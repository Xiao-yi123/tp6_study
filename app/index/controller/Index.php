<?php
namespace app\index\controller;

use app\common\controller\IndexBase;
use app\index\model\Classify;
use app\index\model\Joggle;
use app\Request;

class Index extends IndexBase
{

    public function index(Request $request)
    {

        $result = [
            "WebConfig" => $request->WebConfig,
            "Classify"  =>  Classify::where("status",1)->select()
        ];

        return $this->fetch("",$result);
        //return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V' . \think\facade\App::version() . '<br/><span style="font-size:30px;">16载初心不改 - 你值得信赖的PHP框架</span></p><span style="font-size:25px;">[ V6.0 版本由 <a href="https://www.yisu.com/" target="yisu">亿速云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="ee9b1aa918103c4fc"></think>';
    }

//    分类页面
    public function class_page(Request $request){

        if($request->isGet()){
            $v = $request->get("v");
            $result = [
                "WebConfig" => $request->WebConfig,
//                "Joggle"    =>  Joggle::where("status",0)->select()
                "Joggle"    =>  Joggle::where([
                    "status" => 0,
                    "classify_id"   =>  $v
                ])->select()
            ];

            return $this->fetch("",$result);
        }

    }

    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name;
    }
    public function home(Request $request){

        return $this->fetch();
    }

    public function captcha($id = '')
    {
//        phpinfo();

        return captcha($id);
    }
}
