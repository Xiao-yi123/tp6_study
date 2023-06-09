<?php

namespace app\common\controller;

use app\BaseController; //框架控制器基类
use app\index\model\User as AdminModel; //admin模型
use think\facade\Session;

/**
 * admin应用控制器基类
 */
class AdminBase extends BaseController
{
    public function initialize()
    {
    }

    /**
     * 判断账号密码
     * @param array $data
     * @return AdminModel|array|false|mixed|\think\Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    protected function doLogin(array $data)
    {

        $userinfo = AdminModel::where("username", $data["user"])->find();
        //如果账号不存在
        if (!$userinfo){
            return false;
        }
        //如果密码不正确
        if($userinfo["password"] != sha1($userinfo["salt"] . $data["password"])){
            return false;
        }
        //设置Session
        Session::set("Admin_Login", sha1($userinfo));
        Session::set("uid", $userinfo["id"]);
        return $userinfo;
    }
    /**
     * 退出登录
     */
    protected function doLogout()
    {
        Session::delete("Admin_Login");
        Session::delete("uid",);
        return true;
    }
    /**
     * 根据id获取用户信息
     * @param $uid
     * @return AdminModel|array|mixed|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    protected function getUserInfo($uid)
    {
        return AdminModel::where("id", $uid)->find();
    }
    /**
     * 随机生成密码盐
     * @param $uid
     * @return string|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    protected function get_salt($uid)
    {
        $salt = base64_encode(openssl_random_pseudo_bytes(16));
        return $salt;
    }
}