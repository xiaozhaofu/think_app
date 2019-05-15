<?php

namespace app\api\controller\v2;


use app\api\controller\Common;

class Cat extends Common
{
    public function read()
    {
        $lists = config('cat.lists');

        $result[] = [
            'catid' => 0,
            'catname' => 'Home'
        ];

        foreach ($lists as $catid => $catname) {
            $result[] = [
                'catid' => $catid,
                'catname' => $catname
            ];
        }

        return json_out(1, 'ok', $result, 200);

    }
}
