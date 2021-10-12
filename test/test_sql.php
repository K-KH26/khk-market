<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
include ('test_conn.php');
include ('../MODEL/SQL/SelectSql.php');
include ('../MODEL/SQL/UpdateSql.php');


$db = new ConnectDataBase;
$pdo = $db->getPDO();

$user_id = 58;
$inventory_id = 444;
$input = "";


$select_sql = new SelectSql;
$update_sql = new UpdateSql;

// $sql = $select_sql -> hasMoney($user_id);
// $sql = $select_sql->sellInventory($user_id,$inventory_id);
// $sql = $select_sql->sellingUserInventories($user_id);
// $sql = $select_sql->quickSearch($input);

// $sql = $update_sql -> plusMoney(55,10);

phpinfo();



function executePDO($pdo, $sql){
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    print_r($result);
}
