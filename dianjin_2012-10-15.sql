# ************************************************************
# Sequel Pro SQL dump
# Version 3408
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.5.22)
# Database: dianjin
# Generation Time: 2012-10-15 09:29:12 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table fy_actionlog
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fy_actionlog`;

CREATE TABLE `fy_actionlog` (
  `id` int(11) NOT NULL DEFAULT '0' COMMENT 'id',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间',
  `action` varchar(200) NOT NULL DEFAULT '0' COMMENT '操作',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='操作日记表';



# Dump of table fy_admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fy_admin`;

CREATE TABLE `fy_admin` (
  `adminid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `adminname` varchar(40) NOT NULL DEFAULT '' COMMENT '管理员名字',
  `adminemail` varchar(40) NOT NULL DEFAULT '' COMMENT '管理员邮箱',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `lognum` int(30) NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `status` int(10) NOT NULL DEFAULT '1' COMMENT '用户状态',
  PRIMARY KEY (`adminid`),
  KEY `adminname` (`adminname`),
  KEY `adminemail` (`adminemail`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员';

LOCK TABLES `fy_admin` WRITE;
/*!40000 ALTER TABLE `fy_admin` DISABLE KEYS */;

INSERT INTO `fy_admin` (`adminid`, `adminname`, `adminemail`, `password`, `lognum`, `status`)
VALUES
	(8,'admin','admin@fyhqy.com','21232f297a57a5a743894a0e4a801fc3',0,1);

/*!40000 ALTER TABLE `fy_admin` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fy_category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fy_category`;

CREATE TABLE `fy_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `cname` varchar(40) NOT NULL DEFAULT '' COMMENT '分类名称',
  `cdesc` varchar(32) NOT NULL DEFAULT '' COMMENT '分类描述',
  PRIMARY KEY (`id`),
  KEY `cname` (`cname`),
  KEY `cdesc` (`cdesc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='分类表';



# Dump of table fy_message
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fy_message`;

CREATE TABLE `fy_message` (
  `mid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'MID',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `subject` text NOT NULL COMMENT '消息标题',
  `dateline` int(10) NOT NULL COMMENT '发表时间',
  `lastline` int(10) NOT NULL COMMENT '最后发表时间',
  `reply` text,
  PRIMARY KEY (`mid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='消息表';

LOCK TABLES `fy_message` WRITE;
/*!40000 ALTER TABLE `fy_message` DISABLE KEYS */;

INSERT INTO `fy_message` (`mid`, `uid`, `subject`, `dateline`, `lastline`, `reply`)
VALUES
	(1,1,'I want run pptp-vpn on my VPS.',1345188059,1345188059,'我十四号手术室时不时'),
	(2,1,'my vps is Offline',1345188059,1345188059,NULL),
	(3,1,'                        wwwwww',2012,2012,NULL),
	(4,1,'网站注册验证码错误啊',1350222157,1350222157,' 谢谢反馈！已经修复1'),
	(5,1,'$this->db->set(\'dateline\', $datetime);\n        $this->db->set(\'lastline\', $datetime);',1350222437,1350222437,NULL),
	(6,1,'msgbotton',1350222923,1350222923,NULL),
	(7,1,'',1350223344,1350223344,NULL),
	(8,1,'wwwwwwwwwwwwwww',1350223495,1350223495,NULL),
	(9,1,'wwwwwwwwwwwwwww',1350223510,1350223510,NULL);

/*!40000 ALTER TABLE `fy_message` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fy_message_list
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fy_message_list`;

CREATE TABLE `fy_message_list` (
  `lid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '消息列表id',
  `mid` int(11) NOT NULL DEFAULT '0' COMMENT '消息id',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `subject` text NOT NULL COMMENT '消息标题',
  `dateline` int(10) NOT NULL COMMENT '发表时间',
  `lastline` int(10) NOT NULL COMMENT '最后发表时间',
  PRIMARY KEY (`lid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='消息表列表';



# Dump of table fy_message_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fy_message_user`;

CREATE TABLE `fy_message_user` (
  `lid` int(11) NOT NULL AUTO_INCREMENT COMMENT '消息id',
  `mid` int(11) NOT NULL DEFAULT '0' COMMENT '消息id',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `num` int(10) NOT NULL COMMENT '消息个数',
  `is_new` tinyint(2) NOT NULL DEFAULT '0' COMMENT '是否新消息',
  `dateline` int(10) NOT NULL COMMENT '发表时间',
  `lastline` int(10) NOT NULL COMMENT '最后发表时间',
  PRIMARY KEY (`lid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='消息表用户';

LOCK TABLES `fy_message_user` WRITE;
/*!40000 ALTER TABLE `fy_message_user` DISABLE KEYS */;

INSERT INTO `fy_message_user` (`lid`, `mid`, `uid`, `num`, `is_new`, `dateline`, `lastline`)
VALUES
	(1,1,1,0,1,1345188059,1345188059),
	(2,2,1,1,1,1345188059,1345188059),
	(3,3,1,1,1,1350222226,1350222226),
	(4,4,1,1,1,1350222226,1350222226),
	(5,5,1,1,1,1350222437,1350222437),
	(6,6,1,1,1,1350222923,1350222923),
	(7,7,1,1,1,1350223344,1350223344),
	(8,8,1,1,1,1350223495,1350223495),
	(9,9,1,1,1,1350223510,1350223510);

/*!40000 ALTER TABLE `fy_message_user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fy_order_status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fy_order_status`;

CREATE TABLE `fy_order_status` (
  `order_status_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '状态',
  PRIMARY KEY (`order_status_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订单状态表';



# Dump of table fy_orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fy_orders`;

CREATE TABLE `fy_orders` (
  `order_id` int(18) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单号',
  `invoice_no` int(11) NOT NULL DEFAULT '0' COMMENT '发票id',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `payment_method` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT '付款标示',
  `payment_code` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT '付款标示',
  `total` decimal(15,4) NOT NULL DEFAULT '0.0000' COMMENT '总消费',
  `order_status_id` int(11) NOT NULL DEFAULT '0' COMMENT '订单状态',
  `ip` varchar(15) NOT NULL COMMENT 'IP',
  `user_agent` varchar(255) NOT NULL COMMENT '用户头信息',
  `date_added` varchar(40) NOT NULL COMMENT '订购时间',
  `date_expire` varchar(40) NOT NULL COMMENT '到期时间',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='方案名称';



# Dump of table fy_products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fy_products`;

CREATE TABLE `fy_products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `cid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `type` int(2) NOT NULL DEFAULT '0' COMMENT '发布类型',
  `name` varchar(200) NOT NULL DEFAULT '0' COMMENT '名字',
  `alias` varchar(200) NOT NULL DEFAULT '0' COMMENT '产地',
  `content` text COMMENT '说明',
  `dateline` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '时间',
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='发布表';

LOCK TABLES `fy_products` WRITE;
/*!40000 ALTER TABLE `fy_products` DISABLE KEYS */;

INSERT INTO `fy_products` (`id`, `uid`, `cid`, `type`, `name`, `alias`, `content`, `dateline`)
VALUES
	(8,1,1,1,'www','w','fdfsdfdsf',134444444),
	(2,1,1,1,'weree','ww','NULLdsfdsfdsfsdf',0),
	(3,1,0,0,'我们','0',NULL,0);

/*!40000 ALTER TABLE `fy_products` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fy_products_option
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fy_products_option`;

CREATE TABLE `fy_products_option` (
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '发布id',
  `size` varchar(200) NOT NULL DEFAULT '0' COMMENT '尺寸',
  `num` varchar(200) NOT NULL DEFAULT '0' COMMENT '数量',
  `price` varchar(200) NOT NULL DEFAULT '0' COMMENT '价格',
  PRIMARY KEY (`pid`),
  KEY `price` (`price`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='发布表属性';



# Dump of table fy_scheme
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fy_scheme`;

CREATE TABLE `fy_scheme` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `sname` varchar(40) NOT NULL DEFAULT '' COMMENT '方案名称',
  `sdesc` varchar(32) NOT NULL DEFAULT '' COMMENT '方案描述',
  `price` varchar(32) NOT NULL DEFAULT '' COMMENT '方案价格',
  PRIMARY KEY (`id`),
  KEY `sname` (`sname`),
  KEY `sdesc` (`sdesc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='方案表';



# Dump of table fy_sessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fy_sessions`;

CREATE TABLE `fy_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(50) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

LOCK TABLES `fy_sessions` WRITE;
/*!40000 ALTER TABLE `fy_sessions` DISABLE KEYS */;

INSERT INTO `fy_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`)
VALUES
	(X'3861653363336161373162643663633966633334343763383034373439633137',X'3132372E302E302E31',X'4D6F7A696C6C612F352E3020284D6163696E746F73683B20496E74656C204D6163204F5320582031305F385F312920417070',1350228104,X'613A343A7B733A393A22757365725F6E616D65223B733A363A2261646D696E31223B733A373A22757365725F6964223B733A313A2231223B733A373A22757365725F696E223B733A313A2231223B733A31353A22757365725F6C6173745F6C6F67696E223B733A343A2232303132223B7D');

/*!40000 ALTER TABLE `fy_sessions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table fy_user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fy_user`;

CREATE TABLE `fy_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(40) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `email` varchar(40) NOT NULL DEFAULT '' COMMENT '邮箱',
  `rtime` int(10) NOT NULL COMMENT '注册时间',
  `company` varchar(100) NOT NULL DEFAULT '' COMMENT '公司名字',
  `address` varchar(100) NOT NULL DEFAULT '' COMMENT '地址',
  `postcode` varchar(40) NOT NULL DEFAULT '' COMMENT '邮编',
  `person` varchar(40) NOT NULL DEFAULT '' COMMENT '联系人',
  `mobile` varchar(40) NOT NULL DEFAULT '' COMMENT '手机',
  `tel` varchar(40) NOT NULL DEFAULT '' COMMENT '电话',
  `fax` varchar(40) NOT NULL DEFAULT '' COMMENT '传真',
  `qq` varchar(40) NOT NULL DEFAULT '' COMMENT 'QQ',
  `pemail` varchar(40) NOT NULL DEFAULT '' COMMENT '联系邮箱',
  `website` varchar(40) NOT NULL DEFAULT '' COMMENT '网站',
  `companydesc` text NOT NULL COMMENT '公司介绍',
  `ip` varchar(40) NOT NULL DEFAULT '' COMMENT 'ip',
  `city` varchar(100) DEFAULT NULL,
  `last_login` int(10) DEFAULT NULL,
  `updated` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户';

LOCK TABLES `fy_user` WRITE;
/*!40000 ALTER TABLE `fy_user` DISABLE KEYS */;

INSERT INTO `fy_user` (`id`, `username`, `password`, `email`, `rtime`, `company`, `address`, `postcode`, `person`, `mobile`, `tel`, `fax`, `qq`, `pemail`, `website`, `companydesc`, `ip`, `city`, `last_login`, `updated`)
VALUES
	(1,'admin1','a374c7e6ef133ce24714b31ba486226d','admin@admin.com',0,'枫叶工资','北京市朝阳区万红路','10000','qulaijin','18618488638','18618488638','18618488638','','qulaijin@yahoo.com.cn','http://www.fyhqy.com','           啊数据库的萨克绝对是','','北京-朝阳-万红',1350228115,NULL),
	(2,'test','21232f297a57a5a743894a0e4a801fc3','i@llmfz.com',2012,'forherandforhim','北京','100000','qulaijin','18618488638','18618488638','18618488638','0','qulaijin@yahoo.com.cn','http://www.fyhqy.com','woshissjsj','',NULL,2012,2012),
	(3,'admin','e00cf25ad42683b3df678c61f42c6bda','admin@11.com',2012,'','','','','','','','','','','','',NULL,2012,2012),
	(4,'test1','a374c7e6ef133ce24714b31ba486226d','22@111.com',2012,'','','','','','','','','','','','',NULL,2012,2012),
	(5,'xiaosong','a374c7e6ef133ce24714b31ba486226d','songsong@sss.com',1350225080,'','','','','','','','','','','','',NULL,1350225080,1350225080);

/*!40000 ALTER TABLE `fy_user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
