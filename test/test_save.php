<?php

session_start();

$filters = array(
    'email'=> FILTER_VALIDATE_EMAIL,
    'password'=> array(
        'filter' => FILTER_SANITIZE_STRING
    )
);

['email'=> $email, 'password'=> $password] = filter_input_array(INPUT_POST,$filters);

if($email && $password){

    $user = array(
        'email' => $email,
        'password' => password_hash($password,PASSWORD_DEFAULT)
    );

    $_SESSION['__storage'][$user['email']] = $user;
    
    echo $user['email']."<br>";
    print_r ($_SESSION['__storage'][$user['email']]);
    echo "<br>";
    print_r($_SESSION['__storage']);
    
}