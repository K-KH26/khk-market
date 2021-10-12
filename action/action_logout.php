<?php
session_start();

/**
 * 로그아웃
 * 유저 세션 초기화, 인덱스 홈페이지로 이동
*/

//유저 세션 로그온, 유저 별명 삭제
unset($_SESSION['user_logon']);
unset($_SESSION['user_alias']);
unset($_SESSION['user_id']);

?>

<script>
    sessionStorage.removeItem("logon");
    sessionStorage.removeItem("user_id");
    location.replace('../index.php');
</script>

