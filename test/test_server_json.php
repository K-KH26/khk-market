<?php
// header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

// $index = $_GET['index'];
// $desc = ['Best Friend', 'Favorite Language', 'Best Musician'];
// $name = ['Aram Kim', 'Python', 'IU'];
// $json = json_encode(array('desc' => $desc[$index], 'name' => $name[$index]));
// echo($json);
if($method == "GET"){
    // 1. 자바스크립트 객체 또는 serialize()로 전달
    $name = $_GET['name'];
    $age = $_GET['age'];

    $data = json_encode(array(
        'name' => $name,
        'age' => $age
    ));

    echo ($data);

    // 2. JSON.stringify() 로 전달
    // $data = json_decode($_GET['data']);
    // echo (json_encode(array(
    //     "mode" => $_REQUEST['mode'],
    //     "name" => $data->name,
    //     "age" => $data->age
    // )));

}else if($method == "POST"){
    // 1. 자바스크립트 객체 또는 serialize()로 전달
    $name = $_POST['name'];
    $age = $_POST['age'];
    $data = json_encode(array(
        'name' => $name,
        'age' => $age
    ));
    echo ($data);

    // 2. JSON.stringify() 로 전달
    // $data = json_decode($_POST['data']);
    // echo (json_encode(array(
    //     "mode" => $_REQUEST['mode'],
    //     "name" => $data->name,
    //     "age" => $data->age
    // )));
}