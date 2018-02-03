<?php
/**
 * Created by PhpStorm.
 * User: 27057
 * Date: 2017/12/9
 * Time: 20:49
 */
namespace app\common\lib\exception;
use think\Exception;

class ApiException extends Exception{
    public $message='';
    public $httpCode=500;
    public $code=0;
    /**
     * ApiException初始化方法
     * ApiException constructor.
     * @param string $message
     * @param int $httpCode
     * @param int $code
     */
    public function __construct($message='',$httpCode=0,$code=0)
    {
        $this->httpCode=$httpCode;
        $this->message=$message;
        $this->code=$code;

    }
}