<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tttest</title>
</head>
<body>
    <h1>안녕
    <?php
     if(isset($_SESSION['UID'])){
        echo $_SESSION['UID'];
    }
    ?>
    </h1>
    <form action="test_save.php" method="post">
        <input type="email" name="email"><br>
        <input type="password" name="password"><br>
        <button type="submit">가입</button>
    </form>
    <form action="password_verify.php" method="post">
        <input type="email" name="email"><br>
        <input type="password" name="password"><br>
        <button type="submit">로그인</button>
    </form>
</body>
</html>