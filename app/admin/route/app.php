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


Route::get('captcha/[:config]','\\think\\captcha\\CaptchaController@index');
Route::get('/','index/index');
//文章类型列表首页
//Route::rule('article_type_list/','ArticleTypeList/index');

//Route::resource('joggle_list', 'Joggle');

Route::rule('article_type_list/','ArticleTypeList/index');
Route::rule('article_type_list/edit/:class_id','ArticleTypeList/edit');
Route::rule('article_type_list/stop','ArticleTypeList/stop');
Route::rule('article_type_list/del','ArticleTypeList/del');

Route::rule('article_list/','ArticleList/index');
Route::rule('article_list/table_data/:page/:limit','ArticleList/table_data');

Route::rule("sys_version/",'SysVersion/index');
Route::rule("sys_version/edit/:ver_id",'SysVersion/edit');
Route::rule("sys_version/del",'SysVersion/del');
