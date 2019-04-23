<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/21 0021
 * Time: 19:51
 */

namespace app\common\model;


use think\Model;

class AdminUser extends Model
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