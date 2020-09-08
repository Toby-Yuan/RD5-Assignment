<?php

require_once './models/withdrawalModel.php';

class insert{
    public $result;

    public function __construct(){
        $this->result = new withdrawalRun();
    }

    // 執行提款動作
    public function insert(){
        return $this->result::insert();
    }
}

?>