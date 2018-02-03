<?php
namespace app\admin\controller;
use think\Controller;
use app\common\lib\IAuth;
class Login extends Base
{
    public function _initialize()
    {}
    public function index()
    {
        $isLogin=$this->isLogin();
        if($isLogin){
           return $this->redirect('index/index');
        }else {
            return $this->fetch();
        }
    }


    public function check()
    {
        if (request()->isPost()) {
            $data = input('post.');
//            if (!captcha_check($data['code'])) {
//                $this->error('验证码不正确');
//            }
            $validate=validate('AdminUser');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            try {
                $ret = model('AdminUser')->get(['username' => $data['username']]);
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }
                if (!$ret || $ret->status != config('code.status_normal')) {
                    $this->error('该用户不存在');
                }
                if (IAuth::setPassword($data['password']) != $ret->password) {
                    $this->error('密码不正确');
                }
                //halt($ret);
                $updata = [
                    'last_login_time' => time(),
                    'last_login_ip' => request()->ip(),
                ];
            try {
                model('AdminUser')->save($updata, ['id' => $ret->id]);
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }
            session(config('admin.session_user'),$ret,config('admin.session_user_scope'));
            $this->success('登录成功','index/index');

        }else{
            $this->error('请求不合法');
        }
    }

    /**
     * @return int
     * 这个模块还有什么东西没有实现
     */
    public function welcome(){
        return 1;
    }
    public function logout(){
        session(null,config('admin.session_user_scope'));
        $this->redirect('login/index');
    }

}
