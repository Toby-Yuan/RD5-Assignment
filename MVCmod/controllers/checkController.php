<?php

require_once './models/checkModel.php';

class checkC {
    public $result;

    public function __construct(){
        $this->result = new checkM();
    }

    public function member(){
        $member = $this->result->tranMember();
        return $member[0]['userName'];
    }
}

?>