<?php
namespace app\controller;


use think\captcha\facade\Captcha;
use think\Request;
use app\model\Administrators as AdminModel;
use tool\SendMail;

class Password
{

    public function search(Request $request) {

        $data = $request->param();

        // 错误集合
        $errors = [];

        // 验证
        $user = AdminModel::where('name', $data['username'])->findOrEmpty();
        if($user->isEmpty()) {
            $errors['error'] = '用户名不存在';
            return json($errors);
        } else {
            $email = $user->getData('email');
            $str = explode('@', $email);
            $len = strlen($str[0]);
            $len2 = floor($len/3);
            $replaceStr = str_repeat('*', $len-$len2);
            $data = substr_replace($str[0], $replaceStr, $len2). '@' .$str[1];
            return json($data);
        }



    }

    public function send(Request $request) {
        $data = $request->param();

        if(!empty($data['email']) && !empty($data['username'])) {
            // 生成验证码
            $captcha = Captcha::createStr();

            $user = AdminModel::where('name', $data['username'])->findOrEmpty();

            if ($user->isEmpty()) {
                $data['error'] = '验证信息错误！';
                return json($data);
            } else if ($user['email'] !== $data['email']) {
                $data['error'] = '验证信息错误！';
                return json($data);
            } else {
                // 实例化PHPMailer
                $send = new SendMail();

                // 邮件主题
                $title = '您的验证码';

                // 邮件正文
                $content = '亲爱的'. $data['username'] .'您好！<br> 您正在尝试重置密码，以下是您的验证码:<br>'. strtoupper($captcha) .'<br>若非您本人所为请尽快修改旧密码！';

                $send->sendMail($data['email'], $title, $content);
                return '验证邮件已发送';
            }
        } else if (!empty($data['email']) || !empty($data['username'])) {
            $data['error'] = '验证信息错误！';
            return json($data);
        } else {
            $data['error'] = '用户名和邮箱不能为空！';
            return json($data);
        }
    }

    public function check(Request $request)
    {

    }
}