<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/9 0009
 * Time: 23:25
 */

namespace app\common\lib\exception;


use think\exception\Handle;

class ApiHandleException extends Handle
{
    /**
     * http状态吗
     * @var int 
     */
    public $httpCode = 500;

    public function render(\Exception $e)
    {
        return show(0, $e->getMessage(), [], $this->httpCode);
    }
}