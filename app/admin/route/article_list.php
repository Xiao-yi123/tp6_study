<?php
use think\facade\Route;

Route::group('AL', function () {
    Route::rule('/', 'ArticleList/index');
    Route::rule('/table_data','ArticleList/table_data');
    Route::rule('/del','ArticleList/del');
    Route::rule('/del_sel','ArticleList/del_sel');
    Route::rule('/stop','ArticleList/stop');
    Route::rule('/add_edit','ArticleList/add_edit');
    Route::rule('/two_select','ArticleList/two_select');
});