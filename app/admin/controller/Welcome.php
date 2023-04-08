<?php
namespace app\admin\controller;

use app\admin\middleware\Check; //后台登录拦截中间件
use app\common\controller\AdminBase;
use app\Request;
use think\facade\Session;

//后台控制器基类
class Welcome extends AdminBase
{
    protected $middleware = [
        Check::class => [], //控制器中间件定义
    ];
    public function index(Request $request)
    {
        $uid = Session::get('uid');
        $userinfo = $this->getUserInfo($uid);
        $result = [
            // 获取当前域名
            "domain"        =>  $request->domain(),
            // 获取系统类型及版本号
            'server_system' =>  php_uname(),
            // 获取当前进程用户名
            'course_user'   =>  Get_Current_User(),
            // 获取PHP版本
            'php_ver'       =>  PHP_VERSION,
            // 获取服务器IP
            'server_ip'     =>  GetHostByName($_SERVER['SERVER_NAME']),
            // 获取服务器域名
            'realm_name'    =>  $_SERVER['SERVER_NAME'],
            //  获取服务器Web端口
            'web_port'      =>  $_SERVER['SERVER_PORT'],
            // 获取服务器语言
            'server_lang'   =>  $_SERVER['HTTP_ACCEPT_LANGUAGE'],
            //  服务器器当时时间
            'server_time'   =>  date("Y-m-d h:i"),
            'Zend'          =>  Zend_Version(),
            //用户名
            'username'      =>  $userinfo['username']
        ];

        return $this->fetch('',$result);
    }
}
