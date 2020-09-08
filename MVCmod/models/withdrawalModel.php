<?php

require_once './models/database.php';
session_start();

class withdrawalRun extends database{

    public function __construct(){
        if(!isset($_SESSION['uid'])){
            header("location: ./hello");
            exit();
        }
    }

    // 提款動作, 根據不同按鈕執行不同金額
    public static function insert(){
        $uid = $_SESSION['uid'];
        $_SESSION["deposit"] = 0;
        $search = self::query("SELECT userMoney FROM member WHERE id = $uid");
        $cash = $search[0]['userMoney'];
        
        if(isset($_POST["onek"])){
            return self::insertFun(1000, $uid, $cash);
        }

        if(isset($_POST["trek"])){
            return self::insertFun(3000, $uid, $cash);
        }
        
        if(isset($_POST["fivk"])){
            return self::insertFun(5000, $uid, $cash);
        }
        
        if(isset($_POST["senk"])){
            return self::insertFun(7000, $uid, $cash);
        }
        
        if(isset($_POST["tenk"])){
            return self::insertFun(10000, $uid, $cash);
        }
        
        if(isset($_POST["submit"])){
            $type = $_POST["money"];
            return self::insertFun($type, $uid, $cash);
        }

        if(isset($_POST["back"])){
            unset($_SESSION["deposit"]);
            header("location: ./member");
            exit();
        }
    }

    // 提出不同金額, 若餘額不足會提示
    public static function insertFun($value, $uid, $cash){
        $nowTime = date("Y-m-d H:i:s");
        $cash -= $value;

        if($cash >= 0){
            $insert = self::query("INSERT INTO detail (memberId, deposit, cash, nowTime) VALUES ($uid, 'N', $value, '$nowTime')");
            $update = self::query("UPDATE member SET userMoney = $cash WHERE id = $uid");
            $_SESSION["cash"] = $value;
            header("location: ./now");
            exit();
        }else{
            return 1;
        }
    }
}

?>