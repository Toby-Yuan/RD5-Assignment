<?php

require_once './models/memberModel.php';

class name{
    public $result;

    public function __construct(){
        $this->result = new member();
    }

    // 顯示當前會員
    public function loginName(){
        return $this->result->getName();
    }
}

?>