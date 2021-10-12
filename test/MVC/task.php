<?php

/**
 * MVC - CONTROLLER
 * 가정)
 * 모바일인 경우 -> 제이슨형식으로 반환
 * 모바일이 아닌 경우 -> html 형식으로 반환
*/

include ('./TaskModel.php');
$tasks = TaskModel::all(); //데이터 받아옴

$mode = filter_var($_GET['mode'],FILTER_SANITIZE_STRING);

if($mode === "app"){
    include ('./task-list-json.php');
}else{
    include ('./task-list-html.php');
}

