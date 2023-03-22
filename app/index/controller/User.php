<?php

namespace app\index\controller;

use app\common\controller\IndexBase;

class User extends IndexBase
{
    //前台用户中心视图
    public function index()
    {
        return $this->fetch();
    }
}