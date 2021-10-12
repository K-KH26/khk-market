<?php

/**
 * 옥션에 등록된 판매중인 아이템을 구매하는 MODEL
 * function checkBuyUser() : 옥션 id와 입력받은 sell_user_id 를 확인하고 판매정보 판단
 * function calPrice() : 판매가격과 구매자 보유 차액 비교
 * 옥션 구매 transaction
*/

class AuctionBuyItem
{
    private $db, $pdo;
    private $select_sql;
    private int $auction_id, $sell_user_id, $buy_user_id;

    function __construct( $auction_id, $sell_user_id, $buy_user_id )
    {
        include ('conn.php');
        $this->db = new ConnectDataBase;
        $this->pdo = $this->db->getPDO();
        $this->select_sql = new SelectSql;

        $this->auction_id = $auction_id;
        $this->sell_user_id = $sell_user_id;
        $this->buy_user_id = $buy_user_id;
    }

    /** 옥션에 등록된 아이템 판매자의 등록 id를 조회하고 js로 전달받은 id와 일치하는지 확인한다. */ 
    function checkBuyUser(){
        $check_item_info_sql = $this->select_sql -> buyUserCheck($this->auction_id);
        $result = $this->exePdo($check_item_info_sql);

        if($result['fk_user_id']){
            $fk_user_id = $result['fk_user_id'];
        }else{
            $fk_user_id = null;
        }

        if($fk_user_id != null && $this->sell_user_id != null && ($fk_user_id == $this->sell_user_id)){
            return true;   //판매 아이템 정보 정상
        }else{
            return false;  //판매 아이템 정보 오류
        }
    }

    /** 옥션등록 금액과 구매자 보유 금액과 차액 계산 */
    function calculatePrice(){
        $check_item_info_sql = $this->select_sql -> buyUserCheck($this->auction_id);
        $result = $this->exePdo($check_item_info_sql);

        if($result['price']){
            $selling_price = $result['price'];
        }else{
            return false;
        }

        $check_buy_user_money = $this->select_sql -> hasMoney($this->buy_user_id);
        $result = $this->exePdo($check_buy_user_money);

        if($result['has_money']){
            $buy_user_has_money = $result['has_money'];
        }else{
            return false;
        }

        return $buy_user_has_money - $selling_price;

    }

    /** 
     * 아이템 구매 트랜잭션을 실행. 
     * 파라미터로 구매시 발생한 차액이 들어온다
     * 1. UPDATE AUCTION : SELLING, BUY_USER_ID -> *TRIGGER* : INSERT AUCTION_LOG
     * 2. UPDATE INVENTORIES : FK_USER_ID, FK_AUCTION_ID -> *TRIGGER* : DELETE FROM AUCTION
     * 3. UPDATE USERS : MONEY +-
    */
    function buyItemTransaction(){

        error_reporting(E_ALL);
        ini_set("display_errors",1);

        $doc_root = $_SERVER['DOCUMENT_ROOT'] ;
        include ($doc_root.'/MODEL/SQL/UpdateSql.php');
        
        $update_sql = new UpdateSql;

        try {

            $this->pdo -> beginTransaction(); //트랜잭션 시작

            // 1. UPDATE AUCTION : SELLING, BUY_USER_ID -> *TRIGGER* : INSERT AUCTION_LOG
            $update_auction_sql = $update_sql -> buyItemForAuction($this->auction_id,$this->buy_user_id);
            $stmt = $this->pdo -> prepare($update_auction_sql);
            $result = $stmt->execute();
            $this->failExecute($result);

            // 2. UPDATE INVENTORIES : FK_USER_ID, FK_AUCTION_ID -> *TRIGGER* : DELETE FROM AUCTION
            $update_inventoires_sql = $update_sql -> changeOwner($this->auction_id, $this->buy_user_id);
            $stmt = $this->pdo -> prepare($update_inventoires_sql);
            $result = $stmt->execute();
            $this->failExecute($result);
            
            // 3. UPDATE USERS MONEY +,-
            $select_price_sql = $this->select_sql -> salesAmount($this->auction_id); // 물품 판매 금액 SQL
            $stmt = $this->pdo ->prepare($select_price_sql);
            $result = $stmt->execute();
            $this->failExecute($result);
            
            $result = $stmt -> fetch(PDO::FETCH_ASSOC);
            $price = $result['price'];     //판매 금액             

            //차감
            $update_minus_sql = $update_sql -> minusMoney($this->buy_user_id, $price);
            $stmt = $this->pdo -> prepare($update_minus_sql);
            $result = $stmt->execute();
            $this->failExecute($result);

            //증액
            $update_plus_sql = $update_sql -> plusMoney($this->sell_user_id, $price);
            $stmt = $this->pdo ->prepare($update_plus_sql);
            $result = $stmt->execute();
            $this->failExecute($result);

            $this->pdo -> commit();
            return true;                //정상 처리시 true반환

        } catch (PDOException $e) {
            $this->pdo -> rollBack();
            // return  $e -> getMessage();
            return false;
        }
    }

    function failExecute($result){
        if($result != 1){
            $this->pdo ->rollBack();
            return false; //execute 이후 false리턴시 롤백
        }
    }

    function exePdo($sql){
        $stmt = $this->pdo-> prepare($sql);
        $stmt->execute();
        $result = $stmt -> fetch(PDO::FETCH_ASSOC);

        return $result;
    }

}


// Can't update table 'auction' in stored function/trigger because it is already used by statement which invoked this stored function/trigger"