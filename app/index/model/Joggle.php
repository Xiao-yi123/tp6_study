<?php


namespace app\index\model;

use think\Model;
use think\model\concern\SoftDelete;

class Joggle extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $createTime = 'create_time';
    protected $readonly = ['id','create_time'];
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
//    public function getStatusAttr($value){
//        $status = [0=>'展示',1=>'不展示',2=>'开发中',3=>'关闭'];
//        return $status[$value];
//    }

//    定义查询范围 状态为0 展示
    public function scopeStatus($query)
    {
        $query->where('status', 0)->select();

    }

//    禁用方法
    public function Fstop($id,$status){
        $value =  $this->where('id',$id)->find();
        $value->status = $status;
        $value->save();
    }

//    删除方法
    public function Fdel($id){
        $value =  $this->where('id',$id)->find();
        $value->delete();
    }
//    新增方法
    public function Fadd($data){
        $this->save($data);
    }
//    编辑方法
    public function Fedit($id,$data){
        $value = $this->where('id',$id)->find();
        $value->save($data);
    }
    //    分页函数
    public function Fpage($limit,$page){
        $joggle =  $this->limit($limit)->page($page)->select();
        foreach ($joggle as $jo){
            $jo->classify;
        }
        return $joggle;
    }

//    public function FGetAllData(){
//        $joggle = $this->
//    }
}

