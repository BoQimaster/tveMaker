<?php
namespace app\admin\controller;


use app\admin\model\Administrators;
use app\BaseController;
use think\Request;

class Login extends BaseController
{
    public function index()
    {

        $data = Administrators::select();

        return json($data);

    }

    public function check(Request $request)
    {
        $username = $request->param('username');
        $data = Administrators::where('username', $username)->find();
        return json($data);
    }
}