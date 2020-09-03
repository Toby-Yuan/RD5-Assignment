<?php

require_once './models/balanceModel.php';

class detail {
    public $result;

    public function __construct(){
        $this->result = new getCash();
    }

    public function detail(){
        $money = $this->result->memberMoney();

        foreach($this->result->getDetail() as $key => $value){
            $nowtime = $value[0];

            if($value[1] == 'Y'){
                $deposit = $value[2];
                $withdrawal = 0;
            }else{
                $deposit = 0;
                $withdrawal = $value[2];
            }

            if($value[3] == 0){
                $transfer = "";
            }else{
                $transfer = "匯款";
            }

            $list = <<<showlist
            <tr></tr>
                <td>$nowtime</td>
                <td>$deposit</td>
                <td>$withdrawal</td>
                <td>$money</td>
                <td>$transfer</td>
            <tr></tr>
            showlist;
            echo $list;

            if($value[1] == 'Y'){
                $money = $money - $value[2];
            }else{
                $money = $money + $value[2];
            }
        };
    }
}

?>