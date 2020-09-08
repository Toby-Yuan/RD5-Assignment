<?php

require_once './models/database.php';
session_start();

class member extends database{

    // 確認登入身份符合
    public static function getLogin(){
        $error = 0;
        if(isset($_POST["login"])){
            $userName = $_POST["userName"];
            $userPassword = $_POST["userPassword"];
            $userPassword = sha1($userPassword);

            $member = self::query("SELECT id, userPassword FROM member WHERE userName = '$userName'");

            if(!isset($member[0]['id'])){
                $error = 1;
            }else{
                if($userPassword == $member[0]['userPassword']){
                    $_SESSION["uid"] = $member[0]['id'];
    
                    header("location: ./member");
                    exit();
                }else{
                    $error = 2;
                }
            }
        }
        return $error;
    }

    // 跳轉至註冊頁面
    public function create(){
        if(isset($_POST["create"])){
            header("location: ./create");
            exit();
        }
    }

    // 登出系統
    public function logout(){
        if(isset($_GET["logout"])){
            unset($_SESSION["uid"]);
            session_destroy();
            header("location: ./hello");
            exit();
        }
    }
}

?>