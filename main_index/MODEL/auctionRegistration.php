<?php

/**
 * 입력받은 inventories_id와 세션에 저장된 user_id 로 테이블 조회후 해당 아이템이 있는지 확인한다
 * 리턴받은 값(result)크기가 1일 경우 판매등록을 시작하고
 * 이외는 잘못된 값으로 예외처리한다
*/

class auctionRegistration
{

    private $db;
    private $pdo;

    function __construct()
    {
        include ('conn.php'); 
        $this->db = new ConnectDataBase;
        $this->pdo = $this->db->getPDO();
    }

    //입력받은 값으로 인벤토리 테이블 조회
    public function checkAndUpForAuction($user_id, $inventories_id, $price)
    {
        $select_class = new SelectSql;
        $select_sql = $select_class->sellInventory($user_id, $inventories_id);

        $stmt = $this->pdo->prepare($select_sql);
        $stmt -> execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //사이즈가 1이면서 판매중이 아닐때 판매 등록 || 트랜젝션 || auction 테이블 insert -> inventories 테이블 업데이트 -> 커밋 ||
        if(sizeof($result) == 1 && $result[0]['auc_id'] == null){
            // error_reporting(E_ALL);
            // ini_set("display_errors",1);
            // print_r($result);
            try{

                $this->pdo->beginTransaction();
                $this->upForAuction($inventories_id,$price); //판매 테이블 등록 -> 트리거로 인벤토리테이블 fk_auction_id update         
                $this->pdo->commit();

                return true;
                
            }catch(PDOException $e){
                $this->pdo->rollback();
                // echo $e->getMessage();
                return false;
            }

        }
    
    }

    //sql문으로 판매탭에 INSERT
    function upForAuction($inventories_id,$price){
        include ('/home/market/www/MODEL/SQL/InsertSql.php');
        $insert_class = new InsertSql;
        $insert_sql = $insert_class->registerForAuction($inventories_id,$price);
        
        $stmt = $this->pdo->prepare($insert_sql);
        $stmt->execute();

    }


}

//test
// $test_class = new auctionRegistration;
// $test_class->checkAndUpForAuction(58,1,2000);