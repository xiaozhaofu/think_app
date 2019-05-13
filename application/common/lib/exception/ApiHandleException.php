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
    public $httpCode = 501;
    public $code = 0;

    public function render(\Exception $e)
    {
        // 如果开启debug, 异常交给系统处理
        // if(config('app.app_debug') == true){
        //     return parent::render($e);
        // }
        //如果是API抛出的异常, 则进行此步骤
        if($e instanceof ApiException){
            $this->httpCode = $e->httpCode;
            $this->code = $e->code;
        }
        return json_out($this->code, $e->getMessage(), [], $this->httpCode);
    }
}