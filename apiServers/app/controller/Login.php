<?php
namespace app\controller;


use app\model\Administrators as AdminModel;
use app\BaseController;
use think\facade\Validate;
use think\Request;

class Login extends BaseController
{
    public function index()
    {

    }

    public function check(Request $request)
    {
        $data = $request->param();

        // 错误集合
        $errors = [];

        // 验证
        $validate = Validate::rule([
            'name'  => 'unique:administrators,name^password'
        ]);

        $result = $validate->check([
            'name'      =>  $data['username'],
            'password'      =>  sha1($data['password'])
        ]);

        // 用户名和密码正确通过，错误返回短语
        if($result) {
            $errors[] = '用户名或密码错误~';
        }

        // 验证码
        if( !captcha_check($data['captcha'])) {

            $errors[] = '验证码错误';
        }

        // 验证判断
        if(!empty($errors)) {
            return json($errors);
        } else {
            // 获取登录账号数据
            $info = AdminModel::where('name', $data['username'])->find();
            // 数据整体,返回id，昵称和头像地址
            $info = $info->visible(['id','nickname', 'avatar']);

            return json($info);
//            return 'cookie';
        }


    }
}