<?php

namespace app\admin\controller;

use app\common\controller\AdminBase;
use app\index\model\User;
use app\Request;

class MemberList extends AdminBase
{
    public function index(Request $request){


        return $this->fetch();
    }
    public function table_data(Request $request){
        $Muser = User::select();
        $reqult = [
            'code'  =>  0,
            'msg'   =>  '成功',
            'count' =>  $Muser->count(),
            'data'  =>  $Muser
        ];


        return json($reqult);
    }
    public function del(Request $request){
        if($request -> isPost()){
            $data  = $request->param();
            $user = User::where("id",$data['id'])->find();
            $user->user_status = $data['status'];
            $user->save();
            return json(
                [
                    'code'  =>  200,
                    'msg'   =>  "成功"
                ]
            );
        }
    }
    public function edit(Request $request){
        if($request->isPost()){
            $data = $request->param();

            $Duser = User::where("id",$data['id'])->find();
            if($data['value'] == $Duser[$data['field']]){
                return json([
                    'code'  =>  201,
                    'msg'   =>  "数据没有修改"
                ]);
            }
            $Duser[$data['field']] = $data['value'];
            $Duser->save();
            return json([
                'code'  =>  200,
                'msg'   =>  "修改成功"
            ]);
        }
    }
}