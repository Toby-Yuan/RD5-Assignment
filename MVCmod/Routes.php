<?php

Route::set('index.php', function(){
    Index::CreateView('Index');
});

// 呼叫class Route 的function set
Route::set('about-us', function(){
    // echo "about us";

    // 呼叫符合這個url的外觀
    // AboutUs::CreateView();

    // 傳入url來顯示不同效果
    AboutUs::CreateView('AboutUs');

    // 連接資料庫, 移至總控制器Controller.php處理
    // AboutUs::test();
});

Route::set('contact-us', function(){
    ContactUs::CreateView('ContactUs');
});

?>