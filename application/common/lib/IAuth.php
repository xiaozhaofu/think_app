<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/22 0022
 * Time: 22:48
 */

namespace app\common\lib;


class IAuth
{
    public static function setPassword($data)
    {
        return md5($data);
    }
}