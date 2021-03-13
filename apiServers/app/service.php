<?php

use app\AppService;

// 系统服务定义文件
// 服务在完成全局初始化之后执行
return [
    AppService::class,

    // Casbin权限管理控制
    tauthz\TauthzService::class,
];
