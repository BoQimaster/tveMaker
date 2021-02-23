<?php
namespace app\model;

use think\Model;
use think\model\concern\SoftDelete;

class Administrators extends Model
{
    // 一对一关联
    public function administratorsInfo()
    {
        return $this->hasOne(AdministratorsInfo::class);
    }

    // 多对多关联
    public function roles()
    {
        return $this->belongsToMany(Role::class, Access::class);
    }

}