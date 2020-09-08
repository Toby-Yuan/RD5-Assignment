<?php

require_once './models/database.php';
session_start();

class member extends database{

    public function __construct(){
        if(!isset($_SESSION['uid'])){
            header("location: ./hello");
            exit();
        }
    }

    // 抓取當前會員名稱
    public function getName(){
        $uid = $_SESSION['uid'];
        $member = self::query("SELECT userName FROM member WHERE id = $uid");

        return $member[0]['userName'];
    }

}

?>