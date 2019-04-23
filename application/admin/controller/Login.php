<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/21 0021
 * Time: 21:57
 */

namespace app\admin\controller;

use app\common\lib\IAuth;

class Login extends Base
{
    public function index()
    {
        return $this->fetch();
    }

    public function check()
    {
        if(request()->isPost()){
            $data = input('post.');
            if(!captcha_check($data['code'])){
                $this->error('验证码不正确');
            }

            try {
                //获取数据
                $user = model('AdminUser')->get(['username' => $data['username']]);
            } catch (\Exception $e) {
                $this->error($e->getMessage());
            }
            //验证用户
            if(!$user || $user['status'] != config('code.status_normal')){
                $this->error('该用户不存在');
            }

            //验证密码
            if(IAuth::setPassword($data['password']) != $user['password']){
                $this->error('密码不正确');
            }
            //更新数据库
            $udata = [
                'last_login_time' => time(),
                'last_login_ip' => request()->ip()
            ];

            try{
                model('AdminUser')->save($udata, ['id' => $user['id']]);
            } catch (\Exception $e){
                $this->error($e->getMessage());
            }
            //写入session
            session(config('admin.admin_session'),$user, config('admin.session_user_scope'));
            $this->success('登录成功', 'index/index');

        } else {
            $this->error('请求方法不合法');
        }

    }
}