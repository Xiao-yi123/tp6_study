<?php


namespace app\index\model;


use think\Model;

class Joggle extends Model
{
//    获取器--获取status中文
    public function getStatusAttr($value){
        $status = [0=>'展示',1=>'不展示',2=>'开发中',3=>'关闭'];
        return $status[$value];
    }
}