<?php
namespace app\common\controller;

use app\BaseController;
use app\index\model\Joggle;

/**
 * index应用控制器基类
 */
class IndexBase extends BaseController
{
    //初始化
    public function initialize()
    {
    }

    //JoggleSites获取相关导航数据
    public function get_relevant_nav($joggle_id){
        $relevant = Joggle::where([
            "status"    =>  0,
            "classify_id"   =>  $joggle_id
        ])  ->limit(random_int(2,5))
            ->orderRaw("rand() , id DESC")
            ->select();
        $not_relevant = Joggle::where([
            "status"    =>  0,
        ]) ->limit(random_int(1,3))
            ->orderRaw("rand() , id DESC")
            ->select();
        $result = [
            'relevant'      =>  $relevant,
            "not_relevant"  =>  $not_relevant
        ];
        return $result;
    }
    public function if_iframe(){
        if ($this->request->header('X-Requested-With') !== 'XMLHttpRequest' && strpos($this->request->header('Referer'), '127.0.0.1') === false) {
            return true;
        } else {
            // The request is not coming from an iframe
            return false;
        }
    }

}
