<?php
declare (strict_types = 1);

namespace app\controller;

use think\captcha\facade\Captcha as CaptchaImg;
use think\Request;

class Captcha
{
    /**
     * 获取验证码
     *
     * @return \think\Response
     */
    public function index()
    {
        $captcha =  CaptchaImg::createApi();

        return json($captcha);
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
