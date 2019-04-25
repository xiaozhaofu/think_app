<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Author: LT-Gavin
 * Date: 2019/4/25 0025
 * Time: 10:23
 */

namespace app\admin\controller;


use app\common\lib\Upload;
use think\Config;

class Image extends Base
{
    /**
     *本地上传
     */
    public function upload0()
    {
        // 获取表单上传文件 例如上传了001.jpg
        $image = request()->file('file');
        $info = $image->move('uploads/layui_uploads');
        if ($info) {
            // 成功上传后 获取上传信息
            echo json_encode(['code' => 'T', 'msg' => '上传成功!', 'image_name' =>  $info->getSaveName()]);
        } else {
            echo json_encode(['code' => 'F', 'msg' => '上传失败','info' => $info->getError()]);
        }
    }

    /**
     * 七牛云上传
     */
    public function upload()
    {
        try{
            $image = Upload::image();
        } catch (\Exception $e){
            echo json_encode(['code' => 'F', 'msg' => $e->getMessage()]);
        }

        if ($image) {
            echo json_encode(['code' => 'T', 'msg' => '上传成功', 'data' => config('qiniu.image_url').'/'.$image]);
        } else {
            echo json_encode(['code' => 'F', 'msg' => '上传失败']);
        }
    }

}