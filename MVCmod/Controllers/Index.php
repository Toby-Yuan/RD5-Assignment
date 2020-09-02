<?php

class Index extends Controller{

    public static function doSomething(){
        if(isset($_POST["login"])){
            $error = 0;
            $userName = $_POST["userName"];
            $userPassword = $_POST["userPassword"];
            $userPassword = sha1($userPassword);

            $member = self::query("SELECT id, userPassword FROM member WHERE userName = '$userName'");

            if(!isset($member[0]['id'])){
                $error = 1;
            }else{
                if($userPassword == $member[0]['userPassword']){
                    
                }else{
                    $error = 2;
                }
            }
            echo $error;
        }
    }

}

?>