<?php


namespace app\controller;


use app\model\Administrators as AdminModel;
use thans\jwt\facade\JWTAuth;
use think\facade\Cookie;
use think\facade\Validate;
use think\Request;

class Admin
{
    public function login(Request $request)
    {
        $data = $request->param();

        // 错误集合
        $errors = [];


        // 验证
        $validate = Validate::rule([
            'name' => 'unique:administrators,name^password'
        ]);

        $result = $validate->check([
            'name' => $data['name'],
            'password' => sha1($data['password'])
        ]);

        // 用户名和密码正确通过，错误返回短语
        if ($result) {
            $errors[] = '用户名或密码错误~';
        }

        // 验证码
        if (!captcha_check($data['captcha'])) {

            $errors[] = '验证码错误';
        }

        // 验证判断
        if (!empty($errors)) {
            return json($errors);
        } else {
            // 获取登录账号数据
            $user = AdminModel::where('name', $data['name'])->find();
            // 数据集合id,昵称和头像地址
            $info = $user->visible(['id', 'nickname', 'avatar'])->toArray();

            $response['user'] = $info;

            // 创建登录token
            $token = JWTAuth::builder($info);

            // 判断登录信息是否需要本地保存
            if ($data['cookie'] !== true) {
                // 将token加入response数据返回
                $response['token'] = $token;
                return json($response);
            } else {
                // 刷新token获取半年有效期新token并返回
                $refToken = JWTAuth::refresh();//刷新token，会将旧token加入黑名单
                Cookie::set('token', $refToken, 15768000);
                $response['token'] = $refToken;
                return json($response);
            }


        }
    }

    public function check()
    {
        $payload = JWTAuth::auth();

        $response['id'] = $payload['id']->getValue();
        $response['nickname'] = $payload['nickname']->getValue();
        $response['avatar'] = $payload['avatar']->getValue();

        return json($response);
    }
}