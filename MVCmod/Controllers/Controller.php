<?php

class Controller extends Database{

    // 把符合所需url的頁面都顯示
    // public static function CreateView(){
    //     echo "View Create";
    // }

    // 針對不同的url有不同的效果
    public static function CreateView($viewName){
        require_once './views/' . $viewName . '.php';
        static::doSomething();
    }
}

?>