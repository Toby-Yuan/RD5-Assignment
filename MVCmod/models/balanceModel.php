<?php

require_once './models/database.php';
session_start();

class getCash extends database{

    public $detailList;

    public function memberMoney(){
        $uid = $_SESSION['uid'];
        $search = self::query("SELECT userMoney FROM member WHERE id = $uid");
        return $search[0]['userMoney'];
    }

    public function getDetail(){
        $uid = $_SESSION['uid'];
        $search = self::query("SELECT nowTime, deposit, cash, transfer FROM detail WHERE memberId = $uid ORDER BY nowTime DESC");
        return $search;
    }
}

?>