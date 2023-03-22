<?php
namespace app\index\controller;

use app\common\controller\IndexBase;
use think\facade\View;

class Index extends IndexBase
{
    //前台首页显示
    public function index()
    {

        return $this->fetch();
    }

    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name;
    }
}
