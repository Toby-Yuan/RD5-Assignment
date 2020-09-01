<?php

session_start();

if(isset($_POST["submit"])){
    $uid = $_SESSION["uid"];
    $tranName = $_POST["tranName"];
    $tranMoney = $_POST["tranMoney"];
    $nowTime = date("Y-m-d H:i:s");

    $search1 = "SELECT userMoney FROM member WHERE id = $uid";
    $search2 = "SELECT id, userMoney FROM member WHERE userName = $tranName";
    $result1 = mysqli_query($link, $search1);
    $result2 = mysqli_query($link, $search2);
    $member1 = mysqli_fetch_assoc($result1);
    $member2 = mysqli_fetch_assoc($result2);

    $member1Money = $member1["userMoney"] - $tranMoney;
    $member2Id = $member2["id"];
    $member2Money = $member2["userMoney"] + $tranMoney;

    $_SESSION["insert1"] = "INSERT INTO detail (memberId, deposit, cash, nowTime, transfer) VALUES ($uid, 'N', $tranMoney, '$nowTime', 1)";
    $_SESSION["insert2"] = "INSERT INTO detail (memberId, deposit, cash, nowTime, transfer) VALUES ($member2Id, 'N', $tranMoney, '$nowTime', 2)";
    $_SESSION["update1"] = "UPDATE member SET userMoney = $member1Money WHERE id = $uid";
    $_SESSION["update2"] = "UPDATE member SET userMoney = $member2Money WHERE id = $member2Id";

    header("location: check.php");
    exit();
}

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

        <form action="" method="post">
            <label for="tranName">受匯人帳戶&nbsp;</label>
            <input type="text" id="tranName" name="tranName">
            <br>
            <label for="tranMoney">匯款金額&nbsp;</label>
            <input type="text" id="tranMoney" name="tranMoney">

            <br>
            <input type="submit" value="送出" name="submit">
            <input type="submit" value="回首頁" name="back">
        </form>
    </div>
</body>
</html>