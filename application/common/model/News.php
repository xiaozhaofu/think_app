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

    /**
     * 获取头条数据
     * @param int $num
     */
    public function getHeadIndexNormalNews($num = 4)
    {
        $data = [
            'status' => 1,
            'is_head_figure' => 1
        ];
        $order = [
            'id' => 'desc'
        ];

        return $this->where($data)
            ->field(['id', 'catid', 'image', 'title', 'read_count'])
            ->order($order)
            ->limit($num)
            ->select();
    }


    /**
     * 获取推荐数据
     * @param int $num
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getPositionNormalNews($num = 20)
    {
        $data = [
            'status' => 1,
            'is_position' => 1
        ];
        $order = [
            'id' => 'desc'
        ];

        return $this->where($data)
            ->field(['id', 'catid', 'image', 'title', 'read_count'])
            ->order($order)
            ->limit($num)
            ->select();
    }
}
