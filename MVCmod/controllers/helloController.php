<?php

require_once './models/helloModel.php';

class controller {

    public $result;

    public function __construct(){
        $this->result = new member();
    }

    public function loginCheck(){
        return $this->result::getLogin();
    }

}

?>