<?php


namespace app\index\controller;

use app\common\controller\IndexBase;
use app\index\model\Joggle;
use app\Request;

class JoggleSites extends IndexBase
{
    public function index(Request $request){
        $joggle_id = $request->param("joggle_id");
        if($request->isGet()){
            $result = [
                "WebConfig" => $request->WebConfig,
                "Joggle"  =>  Joggle::where([
                    "status" => 0,
                    "id"   => $joggle_id
                ])->find()
            ];
        }
        return $this->fetch("",$result);
    }

}