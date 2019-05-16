<?php

namespace app\api\controller\v1;

use app\api\controller\Common;


class Index extends Common
{
    /**
     * 获取首页接口
     * 1.头图
     * 2.推荐位列表 默认40条
     */
    public function index()
    {
        $headers = model('News')->getHeadIndexNormalNews();
        $headers = $this->getDealNews($headers);
        $position = model('News')->getPositionNormalNews();
        $position = $this->getDealNews($position);

        $res = [
            'headers' => $headers,
            'position' => $position,
        ];

        return json_out(1, 'ok',$res,200);
    }
}
