-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2021-02-24 01:31:27
-- 服务器版本： 5.7.26
-- PHP 版本： 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `tve`
--

-- --------------------------------------------------------

--
-- 表的结构 `tve_access`
--

CREATE TABLE `tve_access` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT '序号',
  `administrators_id` mediumint(8) UNSIGNED NOT NULL COMMENT '账号关联id',
  `role_id` mediumint(8) UNSIGNED NOT NULL COMMENT '权限关联id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tve_access`
--

INSERT INTO `tve_access` (`id`, `administrators_id`, `role_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3);

-- --------------------------------------------------------

--
-- 表的结构 `tve_administrators`
--

CREATE TABLE `tve_administrators` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT '序号',
  `uid` char(32) NOT NULL COMMENT '唯一识别号MD5',
  `name` varchar(20) NOT NULL COMMENT '用户名',
  `password` char(40) NOT NULL COMMENT '密码sha1',
  `nickname` varchar(10) NOT NULL DEFAULT 'tve生产者' COMMENT '昵称',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像url',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `delete_time` datetime DEFAULT NULL COMMENT '软删除时间',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tve_administrators`
--

INSERT INTO `tve_administrators` (`id`, `uid`, `name`, `password`, `nickname`, `avatar`, `status`, `delete_time`, `create_time`, `update_time`) VALUES
(1, '4314cc73fec9fc3ade64db14388c946d', 'tvemaker', '7c4a8d09ca3762af61e59520943dc26494f8941b', '超级管理员', 'http://api.tvemaker.com//storage/img/avatar/20210224/bc40605adcb1d34caf9a7855627aaeb9.jpg', 0, NULL, '2021-02-23 17:48:58', '2021-02-24 01:28:14');

-- --------------------------------------------------------

--
-- 表的结构 `tve_administrators_info`
--

CREATE TABLE `tve_administrators_info` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT '序号',
  `administrators_id` mediumint(8) UNSIGNED NOT NULL COMMENT '账号关联id',
  `gender` char(1) DEFAULT NULL COMMENT '性别',
  `email` varchar(100) DEFAULT NULL COMMENT '邮箱',
  `delete_time` datetime DEFAULT NULL COMMENT '软删除时间',
  `create_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tve_administrators_info`
--

INSERT INTO `tve_administrators_info` (`id`, `administrators_id`, `gender`, `email`, `delete_time`, `create_time`, `update_time`) VALUES
(1, 1, '男', 'tvemaker@tvemaker.com', NULL, '2021-02-23 21:09:51', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tve_role`
--

CREATE TABLE `tve_role` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT '序号',
  `role` varchar(20) NOT NULL COMMENT '角色'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tve_role`
--

INSERT INTO `tve_role` (`id`, `role`) VALUES
(5, '二审'),
(6, '初审'),
(3, '初级管理员'),
(2, '次级管理员'),
(4, '终审'),
(1, '超级管理员');

--
-- 转储表的索引
--

--
-- 表的索引 `tve_access`
--
ALTER TABLE `tve_access`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `tve_administrators`
--
ALTER TABLE `tve_administrators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- 表的索引 `tve_administrators_info`
--
ALTER TABLE `tve_administrators_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`administrators_id`);

--
-- 表的索引 `tve_role`
--
ALTER TABLE `tve_role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role` (`role`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `tve_access`
--
ALTER TABLE `tve_access`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '序号', AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `tve_administrators`
--
ALTER TABLE `tve_administrators`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '序号', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `tve_administrators_info`
--
ALTER TABLE `tve_administrators_info`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '序号', AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `tve_role`
--
ALTER TABLE `tve_role`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '序号', AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
