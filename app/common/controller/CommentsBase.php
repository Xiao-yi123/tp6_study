<?php


namespace app\common\controller;

use app\BaseController;

class CommentsBase extends BaseController
{
    protected $comments = [];
    protected $reqult = [];
    public function if_iframe(){
        if ($this->request->header('X-Requested-With') !== 'XMLHttpRequest' && strpos($this->request->header('Referer'), '127.0.0.1') === false) {
            return true;
        } else {
            // The request is not coming from an iframe
            return false;
        }
    }
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
        return $this->three_comments($this->comments,$this->reqult);
    }
    public function display_comments($comments, $parent_id = 0, $level = 0) {

        $this->comments = $comments;
        foreach ($this->comments as $key=>$value){
            if($value['reply_type'] == 1){
                $this->reqult[] = $value;
                unset($this->comments[$key]);
            }

        }
        foreach ($this->reqult as $key=>$value){
            foreach ($this->comments as $key1=>$value1){

                if($value['id'] == $value1['reply_id']){
                    $this->reqult[$key]['two'][] = $value1;
                    unset($this->comments[$key1]);
                }
            }
        }

        $this->three_comments($this->comments,$this->reqult);
        return $this->reqult;
    }

}