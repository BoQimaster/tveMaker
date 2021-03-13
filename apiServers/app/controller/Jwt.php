<?php


namespace app\controller;


use app\model\Administrators as AdminModel;
use thans\jwt\facade\JWTAuth;
use think\facade\Validate;
use think\Request;

class Jwt
{
    public function index()
    {
        $token = JWTAuth::builder(['uid' => 1]);//参数为用户认证的信息，请自行添加

        JWTAuth::auth();//token验证

        JWTAuth::refresh();//刷新token，会将旧token加入黑名单

        $tokenStr = JWTAuth::token()->get(); //可以获取请求中的完整token字符串

        $payload = JWTAuth::auth(); //可验证token, 并获取token中的payload部分
        $uid = $payload['uid']->getValue(); //可以继而获取payload里自定义的字段，比如uid
    }

    public function login(Request $request)
    {
//        $data = $request->param();
//
//        // 错误集合
//        $errors = [];
//
//
//        // 验证
//        $validate = Validate::rule([
//            'name'  => 'unique:administrators,name^password'
//        ]);
//
//        $result = $validate->check([
//            'name'      =>  $data['name'],
//            'password'      =>  sha1($data['password'])
//        ]);
//
//        // 用户名和密码正确通过，错误返回短语
//        if($result) {
//            $errors[] = '用户名或密码错误~';
//        }
//
//        // 验证判断
//        if(!empty($errors)) {
//            return json($errors);
//        } else {
//            // 获取登录账号数据
//            $info = AdminModel::where('name', $data['name'])->find();
//            // 数据整体,返回id，昵称和头像地址
//            $info = $info->visible(['id','nickname', 'avatar'])->toArray();
//
//            $token = JWTAuth::builder($info);
//
//            $info['token'] = $token;
//
//            // 判断登录信息是否需要本地保存
//            if($data['cookie']) {
//                $info['cookie'] = true;
//                return json($info);
//            } else {
//                return json($info);
//            }
//
//        }
    }

    public function read()
    {
        $payload = JWTAuth::auth(); //可验证token, 并获取token中的payload部分
        $nickname = $payload['nickname']->getValue(); //可以继而获取payload里自定义的字段，比如uid

        return json($nickname);
    }

    public function refresh()
    {
        $payload = JWTAuth::auth(); //可验证token, 并获取token中的payload部分

        $refToken = JWTAuth::refresh();

        return json($refToken);
    }

}