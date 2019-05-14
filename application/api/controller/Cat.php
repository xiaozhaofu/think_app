<?php

namespace app\api\controller;


class Cat extends Common
{
    public function read()
    {
        $lists = config('cat.lists');

        $result[] = [
            'catid' => 0,
            'catname' => '首页'
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
