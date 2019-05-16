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
    public function index()
    {
        $data = input('param.');
        // halt($data);
        $query = http_build_query($data);

        $whereData = [];
        $whereData = $this->get_whereData($data, $whereData);
        // halt($whereData);
        $news = model('News')->getNews($whereData, 5);
        // halt($news);
        return $this->fetch('',[
            'cats' => config('cat.lists'),
            'catid' => empty($data['catid']) ? '' : $data['catid'],
            'title' => empty($data['title'])? '' : $data['title'],
            'news' => $news,
            // $news打印出来为对象, 若要获取对象里的每个属性的值, 则用 属性名() 的方式获取
            'count' => $news->total(),  //数据总条数
            'curr' => $news->currentPage(), //当前页码数
            'listRows' => $news->listRows(),    // 每页显示条数
            'query' => $query, //跳转时带的参数
        ]);
    }

    /**
     * 添加新闻
     * @return mixed|void
     */
    public function add()
    {
        if (request()->isPost()) {
            $data = input('post.');

            try{
                $id = model('News')->add($data);
            } catch (\Exception $e){
                return $this->result('', 0, '新增失败');
            }

            if ($id) {
                return $this->result(['jump_url' => url('news/index')], 1, 'ok');
            } else {
                return $this->result('', 0, '新增失败');
            }

        } else {
            return $this->fetch('', [
                'cats' => config('cat.lists')
            ]);
        }

    }

    /**
     * @param $data
     * @param array $whereData
     * @return array
     */
    private function get_whereData($data, array $whereData)
    {
        // 转换查询条件
        if (!empty($data['start_time']) && !empty($data['end_time'])
            && $data['end_time'] > $data['start_time']
        ) {
            $whereData[] = ['create_time', 'gt', strtotime($data['start_time'])];
            $whereData[] = ['create_time', 'lt', strtotime($data['end_time'])];;
        }
        if (!empty($data['catid'])) {
            $whereData[] = ['catid', '=', intval($data['catid'])];
        }
        if (!empty($data['title'])) {
            $whereData[] = ['title', 'like', '%' . $data['title'] . '%'];
        }
        return  $whereData;
    }
}