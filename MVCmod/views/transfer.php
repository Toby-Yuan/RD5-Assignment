<?php
require_once './controllers/transferController.php';
$test = new tranGet();
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>網路銀行</title>
    <link rel="stylesheet" href="CSS/transferStyle.css">
</head>
<body>
    <div id="box">
        <h1>匯款資訊</h1>

        <!-- 匯款表格 -->
        <form action="" method="post">
            <label for="tranName">受匯人帳戶&nbsp;</label>
            <input type="text" id="tranName" name="tranName">
            <br>
            <label for="tranMoney">匯款金額&nbsp;</label>
            <input type="text" id="tranMoney" name="tranMoney">
            <h2><?= $test->tranCheck(); ?></h2>

            <br>
            <input type="submit" value="送出" name="submit">
            <input type="submit" value="回首頁" name="back">
        </form>
    </div>
</body>
</html>