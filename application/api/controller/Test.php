<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Author: LT-Gavin
 * Date: 2019/5/13 0013
 * Time: 17:01
 */

namespace app\api\controller;


use think\Controller;

class Test extends Controller
{
    public function index()
    {
        // 不能直接return数组
        return json([
            'thinkphp',
            'laravel',
        ]);
    }
}