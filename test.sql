/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-02-18 17:27:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bhy_action
-- ----------------------------
DROP TABLE IF EXISTS `bhy_action`;
CREATE TABLE `bhy_action` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '行为唯一标识',
  `title` char(80) NOT NULL DEFAULT '' COMMENT '行为说明',
  `remark` char(140) NOT NULL DEFAULT '' COMMENT '行为描述',
  `rule` text NOT NULL COMMENT '行为规则',
  `log` text NOT NULL COMMENT '日志规则',
  `type` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='系统行为表';

-- ----------------------------
-- Records of bhy_action
-- ----------------------------
INSERT INTO `bhy_action` VALUES ('1', 'user_login', '用户登录', '积分+10，每天一次', 'table:member|field:score|condition:uid={$self} AND status>-1|rule:score+10|cycle:24|max:1;', '[user|get_nickname]在[time|time_format]登录了后台', '1', '1', '1387181220');
INSERT INTO `bhy_action` VALUES ('2', 'add_article', '发布文章', '积分+5，每天上限5次', 'table:member|field:score|condition:uid={$self}|rule:score+5|cycle:24|max:5', '', '2', '0', '1380173180');
INSERT INTO `bhy_action` VALUES ('3', 'review', '评论', '评论积分+1，无限制', 'table:member|field:score|condition:uid={$self}|rule:score+1', '', '2', '1', '1383285646');
INSERT INTO `bhy_action` VALUES ('4', 'add_document', '发表文档', '积分+10，每天上限5次', 'table:member|field:score|condition:uid={$self}|rule:score+10|cycle:24|max:5', '[user|get_nickname]在[time|time_format]发表了一篇文章。\r\n表[model]，记录编号[record]。', '2', '0', '1386139726');
INSERT INTO `bhy_action` VALUES ('5', 'add_document_topic', '发表讨论', '积分+5，每天上限10次', 'table:member|field:score|condition:uid={$self}|rule:score+5|cycle:24|max:10', '', '2', '0', '1383285551');
INSERT INTO `bhy_action` VALUES ('6', 'update_config', '更新配置', '新增或修改或删除配置', '', '', '1', '1', '1383294988');
INSERT INTO `bhy_action` VALUES ('7', 'update_model', '更新模型', '新增或修改模型', '', '', '1', '1', '1383295057');
INSERT INTO `bhy_action` VALUES ('8', 'update_attribute', '更新属性', '新增或更新或删除属性', '', '', '1', '1', '1383295963');
INSERT INTO `bhy_action` VALUES ('9', 'update_channel', '更新导航', '新增或修改或删除导航', '', '', '1', '1', '1383296301');
INSERT INTO `bhy_action` VALUES ('10', 'update_menu', '更新菜单', '新增或修改或删除菜单', '', '', '1', '1', '1383296392');
INSERT INTO `bhy_action` VALUES ('11', 'update_category', '更新分类', '新增或修改或删除分类', '', '', '1', '1', '1383296765');

-- ----------------------------
-- Table structure for bhy_action_log
-- ----------------------------
DROP TABLE IF EXISTS `bhy_action_log`;
CREATE TABLE `bhy_action_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `action_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '行为id',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行用户id',
  `action_ip` bigint(20) NOT NULL COMMENT '执行行为者ip',
  `model` varchar(50) NOT NULL DEFAULT '' COMMENT '触发行为的表',
  `record_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '触发行为的数据id',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '日志备注',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '执行行为的时间',
  PRIMARY KEY (`id`),
  KEY `action_ip_ix` (`action_ip`),
  KEY `action_id_ix` (`action_id`),
  KEY `user_id_ix` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED COMMENT='行为日志表';

-- ----------------------------
-- Records of bhy_action_log
-- ----------------------------
INSERT INTO `bhy_action_log` VALUES ('1', '10', '1', '2130706433', 'Menu', '335', '操作url：/index.php?s=/Admin/Menu/add.html', '1', '1550461180');
INSERT INTO `bhy_action_log` VALUES ('2', '10', '1', '2130706433', 'Menu', '335', '操作url：/index.php?s=/Admin/Menu/edit.html', '1', '1550461395');
INSERT INTO `bhy_action_log` VALUES ('3', '10', '1', '2130706433', 'Menu', '63', '操作url：/index.php?s=/Admin/Menu/edit.html', '1', '1550466537');
INSERT INTO `bhy_action_log` VALUES ('4', '10', '1', '2130706433', 'Menu', '171', '操作url：/index.php?s=/Admin/Menu/edit.html', '1', '1550466552');
INSERT INTO `bhy_action_log` VALUES ('5', '10', '1', '2130706433', 'Menu', '63', '操作url：/index.php?s=/Admin/Menu/edit.html', '1', '1550466594');
INSERT INTO `bhy_action_log` VALUES ('6', '10', '1', '2130706433', 'Menu', '171', '操作url：/index.php?s=/Admin/Menu/edit.html', '1', '1550466606');
INSERT INTO `bhy_action_log` VALUES ('7', '10', '1', '2130706433', 'Menu', '183', '操作url：/index.php?s=/Admin/Menu/edit.html', '1', '1550466615');
INSERT INTO `bhy_action_log` VALUES ('8', '10', '1', '2130706433', 'Menu', '183', '操作url：/index.php?s=/Admin/Menu/edit.html', '1', '1550466645');
INSERT INTO `bhy_action_log` VALUES ('9', '11', '1', '2130706433', 'category', '6', '操作url：/index.php?s=/Admin/Category/remove/id/6.html', '1', '1550466918');
INSERT INTO `bhy_action_log` VALUES ('10', '11', '1', '2130706433', 'category', '22', '操作url：/index.php?s=/Admin/Category/remove/id/22.html', '1', '1550466921');
INSERT INTO `bhy_action_log` VALUES ('11', '11', '1', '2130706433', 'category', '21', '操作url：/index.php?s=/Admin/Category/remove/id/21.html', '1', '1550466923');
INSERT INTO `bhy_action_log` VALUES ('12', '11', '1', '2130706433', 'category', '20', '操作url：/index.php?s=/Admin/Category/remove/id/20.html', '1', '1550466926');
INSERT INTO `bhy_action_log` VALUES ('13', '11', '1', '2130706433', 'category', '59', '操作url：/index.php?s=/Admin/Category/remove/id/59.html', '1', '1550466929');
INSERT INTO `bhy_action_log` VALUES ('14', '11', '1', '2130706433', 'category', '58', '操作url：/index.php?s=/Admin/Category/remove/id/58.html', '1', '1550466935');
INSERT INTO `bhy_action_log` VALUES ('15', '11', '1', '2130706433', 'category', '57', '操作url：/index.php?s=/Admin/Category/remove/id/57.html', '1', '1550466937');
INSERT INTO `bhy_action_log` VALUES ('16', '11', '1', '2130706433', 'category', '56', '操作url：/index.php?s=/Admin/Category/remove/id/56.html', '1', '1550466939');
INSERT INTO `bhy_action_log` VALUES ('17', '11', '1', '2130706433', 'category', '55', '操作url：/index.php?s=/Admin/Category/remove/id/55.html', '1', '1550466943');
INSERT INTO `bhy_action_log` VALUES ('18', '11', '1', '2130706433', 'category', '19', '操作url：/index.php?s=/Admin/Category/remove/id/19.html', '1', '1550466948');
INSERT INTO `bhy_action_log` VALUES ('19', '11', '1', '2130706433', 'category', '55', '操作url：/index.php?s=/Admin/Category/remove/id/55.html', '1', '1550466950');
INSERT INTO `bhy_action_log` VALUES ('20', '11', '1', '2130706433', 'category', '5', '操作url：/index.php?s=/Admin/Category/remove/id/5.html', '1', '1550466952');
INSERT INTO `bhy_action_log` VALUES ('21', '11', '1', '2130706433', 'category', '5', '操作url：/index.php?s=/Admin/Category/remove/id/5.html', '1', '1550466955');
INSERT INTO `bhy_action_log` VALUES ('22', '11', '1', '2130706433', 'category', '53', '操作url：/index.php?s=/Admin/Category/remove/id/53.html', '1', '1550466957');
INSERT INTO `bhy_action_log` VALUES ('23', '11', '1', '2130706433', 'category', '4', '操作url：/index.php?s=/Admin/Category/remove/id/4.html', '1', '1550466959');
INSERT INTO `bhy_action_log` VALUES ('24', '11', '1', '2130706433', 'category', '18', '操作url：/index.php?s=/Admin/Category/remove/id/18.html', '1', '1550466961');
INSERT INTO `bhy_action_log` VALUES ('25', '11', '1', '2130706433', 'category', '18', '操作url：/index.php?s=/Admin/Category/remove/id/18.html', '1', '1550466965');
INSERT INTO `bhy_action_log` VALUES ('26', '11', '1', '2130706433', 'category', '17', '操作url：/index.php?s=/Admin/Category/remove/id/17.html', '1', '1550466966');
INSERT INTO `bhy_action_log` VALUES ('27', '11', '1', '2130706433', 'category', '17', '操作url：/index.php?s=/Admin/Category/remove/id/17.html', '1', '1550466968');
INSERT INTO `bhy_action_log` VALUES ('28', '11', '1', '2130706433', 'category', '3', '操作url：/index.php?s=/Admin/Category/remove/id/3.html', '1', '1550466971');
INSERT INTO `bhy_action_log` VALUES ('29', '11', '1', '2130706433', 'category', '16', '操作url：/index.php?s=/Admin/Category/remove/id/16.html', '1', '1550466973');
INSERT INTO `bhy_action_log` VALUES ('30', '11', '1', '2130706433', 'category', '16', '操作url：/index.php?s=/Admin/Category/remove/id/16.html', '1', '1550466976');
INSERT INTO `bhy_action_log` VALUES ('31', '11', '1', '2130706433', 'category', '15', '操作url：/index.php?s=/Admin/Category/remove/id/15.html', '1', '1550466979');
INSERT INTO `bhy_action_log` VALUES ('32', '11', '1', '2130706433', 'category', '60', '操作url：/index.php?s=/Admin/Category/remove/id/60.html', '1', '1550466983');
INSERT INTO `bhy_action_log` VALUES ('33', '11', '1', '2130706433', 'category', '14', '操作url：/index.php?s=/Admin/Category/remove/id/14.html', '1', '1550466985');
INSERT INTO `bhy_action_log` VALUES ('34', '11', '1', '2130706433', 'category', '13', '操作url：/index.php?s=/Admin/Category/remove/id/13.html', '1', '1550466987');
INSERT INTO `bhy_action_log` VALUES ('35', '11', '1', '2130706433', 'category', '13', '操作url：/index.php?s=/Admin/Category/remove/id/13.html', '1', '1550466990');
INSERT INTO `bhy_action_log` VALUES ('36', '11', '1', '2130706433', 'category', '2', '操作url：/index.php?s=/Admin/Category/remove/id/2.html', '1', '1550466992');
INSERT INTO `bhy_action_log` VALUES ('37', '11', '1', '2130706433', 'category', '2', '操作url：/index.php?s=/Admin/Category/remove/id/2.html', '1', '1550466997');
INSERT INTO `bhy_action_log` VALUES ('38', '11', '1', '2130706433', 'category', '12', '操作url：/index.php?s=/Admin/Category/remove/id/12.html', '1', '1550467003');
INSERT INTO `bhy_action_log` VALUES ('39', '11', '1', '2130706433', 'category', '11', '操作url：/index.php?s=/Admin/Category/remove/id/11.html', '1', '1550467005');
INSERT INTO `bhy_action_log` VALUES ('40', '11', '1', '2130706433', 'category', '10', '操作url：/index.php?s=/Admin/Category/remove/id/10.html', '1', '1550467008');
INSERT INTO `bhy_action_log` VALUES ('41', '11', '1', '2130706433', 'category', '10', '操作url：/index.php?s=/Admin/Category/remove/id/10.html', '1', '1550467011');
INSERT INTO `bhy_action_log` VALUES ('42', '11', '1', '2130706433', 'category', '1', '操作url：/index.php?s=/Admin/Category/remove/id/1.html', '1', '1550467013');
INSERT INTO `bhy_action_log` VALUES ('43', '11', '1', '2130706433', 'category', '52', '操作url：/index.php?s=/Admin/Category/remove/id/52.html', '1', '1550467016');
INSERT INTO `bhy_action_log` VALUES ('44', '11', '1', '2130706433', 'category', '51', '操作url：/index.php?s=/Admin/Category/remove/id/51.html', '1', '1550467018');
INSERT INTO `bhy_action_log` VALUES ('45', '11', '1', '2130706433', 'category', '50', '操作url：/index.php?s=/Admin/Category/remove/id/50.html', '1', '1550467020');
INSERT INTO `bhy_action_log` VALUES ('46', '11', '1', '2130706433', 'category', '49', '操作url：/index.php?s=/Admin/Category/remove/id/49.html', '1', '1550467022');
INSERT INTO `bhy_action_log` VALUES ('47', '11', '1', '2130706433', 'category', '48', '操作url：/index.php?s=/Admin/Category/remove/id/48.html', '1', '1550467030');
INSERT INTO `bhy_action_log` VALUES ('48', '11', '1', '2130706433', 'category', '47', '操作url：/index.php?s=/Admin/Category/remove/id/47.html', '1', '1550467032');
INSERT INTO `bhy_action_log` VALUES ('49', '11', '1', '2130706433', 'category', '45', '操作url：/index.php?s=/Admin/Category/remove/id/45.html', '1', '1550467034');
INSERT INTO `bhy_action_log` VALUES ('50', '11', '1', '2130706433', 'category', '46', '操作url：/index.php?s=/Admin/Category/remove/id/46.html', '1', '1550467036');
INSERT INTO `bhy_action_log` VALUES ('51', '11', '1', '2130706433', 'category', '44', '操作url：/index.php?s=/Admin/Category/remove/id/44.html', '1', '1550467038');
INSERT INTO `bhy_action_log` VALUES ('52', '11', '1', '2130706433', 'category', '44', '操作url：/index.php?s=/Admin/Category/remove/id/44.html', '1', '1550467044');
INSERT INTO `bhy_action_log` VALUES ('53', '11', '1', '2130706433', 'category', '43', '操作url：/index.php?s=/Admin/Category/remove/id/43.html', '1', '1550467046');
INSERT INTO `bhy_action_log` VALUES ('54', '11', '1', '2130706433', 'category', '42', '操作url：/index.php?s=/Admin/Category/remove/id/42.html', '1', '1550467048');
INSERT INTO `bhy_action_log` VALUES ('55', '11', '1', '2130706433', 'category', '31', '操作url：/index.php?s=/Admin/Category/remove/id/31.html', '1', '1550467051');
INSERT INTO `bhy_action_log` VALUES ('56', '11', '1', '2130706433', 'category', '39', '操作url：/index.php?s=/Admin/Category/remove/id/39.html', '1', '1550467054');
INSERT INTO `bhy_action_log` VALUES ('57', '11', '1', '2130706433', 'category', '38', '操作url：/index.php?s=/Admin/Category/remove/id/38.html', '1', '1550467058');
INSERT INTO `bhy_action_log` VALUES ('58', '11', '1', '2130706433', 'category', '38', '操作url：/index.php?s=/Admin/Category/remove/id/38.html', '1', '1550467061');
INSERT INTO `bhy_action_log` VALUES ('59', '11', '1', '2130706433', 'category', '41', '操作url：/index.php?s=/Admin/Category/remove/id/41.html', '1', '1550467063');
INSERT INTO `bhy_action_log` VALUES ('60', '11', '1', '2130706433', 'category', '30', '操作url：/index.php?s=/Admin/Category/remove/id/30.html', '1', '1550467065');
INSERT INTO `bhy_action_log` VALUES ('61', '11', '1', '2130706433', 'category', '40', '操作url：/index.php?s=/Admin/Category/remove/id/40.html', '1', '1550467068');
INSERT INTO `bhy_action_log` VALUES ('62', '11', '1', '2130706433', 'category', '29', '操作url：/index.php?s=/Admin/Category/remove/id/29.html', '1', '1550467071');
INSERT INTO `bhy_action_log` VALUES ('63', '11', '1', '2130706433', 'category', '37', '操作url：/index.php?s=/Admin/Category/remove/id/37.html', '1', '1550467073');
INSERT INTO `bhy_action_log` VALUES ('64', '11', '1', '2130706433', 'category', '36', '操作url：/index.php?s=/Admin/Category/remove/id/36.html', '1', '1550467075');
INSERT INTO `bhy_action_log` VALUES ('65', '11', '1', '2130706433', 'category', '35', '操作url：/index.php?s=/Admin/Category/remove/id/35.html', '1', '1550467078');
INSERT INTO `bhy_action_log` VALUES ('66', '11', '1', '2130706433', 'category', '35', '操作url：/index.php?s=/Admin/Category/remove/id/35.html', '1', '1550467080');
INSERT INTO `bhy_action_log` VALUES ('67', '11', '1', '2130706433', 'category', '28', '操作url：/index.php?s=/Admin/Category/remove/id/28.html', '1', '1550467084');
INSERT INTO `bhy_action_log` VALUES ('68', '11', '1', '2130706433', 'category', '28', '操作url：/index.php?s=/Admin/Category/remove/id/28.html', '1', '1550467096');
INSERT INTO `bhy_action_log` VALUES ('69', '11', '1', '2130706433', 'category', '34', '操作url：/index.php?s=/Admin/Category/remove/id/34.html', '1', '1550467098');
INSERT INTO `bhy_action_log` VALUES ('70', '11', '1', '2130706433', 'category', '33', '操作url：/index.php?s=/Admin/Category/remove/id/33.html', '1', '1550467100');
INSERT INTO `bhy_action_log` VALUES ('71', '11', '1', '2130706433', 'category', '27', '操作url：/index.php?s=/Admin/Category/remove/id/27.html', '1', '1550467102');
INSERT INTO `bhy_action_log` VALUES ('72', '11', '1', '2130706433', 'category', '27', '操作url：/index.php?s=/Admin/Category/remove/id/27.html', '1', '1550467105');
INSERT INTO `bhy_action_log` VALUES ('73', '11', '1', '2130706433', 'category', '26', '操作url：/index.php?s=/Admin/Category/remove/id/26.html', '1', '1550467106');
INSERT INTO `bhy_action_log` VALUES ('74', '11', '1', '2130706433', 'category', '24', '操作url：/index.php?s=/Admin/Category/remove/id/24.html', '1', '1550467108');
INSERT INTO `bhy_action_log` VALUES ('75', '11', '1', '2130706433', 'category', '25', '操作url：/index.php?s=/Admin/Category/remove/id/25.html', '1', '1550467110');
INSERT INTO `bhy_action_log` VALUES ('76', '11', '1', '2130706433', 'category', '23', '操作url：/index.php?s=/Admin/Category/remove/id/23.html', '1', '1550467114');
INSERT INTO `bhy_action_log` VALUES ('77', '11', '1', '2130706433', 'category', '9', '操作url：/index.php?s=/Admin/Category/remove/id/9.html', '1', '1550467115');
INSERT INTO `bhy_action_log` VALUES ('78', '11', '1', '2130706433', 'category', '9', '操作url：/index.php?s=/Admin/Category/remove/id/9.html', '1', '1550467117');
INSERT INTO `bhy_action_log` VALUES ('79', '11', '1', '2130706433', 'category', '8', '操作url：/index.php?s=/Admin/Category/remove/id/8.html', '1', '1550467119');
INSERT INTO `bhy_action_log` VALUES ('80', '11', '1', '2130706433', 'category', '7', '操作url：/index.php?s=/Admin/Category/remove/id/7.html', '1', '1550467121');
INSERT INTO `bhy_action_log` VALUES ('81', '11', '1', '2130706433', 'category', '1', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550467491');
INSERT INTO `bhy_action_log` VALUES ('82', '11', '1', '2130706433', 'category', '3', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550467492');
INSERT INTO `bhy_action_log` VALUES ('83', '11', '1', '2130706433', 'category', '2', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550467493');
INSERT INTO `bhy_action_log` VALUES ('84', '11', '1', '2130706433', 'category', '5', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550467494');
INSERT INTO `bhy_action_log` VALUES ('85', '11', '1', '2130706433', 'category', '4', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550467494');
INSERT INTO `bhy_action_log` VALUES ('86', '11', '1', '2130706433', 'category', '6', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550467495');
INSERT INTO `bhy_action_log` VALUES ('87', '11', '1', '2130706433', 'category', '12', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550468246');
INSERT INTO `bhy_action_log` VALUES ('88', '11', '1', '2130706433', 'category', '21', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550468731');
INSERT INTO `bhy_action_log` VALUES ('89', '1', '1', '2130706433', 'member', '1', '超级管理员在2019-02-18 13:46:58登录了后台', '1', '1550468818');
INSERT INTO `bhy_action_log` VALUES ('90', '11', '1', '2130706433', 'category', '29', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550471261');
INSERT INTO `bhy_action_log` VALUES ('91', '11', '1', '2130706433', 'category', '28', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550471270');
INSERT INTO `bhy_action_log` VALUES ('92', '11', '1', '2130706433', 'category', '23', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550471279');
INSERT INTO `bhy_action_log` VALUES ('93', '11', '1', '2130706433', 'category', '26', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550471288');
INSERT INTO `bhy_action_log` VALUES ('94', '11', '1', '2130706433', 'category', '22', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550471324');
INSERT INTO `bhy_action_log` VALUES ('95', '11', '1', '2130706433', 'category', '25', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550471332');
INSERT INTO `bhy_action_log` VALUES ('96', '11', '1', '2130706433', 'category', '27', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550471350');
INSERT INTO `bhy_action_log` VALUES ('97', '11', '1', '2130706433', 'category', '31', '操作url：/index.php?s=/Admin/Category/remove/id/31.html', '1', '1550471421');
INSERT INTO `bhy_action_log` VALUES ('98', '11', '1', '2130706433', 'category', '34', '操作url：/index.php?s=/Admin/Category/remove/id/34.html', '1', '1550471576');
INSERT INTO `bhy_action_log` VALUES ('99', '11', '1', '2130706433', 'category', '33', '操作url：/index.php?s=/Admin/Category/remove/id/33.html', '1', '1550471578');
INSERT INTO `bhy_action_log` VALUES ('100', '11', '1', '2130706433', 'category', '32', '操作url：/index.php?s=/Admin/Category/remove/id/32.html', '1', '1550471581');
INSERT INTO `bhy_action_log` VALUES ('101', '11', '1', '2130706433', 'category', '24', '操作url：/index.php?s=/Admin/Category/remove/id/24.html', '1', '1550471584');
INSERT INTO `bhy_action_log` VALUES ('102', '10', '1', '2130706433', 'Menu', '0', '操作url：/index.php?s=/Admin/Menu/del/id/335.html', '1', '1550474927');
INSERT INTO `bhy_action_log` VALUES ('103', '11', '1', '2130706433', 'category', '15', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550476211');
INSERT INTO `bhy_action_log` VALUES ('104', '11', '1', '2130706433', 'category', '44', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550476908');
INSERT INTO `bhy_action_log` VALUES ('105', '1', '1', '2130706433', 'member', '1', '超级管理员在2019-02-18 16:29:34登录了后台', '1', '1550478574');
INSERT INTO `bhy_action_log` VALUES ('106', '1', '1', '2130706433', 'member', '1', '超级管理员在2019-02-18 16:39:05登录了后台', '1', '1550479145');
INSERT INTO `bhy_action_log` VALUES ('107', '1', '1', '2130706433', 'member', '1', '超级管理员在2019-02-18 16:41:57登录了后台', '1', '1550479317');
INSERT INTO `bhy_action_log` VALUES ('108', '1', '1', '2130706433', 'member', '1', '超级管理员在2019-02-18 17:03:05登录了后台', '1', '1550480585');
INSERT INTO `bhy_action_log` VALUES ('109', '11', '1', '2130706433', 'category', '1', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550481084');
INSERT INTO `bhy_action_log` VALUES ('110', '11', '1', '2130706433', 'category', '7', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550481102');
INSERT INTO `bhy_action_log` VALUES ('111', '11', '1', '2130706433', 'category', '8', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550481116');
INSERT INTO `bhy_action_log` VALUES ('112', '11', '1', '2130706433', 'category', '9', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550481131');
INSERT INTO `bhy_action_log` VALUES ('113', '11', '1', '2130706433', 'category', '2', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550481176');
INSERT INTO `bhy_action_log` VALUES ('114', '11', '1', '2130706433', 'category', '10', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550481189');
INSERT INTO `bhy_action_log` VALUES ('115', '11', '1', '2130706433', 'category', '11', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550481201');
INSERT INTO `bhy_action_log` VALUES ('116', '11', '1', '2130706433', 'category', '3', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550481231');
INSERT INTO `bhy_action_log` VALUES ('117', '11', '1', '2130706433', 'category', '12', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550481247');
INSERT INTO `bhy_action_log` VALUES ('118', '11', '1', '2130706433', 'category', '14', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550481265');
INSERT INTO `bhy_action_log` VALUES ('119', '11', '1', '2130706433', 'category', '4', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550481295');
INSERT INTO `bhy_action_log` VALUES ('120', '11', '1', '2130706433', 'category', '15', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550481308');
INSERT INTO `bhy_action_log` VALUES ('121', '11', '1', '2130706433', 'category', '5', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550481331');
INSERT INTO `bhy_action_log` VALUES ('122', '11', '1', '2130706433', 'category', '16', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550481348');
INSERT INTO `bhy_action_log` VALUES ('123', '11', '1', '2130706433', 'category', '17', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550481363');
INSERT INTO `bhy_action_log` VALUES ('124', '11', '1', '2130706433', 'category', '18', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550481380');
INSERT INTO `bhy_action_log` VALUES ('125', '11', '1', '2130706433', 'category', '19', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550481395');
INSERT INTO `bhy_action_log` VALUES ('126', '11', '1', '2130706433', 'category', '6', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550481408');
INSERT INTO `bhy_action_log` VALUES ('127', '11', '1', '2130706433', 'category', '20', '操作url：/index.php?s=/Admin/Category/edit.html', '1', '1550481422');

-- ----------------------------
-- Table structure for bhy_ad
-- ----------------------------
DROP TABLE IF EXISTS `bhy_ad`;
CREATE TABLE `bhy_ad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '广告标题',
  `adbg` varchar(50) DEFAULT NULL COMMENT '广告背景色',
  `target` varchar(50) NOT NULL,
  `position` varchar(50) DEFAULT NULL COMMENT '广告位置',
  `icon` int(5) DEFAULT NULL COMMENT '广告图片id',
  `typeid` int(11) DEFAULT NULL COMMENT '所属分类id',
  `sort` int(10) NOT NULL COMMENT '广告排序',
  `url` varchar(255) DEFAULT NULL COMMENT '广告跳转地址',
  `remark` mediumtext NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `content` text COMMENT '广告内容',
  `bjicon` int(5) DEFAULT NULL COMMENT '背景图',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='广告表';

-- ----------------------------
-- Records of bhy_ad
-- ----------------------------
INSERT INTO `bhy_ad` VALUES ('23', '首页LOGO', null, '', null, '109', '1', '0', null, '', '1', null, null);
INSERT INTO `bhy_ad` VALUES ('24', '内页LOGO', null, '', null, '110', '2', '0', null, '', '1', null, null);
INSERT INTO `bhy_ad` VALUES ('25', '底部LOGO', null, '', null, '111', '3', '0', null, '', '1', null, null);
INSERT INTO `bhy_ad` VALUES ('26', '首页Banner', null, '', null, '112', '4', '0', null, '', '1', null, null);
INSERT INTO `bhy_ad` VALUES ('27', '内页电话LOGO', null, '', null, '113', '5', '0', null, '', '1', null, null);
INSERT INTO `bhy_ad` VALUES ('29', '官方二维码', null, '', null, '98', '7', '0', null, '', '1', null, null);

-- ----------------------------
-- Table structure for bhy_addons
-- ----------------------------
DROP TABLE IF EXISTS `bhy_addons`;
CREATE TABLE `bhy_addons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL COMMENT '插件名或标识',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '中文名',
  `description` text COMMENT '插件描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `config` text COMMENT '配置',
  `author` varchar(40) DEFAULT '' COMMENT '作者',
  `version` varchar(20) DEFAULT '' COMMENT '版本号',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '安装时间',
  `has_adminlist` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否有后台列表',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='插件表';

-- ----------------------------
-- Records of bhy_addons
-- ----------------------------
INSERT INTO `bhy_addons` VALUES ('15', 'EditorForAdmin', '后台编辑器', '用于增强整站长文本的输入和显示', '1', '{\"editor_type\":\"2\",\"editor_wysiwyg\":\"1\",\"editor_height\":\"500px\",\"editor_resize_type\":\"1\"}', 'thinkphp', '0.1', '1383126253', '0');
INSERT INTO `bhy_addons` VALUES ('2', 'SiteStat', '站点统计信息', '统计站点的基础信息', '1', '{\"title\":\"\\u7cfb\\u7edf\\u4fe1\\u606f\",\"width\":\"1\",\"display\":\"1\",\"status\":\"0\"}', 'thinkphp', '0.1', '1379512015', '0');
INSERT INTO `bhy_addons` VALUES ('3', 'DevTeam', '开发团队信息', '开发团队成员信息', '1', '{\"title\":\"OneThink\\u5f00\\u53d1\\u56e2\\u961f\",\"width\":\"2\",\"display\":\"1\"}', 'thinkphp', '0.1', '1379512022', '0');
INSERT INTO `bhy_addons` VALUES ('4', 'SystemInfo', '系统环境信息', '用于显示一些服务器的信息', '1', '{\"title\":\"\\u7cfb\\u7edf\\u4fe1\\u606f\",\"width\":\"2\",\"display\":\"1\"}', 'thinkphp', '0.1', '1379512036', '0');
INSERT INTO `bhy_addons` VALUES ('5', 'Editor', '前台编辑器', '用于增强整站长文本的输入和显示', '1', '{\"editor_type\":\"2\",\"editor_wysiwyg\":\"1\",\"editor_height\":\"300px\",\"editor_resize_type\":\"1\"}', 'thinkphp', '0.1', '1379830910', '0');
INSERT INTO `bhy_addons` VALUES ('6', 'Attachment', '附件', '用于文档模型上传附件', '1', 'null', 'thinkphp', '0.1', '1379842319', '1');
INSERT INTO `bhy_addons` VALUES ('9', 'SocialComment', '通用社交化评论', '集成了各种社交化评论插件，轻松集成到系统中。', '1', '{\"comment_type\":\"1\",\"comment_uid_youyan\":\"\",\"comment_short_name_duoshuo\":\"\",\"comment_data_list_duoshuo\":\"\"}', 'thinkphp', '0.1', '1380273962', '0');
INSERT INTO `bhy_addons` VALUES ('22', 'UploadImages', '多图上传', '多图上传', '1', 'null', '木梁大囧', '1.2', '1427782952', '0');
INSERT INTO `bhy_addons` VALUES ('28', 'Weather', '天气预报', '天气预报', '1', '{\"title\":\"\\u5929\\u6c14\\u9884\\u62a5\",\"city\":\"\",\"showplace\":[\"1\"],\"showday\":\"1\",\"ak\":\"51da9f03c9731fa65316f2c93c13cb26\",\"width\":\"1\",\"display\":\"1\"}', 'cepljxiongjun', '0.1', '1428902762', '0');

-- ----------------------------
-- Table structure for bhy_article
-- ----------------------------
DROP TABLE IF EXISTS `bhy_article`;
CREATE TABLE `bhy_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `title` varchar(200) DEFAULT NULL COMMENT '新闻标题',
  `egname` varchar(200) DEFAULT NULL COMMENT '英文标题',
  `short_title` varchar(200) DEFAULT NULL COMMENT '短标题',
  `en_short_title` varchar(200) DEFAULT NULL COMMENT '英文短标题',
  `typeid` varchar(10) NOT NULL COMMENT '新闻类别',
  `keywords` varchar(100) DEFAULT NULL COMMENT '新闻关键词',
  `descriptions` varchar(250) DEFAULT NULL COMMENT '新闻描述',
  `egdescriptions` varchar(250) DEFAULT NULL COMMENT '英文描述',
  `content` mediumtext COMMENT '新闻内容',
  `egcontent` text COMMENT '英文内容',
  `status` int(5) NOT NULL DEFAULT '1' COMMENT '新闻状态',
  `icon` int(10) NOT NULL COMMENT '新闻缩略图ID',
  `file` int(10) DEFAULT '0',
  `flag` varchar(50) DEFAULT NULL COMMENT '新闻属性',
  `sort` int(10) NOT NULL COMMENT '新闻排序',
  `view` int(10) NOT NULL COMMENT '新闻浏览量',
  `create_time` int(20) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(20) DEFAULT NULL COMMENT '修改时间',
  `mid` int(10) NOT NULL COMMENT '添加人',
  `source_web` varchar(50) DEFAULT NULL COMMENT '新闻来源',
  `source_egweb` varchar(50) DEFAULT NULL COMMENT '英文新闻来源',
  `author` varchar(100) DEFAULT NULL COMMENT '作者',
  `egauthor` varchar(100) DEFAULT NULL COMMENT '英文作者',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bhy_article
-- ----------------------------
INSERT INTO `bhy_article` VALUES ('95', '测评通知1', 'cptz', '', '', '21', null, '', '', '测评通知1111111111111111111111111111111111111111', '', '1', '152', '0', null, '0', '0', '1550468788', '1550468844', '1', '', '', '管理员发布', '');
INSERT INTO `bhy_article` VALUES ('96', '测评通知2', 'cptz2', '', '', '21', null, '', '', '', '', '1', '0', '0', null, '0', '0', '1550468871', null, '1', '', '', '管理员发布', '');
INSERT INTO `bhy_article` VALUES ('97', '测评通知3', 'pctz', '', '', '21', null, '', '', '测评通知3恶33333333', '', '1', '0', '0', null, '0', '0', '1550469786', '1550469810', '1', '', '', '管理员发布', '');
INSERT INTO `bhy_article` VALUES ('98', '测评通知4', 'cptz', '', '', '21', null, '', '', '测评通知4444444444444444444444444', '', '1', '0', '0', null, '0', '0', '1550469839', '1550469893', '1', '', '', '管理员发布', '');
INSERT INTO `bhy_article` VALUES ('99', '测评通知3', 'cptz', '', '', '21', null, '', '', '', '', '1', '0', '0', null, '0', '0', '1550469919', null, '1', '', '', '管理员发布', '');
INSERT INTO `bhy_article` VALUES ('100', '新闻资讯', '', '', '', '13', null, '', '', '新闻资讯1111111111111111111111111111111111111111111111111111', '', '1', '156', '0', '1', '0', '0', '1550473285', null, '1', '', '', '管理员发布', '');
INSERT INTO `bhy_article` VALUES ('101', '新闻资讯2', '', '', '', '13', null, '', '', '新闻资讯2222222222222222222222222', '', '1', '157', '0', '1', '0', '0', '1550473424', '1550473440', '1', '', '', '管理员发布', '');
INSERT INTO `bhy_article` VALUES ('102', '新闻资讯3', '', '', '', '13', null, '', '', '新闻资讯3333333333333333333333333', '', '1', '158', '0', '1', '0', '0', '1550473473', '1550474317', '1', '', '', '管理员发布', '');
INSERT INTO `bhy_article` VALUES ('103', '规程介绍', '', '', '', '7', null, '', '', '规程介绍<span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程<span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span>规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介</span>规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍<span>绍规程介绍规程介绍规程介绍规程介绍规程介绍<span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span><span>规程介绍</span>规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程介绍规程</span>', '', '1', '0', '0', null, '0', '0', '1550474613', null, '1', '', '', '管理员发布', '');
INSERT INTO `bhy_article` VALUES ('104', 'CEVE管理中心', '', '', '', '8', null, '', '', 'CEVE管理中心', '', '1', '0', '0', null, '0', '0', '1550475011', null, '1', '', '', '管理员发布', '');
INSERT INTO `bhy_article` VALUES ('105', '媒体聚焦1111', '', '', '', '15', null, '', '', '媒体聚焦1111', '', '1', '0', '0', null, '0', '0', '1550476248', null, '1', '', '', '管理员发布', '');

-- ----------------------------
-- Table structure for bhy_attachment
-- ----------------------------
DROP TABLE IF EXISTS `bhy_attachment`;
CREATE TABLE `bhy_attachment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户ID',
  `title` char(30) NOT NULL DEFAULT '' COMMENT '附件显示名',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '附件类型',
  `source` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '资源ID',
  `record_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '关联记录ID',
  `download` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '下载次数',
  `size` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '附件大小',
  `dir` int(12) unsigned NOT NULL DEFAULT '0' COMMENT '上级目录ID',
  `sort` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `idx_record_status` (`record_id`,`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='附件表';

-- ----------------------------
-- Records of bhy_attachment
-- ----------------------------

-- ----------------------------
-- Table structure for bhy_attribute
-- ----------------------------
DROP TABLE IF EXISTS `bhy_attribute`;
CREATE TABLE `bhy_attribute` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '字段名',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '字段注释',
  `field` varchar(100) NOT NULL DEFAULT '' COMMENT '字段定义',
  `type` varchar(20) NOT NULL DEFAULT '' COMMENT '数据类型',
  `value` varchar(100) NOT NULL DEFAULT '' COMMENT '字段默认值',
  `remark` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  `is_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '参数',
  `model_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '模型id',
  `is_must` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否必填',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `validate_rule` varchar(255) NOT NULL,
  `validate_time` tinyint(1) unsigned NOT NULL,
  `error_info` varchar(100) NOT NULL,
  `validate_type` varchar(25) NOT NULL,
  `auto_rule` varchar(100) NOT NULL,
  `auto_time` tinyint(1) unsigned NOT NULL,
  `auto_type` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `model_id` (`model_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='模型属性表';

-- ----------------------------
-- Records of bhy_attribute
-- ----------------------------
INSERT INTO `bhy_attribute` VALUES ('1', 'uid', '用户ID', 'int(10) unsigned NOT NULL ', 'num', '0', '', '0', '', '1', '0', '1', '1384508362', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('2', 'name', '标识', 'char(40) NOT NULL ', 'string', '', '同一根节点下标识不重复', '1', '', '1', '0', '1', '1383894743', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('3', 'title', '标题', 'char(80) NOT NULL ', 'string', '', '文档标题', '1', '', '1', '0', '1', '1383894778', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('4', 'category_id', '所属分类', 'int(10) unsigned NOT NULL ', 'string', '', '', '0', '', '1', '0', '1', '1384508336', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('5', 'description', '描述', 'char(140) NOT NULL ', 'textarea', '', '', '1', '', '1', '0', '1', '1383894927', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('6', 'root', '根节点', 'int(10) unsigned NOT NULL ', 'num', '0', '该文档的顶级文档编号', '0', '', '1', '0', '1', '1384508323', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('7', 'pid', '所属ID', 'int(10) unsigned NOT NULL ', 'num', '0', '父文档编号', '0', '', '1', '0', '1', '1384508543', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('8', 'model_id', '内容模型ID', 'tinyint(3) unsigned NOT NULL ', 'num', '0', '该文档所对应的模型', '0', '', '1', '0', '1', '1384508350', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('9', 'type', '内容类型', 'tinyint(3) unsigned NOT NULL ', 'select', '2', '', '1', '1:目录\r\n2:主题\r\n3:段落', '1', '0', '1', '1384511157', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('10', 'position', '推荐位', 'smallint(5) unsigned NOT NULL ', 'checkbox', '0', '多个推荐则将其推荐值相加', '1', '1:列表推荐\r\n2:频道页推荐\r\n4:首页推荐', '1', '0', '1', '1383895640', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('11', 'link_id', '外链', 'int(10) unsigned NOT NULL ', 'num', '0', '0-非外链，大于0-外链ID,需要函数进行链接与编号的转换', '1', '', '1', '0', '1', '1383895757', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('12', 'cover_id', '封面', 'int(10) unsigned NOT NULL ', 'picture', '0', '0-无封面，大于0-封面图片ID，需要函数处理', '1', '', '1', '0', '1', '1384147827', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('13', 'display', '可见性', 'tinyint(3) unsigned NOT NULL ', 'radio', '1', '', '1', '0:不可见\r\n1:所有人可见', '1', '0', '1', '1386662271', '1383891233', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `bhy_attribute` VALUES ('14', 'deadline', '截至时间', 'int(10) unsigned NOT NULL ', 'datetime', '0', '0-永久有效', '1', '', '1', '0', '1', '1387163248', '1383891233', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `bhy_attribute` VALUES ('15', 'attach', '附件数量', 'tinyint(3) unsigned NOT NULL ', 'num', '0', '', '0', '', '1', '0', '1', '1387260355', '1383891233', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `bhy_attribute` VALUES ('16', 'view', '浏览量', 'int(10) unsigned NOT NULL ', 'num', '0', '', '1', '', '1', '0', '1', '1383895835', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('17', 'comment', '评论数', 'int(10) unsigned NOT NULL ', 'num', '0', '', '1', '', '1', '0', '1', '1383895846', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('18', 'extend', '扩展统计字段', 'int(10) unsigned NOT NULL ', 'num', '0', '根据需求自行使用', '0', '', '1', '0', '1', '1384508264', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('19', 'level', '优先级', 'int(10) unsigned NOT NULL ', 'num', '0', '越高排序越靠前', '1', '', '1', '0', '1', '1383895894', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('20', 'create_time', '创建时间', 'int(10) unsigned NOT NULL ', 'datetime', '0', '', '1', '', '1', '0', '1', '1383895903', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('21', 'update_time', '更新时间', 'int(10) unsigned NOT NULL ', 'datetime', '0', '', '0', '', '1', '0', '1', '1384508277', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('22', 'status', '数据状态', 'tinyint(4) NOT NULL ', 'radio', '0', '', '0', '-1:删除\r\n0:禁用\r\n1:正常\r\n2:待审核\r\n3:草稿', '1', '0', '1', '1384508496', '1383891233', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('23', 'parse', '内容解析类型', 'tinyint(3) unsigned NOT NULL ', 'select', '0', '', '0', '0:html\r\n1:ubb\r\n2:markdown', '2', '0', '1', '1384511049', '1383891243', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('24', 'content', '文章内容', 'text NOT NULL ', 'editor', '', '', '1', '', '2', '0', '1', '1383896225', '1383891243', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('25', 'template', '详情页显示模板', 'varchar(100) NOT NULL ', 'string', '', '参照display方法参数的定义', '1', '', '2', '0', '1', '1383896190', '1383891243', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('26', 'bookmark', '收藏数', 'int(10) unsigned NOT NULL ', 'num', '0', '', '1', '', '2', '0', '1', '1383896103', '1383891243', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('27', 'parse', '内容解析类型', 'tinyint(3) unsigned NOT NULL ', 'select', '0', '', '0', '0:html\r\n1:ubb\r\n2:markdown', '3', '0', '1', '1387260461', '1383891252', '', '0', '', 'regex', '', '0', 'function');
INSERT INTO `bhy_attribute` VALUES ('28', 'content', '下载详细描述', 'text NOT NULL ', 'editor', '', '', '1', '', '3', '0', '1', '1383896438', '1383891252', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('29', 'template', '详情页显示模板', 'varchar(100) NOT NULL ', 'string', '', '', '1', '', '3', '0', '1', '1383896429', '1383891252', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('30', 'file_id', '文件ID', 'int(10) unsigned NOT NULL ', 'file', '0', '需要函数处理', '1', '', '3', '0', '1', '1383896415', '1383891252', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('31', 'download', '下载次数', 'int(10) unsigned NOT NULL ', 'num', '0', '', '1', '', '3', '0', '1', '1383896380', '1383891252', '', '0', '', '', '', '0', '');
INSERT INTO `bhy_attribute` VALUES ('32', 'size', '文件大小', 'bigint(20) unsigned NOT NULL ', 'num', '0', '单位bit', '1', '', '3', '0', '1', '1383896371', '1383891252', '', '0', '', '', '', '0', '');

-- ----------------------------
-- Table structure for bhy_auth_extend
-- ----------------------------
DROP TABLE IF EXISTS `bhy_auth_extend`;
CREATE TABLE `bhy_auth_extend` (
  `group_id` mediumint(10) unsigned NOT NULL COMMENT '用户id',
  `extend_id` mediumint(8) unsigned NOT NULL COMMENT '扩展表中数据的id',
  `type` tinyint(1) unsigned NOT NULL COMMENT '扩展类型标识 1:栏目分类权限;2:模型权限',
  UNIQUE KEY `group_extend_type` (`group_id`,`extend_id`,`type`),
  KEY `uid` (`group_id`),
  KEY `group_id` (`extend_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户组与分类的对应关系表';

-- ----------------------------
-- Records of bhy_auth_extend
-- ----------------------------
INSERT INTO `bhy_auth_extend` VALUES ('1', '1', '1');
INSERT INTO `bhy_auth_extend` VALUES ('1', '1', '2');
INSERT INTO `bhy_auth_extend` VALUES ('1', '2', '1');
INSERT INTO `bhy_auth_extend` VALUES ('1', '2', '2');
INSERT INTO `bhy_auth_extend` VALUES ('1', '3', '1');
INSERT INTO `bhy_auth_extend` VALUES ('1', '3', '2');
INSERT INTO `bhy_auth_extend` VALUES ('1', '4', '1');
INSERT INTO `bhy_auth_extend` VALUES ('1', '37', '1');

-- ----------------------------
-- Table structure for bhy_auth_group
-- ----------------------------
DROP TABLE IF EXISTS `bhy_auth_group`;
CREATE TABLE `bhy_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组id,自增主键',
  `module` varchar(20) NOT NULL COMMENT '用户组所属模块',
  `type` tinyint(4) NOT NULL COMMENT '组类型',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '用户组中文名称',
  `description` varchar(80) NOT NULL DEFAULT '' COMMENT '描述信息',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '用户组状态：为1正常，为0禁用,-1为删除',
  `rules` varchar(500) NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id，多个规则 , 隔开',
  `icon` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bhy_auth_group
-- ----------------------------
INSERT INTO `bhy_auth_group` VALUES ('1', 'admin', '1', '默认用户组', '', '1', '1,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,79,80,81,82,83,84,86,87,88,89,90,91,92,93,94,95,100,102,103,235,238', '0');
INSERT INTO `bhy_auth_group` VALUES ('2', 'admin', '1', '达叔用户组', '达叔直播间用户组', '-1', '1,195,219,225,226,287', '111');
INSERT INTO `bhy_auth_group` VALUES ('5', 'admin', '1', '专家用户组', '注：以下专家排名不分先后，按照专家名称首字母进行排序', '-1', '1,219,289,290,291,292,298,299,304,319', '0');
INSERT INTO `bhy_auth_group` VALUES ('6', 'admin', '1', 'test', '1', '-1', '', '113');
INSERT INTO `bhy_auth_group` VALUES ('7', 'admin', '1', '客服', '', '-1', '', '0');
INSERT INTO `bhy_auth_group` VALUES ('8', 'admin', '1', '测试', '', '-1', '', '0');

-- ----------------------------
-- Table structure for bhy_auth_group_access
-- ----------------------------
DROP TABLE IF EXISTS `bhy_auth_group_access`;
CREATE TABLE `bhy_auth_group_access` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `group_id` mediumint(8) unsigned NOT NULL COMMENT '用户组id',
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bhy_auth_group_access
-- ----------------------------
INSERT INTO `bhy_auth_group_access` VALUES ('3', '2');
INSERT INTO `bhy_auth_group_access` VALUES ('4', '2');
INSERT INTO `bhy_auth_group_access` VALUES ('4', '3');
INSERT INTO `bhy_auth_group_access` VALUES ('5', '2');
INSERT INTO `bhy_auth_group_access` VALUES ('5', '4');
INSERT INTO `bhy_auth_group_access` VALUES ('6', '2');
INSERT INTO `bhy_auth_group_access` VALUES ('6', '4');
INSERT INTO `bhy_auth_group_access` VALUES ('7', '2');
INSERT INTO `bhy_auth_group_access` VALUES ('8', '5');
INSERT INTO `bhy_auth_group_access` VALUES ('9', '5');
INSERT INTO `bhy_auth_group_access` VALUES ('10', '5');
INSERT INTO `bhy_auth_group_access` VALUES ('11', '2');
INSERT INTO `bhy_auth_group_access` VALUES ('12', '8');
INSERT INTO `bhy_auth_group_access` VALUES ('15', '8');
INSERT INTO `bhy_auth_group_access` VALUES ('16', '7');

-- ----------------------------
-- Table structure for bhy_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `bhy_auth_rule`;
CREATE TABLE `bhy_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',
  `module` varchar(20) NOT NULL COMMENT '规则所属module',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1-url;2-主菜单',
  `name` char(80) NOT NULL DEFAULT '' COMMENT '规则唯一英文标识',
  `title` char(20) NOT NULL DEFAULT '' COMMENT '规则中文描述',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效(0:无效,1:有效)',
  `condition` varchar(300) NOT NULL DEFAULT '' COMMENT '规则附加条件',
  PRIMARY KEY (`id`),
  KEY `module` (`module`,`status`,`type`)
) ENGINE=MyISAM AUTO_INCREMENT=352 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bhy_auth_rule
-- ----------------------------
INSERT INTO `bhy_auth_rule` VALUES ('1', 'admin', '2', 'Admin/Index/index', '首页', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('2', 'admin', '2', 'Admin/Article/mydocument', '内容', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('3', 'admin', '2', 'Admin/User/index', '用户', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('4', 'admin', '2', 'Admin/Addons/index', '扩展', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('5', 'admin', '2', 'Admin/Config/group', '系统', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('7', 'admin', '1', 'Admin/article/add', '新增', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('8', 'admin', '1', 'Admin/article/edit', '编辑', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('9', 'admin', '1', 'Admin/article/setStatus', '改变状态', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('10', 'admin', '1', 'Admin/article/update', '保存', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('11', 'admin', '1', 'Admin/article/autoSave', '保存草稿', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('12', 'admin', '1', 'Admin/article/move', '移动', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('13', 'admin', '1', 'Admin/article/copy', '复制', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('14', 'admin', '1', 'Admin/article/paste', '粘贴', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('15', 'admin', '1', 'Admin/article/permit', '还原', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('16', 'admin', '1', 'Admin/article/clear', '清空', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('17', 'admin', '1', 'Admin/article/index', '新闻列表', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('18', 'admin', '1', 'Admin/article/recycle', '回收站', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('19', 'admin', '1', 'Admin/User/addaction', '新增用户行为', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('20', 'admin', '1', 'Admin/User/editaction', '编辑用户行为', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('21', 'admin', '1', 'Admin/User/saveAction', '保存用户行为', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('22', 'admin', '1', 'Admin/User/setStatus', '变更行为状态', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('23', 'admin', '1', 'Admin/User/changeStatus?method=forbidUser', '禁用会员', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('24', 'admin', '1', 'Admin/User/changeStatus?method=resumeUser', '启用会员', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('25', 'admin', '1', 'Admin/User/changeStatus?method=deleteUser', '删除会员', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('26', 'admin', '1', 'Admin/User/index', '用户信息', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('27', 'admin', '1', 'Admin/User/action', '用户行为', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('28', 'admin', '1', 'Admin/AuthManager/changeStatus?method=deleteGroup', '删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('29', 'admin', '1', 'Admin/AuthManager/changeStatus?method=forbidGroup', '禁用', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('30', 'admin', '1', 'Admin/AuthManager/changeStatus?method=resumeGroup', '恢复', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('31', 'admin', '1', 'Admin/AuthManager/createGroup', '新增', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('32', 'admin', '1', 'Admin/AuthManager/editGroup', '编辑', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('33', 'admin', '1', 'Admin/AuthManager/writeGroup', '保存用户组', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('34', 'admin', '1', 'Admin/AuthManager/group', '删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('35', 'admin', '1', 'Admin/AuthManager/access', '访问授权', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('36', 'admin', '1', 'Admin/AuthManager/user', '成员授权', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('37', 'admin', '1', 'Admin/AuthManager/removeFromGroup', '解除授权', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('38', 'admin', '1', 'Admin/AuthManager/addToGroup', '保存成员授权', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('39', 'admin', '1', 'Admin/AuthManager/category', '分类授权', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('40', 'admin', '1', 'Admin/AuthManager/addToCategory', '保存分类授权', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('41', 'admin', '1', 'Admin/AuthManager/index', '权限管理', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('42', 'admin', '1', 'Admin/Addons/create', '创建', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('43', 'admin', '1', 'Admin/Addons/checkForm', '检测创建', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('44', 'admin', '1', 'Admin/Addons/preview', '预览', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('45', 'admin', '1', 'Admin/Addons/build', '快速生成插件', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('46', 'admin', '1', 'Admin/Addons/config', '设置', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('47', 'admin', '1', 'Admin/Addons/disable', '禁用', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('48', 'admin', '1', 'Admin/Addons/enable', '启用', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('49', 'admin', '1', 'Admin/Addons/install', '安装', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('50', 'admin', '1', 'Admin/Addons/uninstall', '卸载', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('51', 'admin', '1', 'Admin/Addons/saveconfig', '更新配置', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('52', 'admin', '1', 'Admin/Addons/adminList', '插件后台列表', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('53', 'admin', '1', 'Admin/Addons/execute', 'URL方式访问插件', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('54', 'admin', '1', 'Admin/Addons/index', '插件管理', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('55', 'admin', '1', 'Admin/Addons/hooks', '钩子管理', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('56', 'admin', '1', 'Admin/model/add', '新增', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('57', 'admin', '1', 'Admin/model/edit', '编辑', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('58', 'admin', '1', 'Admin/model/setStatus', '改变状态', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('59', 'admin', '1', 'Admin/model/update', '保存数据', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('60', 'admin', '1', 'Admin/Model/index', '模型管理', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('61', 'admin', '1', 'Admin/Config/edit', '编辑', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('62', 'admin', '1', 'Admin/Config/del', '删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('63', 'admin', '1', 'Admin/Config/add', '新增', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('64', 'admin', '1', 'Admin/Config/save', '保存', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('65', 'admin', '1', 'Admin/Config/group', '网站设置', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('66', 'admin', '1', 'Admin/Config/index', '配置管理', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('67', 'admin', '1', 'Admin/Channel/add', '新增', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('68', 'admin', '1', 'Admin/Channel/edit', '编辑', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('69', 'admin', '1', 'Admin/Channel/del', '删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('70', 'admin', '1', 'Admin/Channel/index', '导航管理', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('71', 'admin', '1', 'Admin/Category/edit', '编辑', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('72', 'admin', '1', 'Admin/Category/add', '新增', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('73', 'admin', '1', 'Admin/Category/remove', '删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('74', 'admin', '1', 'Admin/Category/index', '分类管理', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('75', 'admin', '1', 'Admin/file/upload', '上传控件', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('76', 'admin', '1', 'Admin/file/uploadPicture', '上传图片', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('77', 'admin', '1', 'Admin/file/download', '下载', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('94', 'admin', '1', 'Admin/AuthManager/modelauth', '模型授权', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('79', 'admin', '1', 'Admin/article/batchOperate', '导入', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('80', 'admin', '1', 'Admin/Database/index?type=export', '备份数据库', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('81', 'admin', '1', 'Admin/Database/index?type=import', '还原数据库', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('82', 'admin', '1', 'Admin/Database/export', '备份', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('83', 'admin', '1', 'Admin/Database/optimize', '优化表', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('84', 'admin', '1', 'Admin/Database/repair', '修复表', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('86', 'admin', '1', 'Admin/Database/import', '恢复', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('87', 'admin', '1', 'Admin/Database/del', '删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('88', 'admin', '1', 'Admin/User/add', '新增用户', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('89', 'admin', '1', 'Admin/Attribute/index', '属性管理', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('90', 'admin', '1', 'Admin/Attribute/add', '新增', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('91', 'admin', '1', 'Admin/Attribute/edit', '编辑', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('92', 'admin', '1', 'Admin/Attribute/setStatus', '改变状态', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('93', 'admin', '1', 'Admin/Attribute/update', '保存数据', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('95', 'admin', '1', 'Admin/AuthManager/addToModel', '保存模型授权', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('96', 'admin', '1', 'Admin/Category/move', '移动', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('97', 'admin', '1', 'Admin/Category/merge', '合并', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('98', 'admin', '1', 'Admin/Config/menu', '后台菜单管理', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('99', 'admin', '1', 'Admin/article/mydocument', '新闻列表', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('100', 'admin', '1', 'Admin/Menu/index', '菜单管理', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('101', 'admin', '1', 'Admin/other', '其他', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('102', 'admin', '1', 'Admin/Menu/add', '新增', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('103', 'admin', '1', 'Admin/Menu/edit', '编辑', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('104', 'admin', '1', 'Admin/Think/lists?model=article', '文章管理', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('105', 'admin', '1', 'Admin/Think/lists?model=download', '下载管理', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('106', 'admin', '1', 'Admin/Think/lists?model=config', '配置管理', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('107', 'admin', '1', 'Admin/Action/actionlog', '行为日志', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('108', 'admin', '1', 'Admin/User/updatePassword', '修改密码', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('109', 'admin', '1', 'Admin/User/updateNickname', '修改昵称', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('110', 'admin', '1', 'Admin/action/edit', '查看行为日志', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('205', 'admin', '1', 'Admin/think/add', '新增数据', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('111', 'admin', '2', 'Admin/article/index', '文档列表', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('112', 'admin', '2', 'Admin/article/add', '新增', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('113', 'admin', '2', 'Admin/article/edit', '编辑', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('114', 'admin', '2', 'Admin/article/setStatus', '改变状态', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('115', 'admin', '2', 'Admin/article/update', '保存', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('116', 'admin', '2', 'Admin/article/autoSave', '保存草稿', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('117', 'admin', '2', 'Admin/article/move', '移动', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('118', 'admin', '2', 'Admin/article/copy', '复制', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('119', 'admin', '2', 'Admin/article/paste', '粘贴', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('120', 'admin', '2', 'Admin/article/batchOperate', '导入', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('121', 'admin', '2', 'Admin/article/recycle', '回收站', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('122', 'admin', '2', 'Admin/article/permit', '还原', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('123', 'admin', '2', 'Admin/article/clear', '清空', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('124', 'admin', '2', 'Admin/User/add', '新增用户', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('125', 'admin', '2', 'Admin/User/action', '用户行为', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('126', 'admin', '2', 'Admin/User/addAction', '新增用户行为', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('127', 'admin', '2', 'Admin/User/editAction', '编辑用户行为', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('128', 'admin', '2', 'Admin/User/saveAction', '保存用户行为', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('129', 'admin', '2', 'Admin/User/setStatus', '变更行为状态', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('130', 'admin', '2', 'Admin/User/changeStatus?method=forbidUser', '禁用会员', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('131', 'admin', '2', 'Admin/User/changeStatus?method=resumeUser', '启用会员', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('132', 'admin', '2', 'Admin/User/changeStatus?method=deleteUser', '删除会员', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('133', 'admin', '2', 'Admin/AuthManager/index', '权限管理', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('134', 'admin', '2', 'Admin/AuthManager/changeStatus?method=deleteGroup', '删除', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('135', 'admin', '2', 'Admin/AuthManager/changeStatus?method=forbidGroup', '禁用', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('136', 'admin', '2', 'Admin/AuthManager/changeStatus?method=resumeGroup', '恢复', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('137', 'admin', '2', 'Admin/AuthManager/createGroup', '新增', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('138', 'admin', '2', 'Admin/AuthManager/editGroup', '编辑', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('139', 'admin', '2', 'Admin/AuthManager/writeGroup', '保存用户组', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('140', 'admin', '2', 'Admin/AuthManager/group', '授权', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('141', 'admin', '2', 'Admin/AuthManager/access', '访问授权', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('142', 'admin', '2', 'Admin/AuthManager/user', '成员授权', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('143', 'admin', '2', 'Admin/AuthManager/removeFromGroup', '解除授权', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('144', 'admin', '2', 'Admin/AuthManager/addToGroup', '保存成员授权', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('145', 'admin', '2', 'Admin/AuthManager/category', '分类授权', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('146', 'admin', '2', 'Admin/AuthManager/addToCategory', '保存分类授权', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('147', 'admin', '2', 'Admin/AuthManager/modelauth', '模型授权', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('148', 'admin', '2', 'Admin/AuthManager/addToModel', '保存模型授权', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('149', 'admin', '2', 'Admin/Addons/create', '创建', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('150', 'admin', '2', 'Admin/Addons/checkForm', '检测创建', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('151', 'admin', '2', 'Admin/Addons/preview', '预览', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('152', 'admin', '2', 'Admin/Addons/build', '快速生成插件', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('153', 'admin', '2', 'Admin/Addons/config', '设置', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('154', 'admin', '2', 'Admin/Addons/disable', '禁用', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('155', 'admin', '2', 'Admin/Addons/enable', '启用', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('156', 'admin', '2', 'Admin/Addons/install', '安装', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('157', 'admin', '2', 'Admin/Addons/uninstall', '卸载', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('158', 'admin', '2', 'Admin/Addons/saveconfig', '更新配置', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('159', 'admin', '2', 'Admin/Addons/adminList', '插件后台列表', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('160', 'admin', '2', 'Admin/Addons/execute', 'URL方式访问插件', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('161', 'admin', '2', 'Admin/Addons/hooks', '钩子管理', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('162', 'admin', '2', 'Admin/Model/index', '模型管理', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('163', 'admin', '2', 'Admin/model/add', '新增', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('164', 'admin', '2', 'Admin/model/edit', '编辑', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('165', 'admin', '2', 'Admin/model/setStatus', '改变状态', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('166', 'admin', '2', 'Admin/model/update', '保存数据', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('167', 'admin', '2', 'Admin/Attribute/index', '属性管理', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('168', 'admin', '2', 'Admin/Attribute/add', '新增', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('169', 'admin', '2', 'Admin/Attribute/edit', '编辑', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('170', 'admin', '2', 'Admin/Attribute/setStatus', '改变状态', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('171', 'admin', '2', 'Admin/Attribute/update', '保存数据', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('172', 'admin', '2', 'Admin/Config/index', '配置管理', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('173', 'admin', '2', 'Admin/Config/edit', '编辑', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('174', 'admin', '2', 'Admin/Config/del', '删除', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('175', 'admin', '2', 'Admin/Config/add', '新增', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('176', 'admin', '2', 'Admin/Config/save', '保存', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('177', 'admin', '2', 'Admin/Menu/index', '菜单管理', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('178', 'admin', '2', 'Admin/Channel/index', '导航管理', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('179', 'admin', '2', 'Admin/Channel/add', '新增', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('180', 'admin', '2', 'Admin/Channel/edit', '编辑', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('181', 'admin', '2', 'Admin/Channel/del', '删除', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('182', 'admin', '2', 'Admin/Category/index', '内容', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('183', 'admin', '2', 'Admin/Category/edit', '编辑', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('184', 'admin', '2', 'Admin/Category/add', '新增', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('185', 'admin', '2', 'Admin/Category/remove', '删除', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('186', 'admin', '2', 'Admin/Category/move', '移动', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('187', 'admin', '2', 'Admin/Category/merge', '合并', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('188', 'admin', '2', 'Admin/Database/index?type=export', '备份数据库', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('189', 'admin', '2', 'Admin/Database/export', '备份', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('190', 'admin', '2', 'Admin/Database/optimize', '优化表', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('191', 'admin', '2', 'Admin/Database/repair', '修复表', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('192', 'admin', '2', 'Admin/Database/index?type=import', '还原数据库', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('193', 'admin', '2', 'Admin/Database/import', '恢复', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('194', 'admin', '2', 'Admin/Database/del', '删除', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('195', 'admin', '2', 'Admin/other', '其他', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('196', 'admin', '2', 'Admin/Menu/add', '新增', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('197', 'admin', '2', 'Admin/Menu/edit', '编辑', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('198', 'admin', '2', 'Admin/Think/lists?model=article', '应用', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('199', 'admin', '2', 'Admin/Think/lists?model=download', '下载管理', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('200', 'admin', '2', 'Admin/Think/lists?model=config', '应用', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('201', 'admin', '2', 'Admin/Action/actionlog', '行为日志', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('202', 'admin', '2', 'Admin/User/updatePassword', '修改密码', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('203', 'admin', '2', 'Admin/User/updateNickname', '修改昵称', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('204', 'admin', '2', 'Admin/action/edit', '查看行为日志', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('206', 'admin', '1', 'Admin/think/edit', '编辑数据', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('207', 'admin', '1', 'Admin/Menu/import', '导入', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('208', 'admin', '1', 'Admin/Model/generate', '生成', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('209', 'admin', '1', 'Admin/Addons/addHook', '新增钩子', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('210', 'admin', '1', 'Admin/Addons/edithook', '编辑钩子', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('211', 'admin', '1', 'Admin/Article/sort', '文档排序', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('212', 'admin', '1', 'Admin/Config/sort', '排序', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('213', 'admin', '1', 'Admin/Menu/sort', '排序', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('214', 'admin', '1', 'Admin/Channel/sort', '排序', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('215', 'admin', '1', 'Admin/Category/operate/type/move', '移动', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('216', 'admin', '1', 'Admin/Category/operate/type/merge', '合并', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('217', 'admin', '1', 'Admin/news/index', '文章列表', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('218', 'admin', '1', 'Admin/News/add', '添加', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('219', 'admin', '2', 'Admin/news/index', '内容', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('220', 'admin', '1', 'Admin/News/edit', '修改', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('221', 'admin', '1', 'Admin/News/changeStatus', '删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('222', 'admin', '1', 'Admin/News/recycle', '文章回收站', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('223', 'admin', '1', 'Admin/persun/index?typeid=1', '晒恋爱', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('224', 'admin', '1', 'Admin/persun/index?typeid=2', '晒幸福', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('225', 'admin', '1', 'Admin/Persun/add', '添加', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('226', 'admin', '1', 'Admin/Persun/edit', '修改', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('227', 'admin', '1', 'Admin/usermember/index', '会员列表', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('228', 'admin', '1', 'Admin/province/index', '省级管理', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('229', 'admin', '1', 'Admin/city/index', '市级管理', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('230', 'admin', '1', 'Admin/county/index', '区县管理', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('231', 'admin', '1', 'Admin/Province/add', '添加', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('232', 'admin', '1', 'Admin/Province/edit', '修改', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('233', 'admin', '1', 'Admin/Province/foreverdelete', '删除', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('234', 'admin', '1', 'Admin/Province/changeStatus', '状态修改', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('235', 'admin', '1', 'Admin/Manifesto/index?flag=1', '内心独白', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('236', 'admin', '1', 'Admin/Usermember/add', '添加会员', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('237', 'admin', '1', 'Admin/Usermember/edit', '修改会员', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('238', 'admin', '1', 'Admin/Manifesto/index?flag=2', '问候语', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('239', 'admin', '1', 'Admin/manifesto/index?type=1', '内心独白', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('240', 'admin', '1', 'Admin/manifesto/index?type=2', '问候语', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('241', 'admin', '1', 'Admin/Manifesto/add', '添加', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('242', 'admin', '1', 'Admin/Manifesto/edit', '编辑', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('243', 'admin', '1', 'Admin/City/add', '添加', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('244', 'admin', '1', 'Admin/City/edit', '编辑', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('245', 'admin', '1', 'Admin/County/add', '添加', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('246', 'admin', '1', 'Admin/County/edit', '修改', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('247', 'admin', '1', 'Admin/matchmaker/index', '红娘列表', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('248', 'admin', '1', 'Admin/Matchmaker/add', '添加', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('249', 'admin', '1', 'Admin/garde/index', '会员等级', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('250', 'admin', '1', 'Admin/Matchmaker/edit', '修改', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('251', 'admin', '1', 'Admin/Garde/add', '添加', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('252', 'admin', '1', 'Admin/Garde/edit', '修改', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('253', 'admin', '1', 'Admin/Garde/foreverdelete', '删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('254', 'admin', '2', 'Admin/matchmaker/index', '红娘', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('255', 'admin', '1', 'Admin/gift/index', '礼物列表', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('256', 'admin', '1', 'Admin/Gift/add', '添加', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('257', 'admin', '1', 'Admin/Gift/edit', '修改', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('258', 'admin', '1', 'Admin/ad/index', '广告列表', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('259', 'admin', '1', 'Admin/links/index', '链接列表', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('260', 'admin', '1', 'Admin/ad/add', '添加', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('261', 'admin', '1', 'Admin/ad/edit', '修改', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('262', 'admin', '1', 'Admin/links/add', '添加', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('263', 'admin', '1', 'Admin/links/edit', '修改', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('264', 'admin', '1', 'Admin/message/index', '短信接口', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('265', 'admin', '1', 'Admin/email/index', '邮箱接口', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('266', 'admin', '1', 'Admin/Message/add', '添加', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('267', 'admin', '1', 'Admin/Message/edit', '修改', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('268', 'admin', '1', 'Admin/email/add', '添加', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('269', 'admin', '1', 'Admin/email/edit', '修改', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('270', 'admin', '1', 'Admin/Message/foreverdelete', '删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('271', 'admin', '1', 'Admin/activity/index', '活动列表', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('272', 'admin', '1', 'Admin/activity/add', '添加', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('273', 'admin', '1', 'Admin/activity/edit', '修改', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('274', 'admin', '1', 'Admin/rechange/index', '充值比例', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('275', 'admin', '1', 'Admin/rechange/add', '添加', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('276', 'admin', '1', 'Admin/rechange/edit', '修改', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('277', 'admin', '1', 'Admin/alipay/index', '支付宝接口', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('278', 'admin', '1', 'Admin/alipay/add', '添加', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('279', 'admin', '1', 'Admin/alipay/edit', '修改', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('280', 'admin', '1', 'Admin/monthly/index', '包月服务', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('281', 'admin', '1', 'Admin/monthly/add', '添加', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('282', 'admin', '1', 'Admin/monthly/edit', '修改', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('283', 'admin', '1', 'Admin/workrecord/index', '工作记录列表', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('284', 'admin', '1', 'Admin/workrecord/add', '添加', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('285', 'admin', '1', 'Admin/workrecord/edit', '修改', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('286', 'admin', '1', 'Admin/workrecord/foreverdelete', '删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('287', 'admin', '1', 'Admin/persun/index', '直播列表', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('288', 'admin', '1', 'Admin/matchuser/index', '会员列表', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('289', 'admin', '1', 'Admin/stock/edit', '修改', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('290', 'admin', '1', 'Admin/stock/add', '添加', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('291', 'admin', '1', 'Admin/stock/index', '股票列表', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('292', 'admin', '1', 'Admin/questions/edit', '修改', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('293', 'admin', '1', 'Admin/warea/index', '城市列表', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('294', 'admin', '1', 'Admin/video/add', '添加', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('295', 'admin', '1', 'Admin/warea/add', '添加', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('296', 'admin', '1', 'Admin/warea/edit', '修改', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('297', 'admin', '1', 'Admin/video/index', '视频管理', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('298', 'admin', '1', 'Admin/questions/add', '添加', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('299', 'admin', '1', 'Admin/questions/index', '提问列表', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('300', 'admin', '1', 'Admin/video/edit', '修改', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('301', 'admin', '1', 'Admin/post/index', '帖子管理', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('302', 'admin', '1', 'Admin/post/edit', '修改', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('303', 'admin', '1', 'Admin/post/add', '添加', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('304', 'admin', '1', 'Admin/questions/stockreply', '回复', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('305', 'admin', '2', 'Admin/post/index', '社区', '-1', '');
INSERT INTO `bhy_auth_rule` VALUES ('306', 'admin', '1', 'Admin/Category/setStatus', '禁用', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('307', 'admin', '1', 'Admin/Video/changeStatus', '禁/启用/删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('308', 'admin', '1', 'Admin/News/changeStatus/method/resumeUser', '还原', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('309', 'admin', '1', 'Admin/News/changeStatus/method/forbidUser', '彻底删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('310', 'admin', '1', 'Admin/Persun/foreverdelete', '删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('311', 'admin', '1', 'Admin/Warea/foreverdelete', '删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('312', 'admin', '1', 'Admin/Questions/changeStatus', '禁/启用/删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('313', 'admin', '1', 'Admin/Stock/changeStatus', '禁/启用/删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('314', 'admin', '1', 'Admin/User/changeStatus', '禁用', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('315', 'admin', '1', 'Admin/User/changereplystatus', '禁言', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('316', 'admin', '1', 'Admin/Usermember/changeStatus', '禁/启用/删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('317', 'admin', '1', 'Admin/Post/changeStatus', '禁/启用/删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('318', 'admin', '1', 'Admin/User/updateuserpwd', '修改密码', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('319', 'admin', '1', 'Admin/questions/updatemyreply', '修改回复', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('320', 'admin', '1', 'Admin/reply/edit', '编辑', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('321', 'admin', '1', 'Admin/branch/add', '新增', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('322', 'admin', '1', 'Admin/branch/edit', '编辑', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('323', 'admin', '1', 'Admin/branch/changeStatus', '改变状态', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('324', 'admin', '1', 'Admin/teacher/add', '添加', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('325', 'admin', '1', 'Admin/teacher/edit', '编辑', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('326', 'admin', '1', 'Admin/teacher/changestatus', '改变状态', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('327', 'admin', '1', 'Admin/lists/index', '列表', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('328', 'admin', '1', 'Admin/Invest/add', '新增', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('329', 'admin', '1', 'Admin/Invest/edit', '编辑', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('330', 'admin', '1', 'Admin/Invest/del', '删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('331', 'admin', '1', 'Admin/teamtype/edit', '编辑', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('332', 'admin', '1', 'Admin/teamtype/add', '增加', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('333', 'admin', '1', 'Admin/teamtype/del', '删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('334', 'admin', '1', 'Admin/team/index', '团队列表', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('335', 'admin', '1', 'Admin/team/add', '新增', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('336', 'admin', '1', 'Admin/team/edit', '编辑', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('337', 'admin', '1', 'Admin/team/del', '删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('338', 'admin', '1', 'Admin/department/add', '新增', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('339', 'admin', '1', 'Admin/department/edit', '编辑', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('340', 'admin', '1', 'Admin/department/del', '删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('341', 'admin', '1', 'Admin/position/add', '新增', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('342', 'admin', '1', 'Admin/position/del', '删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('343', 'admin', '1', 'Admin/position/edit', '编辑', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('344', 'admin', '1', 'Admin/Fuwuerlist/index', '服务内页列表', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('345', 'admin', '1', 'Admin/Fuwuerlist/add', '新增', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('346', 'admin', '1', 'Admin/Fuwuerlist/edit', '编辑', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('347', 'admin', '1', 'Admin/Fuwuerlist/del', '删除', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('348', 'admin', '1', 'Admin/department/index', '部门列表', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('349', 'admin', '1', 'Admin/Invest/index', '上传文件', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('350', 'admin', '1', 'Admin/position/index', '职位列表', '1', '');
INSERT INTO `bhy_auth_rule` VALUES ('351', 'admin', '2', 'Admin//home/index/index', '网站首页', '1', '');

-- ----------------------------
-- Table structure for bhy_car
-- ----------------------------
DROP TABLE IF EXISTS `bhy_car`;
CREATE TABLE `bhy_car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '车型名称',
  `egname` varchar(200) DEFAULT NULL COMMENT '英文',
  `bid` int(10) DEFAULT '0' COMMENT '所属品牌',
  `cid` int(10) NOT NULL DEFAULT '0' COMMENT '车型ID',
  `jid` int(10) DEFAULT '0' COMMENT '级别ID',
  `icon` int(10) DEFAULT '0' COMMENT '年份图片',
  `year` int(11) DEFAULT '0' COMMENT '所属分类id',
  `sort` int(10) NOT NULL COMMENT '广告排序',
  `url` varchar(255) DEFAULT NULL COMMENT '报告链接',
  `point1` double NOT NULL DEFAULT '0' COMMENT '评分1',
  `point2` double NOT NULL DEFAULT '0' COMMENT '评分2',
  `point3` double DEFAULT '0' COMMENT '评分3',
  `point4` double DEFAULT '0' COMMENT '评分4',
  `carmodel` varchar(225) DEFAULT '' COMMENT '车辆型号',
  `create_time` int(11) DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) DEFAULT '0' COMMENT '最后更新时间',
  `status` int(5) DEFAULT '1' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='广告表';

-- ----------------------------
-- Records of bhy_car
-- ----------------------------
INSERT INTO `bhy_car` VALUES ('1', '奔驰', '', '25', '35', '28', '153', '46', '0', 'http://www.baidu.com', '80', '80', '80', '80', 'j123123123', '1550472749', '1550472782', '1');
INSERT INTO `bhy_car` VALUES ('2', '宝马', '', '26', '38', '29', '154', '45', '0', 'http://www.baidu.com', '82', '82', '82', '82', 'a123123123', '1550472972', '1550472972', '1');
INSERT INTO `bhy_car` VALUES ('3', '雪佛兰', '', '27', '41', '30', '155', '0', '0', 'http://www.baidu.com', '75', '75', '75', '75', 'c123567', '1550473052', '1550473073', '1');

-- ----------------------------
-- Table structure for bhy_category
-- ----------------------------
DROP TABLE IF EXISTS `bhy_category`;
CREATE TABLE `bhy_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `title` varchar(200) NOT NULL COMMENT '标题',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `list_row` tinyint(3) unsigned NOT NULL DEFAULT '10' COMMENT '列表每页行数',
  `meta_title` varchar(50) NOT NULL DEFAULT '' COMMENT 'SEO的网页标题',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `model` varchar(100) NOT NULL DEFAULT '' COMMENT '关联模型',
  `type` varchar(100) NOT NULL DEFAULT '' COMMENT '允许发布的内容类型',
  `link_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '外链',
  `allow_publish` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许发布内容',
  `display` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '可见性',
  `reply` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许回复',
  `reply_model` varchar(100) NOT NULL DEFAULT '',
  `extend` text NOT NULL COMMENT '扩展设置',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
  `icon` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类图标',
  `file` int(11) DEFAULT '0' COMMENT '文档文件id',
  `name` varchar(200) DEFAULT NULL COMMENT '标识',
  `content` text COMMENT '内容',
  `isnav` tinyint(2) DEFAULT '1' COMMENT '1前台导航显示，2不显示',
  `url` varchar(100) DEFAULT NULL COMMENT '链接',
  `pagetype` tinyint(2) DEFAULT '0' COMMENT '1单页，2列表页',
  `is_buy` int(3) NOT NULL DEFAULT '1' COMMENT '是否购买   1：不能购买   2：可以购买',
  `buy_type` int(3) NOT NULL DEFAULT '0' COMMENT '购买类型   1：酒店预订   2：餐馆预订    3：景区门票预订',
  `web_url` varchar(200) NOT NULL COMMENT '后台跳转地址',
  `intro` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COMMENT='分类表';

-- ----------------------------
-- Records of bhy_category
-- ----------------------------
INSERT INTO `bhy_category` VALUES ('1', '走进CEVE', '0', '1', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550467180', '1550481084', '1', '0', '0', 'enter CEVE', '', '1', 'ceve/index', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('2', '评价中心', '0', '2', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550467246', '1550481176', '1', '0', '0', 'assessment center', '', '1', 'evaluate/index', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('3', '新闻资讯', '0', '3', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550467343', '1550481231', '1', '0', '0', 'news', '', '1', 'news/index', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('4', '媒体聚焦', '0', '4', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550467384', '1550481295', '1', '0', '0', 'media focus', '', '1', 'media/index', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('5', '下载中心', '0', '5', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550467450', '1550481331', '1', '0', '0', 'download center', '', '1', 'download/index', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('6', '联系我们', '0', '6', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550467485', '1550481408', '1', '0', '0', 'contact us', '', '1', 'contact/index', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('7', '规程介绍', '1', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550467555', '1550481102', '1', '0', '0', 'discipline is introduced', '', '1', 'ceve/index', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('8', 'CEVE管理中心', '1', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550467603', '1550481116', '1', '0', '0', 'CEVE management center', '', '1', 'ceve/index', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('9', '合作单位', '1', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550467642', '1550481131', '1', '0', '0', 'cooperator', '', '1', 'ceve/index', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('10', '体系研究', '2', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550467680', '1550481189', '1', '0', '0', 'architectural study', '', '1', 'evaluate/index', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('11', '评测结果', '2', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550467717', '1550481201', '1', '0', '0', 'review the results', '', '1', 'evaluate/index', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('12', 'CEVE要闻', '3', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550467775', '1550481247', '1', '0', '0', 'CEVE important news ', '', '1', 'news/index', '2', '0', '0', '', '');
INSERT INTO `bhy_category` VALUES ('13', '行业动态', '3', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550467817', '0', '1', '0', '0', 'industry trends', '', '1', '', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('14', '专家观点', '3', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550467852', '1550481265', '1', '0', '0', 'expert opinion', '', '1', 'news/index', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('15', '媒体聚焦', '4', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550467914', '1550481308', '1', '0', '0', 'media focus', '', '1', 'media/index', '2', '0', '0', '', '');
INSERT INTO `bhy_category` VALUES ('16', '检测规程', '5', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550467952', '1550481348', '1', '0', '0', ' ITP InspectionTestProcedure', '', '1', 'download/index', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('17', '评价规程', '5', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550467990', '1550481363', '1', '0', '0', 'C-NCAP', '', '1', 'download/index', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('18', '管理办法', '5', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550468014', '1550481380', '1', '0', '0', 'regulation', '', '1', 'download/index', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('19', '研究办法', '5', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550468045', '1550481395', '1', '0', '0', 'study answer', '', '1', 'download/index', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('20', '联系我们', '6', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550468093', '1550481422', '1', '0', '0', 'contact us', '', '1', 'contact/index', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('21', '测评通知', '0', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550468709', '1550468731', '1', '0', '0', 'Assessment notice', '', '2', '', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('22', '厂商', '0', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550471008', '1550471324', '1', '0', '0', 'cs', '', '2', '', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('23', '车辆级别', '0', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550471037', '1550471279', '1', '0', '0', 'car jb', '', '2', '', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('35', '奔驰GLC', '25', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550471629', '0', '1', '0', '0', '', '', '1', '', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('25', '北京奔驰汽车有限公司', '22', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550471101', '1550471332', '1', '0', '0', 'bjbc', '', '2', '', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('26', '宝马汽车有限公司', '22', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550471128', '1550471288', '1', '0', '0', 'bm', '', '2', '', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('27', '雪佛兰汽车有限公司', '22', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550471183', '1550471350', '1', '0', '0', 'xfl', '', '2', '', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('28', '轿车', '23', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550471220', '1550471270', '1', '0', '0', '', '', '2', '', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('29', '商务车', '23', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550471237', '1550471261', '1', '0', '0', '', '', '2', '', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('30', '商用及家用厢式车', '23', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550471253', '0', '1', '0', '0', '', '', '2', '', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('38', '宝马3系', '26', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550471685', '0', '1', '0', '0', '', '', '1', '', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('36', '奔驰E级', '25', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550471639', '0', '1', '0', '0', '', '', '1', '', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('37', '奔驰C级', '25', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550471647', '0', '1', '0', '0', '', '', '1', '', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('39', '宝马5系', '26', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550471693', '0', '1', '0', '0', '', '', '1', '', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('40', '宝马X1', '26', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550471703', '0', '1', '0', '0', '', '', '1', '', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('41', '科鲁兹', '27', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550471736', '0', '1', '0', '0', '', '', '1', '', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('42', '科沃兹', '27', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550471744', '0', '1', '0', '0', '', '', '1', '', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('43', '探界者', '27', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550471756', '0', '1', '0', '0', '', '', '1', '', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('44', '评级年份', '0', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550472035', '1550476908', '1', '0', '0', '', '', '2', '', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('45', '2017', '44', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550472084', '0', '0', '0', '0', '', '', '1', '', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('46', '2018', '44', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550472094', '0', '0', '0', '0', '', '', '1', '', '1', '1', '0', '', '');
INSERT INTO `bhy_category` VALUES ('47', '2019', '44', '0', '10', '', '', '', '', '', '0', '0', '0', '0', '', '', '1550472105', '0', '0', '0', '0', '', '', '1', '', '1', '1', '0', '', '');

-- ----------------------------
-- Table structure for bhy_category_other
-- ----------------------------
DROP TABLE IF EXISTS `bhy_category_other`;
CREATE TABLE `bhy_category_other` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `title` varchar(50) NOT NULL COMMENT '标题',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `list_row` tinyint(3) unsigned NOT NULL DEFAULT '10' COMMENT '列表每页行数',
  `meta_title` varchar(50) NOT NULL DEFAULT '' COMMENT 'SEO的网页标题',
  `keywords` varchar(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `model` varchar(100) NOT NULL DEFAULT '' COMMENT '关联模型',
  `type` varchar(100) NOT NULL DEFAULT '' COMMENT '允许发布的内容类型',
  `link_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '外链',
  `allow_publish` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许发布内容',
  `display` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '可见性',
  `reply` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '是否允许回复',
  `check` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '发布的文章是否需要审核',
  `reply_model` varchar(100) NOT NULL DEFAULT '',
  `extend` text NOT NULL COMMENT '扩展设置',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '数据状态',
  `icon` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '分类图标',
  `name` varchar(50) DEFAULT NULL COMMENT '标识',
  `content` text COMMENT '内容',
  `isnav` tinyint(2) DEFAULT '1' COMMENT '1前台导航显示，2不显示',
  `url` varchar(100) DEFAULT NULL COMMENT '链接',
  `pagetype` tinyint(2) DEFAULT '0' COMMENT '1单页，2列表页',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='分类表';

-- ----------------------------
-- Records of bhy_category_other
-- ----------------------------

-- ----------------------------
-- Table structure for bhy_channel
-- ----------------------------
DROP TABLE IF EXISTS `bhy_channel`;
CREATE TABLE `bhy_channel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '频道ID',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级频道ID',
  `title` char(30) NOT NULL COMMENT '频道标题',
  `url` char(100) NOT NULL COMMENT '频道连接',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '导航排序',
  `flag` varchar(50) DEFAULT NULL COMMENT '导航属性',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `target` tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '新窗口打开',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bhy_channel
-- ----------------------------
INSERT INTO `bhy_channel` VALUES ('1', '0', '中国汽研', 'Chinabari/index', '1', '', '1480475712', '1480475712', '1', '0');
INSERT INTO `bhy_channel` VALUES ('2', '1', '公司简介', 'Chinabari/about', '1', '', '1480475939', '1480475939', '1', '0');
INSERT INTO `bhy_channel` VALUES ('3', '1', '管理团队', 'Chinabari/team', '2', '', '1480475972', '1480475972', '1', '0');
INSERT INTO `bhy_channel` VALUES ('4', '1', '人力资源', 'Chinabari/source', '3', '', '1480476008', '1480476008', '1', '0');
INSERT INTO `bhy_channel` VALUES ('5', '1', '发展战略', 'aa', '4', '', '1480476050', '1480476050', '1', '0');
INSERT INTO `bhy_channel` VALUES ('6', '1', '企业文化', 'aa', '5', '', '1480476068', '1480476068', '1', '0');
INSERT INTO `bhy_channel` VALUES ('7', '1', '成果荣誉', 'aa', '6', '', '1480476085', '1480476085', '1', '0');
INSERT INTO `bhy_channel` VALUES ('8', '0', '新闻中心', 'news/index', '2', '', '1480476105', '1480476105', '1', '0');
INSERT INTO `bhy_channel` VALUES ('9', '8', '公司动态', 'news/index', '1', '', '1480476127', '1480476127', '1', '0');
INSERT INTO `bhy_channel` VALUES ('10', '8', '学术交流', 'news/index', '2', '', '1480476151', '1480476151', '1', '0');
INSERT INTO `bhy_channel` VALUES ('11', '8', '行业资讯', 'news/lists', '2', '', '1480476176', '1480476176', '1', '0');
INSERT INTO `bhy_channel` VALUES ('12', '8', '媒体报道', 'news/lists', '4', '', '1480476207', '1480476207', '1', '0');
INSERT INTO `bhy_channel` VALUES ('13', '0', '服务内容', 'service/index', '3', '', '1480476230', '1480476230', '1', '0');
INSERT INTO `bhy_channel` VALUES ('14', '13', '研发及咨询', 'service/index', '1', '', '1480476249', '1480476249', '1', '0');
INSERT INTO `bhy_channel` VALUES ('15', '13', '测试与评价', 'service', '2', '', '1480476272', '1480476286', '1', '0');
INSERT INTO `bhy_channel` VALUES ('16', '13', '产业化', 'service', '3', '', '1480476303', '1480476303', '1', '0');
INSERT INTO `bhy_channel` VALUES ('17', '0', '科技实力', 'Science/index', '4', '', '1480476358', '1480476358', '1', '0');
INSERT INTO `bhy_channel` VALUES ('18', '17', '科技实力', 'Science/index', '1', '', '1480476387', '1480476387', '1', '0');
INSERT INTO `bhy_channel` VALUES ('19', '17', '授权授牌', 'Science/index', '2', '', '1480476406', '1480476406', '1', '0');
INSERT INTO `bhy_channel` VALUES ('20', '0', '投资者关系', 'Invest/index', '5', '', '1480476446', '1480476453', '1', '0');
INSERT INTO `bhy_channel` VALUES ('21', '20', '公司治理', 'Invest', '1', '', '1480476476', '1480476476', '1', '0');
INSERT INTO `bhy_channel` VALUES ('22', '20', '财务信息', 'Invest', '2', '', '1480476498', '1480476498', '1', '0');
INSERT INTO `bhy_channel` VALUES ('23', '20', '公告与发布', 'Invest', '3', '', '1480476518', '1480476518', '1', '0');
INSERT INTO `bhy_channel` VALUES ('24', '20', '投资者活动', 'Invest', '4', '', '1480476535', '1480476535', '1', '0');
INSERT INTO `bhy_channel` VALUES ('25', '20', '招股说明书', 'Invest', '5', '', '1480476554', '1480476554', '1', '0');
INSERT INTO `bhy_channel` VALUES ('26', '20', '章程及制度', 'Invest', '6', '', '1480476575', '1480476575', '1', '0');
INSERT INTO `bhy_channel` VALUES ('27', '4', '人才理念', 'aa', '1', '', '1480476704', '1480476704', '1', '0');
INSERT INTO `bhy_channel` VALUES ('28', '4', '人才招聘', 'aa', '2', '', '1480476732', '1480476732', '1', '0');
INSERT INTO `bhy_channel` VALUES ('29', '4', '专家队伍', 'aa', '3', '', '1480476761', '1480476761', '1', '0');
INSERT INTO `bhy_channel` VALUES ('30', '4', '博士后工作站', 'aa', '4', '', '1480476957', '1480476957', '1', '0');
INSERT INTO `bhy_channel` VALUES ('31', '4', '人事动态', 'aa', '5', '', '1480476988', '1480476988', '1', '0');

-- ----------------------------
-- Table structure for bhy_config
-- ----------------------------
DROP TABLE IF EXISTS `bhy_config`;
CREATE TABLE `bhy_config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '配置ID',
  `name` varchar(30) NOT NULL DEFAULT '' COMMENT '配置名称',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置类型',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '配置说明',
  `group` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置分组',
  `extra` varchar(255) NOT NULL DEFAULT '' COMMENT '配置值',
  `remark` varchar(100) NOT NULL COMMENT '配置说明',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  `value` text NOT NULL COMMENT '配置值',
  `sort` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`),
  KEY `type` (`type`),
  KEY `group` (`group`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bhy_config
-- ----------------------------
INSERT INTO `bhy_config` VALUES ('1', 'WEB_SITE_TITLE', '1', '网站标题', '1', '', '网站标题前台显示标题', '1378898976', '1379235274', '1', '中国新能源汽车评价规程', '0');
INSERT INTO `bhy_config` VALUES ('2', 'WEB_SITE_DESCRIPTION', '2', '网站描述', '1', '', '网站搜索引擎描述', '1378898976', '1379235841', '1', '汽车驾乘指数', '1');
INSERT INTO `bhy_config` VALUES ('3', 'WEB_SITE_KEYWORD', '2', '网站关键字', '1', '', '网站搜索引擎关键字', '1378898976', '1381390100', '1', '', '8');
INSERT INTO `bhy_config` VALUES ('4', 'WEB_SITE_CLOSE', '4', '关闭站点', '1', '0:关闭,1:开启', '站点关闭后其他用户不能访问，管理员可以正常访问', '1378898976', '1379235296', '1', '1', '1');
INSERT INTO `bhy_config` VALUES ('9', 'CONFIG_TYPE_LIST', '3', '配置类型列表', '4', '', '主要用于数据解析和页面表单的生成', '1378898976', '1379235348', '1', '0:数字\r\n1:字符\r\n2:文本\r\n3:数组\r\n4:枚举', '2');
INSERT INTO `bhy_config` VALUES ('10', 'WEB_SITE_ICP', '1', '网站备案号', '1', '', '设置在网站底部显示的备案号，如“沪ICP备12007941号-2', '1378900335', '1379235859', '1', '', '9');
INSERT INTO `bhy_config` VALUES ('11', 'DOCUMENT_POSITION', '3', '文档推荐位', '2', '', '文档推荐位，推荐到多个位置KEY值相加即可', '1379053380', '1379235329', '1', '1:热门\r\n2:置顶\r\n3:首页', '3');
INSERT INTO `bhy_config` VALUES ('12', 'DOCUMENT_DISPLAY', '3', '文档可见性', '2', '', '文章可见性仅影响前台显示，后台不收影响', '1379056370', '1379235322', '1', '0:所有人可见\r\n1:仅注册会员可见\r\n2:仅管理员可见', '4');
INSERT INTO `bhy_config` VALUES ('13', 'COLOR_STYLE', '4', '后台色系', '0', 'default_color:默认\r\nblue_color:紫罗兰', '后台颜色风格', '1379122533', '1538273322', '1', 'default_color', '10');
INSERT INTO `bhy_config` VALUES ('20', 'CONFIG_GROUP_LIST', '3', '配置分组', '4', '', '配置分组', '1379228036', '1384418383', '1', '1:基本\r\n2:内容\r\n3:用户\r\n4:系统\r\n', '4');
INSERT INTO `bhy_config` VALUES ('21', 'HOOKS_TYPE', '3', '钩子的类型', '4', '', '类型 1-用于扩展显示内容，2-用于扩展业务处理', '1379313397', '1379313407', '1', '1:视图\r\n2:控制器', '6');
INSERT INTO `bhy_config` VALUES ('22', 'AUTH_CONFIG', '3', 'Auth配置', '4', '', '自定义Auth.class.php类配置', '1379409310', '1379409564', '1', 'AUTH_ON:1\r\nAUTH_TYPE:2', '8');
INSERT INTO `bhy_config` VALUES ('23', 'OPEN_DRAFTBOX', '4', '是否开启草稿功能', '2', '0:关闭草稿功能\r\n1:开启草稿功能\r\n', '新增文章时的草稿功能配置', '1379484332', '1379484591', '1', '1', '1');
INSERT INTO `bhy_config` VALUES ('24', 'DRAFT_AOTOSAVE_INTERVAL', '0', '自动保存草稿时间', '2', '', '自动保存草稿的时间间隔，单位：秒', '1379484574', '1386143323', '1', '60', '2');
INSERT INTO `bhy_config` VALUES ('25', 'LIST_ROWS', '0', '后台每页记录数', '2', '', '后台数据每页显示记录数', '1379503896', '1380427745', '1', '20', '10');
INSERT INTO `bhy_config` VALUES ('26', 'USER_ALLOW_REGISTER', '4', '是否允许用户注册', '3', '0:关闭注册\r\n1:允许注册', '是否开放用户注册', '1379504487', '1426139806', '1', '1', '0');
INSERT INTO `bhy_config` VALUES ('27', 'CODEMIRROR_THEME', '4', '预览插件的CodeMirror主题', '4', '3024-day:3024 day\r\n3024-night:3024 night\r\nambiance:ambiance\r\nbase16-dark:base16 dark\r\nbase16-light:base16 light\r\nblackboard:blackboard\r\ncobalt:cobalt\r\neclipse:eclipse\r\nelegant:elegant\r\nerlang-dark:erlang-dark\r\nlesser-dark:lesser-dark\r\nmidnight:midnight', '详情见CodeMirror官网', '1379814385', '1384740813', '1', 'ambiance', '3');
INSERT INTO `bhy_config` VALUES ('28', 'DATA_BACKUP_PATH', '1', '数据库备份根路径', '4', '', '路径必须以 / 结尾', '1381482411', '1381482411', '1', './Data/', '5');
INSERT INTO `bhy_config` VALUES ('29', 'DATA_BACKUP_PART_SIZE', '0', '数据库备份卷大小', '4', '', '该值用于限制压缩后的分卷最大长度。单位：B；建议设置20M', '1381482488', '1381729564', '1', '20971520', '7');
INSERT INTO `bhy_config` VALUES ('30', 'DATA_BACKUP_COMPRESS', '4', '数据库备份文件是否启用压缩', '4', '0:不压缩\r\n1:启用压缩', '压缩备份文件需要PHP环境支持gzopen,gzwrite函数', '1381713345', '1381729544', '1', '1', '9');
INSERT INTO `bhy_config` VALUES ('31', 'DATA_BACKUP_COMPRESS_LEVEL', '4', '数据库备份文件压缩级别', '4', '1:普通\r\n4:一般\r\n9:最高', '数据库备份文件的压缩级别，该配置在开启压缩时生效', '1381713408', '1381713408', '1', '9', '10');
INSERT INTO `bhy_config` VALUES ('32', 'DEVELOP_MODE', '4', '开启开发者模式', '4', '0:关闭\r\n1:开启', '是否开启开发者模式', '1383105995', '1383291877', '1', '1', '11');
INSERT INTO `bhy_config` VALUES ('33', 'ALLOW_VISIT', '3', '不受限控制器方法', '0', '', '', '1386644047', '1386644741', '1', '0:article/draftbox\r\n1:article/mydocument\r\n2:Category/tree\r\n3:Index/verify\r\n4:file/upload\r\n5:file/download\r\n6:user/updatePassword\r\n7:user/updateNickname\r\n8:user/submitPassword\r\n9:user/submitNickname\r\n10:file/uploadpicture', '0');
INSERT INTO `bhy_config` VALUES ('34', 'DENY_VISIT', '3', '超管专限控制器方法', '0', '', '仅超级管理员可访问的控制器方法', '1386644141', '1386644659', '1', '0:Addons/addhook\r\n1:Addons/edithook\r\n2:Addons/delhook\r\n3:Addons/updateHook\r\n4:Admin/getMenus\r\n5:Admin/recordList\r\n6:AuthManager/updateRules\r\n7:AuthManager/tree', '0');
INSERT INTO `bhy_config` VALUES ('35', 'REPLY_LIST_ROWS', '0', '回复列表每页条数', '2', '', '', '1386645376', '1387178083', '1', '10', '0');
INSERT INTO `bhy_config` VALUES ('36', 'ADMIN_ALLOW_IP', '2', '后台允许访问IP', '4', '', '多个用逗号分隔，如果不配置表示不限制IP访问', '1387165454', '1387165553', '1', '', '12');
INSERT INTO `bhy_config` VALUES ('37', 'SHOW_PAGE_TRACE', '4', '是否显示页面Trace', '4', '0:关闭\r\n1:开启', '是否显示页面Trace信息', '1387165685', '1387165685', '1', '0', '1');
INSERT INTO `bhy_config` VALUES ('38', 'WEB_SITE_MOBILE', '1', '联系方式', '1', '', '', '1426138255', '1480489465', '1', '023-68824060', '0');
INSERT INTO `bhy_config` VALUES ('39', 'WEB_SITE_PORMPT', '2', '注册温馨提示', '3', '', '', '1426139760', '1426139784', '1', '', '1');
INSERT INTO `bhy_config` VALUES ('64', 'WEB_HOT_SEARCH', '2', '热门搜索', '4', '', '', '1455953485', '1455953485', '1', '', '0');
INSERT INTO `bhy_config` VALUES ('40', 'WEB_SITE_YZ', '0', '验证码过期时间', '3', '', '', '1426228653', '1426228653', '1', '240', '0');
INSERT INTO `bhy_config` VALUES ('41', 'WEB_SERVICE_LENGTH', '0', '验证码长度', '3', '', '短信验证码长度', '1426230205', '1427419748', '1', '6', '0');
INSERT INTO `bhy_config` VALUES ('46', 'WEB_SITE_FLAGS', '3', '属性', '2', '', '', '1426650866', '1426651161', '1', '1:首页推荐\r\n2:推荐\r\n3:好评\r\n4:喜欢\r\n5:置顶\r\n6:热贴', '0');
INSERT INTO `bhy_config` VALUES ('47', 'WEB_ACTIVITY_FLAG', '3', '活动属性', '2', '', '活动属性', '1426748205', '1426748205', '1', '1:热门\r\n2:最新', '0');
INSERT INTO `bhy_config` VALUES ('66', 'WEB_ENGLISH_TITLE', '1', '网站英文标题', '1', '', '', '1480489742', '1538273220', '1', '', '0');
INSERT INTO `bhy_config` VALUES ('50', 'WEB_SITE_CODE', '0', '推荐号长度', '3', '', '会员推荐码长度', '1427419781', '1427419781', '1', '7', '0');
INSERT INTO `bhy_config` VALUES ('52', 'WEB_EMAIL_CONFIG_TYPE', '3', '邮箱配置类型', '4', '', '', '1427855357', '1427855357', '1', '1:用户注册\r\n2:修改密码\r\n3:修改邮箱', '0');
INSERT INTO `bhy_config` VALUES ('70', 'WEB_BANQUAN_AUTH', '1', '网站版权', '1', '', '网站底部版权', '1493780295', '1493780295', '1', '', '0');

-- ----------------------------
-- Table structure for bhy_contact
-- ----------------------------
DROP TABLE IF EXISTS `bhy_contact`;
CREATE TABLE `bhy_contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `title` varchar(250) DEFAULT NULL COMMENT '新闻标题',
  `egname` varchar(250) DEFAULT NULL COMMENT '英文标题',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1合作企业，2联系我们',
  `address` varchar(200) DEFAULT NULL COMMENT '地址',
  `egaddress` varchar(255) DEFAULT NULL COMMENT '英文地址',
  `web_url` varchar(100) DEFAULT NULL COMMENT '网址',
  `mobile` varchar(50) DEFAULT NULL COMMENT '手机号',
  `zj_mobile` varchar(50) DEFAULT NULL COMMENT '座机',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '新闻状态',
  `icon` int(10) NOT NULL COMMENT '新闻缩略图ID',
  `icon2` int(10) DEFAULT '0' COMMENT '二维码',
  `flag` varchar(50) DEFAULT NULL COMMENT '新闻属性',
  `sort` int(10) NOT NULL COMMENT '排序',
  `remark` text COMMENT '备注',
  `create_time` int(20) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(20) DEFAULT NULL COMMENT '修改时间',
  `fax_code` varchar(200) DEFAULT NULL COMMENT '传真',
  `email` varchar(200) DEFAULT NULL COMMENT '邮箱',
  `danwei` int(1) unsigned DEFAULT '0' COMMENT '单位',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bhy_contact
-- ----------------------------
INSERT INTO `bhy_contact` VALUES ('1', 'TOYOTA', 'TOYOTA', '1', '重庆市两江新区金渝大道9号', 'No.1 Dingkunchi Second Road (Western), Hi-Tech Industrial Zone, Xi\'an, Shaanxi, 710119, P.R.China', 'http://www.caeri.com.cn/', '+86 29 65651717', '023-68824060', '1', '162', '150', null, '2', null, '1516350050', '1550474543', '023-68821361', 'office@caeri.com.cn', '0');
INSERT INTO `bhy_contact` VALUES ('2', 'HYUNDRI', 'HYUNDRI', '1', '北京市西城区闹市口大街长安兴融中心3号楼11层 （100021）', '北京市西城区闹市口大街长安兴融中心3号楼11层 （100021）', 'http://www.ciri.ac.cn', '+86 0512 62831288', '010-55668800', '1', '161', '149', null, '3', null, '1516350315', '1550474509', '010-55668801', 'contact@ciri.ac.cn', '0');
INSERT INTO `bhy_contact` VALUES ('8', '大众有限公司', '大众有限公司', '1', '北京市西城区金融大街15号鑫茂大厦7层', '北京市西城区金融大街15号鑫茂大厦7层', 'http://www.iachina.cn', null, '010-66290333', '1', '160', '148', null, '1', null, '1538223316', '1550474475', '010-66290333', 'xinxi@iachina.cn', '0');
INSERT INTO `bhy_contact` VALUES ('10', '奔驰', '奔驰', '1', '重庆', '', 'http://www.baidu.com', null, '12345678912', '1', '159', '0', null, '0', null, '1550475150', null, '123123', '123@qq.com', '0');
INSERT INTO `bhy_contact` VALUES ('11', '联系我们', '123', '2', '', '', '', null, '', '-1', '0', '0', null, '0', null, '1550478771', null, '', '', '0');

-- ----------------------------
-- Table structure for bhy_enclosure
-- ----------------------------
DROP TABLE IF EXISTS `bhy_enclosure`;
CREATE TABLE `bhy_enclosure` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '附件名',
  `egname` varchar(255) NOT NULL COMMENT '英文标题',
  `typeid` int(10) DEFAULT '0' COMMENT '分类id',
  `descriptions` varchar(0) NOT NULL COMMENT '描述',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `file` int(11) NOT NULL DEFAULT '0' COMMENT '附件id',
  `sort` int(10) DEFAULT '0' COMMENT '排序',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '附件类型',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bhy_enclosure
-- ----------------------------
INSERT INTO `bhy_enclosure` VALUES ('3', '中国保险汽车安全指数管理办法（2018版）', '中国保险汽车安全指数管理办法（2018版）', '55', '', '1', '13', '0', '0', '1538218142', '1538218334');
INSERT INTO `bhy_enclosure` VALUES ('4', '中国保险汽车安全指数管理办法（2018版）', '中国保险汽车安全指数管理办法（2018版）', '20', '', '1', '13', '0', '0', '1538219406', '0');

-- ----------------------------
-- Table structure for bhy_file
-- ----------------------------
DROP TABLE IF EXISTS `bhy_file`;
CREATE TABLE `bhy_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文件ID',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '原始文件名',
  `savename` char(20) NOT NULL DEFAULT '' COMMENT '保存名称',
  `savepath` char(30) NOT NULL DEFAULT '' COMMENT '文件保存路径',
  `ext` char(5) NOT NULL DEFAULT '' COMMENT '文件后缀',
  `mime` char(40) NOT NULL DEFAULT '' COMMENT '文件mime类型',
  `size` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '文件大小',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `location` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '文件保存位置',
  `create_time` int(10) unsigned NOT NULL COMMENT '上传时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_md5` (`md5`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='文件表';

-- ----------------------------
-- Records of bhy_file
-- ----------------------------
INSERT INTO `bhy_file` VALUES ('1', '2.mp4', '5b39b39381df5.mp4', '2018-07-02/', 'mp4', 'application/octet-stream', '1886377', 'dbf77d2e8de75885d999aab5d6ad9fab', 'ff58d7a6cec90f27786b8deb4d69a0df0a1e462b', '0', '1530508179');
INSERT INTO `bhy_file` VALUES ('2', '5a28fd7cefe47.mp4', '5b39b49546ba4.mp4', '2018-07-02/', 'mp4', 'application/octet-stream', '6377172', '4bbe1ed65c6e64407e38de52a13fc880', '8573521ce3d799687b38627f8da1d0c5d92a3f08', '0', '1530508436');
INSERT INTO `bhy_file` VALUES ('3', 'duanaaaaa.mp4', '5b47182d4590a.mp4', '2018-07-12/', 'mp4', 'video/mp4', '1397837', 'b55440cfe2494cabd5543ef424390e20', '304b8c87ea5f36daa55b32c062500ecb367bfa13', '0', '1531385901');
INSERT INTO `bhy_file` VALUES ('4', '航班路线表.docx', '5b62b8b826481.docx', '2018-08-02/', 'docx', 'application/zip', '21772', '1facc8819abb1e0656ac01ed9f72786a', '1af993a4ead377c213f4dbc8891ea4d5e3cb8c69', '0', '1533196472');
INSERT INTO `bhy_file` VALUES ('5', '余仓修改20180608.docx', '5b9b7d459524e.docx', '2018-09-14/', 'docx', 'application/zip', '219187', '71f6c50107778db0d915ea40f210834a', '9f331eed1852e67af398872db0234af414aa5d67', '0', '1536916805');
INSERT INTO `bhy_file` VALUES ('6', '余仓修改20180613.docx', '5b9b7e0d0b8c6.docx', '2018-09-14/', 'docx', 'application/zip', '38972', '4ada46bf124c6f0b2ab7007afe1a137e', 'e9a7eed56c2e2f1803188687a72f4cc2ec1f0a10', '0', '1536917004');
INSERT INTO `bhy_file` VALUES ('7', '余仓问题.docx', '5b9b7e2c65960.docx', '2018-09-14/', 'docx', 'application/zip', '328440', 'c6efa2c91f234f834fc15542ea988fa7', 'ad4814b4e96a53aefb519087f18e877618fba42a', '0', '1536917036');
INSERT INTO `bhy_file` VALUES ('8', '驾乘指数-logo-标准.pdf', '5b9b8d69392e2.pdf', '2018-09-14/', 'pdf', 'application/pdf', '851240', '5236eac9e37c3f5188e05154dd9fbb06', '57382359fc79467d0d21327a9c296345e06ab3e3', '0', '1536920937');
INSERT INTO `bhy_file` VALUES ('9', '汽车消费者评价规程.pdf', '5ba0511378f93.pdf', '2018-09-18/', 'pdf', 'application/pdf', '213116', '40b727176d33233e5613c0246f000ec8', '8f25a377f8a2fe80f146755e17e51200cd98064a', '0', '1537233171');
INSERT INTO `bhy_file` VALUES ('10', '汽车驾驶性指数测试评价规程.pdf', '5ba0513b2413f.pdf', '2018-09-18/', 'pdf', 'application/pdf', '578601', '5d0cae4d942b6857be2a5edef227d1f8', '1e0c019df4ba0f832aadb22fa554b456d85ba20a', '0', '1537233210');
INSERT INTO `bhy_file` VALUES ('11', '汽车舒适性指数测试评价规程.pdf', '5ba0515494017.pdf', '2018-09-18/', 'pdf', 'application/pdf', '1294057', '282a200f5cd45ed7c0dc08754f1f74f2', 'b357680e1af16e3a007ab8a3bc0121c5fec7abc5', '0', '1537233236');
INSERT INTO `bhy_file` VALUES ('12', '汽车操控安全性指数测试评价规程.pdf', '5ba0517f9bafc.pdf', '2018-09-18/', 'pdf', 'application/pdf', '1197863', '22709eb433d3cfcaa8c1c69c7e410a57', '254648b03b2c4d1a367e48bc9e32a619d5ea7f7c', '0', '1537233279');
INSERT INTO `bhy_file` VALUES ('13', '测试.docx', '5baf588f30f48.docx', '2018-09-29/', 'docx', 'application/zip', '10991', '79b725153ba5a66a10a2521809b6d33c', '469f9a4e7db65cdbd9c8a4711b92e7e80ab5d199', '0', '1538218127');

-- ----------------------------
-- Table structure for bhy_hooks
-- ----------------------------
DROP TABLE IF EXISTS `bhy_hooks`;
CREATE TABLE `bhy_hooks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(40) NOT NULL DEFAULT '' COMMENT '钩子名称',
  `description` text NOT NULL COMMENT '描述',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '类型',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `addons` varchar(255) NOT NULL DEFAULT '' COMMENT '钩子挂载的插件 ''，''分割',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bhy_hooks
-- ----------------------------
INSERT INTO `bhy_hooks` VALUES ('1', 'pageHeader', '页面header钩子，一般用于加载插件CSS文件和代码', '1', '0', '');
INSERT INTO `bhy_hooks` VALUES ('2', 'pageFooter', '页面footer钩子，一般用于加载插件JS文件和JS代码', '1', '0', 'ReturnTop');
INSERT INTO `bhy_hooks` VALUES ('3', 'documentEditForm', '添加编辑表单的 扩展内容钩子', '1', '0', 'Attachment');
INSERT INTO `bhy_hooks` VALUES ('4', 'documentDetailAfter', '文档末尾显示', '1', '0', 'Attachment,SocialComment');
INSERT INTO `bhy_hooks` VALUES ('5', 'documentDetailBefore', '页面内容前显示用钩子', '1', '0', '');
INSERT INTO `bhy_hooks` VALUES ('6', 'documentSaveComplete', '保存文档数据后的扩展钩子', '2', '0', 'Attachment');
INSERT INTO `bhy_hooks` VALUES ('7', 'documentEditFormContent', '添加编辑表单的内容显示钩子', '1', '0', 'Editor');
INSERT INTO `bhy_hooks` VALUES ('8', 'adminArticleEdit', '后台内容编辑页编辑器', '1', '1378982734', 'EditorForAdmin');
INSERT INTO `bhy_hooks` VALUES ('13', 'AdminIndex', '首页小格子个性化显示', '1', '1382596073', 'SiteStat,SystemInfo,DevTeam,Weather');
INSERT INTO `bhy_hooks` VALUES ('14', 'topicComment', '评论提交方式扩展钩子。', '1', '1380163518', 'Editor');
INSERT INTO `bhy_hooks` VALUES ('16', 'app_begin', '应用开始', '2', '1384481614', '');
INSERT INTO `bhy_hooks` VALUES ('17', 'UploadImages', '上传图片插件挂载点', '1', '1426063726', 'uploadImages,UploadImages');
INSERT INTO `bhy_hooks` VALUES ('19', 'AdminPageFooter', '后台钩子', '1', '1427779357', '');
INSERT INTO `bhy_hooks` VALUES ('24', 'pageTop', 'pageTop', '1', '1428903152', 'Weather');

-- ----------------------------
-- Table structure for bhy_links
-- ----------------------------
DROP TABLE IF EXISTS `bhy_links`;
CREATE TABLE `bhy_links` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) DEFAULT NULL COMMENT '标题',
  `egname` varchar(150) DEFAULT NULL COMMENT '英文标题',
  `url` varchar(200) DEFAULT NULL COMMENT '链接地址',
  `icon` int(12) DEFAULT '0' COMMENT '缩略图',
  `sort` int(10) DEFAULT '0' COMMENT '排序',
  `status` tinyint(2) DEFAULT '1' COMMENT '状态',
  `create_time` int(12) DEFAULT '0' COMMENT '添加时间',
  `update_time` int(12) DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bhy_links
-- ----------------------------
INSERT INTO `bhy_links` VALUES ('1', '中国银行保险监督管理委员会', '中国银行保险监督管理委员会', '/', '0', '0', '1', '0', '0');
INSERT INTO `bhy_links` VALUES ('2', '中国保险行业协会', '中国保险行业协会', '/', '0', '0', '1', '0', '0');
INSERT INTO `bhy_links` VALUES ('3', '中国汽车工程研究院', '中国汽车工程研究院', '/', '0', '0', '1', '0', '0');
INSERT INTO `bhy_links` VALUES ('4', '中保研汽车技术研究院', '中保研汽车技术研究院', '/', '0', '0', '1', '0', '0');
INSERT INTO `bhy_links` VALUES ('5', 'IIHS', 'IIHS', '/', '0', '0', '1', '0', '0');
INSERT INTO `bhy_links` VALUES ('6', 'Euro-NCAP', 'Euro-NCAP', '/', '0', '0', '1', '0', '0');
INSERT INTO `bhy_links` VALUES ('7', 'RCAR', 'RCAR', '/', '0', '0', '1', '0', '0');
INSERT INTO `bhy_links` VALUES ('8', 'Euro-NCAP', 'Euro-NCAP', '/', '0', '0', '1', '0', '0');

-- ----------------------------
-- Table structure for bhy_media
-- ----------------------------
DROP TABLE IF EXISTS `bhy_media`;
CREATE TABLE `bhy_media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `sort` int(11) DEFAULT '0',
  `view` int(10) DEFAULT '0',
  `content` mediumtext NOT NULL COMMENT '简介',
  `detail` mediumtext,
  `icon` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL DEFAULT '0',
  `recommend` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='旅行社表';

-- ----------------------------
-- Records of bhy_media
-- ----------------------------
INSERT INTO `bhy_media` VALUES ('2', '2018 i-VISTA自动驾驶汽车挑战赛圆满落幕', '0', '16', '2018 i-VISTA自动驾驶汽车挑战赛在重庆悦来国际会议中心圆满落幕。在智博会闭幕上，重庆市委副书记、市长唐良智、市委常委、常务副市长吴存荣', '<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	中国汽车工程研究院股份有限公司和中国消费者报社联合开展了以消费者购车用车为核心的“中国消费者汽车驾乘指数”研究工作。\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	2018年9月3日中国消费者汽车驾乘指数管理中心正式对外发布《中国消费者汽车驾乘指数测试评价规程（征求意见稿）》，从汽车的驾乘舒适性、驾驶性、操控安全性及消费者评价四个维度进行全面的测试评价。面向广大消费者征求意见，征求意见时间为2018年9月3日至10月10日。\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	联系我们：\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	中国汽车工程研究院股份有限公司 徐磊 023-68087832 xulei1@caeri.com.cn\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	中国消费者报社 聂国春 010-88315448 nc200200117@163.com\r\n</p>', '84', '1', '1531874975', '1531728571', '0');
INSERT INTO `bhy_media` VALUES ('3', '2018 i-VISTA自动驾驶汽车挑战赛圆满落幕', '0', '1', '2018 i-VISTA自动驾驶汽车挑战赛在重庆悦来国际会议中心圆满落幕。在智博会闭幕上，重庆市委副书记、市长唐良智、市委常委、常务副市长吴存荣', '<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	中国汽车工程研究院股份有限公司和中国消费者报社联合开展了以消费者购车用车为核心的“中国消费者汽车驾乘指数”研究工作。\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	2018年9月3日中国消费者汽车驾乘指数管理中心正式对外发布《中国消费者汽车驾乘指数测试评价规程（征求意见稿）》，从汽车的驾乘舒适性、驾驶性、操控安全性及消费者评价四个维度进行全面的测试评价。面向广大消费者征求意见，征求意见时间为2018年9月3日至10月10日。\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	联系我们：\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	中国汽车工程研究院股份有限公司 徐磊 023-68087832 xulei1@caeri.com.cn\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	中国消费者报社 聂国春 010-88315448 nc200200117@163.com\r\n</p>', '84', '1', '1531874975', '1531729054', '0');
INSERT INTO `bhy_media` VALUES ('4', '2018 i-VISTA自动驾驶汽车挑战赛圆满落幕', '0', '2', '2018 i-VISTA自动驾驶汽车挑战赛在重庆悦来国际会议中心圆满落幕。在智博会闭幕上，重庆市委副书记、市长唐良智、市委常委、常务副市长吴存荣', '<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	中国汽车工程研究院股份有限公司和中国消费者报社联合开展了以消费者购车用车为核心的“中国消费者汽车驾乘指数”研究工作。\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	2018年9月3日中国消费者汽车驾乘指数管理中心正式对外发布《中国消费者汽车驾乘指数测试评价规程（征求意见稿）》，从汽车的驾乘舒适性、驾驶性、操控安全性及消费者评价四个维度进行全面的测试评价。面向广大消费者征求意见，征求意见时间为2018年9月3日至10月10日。\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	联系我们：\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	中国汽车工程研究院股份有限公司 徐磊 023-68087832 xulei1@caeri.com.cn\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	中国消费者报社 聂国春 010-88315448 nc200200117@163.com\r\n</p>', '84', '1', '1531874975', '1531729061', '0');
INSERT INTO `bhy_media` VALUES ('6', '2018 i-VISTA自动驾驶汽车挑战赛圆满落幕', '0', '2', '2018 i-VISTA自动驾驶汽车挑战赛在重庆悦来国际会议中心圆满落幕。在智博会闭幕上，重庆市委副书记、市长唐良智、市委常委、常务副市长吴存荣', '<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	中国汽车工程研究院股份有限公司和中国消费者报社联合开展了以消费者购车用车为核心的“中国消费者汽车驾乘指数”研究工作。\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	2018年9月3日中国消费者汽车驾乘指数管理中心正式对外发布《中国消费者汽车驾乘指数测试评价规程（征求意见稿）》，从汽车的驾乘舒适性、驾驶性、操控安全性及消费者评价四个维度进行全面的测试评价。面向广大消费者征求意见，征求意见时间为2018年9月3日至10月10日。\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	联系我们：\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	中国汽车工程研究院股份有限公司 徐磊 023-68087832 xulei1@caeri.com.cn\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	中国消费者报社 聂国春 010-88315448 nc200200117@163.com\r\n</p>', '84', '1', '1531874975', '1531874975', '0');
INSERT INTO `bhy_media` VALUES ('7', '2018 i-VISTA自动驾驶汽车挑战赛圆满落幕', '0', '1', '2018 i-VISTA自动驾驶汽车挑战赛在重庆悦来国际会议中心圆满落幕。在智博会闭幕上，重庆市委副书记、市长唐良智、市委常委、常务副市长吴存荣', '<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	中国汽车工程研究院股份有限公司和中国消费者报社联合开展了以消费者购车用车为核心的“中国消费者汽车驾乘指数”研究工作。\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	2018年9月3日中国消费者汽车驾乘指数管理中心正式对外发布《中国消费者汽车驾乘指数测试评价规程（征求意见稿）》，从汽车的驾乘舒适性、驾驶性、操控安全性及消费者评价四个维度进行全面的测试评价。面向广大消费者征求意见，征求意见时间为2018年9月3日至10月10日。\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	联系我们：\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	中国汽车工程研究院股份有限公司 徐磊 023-68087832 xulei1@caeri.com.cn\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	中国消费者报社 聂国春 010-88315448 nc200200117@163.com\r\n</p>', '84', '1', '1531874975', '0', '0');
INSERT INTO `bhy_media` VALUES ('8', '2018 i-VISTA自动驾驶汽车挑战赛圆满落幕', '0', '1', '2018 i-VISTA自动驾驶汽车挑战赛在重庆悦来国际会议中心圆满落幕。在智博会闭幕上，重庆市委副书记、市长唐良智、市委常委、常务副市长吴存荣', '<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	中国汽车工程研究院股份有限公司和中国消费者报社联合开展了以消费者购车用车为核心的“中国消费者汽车驾乘指数”研究工作。\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	2018年9月3日中国消费者汽车驾乘指数管理中心正式对外发布《中国消费者汽车驾乘指数测试评价规程（征求意见稿）》，从汽车的驾乘舒适性、驾驶性、操控安全性及消费者评价四个维度进行全面的测试评价。面向广大消费者征求意见，征求意见时间为2018年9月3日至10月10日。\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	联系我们：\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	中国汽车工程研究院股份有限公司 徐磊 023-68087832 xulei1@caeri.com.cn\r\n</p>\r\n<p style=\"color:#666666;font-family:&quot;font-size:14px;background-color:#FFFFFF;\">\r\n	中国消费者报社 聂国春 010-88315448 nc200200117@163.com\r\n</p>', '84', '1', '1531874975', '0', '0');
INSERT INTO `bhy_media` VALUES ('9', '2018 i-VISTA自动驾驶汽车挑战赛圆满落幕', '0', '3', '2018 i-VISTA自动驾驶汽车挑战赛在重庆悦来国际会议中心圆满落幕。在智博会闭幕上，重庆市委副书记、市长唐良智、市委常委、常务副市长吴存荣', '<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	中国汽车工程研究院股份有限公司和中国消费者报社联合开展了以消费者购车用车为核心的“中国消费者汽车驾乘指数”研究工作。\r\n	</p>\r\n<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	2018年9月3日中国消费者汽车驾乘指数管理中心正式对外发布《中国消费者汽车驾乘指数测试评价规程（征求意见稿）》，从汽车的驾乘舒适性、驾驶性、操控安全性及消费者评价四个维度进行全面的测试评价。面向广大消费者征求意见，征求意见时间为2018年9月3日至10月10日。\r\n</p>\r\n<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	联系我们：\r\n	</p>\r\n<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	中国汽车工程研究院股份有限公司 徐磊 023-68087832 xulei1@caeri.com.cn\r\n</p>\r\n<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	中国消费者报社 聂国春 010-88315448 nc200200117@163.com\r\n	</p>', '121', '1', '1531874975', '1537152815', '0');
INSERT INTO `bhy_media` VALUES ('10', '2018 i-VISTA自动驾驶汽车挑战赛圆满落幕', '0', '2', '2018 i-VISTA自动驾驶汽车挑战赛在重庆悦来国际会议中心圆满落幕。在智博会闭幕上，重庆市委副书记、市长唐良智、市委常委、常务副市长吴存荣', '<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	中国汽车工程研究院股份有限公司和中国消费者报社联合开展了以消费者购车用车为核心的“中国消费者汽车驾乘指数”研究工作。\r\n	</p>\r\n<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	2018年9月3日中国消费者汽车驾乘指数管理中心正式对外发布《中国消费者汽车驾乘指数测试评价规程（征求意见稿）》，从汽车的驾乘舒适性、驾驶性、操控安全性及消费者评价四个维度进行全面的测试评价。面向广大消费者征求意见，征求意见时间为2018年9月3日至10月10日。\r\n</p>\r\n<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	联系我们：\r\n	</p>\r\n<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	中国汽车工程研究院股份有限公司 徐磊 023-68087832 xulei1@caeri.com.cn\r\n</p>\r\n<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	中国消费者报社 聂国春 010-88315448 nc200200117@163.com\r\n	</p>', '120', '1', '1531874975', '1537152801', '0');
INSERT INTO `bhy_media` VALUES ('11', '2018 i-VISTA自动驾驶汽车挑战赛圆满落幕', '0', '4', '2018 i-VISTA自动驾驶汽车挑战赛在重庆悦来国际会议中心圆满落幕。在智博会闭幕上，重庆市委副书记、市长唐良智、市委常委、常务副市长吴存荣', '<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	中国汽车工程研究院股份有限公司和中国消费者报社联合开展了以消费者购车用车为核心的“中国消费者汽车驾乘指数”研究工作。\r\n	</p>\r\n<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	2018年9月3日中国消费者汽车驾乘指数管理中心正式对外发布《中国消费者汽车驾乘指数测试评价规程（征求意见稿）》，从汽车的驾乘舒适性、驾驶性、操控安全性及消费者评价四个维度进行全面的测试评价。面向广大消费者征求意见，征求意见时间为2018年9月3日至10月10日。\r\n</p>\r\n<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	联系我们：\r\n	</p>\r\n<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	中国汽车工程研究院股份有限公司 徐磊 023-68087832 xulei1@caeri.com.cn\r\n</p>\r\n<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	中国消费者报社 聂国春 010-88315448 nc200200117@163.com\r\n	</p>', '119', '1', '1531874975', '1537152787', '0');
INSERT INTO `bhy_media` VALUES ('12', '2018 i-VISTA自动驾驶汽车挑战赛圆满落幕', '0', '6', '2018 i-VISTA自动驾驶汽车挑战赛在重庆悦来国际会议中心圆满落幕。在智博会闭幕上，重庆市委副书记、市长唐良智、市委常委、常务副市长吴存荣', '<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	中国汽车工程研究院股份有限公司和中国消费者报社联合开展了以消费者购车用车为核心的“中国消费者汽车驾乘指数”研究工作。\r\n	</p>\r\n<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	2018年9月3日中国消费者汽车驾乘指数管理中心正式对外发布《中国消费者汽车驾乘指数测试评价规程（征求意见稿）》，从汽车的驾乘舒适性、驾驶性、操控安全性及消费者评价四个维度进行全面的测试评价。面向广大消费者征求意见，征求意见时间为2018年9月3日至10月10日。\r\n</p>\r\n<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	联系我们：\r\n	</p>\r\n<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	中国汽车工程研究院股份有限公司 徐磊 023-68087832 xulei1@caeri.com.cn\r\n</p>\r\n<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	中国消费者报社 聂国春 010-88315448 nc200200117@163.com\r\n	</p>', '118', '1', '1531874975', '1537152771', '0');
INSERT INTO `bhy_media` VALUES ('13', '2018 i-VISTA自动驾驶汽车挑战赛圆满落幕', '2', '13', '2018 i-VISTA自动驾驶汽车挑战赛在重庆悦来国际会议中心圆满落幕。在智博会闭幕上，重庆市委副书记、市长唐良智、市委常委、常务副市长吴存荣', '<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	中国汽车工程研究院股份有限公司和中国消费者报社联合开展了以消费者购车用车为核心的“中国消费者汽车驾乘指数”研究工作。\r\n	</p>\r\n<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	2018年9月3日中国消费者汽车驾乘指数管理中心正式对外发布《中国消费者汽车驾乘指数测试评价规程（征求意见稿）》，从汽车的驾乘舒适性、驾驶性、操控安全性及消费者评价四个维度进行全面的测试评价。面向广大消费者征求意见，征求意见时间为2018年9月3日至10月10日。\r\n</p>\r\n<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	联系我们：\r\n	</p>\r\n<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	中国汽车工程研究院股份有限公司 徐磊 023-68087832 xulei1@caeri.com.cn\r\n</p>\r\n<p style=\"color:#666666;font-family:\" font-size:14px;background-color:#ffffff;\"=\"\">\r\n	中国消费者报社 聂国春 010-88315448 nc200200117@163.com\r\n	</p>', '117', '1', '1531874975', '1537152758', '0');

-- ----------------------------
-- Table structure for bhy_member
-- ----------------------------
DROP TABLE IF EXISTS `bhy_member`;
CREATE TABLE `bhy_member` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `nickname` char(16) DEFAULT '',
  `sex` tinyint(3) unsigned DEFAULT '0' COMMENT '性别',
  `birthday` date DEFAULT '0000-00-00' COMMENT '生日',
  `qq` char(10) DEFAULT '' COMMENT 'qq号',
  `score` mediumint(8) DEFAULT '0' COMMENT '用户积分',
  `login` int(10) unsigned DEFAULT '0' COMMENT '登录次数',
  `icon` int(10) DEFAULT NULL COMMENT '用户头像',
  `sort` int(10) DEFAULT NULL COMMENT '排序',
  `pid` int(10) DEFAULT NULL COMMENT '所属职务',
  `flag` varchar(10) DEFAULT NULL COMMENT '属性',
  `reg_ip` bigint(20) DEFAULT '0' COMMENT '注册IP',
  `reg_time` int(10) unsigned DEFAULT '0' COMMENT '注册时间',
  `last_login_ip` bigint(20) DEFAULT '0' COMMENT '最后登录IP',
  `last_login_time` int(10) unsigned DEFAULT '0' COMMENT '最后登录时间',
  `status` tinyint(4) DEFAULT '0' COMMENT '会员状态',
  `content` mediumtext COMMENT '用户简介',
  `asknum` int(5) DEFAULT NULL COMMENT '问题数',
  `replynum` int(11) DEFAULT NULL COMMENT '回复数',
  `noreply` int(1) DEFAULT NULL COMMENT '是否禁言',
  PRIMARY KEY (`uid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of bhy_member
-- ----------------------------
INSERT INTO `bhy_member` VALUES ('1', '超级管理员', '0', '0000-00-00', '', '1170', '252', '0', '0', '0', null, '0', '1425520985', '2130706433', '1550480585', '1', null, '0', '2', '0');

-- ----------------------------
-- Table structure for bhy_menu
-- ----------------------------
DROP TABLE IF EXISTS `bhy_menu`;
CREATE TABLE `bhy_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `pid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序（同级有效）',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏',
  `tip` varchar(255) NOT NULL DEFAULT '' COMMENT '提示',
  `group` varchar(50) DEFAULT '' COMMENT '分组',
  `is_dev` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否仅开发者模式可见',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=336 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bhy_menu
-- ----------------------------
INSERT INTO `bhy_menu` VALUES ('1', '首页', '0', '1', 'Index/index', '1', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('2', '内容', '0', '2', 'Category/index', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('4', '新增', '3', '0', 'article/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('5', '编辑', '3', '0', 'article/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('6', '改变状态', '3', '0', 'article/setStatus', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('7', '保存', '3', '0', 'article/update', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('8', '保存草稿', '3', '0', 'article/autoSave', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('9', '移动', '3', '0', 'article/move', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('10', '复制', '3', '0', 'article/copy', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('11', '粘贴', '3', '0', 'article/paste', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('12', '导入', '3', '0', 'article/batchOperate', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('14', '还原', '13', '0', 'article/permit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('15', '清空', '13', '0', 'article/clear', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('16', '用户', '0', '3', 'User/index', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('17', '用户信息', '16', '0', 'User/index', '0', '', '用户管理', '0');
INSERT INTO `bhy_menu` VALUES ('18', '新增用户', '17', '0', 'User/add', '0', '添加新用户', '', '0');
INSERT INTO `bhy_menu` VALUES ('19', '用户行为', '16', '2', 'User/action', '1', '', '行为管理', '0');
INSERT INTO `bhy_menu` VALUES ('20', '新增用户行为', '19', '0', 'User/addaction', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('21', '编辑用户行为', '19', '0', 'User/editaction', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('22', '保存用户行为', '19', '0', 'User/saveAction', '0', '\"用户->用户行为\"保存编辑和新增的用户行为', '', '0');
INSERT INTO `bhy_menu` VALUES ('23', '变更行为状态', '19', '0', 'User/setStatus', '0', '\"用户->用户行为\"中的启用,禁用和删除权限', '', '0');
INSERT INTO `bhy_menu` VALUES ('24', '禁用会员', '19', '0', 'User/changeStatus?method=forbidUser', '0', '\"用户->用户信息\"中的禁用', '', '0');
INSERT INTO `bhy_menu` VALUES ('25', '启用会员', '19', '0', 'User/changeStatus?method=resumeUser', '0', '\"用户->用户信息\"中的启用', '', '0');
INSERT INTO `bhy_menu` VALUES ('26', '删除会员', '19', '0', 'User/changeStatus?method=deleteUser', '0', '\"用户->用户信息\"中的删除', '', '0');
INSERT INTO `bhy_menu` VALUES ('27', '权限管理', '16', '0', 'AuthManager/index', '0', '', '用户管理', '0');
INSERT INTO `bhy_menu` VALUES ('28', '删除', '27', '0', 'AuthManager/changeStatus?method=deleteGroup', '0', '删除用户组', '', '0');
INSERT INTO `bhy_menu` VALUES ('29', '禁用', '27', '0', 'AuthManager/changeStatus?method=forbidGroup', '0', '禁用用户组', '', '0');
INSERT INTO `bhy_menu` VALUES ('30', '恢复', '27', '0', 'AuthManager/changeStatus?method=resumeGroup', '0', '恢复已禁用的用户组', '', '0');
INSERT INTO `bhy_menu` VALUES ('31', '新增', '27', '0', 'AuthManager/createGroup', '0', '创建新的用户组', '', '0');
INSERT INTO `bhy_menu` VALUES ('32', '编辑', '27', '0', 'AuthManager/editGroup', '0', '编辑用户组名称和描述', '', '0');
INSERT INTO `bhy_menu` VALUES ('33', '保存用户组', '27', '0', 'AuthManager/writeGroup', '0', '新增和编辑用户组的\"保存\"按钮', '', '0');
INSERT INTO `bhy_menu` VALUES ('34', '授权', '27', '0', 'AuthManager/group', '0', '\"后台 \\ 用户 \\ 用户信息\"列表页的\"授权\"操作按钮,用于设置用户所属用户组', '', '0');
INSERT INTO `bhy_menu` VALUES ('35', '访问授权', '27', '0', 'AuthManager/access', '0', '\"后台 \\ 用户 \\ 权限管理\"列表页的\"访问授权\"操作按钮', '', '0');
INSERT INTO `bhy_menu` VALUES ('36', '成员授权', '27', '0', 'AuthManager/user', '0', '\"后台 \\ 用户 \\ 权限管理\"列表页的\"成员授权\"操作按钮', '', '0');
INSERT INTO `bhy_menu` VALUES ('37', '解除授权', '27', '0', 'AuthManager/removeFromGroup', '0', '\"成员授权\"列表页内的解除授权操作按钮', '', '0');
INSERT INTO `bhy_menu` VALUES ('38', '保存成员授权', '27', '0', 'AuthManager/addToGroup', '0', '\"用户信息\"列表页\"授权\"时的\"保存\"按钮和\"成员授权\"里右上角的\"添加\"按钮)', '', '0');
INSERT INTO `bhy_menu` VALUES ('39', '分类授权', '27', '0', 'AuthManager/category', '0', '\"后台 \\ 用户 \\ 权限管理\"列表页的\"分类授权\"操作按钮', '', '0');
INSERT INTO `bhy_menu` VALUES ('40', '保存分类授权', '27', '0', 'AuthManager/addToCategory', '0', '\"分类授权\"页面的\"保存\"按钮', '', '0');
INSERT INTO `bhy_menu` VALUES ('41', '模型授权', '27', '0', 'AuthManager/modelauth', '0', '\"后台 \\ 用户 \\ 权限管理\"列表页的\"模型授权\"操作按钮', '', '0');
INSERT INTO `bhy_menu` VALUES ('42', '保存模型授权', '27', '0', 'AuthManager/addToModel', '0', '\"分类授权\"页面的\"保存\"按钮', '', '0');
INSERT INTO `bhy_menu` VALUES ('43', '扩展', '0', '7', 'Addons/index', '1', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('44', '插件管理', '43', '1', 'Addons/index', '0', '', '扩展', '0');
INSERT INTO `bhy_menu` VALUES ('45', '创建', '44', '0', 'Addons/create', '0', '服务器上创建插件结构向导', '', '0');
INSERT INTO `bhy_menu` VALUES ('46', '检测创建', '44', '0', 'Addons/checkForm', '0', '检测插件是否可以创建', '', '0');
INSERT INTO `bhy_menu` VALUES ('47', '预览', '44', '0', 'Addons/preview', '0', '预览插件定义类文件', '', '0');
INSERT INTO `bhy_menu` VALUES ('48', '快速生成插件', '44', '0', 'Addons/build', '0', '开始生成插件结构', '', '0');
INSERT INTO `bhy_menu` VALUES ('49', '设置', '44', '0', 'Addons/config', '0', '设置插件配置', '', '0');
INSERT INTO `bhy_menu` VALUES ('50', '禁用', '44', '0', 'Addons/disable', '0', '禁用插件', '', '0');
INSERT INTO `bhy_menu` VALUES ('51', '启用', '44', '0', 'Addons/enable', '0', '启用插件', '', '0');
INSERT INTO `bhy_menu` VALUES ('52', '安装', '44', '0', 'Addons/install', '0', '安装插件', '', '0');
INSERT INTO `bhy_menu` VALUES ('53', '卸载', '44', '0', 'Addons/uninstall', '0', '卸载插件', '', '0');
INSERT INTO `bhy_menu` VALUES ('54', '更新配置', '44', '0', 'Addons/saveconfig', '0', '更新插件配置处理', '', '0');
INSERT INTO `bhy_menu` VALUES ('55', '插件后台列表', '44', '0', 'Addons/adminList', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('56', 'URL方式访问插件', '44', '0', 'Addons/execute', '0', '控制是否有权限通过url访问插件控制器方法', '', '0');
INSERT INTO `bhy_menu` VALUES ('57', '钩子管理', '43', '2', 'Addons/hooks', '0', '', '扩展', '0');
INSERT INTO `bhy_menu` VALUES ('58', '模型管理', '68', '3', 'Model/index', '0', '', '系统设置', '0');
INSERT INTO `bhy_menu` VALUES ('59', '新增', '58', '0', 'model/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('60', '编辑', '58', '0', 'model/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('61', '改变状态', '58', '0', 'model/setStatus', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('62', '保存数据', '58', '0', 'model/update', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('63', '属性管理', '68', '0', 'Attribute/index', '1', '网站属性配置。', '', '0');
INSERT INTO `bhy_menu` VALUES ('64', '新增', '63', '0', 'Attribute/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('65', '编辑', '63', '0', 'Attribute/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('66', '改变状态', '63', '0', 'Attribute/setStatus', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('67', '保存数据', '63', '0', 'Attribute/update', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('68', '系统', '0', '5', 'Config/group', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('69', '网站设置', '68', '1', 'Config/group', '0', '', '系统设置', '0');
INSERT INTO `bhy_menu` VALUES ('70', '配置管理', '68', '4', 'Config/index', '0', '', '系统设置', '0');
INSERT INTO `bhy_menu` VALUES ('71', '编辑', '70', '0', 'Config/edit', '0', '新增编辑和保存配置', '', '0');
INSERT INTO `bhy_menu` VALUES ('72', '删除', '70', '0', 'Config/del', '0', '删除配置', '', '0');
INSERT INTO `bhy_menu` VALUES ('73', '新增', '70', '0', 'Config/add', '0', '新增配置', '', '0');
INSERT INTO `bhy_menu` VALUES ('74', '保存', '70', '0', 'Config/save', '0', '保存配置', '', '0');
INSERT INTO `bhy_menu` VALUES ('75', '菜单管理', '68', '5', 'Menu/index', '0', '', '系统设置', '0');
INSERT INTO `bhy_menu` VALUES ('76', '导航管理', '68', '6', 'Channel/index', '0', '', '系统设置', '0');
INSERT INTO `bhy_menu` VALUES ('77', '新增', '76', '0', 'Channel/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('78', '编辑', '76', '0', 'Channel/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('79', '删除', '76', '0', 'Channel/del', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('80', '分类管理', '2', '2', 'Category/index', '0', '', '内容管理', '0');
INSERT INTO `bhy_menu` VALUES ('81', '编辑', '80', '0', 'Category/edit', '0', '编辑和保存栏目分类', '', '0');
INSERT INTO `bhy_menu` VALUES ('82', '新增', '80', '0', 'Category/add', '0', '新增栏目分类', '', '0');
INSERT INTO `bhy_menu` VALUES ('83', '删除', '80', '0', 'Category/remove', '0', '删除栏目分类', '', '0');
INSERT INTO `bhy_menu` VALUES ('84', '移动', '80', '0', 'Category/operate/type/move', '1', '移动栏目分类', '', '0');
INSERT INTO `bhy_menu` VALUES ('85', '合并', '80', '0', 'Category/operate/type/merge', '1', '合并栏目分类', '', '0');
INSERT INTO `bhy_menu` VALUES ('86', '备份数据库', '68', '0', 'Database/index?type=export', '0', '', '数据备份', '0');
INSERT INTO `bhy_menu` VALUES ('87', '备份', '86', '0', 'Database/export', '0', '备份数据库', '', '0');
INSERT INTO `bhy_menu` VALUES ('88', '优化表', '86', '0', 'Database/optimize', '0', '优化数据表', '', '0');
INSERT INTO `bhy_menu` VALUES ('89', '修复表', '86', '0', 'Database/repair', '0', '修复数据表', '', '0');
INSERT INTO `bhy_menu` VALUES ('90', '还原数据库', '68', '0', 'Database/index?type=import', '0', '', '数据备份', '0');
INSERT INTO `bhy_menu` VALUES ('91', '恢复', '90', '0', 'Database/import', '0', '数据库恢复', '', '0');
INSERT INTO `bhy_menu` VALUES ('92', '删除', '90', '0', 'Database/del', '0', '删除备份文件', '', '0');
INSERT INTO `bhy_menu` VALUES ('93', '其他', '0', '5', 'other', '1', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('96', '新增', '75', '0', 'Menu/add', '0', '', '系统设置', '0');
INSERT INTO `bhy_menu` VALUES ('98', '编辑', '75', '0', 'Menu/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('104', '下载管理', '102', '0', 'Think/lists?model=download', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('105', '配置管理', '102', '0', 'Think/lists?model=config', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('106', '行为日志', '16', '1', 'Action/actionlog', '1', '', '行为管理', '0');
INSERT INTO `bhy_menu` VALUES ('110', '查看行为日志', '106', '0', 'action/edit', '1', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('112', '新增数据', '58', '0', 'think/add', '1', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('113', '编辑数据', '58', '0', 'think/edit', '1', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('114', '导入', '75', '0', 'Menu/import', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('115', '生成', '58', '0', 'Model/generate', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('116', '新增钩子', '57', '0', 'Addons/addHook', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('117', '编辑钩子', '57', '0', 'Addons/edithook', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('118', '文档排序', '3', '0', 'Article/sort', '1', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('119', '排序', '70', '0', 'Config/sort', '1', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('120', '排序', '75', '0', 'Menu/sort', '1', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('121', '排序', '76', '0', 'Channel/sort', '1', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('124', '添加', '318', '0', 'News/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('125', '修改', '318', '0', 'News/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('126', '删除', '318', '0', 'News/changeStatus', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('207', '修改', '205', '0', 'questions/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('130', '添加', '128', '0', 'Persun/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('131', '修改', '128', '0', 'Persun/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('132', '会员列表', '16', '0', 'usermember/index', '1', '', '会员管理', '0');
INSERT INTO `bhy_menu` VALUES ('198', '添加', '133', '0', 'warea/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('199', '修改', '133', '0', 'warea/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('206', '添加', '205', '0', 'questions/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('197', '修改', '195', '0', 'stock/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('142', '添加会员', '132', '0', 'Usermember/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('143', '修改会员', '132', '0', 'Usermember/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('196', '添加', '195', '0', 'stock/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('146', '添加', '144', '0', 'Manifesto/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('147', '编辑', '144', '0', 'Manifesto/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('210', '新增', '209', '0', 'post/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('211', '修改', '209', '0', 'post/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('204', '修改', '153', '0', 'post/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('203', '添加', '153', '0', 'post/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('158', '添加', '156', '0', 'Garde/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('159', '修改', '156', '0', 'Garde/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('160', '删除', '156', '0', 'Garde/foreverdelete', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('162', '添加', '161', '0', 'Gift/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('163', '修改', '161', '0', 'Gift/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('164', '广告列表', '2', '0', 'ad/index', '0', '', '广告管理', '0');
INSERT INTO `bhy_menu` VALUES ('166', '添加', '164', '0', 'ad/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('167', '修改', '164', '0', 'ad/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('321', '联系方式', '2', '0', 'Contact/index', '0', '', '联系管理', '0');
INSERT INTO `bhy_menu` VALUES ('171', '邮箱接口', '68', '0', 'email/index', '1', '', '第三方端口', '0');
INSERT INTO `bhy_menu` VALUES ('323', '编辑', '321', '0', 'Contact/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('174', '添加', '171', '0', 'email/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('175', '修改', '171', '0', 'email/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('322', '新增', '321', '0', 'Contact/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('178', '添加', '177', '0', 'activity/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('179', '修改', '177', '0', 'activity/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('181', '添加', '180', '0', 'rechange/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('182', '修改', '180', '0', 'rechange/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('183', '支付宝接口', '68', '0', 'alipay/index', '1', '', '第三方端口', '0');
INSERT INTO `bhy_menu` VALUES ('184', '添加', '183', '0', 'alipay/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('185', '修改', '183', '0', 'alipay/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('187', '添加', '186', '0', 'monthly/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('188', '修改', '186', '0', 'monthly/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('213', '禁用', '80', '0', 'Category/setStatus', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('190', '添加', '189', '0', 'workrecord/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('191', '修改', '189', '0', 'workrecord/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('192', '删除', '189', '0', 'workrecord/foreverdelete', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('208', '回复', '205', '0', 'questions/stockreply', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('214', '还原', '318', '0', 'News/changeStatus/method/resumeUser', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('215', '彻底删除', '318', '0', 'News/changeStatus/method/forbidUser', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('216', '删除', '128', '0', 'Persun/foreverdelete', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('217', '删除', '133', '0', 'Warea/foreverdelete', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('218', '禁/启用/删除', '205', '0', 'Questions/changeStatus', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('219', '禁/启用/删除', '195', '0', 'Stock/changeStatus', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('220', '禁用', '17', '0', 'User/changeStatus', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('221', '删除', '17', '0', 'AuthManager/group', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('222', '禁言', '17', '0', 'User/changereplystatus', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('223', '禁/启用/删除', '132', '0', 'Usermember/changeStatus', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('224', '禁/启用/删除', '209', '0', 'Post/changeStatus', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('225', '修改密码', '17', '0', 'User/updateuserpwd', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('226', '修改回复', '205', '0', 'questions/updatemyreply', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('228', '编辑', '227', '0', 'reply/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('230', '新增', '229', '0', 'branch/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('231', '编辑', '229', '0', 'branch/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('232', '改变状态', '229', '0', 'branch/changeStatus', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('234', '添加', '233', '0', 'teacher/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('235', '编辑', '233', '0', 'teacher/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('236', '改变状态', '233', '0', 'teacher/changestatus', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('237', '列表', '80', '0', 'lists/index', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('324', '友情链接', '2', '0', 'Links/index', '0', '', '联系管理', '0');
INSERT INTO `bhy_menu` VALUES ('329', '新增', '319', '0', 'Enclosure/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('242', '删除', '314', '0', 'Video/changeStatus', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('244', '留言列表', '2', '3', 'Message/index', '0', '', '联系管理', '0');
INSERT INTO `bhy_menu` VALUES ('245', '编辑', '243', '0', 'teamtype/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('246', '增加', '243', '0', 'teamtype/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('247', '删除', '243', '0', 'teamtype/del', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('248', '列表', '243', '0', 'team/index', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('249', '查看', '244', '0', 'Message/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('251', '删除', '244', '0', 'Message/del', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('254', '新增', '252', '0', 'department/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('255', '编辑', '252', '0', 'department/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('256', '删除', '252', '0', 'department/del', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('257', '新增', '253', '0', 'position/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('258', '删除', '253', '0', 'position/del', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('259', '编辑', '253', '0', 'position/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('262', '新增', '261', '0', 'Zptalent/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('263', '编辑', '261', '0', 'Zptalent/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('264', '删除', '261', '0', 'Zptalent/del', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('266', '删除', '265', '0', 'Talent/del', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('267', '审核', '265', '0', 'Talent/changeStatus', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('268', '查看', '265', '0', 'talent/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('270', '新增', '269', '0', 'Product/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('271', '编辑', '269', '0', 'Product/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('272', '删除', '269', '0', 'Product/changeStatus', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('274', '新增', '273', '0', 'Case/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('275', '编辑', '273', '0', 'Case/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('276', '删除', '273', '0', 'Case/changeStatus', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('278', '新增', '277', '0', 'Tourist/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('279', '修改', '277', '0', 'Tourist/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('313', 'about', '2', '0', 'about/index', '1', '', '广告管理', '0');
INSERT INTO `bhy_menu` VALUES ('305', '规程列表', '2', '0', 'Regular/index', '1', '', '广告管理', '0');
INSERT INTO `bhy_menu` VALUES ('306', 'PDF列表', '2', '0', 'reg/index', '1', '', '广告管理', '0');
INSERT INTO `bhy_menu` VALUES ('330', '编辑', '319', '0', 'Enclosure/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('308', '媒体焦点', '2', '0', 'media/index', '1', '', '广告管理', '0');
INSERT INTO `bhy_menu` VALUES ('309', '问题', '2', '0', 'normalqa/index', '1', '', '广告管理', '0');
INSERT INTO `bhy_menu` VALUES ('310', 'paper', '2', '0', 'paper/index', '1', '', '广告管理', '0');
INSERT INTO `bhy_menu` VALUES ('311', 'brand', '2', '0', 'brand/index', '1', '', '广告管理', '0');
INSERT INTO `bhy_menu` VALUES ('312', 'cartype', '2', '0', 'cartype/index', '1', '', '广告管理', '0');
INSERT INTO `bhy_menu` VALUES ('314', '视频列表', '2', '0', 'Video/index', '0', '', '视频管理', '0');
INSERT INTO `bhy_menu` VALUES ('315', '新增', '314', '0', 'video/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('316', '修改', '314', '0', 'video/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('318', '文章管理', '2', '0', 'news/index', '0', '', '内容管理', '0');
INSERT INTO `bhy_menu` VALUES ('319', '附件列表', '2', '0', 'enclosure/index', '0', '', '附件管理', '0');
INSERT INTO `bhy_menu` VALUES ('320', '车型评价结果', '2', '0', 'Car/index', '0', '', '车型管理', '0');
INSERT INTO `bhy_menu` VALUES ('325', '新增', '324', '0', 'Links/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('326', '编辑', '324', '0', 'Links/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('331', '禁用启用', '319', '0', 'Enclosure/changeStatus', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('332', '新增', '320', '0', 'Car/add', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('333', '编辑', '320', '0', 'Car/edit', '0', '', '', '0');
INSERT INTO `bhy_menu` VALUES ('334', '禁用启用', '320', '0', 'Car/changeStatus', '0', '', '', '0');

-- ----------------------------
-- Table structure for bhy_message
-- ----------------------------
DROP TABLE IF EXISTS `bhy_message`;
CREATE TABLE `bhy_message` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tel` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `name` varchar(255) NOT NULL COMMENT '姓名',
  `content` mediumtext NOT NULL COMMENT '简介',
  `status` int(11) NOT NULL DEFAULT '1',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='旅行社表';

-- ----------------------------
-- Records of bhy_message
-- ----------------------------
INSERT INTO `bhy_message` VALUES ('1', '13101150371', '12312321@qq.com', '张三', '你们的工资是多少呢', '1', '1538221889', '0');

-- ----------------------------
-- Table structure for bhy_model
-- ----------------------------
DROP TABLE IF EXISTS `bhy_model`;
CREATE TABLE `bhy_model` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '模型ID',
  `name` char(30) NOT NULL DEFAULT '' COMMENT '模型标识',
  `title` char(30) NOT NULL DEFAULT '' COMMENT '模型名称',
  `extend` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '继承的模型',
  `relation` varchar(30) NOT NULL DEFAULT '' COMMENT '继承与被继承模型的关联字段',
  `need_pk` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '新建表时是否需要主键字段',
  `field_sort` text NOT NULL COMMENT '表单字段排序',
  `field_group` varchar(255) NOT NULL DEFAULT '1:基础' COMMENT '字段分组',
  `attribute_list` text NOT NULL COMMENT '属性列表（表的字段）',
  `template_list` varchar(100) NOT NULL DEFAULT '' COMMENT '列表模板',
  `template_add` varchar(100) NOT NULL DEFAULT '' COMMENT '新增模板',
  `template_edit` varchar(100) NOT NULL DEFAULT '' COMMENT '编辑模板',
  `list_grid` text NOT NULL COMMENT '列表定义',
  `list_row` smallint(2) unsigned NOT NULL DEFAULT '10' COMMENT '列表数据长度',
  `search_key` varchar(50) NOT NULL DEFAULT '' COMMENT '默认搜索字段',
  `search_list` varchar(255) NOT NULL DEFAULT '' COMMENT '高级搜索的字段',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  `engine_type` varchar(25) NOT NULL DEFAULT 'MyISAM' COMMENT '数据库引擎',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='文档模型表';

-- ----------------------------
-- Records of bhy_model
-- ----------------------------
INSERT INTO `bhy_model` VALUES ('1', 'document', '基础文档', '0', '', '1', '{\"1\":[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"22\"]}', '1:基础', '', '', '', '', 'id:编号\r\ntitle:标题:article/index?cate_id=[category_id]&pid=[id]\r\ntype|get_document_type:类型\r\nlevel:优先级\r\nupdate_time|time_format:最后更新\r\nstatus_text:状态\r\nview:浏览\r\nid:操作:[EDIT]&cate_id=[category_id]|编辑,article/setstatus?status=-1&ids=[id]|删除', '0', '', '', '1383891233', '1384507827', '1', 'MyISAM');
INSERT INTO `bhy_model` VALUES ('2', 'article', '文章', '1', '', '1', '{\"1\":[\"3\",\"24\",\"2\",\"5\"],\"2\":[\"9\",\"13\",\"19\",\"10\",\"12\",\"16\",\"17\",\"26\",\"20\",\"14\",\"11\",\"25\"]}', '1:基础,2:扩展', '', '', '', '', 'id:编号\r\ntitle:标题:article/edit?cate_id=[category_id]&id=[id]\r\ncontent:内容', '0', '', '', '1383891243', '1387260622', '1', 'MyISAM');
INSERT INTO `bhy_model` VALUES ('3', 'download', '下载', '1', '', '1', '{\"1\":[\"3\",\"28\",\"30\",\"32\",\"2\",\"5\",\"31\"],\"2\":[\"13\",\"10\",\"27\",\"9\",\"12\",\"16\",\"17\",\"19\",\"11\",\"20\",\"14\",\"29\"]}', '1:基础,2:扩展', '', '', '', '', 'id:编号\r\ntitle:标题', '0', '', '', '1383891252', '1387260449', '1', 'MyISAM');

-- ----------------------------
-- Table structure for bhy_news
-- ----------------------------
DROP TABLE IF EXISTS `bhy_news`;
CREATE TABLE `bhy_news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `typeid` int(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `egname` varchar(255) NOT NULL,
  `sort` int(11) DEFAULT '0',
  `view` int(10) DEFAULT '0',
  `egcontent` mediumtext NOT NULL,
  `content` mediumtext NOT NULL COMMENT '简介',
  `descriptions` varchar(255) NOT NULL,
  `egdescriptions` varchar(255) NOT NULL,
  `icon` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='旅行社表';

-- ----------------------------
-- Records of bhy_news
-- ----------------------------
INSERT INTO `bhy_news` VALUES ('1', '17', '', '', '0', '0', '', '', '', '', '137', '0', '1538202261', '1538202261');

-- ----------------------------
-- Table structure for bhy_picture
-- ----------------------------
DROP TABLE IF EXISTS `bhy_picture`;
CREATE TABLE `bhy_picture` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id自增',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '路径',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片链接',
  `md5` char(32) NOT NULL DEFAULT '' COMMENT '文件md5',
  `sha1` char(40) NOT NULL DEFAULT '' COMMENT '文件 sha1编码',
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=163 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bhy_picture
-- ----------------------------
INSERT INTO `bhy_picture` VALUES ('1', '/Uploads/Picture/2018-07-02/5b39b3904bdf5.png', '', 'd659227e458517fd9f5c7f724677bced', '23bcdbf811e727500df66c6f1db21ce85a460ea5', '1', '1530508176');
INSERT INTO `bhy_picture` VALUES ('2', '/Uploads/Picture/2018-07-02/5b39b3cf5b66c.png', '', 'f1992444308d532d22dd2447c32aadc8', '267b3aced1a66b6c8cbb9d1f94bff5a15b8affd7', '1', '1530508239');
INSERT INTO `bhy_picture` VALUES ('15', '/Uploads/Picture/2018-07-16/5b4bf5b172e8f.png', '', 'ba33f3733b2932c3ae482b309dfa9507', 'a654e6c888e54e2fefa2a3facf6676808c84fa99', '1', '1531704753');
INSERT INTO `bhy_picture` VALUES ('21', '/Uploads/Picture/2018-07-17/5b4d7fddd75f1.jpg', '', 'c799bbbc22ba65ae75adcfd3d2c32de8', 'd2af57f36ff95cea5e64669489db725e4edb5267', '1', '1531805661');
INSERT INTO `bhy_picture` VALUES ('20', '/Uploads/Picture/2018-07-17/5b4d604f05a24.png', '', '91ccd368c255d90cdcd28f0d44e583d3', '5f2fa524dc5d2730270fe3552ab6f833e4f3f05b', '1', '1531797582');
INSERT INTO `bhy_picture` VALUES ('17', '/Uploads/Picture/2018-07-16/5b4c482ee03f7.png', '', 'a4be482c9dad467ded80cacb414e8840', 'dd19b76a001d66ab155f455b078347103a2c4eb4', '1', '1531725870');
INSERT INTO `bhy_picture` VALUES ('22', '/Uploads/Picture/2018-07-17/5b4de1a28c8e8.jpg', '', '20558b42411b040d3ecaf0fb37211d4b', '343e1e0a7eca83d7dbbe4f6a5c71faac27df74e9', '1', '1531830690');
INSERT INTO `bhy_picture` VALUES ('23', '/Uploads/Picture/2018-07-17/5b4de1aeae2c6.jpg', '', '01555e0c5d7c1053e0a6eee508c46b24', 'f7bd655cb4aedf37a955aa12b191220c413bd626', '1', '1531830702');
INSERT INTO `bhy_picture` VALUES ('24', '/Uploads/Picture/2018-07-17/5b4de1bc6e280.jpg', '', '8686686b22877b739bcf2fd63dd3aa02', '9477e46cd53ed635abecde6255d68b3010b9b89d', '1', '1531830716');
INSERT INTO `bhy_picture` VALUES ('25', '/Uploads/Picture/2018-07-18/5b4e81636d40c.jpg', '', 'f1bb3e66308d77f44756faf77fea7102', 'ced6f6f8b336591d9624bded2421c8b424ce173b', '1', '1531871587');
INSERT INTO `bhy_picture` VALUES ('26', '/Uploads/Picture/2018-07-18/5b4e8c3f5b2ff.jpg', '', '827ab050d500f4e2bcb3a17e8838c773', 'e5333edece21502257f19e3fb9d1749df516d2b0', '1', '1531874367');
INSERT INTO `bhy_picture` VALUES ('27', '/Uploads/Picture/2018-07-18/5b4e8dcfd3482.jpg', '', 'de0f46c6c993dee48346b4453f5aaca2', '18426857220fdfbeb4e041e6854e9fe6f3651763', '1', '1531874767');
INSERT INTO `bhy_picture` VALUES ('28', '/Uploads/Picture/2018-07-18/5b4e8e9ce73c4.jpg', '', '2418d693b6dd5eb7492f67233392f24d', 'fdce9e47d3e9e537c723f6bd6f35bd65f4cec706', '1', '1531874972');
INSERT INTO `bhy_picture` VALUES ('29', '/Uploads/Picture/2018-07-18/5b4eece1898f6.jpg', '', '9ad2cb9c29d6f1a4b90534c3ca956809', '9da58fe59035d4b5eb653cfc8dedb626f9c82a8f', '1', '1531899105');
INSERT INTO `bhy_picture` VALUES ('30', '/Uploads/Picture/2018-07-18/5b4eed3e1377a.jpg', '', 'e32fc24efcb8f6ddf7e4e058404475fc', 'a9f449215390b5d9747f0589f8dafecc768701cd', '1', '1531899198');
INSERT INTO `bhy_picture` VALUES ('31', '/Uploads/Picture/2018-07-18/5b4ef60a9222f.jpg', '', '3ffa035426db40ca0ad8fc687709e870', 'f08da7ddc5a5c1df0aaf8019ee6a010e5da98c03', '1', '1531901450');
INSERT INTO `bhy_picture` VALUES ('32', '/Uploads/Picture/2018-07-18/5b4efdb521e4a.jpg', '', 'a93404d57015ad3cb27b21f6d528c9a6', '9373dae7e3b910dd8211d954bd5f0f84a3a403da', '1', '1531903413');
INSERT INTO `bhy_picture` VALUES ('33', '/Uploads/Picture/2018-07-18/5b4f23558ffca.jpg', '', '515706fed1d182dc6af4703a427196be', 'a29670ebe60d0e4031f5cdda340d1f845a530bc8', '1', '1531913045');
INSERT INTO `bhy_picture` VALUES ('34', '/Uploads/Picture/2018-07-18/5b4f37555f9b6.jpg', '', 'cfcdf5ff518e88fe3eb34c9dce711dcd', 'a9055a61fd32149fe35ca88250d0cad60836ed04', '1', '1531918165');
INSERT INTO `bhy_picture` VALUES ('35', '/Uploads/Picture/2018-07-18/5b4f37592c257.jpg', '', '5dc1c98de6d8a25bbc648dfe8865237c', '54bcf157fd5af4e28451ac01946652bba11cbff4', '1', '1531918169');
INSERT INTO `bhy_picture` VALUES ('36', '/Uploads/Picture/2018-07-18/5b4f375b84506.jpg', '', '0550111b4661ec0814f6dcf08e2b3f32', 'c9944f66b936ac0b3026101777f5514c7d886d9d', '1', '1531918171');
INSERT INTO `bhy_picture` VALUES ('37', '/Uploads/Picture/2018-07-19/5b5044300551c.jpg', '', 'c0a4da6fc63d5178d9b5b59862c847bd', '03a2f6eb8d702f9e1f17b19197113c37898cbef6', '1', '1531986991');
INSERT INTO `bhy_picture` VALUES ('38', '/Uploads/Picture/2018-07-21/153216435999171384.jpg', '', '3fff91b971d0b4752d431a920209166a', 'c0f5e7a5b0def121b76067443563fe86091e88ab', '1', '1532164359');
INSERT INTO `bhy_picture` VALUES ('39', '/Uploads/Picture/2018-07-21/153216440612149830.jpg', '', '2f27ff043f7f3f0caee1db9e556e0f22', '608fe5fc6b59550a9c656577f47aab67996ba0ca', '1', '1532164406');
INSERT INTO `bhy_picture` VALUES ('40', '/Uploads/Picture/2018-07-22/153225222198492205.jpg', '', '42172d25b6c998ec3d63420826f78cad', '8b3451bf40135dd1ded8b55250330081638ac126', '1', '1532252221');
INSERT INTO `bhy_picture` VALUES ('41', '/Uploads/Picture/2018-07-22/153225689817445377.jpg', '', 'b7c3a2e89bbe2a0005ee57a92aa2e541', '4ecce51d459a46c815d94dd6dee7e822d3dfc502', '1', '1532256898');
INSERT INTO `bhy_picture` VALUES ('43', '/Uploads/Picture/2018-07-23/153233464303335923.jpg', '', 'a3569ed6754691900fea1d7507387ebe', 'dd737844496f882fa7a54854453e20830fbe4013', '1', '1532334643');
INSERT INTO `bhy_picture` VALUES ('44', '/Uploads/Picture/2018-07-23/153233476912552863.jpg', '', '6546bee1115d37204458f0f789b4de83', '474777566cbe5ff88addc2d6f60a96d4d5e51d63', '1', '1532334769');
INSERT INTO `bhy_picture` VALUES ('45', '/Uploads/Picture/2018-07-24/153241996754898862.jpg', '', '8c0b99c9b1ed3f10bd2ebd11dac19fef', '867da61d012981b50861558e08778e1c2045c297', '1', '1532419967');
INSERT INTO `bhy_picture` VALUES ('46', '/Uploads/Picture/2018-07-26/5b599aa3b05ab.jpg', '', 'eb2da118d3ccbea538877cc07ecf8527', 'e6bfbccd0fa7510103c8753cf3beb7d079808ea7', '1', '1532598947');
INSERT INTO `bhy_picture` VALUES ('47', '/Uploads/Picture/2018-07-27/153267678709299831.jpg', '', '5d924e3b50cb5d4f7e81712efb9c6d5b', '9f5eea21feaa749fffc9ac403e5b21515cb8a85c', '1', '1532676787');
INSERT INTO `bhy_picture` VALUES ('48', '/Uploads/Picture/2018-08-14/153423826516158473.png', '', 'cb377252c93720698855c24ae330507e', '3f460ef4b92d36ff0b03c19604674e518a5045a0', '1', '1534238265');
INSERT INTO `bhy_picture` VALUES ('49', '/Uploads/Picture/2018-08-14/153423827261194189.jpg', '', '27513398ecd5e6bc8891d3bd30ddb982', '053ce6fd53fd3c3774354806ec6831a595cdd054', '1', '1534238272');
INSERT INTO `bhy_picture` VALUES ('50', '/Uploads/Picture/2018-08-14/153423858410287037.jpg', '', 'aa89c80b3c97c953b68203705e1a01b9', '5c443470e16a32832a8a3230b4a3de884b256eec', '1', '1534238584');
INSERT INTO `bhy_picture` VALUES ('51', '/Uploads/Picture/2018-08-16/153439648892679739.jpg', '', '6d00cdbf5e3fa68922f81fb578bc37ac', 'f6f051fa9a6387ab58d12b0bc20ea7dd21256698', '1', '1534396488');
INSERT INTO `bhy_picture` VALUES ('52', '/Uploads/Picture/2018-08-16/153439682991223104.jpg', '', '9f90fe233aa98dd12c6ddc8829d691a0', '66a12b6e9abdd0eaa9db484ce417a6f1a47bc917', '1', '1534396829');
INSERT INTO `bhy_picture` VALUES ('53', '/Uploads/Picture/2018-08-16/153439906621415204.png', '', 'b511b270af16ef0fe2e5d7fcd478f698', '62ff26b0bf53504c1c4ec6ce6f57575baea437fa', '1', '1534399066');
INSERT INTO `bhy_picture` VALUES ('54', '/Uploads/Picture/2018-08-16/153439909023459374.jpg', '', '1f6107ea69b1cc85aed15a430821a088', '50b7617df766abcfd1f94a9f6a064ba5683a917c', '1', '1534399090');
INSERT INTO `bhy_picture` VALUES ('55', '/Uploads/Picture/2018-08-16/153439939905612220.jpg', '', '0b968c7413e7f0ae951879a1f03ced87', '600d5b58c8fb568cced921b30cbac9c0089b9695', '1', '1534399399');
INSERT INTO `bhy_picture` VALUES ('56', '/Uploads/Picture/2018-08-16/153439994838757795.png', '', 'e1a68e7dc5b277467b60ae895005333d', 'a5b27a54325d30107436180c05195e56718824ed', '1', '1534399948');
INSERT INTO `bhy_picture` VALUES ('57', '/Uploads/Picture/2018-08-16/153440030948727706.png', '', 'f901d0328321f368dfb42bec442c8bc6', 'c79d90c4e8622cf36635438a5bca8c00ea4011eb', '1', '1534400309');
INSERT INTO `bhy_picture` VALUES ('58', '/Uploads/Picture/2018-08-16/153440033843099461.png', '', '0114ca4d580e16cd30a79d18e8c8d854', 'd0594ebf30726393083cf36d34e33e7fa300275d', '1', '1534400338');
INSERT INTO `bhy_picture` VALUES ('59', '/Uploads/Picture/2018-08-16/153440035264976426.png', '', 'b818e925ff5a8c7963d6ad31c16c09cb', '88cd2da6300831aae0495028ada6cf005c651bd5', '1', '1534400352');
INSERT INTO `bhy_picture` VALUES ('60', '/Uploads/Picture/2018-08-16/153440242407616434.jpg', '', '1d626a5a3425280c86988061018137fa', 'd9c3d9af3527ade6fcf64c818ada53ce04453f75', '1', '1534402424');
INSERT INTO `bhy_picture` VALUES ('61', '/Uploads/Picture/2018-08-17/153449187633378523.jpg', '', '41cf64a92f81d92b7a01f9e8a44f9ce4', '15876b4cc0b791042b449fa32e3bdae68e2e26c4', '1', '1534491876');
INSERT INTO `bhy_picture` VALUES ('62', '/Uploads/Picture/2018-08-18/153458246468848554.jpg', '', 'ac2540ae80c92513b4878c98b619b979', 'e90fa036fb7a6216b9da7da36ed93b7e6cb79a8d', '1', '1534582464');
INSERT INTO `bhy_picture` VALUES ('63', '/Uploads/Picture/2018-08-18/153458252790713974.png', '', 'a2c553030a1d5f6bab0f15532b6272fc', 'b52f96782ce47cc5575cd2e281b2fa5564861446', '1', '1534582527');
INSERT INTO `bhy_picture` VALUES ('64', '/Uploads/Picture/2018-08-18/153458302574856333.jpg', '', '455473a300f8aeb3ad51b4d946552762', '8f41df86d1d07e958db4144384be72f1a1528bbe', '1', '1534583025');
INSERT INTO `bhy_picture` VALUES ('65', '/Uploads/Picture/2018-08-19/153467892240027351.jpg', '', '1ad68a45c9685eb3bcf81f32804cef2a', 'b5b19753366498060869b93943b4dd2b01606db3', '1', '1534678922');
INSERT INTO `bhy_picture` VALUES ('66', '/Uploads/Picture/2018-08-20/153476069540867124.jpg', '', 'eccbf9bf98844209dd9b3de1d2bc4a6b', 'e3d64713165d6b609c04a68a238b9e1566651801', '1', '1534760695');
INSERT INTO `bhy_picture` VALUES ('67', '/Uploads/Picture/2018-08-25/5b8107d6b87a6.jpg', '', 'b7c3a2e89bbe2a0005ee57a92aa2e541', '4ecce51d459a46c815d94dd6dee7e822d3dfc502', '0', '1535182806');
INSERT INTO `bhy_picture` VALUES ('68', '/Uploads/Picture/2018-08-25/5b8107d6b935f.jpg', '', 'de0f46c6c993dee48346b4453f5aaca2', '18426857220fdfbeb4e041e6854e9fe6f3651763', '0', '1535182806');
INSERT INTO `bhy_picture` VALUES ('69', '/Uploads/Picture/2018-08-25/5b810cc05d65b.jpg', '', 'b7c3a2e89bbe2a0005ee57a92aa2e541', '4ecce51d459a46c815d94dd6dee7e822d3dfc502', '0', '1535184064');
INSERT INTO `bhy_picture` VALUES ('70', '/Uploads/Picture/2018-08-25/5b810cc05e213.jpg', '', 'de0f46c6c993dee48346b4453f5aaca2', '18426857220fdfbeb4e041e6854e9fe6f3651763', '0', '1535184064');
INSERT INTO `bhy_picture` VALUES ('71', '/Uploads/Picture/2018-08-25/5b810d29ad7b3.jpg', '', 'b7c3a2e89bbe2a0005ee57a92aa2e541', '4ecce51d459a46c815d94dd6dee7e822d3dfc502', '0', '1535184169');
INSERT INTO `bhy_picture` VALUES ('72', '/Uploads/Picture/2018-08-25/5b810d29afadb.jpg', '', 'de0f46c6c993dee48346b4453f5aaca2', '18426857220fdfbeb4e041e6854e9fe6f3651763', '0', '1535184169');
INSERT INTO `bhy_picture` VALUES ('73', '/Uploads/Picture/2018-08-25/5b810d85c307e.jpg', '', '8c0b99c9b1ed3f10bd2ebd11dac19fef', '867da61d012981b50861558e08778e1c2045c297', '0', '1535184261');
INSERT INTO `bhy_picture` VALUES ('74', '/Uploads/Picture/2018-08-25/5b810d85c3c36.jpg', '', '3fff91b971d0b4752d431a920209166a', 'c0f5e7a5b0def121b76067443563fe86091e88ab', '0', '1535184261');
INSERT INTO `bhy_picture` VALUES ('75', '/Uploads/Picture/2018-08-25/5b810d85c4bd6.jpg', '', '2f27ff043f7f3f0caee1db9e556e0f22', '608fe5fc6b59550a9c656577f47aab67996ba0ca', '0', '1535184261');
INSERT INTO `bhy_picture` VALUES ('76', '/Uploads/Picture/2018-08-25/5b810dc284288.jpg', '', '827ab050d500f4e2bcb3a17e8838c773', 'e5333edece21502257f19e3fb9d1749df516d2b0', '0', '1535184322');
INSERT INTO `bhy_picture` VALUES ('77', '/Uploads/Picture/2018-08-25/5b810dc285229.jpg', '', 'dcda41d646ade8b023e3c23635a34516', 'e5f474a82b5228b3a2dee0c9e1688f8238618e8e', '0', '1535184322');
INSERT INTO `bhy_picture` VALUES ('78', '/Uploads/Picture/2018-08-25/5b810e9073bf3.jpg', '', 'b7c3a2e89bbe2a0005ee57a92aa2e541', '4ecce51d459a46c815d94dd6dee7e822d3dfc502', '0', '1535184528');
INSERT INTO `bhy_picture` VALUES ('79', '/Uploads/Picture/2018-08-25/5b810e9074b93.jpg', '', 'de0f46c6c993dee48346b4453f5aaca2', '18426857220fdfbeb4e041e6854e9fe6f3651763', '0', '1535184528');
INSERT INTO `bhy_picture` VALUES ('80', '/Uploads/Picture/2018-08-25/5b810ee5e7714.jpg', '', '2418d693b6dd5eb7492f67233392f24d', 'fdce9e47d3e9e537c723f6bd6f35bd65f4cec706', '0', '1535184613');
INSERT INTO `bhy_picture` VALUES ('81', '/Uploads/Picture/2018-08-25/5b810ee5e86b4.jpg', '', 'b48dfb60b272f8c8f9e6145549121f90', 'edb3bbbb20a2a77098d2c8e699019e557435e907', '0', '1535184613');
INSERT INTO `bhy_picture` VALUES ('82', '/Uploads/Picture/2018-08-25/5b810efa02b7f.jpg', '', 'de0f46c6c993dee48346b4453f5aaca2', '18426857220fdfbeb4e041e6854e9fe6f3651763', '0', '1535184634');
INSERT INTO `bhy_picture` VALUES ('83', '/Uploads/Picture/2018-09-06/5b9089709987e.png', '', 'fad48ef29a16b9963561d0d3690e0eb8', '69260fc48c388fce4319f310490e1c4b17d91296', '1', '1536199024');
INSERT INTO `bhy_picture` VALUES ('84', '/Uploads/Picture/2018-09-12/5b98fe1145dbc.jpg', '', 'd819cd39c129bfa05840948b872852ed', '1f98f01cc5237f3b1f2e03d44f5d3fe807bd64e3', '1', '1536753169');
INSERT INTO `bhy_picture` VALUES ('85', '/Uploads/Picture/2018-09-14/5b9b5830bfe10.jpg', '', 'f610e920901af0b33138104be02a4425', 'e6878ef0bcbc8d485ea83f10013a6d9e85c963c2', '1', '1536907312');
INSERT INTO `bhy_picture` VALUES ('86', '/Uploads/Picture/2018-09-14/5b9b583c1aff8.jpg', '', '0aaccb5468800b0696823a02c90e948a', '48296e7ad2866edce6102f6b2e07ab96a1f9368e', '1', '1536907324');
INSERT INTO `bhy_picture` VALUES ('87', '/Uploads/Picture/2018-09-14/5b9b5847279a8.jpg', '', '7a9bd08726a2e6cac2d850318834fd0d', 'ca8b286e9b903f49e17e4a3d12c3efb74e0cc37a', '1', '1536907335');
INSERT INTO `bhy_picture` VALUES ('88', '/Uploads/Picture/2018-09-14/5b9b585835067.jpg', '', '9e0dc747362839538f609d7563c0db32', 'a7864cced8063994ae895e6c592bb4bab4222904', '1', '1536907352');
INSERT INTO `bhy_picture` VALUES ('89', '/Uploads/Picture/2018-09-14/5b9b5aec49792.jpg', '', '42b7b477bd715f72bd52001739cdfc66', '7ebebd06b4e036aa5497fe333eae7cf9d922880d', '1', '1536908012');
INSERT INTO `bhy_picture` VALUES ('90', '/Uploads/Picture/2018-09-14/5b9b5afb19959.png', '', 'ba65ebe52a60cc64e28170fd876e7260', '1ff93240313bb48feb2d66f39ab8d26ff42de97f', '1', '1536908027');
INSERT INTO `bhy_picture` VALUES ('91', '/Uploads/Picture/2018-09-14/5b9b5bac9d753.jpg', '', '61a7e710e3ed929955bb77f58f57438e', '1860b6c9e406d0546729820e35b76e1ad72efa02', '1', '1536908204');
INSERT INTO `bhy_picture` VALUES ('92', '/Uploads/Picture/2018-09-14/5b9b5bc71bf1d.jpg', '', 'b0150e8448a517eb10b79a11f1f594fa', 'e027674ee5efa8c3ca1a91a01722fe9ddd35266f', '1', '1536908231');
INSERT INTO `bhy_picture` VALUES ('93', '/Uploads/Picture/2018-09-14/5b9b5bdd29ecb.jpg', '', '15c88cd26423276d5a41190c2ac23047', '41aaa8fe3b213d21ea5bf07a850d92532ee6ac6a', '1', '1536908252');
INSERT INTO `bhy_picture` VALUES ('94', '/Uploads/Picture/2018-09-14/5b9b6025e6947.jpg', '', '08c069743a041d3bbfacfa1425590ba1', '1b6aa30c8b3fd4dcc0765cdc5ce86a6370f8db5c', '1', '1536909349');
INSERT INTO `bhy_picture` VALUES ('95', '/Uploads/Picture/2018-09-14/5b9b602d0c6ad.jpg', '', '92be95cf087632dbebd2f79c860579f7', '8739e863a0319f4035c328c255f6302f47c13d56', '1', '1536909356');
INSERT INTO `bhy_picture` VALUES ('96', '/Uploads/Picture/2018-09-14/5b9b609d89c49.jpg', '', '4cf43f00e1cbb4b81898ecc8d094ccea', '0824ae2a5353893126be3a4265f50def4fb2cb6e', '1', '1536909469');
INSERT INTO `bhy_picture` VALUES ('97', '/Uploads/Picture/2018-09-14/5b9b6f5181c7f.jpg', '', '04c55442ab08d2f1e519689957f555f9', '9593a946c0251c3d3aaadadec83153f1c8bc52b0', '1', '1536913233');
INSERT INTO `bhy_picture` VALUES ('98', '/Uploads/Picture/2018-09-14/5b9b6f5dd7a5a.jpg', '', '0d14e0ae9958143b1213d78ffb158a60', '7ca9a6c13fb57636da1fb171f764204bca3993d4', '1', '1536913245');
INSERT INTO `bhy_picture` VALUES ('99', '/Uploads/Picture/2018-09-14/5b9b6f76e04c2.png', '', 'dd1222197002ddffd90fd3bec10429c9', '941d7075c87676e16e90537eb1359fb315a0b14d', '1', '1536913270');
INSERT INTO `bhy_picture` VALUES ('100', '/Uploads/Picture/2018-09-14/5b9b714b0c929.jpg', '', '36c4690d4e5f505cb6c459286170c105', '815ff132a0eacd80bf437392da41e28d99303739', '1', '1536913738');
INSERT INTO `bhy_picture` VALUES ('101', '/Uploads/Picture/2018-09-14/5b9b715122dfe.png', '', '4d334de6fd24d6b50cd1126fab3b490f', 'e7a641eb6b0ef3d1a9889735f3ceadf68de623fc', '1', '1536913745');
INSERT INTO `bhy_picture` VALUES ('102', '/Uploads/Picture/2018-09-14/5b9b715d6c885.png', '', '3b98ff4c6744fb9d66a2d090a4563e83', 'c0f9d84167cd76730ac38278c1897ecf4634a0bf', '1', '1536913757');
INSERT INTO `bhy_picture` VALUES ('103', '/Uploads/Picture/2018-09-15/5b9c9d4de1acb.png', '', '1296659bd0203f0e6771ee6cf503b5b3', 'e40a3d9df51813b4ddd8e44234c73b59e5d58c5c', '1', '1536990541');
INSERT INTO `bhy_picture` VALUES ('104', '/Uploads/Picture/2018-09-15/5b9ca4ae57017.jpg', '', 'fb700358fe6e60f6933671bfa2fd6144', '52cabd70f7918749923f32e7fc0d2d2b43776da2', '1', '1536992430');
INSERT INTO `bhy_picture` VALUES ('105', '/Uploads/Picture/2018-09-15/5b9cb760a4959.jpg', '', '773a334cbc4a95daca9ea1ddbbb95613', '3658537d2182c992c49c3c44fc3b35fc2e44c173', '1', '1536997216');
INSERT INTO `bhy_picture` VALUES ('106', '/Uploads/Picture/2018-09-15/5b9cb80721da2.jpg', '', '9596bba7aee9f44e9c99bc1c1587a857', '5b37c73fc31f919686ead7830a885ab633640024', '1', '1536997383');
INSERT INTO `bhy_picture` VALUES ('107', '/Uploads/Picture/2018-09-15/5b9cb819d87cb.jpg', '', '5358bad11541661cdd502047c84b2658', 'c0e5cd6a0843ac0a40103e3a8adb44301d6e2105', '1', '1536997401');
INSERT INTO `bhy_picture` VALUES ('108', '/Uploads/Picture/2018-09-15/5b9cb93321e41.jpg', '', 'b4fdab6598237bf5705d7433e8ebafa8', '2169a90200d900a7811297af38f6687a5469896c', '1', '1536997683');
INSERT INTO `bhy_picture` VALUES ('109', '/Uploads/Picture/2018-09-15/5b9cbd2c5090d.png', '', '8356236fd89ea504db2c82d8f4fdc317', 'd654fac7ab797ad436de0806b9fc88a8084a12eb', '1', '1536998700');
INSERT INTO `bhy_picture` VALUES ('110', '/Uploads/Picture/2018-09-15/5b9cbdd38d7eb.png', '', '92215c20cdee5841b8e40532c9bd8431', 'b20482597f5e1d89ce3c8cf4ea10c5d6926a693d', '1', '1536998867');
INSERT INTO `bhy_picture` VALUES ('111', '/Uploads/Picture/2018-09-15/5b9cbdef65d84.png', '', '998ffee74eaa847895b3a609f9e66323', 'f3234dce7062085238dab63f918c05513d27e858', '1', '1536998895');
INSERT INTO `bhy_picture` VALUES ('112', '/Uploads/Picture/2018-09-15/5b9cbdffb6652.jpg', '', 'ec809526bdf939fd8a32def0db54d771', 'cb820f537258243964f1464be3d2ec580037c855', '1', '1536998911');
INSERT INTO `bhy_picture` VALUES ('113', '/Uploads/Picture/2018-09-15/5b9cbe2bb1a35.jpg', '', '02ee461562e102bddcca4b77873d64c4', 'ec6cb405d09ed8abf362681b6c5a8c3ff50796f1', '1', '1536998955');
INSERT INTO `bhy_picture` VALUES ('114', '/Uploads/Picture/2018-09-15/5b9cbeaa58960.jpg', '', '3a0d05a2b058bd5927073362b7b99069', '4e2e4377050c1e7c3ffe6995c69fe6b96b02b5ed', '1', '1536999082');
INSERT INTO `bhy_picture` VALUES ('115', '/Uploads/Picture/2018-09-17/5b9f147b57062.jpg', '', '3013d18c7e45624260343ff969bdc2a2', 'd71e80464acaa1019f00d0e1b8e5fbde49e379ee', '1', '1537152123');
INSERT INTO `bhy_picture` VALUES ('116', '/Uploads/Picture/2018-09-17/5b9f14bf3e566.jpg', '', '36492f264b0af9ad5fec3e1eb39f4069', '30d2a854ddccc32ca69c3ef8393818476ce5d53c', '1', '1537152191');
INSERT INTO `bhy_picture` VALUES ('117', '/Uploads/Picture/2018-09-17/5b9f16f028a10.jpg', '', 'ba0322d73749bf326dcd9b4a6d7923a2', '04eee31808d98be050ad0097c94a0f9a50f553bd', '1', '1537152751');
INSERT INTO `bhy_picture` VALUES ('118', '/Uploads/Picture/2018-09-17/5b9f17010305b.jpg', '', 'c959f771b0f2b1caffd5a8e25a03223c', '04eb4b0a1398d49c001e6e2936f0fe7ef2986a47', '1', '1537152768');
INSERT INTO `bhy_picture` VALUES ('119', '/Uploads/Picture/2018-09-17/5b9f17105b20a.jpg', '', '3954d2ca001b19fca1c3ceddcbcb5d7a', '9364724120a5d4ea5107029cc2d8d1af5eb7252a', '1', '1537152784');
INSERT INTO `bhy_picture` VALUES ('120', '/Uploads/Picture/2018-09-17/5b9f17207867c.jpg', '', 'e073b11082d85e07ef18fb60dce4aff7', '9fde9203ad751ae979cc55745c69621f5a93e4e2', '1', '1537152800');
INSERT INTO `bhy_picture` VALUES ('121', '/Uploads/Picture/2018-09-17/5b9f172bf0ed5.jpg', '', '5fa47ab70bff979ee1a780e8179e8325', '3a38fcc28509d7999e6a9bbbdc9423edbb12ec14', '1', '1537152811');
INSERT INTO `bhy_picture` VALUES ('122', '/Uploads/Picture/2018-09-17/5b9f1cee9bce7.jpg', '', '37d99a3cbd601246918c1fac1d01eadc', '1256aeda8dc1e681f7b70511885a79ce8ff110cf', '1', '1537154286');
INSERT INTO `bhy_picture` VALUES ('123', '/Uploads/Picture/2018-09-17/5b9f22512bb57.jpg', '', '291c627479d965d6de57ac6fb19e0ed5', '83e426fadd072b3cd0f98129690af2c8edfc6697', '1', '1537155665');
INSERT INTO `bhy_picture` VALUES ('124', '/Uploads/Picture/2018-09-17/5b9f225fac92e.jpg', '', 'fe9d3c3863aba79484d6847045f25d8d', '02418a2d79c08d74e18f33e5c7dad728338b7698', '1', '1537155679');
INSERT INTO `bhy_picture` VALUES ('125', '/Uploads/Picture/2018-09-17/5b9f406d5bc6a.jpg', '', 'e76b7773e766c3e845b850daee64684b', 'ebb30fb5bffe976425fecf63718acc1f922e5560', '1', '1537163373');
INSERT INTO `bhy_picture` VALUES ('126', '/Uploads/Picture/2018-09-17/5b9f40c46be26.jpg', '', 'ed110e562f748f3aea98df92389200fa', '975650c7da1cd53a679069432432f858e7cddc4d', '1', '1537163460');
INSERT INTO `bhy_picture` VALUES ('127', '/Uploads/Picture/2018-09-17/5b9f4122f2bfe.jpg', '', 'dcb358ce6bcfd7f4acb86a9c717208d1', '7fdfb7502a78352bb9a5e1af9030a70abd5c2e9b', '1', '1537163554');
INSERT INTO `bhy_picture` VALUES ('128', '/Uploads/Picture/2018-09-17/5b9f5f49a1d01.jpg', '', 'f0bb845f51b02c9e56246898cfc30bd0', 'd98cb30f8b1ec6e9734fd42687737488d5e81a02', '1', '1537171273');
INSERT INTO `bhy_picture` VALUES ('129', '/Uploads/Picture/2018-09-28/5bae0d45a599c.png', '', 'f4a5a6ae9aa965ed10971d57e3dbc9ba', 'af0eb640a8c57975c3d2daca6aa88ad9745bb9a3', '1', '1538133316');
INSERT INTO `bhy_picture` VALUES ('130', '/Uploads/Picture/2018-09-29/5baedce872358.png', '', 'f92b853784e5c025997d712839a5868f', 'cb0d8a41e82d3be185c449d770b73c304b2850bd', '1', '1538186472');
INSERT INTO `bhy_picture` VALUES ('131', '/Uploads/Picture/2018-09-29/5baedd07c3ff0.png', '', 'b8fd21fb508a40ac6bac846087a2270d', '66fc6ea1f554f98b97e74de4a7559368ccb9ccd8', '1', '1538186503');
INSERT INTO `bhy_picture` VALUES ('132', '/Uploads/Picture/2018-09-29/5baedd447cb50.png', '', '1bc13d098b954c95b60eb8301791ccd3', 'd6cd50054f95f9d3a53f12df844435f573b1671f', '1', '1538186564');
INSERT INTO `bhy_picture` VALUES ('133', '/Uploads/Picture/2018-09-29/5baedd6110cc0.png', '', 'fe24df51f1b8af19e8ac0f273a4e439e', 'd8ead875642138b11a962cc7deaabbdce0be5989', '1', '1538186592');
INSERT INTO `bhy_picture` VALUES ('134', '/Uploads/Picture/2018-09-29/5baedd7e9cef0.png', '', 'dbb21c427209c78496bf1d9c4e76cad6', '6c4b8944b1ba1648a2cd70aea2694cb8e70406c7', '1', '1538186622');
INSERT INTO `bhy_picture` VALUES ('135', '/Uploads/Picture/2018-09-29/5baef14d9f600.jpg', '', 'dab91d096ca9261e9795b00086be7b4a', 'b3741eb220214f5c2d0ddf3760fb965ef80b9f8e', '1', '1538191693');
INSERT INTO `bhy_picture` VALUES ('136', '/Uploads/Picture/2018-09-29/5baf0dac06d60.jpg', '', '5afc29be76b015eee278cb0c35769eac', '0c7a8b3ee56719e28a804bcefb9719ab3e1f31e9', '1', '1538198955');
INSERT INTO `bhy_picture` VALUES ('137', '/Uploads/Picture/2018-09-29/5baf1a94320b4.jpg', '', '037b1379a27a7ee8b09c02724ae96a31', '00434b699f46dfaf93e38bda02855bcefa0e016f', '1', '1538202260');
INSERT INTO `bhy_picture` VALUES ('138', '/Uploads/Picture/2018-09-29/5baf330fe1f21.jpg', '', 'b6ed069aaab064433ea8c7dffcd8f42d', '61e58c7df3bb48ea73a16b35db4083234993b6a5', '1', '1538208527');
INSERT INTO `bhy_picture` VALUES ('139', '/Uploads/Picture/2018-09-29/5baf509ec499a.jpg', '', '006f3cde47d27bb6e0c5e46873d8cc6c', '02d9111c708c915098e6e18409ece536aa418518', '1', '1538216094');
INSERT INTO `bhy_picture` VALUES ('140', '/Uploads/Picture/2018-09-29/5baf52411837f.jpg', '', '6afec8f926a7212d99d64c5941bf29f6', 'a3db4ab3bd6f396d4fa4f977d7d1c1ac49cb2842', '1', '1538216513');
INSERT INTO `bhy_picture` VALUES ('141', '/Uploads/Picture/2018-09-29/5baf5cd8c6124.jpg', '', '69598730749bfb2df80bb33e4a7ec063', '057bc284ede6c3a68a3e3a58fc009727de086efd', '1', '1538219224');
INSERT INTO `bhy_picture` VALUES ('142', '/Uploads/Picture/2018-09-29/5baf5cfd7c5d7.jpg', '', '0bf70a39ff5d5305fc403f2fb484fb58', '809c7446d84ad27d64f91ba00f1e5ac5578b23db', '1', '1538219261');
INSERT INTO `bhy_picture` VALUES ('143', '/Uploads/Picture/2018-09-29/5baf5d2f09940.jpg', '', '0b63afa096a61ce6bce453e245c589a8', '8d66231410ce672d0e3d2f009535cee5014df09d', '1', '1538219310');
INSERT INTO `bhy_picture` VALUES ('144', '/Uploads/Picture/2018-09-29/5baf6c992ab5a.png', '', 'e4702e41395f660778036d1f18a6df7e', 'c4a61341bb7e0204ddb35573c00c023da74772a2', '1', '1538223257');
INSERT INTO `bhy_picture` VALUES ('145', '/Uploads/Picture/2018-09-29/5baf6d5e28d25.jpg', '', '62da14406e624cada3bc2270c55bb7cd', 'c61de7452c45750057ea506c7005acabee70a936', '1', '1538223454');
INSERT INTO `bhy_picture` VALUES ('146', '/Uploads/Picture/2018-09-29/5baf6da9dc971.png', '', '9b2fb5f3eb2725428344b347ed850a76', '72d73f725762e682fa91966867a15000623895bb', '1', '1538223529');
INSERT INTO `bhy_picture` VALUES ('147', '/Uploads/Picture/2018-09-29/5baf6e690f01f.png', '', 'c0bf921fd0e8445829c036453c704359', 'bd86fea4f42dbfe8d544bdfef8b43ef0825bdb8a', '1', '1538223720');
INSERT INTO `bhy_picture` VALUES ('148', '/Uploads/Picture/2018-09-30/5bb024c2e8f3f.jpg', '', 'ab657fa982e14347123b50f48a0d1946', '63db3c3e1287f8b940112bae44be26f409467099', '1', '1538270402');
INSERT INTO `bhy_picture` VALUES ('149', '/Uploads/Picture/2018-09-30/5bb024ce6a677.jpg', '', 'ed0835c95e37a15cb590e055419c0ba1', 'c86dc45e6d90880fa181fd10a45e044d36a0aa8c', '1', '1538270414');
INSERT INTO `bhy_picture` VALUES ('150', '/Uploads/Picture/2018-09-30/5bb024d888d1b.jpg', '', '032820b64677e7bf2a7e42551efb0649', '0e0812650719de90d35ac645574c4b13a4e4416f', '1', '1538270424');
INSERT INTO `bhy_picture` VALUES ('151', '/Uploads/Picture/2018-09-30/5bb0259c8dc0e.jpg', '', 'e73894e3c8ba3b613d9ecc59b2a27a79', '27fd402c21e6e3dd3577f23c313cced4fabfca91', '1', '1538270620');
INSERT INTO `bhy_picture` VALUES ('152', '/Uploads/Picture/2019-02-18/5c6a46e8cdc15.jpg', '', '343677d2ddd4d78f54e1ae69445de4c7', '7148708e08c1111ef3b218b8b2febec5d4de264c', '1', '1550468839');
INSERT INTO `bhy_picture` VALUES ('153', '/Uploads/Picture/2019-02-18/5c6a550899109.jpg', '', '4c928f8a736fb3dd9f3d54009258e4cd', '301bd3cd4a62d4f8bdb421de8fbed9bf479f7d66', '1', '1550472455');
INSERT INTO `bhy_picture` VALUES ('154', '/Uploads/Picture/2019-02-18/5c6a56fca4453.jpg', '', '6c8328e004efd6aec59aa1599decb9f7', 'cf64f3b6453099746afa9f38481c8c9d56c094c5', '1', '1550472955');
INSERT INTO `bhy_picture` VALUES ('155', '/Uploads/Picture/2019-02-18/5c6a574ee18b4.jpg', '', '171c51ac4c0f50d6da1a7c61e2cc76bc', 'ea04cab1c8b7ef6311480d3af253b908a8b2b443', '1', '1550473037');
INSERT INTO `bhy_picture` VALUES ('156', '/Uploads/Picture/2019-02-18/5c6a5842db585.jpg', '', '2529e0c99ece588908745c4ecec0fe05', '4610b7a0b2fc1771eefcc120f71a9ffec613b80e', '1', '1550473281');
INSERT INTO `bhy_picture` VALUES ('157', '/Uploads/Picture/2019-02-18/5c6a58cccb9c0.jpg', '', '5d778dba06f41b163701c6cc31181797', '4a8fb595635abfdb5fa684382444dd8a89888ecc', '1', '1550473419');
INSERT INTO `bhy_picture` VALUES ('158', '/Uploads/Picture/2019-02-18/5c6a5c4b39387.jpg', '', '1f787d8df0f1d524e557e9a6cf4ec52b', '5a476690525f4102c1844a78e61a68d4aacd5179', '1', '1550474314');
INSERT INTO `bhy_picture` VALUES ('159', '/Uploads/Picture/2019-02-18/5c6a5cc5f278c.png', '', '7c272b8cf776090f3f55c08b94b6d553', '54353dd603fa6ab4fe1dff126f2cb87d4feab1d2', '1', '1550474436');
INSERT INTO `bhy_picture` VALUES ('160', '/Uploads/Picture/2019-02-18/5c6a5ce8a4824.png', '', '6142eefd3e214d22dee153b63ecde324', '383f5c4091ce1bb29307fd7e8c091a7159bfd9f7', '1', '1550474471');
INSERT INTO `bhy_picture` VALUES ('161', '/Uploads/Picture/2019-02-18/5c6a5d0a6dac2.png', '', '319f70c4ab898e55abd53111376046aa', '181d38c5d8b3a5c9229abf0bffb303cc9f3eda4c', '1', '1550474505');
INSERT INTO `bhy_picture` VALUES ('162', '/Uploads/Picture/2019-02-18/5c6a5d2d0f424.png', '', '8418f42f3181560059d48e4d31afff1c', '75bbc295e3dcf4f199432ef158cb37e0f59ab39f', '1', '1550474539');

-- ----------------------------
-- Table structure for bhy_ucenter_admin
-- ----------------------------
DROP TABLE IF EXISTS `bhy_ucenter_admin`;
CREATE TABLE `bhy_ucenter_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '管理员用户ID',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '管理员状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of bhy_ucenter_admin
-- ----------------------------

-- ----------------------------
-- Table structure for bhy_ucenter_app
-- ----------------------------
DROP TABLE IF EXISTS `bhy_ucenter_app`;
CREATE TABLE `bhy_ucenter_app` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '应用ID',
  `title` varchar(30) NOT NULL COMMENT '应用名称',
  `url` varchar(100) NOT NULL COMMENT '应用URL',
  `ip` char(15) NOT NULL COMMENT '应用IP',
  `auth_key` varchar(100) NOT NULL COMMENT '加密KEY',
  `sys_login` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '同步登陆',
  `allow_ip` varchar(255) NOT NULL COMMENT '允许访问的IP',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '应用状态',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='应用表';

-- ----------------------------
-- Records of bhy_ucenter_app
-- ----------------------------

-- ----------------------------
-- Table structure for bhy_ucenter_member
-- ----------------------------
DROP TABLE IF EXISTS `bhy_ucenter_member`;
CREATE TABLE `bhy_ucenter_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` char(16) DEFAULT NULL COMMENT '用户名',
  `password` char(32) DEFAULT NULL COMMENT '密码',
  `email` char(32) DEFAULT NULL COMMENT '用户邮箱',
  `mobile` char(15) DEFAULT NULL COMMENT '用户手机',
  `reg_time` int(10) unsigned DEFAULT '0' COMMENT '注册时间',
  `reg_ip` bigint(20) DEFAULT '0' COMMENT '注册IP',
  `last_login_time` int(10) unsigned DEFAULT '0' COMMENT '最后登录时间',
  `last_login_ip` bigint(20) DEFAULT '0' COMMENT '最后登录IP',
  `update_time` int(10) unsigned DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) DEFAULT '0' COMMENT '用户状态',
  `asknum` int(5) DEFAULT NULL,
  `replynum` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of bhy_ucenter_member
-- ----------------------------
INSERT INTO `bhy_ucenter_member` VALUES ('1', 'admin', '66a2fa69ef012d5f5779ee4ec079a35a', '727537929@qq.com', '', '1425520985', '3232235896', '1538269256', '0', '1425520985', '1', '0', '0');
INSERT INTO `bhy_ucenter_member` VALUES ('12', 'wang12', '1683568552c6f8893d36218c83c31f26', 'x@qq.com', '', '1536199034', '0', '0', '0', '1536199034', '1', '0', '0');
INSERT INTO `bhy_ucenter_member` VALUES ('13', '222', '55edc6d7853eec63a6f03638b65f1e69', '32323@qq.com', null, '1536234028', '0', '0', '0', '1536234028', '1', null, null);
INSERT INTO `bhy_ucenter_member` VALUES ('14', '2223', '55edc6d7853eec63a6f03638b65f1e69', '2223434@qq.com', null, '1536234107', '0', '0', '0', '1536234107', '1', null, null);
INSERT INTO `bhy_ucenter_member` VALUES ('15', '44411', 'cb7d909c95c2868b2c5b9230857a7f4c', '4441@qq.com', null, '1536234242', '0', '0', '0', '1536234242', '1', null, null);
INSERT INTO `bhy_ucenter_member` VALUES ('16', '5551', '780682af780aceceb7cf068e7d11b10d', '555@qq.com', null, '1536234918', '0', '0', '0', '1536234918', '1', null, null);

-- ----------------------------
-- Table structure for bhy_ucenter_setting
-- ----------------------------
DROP TABLE IF EXISTS `bhy_ucenter_setting`;
CREATE TABLE `bhy_ucenter_setting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '设置ID',
  `type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '配置类型（1-用户配置）',
  `value` text NOT NULL COMMENT '配置数据',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='设置表';

-- ----------------------------
-- Records of bhy_ucenter_setting
-- ----------------------------

-- ----------------------------
-- Table structure for bhy_url
-- ----------------------------
DROP TABLE IF EXISTS `bhy_url`;
CREATE TABLE `bhy_url` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '链接唯一标识',
  `url` char(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `short` char(100) NOT NULL DEFAULT '' COMMENT '短网址',
  `status` tinyint(2) NOT NULL DEFAULT '2' COMMENT '状态',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_url` (`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='链接表';

-- ----------------------------
-- Records of bhy_url
-- ----------------------------

-- ----------------------------
-- Table structure for bhy_userdata
-- ----------------------------
DROP TABLE IF EXISTS `bhy_userdata`;
CREATE TABLE `bhy_userdata` (
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `type` tinyint(3) unsigned NOT NULL COMMENT '类型标识',
  `target_id` int(10) unsigned NOT NULL COMMENT '目标id',
  UNIQUE KEY `uid` (`uid`,`type`,`target_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bhy_userdata
-- ----------------------------

-- ----------------------------
-- Table structure for bhy_usermember
-- ----------------------------
DROP TABLE IF EXISTS `bhy_usermember`;
CREATE TABLE `bhy_usermember` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` varchar(30) NOT NULL DEFAULT '',
  `password` varchar(30) NOT NULL DEFAULT '0000-00-00' COMMENT '生日',
  `phone` varchar(20) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT '商家名称',
  `zzname` varchar(255) DEFAULT NULL,
  `zzaddr` varchar(255) DEFAULT NULL,
  `zzno` varchar(100) DEFAULT NULL,
  `overdue` varchar(100) DEFAULT NULL,
  `faren` varchar(100) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL COMMENT '商家电话',
  `addr` varchar(255) DEFAULT NULL,
  `balance` int(11) DEFAULT '0' COMMENT '余额',
  `view` int(11) DEFAULT '0',
  `star` int(10) DEFAULT NULL,
  `price` int(10) DEFAULT NULL,
  `activity` varchar(255) DEFAULT NULL,
  `shoptype` tinyint(1) DEFAULT '0' COMMENT '1 酒店  2 饭店 3 景区',
  `hoteltype` tinyint(1) DEFAULT '0' COMMENT '1 星级 2 经济 3 民宿',
  `is_shop` tinyint(1) DEFAULT '0' COMMENT '是否是商家  0 不是 1 是',
  `qq` char(10) DEFAULT '' COMMENT 'qq号',
  `score` mediumint(8) DEFAULT '0' COMMENT '用户积分',
  `login` int(10) unsigned DEFAULT '0' COMMENT '登录次数',
  `icon` varchar(255) DEFAULT NULL COMMENT '用户头像',
  `zzicon` int(10) DEFAULT NULL,
  `icon1` int(10) DEFAULT '0',
  `sort` int(10) DEFAULT NULL COMMENT '排序',
  `pid` int(10) DEFAULT NULL COMMENT '所属职务',
  `flag` varchar(10) DEFAULT NULL COMMENT '属性',
  `reg_ip` bigint(20) DEFAULT '0' COMMENT '注册IP',
  `reg_time` int(10) unsigned DEFAULT '0' COMMENT '注册时间',
  `last_login_ip` bigint(20) DEFAULT '0' COMMENT '最后登录IP',
  `last_login_time` int(10) unsigned DEFAULT '0' COMMENT '最后登录时间',
  `state` int(1) DEFAULT '1' COMMENT '商家  0 禁用 1 启用',
  `status` tinyint(4) DEFAULT '0' COMMENT '会员状态',
  `recommend` tinyint(1) DEFAULT '1' COMMENT '1  不推荐  2 推荐',
  `content` mediumtext COMMENT '用户简介',
  `detail` mediumtext,
  `asknum` int(5) DEFAULT NULL COMMENT '问题数',
  `replynum` int(11) DEFAULT NULL COMMENT '回复数',
  `noreply` int(1) DEFAULT NULL COMMENT '是否禁言',
  `log` varchar(20) DEFAULT '109.200534',
  `lat` varchar(20) DEFAULT '26.676233',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of bhy_usermember
-- ----------------------------
INSERT INTO `bhy_usermember` VALUES ('1', '超级管理员', '0000-00-00', null, null, null, null, null, null, null, null, null, '0', '0', null, '299', '', '0', null, '0', '', '1010', '197', '1', null, '0', '0', '0', null, '0', '1425520985', '0', '1531377236', '1', '1', '1', null, null, '0', '2', '0', '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('2', 'administrator', '0000-00-00', null, null, null, null, null, null, null, null, null, '0', '34', null, null, null, '0', null, '0', '', '10', '2', '0', null, '0', '0', '0', null, '0', '0', '3232235896', '1425604612', '1', '1', '1', null, null, '0', '0', '0', '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('3', '王女士', '0000-00-00', null, null, null, null, null, null, null, null, null, '0', '0', null, null, null, '0', null, '0', '', '0', '0', '0', null, '0', '0', '0', null, '0', '0', '0', '0', '1', '-1', '1', null, null, '0', '0', '0', '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('4', '周先生', '0000-00-00', null, null, null, null, null, null, null, null, null, '0', '0', null, null, null, '0', null, '0', '', '70', '8', '0', null, '0', '0', '0', null, '0', '0', '3232235896', '1428485647', '1', '-1', '1', null, null, '0', '0', '1', '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('5', '张先生', '0000-00-00', null, null, null, null, null, null, null, null, null, '0', '0', null, null, null, '0', null, '0', '', '110', '11', '0', null, '0', '0', '0', null, '0', '0', '3232235942', '1427968269', '1', '-1', '1', null, null, '0', '0', '0', '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('6', '李先生', '0000-00-00', null, null, null, null, null, null, null, null, null, '0', '0', null, null, null, '0', null, '0', '', '10', '1', '0', null, '0', '0', '6', '', '0', '0', '3232235942', '1427966321', '1', '-1', '1', '', null, '0', '0', '0', '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('7', '姜先生', '0000-00-00', null, null, null, null, null, null, null, null, null, '0', '0', null, null, null, '0', null, '0', '', '10', '1', '0', null, '0', '0', '0', '', '0', '0', '3232235896', '1428462501', '1', '-1', '1', '', null, '10', '5', '0', '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('8', '雕塑家', '0000-00-00', null, null, null, null, null, null, null, null, null, '0', '0', null, null, null, '0', null, '0', '', '20', '4', '131', null, '0', '0', '7', '1', '0', '0', '3232235942', '1429689075', '1', '-1', '1', '<span>证券发行人是指为筹措资金而发行债券、股票等证券的政府及其机构、金融机构、公司和企业。证券发行人是，如果没有证券发行人，证券发行及其后的证券交易就无从展开，证券市场也就不可能存在。证券发行人根据需要决定证券的发行，证券发行则是把证券向投资者销售的行为。证券发行可以由发行人直接办理，这种证券发行称之为自办发行。自办发行是比较特殊的发行行为，也比较少见。近年来，由于网络技术在发行中的应用，自办发行开始多起来。证券发行一般由证券发行人委托证券公司进行。证券公司首先向证券发行人购入证券，然后再向投资者销售。由证券公司承办的证券发行称之为承销。</span>', null, '6', '0', '0', '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('9', '讲述家', '0000-00-00', null, null, null, null, null, null, null, null, null, '0', '0', null, null, null, '0', null, '0', '', '0', '0', '131', null, '0', '15', '7', '1', '0', '0', '0', '0', '1', '-1', '1', '讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家讲述家', null, '10', '5', '0', '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('10', '阿里巴巴', '0000-00-00', null, null, null, null, null, null, null, null, null, '0', '0', null, null, null, '0', null, '0', '', '30', '5', '131', null, '0', '15', '7', '1', '0', '0', '3232235942', '1429684525', '1', '-1', '1', '证券发行人是指为筹措资金而发行债券、股票等证券的政府及其机构、金融机构、公司和企业。证券发行人是，如果没有证券发行人，证券发行及其后的证券交易就无从展开，证券市场也就不可能存在。证券发行人根据需要决定证券的发行，证券发行则是把证券向投资者销售的行为。证券发行可以由发行人直接办理，这种证券发行称之为自办发行。自办发行是比较特殊的发行行为，也比较少见。近年来，由于网络技术在发行中的应用，自办发行开始多起来。证券发行一般由证券发行人委托证券公司进行。证券公司首先向证券发行人购入证券，然后再向投资者销售。由证券公司承办的证券发行称之为承销', null, '0', '0', '0', '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('11', '周加班1', '0000-00-00', null, null, null, null, null, null, null, null, null, '0', '0', null, null, null, '0', null, '0', '', '20', '2', '1', null, '0', '0', '0', '', '0', '0', '3232235942', '1429684129', '1', '-1', '1', '', null, '0', '0', '0', '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('12', 'a', 'a', 'a', 'nick', null, null, null, null, null, null, null, '97190', '0', null, null, null, '0', null, '0', '', '0', '0', '27', null, '0', null, null, null, '0', '0', '0', '0', '1', '0', '0', null, null, null, null, null, '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('18', '', '14e1b600b1fd579f47433b88e8d852', '15823694675', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '0', null, '0', '', '0', '0', null, null, '0', null, null, null, '0', '1532307926', '0', '0', '1', '0', '1', null, null, null, null, null, '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('19', '', '14e1b600b1fd579f47433b88e8d852', '15215051909', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '0', null, '0', '', '0', '0', null, null, '0', null, null, null, '0', '1532312156', '0', '0', '1', '0', '1', null, null, null, null, null, '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('20', '', 'b9e79361b4040a3f3a71668163d2f0', '13666666666', null, null, null, null, null, null, null, null, '0', '0', null, null, null, '0', null, '0', '', '0', '0', null, null, '0', null, null, null, '0', '1532316340', '0', '0', '1', '0', '1', null, null, null, null, null, '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('21', 'aaa', 'aaa', 'aaa', '杉乡', 'aaa', 'aaa', 'aaa', 'aaa', 'aaa', '023-08980 -5656', '重庆市', '1670', '390', null, '299', '满1000减100', '1', '1', '1', '', '0', '0', '27', null, '1', null, null, null, '0', '0', '0', '0', '1', '0', '1', '杉乡大酒店介绍杉乡大酒店介绍', '杉乡大酒店介绍杉乡大酒店介绍杉乡大酒店介绍', null, null, null, '106.551556', '29.563009');
INSERT INTO `bhy_usermember` VALUES ('22', '', '0000-00-00', '15215051909', '杉乡星级大酒店2', null, null, null, null, null, '023-08980 -5656', '重庆市沙坪坝区自由村66-9-2号', '0', '3', null, '299', '满1000减100', '1', '1', '1', '', '0', '0', '1', null, '1', null, null, null, '0', '0', '0', '0', '1', '0', '0', '杉乡大酒店介绍杉乡大酒店介绍', '杉乡大酒店介绍杉乡大酒店介绍杉乡大酒店介绍', null, null, null, '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('23', '', '0000-00-00', '15215051909', '杉乡星级大酒店3', null, null, null, null, null, '023-08980 -5656', '重庆市沙坪坝区自由村66-9-2号', '0', '1', null, '299', '满1000减100', '1', '1', '1', '', '0', '0', '1', null, '1', null, null, null, '0', '0', '0', '0', '1', '0', '0', '杉乡大酒店介绍杉乡大酒店介绍', '杉乡大酒店介绍杉乡大酒店介绍杉乡大酒店介绍', null, null, null, '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('24', '', '0000-00-00', '15215051909', '杉乡星级大酒店4', null, null, null, null, null, '023-08980 -5656', '重庆市沙坪坝区自由村66-9-2号', '0', '0', null, '299', '满1000减100', '1', '1', '1', '', '0', '0', '1', null, '1', null, null, null, '0', '0', '0', '0', '1', '0', '0', '杉乡大酒店介绍杉乡大酒店介绍', '杉乡大酒店介绍杉乡大酒店介绍杉乡大酒店介绍', null, null, null, '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('25', '', '0000-00-00', '15215051909', '杉乡星级大酒店5', null, null, null, null, null, '023-08980 -5656', '重庆市沙坪坝区自由村66-9-2号', '0', '0', null, '299', '满1000减100', '1', '1', '1', '', '0', '0', '1', null, '1', null, null, null, '0', '0', '0', '0', '1', '0', '1', '杉乡大酒店介绍杉乡大酒店介绍', '杉乡大酒店介绍杉乡大酒店介绍杉乡大酒店介绍', null, null, null, '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('26', '', '0000-00-00', '15215051909', '杉乡经济大酒店1', null, null, null, null, null, '023-08980 -5656', '重庆市沙坪坝区自由村66-9-2号', '0', '1', null, '299', '满1000减100', '1', '2', '1', '', '0', '0', '1', null, '1', null, null, null, '0', '0', '0', '0', '1', '0', '1', '杉乡大酒店介绍杉乡大酒店介绍', '杉乡大酒店介绍杉乡大酒店介绍杉乡大酒店介绍', null, null, null, '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('27', '', '0000-00-00', '15215051909', '杉乡经济大酒店2', null, null, null, null, null, '023-08980 -5656', '重庆市沙坪坝区自由村66-9-2号', '0', '3', null, '299', '满1000减100', '1', '2', '1', '', '0', '0', '1', null, '1', null, null, null, '0', '0', '0', '0', '1', '0', '1', '杉乡大酒店介绍杉乡大酒店介绍', '杉乡大酒店介绍杉乡大酒店介绍杉乡大酒店介绍', null, null, null, '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('28', '', '0000-00-00', '15215051909', '杉乡经济大酒店3', null, null, null, null, null, '023-08980 -5656', '重庆市沙坪坝区自由村66-9-2号', '0', '3', null, '299', '满1000减100', '1', '2', '1', '', '0', '0', '1', null, '1', null, null, null, '0', '0', '0', '0', '1', '0', '1', '杉乡大酒店介绍杉乡大酒店介绍', '杉乡大酒店介绍杉乡大酒店介绍杉乡大酒店介绍', null, null, null, '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('29', '', '0000-00-00', '15215051909', '杉乡经济大酒店4', null, null, null, null, null, '023-08980 -5656', '重庆市沙坪坝区自由村66-9-2号', '0', '0', null, '299', '满1000减100', '1', '2', '1', '', '0', '0', '1', null, '1', null, null, null, '0', '0', '0', '0', '1', '0', '1', '杉乡大酒店介绍杉乡大酒店介绍', '杉乡大酒店介绍杉乡大酒店介绍杉乡大酒店介绍', null, null, null, '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('30', '', '0000-00-00', '15215051909', '杉乡经济大酒店5', null, null, null, null, null, '023-08980 -5656', '重庆市沙坪坝区自由村66-9-2号', '0', '0', null, '299', '满1000减100', '1', '2', '1', '', '0', '0', '1', null, '1', null, null, null, '0', '0', '0', '0', '1', '0', '1', '杉乡大酒店介绍杉乡大酒店介绍', '杉乡大酒店介绍杉乡大酒店介绍杉乡大酒店介绍', null, null, null, '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('31', '', '0000-00-00', '15215051909', '杉乡民宿大酒店1', null, null, null, null, null, '023-08980 -5656', '重庆市沙坪坝区自由村66-9-2号', '0', '1', null, '299', '满1000减100', '1', '3', '1', '', '0', '0', '1', null, '1', null, null, null, '0', '0', '0', '0', '1', '0', '1', '杉乡大酒店介绍杉乡大酒店介绍', '杉乡大酒店介绍杉乡大酒店介绍杉乡大酒店介绍', null, null, null, '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('32', '', '0000-00-00', '15215051909', '杉乡民宿大酒店2', null, null, null, null, null, '023-08980 -5656', '重庆市沙坪坝区自由村66-9-2号', '0', '0', null, '299', '满1000减100', '1', '3', '1', '', '0', '0', '1', null, '1', null, null, null, '0', '0', '0', '0', '1', '0', '1', '杉乡大酒店介绍杉乡大酒店介绍', '杉乡大酒店介绍杉乡大酒店介绍杉乡大酒店介绍', null, null, null, '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('33', '', '0000-00-00', '15215051909', '杉乡民宿大酒店3', null, null, null, null, null, '023-08980 -5656', '重庆市沙坪坝区自由村66-9-2号', '0', '0', null, '299', '满1000减100', '1', '3', '1', '', '0', '0', '1', null, '1', null, null, null, '0', '0', '0', '0', '1', '0', '1', '杉乡大酒店介绍杉乡大酒店介绍', '杉乡大酒店介绍杉乡大酒店介绍杉乡大酒店介绍', null, null, null, '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('34', '', '0000-00-00', '15215051909', '杉乡民宿大酒店4', null, null, null, null, null, '023-08980 -5656', '重庆市沙坪坝区自由村66-9-2号', '0', '0', null, '299', '满1000减100', '1', '3', '1', '', '0', '0', '1', null, '1', null, null, null, '0', '0', '0', '0', '1', '0', '1', '杉乡大酒店介绍杉乡大酒店介绍', '杉乡大酒店介绍杉乡大酒店介绍杉乡大酒店介绍', null, null, null, '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('35', '', '0000-00-00', '15215051909', '杉乡民宿大酒店5', null, null, null, null, null, '023-08980 -5656', '重庆市沙坪坝区自由村66-9-2号', '0', '4', null, '299', '满1000减100', '1', '3', '1', '', '0', '0', '1', null, '1', null, null, null, '0', '0', '0', '0', '1', '0', '1', '杉乡大酒店介绍杉乡大酒店介绍', '杉乡大酒店介绍杉乡大酒店介绍杉乡大酒店介绍', null, null, null, '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('38', 'bbb', 'bbb', 'bbb', '火锅菜馆', '火锅菜馆', '火锅菜馆', '火锅菜馆', '', '火锅菜馆', '023-08980 -5656', '重庆市沙坪坝区自由村66-9-2号', '253', '502', null, '299', null, '2', '0', '1', '', '0', '0', '39', '44', '0', null, null, null, '0', '1532398628', '0', '0', '1', '0', '1', '杉乡大酒店介绍杉乡大酒店介绍杉乡大酒店介绍杉乡大酒店介绍', null, null, null, null, '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('41', '好吃狗', '1', null, '好吃狗', null, null, null, null, null, null, null, '0', '7', null, '299', null, '2', '0', '0', '', '0', '0', '39', null, '0', null, null, null, '0', '1532432597', '0', '0', '1', '0', '1', '杉乡大酒店介绍杉乡大酒店介绍杉乡大酒店介绍杉乡大酒店介绍', null, null, null, null, '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('43', '', '111', null, '田野山货', null, null, null, null, null, null, null, '0', '3', null, '299', null, '2', '0', '0', '', '0', '0', '39', null, '0', null, null, null, '0', '1532432648', '0', '0', '1', '0', '1', '杉乡大酒店介绍杉乡大酒店介绍杉乡大酒店介绍杉乡大酒店介绍', null, null, null, null, '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('44', 'ccc', 'ccc', 'ccc', 'jinqut', null, null, null, null, null, '023-08980 -5656', '重庆市沙坪坝区自由村66-9-2号', '20', '0', null, '299', '满1000减100', '3', '0', '0', '', '0', '0', '65', null, '0', null, null, null, '0', '0', '0', '0', '1', '0', '1', '杉乡大酒店介绍杉乡大酒店介绍', null, null, null, null, '109.200534', '26.676233');
INSERT INTO `bhy_usermember` VALUES ('46', '', '111111', '17708311033', '17708311033', null, null, null, null, null, null, null, '0', '0', null, null, null, '0', '0', '0', '', '0', '0', null, null, '0', null, null, null, '0', '1535766450', '0', '0', '1', '0', '1', null, null, null, null, null, '109.200534', '26.676233');

-- ----------------------------
-- Table structure for bhy_video
-- ----------------------------
DROP TABLE IF EXISTS `bhy_video`;
CREATE TABLE `bhy_video` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键ID',
  `describle` mediumtext NOT NULL COMMENT '描述',
  `egdescrible` mediumtext NOT NULL,
  `egtitle` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT '标题',
  `typeid` int(10) NOT NULL DEFAULT '0' COMMENT '分类id',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `file` int(12) DEFAULT '0',
  `icon` int(10) NOT NULL COMMENT '缩略图',
  `sort` int(10) DEFAULT NULL COMMENT '排序',
  `view` int(10) NOT NULL COMMENT '浏览量',
  `create_time` int(20) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(20) DEFAULT NULL COMMENT '修改时间',
  `mid` int(10) NOT NULL COMMENT '添加人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bhy_video
-- ----------------------------
INSERT INTO `bhy_video` VALUES ('1', '测试测试', '测试测试', '视频一', '视频一', '24', '1', '0', '137', '0', '0', '1538206368', null, '1');
INSERT INTO `bhy_video` VALUES ('2', '视频二视频二视频二', '视频二视频二视频二', '视频二', '视频二', '24', '1', '0', '137', '0', '0', '1538206474', null, '1');
INSERT INTO `bhy_video` VALUES ('3', '具备智能汽车驾驶辅助系统（ADAS）标准法规测试、研发型测试、对标测试评价能力，已为行业提供FCW、LDW、AEB、ACC、LKA、APS等标准检测服务', 'With the ability to test and evaluate the standards and regulations of Intelligent Driving Assisted System (ADAS), R&D testing and benchmarking testing, it has provided standard testing services such as FCW, LDW, AEB, ACC, LKA, APS, etc', 'Video display', '视频展示', '25', '1', '0', '136', '0', '0', '1538211775', null, '1');
