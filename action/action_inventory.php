<?php
/**
 * 로그인 된 유저의 아이템 목록을 불러온다.
 * 로그인 된 유저의 현재 보유 금액을 가지고 온다.
 * 
*/

$user_id = $_SESSION['user_id'];

// user_id에 해당하는 유저 인벤토리와 판매중목록 데이터 추출
include ('main_index/MODEL/InventoryList.php');
$inventory = new InventoryList;
$inventory_list = $inventory->getInventroies($user_id);         //접속 유저 인벤토리
$selling_list = $inventory->getSellingInventories($user_id);    //접속 유저 판매중 아이템 리스트
$has_money = $inventory->getMoney($user_id);                    //접속 유저 보유 금액

//list로 table view를 보여줄 클래스 
include ('main_index/VIEW/view-inventory.php');
$view_make_table = new ViewTable;

//접속 유저 보유 금액 view
include ('main_index/VIEW/view-money.php');
$view_make_money_div = new ViewMoney;

 
