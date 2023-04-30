<?php


namespace app\index\model;


use think\Model;
use think\model\concern\SoftDelete;

class User  extends Model
{
    use SoftDelete;
    // 定义时间戳字段名
    protected $createTime = 'create_date';
    protected $updateTime = 'login_date';
    protected $deleteTime = 'delete_time';

    //设置只读字段
    protected $readonly = ['id','username','salt'];
//    定义查询范围 状态为1 表示用户状态正常
    public function scopeUserStatus($query){
        $query->where('user_status', 1);
    }

    //    获取器--获取status中文
    public function getAuthAttr($value,$data){
        $status = [1=>'管理员',2=>'普通用户',3=>"会员"];
        return $status[$value];
    }

//    分页函数
    public function Fpage($limit,$page,$where=[]){
        $user =  $this->where($where)->limit($limit)->page($page)->select();

        return $user;
    }
    //    禁用方法
    public function Fstop($id,$status){
        $value =  $this->where('id',$id)->find();
        $value->user_status = $status;
        $value->save();
    }
    //    删除方法
    public function Fdel($id){
        $value =  $this->where('id',$id)->find();
        $value->delete();
    }
//    编辑方法
    public function Fedit($id,$data){
        $value = $this->where('id',$id)->find();
        $value->save($data);
    }
    //    添加方法
    public function Fadd($data){
        $this->save($data);
    }

}