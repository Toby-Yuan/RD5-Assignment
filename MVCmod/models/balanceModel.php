<?php

require_once './models/database.php';
session_start();

class getCash extends database{

    public $detailList;

    public function __construct(){
        if(!isset($_SESSION['uid'])){
            header("location: ./hello");
            exit();
        }
    }

    // 抓取用戶戶頭餘額
    public function memberMoney(){
        $uid = $_SESSION['uid'];
        $search = self::query("SELECT userMoney FROM member WHERE id = $uid");
        return $search[0]['userMoney'];
    }

    // 抓取與此用戶有關的交易明細
    public function getDetail(){
        $uid = $_SESSION['uid'];
        $search = self::query("SELECT nowTime, deposit, cash, transfer FROM detail WHERE memberId = $uid ORDER BY nowTime DESC");
        return $search;
    }
}

?>