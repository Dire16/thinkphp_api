<?php
/**
 * Created by PhpStorm.
 * User: 27057
 * Date: 2018/1/18
 * Time: 15:05
 */
namespace app\api\controller;
use think\Controller;
class Test extends Controller
{
    public function read(){
        $data=input('get.');
        try{
            $id=model('Dht')->add($data);
        }catch (\Exception $e){
            $this->error($e->getMessage());
        }
        if($id){
            return $id;
        }else{
           return "新增失败";
        }
    }

}