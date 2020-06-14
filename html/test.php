<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <?php
    session_start();
    echo  $_SESSION['username'];

    ?>

<!---->
<!--</head>-->
<!--<body>-->
<!--<ul class="header-right fr">-->
<!--    <li>-->
<!--        --><?php //if(isset($_SESSION['username'])) : ?>
<!--        <a href="#">欢迎您,--><?php //echo $_SESSION['username']; ?><!--</a>-->
<!--        <a href="exit.php">退出登陆</a>-->
<!--        --><?php //else: ?>
<!--        <a href="register/index.php">注册</a>-->
<!--        <a href="login/index.php">登陆</a>-->
<!--        --><?php //endif ?>
<!--    </li>-->
<!--    <li>-->
<!--        <a href="#">中文(简体)</a>-->
<!--    </li>-->
<!--    <li>-->
<!--        <a href="#"> 400-01-0000</a>-->
<!--    </li>-->
<!--    <li>-->
<!--        <a href="#">天猫旗舰店</a>-->
<!--    </li>-->
<!--</ul>-->
<!---->
<!---->
<!--</body>-->
</html>