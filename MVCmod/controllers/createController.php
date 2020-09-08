<?php

require_once './models/createModel.php';

class createC {
    public $result;

    public function __construct(){
        $this->result = new createM();
    }

    // 顯示各項錯誤訊息
    public function repeatName(){
        if($this->result->checkName() == 1){
            return "此帳號已被使用";
        }
    }

    public function repeatMail(){
        if($this->result->checkMail() == 1){
            return "此信箱已被使用";
        }
    }

    public function repeatPhone(){
        if($this->result->checkPhone() == 1){
            return "此電話已被使用";
        }
    }
}

?>