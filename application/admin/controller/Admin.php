<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/21 0021
 * Time: 18:34
 */

namespace app\admin\controller;


class Admin extends Base
{
    public function add()
    {
        if(request()->isPost()){
            $data = input('post.');
            // halt($data);
            $validate = validate('AdminUser');
            if( ! $validate->check($data)){
                $this->error($validate->getError());
            }

            if($data['password'] != $data['repasswd']){
                $this->error('确认密码不一致');
            }
            $data['password'] = md5($data['password']);
            $data['status'] = 1;

            try{
                $id = model('AdminUser')->add($data);
            }catch (\exception $e){
                $this->error($e->getMessage());
            }

            if($id){
                $this->success('id='.$id.'的用户新增成功');
            } else {
                $this->error('error');
            }
        } else {
            return $this->fetch();
        }

    }
}