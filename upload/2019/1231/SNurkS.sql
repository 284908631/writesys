/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : writesys

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-12-27 10:22:41
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `dept`
-- ----------------------------
DROP TABLE IF EXISTS `dept`;
CREATE TABLE `dept` (
  `dept_id` int(20) NOT NULL,
  `dept_name` char(20) NOT NULL,
  `dept_manager` int(20) DEFAULT NULL,
  `dept_vicemanager` int(20) DEFAULT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dept
-- ----------------------------
INSERT INTO `dept` VALUES ('1', '总经理办公室', null, null);
INSERT INTO `dept` VALUES ('2', '行政部', null, null);
INSERT INTO `dept` VALUES ('3', '人力资源部', null, null);
INSERT INTO `dept` VALUES ('4', '财务部', null, null);
INSERT INTO `dept` VALUES ('5', '生产技术部', null, null);
INSERT INTO `dept` VALUES ('6', '计划营销部', null, null);
INSERT INTO `dept` VALUES ('7', '安全监察部', null, null);
INSERT INTO `dept` VALUES ('8', '营运部', null, null);

-- ----------------------------
-- Table structure for `manage`
-- ----------------------------
DROP TABLE IF EXISTS `manage`;
CREATE TABLE `manage` (
  `username` char(20) NOT NULL,
  `password` char(20) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of manage
-- ----------------------------
INSERT INTO `manage` VALUES ('root', 'root');

-- ----------------------------
-- Table structure for `personnel`
-- ----------------------------
DROP TABLE IF EXISTS `personnel`;
CREATE TABLE `personnel` (
  `emp_id` int(20) NOT NULL,
  `emp_name` char(20) NOT NULL,
  `dept_id` int(20) DEFAULT NULL,
  `emp_sex` char(10) NOT NULL,
  `emp_tel` int(20) DEFAULT NULL,
  `emp_email` char(50) DEFAULT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of personnel
-- ----------------------------
INSERT INTO `personnel` VALUES ('1', '张三', '1', '男', '10086', '1234qq.com');
INSERT INTO `personnel` VALUES ('2', '李四', '2', '女', '10000', '4321qq.com');
INSERT INTO `personnel` VALUES ('3', '王五', '3', '男', '12345', '1111qq.com');

-- ----------------------------
-- Table structure for `user_pswd`
-- ----------------------------
DROP TABLE IF EXISTS `user_pswd`;
CREATE TABLE `user_pswd` (
  `nbxw_user` char(20) NOT NULL,
  `nbxw_pswd` char(30) NOT NULL,
  `dept_id` int(20) DEFAULT NULL,
  PRIMARY KEY (`nbxw_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_pswd
-- ----------------------------
INSERT INTO `user_pswd` VALUES ('1', '1234', '1');
INSERT INTO `user_pswd` VALUES ('1234', '12345', '5');
INSERT INTO `user_pswd` VALUES ('2', '1234', '2');
INSERT INTO `user_pswd` VALUES ('3', '1234', '3');
INSERT INTO `user_pswd` VALUES ('4', '123456', '4');

-- ----------------------------
-- Table structure for `xw`
-- ----------------------------
DROP TABLE IF EXISTS `xw`;
CREATE TABLE `xw` (
  `xw_id` int(20) NOT NULL AUTO_INCREMENT,
  `xw_title` char(20) DEFAULT NULL,
  `xw_auther` int(20) DEFAULT NULL,
  `xw_content` char(200) NOT NULL,
  `xw_date` int(20) DEFAULT NULL,
  `xw_flag` tinyint(4) NOT NULL COMMENT '0未发送，1已发送',
  `xw_to` int(20) NOT NULL,
  `xw_read` int(10) DEFAULT NULL,
  PRIMARY KEY (`xw_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xw
-- ----------------------------
INSERT INTO `xw` VALUES ('1', '开会', '1', '十点开会', '1577058319', '1', '1', '0');
INSERT INTO `xw` VALUES ('2', '取消开会', '1', '取消开会', '1577258319', '1', '1', '0');
INSERT INTO `xw` VALUES ('3', 'kaihui', '1', 'shidian', '1577258319', '0', '1', '0');
INSERT INTO `xw` VALUES ('4', '测试文件啦', '1', '我在进行测试！', '1577407549', '0', '1', '0');
INSERT INTO `xw` VALUES ('5', '测试文件', '2', '我在进行测试', '1577258319', '0', '1', '0');
INSERT INTO `xw` VALUES ('6', '测试3', '2', '进行测试', '1577285797', '1', '1', '1');
INSERT INTO `xw` VALUES ('7', 'e', '1', 'e', '1577326951', '1', '1', '1');
INSERT INTO `xw` VALUES ('8', 'w', '1', 'w', '1577287118', '1', '1', '1');
INSERT INTO `xw` VALUES ('9', '测试4', '1', '进行测试', '1577319360', '1', '1', '1');
INSERT INTO `xw` VALUES ('10', '测试5', '1', '进行测试', '1577319501', '1', '1', '1');
INSERT INTO `xw` VALUES ('12', '给行政部的一封信', '1', '全体成员速度来办公室一趟。', '1577335747', '1', '2', '1');
INSERT INTO `xw` VALUES ('13', 'test', '1', 'test', '1577369561', '1', '1', '0');
INSERT INTO `xw` VALUES ('14', 'test1', '1', 'test1', '1577369570', '1', '1', '0');
INSERT INTO `xw` VALUES ('15', '请汇报招聘情况', '1', '请汇报招聘情况，十点前发给我', '1577412567', '1', '3', '1');

-- ----------------------------
-- Table structure for `xwcl`
-- ----------------------------
DROP TABLE IF EXISTS `xwcl`;
CREATE TABLE `xwcl` (
  `xwcl_id` int(20) NOT NULL AUTO_INCREMENT,
  `xw_id` int(20) NOT NULL,
  `xwcl_content` char(200) NOT NULL,
  `xw_receiver` char(20) NOT NULL,
  `xwcl_date` int(20) NOT NULL,
  PRIMARY KEY (`xwcl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xwcl
-- ----------------------------
INSERT INTO `xwcl` VALUES ('1', '1', '34', '1', '1577329978');
INSERT INTO `xwcl` VALUES ('2', '1', '343', '1', '1577330042');
INSERT INTO `xwcl` VALUES ('3', '10', 'e3r4', '1', '1577330462');
INSERT INTO `xwcl` VALUES ('4', '12', '收到', '2', '1577335891');
INSERT INTO `xwcl` VALUES ('5', '15', '人力资源部收到', '3', '1577412638');
INSERT INTO `xwcl` VALUES ('6', '15', '出了点小问题，请稍等', '3', '1577412695');

-- ----------------------------
-- Table structure for `xw_flag`
-- ----------------------------
DROP TABLE IF EXISTS `xw_flag`;
CREATE TABLE `xw_flag` (
  `xw_flag` tinyint(4) NOT NULL,
  `descript` char(200) DEFAULT NULL,
  PRIMARY KEY (`xw_flag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xw_flag
-- ----------------------------
INSERT INTO `xw_flag` VALUES ('0', '未发送');
INSERT INTO `xw_flag` VALUES ('1', '已经发送');
