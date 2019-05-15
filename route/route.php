<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// Route::get('think', function () {
//     return 'hello,ThinkPHP5!';
// });
//
// Route::get('hello/:name', 'index/hello');


Route::get('test', 'api/test/index');
Route::put('test/:id', 'api/test/update');

Route::resource('test', 'api/test');
// 版本控制, api/v1/cat  对应 api/v1.cat/read, v1.cat即v1目录下的cat.php的read方法
Route::get('api/:ver/cat', 'api/:ver.cat/read');
Route::get('api/:ver/index', 'api/:ver.index/index');
