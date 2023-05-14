<?php
namespace app\index\controller;

use app\common\controller\IndexBase;
use app\index\model\Classify;
use app\index\model\Joggle;
use app\Request;
use think\facade\Db;

class Index extends IndexBase
{
    public function index(Request $request)
    {

        $Classify = Classify::scope("status")->where([
            "rank"      => null,
        ])->select();

        $result = [
            "WebConfig" => $request->WebConfig,
            "Classify"  =>  $Classify
        ];

        return $this->fetch("",$result);
    }

    public function class_page(Request $request){

        if($request->isGet()){
            if($this->if_iframe()){
                return redirect("/");
            }

            $v = $request->get("v");
            $joggle = Joggle::scope("status")->where("classify_id",$v)->select();
            $name = Classify::scope("status")->where("id", $v)->find()->name;
            $tow_nav_data = Classify::scope("status")->where("rank",$v)->select();

            $result = [
                "WebConfig" => $request->WebConfig,
                "Joggle"    =>  $joggle,
                "name"      =>  $name,
                "tow_nav_data"  => $tow_nav_data
            ];
            return $this->fetch("",$result);
        }

    }

    public function captcha($id = '')
    {
        return captcha($id);
    }
}
