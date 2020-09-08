<?php

require_once './models/helloModel.php';

class controller {

    public $result;

    public function __construct(){
        $this->result = new member();
    }

    // 確認登入身份符合
    public function loginCheck(){
        return $this->result::getLogin();
    }

}

?>