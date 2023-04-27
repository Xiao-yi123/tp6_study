<?php
use think\facade\Route;

Route::group('ML', function () {
    Route::rule('/', 'MemberList/index');
    Route::rule('/table_data', 'MemberList/table_data');
    Route::rule('/edit', 'MemberList/edit');
    Route::rule('/del', 'MemberList/del');
});