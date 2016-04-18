-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2016 年 04 月 18 日 19:21
-- 服务器版本: 5.6.17
-- PHP 版本: 5.4.30

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- 数据库: `kitty_o2o`
--

-- --------------------------------------------------------

--
-- 表的结构 `kt_admin_user`
--

CREATE TABLE IF NOT EXISTS `kt_admin_user` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `username` varchar(20) NOT NULL COMMENT '用户名称',
  `password` varchar(60) NOT NULL COMMENT '密码',
  `salt` varchar(10) NOT NULL COMMENT '干扰码',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户状态1:正常 2被封禁',
  `auth_key` varchar(60) NOT NULL,
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `order_id` int(11) NOT NULL DEFAULT '0' COMMENT '排序ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员账户表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `kt_city`
--

CREATE TABLE IF NOT EXISTS `kt_city` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `zipcode` varchar(50) DEFAULT NULL,
  `province_id` int(10) NOT NULL DEFAULT '0' COMMENT '所属省份ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='城市表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `kt_district`
--

CREATE TABLE IF NOT EXISTS `kt_district` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `city_id` int(10) NOT NULL DEFAULT '0' COMMENT '所属城市ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='区县表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `kt_goods`
--

CREATE TABLE IF NOT EXISTS `kt_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT '商品名称',
  `store_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属商家ID',
  `sort_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品所属类别',
  `pic_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品图片ID',
  `price` float(7,1) NOT NULL DEFAULT '0.0' COMMENT '商品单价',
  `brief` varchar(500) DEFAULT NULL COMMENT '商品描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '商品状态1:待上架2:已上架3已下架',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `order_id` int(11) NOT NULL DEFAULT '0' COMMENT '排序ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `kt_goods_order`
--

CREATE TABLE IF NOT EXISTS `kt_goods_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(10) NOT NULL DEFAULT '0' COMMENT '该订单所属哪家店',
  `order_number` varchar(20) NOT NULL COMMENT '订单编号',
  `goods_info` text NOT NULL COMMENT '商品信息',
  `pay_type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '付款方式:1到店支付2:在线支付',
  `pay_time` int(11) NOT NULL DEFAULT '0' COMMENT '付款时间',
  `pay_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '付款状态1:待付款 2:已付款',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '订单状态1:未消费2:已消费',
  `member_id` int(11) NOT NULL DEFAULT '0' COMMENT '下单人的用户id',
  `consume_code` varchar(20) NOT NULL COMMENT '订单生成之后形成的消费码',
  `discount` float(7,1) NOT NULL DEFAULT '0.0' COMMENT '优惠价格',
  `total_price` float(7,1) unsigned NOT NULL DEFAULT '0.0',
  `consume_time` int(11) NOT NULL DEFAULT '0' COMMENT '消费时间',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `order_id` int(11) NOT NULL DEFAULT '0' COMMENT '排序ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `kt_goods_sort`
--

CREATE TABLE IF NOT EXISTS `kt_goods_sort` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '分类名称',
  `store_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属商家',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商品分类' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `kt_material`
--

CREATE TABLE IF NOT EXISTS `kt_material` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL COMMENT '图片名称',
  `host` varchar(100) NOT NULL COMMENT 'host',
  `filepath` varchar(100) NOT NULL COMMENT '原图的存储路径',
  `filename` varchar(40) NOT NULL COMMENT '文件名称',
  `type` varchar(30) NOT NULL COMMENT '图片类型',
  `imgwidth` smallint(4) NOT NULL DEFAULT '0' COMMENT '图片宽度',
  `imgheight` smallint(4) NOT NULL DEFAULT '0' COMMENT '图片高度',
  `filesize` int(10) NOT NULL COMMENT '图片大小',
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='附件表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `kt_members`
--

CREATE TABLE IF NOT EXISTS `kt_members` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `username` varchar(20) NOT NULL COMMENT '用户名(昵称)',
  `sex` varchar(1) NOT NULL DEFAULT 'M' COMMENT '性别:M男F女',
  `avatar_id` int(10) NOT NULL DEFAULT '0' COMMENT '头像ID',
  `password` varchar(60) NOT NULL COMMENT '密码',
  `salt` varchar(10) NOT NULL COMMENT '干扰码',
  `email` varchar(60) DEFAULT NULL COMMENT '邮箱',
  `phone` varchar(20) DEFAULT NULL COMMENT '手机号',
  `balance` float(7,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '账户金额',
  `points` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '积分',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户状态1:正常 2被封禁',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `order_id` int(11) NOT NULL DEFAULT '0' COMMENT '排序ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `kt_province`
--

CREATE TABLE IF NOT EXISTS `kt_province` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='省份表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `kt_store`
--

CREATE TABLE IF NOT EXISTS `kt_store` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商家ID',
  `name` varchar(50) NOT NULL COMMENT '店铺名称',
  `linkman` varchar(20) NOT NULL COMMENT '联系人',
  `phone` varchar(20) NOT NULL COMMENT '手机号',
  `address` varchar(200) NOT NULL COMMENT '店铺详细地址',
  `open_stime` time NOT NULL DEFAULT '00:00:00' COMMENT '营业开始时间',
  `open_etime` time NOT NULL DEFAULT '00:00:00' COMMENT '营业结束时间',
  `province_id` int(10) NOT NULL DEFAULT '0' COMMENT '所属省份ID',
  `city_id` int(10) NOT NULL DEFAULT '0' COMMENT '所属城市ID',
  `district_id` int(10) NOT NULL DEFAULT '0' COMMENT '所属区县的ID',
  `longitude` decimal(11,8) NOT NULL DEFAULT '0.00000000' COMMENT '经度',
  `latitude` decimal(10,8) NOT NULL DEFAULT '0.00000000' COMMENT '纬度',
  `brief` varchar(500) DEFAULT NULL COMMENT '店铺简介',
  `logo_id` int(10) NOT NULL DEFAULT '0' COMMENT '门店Logo图片ID',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '商家状态1:待审核2:已审核3:被打回',
  `poi_id` int(11) NOT NULL DEFAULT '0' COMMENT '在lbs云上的id',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `order_id` int(11) NOT NULL DEFAULT '0' COMMENT '排序ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='商家表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `kt_store_account`
--

CREATE TABLE IF NOT EXISTS `kt_store_account` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `store_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属商家',
  `account_name` varchar(20) NOT NULL COMMENT '账户名称',
  `password` varchar(60) NOT NULL COMMENT '密码',
  `salt` varchar(10) NOT NULL COMMENT '干扰码',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户状态1:正常 2被封禁',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `order_id` int(11) NOT NULL DEFAULT '0' COMMENT '排序ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_name` (`account_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商家账户表' AUTO_INCREMENT=1 ;
