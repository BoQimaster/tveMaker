<?php


namespace app\controller;

use app\BaseController;
use app\model\Administrators as AdminModel;

class Test extends BaseController
{
    public function index()
    {
        $admin = AdminModel::find(1);
        $admin->cookie = true;
        return json($admin);
    }

    public function many()
    {
        $admin = AdminModel::find(1);
        $roles = $admin->roles()->select();
        return json($roles);
    }

}