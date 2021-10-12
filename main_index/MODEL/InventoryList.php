<?php
/*
 * 인벤토리 데이터 리스트를 가지고 온다 
*/


class InventoryList
{
    private $db, $pdo;

    function __construct()
    {
        include ('conn.php');
        $this->db = new ConnectDataBase;
        $this->pdo = $this->db -> getPDO();
    }

    //현재 보유 아이템 인벤토리
    public function getInventroies($user_id)
    {
        $select_sql = new SelectSql;
        $sql_inventory = $select_sql->userInventory($user_id);
        $result = $this->executeSql($sql_inventory);

        $list = array();

        foreach($result as $row){
            if($row['auc_id'] == null){ //판매 등록 안되어 있는 아이템만 가지고온다
                $list[] = $row;
            }
            
        }
        return $list;
        
    }


    //판매중인 인벤토리
    function getSellingInventories($user_id)
    {
        $select_sql = new SelectSql;
        $sql_selling = $select_sql->sellingUserInventories($user_id);
        $result = $this->executeSql($sql_selling);

        $list = array();
        foreach ($result as $row){
           $list[] = $row;
        }

        return $list;
    }

    //접속 유저 보유 금액
    function getMoney($user_id){
        $select_sql = new SelectSql;
        $sql_get_money = $select_sql -> hasMoney($user_id);
        $result = $this->executeSql($sql_get_money);

        $money = $result[0]['has_money'];

        return $money ;

    }
    
    function executeSql($sql){

        $stmt = $this->pdo-> prepare($sql);
        $stmt -> execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
       
    }


}