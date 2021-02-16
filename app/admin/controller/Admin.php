<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\facade\View;
use think\Request;
use app\admin\model\Administrators as AdminModel;

class Admin
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
//        $uid = microtime();
//        $password = 'q6447218';
//        dd(md5($uid).'    |    '.sha1($password));
        return View::fetch('index');
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
