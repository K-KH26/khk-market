<?php

session_start();

$filters = array(
    'email'=> FILTER_VALIDATE_EMAIL,
    'password'=> array(
        'filter' => FILTER_SANITIZE_STRING
    )
);

['email'=> $email, 'password'=> $password] = filter_input_array(INPUT_POST,$filters);

//로그인 확인
if($email&&$password){

    if(array_key_exists($email,$_SESSION['__storage'])){
        $user = $_SESSION['__storage'][$email];

        if(password_verify($password,$user['password'])){
            $_SESSION['UID'] = $user['email'];
        }else{
            $_SESSION['UID'] = null;
        }
    }
}
?>
<script>
location.replace('kkk.php');
</script>
