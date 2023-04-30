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
    protected $readonly = ['id','create_time'];


//    跟joggle表一对多关联
    public function joggle()
    {
        return $this->hasMany(Joggle::class);
    }
//    定义查询范围 状态为1 展示
    public function scopeStatus($query){
        $query->where('status', 1)->select();
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
        $Classify =  $this->limit($limit)->page($page)->select();

        return $Classify;
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
//    返回二级类
    public function FGetOnwRand($id){
        return $this->where('rank' ,  $id)->select();
    }
}