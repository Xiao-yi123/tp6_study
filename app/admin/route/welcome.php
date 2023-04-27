<?php
use think\facade\Route;

Route::group('WEL', function () {
    Route::rule('/', 'Welcome/index');
})->ext('html');