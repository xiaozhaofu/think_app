<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/22 0022
 * Time: 22:48
 */

namespace app\common\lib;




use think\facade\Cache;

class IAuth
{
    /**
     * @param $data
     * @return string
     */
    public static function setPassword($data)
    {
        return md5($data);
    }

    /**
     * 设置sign
     * @param array $data
     * @return string
     */
    public static function setSign($data = [])
    {
        ksort($data);
        $string = http_build_query($data);
        $aes = (new Aes())->encrypt($string);
        // $res = strtoupper($aes);
        return $aes;

    }

    /**
     * 校验sign是否合法
     * @param $data
     * @return bool
     */
    public static function checkSignPass($data)
    {
        $str = (new Aes())->decrypt($data['sign']);

        if (empty($str)) {
            return FALSE;
        }
        parse_str($str, $arr);
        if (! is_array($arr) || $arr['did'] != $data['did'] || empty($arr)) {
            return FALSE;
        }
        // 如果在开发环境下, 即app_debug为true时, 则不进行时间的校验和唯一性的判定
        if(! config('app_debug')){
            if ((time() - ceil($arr['time']/1000)) > config('app_sign_time')) {
                return FALSE;
            }
            //授权码唯一性判定
            if (Cache::get($data['sign'])) {
                return FALSE;
            }
        }

        return TRUE;
    }
}