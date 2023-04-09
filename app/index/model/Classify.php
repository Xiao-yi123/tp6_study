<?php


namespace app\index\model;


use think\Model;

class Classify  extends Model
{
//    跟joggle表一对多关联
    public function joggle()
    {
        return $this->hasMany(Joggle::class);
    }
}