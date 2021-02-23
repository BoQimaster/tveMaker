<?php
declare (strict_types = 1);

namespace app\controller;

use app\model\Administrators;
use think\Exception;
use think\facade\Filesystem;
use think\Request;

class Upload
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return   '上传资源';
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        // 定位更新对象
        $id = $request->param('id');

        if($id) {
            // 查找数据
            $user = Administrators::find($id);
            // 接收文件
            $file = $request->file('avatar');
            // 存储文件获取url
            $info = app()->getRuntimePath() . '/storage/' . Filesystem::putFile('img/avatar', $file);
            // 更新头像地址
            $user->avatar = $info;
            $user->save();
            return json($info);
        } else{
            return json('用户信息有误');
        }
        return 'save';

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

        return 'update';
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        return 'delete';
    }
}
