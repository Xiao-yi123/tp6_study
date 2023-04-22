<?php

namespace app\index\controller;

use app\common\controller\CommentsBase;
use app\index\model\Comments;
use app\index\model\Joggle;
use app\Request;
use app\validate\FromInfo;
use think\exception\ValidateException;

class Comment extends CommentsBase
{
//    评论
    public function index(Request $request){
        if($request->isGet()){
            if($this->if_iframe()){
                return redirect("/");
            }
//            获取接口的id
            $Joggle_id = $request->param('joggle_id');

            $All = (new Comments())->getAllByArticle($Joggle_id);
            $AllComment = $this->display_comments($All);

            $request = [
                'AllComment'    =>  $AllComment
            ];
            return $this->fetch("",$request);
        }elseif ($request->isPost()){
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
//            接口数据
            $joggle = Joggle::scope("status")
                ->where([
                    "id"   => $data['joggle_id']
                ])->find();
            if($data['reply_type'] == 1){
                $reply_id = $joggle->id;
            }elseif ($data['reply_type']  == 2){
                $reply_id = $data['reply_id'];
            }else{
                return json([
                    'status'    =>  210,
                    'msg'       =>  "错误"
                ]);
            }
            $joggle->comments()->save([
                "content" => $data['comment'],
                "url"     =>  $data['url'],
                'email'    =>   $data['email'],
                'author'    =>  $data['author'],
                "reply_type"    =>  $data['reply_type'],
                'reply_id'  => $reply_id
            ]);
            return json([
                'status'    =>  200,
                'msg'       =>  '成功'
            ]);
        }
    }
}