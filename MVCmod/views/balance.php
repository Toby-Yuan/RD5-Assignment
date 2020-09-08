<?php
require_once './controllers/balanceController.php';
$test = new detail;
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>網路銀行</title>
    <link rel="stylesheet" href="CSS/balanceStyle.css">
</head>
<body>
    <div id="box">
        <h1>現有餘額</h1>
        <p id="money">*****</p>
        <div id="hide" style="cursor: pointer;"><img src="./img/open.png" alt=""></div>
        <a href="./member">回首頁</a>

        <h2>交易明細</h2>
        <table>
            <tr>
                <th>時間戳記</th>
                <th>存款</th>
                <th>提款</th>
                <th>餘額</th>
                <th>備註</th>
            </tr>

            <?php $test->detail(); ?>

        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            // 顯示或隱藏餘額
            function clickHide(){
                $("#hide").on("click", function(){
                    $("#money").text("<?= $test->result->memberMoney() ?>");
                    $("#hide").html('<img src="./img/close.png" alt="">');

                    $("#hide").on("click", function(){
                        $("#money").text("*****");
                        $("#hide").html('<img src="./img/open.png" alt="">');
                        clickHide();
                    });
                });
            }

            clickHide();
        });
    </script>
</body>
</html>