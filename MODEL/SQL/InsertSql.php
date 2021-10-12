<?php

class InsertSql{

    //auction 테이블에 등록 SQL
    function registerForAuction($inventories_id, $price){
        
        $sql = "INSERT INTO auction (fk_inventories_id, price) VALUE($inventories_id, $price)";
        return $sql;

    }
}