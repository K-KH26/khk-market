<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

session_start();

$root = $_SERVER['DOCUMENT_ROOT'];
include ($root.'/MODEL/DB/AccountDataBase.php');
include ($root.'/MODEL/DB/ConnectDataBase.php');

/**
 * 로그인 
 * 
 * 입력 정보 받아와 필터링
 * 유저 정보 일치 시 화면 이동 index.php 로 이동
 * 세션 저장
*/

$filters = array(
    'email' => FILTER_VALIDATE_EMAIL,
    'password'=> array(
        'filter' => FILTER_SANITIZE_STRING
    )
);
['email' => $input_email, 'password' => $input_password] = filter_input_array(INPUT_POST,$filters); //POST 데이터 필터링

$db = new ConnectDataBase;
$pdo = $db->getPDO();

//입력정보 확인
$sel_sql = "SELECT id, email, password, alias FROM users WHERE email=:email";  //입력받은 이메일 확인 SQL문
$sel_statement = $pdo->prepare($sel_sql);
$sel_statement->bindParam(':email',$input_email);

$sel_statement->execute(); 

$result = $sel_statement->fetchAll(PDO::FETCH_ASSOC);


//배열이 비어있으면(=이메일 존재X) 정보 없음, 이메일 확인시 비밀번호 
if(empty($result)){ 
    ?>
    <script>
        const error_cd = 1;
        location.replace("/login.php?error_cd=" + error_cd);
    </script>
    <?php
}else{ 
    //비밀번호 확인
    if(password_verify($input_password,$result[0]['password'])){
        $_SESSION['user_alias'] = $result[0]['alias'];
        $_SESSION['user_id'] = $result[0]['id'];
        $_SESSION['user_logon'] = true;
         ?>
        <script>
            sessionStorage.setItem('user_id', <?php echo $result[0]['id'] ?>);
            sessionStorage.setItem('logon',true);
            location.replace('/index.php');
        </script>
        <?php
    }else{
        ?>
        <script>
            const error_cd = 1;
            location.replace("/login.php?error_cd=" + error_cd);
        </script>
        <?php
    }
}