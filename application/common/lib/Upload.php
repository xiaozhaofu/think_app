<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Author: LT-Gavin
 * Date: 2019/4/25 0025
 * Time: 14:43
 */

namespace app\common\lib;

use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
class Upload
{
    public static function image()
    {
        if (empty($_FILES['file']['tmp_name'])) {
            exception('你提交的图片不合法', 404);
        }
        // 要上传的文件
        $file = $_FILES['file']['tmp_name'];
        //获取文件后缀名
        $pathinfo = pathinfo($_FILES['file']['name']);
        $ext = $pathinfo['extension'];

        $config = config('qiniu.');
        // 构建一个鉴权对象
        $auth = new Auth($config['ak'], $config['sk']);
        // 生成上传token
        $token = $auth->uploadToken($config['bucket']);
        // 上传到七牛云后保存的文件名
        $key = date('Y').'/'.date('m').'/'.substr(md5($file), 0, 5).date('YmdHis').rand(0, 9999).'.'.$ext;
        // 初始化UploadManager类
        $upload = new UploadManager();
        // 获取返回的数组中的两个值
        list($ret, $err) = $upload->putFile($token, $key, $file);
        if ($err !== NULL) {
            return NULL;
        } else {
            return $key;
        }

    }
}