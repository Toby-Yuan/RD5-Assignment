<?php

require_once './models/depositModel.php';

class insert{
    public $result;

    public function __construct(){
        $this->result = new depositRun();
    }

    public function insert(){
        $this->result::insert();
    }
}

?>