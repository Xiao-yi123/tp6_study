<?php

namespace app\index\model;

use think\Model;

class Comments extends Model
{
    protected $createTime = 'create_date';

    // 根据文章id查询所有的评论数据
    public function getAllByArticle($joggle_id)
    {
        return $this->where('joggle_id', $joggle_id)
            ->order('comments_date', 'desc');
    }

    // 根据文章id查询所有的1级评论数据
    public function getFirstLevelByArticle($joggle_id)
    {
        return $this->where([
            'joggle_id'=> $joggle_id,
            'reply_type'=> 1
        ])  ->order('comments_date', 'desc')
            ->select()
            ->toArray();
    }

    // 根据1级评论id查询对应的所有的2级评论数据
    public function getSecondLevelByFirstLevel($first_level_id)
    {
        return $this->where([
            'reply_id'=>$first_level_id,
            'reply_type'=> 2
        ])  ->order('comments_date', 'desc')
            ->select()
            ->toArray();
    }


}