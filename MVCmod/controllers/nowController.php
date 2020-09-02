<?php

require_once './models/nowModel.php';

class cashCatch{
    public $result;

    public function __construct(){
        $this->result = new cash();
    }
}

?>