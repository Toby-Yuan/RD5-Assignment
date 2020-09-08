<?php
require_once './controllers/withdrawalController.php';
$test = new insert;
$alert = $test->insert();
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>網路銀行</title>
    <link rel="stylesheet" href="./CSS/depositStyle.css">
</head>
<body>
    <!-- 提款表格 -->
    <form action="" method="post">
        <div id="fast">
            <h1>快速提款</h1>
            <input type="submit" value="1000" name="onek">
            <input type="submit" value="3000" name="trek">
            <input type="submit" value="5000" name="fivk">
            <input type="submit" value="7000" name="senk">
            <input type="submit" value="10000" name="tenk">
        </div>
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