<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::get('think', function () {
    return 'hello,ThinkPHP6!';
});

Route::get('hello/:name', 'index/hello');
//Route::get('captcha/[:config]','\\think\\captcha\\CaptchaController@index');
//详细页面路由
Route::rule('joggle_sites/:joggle_id','JoggleSites/index')
    ->pattern(['joggle_id' => '\d+']);
//评论路由
Route::rule('comment/:joggle_id','Comment/index');