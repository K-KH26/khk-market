<?php
session_start();

//인벤토리 컨트롤
if($_SESSION['user_id']){

    // 인벤토리 데이터 리스트를 가지고 온다
    include ('../main_index/MODEL/inventoryList.php');

    $user_id = $_SESSION['user_id'];
    $inventoryList = new inventoryList;
    $list = $inventoryList->getInventroies($user_id);


    //인벤토리 데이터를 테이블로 만드는 함수를 만든다
    include ('../test/test-table.php');

    //함수를 이후에 테이블에 적용한다
}


