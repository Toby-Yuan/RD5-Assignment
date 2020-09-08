<?php

session_start();
require_once("connect.php");
$uid = $_SESSION["uid"];

// 預設提款
$deposit = 'N';
$_SESSION["deposit"] = 0;

// 搜尋用戶戶頭餘額
$search = "SELECT userMoney FROM member WHERE id = $uid";
$result = mysqli_query($link, $search);
$row = mysqli_fetch_assoc($result);
$cash = $row["userMoney"];

// 根據不同按鈕提取不同資金
function insertFun($value){
    $nowTime = date("Y-m-d H:i:s");
    global $cash, $uid, $deposit, $link, $alert;
    $cash -= $value;

    // 需有足夠的餘額才可提款
    if($cash >= 0){

        // 新增至明細資料庫
        $insertIn = "INSERT INTO detail (memberId, deposit, cash, nowTime) VALUES ($uid, '$deposit', $value, '$nowTime')";

        // 更新用戶餘額
        $updateIn = "UPDATE member SET userMoney = $cash WHERE id = $uid";
        mysqli_query($link, $insertIn);
        mysqli_query($link, $updateIn);
        $_SESSION["cash"] = $value;
        header("location: now.php");
        exit();
    }else{

        // 提示餘額不足
        $alert = 1;
    }
}

// 不同按鈕提取不同金額
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

// 取消提款
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
    <!-- 提款表格 -->
    <form action="" method="post">

        <!-- 快速提款 -->
        <div id="fast">
            <h1>快速提款</h1>
            <input type="submit" value="1000" name="onek">
            <input type="submit" value="3000" name="trek">
            <input type="submit" value="5000" name="fivk">
            <input type="submit" value="7000" name="senk">
            <input type="submit" value="10000" name="tenk">
        </div>

        <!-- 手動輸入 -->
        <div id="typeIt">
            <h1>輸入金額</h1>
            <input type="text" name="money" id="money" pattern="\d{1,}">
            <h1><?= (isset($alert)) ? "餘額不足" : "" ?></h1>
            <input type="submit" value="送出" id="submit" name="submit">
            <input type="submit" value="回首頁" id="back" name="back">
        </div>
    </form>
</body>
</html>