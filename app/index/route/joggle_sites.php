<?php
use think\facade\Route;

Route::group('JS',function (){
//    详细页面路由
    Route::rule("/:joggle_id","JoggleSites/index")
        ->pattern(['joggle_id' => '\d+']);
});