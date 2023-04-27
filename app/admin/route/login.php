<?php
use think\facade\Route;

Route::group('Login',function (){
    Route::rule('/','Login/index');
});