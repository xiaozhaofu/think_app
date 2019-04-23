<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/21 0021
 * Time: 12:10
 */

namespace app\admin\controller;


use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function welcome()
    {
        return "welcome hadmin";
    }
}