<?php
use think\facade\Route;

Route::group('ATL', function () {
    Route::rule('/', 'ArticleTypeList/index');
    Route::rule('/table_data','ArticleTypeList/table_data');
    Route::rule('/edit','ArticleTypeList/edit');
    Route::rule('/stop','ArticleTypeList/stop');
    Route::rule('/del','ArticleTypeList/del');
});