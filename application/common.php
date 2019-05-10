<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * 展示分页 TP自带的分页方法
 * @param $obj
 * @return string
 */
function pagination($obj){
    if (! $obj) {
        return '';
    };
    $params = request()->param();
    return '<div class="imooc-app">'.$obj->appends($params)->render().'</div>';
}

/**
 * 处理分类显示名称
 * @param $catId
 * @return string
 */
function getCatName($catId){
    if (! $catId) {
        return '';
    };
    $cats = config('cat.lists');
    return $cats[$catId]?:'';
}



/**
 * 展示状态
 * @param $id
 * @param $status
 */
function show_status($id, $status){
    $controller = request()->controller();
    $sta = $status == 1 ? 0 : 1;
    $url = url($controller.'/status', ['id' => $id, 'status' => $sta]);
    if (1 == $status) {
        $str = "<a href='javascript:;' title='修改状态' status_url='" . $url . "' onclick='app_status(this)'>
                <span class='label label-success radius'>正常</span>
                </a>";
    } else if (0 == $status) {
        $str = "<a href='javascript:;' title='修改状态' status_url='" . $url . "' onclick='app_status(this)'>
                <span class='label label-danger radius'>待审</span>
                </a>";
    }

    return $str;

}




/**
 * 通用化API接口数据输出
 * @param $status
 * @param $message
 * @param array $data
 * @param int $httpCode
 * @return \think\response\Json
 */
function show($status, $message, $data=[], $httpCode=200){
    $data = [
        'status' => $status,
        'message' => $message,
        'data' => $data,
    ];

    return json($data, $httpCode);
}

