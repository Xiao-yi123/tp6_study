<?php


namespace app\index\model;


use think\Model;

class Joggle extends Model
{
    protected $createTime = 'create_time';
//    一对多关联评论
    public function comments()
    {
        return $this->hasMany(Comments::class,'joggle_id');
    }
//    定义关联模型Classify
    public function classify(){
        return $this->belongsTo(Classify::class);
    }
//    获取器--获取status中文
    public function getStatusAttr($value){
        $status = [0=>'展示',1=>'不展示',2=>'开发中',3=>'关闭'];
        return $status[$value];
    }

//    定义查询范围 状态为0 展示

    public function scopeStatus($query)
    {
        $query->where('status', 0)->select();

    }

}