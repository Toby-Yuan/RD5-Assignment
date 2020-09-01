<?php

session_start();

$insert1 = $_SESSION["insert1"];
$insert2 = $_SESSION["insert2"];
$update1 = $_SESSION["update1"];
$update2 = $_SESSION["update2"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>網路銀行</title>
    <link rel="stylesheet" href="CSS/checkStyle.css">
</head>
<body>
    <div id="box">
        <h1>請再次確認匯款資訊</h1>
        <h2>受匯人帳戶: <?= $_SESSION["tranName"] ?></h2>
        <h2>匯款金額: <?= $_SESSION["tranMoney"] ?></h2>
        <form action="" method="post">
            <input type="submit" value="確認" name="submit">
            <input type="submit" value="取消" name="cancel">
        </form>
    </div>
</body>
</html>