<?php

namespace app\admin\controller;

use app\admin\middleware\Check;
use app\common\controller\AdminBase;
use app\index\model\Classify;
use app\Request;

//    文章类型列表
class ArticleTypeList  extends  AdminBase
{

    protected $middleware = [
        Check::class => [], //控制器中间件定义
    ];

    public function index(){
        $request = [
            "article_types"    =>  Classify::select()
        ];
        return $this->fetch('',$request);
    }

    public function table_data(){
        $Muser = Classify::select();
        $reqult = [
            'code'  =>  0,
            'msg'   =>  '成功',
            'count' =>  $Muser->count(),
            'data'  =>  $Muser
        ];

        return json($reqult);
    }
    public function edit(Request $request){
        if($request->isPost()){
            $data = $request->param();
            $Class = Classify::where("id",$data['id'])->find();
            if($data['value'] == $Class[$data['field']]){
                return json([
                    'code'  =>  201,
                    'msg'   =>  "数据没有修改"
                ]);
            }
            $Class[$data['field']] = $data['value'];
            $Class->save();
            return json([
                'code'  =>  200,
                'msg'   =>  "修改成功"
            ]);
        }

        if($request->isGet()){
            $class_id = $request->param('class_id');
            $reqult = [];
            $reqult['class_id'] =   $class_id;
//            添加分类
            if($class_id == 0){
                $reqult["type"] = Classify::scope('status')->where("rank",1)->select();

            }else{
                $reqult["con"] = Classify::scope('status')->where("id",$class_id)->find();
                $reqult['type'] =   Classify::scope('status')->where("rank",1)->select();
            }
            return $this->fetch('',$reqult);
        }elseif ($request->isPost()){
            $data = $request->post();
            $class_id = $request->post("class_id");
            if($class_id == 0){
                Classify::create([
                    'class_name'  =>  $data['name'],
                    'link' =>  $data['info']
                ]);
            }else{
                Classify::where("id",$data['class_id'])->save([
                    "class_name"    =>  $data['name'],
                    "link"          =>  $data['info'],
                    'rank'          =>  2,
                    'one_rank_id'   =>  $data['cid'],
                    'update_time'   =>  time()
                ]);
            }

            return json([
                'status'=>200,
                'msg'   =>"成功"
                ]);
        }

    }

    public function stop(Request $request){

        if($request->isPost()){
            $data = $request->post();
            $Class = Classify::where("id",$data['id'])->find();
            $Class->status = $data['status'];
            $Class->save();
            return json([
                'code'    =>  200,
                'msg'       =>  '成功'
            ]);
        }
        return $this->fetch('');
    }

    public function del(Request $request){
        if($request->isPost()){
            $id = $request->post('id');
            Classify::where("id",$id,)->find()->delete();
            return json([
                'status'=>200,
                'msg'   =>$id
            ]);
        }
    }
}