<?php

require_once './models/database.php';
session_start();

class checkM extends database{
    
    public function __construct(){
        if(!isset($_SESSION['uid'])){
            header("location: ./hello");
            exit();
        }
    }

    // 抓取用戶戶頭餘額
    public function check(){
        $uid = $_SESSION['uid'];
        $search = self::query("SELECT userMoney FROM member WHERE id = $uid");
        return $search[0]['userMoney'];
    }

    // 抓取受匯人資訊
    public function tranMember(){
        $mid = $_SESSION['member'];
        $search = self::query("SELECT userName, userMoney FROM member WHERE id = $mid");
        return $search;
    }

    // 匯款動作
    public function transfer(){
        $uid = $_SESSION['uid'];
        $mid = $_SESSION['member'];
        $cash = $_SESSION['cash'];
        $nowTime = date("Y-m-d H:i:s");

        $search1 = $this->check();
        $search2 = $this->tranMember();

        $member1Money = $search1 - $cash;
        $member2Money = $search2[0]['userMoney'] + $cash;

        // 新增兩筆交易明細(匯款人為提款, 受匯人為存款), 更新兩方帳戶餘額
        if(isset($_POST["submit"])){
            $insert1 = self::query("INSERT INTO detail (memberId, deposit, cash, nowTime, transfer) VALUES ($uid, 'N', $cash, '$nowTime', 1)");
            $insert2 = self::query("INSERT INTO detail (memberId, deposit, cash, nowTime, transfer) VALUES ($mid, 'Y', $cash, '$nowTime', 2)");
            $update1 = self::query("UPDATE member SET userMoney = $member1Money WHERE id = $uid");
            $update2 = self::query("UPDATE member SET userMoney = $member2Money WHERE id = $mid");

            unset($_SESSION['member']);
            unset($_SESSION['cash']);

            header("location: ./member");
            exit();
        }

        if(isset($_POST["cancel"])){
            unset($_SESSION['member']);
            unset($_SESSION['cash']);

            header("location: ./member");
            exit();
        }
    }
}

?>