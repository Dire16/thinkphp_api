<?php
/**
 * Created by PhpStorm.
 * User: 27057
 * Date: 2018/1/18
 * Time: 16:15
 */
namespace app\admin\controller;
use think\Controller;
use think\Model;

class Showdata extends Controller
{
    public function index()
    {
        $data=Model('Dht')->getLastTem();
        return $this->fetch('',[
            'tem'=>$data->tem,
            'hum'=>$data->hum,
            'time'=>$data->time
        ]);
    }
    public function showTem()
    {
        $res=Model('Dht')->showTem();
        echo  str_replace('"', '', json_encode($res));
    }
    public function showHum(){
        $res=Model('Dht')->showHum();
        echo  str_replace('"', '', json_encode($res));
    }
    public function test()
    {
        $res=Model('Dht')->getLastTem();

        return $res->id;
    }
}