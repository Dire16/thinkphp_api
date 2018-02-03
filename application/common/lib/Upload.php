<?php
/**
 * Created by PhpStorm.
 * User: 27057
 * Date: 2017/12/1
 * Time: 19:03
 */
namespace app\common\lib;
//引入鉴权类
use Qiniu\Auth;
//引入上传类
use Qiniu\Storage\UploadManager;

/**
 * Class Upload
 * @package app\common\lib
 * 七牛图片基础类库
 */
class Upload{
    /**
     * 图片上传
     */
    public static function image(){

        if(empty($_FILES['file']['tmp_name'])){
            exception('您提交的图片数据不合法',404);
        }
        //要上传的文件的临时文件
        $file=$_FILES['file']['tmp_name'];
        $ext=explode('.',$_FILES['file']['name']);
        $ext=$ext[1];
        $config=config('qiniu');
        //构建一个鉴权对象
        $auth=new Auth($config['ak'],$config['sk']);
        //生成上传的token
        $token=$auth->uploadToken($config['bucket']);
        //上传到七牛保存的文件名
        $key=date('Y')."/".date('m')."/".substr(md5($file),0,5).date('YmdHis').rand(0,9999).'.'.$ext;
        //echo $key;
        //初始化UploadManager类
        $uploadMgr=new UploadManager();
        list($ret,$err)=$uploadMgr->putFile($token,$key,$file);

        if($err !==null){
            return null;
        }else{
            return $key;
        }


    }
}

