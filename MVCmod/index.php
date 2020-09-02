<?php

require_once("./Routes.php");

// 在載入時, 引入classes中所有的php
function __autoload($class_name){

    // 先呼叫Routes擷取url送到Route看有沒有符合我們要的, 有的話再引入Controllers中所有的controller
    if(file_exists('./classes/' . $class_name . '.php')){
        require_once './classes/' . $class_name . '.php';
    }else if(file_exists('./Controllers/' . $class_name . '.php')){
        require_once './Controllers/' . $class_name . '.php';
    }
}

?>