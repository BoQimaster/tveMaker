<?php


namespace app\controller;

use app\BaseController;
use app\model\Administrators as AdminModel;

class Test extends BaseController
{
    public function index()
    {
        $admin = AdminModel::find(1);
        return json($admin->administratorsInfo);
    }

    public function many()
    {
        $admin = AdminModel::find(1);
        $roles = $admin->roles()->select();
        return json($roles);
    }

}