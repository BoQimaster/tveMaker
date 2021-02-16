<?php


namespace app\api\controller;

use think\captcha\facade\Captcha as CaptchaImg;

class Captcha
{
    public function index()
    {
        return CaptchaImg::create();
    }

}