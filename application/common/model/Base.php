<?php
/**
 * Created by PhpStorm.
 * User: 27057
 * Date: 2017/11/5
 * Time: 11:07
 */
namespace app\common\model;
use think\Model;

/**
 * Class AdminUser
 * @package app\common\model
 * mvc的m层初始化要use think\Model 并继承model
 */
class Base extends Model{
    //这个$autoWriteTimestamp如果为true，会自动的去数据表中的create_time与
    //update_time字段中插入当前的时间戳
    protected $autoWriteTimestamp=true;

    /**
     * @param $data
     * @return mixed
     * 所有新建的数据库操作之前都需要判断他是否是空数组，为空直接返回错误信息
     */
    public function add($data){

        if(!is_array($data)){
            exception('传递参数不合法');
        }
        //allowField这个方法使得我们不能插入不是数据表中的字段
        $this->allowField(true)->save($data);
       // $this->where('id','=',6)->update($data);

         return $this->id;
    }
}