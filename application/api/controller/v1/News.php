<?php

namespace app\api\controller\v1;

use app\api\controller\Common;
use think\Request;

class News extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = input('get.');
        $whereData[] =['status', '=', config('code.status_normal')] ;
        $whereData[] = ['catid', '=', input('get.catid', 1, 'intval')] ;
        // 条件搜索
        if (!empty($data['title'])) {
            $whereData[] = ['title','like', '%'.$data['title'].'%'];
        }

        $size = input('get.size', 2);   //每页显示条数, 默认为1
        $news = model('News')->getNews($whereData, $size);
        $news = $this->getDealNews($news);
        // echo model('News')->getLastSql();
        return $news;
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
