<?php
/**
 * Created by PhpStorm.
 * User: 27057
 * Date: 2017/11/5
 * Time: 15:32
 */

namespace app\common\lib;
use app\common\lib\Aes;
/**
 * Class IAuth
 * common文件夹下主要是用来存放一些公共的方法，这边的IAuth是用来进行md5的加密和加盐
 */
class IAuth{
    public  static  function setPassword($data){
        return md5($data.config('app.password_pre_halt'));
    }

    /**
     *
     * @param array $data
     * @return string
     */
    public static function setSign($data=[]){
        ksort($data);
        //拼接字符串数据
        $string=http_build_query($data);
        $string=(new Aes())->encrypt($string);
        return $string;
    }

    public static function checkSignPass($data){
        $str=(new Aes())->decrypt($data['sign']);
        if(empty($str)){
            return false;
        }
        parse_str($str,$arr);
        if(!is_array($arr)||empty($arr['did'])||$arr['did']!=$data['did']){
            return false;
        }
       return true;
    }
}