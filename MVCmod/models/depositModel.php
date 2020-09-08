<?php

require_once './models/database.php';
session_start();

class depositRun extends database{

    public function __construct(){
        if(!isset($_SESSION['uid'])){
            header("location: ./hello");
            exit();
        }
    }

    // 存款動作, 根據不同按鈕執行不同金額
    public static function insert(){
        $uid = $_SESSION['uid'];
        $_SESSION["deposit"] = 1;
        $search = self::query("SELECT userMoney FROM member WHERE id = $uid");
        $cash = $search[0]['userMoney'];
        
        if(isset($_POST["onek"])){
            self::insertFun(1000, $uid, $cash);
        }

        if(isset($_POST["trek"])){
            self::insertFun(3000, $uid, $cash);
        }
        
        if(isset($_POST["fivk"])){
            self::insertFun(5000, $uid, $cash);
        }
        
        if(isset($_POST["senk"])){
            self::insertFun(7000, $uid, $cash);
        }
        
        if(isset($_POST["tenk"])){
            self::insertFun(10000, $uid, $cash);
        }
        
        if(isset($_POST["submit"])){
            $type = $_POST["money"];
            self::insertFun($type, $uid, $cash);
        }

        if(isset($_POST["back"])){
            unset($_SESSION["deposit"]);
            header("location: ./member");
            exit();
        }
    }

    // 存入不同金額, 增加明細和更新用戶戶頭
    public static function insertFun($value, $uid, $cash){
        $nowTime = date("Y-m-d H:i:s");
        $cash += $value;
        $insert = self::query("INSERT INTO detail (memberId, deposit, cash, nowTime) VALUES ($uid, 'Y', $value, '$nowTime')");
        $update = self::query("UPDATE member SET userMoney = $cash WHERE id = $uid");
        $_SESSION["cash"] = $value;
        header("location: ./now");
        exit();
    }
}



?>