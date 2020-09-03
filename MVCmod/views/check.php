<?php
require_once './controllers/checkController.php';
$test = new checkC();
$test->result->transfer();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>網路銀行</title>
    <link rel="stylesheet" href="./CSS/checkStyle.css">
</head>
<body>
    <div id="box">
        <h1>請再次確認匯款資訊</h1>
        <h2>受匯人帳戶: <?= $test->member() ?></h2>
        <h2>匯款金額: <?= $_SESSION["cash"] ?></h2>
        <form action="" method="post">
            <input type="submit" value="確認" name="submit">
            <input type="submit" value="取消" name="cancel">
        </form>
    </div>
</body>
</html>