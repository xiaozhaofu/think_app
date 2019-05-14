<?php

namespace app\api\controller;

use think\Controller;

class Time extends Controller
{
    public function index()
    {
        return json_out(1, 'ok', time());
    }
}
