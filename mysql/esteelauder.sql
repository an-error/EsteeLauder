/*
Navicat MySQL Data Transfer

Source Server         : Nars
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : esteelauder

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2018-05-09 18:56:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for address
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL COMMENT 'users表中的id',
  `name` varchar(20) NOT NULL COMMENT 'uid用户的收货人名字、电话、地址',
  `phone` char(11) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `firstChoice` int(11) DEFAULT NULL,
  `postalcode` char(10) DEFAULT NULL,
  PRIMARY KEY (`id`,`uid`),
  KEY `uid` (`uid`),
  CONSTRAINT `address_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of address
-- ----------------------------
INSERT INTO `address` VALUES ('7', '3', '1', '13728113331', '上海市上海市徐汇区', '1', '222222');
INSERT INTO `address` VALUES ('8', '3', '2', '13728113331', '上海市上海市长宁区', '1', '213213');
INSERT INTO `address` VALUES ('9', '7', 'LC', '13728113338', '河北省唐山市遵化市', '1', '213434');
INSERT INTO `address` VALUES ('10', '9', '发', '13728113331', '天津市天津市红桥区', '1', '3463544');

-- ----------------------------
-- Table structure for brand
-- ----------------------------
DROP TABLE IF EXISTS `brand`;
CREATE TABLE `brand` (
  `brandName` varchar(20) NOT NULL,
  `brandImg` varchar(200) NOT NULL,
  PRIMARY KEY (`brandName`),
  KEY `brandName` (`brandName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of brand
-- ----------------------------
INSERT INTO `brand` VALUES ('Bobbi Brown', '‪D:\\AppServ\\www\\EsteeLauder\\image\\d2e65ff7825d0ed0528043b4e253a323.jpg');
INSERT INTO `brand` VALUES ('EsteeLauder', 'D:\\AppServ\\www\\EsteeLauder\\image\\2a61e19fe7f467ce79a11c06e044e917.jpg');
INSERT INTO `brand` VALUES ('her', 'D:\\AppServ\\www\\EsteeLauder\\image\\152543743228711.jpg');
INSERT INTO `brand` VALUES ('Tom Ford', 'D:\\AppServ\\www\\EsteeLauder\\image\\1fc0add8625c515b72d91b46b6b36e41.jpg');

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `minor` varchar(60) NOT NULL,
  `major` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`minor`),
  KEY `major` (`major`),
  KEY `minor` (`minor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('唇彩', '唇部');
INSERT INTO `categories` VALUES ('唇线笔', '唇部');
INSERT INTO `categories` VALUES ('唇膏', '唇部');
INSERT INTO `categories` VALUES ('唇釉', '唇部');
INSERT INTO `categories` VALUES ('眉笔', '眼部');
INSERT INTO `categories` VALUES ('眼影', '眼部');
INSERT INTO `categories` VALUES ('眼线笔', '眼部');
INSERT INTO `categories` VALUES ('睫毛膏', '眼部');
INSERT INTO `categories` VALUES ('妆前乳', '面部');
INSERT INTO `categories` VALUES ('气垫', '面部');
INSERT INTO `categories` VALUES ('粉底液', '面部');
INSERT INTO `categories` VALUES ('粉饼', '面部');
INSERT INTO `categories` VALUES ('腮红', '面部');
INSERT INTO `categories` VALUES ('遮瑕膏', '面部');

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderID` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL,
  `sku` varchar(200) NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `goodsScore` int(11) NOT NULL,
  `serviceScore` int(11) NOT NULL,
  `timeScore` int(11) NOT NULL,
  `content` varchar(200) DEFAULT NULL,
  `img0` varchar(200) DEFAULT NULL,
  `img1` varchar(200) DEFAULT NULL,
  `img2` varchar(200) DEFAULT NULL,
  `img3` varchar(200) DEFAULT NULL,
  `img4` varchar(200) DEFAULT NULL,
  `isShow` int(11) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isDelete` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comment_ibfk_1` (`orderID`),
  KEY `comment_ibfk_2` (`pid`),
  KEY `comment_ibfk_3` (`sku`),
  KEY `comment_ibfk_4` (`uid`),
  CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `production` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`sku`) REFERENCES `productionattr` (`sku`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comment_ibfk_4` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES ('19', '85', '82', 'Crescent White 晶透沁白气垫修颜乳套装_#eab990', '3', '5', '5', '5', '默认好评', '../img/TB2YY5xirSYBuNjSspfXXcZCpXa_!!0-rate.jpg_400x400.jpg', '', '', '', '', '1', '2018-04-12 14:48:01', null);
INSERT INTO `comment` VALUES ('21', '32', '37', 'DW CUSHION BB 12GM/.42OZ 持妆无瑕气垫粉霜 SPF30+/PA+++_#cc955c', '3', '5', '5', '5', '默认好评', '../img/TB2RA0DjACWBuNjy0FaXXXUlXXa_!!0-rate.jpg_400x400.jpg', '', '', '', '', '1', '2018-04-12 14:48:07', null);
INSERT INTO `comment` VALUES ('22', '31', '37', 'DW CUSHION BB 12GM/.42OZ 持妆无瑕气垫粉霜 SPF30+/PA+++_#cc955c', '3', '5', '5', '5', '默认好评', '', '', '', '', '', '1', '2018-04-12 14:48:10', null);
INSERT INTO `comment` VALUES ('23', '87', '41', 'Envy Blush 花漾倾慕腮红_#d18b5e', '3', '5', '5', '5', '默认好评', '../img/TB2lwQujL2H8KJjy1zkXXXr7pXa_!!0-rate.jpg_400x400.jpg', '', '', '', '', '1', '2018-04-12 14:48:13', null);
INSERT INTO `comment` VALUES ('24', '47', '37', 'DW CUSHION BB 12GM/.42OZ 持妆无瑕气垫粉霜 SPF30+/PA+++_#cc955c', '3', '5', '5', '5', '默认好评', '', '', '', '', '', null, '2018-05-03 18:18:10', '1');

-- ----------------------------
-- Table structure for manager
-- ----------------------------
DROP TABLE IF EXISTS `manager`;
CREATE TABLE `manager` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '该id为manager_detail表中的id',
  `name` varchar(20) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `password` varchar(150) NOT NULL,
  `IDCard` char(18) NOT NULL,
  `phone` char(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manager
-- ----------------------------
INSERT INTO `manager` VALUES ('14', '花盼夏', '女', '123', '350725197708243348', '13734552223', '347658943@qq.com');
INSERT INTO `manager` VALUES ('17', '庄爽琳', '女', '11', '130828197602167686', '13798653567', '34456453@qq.com');
INSERT INTO `manager` VALUES ('18', '谢又夏', '女', '123', '510112199011011402', '13725443361', '456345785@qq.com');
INSERT INTO `manager` VALUES ('19', '柏从冬', '女', '123', '350102197607086868', '13756445553', '456345245@qq.com');
INSERT INTO `manager` VALUES ('20', '和雯', '女', '123', '34170119790217214X', '13765786544', '345246874@qq.com');
INSERT INTO `manager` VALUES ('21', '鲍浩恒', '男', '123', '441301199306111333', '13756445567', '456324785@qq.com');
INSERT INTO `manager` VALUES ('22', '席鸿', '男', '123', '152221198011184399', '13765676568', '256746853@qq.com');
INSERT INTO `manager` VALUES ('23', '徐州', '男', '123', '450311198601047476', '13765443336', '325687564@qq.com');
INSERT INTO `manager` VALUES ('24', '邓靖', '女', '11', '210113198410214451', '13754665554', '957678543@qq.com');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单号不可删除，用户只可以在前台“删除”订单，故一个订单可以确定一个用户',
  `uid` int(10) unsigned NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL,
  `isPay` varchar(10) NOT NULL,
  `addressID` int(10) unsigned NOT NULL DEFAULT '1' COMMENT '收货地址默认第一个',
  `text` varchar(200) DEFAULT NULL COMMENT '备注',
  `total` int(11) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `fail` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `addressID` (`addressID`),
  KEY `order_ibfk_1` (`uid`),
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('31', '3', '2018-04-12 09:15:46', '已评价', 'true', '7', '', '4800', '2，13728113331，上海市上海市长宁区', '0');
INSERT INTO `order` VALUES ('32', '3', '2018-04-12 09:14:21', '已评价', 'true', '7', '', '400', '2，13728113331，上海市上海市长宁区', '0');
INSERT INTO `order` VALUES ('47', '3', '2018-05-03 18:15:37', '已评价', 'true', '7', '', '2040', '2，13728113331，上海市上海市长宁区', '0');
INSERT INTO `order` VALUES ('49', '3', '2018-04-08 12:47:33', '已签收', 'true', '7', '', '450', '2，13728113331，上海市上海市长宁区', '0');
INSERT INTO `order` VALUES ('50', '3', '2018-04-14 13:17:05', '交易失败', 'true', '7', '', '1770', '2，13728113331，上海市上海市长宁区', '1');
INSERT INTO `order` VALUES ('60', '3', '2018-04-24 00:03:40', '交易失败', 'true', '7', '', '480', '2，13728113331，上海市上海市长宁区', '1');
INSERT INTO `order` VALUES ('63', '3', '2018-05-05 00:09:08', '已签收', 'true', '8', '', '1350', '2，13728113331，上海市上海市长宁区', '0');
INSERT INTO `order` VALUES ('65', '3', '2018-04-23 16:48:58', '交易失败', 'true', '8', '', '480', '2，13728113331，上海市上海市长宁区', '1');
INSERT INTO `order` VALUES ('66', '3', '2018-04-12 08:56:43', '已签收', 'true', '8', '', '430', '2，13728113331，上海市上海市长宁区', '0');
INSERT INTO `order` VALUES ('67', '3', '2018-05-05 00:09:19', '已签收', 'true', '7', '', '480', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('68', '3', '2018-04-11 20:12:31', '已发货', 'true', '7', '', '400', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('69', '3', '2018-04-14 13:27:05', '交易失败', 'true', '8', '', '350', '2，13728113331，上海市上海市长宁区', '1');
INSERT INTO `order` VALUES ('73', '3', '2018-04-11 20:12:37', '已发货', 'true', '7', '', '1140', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('76', '3', '2018-04-24 00:20:43', '已签收', 'true', '7', '', '450', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('77', '3', '2018-05-08 10:35:42', '已发货', 'true', '7', '', '300', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('79', '3', '2018-05-08 10:35:50', '已发货', 'true', '8', '', '1680', '2，13728113331，上海市上海市长宁区', '0');
INSERT INTO `order` VALUES ('81', '3', '2018-05-04 23:22:58', '待发货', 'true', '7', '', '1600', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('82', '3', '2018-04-11 20:25:53', '已发货', 'true', '7', '', '280', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('83', '3', '2018-04-11 20:25:19', '待发货', 'true', '8', '', '450', '2，13728113331，上海市上海市长宁区', '0');
INSERT INTO `order` VALUES ('85', '3', '2018-04-12 08:58:32', '已评价', 'true', '8', '', '520', '2，13728113331，上海市上海市长宁区', '0');
INSERT INTO `order` VALUES ('86', '3', '2018-04-12 10:06:08', '已签收', 'true', '7', '', '1390', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('87', '3', '2018-04-12 10:44:46', '已评价', 'true', '7', '', '3130', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('88', '3', '2018-04-13 19:03:52', '待发货', 'true', '7', '', '450', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('90', '3', '2018-04-18 22:21:59', '待发货', 'true', '7', '', '1440', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('91', '3', '2018-04-19 13:46:35', '待发货', 'true', '7', '', '1150', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('92', '3', '2018-04-19 13:49:20', '待发货', 'true', '8', '', '420', '2，13728113331，上海市上海市长宁区', '0');
INSERT INTO `order` VALUES ('93', '3', '2018-04-19 14:15:32', '待发货', 'true', '8', '', '770', '2，13728113331，上海市上海市长宁区', '0');
INSERT INTO `order` VALUES ('94', '3', '2018-04-19 14:21:32', '待发货', 'true', '7', '', '580', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('95', '3', '2018-04-19 14:45:07', '待发货', 'true', '7', '', '250', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('96', '3', '2018-04-19 14:45:25', '待发货', 'true', '7', '', '270', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('97', '3', '2018-04-24 00:20:53', '已签收', 'true', '7', '', '423', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('99', '7', '2018-04-20 08:59:37', '待发货', 'true', '9', '', '520', 'LC，13728113338，河北省唐山市遵化市', '0');
INSERT INTO `order` VALUES ('100', '3', '2018-04-24 00:21:05', '已签收', 'true', '7', '', '385', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('101', '3', '2018-04-24 00:20:07', '已发货', 'true', '7', '', '520', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('102', '3', '2018-04-24 00:20:31', '已签收', 'true', '7', '', '270', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('103', '3', '2018-04-25 08:38:50', '待发货', 'true', '7', '', '520', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('104', '3', '2018-04-25 14:57:43', '待发货', 'true', '7', '', '250', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('106', '3', '2018-04-28 20:06:11', '待发货', 'true', '7', '', '350', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('107', '3', '2018-04-28 20:07:32', '待发货', 'true', '7', '', '250', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('108', '3', '2018-04-28 20:09:15', '待发货', 'true', '7', '', '250', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('109', '3', '2018-04-28 20:17:47', '待发货', 'true', '8', '', '520', '2，13728113331，上海市上海市长宁区', '0');
INSERT INTO `order` VALUES ('112', '3', '2018-05-04 22:53:23', '待发货', 'true', '10', '', '9120', 'j，13729114432，广东省东莞市市寮步镇', '0');
INSERT INTO `order` VALUES ('113', '3', '2018-05-08 21:41:15', '交易失败', 'true', '8', '', '420', '2，13728113331，上海市上海市长宁区', '1');
INSERT INTO `order` VALUES ('114', '3', '2018-05-08 21:38:11', '已发货', 'true', '7', '', '520', '1，13728113331，上海市上海市徐汇区', '0');
INSERT INTO `order` VALUES ('115', '9', '2018-05-09 15:43:44', '待发货', 'true', '10', '', '840', '发，13728113331，天津市天津市红桥区', '0');

-- ----------------------------
-- Table structure for ordergoods
-- ----------------------------
DROP TABLE IF EXISTS `ordergoods`;
CREATE TABLE `ordergoods` (
  `id` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL,
  `sku` varchar(200) NOT NULL,
  `quantity` int(10) unsigned DEFAULT '1' COMMENT '默认1',
  PRIMARY KEY (`id`,`pid`,`sku`),
  KEY `ordergoods_ibfk_2` (`sku`),
  KEY `shoppingcard_ibfk_1` (`pid`),
  CONSTRAINT `ordergoods_ibfk_2` FOREIGN KEY (`sku`) REFERENCES `productionattr` (`sku`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ordergoods_ibfk_3` FOREIGN KEY (`id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `shoppingcard_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `production` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ordergoods
-- ----------------------------
INSERT INTO `ordergoods` VALUES ('31', '37', 'DW CUSHION BB 12GM/.42OZ 持妆无瑕气垫粉霜 SPF30+/PA+++_#cc955c', '1');
INSERT INTO `ordergoods` VALUES ('31', '41', 'Envy Blush 花漾倾慕腮红_#b15457', '1');
INSERT INTO `ordergoods` VALUES ('31', '41', 'Envy Blush 花漾倾慕腮红_#d18b5e', '1');
INSERT INTO `ordergoods` VALUES ('32', '37', 'DW CUSHION BB 12GM/.42OZ 持妆无瑕气垫粉霜 SPF30+/PA+++_#cc955c', '1');
INSERT INTO `ordergoods` VALUES ('47', '37', 'DW CUSHION BB 12GM/.42OZ 持妆无瑕气垫粉霜 SPF30+/PA+++_#cc955c', '1');
INSERT INTO `ordergoods` VALUES ('47', '37', 'DW CUSHION BB 12GM/.42OZ 持妆无瑕气垫粉霜 SPF30+/PA+++_#dda770', '3');
INSERT INTO `ordergoods` VALUES ('49', '41', 'Envy Blush 花漾倾慕腮红_#b15457', '1');
INSERT INTO `ordergoods` VALUES ('50', '41', 'Envy Blush 花漾倾慕腮红_#e98ca7', '3');
INSERT INTO `ordergoods` VALUES ('60', '40', 'Reviving Oil Lip Tint 真我光采轻透润唇蜜_#ffffff', '1');
INSERT INTO `ordergoods` VALUES ('63', '40', 'Reviving Oil Lip Tint 真我光采轻透润唇蜜_#ffffff', '1');
INSERT INTO `ordergoods` VALUES ('65', '40', 'Reviving Oil Lip Tint 真我光采轻透润唇蜜_#ffffff', '1');
INSERT INTO `ordergoods` VALUES ('66', '45', 'Crescent White 晶透沁白焕采粉饼SPF 25/PA+++_#e2ccb3', '1');
INSERT INTO `ordergoods` VALUES ('67', '40', 'Reviving Oil Lip Tint 真我光采轻透润唇蜜_#ffffff', '1');
INSERT INTO `ordergoods` VALUES ('68', '37', 'DW CUSHION BB 12GM/.42OZ 持妆无瑕气垫粉霜 SPF30+/PA+++_#cc955c', '1');
INSERT INTO `ordergoods` VALUES ('69', '44', 'Double Wear 无痕持妆遮瑕蜜_#ddb393', '1');
INSERT INTO `ordergoods` VALUES ('73', '37', 'DW CUSHION BB 12GM/.42OZ 持妆无瑕气垫粉霜 SPF30+/PA+++_#cc955c', '1');
INSERT INTO `ordergoods` VALUES ('73', '44', 'Double Wear 无痕持妆遮瑕蜜_#e9c59d', '1');
INSERT INTO `ordergoods` VALUES ('76', '41', 'Envy Blush 花漾倾慕腮红_#b15457', '1');
INSERT INTO `ordergoods` VALUES ('77', '46', 'Pure Color Envy 倾慕单色眼影_#a89aa0', '1');
INSERT INTO `ordergoods` VALUES ('79', '37', 'DW CUSHION BB 12GM/.42OZ 持妆无瑕气垫粉霜 SPF30+/PA+++_#dda770', '2');
INSERT INTO `ordergoods` VALUES ('79', '37', 'DW CUSHION BB 12GM/.42OZ 持妆无瑕气垫粉霜 SPF30+/PA+++_#e5ad74', '1');
INSERT INTO `ordergoods` VALUES ('79', '37', 'DW CUSHION BB 12GM/.42OZ 持妆无瑕气垫粉霜 SPF30+/PA+++_#ecb882', '1');
INSERT INTO `ordergoods` VALUES ('81', '70', 'Envy Metallic 倾慕哑光唇膏金属系列_#3a4552', '4');
INSERT INTO `ordergoods` VALUES ('81', '70', 'Envy Metallic 倾慕哑光唇膏金属系列_#6e2c2c', '1');
INSERT INTO `ordergoods` VALUES ('81', '70', 'Envy Metallic 倾慕哑光唇膏金属系列_#a42c2a', '1');
INSERT INTO `ordergoods` VALUES ('82', '46', 'Pure Color Envy 倾慕单色眼影_#9087b6', '1');
INSERT INTO `ordergoods` VALUES ('83', '87', 'Envy Blush Gradation 花漾倾慕渐变腮红_#ca6c66', '1');
INSERT INTO `ordergoods` VALUES ('85', '82', 'Crescent White 晶透沁白气垫修颜乳套装_#eab990', '1');
INSERT INTO `ordergoods` VALUES ('86', '41', 'Envy Blush 花漾倾慕腮红_#b15457', '1');
INSERT INTO `ordergoods` VALUES ('86', '82', 'Crescent White 晶透沁白气垫修颜乳套装_#eab990', '1');
INSERT INTO `ordergoods` VALUES ('87', '41', 'Envy Blush 花漾倾慕腮红_#b15457', '6');
INSERT INTO `ordergoods` VALUES ('87', '41', 'Envy Blush 花漾倾慕腮红_#d18b5e', '1');
INSERT INTO `ordergoods` VALUES ('88', '85', 'Double Wear 润泽亮采修颜乳SPF 30/PA+++_#d69060', '1');
INSERT INTO `ordergoods` VALUES ('90', '46', 'Pure Color Envy 倾慕单色眼影_#9087b6', '1');
INSERT INTO `ordergoods` VALUES ('90', '46', 'Pure Color Envy 倾慕单色眼影_#d1c8e1', '4');
INSERT INTO `ordergoods` VALUES ('91', '38', 'Crescent White 晶透沁白修颜妆前乳SPF30/PA+++_#ffffff', '2');
INSERT INTO `ordergoods` VALUES ('92', '39', 'Genuine Glow Priming Moisture Balm 真我光采保湿饰底乳_#ffffff', '1');
INSERT INTO `ordergoods` VALUES ('93', '38', 'Crescent White 晶透沁白修颜妆前乳SPF30/PA+++_#ffffff', '1');
INSERT INTO `ordergoods` VALUES ('94', '46', 'Pure Color Envy 倾慕单色眼影_#a5888d', '1');
INSERT INTO `ordergoods` VALUES ('94', '46', 'Pure Color Envy 倾慕单色眼影_#b7928e', '1');
INSERT INTO `ordergoods` VALUES ('95', '66', 'Black Brown 持妆塑形眉彩笔 -SOFT BROWN_#ffffff', '1');
INSERT INTO `ordergoods` VALUES ('96', '70', 'Envy Metallic 倾慕哑光唇膏金属系列_#b21e2e', '1');
INSERT INTO `ordergoods` VALUES ('97', '53', 'Pure Color 花漾琉光三色眼影 -CAMO CHROME_#ffffff', '1');
INSERT INTO `ordergoods` VALUES ('97', '54', 'Pure Color 花漾琉光三色眼影 -STERLINE PLUMS_#ffffff', '1');
INSERT INTO `ordergoods` VALUES ('99', '81', 'Double Wear Cushion Set 持妆无瑕气垫粉霜套装_#e5ad74', '1');
INSERT INTO `ordergoods` VALUES ('100', '89', 'Pure Color 花漾腮红_#d09f8a', '1');
INSERT INTO `ordergoods` VALUES ('101', '49', 'Pure Color 花漾魅型五色眼影盘 -REBEL METAL_#ffffff', '1');
INSERT INTO `ordergoods` VALUES ('102', '69', 'Envy Velvet 倾慕哑光唇膏丝绒系列_#c71e3e', '1');
INSERT INTO `ordergoods` VALUES ('103', '81', 'Double Wear Cushion Set 持妆无瑕气垫粉霜套装_#e5ad74', '1');
INSERT INTO `ordergoods` VALUES ('104', '73', 'Envy Sculpting Gloss 花漾倾慕唇彩_#f03453', '1');
INSERT INTO `ordergoods` VALUES ('106', '44', 'Double Wear 无痕持妆遮瑕蜜_#ddb393', '1');
INSERT INTO `ordergoods` VALUES ('107', '66', 'Black Brown 持妆塑形眉彩笔 -SOFT BROWN_#ffffff', '1');
INSERT INTO `ordergoods` VALUES ('108', '73', 'Envy Sculpting Gloss 花漾倾慕唇彩_#f03453', '1');
INSERT INTO `ordergoods` VALUES ('109', '79', 'Envy Sculpting Lacquer 花漾倾慕唇釉_#cd0b1e', '2');
INSERT INTO `ordergoods` VALUES ('112', '84', 'Double Wear Cushion 持妆无瑕气垫粉霜高定版_#e5ad74', '5');
INSERT INTO `ordergoods` VALUES ('113', '39', 'Genuine Glow Priming Moisture Balm 真我光采保湿饰底乳_#ffffff', '1');
INSERT INTO `ordergoods` VALUES ('114', '82', 'Crescent White 晶透沁白气垫修颜乳套装_#dea677', '1');
INSERT INTO `ordergoods` VALUES ('115', '39', 'Genuine Glow Priming Moisture Balm 真我光采保湿饰底乳_#ffffff', '1');
INSERT INTO `ordergoods` VALUES ('115', '84', 'Double Wear Cushion 持妆无瑕气垫粉霜高定版_#ecb882', '1');

-- ----------------------------
-- Table structure for production
-- ----------------------------
DROP TABLE IF EXISTS `production`;
CREATE TABLE `production` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '产品编号',
  `name` varchar(60) DEFAULT NULL,
  `categories` varchar(60) NOT NULL COMMENT '分类，如眼影、底妆',
  `brand` varchar(20) DEFAULT NULL COMMENT '品牌，如雅诗兰黛、TF',
  `size` varchar(40) DEFAULT NULL,
  `img` varchar(200) NOT NULL COMMENT '产品图片，以下img都是该产品的图片',
  `img0` varchar(200) DEFAULT NULL,
  `img1` varchar(200) DEFAULT NULL,
  `img2` varchar(200) DEFAULT NULL,
  `img3` varchar(200) DEFAULT NULL,
  `text` varchar(1000) DEFAULT NULL,
  `isDelete` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `production_ibfk_3` (`brand`),
  KEY `production_ibfk_4` (`categories`),
  CONSTRAINT `production_ibfk_3` FOREIGN KEY (`brand`) REFERENCES `brand` (`brandName`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `production_ibfk_4` FOREIGN KEY (`categories`) REFERENCES `categories` (`minor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of production
-- ----------------------------
INSERT INTO `production` VALUES ('27', 'Double Wear 持妆粉底液 SPF10/PA++', '粉底液', 'her', '30ml', '../img/1.jpg', '../img/1.1.jpg', '', '', '', 'Double Wear 持妆粉底液，油皮亲妈，不脱妆，更持久。\r\n\r\n\r\n·持久着妆：持久不脱粉的高能持妆力，油汗交加时底妆依然稳稳在线。\r\n·持久控油：中和油脂分泌，令妆容保持自然光泽。\r\n·持久水润：满蕴滋润精华，锁住肌肤水分，妆容持久盈润。\r\n·持久遮瑕：一抹遮瑕，毛孔、痘印、红血丝悄然隐褪。', '1');
INSERT INTO `production` VALUES ('36', 'Futurist 沁水粉底液 SPF15/PA++', '粉底液', 'her', '30ml', '../img/2.jpg', '../img/2.1.jpg', '', '', '', '明星“水粉底”，润贴水亮\"朝露妆\"\r\n明星\"水粉底\"全新升级。水润亲服力被肌肤温度触发，柔滑润贴。满满水分包裹在薄薄水光中，亮泽光感澎盈外透。\r\n\r\n\r\n功效：\r\n• 富含83%精华水+巴尔干半岛\"复活草\"精粹，凝润一滴，深锁水分，如保湿精华般持续沁养，妆容时刻如沐朝露。\r\n• 自带反光板，肌肤如同“水丝绸”。\r\n• 空气感粉雾质地，沁融入肤，持现细致无痕。\r\n• 干燥环境服帖不起皮。\r\n\r\n\r\n使用方法：\r\n第1步：使用前，将护肤品在掌心温热，用指尖蘸取涂抹\r\n第2步：取适量粉底液，于苹果肌、额头处由内而外轻柔打圈，眼周、鼻翼、嘴角周围细致涂抹均匀\r\n第3步：需要特别遮瑕的部位，可以轻轻点压遮盖瑕疵\r\n* 妆前搭配小棕瓶精华使用，妆感更加水润，服帖。', null);
INSERT INTO `production` VALUES ('37', 'DW CUSHION BB 12GM/.42OZ 持妆无瑕气垫粉霜 SPF30+/PA+++', '气垫', 'her', '12g', '../img/3.jpg', '../img/3.1.jpg', '', '', '', '*持妆无瑕气垫粉霜*\r\n光芒不断电，无瑕一整天\r\n\r\n\r\n产品详情：\r\n1. 持久持妆：防水、防汗，持久不脱妆\r\n2. 匀色遮瑕：隐匿毛孔和瑕疵\r\n3. 润泽水亮：30%植物精华水，水亮润泽、持久保湿\r\n4. 防晒防护：SPF30 PA+++\r\n\r\n\r\n使用方法：\r\n1.取粉：轻轻沾\r\n三个手指套住粉扑，取粉时只需要轻轻沾一下即可。不要太用力、反复沾取\r\n2.上妆：轻轻拍\r\n从脸颊开始，轻轻拍在肌肤上，拍出无瑕水亮度的肌肤', null);
INSERT INTO `production` VALUES ('38', 'Crescent White 晶透沁白修颜妆前乳SPF30/PA+++', '妆前乳', 'her', '30ml', '../img/4.jpg', '', '', '', '', 'Crescent White 晶透沁白修颜妆前乳，赋活肌肤匀、白、净、润、透。\r\n\r\n蕴含薰衣草调色成分，独特的紫色色调能立即中和亚洲女性普遍偏黄、暗沉的肤色，让肌肤明亮、白皙、均匀。\r\n\r\n减少能导致黑斑与色素沉淀的损伤，包括污染与UV曝晒，SPF30/PA+++。\r\n\r\n饱含玻尿酸及美白精萃，肌肤白皙，水润，平滑，隐匿毛孔，持妆防护。\r\n使用方法\r\n\r\n每日在日常护肤之后、正式上妆之前使用。取适量均匀涂抹在需要上妆的部位。\r\n', null);
INSERT INTO `production` VALUES ('39', 'Genuine Glow Priming Moisture Balm 真我光采保湿饰底乳', '妆前乳', 'her', '30ml', '../img/5.jpg', '', '', '', '', '真我光采保湿饰底乳，质地轻盈不黏腻，拥有滋润，修护，和打底的三重功效。创新的多效滋润配方，有效地提升肌肤质感，赶走肌肤暗沉与不均，隐形毛孔，轻松一步肌肤变得清透无瑕，散发自然真我光泽。\r\n改善肌肤质感\r\n清爽保湿的质地，瞬时还原细腻柔滑的梦想肤质，使后续上妆效果更出众，保持妆容整日清新。\r\n均匀并提亮肤色\r\n焕发肌肤内在柔润透亮的自然光泽，整日绽放健康红润的好气色。\r\n隐形毛孔\r\n此款无油滋润型乳霜可隐形毛孔，平衡油光，使肌肤匀净透亮。\r\n使用方法\r\n\r\n早晚涂抹于清洁后的肌肤上，后续配合使用其他真我光采系列产品。\r\n', null);
INSERT INTO `production` VALUES ('40', 'Reviving Oil Lip Tint 真我光采轻透润唇蜜', '唇彩', 'her', '2.7ml', '../img/6.jpg', '', '', '', '', '真我光彩轻透润唇蜜，萃取水果的天然精油,融入保湿精粹，丰盈柔润双唇的同时轻盈不粘腻。\r\n清透可人的粉色，自然融入不同唇色，营造出不同的自然玫瑰色光泽，你从此刻独一无二。\r\n香草搭配薄荷的清新香气，使双唇整日沉醉清新体验。\r\n使用方法\r\n\r\n轻旋底部按钮，挤出适量膏体涂抹于唇部。\r\n功效\r\n\r\n丰盈柔润双唇，打造独一无二的自然玫瑰色光泽。\r\n肌肤类型\r\n\r\n适合所有肌肤类型\r\n', null);
INSERT INTO `production` VALUES ('41', 'Envy Blush 花漾倾慕腮红', '腮红', 'her', '7g', '../img/7.jpg', '../img/7.1.jpg', '', '', '', '无论是轻扫双颊，打造健康年轻红晕，还是勾勒面部轮廓，突出性感立体线条，花漾倾慕腮红卓效配方助你拥有心仪的颧骨轮廓，适用于各种肤色。专研 绝对显色科技™ 将色彩浓缩包裹于似晶体般的涂层中，实现最佳色彩效果。升级配方蕴含蔓越莓和枸杞提取物等抗氧化复合物，利用 \"流彩光学\"科技由内而外滋养提升面部光泽度和立体感。奢华粉质，轻若无感，肌肤宛若裹于轻纱之中，香腮透红，娇美动人。\r\n沿承了经典的深蓝色精致小盒，配合专门研发的轮廓刷，精准上妆，自然贴合，色泽饱满，令肌肤熠熠生辉，焕发动人健康光彩。\r\n使用方法\r\n\r\n蘸取适量，在颧骨、鼻侧等部位轻轻涂抹即可\r\n', null);
INSERT INTO `production` VALUES ('44', 'Double Wear 无痕持妆遮瑕蜜', '遮瑕膏', 'her', '7ml', '../img/8.jpg', '../img/8.1.jpg', '', '', '', '\r\n粉底液后一步使用，局部遮瑕，打造无瑕妆效。富含矿物质的轻盈乳霜质地，15小时持妆不干燥。耐湿性配方，抗水抗汗，持妆整日无瑕。\r\n使用方法\r\n\r\n选择和粉底液相同色号用于脸部遮瑕\r\n或者浅一色号用于眼部提亮\r\n用指腹涂抹于需要遮瑕或提亮部位\r\n配合5号遮瑕刷使用，效果更显著\r\n功效\r\n\r\n轻盈，无痕，15小时持久无瑕。\r\n妆效\r\n\r\n遮瑕\r\n', null);
INSERT INTO `production` VALUES ('45', 'Crescent White 晶透沁白焕采粉饼SPF 25/PA+++', '粉饼', 'her', '10g', '../img/9.jpg', '', '', '', '', '晶透沁白粉饼SPF25/PA+++\r\n新月光采妆容，一抹拥有！\r\n细腻透白 轻薄贴合 轻盈防护\r\n\r\n \r\n功效：\r\n• 细腻透白：沁白复合成分——法国黑藻，黑糖蜜，黄岑苷，有效缓解黑色素沉积。配合细腻粉质，上妆顺滑、贴合，修饰毛孔与瑕疵，肌肤由内而外透出白皙无暇。\r\n• 轻盈防护：SPF25/PA+++，高倍防护多重紫外线和污染造成的肌肤问题。持久控油保湿，妆容整日水润光采，轻盈无暇。\r\n\r\n\r\n使用手法：\r\n1.用粉扑分多次蘸取，自然均匀于脸部\r\n2.沿着肌肤纹理，以按压为主，覆盖整个面庞\r\n*本产品仅为粉芯，粉饼盒另拍\r\n功效\r\n\r\n细腻透白 轻盈防护\r\n针对\r\n\r\n暗沉、瑕疵肌肤。渴望晶透沁白。\r\n主要科技/成分:\r\n\r\n突破性美白复合成分---法国黑藻，黑糖蜜，黄芩苷。\r\n', null);
INSERT INTO `production` VALUES ('46', 'Pure Color Envy 倾慕单色眼影', '眼影', 'her', '1.8g', '../img/10.jpg', '../img/10.1.jpg', '', '', '', '多样色彩\r\n全新倾慕单色眼影系列拥有24款令人爱不释手的缤纷色彩，从自然清新的裸色到大胆张扬的色调，无不囊括于中。选择系列中你最心仪的色彩，更可以创造自己最爱的组合。奢华哑光、质感丝绒、微闪珠光和耀眼高光，无论低调精致还是闪耀魅力，都能轻松实现。\r\n\r\n卓效配方\r\n独有绝对光感立体显色科技™，三合一质地融合完美比例的乳霜、散粉和凝胶质感于一盒，一笔完成纯正色彩、精致妆容和丝滑纹理的平衡。可单独使用或将不同色彩叠加，不添加滑石粉，多色搭配也不感觉干结或暗淡。有效防止眼部细纹和妆面剥落，双眸瞬间绽放动人色彩，无瑕妆。', null);
INSERT INTO `production` VALUES ('49', 'Pure Color 花漾魅型五色眼影盘 -REBEL METAL', '眼影', 'her', '7g', '../img/11.jpg', '../img/11.1.jpg', '', '', '', '\r\n一款眼影打造多种妆容，随心变幻。绝对光感显色科技，干湿两用，长效持妆。\r\n使用方法\r\n\r\n一款眼影 打造多重妆容\r\n①根据不同妆容，选择眼影盘中的不同3色\r\n自然-选用1，2，3色\r\n深邃-选用2，3，4色\r\n睛艳-选用3，4，5色\r\n②眼窝打底\r\n用最浅色涂抹睫毛至眉毛以下区域\r\n③轮廓勾勒\r\n用中间色涂抹睫毛至眼皮折痕上方\r\n④眼线加深\r\n用最深色在睫毛根部向上2,3毫米处涂抹，在眼尾处适度拉长\r\n', null);
INSERT INTO `production` VALUES ('50', 'Pure Color 花漾魅型五色眼影盘 -PROVOCATIVE PETAL', '眼影', 'her', '7g', '../img/12.jpg', '../img/12.1.jpg', '', '', '', '\r\n一款眼影打造多种妆容，随心变幻。绝对光感显色科技，干湿两用，长效持妆。\r\n使用方法\r\n\r\n一款眼影 打造多重妆容\r\n①根据不同妆容，选择眼影盘中的不同3色\r\n自然-选用1，2，3色\r\n深邃-选用2，3，4色\r\n睛艳-选用3，4，5色\r\n②眼窝打底\r\n用最浅色涂抹睫毛至眉毛以下区域\r\n③轮廓勾勒\r\n用中间色涂抹睫毛至眼皮折痕上方\r\n④眼线加深\r\n用最深色在睫毛根部向上2,3毫米处涂抹，在眼尾处适度拉长\r\n', null);
INSERT INTO `production` VALUES ('51', 'Pure Color 花漾魅型五色眼影盘 -DEFIANT NUDE', '眼影', 'her', '7g', '../img/13.jpg', '../img/13.1.jpg', '', '', '', '\r\n一款眼影打造多种妆容，随心变幻。绝对光感显色科技，干湿两用，长效持妆。\r\n使用方法\r\n\r\n一款眼影 打造多重妆容\r\n①根据不同妆容，选择眼影盘中的不同3色\r\n自然-选用1，2，3色\r\n深邃-选用2，3，4色\r\n睛艳-选用3，4，5色\r\n②眼窝打底\r\n用最浅色涂抹睫毛至眉毛以下区域\r\n③轮廓勾勒\r\n用中间色涂抹睫毛至眼皮折痕上方\r\n④眼线加深\r\n用最深色在睫毛根部向上2,3毫米处涂抹，在眼尾处适度拉长\r\n', null);
INSERT INTO `production` VALUES ('52', 'Pure Color 花漾魅型五色眼影盘 -IVORY POWER', '眼影', 'her', '7g', '../img/14.jpg', '../img/14.1.jpg', '', '', '', '\r\n一款眼影打造多种妆容，随心变幻。绝对光感显色科技，干湿两用，长效持妆。\r\n使用方法\r\n\r\n一款眼影 打造多重妆容\r\n①根据不同妆容，选择眼影盘中的不同3色\r\n自然-选用1，2，3色\r\n深邃-选用2，3，4色\r\n睛艳-选用3，4，5色\r\n②眼窝打底\r\n用最浅色涂抹睫毛至眉毛以下区域\r\n③轮廓勾勒\r\n用中间色涂抹睫毛至眼皮折痕上方\r\n④眼线加深\r\n用最深色在睫毛根部向上2,3毫米处涂抹，在眼尾处适度拉长\r\n', null);
INSERT INTO `production` VALUES ('53', 'Pure Color 花漾琉光三色眼影 -CAMO CHROME', '眼影', 'her', '3.1g', '../img/15.jpg', '../img/15.1.jpg', '', '', '', '丝缎质地，干湿两用,既能打造温柔色彩，亦可演绎摩登光泽。持续10小时持妆不掉色,Ture-Vision 显色科技糅合国际彩妆大师的色彩搭配，只需一盒，打底，着色，勾勒，轻松完成。\r\n使用方法\r\n\r\n从眼窝内侧至眉骨下方打底提亮\r\n从眼睑内侧至外晕染出翼形效果\r\n沿上下睫毛线勾勒轮廓\r\n', null);
INSERT INTO `production` VALUES ('54', 'Pure Color 花漾琉光三色眼影 -STERLINE PLUMS', '眼影', 'her', '3.1g', '../img/16.jpg', '../img/16.1.jpg', '', '', '', '丝缎质地，干湿两用,既能打造温柔色彩，亦可演绎摩登光泽。持续10小时持妆不掉色,Ture-Vision 显色科技糅合国际彩妆大师的色彩搭配，只需一盒，打底，着色，勾勒，轻松完成。\r\n使用方法\r\n\r\n从眼窝内侧至眉骨下方打底提亮\r\n从眼睑内侧至外晕染出翼形效果\r\n沿上下睫毛线勾勒轮廓\r\n', null);
INSERT INTO `production` VALUES ('55', 'Pure Color 花漾琉光三色眼影', '眼影', 'her', '3.1g', '../img/17.jpg', '../img/17.1.jpg', '', '', '', '丝缎质地，干湿两用,既能打造温柔色彩，亦可演绎摩登光泽。持续10小时持妆不掉色,Ture-Vision 显色科技糅合国际彩妆大师的色彩搭配，只需一盒，打底，着色，勾勒，轻松完成。\r\n使用方法\r\n\r\n从眼窝内侧至眉骨下方打底提亮\r\n从眼睑内侧至外晕染出翼形效果\r\n沿上下睫毛线勾勒轮廓\r\n', null);
INSERT INTO `production` VALUES ('59', 'Little Black 炫黑造型睫毛底膏', '睫毛膏', 'her', '6ml', '../img/18.jpg', '', '', '', '', '\r\n炫黑造型睫毛底膏，颠覆眼妆造型革命，从此爱上睫毛\"小黑裙\"。\r\n不同于传统睫毛底膏的白色质地，炫黑造型睫毛膏首创凝黑显色质地，突破睫毛底膏使用方式，玩转百变眼妆造型。\r\n着色——直接在裸睫上使用，在弧形刷头的帮助下透彻着色、轻松上提，睫毛立即呈现丝质感炫黑光泽；\r\n卷翘——释放睫毛底膏强大造型力，拉长、卷翘、放大双眸一步到位，闪耀深邃电眼；\r\n定型——在睫毛膏上再次使用，碰撞出强大定型力，瞬间形成长效防水定型层，告别脱妆、花妆，魅力大眼零晕染，整夜不下班。\r\n本产品独家专利正在申请中。\r\n使用方法\r\n\r\n可在裸睫上单独使用，打造柔软、纤长、浓密的自然妆感；\r\n亦可作为涂抹睫毛膏之前的底妆，睫毛立现轻盈卷翘。\r\n在睫毛膏上再次使用，可提供卓越的防水、定型妆效。\r\n', null);
INSERT INTO `production` VALUES ('60', 'Lash Primer Plus 滋养睫毛底膏', '睫毛膏', 'her', '5ml', '../img/19.jpg', '', '', '', '', '\r\n均匀附着每根睫毛，呈现更纤长更浓密的妆效。单独使用，更可深度滋养美睫，令睫毛强韧。蕴含滋养成分，白天上妆，温和保护；晚上睡觉，强化滋润.\r\n使用方法\r\n\r\n睫毛膏前做底膏使用\r\n轻轻刷在上下睫毛，从根本向尾部刷匀\r\n为实现最佳效果，在底膏湿润时立即涂抹睫毛膏\r\n', null);
INSERT INTO `production` VALUES ('61', 'Double Wear 凝彩卷翘睫毛膏', '睫毛膏', 'her', '5.5ml', '../img/20.jpg', '../img/20.1.jpg', '', '', '', '\r\n\"零晕染\"神话再掀\"炫翘\"风潮，几秒之间睫毛惊人卷翘定型。全天不晕染，美睫保持初妆般迷人。\r\n使用方法\r\n\r\n刷完睫毛底膏15秒后进行刷涂，用刷头沾取适量膏体\r\n将膏体沾满睫毛根部，并以弧面向上推起睫毛并停留数秒\r\n快速向上提拉睫毛\r\n重复步骤2、3至理想效果\r\n', null);
INSERT INTO `production` VALUES ('62', 'Double Wear Infinite Waterproof Eyeliner 凝彩持妆自动眼线笔', '眼线笔', 'her', '0.35g', '../img/21.jpg', '../img/21.1.jpg', '', '', '', '* 凝彩持妆自动眼线笔*\r\n\r\n\r\n一笔顺滑，持久不晕染。\r\n缤纷十色，双眸立显深邃。\r\n\r\n\r\n功效：\r\n·顺滑出色：质地丝滑一笔到位，十色可选，高度显色。\r\n·极细专业笔头：独特双头设计，同步勾勒内外眼线，即现迷人眼妆。\r\n·持久梦幻眼妆：整日防水防晕染，告别熊猫眼。', null);
INSERT INTO `production` VALUES ('63', 'Little Black 炫黑造型双头眼线液笔', '眼线笔', 'her', '0.9g', '../img/22.jpg', '', '', '', '', '炫黑造型睫毛底膏的最佳搭档——炫黑造型双头眼线液笔，特有炫黑配方，一细一粗的双头造型，笔头流畅，轻松拥有多种眼线。现在，就开始用这一对精巧的工具打造三种完全不同的眼部妆容——自然淡雅、精致日常或是大胆浓妆的眼线妆容，随心而动。\r\n\r\n关键功效\r\n• 长效持妆达12小时\r\n• 防水防晕染，色彩不剥落\r\n• 经眼科医生测试不致过敏', null);
INSERT INTO `production` VALUES ('64', 'Double Wear 凝彩持妆眼线笔', '眼线笔', 'her', '1.2g', '../img/23.jpg', '../img/23.1.jpg', '', '', '', '流畅持久 睛艳玩色\r\n\r\n1)流畅易画：奢华润泽质地，迅速流畅，一笔上妆\r\n2)浓郁显色：凝彩家族的显色科技，带来高遮盖力，高显色度的浓郁色彩\r\n3)12H持妆：含护肤成分的长效防水配方，12小时舒适持妆不褪色\r\n4)晕染头：改良版硅树脂斜角晕染刷头，易于打造自然烟熏妆容，更易打理\r\n5)珍珠色：专业设计一款多用珍珠色（10色中其中一色），多种使用，多变迷眸', null);
INSERT INTO `production` VALUES ('65', 'Double Wear 持妆塑形眉胶笔', '眉笔', 'her', '1.2g', '../img/24.jpg', '../img/24.1.jpg', '', '', '', '马拉松眉笔 持久不脱妆\r\n\r\n\r\n• 一笔即现立体眉形：双头塑形设计，轻松打造立体眉妆效果。\r\n• 持妆零破绽：精准上色，防水防汗，持久不晕染。\r\n\r\n\r\n使用方法：\r\n首先使用眉刷端沿眉毛生长方向梳理，找到眉毛自然生长的形状。\r\n接着使用眉笔描画出眉妆轮廓，填充颜色，修整出最佳眉型。', null);
INSERT INTO `production` VALUES ('66', 'Black Brown 持妆塑形眉彩笔 -SOFT BROWN', '眉笔', 'her', '0.09g', '../img/25.jpg', '../img/25.1.jpg', '', '', '', '精巧笔尖，易于上妆，深色勾勒，浅色塑性，双眉即刻立体有型。显色配方使上色均匀、自然，长效持妆无晕染。\r\n精准\r\n笔尖纤细，精准造型，完美匹配自然眉形\r\n精致\r\n纤细一端精准描绘，高光一端塑形轮廓，创造3D立体眉形\r\n持久\r\n蜡质配方易于上色塑形，12小时持久妆效无晕染\r\n使用方法\r\n\r\n用深色端沿着眉毛下端画一条眉毛底线\r\n用眉笔向上晕染，填充眉毛空隙\r\n用浅色端勾勒轮廓，提亮眉骨，精致眉形，令眉形飞扬\r\n', null);
INSERT INTO `production` VALUES ('67', 'Black Brown 持妆塑形眉彩笔 -', '眉笔', 'her', '0.09G', '../img/26.jpg', '../img/26.1.jpg', '', '', '', '精巧笔尖，易于上妆，深色勾勒，浅色塑性，双眉即刻立体有型。显色配方使上色均匀、自然，长效持妆无晕染。\r\n精准\r\n笔尖纤细，精准造型，完美匹配自然眉形\r\n精致\r\n纤细一端精准描绘，高光一端塑形轮廓，创造3D立体眉形\r\n持久\r\n蜡质配方易于上色塑形，12小时持久妆效无晕染\r\n使用方法\r\n\r\n用深色端沿着眉毛下端画一条眉毛底线\r\n用眉笔向上晕染，填充眉毛空隙\r\n用浅色端勾勒轮廓，提亮眉骨，精致眉形，令眉形飞扬\r\n', null);
INSERT INTO `production` VALUES ('68', 'Automatic Brow Pencil Duo 专业双头眉彩笔', '眉笔', 'her', '0.2g', '../img/27.jpg', '../img/27.1.jpg', '', '', '', '\r\n专业双头眉彩笔，眉笔、眉刷两端合一，塑形加渲染，一支全掌握。\r\n释放风格，多面出击。无论是精准勾勒眉型线条，还是调和眼部光影及脸颊轮廓，专业双头眉彩笔均能轻松胜任。\r\n使用方法\r\n\r\n首先使用眉刷端沿眉毛生长方向梳理，找到眉毛自然生长的形状。\r\n接着使用眉笔描画出眉妆轮廓，填充颜色，修整出最佳眉型。\r\n', null);
INSERT INTO `production` VALUES ('69', 'Envy Velvet 倾慕哑光唇膏丝绒系列', '唇膏', 'her', '3g', '../img/28.jpg', '../img/28.1.jpg', '', '', '', '倾慕哑光唇膏 全新上市\r\n质感哑光唇 哑而不干 引领时尚圣诞季\r\n\r\n\r\n功效：\r\n·双重保湿精粹：玻尿酸及Moisture Complex锁水科技\r\n·质感哑光质地：丝绒哑光，浓郁经典，如天鹅绒般丰盈柔滑', null);
INSERT INTO `production` VALUES ('70', 'Envy Metallic 倾慕哑光唇膏金属系列', '唇膏', 'her', '3g', '../img/29.jpg', '../img/29.1.jpg', '', '', '', '倾慕哑光唇膏 全新上市\r\n质感哑光唇 哑而不干 引领时尚圣诞季\r\n\r\n功效：\r\n·双重保湿精粹：玻尿酸及Moisture Complex锁水科技\r\n·创新哑光质地：金属哑光，前卫时髦，如金属般酷炫闪耀', null);
INSERT INTO `production` VALUES ('71', 'Envy Rouge 倾慕唇膏魅色系列', '唇膏', 'her', '3.5g', '../img/30.jpg', '../img/30.1.jpg', '', '', '', '\r\n\r\n\r\n型色纽约 唇燃倾慕\r\n• 满蕴玻尿酸滋润因子，双唇丰盈有型。\r\n• 立体光感显色科技，打造浓郁饱满色调。\r\n• 出众着色力，赋予双唇非凡魅色。\r\n• 独特磁性包装设计，令每次开合都成为焦点。\r\n\r\n\r\n使用方法：\r\n第1步：先用面纸按压唇部，擦拭干净\r\n第2步：再将唇膏沿唇线涂于唇部\r\n\r\n\r\n*本款唇膏体表面可能会有少量气孔，这是唇膏热胀冷缩的正常反应。', null);
INSERT INTO `production` VALUES ('72', 'Pure Color Love Lipstick 恋爱唇膏', '唇膏', 'her', '3.5g', '../img/31.jpg', '../img/31.1.jpg', '', '', '', '*Bobbi Brown 恋爱唇膏*\r\n\r\n\r\n绝美29色，4大质地。\r\n丝绒哑光、柔润缎光、立体晶闪、冷艳金属，随心混搭，搭出你的专属唇色。\r\n\r\n\r\n热销色：\r\n310火星红，300灵魂橘，330恋爱西柚，220花花粉\r\n\r\n\r\n功效：\r\n·4种质地，妆效随心\r\n·4大色系，显色润泽\r\n·2面斜角设计,1抹成型', null);
INSERT INTO `production` VALUES ('73', 'Envy Sculpting Gloss 花漾倾慕唇彩', '唇彩', 'her', '5.8ml', '../img/32.jpg', '../img/32.1.jpg', '', '', '', '\r\n全新Pure Color Envy Sculpting Gloss，以突破性液体唇膏质地打造闪耀唇彩妆效。十多款色彩随心而绽，每支纯臻闪耀，勾勒双唇自然轮廓，令唇部无限立体，凸显诱人唇部曲线，自然饱满丰盈，闪耀动人光彩。高级真视科技™  带来水漾润泽，凸显唇部曲线。丝滑的唇膏质感精准均匀上妆，为双唇带来完美色彩与动人立体感。富含独有的保湿复合物透明质酸，有助于提高唇部肌肤吸收水分并有效锁水，令双唇时刻倍感柔软丝滑，丰盈水嫩，焕发难以抵挡的诱人魅力。\r\n外观时尚简约，方形水晶透明瓶身，搭配品牌Pure Color Envy系列独有扣盖。全新多功能唇刷轻松完成三种不同妆效，独特的曲线设计，完美贴合唇部曲线，打造动人立体造型与闪耀色彩。在使用时，量身定制的唇刷每次都能蘸取精确用量，根据需要打造立体闪耀的动人唇妆。\r\n使用方法\r\n\r\n可以在上唇彩前，先涂上护唇膏，以保护双唇。\r\n如果需要清晰的唇形，可先勾勒唇线\r\n用唇刷涂抹娇唇，在唇部中间的位置加重以增加亮度\r\nTIPS：如需轻盈晶亮的唇部效果，可以单独使用唇彩；如需精致饱满的唇部效果，可搭配唇膏一起使用。\r\n', null);
INSERT INTO `production` VALUES ('74', 'Envy Volumizer 倾慕丰唇蜜', '唇彩', 'her', '7ml', '../img/33.jpg', '', '', '', '', '\r\n\r\n型：满蕴玻尿酸滋润因子，在魔力丰唇刷的精准勾勒下，一触丰唇，立绽无尽性感。\r\n\r\n色：卓越显色科技，锁住浓郁色彩，十二魅色持久绽放。\r\n\r\n漾：革命性液态质地，一抹丝滑，犹如整日唇膜般水润。\r\n使用方法\r\n\r\n用刷头轻轻涂抹于唇部。本产品清润无色，单独使用即可令双唇丰润立体；或在涂抹其他着色产品之前使用，漾出双唇惊艳魅色。\r\n', null);
INSERT INTO `production` VALUES ('75', 'Envy Blooming Lip 花漾倾慕丰唇膏', '唇膏', 'her', '3.2g', '../img/34.jpg', '', '', '', '', '\r\n轻轻涂抹，唤醒唇部鲜活生机，双唇立现轻盈水润的自然色泽。富含蕴满玻尿酸因子的长效锁水物，助力双唇持久保湿，消除干裂细纹，打造饱满立体的水漾唇色\r\n使用方法\r\n\r\n轻轻涂抹，渗透均匀后，双唇立即呈现水润轻盈的自然色泽；或作为正式涂抹唇膏之前的底色使用，打造滋润鲜活的立体妆感\r\n', null);
INSERT INTO `production` VALUES ('76', 'Pure Color Vivid 花漾唇膏莹炫系列', '唇膏', 'her', '3g', '../img/35.jpg', '../img/35.1.jpg', '', '', '', '\r\n\r\n由于天气炎热，为防止唇膏膏体出现易断裂情况，建议收到唇膏时先放入冰箱冷藏室冰冻一段时间之后再取出使用。\r\n\r\n主角唇膏 摩登优雅\r\n这一华丽的唇膏系列，色号跨越鲜艳浓烈和低调柔和，兼具花漾唇膏持久系列的鲜艳润泽，又融入水晶系列的闪亮活力。掀起唇色革命，令双唇如主角般闪耀。\r\n使用方法\r\n\r\n先用面纸按压唇部，擦拭干净\r\n再将唇膏沿唇线涂于唇部\r\n', null);
INSERT INTO `production` VALUES ('77', 'Pure Color Long Lasting 花漾唇膏持久系列', '唇膏', 'her', '3.8g', '../img/36.jpg', '../img/36.1.jpg', '', '', '', '\r\n\r\n由于天气炎热，为防止唇膏膏体出现易断裂情况，建议收到唇膏时先放入冰箱冷藏室冰冻一段时间之后再取出使用。\r\n\r\n这一华丽的唇膏系列，色号跨越鲜艳浓烈和低调柔和，兼具花漾唇膏持久系列的鲜艳润泽，又融入水晶系列的闪亮活力。掀起唇色革命，令双唇如主角般闪耀。\r\n使用方法\r\n\r\n先用面纸按压唇部，擦拭干净\r\n再将唇膏沿唇线涂于唇部\r\n', null);
INSERT INTO `production` VALUES ('78', 'Pure Color Crystal 花漾唇膏水晶系列', '唇膏', 'her', '3.8g', '../img/37.jpg', '../img/37.1.jpg', '', '', '', '\r\n\r\n由于天气炎热，为防止唇膏膏体出现易断裂情况，建议收到唇膏时先放入冰箱冷藏室冰冻一段时间之后再取出使用。\r\n\r\n这一华丽的唇膏系列，色号跨越鲜艳浓烈和低调柔和，兼具花漾唇膏持久系列的鲜艳润泽，又融入水晶系列的闪亮活力。掀起唇色革命，令双唇如主角般闪耀。\r\n使用方法\r\n\r\n先用面纸按压唇部，擦拭干净\r\n再将唇膏沿唇线涂于唇部\r\n', null);
INSERT INTO `production` VALUES ('79', 'Envy Sculpting Lacquer 花漾倾慕唇釉', '唇釉', 'her', '5.8ml', '../img/38.jpg', '../img/38.1.jpg', '', '', '', '\r\n全新Pure Color Envy Sculpting Lacquer多款丰盈魅惑唇釉，完美结合唇膏的丰润遮瑕与唇彩的无瑕闪耀，双唇自然水润，打造独具魅力、流光溢彩的诱人美唇。独有的真视™技术带来至臻至纯色彩，多功能聚合物牢牢锁住水分，并形成色彩保护屏障，令双唇色彩持久清新，丰盈亮泽，柔软丝滑，越抿越丰盈，持妆时间长达6小时。富含独有的保湿复合物透明质酸，有助于提高唇部肌肤吸收水分并有效锁水，令双唇时刻倍感柔软丝滑，丰盈水嫩，焕发难以抵挡的诱人魅力。\r\n外观时尚简约，方形水晶透明瓶身，搭配品牌Pure Color Envy系列独有扣盖。全新多功能唇刷轻松完成三种不同妆效，独特的曲线设计，完美贴合唇部曲线，打造动人立体造型与闪耀色彩。在使用时，量身定制的唇刷每次都能蘸取精确用量，根据需要打造立体闪耀的动人唇妆。\r\n使用方法\r\n\r\n可以在画上唇釉前，先涂上护唇膏，以保护双唇\r\n如果需要清晰的唇形，可以先勾勒唇线\r\n用唇刷涂抹娇唇，在唇部中间的位置加重以增加亮度\r\nTIPS：如需轻盈晶亮的唇部效果，可单独使用唇釉；如需精致饱满的唇部效果，可搭配唇膏一起使用。\r\n', null);
INSERT INTO `production` VALUES ('80', 'Double Wear 两用唇线笔', '唇线笔', 'her', '1.2g', '../img/39.jpg', '../img/39.1.jpg', '', '', '', '柔和的笔触令双唇精致完美。配方软硬适中，轻柔顺滑的掠过整个唇部，带来恒久如新的色泽，无晕染科技，令双唇极易上色。创新性的\"柔护妆彩控制（Soft-touch Color Control™）技术\"令上妆精确方便，不论是钩线，塑形，还是着色，这款一体化的唇刷都能帮助您创造出具有专业水准的妆容。完美清晰塑造唇部曲线，令唇膏唇彩不溢散。', null);
INSERT INTO `production` VALUES ('81', 'Double Wear Cushion Set 持妆无瑕气垫粉霜套装', '气垫', 'her', '2g*2', '../img/40.jpg', '../img/40.1.jpg', '', '', '', '年度限量臻献 双芯一盒套装更超值\r\n光芒不断电，无瑕一整天\r\n\r\n\r\n产品详情：\r\n1. 超长持久：防水、防汗，持久不脱妆\r\n2. 完美遮瑕：立即隐形毛孔和瑕疵\r\n3. 润泽水亮：30%植物精华水，水亮润泽、持久保湿\r\n4. 高倍防护：SPF30 PA+++全天防护\r\n\r\n\r\n使用方法：\r\n1.取粉：轻轻沾\r\n三个手指套住粉扑，取粉时只需要轻轻沾一下即可。不要太用力、反复沾取\r\n2.上妆：轻轻拍\r\n从脸颊开始，轻轻拍在肌肤上，拍出无瑕水亮度的肌肤\r\n\r\n\r\n内含：\r\n持妆无瑕气垫粉霜正装 1个\r\n持妆无瑕气垫粉霜替换芯 1个', null);
INSERT INTO `production` VALUES ('82', 'Crescent White 晶透沁白气垫修颜乳套装', '气垫', 'her', '12g*2', '../img/41.jpg', '../img/41.1.jpg', '', '', '', '一拍一补防晒亮白 肌肤宛若自带滤镜\r\n\r\n\r\n·防晒防护：SPF50/PA+++，帮助肌肤抵御环境伤害\r\n·清透裸妆：控油配方，水感轻盈，妆容轻薄不黏腻，“妆”出自然亮白肌\r\n·轻巧便携：随时补妆更轻松，随心绽放亮白美肌\r\n\r\n\r\n使用方法：\r\n1.取粉：轻轻沾\r\n三个手指套住粉扑，取粉时只需要轻轻沾一下即可。\r\n2.上妆：轻轻拍\r\n从脸颊开始，轻轻拍在肌肤上，拍出亮白美肌。\r\n\r\n\r\n内含：\r\n晶透沁白气垫修颜乳正装 1个\r\n晶透沁白气垫修颜乳替换芯 1个', null);
INSERT INTO `production` VALUES ('83', 'DW NUDE CSHN STK 14ML/.47FLOZ 持妆无瑕气垫粉妆棒', '气垫', 'her', '30g', '../img/42.jpg', '../img/42.1.jpg', '', '', '', '点点持妆气垫棒\r\n\r\n\r\n持妆家族新成员，随时随地、一手完妆，高光、修容、补妆、遮瑕轻松打造水、亮、无瑕肌\r\n\r\n\r\n产品详情：\r\n1.随时随地 轻松完妆：\r\n打破常规;粉底+专业美妆工具（气垫澎澎球）,轻松完妆\r\n2.多重用途 一手完妆：\r\n高光、修容、补妆，遮瑕\r\n3.水、亮、无瑕：\r\n肌肤瞬间水亮、无瑕持久一整天\r\n\r\n\r\n使用手法：\r\n1.拧：拧半圈的量足够涂抹手背。如果拧太多量，可以反方向转回多余的量\r\n\r\n2.点:\r\n将粉底点在手背上，无需太多量\r\n\r\n3.抹:\r\n以打圈的方式轻轻抹点开打造自然妆效，反复点按可以增加遮盖力\r\n\r\n\r\n不同用法：\r\n1.高光：在T区、大C区、下巴用浅色提亮立体轮廓\r\n2.修容： 在发际线、颧弓下线、下颚线用深色修饰脸型\r\n3.补妆：在需要补妆的地方点按涂抹，打造水亮无瑕肌\r\n4.遮瑕：在瑕疵处反复点按,加强遮盖力', null);
INSERT INTO `production` VALUES ('84', 'Double Wear Cushion 持妆无瑕气垫粉霜高定版', '气垫', 'her', '15g', '../img/43.jpg', '../img/43.1.jpg', '', '', '', '全新上市 艺术家唯美设计款\r\n始于颜值，忠于实力\r\n既是气垫BB，又是吸睛配饰\r\n真正的女神 懂得内外兼修\r\n\r\n\r\n产品详情：\r\n1. 超长持久：防水、防汗，持久不脱妆\r\n2. 完美遮瑕：立即隐形毛孔和瑕疵\r\n3. 润泽水亮：30%植物精华水，水亮润泽、持久保湿\r\n4. 高倍防护：SPF30 PA+++全天防护\r\n\r\n\r\n使用方法：\r\n1.取粉：轻轻沾\r\n三个手指套住粉扑，取粉时只需要轻轻沾一下即可。不要太用力、反复沾取\r\n2.上妆：轻轻拍\r\n从脸颊开始，轻轻拍在肌肤上，拍出无瑕水亮度的肌肤', null);
INSERT INTO `production` VALUES ('85', 'Double Wear 润泽亮采修颜乳SPF 30/PA+++', '妆前乳', 'her', '30ml', '../img/44.jpg', '../img/44.1.jpg', '', '', '', '轻薄、水润配方，可单独使用，也可搭配任何粉底使用。肌肤提亮赋活成分-透明的乳白色云母，一扫暗沉，瞬间为肌肤带来具有亮泽光采的完美遮盖，即刻打造匀净无瑕妆容。融入复合保湿护肤成分，妆容润泽一整天。有效持妆8小时。', null);
INSERT INTO `production` VALUES ('86', 'Genuine Glow 真我光采唇颊彩', '腮红', 'her', '8g', '../img/45.jpg', '../img/45.1.jpg', '', '', '', '\r\nTOM FORD真我光采唇颊彩，一笔多效，一抹红润好气色。\r\n产品呈乳霜状，质地清透丝滑，色彩饱满有光泽，上色均匀，一抹显色，即刻赋予肌肤清新活力光泽。配合出众的补水及持妆配方，赋予肌肤一整日的健康光泽与红润好气色。\r\n\r\n清透不厚重，配合自然饱满的色泽，一抹赋予双唇与面颊健康红润的好气色；\r\n特有保湿滋养配方，使双唇与面颊即刻变得柔嫩，光滑，展现自然柔和的完美光泽；\r\n棒状包装，一笔显色，易于随身携带。随时随地，随心绽放自然光彩。\r\n使用方法\r\n\r\n轻旋底部按钮，旋出适量膏体后涂抹于唇部和脸颊。\r\n', null);
INSERT INTO `production` VALUES ('87', 'Envy Blush Gradation 花漾倾慕渐变腮红', '腮红', 'her', '7g', '../img/46.jpg', '../img/46.1.jpg', '', '', '', '\r\n巧妙利用光影力量，三色可选的花漾渐变腮红自然凸显面部曲线和立体感，打造360度无瑕闪耀美肌。采用创新型光导三棱光学成分，柔化轮廓，提亮肤色，只需轻轻一笔，肌肤立现健康光彩，由内而外焕发好气色。易于上妆的丝滑粉质，完美贴合肌肤，打造纯正色彩，无暇美肌闪耀丝般光泽。三种渐变色调轻松勾勒若有若无的动人色彩，精致妆容闪耀奢华哑光。超易混合的轻盈配方,丰盈滋养，肌肤焕发动人光彩。\r\n使用方法\r\n\r\n蘸取适量，在颧骨、鼻侧等部位轻轻涂抹即可\r\n', null);
INSERT INTO `production` VALUES ('88', 'Envy Lip and Cheek Stick 花漾倾慕唇颊棒', '腮红', 'her', '8g', '../img/47.jpg', '../img/47.1.jpg', '', '', '', '\r\n花漾倾慕唇颊棒质地细滑亲肤，轻松着色，色彩自然丰盈，完美持妆整日，为双唇和脸颊带来鲜亮色彩和闪耀光泽。蕴含抗氧化和保湿成分，清新香草香气配方粉质轻若无感、持久、滋润。融合真彩颜料和光学成分，这支多功能唇部/腮红产品为视觉、触觉和嗅觉带来多重美妙体验。便于携带的棒状包装，即使在外也能毫不费力地上妆，轻松拥有完美腮红。\r\n使用方法\r\n\r\n在需要着色的部位轻轻涂抹，即刻唤醒妆容鲜活生机\r\n', null);
INSERT INTO `production` VALUES ('89', 'Pure Color 花漾腮红', '腮红', 'her', '8g', '../img/48.jpg', '../img/48.1.jpg', '', '', '', '花样腮红，加成活力好气色\r\n\r\n\r\n粉质轻如羽毛，柔和细腻，轻松提亮，肌肤呈现健康好气色。亲和度高的大地色和优雅浪漫的粉色系，塑造小脸，打造立体轮廓专研True Vision™ 显色科技，带来饱满的色泽和丰富的色彩体验。\r\n\r\n\r\n使用方法\r\n在需要着色的部位轻扫，唤醒妆容鲜活生机', null);
INSERT INTO `production` VALUES ('90', 'Double Wear 润泽修颜明采笔', '遮瑕膏', 'her', '2.2ML', '../img/49.jpg', '../img/49.1.jpg', '', '', '', '\r\n独特轻盈舒缓质地内含光学修片科技，局部使用，凸显脸部立体轮廓，同时有效隐匿倦容和黑眼圈。打造整日无瑕，明亮妆感。无瑕柔光修容笔的全新升级版。色号与原来一一对应，更加入新色号，淡色T区提亮，妆容立刻立体。\r\n使用方法\r\n\r\n旋转底端，转出适量产品，涂抹于需要遮瑕和提亮的区域\r\n轻轻涂抹眼睛下方的黑眼圈处，用指腹按压\r\n涂抹在T字部，让肌肤增加立体感\r\n', null);

-- ----------------------------
-- Table structure for productionattr
-- ----------------------------
DROP TABLE IF EXISTS `productionattr`;
CREATE TABLE `productionattr` (
  `sku` varchar(200) NOT NULL COMMENT 'sku编号 产品名称+色号',
  `pid` int(10) unsigned NOT NULL COMMENT '产品编号',
  `colour_num` varchar(30) NOT NULL COMMENT '色号',
  `colour_name` varchar(70) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(10) NOT NULL,
  `isDelete` int(11) DEFAULT NULL,
  PRIMARY KEY (`sku`),
  KEY `pid` (`pid`),
  CONSTRAINT `productionattr_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `production` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of productionattr
-- ----------------------------
INSERT INTO `productionattr` VALUES ('Automatic Brow Pencil Duo 专业双头眉彩笔_#4c4a4c', '68', '#4c4a4c', '3 SOFT BLACK', '240', '3', null);
INSERT INTO `productionattr` VALUES ('Automatic Brow Pencil Duo 专业双头眉彩笔_#6d5e58', '68', '#6d5e58', '6 DARK BROWN', '250', '3', null);
INSERT INTO `productionattr` VALUES ('Automatic Brow Pencil Duo 专业双头眉彩笔_#789eae', '68', '#789eae', '5 SOFT BROWN', '260', '3', null);
INSERT INTO `productionattr` VALUES ('Black Brown 持妆塑形眉彩笔 -SOFT BROWN_#ffffff', '66', '#ffffff', '*', '250', '1', null);
INSERT INTO `productionattr` VALUES ('Black Brown 持妆塑形眉彩笔 -_#ffffff', '67', '#ffffff', '*', '240', '5', null);
INSERT INTO `productionattr` VALUES ('Crescent White 晶透沁白修颜妆前乳SPF30/PA+++_#ffffff', '38', '#ffffff', '*', '380', '2', null);
INSERT INTO `productionattr` VALUES ('Crescent White 晶透沁白气垫修颜乳套装_#dea677', '82', '#dea677', '03号色', '520', '2', null);
INSERT INTO `productionattr` VALUES ('Crescent White 晶透沁白气垫修颜乳套装_#eab990', '82', '#eab990', '02号色', '520', '2', null);
INSERT INTO `productionattr` VALUES ('Crescent White 晶透沁白气垫修颜乳套装_#fac99e', '82', '#fac99e', '01号色', '540', '3', null);
INSERT INTO `productionattr` VALUES ('Crescent White 晶透沁白焕采粉饼SPF 25/PA+++_#e2ccb3', '45', '#e2ccb3', '2W0 WARM VANILLA', '430', '11', null);
INSERT INTO `productionattr` VALUES ('Crescent White 晶透沁白焕采粉饼SPF 25/PA+++_#e6cbb7', '45', '#e6cbb7', '1C0 COOL PORCELAIN', '420', '10', null);
INSERT INTO `productionattr` VALUES ('Crescent White 晶透沁白焕采粉饼SPF 25/PA+++_#e6ceb6', '45', '#e6ceb6', '1W0 WARM PORCELAIN', '450', '11', null);
INSERT INTO `productionattr` VALUES ('Double Wear Cushion Set 持妆无瑕气垫粉霜套装_#e5ad74', '81', '#e5ad74', '17号色 Sand', '520', '0', null);
INSERT INTO `productionattr` VALUES ('Double Wear Cushion Set 持妆无瑕气垫粉霜套装_#ecb882', '81', '#ecb882', '62号色 Cool Vanilla', '520', '3', null);
INSERT INTO `productionattr` VALUES ('Double Wear Cushion 持妆无瑕气垫粉霜高定版_#e5ad74', '84', '#e5ad74', '17号色Bone ', '420', '0', null);
INSERT INTO `productionattr` VALUES ('Double Wear Cushion 持妆无瑕气垫粉霜高定版_#ecb882', '84', '#ecb882', '62号色Cool Vanilla', '420', '2', null);
INSERT INTO `productionattr` VALUES ('Double Wear Infinite Waterproof Eyeliner 凝彩持妆自动眼线笔_#37414a', '62', '#37414a', 'TEAL NIGHT', '260', '2', null);
INSERT INTO `productionattr` VALUES ('Double Wear Infinite Waterproof Eyeliner 凝彩持妆自动眼线笔_#424146', '62', '#424146', 'KOHL NOIR', '250', '3', null);
INSERT INTO `productionattr` VALUES ('Double Wear Infinite Waterproof Eyeliner 凝彩持妆自动眼线笔_#4c4341', '62', '#4c4341', 'BLACKENED ONYX', '250', '2', null);
INSERT INTO `productionattr` VALUES ('Double Wear Infinite Waterproof Eyeliner 凝彩持妆自动眼线笔_#4d3c41', '62', '#4d3c41', 'ESPRESSO', '250', '4', null);
INSERT INTO `productionattr` VALUES ('Double Wear Infinite Waterproof Eyeliner 凝彩持妆自动眼线笔_#515354', '62', '#515354', 'BLACKENED EMERALD', '250', '4', null);
INSERT INTO `productionattr` VALUES ('Double Wear Infinite Waterproof Eyeliner 凝彩持妆自动眼线笔_#52587b', '62', '#52587b', 'INDIGO', '250', '5', null);
INSERT INTO `productionattr` VALUES ('Double Wear Infinite Waterproof Eyeliner 凝彩持妆自动眼线笔_#575157', '62', '#575157', 'GRAPHITE', '250', '4', null);
INSERT INTO `productionattr` VALUES ('Double Wear Infinite Waterproof Eyeliner 凝彩持妆自动眼线笔_#755092', '62', '#755092', 'ROYAL AMETHYST', '250', '2', null);
INSERT INTO `productionattr` VALUES ('Double Wear 两用唇线笔_#ae5c70', '80', '#ae5c70', '14 Wine', '180', '3', null);
INSERT INTO `productionattr` VALUES ('Double Wear 两用唇线笔_#b67079', '80', '#b67079', '06 Apple Cordial', '185', '2', null);
INSERT INTO `productionattr` VALUES ('Double Wear 两用唇线笔_#c66c84', '80', '#c66c84', '02 Fuchsia', '185', '4', null);
INSERT INTO `productionattr` VALUES ('Double Wear 凝彩卷翘睫毛膏_#ffffff', '61', '#ffffff', '*', '250', '5', null);
INSERT INTO `productionattr` VALUES ('Double Wear 凝彩持妆眼线笔_#186060', '64', '#186060', 'EMERALD VOLT', '220', '1', null);
INSERT INTO `productionattr` VALUES ('Double Wear 凝彩持妆眼线笔_#1894b9', '64', '#1894b9', 'TEAL', '220', '8', null);
INSERT INTO `productionattr` VALUES ('Double Wear 凝彩持妆眼线笔_#1b2225', '64', '#1b2225', 'ONYX', '220', '2', null);
INSERT INTO `productionattr` VALUES ('Double Wear 凝彩持妆眼线笔_#373f5b', '64', '#373f5b', 'SAPPHIRE', '220', '4', null);
INSERT INTO `productionattr` VALUES ('Double Wear 凝彩持妆眼线笔_#424b4a', '64', '#424b4a', 'SMOKE', '220', '6', null);
INSERT INTO `productionattr` VALUES ('Double Wear 凝彩持妆眼线笔_#4e4036', '64', '#4e4036', 'COFFEE', '220', '3', null);
INSERT INTO `productionattr` VALUES ('Double Wear 凝彩持妆眼线笔_#575151', '64', '#575151', 'NIGTHT DIAMOND', '230', '0', null);
INSERT INTO `productionattr` VALUES ('Double Wear 凝彩持妆眼线笔_#5c3e3f', '64', '#5c3e3f', 'BURGUNDY SUEDE', '240', '9', null);
INSERT INTO `productionattr` VALUES ('Double Wear 凝彩持妆眼线笔_#c6ad6d', '64', '#c6ad6d', 'GOLD', '220', '7', null);
INSERT INTO `productionattr` VALUES ('Double Wear 凝彩持妆眼线笔_#e2d4c0', '64', '#e2d4c0', 'PEARL', '240', '5', null);
INSERT INTO `productionattr` VALUES ('Double Wear 持妆塑形眉胶笔_#856a56', '65', '#856a56', '04 灰棕色', '250', '3', null);
INSERT INTO `productionattr` VALUES ('Double Wear 持妆塑形眉胶笔_#a37152', '65', '#a37152', '03 蜜棕色', '240', '4', null);
INSERT INTO `productionattr` VALUES ('Double Wear 持妆塑形眉胶笔_#b78768', '65', '#b78768', '02 浅咖色', '250', '2', null);
INSERT INTO `productionattr` VALUES ('Double Wear 持妆粉底液 SPF10/PA++_#c59c63', '27', '#c59c63', '53 DAWN', '390', '184', '1');
INSERT INTO `productionattr` VALUES ('Double Wear 持妆粉底液 SPF10/PA++_#c88d4f', '27', '#c88d4f', '65 WARM CREME', '390', '199', '1');
INSERT INTO `productionattr` VALUES ('Double Wear 持妆粉底液 SPF10/PA++_#d3bb8b', '27', '#d3bb8b', '37 TAWNY', '390', '194', '1');
INSERT INTO `productionattr` VALUES ('Double Wear 持妆粉底液 SPF10/PA++_#d4b67c', '27', '#d4b67c', '84 RATTAN', '390', '200', '1');
INSERT INTO `productionattr` VALUES ('Double Wear 持妆粉底液 SPF10/PA++_#daa289', '27', '#daa289', '82 WARM VANILLA', '390', '192', '1');
INSERT INTO `productionattr` VALUES ('Double Wear 持妆粉底液 SPF10/PA++_#e3ae81', '27', '#e3ae81', '85 COOL CREME', '390', '194', '1');
INSERT INTO `productionattr` VALUES ('Double Wear 持妆粉底液 SPF10/PA++_#e5b593', '27', '#e5b593', '36 SAND', '390', '194', '1');
INSERT INTO `productionattr` VALUES ('Double Wear 持妆粉底液 SPF10/PA++_#e7b79e', '27', '#e7b79e', '62 COOLVANLLA', '390', '198', '1');
INSERT INTO `productionattr` VALUES ('Double Wear 持妆粉底液 SPF10/PA++_#f2cbb0', '27', '#f2cbb0', '17 BONE', '390', '200', '1');
INSERT INTO `productionattr` VALUES ('Double Wear 持妆粉底液 SPF10/PA++_#ffd694', '27', '#ffd694', '66 COOL BONE', '390', '200', '1');
INSERT INTO `productionattr` VALUES ('Double Wear 无痕持妆遮瑕蜜_#ddb393', '44', '#ddb393', 'LIGHT/MEDIUM', '350', '8', null);
INSERT INTO `productionattr` VALUES ('Double Wear 无痕持妆遮瑕蜜_#e9c59d', '44', '#e9c59d', 'WARM LIGHT/MEDIUM', '320', '9', null);
INSERT INTO `productionattr` VALUES ('Double Wear 无痕持妆遮瑕蜜_#e9d0ac', '44', '#e9d0ac', 'WARM LIGHT', '350', '10', null);
INSERT INTO `productionattr` VALUES ('Double Wear 无痕持妆遮瑕蜜_#eec8ab', '44', '#eec8ab', 'LIGHT', '320', '10', null);
INSERT INTO `productionattr` VALUES ('Double Wear 润泽亮采修颜乳SPF 30/PA+++_#d69060', '85', '#d69060', 'Intensity 3.5', '450', '0', null);
INSERT INTO `productionattr` VALUES ('Double Wear 润泽亮采修颜乳SPF 30/PA+++_#ddb393', '85', '#ddb393', 'Intensity 2.0', '460', '2', null);
INSERT INTO `productionattr` VALUES ('Double Wear 润泽亮采修颜乳SPF 30/PA+++_#deaa88', '85', '#deaa88', 'Intensity 3.0', '450', '34', null);
INSERT INTO `productionattr` VALUES ('Double Wear 润泽亮采修颜乳SPF 30/PA+++_#eec8ab', '85', '#eec8ab', 'Intensity 1.0', '450', '2', null);
INSERT INTO `productionattr` VALUES ('Double Wear 润泽修颜明采笔_#d2a67f', '90', '#d2a67f', 'Extra Light', '320', '4', null);
INSERT INTO `productionattr` VALUES ('Double Wear 润泽修颜明采笔_#e6c8b9', '90', '#e6c8b9', 'Light Medium', '340', '6', null);
INSERT INTO `productionattr` VALUES ('Double Wear 润泽修颜明采笔_#e9c59d', '90', '#e9c59d', 'Soft Pink', '320', '5', null);
INSERT INTO `productionattr` VALUES ('Double Wear 润泽修颜明采笔_#eec8ab', '90', '#eec8ab', 'Light', '320', '7', null);
INSERT INTO `productionattr` VALUES ('DW CUSHION BB 12GM/.42OZ 持妆无瑕气垫粉霜 SPF30+/PA+++_#cc955c', '37', '#cc955c', '82 WARM VANILLA', '400', '198', null);
INSERT INTO `productionattr` VALUES ('DW CUSHION BB 12GM/.42OZ 持妆无瑕气垫粉霜 SPF30+/PA+++_#dda770', '37', '#dda770', '37 TAWNY', '420', '198', null);
INSERT INTO `productionattr` VALUES ('DW CUSHION BB 12GM/.42OZ 持妆无瑕气垫粉霜 SPF30+/PA+++_#e5ad74', '37', '#e5ad74', '17 BONE', '420', '199', null);
INSERT INTO `productionattr` VALUES ('DW CUSHION BB 12GM/.42OZ 持妆无瑕气垫粉霜 SPF30+/PA+++_#e5b593', '37', '#e5b593', '36 SAND', '390', '200', null);
INSERT INTO `productionattr` VALUES ('DW CUSHION BB 12GM/.42OZ 持妆无瑕气垫粉霜 SPF30+/PA+++_#ecb882', '37', '#ecb882', '62 COOL VANILLA', '420', '199', null);
INSERT INTO `productionattr` VALUES ('DW NUDE CSHN STK 14ML/.47FLOZ 持妆无瑕气垫粉妆棒_#e6bf91', '83', '#e6bf91', '17 1W1 BONE', '420', '3', null);
INSERT INTO `productionattr` VALUES ('Envy Blooming Lip 花漾倾慕丰唇膏_#ffffff', '75', '#ffffff', '*', '270', '4', null);
INSERT INTO `productionattr` VALUES ('Envy Blush Gradation 花漾倾慕渐变腮红_#ca6c66', '87', '#ca6c66', 'Witty Peach', '450', '0', null);
INSERT INTO `productionattr` VALUES ('Envy Blush Gradation 花漾倾慕渐变腮红_#db80a2', '87', '#db80a2', 'Plush Petal', '450', '2', null);
INSERT INTO `productionattr` VALUES ('Envy Blush 花漾倾慕腮红_#b15457', '41', '#b15457', 'PINK KISS', '450', '2', null);
INSERT INTO `productionattr` VALUES ('Envy Blush 花漾倾慕腮红_#d18b5e', '41', '#d18b5e', 'BRAZEN BRONZE', '430', '4', null);
INSERT INTO `productionattr` VALUES ('Envy Blush 花漾倾慕腮红_#e98ca7', '41', '#e98ca7', 'PINK TEASE', '450', '3', null);
INSERT INTO `productionattr` VALUES ('Envy Lip and Cheek Stick 花漾倾慕唇颊棒_#e15f68', '88', '#e15f68', 'Orange', '420', '4', null);
INSERT INTO `productionattr` VALUES ('Envy Lip and Cheek Stick 花漾倾慕唇颊棒_#f55461', '88', '#f55461', 'Pink', '420', '3', null);
INSERT INTO `productionattr` VALUES ('Envy Metallic 倾慕哑光唇膏金属系列_#3a4552', '70', '#3a4552', '450 BOLTED BLACK', '270', '0', null);
INSERT INTO `productionattr` VALUES ('Envy Metallic 倾慕哑光唇膏金属系列_#6e2c2c', '70', '#6e2c2c', '420 WICKED GLEAM', '260', '3', null);
INSERT INTO `productionattr` VALUES ('Envy Metallic 倾慕哑光唇膏金属系列_#8a2245', '70', '#8a2245', '430 PASSION PATINA', '270', '2', null);
INSERT INTO `productionattr` VALUES ('Envy Metallic 倾慕哑光唇膏金属系列_#a42c2a', '70', '#a42c2a', '330 SIZZLINE', '260', '3', null);
INSERT INTO `productionattr` VALUES ('Envy Metallic 倾慕哑光唇膏金属系列_#ab3e3a', '70', '#ab3e3a', '320 MAGNETIC', '270', '3', null);
INSERT INTO `productionattr` VALUES ('Envy Metallic 倾慕哑光唇膏金属系列_#b21e2e', '70', '#b21e2e', '340 RIVETED', '270', '4', null);
INSERT INTO `productionattr` VALUES ('Envy Metallic 倾慕哑光唇膏金属系列_#e43585', '70', '#e43585', '220 HOT SHOCK', '270', '2', null);
INSERT INTO `productionattr` VALUES ('Envy Metallic 倾慕哑光唇膏金属系列_#ef7367', '70', '#ef7367', '310 HOT CORE', '260', '7', null);
INSERT INTO `productionattr` VALUES ('Envy Rouge 倾慕唇膏魅色系列_#9e434c', '71', '#9e434c', '420轻奢瑰情 13号色', '270', '2', null);
INSERT INTO `productionattr` VALUES ('Envy Rouge 倾慕唇膏魅色系列_#a05f53', '71', '#a05f53', '130奶油枫叶 18号色', '270', '3', null);
INSERT INTO `productionattr` VALUES ('Envy Rouge 倾慕唇膏魅色系列_#b62127', '71', '#b62127', '520浪漫表白 25号色', '270', '2', null);
INSERT INTO `productionattr` VALUES ('Envy Rouge 倾慕唇膏魅色系列_#b81453', '71', '#b81453', '240火龙果色 08号色', '270', '4', null);
INSERT INTO `productionattr` VALUES ('Envy Rouge 倾慕唇膏魅色系列_#b92c40', '71', '#b92c40', '270粉红国度 27号色', '280', '5', null);
INSERT INTO `productionattr` VALUES ('Envy Rouge 倾慕唇膏魅色系列_#bc4750', '71', '#bc4750', '127 Incensed 56号色', '280', '3', null);
INSERT INTO `productionattr` VALUES ('Envy Rouge 倾慕唇膏魅色系列_#bf0404', '71', '#bf0404', '340嫉色绯红 04号色', '270', '8', null);
INSERT INTO `productionattr` VALUES ('Envy Rouge 倾慕唇膏魅色系列_#c10128', '71', '#c10128', '332 Boldface 64号色', '270', '6', null);
INSERT INTO `productionattr` VALUES ('Envy Rouge 倾慕唇膏魅色系列_#cb6860', '71', '#cb6860', '260 俏皮蔷薇 23号色', '270', '1', null);
INSERT INTO `productionattr` VALUES ('Envy Rouge 倾慕唇膏魅色系列_#cc2925', '71', '#cc2925', '330燃情胭红 03号色', '280', '9', null);
INSERT INTO `productionattr` VALUES ('Envy Rouge 倾慕唇膏魅色系列_#d68e83', '71', '#d68e83', '110纯真琥珀 17号色', '280', '5', null);
INSERT INTO `productionattr` VALUES ('Envy Rouge 倾慕唇膏魅色系列_#d70127', '71', '#d70127', '331 Noirish 63号色', '270', '0', null);
INSERT INTO `productionattr` VALUES ('Envy Rouge 倾慕唇膏魅色系列_#d7524a', '71', '#d7524a', '380格调蜜桃 33号色', '280', '7', null);
INSERT INTO `productionattr` VALUES ('Envy Rouge 倾慕唇膏魅色系列_#e5511d', '71', '#e5511d', '390炫慕倾橙 34号色', '270', '1', null);
INSERT INTO `productionattr` VALUES ('Envy Rouge 倾慕唇膏魅色系列_#e75139', '71', '#e75139', '311 Out Of Control 60号色', '280', '7', null);
INSERT INTO `productionattr` VALUES ('Envy Rouge 倾慕唇膏魅色系列_#e94357', '71', '#e94357', '261 Never Enough 65号色', '280', '9', null);
INSERT INTO `productionattr` VALUES ('Envy Rouge 倾慕唇膏魅色系列_#f14862', '71', '#f14862', '280绝色魅粉 32号色', '270', '6', null);
INSERT INTO `productionattr` VALUES ('Envy Rouge 倾慕唇膏魅色系列_#f94954', '71', '#f94954', '312 High Level 61号色', '270', '8', null);
INSERT INTO `productionattr` VALUES ('Envy Rouge 倾慕唇膏魅色系列_#ff1b17', '71', '#ff1b17', '321 Uninhibited 62号色', '270', '4', null);
INSERT INTO `productionattr` VALUES ('Envy Sculpting Gloss 花漾倾慕唇彩_#91365f', '73', '#91365f', '16 Berry Provocative ', '260', '6', null);
INSERT INTO `productionattr` VALUES ('Envy Sculpting Gloss 花漾倾慕唇彩_#972b4f', '73', '#972b4f', '08 Flirtacious Magenta', '260', '2', null);
INSERT INTO `productionattr` VALUES ('Envy Sculpting Gloss 花漾倾慕唇彩_#bc7961', '73', '#bc7961', '03 Wild Mink', '260', '5', null);
INSERT INTO `productionattr` VALUES ('Envy Sculpting Gloss 花漾倾慕唇彩_#d9605f', '73', '#d9605f', '106 Eccentric Flower ', '260', '4', null);
INSERT INTO `productionattr` VALUES ('Envy Sculpting Gloss 花漾倾慕唇彩_#db8266', '73', '#db8266', '10 Shameless Glow ', '250', '1', null);
INSERT INTO `productionattr` VALUES ('Envy Sculpting Gloss 花漾倾慕唇彩_#f03453', '73', '#f03453', '07 Red Extrovert ', '250', '5', null);
INSERT INTO `productionattr` VALUES ('Envy Sculpting Gloss 花漾倾慕唇彩_#f74564', '73', '#f74564', '09 Jealous Blush ', '260', '3', null);
INSERT INTO `productionattr` VALUES ('Envy Sculpting Gloss 花漾倾慕唇彩_#f96f83', '73', '#f96f83', '11 Suggestive Kiss', '260', '8', null);
INSERT INTO `productionattr` VALUES ('Envy Sculpting Gloss 花漾倾慕唇彩_#fa8156', '73', '#fa8156', '05 Shell Game', '260', '9', null);
INSERT INTO `productionattr` VALUES ('Envy Sculpting Gloss 花漾倾慕唇彩_#fe5b60', '73', '#fe5b60', '103 Tempting Melon ', '270', '0', null);
INSERT INTO `productionattr` VALUES ('Envy Sculpting Lacquer 花漾倾慕唇釉_#ae3c50', '79', '#ae3c50', '7 Orchid Intrigue', '270', '7', null);
INSERT INTO `productionattr` VALUES ('Envy Sculpting Lacquer 花漾倾慕唇釉_#c44b54', '79', '#c44b54', '1 Apricot Allure', '280', '2', null);
INSERT INTO `productionattr` VALUES ('Envy Sculpting Lacquer 花漾倾慕唇釉_#cd0b1e', '79', '#cd0b1e', '2 Wicked Apple', '260', '4', null);
INSERT INTO `productionattr` VALUES ('Envy Sculpting Lacquer 花漾倾慕唇釉_#cf767d', '79', '#cf767d', '4 Potent Petal', '270', '1', null);
INSERT INTO `productionattr` VALUES ('Envy Sculpting Lacquer 花漾倾慕唇釉_#de516d', '79', '#de516d', '5 Mulberry Tease', '270', '5', null);
INSERT INTO `productionattr` VALUES ('Envy Sculpting Lacquer 花漾倾慕唇釉_#e00e45', '79', '#e00e45', '6 Thrilling Flame ', '250', '4', null);
INSERT INTO `productionattr` VALUES ('Envy Sculpting Lacquer 花漾倾慕唇釉_#ec604b', '79', '#ec604b', '8 Peach Seduction ', '270', '3', null);
INSERT INTO `productionattr` VALUES ('Envy Velvet 倾慕哑光唇膏丝绒系列_#b12142', '69', '#b12142', '121 DECISIVE', '270', '3', null);
INSERT INTO `productionattr` VALUES ('Envy Velvet 倾慕哑光唇膏丝绒系列_#bd4b43', '69', '#bd4b43', '333 PERSUASIVE', '270', '3', null);
INSERT INTO `productionattr` VALUES ('Envy Velvet 倾慕哑光唇膏丝绒系列_#c71e3e', '69', '#c71e3e', '322 FAME SEEKER', '270', '2', null);
INSERT INTO `productionattr` VALUES ('Envy Velvet 倾慕哑光唇膏丝绒系列_#c83158', '69', '#c83158', '211 ALOOF', '290', '4', null);
INSERT INTO `productionattr` VALUES ('Envy Velvet 倾慕哑光唇膏丝绒系列_#d5357a', '69', '#d5357a', '409 UNINHIBITED', '280', '2', null);
INSERT INTO `productionattr` VALUES ('Envy Velvet 倾慕哑光唇膏丝绒系列_#ec6066', '69', '#ec6066', '208 BLUSH CRUSH', '270', '6', null);
INSERT INTO `productionattr` VALUES ('Envy Velvet 倾慕哑光唇膏丝绒系列_#f63639', '69', '#f63639', '321 SHORT FUSE', '270', '3', null);
INSERT INTO `productionattr` VALUES ('Envy Velvet 倾慕哑光唇膏丝绒系列_#fd5b7b', '69', '#fd5b7b', '209 PRIVATE PARTY', '260', '5', null);
INSERT INTO `productionattr` VALUES ('Envy Volumizer 倾慕丰唇蜜_#ffffff', '74', '#ffffff', '*', '230', '4', null);
INSERT INTO `productionattr` VALUES ('Futurist 沁水粉底液 SPF15/PA++_#d8a886', '36', '#d8a886', '65 COOL CREME', '480', '4', '1');
INSERT INTO `productionattr` VALUES ('Futurist 沁水粉底液 SPF15/PA++_#e6c8ae', '36', '#e6c8ae', '64 WARM VANILLA', '480', '5', '1');
INSERT INTO `productionattr` VALUES ('Futurist 沁水粉底液 SPF15/PA++_#eec5ae', '36', '#eec5ae', '61 COOL PROCELAIN', '480', '2', '1');
INSERT INTO `productionattr` VALUES ('Futurist 沁水粉底液 SPF15/PA++_#f3c783', '36', '#f3c783', '63 COOL VANILLA', '480', '1', '1');
INSERT INTO `productionattr` VALUES ('Futurist 沁水粉底液 SPF15/PA++_#f7d4c1', '36', '#f7d4c1', '60 COOL BONE', '480', '0', '1');
INSERT INTO `productionattr` VALUES ('Futurist 沁水粉底液 SPF15/PA++_#fadcc2', '36', '#fadcc2', '62 WARM PORECELAIN', '480', '3', '1');
INSERT INTO `productionattr` VALUES ('Genuine Glow Priming Moisture Balm 真我光采保湿饰底乳_#ffffff', '39', '#ffffff', '*', '420', '5', null);
INSERT INTO `productionattr` VALUES ('Genuine Glow 真我光采唇颊彩_#d95a70', '86', '#d95a70', '01 甜颜蜜语', '220', '1', null);
INSERT INTO `productionattr` VALUES ('Genuine Glow 真我光采唇颊彩_#e2665e', '86', '#e2665e', '02 桃色可人', '220', '2', null);
INSERT INTO `productionattr` VALUES ('Lash Primer Plus 滋养睫毛底膏_#ffffff', '60', '#ffffff', '*', '250', '5', null);
INSERT INTO `productionattr` VALUES ('Little Black 炫黑造型双头眼线液笔_#ffffff', '63', '#ffffff', '*', '250', '3', null);
INSERT INTO `productionattr` VALUES ('Little Black 炫黑造型睫毛底膏_#ffffff', '59', '#ffffff', '*', '270', '3', null);
INSERT INTO `productionattr` VALUES ('Pure Color Crystal 花漾唇膏水晶系列_#9d1b2a', '78', '#9d1b2a', '38 Twinkling Ruby', '270', '7', null);
INSERT INTO `productionattr` VALUES ('Pure Color Crystal 花漾唇膏水晶系列_#a23d5b', '78', '#a23d5b', '54 Passion Fruit', '260', '2', null);
INSERT INTO `productionattr` VALUES ('Pure Color Crystal 花漾唇膏水晶系列_#a63f3f', '78', '#a63f3f', '57 Ripe Papaya ', '260', '8', null);
INSERT INTO `productionattr` VALUES ('Pure Color Crystal 花漾唇膏水晶系列_#ba4d62', '78', '#ba4d62', '03 Crystal Pink', '270', '5', null);
INSERT INTO `productionattr` VALUES ('Pure Color Crystal 花漾唇膏水晶系列_#c54451', '78', '#c54451', '57 Ripe Papaya ', '260', '1', null);
INSERT INTO `productionattr` VALUES ('Pure Color Crystal 花漾唇膏水晶系列_#d87b78', '78', '#d87b78', '08 Crystal Blush', '260', '4', null);
INSERT INTO `productionattr` VALUES ('Pure Color Crystal 花漾唇膏水晶系列_#f2757a', '78', '#f2757a', '24 Peach Fizz', '260', '6', null);
INSERT INTO `productionattr` VALUES ('Pure Color Crystal 花漾唇膏水晶系列_#fd5f4c', '78', '#fd5f4c', '11 Crystal Coral', '260', '9', null);
INSERT INTO `productionattr` VALUES ('Pure Color Envy 倾慕单色眼影_#9087b6', '46', '#9087b6', '19 INFAMOUS ORCHID', '280', '0', null);
INSERT INTO `productionattr` VALUES ('Pure Color Envy 倾慕单色眼影_#9e6875', '46', '#9e6875', '16 VAIN VIOLET', '270', '3', null);
INSERT INTO `productionattr` VALUES ('Pure Color Envy 倾慕单色眼影_#a5888d', '46', '#a5888d', '27 STRONG CURRANT', '290', '5', null);
INSERT INTO `productionattr` VALUES ('Pure Color Envy 倾慕单色眼影_#a89aa0', '46', '#a89aa0', '20 OMINOUS', '300', '6', null);
INSERT INTO `productionattr` VALUES ('Pure Color Envy 倾慕单色眼影_#b7928e', '46', '#b7928e', '26 AMBER INTRIGUE', '290', '1', null);
INSERT INTO `productionattr` VALUES ('Pure Color Envy 倾慕单色眼影_#d1c8e1', '46', '#d1c8e1', '15 STEELY LILAC', '290', '0', null);
INSERT INTO `productionattr` VALUES ('Pure Color Envy 倾慕单色眼影_#d2bcc4', '46', '#d2bcc4', '31 FIERY TOPAZ', '290', '2', null);
INSERT INTO `productionattr` VALUES ('Pure Color Envy 倾慕单色眼影_#d5bc9c', '46', '#d5bc9c', '12 NAKED GOLD', '290', '1', null);
INSERT INTO `productionattr` VALUES ('Pure Color Envy 倾慕单色眼影_#d5cdc8', '46', '#d5cdc8', '13 SILVER EDGE', '290', '4', null);
INSERT INTO `productionattr` VALUES ('Pure Color Envy 倾慕单色眼影_#d7b39c', '46', '#d7b39c', '11 DECADENT COPPER', '290', '3', null);
INSERT INTO `productionattr` VALUES ('Pure Color Envy 倾慕单色眼影_#deb3ce', '46', '#deb3ce', '17 FEARLESS PETAL', '290', '5', null);
INSERT INTO `productionattr` VALUES ('Pure Color Envy 倾慕单色眼影_#ded3c1', '46', '#ded3c1', '10 IMPULSIVE BLONDE', '300', '1', null);
INSERT INTO `productionattr` VALUES ('Pure Color Envy 倾慕单色眼影_#e9cdc5', '46', '#e9cdc5', '14 MAGNETIC ROSE', '300', '2', null);
INSERT INTO `productionattr` VALUES ('Pure Color Envy 倾慕单色眼影_#e9cece', '46', '#e9cece', '18 CHEEKY PINK', '290', '3', null);
INSERT INTO `productionattr` VALUES ('Pure Color Envy 倾慕单色眼影_#eecbb0', '46', '#eecbb0', '08 UNRIVALED', '290', '4', null);
INSERT INTO `productionattr` VALUES ('Pure Color Envy 倾慕单色眼影_#efb69d', '46', '#efb69d', '30 NUDE DARE', '340', '5', null);
INSERT INTO `productionattr` VALUES ('Pure Color Envy 倾慕单色眼影_#f9ddce', '46', '#f9ddce', '28 INSOLENT IVORY', '290', '3', null);
INSERT INTO `productionattr` VALUES ('Pure Color Envy 倾慕单色眼影_#facda5', '46', '#facda5', '22 FLAWLESS', '280', '6', null);
INSERT INTO `productionattr` VALUES ('Pure Color Long Lasting 花漾唇膏持久系列_#70342f', '77', '#70342f', '50 Wild Copper', '290', '4', null);
INSERT INTO `productionattr` VALUES ('Pure Color Long Lasting 花漾唇膏持久系列_#9f3e39', '77', '#9f3e39', '55 Blushing Lilac', '260', '3', null);
INSERT INTO `productionattr` VALUES ('Pure Color Long Lasting 花漾唇膏持久系列_#a02e37', '77', '#a02e37', '26 Nectarine', '260', '2', null);
INSERT INTO `productionattr` VALUES ('Pure Color Long Lasting 花漾唇膏持久系列_#b64564', '77', '#b64564', '16 Candy', '270', '6', null);
INSERT INTO `productionattr` VALUES ('Pure Color Long Lasting 花漾唇膏持久系列_#bf2f03', '77', '#bf2f03', '55 Blushing Lilac', '260', '1', null);
INSERT INTO `productionattr` VALUES ('Pure Color Long Lasting 花漾唇膏持久系列_#c37179', '77', '#c37179', '18 Rols De Rose', '260', '7', null);
INSERT INTO `productionattr` VALUES ('Pure Color Long Lasting 花漾唇膏持久系列_#c60545', '77', '#c60545', '53 Wildly Pink', '280', '5', null);
INSERT INTO `productionattr` VALUES ('Pure Color Love Lipstick 恋爱唇膏_#b34455', '72', '#b34455', '460 ripped raisin 醉爱', '270', '7', null);
INSERT INTO `productionattr` VALUES ('Pure Color Love Lipstick 恋爱唇膏_#c0113c', '72', '#c0113c', '220 shock&awe 心动', '270', '7', null);
INSERT INTO `productionattr` VALUES ('Pure Color Love Lipstick 恋爱唇膏_#ce0925', '72', '#ce0925', '310 bar red 猎爱', '280', '4', null);
INSERT INTO `productionattr` VALUES ('Pure Color Love Lipstick 恋爱唇膏_#d6817e', '72', '#d6817e', '100 blaise buff 初吻', '270', '1', null);
INSERT INTO `productionattr` VALUES ('Pure Color Love Lipstick 恋爱唇膏_#e63150', '72', '#e63150', '270 haute&cold 焰火', '270', '5', null);
INSERT INTO `productionattr` VALUES ('Pure Color Love Lipstick 恋爱唇膏_#ea808e', '72', '#ea808e', '200 proven innocent 初恋', '280', '0', null);
INSERT INTO `productionattr` VALUES ('Pure Color Love Lipstick 恋爱唇膏_#f04043', '72', '#f04043', '300 hot streak 热吻', '270', '2', null);
INSERT INTO `productionattr` VALUES ('Pure Color Love Lipstick 恋爱唇膏_#f16780', '72', '#f16780', '250 radical chic 狂热', '270', '7', null);
INSERT INTO `productionattr` VALUES ('Pure Color Love Lipstick 恋爱唇膏_#f8596b', '72', '#f8596b', '330 wild poppy 着迷', '270', '9', null);
INSERT INTO `productionattr` VALUES ('Pure Color Love Lipstick 恋爱唇膏_#f87796', '72', '#f87796', '240 pret-a-party 战袍', '270', '3', null);
INSERT INTO `productionattr` VALUES ('Pure Color Love Lipstick 恋爱唇膏_#fd4449', '72', '#fd4449', '360 flash chill 初见', '280', '6', null);
INSERT INTO `productionattr` VALUES ('Pure Color Love Lipstick 恋爱唇膏_#fd5147', '72', '#fd5147', '340 hot rumor 绯闻', '280', '8', null);
INSERT INTO `productionattr` VALUES ('Pure Color Love Lipstick 恋爱唇膏_#ff7169', '72', '#ff7169', '350 sly wink 迷离', '270', '9', null);
INSERT INTO `productionattr` VALUES ('Pure Color Vivid 花漾唇膏莹炫系列_#910317', '76', '#910317', 'FL Forbidden Apple ', '270', '9', null);
INSERT INTO `productionattr` VALUES ('Pure Color Vivid 花漾唇膏莹炫系列_#d08969', '76', '#d08969', 'F4 Spiked Toffee ', '260', '6', null);
INSERT INTO `productionattr` VALUES ('Pure Color Vivid 花漾唇膏莹炫系列_#da1d58', '76', '#da1d58', 'F7 Magnetic Magenta ', '260', '8', null);
INSERT INTO `productionattr` VALUES ('Pure Color Vivid 花漾唇膏莹炫系列_#e3649d', '76', '#e3649d', 'FH Electric Mauve ', '260', '1', null);
INSERT INTO `productionattr` VALUES ('Pure Color Vivid 花漾唇膏莹炫系列_#e76a89', '76', '#e76a89', 'F6 Pink Voltage ', '260', '3', null);
INSERT INTO `productionattr` VALUES ('Pure Color Vivid 花漾唇膏莹炫系列_#ea6798', '76', '#ea6798', 'FG Poppy Love ', '270', '2', null);
INSERT INTO `productionattr` VALUES ('Pure Color Vivid 花漾唇膏莹炫系列_#ee2a25', '76', '#ee2a25', 'FK Fireball ', '280', '6', null);
INSERT INTO `productionattr` VALUES ('Pure Color Vivid 花漾唇膏莹炫系列_#f72f5e', '76', '#f72f5e', 'F8 Pink Riot ', '260', '7', null);
INSERT INTO `productionattr` VALUES ('Pure Color Vivid 花漾唇膏莹炫系列_#ff8a83', '76', '#ff8a83', 'FE Hot Coralline ', '270', '5', null);
INSERT INTO `productionattr` VALUES ('Pure Color Vivid 花漾唇膏莹炫系列_#ffb2ab', '76', '#ffb2ab', 'F9 Mauve Struck', '270', '4', null);
INSERT INTO `productionattr` VALUES ('Pure Color 花漾琉光三色眼影 -CAMO CHROME_#ffffff', '53', '#ffffff', '*', '420', '4', null);
INSERT INTO `productionattr` VALUES ('Pure Color 花漾琉光三色眼影 -STERLINE PLUMS_#ffffff', '54', '#ffffff', '* ', '3', '4', null);
INSERT INTO `productionattr` VALUES ('Pure Color 花漾琉光三色眼影_#ffffff', '55', '#ffffff', '*', '430', '8', null);
INSERT INTO `productionattr` VALUES ('Pure Color 花漾腮红_#d09f8a', '89', '#d09f8a', '11 Sensuous Rose ', '385', '4', null);
INSERT INTO `productionattr` VALUES ('Pure Color 花漾腮红_#db80a2', '89', '#db80a2', '14 Plush Petal (Satin)', '385', '3', null);
INSERT INTO `productionattr` VALUES ('Pure Color 花漾腮红_#fd9bba', '89', '#fd9bba', '01 Pink Tease', '380', '4', null);
INSERT INTO `productionattr` VALUES ('Pure Color 花漾魅型五色眼影盘 -DEFIANT NUDE_#ffffff', '51', '#ffffff', '*', '520', '3', null);
INSERT INTO `productionattr` VALUES ('Pure Color 花漾魅型五色眼影盘 -IVORY POWER_#ffffff', '52', '#ffffff', '*', '520', '5', null);
INSERT INTO `productionattr` VALUES ('Pure Color 花漾魅型五色眼影盘 -PROVOCATIVE PETAL_#ffffff', '50', '#ffffff', '*', '520', '7', null);
INSERT INTO `productionattr` VALUES ('Pure Color 花漾魅型五色眼影盘 -REBEL METAL_#ffffff', '49', '#ffffff', '*', '520', '9', null);
INSERT INTO `productionattr` VALUES ('Reviving Oil Lip Tint 真我光采轻透润唇蜜_#ffffff', '40', '#ffffff', '*', '480', '6', null);

-- ----------------------------
-- Table structure for returngoods
-- ----------------------------
DROP TABLE IF EXISTS `returngoods`;
CREATE TABLE `returngoods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderID` int(11) unsigned NOT NULL,
  `reason` varchar(60) NOT NULL,
  `price` int(11) NOT NULL,
  `text` varchar(200) NOT NULL,
  `img0` varchar(500) DEFAULT NULL,
  `img1` varchar(500) DEFAULT NULL,
  `img2` varchar(500) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `delivery` varchar(12) DEFAULT NULL,
  `backDelivery` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of returngoods
-- ----------------------------
INSERT INTO `returngoods` VALUES ('9', '50', '商品破损', '1770', '商品破损', '../img/TB2eWZEj9BYBeNjy0FeXXbnmFXa_!!0-rate.jpg_400x400.jpg', '', '', '退款', '2018-04-14 13:17:05', '1213213', '3425252');
INSERT INTO `returngoods` VALUES ('12', '69', '商品破损', '350', '商品破损', '../img/TB2YY5xirSYBuNjSspfXXcZCpXa_!!0-rate.jpg_400x400.jpg', '../img/TB23tDqf3mTBuNjy1XbXXaMrVXa_!!0-rate.jpg_400x400.jpg', '', '退款', '2018-04-14 13:27:05', '1234456', '12343234');
INSERT INTO `returngoods` VALUES ('13', '54', '商品破损', '380', '破损', '', '', '', '驳回申请', '2018-04-14 15:16:58', null, null);
INSERT INTO `returngoods` VALUES ('14', '55', '商品破损', '390', '破损', '../img/TB23tDqf3mTBuNjy1XbXXaMrVXa_!!0-rate.jpg_400x400.jpg', '', '', '退回', '2018-04-14 15:18:13', '1234567', '325252');
INSERT INTO `returngoods` VALUES ('15', '56', '商品破损', '380', '破损', '', '', '', '退款', '2018-04-14 15:19:59', '123456', null);
INSERT INTO `returngoods` VALUES ('16', '64', '商品破损', '860', '粉底泄漏', '../img/TB2RA0DjACWBuNjy0FaXXXUlXXa_!!0-rate.jpg_400x400.jpg', '', '', '退款', '2018-04-23 16:45:04', '123786', null);
INSERT INTO `returngoods` VALUES ('17', '65', '商品破损', '480', '商品破损', '../img/TB2jpdAf79WBuNjSspeXXaz5VXa_!!0-rate.jpg_40x40.jpg', '', '', '退款', '2018-04-23 16:48:58', '656456', null);
INSERT INTO `returngoods` VALUES ('18', '57', '商品破损', '480', '商品破损', '../img/TB2w7xrf4SYBuNjSsphXXbGvVXa_!!0-rate.jpg_400x400.jpg', '', '', '驳回申请', '2018-04-23 16:54:41', null, null);
INSERT INTO `returngoods` VALUES ('19', '67', '商品破损', '480', '商品破损', '../img/TB2XoX1cIuYBuNkSmRyXXcA3pXa_!!0-rate.jpg_400x400.jpg', '', '', '退回', '2018-04-23 16:57:33', '6758453', '24325532');
INSERT INTO `returngoods` VALUES ('20', '60', '商品破损', '480', '商品破损', '../img/TB2eWZEj9BYBeNjy0FeXXbnmFXa_!!0-rate.jpg_400x400.jpg', '', '', '退款', '2018-04-24 00:03:40', '456789', null);
INSERT INTO `returngoods` VALUES ('21', '62', '商品破损', '1910', '商品', '../img/TB2eWZEj9BYBeNjy0FeXXbnmFXa_!!0-rate.jpg_400x400.jpg', '', '', '买家已寄出', '2018-04-24 09:18:03', '456789', null);
INSERT INTO `returngoods` VALUES ('22', '114', '商品破损', '520', '破损', '../img/TB2w7xrf4SYBuNjSsphXXbGvVXa_!!0-rate.jpg_400x400.jpg', '', '', '驳回申请', '2018-05-08 21:39:12', null, null);
INSERT INTO `returngoods` VALUES ('23', '113', '商品破损', '420', '破损', '../img/TB2eWZEj9BYBeNjy0FeXXbnmFXa_!!0-rate.jpg_400x400.jpg', '', '', '退款', '2018-05-08 21:41:15', '4536536', null);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `phone` char(11) NOT NULL,
  `password` varchar(16) NOT NULL,
  `email` varchar(60) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `orderNumber` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('3', 'LC', '13728113331', 'qq', '957678541@qq.com', '2018-04-07 13:00:14', '0');
INSERT INTO `user` VALUES ('4', null, '13728113332', '11', '957678543@qq.com', '2018-03-29 14:51:24', '0');
INSERT INTO `user` VALUES ('5', null, '13798653567', '11', '956754326@qq.com', '2018-04-01 16:17:35', '0');
INSERT INTO `user` VALUES ('6', null, '13725443361', 'qq', '324432468@qq.com', '2018-04-01 16:23:12', '0');
INSERT INTO `user` VALUES ('7', null, '13728113338', '11', '957678546@qq.com', '2018-04-20 08:54:27', '0');
INSERT INTO `user` VALUES ('8', null, '13728113339', '11', '957675541@qq.com', '2018-04-29 10:28:18', '0');
INSERT INTO `user` VALUES ('9', null, '13728113336', '11', '957678591@qq.com', '2018-05-09 10:53:34', '0');
