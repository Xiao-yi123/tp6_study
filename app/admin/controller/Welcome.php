<?php
namespace app\admin\controller;

use app\admin\middleware\Check; //后台登录拦截中间件
use app\common\controller\AdminBase;
use app\Request;
use think\facade\Session;

//后台控制器基类

class Welcome extends AdminBase
{
//    protected $middleware = [
//        Check::class => [], //控制器中间件定义
//    ];
    public function index(Request $request)
    {
        $result = [
            "获取系统类型及版本号" => php_uname(),
            "只获取系统类型"  => php_uname('s'),
            "只获取系统版本号" =>php_uname('r'),
            "获取PHP运行方式" => php_sapi_name(),
            "获取前进程用户名" =>Get_Current_User(),
            "获取PHP版本" =>PHP_VERSION,
            "获取Zend版本"=>Zend_Version(),
            "获取PHP安装路径"=>DEFAULT_INCLUDE_PATH,
            "获取服务器IP"=>GetHostByName($_SERVER['SERVER_NAME']),
            "接受请求的服务器IP"=>GetHostByName($_SERVER['SERVER_NAME']),//(有时候获取不到，推荐用：$_SERVER['SERVER_ADDR']
//            "获取客户端IP"=>$_SERVER['SERVER_ADDR'],
            "获取服务器解译引擎"=>$_SERVER['SERVER_SOFTWARE'],
//            '获取服务器CPU数量'=>$_SERVER['PROCESSOR_IDENTIFIER'],
//            '获取服务器系统目录' =>$_SERVER['SystemRoot'],
            '获取服务器域名'=>$_SERVER['SERVER_NAME'],
//            '获取用户域名'=>$_SERVER['USERDOMAIN'],
            '获取服务器语言'=>$_SERVER['HTTP_ACCEPT_LANGUAGE'],
            '获取服务器Web端口'=>$_SERVER['SERVER_PORT']
        ];
        return json($result);
        return $this->fetch();
    }
}
