<?php

class SearchModel{

    function quickSearch($data){
        
        include ('conn.php');
        include ($root.'/MODEL/SQL/SelectSql.php');
       
        $db = new ConnectDataBase;
        $pdo = $db->getPDO();

        $selectSql = new SelectSql;
        $sql = $selectSql->quickSearch("items",$data);

        $stmt = $pdo -> prepare($sql);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $list = [];
        while($result = $stmt->fetch()){
            $list[] = $result;
        }

        return $list;

    }

}