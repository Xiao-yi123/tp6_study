<?php


namespace app\common\controller;

use app\BaseController;

class CommentsBase extends BaseController
{
    /**
     * 评论相关的所有数据
     * @var array
     */
    protected $comments = [];
    /**
     * 返回的结果
     * @var array
     */
    protected $reqult = [];

    /**
     * 判断是否是iframe标签请求来的
     * @return bool
     */
    public function if_iframe(){
        if ($this->request->header('X-Requested-With') !== 'XMLHttpRequest' && strpos($this->request->header('Referer'), '127.0.0.1') === false) {
            return true;
        } else {
            // The request is not coming from an iframe
            return false;
        }
    }

    /**
     *  获得3级评论，并从评论数据中删除查到的评论
     * @return void
     */
    public function three_comments(){
        if(!$this->comments){
            return;
        }
        foreach ($this->comments as $key=>$value){
            foreach ($this->reqult as $key1=>$value1){
                if(isset($value1['two']))
                    foreach ($value1['two'] as $key2=>$value2){
                        if($value['reply_id'] == $value2['id']){
                            array_splice($this->reqult[$key1]['two'],$key2+1,0,array($value));
                            unset($this->comments[$key]);
                        }
                    }
            }

        }
        return $this->three_comments();
    }

    /**
     * 显示所有评论内容
     * @param $comments 评论相关所有数据
     * @return array|mixed
     */
    public function display_comments($comments) {
        $this->comments = $comments;
//        获得1级评论，并从评论数据中删除查到的评论
        foreach ($this->comments as $key=>$value){
            if($value['reply_type'] == 1){
                $this->reqult[] = $value;
                unset($this->comments[$key]);
            }

        }
//        获得2级评论，并从评论数据中删除查到的评论
        foreach ($this->reqult as $key=>$value){
            foreach ($this->comments as $key1=>$value1){

                if($value['id'] == $value1['reply_id']){
                    $this->reqult[$key]['two'][] = $value1;
                    unset($this->comments[$key1]);
                }
            }
        }
//        获得3级评论，并从评论数据中删除查到的评论
        $this->three_comments();
        return $this->reqult;
    }

}