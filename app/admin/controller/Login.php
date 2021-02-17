<?php
namespace app\admin\controller;


use app\admin\model\Administrators;
use think\Request;

class Login
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