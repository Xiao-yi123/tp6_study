<?php


namespace app\index\model;


use think\Model;
use think\model\concern\SoftDelete;

class Classify  extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $createTime = 'create_date';
    protected $updateTime = 'update_time';


//    跟joggle表一对多关联
    public function joggle()
    {
        return $this->hasMany(Joggle::class);
    }
//    定义查询范围 状态为1 展示
    public function scopeStatus($query){
        $query->where('status', 1)->select();
    }
}