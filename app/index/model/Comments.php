<?php

namespace app\index\model;

use think\Model;

class Comments extends Model
{
    public function scopeStatus($query)
    {
        $query->where('status', 0)->select();

    }
}