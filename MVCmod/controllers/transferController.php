<?php

require_once './models/transferModel.php';

class tranGet {
    public $result;

    public function __construct(){
        $this->result = new transferM();
    }

    public function tranCheck(){
        if( $this->result->tranFun() == 1 ){
            return "餘額不足";
        }else if( $this->result->tranFun() == 2 ){
            return "無此用戶";
        }else if( $this->result->tranFun() == 3 ){
            return "請勿匯款給自己";
        }else{
            return "";
        }
    }
}

?>