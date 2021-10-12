<!-- MVC-VIEW -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>VIEW</title>
</head>
<body>
    <h1>할일</h1>
    <?php
        if($tasks):
    ?>
    <ul>
    <?php foreach($tasks as $row): ?>
        <li><?php
            echo $row['name']." : ".$row['task'] ;
            ?>
        </li>
    <?php endforeach; ?>
    </ul>
    <?php else : ?>
    <p> 할 일이 없다. </p>
    <?php endif ;?>
</body>
</html>