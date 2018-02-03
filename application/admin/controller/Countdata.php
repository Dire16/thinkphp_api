<?php
namespace app\admin\controller;

use think\Controller;

class Countdata extends Base
{
    public function index()
    {
        return $this->fetch();
    }
}
