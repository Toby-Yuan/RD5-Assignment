<?php

require_once './models/database.php';
session_start();

class transferM extends database{

    public function __construct(){
        if(!isset($_SESSION['uid'])){
            header("location: ./hello");
            exit();
        }
    }

    // 抓取此用戶餘額
    public function check(){
        $uid = $_SESSION['uid'];
        $search = self::query("SELECT userMoney FROM member WHERE id = $uid");
        return $search[0]['userMoney'];
    }

    // 抓取受匯人資訊
    public function tranMember($name){
        $search = self::query("SELECT id, userMoney FROM member WHERE userName = '$name'");
        return $search;
    }

    // 匯款動作
    public function tranFun(){
        if(isset($_POST["submit"])){
            $uid = $_SESSION['uid'];
            $tranName = $_POST["tranName"];
            $tranMoney = $_POST["tranMoney"];

            $search1 = $this->check();
            $search2 = $this->tranMember($tranName);

            // 確認各項成立: 餘額足夠, 受匯人存在, 受匯人不是自己
            if( ($search1 - $tranMoney) < 0 ){
                return 1;
            }else if(!isset($search2[0]['id'])){
                return 2;
            }else if($uid == $search2[0]['id']){
                return 3;
            }else{
                $_SESSION["member"] = $search2[0]['id'];
                $_SESSION["cash"] = $tranMoney;

                header("location: ./check");
                exit();
            }
        }

        if(isset($_POST["back"])){
            header("location: ./member");
            exit();
        }
    }
}

?>