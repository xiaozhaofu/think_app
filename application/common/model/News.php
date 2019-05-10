<?php

namespace app\common\model;


class News extends Base
{
    //获取新闻列表信息
    public function getNews($data = [])
    {
        $data[] = [
            'status','neq', config('code.status_delete')
        ];
        $order = ['id' => 'desc'];
        $result = self::where($data)->order($order)->paginate(5);

        return $result;
    }
}
