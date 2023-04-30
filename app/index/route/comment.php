<?php
use think\facade\Route;

Route::group('comment',function (){
//    评论路由
   Route::rule('/:joggle_id','Comment/index');
});