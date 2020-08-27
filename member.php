<?php

session_start();
require_once("connect.php");

if(!isset($_SESSION["uid"])){
    header("location: index.php");
    exit();
}else{
    $uid = $_SESSION["uid"];
    $search = "SELECT userName FROM member WHERE id = $uid";
    $result = mysqli_query($link, $search);
    $row = mysqli_fetch_assoc($result);
}

?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>網路銀行</title>
    <link rel="stylesheet" href="CSS/memberStyle.css">
</head>
<body>
    <div id="contant">
        <h1>HELLO <?= $row["userName"] ?> !!</h1>
        <div id="box">
            <a href="deposit.php" class="act">
                存款
            </a>
            <a href="withdrawal.php" class="act">
                提款    
            </a>
            <a href="balance" class="act">
                查詢餘額
            </a>
        </div>

        <a href="index.php?logout=1">登出</a>
    </div>
</body>
</html>