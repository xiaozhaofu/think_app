<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Author: LT-Gavin
 * Date: 2019/4/26 0026
 * Time: 15:39
 */

namespace app\common\model;


use think\Model;

class Base extends Model
{
    protected $autoWriteTimestamp = true; //动态设置时间字段写入
    public function add($data)
    {
        if(!is_array($data)){
            exception('传入的数据不合法');
        }
        $this->allowField(true)->save($data);

        //获取插入数据的id
        return $this->id;
    }
}