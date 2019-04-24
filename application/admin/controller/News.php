<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Author: LT-Gavin
 * Date: 2019/4/24 0024
 * Time: 13:48
 */

namespace app\admin\controller;


class News extends Base
{
    public function add()
    {
        return $this->fetch();
    }
}