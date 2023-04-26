<?php


namespace app\index\model;


use think\Model;

class User  extends Model
{
    // 定义时间戳字段名
    protected $createTime = 'create_date';
    protected $updateTime = 'login_date';
    //设置只读字段
    protected $readonly = ['username','salt'];
//    定义查询范围 状态为1 表示用户状态正常
    public function scopeUserStatus($query){
        $query->where('user_status', 1);
    }

    //    获取器--获取status中文
    public function getAuthAttr($value){
        $status = [1=>'管理员',2=>'普通用户'];
        return $status[$value];
    }
}