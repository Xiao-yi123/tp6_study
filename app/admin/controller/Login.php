<?php

namespace app\admin\controller;

use app\common\controller\AdminBase; //后台控制器基类
use app\Request;
use app\admin\model\Admin as AdminModel; //admin模型
use think\facade\Db;
use think\facade\Session;

class Login extends AdminBase
{
    public function captcha($id = '')
    {
        echo "dsa";
        return captcha($id);
    }
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
//            if(!captcha_check($input["captcha"])){
//                return $this->RestJson([
//                    "code"  => 201,
//                    "msg"   => "验证码错误!",
//                    "data"  => null
//                ]);
//            };
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

        $input = [
            "user" => "admin",
        ];

//        $userinfo = AdminModel::where("username", $input["user"])->find();

        $userinfo = Db::table('pay_admin')->where("username", $input["user"])->find();
        return json($userinfo);
    }
}