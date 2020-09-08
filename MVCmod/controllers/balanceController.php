<?php

require_once './models/balanceModel.php';

class detail {
    public $result;

    public function __construct(){
        $this->result = new getCash();
    }

    // 顯示交易明細
    public function detail(){
        $money = $this->result->memberMoney();

        // 依照存款或提款顯示在不同欄位
        foreach($this->result->getDetail() as $key => $value){
            $nowtime = $value[0];

            if($value[1] == 'Y'){
                $deposit = $value[2];
                $withdrawal = 0;
            }else{
                $deposit = 0;
                $withdrawal = $value[2];
            }

            // 顯示此筆交易是否為匯款
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

            // 回推餘額
            if($value[1] == 'Y'){
                $money = $money - $value[2];
            }else{
                $money = $money + $value[2];
            }
        };
    }
}

?>