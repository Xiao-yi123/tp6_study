<?php
use think\facade\Route;

Route::group('SVer', function () {
    Route::rule('/', 'SysVersion/index');
    Route::rule("/edit/:ver_id",'SysVersion/edit');
    Route::rule("/del",'SysVersion/del');
})->ext('html');