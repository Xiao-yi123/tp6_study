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

//    评论
    public function comment(Request $request){
        if($request->isGet()){
            if($this->if_iframe()){
                return redirect("/");
            }
//            获取评论列表

            Comments::scope("reply_type")->select();
            return $this->fetch("");
        }elseif ($request->isPost()){
//            {comment: 'fsa', url: 'fas', email: 'fasf', author: 'fsaf'}
            $data = $request->post();
            try {
                validate(FromInfo::class)->check([
                    'author'  => $data['author'],
                    'url' => $data['url'],
                    'email' => $data['email'],
                    'comment' => $data['comment'],
                ]);
            } catch (ValidateException $e) {
                // 验证失败 输出错误信息
                return json([
                    'status'    =>  210,
                    'msg'       =>  $e->getError()
                ]);
            }


        }
    }

    public function text(){
        $a =Joggle::where("status",0)->orderRaw("rand() , id DESC")->select();
        dump($a);
//        echo (random_int(0,2));
        dump($this->get_relevant_nav(3));
    }

}