<?php

require_once './models/database.php';
session_start();

class createM extends database{
    public function create(){
        if(isset($_POST["create"])){
            $userName = $_POST["userName"];
            $userPassword = $_POST["userPassword"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $money = $_POST["money"];

            $userPassword = sha1($userPassword);

            // 確認各項資訊與原有會員不重複
            $check1 = $this->checkName();
            $check2 = $this->checkMail();
            $check3 = $this->checkPhone();

            if( ($check1 + $check2 + $check3) == 0 ){
                $insertIn = <<<insertin
                INSERT INTO `member`(`userName`, `userPassword`, `email`, `phone`, `userMoney`) 
                VALUES ('$userName', '$userPassword', '$email', '$phone', '$money');
                insertin;
                $insert = self::query("$insertIn");

                $searchNow = self::query("SELECT id FROM member WHERE userName = '$userName'");
                $_SESSION["uid"] = $searchNow[0]['id'];

                header("location: ./member");
                exit();
            }
            
        }
    }

    public function search(){
        $search = self::query("SELECT userName, email, phone FROM member");
        return $search;
    }

    // 用戶名不重複
    public function checkName(){
        if(isset($_POST["create"])){
            $userName = $_POST["userName"];
            $search = $this->search();
            foreach($search as $key=>$value){
                if($userName == $value[0]){
                    return 1;
                }
            }
        }
    }

    // 電子信箱不重複
    public function checkMail(){
        if(isset($_POST["create"])){
            $email = $_POST["email"];
            $search = $this->search();
            foreach($search as $key=>$value){
                if($email == $value[1]){
                    return 1;
                }
            }
        }
    }

    // 電話不重複
    public function checkPhone(){
        if(isset($_POST["create"])){
            $phone = $_POST["phone"];
            $search = $this->search();
            foreach($search as $key=>$value){
                if($phone == $value[2]){
                    return 1;
                }
            }
        }
    }
}

?>