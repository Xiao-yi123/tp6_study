<?php


namespace app\index\controller;

use app\common\controller\IndexBase;
use app\index\model\Comments;
use app\index\model\Joggle;
use app\Request;
use app\validate\FromInfo;
use think\exception\ValidateException;

//接口项目
class JoggleSites extends IndexBase
{
//   接口主页
    public function index(Request $request){
        $joggle_id = $request->param("joggle_id");
        if($request->isGet()){
            $relevant_nav_data = $this->get_relevant_nav($joggle_id);
            $Joggle =   Joggle::scope("status")
                ->where([
                "id"   => $joggle_id
            ])->find();
            $result = [
                "Joggle"  =>  $Joggle,
                "relevant_nav_data"    =>  $relevant_nav_data
            ];
            return $this->fetch("",$result);
        }
    }




}