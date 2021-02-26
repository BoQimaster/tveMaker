<?php
declare (strict_types = 1);

namespace app\controller;

use app\model\Administrators as AdminModel;
use think\facade\Validate;
use think\Request;

/**
 * Class AdminLogin
 * @package app\controller
 */
class AdminLogin
{
    /**
     * 管理后台登录验证
     * @param Request $request
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
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
            $info = $info->visible(['id','nickname', 'avatar'])->toArray();

            // 判断登录信息是否需要本地保存
            if($data['cookie']) {
                $info['cookie'] = true;
                return json($info);
            } else {
                return json($info);
            }

        }


    }

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        // return 'AdminLogin';
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
