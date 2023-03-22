<?php
namespace app\admin\controller;

use app\admin\middleware\Check; //后台登录拦截中间件
use app\common\controller\AdminBase;
use think\facade\Session;

//后台控制器基类

class Index extends AdminBase
{
    protected $middleware = [
        Check::class => [], //控制器中间件定义
    ];
    public function index()
    {
        $uid = Session::get('uid');
        $userinfo = $this->getUserInfo($uid);
        return "欢迎 {$userinfo['nickname']} !";
    }
}
