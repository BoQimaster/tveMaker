-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2021-02-16 15:08:08
-- 服务器版本： 5.7.26
-- PHP 版本： 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `tvemaker`
--

-- --------------------------------------------------------

--
-- 表的结构 `tve_administrators`
--

CREATE TABLE `tve_administrators` (
  `id` mediumint(8) UNSIGNED NOT NULL COMMENT '序号',
  `uid` char(32) NOT NULL COMMENT '唯一识别号',
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `password` char(40) NOT NULL COMMENT '密码',
  `gender` char(1) DEFAULT NULL COMMENT '性别',
  `email` varchar(100) DEFAULT NULL COMMENT '邮箱',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `delete_time` datetime DEFAULT NULL COMMENT '删除时间',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tve_administrators`
--

INSERT INTO `tve_administrators` (`id`, `uid`, `username`, `password`, `gender`, `email`, `status`, `delete_time`, `create_time`, `update_time`) VALUES
(1, 'e3b764bb1a9c6bac9c9cf498ad0fa68d', 'tveadmin', 'd5d9082b574059ae2b110d4a12ba1ef4d51ed3cc', NULL, NULL, 0, NULL, '2021-02-16 00:00:00', NULL);

--
-- 转储表的索引
--

--
-- 表的索引 `tve_administrators`
--
ALTER TABLE `tve_administrators`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `uid` (`uid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `id` (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `tve_administrators`
--
ALTER TABLE `tve_administrators`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '序号', AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
