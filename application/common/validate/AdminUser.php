<?php
namespace app\common\validate;

use think\Validate;

class AdminUser extends Validate
{
    //这是tp5的验证机制，具体可看文档的验证功能
    protected  $rule=[
        'username'=>'require|max:20',
        'password'=>'require|max:20',

    ];
}