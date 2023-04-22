<?php

namespace app\admin\controller;

use app\admin\middleware\Check;
use app\common\controller\AdminBase;
use app\index\model\Classify;
use app\index\model\Joggle;
use app\Request;

//文章列表
class ArticleList   extends  AdminBase
{
    protected $middleware = [
        Check::class => [], //控制器中间件定义
    ];

    public function index(Request $request){
        if($request->isGet()){
            $reqult = [];

            foreach (Joggle::select() as $jo){
                $jo->class_name = $jo->classify->class_name;
                $reqult['joggles_data'][] = $jo;
            }
//            return json();
            return $this->fetch('',$reqult);
        }


    }

    public function table_data(){
        $joggle = Joggle::select();
        $reqult = [
            'code'  =>  0,
            'msg'   =>  '成功',
            'count' =>  $joggle->count()
        ];

        foreach ($joggle as $jo){
            $jo->class_name = $jo->classify->class_name;
            $reqult['data'][] = $jo;
        }
        return json($reqult);
    }
}