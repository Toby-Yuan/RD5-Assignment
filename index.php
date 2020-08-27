<?php

session_start();
require_once("connect.php");

if(isset($_POST["login"])){
    $userName = $_POST["userName"];
    $userPassword = $_POST["userPassword"];
    $userPassword = sha1($userPassword);

    $searchUser = "SELECT id, userPassword FROM member WHERE userName = '$userName'";
    $result = mysqli_query($link, $searchUser);
    $row = mysqli_fetch_assoc($result);

    if($userPassword = $row["userPassword"]){
        $_SESSION["uid"] = $row["id"];

        header("location: member.php");
        exit();
    }
}

if(isset($_GET["logout"])){
    unset($_SESSION["uid"]);
    session_destroy();
}

if(isset($_POST["create"])){
    header("location: create.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>網路銀行</title>
    <link rel="stylesheet" href="CSS/indexStyle.css">
</head>
<body>
    <form action="" method="post">
        <h1>會員登入</h1>
        <label for="userName">帳號</label>
        <input type="text" name="userName" id="userName" pattern="\w{8, 15}" class="inputText"> 
        <label for="userPassword">密碼</label>
        <input type="password" name="userPassword" id="userPassword" pattern="\w{8, 15}" class="inputText">
        <input type="submit" value="登入" name="login" class="btn">
        <input type="submit" value="註冊" name="create" class="btn">
    </form>
</body>
</html>