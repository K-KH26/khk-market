<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>QuickSearch</h1>
    <!-- 컨트롤러로 전송, 컨트롤러에서 받은 요청에 맞게 모델에서 data를 받아오고, view.php로 보내준다. view에서 표를 만들고 여기서 include해준다 -->
    <form action="search.php" method="get">  
        <input name="quick" type="text" value="<?php if($_GET['quick']){ echo $_GET['quick']; } ?>"><br>
        <button type="submit">검색 하기</button>
        <br><br><br>
    </form>
    <?php 
     include ('quick-search-view.php');
    ?>
</body>
</html>