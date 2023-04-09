<?php
declare (strict_types = 1);

namespace app\validate;

use think\Validate;

class FromInfo extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'author'    =>  "require|max:15",
        "url"       =>  "require|url",
        'comment'   =>  "require|max:200|min:15",
        "email"     =>  "require|email",
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [
        'author.require|url.require|email.require|comment.require'      => '请检查表单是否填写完整!',
        'author.max'       => '您的昵称过长',
        'comment.max'       => '您的评论过长',
        'comment.min'       => '您的评论过短，再多写点评论吧',
    ];
}
