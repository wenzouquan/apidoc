/*
 Navicat Premium Data Transfer

 Source Server         : develop环境
 Source Server Type    : MySQL
 Source Server Version : 50634
 Source Host           : 101.200.36.159
 Source Database       : phprap

 Target Server Type    : MySQL
 Target Server Version : 50634
 File Encoding         : utf-8

 Date: 11/07/2017 20:42:19 PM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `doc_api`
-- ----------------------------
DROP TABLE IF EXISTS `doc_api`;
CREATE TABLE `doc_api` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `module_id` int(10) NOT NULL DEFAULT '0' COMMENT '模块id',
  `title` varchar(250) NOT NULL DEFAULT '' COMMENT '接口名',
  `method` varchar(10) NOT NULL DEFAULT '' COMMENT '请求方式',
  `uri` varchar(250) NOT NULL DEFAULT '' COMMENT '接口地址',
  `intro` varchar(250) NOT NULL DEFAULT '' COMMENT '接口简介',
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '创建者id',
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `module_id_index` (`module_id`),
  KEY `user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='项目接口表';

-- ----------------------------
--  Records of `doc_api`
-- ----------------------------
BEGIN;
INSERT INTO `doc_api` VALUES ('1', '1', '获取商品详情', 'GET', 'goods/{id}', '', '1', '2017-11-04 21:47:01');
COMMIT;

-- ----------------------------
--  Table structure for `doc_apply`
-- ----------------------------
DROP TABLE IF EXISTS `doc_apply`;
CREATE TABLE `doc_apply` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) NOT NULL DEFAULT '0' COMMENT '项目id',
  `creater_id` int(10) NOT NULL DEFAULT '0' COMMENT '项目创建者id',
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '申请用户id',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '审核状态',
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `user_id` (`user_id`),
  KEY `creater_id` (`creater_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='申请加入项目表';

-- ----------------------------
--  Table structure for `doc_config`
-- ----------------------------
DROP TABLE IF EXISTS `doc_config`;
CREATE TABLE `doc_config` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `config` text NOT NULL,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='系统配置表';

-- ----------------------------
--  Records of `doc_config`
-- ----------------------------
BEGIN;
INSERT INTO `doc_config` VALUES ('1', '{\"name\":\"PHPRAP接口文档管理系统\",\"keywords\":\"phprap,apidoc,api文档管理\",\"description\":\"PHPRAP，是一个PHP轻量级开源API接口文档管理系统，致力于减少前后端沟通成本，提高团队协作开发效率，打造PHP版的RAP。\",\"copyright\":\"Copyright ©2016-2017 PHPRAP版权所有\",\"email\":\"245629560@qq.com\",\"register_token\":\"PHPRAP\",\"default_password\":\"123456\",\"login_captcha\":\"1\",\"register_captcha\":\"1\",\"is_push\":\"1\",\"push_time\":\"5\"}', '2017-11-20 16:40:05');
COMMIT;

-- ----------------------------
--  Table structure for `doc_dbbak`
-- ----------------------------
DROP TABLE IF EXISTS `doc_db_bak`;
CREATE TABLE `doc_db_bak` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `file` varchar(250) NOT NULL,
  `size` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '大小，单位KB',
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8  COMMENT='数据备份表';

-- ----------------------------
--  Table structure for `doc_db_map`
-- ----------------------------
DROP TABLE IF EXISTS `doc_db_map`;
CREATE TABLE `doc_db_map` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) NOT NULL DEFAULT '0' COMMENT '项目id',
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '创建者id',
  `table_name` varchar(20) NOT NULL,
  `table_comment` varchar(50) NOT NULL DEFAULT '' COMMENT '表备注',
  `field_json` text NOT NULL COMMENT '字段json字符串',
  `add_time` datetime DEFAULT NULL COMMENT '添加时间',
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `user_id` (`user_id`),
  KEY `table_name` (`table_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=432 DEFAULT CHARSET=utf8 COMMENT='数据字典表';

-- ----------------------------
--  Table structure for `doc_field`
-- ----------------------------
DROP TABLE IF EXISTS `doc_field`;
CREATE TABLE `doc_field` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `api_id` int(10) NOT NULL DEFAULT '0' COMMENT '接口id',
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '创建者用户id',
  `parent_id` int(10) NOT NULL DEFAULT '0' COMMENT '父级id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '接口名称',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '接口标题',
  `type` varchar(10) NOT NULL DEFAULT '' COMMENT '字段类型',
  `method` tinyint(3) NOT NULL DEFAULT '1' COMMENT '参数类型，1:请求字段 2:响应字段 3:header字段',
  `is_required` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否必传',
  `default_value` varchar(250) NOT NULL DEFAULT '' COMMENT '默认值',
  `intro` varchar(250) NOT NULL DEFAULT '' COMMENT '备注',
  `mock` varchar(200) NOT NULL DEFAULT '' COMMENT 'mock规则',
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `api_id_index` (`api_id`),
  KEY `user_id_index` (`user_id`),
  KEY `parent_id_index` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='项目字段表';

-- ----------------------------
--  Records of `doc_field`
-- ----------------------------
BEGIN;
INSERT INTO `doc_field` VALUES ('1', '1', '1', '0', 'code', '返回状态码', 'number', '2', '0', '219', '', 'number|200-300', '2017-11-01 02:07:50'), ('3', '1', '1', '0', 'msg', '返回信息', 'string', '2', '0', '成功消息805', '', 'message|success', '2017-11-03 16:52:02'), ('4', '1', '3', '0', 'data', '数据实体', 'array', '2', '0', '', '', '', '2017-11-03 17:12:54'), ('5', '1', '1', '4', 'name', '商品名称', 'string', '2', '0', '诺伊曼乳胶宿舍床垫子榻榻米单人床褥垫1.8米床 天然乳胶床垫4cm 90cm*190cm', '', 'goods|name', '2017-11-03 17:13:07'), ('6', '1', '1', '4', 'desc', '商品描述', 'string', '2', '0', '【拯救者全新升级，外观更炫酷，色彩更丰富】【靠谱之选】天逸性能 稳定高效 使用流畅 商务稳重', '', 'goods|desc', '2017-11-03 17:39:51'), ('7', '1', '1', '0', 'goodsId', '商品id', 'number', '1', '1', '0', '', '', '2017-11-04 21:52:42'), ('8', '1', '1', '4', 'price', '商品价格', 'float', '2', '0', '81.76', '', 'price|2', '2017-11-04 21:55:34'), ('9', '1', '1', '4', 'cover', '商品封面', 'string', '2', '0', 'https://dummyimage.com/200x200/', '', 'image|200x200', '2017-11-04 21:58:28'), ('10', '1', '1', '0', 'Content-Type', 'header头', 'string', '3', '0', 'application/json', '', '', '2017-11-15 18:02:29');
COMMIT;

-- ----------------------------
--  Table structure for `doc_login_log`
-- ----------------------------
DROP TABLE IF EXISTS `doc_login_log`;
CREATE TABLE `doc_login_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '用户id',
  `user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名称',
  `user_email` varchar(50) NOT NULL DEFAULT '' COMMENT '用户邮箱',
  `ip` varchar(50) NOT NULL DEFAULT '' COMMENT '登录ip',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '登录地址',
  `device` varchar(50) NOT NULL DEFAULT '' COMMENT '登录设备',
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='登录日志表';

-- ----------------------------
--  Table structure for `doc_member`
-- ----------------------------
DROP TABLE IF EXISTS `doc_member`;
CREATE TABLE `doc_member` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) NOT NULL DEFAULT '0' COMMENT '项目id',
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '用户id',
  `project_rule` varchar(50) NOT NULL DEFAULT '' COMMENT '项目权限',
  `module_rule` varchar(50) NOT NULL DEFAULT '' COMMENT '权限',
  `api_rule` varchar(50) NOT NULL DEFAULT '' COMMENT '接口权限',
  `member_rule` varchar(50) NOT NULL DEFAULT '' COMMENT '成员权限',
  `map_rule` varchar(50) NOT NULL DEFAULT '' COMMENT '数据字典权限',
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id_index` (`user_id`) USING BTREE,
  KEY `project_id_index` (`project_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='项目成员表';

-- ----------------------------
--  Table structure for `doc_module`
-- ----------------------------
DROP TABLE IF EXISTS `doc_module`;
CREATE TABLE `doc_module` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) NOT NULL DEFAULT '0' COMMENT '项目id',
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '创建者id',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '模块名称',
  `intro` varchar(255) NOT NULL DEFAULT '' COMMENT '项目描述',
  `sort` int(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `project_id_index` (`project_id`),
  KEY `user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='项目模块表';

-- ----------------------------
--  Records of `doc_module`
-- ----------------------------
BEGIN;
INSERT INTO `doc_module` VALUES ('1', '1', '1', '商品模块', '商品相关接口', '0', '2017-11-04 21:46:17');
COMMIT;

-- ----------------------------
--  Table structure for `doc_notify`
-- ----------------------------
DROP TABLE IF EXISTS `doc_notify`;
CREATE TABLE `doc_notify` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '申请者id',
  `user_name` varchar(250) NOT NULL DEFAULT '' COMMENT '用户名',
  `project_id` int(10) NOT NULL DEFAULT '0' COMMENT '项目id',
  `to_user_id` int(10) NOT NULL DEFAULT '0' COMMENT '通知者id',
  `type` varchar(10) NOT NULL,
  `message` varchar(250) NOT NULL DEFAULT '',
  `is_readed` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否读过',
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `to_user_id` (`to_user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='消息通知表';

-- ----------------------------
--  Table structure for `doc_project`
-- ----------------------------
DROP TABLE IF EXISTS `doc_project`;
CREATE TABLE `doc_project` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL DEFAULT '0' COMMENT '创建者id',
  `title` varchar(255) NOT NULL COMMENT '项目标题',
  `intro` varchar(255) NOT NULL COMMENT '项目描述',
  `envs` text NOT NULL COMMENT '环境域名,json字符串',
  `allow_search` tinyint(3) NOT NULL DEFAULT '1' COMMENT '是否允许被搜索到',
  `sort` int(10) NOT NULL DEFAULT '0' ,
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL COMMENT '最后更新时间',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='项目表';

-- ----------------------------
--  Records of `doc_project`
-- ----------------------------
BEGIN;
INSERT INTO `doc_project` VALUES ('1', '1', '测试项目', '测试专用项目', '[{\"name\":\"product\",\"title\":\"生产环境",\"domain\":\"http:\\/\\/phprap.gouguoyin.cn\"},{\"name\":\"develop\",\"title\":\"测试环境",\"domain\":\"http:\\/\\/demo.gouguoyin.cn\"}]', '1', '0', '2017-11-04 21:45:53', '2017-11-04 21:50:32');
COMMIT;

-- ----------------------------
--  Table structure for `doc_project_log`
-- ----------------------------
DROP TABLE IF EXISTS `doc_project_log`;
CREATE TABLE `doc_project_log` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `project_id` int(1) NOT NULL DEFAULT '0' COMMENT '项目id',
  `user_id` int(10) NOT NULL,
  `user_name` varchar(200) NOT NULL DEFAULT '' COMMENT '操作人昵称',
  `user_email` varchar(50) NOT NULL DEFAULT '' COMMENT '操作人邮箱',
  `type` varchar(10) NOT NULL COMMENT '操作类型',
  `object` varchar(20) NOT NULL,
  `content` text NOT NULL COMMENT '对象',
  `project_title` varchar(200) DEFAULT NULL,
  `module_title` varchar(50) DEFAULT NULL,
  `api_name` varchar(200) DEFAULT NULL,
  `field_name` varchar(200) DEFAULT NULL,
  `member_name` varchar(200) DEFAULT NULL,
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `doc_user`
-- ----------------------------
DROP TABLE IF EXISTS `doc_user`;
CREATE TABLE `doc_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '登录邮箱',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '昵称',
  `password` varchar(50) NOT NULL DEFAULT '' COMMENT '密码',
  `type` tinyint(3) NOT NULL DEFAULT '1' COMMENT '1:用户 2:管理员',
  `status` tinyint(3) NOT NULL DEFAULT '1' COMMENT '状态',
  `ip` varchar(250) NOT NULL DEFAULT '' COMMENT '注册ip',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '注册地址',
  `device` varchar(255) NOT NULL DEFAULT '' COMMENT '登录设备',
  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='会员表';

SET FOREIGN_KEY_CHECKS = 1;
