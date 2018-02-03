<?php
namespace app\common\model;
use think\Model;
class Dht extends Model
{
    public function add($data){
        $this->save($data);
        return $this->id;
    }
    public function showDataBase(){
        $result=$this->select();
        return $result;
    }
    public function showTem(){
        $order=['id'=>'desc'];
        $result=$this->limit(0,10)
            ->order($order)
            ->column('tem');
        return $result;
    }
    public function showHum(){
        $order=['id'=>'desc'];
        $result=$this->limit(0,10)
            ->order($order)
            ->column('hum');
        return $result;
    }
    public function getLastTem(){
        $order=['id'=>'desc'];
        $result=$this->limit(0,1)
            ->order($order)
            ->find();
        return $result;
    }

}