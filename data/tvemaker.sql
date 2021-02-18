# Host: localhost  (Version: 5.7.26)
# Date: 2021-02-19 00:54:23
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "tve_administrators"
#

DROP TABLE IF EXISTS `tve_administrators`;
CREATE TABLE `tve_administrators` (
  `id` mediumint(8) unsigned NOT NULL COMMENT '序号',
  `uid` char(32) NOT NULL COMMENT '唯一识别号',
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `nickname` varchar(10) NOT NULL DEFAULT 'tve生产者' COMMENT '昵称',
  `password` char(40) NOT NULL COMMENT '密码',
  `gender` char(1) DEFAULT NULL COMMENT '性别',
  `email` varchar(100) DEFAULT NULL COMMENT '邮箱',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `delete_time` datetime DEFAULT NULL COMMENT '删除时间',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `update_time` datetime DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `id` (`id`)
);

#
# Data for table "tve_administrators"
#

INSERT INTO `tve_administrators` VALUES (1,'e3b764bb1a9c6bac9c9cf498ad0fa68d','tveadmin','超级管理员','d5d9082b574059ae2b110d4a12ba1ef4d51ed3cc',NULL,NULL,'http://www.tvemaker.com/storage/img/avatar/20210219\\3c64f7280f557bcc62b55a0c2e3a9429.jpg',0,NULL,'2021-02-16 00:00:00','2021-02-19 00:48:10');
