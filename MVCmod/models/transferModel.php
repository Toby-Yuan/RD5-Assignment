<?php

require_once './models/database.php';
session_start();

class transferM extends database{


    public function check(){
        $uid = $_SESSION['uid'];
        $search = self::query("SELECT userMoney FROM member WHERE id = $uid");
        return $search[0]['userMoney'];
    }

    public function tranMember($name){
        $search = self::query("SELECT id, userMoney FROM member WHERE userName = '$name'");
        return $search;
    }

    public function tranFun(){
        if(isset($_POST["submit"])){
            $uid = $_SESSION['uid'];
            $tranName = $_POST["tranName"];
            $tranMoney = $_POST["tranMoney"];

            $search1 = $this->check();
            $search2 = $this->tranMember($tranName);

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