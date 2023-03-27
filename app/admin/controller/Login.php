<?php

namespace app\admin\controller;

use app\common\controller\AdminBase; //后台控制器基类
use app\Request;
use app\admin\model\Admin as AdminModel; //admin模型
use think\facade\Session;
use think\captcha\facade\Captcha;


class Login extends AdminBase
{
    public function index(Request $request)
    {

        //如果Session存在
        if (Session::has("Admin_Login")){
            return redirect( DS . ADMIN_NAME);
        }
        //如果是POST请求
        if ($request->isPost()){

            //获取所有post参数
            $input = $request->post();

            //如果验证码错误
            if(!captcha_check($input["captcha"])){
                return $this->RestJson([
                    "code"  => 201,
                    "msg"   => "验证码错误!",
                    "data"  => null
                ]);
            };
            //调用判断账号密码的方法
            $res = $this->doLogin($input);

            //如果账号或密码错误
            if ($res === false){
                return $this->RestJson([
                    "code"  => 201,
                    "msg"   => "账号或密码错误!",
                    "data"  => null
                ]);
            }
            //账号密码正确
            $data = [
                "code"  => 200,
                "msg"   => "登录成功!",
                "data"  => null
            ];

            AdminModel::where("id",$res["id"])->update([
                "login_date"    => time(),
                "login_ip"      => $request->ip()
            ]);
            return $this->RestJson($data);
            //不是post请求就渲染视图
        }else{
            return $this->fetch();
        }
    }
    public function test(Request $request){
        // 获取当前域名
        echo 'domain: ' . $request->domain() . '<br/>';
        // 获取当前入口文件
        echo 'file: ' . $request->baseFile() . '<br/>';
        // 获取当前URL地址 不含域名
        echo 'url: ' . $request->url() . '<br/>';
        // 获取包含域名的完整URL地址
        echo 'url with domain: ' . $request->url(true) . '<br/>';
        // 获取当前URL地址 不含QUERY_STRING
        echo 'url without query: ' . $request->baseUrl() . '<br/>';
        // 获取URL访问的ROOT地址
        echo 'root:' . $request->root() . '<br/>';
        // 获取URL访问的ROOT地址
        echo 'root with domain: ' . $request->root(true) . '<br/>';
        // 获取URL地址中的PATH_INFO信息
        echo 'pathinfo: ' . $request->pathinfo() . '<br/>';
        // 获取URL地址中的后缀信息
        echo 'ext: ' . $request->ext() . '<br/>';

        // 获取完整URL地址 不带域名
//        当前访问域名或者IP
        echo 'host: ' .$request->host();
        dump($request);
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
        return ;
    }
    public function captcha($id = '')
    {

        return Captcha::create();
    }
}