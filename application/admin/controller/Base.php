<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/21 0021
 * Time: 19:32
 */

namespace app\admin\controller;


use think\Controller;


class Base extends Controller
{
    public function __construct()
    {
        header("Cache-control: private");
        parent::__construct();
    }

    /**
     * 初始化方法
     */
    public function initialize()
    {
        // 判断用户是否登录
        $isLogin = $this->isLogin();
        if(! $isLogin){
            // return $this->redirect('login/index');
            // 此处防止退出登录时, 页码循环嵌套
            $url = url('login/index');
            echo "<script>top.location.href='$url'</script>";
        }
    }

    /**
     * 判断用户是否登录
     * @return bool
     */
    public function isLogin()
    {
        // 获取session
        $user = session(config('admin.admin_session'), '', config('admin.session_user_scope'));

        if($user && $user->id){
            return true;
        }
        return false;
    }
}