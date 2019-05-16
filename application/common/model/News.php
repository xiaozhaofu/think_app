<?php

namespace app\common\model;


class News extends Base
{
    //获取新闻列表信息
    public function getNews($data = [], $size=1)
    {
        //
        if (! isset($data['status'])) {
            $data[] = [
                'status','neq', config('code.status_delete')
            ];
        }

        $order = ['id' => 'desc'];
        $result = $this->where($data)
            ->field($this->_getListField())
            ->order($order)
            ->paginate($size);

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
        $res = $this->getNewsRes($num, $data, $order);
        return $res;
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

        $res = $this->getNewsRes($num, $data, $order);
        return $res;
    }

    /**
     * 获取参数的数据字段
     * @return array
     */
    private function _getListField()
    {
        return ['id', 'catid', 'image', 'title', 'read_count', 'status', 'is_position', 'update_time'];
    }

    /**
     * @param $num
     * @param array $data
     * @param array $order
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    private function getNewsRes($num, array $data, array $order)
    {
        $res = $this->where($data)
            ->field($this->_getListField())
            ->order($order)
            ->limit($num)
            ->select();
        return $res;
    }
}
