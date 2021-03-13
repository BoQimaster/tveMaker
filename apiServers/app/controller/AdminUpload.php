<?php
declare (strict_types = 1);

namespace app\controller;

use app\model\Administrators as AdminModel;
use think\facade\Filesystem;
use think\Request;

class AdminUpload
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
        $data = $request->param();

        $id = $data['id'];

        if($id) {
            // 查找数据
            $user = AdminModel::find($id);
            // 接收文件
            $file = $request->file('avatar');

            // 存储文件获取url
            $info = Filesystem::putFile('/img/avatar', $file);

            // 获取存储位置
            $url = 'http://api.tvemaker.com'. '/' .Filesystem::getDiskConfig('public', 'url'). '/' .str_replace('\\','/',$info);

            // 更新头像地址
            $user->avatar = $url;
            $user->save();
            return json($url);
        } else{
            return json('用户信息有误');
        }
//        return 'save';

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
