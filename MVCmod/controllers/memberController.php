<?php

require_once './models/memberModel.php';

class name{
    public $result;

    public function __construct(){
        $this->result = new member();
    }

    public function loginName(){
        return $this->result->getName();
    }
}

?>