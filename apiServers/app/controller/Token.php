<?php
namespace app\controller;

use think\captcha\facade\Captcha as CaptchaImg;
use think\Request;

class Token
{
    public function index(Request $request)
    {
        // 数据集合
        $yz = [];
        // 验证码验证
        $captcha =  CaptchaImg::createApi();
        $yz['captcha'] = $captcha;
        // token验证
        $token = $request->buildToken();
        $yz['token'] = $token;
        return json($yz);
    }

}