<?php
require_once './controllers/helloController.php';
$error = new controller;
$error->result->create();
$error->result->logout();
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>網路銀行</title>
    <link rel="stylesheet" href="./CSS/indexStyle.css">
</head>
<body>
    <!-- 會員登入表格 -->
    <form action="" method="post">
        <h1>會員登入</h1>
        <label for="userName">帳號</label>
        <input type="text" name="userName" id="userName" pattern="\w{8, 15}" class="inputText"> 
        <p><?= ($error->loginCheck() == 1)? "無此帳號" : "" ?></p>
        <label for="userPassword">密碼</label>
        <input type="password" name="userPassword" id="userPassword" pattern="\w{8, 15}" class="inputText">
        <p><?= ($error->loginCheck() == 2)? "密碼錯誤" : "" ?></p>
        <input type="submit" value="登入" name="login" class="btn">
        <input type="submit" value="註冊" name="create" class="btn">
    </form>
</body>
</html>