<?php


use think\facade\Route;

Route::group('AdminL',function(){
   Route::rule('/','AdminList/index');
    Route::rule('/table_data', 'AdminList/table_data');
    Route::rule('/add_edit', 'AdminList/add_edit');
    Route::rule('/stop', 'AdminList/stop');
    Route::rule('/del', 'AdminList/del');
    Route::rule('/del_sel', 'AdminList/del_sel');
});