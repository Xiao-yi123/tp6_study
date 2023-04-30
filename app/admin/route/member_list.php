<?php
use think\facade\Route;

Route::group('ML', function () {
    Route::rule('/', 'MemberList/index');
    Route::rule('/table_data', 'MemberList/table_data');
    Route::rule('/add_edit', 'MemberList/add_edit');
    Route::rule('/stop', 'MemberList/stop');
    Route::rule('/del', 'MemberList/del');
    Route::rule('/del_sel', 'MemberList/del_sel');
});