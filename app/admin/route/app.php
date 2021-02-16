<?php
//TVEMaker后台路由
use think\facade\Route;


Route::resource('/', 'Admin');

// 登录模块路由
Route::group(function() {
    Route::get('login', 'Login/index');
    Route::post('login_check', 'Login/check');
});