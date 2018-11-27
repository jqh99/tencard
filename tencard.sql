/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50719
Source Host           : localhost:3306
Source Database       : tencard

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2018-11-27 16:26:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for card
-- ----------------------------
DROP TABLE IF EXISTS `card`;
CREATE TABLE `card` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `content` varchar(500) NOT NULL,
  `theme_id` int(11) NOT NULL,
  `like_count` int(11) NOT NULL DEFAULT '0',
  `view_count` int(11) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of card
-- ----------------------------
INSERT INTO `card` VALUES ('1', '1', '人生如戏，若得嬉笑怒骂，当可超然！', '1', '0', '0', '1543301541');
INSERT INTO `card` VALUES ('2', '1', '天之道，损有余而补不足！\r\n人之道，损不足而奉有余！', '1', '0', '0', '1543303224');

-- ----------------------------
-- Table structure for card_to_like_user
-- ----------------------------
DROP TABLE IF EXISTS `card_to_like_user`;
CREATE TABLE `card_to_like_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `card_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of card_to_like_user
-- ----------------------------

-- ----------------------------
-- Table structure for msg
-- ----------------------------
DROP TABLE IF EXISTS `msg`;
CREATE TABLE `msg` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `from_user_id` bigint(20) NOT NULL,
  `to_user_id` bigint(20) NOT NULL,
  `is_read` int(11) NOT NULL DEFAULT '0',
  `send_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of msg
-- ----------------------------

-- ----------------------------
-- Table structure for theme
-- ----------------------------
DROP TABLE IF EXISTS `theme`;
CREATE TABLE `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `class` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of theme
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_freeze` int(11) NOT NULL DEFAULT '0',
  `freezer_id` bigint(20) DEFAULT NULL,
  `freezer_count` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'jqh', '江大聪', '$2y$10$ln3pUbHt6UlctKMZddGAJudV0bcHMuEuwh/A4JJlZCW4fb2xGCmdC', '0', null, '0', 'oGzqeT7nQaNcDOpy6YPStPeGGzhLtKY9xzS2stcGHzx7TM3BEFenNd6xhp4q');
INSERT INTO `user` VALUES ('2', 'jqh', '江神州', '$2y$10$1zkNdEVZv6iFI31R18kPxeLM/mqUCdyVMUoXPlLRmie9UoXFH1slS', '0', null, '0', '8n6mbKnOtuaUu7yKnleizimuS9EGpDDdsf97WcsvGbb2nES9fYBJX410JYuW');
