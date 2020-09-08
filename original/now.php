<?php

session_start();
require_once("connect.php");

// 接取預設動作
$deposit = $_SESSION["deposit"];
$cash = $_SESSION["cash"];
$uid = $_SESSION["uid"];

unset($_SESSION["deposit"]);
unset($_SESSION["cash"]);

// 搜尋用戶餘額
$search = "SELECT userMoney FROM member WHERE id = $uid";
$result = mysqli_query($link, $search);
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>網路銀行</title>
    <link rel="stylesheet" href="CSS/nowStyle.css">
</head>
<body>
    <!-- 顯示交易結果 -->
    <div id="box">
        <h1>本次紀錄</h1>
        <h2><?= ($deposit == 1) ? "存款" : "提款" ?></h2>
        <p>本次交易金額:&nbsp;<span><?= $cash ?></span></p>
        <p>帳戶餘額:&nbsp;<span id="money">*****</span></p>
        <div id="hide" style="cursor: pointer;"><img src="./img/open.png" alt=""></div>
        <div></div>
        <a href="member.php" id="link">回首頁</a>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){

            // 顯示或隱藏餘額
            function clickHide(){
                $("#hide").on("click", function(){
                    $("#money").text("<?= $row["userMoney"] ?>");
                    $("#hide").html("<img src='./img/close.png'>");

                    $("#hide").on("click", function(){
                        $("#money").text("*****");
                        $("#hide").html("<img src='./img/open.png'>");
                        clickHide();
                    });
                });
            }

            clickHide();
        });
    </script>
</body>
</html>