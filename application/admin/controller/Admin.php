<?php
namespace app\admin\controller;
use app\common\validate\AdminUser;
use think\Controller;
use think\Validate;

class Admin extends Controller
{

    public function add(){
        //判断是否是post提交

        if(request()->isPost())
        {
            //dump(input('post.'));
            $data=input('post.');
            //validate
            $validate=validate('AdminUser');
            if(!$validate->check($data)){
                $this->error($validate->getError());
            }
            $data['password']=md5($data['password'].'_#sing_ty');

            $data['status']=1;
            $data['last_login_ip']=getenv('REMOTE_ADDR');

            try{
                $id=model('AdminUser')->add($data);
            }catch (\Exception $e){
                $this->error($e->getMessage());
            }
            if($id){
                $this->success('id='.$id.'的用户新增成功');
            }else{
                $this->error('error');
            }

        } else {
            return $this->fetch();
        }

    }

}
