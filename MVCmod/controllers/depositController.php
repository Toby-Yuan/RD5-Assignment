<?php

require_once './models/depositModel.php';

class insert{
    public $result;

    public function __construct(){
        $this->result = new depositRun();
    }

    // 進行存款
    public function insert(){
        $this->result::insert();
    }
}

?>