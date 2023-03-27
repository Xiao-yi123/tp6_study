<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2019 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
namespace think;

require __DIR__ . '/../vendor/autoload.php';


//定义分隔符
define('DS', DIRECTORY_SEPARATOR);

//当前文件名
define('ADMIN_NAME', basename(__FILE__)."/index");

// 执行HTTP应用并响应
$app = new App();
$http = $app->http;


//指定执行admin应用
$response = $http->name("admin")->run();

$response->send();

$http->end($response);
