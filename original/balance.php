<?php

session_start();
require_once("connect.php");

// 需登入才可進入
if(!isset($_SESSION["uid"])){
    header("location: index.php");
    exit();
}else{
    // 搜尋用戶餘額
    $uid = $_SESSION["uid"];
    $search = "SELECT userMoney FROM member WHERE id = $uid";
    $result = mysqli_query($link, $search);
    $row = mysqli_fetch_assoc($result);

    // 搜尋與此用戶相關的明細, 並且依照時間排列
    $searchDetail = "SELECT nowTime, deposit, cash, transfer FROM detail WHERE memberId = $uid ORDER BY nowTime DESC";
    $resultDetail = mysqli_query($link, $searchDetail);
}

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
        <!-- 顯示餘額 -->
        <h1>現有餘額</h1>
        <p id="money">*****</p>
        <div id="hide" style="cursor: pointer;"><img src="./img/open.png" alt=""></div>
        <a href="member.php">回首頁</a>

        <!-- 顯示明細 -->
        <h2>交易明細</h2>
        <table>
            <tr>
                <th>時間戳記</th>
                <th>存款</th>
                <th>提款</th>
                <th>餘額</th>
                <th>備註</th>
            </tr>

            <?php 
                $money = $row["userMoney"];
                while($detail = mysqli_fetch_assoc($resultDetail)) { 
            ?>
                <tr>
                    <td><?= $detail["nowTime"] ?></td>

                    <!-- 區分提款或存款 -->
                    <?php if($detail["deposit"] == 'Y'){ ?>
                        <td><?= $detail["cash"] ?></td>
                        <td>0</td>
                        <td><?= $money ?></td>
                        <td><?= ($detail["transfer"] == 0)? "" : "匯款" ?></td>
                    <?php
                            $money = $money - $detail["cash"]; 
                        } else {
                    ?>
                        <td>0</td>
                        <td><?= $detail["cash"] ?></td>
                        <td><?= $money ?></td>
                        <td><?= ($detail["transfer"] == 0)? "" : "匯款" ?></td>
                    <?php
                            $money = $money + $detail["cash"]; 
                        } 
                    ?>
                </tr>
            <?php } ?>

            <!-- <tr>
                <td>1</td>
                <td>1</td>
                <td>1</td>
                <td>1</td>
            </tr> -->
        </table>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            //  顯示或隱藏餘額
            function clickHide(){
                $("#hide").on("click", function(){
                    $("#money").text("<?= $row["userMoney"] ?>");
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