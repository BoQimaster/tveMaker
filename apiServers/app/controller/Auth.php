<?php
namespace app\controller;


use tauthz\facade\Enforcer;

class Auth
{
    public function index()
    {
//        // 给用户添加权限
//        Enforcer::addPermissionForUser('eve', 'articles', 'read');
//        // 给用户添加角色
//        Enforcer::addRoleForUser('eve', 'writer');
//        // 给规则添加权限
//        Enforcer::addPolicy('writer', 'articles','edit');

//        // 检查用户是否具有权限
//        if (Enforcer::enforce("eve", "articles", "edit")) {
//            // 允许eve编辑文章
//            return '允许';
//            // 获取所有角色
//            $roles = Enforcer::getAllRoles();
//            // 获取所有的角色的授权规则
//            $policy = Enforcer::getPolicy();
//            // 获取某个用户的所有角色
//            $eveRole = Enforcer::getRolesForUser('eve');
//            // 获取某个角色的所有用户
//            $roleUser = Enforcer::getUsersForRole('writer');
//
//            // 判断用户是否拥有某个角色
//            $hasRole = Enforcer::hasRoleForUser('eve', 'writer');

//            // 赋予权限给某个用户或角色
//            // 给用户
//            Enforcer::addPermissionForUser('eve', 'articles', 'read');
//            // 给角色
//            Enforcer::addPermissionForUser('writer', 'articles','edit');

//            // 删除用户的角色：
//            Enforcer::deleteRoleForUser('eve', 'writer');
//
//            // 删除某个用户的所有角色：
//            Enforcer::deleteRolesForUser('eve');
//
//            // 删除单个角色：
//            Enforcer::deleteRole('writer');
//
//            // 删除某个权限：
//            Enforcer::deletePermission('articles', 'read');

//            // 删除某个用户或角色的权限：
//            Enforcer::deletePermissionForUser('eve', 'articles', 'read');

//            // 删除某个用户或角色的所有权限：
//                // 对用户
//                Enforcer::deletePermissionsForUser('eve');
//                // 对角色
//                Enforcer::deletePermissionsForUser('writer');

//            // 获取用户或角色的所有权限：
//            $userPolicy = Enforcer::getPermissionsForUser('eve');
//
//            // 判断某个用户是否拥有某个权限
//            $hasPolicy = Enforcer::hasPermissionForUser('eve', 'articles', 'read');
//            return json($hasPolicy);
//        } else {
//            // 拒绝请求，显示错误
//            return '拒绝';
//        }

        // 给tvemaker添加 超级管理员 角色
        Enforcer::addRoleForUser('tvemaker', '超级管理员');
        // 给 超级管理员 角色添加 文章 功能的 编辑 权限
        Enforcer::addPolicy('超级管理员', 'articles','edit');

    }
}