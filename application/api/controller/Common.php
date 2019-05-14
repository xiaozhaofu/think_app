<?php

namespace app\api\controller;

use app\common\lib\Aes;
use app\common\lib\exception\ApiException;
use app\common\lib\IAuth;
use app\common\lib\Time;
use think\Controller;
use think\facade\Cache;

class Common extends Controller
{
    public $headers = '';
    /**
     * 初始化方法
     */
    public function initialize()
    {

        $this->checkRequestAuth();
        // $this->testAes();
    }

    /**
     * 校验每次app请求的数据是否合法
     */
    public function checkRequestAuth()
    {
        $headers = request()->header();
        if (empty($headers['sign'])) {
            throw new ApiException('sign 不存在', 400);
        }

        if ( ! in_array($headers['app-type'], config('app.apptypes'))) {
            throw new ApiException('app-type不合法',400);
        }

        if ( ! IAuth::checkSignPass($headers)) {
            throw new ApiException('授权码sign失败', 401);
        }
        Cache::set($headers['sign'], 1, config('app.app_sign_cache_time'));
        $this->headers = $headers;

    }

    public function testAes()
    {
        $aes = new Aes();
        $headers = request()->header();
        $data = [
            'version' => $headers['version'],
            'model' => $headers['model'],
            'did' => $headers['did'],
            'time' => Time::getMillisecond(),
        ];
        $str = http_build_query($data);
        // halt($str);
        $aesstr = 'go0pFohccFlzVUnVzF8r3RCPM37X75WP/mwDIiYGiU5GGmmGD/WtYnA3MatqUWxQ4zXEPIkYcelTfbpauu66zw==';
        // echo $aes->encrypt($str);die;
        echo $aes->decrypt($aesstr);die;
    }
}
