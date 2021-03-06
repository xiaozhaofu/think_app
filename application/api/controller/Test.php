<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Author: LT-Gavin
 * Date: 2019/5/13 0013
 * Time: 17:01
 */

namespace app\api\controller;


use app\common\lib\Aes;
use app\common\lib\exception\ApiException;

class Test extends Common
{
    public function index()
    {
        // 不能直接return数组
        return [
            'thinkphp',
            'laravel',
        ];
    }

    public function update($id = 0)
    {
        $params = input('put.');
        halt($params);
        // return $params;
    }

    public function save()
    {
        $data = input('post.');

        if($data['http'] != 10){
           // exception('你提交的数据不合法');
            throw new ApiException('你提交的数据不合法, 请更正', 403, 2);
        }
       return json_out(1, 'success', (new Aes())->encrypt(json_encode($data)), 201);
    }

}