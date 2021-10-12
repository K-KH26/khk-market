<?php

error_reporting(E_ALL);
ini_set("display_errors",1);

$root = $_SERVER['DOCUMENT_ROOT'];
include ($root.'/MODEL/DB/AccountDataBase.php');
include ($root.'/MODEL/DB/ConnectDataBase.php');

/*
 * 회원가입 VALUES - 예외처리 , 중복 email, 중복 alias 확인, 패스워드 암호화, 데이터베이스 저장
 * 0.회원번호   user_id : NULL
 * 1.이메일     email   
 * 2.비밀번호   password
 * 3.별명       alias
 * 4.가입 날짜  signup_date
*/

// <filter_input> 방식
// 1. Array filters Variableization
$filters = array(
    "email" => FILTER_VALIDATE_EMAIL,  // not validate output : bool (false)
    "password" => array(
        'filter' => FILTER_SANITIZE_STRING
    ),
    "check_password" => array(
        'filter' => FILTER_SANITIZE_STRING
    ),
    "alias" => array(
        'filter' => FILTER_SANITIZE_STRING
    ),
);

// ['email'=>$email,'password'=>$password, 'alias'=>$alias ]  = filter_input_array(INPUT_POST,$filters);  //변수로 직접 담기
['email'=>$email, 'password' => $password, 'check_password' => $check_password, 'alias' => $alias] = filter_input_array(INPUT_POST, $filters) ;
//$result = filter_input_array(INPUT_POST,$filters); // 배열로 담기 $result['email'];

// 2. direct coding
// ['email'=>$email,'password'=>$password, 'alias'=>$alias ] = filter_input_array(INPUT_POST,[
//     'email' => FILTER_VALIDATE_EMAIL,
//     'password' => [
//         'filter' => FILTER_SANITIZE_STRING
//     ],
//     'alias' => FILTER_SANITIZE_STRING
// ]);


/**
 * 이메일 형식 예외처리 - 다시 회원가입페이지로 
 * 이동중복 확인 후 DB 저장
*/

if(!$email){
    ?>
    <script>
        alert ('올바른 형식의 이메일 주소가 아닙니다.');
        location.replace('/signup.php');
    </script>
    <?php
}else if($password){ // 기타 중복 확인 후 저장

    $db = new ConnectDataBase;  //db connect
    $pdo = $db->getPDO();       //pdo

    $sel_sql = "SELECT email, alias FROM users ";
    $sel_statement = $pdo -> prepare($sel_sql);
    $sel_statement-> execute();
    $overlap = false;

    //중복검사 1.이메일, 2.별명
    $result = $sel_statement -> fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row){
        if ($row['email'] === $email) {
            $overlap = true;
            ?>
            <script>
                alert ('이미 가입된 이메일 주소입니다.');
                location.replace('/signup.php');
            </script>
            <?php
            break ;
        }else if ($row['alias'] === $alias){
            $overlap = true;
            ?>
            <script>
                alert ('이미 존재하는 별명입니다.');
                location.replace('/signup.php');
            </script>
            <?php
            break;
        }
    }

    //중복 없으면 저장
    if(!$overlap){

        // 패스워드 일치 확인
        if ($password === $check_password){
            //SQL QUERY PREPARE 
            $ins_sql = "INSERT INTO users(id, email, password, alias, signup_date)
            VALUES(null,:email,:password,:alias,current_timestamp())"; //회원가입 정보
            
            $password_hash = password_hash($password,PASSWORD_DEFAULT);

            $ins_statement = $pdo->prepare($ins_sql); //SQL PREPARE
            $ins_statement->bindParam(':email',$email);
            $ins_statement->bindParam(':password',$password_hash);
            $ins_statement->bindParam(':alias',$alias);
    
            $db->transactionPDO($pdo,$ins_statement); // TRANSACTION
            ?>
            <script>
                alert ('회원가입이 완료되었습니다.');  
                location.replace('/login.php');  // 로그인페이지로 이동
            </script>
            <?php
        }else{
            ?>
            <script>
                alert ('비밀번호가 일치하지 않습니다.');
                location.replace('/signup.php');
            </script>
            <?php
        }

        
    }

}else{
    ?>
    <script>
        alert ('비밀번호 양식이 잘못되었습니다.');
        location.replace('/signup.php');
    </script>
    <?php
}