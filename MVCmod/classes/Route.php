<?php

class Route{

    // static : 全域居可直接呼叫, 不用先宣告一個新的class
    public static $validRoutes = array();
    public static function set ($route, $function){

        // 呼叫自己這個class中的參數$validRoutes
        self::$validRoutes[] = $route;

        // print_r(self::$validRoutes);

        // __invoke() : 當物件被當作函式呼叫時
        // 在Routes裡, 函式內容是: echo ""; 所以在這裡會一樣執行: echo "";
        // $function -> __invoke();

        // 若url有符合Routes中指定的, 則執行
        if($_GET["url"] == $route){
            $function -> __invoke();
        }
    }
}

?>