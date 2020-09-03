<?php
require_once './controllers/memberController.php';
$result = new name;
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>網路銀行</title>
    <link rel="stylesheet" href="./CSS/memberStyle.css">
</head>
<body>
    <div id="contant">
        <h1>HELLO <?= $result->loginName() ?> !!</h1>
        <div id="box">
            <a href="./deposit" class="act">
                存款
            </a>
            <a href="./withdrawal" class="act">
                提款    
            </a>
            <a href="./balance" class="act">
                查詢餘額
            </a>
            <a href="./transfer" class="act">
                匯款
            </a>
        </div>

        <a href="./hello?logout=1" class="logout">登出</a>
    </div>
</body>
</html>