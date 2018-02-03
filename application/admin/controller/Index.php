<?php
namespace app\admin\controller;

use think\Controller;

class Index extends Base
{
    public function index()
    {
        //halt(session('adminuser','','imooc_app_scope'));
        return $this->fetch();
    }
    //TODO

    /**
     * @return int
     * 这个模块还有什么东西没有实现
     */
    public function welcome(){
        return $this->fetch();
    }


}
