<?php

namespace app\admin\controller;

use app\admin\middleware\Check;
use app\admin\model\Version;
use app\common\controller\AdminBase;
use app\Request;

class SysVersion extends AdminBase
{
    protected $middleware = [
        Check::class => [], //控制器中间件定义
    ];

    public function index(Request $request){
        $result = [];
        if($request->isGet()){
            $ver_data = Version::order("created_time",'desc')->select();
            $result['ver_data'] =   $ver_data;

        }

        return $this->fetch('',$result);
    }

    public function edit(Request $request){
        if($request->isGet()){
            $ver_id = $request->param('ver_id');
            $reqult = [];
            $reqult["con"] = Version::scope('status')->where("id",$ver_id)->find();
            return $this->fetch('',$reqult);
        }elseif ($request->isPost()){
            $data = $request->post();
            $ver_value = Version::where([
                'version'   =>  $data['version']
            ])->find();

            if(($data['id'] == 0) && $ver_value){
                return json([
                    'status'=>201,
                    'msg'   =>"版本已存在",
                ]);
            }

            if($ver_value){
                $ver_value->version = $data['version'];
                $ver_value->description = $data['desc'];
                $ver_value->save();
            }else{
                Version::create([
                    'version'   =>  $data['version'],
                    'description'   =>  $data['desc']
                ]);
            }

            return json([
                'status'=>200,
                'msg'   =>"成功"
            ]);
        }

    }

    public function del(Request $request){
        if($request->isPost()){
            $id = $request->param('id');
            Version::where("id",$id)->find()->delete();
            return json([
                'status'=>200,
                'msg'   =>$id
            ]);
        }
    }
}