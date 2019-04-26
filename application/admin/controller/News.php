<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Author: LT-Gavin
 * Date: 2019/4/24 0024
 * Time: 13:48
 */

namespace app\admin\controller;


class News extends Base
{
    public function add()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $id = model('News')->allowField(TRUE)->save($data);
            halt($id);
        } else {
            return $this->fetch('', [
                'cats' => config('cat.lists')
            ]);
        }

    }
}