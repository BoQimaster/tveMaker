<?php


namespace app\controller;


use think\Request;
use tool\SendMail;

class Mailer
{
    public function send(Request $request)
    {
        $data = $request->param();

        $send = new SendMail();

        if (!empty($data['email'])) {
            $send->sendMail($data['email'], 'c测试标题', '测试征文内容12345');
            return '测试邮件已发送至指定邮箱';
        } else {
            return '错误：邮箱号码不正确';
        }
    }

    public function index()
    {
        echo (extension_loaded('openssl') ? 'SSL loaded' : 'SSL not loaded') . "\n";
    }

}