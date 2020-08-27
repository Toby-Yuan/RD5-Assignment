<?php

session_start();
require_once("connect.php");

if(!isset($_SESSION["uid"])){
    header("location: index.php");
    exit();
}else{
    $uid = $_SESSION["uid"];
    $search = "SELECT userMoney FROM member WHERE id = $uid";
    $result = mysqli_query($link, $search);
    $row = mysqli_fetch_assoc($result);

    $searchDetail = "SELECT nowTime, deposit, cash FROM detail WHERE memberId = $uid ORDER BY nowTime DESC";
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
        <h1>現有餘額</h1>
        <p><?= $row["userMoney"] ?></p>
        <a href="member.php">回首頁</a>

        <h2>交易明細</h2>
        <table>
            <tr>
                <th>時間戳記</th>
                <th>存款</th>
                <th>提款</th>
                <th>餘額</th>
            </tr>

            <?php 
                $money = $row["userMoney"];
                while($detail = mysqli_fetch_assoc($resultDetail)) { 
            ?>
                <tr>
                    <td><?= $detail["nowTime"] ?></td>

                    <?php if($detail["deposit"] == 'Y'){ ?>
                        <td><?= $detail["cash"] ?></td>
                        <td>0</td>
                        <td><?= $money ?></td>
                    <?php
                            $money = $money - $detail["cash"]; 
                        } else {
                    ?>
                        <td>0</td>
                        <td><?= $detail["cash"] ?></td>
                        <td><?= $money ?></td>
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
</body>
</html>