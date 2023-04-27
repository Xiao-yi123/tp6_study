<?php
use think\facade\Route;

Route::group('AL', function () {
    Route::rule('/', 'ArticleList/index');
    Route::rule('/table_data/:page/:limit','ArticleList/table_data');
})->ext('html');