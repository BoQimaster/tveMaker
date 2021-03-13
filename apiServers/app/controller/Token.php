<?php
namespace app\controller;

use think\captcha\facade\Captcha as CaptchaImg;
use think\Request;

class Token
{
    public function index(Request $request)
    {
        // 验证数据集合
        $yz = [];
        // 验证码验证
        $captcha =  CaptchaImg::createApi();
        $yz['captcha'] = $captcha;

        return json($yz);
    }

}