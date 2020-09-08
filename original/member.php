<?php

session_start();
require_once("connect.php");

// 需登入才可進入
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
    <link rel="stylesheet" href="./CSS/memberStyle.css">

    <style>
        .logout{
            text-decoration: none;
            color: black;
            font-size: 24px;
        }
    </style>
</head>
<body>

    <!-- 會員區域, 以及各頁面連結 -->
    <div id="contant">
        <h1>HELLO <?= $row["userName"] ?> !!</h1>
        <div id="box">
            <a href="deposit.php" class="act">
                存款
            </a>
            <a href="withdrawal.php" class="act">
                提款    
            </a>
            <a href="balance.php" class="act">
                查詢餘額
            </a>
            <a href="transfer.php" class="act">
                匯款
            </a>
        </div>

        <a href="index.php?logout=1" class="logout">登出</a>
    </div>
</body>
</html>