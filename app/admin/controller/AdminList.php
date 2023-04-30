<?php

namespace app\admin\controller;

use app\common\controller\AdminBase;
use app\index\model\User;
use app\Request;

class AdminList extends AdminBase
{
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->UserModel = new User();
        $this->result = [];
        $this->result['url_con'] =  "AdminL";
    }
    public function index(Request $request){
        return $this->fetch('member_list/index',$this->result);
    }
    public function table_data(Request $request){
        if($request->isGet()){
            $limit = $request->get('limit');
            $page = $request->get('page');
            $where = [
                ["auth","=",1]
            ];
            $reqult = [
                'code'  =>  0,
                'msg'   =>  '成功',
                'count' =>  User::count(),
                'data'  =>  $this->UserModel->Fpage($limit,$page,$where)
            ];
            return json($reqult);
        }

    }
    public function del(Request $request){
        if($request -> isPost()){
            $id  = $request->param('id');
            $this->UserModel->Fdel($id);
            return json(
                [
                    'code'  =>  200,
                    'msg'   =>  "成功"
                ]
            );
        }
    }
    public function del_sel(Request $request){
        if($request->isPost()){
            $ids = $request->post('ids');

            User::destroy($ids);
            return json([
                'code'=>200,
                'msg'   =>"删除成功",
            ]);

        }
    }
    public function stop(Request $request){
        if($request -> isPost()){
            $data  = $request->param();

            $this->UserModel->Fstop($data['id'],$data['user_status']);
            return json(
                [
                    'code'  =>  200,
                    'msg'   =>  "成功"
                ]
            );
        }
    }
    public function add_edit(Request $request){
        if($request->isGet()){
            $id = $request->get('id');
            $this->result['data'] = User::where("id",$id)->find();
            return $this->fetch('member_list/add_edit',$this->result);
        }
        elseif ($request->isPost()){
            $data = $request->param();
            if($data['id']){
                $data['auth'] = 1;
                $this->UserModel->Fedit($data['id'],$data);
            }else{
                $this->UserModel_->Fadd($data);
            }


            return json([
                'code'  =>  200,
                'msg'   =>  "修改成功"
            ]);
        }
    }
}