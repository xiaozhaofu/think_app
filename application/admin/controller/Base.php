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
    /**
     * 定义model
     * @var string
     */
    public $model = '';

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


    /**
     * 删除逻辑
     * @param int $id
     */
    public function delete($id = 0)
    {
        if ( ! intval($id)) {
            return $this->result('', 0, 'ID 不合法');
        }
        // 如果继承Base的控制器, 定义了model, 则用$this->model的名称, 否则采用控制器的名称
        $model = $this->model?: request()->controller();
        // 更新数据库数据, save中第一个参数为修改的数据, 第二个为修改条件
        try{
            $res = model($model)->save(['status' => -1], ['id' => $id]);
        } catch (\Exception $e){
            return $this->result('', 0, $e->getMessage());
        }

        // 删除完之后的跳转路径为删除前的url
        if ($res) {
            return $this->result(['jump_url' => $_SERVER['HTTP_REFERER']], 1, '删除id='."$id".'成功');
        }
        return $this->result('', 0, '删除失败');
    }


    /**
     * 通用化修改状态
     */
    public function status() {
        $data  = input('param.');
        // tp5  validate 机制 校验  小伙伴自行完成 id status

        // 通过id 去库中查询下记录是否存在
        //model('News')->get($data['id']);

        $model = $this->model ? $this->model : request()->controller();

        try {
            $res = model($model)->save(['status' => $data['status']], ['id' => $data['id']]);
        }catch(\Exception $e) {
            return $this->result('', 0, $e->getMessage());
        }

        if($res) {
            return $this->result(['jump_url' => $_SERVER['HTTP_REFERER']], 1, 'OK');
        }
        return $this->result('', 0, '修改失败');
    }


}