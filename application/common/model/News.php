<?php
/**
 * Created by PhpStorm.
 * User: 27057
 * Date: 2017/11/5
 * Time: 11:07
 */
namespace app\common\model;
use think\Model;
use app\common\model\Base;

/**
 * Class AdminUser
 * @package app\common\model
 * mvc的m层初始化要use think\Model 并继承model
 */
class News extends Base {
    /**
     * 后台自动化分页
     * @param array $data
     */
    public function getNews($data=[]){
        $data['status']=[
            'neq',config('code.status_delete')
        ];
        $order=['id'=>'desc'];
        $result=$this->where($data)
            ->order($order)
            ->paginate();
        return $result;
    }
    public function getNewsBtCondition($condition=[],$from=0,$size=4){
        $condition['status']=[
            'neq',config('code.status_delete')
        ];
        $order=['id'=>'desc'];

        //limit a,b
        $result=$this->where($condition)
            ->limit($from,$size)
            ->order($order)
            ->select();
        return $result;
    }
    public function getNewsCountByCondition($condition=[]){
        $condition['status']=[
            'neq',config('code.status_delete')
        ];
        return $this->where($condition)
            ->count();
    }
    public function getNewsByID($id=1)
    {
        $result=$this->where('id',$id)
            ->find();
        return $result;
    }
    public function setNewsByID($id,$data){
        $result=$this->where('id', $id)
            ->update($data);
        return $result;
    }
}