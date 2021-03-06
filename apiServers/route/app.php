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
use think\facade\Route;

Route::get('think', function () {
    return 'hello,ThinkPHP6!';
});


Route::get('hello/:name', 'index/hello');

// 后台登录模块路由
//Route::post('admin/login', 'Admin/login');


Route::post('jwt/read', 'Jwt/read');


// 文件上传
Route::resource('admin_upload', 'AdminUpload');

// 验证码
Route::resource('captcha', 'Captcha');
