<?php

session_start();
require_once("connect.php");

if(isset($_POST["create"])){
    $userName = $_POST["userName"];
    $userPassword = $_POST["userPassword"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $money = $_POST["money"];

    $userPassword = sha1($userPassword);

    $insertIn = <<<insertin
    INSERT INTO `member`(`userName`, `userPassword`, `email`, `phone`, `userMoney`) 
    VALUES ('$userName', '$userPassword', '$email', '$phone', '$money');
    insertin;
    mysqli_query($link, $insertIn);

    $search = "SELECT id FROM member WHERE userName = '$userName'";
    $result = mysqli_query($link, $search);
    $row = mysqli_fetch_assoc($result);
    $_SESSION["uid"] = $row["id"];

    header("location: member.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>網路銀行</title>
    <link rel="stylesheet" href="CSS/createStyle.css">
</head>
<body>
    <form action="" method="post">
        <h1>會員註冊</h1>
        <label for="userName">帳號</label>
        <input type="text" name="userName" id="userName" pattern="\w{8, 15}" 
            placeholder="請輸入8~15位英文或數字" required class="inputText">
        <label for="userPassword">密碼</label>
        <input type="password" name="userPassword" id="userPassword" pattern="\w{8, 15}" 
            placeholder="請輸入8~15位英文或數字" required class="inputText">
        <label for="email">電子信箱</label>
        <input type="text" name="email" id="email" pattern="\w+([.-]\w+)*@\w+([.]\w+)+" required class="inputText">
        <label for="phone">聯絡電話</label>
        <input type="text" name="phone" id="phone" pattern="\d{10}" 
            placeholder="範例: 0912345678" required class="inputText">
        <label for="money">首次存入(最少1000)</label>
        <input type="text" name="money" id="money" pattern="\d{4,}" required class="inputText">
        <input type="submit" value="註冊" name="create" class="btn">
    </form>
</body>
</html>