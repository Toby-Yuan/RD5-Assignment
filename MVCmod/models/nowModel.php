<?php

require_once './models/database.php';
session_start();

class cash extends database{

    public $deposit;
    public $cash;
    public $uid;

    public function __construct(){
        $this->deposit = $_SESSION['deposit'];
        $this->cash = $_SESSION['cash'];
        $this->uid = $_SESSION['uid'];

        unset($_SESSION["deposit"]);
        unset($_SESSION["cash"]);
    }

    public function getMoney(){
        $search = self::query("SELECT userMoney FROM member WHERE id =" . $this->uid);
        $cash = $search[0]['userMoney'];
        echo $cash;
    }

}

?>