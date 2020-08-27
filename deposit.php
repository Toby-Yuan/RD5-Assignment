<?php

session_start();
require_once("connect.php");
$uid = $_SESSION["uid"];
$deposit = 'Y';
$_SESSION["deposit"] = 1;

$search = "SELECT userMoney FROM member WHERE id = $uid";
$result = mysqli_query($link, $search);
$row = mysqli_fetch_assoc($result);
$cash = $row["userMoney"];

function insertFun($value){
    $nowTime = date("Y-m-d H:i:s");
    global $cash, $uid, $deposit, $link;
    $cash += $value;
    $insertIn = "INSERT INTO detail (memberId, deposit, cash, nowTime) VALUES ($uid, '$deposit', $value, '$nowTime')";
    $updateIn = "UPDATE member SET userMoney = $cash WHERE id = $uid";
    mysqli_query($link, $insertIn);
    mysqli_query($link, $updateIn);
    $_SESSION["cash"] = $value;
    header("location: now.php");
    exit();
}

if(isset($_POST["onek"])){
    insertFun(1000);
}

if(isset($_POST["trek"])){
    insertFun(3000);
}

if(isset($_POST["fivk"])){
    insertFun(5000);
}

if(isset($_POST["senk"])){
    insertFun(7000);
}

if(isset($_POST["tenk"])){
    insertFun(10000);
}

if(isset($_POST["submit"])){
    $type = $_POST["money"];
    insertFun($type);
}

if(isset($_POST["back"])){
    unset($_SESSION["deposit"]);
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
    <link rel="stylesheet" href="CSS/depositStyle.css">
</head>
<body>
    <form action="" method="post">
        <div id="fast">
            <h1>快速存款</h1>
            <input type="submit" value="1000" name="onek">
            <input type="submit" value="3000" name="trek">
            <input type="submit" value="5000" name="fivk">
            <input type="submit" value="7000" name="senk">
            <input type="submit" value="10000" name="tenk">
        </div>
        <div id="typeIt">
            <h1>輸入金額</h1>
            <input type="text" name="money" id="money" pattern="\d{1,}">
            <input type="submit" value="送出" id="submit" name="submit">
            <input type="submit" value="回首頁" id="back" name="back">
        </div>
    </form>
</body>
</html>