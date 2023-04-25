<?php

namespace app\admin\model;

use think\Model;
use think\model\concern\SoftDelete;

class Version extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $createTime = 'create_date';
}