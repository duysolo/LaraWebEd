/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : mine_laracms

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2016-04-25 19:58:06
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `admin_users`
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_id` int(11) NOT NULL DEFAULT '3',
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(255) NOT NULL,
  `login_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token_expired_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_login_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of admin_users
-- ----------------------------
INSERT INTO admin_users VALUES ('1', '1', 'webmaster', '$2y$10$HZpZYik9nYGc8kBtKnICjujtBFIXd42ITgZTA.Ss2OvJg4k9g3PfG', '1', 'aUz7m68uo4AqmDEjBQDF47pfshxSKvULJs4WqBCnPp5ezEbNPdTRpS8v862c', '749f258446f1d3bc08c9b669b3bb1a0f', '2015-12-22 01:33:21', '2016-04-24 15:16:56', '2014-10-14 00:10:13', '2016-01-19 12:08:46');

-- ----------------------------
-- Table structure for `admin_user_roles`
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_roles`;
CREATE TABLE `admin_user_roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of admin_user_roles
-- ----------------------------
INSERT INTO admin_user_roles VALUES ('1', 'Webmaster', 'webmaster');
INSERT INTO admin_user_roles VALUES ('2', 'Administrator', 'administrator');
INSERT INTO admin_user_roles VALUES ('3', 'Staff', 'staff');

-- ----------------------------
-- Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `global_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_template` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `order` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO categories VALUES ('4', '0', 'Tutorials', '', '1', '2', '0', '2016-01-28 14:06:40', '2016-04-18 10:51:48');
INSERT INTO categories VALUES ('5', '0', 'Blog', '', '1', '0', '0', '2016-04-16 00:59:40', '2016-04-16 01:07:14');
INSERT INTO categories VALUES ('6', '0', 'Documentation', '', '1', '0', '0', '2016-04-18 12:46:06', '2016-04-18 12:49:00');
INSERT INTO categories VALUES ('7', '6', 'Getting started', '', '1', '0', '0', '2016-04-18 12:46:27', '2016-04-18 12:49:12');
INSERT INTO categories VALUES ('8', '6', 'Module page', '', '1', '2', '0', '2016-04-18 12:50:16', '2016-04-19 22:02:56');
INSERT INTO categories VALUES ('9', '6', 'Module post', '', '1', '3', '0', '2016-04-18 12:50:40', '2016-04-19 22:03:01');
INSERT INTO categories VALUES ('10', '6', 'Module category', '', '1', '4', '0', '2016-04-18 12:50:54', '2016-04-19 22:05:33');
INSERT INTO categories VALUES ('11', '6', 'Module product', '', '1', '5', '0', '2016-04-18 12:51:39', '2016-04-19 22:05:37');
INSERT INTO categories VALUES ('12', '6', 'Module product category', '', '1', '6', '0', '2016-04-18 12:51:56', '2016-04-19 22:05:41');
INSERT INTO categories VALUES ('13', '6', 'Module coupon', '', '1', '7', '0', '2016-04-18 12:52:16', '2016-04-19 22:05:45');
INSERT INTO categories VALUES ('14', '6', 'Module user', '', '1', '8', '0', '2016-04-18 12:53:37', '2016-04-19 22:05:50');
INSERT INTO categories VALUES ('15', '6', 'Module admin user', '', '1', '9', '0', '2016-04-18 12:53:55', '2016-04-19 22:05:55');
INSERT INTO categories VALUES ('16', '6', 'Module menu', '', '1', '10', '0', '2016-04-18 12:54:14', '2016-04-19 22:06:01');
INSERT INTO categories VALUES ('17', '6', 'Module option', '', '1', '11', '0', '2016-04-18 12:54:34', '2016-04-19 22:06:10');
INSERT INTO categories VALUES ('18', '6', 'Module custom fields', '', '1', '12', '0', '2016-04-18 12:54:55', '2016-04-19 22:06:20');
INSERT INTO categories VALUES ('19', '6', 'Module languages', '', '1', '14', '0', '2016-04-18 12:55:29', '2016-04-19 22:07:57');
INSERT INTO categories VALUES ('20', '6', 'Module feedback', '', '1', '13', '0', '2016-04-18 12:56:13', '2016-04-19 22:06:30');
INSERT INTO categories VALUES ('21', '6', 'API reference', '', '1', '1', '0', '2016-04-19 21:59:29', '2016-04-19 22:02:30');
INSERT INTO categories VALUES ('22', '6', 'Models', '', '1', '0', '0', '2016-04-21 21:51:33', '2016-04-21 21:51:46');

-- ----------------------------
-- Table structure for `categories_posts`
-- ----------------------------
DROP TABLE IF EXISTS `categories_posts`;
CREATE TABLE `categories_posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=214 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of categories_posts
-- ----------------------------
INSERT INTO categories_posts VALUES ('3', '1', '4');
INSERT INTO categories_posts VALUES ('4', '2', '4');
INSERT INTO categories_posts VALUES ('5', '3', '4');
INSERT INTO categories_posts VALUES ('6', '4', '4');
INSERT INTO categories_posts VALUES ('7', '5', '4');
INSERT INTO categories_posts VALUES ('8', '6', '4');
INSERT INTO categories_posts VALUES ('9', '7', '4');
INSERT INTO categories_posts VALUES ('10', '8', '4');
INSERT INTO categories_posts VALUES ('11', '9', '4');
INSERT INTO categories_posts VALUES ('12', '10', '4');
INSERT INTO categories_posts VALUES ('13', '11', '4');
INSERT INTO categories_posts VALUES ('14', '12', '4');
INSERT INTO categories_posts VALUES ('15', '13', '4');
INSERT INTO categories_posts VALUES ('16', '14', '4');
INSERT INTO categories_posts VALUES ('17', '15', '4');
INSERT INTO categories_posts VALUES ('18', '16', '4');
INSERT INTO categories_posts VALUES ('19', '17', '4');
INSERT INTO categories_posts VALUES ('20', '18', '4');
INSERT INTO categories_posts VALUES ('21', '19', '4');
INSERT INTO categories_posts VALUES ('22', '20', '4');
INSERT INTO categories_posts VALUES ('23', '21', '4');
INSERT INTO categories_posts VALUES ('24', '22', '4');
INSERT INTO categories_posts VALUES ('25', '23', '4');
INSERT INTO categories_posts VALUES ('26', '24', '4');
INSERT INTO categories_posts VALUES ('27', '25', '4');
INSERT INTO categories_posts VALUES ('28', '26', '4');
INSERT INTO categories_posts VALUES ('29', '27', '4');
INSERT INTO categories_posts VALUES ('30', '28', '4');
INSERT INTO categories_posts VALUES ('31', '29', '4');
INSERT INTO categories_posts VALUES ('32', '30', '4');
INSERT INTO categories_posts VALUES ('33', '31', '4');
INSERT INTO categories_posts VALUES ('34', '32', '4');
INSERT INTO categories_posts VALUES ('35', '33', '4');
INSERT INTO categories_posts VALUES ('36', '34', '4');
INSERT INTO categories_posts VALUES ('37', '35', '4');
INSERT INTO categories_posts VALUES ('38', '36', '4');
INSERT INTO categories_posts VALUES ('39', '37', '4');
INSERT INTO categories_posts VALUES ('40', '38', '4');
INSERT INTO categories_posts VALUES ('41', '39', '4');
INSERT INTO categories_posts VALUES ('42', '40', '4');
INSERT INTO categories_posts VALUES ('43', '41', '4');
INSERT INTO categories_posts VALUES ('44', '42', '4');
INSERT INTO categories_posts VALUES ('45', '43', '4');
INSERT INTO categories_posts VALUES ('46', '44', '4');
INSERT INTO categories_posts VALUES ('47', '45', '4');
INSERT INTO categories_posts VALUES ('48', '46', '4');
INSERT INTO categories_posts VALUES ('49', '47', '4');
INSERT INTO categories_posts VALUES ('50', '48', '4');
INSERT INTO categories_posts VALUES ('51', '49', '4');
INSERT INTO categories_posts VALUES ('52', '50', '4');
INSERT INTO categories_posts VALUES ('53', '51', '4');
INSERT INTO categories_posts VALUES ('54', '52', '4');
INSERT INTO categories_posts VALUES ('55', '53', '4');
INSERT INTO categories_posts VALUES ('56', '54', '4');
INSERT INTO categories_posts VALUES ('57', '55', '4');
INSERT INTO categories_posts VALUES ('58', '56', '4');
INSERT INTO categories_posts VALUES ('59', '57', '4');
INSERT INTO categories_posts VALUES ('60', '58', '4');
INSERT INTO categories_posts VALUES ('61', '59', '4');
INSERT INTO categories_posts VALUES ('62', '60', '4');
INSERT INTO categories_posts VALUES ('63', '61', '4');
INSERT INTO categories_posts VALUES ('64', '62', '4');
INSERT INTO categories_posts VALUES ('65', '63', '4');
INSERT INTO categories_posts VALUES ('66', '64', '4');
INSERT INTO categories_posts VALUES ('67', '65', '4');
INSERT INTO categories_posts VALUES ('68', '66', '4');
INSERT INTO categories_posts VALUES ('69', '67', '4');
INSERT INTO categories_posts VALUES ('70', '68', '4');
INSERT INTO categories_posts VALUES ('71', '69', '4');
INSERT INTO categories_posts VALUES ('72', '70', '4');
INSERT INTO categories_posts VALUES ('73', '71', '4');
INSERT INTO categories_posts VALUES ('74', '72', '4');
INSERT INTO categories_posts VALUES ('75', '73', '4');
INSERT INTO categories_posts VALUES ('76', '74', '4');
INSERT INTO categories_posts VALUES ('77', '75', '4');
INSERT INTO categories_posts VALUES ('78', '76', '4');
INSERT INTO categories_posts VALUES ('79', '77', '4');
INSERT INTO categories_posts VALUES ('80', '78', '4');
INSERT INTO categories_posts VALUES ('81', '79', '4');
INSERT INTO categories_posts VALUES ('82', '80', '4');
INSERT INTO categories_posts VALUES ('83', '81', '4');
INSERT INTO categories_posts VALUES ('84', '82', '4');
INSERT INTO categories_posts VALUES ('85', '83', '4');
INSERT INTO categories_posts VALUES ('86', '84', '4');
INSERT INTO categories_posts VALUES ('87', '85', '4');
INSERT INTO categories_posts VALUES ('88', '86', '4');
INSERT INTO categories_posts VALUES ('89', '87', '4');
INSERT INTO categories_posts VALUES ('90', '88', '4');
INSERT INTO categories_posts VALUES ('91', '89', '4');
INSERT INTO categories_posts VALUES ('92', '90', '4');
INSERT INTO categories_posts VALUES ('93', '91', '4');
INSERT INTO categories_posts VALUES ('94', '92', '4');
INSERT INTO categories_posts VALUES ('95', '93', '4');
INSERT INTO categories_posts VALUES ('96', '94', '4');
INSERT INTO categories_posts VALUES ('97', '95', '4');
INSERT INTO categories_posts VALUES ('98', '96', '4');
INSERT INTO categories_posts VALUES ('99', '97', '4');
INSERT INTO categories_posts VALUES ('100', '98', '4');
INSERT INTO categories_posts VALUES ('101', '99', '4');
INSERT INTO categories_posts VALUES ('102', '100', '4');
INSERT INTO categories_posts VALUES ('104', '102', '4');
INSERT INTO categories_posts VALUES ('105', '103', '4');
INSERT INTO categories_posts VALUES ('106', '104', '4');
INSERT INTO categories_posts VALUES ('107', '105', '4');
INSERT INTO categories_posts VALUES ('108', '106', '4');
INSERT INTO categories_posts VALUES ('109', '107', '4');
INSERT INTO categories_posts VALUES ('110', '108', '4');
INSERT INTO categories_posts VALUES ('111', '109', '4');
INSERT INTO categories_posts VALUES ('112', '110', '4');
INSERT INTO categories_posts VALUES ('113', '111', '4');
INSERT INTO categories_posts VALUES ('114', '112', '4');
INSERT INTO categories_posts VALUES ('115', '113', '4');
INSERT INTO categories_posts VALUES ('116', '114', '4');
INSERT INTO categories_posts VALUES ('117', '115', '4');
INSERT INTO categories_posts VALUES ('118', '116', '4');
INSERT INTO categories_posts VALUES ('119', '117', '4');
INSERT INTO categories_posts VALUES ('120', '118', '4');
INSERT INTO categories_posts VALUES ('121', '119', '4');
INSERT INTO categories_posts VALUES ('122', '120', '4');
INSERT INTO categories_posts VALUES ('123', '121', '4');
INSERT INTO categories_posts VALUES ('124', '122', '4');
INSERT INTO categories_posts VALUES ('125', '123', '4');
INSERT INTO categories_posts VALUES ('126', '124', '4');
INSERT INTO categories_posts VALUES ('127', '125', '4');
INSERT INTO categories_posts VALUES ('128', '126', '4');
INSERT INTO categories_posts VALUES ('129', '127', '4');
INSERT INTO categories_posts VALUES ('130', '128', '4');
INSERT INTO categories_posts VALUES ('131', '129', '4');
INSERT INTO categories_posts VALUES ('132', '130', '4');
INSERT INTO categories_posts VALUES ('133', '131', '4');
INSERT INTO categories_posts VALUES ('134', '132', '4');
INSERT INTO categories_posts VALUES ('135', '133', '4');
INSERT INTO categories_posts VALUES ('136', '134', '4');
INSERT INTO categories_posts VALUES ('137', '135', '4');
INSERT INTO categories_posts VALUES ('138', '136', '4');
INSERT INTO categories_posts VALUES ('139', '137', '4');
INSERT INTO categories_posts VALUES ('140', '138', '4');
INSERT INTO categories_posts VALUES ('141', '139', '4');
INSERT INTO categories_posts VALUES ('142', '140', '4');
INSERT INTO categories_posts VALUES ('143', '141', '4');
INSERT INTO categories_posts VALUES ('144', '142', '4');
INSERT INTO categories_posts VALUES ('145', '143', '4');
INSERT INTO categories_posts VALUES ('146', '144', '4');
INSERT INTO categories_posts VALUES ('147', '145', '4');
INSERT INTO categories_posts VALUES ('148', '146', '4');
INSERT INTO categories_posts VALUES ('149', '147', '4');
INSERT INTO categories_posts VALUES ('150', '148', '4');
INSERT INTO categories_posts VALUES ('151', '149', '4');
INSERT INTO categories_posts VALUES ('152', '150', '4');
INSERT INTO categories_posts VALUES ('153', '151', '4');
INSERT INTO categories_posts VALUES ('154', '152', '4');
INSERT INTO categories_posts VALUES ('155', '153', '4');
INSERT INTO categories_posts VALUES ('156', '154', '4');
INSERT INTO categories_posts VALUES ('157', '155', '4');
INSERT INTO categories_posts VALUES ('158', '156', '4');
INSERT INTO categories_posts VALUES ('159', '157', '4');
INSERT INTO categories_posts VALUES ('160', '158', '4');
INSERT INTO categories_posts VALUES ('161', '159', '4');
INSERT INTO categories_posts VALUES ('162', '160', '4');
INSERT INTO categories_posts VALUES ('163', '161', '4');
INSERT INTO categories_posts VALUES ('164', '162', '4');
INSERT INTO categories_posts VALUES ('165', '163', '4');
INSERT INTO categories_posts VALUES ('166', '164', '4');
INSERT INTO categories_posts VALUES ('167', '165', '4');
INSERT INTO categories_posts VALUES ('168', '166', '4');
INSERT INTO categories_posts VALUES ('169', '167', '4');
INSERT INTO categories_posts VALUES ('170', '168', '4');
INSERT INTO categories_posts VALUES ('171', '169', '4');
INSERT INTO categories_posts VALUES ('172', '170', '4');
INSERT INTO categories_posts VALUES ('173', '171', '4');
INSERT INTO categories_posts VALUES ('174', '172', '4');
INSERT INTO categories_posts VALUES ('175', '173', '4');
INSERT INTO categories_posts VALUES ('176', '174', '4');
INSERT INTO categories_posts VALUES ('177', '175', '4');
INSERT INTO categories_posts VALUES ('178', '176', '4');
INSERT INTO categories_posts VALUES ('179', '177', '4');
INSERT INTO categories_posts VALUES ('180', '178', '4');
INSERT INTO categories_posts VALUES ('181', '179', '4');
INSERT INTO categories_posts VALUES ('182', '180', '4');
INSERT INTO categories_posts VALUES ('183', '181', '4');
INSERT INTO categories_posts VALUES ('184', '182', '4');
INSERT INTO categories_posts VALUES ('185', '183', '4');
INSERT INTO categories_posts VALUES ('186', '184', '4');
INSERT INTO categories_posts VALUES ('187', '185', '4');
INSERT INTO categories_posts VALUES ('188', '186', '4');
INSERT INTO categories_posts VALUES ('189', '187', '4');
INSERT INTO categories_posts VALUES ('190', '188', '4');
INSERT INTO categories_posts VALUES ('191', '189', '4');
INSERT INTO categories_posts VALUES ('192', '190', '4');
INSERT INTO categories_posts VALUES ('193', '191', '4');
INSERT INTO categories_posts VALUES ('194', '192', '4');
INSERT INTO categories_posts VALUES ('195', '193', '4');
INSERT INTO categories_posts VALUES ('196', '194', '4');
INSERT INTO categories_posts VALUES ('197', '195', '4');
INSERT INTO categories_posts VALUES ('198', '196', '4');
INSERT INTO categories_posts VALUES ('199', '197', '4');
INSERT INTO categories_posts VALUES ('200', '198', '4');
INSERT INTO categories_posts VALUES ('201', '199', '4');
INSERT INTO categories_posts VALUES ('202', '200', '4');
INSERT INTO categories_posts VALUES ('203', '102', '5');
INSERT INTO categories_posts VALUES ('204', '201', '7');
INSERT INTO categories_posts VALUES ('206', '202', '21');
INSERT INTO categories_posts VALUES ('207', '203', '21');
INSERT INTO categories_posts VALUES ('208', '204', '7');
INSERT INTO categories_posts VALUES ('210', '205', '22');
INSERT INTO categories_posts VALUES ('211', '206', '22');
INSERT INTO categories_posts VALUES ('212', '207', '8');
INSERT INTO categories_posts VALUES ('213', '208', '7');

-- ----------------------------
-- Table structure for `category_contents`
-- ----------------------------
DROP TABLE IF EXISTS `category_contents`;
CREATE TABLE `category_contents` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '59',
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '1',
  `thumbnail` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `tags` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of category_contents
-- ----------------------------
INSERT INTO category_contents VALUES ('9', '4', '59', 'Tutorials', 'huong-dan', '', '', '1', '', '', '0', '2016-01-28 14:06:40', '2016-04-16 01:04:04');
INSERT INTO category_contents VALUES ('10', '5', '59', 'Nhật ký', 'nhat-ky', '', '', '1', '', '', '0', '2016-04-16 00:59:41', '2016-04-16 01:07:07');
INSERT INTO category_contents VALUES ('11', '4', '1', 'Tutorials', 'tutorials', '', '', '1', '', '', '1', '2016-04-16 01:03:02', '2016-04-16 01:04:15');
INSERT INTO category_contents VALUES ('12', '5', '1', 'Blog', 'blog', '', '', '1', '', '', '1', '2016-04-16 01:03:03', '2016-04-16 01:07:14');
INSERT INTO category_contents VALUES ('13', '6', '1', 'Documentation', 'documentation', '', '', '1', '', '', '0', '2016-04-18 12:46:06', '2016-04-18 12:49:00');
INSERT INTO category_contents VALUES ('14', '7', '1', 'Getting started', 'getting-started', '', '', '1', '', '', '0', '2016-04-18 12:46:27', '2016-04-18 12:49:18');
INSERT INTO category_contents VALUES ('15', '8', '1', 'Module page', 'module-page', '', '', '1', '', '', '0', '2016-04-18 12:50:16', '2016-04-18 12:50:16');
INSERT INTO category_contents VALUES ('16', '9', '1', 'Module post', 'module-post', '', '', '1', '', '', '0', '2016-04-18 12:50:40', '2016-04-18 12:50:40');
INSERT INTO category_contents VALUES ('17', '10', '1', 'Module category', 'module-category', '', '', '1', '', '', '0', '2016-04-18 12:50:54', '2016-04-18 12:50:54');
INSERT INTO category_contents VALUES ('18', '11', '1', 'Module product', 'module-product', '', '', '1', '', '', '0', '2016-04-18 12:51:41', '2016-04-18 12:51:41');
INSERT INTO category_contents VALUES ('19', '12', '1', 'Module product category', 'module-product-category', '', '', '1', '', '', '0', '2016-04-18 12:51:56', '2016-04-18 12:51:56');
INSERT INTO category_contents VALUES ('20', '13', '1', 'Module coupon', 'module-coupon', '', '', '1', '', '', '0', '2016-04-18 12:52:17', '2016-04-18 12:52:17');
INSERT INTO category_contents VALUES ('21', '14', '1', 'Module user', 'module-user', '', '', '1', '', '', '0', '2016-04-18 12:53:40', '2016-04-18 12:53:40');
INSERT INTO category_contents VALUES ('22', '15', '1', 'Module admin user', 'module-admin-user', '', '', '1', '', '', '0', '2016-04-18 12:53:55', '2016-04-18 12:53:55');
INSERT INTO category_contents VALUES ('23', '16', '1', 'Module menu', 'module-menu', '', '', '1', '', '', '0', '2016-04-18 12:54:14', '2016-04-18 12:54:14');
INSERT INTO category_contents VALUES ('24', '17', '1', 'Module option', 'module-option', '', '', '1', '', '', '0', '2016-04-18 12:54:34', '2016-04-18 12:54:34');
INSERT INTO category_contents VALUES ('25', '18', '1', 'Module custom fields', 'module-custom-fields', '', '', '1', '', '', '0', '2016-04-18 12:54:55', '2016-04-18 12:54:55');
INSERT INTO category_contents VALUES ('26', '19', '1', 'Module languages', 'module-languages', '', '', '1', '', '', '0', '2016-04-18 12:55:29', '2016-04-18 12:55:29');
INSERT INTO category_contents VALUES ('27', '20', '1', 'Module feedback', 'module-feedback', '', '', '1', '', '', '0', '2016-04-18 12:56:13', '2016-04-18 12:56:13');
INSERT INTO category_contents VALUES ('28', '21', '1', 'API reference', 'api-reference', '', '', '1', '', '', '0', '2016-04-19 21:59:29', '2016-04-19 21:59:29');
INSERT INTO category_contents VALUES ('29', '22', '1', 'Models', 'models', '', '', '1', '', '', '0', '2016-04-21 21:51:33', '2016-04-21 21:51:33');

-- ----------------------------
-- Table structure for `category_metas`
-- ----------------------------
DROP TABLE IF EXISTS `category_metas`;
CREATE TABLE `category_metas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int(11) DEFAULT NULL,
  `meta_key` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_value` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of category_metas
-- ----------------------------

-- ----------------------------
-- Table structure for `cities`
-- ----------------------------
DROP TABLE IF EXISTS `cities`;
CREATE TABLE `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `city_name` varchar(255) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4064 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cities
-- ----------------------------
INSERT INTO cities VALUES ('1', '5', 'Canillo', '0', '0');
INSERT INTO cities VALUES ('2', '5', 'Encamp', '0', '0');
INSERT INTO cities VALUES ('3', '5', 'La Massana', '0', '0');
INSERT INTO cities VALUES ('4', '5', 'Ordino', '0', '0');
INSERT INTO cities VALUES ('5', '5', 'Sant Julia de Loria', '0', '0');
INSERT INTO cities VALUES ('6', '5', 'Andorra la Vella', '0', '0');
INSERT INTO cities VALUES ('7', '5', 'Escaldes-Engordany', '0', '0');
INSERT INTO cities VALUES ('8', '221', 'Abu Dhabi', '0', '0');
INSERT INTO cities VALUES ('9', '221', 'Ajman', '0', '0');
INSERT INTO cities VALUES ('10', '221', 'Dubai', '0', '0');
INSERT INTO cities VALUES ('11', '221', 'Fujairah', '0', '0');
INSERT INTO cities VALUES ('12', '221', 'Ras Al Khaimah', '0', '0');
INSERT INTO cities VALUES ('13', '221', 'Sharjah', '0', '0');
INSERT INTO cities VALUES ('14', '221', 'Umm Al Quwain', '0', '0');
INSERT INTO cities VALUES ('15', '1', 'Badakhshan', '0', '0');
INSERT INTO cities VALUES ('16', '1', 'Badghis', '0', '0');
INSERT INTO cities VALUES ('17', '1', 'Baghlan', '0', '0');
INSERT INTO cities VALUES ('18', '1', 'Bamian', '0', '0');
INSERT INTO cities VALUES ('19', '1', 'Farah', '0', '0');
INSERT INTO cities VALUES ('20', '1', 'Faryab', '0', '0');
INSERT INTO cities VALUES ('21', '1', 'Ghazni', '0', '0');
INSERT INTO cities VALUES ('22', '1', 'Ghowr', '0', '0');
INSERT INTO cities VALUES ('23', '1', 'Helmand', '0', '0');
INSERT INTO cities VALUES ('24', '1', 'Herat', '0', '0');
INSERT INTO cities VALUES ('25', '1', 'Kabol', '0', '0');
INSERT INTO cities VALUES ('26', '1', 'Kapisa', '0', '0');
INSERT INTO cities VALUES ('27', '1', 'Lowgar', '0', '0');
INSERT INTO cities VALUES ('28', '1', 'Nangarhar', '0', '0');
INSERT INTO cities VALUES ('29', '1', 'Nimruz', '0', '0');
INSERT INTO cities VALUES ('30', '1', 'Kandahar', '0', '0');
INSERT INTO cities VALUES ('31', '1', 'Kondoz', '0', '0');
INSERT INTO cities VALUES ('32', '1', 'Takhar', '0', '0');
INSERT INTO cities VALUES ('33', '1', 'Vardak', '0', '0');
INSERT INTO cities VALUES ('34', '1', 'Zabol', '0', '0');
INSERT INTO cities VALUES ('35', '1', 'Paktika', '0', '0');
INSERT INTO cities VALUES ('36', '1', 'Balkh', '0', '0');
INSERT INTO cities VALUES ('37', '1', 'Jowzjan', '0', '0');
INSERT INTO cities VALUES ('38', '1', 'Samangan', '0', '0');
INSERT INTO cities VALUES ('39', '1', 'Sar-e Pol', '0', '0');
INSERT INTO cities VALUES ('40', '1', 'Konar', '0', '0');
INSERT INTO cities VALUES ('41', '1', 'Laghman', '0', '0');
INSERT INTO cities VALUES ('42', '1', 'Paktia', '0', '0');
INSERT INTO cities VALUES ('43', '1', 'Khowst', '0', '0');
INSERT INTO cities VALUES ('44', '1', 'Nurestan', '0', '0');
INSERT INTO cities VALUES ('45', '1', 'Oruzgan', '0', '0');
INSERT INTO cities VALUES ('46', '1', 'Parvan', '0', '0');
INSERT INTO cities VALUES ('47', '1', 'Daykondi', '0', '0');
INSERT INTO cities VALUES ('48', '1', 'Panjshir', '0', '0');
INSERT INTO cities VALUES ('49', '9', 'Barbuda', '0', '0');
INSERT INTO cities VALUES ('50', '9', 'Saint George', '0', '0');
INSERT INTO cities VALUES ('51', '9', 'Saint John', '0', '0');
INSERT INTO cities VALUES ('52', '9', 'Saint Mary', '0', '0');
INSERT INTO cities VALUES ('53', '9', 'Saint Paul', '0', '0');
INSERT INTO cities VALUES ('54', '9', 'Saint Peter', '0', '0');
INSERT INTO cities VALUES ('55', '9', 'Saint Philip', '0', '0');
INSERT INTO cities VALUES ('56', '9', 'Redonda', '0', '0');
INSERT INTO cities VALUES ('57', '2', 'Berat', '0', '0');
INSERT INTO cities VALUES ('58', '2', 'Diber', '0', '0');
INSERT INTO cities VALUES ('59', '2', 'Durres', '0', '0');
INSERT INTO cities VALUES ('60', '2', 'Elbasan', '0', '0');
INSERT INTO cities VALUES ('61', '2', 'Fier', '0', '0');
INSERT INTO cities VALUES ('62', '2', 'Gjirokaster', '0', '0');
INSERT INTO cities VALUES ('63', '2', 'Korce', '0', '0');
INSERT INTO cities VALUES ('64', '2', 'Kukes', '0', '0');
INSERT INTO cities VALUES ('65', '2', 'Lezhe', '0', '0');
INSERT INTO cities VALUES ('66', '2', 'Shkoder', '0', '0');
INSERT INTO cities VALUES ('67', '2', 'Tirane', '0', '0');
INSERT INTO cities VALUES ('68', '2', 'Vlore', '0', '0');
INSERT INTO cities VALUES ('69', '11', 'Aragatsotn', '0', '0');
INSERT INTO cities VALUES ('70', '11', 'Ararat', '0', '0');
INSERT INTO cities VALUES ('71', '11', 'Armavir', '0', '0');
INSERT INTO cities VALUES ('72', '11', 'Geghark\'unik\'', '0', '0');
INSERT INTO cities VALUES ('73', '11', 'Kotayk\'', '0', '0');
INSERT INTO cities VALUES ('74', '11', 'Lorri', '0', '0');
INSERT INTO cities VALUES ('75', '11', 'Shirak', '0', '0');
INSERT INTO cities VALUES ('76', '11', 'Syunik\'', '0', '0');
INSERT INTO cities VALUES ('77', '11', 'Tavush', '0', '0');
INSERT INTO cities VALUES ('78', '11', 'Vayots\' Dzor', '0', '0');
INSERT INTO cities VALUES ('79', '11', 'Yerevan', '0', '0');
INSERT INTO cities VALUES ('80', '6', 'Benguela', '0', '0');
INSERT INTO cities VALUES ('81', '6', 'Bie', '0', '0');
INSERT INTO cities VALUES ('82', '6', 'Cabinda', '0', '0');
INSERT INTO cities VALUES ('83', '6', 'Cuando Cubango', '0', '0');
INSERT INTO cities VALUES ('84', '6', 'Cuanza Norte', '0', '0');
INSERT INTO cities VALUES ('85', '6', 'Cuanza Sul', '0', '0');
INSERT INTO cities VALUES ('86', '6', 'Cunene', '0', '0');
INSERT INTO cities VALUES ('87', '6', 'Huambo', '0', '0');
INSERT INTO cities VALUES ('88', '6', 'Huila', '0', '0');
INSERT INTO cities VALUES ('89', '6', 'Malanje', '0', '0');
INSERT INTO cities VALUES ('90', '6', 'Namibe', '0', '0');
INSERT INTO cities VALUES ('91', '6', 'Moxico', '0', '0');
INSERT INTO cities VALUES ('92', '6', 'Uige', '0', '0');
INSERT INTO cities VALUES ('93', '6', 'Zaire', '0', '0');
INSERT INTO cities VALUES ('94', '6', 'Lunda Norte', '0', '0');
INSERT INTO cities VALUES ('95', '6', 'Lunda Sul', '0', '0');
INSERT INTO cities VALUES ('96', '6', 'Bengo', '0', '0');
INSERT INTO cities VALUES ('97', '6', 'Luanda', '0', '0');
INSERT INTO cities VALUES ('98', '10', 'Buenos Aires', '0', '0');
INSERT INTO cities VALUES ('99', '10', 'Catamarca', '0', '0');
INSERT INTO cities VALUES ('100', '10', 'Chaco', '0', '0');
INSERT INTO cities VALUES ('101', '10', 'Chubut', '0', '0');
INSERT INTO cities VALUES ('102', '10', 'Cordoba', '0', '0');
INSERT INTO cities VALUES ('103', '10', 'Corrientes', '0', '0');
INSERT INTO cities VALUES ('104', '10', 'Distrito Federal', '0', '0');
INSERT INTO cities VALUES ('105', '10', 'Entre Rios', '0', '0');
INSERT INTO cities VALUES ('106', '10', 'Formosa', '0', '0');
INSERT INTO cities VALUES ('107', '10', 'Jujuy', '0', '0');
INSERT INTO cities VALUES ('108', '10', 'La Pampa', '0', '0');
INSERT INTO cities VALUES ('109', '10', 'La Rioja', '0', '0');
INSERT INTO cities VALUES ('110', '10', 'Mendoza', '0', '0');
INSERT INTO cities VALUES ('111', '10', 'Misiones', '0', '0');
INSERT INTO cities VALUES ('112', '10', 'Neuquen', '0', '0');
INSERT INTO cities VALUES ('113', '10', 'Rio Negro', '0', '0');
INSERT INTO cities VALUES ('114', '10', 'Salta', '0', '0');
INSERT INTO cities VALUES ('115', '10', 'San Juan', '0', '0');
INSERT INTO cities VALUES ('116', '10', 'San Luis', '0', '0');
INSERT INTO cities VALUES ('117', '10', 'Santa Cruz', '0', '0');
INSERT INTO cities VALUES ('118', '10', 'Santa Fe', '0', '0');
INSERT INTO cities VALUES ('119', '10', 'Santiago del Estero', '0', '0');
INSERT INTO cities VALUES ('120', '10', 'Tierra del Fuego', '0', '0');
INSERT INTO cities VALUES ('121', '10', 'Tucuman', '0', '0');
INSERT INTO cities VALUES ('122', '14', 'Burgenland', '0', '0');
INSERT INTO cities VALUES ('123', '14', 'Karnten', '0', '0');
INSERT INTO cities VALUES ('124', '14', 'Niederosterreich', '0', '0');
INSERT INTO cities VALUES ('125', '14', 'Oberosterreich', '0', '0');
INSERT INTO cities VALUES ('126', '14', 'Salzburg', '0', '0');
INSERT INTO cities VALUES ('127', '14', 'Steiermark', '0', '0');
INSERT INTO cities VALUES ('128', '14', 'Tirol', '0', '0');
INSERT INTO cities VALUES ('129', '14', 'Vorarlberg', '0', '0');
INSERT INTO cities VALUES ('130', '14', 'Wien', '0', '0');
INSERT INTO cities VALUES ('131', '13', 'Australian Capital Territory', '0', '0');
INSERT INTO cities VALUES ('132', '13', 'New South Wales', '0', '0');
INSERT INTO cities VALUES ('133', '13', 'Northern Territory', '0', '0');
INSERT INTO cities VALUES ('134', '13', 'Queensland', '0', '0');
INSERT INTO cities VALUES ('135', '13', 'South Australia', '0', '0');
INSERT INTO cities VALUES ('136', '13', 'Tasmania', '0', '0');
INSERT INTO cities VALUES ('137', '13', 'Victoria', '28.7466', '-97.0165');
INSERT INTO cities VALUES ('138', '13', 'Western Australia', '0', '0');
INSERT INTO cities VALUES ('139', '15', 'Abseron', '0', '0');
INSERT INTO cities VALUES ('140', '15', 'Agcabadi', '0', '0');
INSERT INTO cities VALUES ('141', '15', 'Agdam', '0', '0');
INSERT INTO cities VALUES ('142', '15', 'Agdas', '0', '0');
INSERT INTO cities VALUES ('143', '15', 'Agstafa', '0', '0');
INSERT INTO cities VALUES ('144', '15', 'Agsu', '0', '0');
INSERT INTO cities VALUES ('145', '15', 'Ali Bayramli', '0', '0');
INSERT INTO cities VALUES ('146', '15', 'Astara', '0', '0');
INSERT INTO cities VALUES ('147', '15', 'Baki', '0', '0');
INSERT INTO cities VALUES ('148', '15', 'Balakan', '0', '0');
INSERT INTO cities VALUES ('149', '15', 'Barda', '0', '0');
INSERT INTO cities VALUES ('150', '15', 'Beylaqan', '0', '0');
INSERT INTO cities VALUES ('151', '15', 'Bilasuvar', '0', '0');
INSERT INTO cities VALUES ('152', '15', 'Cabrayil', '0', '0');
INSERT INTO cities VALUES ('153', '15', 'Calilabad', '0', '0');
INSERT INTO cities VALUES ('154', '15', 'Daskasan', '0', '0');
INSERT INTO cities VALUES ('155', '15', 'Davaci', '0', '0');
INSERT INTO cities VALUES ('156', '15', 'Fuzuli', '0', '0');
INSERT INTO cities VALUES ('157', '15', 'Gadabay', '0', '0');
INSERT INTO cities VALUES ('158', '15', 'Ganca', '0', '0');
INSERT INTO cities VALUES ('159', '15', 'Goranboy', '0', '0');
INSERT INTO cities VALUES ('160', '15', 'Goycay', '0', '0');
INSERT INTO cities VALUES ('161', '15', 'Haciqabul', '0', '0');
INSERT INTO cities VALUES ('162', '15', 'Imisli', '0', '0');
INSERT INTO cities VALUES ('163', '15', 'Ismayilli', '0', '0');
INSERT INTO cities VALUES ('164', '15', 'Kalbacar', '0', '0');
INSERT INTO cities VALUES ('165', '15', 'Kurdamir', '0', '0');
INSERT INTO cities VALUES ('166', '15', 'Lacin', '0', '0');
INSERT INTO cities VALUES ('167', '15', 'Lankaran', '0', '0');
INSERT INTO cities VALUES ('168', '15', 'Lankaran', '0', '0');
INSERT INTO cities VALUES ('169', '15', 'Lerik', '0', '0');
INSERT INTO cities VALUES ('170', '15', 'Masalli', '0', '0');
INSERT INTO cities VALUES ('171', '15', 'Mingacevir', '0', '0');
INSERT INTO cities VALUES ('172', '15', 'Naftalan', '0', '0');
INSERT INTO cities VALUES ('173', '15', 'Naxcivan', '0', '0');
INSERT INTO cities VALUES ('174', '15', 'Neftcala', '0', '0');
INSERT INTO cities VALUES ('175', '15', 'Oguz', '0', '0');
INSERT INTO cities VALUES ('176', '15', 'Qabala', '0', '0');
INSERT INTO cities VALUES ('177', '15', 'Qax', '0', '0');
INSERT INTO cities VALUES ('178', '15', 'Qazax', '0', '0');
INSERT INTO cities VALUES ('179', '15', 'Qobustan', '0', '0');
INSERT INTO cities VALUES ('180', '15', 'Quba', '0', '0');
INSERT INTO cities VALUES ('181', '15', 'Qubadli', '0', '0');
INSERT INTO cities VALUES ('182', '15', 'Qusar', '0', '0');
INSERT INTO cities VALUES ('183', '15', 'Saatli', '0', '0');
INSERT INTO cities VALUES ('184', '15', 'Sabirabad', '0', '0');
INSERT INTO cities VALUES ('185', '15', 'Saki', '0', '0');
INSERT INTO cities VALUES ('186', '15', 'Saki', '0', '0');
INSERT INTO cities VALUES ('187', '15', 'Salyan', '0', '0');
INSERT INTO cities VALUES ('188', '15', 'Samaxi', '0', '0');
INSERT INTO cities VALUES ('189', '15', 'Samkir', '0', '0');
INSERT INTO cities VALUES ('190', '15', 'Samux', '0', '0');
INSERT INTO cities VALUES ('191', '15', 'Siyazan', '0', '0');
INSERT INTO cities VALUES ('192', '15', 'Sumqayit', '0', '0');
INSERT INTO cities VALUES ('193', '15', 'Susa', '0', '0');
INSERT INTO cities VALUES ('194', '15', 'Susa', '0', '0');
INSERT INTO cities VALUES ('195', '15', 'Tartar', '0', '0');
INSERT INTO cities VALUES ('196', '15', 'Tovuz', '0', '0');
INSERT INTO cities VALUES ('197', '15', 'Ucar', '0', '0');
INSERT INTO cities VALUES ('198', '15', 'Xacmaz', '0', '0');
INSERT INTO cities VALUES ('199', '15', 'Xankandi', '0', '0');
INSERT INTO cities VALUES ('200', '15', 'Xanlar', '0', '0');
INSERT INTO cities VALUES ('201', '15', 'Xizi', '0', '0');
INSERT INTO cities VALUES ('202', '15', 'Xocali', '0', '0');
INSERT INTO cities VALUES ('203', '15', 'Xocavand', '0', '0');
INSERT INTO cities VALUES ('204', '15', 'Yardimli', '0', '0');
INSERT INTO cities VALUES ('205', '15', 'Yevlax', '0', '0');
INSERT INTO cities VALUES ('206', '15', 'Yevlax', '0', '0');
INSERT INTO cities VALUES ('207', '15', 'Zangilan', '0', '0');
INSERT INTO cities VALUES ('208', '15', 'Zaqatala', '0', '0');
INSERT INTO cities VALUES ('209', '15', 'Zardab', '0', '0');
INSERT INTO cities VALUES ('210', '27', 'Federation of Bosnia and Herzegovina', '0', '0');
INSERT INTO cities VALUES ('211', '27', 'Brcko District', '0', '0');
INSERT INTO cities VALUES ('212', '27', 'Republika Srpska', '0', '0');
INSERT INTO cities VALUES ('213', '19', 'Christ Church', '0', '0');
INSERT INTO cities VALUES ('214', '19', 'Saint Andrew', '0', '0');
INSERT INTO cities VALUES ('215', '19', 'Saint George', '0', '0');
INSERT INTO cities VALUES ('216', '19', 'Saint James', '0', '0');
INSERT INTO cities VALUES ('217', '19', 'Saint John', '0', '0');
INSERT INTO cities VALUES ('218', '19', 'Saint Joseph', '0', '0');
INSERT INTO cities VALUES ('219', '19', 'Saint Lucy', '0', '0');
INSERT INTO cities VALUES ('220', '19', 'Saint Michael', '0', '0');
INSERT INTO cities VALUES ('221', '19', 'Saint Peter', '0', '0');
INSERT INTO cities VALUES ('222', '19', 'Saint Philip', '0', '0');
INSERT INTO cities VALUES ('223', '19', 'Saint Thomas', '0', '0');
INSERT INTO cities VALUES ('224', '18', 'Dhaka', '0', '0');
INSERT INTO cities VALUES ('225', '18', 'Khulna', '0', '0');
INSERT INTO cities VALUES ('226', '18', 'Rajshahi', '0', '0');
INSERT INTO cities VALUES ('227', '18', 'Chittagong', '0', '0');
INSERT INTO cities VALUES ('228', '18', 'Barisal', '0', '0');
INSERT INTO cities VALUES ('229', '18', 'Sylhet', '0', '0');
INSERT INTO cities VALUES ('230', '21', 'Antwerpen', '0', '0');
INSERT INTO cities VALUES ('231', '21', 'Hainaut', '0', '0');
INSERT INTO cities VALUES ('232', '21', 'Liege', '0', '0');
INSERT INTO cities VALUES ('233', '21', 'Limburg', '0', '0');
INSERT INTO cities VALUES ('234', '21', 'Luxembourg', '0', '0');
INSERT INTO cities VALUES ('235', '21', 'Namur', '0', '0');
INSERT INTO cities VALUES ('236', '21', 'Oost-Vlaanderen', '0', '0');
INSERT INTO cities VALUES ('237', '21', 'West-Vlaanderen', '0', '0');
INSERT INTO cities VALUES ('238', '21', 'Brabant Wallon', '0', '0');
INSERT INTO cities VALUES ('239', '21', 'Brussels Hoofdstedelijk Gewest', '0', '0');
INSERT INTO cities VALUES ('240', '21', 'Vlaams-Brabant', '0', '0');
INSERT INTO cities VALUES ('241', '21', 'Flanders', '0', '0');
INSERT INTO cities VALUES ('242', '21', 'Wallonia', '0', '0');
INSERT INTO cities VALUES ('243', '34', 'Bam', '0', '0');
INSERT INTO cities VALUES ('244', '34', 'Boulkiemde', '0', '0');
INSERT INTO cities VALUES ('245', '34', 'Ganzourgou', '0', '0');
INSERT INTO cities VALUES ('246', '34', 'Gnagna', '0', '0');
INSERT INTO cities VALUES ('247', '34', 'Kouritenga', '0', '0');
INSERT INTO cities VALUES ('248', '34', 'Oudalan', '0', '0');
INSERT INTO cities VALUES ('249', '34', 'Passore', '0', '0');
INSERT INTO cities VALUES ('250', '34', 'Sanguie', '0', '0');
INSERT INTO cities VALUES ('251', '34', 'Soum', '0', '0');
INSERT INTO cities VALUES ('252', '34', 'Tapoa', '0', '0');
INSERT INTO cities VALUES ('253', '34', 'Zoundweogo', '0', '0');
INSERT INTO cities VALUES ('254', '34', 'Bale', '0', '0');
INSERT INTO cities VALUES ('255', '34', 'Banwa', '0', '0');
INSERT INTO cities VALUES ('256', '34', 'Bazega', '0', '0');
INSERT INTO cities VALUES ('257', '34', 'Bougouriba', '0', '0');
INSERT INTO cities VALUES ('258', '34', 'Boulgou', '0', '0');
INSERT INTO cities VALUES ('259', '34', 'Gourma', '0', '0');
INSERT INTO cities VALUES ('260', '34', 'Houet', '0', '0');
INSERT INTO cities VALUES ('261', '34', 'Ioba', '0', '0');
INSERT INTO cities VALUES ('262', '34', 'Kadiogo', '0', '0');
INSERT INTO cities VALUES ('263', '34', 'Kenedougou', '0', '0');
INSERT INTO cities VALUES ('264', '34', 'Komoe', '0', '0');
INSERT INTO cities VALUES ('265', '34', 'Komondjari', '0', '0');
INSERT INTO cities VALUES ('266', '34', 'Kompienga', '0', '0');
INSERT INTO cities VALUES ('267', '34', 'Kossi', '0', '0');
INSERT INTO cities VALUES ('268', '34', 'Koulpelogo', '0', '0');
INSERT INTO cities VALUES ('269', '34', 'Kourweogo', '0', '0');
INSERT INTO cities VALUES ('270', '34', 'Leraba', '0', '0');
INSERT INTO cities VALUES ('271', '34', 'Loroum', '0', '0');
INSERT INTO cities VALUES ('272', '34', 'Mouhoun', '0', '0');
INSERT INTO cities VALUES ('273', '34', 'Namentenga', '0', '0');
INSERT INTO cities VALUES ('274', '34', 'Naouri', '0', '0');
INSERT INTO cities VALUES ('275', '34', 'Nayala', '0', '0');
INSERT INTO cities VALUES ('276', '34', 'Noumbiel', '0', '0');
INSERT INTO cities VALUES ('277', '34', 'Oubritenga', '0', '0');
INSERT INTO cities VALUES ('278', '34', 'Poni', '0', '0');
INSERT INTO cities VALUES ('279', '34', 'Sanmatenga', '0', '0');
INSERT INTO cities VALUES ('280', '34', 'Seno', '0', '0');
INSERT INTO cities VALUES ('281', '34', 'Sissili', '0', '0');
INSERT INTO cities VALUES ('282', '34', 'Sourou', '0', '0');
INSERT INTO cities VALUES ('283', '34', 'Tuy', '0', '0');
INSERT INTO cities VALUES ('284', '34', 'Yagha', '0', '0');
INSERT INTO cities VALUES ('285', '34', 'Yatenga', '0', '0');
INSERT INTO cities VALUES ('286', '34', 'Ziro', '0', '0');
INSERT INTO cities VALUES ('287', '34', 'Zondoma', '0', '0');
INSERT INTO cities VALUES ('288', '33', 'Mikhaylovgrad', '0', '0');
INSERT INTO cities VALUES ('289', '33', 'Blagoevgrad', '0', '0');
INSERT INTO cities VALUES ('290', '33', 'Burgas', '0', '0');
INSERT INTO cities VALUES ('291', '33', 'Dobrich', '0', '0');
INSERT INTO cities VALUES ('292', '33', 'Gabrovo', '0', '0');
INSERT INTO cities VALUES ('293', '33', 'Grad Sofiya', '0', '0');
INSERT INTO cities VALUES ('294', '33', 'Khaskovo', '0', '0');
INSERT INTO cities VALUES ('295', '33', 'Kurdzhali', '0', '0');
INSERT INTO cities VALUES ('296', '33', 'Kyustendil', '0', '0');
INSERT INTO cities VALUES ('297', '33', 'Lovech', '0', '0');
INSERT INTO cities VALUES ('298', '33', 'Montana', '0', '0');
INSERT INTO cities VALUES ('299', '33', 'Pazardzhik', '0', '0');
INSERT INTO cities VALUES ('300', '33', 'Pernik', '0', '0');
INSERT INTO cities VALUES ('301', '33', 'Pleven', '0', '0');
INSERT INTO cities VALUES ('302', '33', 'Plovdiv', '0', '0');
INSERT INTO cities VALUES ('303', '33', 'Razgrad', '0', '0');
INSERT INTO cities VALUES ('304', '33', 'Ruse', '0', '0');
INSERT INTO cities VALUES ('305', '33', 'Shumen', '0', '0');
INSERT INTO cities VALUES ('306', '33', 'Silistra', '0', '0');
INSERT INTO cities VALUES ('307', '33', 'Sliven', '0', '0');
INSERT INTO cities VALUES ('308', '33', 'Smolyan', '0', '0');
INSERT INTO cities VALUES ('309', '33', 'Sofiya', '0', '0');
INSERT INTO cities VALUES ('310', '33', 'Stara Zagora', '0', '0');
INSERT INTO cities VALUES ('311', '33', 'Turgovishte', '0', '0');
INSERT INTO cities VALUES ('312', '33', 'Varna', '0', '0');
INSERT INTO cities VALUES ('313', '33', 'Veliko Turnovo', '0', '0');
INSERT INTO cities VALUES ('314', '33', 'Vidin', '0', '0');
INSERT INTO cities VALUES ('315', '33', 'Vratsa', '0', '0');
INSERT INTO cities VALUES ('316', '33', 'Yambol', '0', '0');
INSERT INTO cities VALUES ('317', '17', 'Al Hadd', '0', '0');
INSERT INTO cities VALUES ('318', '17', 'Al Manamah', '0', '0');
INSERT INTO cities VALUES ('319', '17', 'Jidd Hafs', '0', '0');
INSERT INTO cities VALUES ('320', '17', 'Sitrah', '0', '0');
INSERT INTO cities VALUES ('321', '17', 'Al Mintaqah al Gharbiyah', '0', '0');
INSERT INTO cities VALUES ('322', '17', 'Mintaqat Juzur Hawar', '0', '0');
INSERT INTO cities VALUES ('323', '17', 'Al Mintaqah ash Shamaliyah', '0', '0');
INSERT INTO cities VALUES ('324', '17', 'Al Mintaqah al Wusta', '0', '0');
INSERT INTO cities VALUES ('325', '17', 'Madinat', '0', '0');
INSERT INTO cities VALUES ('326', '17', 'Ar Rifa', '0', '0');
INSERT INTO cities VALUES ('327', '17', 'Madinat Hamad', '0', '0');
INSERT INTO cities VALUES ('328', '17', 'Al Muharraq', '0', '0');
INSERT INTO cities VALUES ('329', '17', 'Al Asimah', '0', '0');
INSERT INTO cities VALUES ('330', '17', 'Al Janubiyah', '0', '0');
INSERT INTO cities VALUES ('331', '17', 'Ash Shamaliyah', '0', '0');
INSERT INTO cities VALUES ('332', '17', 'Al Wusta', '0', '0');
INSERT INTO cities VALUES ('333', '35', 'Bujumbura', '0', '0');
INSERT INTO cities VALUES ('334', '35', 'Bubanza', '0', '0');
INSERT INTO cities VALUES ('335', '35', 'Bururi', '0', '0');
INSERT INTO cities VALUES ('336', '35', 'Cankuzo', '0', '0');
INSERT INTO cities VALUES ('337', '35', 'Cibitoke', '0', '0');
INSERT INTO cities VALUES ('338', '35', 'Gitega', '0', '0');
INSERT INTO cities VALUES ('339', '35', 'Karuzi', '0', '0');
INSERT INTO cities VALUES ('340', '35', 'Kayanza', '0', '0');
INSERT INTO cities VALUES ('341', '35', 'Kirundo', '0', '0');
INSERT INTO cities VALUES ('342', '35', 'Makamba', '0', '0');
INSERT INTO cities VALUES ('343', '35', 'Muyinga', '0', '0');
INSERT INTO cities VALUES ('344', '35', 'Ngozi', '0', '0');
INSERT INTO cities VALUES ('345', '35', 'Rutana', '0', '0');
INSERT INTO cities VALUES ('346', '35', 'Ruyigi', '0', '0');
INSERT INTO cities VALUES ('347', '35', 'Muramvya', '0', '0');
INSERT INTO cities VALUES ('348', '35', 'Mwaro', '0', '0');
INSERT INTO cities VALUES ('349', '23', 'Alibori', '0', '0');
INSERT INTO cities VALUES ('350', '23', 'Atakora', '0', '0');
INSERT INTO cities VALUES ('351', '23', 'Atlanyique', '0', '0');
INSERT INTO cities VALUES ('352', '23', 'Borgou', '0', '0');
INSERT INTO cities VALUES ('353', '23', 'Collines', '0', '0');
INSERT INTO cities VALUES ('354', '23', 'Kouffo', '0', '0');
INSERT INTO cities VALUES ('355', '23', 'Donga', '0', '0');
INSERT INTO cities VALUES ('356', '23', 'Littoral', '0', '0');
INSERT INTO cities VALUES ('357', '23', 'Mono', '0', '0');
INSERT INTO cities VALUES ('358', '23', 'Oueme', '0', '0');
INSERT INTO cities VALUES ('359', '23', 'Plateau', '0', '0');
INSERT INTO cities VALUES ('360', '23', 'Zou', '0', '0');
INSERT INTO cities VALUES ('361', '24', 'Devonshire', '0', '0');
INSERT INTO cities VALUES ('362', '24', 'Hamilton', '0', '0');
INSERT INTO cities VALUES ('363', '24', 'Hamilton', '0', '0');
INSERT INTO cities VALUES ('364', '24', 'Paget', '0', '0');
INSERT INTO cities VALUES ('365', '24', 'Pembroke', '0', '0');
INSERT INTO cities VALUES ('366', '24', 'Saint George', '0', '0');
INSERT INTO cities VALUES ('367', '24', 'Saint George\'s', '0', '0');
INSERT INTO cities VALUES ('368', '24', 'Sandys', '0', '0');
INSERT INTO cities VALUES ('369', '24', 'Smiths', '0', '0');
INSERT INTO cities VALUES ('370', '24', 'Southampton', '0', '0');
INSERT INTO cities VALUES ('371', '24', 'Warwick', '0', '0');
INSERT INTO cities VALUES ('372', '32', 'Alibori', '0', '0');
INSERT INTO cities VALUES ('373', '32', 'Belait', '0', '0');
INSERT INTO cities VALUES ('374', '32', 'Brunei and Muara', '0', '0');
INSERT INTO cities VALUES ('375', '32', 'Temburong', '0', '0');
INSERT INTO cities VALUES ('376', '32', 'Collines', '0', '0');
INSERT INTO cities VALUES ('377', '32', 'Kouffo', '0', '0');
INSERT INTO cities VALUES ('378', '32', 'Donga', '0', '0');
INSERT INTO cities VALUES ('379', '32', 'Littoral', '0', '0');
INSERT INTO cities VALUES ('380', '32', 'Tutong', '0', '0');
INSERT INTO cities VALUES ('381', '32', 'Oueme', '0', '0');
INSERT INTO cities VALUES ('382', '32', 'Plateau', '0', '0');
INSERT INTO cities VALUES ('383', '32', 'Zou', '0', '0');
INSERT INTO cities VALUES ('384', '26', 'Chuquisaca', '0', '0');
INSERT INTO cities VALUES ('385', '26', 'Cochabamba', '0', '0');
INSERT INTO cities VALUES ('386', '26', 'El Beni', '0', '0');
INSERT INTO cities VALUES ('387', '26', 'La Paz', '0', '0');
INSERT INTO cities VALUES ('388', '26', 'Oruro', '0', '0');
INSERT INTO cities VALUES ('389', '26', 'Pando', '0', '0');
INSERT INTO cities VALUES ('390', '26', 'Potosi', '0', '0');
INSERT INTO cities VALUES ('391', '26', 'Santa Cruz', '0', '0');
INSERT INTO cities VALUES ('392', '26', 'Tarija', '0', '0');
INSERT INTO cities VALUES ('393', '30', 'Acre', '0', '0');
INSERT INTO cities VALUES ('394', '30', 'Alagoas', '0', '0');
INSERT INTO cities VALUES ('395', '30', 'Amapa', '0', '0');
INSERT INTO cities VALUES ('396', '30', 'Amazonas', '0', '0');
INSERT INTO cities VALUES ('397', '30', 'Bahia', '0', '0');
INSERT INTO cities VALUES ('398', '30', 'Ceara', '0', '0');
INSERT INTO cities VALUES ('399', '30', 'Distrito Federal', '0', '0');
INSERT INTO cities VALUES ('400', '30', 'Espirito Santo', '0', '0');
INSERT INTO cities VALUES ('401', '30', 'Mato Grosso do Sul', '0', '0');
INSERT INTO cities VALUES ('402', '30', 'Maranhao', '0', '0');
INSERT INTO cities VALUES ('403', '30', 'Mato Grosso', '0', '0');
INSERT INTO cities VALUES ('404', '30', 'Minas Gerais', '0', '0');
INSERT INTO cities VALUES ('405', '30', 'Para', '0', '0');
INSERT INTO cities VALUES ('406', '30', 'Paraiba', '0', '0');
INSERT INTO cities VALUES ('407', '30', 'Parana', '0', '0');
INSERT INTO cities VALUES ('408', '30', 'Piaui', '0', '0');
INSERT INTO cities VALUES ('409', '30', 'Rio de Janeiro', '0', '0');
INSERT INTO cities VALUES ('410', '30', 'Rio Grande do Norte', '0', '0');
INSERT INTO cities VALUES ('411', '30', 'Rio Grande do Sul', '0', '0');
INSERT INTO cities VALUES ('412', '30', 'Rondonia', '0', '0');
INSERT INTO cities VALUES ('413', '30', 'Roraima', '0', '0');
INSERT INTO cities VALUES ('414', '30', 'Santa Catarina', '0', '0');
INSERT INTO cities VALUES ('415', '30', 'Sao Paulo', '0', '0');
INSERT INTO cities VALUES ('416', '30', 'Sergipe', '0', '0');
INSERT INTO cities VALUES ('417', '30', 'Goias', '0', '0');
INSERT INTO cities VALUES ('418', '30', 'Pernambuco', '0', '0');
INSERT INTO cities VALUES ('419', '30', 'Tocantins', '0', '0');
INSERT INTO cities VALUES ('420', '16', 'Bimini', '0', '0');
INSERT INTO cities VALUES ('421', '16', 'Cat Island', '0', '0');
INSERT INTO cities VALUES ('422', '16', 'Exuma', '0', '0');
INSERT INTO cities VALUES ('423', '16', 'Inagua', '0', '0');
INSERT INTO cities VALUES ('424', '16', 'Long Island', '0', '0');
INSERT INTO cities VALUES ('425', '16', 'Mayaguana', '0', '0');
INSERT INTO cities VALUES ('426', '16', 'Ragged Island', '0', '0');
INSERT INTO cities VALUES ('427', '16', 'Harbour Island', '0', '0');
INSERT INTO cities VALUES ('428', '16', 'New Providence', '0', '0');
INSERT INTO cities VALUES ('429', '16', 'Acklins and Crooked Islands', '0', '0');
INSERT INTO cities VALUES ('430', '16', 'Freeport', '0', '0');
INSERT INTO cities VALUES ('431', '16', 'Fresh Creek', '0', '0');
INSERT INTO cities VALUES ('432', '16', 'Governor\'s Harbour', '0', '0');
INSERT INTO cities VALUES ('433', '16', 'Green Turtle Cay', '0', '0');
INSERT INTO cities VALUES ('434', '16', 'High Rock', '0', '0');
INSERT INTO cities VALUES ('435', '16', 'Kemps Bay', '0', '0');
INSERT INTO cities VALUES ('436', '16', 'Marsh Harbour', '0', '0');
INSERT INTO cities VALUES ('437', '16', 'Nichollstown and Berry Islands', '0', '0');
INSERT INTO cities VALUES ('438', '16', 'Rock Sound', '0', '0');
INSERT INTO cities VALUES ('439', '16', 'Sandy Point', '0', '0');
INSERT INTO cities VALUES ('440', '16', 'San Salvador and Rum Cay', '0', '0');
INSERT INTO cities VALUES ('441', '25', 'Bumthang', '0', '0');
INSERT INTO cities VALUES ('442', '25', 'Chhukha', '0', '0');
INSERT INTO cities VALUES ('443', '25', 'Chirang', '0', '0');
INSERT INTO cities VALUES ('444', '25', 'Daga', '0', '0');
INSERT INTO cities VALUES ('445', '25', 'Geylegphug', '0', '0');
INSERT INTO cities VALUES ('446', '25', 'Ha', '0', '0');
INSERT INTO cities VALUES ('447', '25', 'Lhuntshi', '0', '0');
INSERT INTO cities VALUES ('448', '25', 'Mongar', '0', '0');
INSERT INTO cities VALUES ('449', '25', 'Paro', '0', '0');
INSERT INTO cities VALUES ('450', '25', 'Pemagatsel', '0', '0');
INSERT INTO cities VALUES ('451', '25', 'Punakha', '0', '0');
INSERT INTO cities VALUES ('452', '25', 'Samchi', '0', '0');
INSERT INTO cities VALUES ('453', '25', 'Samdrup', '0', '0');
INSERT INTO cities VALUES ('454', '25', 'Shemgang', '0', '0');
INSERT INTO cities VALUES ('455', '25', 'Tashigang', '0', '0');
INSERT INTO cities VALUES ('456', '25', 'Thimphu', '0', '0');
INSERT INTO cities VALUES ('457', '25', 'Tongsa', '0', '0');
INSERT INTO cities VALUES ('458', '25', 'Wangdi Phodrang', '0', '0');
INSERT INTO cities VALUES ('459', '28', 'Central', '0', '0');
INSERT INTO cities VALUES ('460', '28', 'Ghanzi', '0', '0');
INSERT INTO cities VALUES ('461', '28', 'Kgalagadi', '0', '0');
INSERT INTO cities VALUES ('462', '28', 'Kgatleng', '0', '0');
INSERT INTO cities VALUES ('463', '28', 'Kweneng', '0', '0');
INSERT INTO cities VALUES ('464', '28', 'North-East', '0', '0');
INSERT INTO cities VALUES ('465', '28', 'South-East', '0', '0');
INSERT INTO cities VALUES ('466', '28', 'Southern', '0', '0');
INSERT INTO cities VALUES ('467', '28', 'North-West', '0', '0');
INSERT INTO cities VALUES ('468', '20', 'Brestskaya Voblasts\'', '0', '0');
INSERT INTO cities VALUES ('469', '20', 'Homyel\'skaya Voblasts\'', '0', '0');
INSERT INTO cities VALUES ('470', '20', 'Hrodzyenskaya Voblasts\'', '0', '0');
INSERT INTO cities VALUES ('471', '20', 'Minsk', '0', '0');
INSERT INTO cities VALUES ('472', '20', 'Minskaya Voblasts\'', '0', '0');
INSERT INTO cities VALUES ('473', '20', 'Mahilyowskaya Voblasts\'', '0', '0');
INSERT INTO cities VALUES ('474', '20', 'Vitsyebskaya Voblasts\'', '0', '0');
INSERT INTO cities VALUES ('475', '22', 'Belize', '0', '0');
INSERT INTO cities VALUES ('476', '22', 'Cayo', '0', '0');
INSERT INTO cities VALUES ('477', '22', 'Corozal', '0', '0');
INSERT INTO cities VALUES ('478', '22', 'Orange Walk', '0', '0');
INSERT INTO cities VALUES ('479', '22', 'Stann Creek', '0', '0');
INSERT INTO cities VALUES ('480', '22', 'Toledo', '0', '0');
INSERT INTO cities VALUES ('481', '38', 'Alberta', '0', '0');
INSERT INTO cities VALUES ('482', '38', 'British Columbia', '0', '0');
INSERT INTO cities VALUES ('483', '38', 'Manitoba', '0', '0');
INSERT INTO cities VALUES ('484', '38', 'New Brunswick', '0', '0');
INSERT INTO cities VALUES ('485', '38', 'Newfoundland', '0', '0');
INSERT INTO cities VALUES ('486', '38', 'Nova Scotia', '0', '0');
INSERT INTO cities VALUES ('487', '38', 'Northwest Territories', '0', '0');
INSERT INTO cities VALUES ('488', '38', 'Nunavut', '0', '0');
INSERT INTO cities VALUES ('489', '38', 'Ontario', '0', '0');
INSERT INTO cities VALUES ('490', '38', 'Prince Edward Island', '0', '0');
INSERT INTO cities VALUES ('491', '38', 'Quebec', '0', '0');
INSERT INTO cities VALUES ('492', '38', 'Saskatchewan', '0', '0');
INSERT INTO cities VALUES ('493', '38', 'Yukon Territory', '0', '0');
INSERT INTO cities VALUES ('504', '41', 'Bamingui-Bangoran', '0', '0');
INSERT INTO cities VALUES ('505', '41', 'Basse-Kotto', '0', '0');
INSERT INTO cities VALUES ('506', '41', 'Haute-Kotto', '0', '0');
INSERT INTO cities VALUES ('507', '41', 'Mambere-Kadei', '0', '0');
INSERT INTO cities VALUES ('508', '41', 'Haut-Mbomou', '0', '0');
INSERT INTO cities VALUES ('509', '41', 'Kemo', '0', '0');
INSERT INTO cities VALUES ('510', '41', 'Lobaye', '0', '0');
INSERT INTO cities VALUES ('511', '41', 'Mbomou', '0', '0');
INSERT INTO cities VALUES ('512', '41', 'Nana-Mambere', '0', '0');
INSERT INTO cities VALUES ('513', '41', 'Ouaka', '0', '0');
INSERT INTO cities VALUES ('514', '41', 'Ouham', '0', '0');
INSERT INTO cities VALUES ('515', '41', 'Ouham-Pende', '0', '0');
INSERT INTO cities VALUES ('516', '41', 'Cuvette-Ouest', '0', '0');
INSERT INTO cities VALUES ('517', '41', 'Nana-Grebizi', '0', '0');
INSERT INTO cities VALUES ('518', '41', 'Sangha-Mbaere', '0', '0');
INSERT INTO cities VALUES ('519', '41', 'Ombella-Mpoko', '0', '0');
INSERT INTO cities VALUES ('520', '41', 'Bangui', '0', '0');
INSERT INTO cities VALUES ('521', '49', 'Bouenza', '0', '0');
INSERT INTO cities VALUES ('522', '49', 'Kouilou', '0', '0');
INSERT INTO cities VALUES ('523', '49', 'Lekoumou', '0', '0');
INSERT INTO cities VALUES ('524', '49', 'Likouala', '0', '0');
INSERT INTO cities VALUES ('525', '49', 'Niari', '0', '0');
INSERT INTO cities VALUES ('526', '49', 'Plateaux', '0', '0');
INSERT INTO cities VALUES ('527', '49', 'Sangha', '0', '0');
INSERT INTO cities VALUES ('528', '49', 'Pool', '0', '0');
INSERT INTO cities VALUES ('529', '49', 'Brazzaville', '0', '0');
INSERT INTO cities VALUES ('530', '49', 'Cuvette', '0', '0');
INSERT INTO cities VALUES ('531', '49', 'Cuvette-Ouest', '0', '0');
INSERT INTO cities VALUES ('532', '204', 'Aargau', '0', '0');
INSERT INTO cities VALUES ('533', '204', 'Ausser-Rhoden', '0', '0');
INSERT INTO cities VALUES ('534', '204', 'Basel-Landschaft', '0', '0');
INSERT INTO cities VALUES ('535', '204', 'Basel-Stadt', '0', '0');
INSERT INTO cities VALUES ('536', '204', 'Bern', '0', '0');
INSERT INTO cities VALUES ('537', '204', 'Fribourg', '0', '0');
INSERT INTO cities VALUES ('538', '204', 'Geneve', '0', '0');
INSERT INTO cities VALUES ('539', '204', 'Glarus', '0', '0');
INSERT INTO cities VALUES ('540', '204', 'Graubunden', '0', '0');
INSERT INTO cities VALUES ('541', '204', 'Inner-Rhoden', '0', '0');
INSERT INTO cities VALUES ('542', '204', 'Luzern', '0', '0');
INSERT INTO cities VALUES ('543', '204', 'Neuchatel', '0', '0');
INSERT INTO cities VALUES ('544', '204', 'Nidwalden', '0', '0');
INSERT INTO cities VALUES ('545', '204', 'Obwalden', '0', '0');
INSERT INTO cities VALUES ('546', '204', 'Sankt Gallen', '0', '0');
INSERT INTO cities VALUES ('547', '204', 'Schaffhausen', '0', '0');
INSERT INTO cities VALUES ('548', '204', 'Schwyz', '0', '0');
INSERT INTO cities VALUES ('549', '204', 'Solothurn', '0', '0');
INSERT INTO cities VALUES ('550', '204', 'Thurgau', '0', '0');
INSERT INTO cities VALUES ('551', '204', 'Ticino', '0', '0');
INSERT INTO cities VALUES ('552', '204', 'Uri', '0', '0');
INSERT INTO cities VALUES ('553', '204', 'Valais', '0', '0');
INSERT INTO cities VALUES ('554', '204', 'Vaud', '0', '0');
INSERT INTO cities VALUES ('555', '204', 'Zug', '0', '0');
INSERT INTO cities VALUES ('556', '204', 'Zurich', '0', '0');
INSERT INTO cities VALUES ('557', '204', 'Jura', '0', '0');
INSERT INTO cities VALUES ('558', '52', 'Agneby', '0', '0');
INSERT INTO cities VALUES ('559', '52', 'Bafing', '0', '0');
INSERT INTO cities VALUES ('560', '52', 'Bas-Sassandra', '0', '0');
INSERT INTO cities VALUES ('561', '52', 'Denguele', '0', '0');
INSERT INTO cities VALUES ('562', '52', 'Dix-Huit Montagnes', '0', '0');
INSERT INTO cities VALUES ('563', '52', 'Fromager', '0', '0');
INSERT INTO cities VALUES ('564', '52', 'Haut-Sassandra', '0', '0');
INSERT INTO cities VALUES ('565', '52', 'Lacs', '0', '0');
INSERT INTO cities VALUES ('566', '52', 'Lagunes', '0', '0');
INSERT INTO cities VALUES ('567', '52', 'Marahoue', '0', '0');
INSERT INTO cities VALUES ('568', '52', 'Moyen-Cavally', '0', '0');
INSERT INTO cities VALUES ('569', '52', 'Moyen-Comoe', '0', '0');
INSERT INTO cities VALUES ('570', '52', 'N\'zi-Comoe', '0', '0');
INSERT INTO cities VALUES ('571', '52', 'Savanes', '0', '0');
INSERT INTO cities VALUES ('572', '52', 'Sud-Bandama', '0', '0');
INSERT INTO cities VALUES ('573', '52', 'Sud-Comoe', '0', '0');
INSERT INTO cities VALUES ('574', '52', 'Vallee du Bandama', '0', '0');
INSERT INTO cities VALUES ('575', '52', 'Worodougou', '0', '0');
INSERT INTO cities VALUES ('576', '52', 'Zanzan', '0', '0');
INSERT INTO cities VALUES ('577', '43', 'Valparaiso', '0', '0');
INSERT INTO cities VALUES ('578', '43', 'Aisen del General Carlos Ibanez del Campo', '0', '0');
INSERT INTO cities VALUES ('579', '43', 'Antofagasta', '0', '0');
INSERT INTO cities VALUES ('580', '43', 'Araucania', '0', '0');
INSERT INTO cities VALUES ('581', '43', 'Atacama', '0', '0');
INSERT INTO cities VALUES ('582', '43', 'Bio-Bio', '0', '0');
INSERT INTO cities VALUES ('583', '43', 'Coquimbo', '0', '0');
INSERT INTO cities VALUES ('584', '43', 'Libertador General Bernardo O\'Higgins', '0', '0');
INSERT INTO cities VALUES ('585', '43', 'Los Lagos', '0', '0');
INSERT INTO cities VALUES ('586', '43', 'Magallanes y de la Antartica Chilena', '0', '0');
INSERT INTO cities VALUES ('587', '43', 'Maule', '0', '0');
INSERT INTO cities VALUES ('588', '43', 'Region Metropolitana', '0', '0');
INSERT INTO cities VALUES ('589', '43', 'Tarapaca', '0', '0');
INSERT INTO cities VALUES ('590', '43', 'Los Lagos', '0', '0');
INSERT INTO cities VALUES ('591', '43', 'Tarapaca', '0', '0');
INSERT INTO cities VALUES ('592', '43', 'Arica y Parinacota', '0', '0');
INSERT INTO cities VALUES ('593', '43', 'Los Rios', '0', '0');
INSERT INTO cities VALUES ('594', '37', 'Est', '0', '0');
INSERT INTO cities VALUES ('595', '37', 'Littoral', '0', '0');
INSERT INTO cities VALUES ('596', '37', 'Nord-Ouest', '0', '0');
INSERT INTO cities VALUES ('597', '37', 'Ouest', '0', '0');
INSERT INTO cities VALUES ('598', '37', 'Sud-Ouest', '0', '0');
INSERT INTO cities VALUES ('599', '37', 'Adamaoua', '0', '0');
INSERT INTO cities VALUES ('600', '37', 'Centre', '0', '0');
INSERT INTO cities VALUES ('601', '37', 'Extreme-Nord', '0', '0');
INSERT INTO cities VALUES ('602', '37', 'Nord', '0', '0');
INSERT INTO cities VALUES ('603', '37', 'Sud', '0', '0');
INSERT INTO cities VALUES ('604', '44', 'Anhui', '0', '0');
INSERT INTO cities VALUES ('605', '44', 'Zhejiang', '0', '0');
INSERT INTO cities VALUES ('606', '44', 'Jiangxi', '0', '0');
INSERT INTO cities VALUES ('607', '44', 'Jiangsu', '0', '0');
INSERT INTO cities VALUES ('608', '44', 'Jilin', '0', '0');
INSERT INTO cities VALUES ('609', '44', 'Qinghai', '0', '0');
INSERT INTO cities VALUES ('610', '44', 'Fujian', '0', '0');
INSERT INTO cities VALUES ('611', '44', 'Heilongjiang', '0', '0');
INSERT INTO cities VALUES ('612', '44', 'Henan', '0', '0');
INSERT INTO cities VALUES ('613', '44', 'Hebei', '0', '0');
INSERT INTO cities VALUES ('614', '44', 'Hunan', '0', '0');
INSERT INTO cities VALUES ('615', '44', 'Hubei', '0', '0');
INSERT INTO cities VALUES ('616', '44', 'Xinjiang', '0', '0');
INSERT INTO cities VALUES ('617', '44', 'Xizang', '0', '0');
INSERT INTO cities VALUES ('618', '44', 'Gansu', '0', '0');
INSERT INTO cities VALUES ('619', '44', 'Guangxi', '0', '0');
INSERT INTO cities VALUES ('620', '44', 'Guizhou', '0', '0');
INSERT INTO cities VALUES ('621', '44', 'Liaoning', '0', '0');
INSERT INTO cities VALUES ('622', '44', 'Nei Mongol', '0', '0');
INSERT INTO cities VALUES ('623', '44', 'Ningxia', '0', '0');
INSERT INTO cities VALUES ('624', '44', 'Beijing', '0', '0');
INSERT INTO cities VALUES ('625', '44', 'Shanghai', '0', '0');
INSERT INTO cities VALUES ('626', '44', 'Shanxi', '0', '0');
INSERT INTO cities VALUES ('627', '44', 'Shandong', '0', '0');
INSERT INTO cities VALUES ('628', '44', 'Shaanxi', '0', '0');
INSERT INTO cities VALUES ('629', '44', 'Tianjin', '0', '0');
INSERT INTO cities VALUES ('630', '44', 'Yunnan', '0', '0');
INSERT INTO cities VALUES ('631', '44', 'Guangdong', '0', '0');
INSERT INTO cities VALUES ('632', '44', 'Hainan', '0', '0');
INSERT INTO cities VALUES ('633', '44', 'Sichuan', '0', '0');
INSERT INTO cities VALUES ('634', '44', 'Chongqing', '0', '0');
INSERT INTO cities VALUES ('635', '47', 'Amazonas', '0', '0');
INSERT INTO cities VALUES ('636', '47', 'Antioquia', '0', '0');
INSERT INTO cities VALUES ('637', '47', 'Arauca', '0', '0');
INSERT INTO cities VALUES ('638', '47', 'Atlantico', '0', '0');
INSERT INTO cities VALUES ('639', '47', 'Caqueta', '0', '0');
INSERT INTO cities VALUES ('640', '47', 'Cauca', '0', '0');
INSERT INTO cities VALUES ('641', '47', 'Cesar', '0', '0');
INSERT INTO cities VALUES ('642', '47', 'Choco', '0', '0');
INSERT INTO cities VALUES ('643', '47', 'Cordoba', '0', '0');
INSERT INTO cities VALUES ('644', '47', 'Guaviare', '0', '0');
INSERT INTO cities VALUES ('645', '47', 'Guainia', '0', '0');
INSERT INTO cities VALUES ('646', '47', 'Huila', '0', '0');
INSERT INTO cities VALUES ('647', '47', 'La Guajira', '0', '0');
INSERT INTO cities VALUES ('648', '47', 'Meta', '0', '0');
INSERT INTO cities VALUES ('649', '47', 'Narino', '0', '0');
INSERT INTO cities VALUES ('650', '47', 'Norte de Santander', '0', '0');
INSERT INTO cities VALUES ('651', '47', 'Putumayo', '0', '0');
INSERT INTO cities VALUES ('652', '47', 'Quindio', '0', '0');
INSERT INTO cities VALUES ('653', '47', 'Risaralda', '0', '0');
INSERT INTO cities VALUES ('654', '47', 'San Andres y Providencia', '0', '0');
INSERT INTO cities VALUES ('655', '47', 'Santander', '0', '0');
INSERT INTO cities VALUES ('656', '47', 'Sucre', '0', '0');
INSERT INTO cities VALUES ('657', '47', 'Tolima', '0', '0');
INSERT INTO cities VALUES ('658', '47', 'Valle del Cauca', '0', '0');
INSERT INTO cities VALUES ('659', '47', 'Vaupes', '0', '0');
INSERT INTO cities VALUES ('660', '47', 'Vichada', '0', '0');
INSERT INTO cities VALUES ('661', '47', 'Casanare', '0', '0');
INSERT INTO cities VALUES ('662', '47', 'Cundinamarca', '0', '0');
INSERT INTO cities VALUES ('663', '47', 'Distrito Especial', '0', '0');
INSERT INTO cities VALUES ('664', '47', 'Bolivar', '0', '0');
INSERT INTO cities VALUES ('665', '47', 'Boyaca', '0', '0');
INSERT INTO cities VALUES ('666', '47', 'Caldas', '0', '0');
INSERT INTO cities VALUES ('667', '47', 'Magdalena', '0', '0');
INSERT INTO cities VALUES ('668', '51', 'Alajuela', '0', '0');
INSERT INTO cities VALUES ('669', '51', 'Cartago', '0', '0');
INSERT INTO cities VALUES ('670', '51', 'Guanacaste', '0', '0');
INSERT INTO cities VALUES ('671', '51', 'Heredia', '0', '0');
INSERT INTO cities VALUES ('672', '51', 'Limon', '0', '0');
INSERT INTO cities VALUES ('673', '51', 'Puntarenas', '0', '0');
INSERT INTO cities VALUES ('674', '51', 'San Jose', '0', '0');
INSERT INTO cities VALUES ('675', '54', 'Pinar del Rio', '0', '0');
INSERT INTO cities VALUES ('676', '54', 'Ciudad de la Habana', '0', '0');
INSERT INTO cities VALUES ('677', '54', 'Matanzas', '0', '0');
INSERT INTO cities VALUES ('678', '54', 'Isla de la Juventud', '0', '0');
INSERT INTO cities VALUES ('679', '54', 'Camaguey', '0', '0');
INSERT INTO cities VALUES ('680', '54', 'Ciego de Avila', '0', '0');
INSERT INTO cities VALUES ('681', '54', 'Cienfuegos', '0', '0');
INSERT INTO cities VALUES ('682', '54', 'Granma', '0', '0');
INSERT INTO cities VALUES ('683', '54', 'Guantanamo', '0', '0');
INSERT INTO cities VALUES ('684', '54', 'La Habana', '0', '0');
INSERT INTO cities VALUES ('685', '54', 'Holguin', '0', '0');
INSERT INTO cities VALUES ('686', '54', 'Las Tunas', '0', '0');
INSERT INTO cities VALUES ('687', '54', 'Sancti Spiritus', '0', '0');
INSERT INTO cities VALUES ('688', '54', 'Santiago de Cuba', '0', '0');
INSERT INTO cities VALUES ('689', '54', 'Villa Clara', '0', '0');
INSERT INTO cities VALUES ('690', '39', 'Boa Vista', '0', '0');
INSERT INTO cities VALUES ('691', '39', 'Brava', '0', '0');
INSERT INTO cities VALUES ('692', '39', 'Maio', '0', '0');
INSERT INTO cities VALUES ('693', '39', 'Paul', '0', '0');
INSERT INTO cities VALUES ('694', '39', 'Ribeira Grande', '0', '0');
INSERT INTO cities VALUES ('695', '39', 'Sal', '0', '0');
INSERT INTO cities VALUES ('696', '39', 'Sao Nicolau', '0', '0');
INSERT INTO cities VALUES ('697', '39', 'Sao Vicente', '0', '0');
INSERT INTO cities VALUES ('698', '39', 'Mosteiros', '0', '0');
INSERT INTO cities VALUES ('699', '39', 'Praia', '0', '0');
INSERT INTO cities VALUES ('700', '39', 'Santa Catarina', '0', '0');
INSERT INTO cities VALUES ('701', '39', 'Santa Cruz', '0', '0');
INSERT INTO cities VALUES ('702', '39', 'Sao Domingos', '0', '0');
INSERT INTO cities VALUES ('703', '39', 'Sao Filipe', '0', '0');
INSERT INTO cities VALUES ('704', '39', 'Sao Miguel', '0', '0');
INSERT INTO cities VALUES ('705', '39', 'Tarrafal', '0', '0');
INSERT INTO cities VALUES ('706', '55', 'Famagusta', '0', '0');
INSERT INTO cities VALUES ('707', '55', 'Kyrenia', '0', '0');
INSERT INTO cities VALUES ('708', '55', 'Larnaca', '0', '0');
INSERT INTO cities VALUES ('709', '55', 'Nicosia', '0', '0');
INSERT INTO cities VALUES ('710', '55', 'Limassol', '0', '0');
INSERT INTO cities VALUES ('711', '55', 'Paphos', '0', '0');
INSERT INTO cities VALUES ('712', '56', 'Hlavni mesto Praha', '0', '0');
INSERT INTO cities VALUES ('713', '56', 'Jihomoravsky kraj', '0', '0');
INSERT INTO cities VALUES ('714', '56', 'Jihocesky kraj', '0', '0');
INSERT INTO cities VALUES ('715', '56', 'Vysocina', '0', '0');
INSERT INTO cities VALUES ('716', '56', 'Karlovarsky kraj', '0', '0');
INSERT INTO cities VALUES ('717', '56', 'Kralovehradecky kraj', '0', '0');
INSERT INTO cities VALUES ('718', '56', 'Liberecky kraj', '0', '0');
INSERT INTO cities VALUES ('719', '56', 'Olomoucky kraj', '0', '0');
INSERT INTO cities VALUES ('720', '56', 'Moravskoslezsky kraj', '0', '0');
INSERT INTO cities VALUES ('721', '56', 'Pardubicky kraj', '0', '0');
INSERT INTO cities VALUES ('722', '56', 'Plzensky kraj', '0', '0');
INSERT INTO cities VALUES ('723', '56', 'Stredocesky kraj', '0', '0');
INSERT INTO cities VALUES ('724', '56', 'Ustecky kraj', '0', '0');
INSERT INTO cities VALUES ('725', '56', 'Zlinsky kraj', '0', '0');
INSERT INTO cities VALUES ('726', '81', 'Baden-Wurttemberg', '0', '0');
INSERT INTO cities VALUES ('727', '81', 'Bayern', '0', '0');
INSERT INTO cities VALUES ('728', '81', 'Bremen', '0', '0');
INSERT INTO cities VALUES ('729', '81', 'Hamburg', '0', '0');
INSERT INTO cities VALUES ('730', '81', 'Hessen', '0', '0');
INSERT INTO cities VALUES ('731', '81', 'Niedersachsen', '0', '0');
INSERT INTO cities VALUES ('732', '81', 'Nordrhein-Westfalen', '0', '0');
INSERT INTO cities VALUES ('733', '81', 'Rheinland-Pfalz', '0', '0');
INSERT INTO cities VALUES ('734', '81', 'Saarland', '0', '0');
INSERT INTO cities VALUES ('735', '81', 'Schleswig-Holstein', '0', '0');
INSERT INTO cities VALUES ('736', '81', 'Brandenburg', '0', '0');
INSERT INTO cities VALUES ('737', '81', 'Mecklenburg-Vorpommern', '0', '0');
INSERT INTO cities VALUES ('738', '81', 'Sachsen', '0', '0');
INSERT INTO cities VALUES ('739', '81', 'Sachsen-Anhalt', '0', '0');
INSERT INTO cities VALUES ('740', '81', 'Thuringen', '0', '0');
INSERT INTO cities VALUES ('741', '81', 'Berlin', '0', '0');
INSERT INTO cities VALUES ('742', '58', 'Ali Sabieh', '0', '0');
INSERT INTO cities VALUES ('743', '58', 'Obock', '0', '0');
INSERT INTO cities VALUES ('744', '58', 'Tadjoura', '0', '0');
INSERT INTO cities VALUES ('745', '58', 'Dikhil', '0', '0');
INSERT INTO cities VALUES ('746', '58', 'Djibouti', '0', '0');
INSERT INTO cities VALUES ('747', '58', 'Arta', '0', '0');
INSERT INTO cities VALUES ('748', '57', 'Hovedstaden', '0', '0');
INSERT INTO cities VALUES ('749', '57', 'Midtjylland', '0', '0');
INSERT INTO cities VALUES ('750', '57', 'Nordjylland', '0', '0');
INSERT INTO cities VALUES ('751', '57', 'Sjelland', '0', '0');
INSERT INTO cities VALUES ('752', '57', 'Syddanmark', '0', '0');
INSERT INTO cities VALUES ('753', '59', 'Saint Andrew', '0', '0');
INSERT INTO cities VALUES ('754', '59', 'Saint David', '0', '0');
INSERT INTO cities VALUES ('755', '59', 'Saint George', '0', '0');
INSERT INTO cities VALUES ('756', '59', 'Saint John', '0', '0');
INSERT INTO cities VALUES ('757', '59', 'Saint Joseph', '0', '0');
INSERT INTO cities VALUES ('758', '59', 'Saint Luke', '0', '0');
INSERT INTO cities VALUES ('759', '59', 'Saint Mark', '0', '0');
INSERT INTO cities VALUES ('760', '59', 'Saint Patrick', '0', '0');
INSERT INTO cities VALUES ('761', '59', 'Saint Paul', '0', '0');
INSERT INTO cities VALUES ('762', '59', 'Saint Peter', '0', '0');
INSERT INTO cities VALUES ('763', '60', 'Azua', '0', '0');
INSERT INTO cities VALUES ('764', '60', 'Baoruco', '0', '0');
INSERT INTO cities VALUES ('765', '60', 'Barahona', '0', '0');
INSERT INTO cities VALUES ('766', '60', 'Dajabon', '0', '0');
INSERT INTO cities VALUES ('767', '60', 'Distrito Nacional', '0', '0');
INSERT INTO cities VALUES ('768', '60', 'Duarte', '0', '0');
INSERT INTO cities VALUES ('769', '60', 'Espaillat', '0', '0');
INSERT INTO cities VALUES ('770', '60', 'Independencia', '0', '0');
INSERT INTO cities VALUES ('771', '60', 'La Altagracia', '0', '0');
INSERT INTO cities VALUES ('772', '60', 'Elias Pina', '0', '0');
INSERT INTO cities VALUES ('773', '60', 'La Romana', '0', '0');
INSERT INTO cities VALUES ('774', '60', 'Maria Trinidad Sanchez', '0', '0');
INSERT INTO cities VALUES ('775', '60', 'Monte Cristi', '0', '0');
INSERT INTO cities VALUES ('776', '60', 'Pedernales', '0', '0');
INSERT INTO cities VALUES ('777', '60', 'Peravia', '0', '0');
INSERT INTO cities VALUES ('778', '60', 'Puerto Plata', '0', '0');
INSERT INTO cities VALUES ('779', '60', 'Salcedo', '0', '0');
INSERT INTO cities VALUES ('780', '60', 'Samana', '0', '0');
INSERT INTO cities VALUES ('781', '60', 'Sanchez Ramirez', '0', '0');
INSERT INTO cities VALUES ('782', '60', 'San Juan', '0', '0');
INSERT INTO cities VALUES ('783', '60', 'San Pedro De Macoris', '0', '0');
INSERT INTO cities VALUES ('784', '60', 'Santiago', '0', '0');
INSERT INTO cities VALUES ('785', '60', 'Santiago Rodriguez', '0', '0');
INSERT INTO cities VALUES ('786', '60', 'Valverde', '0', '0');
INSERT INTO cities VALUES ('787', '60', 'El Seibo', '0', '0');
INSERT INTO cities VALUES ('788', '60', 'Hato Mayor', '0', '0');
INSERT INTO cities VALUES ('789', '60', 'La Vega', '0', '0');
INSERT INTO cities VALUES ('790', '60', 'Monsenor Nouel', '0', '0');
INSERT INTO cities VALUES ('791', '60', 'Monte Plata', '0', '0');
INSERT INTO cities VALUES ('792', '60', 'San Cristobal', '0', '0');
INSERT INTO cities VALUES ('793', '60', 'Distrito Nacional', '0', '0');
INSERT INTO cities VALUES ('794', '60', 'Peravia', '0', '0');
INSERT INTO cities VALUES ('795', '60', 'San Jose de Ocoa', '0', '0');
INSERT INTO cities VALUES ('796', '60', 'Santo Domingo', '0', '0');
INSERT INTO cities VALUES ('797', '3', 'Alger', '0', '0');
INSERT INTO cities VALUES ('798', '3', 'Batna', '0', '0');
INSERT INTO cities VALUES ('799', '3', 'Constantine', '0', '0');
INSERT INTO cities VALUES ('800', '3', 'Medea', '0', '0');
INSERT INTO cities VALUES ('801', '3', 'Mostaganem', '0', '0');
INSERT INTO cities VALUES ('802', '3', 'Oran', '0', '0');
INSERT INTO cities VALUES ('803', '3', 'Saida', '0', '0');
INSERT INTO cities VALUES ('804', '3', 'Setif', '0', '0');
INSERT INTO cities VALUES ('805', '3', 'Tiaret', '0', '0');
INSERT INTO cities VALUES ('806', '3', 'Tizi Ouzou', '0', '0');
INSERT INTO cities VALUES ('807', '3', 'Tlemcen', '0', '0');
INSERT INTO cities VALUES ('808', '3', 'Bejaia', '0', '0');
INSERT INTO cities VALUES ('809', '3', 'Biskra', '0', '0');
INSERT INTO cities VALUES ('810', '3', 'Blida', '0', '0');
INSERT INTO cities VALUES ('811', '3', 'Bouira', '0', '0');
INSERT INTO cities VALUES ('812', '3', 'Djelfa', '0', '0');
INSERT INTO cities VALUES ('813', '3', 'Guelma', '0', '0');
INSERT INTO cities VALUES ('814', '3', 'Jijel', '0', '0');
INSERT INTO cities VALUES ('815', '3', 'Laghouat', '0', '0');
INSERT INTO cities VALUES ('816', '3', 'Mascara', '0', '0');
INSERT INTO cities VALUES ('817', '3', 'M\'sila', '0', '0');
INSERT INTO cities VALUES ('818', '3', 'Oum el Bouaghi', '0', '0');
INSERT INTO cities VALUES ('819', '3', 'Sidi Bel Abbes', '0', '0');
INSERT INTO cities VALUES ('820', '3', 'Skikda', '0', '0');
INSERT INTO cities VALUES ('821', '3', 'Tebessa', '0', '0');
INSERT INTO cities VALUES ('822', '3', 'Adrar', '0', '0');
INSERT INTO cities VALUES ('823', '3', 'Ain Defla', '0', '0');
INSERT INTO cities VALUES ('824', '3', 'Ain Temouchent', '0', '0');
INSERT INTO cities VALUES ('825', '3', 'Annaba', '0', '0');
INSERT INTO cities VALUES ('826', '3', 'Bechar', '0', '0');
INSERT INTO cities VALUES ('827', '3', 'Bordj Bou Arreridj', '0', '0');
INSERT INTO cities VALUES ('828', '3', 'Boumerdes', '0', '0');
INSERT INTO cities VALUES ('829', '3', 'Chlef', '0', '0');
INSERT INTO cities VALUES ('830', '3', 'El Bayadh', '0', '0');
INSERT INTO cities VALUES ('831', '3', 'El Oued', '0', '0');
INSERT INTO cities VALUES ('832', '3', 'El Tarf', '0', '0');
INSERT INTO cities VALUES ('833', '3', 'Ghardaia', '0', '0');
INSERT INTO cities VALUES ('834', '3', 'Illizi', '0', '0');
INSERT INTO cities VALUES ('835', '3', 'Khenchela', '0', '0');
INSERT INTO cities VALUES ('836', '3', 'Mila', '0', '0');
INSERT INTO cities VALUES ('837', '3', 'Naama', '0', '0');
INSERT INTO cities VALUES ('838', '3', 'Ouargla', '0', '0');
INSERT INTO cities VALUES ('839', '3', 'Relizane', '0', '0');
INSERT INTO cities VALUES ('840', '3', 'Souk Ahras', '0', '0');
INSERT INTO cities VALUES ('841', '3', 'Tamanghasset', '0', '0');
INSERT INTO cities VALUES ('842', '3', 'Tindouf', '0', '0');
INSERT INTO cities VALUES ('843', '3', 'Tipaza', '0', '0');
INSERT INTO cities VALUES ('844', '3', 'Tissemsilt', '0', '0');
INSERT INTO cities VALUES ('845', '62', 'Galapagos', '0', '0');
INSERT INTO cities VALUES ('846', '62', 'Azuay', '0', '0');
INSERT INTO cities VALUES ('847', '62', 'Bolivar', '0', '0');
INSERT INTO cities VALUES ('848', '62', 'Canar', '0', '0');
INSERT INTO cities VALUES ('849', '62', 'Carchi', '0', '0');
INSERT INTO cities VALUES ('850', '62', 'Chimborazo', '0', '0');
INSERT INTO cities VALUES ('851', '62', 'Cotopaxi', '0', '0');
INSERT INTO cities VALUES ('852', '62', 'El Oro', '0', '0');
INSERT INTO cities VALUES ('853', '62', 'Esmeraldas', '0', '0');
INSERT INTO cities VALUES ('854', '62', 'Guayas', '0', '0');
INSERT INTO cities VALUES ('855', '62', 'Imbabura', '0', '0');
INSERT INTO cities VALUES ('856', '62', 'Loja', '0', '0');
INSERT INTO cities VALUES ('857', '62', 'Los Rios', '0', '0');
INSERT INTO cities VALUES ('858', '62', 'Manabi', '0', '0');
INSERT INTO cities VALUES ('859', '62', 'Morona-Santiago', '0', '0');
INSERT INTO cities VALUES ('860', '62', 'Pastaza', '0', '0');
INSERT INTO cities VALUES ('861', '62', 'Pichincha', '0', '0');
INSERT INTO cities VALUES ('862', '62', 'Tungurahua', '0', '0');
INSERT INTO cities VALUES ('863', '62', 'Zamora-Chinchipe', '0', '0');
INSERT INTO cities VALUES ('864', '62', 'Sucumbios', '0', '0');
INSERT INTO cities VALUES ('865', '62', 'Napo', '0', '0');
INSERT INTO cities VALUES ('866', '62', 'Orellana', '0', '0');
INSERT INTO cities VALUES ('867', '67', 'Harjumaa', '0', '0');
INSERT INTO cities VALUES ('868', '67', 'Hiiumaa', '0', '0');
INSERT INTO cities VALUES ('869', '67', 'Ida-Virumaa', '0', '0');
INSERT INTO cities VALUES ('870', '67', 'Jarvamaa', '0', '0');
INSERT INTO cities VALUES ('871', '67', 'Jogevamaa', '0', '0');
INSERT INTO cities VALUES ('872', '67', 'Kohtla-Jarve', '0', '0');
INSERT INTO cities VALUES ('873', '67', 'Laanemaa', '0', '0');
INSERT INTO cities VALUES ('874', '67', 'Laane-Virumaa', '0', '0');
INSERT INTO cities VALUES ('875', '67', 'Narva', '0', '0');
INSERT INTO cities VALUES ('876', '67', 'Parnu', '0', '0');
INSERT INTO cities VALUES ('877', '67', 'Parnumaa', '0', '0');
INSERT INTO cities VALUES ('878', '67', 'Polvamaa', '0', '0');
INSERT INTO cities VALUES ('879', '67', 'Raplamaa', '0', '0');
INSERT INTO cities VALUES ('880', '67', 'Saaremaa', '0', '0');
INSERT INTO cities VALUES ('881', '67', 'Sillamae', '0', '0');
INSERT INTO cities VALUES ('882', '67', 'Tallinn', '0', '0');
INSERT INTO cities VALUES ('883', '67', 'Tartu', '0', '0');
INSERT INTO cities VALUES ('884', '67', 'Tartumaa', '0', '0');
INSERT INTO cities VALUES ('885', '67', 'Valgamaa', '0', '0');
INSERT INTO cities VALUES ('886', '67', 'Viljandimaa', '0', '0');
INSERT INTO cities VALUES ('887', '67', 'Vorumaa', '0', '0');
INSERT INTO cities VALUES ('888', '63', 'Ad Daqahliyah', '0', '0');
INSERT INTO cities VALUES ('889', '63', 'Al Bahr al Ahmar', '0', '0');
INSERT INTO cities VALUES ('890', '63', 'Al Buhayrah', '0', '0');
INSERT INTO cities VALUES ('891', '63', 'Al Fayyum', '0', '0');
INSERT INTO cities VALUES ('892', '63', 'Al Gharbiyah', '0', '0');
INSERT INTO cities VALUES ('893', '63', 'Al Iskandariyah', '0', '0');
INSERT INTO cities VALUES ('894', '63', 'Al Isma\'iliyah', '0', '0');
INSERT INTO cities VALUES ('895', '63', 'Al Jizah', '0', '0');
INSERT INTO cities VALUES ('896', '63', 'Al Minufiyah', '0', '0');
INSERT INTO cities VALUES ('897', '63', 'Al Minya', '0', '0');
INSERT INTO cities VALUES ('898', '63', 'Al Qahirah', '0', '0');
INSERT INTO cities VALUES ('899', '63', 'Al Qalyubiyah', '0', '0');
INSERT INTO cities VALUES ('900', '63', 'Al Wadi al Jadid', '0', '0');
INSERT INTO cities VALUES ('901', '63', 'Ash Sharqiyah', '0', '0');
INSERT INTO cities VALUES ('902', '63', 'As Suways', '0', '0');
INSERT INTO cities VALUES ('903', '63', 'Aswan', '0', '0');
INSERT INTO cities VALUES ('904', '63', 'Asyut', '0', '0');
INSERT INTO cities VALUES ('905', '63', 'Bani Suwayf', '0', '0');
INSERT INTO cities VALUES ('906', '63', 'Bur Sa\'id', '0', '0');
INSERT INTO cities VALUES ('907', '63', 'Dumyat', '0', '0');
INSERT INTO cities VALUES ('908', '63', 'Kafr ash Shaykh', '0', '0');
INSERT INTO cities VALUES ('909', '63', 'Matruh', '0', '0');
INSERT INTO cities VALUES ('910', '63', 'Qina', '0', '0');
INSERT INTO cities VALUES ('911', '63', 'Suhaj', '0', '0');
INSERT INTO cities VALUES ('912', '63', 'Janub Sina\'', '0', '0');
INSERT INTO cities VALUES ('913', '63', 'Shamal Sina\'', '0', '0');
INSERT INTO cities VALUES ('914', '66', 'Anseba', '0', '0');
INSERT INTO cities VALUES ('915', '66', 'Debub', '0', '0');
INSERT INTO cities VALUES ('916', '66', 'Debubawi K\'eyih Bahri', '0', '0');
INSERT INTO cities VALUES ('917', '66', 'Gash Barka', '0', '0');
INSERT INTO cities VALUES ('918', '66', 'Ma\'akel', '0', '0');
INSERT INTO cities VALUES ('919', '66', 'Semenawi K\'eyih Bahri', '0', '0');
INSERT INTO cities VALUES ('920', '195', 'Islas Baleares', '0', '0');
INSERT INTO cities VALUES ('921', '195', 'La Rioja', '0', '0');
INSERT INTO cities VALUES ('922', '195', 'Madrid', '0', '0');
INSERT INTO cities VALUES ('923', '195', 'Murcia', '0', '0');
INSERT INTO cities VALUES ('924', '195', 'Navarra', '0', '0');
INSERT INTO cities VALUES ('925', '195', 'Asturias', '0', '0');
INSERT INTO cities VALUES ('926', '195', 'Cantabria', '0', '0');
INSERT INTO cities VALUES ('927', '195', 'Andalucia', '0', '0');
INSERT INTO cities VALUES ('928', '195', 'Aragon', '0', '0');
INSERT INTO cities VALUES ('929', '195', 'Canarias', '0', '0');
INSERT INTO cities VALUES ('930', '195', 'Castilla-La Mancha', '0', '0');
INSERT INTO cities VALUES ('931', '195', 'Castilla y Leon', '0', '0');
INSERT INTO cities VALUES ('932', '195', 'Catalonia', '0', '0');
INSERT INTO cities VALUES ('933', '195', 'Extremadura', '0', '0');
INSERT INTO cities VALUES ('934', '195', 'Galicia', '0', '0');
INSERT INTO cities VALUES ('935', '195', 'Pais Vasco', '0', '0');
INSERT INTO cities VALUES ('936', '195', 'Comunidad Valenciana', '0', '0');
INSERT INTO cities VALUES ('937', '68', 'Adis Abeba', '0', '0');
INSERT INTO cities VALUES ('938', '68', 'Afar', '0', '0');
INSERT INTO cities VALUES ('939', '68', 'Amara', '0', '0');
INSERT INTO cities VALUES ('940', '68', 'Binshangul Gumuz', '0', '0');
INSERT INTO cities VALUES ('941', '68', 'Dire Dawa', '0', '0');
INSERT INTO cities VALUES ('942', '68', 'Gambela Hizboch', '0', '0');
INSERT INTO cities VALUES ('943', '68', 'Hareri Hizb', '0', '0');
INSERT INTO cities VALUES ('944', '68', 'Oromiya', '0', '0');
INSERT INTO cities VALUES ('945', '68', 'Sumale', '0', '0');
INSERT INTO cities VALUES ('946', '68', 'Tigray', '0', '0');
INSERT INTO cities VALUES ('947', '68', 'YeDebub Biheroch Bihereseboch na Hizboch', '0', '0');
INSERT INTO cities VALUES ('948', '72', 'Aland', '0', '0');
INSERT INTO cities VALUES ('949', '72', 'Lapland', '0', '0');
INSERT INTO cities VALUES ('950', '72', 'Oulu', '0', '0');
INSERT INTO cities VALUES ('951', '72', 'Southern Finland', '0', '0');
INSERT INTO cities VALUES ('952', '72', 'Eastern Finland', '0', '0');
INSERT INTO cities VALUES ('953', '72', 'Western Finland', '0', '0');
INSERT INTO cities VALUES ('954', '71', 'Central', '0', '0');
INSERT INTO cities VALUES ('955', '71', 'Eastern', '0', '0');
INSERT INTO cities VALUES ('956', '71', 'Northern', '0', '0');
INSERT INTO cities VALUES ('957', '71', 'Rotuma', '0', '0');
INSERT INTO cities VALUES ('958', '71', 'Western', '0', '0');
INSERT INTO cities VALUES ('959', '139', 'Kosrae', '0', '0');
INSERT INTO cities VALUES ('960', '139', 'Pohnpei', '0', '0');
INSERT INTO cities VALUES ('961', '139', 'Chuuk', '0', '0');
INSERT INTO cities VALUES ('962', '139', 'Yap', '0', '0');
INSERT INTO cities VALUES ('963', '73', 'Aquitaine', '0', '0');
INSERT INTO cities VALUES ('964', '73', 'Auvergne', '0', '0');
INSERT INTO cities VALUES ('965', '73', 'Basse-Normandie', '0', '0');
INSERT INTO cities VALUES ('966', '73', 'Bourgogne', '0', '0');
INSERT INTO cities VALUES ('967', '73', 'Bretagne', '0', '0');
INSERT INTO cities VALUES ('968', '73', 'Centre', '0', '0');
INSERT INTO cities VALUES ('969', '73', 'Champagne-Ardenne', '0', '0');
INSERT INTO cities VALUES ('970', '73', 'Corse', '0', '0');
INSERT INTO cities VALUES ('971', '73', 'Franche-Comte', '0', '0');
INSERT INTO cities VALUES ('972', '73', 'Haute-Normandie', '0', '0');
INSERT INTO cities VALUES ('973', '73', 'Ile-de-France', '0', '0');
INSERT INTO cities VALUES ('974', '73', 'Languedoc-Roussillon', '0', '0');
INSERT INTO cities VALUES ('975', '73', 'Limousin', '0', '0');
INSERT INTO cities VALUES ('976', '73', 'Lorraine', '0', '0');
INSERT INTO cities VALUES ('977', '73', 'Midi-Pyrenees', '0', '0');
INSERT INTO cities VALUES ('978', '73', 'Nord-Pas-de-Calais', '0', '0');
INSERT INTO cities VALUES ('979', '73', 'Pays de la Loire', '0', '0');
INSERT INTO cities VALUES ('980', '73', 'Picardie', '0', '0');
INSERT INTO cities VALUES ('981', '73', 'Poitou-Charentes', '0', '0');
INSERT INTO cities VALUES ('982', '73', 'Provence-Alpes-Cote d\'Azur', '0', '0');
INSERT INTO cities VALUES ('983', '73', 'Rhone-Alpes', '0', '0');
INSERT INTO cities VALUES ('984', '73', 'Alsace', '0', '0');
INSERT INTO cities VALUES ('985', '78', 'Estuaire', '0', '0');
INSERT INTO cities VALUES ('986', '78', 'Haut-Ogooue', '0', '0');
INSERT INTO cities VALUES ('987', '78', 'Moyen-Ogooue', '0', '0');
INSERT INTO cities VALUES ('988', '78', 'Ngounie', '0', '0');
INSERT INTO cities VALUES ('989', '78', 'Nyanga', '0', '0');
INSERT INTO cities VALUES ('990', '78', 'Ogooue-Ivindo', '0', '0');
INSERT INTO cities VALUES ('991', '78', 'Ogooue-Lolo', '0', '0');
INSERT INTO cities VALUES ('992', '78', 'Ogooue-Maritime', '0', '0');
INSERT INTO cities VALUES ('993', '78', 'Woleu-Ntem', '0', '0');
INSERT INTO cities VALUES ('994', '222', 'Barking and Dagenham', '0', '0');
INSERT INTO cities VALUES ('995', '222', 'Barnet', '0', '0');
INSERT INTO cities VALUES ('996', '222', 'Barnsley', '0', '0');
INSERT INTO cities VALUES ('997', '222', 'Bath and North East Somerset', '0', '0');
INSERT INTO cities VALUES ('998', '222', 'Bedfordshire', '0', '0');
INSERT INTO cities VALUES ('999', '222', 'Bexley', '0', '0');
INSERT INTO cities VALUES ('1000', '222', 'Birmingham', '0', '0');
INSERT INTO cities VALUES ('1001', '222', 'Blackburn with Darwen', '0', '0');
INSERT INTO cities VALUES ('1002', '222', 'Blackpool', '0', '0');
INSERT INTO cities VALUES ('1003', '222', 'Bolton', '0', '0');
INSERT INTO cities VALUES ('1004', '222', 'Bournemouth', '0', '0');
INSERT INTO cities VALUES ('1005', '222', 'Bracknell Forest', '0', '0');
INSERT INTO cities VALUES ('1006', '222', 'Bradford', '0', '0');
INSERT INTO cities VALUES ('1007', '222', 'Brent', '0', '0');
INSERT INTO cities VALUES ('1008', '222', 'Brighton and Hove', '0', '0');
INSERT INTO cities VALUES ('1009', '222', 'Bristol, City of', '0', '0');
INSERT INTO cities VALUES ('1010', '222', 'Bromley', '0', '0');
INSERT INTO cities VALUES ('1011', '222', 'Buckinghamshire', '0', '0');
INSERT INTO cities VALUES ('1012', '222', 'Bury', '0', '0');
INSERT INTO cities VALUES ('1013', '222', 'Calderdale', '0', '0');
INSERT INTO cities VALUES ('1014', '222', 'Cambridgeshire', '0', '0');
INSERT INTO cities VALUES ('1015', '222', 'Camden', '0', '0');
INSERT INTO cities VALUES ('1016', '222', 'Cheshire', '0', '0');
INSERT INTO cities VALUES ('1017', '222', 'Cornwall', '0', '0');
INSERT INTO cities VALUES ('1018', '222', 'Coventry', '0', '0');
INSERT INTO cities VALUES ('1019', '222', 'Croydon', '0', '0');
INSERT INTO cities VALUES ('1020', '222', 'Cumbria', '0', '0');
INSERT INTO cities VALUES ('1021', '222', 'Darlington', '0', '0');
INSERT INTO cities VALUES ('1022', '222', 'Derby', '0', '0');
INSERT INTO cities VALUES ('1023', '222', 'Derbyshire', '0', '0');
INSERT INTO cities VALUES ('1024', '222', 'Devon', '0', '0');
INSERT INTO cities VALUES ('1025', '222', 'Doncaster', '0', '0');
INSERT INTO cities VALUES ('1026', '222', 'Dorset', '0', '0');
INSERT INTO cities VALUES ('1027', '222', 'Dudley', '0', '0');
INSERT INTO cities VALUES ('1028', '222', 'Durham', '0', '0');
INSERT INTO cities VALUES ('1029', '222', 'Ealing', '0', '0');
INSERT INTO cities VALUES ('1030', '222', 'East Riding of Yorkshire', '0', '0');
INSERT INTO cities VALUES ('1031', '222', 'East Sussex', '0', '0');
INSERT INTO cities VALUES ('1032', '222', 'Enfield', '0', '0');
INSERT INTO cities VALUES ('1033', '222', 'Essex', '0', '0');
INSERT INTO cities VALUES ('1034', '222', 'Gateshead', '0', '0');
INSERT INTO cities VALUES ('1035', '222', 'Gloucestershire', '0', '0');
INSERT INTO cities VALUES ('1036', '222', 'Greenwich', '0', '0');
INSERT INTO cities VALUES ('1037', '222', 'Hackney', '0', '0');
INSERT INTO cities VALUES ('1038', '222', 'Halton', '0', '0');
INSERT INTO cities VALUES ('1039', '222', 'Hammersmith and Fulham', '0', '0');
INSERT INTO cities VALUES ('1040', '222', 'Hampshire', '0', '0');
INSERT INTO cities VALUES ('1041', '222', 'Haringey', '0', '0');
INSERT INTO cities VALUES ('1042', '222', 'Harrow', '0', '0');
INSERT INTO cities VALUES ('1043', '222', 'Hartlepool', '0', '0');
INSERT INTO cities VALUES ('1044', '222', 'Havering', '0', '0');
INSERT INTO cities VALUES ('1045', '222', 'Herefordshire', '0', '0');
INSERT INTO cities VALUES ('1046', '222', 'Hertford', '0', '0');
INSERT INTO cities VALUES ('1047', '222', 'Hillingdon', '0', '0');
INSERT INTO cities VALUES ('1048', '222', 'Hounslow', '0', '0');
INSERT INTO cities VALUES ('1049', '222', 'Isle of Wight', '0', '0');
INSERT INTO cities VALUES ('1050', '222', 'Islington', '0', '0');
INSERT INTO cities VALUES ('1051', '222', 'Kensington and Chelsea', '0', '0');
INSERT INTO cities VALUES ('1052', '222', 'Kent', '0', '0');
INSERT INTO cities VALUES ('1053', '222', 'Kingston upon Hull, City of', '0', '0');
INSERT INTO cities VALUES ('1054', '222', 'Kingston upon Thames', '0', '0');
INSERT INTO cities VALUES ('1055', '222', 'Kirklees', '0', '0');
INSERT INTO cities VALUES ('1056', '222', 'Knowsley', '0', '0');
INSERT INTO cities VALUES ('1057', '222', 'Lambeth', '0', '0');
INSERT INTO cities VALUES ('1058', '222', 'Lancashire', '0', '0');
INSERT INTO cities VALUES ('1059', '222', 'Leeds', '0', '0');
INSERT INTO cities VALUES ('1060', '222', 'Leicester', '0', '0');
INSERT INTO cities VALUES ('1061', '222', 'Leicestershire', '0', '0');
INSERT INTO cities VALUES ('1062', '222', 'Lewisham', '0', '0');
INSERT INTO cities VALUES ('1063', '222', 'Lincolnshire', '0', '0');
INSERT INTO cities VALUES ('1064', '222', 'Liverpool', '0', '0');
INSERT INTO cities VALUES ('1065', '222', 'London, City of', '0', '0');
INSERT INTO cities VALUES ('1066', '222', 'Luton', '0', '0');
INSERT INTO cities VALUES ('1067', '222', 'Manchester', '0', '0');
INSERT INTO cities VALUES ('1068', '222', 'Medway', '0', '0');
INSERT INTO cities VALUES ('1069', '222', 'Merton', '0', '0');
INSERT INTO cities VALUES ('1070', '222', 'Middlesbrough', '0', '0');
INSERT INTO cities VALUES ('1071', '222', 'Milton Keynes', '0', '0');
INSERT INTO cities VALUES ('1072', '222', 'Newcastle upon Tyne', '0', '0');
INSERT INTO cities VALUES ('1073', '222', 'Newham', '0', '0');
INSERT INTO cities VALUES ('1074', '222', 'Norfolk', '0', '0');
INSERT INTO cities VALUES ('1075', '222', 'Northamptonshire', '0', '0');
INSERT INTO cities VALUES ('1076', '222', 'North East Lincolnshire', '0', '0');
INSERT INTO cities VALUES ('1077', '222', 'North Lincolnshire', '0', '0');
INSERT INTO cities VALUES ('1078', '222', 'North Somerset', '0', '0');
INSERT INTO cities VALUES ('1079', '222', 'North Tyneside', '0', '0');
INSERT INTO cities VALUES ('1080', '222', 'Northumberland', '0', '0');
INSERT INTO cities VALUES ('1081', '222', 'North Yorkshire', '0', '0');
INSERT INTO cities VALUES ('1082', '222', 'Nottingham', '0', '0');
INSERT INTO cities VALUES ('1083', '222', 'Nottinghamshire', '0', '0');
INSERT INTO cities VALUES ('1084', '222', 'Oldham', '0', '0');
INSERT INTO cities VALUES ('1085', '222', 'Oxfordshire', '0', '0');
INSERT INTO cities VALUES ('1086', '222', 'Peterborough', '0', '0');
INSERT INTO cities VALUES ('1087', '222', 'Plymouth', '0', '0');
INSERT INTO cities VALUES ('1088', '222', 'Poole', '0', '0');
INSERT INTO cities VALUES ('1089', '222', 'Portsmouth', '0', '0');
INSERT INTO cities VALUES ('1090', '222', 'Reading', '0', '0');
INSERT INTO cities VALUES ('1091', '222', 'Redbridge', '0', '0');
INSERT INTO cities VALUES ('1092', '222', 'Redcar and Cleveland', '0', '0');
INSERT INTO cities VALUES ('1093', '222', 'Richmond upon Thames', '0', '0');
INSERT INTO cities VALUES ('1094', '222', 'Rochdale', '0', '0');
INSERT INTO cities VALUES ('1095', '222', 'Rotherham', '0', '0');
INSERT INTO cities VALUES ('1096', '222', 'Rutland', '0', '0');
INSERT INTO cities VALUES ('1097', '222', 'Salford', '0', '0');
INSERT INTO cities VALUES ('1098', '222', 'Shropshire', '0', '0');
INSERT INTO cities VALUES ('1099', '222', 'Sandwell', '0', '0');
INSERT INTO cities VALUES ('1100', '222', 'Sefton', '0', '0');
INSERT INTO cities VALUES ('1101', '222', 'Sheffield', '0', '0');
INSERT INTO cities VALUES ('1102', '222', 'Slough', '0', '0');
INSERT INTO cities VALUES ('1103', '222', 'Solihull', '0', '0');
INSERT INTO cities VALUES ('1104', '222', 'Somerset', '0', '0');
INSERT INTO cities VALUES ('1105', '222', 'Southampton', '0', '0');
INSERT INTO cities VALUES ('1106', '222', 'Southend-on-Sea', '0', '0');
INSERT INTO cities VALUES ('1107', '222', 'South Gloucestershire', '0', '0');
INSERT INTO cities VALUES ('1108', '222', 'South Tyneside', '0', '0');
INSERT INTO cities VALUES ('1109', '222', 'Southwark', '0', '0');
INSERT INTO cities VALUES ('1110', '222', 'Staffordshire', '0', '0');
INSERT INTO cities VALUES ('1111', '222', 'St. Helens', '0', '0');
INSERT INTO cities VALUES ('1112', '222', 'Stockport', '0', '0');
INSERT INTO cities VALUES ('1113', '222', 'Stockton-on-Tees', '0', '0');
INSERT INTO cities VALUES ('1114', '222', 'Stoke-on-Trent', '0', '0');
INSERT INTO cities VALUES ('1115', '222', 'Suffolk', '0', '0');
INSERT INTO cities VALUES ('1116', '222', 'Sunderland', '0', '0');
INSERT INTO cities VALUES ('1117', '222', 'Surrey', '0', '0');
INSERT INTO cities VALUES ('1118', '222', 'Sutton', '0', '0');
INSERT INTO cities VALUES ('1119', '222', 'Swindon', '0', '0');
INSERT INTO cities VALUES ('1120', '222', 'Tameside', '0', '0');
INSERT INTO cities VALUES ('1121', '222', 'Telford and Wrekin', '0', '0');
INSERT INTO cities VALUES ('1122', '222', 'Thurrock', '0', '0');
INSERT INTO cities VALUES ('1123', '222', 'Torbay', '0', '0');
INSERT INTO cities VALUES ('1124', '222', 'Tower Hamlets', '0', '0');
INSERT INTO cities VALUES ('1125', '222', 'Trafford', '0', '0');
INSERT INTO cities VALUES ('1126', '222', 'Wakefield', '0', '0');
INSERT INTO cities VALUES ('1127', '222', 'Walsall', '0', '0');
INSERT INTO cities VALUES ('1128', '222', 'Waltham Forest', '0', '0');
INSERT INTO cities VALUES ('1129', '222', 'Wandsworth', '0', '0');
INSERT INTO cities VALUES ('1130', '222', 'Warrington', '0', '0');
INSERT INTO cities VALUES ('1131', '222', 'Warwickshire', '0', '0');
INSERT INTO cities VALUES ('1132', '222', 'West Berkshire', '0', '0');
INSERT INTO cities VALUES ('1133', '222', 'Westminster', '0', '0');
INSERT INTO cities VALUES ('1134', '222', 'West Sussex', '0', '0');
INSERT INTO cities VALUES ('1135', '222', 'Wigan', '0', '0');
INSERT INTO cities VALUES ('1136', '222', 'Wiltshire', '0', '0');
INSERT INTO cities VALUES ('1137', '222', 'Windsor and Maidenhead', '0', '0');
INSERT INTO cities VALUES ('1138', '222', 'Wirral', '0', '0');
INSERT INTO cities VALUES ('1139', '222', 'Wokingham', '0', '0');
INSERT INTO cities VALUES ('1140', '222', 'Wolverhampton', '0', '0');
INSERT INTO cities VALUES ('1141', '222', 'Worcestershire', '0', '0');
INSERT INTO cities VALUES ('1142', '222', 'York', '0', '0');
INSERT INTO cities VALUES ('1143', '222', 'Antrim', '0', '0');
INSERT INTO cities VALUES ('1144', '222', 'Ards', '0', '0');
INSERT INTO cities VALUES ('1145', '222', 'Armagh', '0', '0');
INSERT INTO cities VALUES ('1146', '222', 'Ballymena', '0', '0');
INSERT INTO cities VALUES ('1147', '222', 'Ballymoney', '0', '0');
INSERT INTO cities VALUES ('1148', '222', 'Banbridge', '0', '0');
INSERT INTO cities VALUES ('1149', '222', 'Belfast', '0', '0');
INSERT INTO cities VALUES ('1150', '222', 'Carrickfergus', '0', '0');
INSERT INTO cities VALUES ('1151', '222', 'Castlereagh', '0', '0');
INSERT INTO cities VALUES ('1152', '222', 'Coleraine', '0', '0');
INSERT INTO cities VALUES ('1153', '222', 'Cookstown', '0', '0');
INSERT INTO cities VALUES ('1154', '222', 'Craigavon', '0', '0');
INSERT INTO cities VALUES ('1155', '222', 'Down', '0', '0');
INSERT INTO cities VALUES ('1156', '222', 'Dungannon', '0', '0');
INSERT INTO cities VALUES ('1157', '222', 'Fermanagh', '0', '0');
INSERT INTO cities VALUES ('1158', '222', 'Larne', '0', '0');
INSERT INTO cities VALUES ('1159', '222', 'Limavady', '0', '0');
INSERT INTO cities VALUES ('1160', '222', 'Lisburn', '0', '0');
INSERT INTO cities VALUES ('1161', '222', 'Derry', '0', '0');
INSERT INTO cities VALUES ('1162', '222', 'Magherafelt', '0', '0');
INSERT INTO cities VALUES ('1163', '222', 'Moyle', '0', '0');
INSERT INTO cities VALUES ('1164', '222', 'Newry and Mourne', '0', '0');
INSERT INTO cities VALUES ('1165', '222', 'Newtownabbey', '0', '0');
INSERT INTO cities VALUES ('1166', '222', 'North Down', '0', '0');
INSERT INTO cities VALUES ('1167', '222', 'Omagh', '0', '0');
INSERT INTO cities VALUES ('1168', '222', 'Strabane', '0', '0');
INSERT INTO cities VALUES ('1169', '222', 'Aberdeen City', '0', '0');
INSERT INTO cities VALUES ('1170', '222', 'Aberdeenshire', '0', '0');
INSERT INTO cities VALUES ('1171', '222', 'Angus', '0', '0');
INSERT INTO cities VALUES ('1172', '222', 'Argyll and Bute', '0', '0');
INSERT INTO cities VALUES ('1173', '222', 'Scottish Borders, The', '0', '0');
INSERT INTO cities VALUES ('1174', '222', 'Clackmannanshire', '0', '0');
INSERT INTO cities VALUES ('1175', '222', 'Dumfries and Galloway', '0', '0');
INSERT INTO cities VALUES ('1176', '222', 'Dundee City', '0', '0');
INSERT INTO cities VALUES ('1177', '222', 'East Ayrshire', '0', '0');
INSERT INTO cities VALUES ('1178', '222', 'East Dunbartonshire', '0', '0');
INSERT INTO cities VALUES ('1179', '222', 'East Lothian', '0', '0');
INSERT INTO cities VALUES ('1180', '222', 'East Renfrewshire', '0', '0');
INSERT INTO cities VALUES ('1181', '222', 'Edinburgh, City of', '0', '0');
INSERT INTO cities VALUES ('1182', '222', 'Falkirk', '0', '0');
INSERT INTO cities VALUES ('1183', '222', 'Fife', '0', '0');
INSERT INTO cities VALUES ('1184', '222', 'Glasgow City', '0', '0');
INSERT INTO cities VALUES ('1185', '222', 'Highland', '0', '0');
INSERT INTO cities VALUES ('1186', '222', 'Inverclyde', '0', '0');
INSERT INTO cities VALUES ('1187', '222', 'Midlothian', '0', '0');
INSERT INTO cities VALUES ('1188', '222', 'Moray', '0', '0');
INSERT INTO cities VALUES ('1189', '222', 'North Ayrshire', '0', '0');
INSERT INTO cities VALUES ('1190', '222', 'North Lanarkshire', '0', '0');
INSERT INTO cities VALUES ('1191', '222', 'Orkney', '0', '0');
INSERT INTO cities VALUES ('1192', '222', 'Perth and Kinross', '0', '0');
INSERT INTO cities VALUES ('1193', '222', 'Renfrewshire', '0', '0');
INSERT INTO cities VALUES ('1194', '222', 'Shetland Islands', '0', '0');
INSERT INTO cities VALUES ('1195', '222', 'South Ayrshire', '0', '0');
INSERT INTO cities VALUES ('1196', '222', 'South Lanarkshire', '0', '0');
INSERT INTO cities VALUES ('1197', '222', 'Stirling', '0', '0');
INSERT INTO cities VALUES ('1198', '222', 'West Dunbartonshire', '0', '0');
INSERT INTO cities VALUES ('1199', '222', 'Eilean Siar', '0', '0');
INSERT INTO cities VALUES ('1200', '222', 'West Lothian', '0', '0');
INSERT INTO cities VALUES ('1201', '222', 'Isle of Anglesey', '0', '0');
INSERT INTO cities VALUES ('1202', '222', 'Blaenau Gwent', '0', '0');
INSERT INTO cities VALUES ('1203', '222', 'Bridgend', '0', '0');
INSERT INTO cities VALUES ('1204', '222', 'Caerphilly', '0', '0');
INSERT INTO cities VALUES ('1205', '222', 'Cardiff', '0', '0');
INSERT INTO cities VALUES ('1206', '222', 'Ceredigion', '0', '0');
INSERT INTO cities VALUES ('1207', '222', 'Carmarthenshire', '0', '0');
INSERT INTO cities VALUES ('1208', '222', 'Conwy', '0', '0');
INSERT INTO cities VALUES ('1209', '222', 'Denbighshire', '0', '0');
INSERT INTO cities VALUES ('1210', '222', 'Flintshire', '0', '0');
INSERT INTO cities VALUES ('1211', '222', 'Gwynedd', '0', '0');
INSERT INTO cities VALUES ('1212', '222', 'Merthyr Tydfil', '0', '0');
INSERT INTO cities VALUES ('1213', '222', 'Monmouthshire', '0', '0');
INSERT INTO cities VALUES ('1214', '222', 'Neath Port Talbot', '0', '0');
INSERT INTO cities VALUES ('1215', '222', 'Newport', '0', '0');
INSERT INTO cities VALUES ('1216', '222', 'Pembrokeshire', '0', '0');
INSERT INTO cities VALUES ('1217', '222', 'Powys', '0', '0');
INSERT INTO cities VALUES ('1218', '222', 'Rhondda Cynon Taff', '0', '0');
INSERT INTO cities VALUES ('1219', '222', 'Swansea', '0', '0');
INSERT INTO cities VALUES ('1220', '222', 'Torfaen', '0', '0');
INSERT INTO cities VALUES ('1221', '222', 'Vale of Glamorgan, The', '0', '0');
INSERT INTO cities VALUES ('1222', '222', 'Wrexham', '0', '0');
INSERT INTO cities VALUES ('1223', '222', 'Bedfordshire', '0', '0');
INSERT INTO cities VALUES ('1224', '222', 'Central Bedfordshire', '0', '0');
INSERT INTO cities VALUES ('1225', '222', 'Cheshire East', '0', '0');
INSERT INTO cities VALUES ('1226', '222', 'Cheshire West and Chester', '0', '0');
INSERT INTO cities VALUES ('1227', '222', 'Isles of Scilly', '0', '0');
INSERT INTO cities VALUES ('1228', '86', 'Saint Andrew', '0', '0');
INSERT INTO cities VALUES ('1229', '86', 'Saint David', '0', '0');
INSERT INTO cities VALUES ('1230', '86', 'Saint George', '0', '0');
INSERT INTO cities VALUES ('1231', '86', 'Saint John', '0', '0');
INSERT INTO cities VALUES ('1232', '86', 'Saint Mark', '0', '0');
INSERT INTO cities VALUES ('1233', '86', 'Saint Patrick', '0', '0');
INSERT INTO cities VALUES ('1234', '80', 'Abashis Raioni', '0', '0');
INSERT INTO cities VALUES ('1235', '80', 'Abkhazia', '0', '0');
INSERT INTO cities VALUES ('1236', '80', 'Adigenis Raioni', '0', '0');
INSERT INTO cities VALUES ('1237', '80', 'Ajaria', '0', '0');
INSERT INTO cities VALUES ('1238', '80', 'Akhalgoris Raioni', '0', '0');
INSERT INTO cities VALUES ('1239', '80', 'Akhalk\'alak\'is Raioni', '0', '0');
INSERT INTO cities VALUES ('1240', '80', 'Akhalts\'ikhis Raioni', '0', '0');
INSERT INTO cities VALUES ('1241', '80', 'Akhmetis Raioni', '0', '0');
INSERT INTO cities VALUES ('1242', '80', 'Ambrolauris Raioni', '0', '0');
INSERT INTO cities VALUES ('1243', '80', 'Aspindzis Raioni', '0', '0');
INSERT INTO cities VALUES ('1244', '80', 'Baghdat\'is Raioni', '0', '0');
INSERT INTO cities VALUES ('1245', '80', 'Bolnisis Raioni', '0', '0');
INSERT INTO cities VALUES ('1246', '80', 'Borjomis Raioni', '0', '0');
INSERT INTO cities VALUES ('1247', '80', 'Chiat\'ura', '0', '0');
INSERT INTO cities VALUES ('1248', '80', 'Ch\'khorotsqus Raioni', '0', '0');
INSERT INTO cities VALUES ('1249', '80', 'Ch\'okhatauris Raioni', '0', '0');
INSERT INTO cities VALUES ('1250', '80', 'Dedop\'listsqaros Raioni', '0', '0');
INSERT INTO cities VALUES ('1251', '80', 'Dmanisis Raioni', '0', '0');
INSERT INTO cities VALUES ('1252', '80', 'Dushet\'is Raioni', '0', '0');
INSERT INTO cities VALUES ('1253', '80', 'Gardabanis Raioni', '0', '0');
INSERT INTO cities VALUES ('1254', '80', 'Gori', '0', '0');
INSERT INTO cities VALUES ('1255', '80', 'Goris Raioni', '0', '0');
INSERT INTO cities VALUES ('1256', '80', 'Gurjaanis Raioni', '0', '0');
INSERT INTO cities VALUES ('1257', '80', 'Javis Raioni', '0', '0');
INSERT INTO cities VALUES ('1258', '80', 'K\'arelis Raioni', '0', '0');
INSERT INTO cities VALUES ('1259', '80', 'Kaspis Raioni', '0', '0');
INSERT INTO cities VALUES ('1260', '80', 'Kharagaulis Raioni', '0', '0');
INSERT INTO cities VALUES ('1261', '80', 'Khashuris Raioni', '0', '0');
INSERT INTO cities VALUES ('1262', '80', 'Khobis Raioni', '0', '0');
INSERT INTO cities VALUES ('1263', '80', 'Khonis Raioni', '0', '0');
INSERT INTO cities VALUES ('1264', '80', 'K\'ut\'aisi', '0', '0');
INSERT INTO cities VALUES ('1265', '80', 'Lagodekhis Raioni', '0', '0');
INSERT INTO cities VALUES ('1266', '80', 'Lanch\'khut\'is Raioni', '0', '0');
INSERT INTO cities VALUES ('1267', '80', 'Lentekhis Raioni', '0', '0');
INSERT INTO cities VALUES ('1268', '80', 'Marneulis Raioni', '0', '0');
INSERT INTO cities VALUES ('1269', '80', 'Martvilis Raioni', '0', '0');
INSERT INTO cities VALUES ('1270', '80', 'Mestiis Raioni', '0', '0');
INSERT INTO cities VALUES ('1271', '80', 'Mts\'khet\'is Raioni', '0', '0');
INSERT INTO cities VALUES ('1272', '80', 'Ninotsmindis Raioni', '0', '0');
INSERT INTO cities VALUES ('1273', '80', 'Onis Raioni', '0', '0');
INSERT INTO cities VALUES ('1274', '80', 'Ozurget\'is Raioni', '0', '0');
INSERT INTO cities VALUES ('1275', '80', 'P\'ot\'i', '0', '0');
INSERT INTO cities VALUES ('1276', '80', 'Qazbegis Raioni', '0', '0');
INSERT INTO cities VALUES ('1277', '80', 'Qvarlis Raioni', '0', '0');
INSERT INTO cities VALUES ('1278', '80', 'Rust\'avi', '0', '0');
INSERT INTO cities VALUES ('1279', '80', 'Sach\'kheris Raioni', '0', '0');
INSERT INTO cities VALUES ('1280', '80', 'Sagarejos Raioni', '0', '0');
INSERT INTO cities VALUES ('1281', '80', 'Samtrediis Raioni', '0', '0');
INSERT INTO cities VALUES ('1282', '80', 'Senakis Raioni', '0', '0');
INSERT INTO cities VALUES ('1283', '80', 'Sighnaghis Raioni', '0', '0');
INSERT INTO cities VALUES ('1284', '80', 'T\'bilisi', '0', '0');
INSERT INTO cities VALUES ('1285', '80', 'T\'elavis Raioni', '0', '0');
INSERT INTO cities VALUES ('1286', '80', 'T\'erjolis Raioni', '0', '0');
INSERT INTO cities VALUES ('1287', '80', 'T\'et\'ritsqaros Raioni', '0', '0');
INSERT INTO cities VALUES ('1288', '80', 'T\'ianet\'is Raioni', '0', '0');
INSERT INTO cities VALUES ('1289', '80', 'Tqibuli', '0', '0');
INSERT INTO cities VALUES ('1290', '80', 'Ts\'ageris Raioni', '0', '0');
INSERT INTO cities VALUES ('1291', '80', 'Tsalenjikhis Raioni', '0', '0');
INSERT INTO cities VALUES ('1292', '80', 'Tsalkis Raioni', '0', '0');
INSERT INTO cities VALUES ('1293', '80', 'Tsqaltubo', '0', '0');
INSERT INTO cities VALUES ('1294', '80', 'Vanis Raioni', '0', '0');
INSERT INTO cities VALUES ('1295', '80', 'Zestap\'onis Raioni', '0', '0');
INSERT INTO cities VALUES ('1296', '80', 'Zugdidi', '0', '0');
INSERT INTO cities VALUES ('1297', '80', 'Zugdidis Raioni', '0', '0');
INSERT INTO cities VALUES ('1298', '82', 'Greater Accra', '0', '0');
INSERT INTO cities VALUES ('1299', '82', 'Ashanti', '0', '0');
INSERT INTO cities VALUES ('1300', '82', 'Brong-Ahafo', '0', '0');
INSERT INTO cities VALUES ('1301', '82', 'Central', '0', '0');
INSERT INTO cities VALUES ('1302', '82', 'Eastern', '0', '0');
INSERT INTO cities VALUES ('1303', '82', 'Northern', '0', '0');
INSERT INTO cities VALUES ('1304', '82', 'Volta', '0', '0');
INSERT INTO cities VALUES ('1305', '82', 'Western', '0', '0');
INSERT INTO cities VALUES ('1306', '82', 'Upper East', '0', '0');
INSERT INTO cities VALUES ('1307', '82', 'Upper West', '0', '0');
INSERT INTO cities VALUES ('1308', '85', 'Nordgronland', '0', '0');
INSERT INTO cities VALUES ('1309', '85', 'Ostgronland', '0', '0');
INSERT INTO cities VALUES ('1310', '85', 'Vestgronland', '0', '0');
INSERT INTO cities VALUES ('1311', '79', 'Banjul', '0', '0');
INSERT INTO cities VALUES ('1312', '79', 'Lower River', '0', '0');
INSERT INTO cities VALUES ('1313', '79', 'Central River', '0', '0');
INSERT INTO cities VALUES ('1314', '79', 'Upper River', '0', '0');
INSERT INTO cities VALUES ('1315', '79', 'Western', '0', '0');
INSERT INTO cities VALUES ('1316', '79', 'North Bank', '0', '0');
INSERT INTO cities VALUES ('1317', '90', 'Beyla', '0', '0');
INSERT INTO cities VALUES ('1318', '90', 'Boffa', '0', '0');
INSERT INTO cities VALUES ('1319', '90', 'Boke', '0', '0');
INSERT INTO cities VALUES ('1320', '90', 'Conakry', '0', '0');
INSERT INTO cities VALUES ('1321', '90', 'Dabola', '0', '0');
INSERT INTO cities VALUES ('1322', '90', 'Dalaba', '0', '0');
INSERT INTO cities VALUES ('1323', '90', 'Dinguiraye', '0', '0');
INSERT INTO cities VALUES ('1324', '90', 'Faranah', '0', '0');
INSERT INTO cities VALUES ('1325', '90', 'Forecariah', '0', '0');
INSERT INTO cities VALUES ('1326', '90', 'Fria', '0', '0');
INSERT INTO cities VALUES ('1327', '90', 'Gaoual', '0', '0');
INSERT INTO cities VALUES ('1328', '90', 'Gueckedou', '0', '0');
INSERT INTO cities VALUES ('1329', '90', 'Kerouane', '0', '0');
INSERT INTO cities VALUES ('1330', '90', 'Kindia', '0', '0');
INSERT INTO cities VALUES ('1331', '90', 'Kissidougou', '0', '0');
INSERT INTO cities VALUES ('1332', '90', 'Koundara', '0', '0');
INSERT INTO cities VALUES ('1333', '90', 'Kouroussa', '0', '0');
INSERT INTO cities VALUES ('1334', '90', 'Macenta', '0', '0');
INSERT INTO cities VALUES ('1335', '90', 'Mali', '0', '0');
INSERT INTO cities VALUES ('1336', '90', 'Mamou', '0', '0');
INSERT INTO cities VALUES ('1337', '90', 'Pita', '0', '0');
INSERT INTO cities VALUES ('1338', '90', 'Telimele', '0', '0');
INSERT INTO cities VALUES ('1339', '90', 'Tougue', '0', '0');
INSERT INTO cities VALUES ('1340', '90', 'Yomou', '0', '0');
INSERT INTO cities VALUES ('1341', '90', 'Coyah', '0', '0');
INSERT INTO cities VALUES ('1342', '90', 'Dubreka', '0', '0');
INSERT INTO cities VALUES ('1343', '90', 'Kankan', '0', '0');
INSERT INTO cities VALUES ('1344', '90', 'Koubia', '0', '0');
INSERT INTO cities VALUES ('1345', '90', 'Labe', '0', '0');
INSERT INTO cities VALUES ('1346', '90', 'Lelouma', '0', '0');
INSERT INTO cities VALUES ('1347', '90', 'Lola', '0', '0');
INSERT INTO cities VALUES ('1348', '90', 'Mandiana', '0', '0');
INSERT INTO cities VALUES ('1349', '90', 'Nzerekore', '0', '0');
INSERT INTO cities VALUES ('1350', '90', 'Siguiri', '0', '0');
INSERT INTO cities VALUES ('1351', '65', 'Annobon', '0', '0');
INSERT INTO cities VALUES ('1352', '65', 'Bioko Norte', '0', '0');
INSERT INTO cities VALUES ('1353', '65', 'Bioko Sur', '0', '0');
INSERT INTO cities VALUES ('1354', '65', 'Centro Sur', '0', '0');
INSERT INTO cities VALUES ('1355', '65', 'Kie-Ntem', '0', '0');
INSERT INTO cities VALUES ('1356', '65', 'Litoral', '0', '0');
INSERT INTO cities VALUES ('1357', '65', 'Wele-Nzas', '0', '0');
INSERT INTO cities VALUES ('1358', '84', 'Evros', '0', '0');
INSERT INTO cities VALUES ('1359', '84', 'Rodhopi', '0', '0');
INSERT INTO cities VALUES ('1360', '84', 'Xanthi', '0', '0');
INSERT INTO cities VALUES ('1361', '84', 'Drama', '0', '0');
INSERT INTO cities VALUES ('1362', '84', 'Serrai', '0', '0');
INSERT INTO cities VALUES ('1363', '84', 'Kilkis', '0', '0');
INSERT INTO cities VALUES ('1364', '84', 'Pella', '0', '0');
INSERT INTO cities VALUES ('1365', '84', 'Florina', '0', '0');
INSERT INTO cities VALUES ('1366', '84', 'Kastoria', '0', '0');
INSERT INTO cities VALUES ('1367', '84', 'Grevena', '0', '0');
INSERT INTO cities VALUES ('1368', '84', 'Kozani', '0', '0');
INSERT INTO cities VALUES ('1369', '84', 'Imathia', '0', '0');
INSERT INTO cities VALUES ('1370', '84', 'Thessaloniki', '0', '0');
INSERT INTO cities VALUES ('1371', '84', 'Kavala', '0', '0');
INSERT INTO cities VALUES ('1372', '84', 'Khalkidhiki', '0', '0');
INSERT INTO cities VALUES ('1373', '84', 'Pieria', '0', '0');
INSERT INTO cities VALUES ('1374', '84', 'Ioannina', '0', '0');
INSERT INTO cities VALUES ('1375', '84', 'Thesprotia', '0', '0');
INSERT INTO cities VALUES ('1376', '84', 'Preveza', '0', '0');
INSERT INTO cities VALUES ('1377', '84', 'Arta', '0', '0');
INSERT INTO cities VALUES ('1378', '84', 'Larisa', '0', '0');
INSERT INTO cities VALUES ('1379', '84', 'Trikala', '0', '0');
INSERT INTO cities VALUES ('1380', '84', 'Kardhitsa', '0', '0');
INSERT INTO cities VALUES ('1381', '84', 'Magnisia', '0', '0');
INSERT INTO cities VALUES ('1382', '84', 'Kerkira', '0', '0');
INSERT INTO cities VALUES ('1383', '84', 'Levkas', '0', '0');
INSERT INTO cities VALUES ('1384', '84', 'Kefallinia', '0', '0');
INSERT INTO cities VALUES ('1385', '84', 'Zakinthos', '0', '0');
INSERT INTO cities VALUES ('1386', '84', 'Fthiotis', '0', '0');
INSERT INTO cities VALUES ('1387', '84', 'Evritania', '0', '0');
INSERT INTO cities VALUES ('1388', '84', 'Aitolia kai Akarnania', '0', '0');
INSERT INTO cities VALUES ('1389', '84', 'Fokis', '0', '0');
INSERT INTO cities VALUES ('1390', '84', 'Voiotia', '0', '0');
INSERT INTO cities VALUES ('1391', '84', 'Evvoia', '0', '0');
INSERT INTO cities VALUES ('1392', '84', 'Attiki', '0', '0');
INSERT INTO cities VALUES ('1393', '84', 'Argolis', '0', '0');
INSERT INTO cities VALUES ('1394', '84', 'Korinthia', '0', '0');
INSERT INTO cities VALUES ('1395', '84', 'Akhaia', '0', '0');
INSERT INTO cities VALUES ('1396', '84', 'Ilia', '0', '0');
INSERT INTO cities VALUES ('1397', '84', 'Messinia', '0', '0');
INSERT INTO cities VALUES ('1398', '84', 'Arkadhia', '0', '0');
INSERT INTO cities VALUES ('1399', '84', 'Lakonia', '0', '0');
INSERT INTO cities VALUES ('1400', '84', 'Khania', '0', '0');
INSERT INTO cities VALUES ('1401', '84', 'Rethimni', '0', '0');
INSERT INTO cities VALUES ('1402', '84', 'Iraklion', '0', '0');
INSERT INTO cities VALUES ('1403', '84', 'Lasithi', '0', '0');
INSERT INTO cities VALUES ('1404', '84', 'Dhodhekanisos', '0', '0');
INSERT INTO cities VALUES ('1405', '84', 'Samos', '0', '0');
INSERT INTO cities VALUES ('1406', '84', 'Kikladhes', '0', '0');
INSERT INTO cities VALUES ('1407', '84', 'Khios', '0', '0');
INSERT INTO cities VALUES ('1408', '84', 'Lesvos', '0', '0');
INSERT INTO cities VALUES ('1409', '89', 'Alta Verapaz', '0', '0');
INSERT INTO cities VALUES ('1410', '89', 'Baja Verapaz', '0', '0');
INSERT INTO cities VALUES ('1411', '89', 'Chimaltenango', '0', '0');
INSERT INTO cities VALUES ('1412', '89', 'Chiquimula', '0', '0');
INSERT INTO cities VALUES ('1413', '89', 'El Progreso', '0', '0');
INSERT INTO cities VALUES ('1414', '89', 'Escuintla', '0', '0');
INSERT INTO cities VALUES ('1415', '89', 'Guatemala', '0', '0');
INSERT INTO cities VALUES ('1416', '89', 'Huehuetenango', '0', '0');
INSERT INTO cities VALUES ('1417', '89', 'Izabal', '0', '0');
INSERT INTO cities VALUES ('1418', '89', 'Jalapa', '0', '0');
INSERT INTO cities VALUES ('1419', '89', 'Jutiapa', '0', '0');
INSERT INTO cities VALUES ('1420', '89', 'Peten', '0', '0');
INSERT INTO cities VALUES ('1421', '89', 'Quetzaltenango', '0', '0');
INSERT INTO cities VALUES ('1422', '89', 'Quiche', '0', '0');
INSERT INTO cities VALUES ('1423', '89', 'Retalhuleu', '0', '0');
INSERT INTO cities VALUES ('1424', '89', 'Sacatepequez', '0', '0');
INSERT INTO cities VALUES ('1425', '89', 'San Marcos', '0', '0');
INSERT INTO cities VALUES ('1426', '89', 'Santa Rosa', '0', '0');
INSERT INTO cities VALUES ('1427', '89', 'Solola', '0', '0');
INSERT INTO cities VALUES ('1428', '89', 'Suchitepequez', '0', '0');
INSERT INTO cities VALUES ('1429', '89', 'Totonicapan', '0', '0');
INSERT INTO cities VALUES ('1430', '89', 'Zacapa', '0', '0');
INSERT INTO cities VALUES ('1431', '91', 'Bafata', '0', '0');
INSERT INTO cities VALUES ('1432', '91', 'Quinara', '0', '0');
INSERT INTO cities VALUES ('1433', '91', 'Oio', '0', '0');
INSERT INTO cities VALUES ('1434', '91', 'Bolama', '0', '0');
INSERT INTO cities VALUES ('1435', '91', 'Cacheu', '0', '0');
INSERT INTO cities VALUES ('1436', '91', 'Tombali', '0', '0');
INSERT INTO cities VALUES ('1437', '91', 'Gabu', '0', '0');
INSERT INTO cities VALUES ('1438', '91', 'Bissau', '0', '0');
INSERT INTO cities VALUES ('1439', '91', 'Biombo', '0', '0');
INSERT INTO cities VALUES ('1440', '92', 'Barima-Waini', '0', '0');
INSERT INTO cities VALUES ('1441', '92', 'Cuyuni-Mazaruni', '0', '0');
INSERT INTO cities VALUES ('1442', '92', 'Demerara-Mahaica', '0', '0');
INSERT INTO cities VALUES ('1443', '92', 'East Berbice-Corentyne', '0', '0');
INSERT INTO cities VALUES ('1444', '92', 'Essequibo Islands-West Demerara', '0', '0');
INSERT INTO cities VALUES ('1445', '92', 'Mahaica-Berbice', '0', '0');
INSERT INTO cities VALUES ('1446', '92', 'Pomeroon-Supenaam', '0', '0');
INSERT INTO cities VALUES ('1447', '92', 'Potaro-Siparuni', '0', '0');
INSERT INTO cities VALUES ('1448', '92', 'Upper Demerara-Berbice', '0', '0');
INSERT INTO cities VALUES ('1449', '92', 'Upper Takutu-Upper Essequibo', '0', '0');
INSERT INTO cities VALUES ('1450', '95', 'Atlantida', '0', '0');
INSERT INTO cities VALUES ('1451', '95', 'Choluteca', '0', '0');
INSERT INTO cities VALUES ('1452', '95', 'Colon', '0', '0');
INSERT INTO cities VALUES ('1453', '95', 'Comayagua', '0', '0');
INSERT INTO cities VALUES ('1454', '95', 'Copan', '0', '0');
INSERT INTO cities VALUES ('1455', '95', 'Cortes', '0', '0');
INSERT INTO cities VALUES ('1456', '95', 'El Paraiso', '0', '0');
INSERT INTO cities VALUES ('1457', '95', 'Francisco Morazan', '0', '0');
INSERT INTO cities VALUES ('1458', '95', 'Gracias a Dios', '0', '0');
INSERT INTO cities VALUES ('1459', '95', 'Intibuca', '0', '0');
INSERT INTO cities VALUES ('1460', '95', 'Islas de la Bahia', '0', '0');
INSERT INTO cities VALUES ('1461', '95', 'La Paz', '0', '0');
INSERT INTO cities VALUES ('1462', '95', 'Lempira', '0', '0');
INSERT INTO cities VALUES ('1463', '95', 'Ocotepeque', '0', '0');
INSERT INTO cities VALUES ('1464', '95', 'Olancho', '0', '0');
INSERT INTO cities VALUES ('1465', '95', 'Santa Barbara', '0', '0');
INSERT INTO cities VALUES ('1466', '95', 'Valle', '0', '0');
INSERT INTO cities VALUES ('1467', '95', 'Yoro', '0', '0');
INSERT INTO cities VALUES ('1468', '53', 'Bjelovarsko-Bilogorska', '0', '0');
INSERT INTO cities VALUES ('1469', '53', 'Brodsko-Posavska', '0', '0');
INSERT INTO cities VALUES ('1470', '53', 'Dubrovacko-Neretvanska', '0', '0');
INSERT INTO cities VALUES ('1471', '53', 'Istarska', '0', '0');
INSERT INTO cities VALUES ('1472', '53', 'Karlovacka', '0', '0');
INSERT INTO cities VALUES ('1473', '53', 'Koprivnicko-Krizevacka', '0', '0');
INSERT INTO cities VALUES ('1474', '53', 'Krapinsko-Zagorska', '0', '0');
INSERT INTO cities VALUES ('1475', '53', 'Licko-Senjska', '0', '0');
INSERT INTO cities VALUES ('1476', '53', 'Medimurska', '0', '0');
INSERT INTO cities VALUES ('1477', '53', 'Osjecko-Baranjska', '0', '0');
INSERT INTO cities VALUES ('1478', '53', 'Pozesko-Slavonska', '0', '0');
INSERT INTO cities VALUES ('1479', '53', 'Primorsko-Goranska', '0', '0');
INSERT INTO cities VALUES ('1480', '53', 'Sibensko-Kninska', '0', '0');
INSERT INTO cities VALUES ('1481', '53', 'Sisacko-Moslavacka', '0', '0');
INSERT INTO cities VALUES ('1482', '53', 'Splitsko-Dalmatinska', '0', '0');
INSERT INTO cities VALUES ('1483', '53', 'Varazdinska', '0', '0');
INSERT INTO cities VALUES ('1484', '53', 'Viroviticko-Podravska', '0', '0');
INSERT INTO cities VALUES ('1485', '53', 'Vukovarsko-Srijemska', '0', '0');
INSERT INTO cities VALUES ('1486', '53', 'Zadarska', '0', '0');
INSERT INTO cities VALUES ('1487', '53', 'Zagrebacka', '0', '0');
INSERT INTO cities VALUES ('1488', '53', 'Grad Zagreb', '0', '0');
INSERT INTO cities VALUES ('1489', '93', 'Nord-Ouest', '0', '0');
INSERT INTO cities VALUES ('1490', '93', 'Artibonite', '0', '0');
INSERT INTO cities VALUES ('1491', '93', 'Centre', '0', '0');
INSERT INTO cities VALUES ('1492', '93', 'Nord', '0', '0');
INSERT INTO cities VALUES ('1493', '93', 'Nord-Est', '0', '0');
INSERT INTO cities VALUES ('1494', '93', 'Ouest', '0', '0');
INSERT INTO cities VALUES ('1495', '93', 'Sud', '0', '0');
INSERT INTO cities VALUES ('1496', '93', 'Sud-Est', '0', '0');
INSERT INTO cities VALUES ('1497', '93', 'Grand\' Anse', '0', '0');
INSERT INTO cities VALUES ('1498', '93', 'Nippes', '0', '0');
INSERT INTO cities VALUES ('1499', '97', 'Bacs-Kiskun', '0', '0');
INSERT INTO cities VALUES ('1500', '97', 'Baranya', '0', '0');
INSERT INTO cities VALUES ('1501', '97', 'Bekes', '0', '0');
INSERT INTO cities VALUES ('1502', '97', 'Borsod-Abauj-Zemplen', '0', '0');
INSERT INTO cities VALUES ('1503', '97', 'Budapest', '0', '0');
INSERT INTO cities VALUES ('1504', '97', 'Csongrad', '0', '0');
INSERT INTO cities VALUES ('1505', '97', 'Debrecen', '0', '0');
INSERT INTO cities VALUES ('1506', '97', 'Fejer', '0', '0');
INSERT INTO cities VALUES ('1507', '97', 'Gyor-Moson-Sopron', '0', '0');
INSERT INTO cities VALUES ('1508', '97', 'Hajdu-Bihar', '0', '0');
INSERT INTO cities VALUES ('1509', '97', 'Heves', '0', '0');
INSERT INTO cities VALUES ('1510', '97', 'Komarom-Esztergom', '0', '0');
INSERT INTO cities VALUES ('1511', '97', 'Miskolc', '0', '0');
INSERT INTO cities VALUES ('1512', '97', 'Nograd', '0', '0');
INSERT INTO cities VALUES ('1513', '97', 'Pecs', '0', '0');
INSERT INTO cities VALUES ('1514', '97', 'Pest', '0', '0');
INSERT INTO cities VALUES ('1515', '97', 'Somogy', '0', '0');
INSERT INTO cities VALUES ('1516', '97', 'Szabolcs-Szatmar-Bereg', '0', '0');
INSERT INTO cities VALUES ('1517', '97', 'Szeged', '0', '0');
INSERT INTO cities VALUES ('1518', '97', 'Jasz-Nagykun-Szolnok', '0', '0');
INSERT INTO cities VALUES ('1519', '97', 'Tolna', '0', '0');
INSERT INTO cities VALUES ('1520', '97', 'Vas', '0', '0');
INSERT INTO cities VALUES ('1521', '97', 'Veszprem', '0', '0');
INSERT INTO cities VALUES ('1522', '97', 'Zala', '0', '0');
INSERT INTO cities VALUES ('1523', '97', 'Gyor', '0', '0');
INSERT INTO cities VALUES ('1524', '97', 'Bekescsaba', '0', '0');
INSERT INTO cities VALUES ('1525', '97', 'Dunaujvaros', '0', '0');
INSERT INTO cities VALUES ('1526', '97', 'Eger', '0', '0');
INSERT INTO cities VALUES ('1527', '97', 'Hodmezovasarhely', '0', '0');
INSERT INTO cities VALUES ('1528', '97', 'Kaposvar', '0', '0');
INSERT INTO cities VALUES ('1529', '97', 'Kecskemet', '0', '0');
INSERT INTO cities VALUES ('1530', '97', 'Nagykanizsa', '0', '0');
INSERT INTO cities VALUES ('1531', '97', 'Nyiregyhaza', '0', '0');
INSERT INTO cities VALUES ('1532', '97', 'Sopron', '0', '0');
INSERT INTO cities VALUES ('1533', '97', 'Szekesfehervar', '0', '0');
INSERT INTO cities VALUES ('1534', '97', 'Szolnok', '0', '0');
INSERT INTO cities VALUES ('1535', '97', 'Szombathely', '0', '0');
INSERT INTO cities VALUES ('1536', '97', 'Tatabanya', '0', '0');
INSERT INTO cities VALUES ('1537', '97', 'Veszprem', '0', '0');
INSERT INTO cities VALUES ('1538', '97', 'Zalaegerszeg', '0', '0');
INSERT INTO cities VALUES ('1539', '97', 'Salgotarjan', '0', '0');
INSERT INTO cities VALUES ('1540', '97', 'Szekszard', '0', '0');
INSERT INTO cities VALUES ('1541', '97', 'Erd', '0', '0');
INSERT INTO cities VALUES ('1542', '100', 'Aceh', '0', '0');
INSERT INTO cities VALUES ('1543', '100', 'Bali', '0', '0');
INSERT INTO cities VALUES ('1544', '100', 'Bengkulu', '0', '0');
INSERT INTO cities VALUES ('1545', '100', 'Jakarta Raya', '0', '0');
INSERT INTO cities VALUES ('1546', '100', 'Jambi', '0', '0');
INSERT INTO cities VALUES ('1547', '100', 'Jawa Tengah', '0', '0');
INSERT INTO cities VALUES ('1548', '100', 'Jawa Timur', '0', '0');
INSERT INTO cities VALUES ('1549', '100', 'Yogyakarta', '0', '0');
INSERT INTO cities VALUES ('1550', '100', 'Kalimantan Barat', '0', '0');
INSERT INTO cities VALUES ('1551', '100', 'Kalimantan Selatan', '0', '0');
INSERT INTO cities VALUES ('1552', '100', 'Kalimantan Tengah', '0', '0');
INSERT INTO cities VALUES ('1553', '100', 'Kalimantan Timur', '0', '0');
INSERT INTO cities VALUES ('1554', '100', 'Lampung', '0', '0');
INSERT INTO cities VALUES ('1555', '100', 'Nusa Tenggara Barat', '0', '0');
INSERT INTO cities VALUES ('1556', '100', 'Nusa Tenggara Timur', '0', '0');
INSERT INTO cities VALUES ('1557', '100', 'Sulawesi Tengah', '0', '0');
INSERT INTO cities VALUES ('1558', '100', 'Sulawesi Tenggara', '0', '0');
INSERT INTO cities VALUES ('1559', '100', 'Sumatera Barat', '0', '0');
INSERT INTO cities VALUES ('1560', '100', 'Sumatera Utara', '0', '0');
INSERT INTO cities VALUES ('1561', '100', 'Maluku', '0', '0');
INSERT INTO cities VALUES ('1562', '100', 'Maluku Utara', '0', '0');
INSERT INTO cities VALUES ('1563', '100', 'Jawa Barat', '0', '0');
INSERT INTO cities VALUES ('1564', '100', 'Sulawesi Utara', '0', '0');
INSERT INTO cities VALUES ('1565', '100', 'Sumatera Selatan', '0', '0');
INSERT INTO cities VALUES ('1566', '100', 'Banten', '0', '0');
INSERT INTO cities VALUES ('1567', '100', 'Gorontalo', '0', '0');
INSERT INTO cities VALUES ('1568', '100', 'Kepulauan Bangka Belitung', '0', '0');
INSERT INTO cities VALUES ('1569', '100', 'Papua', '0', '0');
INSERT INTO cities VALUES ('1570', '100', 'Riau', '0', '0');
INSERT INTO cities VALUES ('1571', '100', 'Sulawesi Selatan', '0', '0');
INSERT INTO cities VALUES ('1572', '100', 'Irian Jaya Barat', '0', '0');
INSERT INTO cities VALUES ('1573', '100', 'Kepulauan Riau', '0', '0');
INSERT INTO cities VALUES ('1574', '100', 'Sulawesi Barat', '0', '0');
INSERT INTO cities VALUES ('1575', '103', 'Carlow', '0', '0');
INSERT INTO cities VALUES ('1576', '103', 'Cavan', '0', '0');
INSERT INTO cities VALUES ('1577', '103', 'Clare', '0', '0');
INSERT INTO cities VALUES ('1578', '103', 'Cork', '0', '0');
INSERT INTO cities VALUES ('1579', '103', 'Donegal', '0', '0');
INSERT INTO cities VALUES ('1580', '103', 'Dublin', '0', '0');
INSERT INTO cities VALUES ('1581', '103', 'Galway', '0', '0');
INSERT INTO cities VALUES ('1582', '103', 'Kerry', '0', '0');
INSERT INTO cities VALUES ('1583', '103', 'Kildare', '0', '0');
INSERT INTO cities VALUES ('1584', '103', 'Kilkenny', '0', '0');
INSERT INTO cities VALUES ('1585', '103', 'Leitrim', '0', '0');
INSERT INTO cities VALUES ('1586', '103', 'Laois', '0', '0');
INSERT INTO cities VALUES ('1587', '103', 'Limerick', '0', '0');
INSERT INTO cities VALUES ('1588', '103', 'Longford', '0', '0');
INSERT INTO cities VALUES ('1589', '103', 'Louth', '0', '0');
INSERT INTO cities VALUES ('1590', '103', 'Mayo', '0', '0');
INSERT INTO cities VALUES ('1591', '103', 'Meath', '0', '0');
INSERT INTO cities VALUES ('1592', '103', 'Monaghan', '0', '0');
INSERT INTO cities VALUES ('1593', '103', 'Offaly', '0', '0');
INSERT INTO cities VALUES ('1594', '103', 'Roscommon', '0', '0');
INSERT INTO cities VALUES ('1595', '103', 'Sligo', '0', '0');
INSERT INTO cities VALUES ('1596', '103', 'Tipperary', '0', '0');
INSERT INTO cities VALUES ('1597', '103', 'Waterford', '0', '0');
INSERT INTO cities VALUES ('1598', '103', 'Westmeath', '0', '0');
INSERT INTO cities VALUES ('1599', '103', 'Wexford', '0', '0');
INSERT INTO cities VALUES ('1600', '103', 'Wicklow', '0', '0');
INSERT INTO cities VALUES ('1601', '104', 'HaDarom', '0', '0');
INSERT INTO cities VALUES ('1602', '104', 'HaMerkaz', '0', '0');
INSERT INTO cities VALUES ('1603', '104', 'HaZafon', '0', '0');
INSERT INTO cities VALUES ('1604', '104', 'Hefa', '0', '0');
INSERT INTO cities VALUES ('1605', '104', 'Tel Aviv', '0', '0');
INSERT INTO cities VALUES ('1606', '104', 'Yerushalayim', '0', '0');
INSERT INTO cities VALUES ('1607', '99', 'Andaman and Nicobar Islands', '0', '0');
INSERT INTO cities VALUES ('1608', '99', 'Andhra Pradesh', '0', '0');
INSERT INTO cities VALUES ('1609', '99', 'Assam', '0', '0');
INSERT INTO cities VALUES ('1610', '99', 'Chandigarh', '0', '0');
INSERT INTO cities VALUES ('1611', '99', 'Dadra and Nagar Haveli', '0', '0');
INSERT INTO cities VALUES ('1612', '99', 'Delhi', '0', '0');
INSERT INTO cities VALUES ('1613', '99', 'Gujarat', '0', '0');
INSERT INTO cities VALUES ('1614', '99', 'Haryana', '0', '0');
INSERT INTO cities VALUES ('1615', '99', 'Himachal Pradesh', '0', '0');
INSERT INTO cities VALUES ('1616', '99', 'Jammu and Kashmir', '0', '0');
INSERT INTO cities VALUES ('1617', '99', 'Kerala', '0', '0');
INSERT INTO cities VALUES ('1618', '99', 'Lakshadweep', '0', '0');
INSERT INTO cities VALUES ('1619', '99', 'Maharashtra', '0', '0');
INSERT INTO cities VALUES ('1620', '99', 'Manipur', '0', '0');
INSERT INTO cities VALUES ('1621', '99', 'Meghalaya', '0', '0');
INSERT INTO cities VALUES ('1622', '99', 'Karnataka', '0', '0');
INSERT INTO cities VALUES ('1623', '99', 'Nagaland', '0', '0');
INSERT INTO cities VALUES ('1624', '99', 'Orissa', '0', '0');
INSERT INTO cities VALUES ('1625', '99', 'Puducherry', '0', '0');
INSERT INTO cities VALUES ('1626', '99', 'Punjab', '0', '0');
INSERT INTO cities VALUES ('1627', '99', 'Rajasthan', '0', '0');
INSERT INTO cities VALUES ('1628', '99', 'Tamil Nadu', '0', '0');
INSERT INTO cities VALUES ('1629', '99', 'Tripura', '0', '0');
INSERT INTO cities VALUES ('1630', '99', 'West Bengal', '0', '0');
INSERT INTO cities VALUES ('1631', '99', 'Sikkim', '0', '0');
INSERT INTO cities VALUES ('1632', '99', 'Arunachal Pradesh', '0', '0');
INSERT INTO cities VALUES ('1633', '99', 'Mizoram', '0', '0');
INSERT INTO cities VALUES ('1634', '99', 'Daman and Diu', '0', '0');
INSERT INTO cities VALUES ('1635', '99', 'Goa', '0', '0');
INSERT INTO cities VALUES ('1636', '99', 'Bihar', '0', '0');
INSERT INTO cities VALUES ('1637', '99', 'Madhya Pradesh', '0', '0');
INSERT INTO cities VALUES ('1638', '99', 'Uttar Pradesh', '0', '0');
INSERT INTO cities VALUES ('1639', '99', 'Chhattisgarh', '0', '0');
INSERT INTO cities VALUES ('1640', '99', 'Jharkhand', '0', '0');
INSERT INTO cities VALUES ('1641', '99', 'Uttarakhand', '0', '0');
INSERT INTO cities VALUES ('1642', '102', 'Al Anbar', '0', '0');
INSERT INTO cities VALUES ('1643', '102', 'Al Basrah', '0', '0');
INSERT INTO cities VALUES ('1644', '102', 'Al Muthanna', '0', '0');
INSERT INTO cities VALUES ('1645', '102', 'Al Qadisiyah', '0', '0');
INSERT INTO cities VALUES ('1646', '102', 'As Sulaymaniyah', '0', '0');
INSERT INTO cities VALUES ('1647', '102', 'Babil', '0', '0');
INSERT INTO cities VALUES ('1648', '102', 'Baghdad', '0', '0');
INSERT INTO cities VALUES ('1649', '102', 'Dahuk', '0', '0');
INSERT INTO cities VALUES ('1650', '102', 'Dhi Qar', '0', '0');
INSERT INTO cities VALUES ('1651', '102', 'Diyala', '0', '0');
INSERT INTO cities VALUES ('1652', '102', 'Arbil', '0', '0');
INSERT INTO cities VALUES ('1653', '102', 'Karbala\'', '0', '0');
INSERT INTO cities VALUES ('1654', '102', 'At Ta\'mim', '0', '0');
INSERT INTO cities VALUES ('1655', '102', 'Maysan', '0', '0');
INSERT INTO cities VALUES ('1656', '102', 'Ninawa', '0', '0');
INSERT INTO cities VALUES ('1657', '102', 'Wasit', '0', '0');
INSERT INTO cities VALUES ('1658', '102', 'An Najaf', '0', '0');
INSERT INTO cities VALUES ('1659', '102', 'Salah ad Din', '0', '0');
INSERT INTO cities VALUES ('1660', '101', 'Azarbayjan-e Bakhtari', '0', '0');
INSERT INTO cities VALUES ('1661', '101', 'Chahar Mahall va Bakhtiari', '0', '0');
INSERT INTO cities VALUES ('1662', '101', 'Sistan va Baluchestan', '0', '0');
INSERT INTO cities VALUES ('1663', '101', 'Kohkiluyeh va Buyer Ahmadi', '0', '0');
INSERT INTO cities VALUES ('1664', '101', 'Fars', '0', '0');
INSERT INTO cities VALUES ('1665', '101', 'Gilan', '0', '0');
INSERT INTO cities VALUES ('1666', '101', 'Hamadan', '0', '0');
INSERT INTO cities VALUES ('1667', '101', 'Ilam', '0', '0');
INSERT INTO cities VALUES ('1668', '101', 'Hormozgan', '0', '0');
INSERT INTO cities VALUES ('1669', '101', 'Kerman', '0', '0');
INSERT INTO cities VALUES ('1670', '101', 'Bakhtaran', '0', '0');
INSERT INTO cities VALUES ('1671', '101', 'Khuzestan', '0', '0');
INSERT INTO cities VALUES ('1672', '101', 'Kordestan', '0', '0');
INSERT INTO cities VALUES ('1673', '101', 'Mazandaran', '0', '0');
INSERT INTO cities VALUES ('1674', '101', 'Semnan Province', '0', '0');
INSERT INTO cities VALUES ('1675', '101', 'Markazi', '0', '0');
INSERT INTO cities VALUES ('1676', '101', 'Zanjan', '0', '0');
INSERT INTO cities VALUES ('1677', '101', 'Bushehr', '0', '0');
INSERT INTO cities VALUES ('1678', '101', 'Lorestan', '0', '0');
INSERT INTO cities VALUES ('1679', '101', 'Markazi', '0', '0');
INSERT INTO cities VALUES ('1680', '101', 'Semnan', '0', '0');
INSERT INTO cities VALUES ('1681', '101', 'Tehran', '0', '0');
INSERT INTO cities VALUES ('1682', '101', 'Zanjan', '0', '0');
INSERT INTO cities VALUES ('1683', '101', 'Esfahan', '0', '0');
INSERT INTO cities VALUES ('1684', '101', 'Kerman', '0', '0');
INSERT INTO cities VALUES ('1685', '101', 'Khorasan', '0', '0');
INSERT INTO cities VALUES ('1686', '101', 'Yazd', '0', '0');
INSERT INTO cities VALUES ('1687', '101', 'Ardabil', '0', '0');
INSERT INTO cities VALUES ('1688', '101', 'East Azarbaijan', '0', '0');
INSERT INTO cities VALUES ('1689', '101', 'Markazi', '0', '0');
INSERT INTO cities VALUES ('1690', '101', 'Mazandaran', '0', '0');
INSERT INTO cities VALUES ('1691', '101', 'Zanjan', '0', '0');
INSERT INTO cities VALUES ('1692', '101', 'Golestan', '0', '0');
INSERT INTO cities VALUES ('1693', '101', 'Qazvin', '0', '0');
INSERT INTO cities VALUES ('1694', '101', 'Qom', '0', '0');
INSERT INTO cities VALUES ('1695', '101', 'Yazd', '0', '0');
INSERT INTO cities VALUES ('1696', '101', 'Khorasan-e Janubi', '0', '0');
INSERT INTO cities VALUES ('1697', '101', 'Khorasan-e Razavi', '0', '0');
INSERT INTO cities VALUES ('1698', '101', 'Khorasan-e Shemali', '0', '0');
INSERT INTO cities VALUES ('1699', '101', 'Alborz', '0', '0');
INSERT INTO cities VALUES ('1700', '98', 'Arnessysla', '0', '0');
INSERT INTO cities VALUES ('1701', '98', 'Austur-Hunavatnssysla', '0', '0');
INSERT INTO cities VALUES ('1702', '98', 'Austur-Skaftafellssysla', '0', '0');
INSERT INTO cities VALUES ('1703', '98', 'Borgarfjardarsysla', '0', '0');
INSERT INTO cities VALUES ('1704', '98', 'Eyjafjardarsysla', '0', '0');
INSERT INTO cities VALUES ('1705', '98', 'Gullbringusysla', '0', '0');
INSERT INTO cities VALUES ('1706', '98', 'Kjosarsysla', '0', '0');
INSERT INTO cities VALUES ('1707', '98', 'Myrasysla', '0', '0');
INSERT INTO cities VALUES ('1708', '98', 'Nordur-Mulasysla', '0', '0');
INSERT INTO cities VALUES ('1709', '98', 'Nordur-Tingeyjarsysla', '0', '0');
INSERT INTO cities VALUES ('1710', '98', 'Rangarvallasysla', '0', '0');
INSERT INTO cities VALUES ('1711', '98', 'Skagafjardarsysla', '0', '0');
INSERT INTO cities VALUES ('1712', '98', 'Snafellsnes- og Hnappadalssysla', '0', '0');
INSERT INTO cities VALUES ('1713', '98', 'Strandasysla', '0', '0');
INSERT INTO cities VALUES ('1714', '98', 'Sudur-Mulasysla', '0', '0');
INSERT INTO cities VALUES ('1715', '98', 'Sudur-Tingeyjarsysla', '0', '0');
INSERT INTO cities VALUES ('1716', '98', 'Vestur-Bardastrandarsysla', '0', '0');
INSERT INTO cities VALUES ('1717', '98', 'Vestur-Hunavatnssysla', '0', '0');
INSERT INTO cities VALUES ('1718', '98', 'Vestur-Isafjardarsysla', '0', '0');
INSERT INTO cities VALUES ('1719', '98', 'Vestur-Skaftafellssysla', '0', '0');
INSERT INTO cities VALUES ('1720', '98', 'Austurland', '0', '0');
INSERT INTO cities VALUES ('1721', '98', 'Hofuoborgarsvaoio', '0', '0');
INSERT INTO cities VALUES ('1722', '98', 'Norourland Eystra', '0', '0');
INSERT INTO cities VALUES ('1723', '98', 'Norourland Vestra', '0', '0');
INSERT INTO cities VALUES ('1724', '98', 'Suourland', '0', '0');
INSERT INTO cities VALUES ('1725', '98', 'Suournes', '0', '0');
INSERT INTO cities VALUES ('1726', '98', 'Vestfiroir', '0', '0');
INSERT INTO cities VALUES ('1727', '98', 'Vesturland', '0', '0');
INSERT INTO cities VALUES ('1728', '105', 'Abruzzi', '0', '0');
INSERT INTO cities VALUES ('1729', '105', 'Basilicata', '0', '0');
INSERT INTO cities VALUES ('1730', '105', 'Calabria', '0', '0');
INSERT INTO cities VALUES ('1731', '105', 'Campania', '0', '0');
INSERT INTO cities VALUES ('1732', '105', 'Emilia-Romagna', '0', '0');
INSERT INTO cities VALUES ('1733', '105', 'Friuli-Venezia Giulia', '0', '0');
INSERT INTO cities VALUES ('1734', '105', 'Lazio', '0', '0');
INSERT INTO cities VALUES ('1735', '105', 'Liguria', '0', '0');
INSERT INTO cities VALUES ('1736', '105', 'Lombardia', '0', '0');
INSERT INTO cities VALUES ('1737', '105', 'Marche', '0', '0');
INSERT INTO cities VALUES ('1738', '105', 'Molise', '0', '0');
INSERT INTO cities VALUES ('1739', '105', 'Piemonte', '0', '0');
INSERT INTO cities VALUES ('1740', '105', 'Puglia', '0', '0');
INSERT INTO cities VALUES ('1741', '105', 'Sardegna', '0', '0');
INSERT INTO cities VALUES ('1742', '105', 'Sicilia', '0', '0');
INSERT INTO cities VALUES ('1743', '105', 'Toscana', '0', '0');
INSERT INTO cities VALUES ('1744', '105', 'Trentino-Alto Adige', '0', '0');
INSERT INTO cities VALUES ('1745', '105', 'Umbria', '0', '0');
INSERT INTO cities VALUES ('1746', '105', 'Valle d\'Aosta', '0', '0');
INSERT INTO cities VALUES ('1747', '105', 'Veneto', '0', '0');
INSERT INTO cities VALUES ('1748', '106', 'Clarendon', '0', '0');
INSERT INTO cities VALUES ('1749', '106', 'Hanover', '0', '0');
INSERT INTO cities VALUES ('1750', '106', 'Manchester', '0', '0');
INSERT INTO cities VALUES ('1751', '106', 'Portland', '0', '0');
INSERT INTO cities VALUES ('1752', '106', 'Saint Andrew', '0', '0');
INSERT INTO cities VALUES ('1753', '106', 'Saint Ann', '0', '0');
INSERT INTO cities VALUES ('1754', '106', 'Saint Catherine', '0', '0');
INSERT INTO cities VALUES ('1755', '106', 'Saint Elizabeth', '0', '0');
INSERT INTO cities VALUES ('1756', '106', 'Saint James', '0', '0');
INSERT INTO cities VALUES ('1757', '106', 'Saint Mary', '0', '0');
INSERT INTO cities VALUES ('1758', '106', 'Saint Thomas', '0', '0');
INSERT INTO cities VALUES ('1759', '106', 'Trelawny', '0', '0');
INSERT INTO cities VALUES ('1760', '106', 'Westmoreland', '0', '0');
INSERT INTO cities VALUES ('1761', '106', 'Kingston', '0', '0');
INSERT INTO cities VALUES ('1762', '108', 'Al Balqa\'', '0', '0');
INSERT INTO cities VALUES ('1763', '108', 'Al Karak', '0', '0');
INSERT INTO cities VALUES ('1764', '108', 'At Tafilah', '0', '0');
INSERT INTO cities VALUES ('1765', '108', 'Al Mafraq', '0', '0');
INSERT INTO cities VALUES ('1766', '108', 'Amman', '0', '0');
INSERT INTO cities VALUES ('1767', '108', 'Az Zaraqa', '0', '0');
INSERT INTO cities VALUES ('1768', '108', 'Irbid', '0', '0');
INSERT INTO cities VALUES ('1769', '108', 'Ma\'an', '0', '0');
INSERT INTO cities VALUES ('1770', '108', 'Ajlun', '0', '0');
INSERT INTO cities VALUES ('1771', '108', 'Al Aqabah', '0', '0');
INSERT INTO cities VALUES ('1772', '108', 'Jarash', '0', '0');
INSERT INTO cities VALUES ('1773', '108', 'Madaba', '0', '0');
INSERT INTO cities VALUES ('1774', '107', 'Aichi', '0', '0');
INSERT INTO cities VALUES ('1775', '107', 'Akita', '0', '0');
INSERT INTO cities VALUES ('1776', '107', 'Aomori', '0', '0');
INSERT INTO cities VALUES ('1777', '107', 'Chiba', '0', '0');
INSERT INTO cities VALUES ('1778', '107', 'Ehime', '0', '0');
INSERT INTO cities VALUES ('1779', '107', 'Fukui', '0', '0');
INSERT INTO cities VALUES ('1780', '107', 'Fukuoka', '0', '0');
INSERT INTO cities VALUES ('1781', '107', 'Fukushima', '0', '0');
INSERT INTO cities VALUES ('1782', '107', 'Gifu', '0', '0');
INSERT INTO cities VALUES ('1783', '107', 'Gumma', '0', '0');
INSERT INTO cities VALUES ('1784', '107', 'Hiroshima', '0', '0');
INSERT INTO cities VALUES ('1785', '107', 'Hokkaido', '0', '0');
INSERT INTO cities VALUES ('1786', '107', 'Hyogo', '0', '0');
INSERT INTO cities VALUES ('1787', '107', 'Ibaraki', '0', '0');
INSERT INTO cities VALUES ('1788', '107', 'Ishikawa', '0', '0');
INSERT INTO cities VALUES ('1789', '107', 'Iwate', '0', '0');
INSERT INTO cities VALUES ('1790', '107', 'Kagawa', '0', '0');
INSERT INTO cities VALUES ('1791', '107', 'Kagoshima', '0', '0');
INSERT INTO cities VALUES ('1792', '107', 'Kanagawa', '0', '0');
INSERT INTO cities VALUES ('1793', '107', 'Kochi', '0', '0');
INSERT INTO cities VALUES ('1794', '107', 'Kumamoto', '0', '0');
INSERT INTO cities VALUES ('1795', '107', 'Kyoto', '0', '0');
INSERT INTO cities VALUES ('1796', '107', 'Mie', '0', '0');
INSERT INTO cities VALUES ('1797', '107', 'Miyagi', '0', '0');
INSERT INTO cities VALUES ('1798', '107', 'Miyazaki', '0', '0');
INSERT INTO cities VALUES ('1799', '107', 'Nagano', '0', '0');
INSERT INTO cities VALUES ('1800', '107', 'Nagasaki', '0', '0');
INSERT INTO cities VALUES ('1801', '107', 'Nara', '0', '0');
INSERT INTO cities VALUES ('1802', '107', 'Niigata', '0', '0');
INSERT INTO cities VALUES ('1803', '107', 'Oita', '0', '0');
INSERT INTO cities VALUES ('1804', '107', 'Okayama', '0', '0');
INSERT INTO cities VALUES ('1805', '107', 'Osaka', '0', '0');
INSERT INTO cities VALUES ('1806', '107', 'Saga', '0', '0');
INSERT INTO cities VALUES ('1807', '107', 'Saitama', '0', '0');
INSERT INTO cities VALUES ('1808', '107', 'Shiga', '0', '0');
INSERT INTO cities VALUES ('1809', '107', 'Shimane', '0', '0');
INSERT INTO cities VALUES ('1810', '107', 'Shizuoka', '0', '0');
INSERT INTO cities VALUES ('1811', '107', 'Tochigi', '0', '0');
INSERT INTO cities VALUES ('1812', '107', 'Tokushima', '0', '0');
INSERT INTO cities VALUES ('1813', '107', 'Tokyo', '0', '0');
INSERT INTO cities VALUES ('1814', '107', 'Tottori', '0', '0');
INSERT INTO cities VALUES ('1815', '107', 'Toyama', '0', '0');
INSERT INTO cities VALUES ('1816', '107', 'Wakayama', '0', '0');
INSERT INTO cities VALUES ('1817', '107', 'Yamagata', '0', '0');
INSERT INTO cities VALUES ('1818', '107', 'Yamaguchi', '0', '0');
INSERT INTO cities VALUES ('1819', '107', 'Yamanashi', '0', '0');
INSERT INTO cities VALUES ('1820', '107', 'Okinawa', '0', '0');
INSERT INTO cities VALUES ('1821', '110', 'Central', '0', '0');
INSERT INTO cities VALUES ('1822', '110', 'Coast', '0', '0');
INSERT INTO cities VALUES ('1823', '110', 'Eastern', '0', '0');
INSERT INTO cities VALUES ('1824', '110', 'Nairobi Area', '0', '0');
INSERT INTO cities VALUES ('1825', '110', 'North-Eastern', '0', '0');
INSERT INTO cities VALUES ('1826', '110', 'Nyanza', '0', '0');
INSERT INTO cities VALUES ('1827', '110', 'Rift Valley', '0', '0');
INSERT INTO cities VALUES ('1828', '110', 'Western', '0', '0');
INSERT INTO cities VALUES ('1829', '115', 'Bishkek', '0', '0');
INSERT INTO cities VALUES ('1830', '115', 'Chuy', '0', '0');
INSERT INTO cities VALUES ('1831', '115', 'Jalal-Abad', '0', '0');
INSERT INTO cities VALUES ('1832', '115', 'Naryn', '0', '0');
INSERT INTO cities VALUES ('1833', '115', 'Osh', '0', '0');
INSERT INTO cities VALUES ('1834', '115', 'Talas', '0', '0');
INSERT INTO cities VALUES ('1835', '115', 'Ysyk-Kol', '0', '0');
INSERT INTO cities VALUES ('1836', '115', 'Osh', '0', '0');
INSERT INTO cities VALUES ('1837', '115', 'Batken', '0', '0');
INSERT INTO cities VALUES ('1838', '36', 'Batdambang', '0', '0');
INSERT INTO cities VALUES ('1839', '36', 'Kampong Cham', '0', '0');
INSERT INTO cities VALUES ('1840', '36', 'Kampong Chhnang', '0', '0');
INSERT INTO cities VALUES ('1841', '36', 'Kampong Speu', '0', '0');
INSERT INTO cities VALUES ('1842', '36', 'Kampong Thum', '0', '0');
INSERT INTO cities VALUES ('1843', '36', 'Kampot', '0', '0');
INSERT INTO cities VALUES ('1844', '36', 'Kandal', '0', '0');
INSERT INTO cities VALUES ('1845', '36', 'Koh Kong', '0', '0');
INSERT INTO cities VALUES ('1846', '36', 'Kracheh', '0', '0');
INSERT INTO cities VALUES ('1847', '36', 'Mondulkiri', '0', '0');
INSERT INTO cities VALUES ('1848', '36', 'Phnum Penh', '0', '0');
INSERT INTO cities VALUES ('1849', '36', 'Pursat', '0', '0');
INSERT INTO cities VALUES ('1850', '36', 'Preah Vihear', '0', '0');
INSERT INTO cities VALUES ('1851', '36', 'Prey Veng', '0', '0');
INSERT INTO cities VALUES ('1852', '36', 'Ratanakiri Kiri', '0', '0');
INSERT INTO cities VALUES ('1853', '36', 'Siem Reap', '0', '0');
INSERT INTO cities VALUES ('1854', '36', 'Stung Treng', '0', '0');
INSERT INTO cities VALUES ('1855', '36', 'Svay Rieng', '0', '0');
INSERT INTO cities VALUES ('1856', '36', 'Takeo', '0', '0');
INSERT INTO cities VALUES ('1857', '36', 'Banteay Meanchey', '0', '0');
INSERT INTO cities VALUES ('1858', '36', 'Batdambang', '0', '0');
INSERT INTO cities VALUES ('1859', '36', 'Pailin', '0', '0');
INSERT INTO cities VALUES ('1860', '111', 'Gilbert Islands', '0', '0');
INSERT INTO cities VALUES ('1861', '111', 'Line Islands', '0', '0');
INSERT INTO cities VALUES ('1862', '111', 'Phoenix Islands', '0', '0');
INSERT INTO cities VALUES ('1863', '48', 'Anjouan', '0', '0');
INSERT INTO cities VALUES ('1864', '48', 'Grande Comore', '0', '0');
INSERT INTO cities VALUES ('1865', '48', 'Moheli', '0', '0');
INSERT INTO cities VALUES ('1866', '178', 'Christ Church Nichola Town', '0', '0');
INSERT INTO cities VALUES ('1867', '178', 'Saint Anne Sandy Point', '0', '0');
INSERT INTO cities VALUES ('1868', '178', 'Saint George Basseterre', '0', '0');
INSERT INTO cities VALUES ('1869', '178', 'Saint George Gingerland', '0', '0');
INSERT INTO cities VALUES ('1870', '178', 'Saint James Windward', '0', '0');
INSERT INTO cities VALUES ('1871', '178', 'Saint John Capisterre', '0', '0');
INSERT INTO cities VALUES ('1872', '178', 'Saint John Figtree', '0', '0');
INSERT INTO cities VALUES ('1873', '178', 'Saint Mary Cayon', '0', '0');
INSERT INTO cities VALUES ('1874', '178', 'Saint Paul Capisterre', '0', '0');
INSERT INTO cities VALUES ('1875', '178', 'Saint Paul Charlestown', '0', '0');
INSERT INTO cities VALUES ('1876', '178', 'Saint Peter Basseterre', '0', '0');
INSERT INTO cities VALUES ('1877', '178', 'Saint Thomas Lowland', '0', '0');
INSERT INTO cities VALUES ('1878', '178', 'Saint Thomas Middle Island', '0', '0');
INSERT INTO cities VALUES ('1879', '178', 'Trinity Palmetto Point', '0', '0');
INSERT INTO cities VALUES ('1880', '112', 'Chagang-do', '0', '0');
INSERT INTO cities VALUES ('1881', '112', 'Hamgyong-namdo', '0', '0');
INSERT INTO cities VALUES ('1882', '112', 'Hwanghae-namdo', '0', '0');
INSERT INTO cities VALUES ('1883', '112', 'Hwanghae-bukto', '0', '0');
INSERT INTO cities VALUES ('1884', '112', 'Kaesong-si', '0', '0');
INSERT INTO cities VALUES ('1885', '112', 'Kangwon-do', '0', '0');
INSERT INTO cities VALUES ('1886', '112', 'P\'yongan-bukto', '0', '0');
INSERT INTO cities VALUES ('1887', '112', 'P\'yongyang-si', '0', '0');
INSERT INTO cities VALUES ('1888', '112', 'Yanggang-do', '0', '0');
INSERT INTO cities VALUES ('1889', '112', 'Namp\'o-si', '0', '0');
INSERT INTO cities VALUES ('1890', '112', 'P\'yongan-namdo', '0', '0');
INSERT INTO cities VALUES ('1891', '112', 'Hamgyong-bukto', '0', '0');
INSERT INTO cities VALUES ('1892', '112', 'Najin Sonbong-si', '0', '0');
INSERT INTO cities VALUES ('1893', '113', 'Cheju-do', '0', '0');
INSERT INTO cities VALUES ('1894', '113', 'Cholla-bukto', '0', '0');
INSERT INTO cities VALUES ('1895', '113', 'Ch\'ungch\'ong-bukto', '0', '0');
INSERT INTO cities VALUES ('1896', '113', 'Kangwon-do', '0', '0');
INSERT INTO cities VALUES ('1897', '113', 'Pusan-jikhalsi', '0', '0');
INSERT INTO cities VALUES ('1898', '113', 'Seoul-t\'ukpyolsi', '0', '0');
INSERT INTO cities VALUES ('1899', '113', 'Inch\'on-jikhalsi', '0', '0');
INSERT INTO cities VALUES ('1900', '113', 'Kyonggi-do', '0', '0');
INSERT INTO cities VALUES ('1901', '113', 'Kyongsang-bukto', '0', '0');
INSERT INTO cities VALUES ('1902', '113', 'Taegu-jikhalsi', '0', '0');
INSERT INTO cities VALUES ('1903', '113', 'Cholla-namdo', '0', '0');
INSERT INTO cities VALUES ('1904', '113', 'Ch\'ungch\'ong-namdo', '0', '0');
INSERT INTO cities VALUES ('1905', '113', 'Kwangju-jikhalsi', '0', '0');
INSERT INTO cities VALUES ('1906', '113', 'Taejon-jikhalsi', '0', '0');
INSERT INTO cities VALUES ('1907', '113', 'Kyongsang-namdo', '0', '0');
INSERT INTO cities VALUES ('1908', '113', 'Ulsan-gwangyoksi', '0', '0');
INSERT INTO cities VALUES ('1909', '114', 'Al Ahmadi', '0', '0');
INSERT INTO cities VALUES ('1910', '114', 'Al Kuwayt', '0', '0');
INSERT INTO cities VALUES ('1911', '114', 'Al Jahra', '0', '0');
INSERT INTO cities VALUES ('1912', '114', 'Al Farwaniyah', '0', '0');
INSERT INTO cities VALUES ('1913', '114', 'Hawalli', '0', '0');
INSERT INTO cities VALUES ('1914', '114', 'Mubarak al Kabir', '0', '0');
INSERT INTO cities VALUES ('1915', '40', 'Creek', '0', '0');
INSERT INTO cities VALUES ('1916', '40', 'Eastern', '0', '0');
INSERT INTO cities VALUES ('1917', '40', 'Midland', '0', '0');
INSERT INTO cities VALUES ('1918', '40', 'South Town', '0', '0');
INSERT INTO cities VALUES ('1919', '40', 'Spot Bay', '0', '0');
INSERT INTO cities VALUES ('1920', '40', 'Stake Bay', '0', '0');
INSERT INTO cities VALUES ('1921', '40', 'West End', '0', '0');
INSERT INTO cities VALUES ('1922', '40', 'Western', '0', '0');
INSERT INTO cities VALUES ('1923', '109', 'Almaty', '0', '0');
INSERT INTO cities VALUES ('1924', '109', 'Almaty City', '0', '0');
INSERT INTO cities VALUES ('1925', '109', 'Aqmola', '0', '0');
INSERT INTO cities VALUES ('1926', '109', 'Aqtobe', '0', '0');
INSERT INTO cities VALUES ('1927', '109', 'Astana', '0', '0');
INSERT INTO cities VALUES ('1928', '109', 'Atyrau', '0', '0');
INSERT INTO cities VALUES ('1929', '109', 'West Kazakhstan', '0', '0');
INSERT INTO cities VALUES ('1930', '109', 'Bayqonyr', '0', '0');
INSERT INTO cities VALUES ('1931', '109', 'Mangghystau', '0', '0');
INSERT INTO cities VALUES ('1932', '109', 'South Kazakhstan', '0', '0');
INSERT INTO cities VALUES ('1933', '109', 'Pavlodar', '0', '0');
INSERT INTO cities VALUES ('1934', '109', 'Qaraghandy', '0', '0');
INSERT INTO cities VALUES ('1935', '109', 'Qostanay', '0', '0');
INSERT INTO cities VALUES ('1936', '109', 'Qyzylorda', '0', '0');
INSERT INTO cities VALUES ('1937', '109', 'East Kazakhstan', '0', '0');
INSERT INTO cities VALUES ('1938', '109', 'North Kazakhstan', '0', '0');
INSERT INTO cities VALUES ('1939', '109', 'Zhambyl', '0', '0');
INSERT INTO cities VALUES ('1940', '116', 'Attapu', '0', '0');
INSERT INTO cities VALUES ('1941', '116', 'Champasak', '0', '0');
INSERT INTO cities VALUES ('1942', '116', 'Houaphan', '0', '0');
INSERT INTO cities VALUES ('1943', '116', 'Khammouan', '0', '0');
INSERT INTO cities VALUES ('1944', '116', 'Louang Namtha', '0', '0');
INSERT INTO cities VALUES ('1945', '116', 'Oudomxai', '0', '0');
INSERT INTO cities VALUES ('1946', '116', 'Phongsali', '0', '0');
INSERT INTO cities VALUES ('1947', '116', 'Saravan', '0', '0');
INSERT INTO cities VALUES ('1948', '116', 'Savannakhet', '0', '0');
INSERT INTO cities VALUES ('1949', '116', 'Vientiane', '0', '0');
INSERT INTO cities VALUES ('1950', '116', 'Xaignabouri', '0', '0');
INSERT INTO cities VALUES ('1951', '116', 'Xiangkhoang', '0', '0');
INSERT INTO cities VALUES ('1952', '116', 'Louangphrabang', '0', '0');
INSERT INTO cities VALUES ('1953', '118', 'Beqaa', '0', '0');
INSERT INTO cities VALUES ('1954', '118', 'Al Janub', '0', '0');
INSERT INTO cities VALUES ('1955', '118', 'Liban-Nord', '0', '0');
INSERT INTO cities VALUES ('1956', '118', 'Beyrouth', '0', '0');
INSERT INTO cities VALUES ('1957', '118', 'Mont-Liban', '0', '0');
INSERT INTO cities VALUES ('1958', '118', 'Liban-Sud', '0', '0');
INSERT INTO cities VALUES ('1959', '118', 'Nabatiye', '0', '0');
INSERT INTO cities VALUES ('1960', '118', 'Beqaa', '0', '0');
INSERT INTO cities VALUES ('1961', '118', 'Liban-Nord', '0', '0');
INSERT INTO cities VALUES ('1962', '118', 'Aakk,r', '0', '0');
INSERT INTO cities VALUES ('1963', '118', 'Baalbek-Hermel', '0', '0');
INSERT INTO cities VALUES ('1964', '179', 'Anse-la-Raye', '0', '0');
INSERT INTO cities VALUES ('1965', '179', 'Dauphin', '0', '0');
INSERT INTO cities VALUES ('1966', '179', 'Castries', '0', '0');
INSERT INTO cities VALUES ('1967', '179', 'Choiseul', '0', '0');
INSERT INTO cities VALUES ('1968', '179', 'Dennery', '0', '0');
INSERT INTO cities VALUES ('1969', '179', 'Gros-Islet', '0', '0');
INSERT INTO cities VALUES ('1970', '179', 'Laborie', '0', '0');
INSERT INTO cities VALUES ('1971', '179', 'Micoud', '0', '0');
INSERT INTO cities VALUES ('1972', '179', 'Soufriere', '0', '0');
INSERT INTO cities VALUES ('1973', '179', 'Vieux-Fort', '0', '0');
INSERT INTO cities VALUES ('1974', '179', 'Praslin', '0', '0');
INSERT INTO cities VALUES ('1975', '122', 'Balzers', '0', '0');
INSERT INTO cities VALUES ('1976', '122', 'Eschen', '0', '0');
INSERT INTO cities VALUES ('1977', '122', 'Gamprin', '0', '0');
INSERT INTO cities VALUES ('1978', '122', 'Mauren', '0', '0');
INSERT INTO cities VALUES ('1979', '122', 'Planken', '0', '0');
INSERT INTO cities VALUES ('1980', '122', 'Ruggell', '0', '0');
INSERT INTO cities VALUES ('1981', '122', 'Schaan', '0', '0');
INSERT INTO cities VALUES ('1982', '122', 'Schellenberg', '0', '0');
INSERT INTO cities VALUES ('1983', '122', 'Triesen', '0', '0');
INSERT INTO cities VALUES ('1984', '122', 'Triesenberg', '0', '0');
INSERT INTO cities VALUES ('1985', '122', 'Vaduz', '0', '0');
INSERT INTO cities VALUES ('1986', '122', 'Gbarpolu', '0', '0');
INSERT INTO cities VALUES ('1987', '122', 'River Gee', '0', '0');
INSERT INTO cities VALUES ('1988', '196', 'Central', '0', '0');
INSERT INTO cities VALUES ('1989', '196', 'North Central', '0', '0');
INSERT INTO cities VALUES ('1990', '196', 'North Western', '0', '0');
INSERT INTO cities VALUES ('1991', '196', 'Sabaragamuwa', '0', '0');
INSERT INTO cities VALUES ('1992', '196', 'Southern', '0', '0');
INSERT INTO cities VALUES ('1993', '196', 'Uva', '0', '0');
INSERT INTO cities VALUES ('1994', '196', 'Western', '0', '0');
INSERT INTO cities VALUES ('1995', '196', 'Eastern', '0', '0');
INSERT INTO cities VALUES ('1996', '196', 'Northern', '0', '0');
INSERT INTO cities VALUES ('1997', '120', 'Bong', '0', '0');
INSERT INTO cities VALUES ('1998', '120', 'Grand Cape Mount', '0', '0');
INSERT INTO cities VALUES ('1999', '120', 'Lofa', '0', '0');
INSERT INTO cities VALUES ('2000', '120', 'Maryland', '0', '0');
INSERT INTO cities VALUES ('2001', '120', 'Monrovia', '0', '0');
INSERT INTO cities VALUES ('2002', '120', 'Nimba', '0', '0');
INSERT INTO cities VALUES ('2003', '120', 'Sino', '0', '0');
INSERT INTO cities VALUES ('2004', '120', 'Grand Bassa', '0', '0');
INSERT INTO cities VALUES ('2005', '120', 'Grand Cape Mount', '0', '0');
INSERT INTO cities VALUES ('2006', '120', 'Maryland', '0', '0');
INSERT INTO cities VALUES ('2007', '120', 'Montserrado', '0', '0');
INSERT INTO cities VALUES ('2008', '120', 'Margibi', '0', '0');
INSERT INTO cities VALUES ('2009', '120', 'River Cess', '0', '0');
INSERT INTO cities VALUES ('2010', '120', 'Grand Gedeh', '0', '0');
INSERT INTO cities VALUES ('2011', '120', 'Lofa', '0', '0');
INSERT INTO cities VALUES ('2012', '120', 'Gbarpolu', '0', '0');
INSERT INTO cities VALUES ('2013', '120', 'River Gee', '0', '0');
INSERT INTO cities VALUES ('2014', '119', 'Berea', '0', '0');
INSERT INTO cities VALUES ('2015', '119', 'Butha-Buthe', '0', '0');
INSERT INTO cities VALUES ('2016', '119', 'Leribe', '0', '0');
INSERT INTO cities VALUES ('2017', '119', 'Mafeteng', '0', '0');
INSERT INTO cities VALUES ('2018', '119', 'Maseru', '0', '0');
INSERT INTO cities VALUES ('2019', '119', 'Mohales Hoek', '0', '0');
INSERT INTO cities VALUES ('2020', '119', 'Mokhotlong', '0', '0');
INSERT INTO cities VALUES ('2021', '119', 'Qachas Nek', '0', '0');
INSERT INTO cities VALUES ('2022', '119', 'Quthing', '0', '0');
INSERT INTO cities VALUES ('2023', '119', 'Thaba-Tseka', '0', '0');
INSERT INTO cities VALUES ('2024', '123', 'Alytaus Apskritis', '0', '0');
INSERT INTO cities VALUES ('2025', '123', 'Kauno Apskritis', '0', '0');
INSERT INTO cities VALUES ('2026', '123', 'Klaipedos Apskritis', '0', '0');
INSERT INTO cities VALUES ('2027', '123', 'Marijampoles Apskritis', '0', '0');
INSERT INTO cities VALUES ('2028', '123', 'Panevezio Apskritis', '0', '0');
INSERT INTO cities VALUES ('2029', '123', 'Siauliu Apskritis', '0', '0');
INSERT INTO cities VALUES ('2030', '123', 'Taurages Apskritis', '0', '0');
INSERT INTO cities VALUES ('2031', '123', 'Telsiu Apskritis', '0', '0');
INSERT INTO cities VALUES ('2032', '123', 'Utenos Apskritis', '0', '0');
INSERT INTO cities VALUES ('2033', '123', 'Vilniaus Apskritis', '0', '0');
INSERT INTO cities VALUES ('2034', '124', 'Diekirch', '0', '0');
INSERT INTO cities VALUES ('2035', '124', 'Grevenmacher', '0', '0');
INSERT INTO cities VALUES ('2036', '124', 'Luxembourg', '0', '0');
INSERT INTO cities VALUES ('2037', '117', 'Aizkraukles', '0', '0');
INSERT INTO cities VALUES ('2038', '117', 'Aluksnes', '0', '0');
INSERT INTO cities VALUES ('2039', '117', 'Balvu', '0', '0');
INSERT INTO cities VALUES ('2040', '117', 'Bauskas', '0', '0');
INSERT INTO cities VALUES ('2041', '117', 'Cesu', '0', '0');
INSERT INTO cities VALUES ('2042', '117', 'Daugavpils', '0', '0');
INSERT INTO cities VALUES ('2043', '117', 'Daugavpils', '0', '0');
INSERT INTO cities VALUES ('2044', '117', 'Dobeles', '0', '0');
INSERT INTO cities VALUES ('2045', '117', 'Gulbenes', '0', '0');
INSERT INTO cities VALUES ('2046', '117', 'Jekabpils', '0', '0');
INSERT INTO cities VALUES ('2047', '117', 'Jelgava', '0', '0');
INSERT INTO cities VALUES ('2048', '117', 'Jelgavas', '0', '0');
INSERT INTO cities VALUES ('2049', '117', 'Jurmala', '0', '0');
INSERT INTO cities VALUES ('2050', '117', 'Kraslavas', '0', '0');
INSERT INTO cities VALUES ('2051', '117', 'Kuldigas', '0', '0');
INSERT INTO cities VALUES ('2052', '117', 'Liepaja', '0', '0');
INSERT INTO cities VALUES ('2053', '117', 'Liepajas', '0', '0');
INSERT INTO cities VALUES ('2054', '117', 'Limbazu', '0', '0');
INSERT INTO cities VALUES ('2055', '117', 'Ludzas', '0', '0');
INSERT INTO cities VALUES ('2056', '117', 'Madonas', '0', '0');
INSERT INTO cities VALUES ('2057', '117', 'Ogres', '0', '0');
INSERT INTO cities VALUES ('2058', '117', 'Preilu', '0', '0');
INSERT INTO cities VALUES ('2059', '117', 'Rezekne', '0', '0');
INSERT INTO cities VALUES ('2060', '117', 'Rezeknes', '0', '0');
INSERT INTO cities VALUES ('2061', '117', 'Riga', '0', '0');
INSERT INTO cities VALUES ('2062', '117', 'Rigas', '0', '0');
INSERT INTO cities VALUES ('2063', '117', 'Saldus', '0', '0');
INSERT INTO cities VALUES ('2064', '117', 'Talsu', '0', '0');
INSERT INTO cities VALUES ('2065', '117', 'Tukuma', '0', '0');
INSERT INTO cities VALUES ('2066', '117', 'Valkas', '0', '0');
INSERT INTO cities VALUES ('2067', '117', 'Valmieras', '0', '0');
INSERT INTO cities VALUES ('2068', '117', 'Ventspils', '0', '0');
INSERT INTO cities VALUES ('2069', '117', 'Ventspils', '0', '0');
INSERT INTO cities VALUES ('2070', '121', 'Al Aziziyah', '0', '0');
INSERT INTO cities VALUES ('2071', '121', 'Al Jufrah', '0', '0');
INSERT INTO cities VALUES ('2072', '121', 'Al Kufrah', '0', '0');
INSERT INTO cities VALUES ('2073', '121', 'Ash Shati\'', '0', '0');
INSERT INTO cities VALUES ('2074', '121', 'Murzuq', '0', '0');
INSERT INTO cities VALUES ('2075', '121', 'Sabha', '0', '0');
INSERT INTO cities VALUES ('2076', '121', 'Tarhunah', '0', '0');
INSERT INTO cities VALUES ('2077', '121', 'Tubruq', '0', '0');
INSERT INTO cities VALUES ('2078', '121', 'Zlitan', '0', '0');
INSERT INTO cities VALUES ('2079', '121', 'Ajdabiya', '0', '0');
INSERT INTO cities VALUES ('2080', '121', 'Al Fatih', '0', '0');
INSERT INTO cities VALUES ('2081', '121', 'Al Jabal al Akhdar', '0', '0');
INSERT INTO cities VALUES ('2082', '121', 'Al Khums', '0', '0');
INSERT INTO cities VALUES ('2083', '121', 'An Nuqat al Khams', '0', '0');
INSERT INTO cities VALUES ('2084', '121', 'Awbari', '0', '0');
INSERT INTO cities VALUES ('2085', '121', 'Az Zawiyah', '0', '0');
INSERT INTO cities VALUES ('2086', '121', 'Banghazi', '0', '0');
INSERT INTO cities VALUES ('2087', '121', 'Darnah', '0', '0');
INSERT INTO cities VALUES ('2088', '121', 'Ghadamis', '0', '0');
INSERT INTO cities VALUES ('2089', '121', 'Gharyan', '0', '0');
INSERT INTO cities VALUES ('2090', '121', 'Misratah', '0', '0');
INSERT INTO cities VALUES ('2091', '121', 'Sawfajjin', '0', '0');
INSERT INTO cities VALUES ('2092', '121', 'Surt', '0', '0');
INSERT INTO cities VALUES ('2093', '121', 'Tarabulus', '0', '0');
INSERT INTO cities VALUES ('2094', '121', 'Yafran', '0', '0');
INSERT INTO cities VALUES ('2095', '144', 'Grand Casablanca', '0', '0');
INSERT INTO cities VALUES ('2096', '144', 'Fes-Boulemane', '0', '0');
INSERT INTO cities VALUES ('2097', '144', 'Marrakech-Tensift-Al Haouz', '0', '0');
INSERT INTO cities VALUES ('2098', '144', 'Meknes-Tafilalet', '0', '0');
INSERT INTO cities VALUES ('2099', '144', 'Rabat-Sale-Zemmour-Zaer', '0', '0');
INSERT INTO cities VALUES ('2100', '144', 'Chaouia-Ouardigha', '0', '0');
INSERT INTO cities VALUES ('2101', '144', 'Doukkala-Abda', '0', '0');
INSERT INTO cities VALUES ('2102', '144', 'Gharb-Chrarda-Beni Hssen', '0', '0');
INSERT INTO cities VALUES ('2103', '144', 'Guelmim-Es Smara', '0', '0');
INSERT INTO cities VALUES ('2104', '144', 'Oriental', '0', '0');
INSERT INTO cities VALUES ('2105', '144', 'Souss-Massa-Dr,a', '0', '0');
INSERT INTO cities VALUES ('2106', '144', 'Tadla-Azilal', '0', '0');
INSERT INTO cities VALUES ('2107', '144', 'Tanger-Tetouan', '0', '0');
INSERT INTO cities VALUES ('2108', '144', 'Taza-Al Hoceima-Taounate', '0', '0');
INSERT INTO cities VALUES ('2109', '144', 'La,youne-Boujdour-Sakia El Hamra', '0', '0');
INSERT INTO cities VALUES ('2110', '141', 'La Condamine', '0', '0');
INSERT INTO cities VALUES ('2111', '141', 'Monaco', '0', '0');
INSERT INTO cities VALUES ('2112', '141', 'Monte-Carlo', '0', '0');
INSERT INTO cities VALUES ('2113', '140', 'Gagauzia', '0', '0');
INSERT INTO cities VALUES ('2114', '140', 'Chisinau', '0', '0');
INSERT INTO cities VALUES ('2115', '140', 'Stinga Nistrului', '0', '0');
INSERT INTO cities VALUES ('2116', '140', 'Anenii Noi', '0', '0');
INSERT INTO cities VALUES ('2117', '140', 'Balti', '0', '0');
INSERT INTO cities VALUES ('2118', '140', 'Basarabeasca', '0', '0');
INSERT INTO cities VALUES ('2119', '140', 'Bender', '0', '0');
INSERT INTO cities VALUES ('2120', '140', 'Briceni', '0', '0');
INSERT INTO cities VALUES ('2121', '140', 'Cahul', '0', '0');
INSERT INTO cities VALUES ('2122', '140', 'Cantemir', '0', '0');
INSERT INTO cities VALUES ('2123', '140', 'Calarasi', '0', '0');
INSERT INTO cities VALUES ('2124', '140', 'Causeni', '0', '0');
INSERT INTO cities VALUES ('2125', '140', 'Cimislia', '0', '0');
INSERT INTO cities VALUES ('2126', '140', 'Criuleni', '0', '0');
INSERT INTO cities VALUES ('2127', '140', 'Donduseni', '0', '0');
INSERT INTO cities VALUES ('2128', '140', 'Drochia', '0', '0');
INSERT INTO cities VALUES ('2129', '140', 'Dubasari', '0', '0');
INSERT INTO cities VALUES ('2130', '140', 'Edinet', '0', '0');
INSERT INTO cities VALUES ('2131', '140', 'Falesti', '0', '0');
INSERT INTO cities VALUES ('2132', '140', 'Floresti', '0', '0');
INSERT INTO cities VALUES ('2133', '140', 'Glodeni', '0', '0');
INSERT INTO cities VALUES ('2134', '140', 'Hincesti', '0', '0');
INSERT INTO cities VALUES ('2135', '140', 'Ialoveni', '0', '0');
INSERT INTO cities VALUES ('2136', '140', 'Leova', '0', '0');
INSERT INTO cities VALUES ('2137', '140', 'Nisporeni', '0', '0');
INSERT INTO cities VALUES ('2138', '140', 'Ocnita', '0', '0');
INSERT INTO cities VALUES ('2139', '140', 'Orhei', '0', '0');
INSERT INTO cities VALUES ('2140', '140', 'Rezina', '0', '0');
INSERT INTO cities VALUES ('2141', '140', 'Riscani', '0', '0');
INSERT INTO cities VALUES ('2142', '140', 'Singerei', '0', '0');
INSERT INTO cities VALUES ('2143', '140', 'Soldanesti', '0', '0');
INSERT INTO cities VALUES ('2144', '140', 'Soroca', '0', '0');
INSERT INTO cities VALUES ('2145', '140', 'Stefan-Voda', '0', '0');
INSERT INTO cities VALUES ('2146', '140', 'Straseni', '0', '0');
INSERT INTO cities VALUES ('2147', '140', 'Taraclia', '0', '0');
INSERT INTO cities VALUES ('2148', '140', 'Telenesti', '0', '0');
INSERT INTO cities VALUES ('2149', '140', 'Ungheni', '0', '0');
INSERT INTO cities VALUES ('2150', '127', 'Antsiranana', '0', '0');
INSERT INTO cities VALUES ('2151', '127', 'Fianarantsoa', '0', '0');
INSERT INTO cities VALUES ('2152', '127', 'Mahajanga', '0', '0');
INSERT INTO cities VALUES ('2153', '127', 'Toamasina', '0', '0');
INSERT INTO cities VALUES ('2154', '127', 'Antananarivo', '0', '0');
INSERT INTO cities VALUES ('2155', '127', 'Toliara', '0', '0');
INSERT INTO cities VALUES ('2156', '126', 'Aracinovo', '0', '0');
INSERT INTO cities VALUES ('2157', '126', 'Bac', '0', '0');
INSERT INTO cities VALUES ('2158', '126', 'Belcista', '0', '0');
INSERT INTO cities VALUES ('2159', '126', 'Berovo', '0', '0');
INSERT INTO cities VALUES ('2160', '126', 'Bistrica', '0', '0');
INSERT INTO cities VALUES ('2161', '126', 'Bitola', '0', '0');
INSERT INTO cities VALUES ('2162', '126', 'Blatec', '0', '0');
INSERT INTO cities VALUES ('2163', '126', 'Bogdanci', '0', '0');
INSERT INTO cities VALUES ('2164', '126', 'Bogomila', '0', '0');
INSERT INTO cities VALUES ('2165', '126', 'Bogovinje', '0', '0');
INSERT INTO cities VALUES ('2166', '126', 'Bosilovo', '0', '0');
INSERT INTO cities VALUES ('2167', '126', 'Brvenica', '0', '0');
INSERT INTO cities VALUES ('2168', '126', 'Cair', '0', '0');
INSERT INTO cities VALUES ('2169', '126', 'Capari', '0', '0');
INSERT INTO cities VALUES ('2170', '126', 'Caska', '0', '0');
INSERT INTO cities VALUES ('2171', '126', 'Cegrane', '0', '0');
INSERT INTO cities VALUES ('2172', '126', 'Centar', '0', '0');
INSERT INTO cities VALUES ('2173', '126', 'Centar Zupa', '0', '0');
INSERT INTO cities VALUES ('2174', '126', 'Cesinovo', '0', '0');
INSERT INTO cities VALUES ('2175', '126', 'Cucer-Sandevo', '0', '0');
INSERT INTO cities VALUES ('2176', '126', 'Debar', '0', '0');
INSERT INTO cities VALUES ('2177', '126', 'Delcevo', '0', '0');
INSERT INTO cities VALUES ('2178', '126', 'Delogozdi', '0', '0');
INSERT INTO cities VALUES ('2179', '126', 'Demir Hisar', '0', '0');
INSERT INTO cities VALUES ('2180', '126', 'Demir Kapija', '0', '0');
INSERT INTO cities VALUES ('2181', '126', 'Dobrusevo', '0', '0');
INSERT INTO cities VALUES ('2182', '126', 'Dolna Banjica', '0', '0');
INSERT INTO cities VALUES ('2183', '126', 'Dolneni', '0', '0');
INSERT INTO cities VALUES ('2184', '126', 'Dorce Petrov', '0', '0');
INSERT INTO cities VALUES ('2185', '126', 'Drugovo', '0', '0');
INSERT INTO cities VALUES ('2186', '126', 'Dzepciste', '0', '0');
INSERT INTO cities VALUES ('2187', '126', 'Gazi Baba', '0', '0');
INSERT INTO cities VALUES ('2188', '126', 'Gevgelija', '0', '0');
INSERT INTO cities VALUES ('2189', '126', 'Gostivar', '0', '0');
INSERT INTO cities VALUES ('2190', '126', 'Gradsko', '0', '0');
INSERT INTO cities VALUES ('2191', '126', 'Ilinden', '0', '0');
INSERT INTO cities VALUES ('2192', '126', 'Izvor', '0', '0');
INSERT INTO cities VALUES ('2193', '126', 'Jegunovce', '0', '0');
INSERT INTO cities VALUES ('2194', '126', 'Kamenjane', '0', '0');
INSERT INTO cities VALUES ('2195', '126', 'Karbinci', '0', '0');
INSERT INTO cities VALUES ('2196', '126', 'Karpos', '0', '0');
INSERT INTO cities VALUES ('2197', '126', 'Kavadarci', '0', '0');
INSERT INTO cities VALUES ('2198', '126', 'Kicevo', '0', '0');
INSERT INTO cities VALUES ('2199', '126', 'Kisela Voda', '0', '0');
INSERT INTO cities VALUES ('2200', '126', 'Klecevce', '0', '0');
INSERT INTO cities VALUES ('2201', '126', 'Kocani', '0', '0');
INSERT INTO cities VALUES ('2202', '126', 'Konce', '0', '0');
INSERT INTO cities VALUES ('2203', '126', 'Kondovo', '0', '0');
INSERT INTO cities VALUES ('2204', '126', 'Konopiste', '0', '0');
INSERT INTO cities VALUES ('2205', '126', 'Kosel', '0', '0');
INSERT INTO cities VALUES ('2206', '126', 'Kratovo', '0', '0');
INSERT INTO cities VALUES ('2207', '126', 'Kriva Palanka', '0', '0');
INSERT INTO cities VALUES ('2208', '126', 'Krivogastani', '0', '0');
INSERT INTO cities VALUES ('2209', '126', 'Krusevo', '0', '0');
INSERT INTO cities VALUES ('2210', '126', 'Kuklis', '0', '0');
INSERT INTO cities VALUES ('2211', '126', 'Kukurecani', '0', '0');
INSERT INTO cities VALUES ('2212', '126', 'Kumanovo', '0', '0');
INSERT INTO cities VALUES ('2213', '126', 'Labunista', '0', '0');
INSERT INTO cities VALUES ('2214', '126', 'Lipkovo', '0', '0');
INSERT INTO cities VALUES ('2215', '126', 'Lozovo', '0', '0');
INSERT INTO cities VALUES ('2216', '126', 'Lukovo', '0', '0');
INSERT INTO cities VALUES ('2217', '126', 'Makedonska Kamenica', '0', '0');
INSERT INTO cities VALUES ('2218', '126', 'Makedonski Brod', '0', '0');
INSERT INTO cities VALUES ('2219', '126', 'Mavrovi Anovi', '0', '0');
INSERT INTO cities VALUES ('2220', '126', 'Meseista', '0', '0');
INSERT INTO cities VALUES ('2221', '126', 'Miravci', '0', '0');
INSERT INTO cities VALUES ('2222', '126', 'Mogila', '0', '0');
INSERT INTO cities VALUES ('2223', '126', 'Murtino', '0', '0');
INSERT INTO cities VALUES ('2224', '126', 'Negotino', '0', '0');
INSERT INTO cities VALUES ('2225', '126', 'Negotino-Polosko', '0', '0');
INSERT INTO cities VALUES ('2226', '126', 'Novaci', '0', '0');
INSERT INTO cities VALUES ('2227', '126', 'Novo Selo', '0', '0');
INSERT INTO cities VALUES ('2228', '126', 'Oblesevo', '0', '0');
INSERT INTO cities VALUES ('2229', '126', 'Ohrid', '0', '0');
INSERT INTO cities VALUES ('2230', '126', 'Orasac', '0', '0');
INSERT INTO cities VALUES ('2231', '126', 'Orizari', '0', '0');
INSERT INTO cities VALUES ('2232', '126', 'Oslomej', '0', '0');
INSERT INTO cities VALUES ('2233', '126', 'Pehcevo', '0', '0');
INSERT INTO cities VALUES ('2234', '126', 'Petrovec', '0', '0');
INSERT INTO cities VALUES ('2235', '126', 'Plasnica', '0', '0');
INSERT INTO cities VALUES ('2236', '126', 'Podares', '0', '0');
INSERT INTO cities VALUES ('2237', '126', 'Prilep', '0', '0');
INSERT INTO cities VALUES ('2238', '126', 'Probistip', '0', '0');
INSERT INTO cities VALUES ('2239', '126', 'Radovis', '0', '0');
INSERT INTO cities VALUES ('2240', '126', 'Rankovce', '0', '0');
INSERT INTO cities VALUES ('2241', '126', 'Resen', '0', '0');
INSERT INTO cities VALUES ('2242', '126', 'Rosoman', '0', '0');
INSERT INTO cities VALUES ('2243', '126', 'Rostusa', '0', '0');
INSERT INTO cities VALUES ('2244', '126', 'Samokov', '0', '0');
INSERT INTO cities VALUES ('2245', '126', 'Saraj', '0', '0');
INSERT INTO cities VALUES ('2246', '126', 'Sipkovica', '0', '0');
INSERT INTO cities VALUES ('2247', '126', 'Sopiste', '0', '0');
INSERT INTO cities VALUES ('2248', '126', 'Sopotnica', '0', '0');
INSERT INTO cities VALUES ('2249', '126', 'Srbinovo', '0', '0');
INSERT INTO cities VALUES ('2250', '126', 'Staravina', '0', '0');
INSERT INTO cities VALUES ('2251', '126', 'Star Dojran', '0', '0');
INSERT INTO cities VALUES ('2252', '126', 'Staro Nagoricane', '0', '0');
INSERT INTO cities VALUES ('2253', '126', 'Stip', '0', '0');
INSERT INTO cities VALUES ('2254', '126', 'Struga', '0', '0');
INSERT INTO cities VALUES ('2255', '126', 'Strumica', '0', '0');
INSERT INTO cities VALUES ('2256', '126', 'Studenicani', '0', '0');
INSERT INTO cities VALUES ('2257', '126', 'Suto Orizari', '0', '0');
INSERT INTO cities VALUES ('2258', '126', 'Sveti Nikole', '0', '0');
INSERT INTO cities VALUES ('2259', '126', 'Tearce', '0', '0');
INSERT INTO cities VALUES ('2260', '126', 'Tetovo', '0', '0');
INSERT INTO cities VALUES ('2261', '126', 'Topolcani', '0', '0');
INSERT INTO cities VALUES ('2262', '126', 'Valandovo', '0', '0');
INSERT INTO cities VALUES ('2263', '126', 'Vasilevo', '0', '0');
INSERT INTO cities VALUES ('2264', '126', 'Veles', '0', '0');
INSERT INTO cities VALUES ('2265', '126', 'Velesta', '0', '0');
INSERT INTO cities VALUES ('2266', '126', 'Vevcani', '0', '0');
INSERT INTO cities VALUES ('2267', '126', 'Vinica', '0', '0');
INSERT INTO cities VALUES ('2268', '126', 'Vitoliste', '0', '0');
INSERT INTO cities VALUES ('2269', '126', 'Vranestica', '0', '0');
INSERT INTO cities VALUES ('2270', '126', 'Vrapciste', '0', '0');
INSERT INTO cities VALUES ('2271', '126', 'Vratnica', '0', '0');
INSERT INTO cities VALUES ('2272', '126', 'Vrutok', '0', '0');
INSERT INTO cities VALUES ('2273', '126', 'Zajas', '0', '0');
INSERT INTO cities VALUES ('2274', '126', 'Zelenikovo', '0', '0');
INSERT INTO cities VALUES ('2275', '126', 'Zelino', '0', '0');
INSERT INTO cities VALUES ('2276', '126', 'Zitose', '0', '0');
INSERT INTO cities VALUES ('2277', '126', 'Zletovo', '0', '0');
INSERT INTO cities VALUES ('2278', '126', 'Zrnovci', '0', '0');
INSERT INTO cities VALUES ('2279', '131', 'Bamako', '0', '0');
INSERT INTO cities VALUES ('2280', '131', 'Kayes', '0', '0');
INSERT INTO cities VALUES ('2281', '131', 'Mopti', '0', '0');
INSERT INTO cities VALUES ('2282', '131', 'Segou', '0', '0');
INSERT INTO cities VALUES ('2283', '131', 'Sikasso', '0', '0');
INSERT INTO cities VALUES ('2284', '131', 'Koulikoro', '0', '0');
INSERT INTO cities VALUES ('2285', '131', 'Tombouctou', '0', '0');
INSERT INTO cities VALUES ('2286', '131', 'Gao', '0', '0');
INSERT INTO cities VALUES ('2287', '131', 'Kidal', '0', '0');
INSERT INTO cities VALUES ('2288', '146', 'Rakhine State', '0', '0');
INSERT INTO cities VALUES ('2289', '146', 'Chin State', '0', '0');
INSERT INTO cities VALUES ('2290', '146', 'Irrawaddy', '0', '0');
INSERT INTO cities VALUES ('2291', '146', 'Kachin State', '0', '0');
INSERT INTO cities VALUES ('2292', '146', 'Karan State', '0', '0');
INSERT INTO cities VALUES ('2293', '146', 'Kayah State', '0', '0');
INSERT INTO cities VALUES ('2294', '146', 'Magwe', '0', '0');
INSERT INTO cities VALUES ('2295', '146', 'Mandalay', '0', '0');
INSERT INTO cities VALUES ('2296', '146', 'Pegu', '0', '0');
INSERT INTO cities VALUES ('2297', '146', 'Sagaing', '0', '0');
INSERT INTO cities VALUES ('2298', '146', 'Shan State', '0', '0');
INSERT INTO cities VALUES ('2299', '146', 'Tenasserim', '0', '0');
INSERT INTO cities VALUES ('2300', '146', 'Mon State', '0', '0');
INSERT INTO cities VALUES ('2301', '146', 'Rangoon', '0', '0');
INSERT INTO cities VALUES ('2302', '146', 'Yangon', '0', '0');
INSERT INTO cities VALUES ('2303', '142', 'Arhangay', '0', '0');
INSERT INTO cities VALUES ('2304', '142', 'Bayanhongor', '0', '0');
INSERT INTO cities VALUES ('2305', '142', 'Bayan-Olgiy', '0', '0');
INSERT INTO cities VALUES ('2306', '142', 'Darhan', '0', '0');
INSERT INTO cities VALUES ('2307', '142', 'Dornod', '0', '0');
INSERT INTO cities VALUES ('2308', '142', 'Dornogovi', '0', '0');
INSERT INTO cities VALUES ('2309', '142', 'Dundgovi', '0', '0');
INSERT INTO cities VALUES ('2310', '142', 'Dzavhan', '0', '0');
INSERT INTO cities VALUES ('2311', '142', 'Govi-Altay', '0', '0');
INSERT INTO cities VALUES ('2312', '142', 'Hentiy', '0', '0');
INSERT INTO cities VALUES ('2313', '142', 'Hovd', '0', '0');
INSERT INTO cities VALUES ('2314', '142', 'Hovsgol', '0', '0');
INSERT INTO cities VALUES ('2315', '142', 'Omnogovi', '0', '0');
INSERT INTO cities VALUES ('2316', '142', 'Ovorhangay', '0', '0');
INSERT INTO cities VALUES ('2317', '142', 'Selenge', '0', '0');
INSERT INTO cities VALUES ('2318', '142', 'Suhbaatar', '0', '0');
INSERT INTO cities VALUES ('2319', '142', 'Tov', '0', '0');
INSERT INTO cities VALUES ('2320', '142', 'Uvs', '0', '0');
INSERT INTO cities VALUES ('2321', '142', 'Ulaanbaatar', '0', '0');
INSERT INTO cities VALUES ('2322', '142', 'Bulgan', '0', '0');
INSERT INTO cities VALUES ('2323', '142', 'Erdenet', '0', '0');
INSERT INTO cities VALUES ('2324', '142', 'Darhan-Uul', '0', '0');
INSERT INTO cities VALUES ('2325', '142', 'Govisumber', '0', '0');
INSERT INTO cities VALUES ('2326', '142', 'Orhon', '0', '0');
INSERT INTO cities VALUES ('2327', '125', 'Ilhas', '0', '0');
INSERT INTO cities VALUES ('2328', '125', 'Macau', '0', '0');
INSERT INTO cities VALUES ('2329', '135', 'Hodh Ech Chargui', '0', '0');
INSERT INTO cities VALUES ('2330', '135', 'Hodh El Gharbi', '0', '0');
INSERT INTO cities VALUES ('2331', '135', 'Assaba', '0', '0');
INSERT INTO cities VALUES ('2332', '135', 'Gorgol', '0', '0');
INSERT INTO cities VALUES ('2333', '135', 'Brakna', '0', '0');
INSERT INTO cities VALUES ('2334', '135', 'Trarza', '0', '0');
INSERT INTO cities VALUES ('2335', '135', 'Adrar', '0', '0');
INSERT INTO cities VALUES ('2336', '135', 'Dakhlet Nouadhibou', '0', '0');
INSERT INTO cities VALUES ('2337', '135', 'Tagant', '0', '0');
INSERT INTO cities VALUES ('2338', '135', 'Guidimaka', '0', '0');
INSERT INTO cities VALUES ('2339', '135', 'Tiris Zemmour', '0', '0');
INSERT INTO cities VALUES ('2340', '135', 'Inchiri', '0', '0');
INSERT INTO cities VALUES ('2341', '143', 'Saint Anthony', '0', '0');
INSERT INTO cities VALUES ('2342', '143', 'Saint Georges', '0', '0');
INSERT INTO cities VALUES ('2343', '143', 'Saint Peter', '0', '0');
INSERT INTO cities VALUES ('2344', '136', 'Black River', '0', '0');
INSERT INTO cities VALUES ('2345', '136', 'Flacq', '0', '0');
INSERT INTO cities VALUES ('2346', '136', 'Grand Port', '0', '0');
INSERT INTO cities VALUES ('2347', '136', 'Moka', '0', '0');
INSERT INTO cities VALUES ('2348', '136', 'Pamplemousses', '0', '0');
INSERT INTO cities VALUES ('2349', '136', 'Plaines Wilhems', '0', '0');
INSERT INTO cities VALUES ('2350', '136', 'Port Louis', '0', '0');
INSERT INTO cities VALUES ('2351', '136', 'Riviere du Rempart', '0', '0');
INSERT INTO cities VALUES ('2352', '136', 'Savanne', '0', '0');
INSERT INTO cities VALUES ('2353', '136', 'Agalega Islands', '0', '0');
INSERT INTO cities VALUES ('2354', '136', 'Cargados Carajos', '0', '0');
INSERT INTO cities VALUES ('2355', '136', 'Rodrigues', '0', '0');
INSERT INTO cities VALUES ('2356', '130', 'Seenu', '0', '0');
INSERT INTO cities VALUES ('2357', '130', 'Laamu', '0', '0');
INSERT INTO cities VALUES ('2358', '130', 'Alifu', '0', '0');
INSERT INTO cities VALUES ('2359', '130', 'Baa', '0', '0');
INSERT INTO cities VALUES ('2360', '130', 'Dhaalu', '0', '0');
INSERT INTO cities VALUES ('2361', '130', 'Faafu ', '0', '0');
INSERT INTO cities VALUES ('2362', '130', 'Gaafu Alifu', '0', '0');
INSERT INTO cities VALUES ('2363', '130', 'Gaafu Dhaalu', '0', '0');
INSERT INTO cities VALUES ('2364', '130', 'Haa Alifu', '0', '0');
INSERT INTO cities VALUES ('2365', '130', 'Haa Dhaalu', '0', '0');
INSERT INTO cities VALUES ('2366', '130', 'Kaafu', '0', '0');
INSERT INTO cities VALUES ('2367', '130', 'Lhaviyani', '0', '0');
INSERT INTO cities VALUES ('2368', '130', 'Maale', '0', '0');
INSERT INTO cities VALUES ('2369', '130', 'Meemu', '0', '0');
INSERT INTO cities VALUES ('2370', '130', 'Gnaviyani', '0', '0');
INSERT INTO cities VALUES ('2371', '130', 'Noonu', '0', '0');
INSERT INTO cities VALUES ('2372', '130', 'Raa', '0', '0');
INSERT INTO cities VALUES ('2373', '130', 'Shaviyani', '0', '0');
INSERT INTO cities VALUES ('2374', '130', 'Thaa', '0', '0');
INSERT INTO cities VALUES ('2375', '130', 'Vaavu', '0', '0');
INSERT INTO cities VALUES ('2376', '128', 'Chikwawa', '0', '0');
INSERT INTO cities VALUES ('2377', '128', 'Chiradzulu', '0', '0');
INSERT INTO cities VALUES ('2378', '128', 'Chitipa', '0', '0');
INSERT INTO cities VALUES ('2379', '128', 'Thyolo', '0', '0');
INSERT INTO cities VALUES ('2380', '128', 'Dedza', '0', '0');
INSERT INTO cities VALUES ('2381', '128', 'Dowa', '0', '0');
INSERT INTO cities VALUES ('2382', '128', 'Karonga', '0', '0');
INSERT INTO cities VALUES ('2383', '128', 'Kasungu', '0', '0');
INSERT INTO cities VALUES ('2384', '128', 'Lilongwe', '0', '0');
INSERT INTO cities VALUES ('2385', '128', 'Mangochi', '0', '0');
INSERT INTO cities VALUES ('2386', '128', 'Mchinji', '0', '0');
INSERT INTO cities VALUES ('2387', '128', 'Mzimba', '0', '0');
INSERT INTO cities VALUES ('2388', '128', 'Ntcheu', '0', '0');
INSERT INTO cities VALUES ('2389', '128', 'Nkhata Bay', '0', '0');
INSERT INTO cities VALUES ('2390', '128', 'Nkhotakota', '0', '0');
INSERT INTO cities VALUES ('2391', '128', 'Nsanje', '0', '0');
INSERT INTO cities VALUES ('2392', '128', 'Ntchisi', '0', '0');
INSERT INTO cities VALUES ('2393', '128', 'Rumphi', '0', '0');
INSERT INTO cities VALUES ('2394', '128', 'Salima', '0', '0');
INSERT INTO cities VALUES ('2395', '128', 'Zomba', '0', '0');
INSERT INTO cities VALUES ('2396', '128', 'Blantyre', '0', '0');
INSERT INTO cities VALUES ('2397', '128', 'Mwanza', '0', '0');
INSERT INTO cities VALUES ('2398', '128', 'Balaka', '0', '0');
INSERT INTO cities VALUES ('2399', '128', 'Likoma', '0', '0');
INSERT INTO cities VALUES ('2400', '128', 'Machinga', '0', '0');
INSERT INTO cities VALUES ('2401', '128', 'Mulanje', '0', '0');
INSERT INTO cities VALUES ('2402', '128', 'Phalombe', '0', '0');
INSERT INTO cities VALUES ('2403', '138', 'Aguascalientes', '0', '0');
INSERT INTO cities VALUES ('2404', '138', 'Baja California', '0', '0');
INSERT INTO cities VALUES ('2405', '138', 'Baja California Sur', '0', '0');
INSERT INTO cities VALUES ('2406', '138', 'Campeche', '0', '0');
INSERT INTO cities VALUES ('2407', '138', 'Chiapas', '0', '0');
INSERT INTO cities VALUES ('2408', '138', 'Chihuahua', '0', '0');
INSERT INTO cities VALUES ('2409', '138', 'Coahuila de Zaragoza', '0', '0');
INSERT INTO cities VALUES ('2410', '138', 'Colima', '0', '0');
INSERT INTO cities VALUES ('2411', '138', 'Distrito Federal', '0', '0');
INSERT INTO cities VALUES ('2412', '138', 'Durango', '0', '0');
INSERT INTO cities VALUES ('2413', '138', 'Guanajuato', '0', '0');
INSERT INTO cities VALUES ('2414', '138', 'Guerrero', '0', '0');
INSERT INTO cities VALUES ('2415', '138', 'Hidalgo', '0', '0');
INSERT INTO cities VALUES ('2416', '138', 'Jalisco', '0', '0');
INSERT INTO cities VALUES ('2417', '138', 'Mexico', '0', '0');
INSERT INTO cities VALUES ('2418', '138', 'Michoacan de Ocampo', '0', '0');
INSERT INTO cities VALUES ('2419', '138', 'Morelos', '0', '0');
INSERT INTO cities VALUES ('2420', '138', 'Nayarit', '0', '0');
INSERT INTO cities VALUES ('2421', '138', 'Nuevo Leon', '0', '0');
INSERT INTO cities VALUES ('2422', '138', 'Oaxaca', '0', '0');
INSERT INTO cities VALUES ('2423', '138', 'Puebla', '0', '0');
INSERT INTO cities VALUES ('2424', '138', 'Queretaro de Arteaga', '0', '0');
INSERT INTO cities VALUES ('2425', '138', 'Quintana Roo', '0', '0');
INSERT INTO cities VALUES ('2426', '138', 'San Luis Potosi', '0', '0');
INSERT INTO cities VALUES ('2427', '138', 'Sinaloa', '0', '0');
INSERT INTO cities VALUES ('2428', '138', 'Sonora', '0', '0');
INSERT INTO cities VALUES ('2429', '138', 'Tabasco', '0', '0');
INSERT INTO cities VALUES ('2430', '138', 'Tamaulipas', '0', '0');
INSERT INTO cities VALUES ('2431', '138', 'Tlaxcala', '0', '0');
INSERT INTO cities VALUES ('2432', '138', 'Veracruz-Llave', '0', '0');
INSERT INTO cities VALUES ('2433', '138', 'Yucatan', '0', '0');
INSERT INTO cities VALUES ('2434', '138', 'Zacatecas', '0', '0');
INSERT INTO cities VALUES ('2435', '129', 'Johor', '0', '0');
INSERT INTO cities VALUES ('2436', '129', 'Kedah', '0', '0');
INSERT INTO cities VALUES ('2437', '129', 'Kelantan', '0', '0');
INSERT INTO cities VALUES ('2438', '129', 'Melaka', '0', '0');
INSERT INTO cities VALUES ('2439', '129', 'Negeri Sembilan', '0', '0');
INSERT INTO cities VALUES ('2440', '129', 'Pahang', '0', '0');
INSERT INTO cities VALUES ('2441', '129', 'Perak', '0', '0');
INSERT INTO cities VALUES ('2442', '129', 'Perlis', '0', '0');
INSERT INTO cities VALUES ('2443', '129', 'Pulau Pinang', '0', '0');
INSERT INTO cities VALUES ('2444', '129', 'Sarawak', '0', '0');
INSERT INTO cities VALUES ('2445', '129', 'Selangor', '0', '0');
INSERT INTO cities VALUES ('2446', '129', 'Terengganu', '0', '0');
INSERT INTO cities VALUES ('2447', '129', 'Kuala Lumpur', '0', '0');
INSERT INTO cities VALUES ('2448', '129', 'Labuan', '0', '0');
INSERT INTO cities VALUES ('2449', '129', 'Sabah', '0', '0');
INSERT INTO cities VALUES ('2450', '129', 'Putrajaya', '0', '0');
INSERT INTO cities VALUES ('2451', '145', 'Cabo Delgado', '0', '0');
INSERT INTO cities VALUES ('2452', '145', 'Gaza', '0', '0');
INSERT INTO cities VALUES ('2453', '145', 'Inhambane', '0', '0');
INSERT INTO cities VALUES ('2454', '145', 'Maputo', '0', '0');
INSERT INTO cities VALUES ('2455', '145', 'Sofala', '0', '0');
INSERT INTO cities VALUES ('2456', '145', 'Nampula', '0', '0');
INSERT INTO cities VALUES ('2457', '145', 'Niassa', '0', '0');
INSERT INTO cities VALUES ('2458', '145', 'Tete', '0', '0');
INSERT INTO cities VALUES ('2459', '145', 'Zambezia', '0', '0');
INSERT INTO cities VALUES ('2460', '145', 'Manica', '0', '0');
INSERT INTO cities VALUES ('2461', '145', 'Maputo', '0', '0');
INSERT INTO cities VALUES ('2462', '147', 'Bethanien', '0', '0');
INSERT INTO cities VALUES ('2463', '147', 'Caprivi Oos', '0', '0');
INSERT INTO cities VALUES ('2464', '147', 'Boesmanland', '0', '0');
INSERT INTO cities VALUES ('2465', '147', 'Gobabis', '0', '0');
INSERT INTO cities VALUES ('2466', '147', 'Grootfontein', '0', '0');
INSERT INTO cities VALUES ('2467', '147', 'Kaokoland', '0', '0');
INSERT INTO cities VALUES ('2468', '147', 'Karibib', '0', '0');
INSERT INTO cities VALUES ('2469', '147', 'Keetmanshoop', '0', '0');
INSERT INTO cities VALUES ('2470', '147', 'Luderitz', '0', '0');
INSERT INTO cities VALUES ('2471', '147', 'Maltahohe', '0', '0');
INSERT INTO cities VALUES ('2472', '147', 'Okahandja', '0', '0');
INSERT INTO cities VALUES ('2473', '147', 'Omaruru', '0', '0');
INSERT INTO cities VALUES ('2474', '147', 'Otjiwarongo', '0', '0');
INSERT INTO cities VALUES ('2475', '147', 'Outjo', '0', '0');
INSERT INTO cities VALUES ('2476', '147', 'Owambo', '0', '0');
INSERT INTO cities VALUES ('2477', '147', 'Rehoboth', '0', '0');
INSERT INTO cities VALUES ('2478', '147', 'Swakopmund', '0', '0');
INSERT INTO cities VALUES ('2479', '147', 'Tsumeb', '0', '0');
INSERT INTO cities VALUES ('2480', '147', 'Karasburg', '0', '0');
INSERT INTO cities VALUES ('2481', '147', 'Windhoek', '0', '0');
INSERT INTO cities VALUES ('2482', '147', 'Damaraland', '0', '0');
INSERT INTO cities VALUES ('2483', '147', 'Hereroland Oos', '0', '0');
INSERT INTO cities VALUES ('2484', '147', 'Hereroland Wes', '0', '0');
INSERT INTO cities VALUES ('2485', '147', 'Kavango', '0', '0');
INSERT INTO cities VALUES ('2486', '147', 'Mariental', '0', '0');
INSERT INTO cities VALUES ('2487', '147', 'Namaland', '0', '0');
INSERT INTO cities VALUES ('2488', '147', 'Caprivi', '0', '0');
INSERT INTO cities VALUES ('2489', '147', 'Erongo', '0', '0');
INSERT INTO cities VALUES ('2490', '147', 'Hardap', '0', '0');
INSERT INTO cities VALUES ('2491', '147', 'Karas', '0', '0');
INSERT INTO cities VALUES ('2492', '147', 'Kunene', '0', '0');
INSERT INTO cities VALUES ('2493', '147', 'Ohangwena', '0', '0');
INSERT INTO cities VALUES ('2494', '147', 'Okavango', '0', '0');
INSERT INTO cities VALUES ('2495', '147', 'Omaheke', '0', '0');
INSERT INTO cities VALUES ('2496', '147', 'Omusati', '0', '0');
INSERT INTO cities VALUES ('2497', '147', 'Oshana', '0', '0');
INSERT INTO cities VALUES ('2498', '147', 'Oshikoto', '0', '0');
INSERT INTO cities VALUES ('2499', '147', 'Otjozondjupa', '0', '0');
INSERT INTO cities VALUES ('2500', '155', 'Agadez', '0', '0');
INSERT INTO cities VALUES ('2501', '155', 'Diffa', '0', '0');
INSERT INTO cities VALUES ('2502', '155', 'Dosso', '0', '0');
INSERT INTO cities VALUES ('2503', '155', 'Maradi', '0', '0');
INSERT INTO cities VALUES ('2504', '155', 'Niamey', '0', '0');
INSERT INTO cities VALUES ('2505', '155', 'Tahoua', '0', '0');
INSERT INTO cities VALUES ('2506', '155', 'Zinder', '0', '0');
INSERT INTO cities VALUES ('2507', '155', 'Niamey', '0', '0');
INSERT INTO cities VALUES ('2508', '156', 'Lagos', '0', '0');
INSERT INTO cities VALUES ('2509', '156', 'Federal Capital Territory', '0', '0');
INSERT INTO cities VALUES ('2510', '156', 'Ogun', '0', '0');
INSERT INTO cities VALUES ('2511', '156', 'Akwa Ibom', '0', '0');
INSERT INTO cities VALUES ('2512', '156', 'Cross River', '0', '0');
INSERT INTO cities VALUES ('2513', '156', 'Kaduna', '0', '0');
INSERT INTO cities VALUES ('2514', '156', 'Katsina', '0', '0');
INSERT INTO cities VALUES ('2515', '156', 'Anambra', '0', '0');
INSERT INTO cities VALUES ('2516', '156', 'Benue', '0', '0');
INSERT INTO cities VALUES ('2517', '156', 'Borno', '0', '0');
INSERT INTO cities VALUES ('2518', '156', 'Imo', '0', '0');
INSERT INTO cities VALUES ('2519', '156', 'Kano', '0', '0');
INSERT INTO cities VALUES ('2520', '156', 'Kwara', '0', '0');
INSERT INTO cities VALUES ('2521', '156', 'Niger', '0', '0');
INSERT INTO cities VALUES ('2522', '156', 'Oyo', '0', '0');
INSERT INTO cities VALUES ('2523', '156', 'Adamawa', '0', '0');
INSERT INTO cities VALUES ('2524', '156', 'Delta', '0', '0');
INSERT INTO cities VALUES ('2525', '156', 'Edo', '0', '0');
INSERT INTO cities VALUES ('2526', '156', 'Jigawa', '0', '0');
INSERT INTO cities VALUES ('2527', '156', 'Kebbi', '0', '0');
INSERT INTO cities VALUES ('2528', '156', 'Kogi', '0', '0');
INSERT INTO cities VALUES ('2529', '156', 'Osun', '0', '0');
INSERT INTO cities VALUES ('2530', '156', 'Taraba', '0', '0');
INSERT INTO cities VALUES ('2531', '156', 'Yobe', '0', '0');
INSERT INTO cities VALUES ('2532', '156', 'Abia', '0', '0');
INSERT INTO cities VALUES ('2533', '156', 'Bauchi', '0', '0');
INSERT INTO cities VALUES ('2534', '156', 'Enugu', '0', '0');
INSERT INTO cities VALUES ('2535', '156', 'Ondo', '0', '0');
INSERT INTO cities VALUES ('2536', '156', 'Plateau', '0', '0');
INSERT INTO cities VALUES ('2537', '156', 'Rivers', '0', '0');
INSERT INTO cities VALUES ('2538', '156', 'Sokoto', '0', '0');
INSERT INTO cities VALUES ('2539', '156', 'Bayelsa', '0', '0');
INSERT INTO cities VALUES ('2540', '156', 'Ebonyi', '0', '0');
INSERT INTO cities VALUES ('2541', '156', 'Ekiti', '0', '0');
INSERT INTO cities VALUES ('2542', '156', 'Gombe', '0', '0');
INSERT INTO cities VALUES ('2543', '156', 'Nassarawa', '0', '0');
INSERT INTO cities VALUES ('2544', '156', 'Zamfara', '0', '0');
INSERT INTO cities VALUES ('2545', '154', 'Boaco', '0', '0');
INSERT INTO cities VALUES ('2546', '154', 'Carazo', '0', '0');
INSERT INTO cities VALUES ('2547', '154', 'Chinandega', '0', '0');
INSERT INTO cities VALUES ('2548', '154', 'Chontales', '0', '0');
INSERT INTO cities VALUES ('2549', '154', 'Esteli', '0', '0');
INSERT INTO cities VALUES ('2550', '154', 'Granada', '0', '0');
INSERT INTO cities VALUES ('2551', '154', 'Jinotega', '0', '0');
INSERT INTO cities VALUES ('2552', '154', 'Leon', '0', '0');
INSERT INTO cities VALUES ('2553', '154', 'Madriz', '0', '0');
INSERT INTO cities VALUES ('2554', '154', 'Managua', '0', '0');
INSERT INTO cities VALUES ('2555', '154', 'Masaya', '0', '0');
INSERT INTO cities VALUES ('2556', '154', 'Matagalpa', '0', '0');
INSERT INTO cities VALUES ('2557', '154', 'Nueva Segovia', '0', '0');
INSERT INTO cities VALUES ('2558', '154', 'Rio San Juan', '0', '0');
INSERT INTO cities VALUES ('2559', '154', 'Rivas', '0', '0');
INSERT INTO cities VALUES ('2560', '154', 'Zelaya', '0', '0');
INSERT INTO cities VALUES ('2561', '154', 'Autonoma Atlantico Norte', '0', '0');
INSERT INTO cities VALUES ('2562', '154', 'Region Autonoma Atlantico Sur', '0', '0');
INSERT INTO cities VALUES ('2563', '150', 'Drenthe', '0', '0');
INSERT INTO cities VALUES ('2564', '150', 'Friesland', '0', '0');
INSERT INTO cities VALUES ('2565', '150', 'Gelderland', '0', '0');
INSERT INTO cities VALUES ('2566', '150', 'Groningen', '0', '0');
INSERT INTO cities VALUES ('2567', '150', 'Limburg', '0', '0');
INSERT INTO cities VALUES ('2568', '150', 'Noord-Brabant', '0', '0');
INSERT INTO cities VALUES ('2569', '150', 'Noord-Holland', '0', '0');
INSERT INTO cities VALUES ('2570', '150', 'Utrecht', '0', '0');
INSERT INTO cities VALUES ('2571', '150', 'Zeeland', '0', '0');
INSERT INTO cities VALUES ('2572', '150', 'Zuid-Holland', '0', '0');
INSERT INTO cities VALUES ('2573', '150', 'Overijssel', '0', '0');
INSERT INTO cities VALUES ('2574', '150', 'Flevoland', '0', '0');
INSERT INTO cities VALUES ('2575', '160', 'Akershus', '0', '0');
INSERT INTO cities VALUES ('2576', '160', 'Aust-Agder', '0', '0');
INSERT INTO cities VALUES ('2577', '160', 'Buskerud', '0', '0');
INSERT INTO cities VALUES ('2578', '160', 'Finnmark', '0', '0');
INSERT INTO cities VALUES ('2579', '160', 'Hedmark', '0', '0');
INSERT INTO cities VALUES ('2580', '160', 'Hordaland', '0', '0');
INSERT INTO cities VALUES ('2581', '160', 'More og Romsdal', '0', '0');
INSERT INTO cities VALUES ('2582', '160', 'Nordland', '0', '0');
INSERT INTO cities VALUES ('2583', '160', 'Nord-Trondelag', '0', '0');
INSERT INTO cities VALUES ('2584', '160', 'Oppland', '0', '0');
INSERT INTO cities VALUES ('2585', '160', 'Oslo', '0', '0');
INSERT INTO cities VALUES ('2586', '160', 'Ostfold', '0', '0');
INSERT INTO cities VALUES ('2587', '160', 'Rogaland', '0', '0');
INSERT INTO cities VALUES ('2588', '160', 'Sogn og Fjordane', '0', '0');
INSERT INTO cities VALUES ('2589', '160', 'Sor-Trondelag', '0', '0');
INSERT INTO cities VALUES ('2590', '160', 'Telemark', '0', '0');
INSERT INTO cities VALUES ('2591', '160', 'Troms', '0', '0');
INSERT INTO cities VALUES ('2592', '160', 'Vest-Agder', '0', '0');
INSERT INTO cities VALUES ('2593', '160', 'Vestfold', '0', '0');
INSERT INTO cities VALUES ('2594', '149', 'Bagmati', '0', '0');
INSERT INTO cities VALUES ('2595', '149', 'Bheri', '0', '0');
INSERT INTO cities VALUES ('2596', '149', 'Dhawalagiri', '0', '0');
INSERT INTO cities VALUES ('2597', '149', 'Gandaki', '0', '0');
INSERT INTO cities VALUES ('2598', '149', 'Janakpur', '0', '0');
INSERT INTO cities VALUES ('2599', '149', 'Karnali', '0', '0');
INSERT INTO cities VALUES ('2600', '149', 'Kosi', '0', '0');
INSERT INTO cities VALUES ('2601', '149', 'Lumbini', '0', '0');
INSERT INTO cities VALUES ('2602', '149', 'Mahakali', '0', '0');
INSERT INTO cities VALUES ('2603', '149', 'Mechi', '0', '0');
INSERT INTO cities VALUES ('2604', '149', 'Narayani', '0', '0');
INSERT INTO cities VALUES ('2605', '149', 'Rapti', '0', '0');
INSERT INTO cities VALUES ('2606', '149', 'Sagarmatha', '0', '0');
INSERT INTO cities VALUES ('2607', '149', 'Seti', '0', '0');
INSERT INTO cities VALUES ('2608', '148', 'Aiwo', '0', '0');
INSERT INTO cities VALUES ('2609', '148', 'Anabar', '0', '0');
INSERT INTO cities VALUES ('2610', '148', 'Anetan', '0', '0');
INSERT INTO cities VALUES ('2611', '148', 'Anibare', '0', '0');
INSERT INTO cities VALUES ('2612', '148', 'Baiti', '0', '0');
INSERT INTO cities VALUES ('2613', '148', 'Boe', '0', '0');
INSERT INTO cities VALUES ('2614', '148', 'Buada', '0', '0');
INSERT INTO cities VALUES ('2615', '148', 'Denigomodu', '0', '0');
INSERT INTO cities VALUES ('2616', '148', 'Ewa', '0', '0');
INSERT INTO cities VALUES ('2617', '148', 'Ijuw', '0', '0');
INSERT INTO cities VALUES ('2618', '148', 'Meneng', '0', '0');
INSERT INTO cities VALUES ('2619', '148', 'Nibok', '0', '0');
INSERT INTO cities VALUES ('2620', '148', 'Uaboe', '0', '0');
INSERT INTO cities VALUES ('2621', '148', 'Yaren', '0', '0');
INSERT INTO cities VALUES ('2622', '153', 'Chatham Islands', '0', '0');
INSERT INTO cities VALUES ('2623', '153', 'Auckland', '0', '0');
INSERT INTO cities VALUES ('2624', '153', 'Bay of Plenty', '0', '0');
INSERT INTO cities VALUES ('2625', '153', 'Canterbury', '0', '0');
INSERT INTO cities VALUES ('2626', '153', 'Gisborne', '0', '0');
INSERT INTO cities VALUES ('2627', '153', 'Hawke\'s Bay', '0', '0');
INSERT INTO cities VALUES ('2628', '153', 'Manawatu-Wanganui', '0', '0');
INSERT INTO cities VALUES ('2629', '153', 'Marlborough', '0', '0');
INSERT INTO cities VALUES ('2630', '153', 'Nelson', '0', '0');
INSERT INTO cities VALUES ('2631', '153', 'Northland', '0', '0');
INSERT INTO cities VALUES ('2632', '153', 'Otago', '0', '0');
INSERT INTO cities VALUES ('2633', '153', 'Southland', '0', '0');
INSERT INTO cities VALUES ('2634', '153', 'Taranaki', '0', '0');
INSERT INTO cities VALUES ('2635', '153', 'Waikato', '0', '0');
INSERT INTO cities VALUES ('2636', '153', 'Wellington', '0', '0');
INSERT INTO cities VALUES ('2637', '153', 'West Coast', '0', '0');
INSERT INTO cities VALUES ('2638', '161', 'Ad Dakhiliyah', '0', '0');
INSERT INTO cities VALUES ('2639', '161', 'Al Batinah', '0', '0');
INSERT INTO cities VALUES ('2640', '161', 'Al Wusta', '0', '0');
INSERT INTO cities VALUES ('2641', '161', 'Ash Sharqiyah', '0', '0');
INSERT INTO cities VALUES ('2642', '161', 'Az Zahirah', '0', '0');
INSERT INTO cities VALUES ('2643', '161', 'Masqat', '0', '0');
INSERT INTO cities VALUES ('2644', '161', 'Musandam', '0', '0');
INSERT INTO cities VALUES ('2645', '161', 'Zufar', '0', '0');
INSERT INTO cities VALUES ('2646', '164', 'Bocas del Toro', '0', '0');
INSERT INTO cities VALUES ('2647', '164', 'Chiriqui', '0', '0');
INSERT INTO cities VALUES ('2648', '164', 'Cocle', '0', '0');
INSERT INTO cities VALUES ('2649', '164', 'Colon', '0', '0');
INSERT INTO cities VALUES ('2650', '164', 'Darien', '0', '0');
INSERT INTO cities VALUES ('2651', '164', 'Herrera', '0', '0');
INSERT INTO cities VALUES ('2652', '164', 'Los Santos', '0', '0');
INSERT INTO cities VALUES ('2653', '164', 'Panama', '0', '0');
INSERT INTO cities VALUES ('2654', '164', 'San Blas', '0', '0');
INSERT INTO cities VALUES ('2655', '164', 'Veraguas', '0', '0');
INSERT INTO cities VALUES ('2656', '167', 'Amazonas', '0', '0');
INSERT INTO cities VALUES ('2657', '167', 'Ancash', '0', '0');
INSERT INTO cities VALUES ('2658', '167', 'Apurimac', '0', '0');
INSERT INTO cities VALUES ('2659', '167', 'Arequipa', '0', '0');
INSERT INTO cities VALUES ('2660', '167', 'Ayacucho', '0', '0');
INSERT INTO cities VALUES ('2661', '167', 'Cajamarca', '0', '0');
INSERT INTO cities VALUES ('2662', '167', 'Callao', '0', '0');
INSERT INTO cities VALUES ('2663', '167', 'Cusco', '0', '0');
INSERT INTO cities VALUES ('2664', '167', 'Huancavelica', '0', '0');
INSERT INTO cities VALUES ('2665', '167', 'Huanuco', '0', '0');
INSERT INTO cities VALUES ('2666', '167', 'Ica', '0', '0');
INSERT INTO cities VALUES ('2667', '167', 'Junin', '0', '0');
INSERT INTO cities VALUES ('2668', '167', 'La Libertad', '0', '0');
INSERT INTO cities VALUES ('2669', '167', 'Lambayeque', '0', '0');
INSERT INTO cities VALUES ('2670', '167', 'Lima', '0', '0');
INSERT INTO cities VALUES ('2671', '167', 'Loreto', '0', '0');
INSERT INTO cities VALUES ('2672', '167', 'Madre de Dios', '0', '0');
INSERT INTO cities VALUES ('2673', '167', 'Moquegua', '0', '0');
INSERT INTO cities VALUES ('2674', '167', 'Pasco', '0', '0');
INSERT INTO cities VALUES ('2675', '167', 'Piura', '0', '0');
INSERT INTO cities VALUES ('2676', '167', 'Puno', '0', '0');
INSERT INTO cities VALUES ('2677', '167', 'San Martin', '0', '0');
INSERT INTO cities VALUES ('2678', '167', 'Tacna', '0', '0');
INSERT INTO cities VALUES ('2679', '167', 'Tumbes', '0', '0');
INSERT INTO cities VALUES ('2680', '167', 'Ucayali', '0', '0');
INSERT INTO cities VALUES ('2681', '165', 'Central', '0', '0');
INSERT INTO cities VALUES ('2682', '165', 'Gulf', '0', '0');
INSERT INTO cities VALUES ('2683', '165', 'Milne Bay', '0', '0');
INSERT INTO cities VALUES ('2684', '165', 'Northern', '0', '0');
INSERT INTO cities VALUES ('2685', '165', 'Southern Highlands', '0', '0');
INSERT INTO cities VALUES ('2686', '165', 'Western', '0', '0');
INSERT INTO cities VALUES ('2687', '165', 'North Solomons', '0', '0');
INSERT INTO cities VALUES ('2688', '165', 'Chimbu', '0', '0');
INSERT INTO cities VALUES ('2689', '165', 'Eastern Highlands', '0', '0');
INSERT INTO cities VALUES ('2690', '165', 'East New Britain', '0', '0');
INSERT INTO cities VALUES ('2691', '165', 'East Sepik', '0', '0');
INSERT INTO cities VALUES ('2692', '165', 'Madang', '0', '0');
INSERT INTO cities VALUES ('2693', '165', 'Manus', '0', '0');
INSERT INTO cities VALUES ('2694', '165', 'Morobe', '0', '0');
INSERT INTO cities VALUES ('2695', '165', 'New Ireland', '0', '0');
INSERT INTO cities VALUES ('2696', '165', 'Western Highlands', '0', '0');
INSERT INTO cities VALUES ('2697', '165', 'West New Britain', '0', '0');
INSERT INTO cities VALUES ('2698', '165', 'Sandaun', '0', '0');
INSERT INTO cities VALUES ('2699', '165', 'Enga', '0', '0');
INSERT INTO cities VALUES ('2700', '165', 'National Capital', '0', '0');
INSERT INTO cities VALUES ('2701', '168', 'Abra', '0', '0');
INSERT INTO cities VALUES ('2702', '168', 'Agusan del Norte', '0', '0');
INSERT INTO cities VALUES ('2703', '168', 'Agusan del Sur', '0', '0');
INSERT INTO cities VALUES ('2704', '168', 'Aklan', '0', '0');
INSERT INTO cities VALUES ('2705', '168', 'Albay', '0', '0');
INSERT INTO cities VALUES ('2706', '168', 'Antique', '0', '0');
INSERT INTO cities VALUES ('2707', '168', 'Bataan', '0', '0');
INSERT INTO cities VALUES ('2708', '168', 'Batanes', '0', '0');
INSERT INTO cities VALUES ('2709', '168', 'Batangas', '0', '0');
INSERT INTO cities VALUES ('2710', '168', 'Benguet', '0', '0');
INSERT INTO cities VALUES ('2711', '168', 'Bohol', '0', '0');
INSERT INTO cities VALUES ('2712', '168', 'Bukidnon', '0', '0');
INSERT INTO cities VALUES ('2713', '168', 'Bulacan', '0', '0');
INSERT INTO cities VALUES ('2714', '168', 'Cagayan', '0', '0');
INSERT INTO cities VALUES ('2715', '168', 'Camarines Norte', '0', '0');
INSERT INTO cities VALUES ('2716', '168', 'Camarines Sur', '0', '0');
INSERT INTO cities VALUES ('2717', '168', 'Camiguin', '0', '0');
INSERT INTO cities VALUES ('2718', '168', 'Capiz', '0', '0');
INSERT INTO cities VALUES ('2719', '168', 'Catanduanes', '0', '0');
INSERT INTO cities VALUES ('2720', '168', 'Cavite', '0', '0');
INSERT INTO cities VALUES ('2721', '168', 'Cebu', '0', '0');
INSERT INTO cities VALUES ('2722', '168', 'Basilan', '0', '0');
INSERT INTO cities VALUES ('2723', '168', 'Eastern Samar', '0', '0');
INSERT INTO cities VALUES ('2724', '168', 'Davao', '0', '0');
INSERT INTO cities VALUES ('2725', '168', 'Davao del Sur', '0', '0');
INSERT INTO cities VALUES ('2726', '168', 'Davao Oriental', '0', '0');
INSERT INTO cities VALUES ('2727', '168', 'Ifugao', '0', '0');
INSERT INTO cities VALUES ('2728', '168', 'Ilocos Norte', '0', '0');
INSERT INTO cities VALUES ('2729', '168', 'Ilocos Sur', '0', '0');
INSERT INTO cities VALUES ('2730', '168', 'Iloilo', '0', '0');
INSERT INTO cities VALUES ('2731', '168', 'Isabela', '0', '0');
INSERT INTO cities VALUES ('2732', '168', 'Kalinga-Apayao', '0', '0');
INSERT INTO cities VALUES ('2733', '168', 'Laguna', '0', '0');
INSERT INTO cities VALUES ('2734', '168', 'Lanao del Norte', '0', '0');
INSERT INTO cities VALUES ('2735', '168', 'Lanao del Sur', '0', '0');
INSERT INTO cities VALUES ('2736', '168', 'La Union', '0', '0');
INSERT INTO cities VALUES ('2737', '168', 'Leyte', '0', '0');
INSERT INTO cities VALUES ('2738', '168', 'Marinduque', '0', '0');
INSERT INTO cities VALUES ('2739', '168', 'Masbate', '0', '0');
INSERT INTO cities VALUES ('2740', '168', 'Mindoro Occidental', '0', '0');
INSERT INTO cities VALUES ('2741', '168', 'Mindoro Oriental', '0', '0');
INSERT INTO cities VALUES ('2742', '168', 'Misamis Occidental', '0', '0');
INSERT INTO cities VALUES ('2743', '168', 'Misamis Oriental', '0', '0');
INSERT INTO cities VALUES ('2744', '168', 'Mountain', '0', '0');
INSERT INTO cities VALUES ('2745', '168', 'Negros Occidental', '0', '0');
INSERT INTO cities VALUES ('2746', '168', 'Negros Oriental', '0', '0');
INSERT INTO cities VALUES ('2747', '168', 'Nueva Ecija', '0', '0');
INSERT INTO cities VALUES ('2748', '168', 'Nueva Vizcaya', '0', '0');
INSERT INTO cities VALUES ('2749', '168', 'Palawan', '0', '0');
INSERT INTO cities VALUES ('2750', '168', 'Pampanga', '0', '0');
INSERT INTO cities VALUES ('2751', '168', 'Pangasinan', '0', '0');
INSERT INTO cities VALUES ('2752', '168', 'Rizal', '0', '0');
INSERT INTO cities VALUES ('2753', '168', 'Romblon', '0', '0');
INSERT INTO cities VALUES ('2754', '168', 'Samar', '0', '0');
INSERT INTO cities VALUES ('2755', '168', 'Maguindanao', '0', '0');
INSERT INTO cities VALUES ('2756', '168', 'North Cotabato', '0', '0');
INSERT INTO cities VALUES ('2757', '168', 'Sorsogon', '0', '0');
INSERT INTO cities VALUES ('2758', '168', 'Southern Leyte', '0', '0');
INSERT INTO cities VALUES ('2759', '168', 'Sulu', '0', '0');
INSERT INTO cities VALUES ('2760', '168', 'Surigao del Norte', '0', '0');
INSERT INTO cities VALUES ('2761', '168', 'Surigao del Sur', '0', '0');
INSERT INTO cities VALUES ('2762', '168', 'Tarlac', '0', '0');
INSERT INTO cities VALUES ('2763', '168', 'Zambales', '0', '0');
INSERT INTO cities VALUES ('2764', '168', 'Zamboanga del Norte', '0', '0');
INSERT INTO cities VALUES ('2765', '168', 'Zamboanga del Sur', '0', '0');
INSERT INTO cities VALUES ('2766', '168', 'Northern Samar', '0', '0');
INSERT INTO cities VALUES ('2767', '168', 'Quirino', '0', '0');
INSERT INTO cities VALUES ('2768', '168', 'Siquijor', '0', '0');
INSERT INTO cities VALUES ('2769', '168', 'South Cotabato', '0', '0');
INSERT INTO cities VALUES ('2770', '168', 'Sultan Kudarat', '0', '0');
INSERT INTO cities VALUES ('2771', '168', 'Tawitawi', '0', '0');
INSERT INTO cities VALUES ('2772', '168', 'Angeles', '0', '0');
INSERT INTO cities VALUES ('2773', '168', 'Bacolod', '0', '0');
INSERT INTO cities VALUES ('2774', '168', 'Bago', '0', '0');
INSERT INTO cities VALUES ('2775', '168', 'Baguio', '0', '0');
INSERT INTO cities VALUES ('2776', '168', 'Bais', '0', '0');
INSERT INTO cities VALUES ('2777', '168', 'Basilan City', '0', '0');
INSERT INTO cities VALUES ('2778', '168', 'Batangas City', '0', '0');
INSERT INTO cities VALUES ('2779', '168', 'Butuan', '0', '0');
INSERT INTO cities VALUES ('2780', '168', 'Cabanatuan', '0', '0');
INSERT INTO cities VALUES ('2781', '168', 'Cadiz', '0', '0');
INSERT INTO cities VALUES ('2782', '168', 'Cagayan de Oro', '0', '0');
INSERT INTO cities VALUES ('2783', '168', 'Calbayog', '0', '0');
INSERT INTO cities VALUES ('2784', '168', 'Caloocan', '0', '0');
INSERT INTO cities VALUES ('2785', '168', 'Canlaon', '0', '0');
INSERT INTO cities VALUES ('2786', '168', 'Cavite City', '0', '0');
INSERT INTO cities VALUES ('2787', '168', 'Cebu City', '0', '0');
INSERT INTO cities VALUES ('2788', '168', 'Cotabato', '0', '0');
INSERT INTO cities VALUES ('2789', '168', 'Dagupan', '0', '0');
INSERT INTO cities VALUES ('2790', '168', 'Danao', '0', '0');
INSERT INTO cities VALUES ('2791', '168', 'Dapitan', '0', '0');
INSERT INTO cities VALUES ('2792', '168', 'Davao City', '0', '0');
INSERT INTO cities VALUES ('2793', '168', 'Dipolog', '0', '0');
INSERT INTO cities VALUES ('2794', '168', 'Dumaguete', '0', '0');
INSERT INTO cities VALUES ('2795', '168', 'General Santos', '0', '0');
INSERT INTO cities VALUES ('2796', '168', 'Gingoog', '0', '0');
INSERT INTO cities VALUES ('2797', '168', 'Iligan', '0', '0');
INSERT INTO cities VALUES ('2798', '168', 'Iloilo City', '0', '0');
INSERT INTO cities VALUES ('2799', '168', 'Iriga', '0', '0');
INSERT INTO cities VALUES ('2800', '168', 'La Carlota', '0', '0');
INSERT INTO cities VALUES ('2801', '168', 'Laoag', '0', '0');
INSERT INTO cities VALUES ('2802', '168', 'Lapu-Lapu', '0', '0');
INSERT INTO cities VALUES ('2803', '168', 'Legaspi', '0', '0');
INSERT INTO cities VALUES ('2804', '168', 'Lipa', '0', '0');
INSERT INTO cities VALUES ('2805', '168', 'Lucena', '0', '0');
INSERT INTO cities VALUES ('2806', '168', 'Mandaue', '0', '0');
INSERT INTO cities VALUES ('2807', '168', 'Manila', '0', '0');
INSERT INTO cities VALUES ('2808', '168', 'Marawi', '0', '0');
INSERT INTO cities VALUES ('2809', '168', 'Naga', '0', '0');
INSERT INTO cities VALUES ('2810', '168', 'Olongapo', '0', '0');
INSERT INTO cities VALUES ('2811', '168', 'Ormoc', '0', '0');
INSERT INTO cities VALUES ('2812', '168', 'Oroquieta', '0', '0');
INSERT INTO cities VALUES ('2813', '168', 'Ozamis', '0', '0');
INSERT INTO cities VALUES ('2814', '168', 'Pagadian', '0', '0');
INSERT INTO cities VALUES ('2815', '168', 'Palayan', '0', '0');
INSERT INTO cities VALUES ('2816', '168', 'Pasay', '0', '0');
INSERT INTO cities VALUES ('2817', '168', 'Puerto Princesa', '0', '0');
INSERT INTO cities VALUES ('2818', '168', 'Quezon City', '0', '0');
INSERT INTO cities VALUES ('2819', '168', 'Roxas', '0', '0');
INSERT INTO cities VALUES ('2820', '168', 'San Carlos', '0', '0');
INSERT INTO cities VALUES ('2821', '168', 'San Carlos', '0', '0');
INSERT INTO cities VALUES ('2822', '168', 'San Jose', '0', '0');
INSERT INTO cities VALUES ('2823', '168', 'San Pablo', '0', '0');
INSERT INTO cities VALUES ('2824', '168', 'Silay', '0', '0');
INSERT INTO cities VALUES ('2825', '168', 'Surigao', '0', '0');
INSERT INTO cities VALUES ('2826', '168', 'Tacloban', '0', '0');
INSERT INTO cities VALUES ('2827', '168', 'Tagaytay', '0', '0');
INSERT INTO cities VALUES ('2828', '168', 'Tagbilaran', '0', '0');
INSERT INTO cities VALUES ('2829', '168', 'Tangub', '0', '0');
INSERT INTO cities VALUES ('2830', '168', 'Toledo', '0', '0');
INSERT INTO cities VALUES ('2831', '168', 'Trece Martires', '0', '0');
INSERT INTO cities VALUES ('2832', '168', 'Zamboanga', '0', '0');
INSERT INTO cities VALUES ('2833', '168', 'Aurora', '0', '0');
INSERT INTO cities VALUES ('2834', '168', 'Quezon', '0', '0');
INSERT INTO cities VALUES ('2835', '168', 'Negros Occidental', '0', '0');
INSERT INTO cities VALUES ('2836', '168', 'Compostela Valley', '0', '0');
INSERT INTO cities VALUES ('2837', '168', 'Davao del Norte', '0', '0');
INSERT INTO cities VALUES ('2838', '168', 'Himamaylan', '0', '0');
INSERT INTO cities VALUES ('2839', '168', 'Kalinga', '0', '0');
INSERT INTO cities VALUES ('2840', '168', 'Malaybalay', '0', '0');
INSERT INTO cities VALUES ('2841', '168', 'Passi', '0', '0');
INSERT INTO cities VALUES ('2842', '168', 'Zambales', '0', '0');
INSERT INTO cities VALUES ('2843', '168', 'San Jose del Monte', '0', '0');
INSERT INTO cities VALUES ('2844', '168', 'San Juan', '0', '0');
INSERT INTO cities VALUES ('2845', '168', 'Santiago', '0', '0');
INSERT INTO cities VALUES ('2846', '168', 'Sarangani', '0', '0');
INSERT INTO cities VALUES ('2847', '168', 'Sipalay', '0', '0');
INSERT INTO cities VALUES ('2848', '168', 'Surigao del Norte', '0', '0');
INSERT INTO cities VALUES ('2849', '168', 'Zamboanga', '0', '0');
INSERT INTO cities VALUES ('2850', '162', 'Federally Administered Tribal Areas', '0', '0');
INSERT INTO cities VALUES ('2851', '162', 'Balochistan', '0', '0');
INSERT INTO cities VALUES ('2852', '162', 'North-West Frontier', '0', '0');
INSERT INTO cities VALUES ('2853', '162', 'Punjab', '0', '0');
INSERT INTO cities VALUES ('2854', '162', 'Sindh', '0', '0');
INSERT INTO cities VALUES ('2855', '162', 'Azad Kashmir', '0', '0');
INSERT INTO cities VALUES ('2856', '162', 'Northern Areas', '0', '0');
INSERT INTO cities VALUES ('2857', '162', 'Islamabad', '0', '0');
INSERT INTO cities VALUES ('2858', '170', 'Dolnoslaskie', '0', '0');
INSERT INTO cities VALUES ('2859', '170', 'Kujawsko-Pomorskie', '0', '0');
INSERT INTO cities VALUES ('2860', '170', 'Lodzkie', '0', '0');
INSERT INTO cities VALUES ('2861', '170', 'Lubelskie', '0', '0');
INSERT INTO cities VALUES ('2862', '170', 'Lubuskie', '0', '0');
INSERT INTO cities VALUES ('2863', '170', 'Malopolskie', '0', '0');
INSERT INTO cities VALUES ('2864', '170', 'Mazowieckie', '0', '0');
INSERT INTO cities VALUES ('2865', '170', 'Opolskie', '0', '0');
INSERT INTO cities VALUES ('2866', '170', 'Podkarpackie', '0', '0');
INSERT INTO cities VALUES ('2867', '170', 'Podlaskie', '0', '0');
INSERT INTO cities VALUES ('2868', '170', 'Pomorskie', '0', '0');
INSERT INTO cities VALUES ('2869', '170', 'Slaskie', '0', '0');
INSERT INTO cities VALUES ('2870', '170', 'Swietokrzyskie', '0', '0');
INSERT INTO cities VALUES ('2871', '170', 'Warminsko-Mazurskie', '0', '0');
INSERT INTO cities VALUES ('2872', '170', 'Wielkopolskie', '0', '0');
INSERT INTO cities VALUES ('2873', '170', 'Zachodniopomorskie', '0', '0');
INSERT INTO cities VALUES ('2874', '248', 'Gaza', '0', '0');
INSERT INTO cities VALUES ('2875', '248', 'West Bank', '0', '0');
INSERT INTO cities VALUES ('2876', '171', 'Aveiro', '0', '0');
INSERT INTO cities VALUES ('2877', '171', 'Beja', '0', '0');
INSERT INTO cities VALUES ('2878', '171', 'Braga', '0', '0');
INSERT INTO cities VALUES ('2879', '171', 'Braganca', '0', '0');
INSERT INTO cities VALUES ('2880', '171', 'Castelo Branco', '0', '0');
INSERT INTO cities VALUES ('2881', '171', 'Coimbra', '0', '0');
INSERT INTO cities VALUES ('2882', '171', 'Evora', '0', '0');
INSERT INTO cities VALUES ('2883', '171', 'Faro', '0', '0');
INSERT INTO cities VALUES ('2884', '171', 'Madeira', '0', '0');
INSERT INTO cities VALUES ('2885', '171', 'Guarda', '0', '0');
INSERT INTO cities VALUES ('2886', '171', 'Leiria', '0', '0');
INSERT INTO cities VALUES ('2887', '171', 'Lisboa', '0', '0');
INSERT INTO cities VALUES ('2888', '171', 'Portalegre', '0', '0');
INSERT INTO cities VALUES ('2889', '171', 'Porto', '0', '0');
INSERT INTO cities VALUES ('2890', '171', 'Santarem', '0', '0');
INSERT INTO cities VALUES ('2891', '171', 'Setubal', '0', '0');
INSERT INTO cities VALUES ('2892', '171', 'Viana do Castelo', '0', '0');
INSERT INTO cities VALUES ('2893', '171', 'Vila Real', '0', '0');
INSERT INTO cities VALUES ('2894', '171', 'Viseu', '0', '0');
INSERT INTO cities VALUES ('2895', '171', 'Azores', '0', '0');
INSERT INTO cities VALUES ('2896', '166', 'Alto Parana', '0', '0');
INSERT INTO cities VALUES ('2897', '166', 'Amambay', '0', '0');
INSERT INTO cities VALUES ('2898', '166', 'Boqueron', '0', '0');
INSERT INTO cities VALUES ('2899', '166', 'Caaguazu', '0', '0');
INSERT INTO cities VALUES ('2900', '166', 'Caazapa', '0', '0');
INSERT INTO cities VALUES ('2901', '166', 'Central', '0', '0');
INSERT INTO cities VALUES ('2902', '166', 'Concepcion', '0', '0');
INSERT INTO cities VALUES ('2903', '166', 'Cordillera', '0', '0');
INSERT INTO cities VALUES ('2904', '166', 'Guaira', '0', '0');
INSERT INTO cities VALUES ('2905', '166', 'Itapua', '0', '0');
INSERT INTO cities VALUES ('2906', '166', 'Misiones', '0', '0');
INSERT INTO cities VALUES ('2907', '166', 'Neembucu', '0', '0');
INSERT INTO cities VALUES ('2908', '166', 'Paraguari', '0', '0');
INSERT INTO cities VALUES ('2909', '166', 'Presidente Hayes', '0', '0');
INSERT INTO cities VALUES ('2910', '166', 'San Pedro', '0', '0');
INSERT INTO cities VALUES ('2911', '166', 'Canindeyu', '0', '0');
INSERT INTO cities VALUES ('2912', '166', 'Chaco', '0', '0');
INSERT INTO cities VALUES ('2913', '166', 'Nueva Asuncion', '0', '0');
INSERT INTO cities VALUES ('2914', '166', 'Alto Paraguay', '0', '0');
INSERT INTO cities VALUES ('2915', '166', 'Boqueron', '0', '0');
INSERT INTO cities VALUES ('2916', '173', 'Ad Dawhah', '0', '0');
INSERT INTO cities VALUES ('2917', '173', 'Al Ghuwariyah', '0', '0');
INSERT INTO cities VALUES ('2918', '173', 'Al Jumaliyah', '0', '0');
INSERT INTO cities VALUES ('2919', '173', 'Al Khawr', '0', '0');
INSERT INTO cities VALUES ('2920', '173', 'Al Wakrah Municipality', '0', '0');
INSERT INTO cities VALUES ('2921', '173', 'Ar Rayyan', '0', '0');
INSERT INTO cities VALUES ('2922', '173', 'Madinat ach Shamal', '0', '0');
INSERT INTO cities VALUES ('2923', '173', 'Umm Salal', '0', '0');
INSERT INTO cities VALUES ('2924', '173', 'Al Wakrah', '0', '0');
INSERT INTO cities VALUES ('2925', '173', 'Jariyan al Batnah', '0', '0');
INSERT INTO cities VALUES ('2926', '173', 'Umm Sa\'id', '0', '0');
INSERT INTO cities VALUES ('2927', '175', 'Alba', '0', '0');
INSERT INTO cities VALUES ('2928', '175', 'Arad', '0', '0');
INSERT INTO cities VALUES ('2929', '175', 'Arges', '0', '0');
INSERT INTO cities VALUES ('2930', '175', 'Bacau', '0', '0');
INSERT INTO cities VALUES ('2931', '175', 'Bihor', '0', '0');
INSERT INTO cities VALUES ('2932', '175', 'Bistrita-Nasaud', '0', '0');
INSERT INTO cities VALUES ('2933', '175', 'Botosani', '0', '0');
INSERT INTO cities VALUES ('2934', '175', 'Braila', '0', '0');
INSERT INTO cities VALUES ('2935', '175', 'Brasov', '0', '0');
INSERT INTO cities VALUES ('2936', '175', 'Bucuresti', '0', '0');
INSERT INTO cities VALUES ('2937', '175', 'Buzau', '0', '0');
INSERT INTO cities VALUES ('2938', '175', 'Caras-Severin', '0', '0');
INSERT INTO cities VALUES ('2939', '175', 'Cluj', '0', '0');
INSERT INTO cities VALUES ('2940', '175', 'Constanta', '0', '0');
INSERT INTO cities VALUES ('2941', '175', 'Covasna', '0', '0');
INSERT INTO cities VALUES ('2942', '175', 'Dambovita', '0', '0');
INSERT INTO cities VALUES ('2943', '175', 'Dolj', '0', '0');
INSERT INTO cities VALUES ('2944', '175', 'Galati', '0', '0');
INSERT INTO cities VALUES ('2945', '175', 'Gorj', '0', '0');
INSERT INTO cities VALUES ('2946', '175', 'Harghita', '0', '0');
INSERT INTO cities VALUES ('2947', '175', 'Hunedoara', '0', '0');
INSERT INTO cities VALUES ('2948', '175', 'Ialomita', '0', '0');
INSERT INTO cities VALUES ('2949', '175', 'Iasi', '0', '0');
INSERT INTO cities VALUES ('2950', '175', 'Maramures', '0', '0');
INSERT INTO cities VALUES ('2951', '175', 'Mehedinti', '0', '0');
INSERT INTO cities VALUES ('2952', '175', 'Mures', '0', '0');
INSERT INTO cities VALUES ('2953', '175', 'Neamt', '0', '0');
INSERT INTO cities VALUES ('2954', '175', 'Olt', '0', '0');
INSERT INTO cities VALUES ('2955', '175', 'Prahova', '0', '0');
INSERT INTO cities VALUES ('2956', '175', 'Salaj', '0', '0');
INSERT INTO cities VALUES ('2957', '175', 'Satu Mare', '0', '0');
INSERT INTO cities VALUES ('2958', '175', 'Sibiu', '0', '0');
INSERT INTO cities VALUES ('2959', '175', 'Suceava', '0', '0');
INSERT INTO cities VALUES ('2960', '175', 'Teleorman', '0', '0');
INSERT INTO cities VALUES ('2961', '175', 'Timis', '0', '0');
INSERT INTO cities VALUES ('2962', '175', 'Tulcea', '0', '0');
INSERT INTO cities VALUES ('2963', '175', 'Vaslui', '0', '0');
INSERT INTO cities VALUES ('2964', '175', 'Valcea', '0', '0');
INSERT INTO cities VALUES ('2965', '175', 'Vrancea', '0', '0');
INSERT INTO cities VALUES ('2966', '175', 'Calarasi', '0', '0');
INSERT INTO cities VALUES ('2967', '175', 'Giurgiu', '0', '0');
INSERT INTO cities VALUES ('2968', '175', 'Ilfov', '0', '0');
INSERT INTO cities VALUES ('2969', '245', 'Kosovo', '0', '0');
INSERT INTO cities VALUES ('2970', '245', 'Vojvodina', '0', '0');
INSERT INTO cities VALUES ('2971', '176', 'Adygeya, Republic of', '0', '0');
INSERT INTO cities VALUES ('2972', '176', 'Aginsky Buryatsky AO', '0', '0');
INSERT INTO cities VALUES ('2973', '176', 'Gorno-Altay', '0', '0');
INSERT INTO cities VALUES ('2974', '176', 'Altaisky krai', '0', '0');
INSERT INTO cities VALUES ('2975', '176', 'Amur', '0', '0');
INSERT INTO cities VALUES ('2976', '176', 'Arkhangel\'sk', '0', '0');
INSERT INTO cities VALUES ('2977', '176', 'Astrakhan\'', '0', '0');
INSERT INTO cities VALUES ('2978', '176', 'Bashkortostan', '0', '0');
INSERT INTO cities VALUES ('2979', '176', 'Belgorod', '0', '0');
INSERT INTO cities VALUES ('2980', '176', 'Bryansk', '0', '0');
INSERT INTO cities VALUES ('2981', '176', 'Buryat', '0', '0');
INSERT INTO cities VALUES ('2982', '176', 'Chechnya', '0', '0');
INSERT INTO cities VALUES ('2983', '176', 'Chelyabinsk', '0', '0');
INSERT INTO cities VALUES ('2984', '176', 'Chita', '0', '0');
INSERT INTO cities VALUES ('2985', '176', 'Chukot', '0', '0');
INSERT INTO cities VALUES ('2986', '176', 'Chuvashia', '0', '0');
INSERT INTO cities VALUES ('2987', '176', 'Dagestan', '0', '0');
INSERT INTO cities VALUES ('2988', '176', 'Evenk', '0', '0');
INSERT INTO cities VALUES ('2989', '176', 'Ingush', '0', '0');
INSERT INTO cities VALUES ('2990', '176', 'Irkutsk', '0', '0');
INSERT INTO cities VALUES ('2991', '176', 'Ivanovo', '0', '0');
INSERT INTO cities VALUES ('2992', '176', 'Kabardin-Balkar', '0', '0');
INSERT INTO cities VALUES ('2993', '176', 'Kaliningrad', '0', '0');
INSERT INTO cities VALUES ('2994', '176', 'Kalmyk', '0', '0');
INSERT INTO cities VALUES ('2995', '176', 'Kaluga', '0', '0');
INSERT INTO cities VALUES ('2996', '176', 'Kamchatka', '0', '0');
INSERT INTO cities VALUES ('2997', '176', 'Karachay-Cherkess', '0', '0');
INSERT INTO cities VALUES ('2998', '176', 'Karelia', '0', '0');
INSERT INTO cities VALUES ('2999', '176', 'Kemerovo', '0', '0');
INSERT INTO cities VALUES ('3000', '176', 'Khabarovsk', '0', '0');
INSERT INTO cities VALUES ('3001', '176', 'Khakass', '0', '0');
INSERT INTO cities VALUES ('3002', '176', 'Khanty-Mansiy', '0', '0');
INSERT INTO cities VALUES ('3003', '176', 'Kirov', '0', '0');
INSERT INTO cities VALUES ('3004', '176', 'Komi', '0', '0');
INSERT INTO cities VALUES ('3005', '176', 'Koryak', '0', '0');
INSERT INTO cities VALUES ('3006', '176', 'Kostroma', '0', '0');
INSERT INTO cities VALUES ('3007', '176', 'Krasnodar', '0', '0');
INSERT INTO cities VALUES ('3008', '176', 'Krasnoyarsk', '0', '0');
INSERT INTO cities VALUES ('3009', '176', 'Kurgan', '0', '0');
INSERT INTO cities VALUES ('3010', '176', 'Kursk', '0', '0');
INSERT INTO cities VALUES ('3011', '176', 'Leningrad', '0', '0');
INSERT INTO cities VALUES ('3012', '176', 'Lipetsk', '0', '0');
INSERT INTO cities VALUES ('3013', '176', 'Magadan', '0', '0');
INSERT INTO cities VALUES ('3014', '176', 'Mariy-El', '0', '0');
INSERT INTO cities VALUES ('3015', '176', 'Mordovia', '0', '0');
INSERT INTO cities VALUES ('3016', '176', 'Moskva', '0', '0');
INSERT INTO cities VALUES ('3017', '176', 'Moscow City', '0', '0');
INSERT INTO cities VALUES ('3018', '176', 'Murmansk', '0', '0');
INSERT INTO cities VALUES ('3019', '176', 'Nenets', '0', '0');
INSERT INTO cities VALUES ('3020', '176', 'Nizhegorod', '0', '0');
INSERT INTO cities VALUES ('3021', '176', 'Novgorod', '0', '0');
INSERT INTO cities VALUES ('3022', '176', 'Novosibirsk', '0', '0');
INSERT INTO cities VALUES ('3023', '176', 'Omsk', '0', '0');
INSERT INTO cities VALUES ('3024', '176', 'Orenburg', '0', '0');
INSERT INTO cities VALUES ('3025', '176', 'Orel', '0', '0');
INSERT INTO cities VALUES ('3026', '176', 'Penza', '0', '0');
INSERT INTO cities VALUES ('3027', '176', 'Perm\'', '0', '0');
INSERT INTO cities VALUES ('3028', '176', 'Primor\'ye', '0', '0');
INSERT INTO cities VALUES ('3029', '176', 'Pskov', '0', '0');
INSERT INTO cities VALUES ('3030', '176', 'Rostov', '0', '0');
INSERT INTO cities VALUES ('3031', '176', 'Ryazan\'', '0', '0');
INSERT INTO cities VALUES ('3032', '176', 'Sakha', '0', '0');
INSERT INTO cities VALUES ('3033', '176', 'Sakhalin', '0', '0');
INSERT INTO cities VALUES ('3034', '176', 'Samara', '0', '0');
INSERT INTO cities VALUES ('3035', '176', 'Saint Petersburg City', '0', '0');
INSERT INTO cities VALUES ('3036', '176', 'Saratov', '0', '0');
INSERT INTO cities VALUES ('3037', '176', 'North Ossetia', '0', '0');
INSERT INTO cities VALUES ('3038', '176', 'Smolensk', '0', '0');
INSERT INTO cities VALUES ('3039', '176', 'Stavropol\'', '0', '0');
INSERT INTO cities VALUES ('3040', '176', 'Sverdlovsk', '0', '0');
INSERT INTO cities VALUES ('3041', '176', 'Tambovskaya oblast', '0', '0');
INSERT INTO cities VALUES ('3042', '176', 'Tatarstan', '0', '0');
INSERT INTO cities VALUES ('3043', '176', 'Taymyr', '0', '0');
INSERT INTO cities VALUES ('3044', '176', 'Tomsk', '0', '0');
INSERT INTO cities VALUES ('3045', '176', 'Tula', '0', '0');
INSERT INTO cities VALUES ('3046', '176', 'Tver\'', '0', '0');
INSERT INTO cities VALUES ('3047', '176', 'Tyumen\'', '0', '0');
INSERT INTO cities VALUES ('3048', '176', 'Tuva', '0', '0');
INSERT INTO cities VALUES ('3049', '176', 'Udmurt', '0', '0');
INSERT INTO cities VALUES ('3050', '176', 'Ul\'yanovsk', '0', '0');
INSERT INTO cities VALUES ('3051', '176', 'Vladimir', '0', '0');
INSERT INTO cities VALUES ('3052', '176', 'Volgograd', '0', '0');
INSERT INTO cities VALUES ('3053', '176', 'Vologda', '0', '0');
INSERT INTO cities VALUES ('3054', '176', 'Voronezh', '0', '0');
INSERT INTO cities VALUES ('3055', '176', 'Yamal-Nenets', '0', '0');
INSERT INTO cities VALUES ('3056', '176', 'Yaroslavl\'', '0', '0');
INSERT INTO cities VALUES ('3057', '176', 'Yevrey', '0', '0');
INSERT INTO cities VALUES ('3058', '176', 'Permskiy Kray', '0', '0');
INSERT INTO cities VALUES ('3059', '176', 'Krasnoyarskiy Kray', '0', '0');
INSERT INTO cities VALUES ('3060', '176', 'Kamchatskiy Kray', '0', '0');
INSERT INTO cities VALUES ('3061', '176', 'Zabaykal\'skiy Kray', '0', '0');
INSERT INTO cities VALUES ('3062', '177', 'Butare', '0', '0');
INSERT INTO cities VALUES ('3063', '177', 'Gitarama', '0', '0');
INSERT INTO cities VALUES ('3064', '177', 'Kibungo', '0', '0');
INSERT INTO cities VALUES ('3065', '177', 'Kigali', '0', '0');
INSERT INTO cities VALUES ('3066', '177', 'Est', '0', '0');
INSERT INTO cities VALUES ('3067', '177', 'Kigali', '0', '0');
INSERT INTO cities VALUES ('3068', '177', 'Nord', '0', '0');
INSERT INTO cities VALUES ('3069', '177', 'Ouest', '0', '0');
INSERT INTO cities VALUES ('3070', '177', 'Sud', '0', '0');
INSERT INTO cities VALUES ('3071', '184', 'Al Bahah', '0', '0');
INSERT INTO cities VALUES ('3072', '184', 'Al Madinah', '0', '0');
INSERT INTO cities VALUES ('3073', '184', 'Ash Sharqiyah', '0', '0');
INSERT INTO cities VALUES ('3074', '184', 'Al Qasim', '0', '0');
INSERT INTO cities VALUES ('3075', '184', 'Ar Riyad', '0', '0');
INSERT INTO cities VALUES ('3076', '184', 'Asir Province', '0', '0');
INSERT INTO cities VALUES ('3077', '184', 'Ha\'il', '0', '0');
INSERT INTO cities VALUES ('3078', '184', 'Makkah', '0', '0');
INSERT INTO cities VALUES ('3079', '184', 'Al Hudud ash Shamaliyah', '0', '0');
INSERT INTO cities VALUES ('3080', '184', 'Najran', '0', '0');
INSERT INTO cities VALUES ('3081', '184', 'Jizan', '0', '0');
INSERT INTO cities VALUES ('3082', '184', 'Tabuk', '0', '0');
INSERT INTO cities VALUES ('3083', '184', 'Al Jawf', '0', '0');
INSERT INTO cities VALUES ('3084', '191', 'Malaita', '0', '0');
INSERT INTO cities VALUES ('3085', '191', 'Guadalcanal', '0', '0');
INSERT INTO cities VALUES ('3086', '191', 'Isabel', '0', '0');
INSERT INTO cities VALUES ('3087', '191', 'Makira', '0', '0');
INSERT INTO cities VALUES ('3088', '191', 'Temotu', '0', '0');
INSERT INTO cities VALUES ('3089', '191', 'Central', '0', '0');
INSERT INTO cities VALUES ('3090', '191', 'Western', '0', '0');
INSERT INTO cities VALUES ('3091', '191', 'Choiseul', '0', '0');
INSERT INTO cities VALUES ('3092', '191', 'Rennell and Bellona', '0', '0');
INSERT INTO cities VALUES ('3093', '186', 'Anse aux Pins', '0', '0');
INSERT INTO cities VALUES ('3094', '186', 'Anse Boileau', '0', '0');
INSERT INTO cities VALUES ('3095', '186', 'Anse Etoile', '0', '0');
INSERT INTO cities VALUES ('3096', '186', 'Anse Louis', '0', '0');
INSERT INTO cities VALUES ('3097', '186', 'Anse Royale', '0', '0');
INSERT INTO cities VALUES ('3098', '186', 'Baie Lazare', '0', '0');
INSERT INTO cities VALUES ('3099', '186', 'Baie Sainte Anne', '0', '0');
INSERT INTO cities VALUES ('3100', '186', 'Beau Vallon', '0', '0');
INSERT INTO cities VALUES ('3101', '186', 'Bel Air', '0', '0');
INSERT INTO cities VALUES ('3102', '186', 'Bel Ombre', '0', '0');
INSERT INTO cities VALUES ('3103', '186', 'Cascade', '0', '0');
INSERT INTO cities VALUES ('3104', '186', 'Glacis', '0', '0');
INSERT INTO cities VALUES ('3105', '186', 'Grand\' Anse', '0', '0');
INSERT INTO cities VALUES ('3106', '186', 'Grand\' Anse', '0', '0');
INSERT INTO cities VALUES ('3107', '186', 'La Digue', '0', '0');
INSERT INTO cities VALUES ('3108', '186', 'La Riviere Anglaise', '0', '0');
INSERT INTO cities VALUES ('3109', '186', 'Mont Buxton', '0', '0');
INSERT INTO cities VALUES ('3110', '186', 'Mont Fleuri', '0', '0');
INSERT INTO cities VALUES ('3111', '186', 'Plaisance', '0', '0');
INSERT INTO cities VALUES ('3112', '186', 'Pointe La Rue', '0', '0');
INSERT INTO cities VALUES ('3113', '186', 'Port Glaud', '0', '0');
INSERT INTO cities VALUES ('3114', '186', 'Saint Louis', '0', '0');
INSERT INTO cities VALUES ('3115', '186', 'Takamaka', '0', '0');
INSERT INTO cities VALUES ('3116', '199', 'Al Wusta', '0', '0');
INSERT INTO cities VALUES ('3117', '199', 'Al Istiwa\'iyah', '0', '0');
INSERT INTO cities VALUES ('3118', '199', 'Al Khartum', '0', '0');
INSERT INTO cities VALUES ('3119', '199', 'Ash Shamaliyah', '0', '0');
INSERT INTO cities VALUES ('3120', '199', 'Ash Sharqiyah', '0', '0');
INSERT INTO cities VALUES ('3121', '199', 'Bahr al Ghazal', '0', '0');
INSERT INTO cities VALUES ('3122', '199', 'Darfur', '0', '0');
INSERT INTO cities VALUES ('3123', '199', 'Kurdufan', '0', '0');
INSERT INTO cities VALUES ('3124', '199', 'Upper Nile', '0', '0');
INSERT INTO cities VALUES ('3125', '199', 'Al Wahadah State', '0', '0');
INSERT INTO cities VALUES ('3126', '199', 'Central Equatoria State', '0', '0');
INSERT INTO cities VALUES ('3127', '199', 'Southern Darfur', '0', '0');
INSERT INTO cities VALUES ('3128', '199', 'Southern Kordofan', '0', '0');
INSERT INTO cities VALUES ('3129', '199', 'Kassala', '0', '0');
INSERT INTO cities VALUES ('3130', '199', 'Northern Darfur', '0', '0');
INSERT INTO cities VALUES ('3131', '203', 'Blekinge Lan', '0', '0');
INSERT INTO cities VALUES ('3132', '203', 'Gavleborgs Lan', '0', '0');
INSERT INTO cities VALUES ('3133', '203', 'Gotlands Lan', '0', '0');
INSERT INTO cities VALUES ('3134', '203', 'Hallands Lan', '0', '0');
INSERT INTO cities VALUES ('3135', '203', 'Jamtlands Lan', '0', '0');
INSERT INTO cities VALUES ('3136', '203', 'Jonkopings Lan', '0', '0');
INSERT INTO cities VALUES ('3137', '203', 'Kalmar Lan', '0', '0');
INSERT INTO cities VALUES ('3138', '203', 'Dalarnas Lan', '0', '0');
INSERT INTO cities VALUES ('3139', '203', 'Kronobergs Lan', '0', '0');
INSERT INTO cities VALUES ('3140', '203', 'Norrbottens Lan', '0', '0');
INSERT INTO cities VALUES ('3141', '203', 'Orebro Lan', '0', '0');
INSERT INTO cities VALUES ('3142', '203', 'Ostergotlands Lan', '0', '0');
INSERT INTO cities VALUES ('3143', '203', 'Sodermanlands Lan', '0', '0');
INSERT INTO cities VALUES ('3144', '203', 'Uppsala Lan', '0', '0');
INSERT INTO cities VALUES ('3145', '203', 'Varmlands Lan', '0', '0');
INSERT INTO cities VALUES ('3146', '203', 'Vasterbottens Lan', '0', '0');
INSERT INTO cities VALUES ('3147', '203', 'Vasternorrlands Lan', '0', '0');
INSERT INTO cities VALUES ('3148', '203', 'Vastmanlands Lan', '0', '0');
INSERT INTO cities VALUES ('3149', '203', 'Stockholms Lan', '0', '0');
INSERT INTO cities VALUES ('3150', '203', 'Skane Lan', '0', '0');
INSERT INTO cities VALUES ('3151', '203', 'Vastra Gotaland', '0', '0');
INSERT INTO cities VALUES ('3152', '197', 'Ascension', '0', '0');
INSERT INTO cities VALUES ('3153', '197', 'Saint Helena', '0', '0');
INSERT INTO cities VALUES ('3154', '197', 'Tristan da Cunha', '0', '0');
INSERT INTO cities VALUES ('3155', '190', 'Ajdovscina Commune', '0', '0');
INSERT INTO cities VALUES ('3156', '190', 'Beltinci Commune', '0', '0');
INSERT INTO cities VALUES ('3157', '190', 'Bled Commune', '0', '0');
INSERT INTO cities VALUES ('3158', '190', 'Bohinj Commune', '0', '0');
INSERT INTO cities VALUES ('3159', '190', 'Borovnica Commune', '0', '0');
INSERT INTO cities VALUES ('3160', '190', 'Bovec Commune', '0', '0');
INSERT INTO cities VALUES ('3161', '190', 'Brda Commune', '0', '0');
INSERT INTO cities VALUES ('3162', '190', 'Brezice Commune', '0', '0');
INSERT INTO cities VALUES ('3163', '190', 'Brezovica Commune', '0', '0');
INSERT INTO cities VALUES ('3164', '190', 'Celje Commune', '0', '0');
INSERT INTO cities VALUES ('3165', '190', 'Cerklje na Gorenjskem Commune', '0', '0');
INSERT INTO cities VALUES ('3166', '190', 'Cerknica Commune', '0', '0');
INSERT INTO cities VALUES ('3167', '190', 'Cerkno Commune', '0', '0');
INSERT INTO cities VALUES ('3168', '190', 'Crensovci Commune', '0', '0');
INSERT INTO cities VALUES ('3169', '190', 'Crna na Koroskem Commune', '0', '0');
INSERT INTO cities VALUES ('3170', '190', 'Crnomelj Commune', '0', '0');
INSERT INTO cities VALUES ('3171', '190', 'Divaca Commune', '0', '0');
INSERT INTO cities VALUES ('3172', '190', 'Dobrepolje Commune', '0', '0');
INSERT INTO cities VALUES ('3173', '190', 'Dol pri Ljubljani Commune', '0', '0');
INSERT INTO cities VALUES ('3174', '190', 'Dornava Commune', '0', '0');
INSERT INTO cities VALUES ('3175', '190', 'Dravograd Commune', '0', '0');
INSERT INTO cities VALUES ('3176', '190', 'Duplek Commune', '0', '0');
INSERT INTO cities VALUES ('3177', '190', 'Gorenja vas-Poljane Commune', '0', '0');
INSERT INTO cities VALUES ('3178', '190', 'Gorisnica Commune', '0', '0');
INSERT INTO cities VALUES ('3179', '190', 'Gornja Radgona Commune', '0', '0');
INSERT INTO cities VALUES ('3180', '190', 'Gornji Grad Commune', '0', '0');
INSERT INTO cities VALUES ('3181', '190', 'Gornji Petrovci Commune', '0', '0');
INSERT INTO cities VALUES ('3182', '190', 'Grosuplje Commune', '0', '0');
INSERT INTO cities VALUES ('3183', '190', 'Hrastnik Commune', '0', '0');
INSERT INTO cities VALUES ('3184', '190', 'Hrpelje-Kozina Commune', '0', '0');
INSERT INTO cities VALUES ('3185', '190', 'Idrija Commune', '0', '0');
INSERT INTO cities VALUES ('3186', '190', 'Ig Commune', '0', '0');
INSERT INTO cities VALUES ('3187', '190', 'Ilirska Bistrica Commune', '0', '0');
INSERT INTO cities VALUES ('3188', '190', 'Ivancna Gorica Commune', '0', '0');
INSERT INTO cities VALUES ('3189', '190', 'Izola-Isola Commune', '0', '0');
INSERT INTO cities VALUES ('3190', '190', 'Jursinci Commune', '0', '0');
INSERT INTO cities VALUES ('3191', '190', 'Kanal Commune', '0', '0');
INSERT INTO cities VALUES ('3192', '190', 'Kidricevo Commune', '0', '0');
INSERT INTO cities VALUES ('3193', '190', 'Kobarid Commune', '0', '0');
INSERT INTO cities VALUES ('3194', '190', 'Kobilje Commune', '0', '0');
INSERT INTO cities VALUES ('3195', '190', 'Komen Commune', '0', '0');
INSERT INTO cities VALUES ('3196', '190', 'Koper-Capodistria Urban Commune', '0', '0');
INSERT INTO cities VALUES ('3197', '190', 'Kozje Commune', '0', '0');
INSERT INTO cities VALUES ('3198', '190', 'Kranj Commune', '0', '0');
INSERT INTO cities VALUES ('3199', '190', 'Kranjska Gora Commune', '0', '0');
INSERT INTO cities VALUES ('3200', '190', 'Krsko Commune', '0', '0');
INSERT INTO cities VALUES ('3201', '190', 'Kungota Commune', '0', '0');
INSERT INTO cities VALUES ('3202', '190', 'Lasko Commune', '0', '0');
INSERT INTO cities VALUES ('3203', '190', 'Ljubljana Urban Commune', '0', '0');
INSERT INTO cities VALUES ('3204', '190', 'Ljubno Commune', '0', '0');
INSERT INTO cities VALUES ('3205', '190', 'Logatec Commune', '0', '0');
INSERT INTO cities VALUES ('3206', '190', 'Loski Potok Commune', '0', '0');
INSERT INTO cities VALUES ('3207', '190', 'Lukovica Commune', '0', '0');
INSERT INTO cities VALUES ('3208', '190', 'Medvode Commune', '0', '0');
INSERT INTO cities VALUES ('3209', '190', 'Menges Commune', '0', '0');
INSERT INTO cities VALUES ('3210', '190', 'Metlika Commune', '0', '0');
INSERT INTO cities VALUES ('3211', '190', 'Mezica Commune', '0', '0');
INSERT INTO cities VALUES ('3212', '190', 'Mislinja Commune', '0', '0');
INSERT INTO cities VALUES ('3213', '190', 'Moravce Commune', '0', '0');
INSERT INTO cities VALUES ('3214', '190', 'Moravske Toplice Commune', '0', '0');
INSERT INTO cities VALUES ('3215', '190', 'Mozirje Commune', '0', '0');
INSERT INTO cities VALUES ('3216', '190', 'Murska Sobota Urban Commune', '0', '0');
INSERT INTO cities VALUES ('3217', '190', 'Muta Commune', '0', '0');
INSERT INTO cities VALUES ('3218', '190', 'Naklo Commune', '0', '0');
INSERT INTO cities VALUES ('3219', '190', 'Nazarje Commune', '0', '0');
INSERT INTO cities VALUES ('3220', '190', 'Nova Gorica Urban Commune', '0', '0');
INSERT INTO cities VALUES ('3221', '190', 'Odranci Commune', '0', '0');
INSERT INTO cities VALUES ('3222', '190', 'Ormoz Commune', '0', '0');
INSERT INTO cities VALUES ('3223', '190', 'Osilnica Commune', '0', '0');
INSERT INTO cities VALUES ('3224', '190', 'Pesnica Commune', '0', '0');
INSERT INTO cities VALUES ('3225', '190', 'Pivka Commune', '0', '0');
INSERT INTO cities VALUES ('3226', '190', 'Podcetrtek Commune', '0', '0');
INSERT INTO cities VALUES ('3227', '190', 'Postojna Commune', '0', '0');
INSERT INTO cities VALUES ('3228', '190', 'Puconci Commune', '0', '0');
INSERT INTO cities VALUES ('3229', '190', 'Race-Fram Commune', '0', '0');
INSERT INTO cities VALUES ('3230', '190', 'Radece Commune', '0', '0');
INSERT INTO cities VALUES ('3231', '190', 'Radenci Commune', '0', '0');
INSERT INTO cities VALUES ('3232', '190', 'Radlje ob Dravi Commune', '0', '0');
INSERT INTO cities VALUES ('3233', '190', 'Radovljica Commune', '0', '0');
INSERT INTO cities VALUES ('3234', '190', 'Rogasovci Commune', '0', '0');
INSERT INTO cities VALUES ('3235', '190', 'Rogaska Slatina Commune', '0', '0');
INSERT INTO cities VALUES ('3236', '190', 'Rogatec Commune', '0', '0');
INSERT INTO cities VALUES ('3237', '190', 'Semic Commune', '0', '0');
INSERT INTO cities VALUES ('3238', '190', 'Sencur Commune', '0', '0');
INSERT INTO cities VALUES ('3239', '190', 'Sentilj Commune', '0', '0');
INSERT INTO cities VALUES ('3240', '190', 'Sentjernej Commune', '0', '0');
INSERT INTO cities VALUES ('3241', '190', 'Sevnica Commune', '0', '0');
INSERT INTO cities VALUES ('3242', '190', 'Sezana Commune', '0', '0');
INSERT INTO cities VALUES ('3243', '190', 'Skocjan Commune', '0', '0');
INSERT INTO cities VALUES ('3244', '190', 'Skofja Loka Commune', '0', '0');
INSERT INTO cities VALUES ('3245', '190', 'Skofljica Commune', '0', '0');
INSERT INTO cities VALUES ('3246', '190', 'Slovenj Gradec Urban Commune', '0', '0');
INSERT INTO cities VALUES ('3247', '190', 'Slovenske Konjice Commune', '0', '0');
INSERT INTO cities VALUES ('3248', '190', 'Smarje pri Jelsah Commune', '0', '0');
INSERT INTO cities VALUES ('3249', '190', 'Smartno ob Paki Commune', '0', '0');
INSERT INTO cities VALUES ('3250', '190', 'Sostanj Commune', '0', '0');
INSERT INTO cities VALUES ('3251', '190', 'Starse Commune', '0', '0');
INSERT INTO cities VALUES ('3252', '190', 'Store Commune', '0', '0');
INSERT INTO cities VALUES ('3253', '190', 'Sveti Jurij Commune', '0', '0');
INSERT INTO cities VALUES ('3254', '190', 'Tolmin Commune', '0', '0');
INSERT INTO cities VALUES ('3255', '190', 'Trbovlje Commune', '0', '0');
INSERT INTO cities VALUES ('3256', '190', 'Trebnje Commune', '0', '0');
INSERT INTO cities VALUES ('3257', '190', 'Trzic Commune', '0', '0');
INSERT INTO cities VALUES ('3258', '190', 'Turnisce Commune', '0', '0');
INSERT INTO cities VALUES ('3259', '190', 'Velenje Urban Commune', '0', '0');
INSERT INTO cities VALUES ('3260', '190', 'Velike Lasce Commune', '0', '0');
INSERT INTO cities VALUES ('3261', '190', 'Vipava Commune', '0', '0');
INSERT INTO cities VALUES ('3262', '190', 'Vitanje Commune', '0', '0');
INSERT INTO cities VALUES ('3263', '190', 'Vodice Commune', '0', '0');
INSERT INTO cities VALUES ('3264', '190', 'Vrhnika Commune', '0', '0');
INSERT INTO cities VALUES ('3265', '190', 'Vuzenica Commune', '0', '0');
INSERT INTO cities VALUES ('3266', '190', 'Zagorje ob Savi Commune', '0', '0');
INSERT INTO cities VALUES ('3267', '190', 'Zavrc Commune', '0', '0');
INSERT INTO cities VALUES ('3268', '190', 'Zelezniki Commune', '0', '0');
INSERT INTO cities VALUES ('3269', '190', 'Ziri Commune', '0', '0');
INSERT INTO cities VALUES ('3270', '190', 'Zrece Commune', '0', '0');
INSERT INTO cities VALUES ('3271', '190', 'Benedikt Commune', '0', '0');
INSERT INTO cities VALUES ('3272', '190', 'Bistrica ob Sotli Commune', '0', '0');
INSERT INTO cities VALUES ('3273', '190', 'Bloke Commune', '0', '0');
INSERT INTO cities VALUES ('3274', '190', 'Braslovce Commune', '0', '0');
INSERT INTO cities VALUES ('3275', '190', 'Cankova Commune', '0', '0');
INSERT INTO cities VALUES ('3276', '190', 'Cerkvenjak Commune', '0', '0');
INSERT INTO cities VALUES ('3277', '190', 'Destrnik Commune', '0', '0');
INSERT INTO cities VALUES ('3278', '190', 'Dobje Commune', '0', '0');
INSERT INTO cities VALUES ('3279', '190', 'Dobrna Commune', '0', '0');
INSERT INTO cities VALUES ('3280', '190', 'Dobrova-Horjul-Polhov Gradec Commune', '0', '0');
INSERT INTO cities VALUES ('3281', '190', 'Dobrovnik-Dobronak Commune', '0', '0');
INSERT INTO cities VALUES ('3282', '190', 'Dolenjske Toplice Commune', '0', '0');
INSERT INTO cities VALUES ('3283', '190', 'Domzale Commune', '0', '0');
INSERT INTO cities VALUES ('3284', '190', 'Grad Commune', '0', '0');
INSERT INTO cities VALUES ('3285', '190', 'Hajdina Commune', '0', '0');
INSERT INTO cities VALUES ('3286', '190', 'Hoce-Slivnica Commune', '0', '0');
INSERT INTO cities VALUES ('3287', '190', 'Hodos-Hodos Commune', '0', '0');
INSERT INTO cities VALUES ('3288', '190', 'Horjul Commune', '0', '0');
INSERT INTO cities VALUES ('3289', '190', 'Jesenice Commune', '0', '0');
INSERT INTO cities VALUES ('3290', '190', 'Jezersko Commune', '0', '0');
INSERT INTO cities VALUES ('3291', '190', 'Kamnik Commune', '0', '0');
INSERT INTO cities VALUES ('3292', '190', 'Kocevje Commune', '0', '0');
INSERT INTO cities VALUES ('3293', '190', 'Komenda Commune', '0', '0');
INSERT INTO cities VALUES ('3294', '190', 'Kostel Commune', '0', '0');
INSERT INTO cities VALUES ('3295', '190', 'Krizevci Commune', '0', '0');
INSERT INTO cities VALUES ('3296', '190', 'Kuzma Commune', '0', '0');
INSERT INTO cities VALUES ('3297', '190', 'Lenart Commune', '0', '0');
INSERT INTO cities VALUES ('3298', '190', 'Lendava-Lendva Commune', '0', '0');
INSERT INTO cities VALUES ('3299', '190', 'Litija Commune', '0', '0');
INSERT INTO cities VALUES ('3300', '190', 'Ljutomer Commune', '0', '0');
INSERT INTO cities VALUES ('3301', '190', 'Loska Dolina Commune', '0', '0');
INSERT INTO cities VALUES ('3302', '190', 'Lovrenc na Pohorju Commune', '0', '0');
INSERT INTO cities VALUES ('3303', '190', 'Luce Commune', '0', '0');
INSERT INTO cities VALUES ('3304', '190', 'Majsperk Commune', '0', '0');
INSERT INTO cities VALUES ('3305', '190', 'Maribor Commune', '0', '0');
INSERT INTO cities VALUES ('3306', '190', 'Markovci Commune', '0', '0');
INSERT INTO cities VALUES ('3307', '190', 'Miklavz na Dravskem polju Commune', '0', '0');
INSERT INTO cities VALUES ('3308', '190', 'Miren-Kostanjevica Commune', '0', '0');
INSERT INTO cities VALUES ('3309', '190', 'Mirna Pec Commune', '0', '0');
INSERT INTO cities VALUES ('3310', '190', 'Novo mesto Urban Commune', '0', '0');
INSERT INTO cities VALUES ('3311', '190', 'Oplotnica Commune', '0', '0');
INSERT INTO cities VALUES ('3312', '190', 'Piran-Pirano Commune', '0', '0');
INSERT INTO cities VALUES ('3313', '190', 'Podlehnik Commune', '0', '0');
INSERT INTO cities VALUES ('3314', '190', 'Podvelka Commune', '0', '0');
INSERT INTO cities VALUES ('3315', '190', 'Polzela Commune', '0', '0');
INSERT INTO cities VALUES ('3316', '190', 'Prebold Commune', '0', '0');
INSERT INTO cities VALUES ('3317', '190', 'Preddvor Commune', '0', '0');
INSERT INTO cities VALUES ('3318', '190', 'Prevalje Commune', '0', '0');
INSERT INTO cities VALUES ('3319', '190', 'Ptuj Urban Commune', '0', '0');
INSERT INTO cities VALUES ('3320', '190', 'Ravne na Koroskem Commune', '0', '0');
INSERT INTO cities VALUES ('3321', '190', 'Razkrizje Commune', '0', '0');
INSERT INTO cities VALUES ('3322', '190', 'Ribnica Commune', '0', '0');
INSERT INTO cities VALUES ('3323', '190', 'Ribnica na Pohorju Commune', '0', '0');
INSERT INTO cities VALUES ('3324', '190', 'Ruse Commune', '0', '0');
INSERT INTO cities VALUES ('3325', '190', 'Salovci Commune', '0', '0');
INSERT INTO cities VALUES ('3326', '190', 'Selnica ob Dravi Commune', '0', '0');
INSERT INTO cities VALUES ('3327', '190', 'Sempeter-Vrtojba Commune', '0', '0');
INSERT INTO cities VALUES ('3328', '190', 'Sentjur pri Celju Commune', '0', '0');
INSERT INTO cities VALUES ('3329', '190', 'Slovenska Bistrica Commune', '0', '0');
INSERT INTO cities VALUES ('3330', '190', 'Smartno pri Litiji Commune', '0', '0');
INSERT INTO cities VALUES ('3331', '190', 'Sodrazica Commune', '0', '0');
INSERT INTO cities VALUES ('3332', '190', 'Solcava Commune', '0', '0');
INSERT INTO cities VALUES ('3333', '190', 'Sveta Ana Commune', '0', '0');
INSERT INTO cities VALUES ('3334', '190', 'Sveti Andraz v Slovenskih goricah Commune', '0', '0');
INSERT INTO cities VALUES ('3335', '190', 'Tabor Commune', '0', '0');
INSERT INTO cities VALUES ('3336', '190', 'Tisina Commune', '0', '0');
INSERT INTO cities VALUES ('3337', '190', 'Trnovska vas Commune', '0', '0');
INSERT INTO cities VALUES ('3338', '190', 'Trzin Commune', '0', '0');
INSERT INTO cities VALUES ('3339', '190', 'Velika Polana Commune', '0', '0');
INSERT INTO cities VALUES ('3340', '190', 'Verzej Commune', '0', '0');
INSERT INTO cities VALUES ('3341', '190', 'Videm Commune', '0', '0');
INSERT INTO cities VALUES ('3342', '190', 'Vojnik Commune', '0', '0');
INSERT INTO cities VALUES ('3343', '190', 'Vransko Commune', '0', '0');
INSERT INTO cities VALUES ('3344', '190', 'Zalec Commune', '0', '0');
INSERT INTO cities VALUES ('3345', '190', 'Zetale Commune', '0', '0');
INSERT INTO cities VALUES ('3346', '190', 'Zirovnica Commune', '0', '0');
INSERT INTO cities VALUES ('3347', '190', 'Zuzemberk Commune', '0', '0');
INSERT INTO cities VALUES ('3348', '190', 'Apace Commune', '0', '0');
INSERT INTO cities VALUES ('3349', '190', 'Cirkulane Commune', '0', '0');
INSERT INTO cities VALUES ('3350', '189', 'Banska Bystrica', '0', '0');
INSERT INTO cities VALUES ('3351', '189', 'Bratislava', '0', '0');
INSERT INTO cities VALUES ('3352', '189', 'Kosice', '0', '0');
INSERT INTO cities VALUES ('3353', '189', 'Nitra', '0', '0');
INSERT INTO cities VALUES ('3354', '189', 'Presov', '0', '0');
INSERT INTO cities VALUES ('3355', '189', 'Trencin', '0', '0');
INSERT INTO cities VALUES ('3356', '189', 'Trnava', '0', '0');
INSERT INTO cities VALUES ('3357', '189', 'Zilina', '0', '0');
INSERT INTO cities VALUES ('3358', '187', 'Eastern', '0', '0');
INSERT INTO cities VALUES ('3359', '187', 'Northern', '0', '0');
INSERT INTO cities VALUES ('3360', '187', 'Southern', '0', '0');
INSERT INTO cities VALUES ('3361', '187', 'Western Area', '0', '0');
INSERT INTO cities VALUES ('3362', '182', 'Acquaviva', '0', '0');
INSERT INTO cities VALUES ('3363', '182', 'Chiesanuova', '0', '0');
INSERT INTO cities VALUES ('3364', '182', 'Domagnano', '0', '0');
INSERT INTO cities VALUES ('3365', '182', 'Faetano', '0', '0');
INSERT INTO cities VALUES ('3366', '182', 'Fiorentino', '0', '0');
INSERT INTO cities VALUES ('3367', '182', 'Borgo Maggiore', '0', '0');
INSERT INTO cities VALUES ('3368', '182', 'San Marino', '0', '0');
INSERT INTO cities VALUES ('3369', '182', 'Monte Giardino', '0', '0');
INSERT INTO cities VALUES ('3370', '182', 'Serravalle', '0', '0');
INSERT INTO cities VALUES ('3371', '185', 'Dakar', '0', '0');
INSERT INTO cities VALUES ('3372', '185', 'Diourbel', '0', '0');
INSERT INTO cities VALUES ('3373', '185', 'Tambacounda', '0', '0');
INSERT INTO cities VALUES ('3374', '185', 'Thies', '0', '0');
INSERT INTO cities VALUES ('3375', '185', 'Fatick', '0', '0');
INSERT INTO cities VALUES ('3376', '185', 'Kaolack', '0', '0');
INSERT INTO cities VALUES ('3377', '185', 'Kolda', '0', '0');
INSERT INTO cities VALUES ('3378', '185', 'Ziguinchor', '0', '0');
INSERT INTO cities VALUES ('3379', '185', 'Louga', '0', '0');
INSERT INTO cities VALUES ('3380', '185', 'Saint-Louis', '0', '0');
INSERT INTO cities VALUES ('3381', '185', 'Matam', '0', '0');
INSERT INTO cities VALUES ('3382', '192', 'Bakool', '0', '0');
INSERT INTO cities VALUES ('3383', '192', 'Banaadir', '0', '0');
INSERT INTO cities VALUES ('3384', '192', 'Bari', '0', '0');
INSERT INTO cities VALUES ('3385', '192', 'Bay', '0', '0');
INSERT INTO cities VALUES ('3386', '192', 'Galguduud', '0', '0');
INSERT INTO cities VALUES ('3387', '192', 'Gedo', '0', '0');
INSERT INTO cities VALUES ('3388', '192', 'Hiiraan', '0', '0');
INSERT INTO cities VALUES ('3389', '192', 'Jubbada Dhexe', '0', '0');
INSERT INTO cities VALUES ('3390', '192', 'Jubbada Hoose', '0', '0');
INSERT INTO cities VALUES ('3391', '192', 'Mudug', '0', '0');
INSERT INTO cities VALUES ('3392', '192', 'Nugaal', '0', '0');
INSERT INTO cities VALUES ('3393', '192', 'Sanaag', '0', '0');
INSERT INTO cities VALUES ('3394', '192', 'Shabeellaha Dhexe', '0', '0');
INSERT INTO cities VALUES ('3395', '192', 'Shabeellaha Hoose', '0', '0');
INSERT INTO cities VALUES ('3396', '192', 'Woqooyi Galbeed', '0', '0');
INSERT INTO cities VALUES ('3397', '192', 'Nugaal', '0', '0');
INSERT INTO cities VALUES ('3398', '192', 'Togdheer', '0', '0');
INSERT INTO cities VALUES ('3399', '192', 'Woqooyi Galbeed', '0', '0');
INSERT INTO cities VALUES ('3400', '192', 'Awdal', '0', '0');
INSERT INTO cities VALUES ('3401', '192', 'Sool', '0', '0');
INSERT INTO cities VALUES ('3402', '200', 'Brokopondo', '0', '0');
INSERT INTO cities VALUES ('3403', '200', 'Commewijne', '0', '0');
INSERT INTO cities VALUES ('3404', '200', 'Coronie', '0', '0');
INSERT INTO cities VALUES ('3405', '200', 'Marowijne', '0', '0');
INSERT INTO cities VALUES ('3406', '200', 'Nickerie', '0', '0');
INSERT INTO cities VALUES ('3407', '200', 'Para', '0', '0');
INSERT INTO cities VALUES ('3408', '200', 'Paramaribo', '0', '0');
INSERT INTO cities VALUES ('3409', '200', 'Saramacca', '0', '0');
INSERT INTO cities VALUES ('3410', '200', 'Sipaliwini', '0', '0');
INSERT INTO cities VALUES ('3411', '200', 'Wanica', '0', '0');
INSERT INTO cities VALUES ('3422', '183', 'Principe', '0', '0');
INSERT INTO cities VALUES ('3423', '183', 'Sao Tome', '0', '0');
INSERT INTO cities VALUES ('3424', '64', 'Ahuachapan', '0', '0');
INSERT INTO cities VALUES ('3425', '64', 'Cabanas', '0', '0');
INSERT INTO cities VALUES ('3426', '64', 'Chalatenango', '0', '0');
INSERT INTO cities VALUES ('3427', '64', 'Cuscatlan', '0', '0');
INSERT INTO cities VALUES ('3428', '64', 'La Libertad', '0', '0');
INSERT INTO cities VALUES ('3429', '64', 'La Paz', '0', '0');
INSERT INTO cities VALUES ('3430', '64', 'La Union', '0', '0');
INSERT INTO cities VALUES ('3431', '64', 'Morazan', '0', '0');
INSERT INTO cities VALUES ('3432', '64', 'San Miguel', '0', '0');
INSERT INTO cities VALUES ('3433', '64', 'San Salvador', '0', '0');
INSERT INTO cities VALUES ('3434', '64', 'Santa Ana', '0', '0');
INSERT INTO cities VALUES ('3435', '64', 'San Vicente', '0', '0');
INSERT INTO cities VALUES ('3436', '64', 'Sonsonate', '0', '0');
INSERT INTO cities VALUES ('3437', '64', 'Usulutan', '0', '0');
INSERT INTO cities VALUES ('3438', '205', 'Al Hasakah', '0', '0');
INSERT INTO cities VALUES ('3439', '205', 'Al Ladhiqiyah', '0', '0');
INSERT INTO cities VALUES ('3440', '205', 'Al Qunaytirah', '0', '0');
INSERT INTO cities VALUES ('3441', '205', 'Ar Raqqah', '0', '0');
INSERT INTO cities VALUES ('3442', '205', 'As Suwayda\'', '0', '0');
INSERT INTO cities VALUES ('3443', '205', 'Dar', '0', '0');
INSERT INTO cities VALUES ('3444', '205', 'Dayr az Zawr', '0', '0');
INSERT INTO cities VALUES ('3445', '205', 'Rif Dimashq', '0', '0');
INSERT INTO cities VALUES ('3446', '205', 'Halab', '0', '0');
INSERT INTO cities VALUES ('3447', '205', 'Hamah', '0', '0');
INSERT INTO cities VALUES ('3448', '205', 'Hims', '0', '0');
INSERT INTO cities VALUES ('3449', '205', 'Idlib', '0', '0');
INSERT INTO cities VALUES ('3450', '205', 'Dimashq', '0', '0');
INSERT INTO cities VALUES ('3451', '205', 'Tartus', '0', '0');
INSERT INTO cities VALUES ('3452', '202', 'Hhohho', '0', '0');
INSERT INTO cities VALUES ('3453', '202', 'Lubombo', '0', '0');
INSERT INTO cities VALUES ('3454', '202', 'Manzini', '0', '0');
INSERT INTO cities VALUES ('3455', '202', 'Shiselweni', '0', '0');
INSERT INTO cities VALUES ('3456', '202', 'Praslin', '0', '0');
INSERT INTO cities VALUES ('3457', '42', 'Batha', '0', '0');
INSERT INTO cities VALUES ('3458', '42', 'Biltine', '0', '0');
INSERT INTO cities VALUES ('3459', '42', 'Borkou-Ennedi-Tibesti', '0', '0');
INSERT INTO cities VALUES ('3460', '42', 'Chari-Baguirmi', '0', '0');
INSERT INTO cities VALUES ('3461', '42', 'Guera', '0', '0');
INSERT INTO cities VALUES ('3462', '42', 'Kanem', '0', '0');
INSERT INTO cities VALUES ('3463', '42', 'Lac', '0', '0');
INSERT INTO cities VALUES ('3464', '42', 'Logone Occidental', '0', '0');
INSERT INTO cities VALUES ('3465', '42', 'Logone Oriental', '0', '0');
INSERT INTO cities VALUES ('3466', '42', 'Mayo-Kebbi', '0', '0');
INSERT INTO cities VALUES ('3467', '42', 'Moyen-Chari', '0', '0');
INSERT INTO cities VALUES ('3468', '42', 'Ouaddai', '0', '0');
INSERT INTO cities VALUES ('3469', '42', 'Salamat', '0', '0');
INSERT INTO cities VALUES ('3470', '42', 'Tandjile', '0', '0');
INSERT INTO cities VALUES ('3471', '210', 'Centrale', '0', '0');
INSERT INTO cities VALUES ('3472', '210', 'Kara', '0', '0');
INSERT INTO cities VALUES ('3473', '210', 'Maritime', '0', '0');
INSERT INTO cities VALUES ('3474', '210', 'Plateaux', '0', '0');
INSERT INTO cities VALUES ('3475', '210', 'Savanes', '0', '0');
INSERT INTO cities VALUES ('3476', '209', 'Mae Hong Son', '0', '0');
INSERT INTO cities VALUES ('3477', '209', 'Chiang Mai', '0', '0');
INSERT INTO cities VALUES ('3478', '209', 'Chiang Rai', '0', '0');
INSERT INTO cities VALUES ('3479', '209', 'Nan', '0', '0');
INSERT INTO cities VALUES ('3480', '209', 'Lamphun', '0', '0');
INSERT INTO cities VALUES ('3481', '209', 'Lampang', '0', '0');
INSERT INTO cities VALUES ('3482', '209', 'Phrae', '0', '0');
INSERT INTO cities VALUES ('3483', '209', 'Tak', '0', '0');
INSERT INTO cities VALUES ('3484', '209', 'Sukhothai', '0', '0');
INSERT INTO cities VALUES ('3485', '209', 'Uttaradit', '0', '0');
INSERT INTO cities VALUES ('3486', '209', 'Kamphaeng Phet', '0', '0');
INSERT INTO cities VALUES ('3487', '209', 'Phitsanulok', '0', '0');
INSERT INTO cities VALUES ('3488', '209', 'Phichit', '0', '0');
INSERT INTO cities VALUES ('3489', '209', 'Phetchabun', '0', '0');
INSERT INTO cities VALUES ('3490', '209', 'Uthai Thani', '0', '0');
INSERT INTO cities VALUES ('3491', '209', 'Nakhon Sawan', '0', '0');
INSERT INTO cities VALUES ('3492', '209', 'Nong Khai', '0', '0');
INSERT INTO cities VALUES ('3493', '209', 'Loei', '0', '0');
INSERT INTO cities VALUES ('3494', '209', 'Sakon Nakhon', '0', '0');
INSERT INTO cities VALUES ('3495', '209', 'Nakhon Phanom', '0', '0');
INSERT INTO cities VALUES ('3496', '209', 'Khon Kaen', '0', '0');
INSERT INTO cities VALUES ('3497', '209', 'Kalasin', '0', '0');
INSERT INTO cities VALUES ('3498', '209', 'Maha Sarakham', '0', '0');
INSERT INTO cities VALUES ('3499', '209', 'Roi Et', '0', '0');
INSERT INTO cities VALUES ('3500', '209', 'Chaiyaphum', '0', '0');
INSERT INTO cities VALUES ('3501', '209', 'Nakhon Ratchasima', '0', '0');
INSERT INTO cities VALUES ('3502', '209', 'Buriram', '0', '0');
INSERT INTO cities VALUES ('3503', '209', 'Surin', '0', '0');
INSERT INTO cities VALUES ('3504', '209', 'Sisaket', '0', '0');
INSERT INTO cities VALUES ('3505', '209', 'Narathiwat', '0', '0');
INSERT INTO cities VALUES ('3506', '209', 'Chai Nat', '0', '0');
INSERT INTO cities VALUES ('3507', '209', 'Sing Buri', '0', '0');
INSERT INTO cities VALUES ('3508', '209', 'Lop Buri', '0', '0');
INSERT INTO cities VALUES ('3509', '209', 'Ang Thong', '0', '0');
INSERT INTO cities VALUES ('3510', '209', 'Phra Nakhon Si Ayutthaya', '0', '0');
INSERT INTO cities VALUES ('3511', '209', 'Saraburi', '0', '0');
INSERT INTO cities VALUES ('3512', '209', 'Nonthaburi', '0', '0');
INSERT INTO cities VALUES ('3513', '209', 'Pathum Thani', '0', '0');
INSERT INTO cities VALUES ('3514', '209', 'Krung Thep', '0', '0');
INSERT INTO cities VALUES ('3515', '209', 'Phayao', '0', '0');
INSERT INTO cities VALUES ('3516', '209', 'Samut Prakan', '0', '0');
INSERT INTO cities VALUES ('3517', '209', 'Nakhon Nayok', '0', '0');
INSERT INTO cities VALUES ('3518', '209', 'Chachoengsao', '0', '0');
INSERT INTO cities VALUES ('3519', '209', 'Prachin Buri', '0', '0');
INSERT INTO cities VALUES ('3520', '209', 'Chon Buri', '0', '0');
INSERT INTO cities VALUES ('3521', '209', 'Rayong', '0', '0');
INSERT INTO cities VALUES ('3522', '209', 'Chanthaburi', '0', '0');
INSERT INTO cities VALUES ('3523', '209', 'Trat', '0', '0');
INSERT INTO cities VALUES ('3524', '209', 'Kanchanaburi', '0', '0');
INSERT INTO cities VALUES ('3525', '209', 'Suphan Buri', '0', '0');
INSERT INTO cities VALUES ('3526', '209', 'Ratchaburi', '0', '0');
INSERT INTO cities VALUES ('3527', '209', 'Nakhon Pathom', '0', '0');
INSERT INTO cities VALUES ('3528', '209', 'Samut Songkhram', '0', '0');
INSERT INTO cities VALUES ('3529', '209', 'Samut Sakhon', '0', '0');
INSERT INTO cities VALUES ('3530', '209', 'Phetchaburi', '0', '0');
INSERT INTO cities VALUES ('3531', '209', 'Prachuap Khiri Khan', '0', '0');
INSERT INTO cities VALUES ('3532', '209', 'Chumphon', '0', '0');
INSERT INTO cities VALUES ('3533', '209', 'Ranong', '0', '0');
INSERT INTO cities VALUES ('3534', '209', 'Surat Thani', '0', '0');
INSERT INTO cities VALUES ('3535', '209', 'Phangnga', '0', '0');
INSERT INTO cities VALUES ('3536', '209', 'Phuket', '0', '0');
INSERT INTO cities VALUES ('3537', '209', 'Krabi', '0', '0');
INSERT INTO cities VALUES ('3538', '209', 'Nakhon Si Thammarat', '0', '0');
INSERT INTO cities VALUES ('3539', '209', 'Trang', '0', '0');
INSERT INTO cities VALUES ('3540', '209', 'Phatthalung', '0', '0');
INSERT INTO cities VALUES ('3541', '209', 'Satun', '0', '0');
INSERT INTO cities VALUES ('3542', '209', 'Songkhla', '0', '0');
INSERT INTO cities VALUES ('3543', '209', 'Pattani', '0', '0');
INSERT INTO cities VALUES ('3544', '209', 'Yala', '0', '0');
INSERT INTO cities VALUES ('3545', '209', 'Ubon Ratchathani', '0', '0');
INSERT INTO cities VALUES ('3546', '209', 'Yasothon', '0', '0');
INSERT INTO cities VALUES ('3547', '209', 'Nakhon Phanom', '0', '0');
INSERT INTO cities VALUES ('3548', '209', 'Prachin Buri', '0', '0');
INSERT INTO cities VALUES ('3549', '209', 'Ubon Ratchathani', '0', '0');
INSERT INTO cities VALUES ('3550', '209', 'Udon Thani', '0', '0');
INSERT INTO cities VALUES ('3551', '209', 'Amnat Charoen', '0', '0');
INSERT INTO cities VALUES ('3552', '209', 'Mukdahan', '0', '0');
INSERT INTO cities VALUES ('3553', '209', 'Nong Bua Lamphu', '0', '0');
INSERT INTO cities VALUES ('3554', '209', 'Sa Kaeo', '0', '0');
INSERT INTO cities VALUES ('3555', '209', 'Bueng Kan', '0', '0');
INSERT INTO cities VALUES ('3556', '207', 'Kuhistoni Badakhshon', '0', '0');
INSERT INTO cities VALUES ('3557', '207', 'Khatlon', '0', '0');
INSERT INTO cities VALUES ('3558', '207', 'Sughd', '0', '0');
INSERT INTO cities VALUES ('3560', '216', 'Ahal', '0', '0');
INSERT INTO cities VALUES ('3561', '216', 'Balkan', '0', '0');
INSERT INTO cities VALUES ('3562', '216', 'Dashoguz', '0', '0');
INSERT INTO cities VALUES ('3563', '216', 'Lebap', '0', '0');
INSERT INTO cities VALUES ('3564', '216', 'Mary', '0', '0');
INSERT INTO cities VALUES ('3565', '214', 'Kasserine', '0', '0');
INSERT INTO cities VALUES ('3566', '214', 'Kairouan', '0', '0');
INSERT INTO cities VALUES ('3567', '214', 'Jendouba', '0', '0');
INSERT INTO cities VALUES ('3568', '214', 'Qafsah', '0', '0');
INSERT INTO cities VALUES ('3569', '214', 'El Kef', '0', '0');
INSERT INTO cities VALUES ('3570', '214', 'Al Mahdia', '0', '0');
INSERT INTO cities VALUES ('3571', '214', 'Al Munastir', '0', '0');
INSERT INTO cities VALUES ('3572', '214', 'Bajah', '0', '0');
INSERT INTO cities VALUES ('3573', '214', 'Bizerte', '0', '0');
INSERT INTO cities VALUES ('3574', '214', 'Nabeul', '0', '0');
INSERT INTO cities VALUES ('3575', '214', 'Siliana', '0', '0');
INSERT INTO cities VALUES ('3576', '214', 'Sousse', '0', '0');
INSERT INTO cities VALUES ('3577', '214', 'Ben Arous', '0', '0');
INSERT INTO cities VALUES ('3578', '214', 'Madanin', '0', '0');
INSERT INTO cities VALUES ('3579', '214', 'Gabes', '0', '0');
INSERT INTO cities VALUES ('3580', '214', 'Kebili', '0', '0');
INSERT INTO cities VALUES ('3581', '214', 'Sfax', '0', '0');
INSERT INTO cities VALUES ('3582', '214', 'Sidi Bou Zid', '0', '0');
INSERT INTO cities VALUES ('3583', '214', 'Tataouine', '0', '0');
INSERT INTO cities VALUES ('3584', '214', 'Tozeur', '0', '0');
INSERT INTO cities VALUES ('3585', '214', 'Tunis', '0', '0');
INSERT INTO cities VALUES ('3586', '214', 'Zaghouan', '0', '0');
INSERT INTO cities VALUES ('3587', '214', 'Aiana', '0', '0');
INSERT INTO cities VALUES ('3588', '214', 'Manouba', '0', '0');
INSERT INTO cities VALUES ('3589', '212', 'Ha', '0', '0');
INSERT INTO cities VALUES ('3590', '212', 'Tongatapu', '0', '0');
INSERT INTO cities VALUES ('3591', '212', 'Vava', '0', '0');
INSERT INTO cities VALUES ('3592', '215', 'Adiyaman', '0', '0');
INSERT INTO cities VALUES ('3593', '215', 'Afyonkarahisar', '0', '0');
INSERT INTO cities VALUES ('3594', '215', 'Agri', '0', '0');
INSERT INTO cities VALUES ('3595', '215', 'Amasya', '0', '0');
INSERT INTO cities VALUES ('3596', '215', 'Antalya', '0', '0');
INSERT INTO cities VALUES ('3597', '215', 'Artvin', '0', '0');
INSERT INTO cities VALUES ('3598', '215', 'Aydin', '0', '0');
INSERT INTO cities VALUES ('3599', '215', 'Balikesir', '0', '0');
INSERT INTO cities VALUES ('3600', '215', 'Bilecik', '0', '0');
INSERT INTO cities VALUES ('3601', '215', 'Bingol', '0', '0');
INSERT INTO cities VALUES ('3602', '215', 'Bitlis', '0', '0');
INSERT INTO cities VALUES ('3603', '215', 'Bolu', '0', '0');
INSERT INTO cities VALUES ('3604', '215', 'Burdur', '0', '0');
INSERT INTO cities VALUES ('3605', '215', 'Bursa', '0', '0');
INSERT INTO cities VALUES ('3606', '215', 'Canakkale', '0', '0');
INSERT INTO cities VALUES ('3607', '215', 'Corum', '0', '0');
INSERT INTO cities VALUES ('3608', '215', 'Denizli', '0', '0');
INSERT INTO cities VALUES ('3609', '215', 'Diyarbakir', '0', '0');
INSERT INTO cities VALUES ('3610', '215', 'Edirne', '0', '0');
INSERT INTO cities VALUES ('3611', '215', 'Elazig', '0', '0');
INSERT INTO cities VALUES ('3612', '215', 'Erzincan', '0', '0');
INSERT INTO cities VALUES ('3613', '215', 'Erzurum', '0', '0');
INSERT INTO cities VALUES ('3614', '215', 'Eskisehir', '0', '0');
INSERT INTO cities VALUES ('3615', '215', 'Giresun', '0', '0');
INSERT INTO cities VALUES ('3616', '215', 'Hatay', '0', '0');
INSERT INTO cities VALUES ('3617', '215', 'Mersin', '0', '0');
INSERT INTO cities VALUES ('3618', '215', 'Isparta', '0', '0');
INSERT INTO cities VALUES ('3619', '215', 'Istanbul', '0', '0');
INSERT INTO cities VALUES ('3620', '215', 'Izmir', '0', '0');
INSERT INTO cities VALUES ('3621', '215', 'Kastamonu', '0', '0');
INSERT INTO cities VALUES ('3622', '215', 'Kayseri', '0', '0');
INSERT INTO cities VALUES ('3623', '215', 'Kirklareli', '0', '0');
INSERT INTO cities VALUES ('3624', '215', 'Kirsehir', '0', '0');
INSERT INTO cities VALUES ('3625', '215', 'Kocaeli', '0', '0');
INSERT INTO cities VALUES ('3626', '215', 'Kutahya', '0', '0');
INSERT INTO cities VALUES ('3627', '215', 'Malatya', '0', '0');
INSERT INTO cities VALUES ('3628', '215', 'Manisa', '0', '0');
INSERT INTO cities VALUES ('3629', '215', 'Kahramanmaras', '0', '0');
INSERT INTO cities VALUES ('3630', '215', 'Mugla', '0', '0');
INSERT INTO cities VALUES ('3631', '215', 'Mus', '0', '0');
INSERT INTO cities VALUES ('3632', '215', 'Nevsehir', '0', '0');
INSERT INTO cities VALUES ('3633', '215', 'Ordu', '0', '0');
INSERT INTO cities VALUES ('3634', '215', 'Rize', '0', '0');
INSERT INTO cities VALUES ('3635', '215', 'Sakarya', '0', '0');
INSERT INTO cities VALUES ('3636', '215', 'Samsun', '0', '0');
INSERT INTO cities VALUES ('3637', '215', 'Sinop', '0', '0');
INSERT INTO cities VALUES ('3638', '215', 'Sivas', '0', '0');
INSERT INTO cities VALUES ('3639', '215', 'Tekirdag', '0', '0');
INSERT INTO cities VALUES ('3640', '215', 'Tokat', '0', '0');
INSERT INTO cities VALUES ('3641', '215', 'Trabzon', '0', '0');
INSERT INTO cities VALUES ('3642', '215', 'Tunceli', '0', '0');
INSERT INTO cities VALUES ('3643', '215', 'Sanliurfa', '0', '0');
INSERT INTO cities VALUES ('3644', '215', 'Usak', '0', '0');
INSERT INTO cities VALUES ('3645', '215', 'Van', '0', '0');
INSERT INTO cities VALUES ('3646', '215', 'Yozgat', '0', '0');
INSERT INTO cities VALUES ('3647', '215', 'Ankara', '0', '0');
INSERT INTO cities VALUES ('3648', '215', 'Gumushane', '0', '0');
INSERT INTO cities VALUES ('3649', '215', 'Hakkari', '0', '0');
INSERT INTO cities VALUES ('3650', '215', 'Konya', '0', '0');
INSERT INTO cities VALUES ('3651', '215', 'Mardin', '0', '0');
INSERT INTO cities VALUES ('3652', '215', 'Nigde', '0', '0');
INSERT INTO cities VALUES ('3653', '215', 'Siirt', '0', '0');
INSERT INTO cities VALUES ('3654', '215', 'Aksaray', '0', '0');
INSERT INTO cities VALUES ('3655', '215', 'Batman', '0', '0');
INSERT INTO cities VALUES ('3656', '215', 'Bayburt', '0', '0');
INSERT INTO cities VALUES ('3657', '215', 'Karaman', '0', '0');
INSERT INTO cities VALUES ('3658', '215', 'Kirikkale', '0', '0');
INSERT INTO cities VALUES ('3659', '215', 'Sirnak', '0', '0');
INSERT INTO cities VALUES ('3660', '215', 'Adana', '0', '0');
INSERT INTO cities VALUES ('3661', '215', 'Cankiri', '0', '0');
INSERT INTO cities VALUES ('3662', '215', 'Gaziantep', '0', '0');
INSERT INTO cities VALUES ('3663', '215', 'Kars', '0', '0');
INSERT INTO cities VALUES ('3664', '215', 'Zonguldak', '0', '0');
INSERT INTO cities VALUES ('3665', '215', 'Ardahan', '0', '0');
INSERT INTO cities VALUES ('3666', '215', 'Bartin', '0', '0');
INSERT INTO cities VALUES ('3667', '215', 'Igdir', '0', '0');
INSERT INTO cities VALUES ('3668', '215', 'Karabuk', '0', '0');
INSERT INTO cities VALUES ('3669', '215', 'Kilis', '0', '0');
INSERT INTO cities VALUES ('3670', '215', 'Osmaniye', '0', '0');
INSERT INTO cities VALUES ('3671', '215', 'Yalova', '0', '0');
INSERT INTO cities VALUES ('3672', '215', 'Duzce', '0', '0');
INSERT INTO cities VALUES ('3673', '213', 'Arima', '0', '0');
INSERT INTO cities VALUES ('3674', '213', 'Caroni', '0', '0');
INSERT INTO cities VALUES ('3675', '213', 'Mayaro', '0', '0');
INSERT INTO cities VALUES ('3676', '213', 'Nariva', '0', '0');
INSERT INTO cities VALUES ('3677', '213', 'Port-of-Spain', '0', '0');
INSERT INTO cities VALUES ('3678', '213', 'Saint Andrew', '0', '0');
INSERT INTO cities VALUES ('3679', '213', 'Saint David', '0', '0');
INSERT INTO cities VALUES ('3680', '213', 'Saint George', '0', '0');
INSERT INTO cities VALUES ('3681', '213', 'Saint Patrick', '0', '0');
INSERT INTO cities VALUES ('3682', '213', 'San Fernando', '0', '0');
INSERT INTO cities VALUES ('3683', '213', 'Tobago', '0', '0');
INSERT INTO cities VALUES ('3684', '213', 'Victoria', '0', '0');
INSERT INTO cities VALUES ('3685', '206', 'Fu-chien', '0', '0');
INSERT INTO cities VALUES ('3686', '206', 'Kao-hsiung', '0', '0');
INSERT INTO cities VALUES ('3687', '206', 'T\'ai-pei', '0', '0');
INSERT INTO cities VALUES ('3688', '206', 'T\'ai-wan', '0', '0');
INSERT INTO cities VALUES ('3689', '208', 'Pwani', '0', '0');
INSERT INTO cities VALUES ('3690', '208', 'Dodoma', '0', '0');
INSERT INTO cities VALUES ('3691', '208', 'Iringa', '0', '0');
INSERT INTO cities VALUES ('3692', '208', 'Kigoma', '0', '0');
INSERT INTO cities VALUES ('3693', '208', 'Kilimanjaro', '0', '0');
INSERT INTO cities VALUES ('3694', '208', 'Lindi', '0', '0');
INSERT INTO cities VALUES ('3695', '208', 'Mara', '0', '0');
INSERT INTO cities VALUES ('3696', '208', 'Mbeya', '0', '0');
INSERT INTO cities VALUES ('3697', '208', 'Morogoro', '0', '0');
INSERT INTO cities VALUES ('3698', '208', 'Mtwara', '0', '0');
INSERT INTO cities VALUES ('3699', '208', 'Mwanza', '0', '0');
INSERT INTO cities VALUES ('3700', '208', 'Pemba North', '0', '0');
INSERT INTO cities VALUES ('3701', '208', 'Ruvuma', '0', '0');
INSERT INTO cities VALUES ('3702', '208', 'Shinyanga', '0', '0');
INSERT INTO cities VALUES ('3703', '208', 'Singida', '0', '0');
INSERT INTO cities VALUES ('3704', '208', 'Tabora', '0', '0');
INSERT INTO cities VALUES ('3705', '208', 'Tanga', '0', '0');
INSERT INTO cities VALUES ('3706', '208', 'Kagera', '0', '0');
INSERT INTO cities VALUES ('3707', '208', 'Pemba South', '0', '0');
INSERT INTO cities VALUES ('3708', '208', 'Zanzibar Central', '0', '0');
INSERT INTO cities VALUES ('3709', '208', 'Zanzibar North', '0', '0');
INSERT INTO cities VALUES ('3710', '208', 'Dar es Salaam', '0', '0');
INSERT INTO cities VALUES ('3711', '208', 'Rukwa', '0', '0');
INSERT INTO cities VALUES ('3712', '208', 'Zanzibar Urban', '0', '0');
INSERT INTO cities VALUES ('3713', '208', 'Arusha', '0', '0');
INSERT INTO cities VALUES ('3714', '208', 'Manyara', '0', '0');
INSERT INTO cities VALUES ('3715', '220', 'Cherkas\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3716', '220', 'Chernihivs\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3717', '220', 'Chernivets\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3718', '220', 'Dnipropetrovs\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3719', '220', 'Donets\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3720', '220', 'Ivano-Frankivs\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3721', '220', 'Kharkivs\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3722', '220', 'Khersons\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3723', '220', 'Khmel\'nyts\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3724', '220', 'Kirovohrads\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3725', '220', 'Krym', '0', '0');
INSERT INTO cities VALUES ('3726', '220', 'Kyyiv', '0', '0');
INSERT INTO cities VALUES ('3727', '220', 'Kyyivs\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3728', '220', 'Luhans\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3729', '220', 'L\'vivs\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3730', '220', 'Mykolayivs\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3731', '220', 'Odes\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3732', '220', 'Poltavs\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3733', '220', 'Rivnens\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3734', '220', 'Sevastopol\'', '0', '0');
INSERT INTO cities VALUES ('3735', '220', 'Sums\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3736', '220', 'Ternopil\'s\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3737', '220', 'Vinnyts\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3738', '220', 'Volyns\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3739', '220', 'Zakarpats\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3740', '220', 'Zaporiz\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3741', '220', 'Zhytomyrs\'ka Oblast\'', '0', '0');
INSERT INTO cities VALUES ('3742', '219', 'Apac', '0', '0');
INSERT INTO cities VALUES ('3743', '219', 'Bundibugyo', '0', '0');
INSERT INTO cities VALUES ('3744', '219', 'Bushenyi', '0', '0');
INSERT INTO cities VALUES ('3745', '219', 'Gulu', '0', '0');
INSERT INTO cities VALUES ('3746', '219', 'Hoima', '0', '0');
INSERT INTO cities VALUES ('3747', '219', 'Jinja', '0', '0');
INSERT INTO cities VALUES ('3748', '219', 'Kalangala', '0', '0');
INSERT INTO cities VALUES ('3749', '219', 'Kampala', '0', '0');
INSERT INTO cities VALUES ('3750', '219', 'Kamuli', '0', '0');
INSERT INTO cities VALUES ('3751', '219', 'Kapchorwa', '0', '0');
INSERT INTO cities VALUES ('3752', '219', 'Kasese', '0', '0');
INSERT INTO cities VALUES ('3753', '219', 'Kibale', '0', '0');
INSERT INTO cities VALUES ('3754', '219', 'Kiboga', '0', '0');
INSERT INTO cities VALUES ('3755', '219', 'Kisoro', '0', '0');
INSERT INTO cities VALUES ('3756', '219', 'Kotido', '0', '0');
INSERT INTO cities VALUES ('3757', '219', 'Kumi', '0', '0');
INSERT INTO cities VALUES ('3758', '219', 'Lira', '0', '0');
INSERT INTO cities VALUES ('3759', '219', 'Masindi', '0', '0');
INSERT INTO cities VALUES ('3760', '219', 'Mbarara', '0', '0');
INSERT INTO cities VALUES ('3761', '219', 'Mubende', '0', '0');
INSERT INTO cities VALUES ('3762', '219', 'Nebbi', '0', '0');
INSERT INTO cities VALUES ('3763', '219', 'Ntungamo', '0', '0');
INSERT INTO cities VALUES ('3764', '219', 'Pallisa', '0', '0');
INSERT INTO cities VALUES ('3765', '219', 'Rakai', '0', '0');
INSERT INTO cities VALUES ('3766', '219', 'Adjumani', '0', '0');
INSERT INTO cities VALUES ('3767', '219', 'Bugiri', '0', '0');
INSERT INTO cities VALUES ('3768', '219', 'Busia', '0', '0');
INSERT INTO cities VALUES ('3769', '219', 'Katakwi', '0', '0');
INSERT INTO cities VALUES ('3770', '219', 'Luwero', '0', '0');
INSERT INTO cities VALUES ('3771', '219', 'Masaka', '0', '0');
INSERT INTO cities VALUES ('3772', '219', 'Moyo', '0', '0');
INSERT INTO cities VALUES ('3773', '219', 'Nakasongola', '0', '0');
INSERT INTO cities VALUES ('3774', '219', 'Sembabule', '0', '0');
INSERT INTO cities VALUES ('3775', '219', 'Tororo', '0', '0');
INSERT INTO cities VALUES ('3776', '219', 'Arua', '0', '0');
INSERT INTO cities VALUES ('3777', '219', 'Iganga', '0', '0');
INSERT INTO cities VALUES ('3778', '219', 'Kabarole', '0', '0');
INSERT INTO cities VALUES ('3779', '219', 'Kaberamaido', '0', '0');
INSERT INTO cities VALUES ('3780', '219', 'Kamwenge', '0', '0');
INSERT INTO cities VALUES ('3781', '219', 'Kanungu', '0', '0');
INSERT INTO cities VALUES ('3782', '219', 'Kayunga', '0', '0');
INSERT INTO cities VALUES ('3783', '219', 'Kitgum', '0', '0');
INSERT INTO cities VALUES ('3784', '219', 'Kyenjojo', '0', '0');
INSERT INTO cities VALUES ('3785', '219', 'Mayuge', '0', '0');
INSERT INTO cities VALUES ('3786', '219', 'Mbale', '0', '0');
INSERT INTO cities VALUES ('3787', '219', 'Moroto', '0', '0');
INSERT INTO cities VALUES ('3788', '219', 'Mpigi', '0', '0');
INSERT INTO cities VALUES ('3789', '219', 'Mukono', '0', '0');
INSERT INTO cities VALUES ('3790', '219', 'Nakapiripirit', '0', '0');
INSERT INTO cities VALUES ('3791', '219', 'Pader', '0', '0');
INSERT INTO cities VALUES ('3792', '219', 'Rukungiri', '0', '0');
INSERT INTO cities VALUES ('3793', '219', 'Sironko', '0', '0');
INSERT INTO cities VALUES ('3794', '219', 'Soroti', '0', '0');
INSERT INTO cities VALUES ('3795', '219', 'Wakiso', '0', '0');
INSERT INTO cities VALUES ('3796', '219', 'Yumbe', '0', '0');
INSERT INTO cities VALUES ('3797', '223', 'Armed Forces Americas', '0', '0');
INSERT INTO cities VALUES ('3798', '223', 'Armed Forces Europe, Middle East, & Canada', '0', '0');
INSERT INTO cities VALUES ('3799', '223', 'Alaska', '0', '0');
INSERT INTO cities VALUES ('3800', '223', 'Alabama', '0', '0');
INSERT INTO cities VALUES ('3801', '223', 'Armed Forces Pacific', '0', '0');
INSERT INTO cities VALUES ('3802', '223', 'Arkansas', '0', '0');
INSERT INTO cities VALUES ('3803', '223', 'American Samoa', '0', '0');
INSERT INTO cities VALUES ('3804', '223', 'Arizona', '0', '0');
INSERT INTO cities VALUES ('3805', '223', 'California', '0', '0');
INSERT INTO cities VALUES ('3806', '223', 'Colorado', '0', '0');
INSERT INTO cities VALUES ('3807', '223', 'Connecticut', '0', '0');
INSERT INTO cities VALUES ('3808', '223', 'District of Columbia', '0', '0');
INSERT INTO cities VALUES ('3809', '223', 'Delaware', '0', '0');
INSERT INTO cities VALUES ('3810', '223', 'Florida', '0', '0');
INSERT INTO cities VALUES ('3811', '223', 'Federated States of Micronesia', '0', '0');
INSERT INTO cities VALUES ('3812', '223', 'Georgia', '0', '0');
INSERT INTO cities VALUES ('3813', '223', 'Guam', '0', '0');
INSERT INTO cities VALUES ('3814', '223', 'Hawaii', '0', '0');
INSERT INTO cities VALUES ('3815', '223', 'Iowa', '0', '0');
INSERT INTO cities VALUES ('3816', '223', 'Idaho', '0', '0');
INSERT INTO cities VALUES ('3817', '223', 'Illinois', '0', '0');
INSERT INTO cities VALUES ('3818', '223', 'Indiana', '0', '0');
INSERT INTO cities VALUES ('3819', '223', 'Kansas', '0', '0');
INSERT INTO cities VALUES ('3820', '223', 'Kentucky', '0', '0');
INSERT INTO cities VALUES ('3821', '223', 'Louisiana', '0', '0');
INSERT INTO cities VALUES ('3822', '223', 'Massachusetts', '0', '0');
INSERT INTO cities VALUES ('3823', '223', 'Maryland', '0', '0');
INSERT INTO cities VALUES ('3824', '223', 'Maine', '0', '0');
INSERT INTO cities VALUES ('3825', '223', 'Marshall Islands', '0', '0');
INSERT INTO cities VALUES ('3826', '223', 'Michigan', '0', '0');
INSERT INTO cities VALUES ('3827', '223', 'Minnesota', '0', '0');
INSERT INTO cities VALUES ('3828', '223', 'Missouri', '0', '0');
INSERT INTO cities VALUES ('3829', '223', 'Northern Mariana Islands', '0', '0');
INSERT INTO cities VALUES ('3830', '223', 'Mississippi', '0', '0');
INSERT INTO cities VALUES ('3831', '223', 'Montana', '0', '0');
INSERT INTO cities VALUES ('3832', '223', 'North Carolina', '0', '0');
INSERT INTO cities VALUES ('3833', '223', 'North Dakota', '0', '0');
INSERT INTO cities VALUES ('3834', '223', 'Nebraska', '0', '0');
INSERT INTO cities VALUES ('3835', '223', 'New Hampshire', '0', '0');
INSERT INTO cities VALUES ('3836', '223', 'New Jersey', '0', '0');
INSERT INTO cities VALUES ('3837', '223', 'New Mexico', '0', '0');
INSERT INTO cities VALUES ('3838', '223', 'Nevada', '0', '0');
INSERT INTO cities VALUES ('3839', '223', 'New York', '0', '0');
INSERT INTO cities VALUES ('3840', '223', 'Ohio', '0', '0');
INSERT INTO cities VALUES ('3841', '223', 'Oklahoma', '0', '0');
INSERT INTO cities VALUES ('3842', '223', 'Oregon', '0', '0');
INSERT INTO cities VALUES ('3843', '223', 'Pennsylvania', '0', '0');
INSERT INTO cities VALUES ('3844', '223', 'Palau', '0', '0');
INSERT INTO cities VALUES ('3845', '223', 'Rhode Island', '0', '0');
INSERT INTO cities VALUES ('3846', '223', 'South Carolina', '0', '0');
INSERT INTO cities VALUES ('3847', '223', 'South Dakota', '0', '0');
INSERT INTO cities VALUES ('3848', '223', 'Tennessee', '0', '0');
INSERT INTO cities VALUES ('3849', '223', 'Texas', '0', '0');
INSERT INTO cities VALUES ('3850', '223', 'Utah', '0', '0');
INSERT INTO cities VALUES ('3851', '223', 'Virginia', '0', '0');
INSERT INTO cities VALUES ('3852', '223', 'Virgin Islands', '0', '0');
INSERT INTO cities VALUES ('3853', '223', 'Vermont', '0', '0');
INSERT INTO cities VALUES ('3854', '223', 'Washington', '0', '0');
INSERT INTO cities VALUES ('3855', '223', 'Wisconsin', '0', '0');
INSERT INTO cities VALUES ('3856', '223', 'West Virginia', '0', '0');
INSERT INTO cities VALUES ('3857', '223', 'Wyoming', '0', '0');
INSERT INTO cities VALUES ('3858', '225', 'Artigas', '0', '0');
INSERT INTO cities VALUES ('3859', '225', 'Canelones', '0', '0');
INSERT INTO cities VALUES ('3860', '225', 'Cerro Largo', '0', '0');
INSERT INTO cities VALUES ('3861', '225', 'Colonia', '0', '0');
INSERT INTO cities VALUES ('3862', '225', 'Durazno', '0', '0');
INSERT INTO cities VALUES ('3863', '225', 'Flores', '0', '0');
INSERT INTO cities VALUES ('3864', '225', 'Florida', '0', '0');
INSERT INTO cities VALUES ('3865', '225', 'Lavalleja', '0', '0');
INSERT INTO cities VALUES ('3866', '225', 'Maldonado', '0', '0');
INSERT INTO cities VALUES ('3867', '225', 'Montevideo', '0', '0');
INSERT INTO cities VALUES ('3868', '225', 'Paysandu', '0', '0');
INSERT INTO cities VALUES ('3869', '225', 'Rio Negro', '0', '0');
INSERT INTO cities VALUES ('3870', '225', 'Rivera', '0', '0');
INSERT INTO cities VALUES ('3871', '225', 'Rocha', '0', '0');
INSERT INTO cities VALUES ('3872', '225', 'Salto', '0', '0');
INSERT INTO cities VALUES ('3873', '225', 'San Jose', '0', '0');
INSERT INTO cities VALUES ('3874', '225', 'Soriano', '0', '0');
INSERT INTO cities VALUES ('3875', '225', 'Tacuarembo', '0', '0');
INSERT INTO cities VALUES ('3876', '225', 'Treinta y Tres', '0', '0');
INSERT INTO cities VALUES ('3877', '226', 'Andijon', '0', '0');
INSERT INTO cities VALUES ('3878', '226', 'Bukhoro', '0', '0');
INSERT INTO cities VALUES ('3879', '226', 'Farghona', '0', '0');
INSERT INTO cities VALUES ('3880', '226', 'Jizzakh', '0', '0');
INSERT INTO cities VALUES ('3881', '226', 'Khorazm', '0', '0');
INSERT INTO cities VALUES ('3882', '226', 'Namangan', '0', '0');
INSERT INTO cities VALUES ('3883', '226', 'Nawoiy', '0', '0');
INSERT INTO cities VALUES ('3884', '226', 'Qashqadaryo', '0', '0');
INSERT INTO cities VALUES ('3885', '226', 'Qoraqalpoghiston', '0', '0');
INSERT INTO cities VALUES ('3886', '226', 'Samarqand', '0', '0');
INSERT INTO cities VALUES ('3887', '226', 'Sirdaryo', '0', '0');
INSERT INTO cities VALUES ('3888', '226', 'Surkhondaryo', '0', '0');
INSERT INTO cities VALUES ('3889', '226', 'Toshkent', '0', '0');
INSERT INTO cities VALUES ('3890', '226', 'Toshkent', '0', '0');
INSERT INTO cities VALUES ('3891', '180', 'Charlotte', '0', '0');
INSERT INTO cities VALUES ('3892', '180', 'Saint Andrew', '0', '0');
INSERT INTO cities VALUES ('3893', '180', 'Saint David', '0', '0');
INSERT INTO cities VALUES ('3894', '180', 'Saint George', '0', '0');
INSERT INTO cities VALUES ('3895', '180', 'Saint Patrick', '0', '0');
INSERT INTO cities VALUES ('3896', '180', 'Grenadines', '0', '0');
INSERT INTO cities VALUES ('3897', '229', 'Amazonas', '0', '0');
INSERT INTO cities VALUES ('3898', '229', 'Anzoategui', '0', '0');
INSERT INTO cities VALUES ('3899', '229', 'Apure', '0', '0');
INSERT INTO cities VALUES ('3900', '229', 'Aragua', '0', '0');
INSERT INTO cities VALUES ('3901', '229', 'Barinas', '0', '0');
INSERT INTO cities VALUES ('3902', '229', 'Bolivar', '0', '0');
INSERT INTO cities VALUES ('3903', '229', 'Carabobo', '0', '0');
INSERT INTO cities VALUES ('3904', '229', 'Cojedes', '0', '0');
INSERT INTO cities VALUES ('3905', '229', 'Delta Amacuro', '0', '0');
INSERT INTO cities VALUES ('3906', '229', 'Falcon', '0', '0');
INSERT INTO cities VALUES ('3907', '229', 'Guarico', '0', '0');
INSERT INTO cities VALUES ('3908', '229', 'Lara', '0', '0');
INSERT INTO cities VALUES ('3909', '229', 'Merida', '0', '0');
INSERT INTO cities VALUES ('3910', '229', 'Miranda', '0', '0');
INSERT INTO cities VALUES ('3911', '229', 'Monagas', '0', '0');
INSERT INTO cities VALUES ('3912', '229', 'Nueva Esparta', '0', '0');
INSERT INTO cities VALUES ('3913', '229', 'Portuguesa', '0', '0');
INSERT INTO cities VALUES ('3914', '229', 'Sucre', '0', '0');
INSERT INTO cities VALUES ('3915', '229', 'Tachira', '0', '0');
INSERT INTO cities VALUES ('3916', '229', 'Trujillo', '0', '0');
INSERT INTO cities VALUES ('3917', '229', 'Yaracuy', '0', '0');
INSERT INTO cities VALUES ('3918', '229', 'Zulia', '0', '0');
INSERT INTO cities VALUES ('3919', '229', 'Dependencias Federales', '0', '0');
INSERT INTO cities VALUES ('3920', '229', 'Distrito Federal', '0', '0');
INSERT INTO cities VALUES ('3921', '229', 'Vargas', '0', '0');
INSERT INTO cities VALUES ('3922', '230', 'An Giang', '14.35', '109.1');
INSERT INTO cities VALUES ('3923', '230', 'Bến Tre', '10.2333', '106.3833');
INSERT INTO cities VALUES ('3924', '230', 'Cao Bằng', '22.6667', '106.25');
INSERT INTO cities VALUES ('3925', '230', 'Đồng Tháp', '21.7667', '104.7');
INSERT INTO cities VALUES ('3926', '230', 'Hải Phòng', '20.8561', '106.6822');
INSERT INTO cities VALUES ('3927', '230', 'Hồ Chí Minh', '10.8142', '106.6438');
INSERT INTO cities VALUES ('3928', '230', 'Kiên Giang', '0', '0');
INSERT INTO cities VALUES ('3929', '230', 'Lâm Đồng', '0', '0');
INSERT INTO cities VALUES ('3930', '230', 'Long An', '10.4', '106.3333');
INSERT INTO cities VALUES ('3931', '230', 'Quảng Ninh', '17.4', '106.65');
INSERT INTO cities VALUES ('3932', '230', 'Sơn La', '21.3167', '103.9');
INSERT INTO cities VALUES ('3933', '230', 'Tây Ninh', '11.3', '106.1');
INSERT INTO cities VALUES ('3934', '230', 'Thanh Hóa', '19.8', '105.7667');
INSERT INTO cities VALUES ('3935', '230', 'Thái Bình', '20.45', '106.3333');
INSERT INTO cities VALUES ('3936', '230', 'Tiền Giang', '0', '0');
INSERT INTO cities VALUES ('3937', '230', 'Lạng Sơn', '21.8333', '106.7333');
INSERT INTO cities VALUES ('3938', '230', 'Đồng Nai', '18.1', '106.3333');
INSERT INTO cities VALUES ('3939', '230', 'Hà Nội', '21.0333', '105.85');
INSERT INTO cities VALUES ('3940', '230', 'Bà Rịa', '14.7', '108.6833');
INSERT INTO cities VALUES ('3941', '230', 'Bình Định', '14.1333', '108.7833');
INSERT INTO cities VALUES ('3942', '230', 'Bình Thuận', '0', '0');
INSERT INTO cities VALUES ('3943', '230', 'Gia Lai', '13.9833', '108');
INSERT INTO cities VALUES ('3944', '230', 'Hà Giang', '22.8333', '104.9833');
INSERT INTO cities VALUES ('3945', '230', 'Hà Tĩnh', '18.3333', '105.9');
INSERT INTO cities VALUES ('3946', '230', 'Hòa Bình', '20.8133', '105.3383');
INSERT INTO cities VALUES ('3947', '230', 'Khánh Hòa', '10.6833', '105.1667');
INSERT INTO cities VALUES ('3948', '230', 'Kon Tum', '14.35', '108');
INSERT INTO cities VALUES ('3949', '230', 'Nghệ An', '0', '0');
INSERT INTO cities VALUES ('3950', '230', 'Ninh Bình', '20.2539', '105.975');
INSERT INTO cities VALUES ('3951', '230', 'Ninh Thuận', '0', '0');
INSERT INTO cities VALUES ('3952', '230', 'Phú Yên', '0', '0');
INSERT INTO cities VALUES ('3953', '230', 'Quảng Bình', '0', '0');
INSERT INTO cities VALUES ('3954', '230', 'Quảng Ngãi', '15.1167', '108.8');
INSERT INTO cities VALUES ('3955', '230', 'Quảng Trị', '16.75', '107.2');
INSERT INTO cities VALUES ('3956', '230', 'Sóc Trăng', '9.6033', '105.98');
INSERT INTO cities VALUES ('3957', '230', 'Thừa Thiên - Huế', '0', '0');
INSERT INTO cities VALUES ('3958', '230', 'Trà Vinh', '9.9347', '106.3453');
INSERT INTO cities VALUES ('3959', '230', 'Tuyên Quang', '0', '0');
INSERT INTO cities VALUES ('3960', '230', 'Vĩnh Long', '10.25', '105.9667');
INSERT INTO cities VALUES ('3961', '230', 'Yên Bái', '21.7', '104.8667');
INSERT INTO cities VALUES ('3962', '230', 'Bắc Giang', '21.2731', '106.1946');
INSERT INTO cities VALUES ('3963', '230', 'Bắc Kạn', '0', '0');
INSERT INTO cities VALUES ('3964', '230', 'Bạc Liêu', '9.2941', '105.7278');
INSERT INTO cities VALUES ('3965', '230', 'Bắc Ninh', '21.1861', '106.0763');
INSERT INTO cities VALUES ('3966', '230', 'Bình Dương', '15.85', '108.3833');
INSERT INTO cities VALUES ('3967', '230', 'Bình Phước', '10.4927', '105.2681');
INSERT INTO cities VALUES ('3968', '230', 'Cà Mau', '9.1769', '105.15');
INSERT INTO cities VALUES ('3969', '230', 'Đà Nẵng', '16.0678', '108.2208');
INSERT INTO cities VALUES ('3970', '230', 'Hải Dương', '20.9333', '106.3167');
INSERT INTO cities VALUES ('3971', '230', 'Hà Nam', '19.3167', '105.8');
INSERT INTO cities VALUES ('3972', '230', 'Hưng Yên', '20.65', '106.0667');
INSERT INTO cities VALUES ('3973', '230', 'Nam Định', '20.4167', '106.1667');
INSERT INTO cities VALUES ('3974', '230', 'Phú Thọ', '13.9', '108.9167');
INSERT INTO cities VALUES ('3975', '230', 'Quảng Nam', '15.8858', '108.2569');
INSERT INTO cities VALUES ('3976', '230', 'Thái Nguyên', '21.5928', '105.8442');
INSERT INTO cities VALUES ('3977', '230', 'Vĩnh Phúc', '14.1', '108.8');
INSERT INTO cities VALUES ('3978', '230', 'Cần Thơ', '10.0333', '105.7833');
INSERT INTO cities VALUES ('3979', '230', 'Đak Lak', '0', '0');
INSERT INTO cities VALUES ('3980', '230', 'Lai Châu', '22.0667', '103.1667');
INSERT INTO cities VALUES ('3981', '230', 'Lào Cai', '22.4833', '103.95');
INSERT INTO cities VALUES ('3982', '230', 'Đak Nông', '0', '0');
INSERT INTO cities VALUES ('3983', '230', 'Điện Biên', '21.3833', '103.0167');
INSERT INTO cities VALUES ('3984', '230', 'Hậu Giang', '0', '0');
INSERT INTO cities VALUES ('3985', '227', 'Ambrym', '0', '0');
INSERT INTO cities VALUES ('3986', '227', 'Aoba', '0', '0');
INSERT INTO cities VALUES ('3987', '227', 'Torba', '0', '0');
INSERT INTO cities VALUES ('3988', '227', 'Efate', '0', '0');
INSERT INTO cities VALUES ('3989', '227', 'Epi', '0', '0');
INSERT INTO cities VALUES ('3990', '227', 'Malakula', '0', '0');
INSERT INTO cities VALUES ('3991', '227', 'Paama', '0', '0');
INSERT INTO cities VALUES ('3992', '227', 'Pentecote', '0', '0');
INSERT INTO cities VALUES ('3993', '227', 'Sanma', '0', '0');
INSERT INTO cities VALUES ('3994', '227', 'Shepherd', '0', '0');
INSERT INTO cities VALUES ('3995', '227', 'Tafea', '0', '0');
INSERT INTO cities VALUES ('3996', '227', 'Malampa', '0', '0');
INSERT INTO cities VALUES ('3997', '227', 'Penama', '0', '0');
INSERT INTO cities VALUES ('3998', '227', 'Shefa', '0', '0');
INSERT INTO cities VALUES ('3999', '181', 'Aiga-i-le-Tai', '0', '0');
INSERT INTO cities VALUES ('4000', '181', 'Atua', '0', '0');
INSERT INTO cities VALUES ('4001', '181', 'Fa', '0', '0');
INSERT INTO cities VALUES ('4002', '181', 'Gaga', '0', '0');
INSERT INTO cities VALUES ('4003', '181', 'Va', '0', '0');
INSERT INTO cities VALUES ('4004', '181', 'Gagaifomauga', '0', '0');
INSERT INTO cities VALUES ('4005', '181', 'Palauli', '0', '0');
INSERT INTO cities VALUES ('4006', '181', 'Satupa', '0', '0');
INSERT INTO cities VALUES ('4007', '181', 'Tuamasaga', '0', '0');
INSERT INTO cities VALUES ('4008', '181', 'Vaisigano', '0', '0');
INSERT INTO cities VALUES ('4009', '235', 'Abyan', '0', '0');
INSERT INTO cities VALUES ('4010', '235', 'Adan', '0', '0');
INSERT INTO cities VALUES ('4011', '235', 'Al Mahrah', '0', '0');
INSERT INTO cities VALUES ('4012', '235', 'Hadramawt', '0', '0');
INSERT INTO cities VALUES ('4013', '235', 'Shabwah', '0', '0');
INSERT INTO cities VALUES ('4014', '235', 'Lahij', '0', '0');
INSERT INTO cities VALUES ('4015', '235', 'Al Bayda\'', '0', '0');
INSERT INTO cities VALUES ('4016', '235', 'Al Hudaydah', '0', '0');
INSERT INTO cities VALUES ('4017', '235', 'Al Jawf', '0', '0');
INSERT INTO cities VALUES ('4018', '235', 'Al Mahwit', '0', '0');
INSERT INTO cities VALUES ('4019', '235', 'Dhamar', '0', '0');
INSERT INTO cities VALUES ('4020', '235', 'Hajjah', '0', '0');
INSERT INTO cities VALUES ('4021', '235', 'Ibb', '0', '0');
INSERT INTO cities VALUES ('4022', '235', 'Ma\'rib', '0', '0');
INSERT INTO cities VALUES ('4023', '235', 'Sa\'dah', '0', '0');
INSERT INTO cities VALUES ('4024', '235', 'San\'a\'', '0', '0');
INSERT INTO cities VALUES ('4025', '235', 'Taizz', '0', '0');
INSERT INTO cities VALUES ('4026', '235', 'Ad Dali', '0', '0');
INSERT INTO cities VALUES ('4027', '235', 'Amran', '0', '0');
INSERT INTO cities VALUES ('4028', '235', 'Al Bayda\'', '0', '0');
INSERT INTO cities VALUES ('4029', '235', 'Al Jawf', '0', '0');
INSERT INTO cities VALUES ('4030', '235', 'Hajjah', '0', '0');
INSERT INTO cities VALUES ('4031', '235', 'Ibb', '0', '0');
INSERT INTO cities VALUES ('4032', '235', 'Lahij', '0', '0');
INSERT INTO cities VALUES ('4033', '235', 'Taizz', '0', '0');
INSERT INTO cities VALUES ('4034', '193', 'North-Western Province', '0', '0');
INSERT INTO cities VALUES ('4035', '193', 'KwaZulu-Natal', '0', '0');
INSERT INTO cities VALUES ('4036', '193', 'Free State', '0', '0');
INSERT INTO cities VALUES ('4037', '193', 'Eastern Cape', '0', '0');
INSERT INTO cities VALUES ('4038', '193', 'Gauteng', '0', '0');
INSERT INTO cities VALUES ('4039', '193', 'Mpumalanga', '0', '0');
INSERT INTO cities VALUES ('4040', '193', 'Northern Cape', '0', '0');
INSERT INTO cities VALUES ('4041', '193', 'Limpopo', '0', '0');
INSERT INTO cities VALUES ('4042', '193', 'North-West', '0', '0');
INSERT INTO cities VALUES ('4043', '193', 'Western Cape', '0', '0');
INSERT INTO cities VALUES ('4044', '238', 'Western', '0', '0');
INSERT INTO cities VALUES ('4045', '238', 'Central', '0', '0');
INSERT INTO cities VALUES ('4046', '238', 'Eastern', '0', '0');
INSERT INTO cities VALUES ('4047', '238', 'Luapula', '0', '0');
INSERT INTO cities VALUES ('4048', '238', 'Northern', '0', '0');
INSERT INTO cities VALUES ('4049', '238', 'North-Western', '0', '0');
INSERT INTO cities VALUES ('4050', '238', 'Southern', '0', '0');
INSERT INTO cities VALUES ('4051', '238', 'Copperbelt', '0', '0');
INSERT INTO cities VALUES ('4052', '238', 'Lusaka', '0', '0');
INSERT INTO cities VALUES ('4053', '239', 'Manicaland', '0', '0');
INSERT INTO cities VALUES ('4054', '239', 'Midlands', '0', '0');
INSERT INTO cities VALUES ('4055', '239', 'Mashonaland Central', '0', '0');
INSERT INTO cities VALUES ('4056', '239', 'Mashonaland East', '0', '0');
INSERT INTO cities VALUES ('4057', '239', 'Mashonaland West', '0', '0');
INSERT INTO cities VALUES ('4058', '239', 'Matabeleland North', '0', '0');
INSERT INTO cities VALUES ('4059', '239', 'Matabeleland South', '0', '0');
INSERT INTO cities VALUES ('4060', '239', 'Masvingo', '0', '0');
INSERT INTO cities VALUES ('4061', '239', 'Bulawayo', '0', '0');
INSERT INTO cities VALUES ('4062', '239', 'Harare', '0', '0');
INSERT INTO cities VALUES ('4063', '230', 'Vũng Tàu', '10.35', '107.0667');

-- ----------------------------
-- Table structure for `contacts`
-- ----------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of contacts
-- ----------------------------
INSERT INTO contacts VALUES ('50', 'Xin chào', 'Tedozi Manson', '0915428202', 'duyphan.developer@gmail.com', 'Giờ thì hết rồi các trường cấp 2 ko mặn mà, cấp 3 thì năm cắm năm ko, học sinh giờ thì lười chỉ thuê rạp ráp như đám cưới, cổng trại góp mỗi đứa vài chục thuê làm bảng chớp tắt như động đĩ, ôi còn gì những ngày tháng cả lớp phải bàn bạc vẽ bản vẽ cổng trại và trại trước cả 2-3 tháng trước tết, mỗi tuần là mỗi cãi lộn, rồi phân công nhóm đi chặt tre gom hoa lá, nhóm nấu ăn, nhóm dự thi các cuộc thi,... Rồi tới ngày cắm trại phải thức gần như cả đêm dựng cái trại, nhiều khi xấu như gì cũng có cái tự hào với tụi lớp khác. Ôi tuổi thơ xa lắm giờ tết chả muốn về thăm cắm trại ở trường xưa nữa', '1', '2016-01-28 10:13:26', '2016-01-30 22:10:02');
INSERT INTO contacts VALUES ('51', 'Yêu cầu thiết kế website', 'Tedozi Manson', '0915428202', 'duy.phan2509@outlook.com', 'Dear công ty Tedozi,<br />\r\n<br />\r\nHôm qua tôi được anh Tuấn giới thiệu về công ty anh, và tôi thấy khá phù hợp với yêu cầu của mình.<br />\r\nAnh có thể cung cấp SĐT để chúng ta tiện liên lạc không?<br />\r\n<br />\r\nThân chào anh.', '1', '2016-01-30 23:53:48', '2016-01-30 23:55:21');

-- ----------------------------
-- Table structure for `countries`
-- ----------------------------
DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_3_code` char(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_2_code` char(2) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_name` char(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_city` int(11) DEFAULT '0',
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=249 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of countries
-- ----------------------------
INSERT INTO countries VALUES ('1', 'AFG', 'AF', 'Afghanistan', '34', '0');
INSERT INTO countries VALUES ('2', 'ALB', 'AL', 'Albania', '12', '0');
INSERT INTO countries VALUES ('3', 'DZA', 'DZ', 'Algeria', '48', '0');
INSERT INTO countries VALUES ('4', 'ASM', 'AS', 'American Samoa', '0', '0');
INSERT INTO countries VALUES ('5', 'AND', 'AD', 'Andorra', '7', '0');
INSERT INTO countries VALUES ('6', 'AGO', 'AO', 'Angola', '18', '0');
INSERT INTO countries VALUES ('7', 'AIA', 'AI', 'Anguilla', '0', '0');
INSERT INTO countries VALUES ('8', 'ATA', 'AQ', 'Antarctica', '0', '0');
INSERT INTO countries VALUES ('9', 'ATG', 'AG', 'Antigua and Barbuda', '8', '0');
INSERT INTO countries VALUES ('10', 'ARG', 'AR', 'Argentina', '24', '0');
INSERT INTO countries VALUES ('11', 'ARM', 'AM', 'Armenia', '11', '0');
INSERT INTO countries VALUES ('12', 'ABW', 'AW', 'Aruba', '0', '0');
INSERT INTO countries VALUES ('13', 'AUS', 'AU', 'Australia', '8', '0');
INSERT INTO countries VALUES ('14', 'AUT', 'AT', 'Austria', '9', '0');
INSERT INTO countries VALUES ('15', 'AZE', 'AZ', 'Azerbaijan', '71', '0');
INSERT INTO countries VALUES ('16', 'BHS', 'BS', 'Bahamas', '21', '0');
INSERT INTO countries VALUES ('17', 'BHR', 'BH', 'Bahrain', '16', '0');
INSERT INTO countries VALUES ('18', 'BGD', 'BD', 'Bangladesh', '6', '0');
INSERT INTO countries VALUES ('19', 'BRB', 'BB', 'Barbados', '11', '0');
INSERT INTO countries VALUES ('20', 'BLR', 'BY', 'Belarus', '7', '0');
INSERT INTO countries VALUES ('21', 'BEL', 'BE', 'Belgium', '13', '0');
INSERT INTO countries VALUES ('22', 'BLZ', 'BZ', 'Belize', '6', '0');
INSERT INTO countries VALUES ('23', 'BEN', 'BJ', 'Benin', '12', '0');
INSERT INTO countries VALUES ('24', 'BMU', 'BM', 'Bermuda', '11', '0');
INSERT INTO countries VALUES ('25', 'BTN', 'BT', 'Bhutan', '18', '0');
INSERT INTO countries VALUES ('26', 'BOL', 'BO', 'Bolivia', '9', '0');
INSERT INTO countries VALUES ('27', 'BIH', 'BA', 'Bosnia and Herzegowina', '3', '0');
INSERT INTO countries VALUES ('28', 'BWA', 'BW', 'Botswana', '9', '0');
INSERT INTO countries VALUES ('29', 'BVT', 'BV', 'Bouvet Island', '0', '0');
INSERT INTO countries VALUES ('30', 'BRA', 'BR', 'Brazil', '27', '0');
INSERT INTO countries VALUES ('31', 'IOT', 'IO', 'British Indian Ocean Territory', '0', '0');
INSERT INTO countries VALUES ('32', 'BRN', 'BN', 'Brunei Darussalam', '12', '0');
INSERT INTO countries VALUES ('33', 'BGR', 'BG', 'Bulgaria', '29', '0');
INSERT INTO countries VALUES ('34', 'BFA', 'BF', 'Burkina Faso', '45', '0');
INSERT INTO countries VALUES ('35', 'BDI', 'BI', 'Burundi', '16', '0');
INSERT INTO countries VALUES ('36', 'KHM', 'KH', 'Cambodia', '22', '0');
INSERT INTO countries VALUES ('37', 'CMR', 'CM', 'Cameroon', '10', '0');
INSERT INTO countries VALUES ('38', 'CAN', 'CA', 'Canada', '13', '0');
INSERT INTO countries VALUES ('39', 'CPV', 'CV', 'Cape Verde', '16', '0');
INSERT INTO countries VALUES ('40', 'CYM', 'KY', 'Cayman Islands', '8', '0');
INSERT INTO countries VALUES ('41', 'CAF', 'CF', 'Central African Republic', '17', '0');
INSERT INTO countries VALUES ('42', 'TCD', 'TD', 'Chad', '14', '0');
INSERT INTO countries VALUES ('43', 'CHL', 'CL', 'Chile', '17', '0');
INSERT INTO countries VALUES ('44', 'CHN', 'CN', 'China', '31', '0');
INSERT INTO countries VALUES ('45', 'CXR', 'CX', 'Christmas Island', '0', '0');
INSERT INTO countries VALUES ('46', 'CCK', 'CC', 'Cocos (Keeling) Islands', '0', '0');
INSERT INTO countries VALUES ('47', 'COL', 'CO', 'Colombia', '33', '0');
INSERT INTO countries VALUES ('48', 'COM', 'KM', 'Comoros', '3', '0');
INSERT INTO countries VALUES ('49', 'COG', 'CG', 'Congo', '11', '0');
INSERT INTO countries VALUES ('50', 'COK', 'CK', 'Cook Islands', '0', '0');
INSERT INTO countries VALUES ('51', 'CRI', 'CR', 'Costa Rica', '7', '0');
INSERT INTO countries VALUES ('52', 'CIV', 'CI', 'Cote D\'Ivoire', '19', '0');
INSERT INTO countries VALUES ('53', 'HRV', 'HR', 'Croatia', '21', '0');
INSERT INTO countries VALUES ('54', 'CUB', 'CU', 'Cuba', '15', '0');
INSERT INTO countries VALUES ('55', 'CYP', 'CY', 'Cyprus', '6', '0');
INSERT INTO countries VALUES ('56', 'CZE', 'CZ', 'Czech Republic', '14', '0');
INSERT INTO countries VALUES ('57', 'DNK', 'DK', 'Denmark', '5', '0');
INSERT INTO countries VALUES ('58', 'DJI', 'DJ', 'Djibouti', '6', '0');
INSERT INTO countries VALUES ('59', 'DMA', 'DM', 'Dominica', '10', '0');
INSERT INTO countries VALUES ('60', 'DOM', 'DO', 'Dominican Republic', '34', '0');
INSERT INTO countries VALUES ('61', 'TMP', 'TP', 'East Timor', '0', '0');
INSERT INTO countries VALUES ('62', 'ECU', 'EC', 'Ecuador', '22', '0');
INSERT INTO countries VALUES ('63', 'EGY', 'EG', 'Egypt', '26', '0');
INSERT INTO countries VALUES ('64', 'SLV', 'SV', 'El Salvador', '14', '0');
INSERT INTO countries VALUES ('65', 'GNQ', 'GQ', 'Equatorial Guinea', '7', '0');
INSERT INTO countries VALUES ('66', 'ERI', 'ER', 'Eritrea', '6', '0');
INSERT INTO countries VALUES ('67', 'EST', 'EE', 'Estonia', '21', '0');
INSERT INTO countries VALUES ('68', 'ETH', 'ET', 'Ethiopia', '11', '0');
INSERT INTO countries VALUES ('69', 'FLK', 'FK', 'Falkland Islands (Malvinas)', '0', '0');
INSERT INTO countries VALUES ('70', 'FRO', 'FO', 'Faroe Islands', '0', '0');
INSERT INTO countries VALUES ('71', 'FJI', 'FJ', 'Fiji', '5', '0');
INSERT INTO countries VALUES ('72', 'FIN', 'FI', 'Finland', '6', '0');
INSERT INTO countries VALUES ('73', 'FRA', 'FR', 'France', '22', '0');
INSERT INTO countries VALUES ('75', 'GUF', 'GF', 'French Guiana', '0', '0');
INSERT INTO countries VALUES ('76', 'PYF', 'PF', 'French Polynesia', '0', '0');
INSERT INTO countries VALUES ('77', 'ATF', 'TF', 'French Southern Territories', '0', '0');
INSERT INTO countries VALUES ('78', 'GAB', 'GA', 'Gabon', '9', '0');
INSERT INTO countries VALUES ('79', 'GMB', 'GM', 'Gambia', '6', '0');
INSERT INTO countries VALUES ('80', 'GEO', 'GE', 'Georgia', '64', '0');
INSERT INTO countries VALUES ('81', 'DEU', 'DE', 'Germany', '16', '0');
INSERT INTO countries VALUES ('82', 'GHA', 'GH', 'Ghana', '10', '0');
INSERT INTO countries VALUES ('83', 'GIB', 'GI', 'Gibraltar', '0', '0');
INSERT INTO countries VALUES ('84', 'GRC', 'GR', 'Greece', '51', '0');
INSERT INTO countries VALUES ('85', 'GRL', 'GL', 'Greenland', '3', '0');
INSERT INTO countries VALUES ('86', 'GRD', 'GD', 'Grenada', '6', '0');
INSERT INTO countries VALUES ('87', 'GLP', 'GP', 'Guadeloupe', '0', '0');
INSERT INTO countries VALUES ('88', 'GUM', 'GU', 'Guam', '0', '0');
INSERT INTO countries VALUES ('89', 'GTM', 'GT', 'Guatemala', '22', '0');
INSERT INTO countries VALUES ('90', 'GIN', 'GN', 'Guinea', '34', '0');
INSERT INTO countries VALUES ('91', 'GNB', 'GW', 'Guinea-bissau', '9', '0');
INSERT INTO countries VALUES ('92', 'GUY', 'GY', 'Guyana', '10', '0');
INSERT INTO countries VALUES ('93', 'HTI', 'HT', 'Haiti', '10', '0');
INSERT INTO countries VALUES ('94', 'HMD', 'HM', 'Heard and Mc Donald Islands', '0', '0');
INSERT INTO countries VALUES ('95', 'HND', 'HN', 'Honduras', '18', '0');
INSERT INTO countries VALUES ('96', 'HKG', 'HK', 'Hong Kong', '0', '0');
INSERT INTO countries VALUES ('97', 'HUN', 'HU', 'Hungary', '43', '0');
INSERT INTO countries VALUES ('98', 'ISL', 'IS', 'Iceland', '28', '0');
INSERT INTO countries VALUES ('99', 'IND', 'IN', 'India', '35', '0');
INSERT INTO countries VALUES ('100', 'IDN', 'ID', 'Indonesia', '33', '0');
INSERT INTO countries VALUES ('101', 'IRN', 'IR', 'Iran (Islamic Republic of)', '40', '0');
INSERT INTO countries VALUES ('102', 'IRQ', 'IQ', 'Iraq', '18', '0');
INSERT INTO countries VALUES ('103', 'IRL', 'IE', 'Ireland', '26', '0');
INSERT INTO countries VALUES ('104', 'ISR', 'IL', 'Israel', '6', '0');
INSERT INTO countries VALUES ('105', 'ITA', 'IT', 'Italy', '20', '0');
INSERT INTO countries VALUES ('106', 'JAM', 'JM', 'Jamaica', '14', '0');
INSERT INTO countries VALUES ('107', 'JPN', 'JP', 'Japan', '47', '0');
INSERT INTO countries VALUES ('108', 'JOR', 'JO', 'Jordan', '12', '0');
INSERT INTO countries VALUES ('109', 'KAZ', 'KZ', 'Kazakhstan', '17', '0');
INSERT INTO countries VALUES ('110', 'KEN', 'KE', 'Kenya', '8', '0');
INSERT INTO countries VALUES ('111', 'KIR', 'KI', 'Kiribati', '3', '0');
INSERT INTO countries VALUES ('112', 'PRK', 'KP', 'Korea, Democratic People\'s Republic of', '13', '0');
INSERT INTO countries VALUES ('113', 'KOR', 'KR', 'Korea, Republic of', '16', '0');
INSERT INTO countries VALUES ('114', 'KWT', 'KW', 'Kuwait', '6', '0');
INSERT INTO countries VALUES ('115', 'KGZ', 'KG', 'Kyrgyzstan', '9', '0');
INSERT INTO countries VALUES ('116', 'LAO', 'LA', 'Lao People\'s Democratic Republic', '13', '0');
INSERT INTO countries VALUES ('117', 'LVA', 'LV', 'Latvia', '33', '0');
INSERT INTO countries VALUES ('118', 'LBN', 'LB', 'Lebanon', '11', '0');
INSERT INTO countries VALUES ('119', 'LSO', 'LS', 'Lesotho', '10', '0');
INSERT INTO countries VALUES ('120', 'LBR', 'LR', 'Liberia', '17', '0');
INSERT INTO countries VALUES ('121', 'LBY', 'LY', 'Libya', '25', '0');
INSERT INTO countries VALUES ('122', 'LIE', 'LI', 'Liechtenstein', '13', '0');
INSERT INTO countries VALUES ('123', 'LTU', 'LT', 'Lithuania', '10', '0');
INSERT INTO countries VALUES ('124', 'LUX', 'LU', 'Luxembourg', '3', '0');
INSERT INTO countries VALUES ('125', 'MAC', 'MO', 'Macau', '2', '0');
INSERT INTO countries VALUES ('126', 'MKD', 'MK', 'Macedonia, The Former Yugoslav Republic of', '123', '0');
INSERT INTO countries VALUES ('127', 'MDG', 'MG', 'Madagascar', '6', '0');
INSERT INTO countries VALUES ('128', 'MWI', 'MW', 'Malawi', '27', '0');
INSERT INTO countries VALUES ('129', 'MYS', 'MY', 'Malaysia', '16', '0');
INSERT INTO countries VALUES ('130', 'MDV', 'MV', 'Maldives', '20', '0');
INSERT INTO countries VALUES ('131', 'MLI', 'ML', 'Mali', '9', '0');
INSERT INTO countries VALUES ('132', 'MLT', 'MT', 'Malta', '0', '0');
INSERT INTO countries VALUES ('133', 'MHL', 'MH', 'Marshall Islands', '0', '0');
INSERT INTO countries VALUES ('134', 'MTQ', 'MQ', 'Martinique', '0', '0');
INSERT INTO countries VALUES ('135', 'MRT', 'MR', 'Mauritania', '12', '0');
INSERT INTO countries VALUES ('136', 'MUS', 'MU', 'Mauritius', '12', '0');
INSERT INTO countries VALUES ('137', 'MYT', 'YT', 'Mayotte', '0', '0');
INSERT INTO countries VALUES ('138', 'MEX', 'MX', 'Mexico', '32', '0');
INSERT INTO countries VALUES ('139', 'FSM', 'FM', 'Micronesia, Federated States of', '4', '0');
INSERT INTO countries VALUES ('140', 'MDA', 'MD', 'Moldova, Republic of', '37', '0');
INSERT INTO countries VALUES ('141', 'MCO', 'MC', 'Monaco', '3', '0');
INSERT INTO countries VALUES ('142', 'MNG', 'MN', 'Mongolia', '24', '0');
INSERT INTO countries VALUES ('143', 'MSR', 'MS', 'Montserrat', '3', '0');
INSERT INTO countries VALUES ('144', 'MAR', 'MA', 'Morocco', '15', '0');
INSERT INTO countries VALUES ('145', 'MOZ', 'MZ', 'Mozambique', '11', '0');
INSERT INTO countries VALUES ('146', 'MMR', 'MM', 'Myanmar', '15', '0');
INSERT INTO countries VALUES ('147', 'NAM', 'NA', 'Namibia', '38', '0');
INSERT INTO countries VALUES ('148', 'NRU', 'NR', 'Nauru', '14', '0');
INSERT INTO countries VALUES ('149', 'NPL', 'NP', 'Nepal', '14', '0');
INSERT INTO countries VALUES ('150', 'NLD', 'NL', 'Netherlands', '12', '0');
INSERT INTO countries VALUES ('151', 'ANT', 'AN', 'Netherlands Antilles', '0', '0');
INSERT INTO countries VALUES ('152', 'NCL', 'NC', 'New Caledonia', '0', '0');
INSERT INTO countries VALUES ('153', 'NZL', 'NZ', 'New Zealand', '16', '0');
INSERT INTO countries VALUES ('154', 'NIC', 'NI', 'Nicaragua', '18', '0');
INSERT INTO countries VALUES ('155', 'NER', 'NE', 'Niger', '8', '0');
INSERT INTO countries VALUES ('156', 'NGA', 'NG', 'Nigeria', '37', '0');
INSERT INTO countries VALUES ('157', 'NIU', 'NU', 'Niue', '0', '0');
INSERT INTO countries VALUES ('158', 'NFK', 'NF', 'Norfolk Island', '0', '0');
INSERT INTO countries VALUES ('159', 'MNP', 'MP', 'Northern Mariana Islands', '0', '0');
INSERT INTO countries VALUES ('160', 'NOR', 'NO', 'Norway', '19', '0');
INSERT INTO countries VALUES ('161', 'OMN', 'OM', 'Oman', '8', '0');
INSERT INTO countries VALUES ('162', 'PAK', 'PK', 'Pakistan', '8', '0');
INSERT INTO countries VALUES ('163', 'PLW', 'PW', 'Palau', '0', '0');
INSERT INTO countries VALUES ('164', 'PAN', 'PA', 'Panama', '10', '0');
INSERT INTO countries VALUES ('165', 'PNG', 'PG', 'Papua New Guinea', '20', '0');
INSERT INTO countries VALUES ('166', 'PRY', 'PY', 'Paraguay', '20', '0');
INSERT INTO countries VALUES ('167', 'PER', 'PE', 'Peru', '25', '0');
INSERT INTO countries VALUES ('168', 'PHL', 'PH', 'Philippines', '149', '0');
INSERT INTO countries VALUES ('169', 'PCN', 'PN', 'Pitcairn', '0', '0');
INSERT INTO countries VALUES ('170', 'POL', 'PL', 'Poland', '16', '0');
INSERT INTO countries VALUES ('171', 'PRT', 'PT', 'Portugal', '20', '0');
INSERT INTO countries VALUES ('172', 'PRI', 'PR', 'Puerto Rico', '0', '0');
INSERT INTO countries VALUES ('173', 'QAT', 'QA', 'Qatar', '11', '0');
INSERT INTO countries VALUES ('174', 'REU', 'RE', 'Reunion', '0', '0');
INSERT INTO countries VALUES ('175', 'ROM', 'RO', 'Romania', '42', '0');
INSERT INTO countries VALUES ('176', 'RUS', 'RU', 'Russian Federation', '91', '0');
INSERT INTO countries VALUES ('177', 'RWA', 'RW', 'Rwanda', '9', '0');
INSERT INTO countries VALUES ('178', 'KNA', 'KN', 'Saint Kitts and Nevis', '14', '0');
INSERT INTO countries VALUES ('179', 'LCA', 'LC', 'Saint Lucia', '11', '0');
INSERT INTO countries VALUES ('180', 'VCT', 'VC', 'Saint Vincent and the Grenadines', '6', '0');
INSERT INTO countries VALUES ('181', 'WSM', 'WS', 'Samoa', '10', '0');
INSERT INTO countries VALUES ('182', 'SMR', 'SM', 'San Marino', '9', '0');
INSERT INTO countries VALUES ('183', 'STP', 'ST', 'Sao Tome and Principe', '2', '0');
INSERT INTO countries VALUES ('184', 'SAU', 'SA', 'Saudi Arabia', '13', '0');
INSERT INTO countries VALUES ('185', 'SEN', 'SN', 'Senegal', '11', '0');
INSERT INTO countries VALUES ('186', 'SYC', 'SC', 'Seychelles', '23', '0');
INSERT INTO countries VALUES ('187', 'SLE', 'SL', 'Sierra Leone', '4', '0');
INSERT INTO countries VALUES ('188', 'SGP', 'SG', 'Singapore', '0', '0');
INSERT INTO countries VALUES ('189', 'SVK', 'SK', 'Slovakia', '8', '0');
INSERT INTO countries VALUES ('190', 'SVN', 'SI', 'Slovenia', '195', '0');
INSERT INTO countries VALUES ('191', 'SLB', 'SB', 'Solomon Islands', '9', '0');
INSERT INTO countries VALUES ('192', 'SOM', 'SO', 'Somalia', '20', '0');
INSERT INTO countries VALUES ('193', 'ZAF', 'ZA', 'South Africa', '10', '0');
INSERT INTO countries VALUES ('194', 'SGS', 'GS', 'South Georgia and the South Sandwich Islands', '0', '0');
INSERT INTO countries VALUES ('195', 'ESP', 'ES', 'Spain', '17', '0');
INSERT INTO countries VALUES ('196', 'LKA', 'LK', 'Sri Lanka', '9', '0');
INSERT INTO countries VALUES ('197', 'SHN', 'SH', 'St. Helena', '3', '0');
INSERT INTO countries VALUES ('198', 'SPM', 'PM', 'St. Pierre and Miquelon', '0', '0');
INSERT INTO countries VALUES ('199', 'SDN', 'SD', 'Sudan', '15', '0');
INSERT INTO countries VALUES ('200', 'SUR', 'SR', 'Suriname', '10', '0');
INSERT INTO countries VALUES ('201', 'SJM', 'SJ', 'Svalbard and Jan Mayen Islands', '0', '0');
INSERT INTO countries VALUES ('202', 'SWZ', 'SZ', 'Swaziland', '5', '0');
INSERT INTO countries VALUES ('203', 'SWE', 'SE', 'Sweden', '21', '0');
INSERT INTO countries VALUES ('204', 'CHE', 'CH', 'Switzerland', '26', '0');
INSERT INTO countries VALUES ('205', 'SYR', 'SY', 'Syrian Arab Republic', '14', '0');
INSERT INTO countries VALUES ('206', 'TWN', 'TW', 'Taiwan', '4', '0');
INSERT INTO countries VALUES ('207', 'TJK', 'TJ', 'Tajikistan', '3', '0');
INSERT INTO countries VALUES ('208', 'TZA', 'TZ', 'Tanzania, United Republic of', '26', '0');
INSERT INTO countries VALUES ('209', 'THA', 'TH', 'Thailand', '80', '0');
INSERT INTO countries VALUES ('210', 'TGO', 'TG', 'Togo', '5', '0');
INSERT INTO countries VALUES ('211', 'TKL', 'TK', 'Tokelau', '0', '0');
INSERT INTO countries VALUES ('212', 'TON', 'TO', 'Tonga', '3', '0');
INSERT INTO countries VALUES ('213', 'TTO', 'TT', 'Trinidad and Tobago', '12', '0');
INSERT INTO countries VALUES ('214', 'TUN', 'TN', 'Tunisia', '24', '0');
INSERT INTO countries VALUES ('215', 'TUR', 'TR', 'Turkey', '81', '0');
INSERT INTO countries VALUES ('216', 'TKM', 'TM', 'Turkmenistan', '5', '0');
INSERT INTO countries VALUES ('217', 'TCA', 'TC', 'Turks and Caicos Islands', '0', '0');
INSERT INTO countries VALUES ('218', 'TUV', 'TV', 'Tuvalu', '0', '0');
INSERT INTO countries VALUES ('219', 'UGA', 'UG', 'Uganda', '55', '0');
INSERT INTO countries VALUES ('220', 'UKR', 'UA', 'Ukraine', '27', '0');
INSERT INTO countries VALUES ('221', 'ARE', 'AE', 'United Arab Emirates', '7', '0');
INSERT INTO countries VALUES ('222', 'GBR', 'GB', 'United Kingdom', '234', '0');
INSERT INTO countries VALUES ('223', 'USA', 'US', 'United States', '61', '1');
INSERT INTO countries VALUES ('224', 'UMI', 'UM', 'United States Minor Outlying Islands', '0', '0');
INSERT INTO countries VALUES ('225', 'URY', 'UY', 'Uruguay', '19', '0');
INSERT INTO countries VALUES ('226', 'UZB', 'UZ', 'Uzbekistan', '14', '0');
INSERT INTO countries VALUES ('227', 'VUT', 'VU', 'Vanuatu', '14', '0');
INSERT INTO countries VALUES ('228', 'VAT', 'VA', 'Vatican City State (Holy See)', '0', '0');
INSERT INTO countries VALUES ('229', 'VEN', 'VE', 'Venezuela', '25', '0');
INSERT INTO countries VALUES ('230', 'VNM', 'VN', 'Việt Nam', '65', '1');
INSERT INTO countries VALUES ('231', 'VGB', 'VG', 'Virgin Islands (British)', '0', '0');
INSERT INTO countries VALUES ('232', 'VIR', 'VI', 'Virgin Islands (U.S.)', '0', '0');
INSERT INTO countries VALUES ('233', 'WLF', 'WF', 'Wallis and Futuna Islands', '0', '0');
INSERT INTO countries VALUES ('234', 'ESH', 'EH', 'Western Sahara', '0', '0');
INSERT INTO countries VALUES ('235', 'YEM', 'YE', 'Yemen', '25', '0');
INSERT INTO countries VALUES ('237', 'DRC', 'DC', 'The Democratic Republic of Congo', '0', '0');
INSERT INTO countries VALUES ('238', 'ZMB', 'ZM', 'Zambia', '9', '0');
INSERT INTO countries VALUES ('239', 'ZWE', 'ZW', 'Zimbabwe', '10', '0');
INSERT INTO countries VALUES ('240', 'XET', 'XE', 'East Timor', '0', '0');
INSERT INTO countries VALUES ('241', 'JEY', 'JE', 'Jersey', '0', '0');
INSERT INTO countries VALUES ('242', 'XSB', 'XB', 'St. Barthelemy', '0', '0');
INSERT INTO countries VALUES ('243', 'XSE', 'XU', 'St. Eustatius', '0', '0');
INSERT INTO countries VALUES ('244', 'XCA', 'XC', 'Canary Islands', '0', '0');
INSERT INTO countries VALUES ('245', 'SRB', 'RS', 'Serbia', '2', '0');
INSERT INTO countries VALUES ('246', 'MAF', 'MF', 'Sint Maarten (French Antilles)', '0', '0');
INSERT INTO countries VALUES ('247', 'SXM', 'SX', 'Sint Maarten (Netherlands Antilles)', '0', '0');
INSERT INTO countries VALUES ('248', 'PSE', 'FS', 'Palestinian Territory, occupied', '2', '0');

-- ----------------------------
-- Table structure for `coupons`
-- ----------------------------
DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `global_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `order` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=180 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of coupons
-- ----------------------------

-- ----------------------------
-- Table structure for `coupon_contents`
-- ----------------------------
DROP TABLE IF EXISTS `coupon_contents`;
CREATE TABLE `coupon_contents` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `coupon_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `value` double NOT NULL DEFAULT '0',
  `total_quantity` int(10) NOT NULL DEFAULT '0',
  `total_used` int(10) NOT NULL DEFAULT '0',
  `apply_for_min_price` double NOT NULL DEFAULT '0',
  `thumbnail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `expired_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=207 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of coupon_contents
-- ----------------------------

-- ----------------------------
-- Table structure for `field_groups`
-- ----------------------------
DROP TABLE IF EXISTS `field_groups`;
CREATE TABLE `field_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `position` int(11) DEFAULT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `field_rules` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `admin_user_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of field_groups
-- ----------------------------
INSERT INTO field_groups VALUES ('5', null, 'Documentation redirect', '[{\"field_relation\":\"and\",\"field_options\":[{\"rel_name\":\"page_template\",\"rel_value\":\"Documentation\",\"rel_type\":\"==\"}]}]', null, '1', '2016-04-18 14:18:24', '2016-04-18 14:33:38');
INSERT INTO field_groups VALUES ('4', null, 'Homepage custom fields', '[{\"field_relation\":\"and\",\"field_options\":[{\"rel_name\":\"page_template\",\"rel_value\":\"Homepage\",\"rel_type\":\"==\"}]}]', null, '1', '2016-04-17 00:47:49', '2016-04-17 00:52:37');

-- ----------------------------
-- Table structure for `field_items`
-- ----------------------------
DROP TABLE IF EXISTS `field_items`;
CREATE TABLE `field_items` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `field_group_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `field_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `instructions` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `options` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of field_items
-- ----------------------------
INSERT INTO field_items VALUES ('9', '4', '8', '1', 'Background color', '9_background_color', 'text', 'Background color for this section', '{\"defaultvalue\":\"transparent\",\"placeholdertext\":\"\",\"defaultvaluetextarea\":\"\",\"wyswygtoolbar\":\"\",\"selectchoices\":\"\",\"buttonlabel\":\"\"}');
INSERT INTO field_items VALUES ('8', '4', '0', '1', 'Sections', '8_sections', 'repeater', 'All sections of homepage.', '{\"defaultvalue\":\"\",\"placeholdertext\":\"\",\"defaultvaluetextarea\":\"\",\"wyswygtoolbar\":\"\",\"selectchoices\":\"\",\"buttonlabel\":\"Add new section\"}');
INSERT INTO field_items VALUES ('10', '4', '8', '2', 'Section content', '10_section_content', 'wyswyg', 'Content of this section', '{\"defaultvalue\":\"\",\"placeholdertext\":\"\",\"defaultvaluetextarea\":\"\",\"wyswygtoolbar\":\"full\",\"selectchoices\":\"\",\"buttonlabel\":\"\"}');
INSERT INTO field_items VALUES ('11', '4', '8', '3', 'Section image', '11_section_image', 'image', 'Image of this section', '{\"defaultvalue\":\"\",\"placeholdertext\":\"\",\"defaultvaluetextarea\":\"\",\"wyswygtoolbar\":\"\",\"selectchoices\":\"\",\"buttonlabel\":\"\"}');
INSERT INTO field_items VALUES ('12', '5', '0', '1', 'Redirect to', '12_redirect_to', 'text', 'When user access this page, redirect to this link', '{\"defaultvalue\":\"\",\"placeholdertext\":\"\",\"defaultvaluetextarea\":\"\",\"wyswygtoolbar\":\"\",\"selectchoices\":\"\",\"buttonlabel\":\"\"}');

-- ----------------------------
-- Table structure for `languages`
-- ----------------------------
DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language_code` varchar(7) NOT NULL,
  `language_name` varchar(128) NOT NULL,
  `major` tinyint(4) NOT NULL DEFAULT '0',
  `default_locale` varchar(8) DEFAULT NULL,
  `tag` varchar(8) DEFAULT NULL,
  `currency` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`language_code`),
  UNIQUE KEY `english_name` (`language_name`)
) ENGINE=MyISAM AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of languages
-- ----------------------------
INSERT INTO languages VALUES ('1', 'en', 'English', '1', 'en_US', 'en-US', 'USD', '1', '0000-00-00 00:00:00', '2015-12-11 08:17:35');
INSERT INTO languages VALUES ('2', 'es', 'Spanish', '1', 'es_ES', 'es-ES', '', '0', '0000-00-00 00:00:00', '2016-01-22 17:06:58');
INSERT INTO languages VALUES ('3', 'de', 'German', '1', 'de_DE', 'de-DE', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('4', 'fr', 'French', '1', 'fr_FR', 'fr-FR', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:36');
INSERT INTO languages VALUES ('5', 'ar', 'Arabic', '0', 'ar', 'ar', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('6', 'bs', 'Bosnian', '0', 'bs', '', '', '0', '0000-00-00 00:00:00', '2016-01-21 04:39:39');
INSERT INTO languages VALUES ('7', 'bg', 'Bulgarian', '0', 'bg_BG', 'bg-BG', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('8', 'ca', 'Catalan', '0', 'ca', 'ca', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('9', 'cs', 'Czech', '0', 'cs_CZ', 'cs-CZ', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('10', 'sk', 'Slovak', '0', 'sk_SK', 'sk-SK', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('11', 'cy', 'Welsh', '0', 'cy', 'cy', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('12', 'da', 'Danish', '1', 'da_DK', 'da-DK', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('13', 'el', 'Greek', '0', 'el', 'el', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('14', 'eo', 'Esperanto', '0', 'eo', 'eo', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('15', 'et', 'Estonian', '0', 'et', 'et', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('16', 'eu', 'Basque', '0', 'eu', 'eu', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('17', 'fa', 'Persian', '0', 'fa_IR', 'fa-IR', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('18', 'fi', 'Finnish', '0', 'fi', 'fi', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('19', 'ga', 'Irish', '0', '', '', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('20', 'he', 'Hebrew', '0', 'he_IL', 'he-IL', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('21', 'hi', 'Hindi', '0', '', '', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('22', 'hr', 'Croatian', '0', 'hr', 'hr', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('23', 'hu', 'Hungarian', '0', 'hu_HU', 'hu-HU', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('24', 'hy', 'Armenian', '0', '', '', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('25', 'id', 'Indonesian', '0', 'id_ID', 'id-ID', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('26', 'is', 'Icelandic', '0', 'is_IS', 'is-IS', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('27', 'it', 'Italian', '1', 'it_IT', 'it-IT', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('28', 'ja', 'Japanese', '1', 'ja', 'ja', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('29', 'ko', 'Korean', '0', 'ko_KR', 'ko-KR', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('30', 'ku', 'Kurdish', '0', 'ku', 'ku', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('31', 'la', 'Latin', '0', '', '', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('32', 'lv', 'Latvian', '0', 'lv', 'lv', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('33', 'lt', 'Lithuanian', '0', 'lt', 'lt', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('34', 'mk', 'Macedonian', '0', 'mk_MK', 'mk-MK', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('35', 'mt', 'Maltese', '0', '', '', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('36', 'mo', 'Moldavian', '0', '', '', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('37', 'mn', 'Mongolian', '0', '', '', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('38', 'ne', 'Nepali', '0', '', '', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('39', 'nl', 'Dutch', '1', 'nl_NL', 'nl-NL', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('40', 'nb', 'Norwegian Bokmål', '0', 'nb_NO', 'nb-NO', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('41', 'pa', 'Punjabi', '0', '', '', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('42', 'pl', 'Polish', '0', 'pl_PL', 'pl-PL', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('43', 'pt-pt', 'Portuguese, Portugal', '0', 'pt_PT', 'pt-PT', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('44', 'pt-br', 'Portuguese, Brazil', '0', 'pt_BR', 'pt-BR', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('45', 'qu', 'Quechua', '0', '', '', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('46', 'ro', 'Romanian', '0', 'ro_RO', 'ro-RO', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('47', 'ru', 'Russian', '1', 'ru_RU', 'ru-RU', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('48', 'sl', 'Slovenian', '0', 'sl_SI', 'sl-SI', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('49', 'so', 'Somali', '0', '', '', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('50', 'sq', 'Albanian', '0', '', '', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('51', 'sr', 'Serbian', '0', 'sr_RS', 'sr-RS', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('52', 'sv', 'Swedish', '0', 'sv_SE', 'sv-SE', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('53', 'ta', 'Tamil', '0', '', '', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('54', 'th', 'Thai', '0', 'th', 'th', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('55', 'tr', 'Turkish', '0', 'tr', 'tr', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('56', 'uk', 'Ukrainian', '0', 'uk_UA', 'uk-UA', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('57', 'ur', 'Urdu', '0', '', '', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('58', 'uz', 'Uzbek', '0', 'uz_UZ', 'uz-UZ', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('59', 'vi', 'Vietnamese', '0', 'vi_VN', 'vi-vn', 'VND', '1', '0000-00-00 00:00:00', '2016-01-21 04:46:42');
INSERT INTO languages VALUES ('60', 'yi', 'Yiddish', '0', '', '', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('61', 'zh-hans', 'Chinese (Simplified)', '1', 'zh_CN', 'zh-CN', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('62', 'zu', 'Zulu', '0', '', '', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('63', 'zh-hant', 'Chinese (Traditional)', '1', 'zh_TW', 'zh-TW', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');
INSERT INTO languages VALUES ('64', 'ms', 'Malay', '0', 'ms_MY', 'ms-MY', '', '0', '0000-00-00 00:00:00', '2015-09-13 02:03:00');

-- ----------------------------
-- Table structure for `menus`
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO menus VALUES ('2', 'Admin menu', 'admin-menu', '1', '2014-10-25 01:26:30', '2016-01-11 09:59:26');
INSERT INTO menus VALUES ('3', 'Main menu', 'main-menu', '1', '2015-05-17 21:14:02', '2015-05-17 21:14:02');
INSERT INTO menus VALUES ('4', 'Footer menu', 'footer-menu', '1', '2015-05-30 19:40:39', '2015-05-30 19:40:39');

-- ----------------------------
-- Table structure for `menu_nodes`
-- ----------------------------
DROP TABLE IF EXISTS `menu_nodes`;
CREATE TABLE `menu_nodes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `related_id` int(11) DEFAULT NULL,
  `type` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `icon_font` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `css_class` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=450 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of menu_nodes
-- ----------------------------
INSERT INTO menu_nodes VALUES ('272', '2', '0', '0', 'custom-link', 'dashboard', 'fa fa-home', '0', 'Dashboard', 'start', '2015-01-09 07:34:11', '2015-01-26 15:08:30');
INSERT INTO menu_nodes VALUES ('273', '2', '301', '0', 'custom-link', 'categories', 'fa fa-sitemap', '1', 'Post Categories', '', '2015-01-09 07:34:11', '2016-01-18 03:43:37');
INSERT INTO menu_nodes VALUES ('280', '2', '403', '0', 'custom-link', 'custom-fields', 'fa fa-edit', '2', 'Custom fields', '', '2015-01-09 07:34:11', '2016-01-21 04:16:51');
INSERT INTO menu_nodes VALUES ('283', '2', '0', '0', 'custom-link', 'pages', 'fa fa-tasks', '3', 'Pages', '', '2015-01-09 07:34:11', '2015-12-22 11:30:12');
INSERT INTO menu_nodes VALUES ('291', '2', '403', '0', 'custom-link', 'settings', 'fa fa-gear', '1', 'Options', '', '2015-01-09 07:34:11', '2016-01-20 09:45:17');
INSERT INTO menu_nodes VALUES ('297', '2', '403', '0', 'custom-link', 'menus', 'fa fa-bars', '0', 'Menus', '', '2015-01-09 07:34:11', '2015-12-22 11:30:12');
INSERT INTO menu_nodes VALUES ('300', '2', '301', '0', 'custom-link', 'posts', 'icon-layers', '0', 'Posts', '', '2015-03-14 16:47:08', '2016-01-18 03:43:37');
INSERT INTO menu_nodes VALUES ('301', '2', '0', '0', 'custom-link', 'post', 'icon-layers', '1', 'Posts', '', '2015-03-14 16:47:08', '2015-12-22 09:48:57');
INSERT INTO menu_nodes VALUES ('331', '2', '414', '0', 'custom-link', 'products', 'fa fa-cubes', '0', 'Products', '', '2015-04-02 15:54:31', '2016-01-18 12:22:11');
INSERT INTO menu_nodes VALUES ('332', '2', '414', '0', 'custom-link', 'product-categories', 'fa fa-sitemap', '1', 'Product categories', '', '2015-04-02 15:54:31', '2016-01-18 12:22:11');
INSERT INTO menu_nodes VALUES ('403', '2', '0', '0', 'custom-link', 'settings', 'fa fa-cogs', '5', 'Settings', '', '2015-09-13 01:22:25', '2016-01-20 09:45:17');
INSERT INTO menu_nodes VALUES ('414', '2', '0', '0', 'custom-link', 'orders', 'fa fa-shopping-cart', '2', 'Ecommerce', '', '2016-01-15 07:12:15', '2016-01-18 12:22:11');
INSERT INTO menu_nodes VALUES ('415', '2', '438', '0', 'custom-link', 'admin-users', 'icon-users', '1', 'Admin users', '', '2016-01-19 06:50:46', '2016-01-24 14:05:00');
INSERT INTO menu_nodes VALUES ('416', '2', '403', '0', 'custom-link', 'settings/languages', 'fa fa-language', '3', 'Languages', '', '2016-01-21 02:10:32', '2016-01-21 04:16:51');
INSERT INTO menu_nodes VALUES ('436', '3', '0', '2', 'page', '', '', '2', '', '', '2016-01-22 17:45:39', '2016-04-17 00:46:01');
INSERT INTO menu_nodes VALUES ('437', '2', '403', '0', 'custom-link', 'countries-cities', 'fa fa-building', '4', 'Countries/Cities', '', '2016-01-24 06:24:54', '2016-01-24 06:24:54');
INSERT INTO menu_nodes VALUES ('438', '2', '0', '0', 'custom-link', 'users', 'icon-users', '4', 'Users', '', '2016-01-24 14:05:00', '2016-01-24 14:05:00');
INSERT INTO menu_nodes VALUES ('439', '2', '438', '0', 'custom-link', 'users', 'icon-users', '0', 'Users', '', '2016-01-24 14:05:00', '2016-01-24 14:05:00');
INSERT INTO menu_nodes VALUES ('440', '2', '414', '0', 'custom-link', 'coupons', 'fa fa-code', '2', 'Coupons/Giftcards', '', '2016-01-27 09:23:56', '2016-01-27 09:23:56');
INSERT INTO menu_nodes VALUES ('441', '2', '0', '0', 'custom-link', 'contacts', 'fa fa-suitcase', '6', 'Feedbacks', '', '2016-01-28 10:14:54', '2016-04-18 12:56:31');
INSERT INTO menu_nodes VALUES ('445', '3', '0', '4', 'category', '', '', '1', '', '', '2016-01-28 14:07:07', '2016-04-17 00:46:01');
INSERT INTO menu_nodes VALUES ('448', '3', '0', '5', 'category', '', '', '3', '', '', '2016-04-16 01:00:42', '2016-04-17 00:46:01');
INSERT INTO menu_nodes VALUES ('449', '3', '0', '3', 'page', '', '', '0', '', '', '2016-04-17 00:46:01', '2016-04-17 00:46:01');

-- ----------------------------
-- Table structure for `pages`
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `global_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_template` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `order` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of pages
-- ----------------------------
INSERT INTO pages VALUES ('1', 'Homepage', 'Homepage', '1', '1', '0', '2016-01-16 11:13:19', '2016-04-18 10:32:25');
INSERT INTO pages VALUES ('2', 'Contact us', 'Contact Us', '1', '3', '0', '2016-01-22 17:45:22', '2016-04-18 10:32:32');
INSERT INTO pages VALUES ('3', 'Documentation', 'Documentation', '1', '2', '0', '2016-04-17 00:45:46', '2016-04-18 14:33:48');

-- ----------------------------
-- Table structure for `page_contents`
-- ----------------------------
DROP TABLE IF EXISTS `page_contents`;
CREATE TABLE `page_contents` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '59',
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `thumbnail` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `tags` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of page_contents
-- ----------------------------
INSERT INTO page_contents VALUES ('1', '1', '59', 'Trang chủ', 'trang-chu', '', '<h1>Bạn y&ecirc;u th&iacute;ch Laravel v&agrave; muốn c&oacute; một trang web?<br />\r\nT&ocirc;i l&agrave;m cho bạn.</h1>\r\n\r\n<h3>LaraWebEd - một hệ thống quản trị nội dung (CMS) x&acirc;y dựng tr&ecirc;n Laravel.</h3>\r\n\r\n<p><img alt=\"LaraWebEd\" class=\"img-responsive middle-auto\" src=\"/uploads/website-development.png\" /></p>\r\n\r\n<h2>Tại sao n&ecirc;n sử dụng LaraWebEd?</h2>\r\n', '1', '', 'Site Vui,Một người khỏe hai người vui,Ôi vui quá xá là vui', '0', '2016-01-16 11:13:19', '2016-04-17 01:21:39');
INSERT INTO page_contents VALUES ('2', '1', '1', 'Homepage', 'homepage', '', '<h1>Love Laravel and wanna have a website?<br />\r\nI do it for you.</h1>\r\n\r\n<h3>LaraWebEd - A CMS built on Laravel</h3>\r\n\r\n<p><img alt=\"\" class=\"img-responsive middle-auto\" src=\"/uploads/website-development.png\" /></p>\r\n\r\n<h2>Why LaraWebEd?</h2>\r\n', '1', '', '', '0', '2016-01-20 10:37:36', '2016-04-17 01:05:57');
INSERT INTO page_contents VALUES ('3', '2', '59', 'Liên hệ', 'lien-he', '', '', '1', '', '', '0', '2016-01-22 17:45:22', '2016-01-22 17:45:22');
INSERT INTO page_contents VALUES ('6', '2', '1', 'Contact us', 'contact-us', '', '', '1', '', '', '1', '2016-04-16 01:03:07', '2016-04-16 01:04:54');
INSERT INTO page_contents VALUES ('7', '3', '1', 'Documentation', 'documentation', '', '', '1', '', '', '0', '2016-04-17 00:45:46', '2016-04-17 00:45:46');

-- ----------------------------
-- Table structure for `page_metas`
-- ----------------------------
DROP TABLE IF EXISTS `page_metas`;
CREATE TABLE `page_metas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int(11) DEFAULT NULL,
  `meta_key` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_value` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of page_metas
-- ----------------------------
INSERT INTO page_metas VALUES ('4', '2', '8_sections', '[[{\"field_value\":\"#f4645f\",\"field_type\":\"text\",\"slug\":\"9_background_color\"},{\"field_value\":\"<p><strong>Built on Laravel<\\/strong><\\/p>\\n\\n<p>&nbsp;<\\/p>\\n\\n<p>the most popular PHP framework since 2013.<\\/p>\\n\\n<p>&nbsp;<\\/p>\\n\",\"field_type\":\"wyswyg\",\"slug\":\"10_section_content\"},{\"field_value\":\"\\/uploads\\/Laravel-5.png\",\"field_type\":\"image\",\"slug\":\"11_section_image\"}],[{\"field_value\":\"transparent\",\"field_type\":\"text\",\"slug\":\"9_background_color\"},{\"field_value\":\"<p><strong>Over 8,500 packages<\\/strong><\\/p>\\n\\n<p>&nbsp;<\\/p>\\n\\n<p>Simple and social packages registry for Laravel. Discover packages, ask for packages and learn how to create your own packages for Laravel.<\\/p>\\n\\n<p>&nbsp;<\\/p>\\n\\n<p><a href=\\\"http:\\/\\/packalyst.com\\/\\\">packalyst.com<\\/a><\\/p>\\n\",\"field_type\":\"wyswyg\",\"slug\":\"10_section_content\"},{\"field_value\":\"\\/uploads\\/laravel-packages.png\",\"field_type\":\"image\",\"slug\":\"11_section_image\"}],[{\"field_value\":\"#e1bc51\",\"field_type\":\"text\",\"slug\":\"9_background_color\"},{\"field_value\":\"<p><strong>Modern admin dashboard<\\/strong><\\/p>\\n\\n<p>&nbsp;<\\/p>\\n\\n<p>I use Metronic Admin Theme - the most popular admin theme in <a href=\\\"http:\\/\\/themeforest.net\\/item\\/metronic-responsive-admin-dashboard-template\\/4021469\\\">themeforest.net<\\/a> for admin dashboard.<\\/p>\\n\\n<p>&nbsp;<\\/p>\\n\\n<p>If you have condition, please <a href=\\\"http:\\/\\/themeforest.net\\/item\\/metronic-responsive-admin-dashboard-template\\/4021469\\\">buy<\\/a> this theme to donate for artists.<\\/p>\\n\",\"field_type\":\"wyswyg\",\"slug\":\"10_section_content\"},{\"field_value\":\"\\/uploads\\/metronic-admin-theme.jpg\",\"field_type\":\"image\",\"slug\":\"11_section_image\"}],[{\"field_value\":\"transparent\",\"field_type\":\"text\",\"slug\":\"9_background_color\"},{\"field_value\":\"<p><strong>Top features<\\/strong><\\/p>\\n\\n<p>&nbsp;<\\/p>\\n\\n<ul>\\n\\t<li>Support multi languages, easy to CRUD new languages.<\\/li>\\n\\t<li>Users management.<\\/li>\\n\\t<li>Pages management, with multi page templates.<\\/li>\\n\\t<li>Posts, categories management.<\\/li>\\n\\t<li>Products, product categories management.<\\/li>\\n\\t<li>Support custom fields for pages, posts, categories, products, product categories.<\\/li>\\n\\t<li>Menus management, support drag &amp; drop.<\\/li>\\n\\t<li>Feedbacks management.<\\/li>\\n<\\/ul>\\n\\n<p>&nbsp;<\\/p>\\n\",\"field_type\":\"wyswyg\",\"slug\":\"10_section_content\"},{\"field_value\":\"\\/uploads\\/website-features.png\",\"field_type\":\"image\",\"slug\":\"11_section_image\"}],[{\"field_value\":\"#c18994\",\"field_type\":\"text\",\"slug\":\"9_background_color\"},{\"field_value\":\"<p><strong>Feedback<\\/strong><\\/p>\\n\\n<p>&nbsp;<\\/p>\\n\\n<p>Thank you for using LaraWebEd. I value your comments and appreciate your time in sending them to me to make LaraWebEd become better.<\\/p>\\n\\n<p>&nbsp;<\\/p>\\n\\n<p>Contact me via:<\\/p>\\n\\n<p>&nbsp;<\\/p>\\n\\n<ul>\\n\\t<li>Skype: tedozi.manson<\\/li>\\n\\t<li>Email: duyphan.developer@gmail.com<\\/li>\\n\\t<li>Facebook: <a href=\\\"https:\\/\\/www.facebook.com\\/tedozi.manson\\\">link<\\/a><\\/li>\\n<\\/ul>\\n\\n<p>&nbsp;<\\/p>\\n\",\"field_type\":\"wyswyg\",\"slug\":\"10_section_content\"},{\"field_value\":\"\\/uploads\\/feedback.png\",\"field_type\":\"image\",\"slug\":\"11_section_image\"}]]');
INSERT INTO page_metas VALUES ('5', '1', '8_sections', '[[{\"field_value\":\"#f4645f\",\"field_type\":\"text\",\"slug\":\"9_background_color\"},{\"field_value\":\"<p><strong>\\u0110\\u01b0\\u1ee3c&nbsp;x&acirc;y d\\u1ef1ng tr&ecirc;n&nbsp;Laravel<\\/strong><\\/p>\\n\\n<p>&nbsp;<\\/p>\\n\\n<p>framework PHP n\\u1ed5i ti\\u1ebfng nh\\u1ea5t t\\u1eeb n\\u0103m 2013 \\u0111\\u1ebfn&nbsp;nay.<\\/p>\\n\",\"field_type\":\"wyswyg\",\"slug\":\"10_section_content\"},{\"field_value\":\"\\/uploads\\/Laravel-5.png\",\"field_type\":\"image\",\"slug\":\"11_section_image\"}],[{\"field_value\":\"transparent\",\"field_type\":\"text\",\"slug\":\"9_background_color\"},{\"field_value\":\"<p><strong>V\\u1edbi h\\u01a1n&nbsp;8,500 g&oacute;i m\\u1edf r\\u1ed9ng<\\/strong><\\/p>\\n\\n<p>&nbsp;<\\/p>\\n\\n<p>D\\u1ec5 d&agrave;ng t&iacute;ch h\\u1ee3p c&aacute;c g&oacute;i m\\u1edf r\\u1ed9ng v&agrave;o&nbsp;Laravel. Kh&aacute;m ph&aacute; c&aacute;c g&oacute;i m\\u1edf r\\u1ed9ng, \\u0111\\u1eb7t y&ecirc;u c\\u1ea7u m\\u1edbi&nbsp;v&agrave; h\\u1ecdc c&aacute;ch t\\u1ea1o m\\u1ed9t g&oacute;i m\\u1edf r\\u1ed9ng c\\u1ee7a ri&ecirc;ng b\\u1ea1n cho d\\u1ef1 &aacute;n&nbsp;Laravel.<\\/p>\\n\\n<p>&nbsp;<\\/p>\\n\\n<p><a href=\\\"http:\\/\\/packalyst.com\\/\\\">packalyst.com<\\/a><\\/p>\\n\",\"field_type\":\"wyswyg\",\"slug\":\"10_section_content\"},{\"field_value\":\"\\/uploads\\/laravel-packages.png\",\"field_type\":\"image\",\"slug\":\"11_section_image\"}],[{\"field_value\":\"#e1bc51\",\"field_type\":\"text\",\"slug\":\"9_background_color\"},{\"field_value\":\"<p><strong>Ph\\u1ea7n qu\\u1ea3n l&yacute; admin v\\u1edbi giao di\\u1ec7n hi\\u1ec7n \\u0111\\u1ea1i<\\/strong><\\/p>\\n\\n<p>&nbsp;<\\/p>\\n\\n<p>T&ocirc;i s\\u1eed d\\u1ee5ng giao di\\u1ec7n Metronic&nbsp;- m\\u1ed9t giao di\\u1ec7n n\\u1ed5i ti\\u1ebfng nh\\u1ea5t tr&ecirc;n&nbsp;<a href=\\\"http:\\/\\/themeforest.net\\/item\\/metronic-responsive-admin-dashboard-template\\/4021469\\\">themeforest.net<\\/a>.<\\/p>\\n\\n<p>&nbsp;<\\/p>\\n\\n<p>N\\u1ebfu c&oacute; \\u0111i\\u1ec1u ki\\u1ec7n, vui l&ograve;ng&nbsp;<a href=\\\"http:\\/\\/themeforest.net\\/item\\/metronic-responsive-admin-dashboard-template\\/4021469\\\">mua<\\/a>&nbsp;giao di\\u1ec7n n&agrave;y \\u0111\\u1ec3 \\u1ee7ng h\\u1ed9 cho t&aacute;c gi\\u1ea3 =)).<\\/p>\\n\",\"field_type\":\"wyswyg\",\"slug\":\"10_section_content\"},{\"field_value\":\"\\/uploads\\/metronic-admin-theme.jpg\",\"field_type\":\"image\",\"slug\":\"11_section_image\"}],[{\"field_value\":\"transparent\",\"field_type\":\"text\",\"slug\":\"9_background_color\"},{\"field_value\":\"<p><strong>Ch\\u1ee9c n\\u0103ng ch&iacute;nh<\\/strong><\\/p>\\n\\n<p>&nbsp;<\\/p>\\n\\n<ul>\\n\\t<li>H\\u1ed7 tr\\u1ee3 \\u0111a ng&ocirc;n ng\\u1eef, d\\u1ec5 d&agrave;ng th&ecirc;m ng&ocirc;n ng\\u1eef m\\u1edbi.<\\/li>\\n\\t<li>Qu\\u1ea3n l&yacute; users.<\\/li>\\n\\t<li>Qu\\u1ea3n l&yacute; pages, h\\u1ed7 tr\\u1ee3 page templates.<\\/li>\\n\\t<li>Qu\\u1ea3n l&yacute; b&agrave;i vi\\u1ebft v&agrave; danh m\\u1ee5c.<\\/li>\\n\\t<li>Qu\\u1ea3n l&yacute; s\\u1ea3n ph\\u1ea9m, danh m\\u1ee5c s\\u1ea3n ph\\u1ea9m.<\\/li>\\n\\t<li>H\\u1ed7 tr\\u1ee3 vi\\u1ec7c th&ecirc;m c&aacute;c n\\u1ed9i dung \\u0111\\u1eb7c th&ugrave; cho t\\u1eebng trang.<\\/li>\\n\\t<li>Qu\\u1ea3n l&yacute; menu, h\\u1ed7 tr\\u1ee3 k&eacute;o th\\u1ea3.<\\/li>\\n\\t<li>Qu\\u1ea3n l&yacute; c&aacute;c ph\\u1ea3n h\\u1ed3i t\\u1eeb kh&aacute;ch h&agrave;ng.<\\/li>\\n<\\/ul>\\n\",\"field_type\":\"wyswyg\",\"slug\":\"10_section_content\"},{\"field_value\":\"\\/uploads\\/website-features.png\",\"field_type\":\"image\",\"slug\":\"11_section_image\"}],[{\"field_value\":\"#c18994\",\"field_type\":\"text\",\"slug\":\"9_background_color\"},{\"field_value\":\"<p><strong>Ph\\u1ea3n h\\u1ed3i<\\/strong><\\/p>\\n\\n<p>&nbsp;<\\/p>\\n\\n<p>C&aacute;m \\u01a1n v&igrave; b\\u1ea1n \\u0111&atilde; ch\\u1ecdn s\\u1eed d\\u1ee5ng&nbsp;LaraWebEd. T&ocirc;i r\\u1ea5t vui v&agrave; c\\u1ea3m k&iacute;ch khi b\\u1ea1n d&agrave;nh th\\u1eddi gian \\u0111&aacute;nh gi&aacute; v&agrave; ph\\u1ea3n h\\u1ed3i v\\u1ec1&nbsp;LaraWebEd \\u0111\\u1ec3 l&agrave;m n&oacute; t\\u1ed1t h\\u01a1n.<\\/p>\\n\\n<p>&nbsp;<\\/p>\\n\\n<p>Li&ecirc;n h\\u1ec7 v\\u1edbi t&ocirc;i qua:<\\/p>\\n\\n<p>&nbsp;<\\/p>\\n\\n<ul>\\n\\t<li>Skype: tedozi.manson<\\/li>\\n\\t<li>Email: duyphan.developer@gmail.com<\\/li>\\n\\t<li>Facebook: <a href=\\\"https:\\/\\/www.facebook.com\\/tedozi.manson\\\">li&ecirc;n k\\u1ebft<\\/a><\\/li>\\n<\\/ul>\\n\",\"field_type\":\"wyswyg\",\"slug\":\"10_section_content\"},{\"field_value\":\"\\/uploads\\/feedback.png\",\"field_type\":\"image\",\"slug\":\"11_section_image\"}]]');
INSERT INTO page_metas VALUES ('6', '7', '12_redirect_to', '/en/post/installation');

-- ----------------------------
-- Table structure for `posts`
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `global_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `order` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=209 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO posts VALUES ('201', 'Installation', '1', '0', '1', '2016-04-18 13:48:35', '2016-04-21 21:57:16');
INSERT INTO posts VALUES ('202', 'Variables extended in controllers', '1', '0', '1', '2016-04-19 21:55:52', '2016-04-19 23:01:40');
INSERT INTO posts VALUES ('203', 'Variables extended in views', '1', '0', '1', '2016-04-20 00:08:17', '2016-04-20 00:24:18');
INSERT INTO posts VALUES ('204', 'Configuration', '1', '0', '1', '2016-04-21 19:28:13', '2016-04-21 19:28:13');
INSERT INTO posts VALUES ('205', 'Global functions of models', '1', '0', '1', '2016-04-21 21:22:07', '2016-04-21 22:49:43');
INSERT INTO posts VALUES ('206', 'Properties must have', '1', '0', '1', '2016-04-22 22:06:31', '2016-04-22 22:16:34');
INSERT INTO posts VALUES ('207', 'Page model', '1', '0', '1', '2016-04-23 00:52:29', '2016-04-23 01:21:22');
INSERT INTO posts VALUES ('208', 'Structure of application', '1', '0', '1', '2016-04-23 00:56:34', '2016-04-23 00:56:34');

-- ----------------------------
-- Table structure for `post_contents`
-- ----------------------------
DROP TABLE IF EXISTS `post_contents`;
CREATE TABLE `post_contents` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '59',
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `thumbnail` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `tags` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=213 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of post_contents
-- ----------------------------
INSERT INTO post_contents VALUES ('206', '202', '1', 'Variables extended in controllers', 'variables-extended-in-controllers', '', '<p><strong>These variables can be access from controllers</strong>:</p>\r\n\r\n<h3>Extended from <code>app/Http/Controllers/BaseController.php</code></h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>- The admin route friendly slug:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>$this-&gt;adminCpAccess</blockquote>\r\n\r\n<p><strong>- All CMS settings:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>$this-&gt;CMSSettings</blockquote>\r\n\r\n<p><strong>- Languages:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>$this-&gt;activatedLanguages<br />\r\n$this-&gt;defaultLanguage<br />\r\n$this-&gt;defaultLanguageId<br />\r\n$this-&gt;currentLanguage<br />\r\n$this-&gt;currentLanguageId<br />\r\n$this-&gt;currentLanguageCode</blockquote>\r\n\r\n<p><strong>- User:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>$this-&gt;loggedInUser<br />\r\n$this-&gt;loggedInAdminUser<br />\r\n$this-&gt;loggedInAdminUserRole</blockquote>\r\n\r\n<p><strong>- Handle flash messages:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>$this-&gt;errorMessages<br />\r\n$this-&gt;infoMessages<br />\r\n$this-&gt;successMessages<br />\r\n$this-&gt;warningMessages</p>\r\n</blockquote>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>&nbsp;Extended from <code>app/Http/Controllers/Front/BaseFrontController.php</code></h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>- CSS class for body tag:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>$this-&gt;bodyClass</p>\r\n</blockquote>\r\n', '1', '', '', '0', '2016-04-19 21:55:53', '2016-04-21 19:17:16');
INSERT INTO post_contents VALUES ('207', '203', '1', 'Variables extended in views', 'variables-extended-in-views', '', '<p><strong>These variables can be access from views</strong>:</p>\r\n\r\n<h3>Extended from <code>app/Http/Controllers/BaseController.php</code></h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>- The admin route friendly slug:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>$adminCpAccess</blockquote>\r\n\r\n<p><strong>- All CMS settings:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>$CMSSettings</blockquote>\r\n\r\n<p><strong>- Languages:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>$activatedLanguages<br />\r\n$defaultLanguage<br />\r\n$defaultLanguageId<br />\r\n$currentLanguage<br />\r\n$currentLanguageId<br />\r\n$currentLanguageCode</blockquote>\r\n\r\n<p><strong>- User:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>$loggedInUser<br />\r\n$loggedInAdminUser<br />\r\n$loggedInAdminUserRole</blockquote>\r\n\r\n<p><strong>- Show/Hide the header admin bar when admin logged in:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>$showHeaderAdminBar</p>\r\n</blockquote>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>&nbsp;Extended from <code>app/Http/Controllers/Front/BaseFrontController.php</code></h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>- CSS class for body tag:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>$bodyClass</p>\r\n</blockquote>\r\n', '1', '', '', '0', '2016-04-20 00:08:17', '2016-04-21 19:17:48');
INSERT INTO post_contents VALUES ('208', '204', '1', 'Configuration', 'configuration', '', '<h3>Here are available configuration to your app by adding to <code>.env</code>:</h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>- App config:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>APP_ENV=localhost<br />\r\nAPP_DEBUG=false<br />\r\nAPP_ADMINCPACCESS=admincp<br />\r\nAPP_KEY=1SIkNkLLNKFhvVucOQNhb9uoXGFCYhYT<br />\r\nAPP_LOG=single (Available: single, daily, syslog, errorlog)</blockquote>\r\n\r\n<p><strong>- Database:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>DB_CONNECTON=mysql<br />\r\nDB_HOST=localhost<br />\r\nDB_DATABASE=your_database_name<br />\r\nDB_USERNAME=your_database_username<br />\r\nDB_PASSWORD=your_database_password<br />\r\nDB_PORT=your_database_port<br />\r\n<br />\r\n#redis<br />\r\nREDIS_HOST=localhost<br />\r\nREDIS_PASSWORD=null<br />\r\nREDIS_PORT=6379</blockquote>\r\n\r\n<p><strong>- User:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>$loggedInUser<br />\r\n$loggedInAdminUser<br />\r\n$loggedInAdminUserRole</blockquote>\r\n\r\n<p><strong>- Email:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>MAIL_DRIVER=smtp<br />\r\nMAIL_HOST=smtp.mailgun.org<br />\r\nMAIL_PORT=587<br />\r\nMAIL_ENCRYPTION=tls<br />\r\nMAIL_USERNAME=your_mail_address<br />\r\nMAIL_PASSWORD=your_mail_password</blockquote>\r\n\r\n<p>&nbsp;Other config you can see in <code>/config/</code>.</p>\r\n', '1', '', '', '0', '2016-04-21 19:28:14', '2016-04-21 21:18:45');
INSERT INTO post_contents VALUES ('209', '205', '1', 'Global functions of models', 'global-functions-of-models', '', '<h1>Get data</h1>\r\n\r\n<p><strong>Get all:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>//@param $order: [*order_by* =&gt; *order_type*] or <strong>null</strong><br />\r\n//@param $perPage: how many items per page. If &lt; 1, will return all items: <strong>int<br />\r\n//</strong>@return<strong>&nbsp;collection/array</strong><br />\r\n<strong>$model::getAll($order, $perPage);</strong></p>\r\n</blockquote>\r\n\r\n<pre class=\"prettyprint\">\r\n$order = [\r\n&nbsp; &nbsp; &#39;created_at&#39; =&gt; &#39;DESC&#39;,\r\n&nbsp; &nbsp; &#39;title&#39; =&gt; &#39;ASC&#39;\r\n];\r\n$postPerPage = 5;\r\n$data = Post::getAll($order, ​$postPerPage);</pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Get by fields:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>//@param $fields: <strong>array </strong>[&#39;field_1&#39; =&gt; &#39;value_1&#39;, &#39;field_2&#39; =&gt; &#39;value_2&#39;]<br />\r\n//@param $order: <strong>array </strong>[*order_by* =&gt; *order_type*] or <strong>null</strong><br />\r\n//@param $multiple: get many items or just the first one: <strong>bool</strong><br />\r\n//@param $perPage: how many items per page. If &lt; 1, will return all items: <strong>int<br />\r\n//</strong>@return<strong>&nbsp;collection/array</strong><br />\r\n<strong>$model::getBy($fields, $order, $multiple, $perPage);</strong></p>\r\n</blockquote>\r\n\r\n<pre class=\"prettyprint\">\r\n$fields = [\r\n&nbsp; &nbsp; &#39;title&#39; =&gt; &#39;foo&#39;,\r\n&nbsp; &nbsp; &#39;other_field&#39; =&gt; &#39;bar&#39;\r\n];\r\n$order = [\r\n&nbsp; &nbsp; &#39;title&#39; =&gt; &#39;ASC&#39;,\r\n&nbsp; &nbsp; &#39;other_field&#39; =&gt; &#39;DESC&#39;\r\n];\r\n$multiple = true;\r\n$perPage = 0;\r\n$posts = Post::getBy($fields, $order, $multiple, $perPage);</pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Search by:</strong><br />\r\nAlmost similar to <strong>getBy</strong>, but <strong>$fields</strong> accepted more compare type.<br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>//@param $fields: [&#39;field_1&#39; =&gt; [&#39;compare&#39; =&gt; &#39;=&#39;, &#39;value&#39; =&gt; &#39;value&#39;], &#39;field_2&#39; =&gt; [&#39;compare&#39; =&gt; &#39;LIKE&#39;, &#39;value&#39; =&gt; &#39;value&#39;]]<br />\r\n//@param $order: <strong>array </strong>[*order_by* =&gt; *order_type*] or <strong>null</strong><br />\r\n//@param $multiple: get many items or just the first one: <strong>bool</strong><br />\r\n//@param $perPage: how many items per page. If &lt; 1, will return all items: <strong>int<br />\r\n//</strong>@return<strong>&nbsp;collection/array</strong><br />\r\n<strong>$model::searchBy($fields, $order, $multiple, $perPage);</strong></p>\r\n</blockquote>\r\n\r\n<pre class=\"prettyprint\">\r\n$fields = [\r\n&nbsp; &nbsp; &#39;title&#39; =&gt; [\r\n&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&#39;compare&#39; =&gt; &#39;=&#39;,\r\n&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&#39;value&#39; =&gt; &#39;foo&#39;\r\n&nbsp; &nbsp; ],\r\n&nbsp; &nbsp; &#39;other_field&#39; =&gt; [\r\n&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&#39;compare&#39; =&gt; &#39;&lt;&gt;&#39;,\r\n&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&#39;value&#39; =&gt; &#39;bar&#39;\r\n&nbsp; &nbsp; ],\r\n&nbsp; &nbsp; &#39;other_field_2&#39; =&gt; [\r\n&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&#39;compare&#39; =&gt; &#39;LIKE&#39;,\r\n&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&#39;value&#39; =&gt; &#39;other&#39;\r\n&nbsp; &nbsp; ]\r\n];\r\n$order = [\r\n&nbsp; &nbsp; &#39;title&#39; =&gt; &#39;ASC&#39;,\r\n&nbsp; &nbsp; &#39;other_field&#39; =&gt; &#39;DESC&#39;\r\n];\r\n$multiple = true;\r\n$perPage = 0;\r\n$posts = Post::searchBy($fields, $order, $multiple, $perPage);</pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Find by fields or create a new one:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>//@param $fields: <strong>array </strong>[&#39;field_1&#39; =&gt; &#39;value_1&#39;, &#39;field_2&#39; =&gt; &#39;value_2&#39;]<br />\r\n<strong>//</strong>@return<strong>&nbsp;instance of model</strong><br />\r\n<strong>$model::findByFieldsOrCreate($order, $perPage);</strong></p>\r\n</blockquote>\r\n\r\n<pre class=\"prettyprint\">\r\n$fields = [\r\n&nbsp;&nbsp;&nbsp;&nbsp;&#39;title&#39; =&gt; &#39;foo&#39;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&#39;other_field&#39; =&gt; &#39;bar&#39;\r\n];\r\n$data = Post::findByFieldsOrCreate($fields);</pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1>Update data</h1>\r\n\r\n<p><strong>Fast edit:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>//@param $data: [&#39;id&#39;&nbsp;=&gt; &#39;object_id&#39;, &#39;field_1&#39; =&gt; &#39;foo&#39;, &#39;field_2&#39; =&gt; &#39;bar&#39;]<br />\r\n//@param $<strong>allowCreateNew</strong>: if <strong>true</strong>, when object not found, model will create a new one, if <strong>false</strong>, throw 404.<br />\r\n//@param $justUpdateSomeFields: if <strong>true</strong>, model just validate the fields in $data, if <strong>false</strong>, model will validate all fields of that model.<br />\r\n<strong>//</strong>@return<strong>&nbsp;mixed</strong><br />\r\n<strong>$model::fastEdit($data, $allowCreateNew, $justUpdateSomeFields);</strong></p>\r\n</blockquote>\r\n\r\n<pre class=\"prettyprint\">\r\n$data = [\r\n&nbsp; &nbsp; &#39;id&#39; =&gt; 0,\r\n&nbsp; &nbsp; &#39;title&#39; =&gt; &#39;foo&#39;,\r\n&nbsp; &nbsp; &#39;other_field&#39; =&gt; &#39;bar&#39;\r\n];\r\n$allowCreateNew = true;\r\n$justUpdateSomeFields = true;\r\n$post = new Post();\r\n$result = $post-&gt;fastEdit($data, $allowCreateNew, $justUpdateSomeFields);</pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Update multiple records:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>//@param $ids: <strong>array</strong>&nbsp;[id1, id2, id3]<br />\r\n//@param $data: <strong>array</strong>&nbsp;&nbsp;[&#39;id&#39;&nbsp;=&gt; &#39;object_id&#39;, &#39;field_1&#39; =&gt; &#39;foo&#39;, &#39;field_2&#39; =&gt; &#39;bar&#39;]<br />\r\n//@param $justUpdateSomeFields: if <strong>true</strong>, model just validate the fields in $data, if <strong>false</strong>, model will validate all fields of that model.<br />\r\n<strong>//</strong>@return<strong>&nbsp;mixed</strong><br />\r\n<strong>$model::updateMultiple($ids, $data, $justUpdateSomeFields);</strong></p>\r\n</blockquote>\r\n\r\n<pre class=\"prettyprint\">\r\n$data = [\r\n&nbsp;&nbsp;&nbsp;&nbsp;&#39;id&#39; =&gt; 0,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&#39;title&#39; =&gt; &#39;foo&#39;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&#39;other_field&#39; =&gt; &#39;bar&#39;\r\n];\r\n$ids = [1, 2, 3];\r\n$justUpdateSomeFields = true;\r\n$post = new Post();\r\n$result = $post-&gt;updateMultiple($ids, $data, $justUpdateSomeFields);\r\n</pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Update multiple records (filter the records by specific fields):</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>//@param $fields: <strong>array </strong>[&#39;field_1&#39; =&gt; &#39;value_1&#39;, &#39;field_2&#39; =&gt; &#39;value_2&#39;]<br />\r\n//@param $data: <strong>array</strong>&nbsp;&nbsp;[&#39;id&#39;&nbsp;=&gt; &#39;object_id&#39;, &#39;field_1&#39; =&gt; &#39;foo&#39;, &#39;field_2&#39; =&gt; &#39;bar&#39;]<br />\r\n//@param $justUpdateSomeFields: if <strong>true</strong>, model just validate the fields in $data, if <strong>false</strong>, model will validate all fields of that model.<br />\r\n<strong>//</strong>@return<strong>&nbsp;mixed</strong><br />\r\n<strong>$model::updateMultiple($ids, $data, $justUpdateSomeFields);</strong></p>\r\n</blockquote>\r\n\r\n<pre class=\"prettyprint\">\r\n$data = [\r\n&nbsp;&nbsp;&nbsp;&nbsp;&#39;id&#39; =&gt; 0,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&#39;title&#39; =&gt; &#39;foo&#39;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&#39;other_field&#39; =&gt; &#39;bar&#39;\r\n];\r\n$fields = [\r\n&nbsp;&nbsp;&nbsp;&nbsp;&#39;title&#39; =&gt; &#39;foo&#39;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&#39;other_field&#39; =&gt; &#39;bar&#39;\r\n];\r\n$justUpdateSomeFields = true;\r\n$post = new Post();\r\n$result = $post-&gt;updateMultiple($fields, $data, $justUpdateSomeFields);</pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1>Other</h1>\r\n\r\n<p><strong>Check value not change:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>//@param $object: Instance of model.<br />\r\n//@param $data: (<strong>array</strong>) the data passed to model<br />\r\n//@return <strong>bool</strong><br />\r\n<strong>$model::checkValueNotChange($object</strong><strong>, $data</strong><strong>);</strong></p>\r\n</blockquote>\r\n\r\n<pre class=\"prettyprint\">\r\n$post = new Post();\r\n$post = $post-&gt;getBy([&#39;title&#39; =&gt; &#39;foo&#39;]);\r\n$data = [\r\n&nbsp; &nbsp; &#39;title&#39; =&gt; &#39;bar&#39;\r\n];\r\n$result = $post-&gt;checkValueNotChange($post, $data);\r\n</pre>\r\n', '1', '', '', '0', '2016-04-21 21:22:09', '2016-04-22 22:02:20');
INSERT INTO post_contents VALUES ('210', '206', '1', 'Properties must have', 'properties-must-have', '', '<h3>These properties are must have in your model to make the app work properly.</h3>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>$table:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p><strong>protected $table = &quot;table_name_of_model&quot;;</strong></p>\r\n</blockquote>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>$primaryKey:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p><strong>//</strong>Specify the primary key of model<br />\r\n//If your table don&#39;t have&nbsp;<strong>primary key</strong>, make it as <strong>null</strong>.<br />\r\n<strong>protected $primaryKey = &quot;id&quot;;</strong></p>\r\n</blockquote>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>$editableFields:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>//Specify all the fields can be edited by method&nbsp;<strong>fastEdit</strong>, <strong>updateMultiple</strong>, <strong>updateMultipleGetByFields</strong>.<br />\r\n//Make it as an empty array if no field can be edited.<br />\r\n<strong>protected $editableFields = [&#39;foo&#39;, &#39;bar&#39;...];</strong></p>\r\n</blockquote>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>$rules:</strong><br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>//Used to validate data when user try to update model&nbsp;by method&nbsp;<strong>fastEdit</strong>, <strong>updateMultiple</strong>, <strong>updateMultipleGetByFields</strong>.<br />\r\n//Some function create/update of model use&nbsp;<strong>fastEdit</strong>&nbsp;method.<br />\r\n//Make it as an empty array if no field need to validate.<br />\r\n<strong>protected $rules = [&#39;foo&#39; =&gt; &#39;required|between:5,50|string&#39;] ;</strong></p>\r\n</blockquote>\r\n', '1', '', '', '0', '2016-04-22 22:06:31', '2016-04-23 00:21:32');
INSERT INTO post_contents VALUES ('205', '201', '1', 'Installation', 'installation', '', '<h1>Server requirements:</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The server requirements are similar to Laravel&#39;s server requirements:<br />\r\n&nbsp;</p>\r\n\r\n<ul>\r\n	<li>PHP &gt;= 5.5.9</li>\r\n	<li>OpenSSL PHP Extension</li>\r\n	<li>PDO PHP Extension</li>\r\n	<li>Mbstring PHP Extension</li>\r\n	<li>Tokenizer PHP Extension</li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1>Installation:</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h4><strong>Clone source from github</strong></h4>\r\n\r\n<blockquote>git clone git@github.com:duyphan2502/Front-end-Developer-Interview-Questions.git</blockquote>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h4><strong>Create <code>.env</code> file in the root path</strong></h4>\r\n\r\n<blockquote>APP_ADMINCPACCESS=admincp<br />\r\nAPP_ENV=local<br />\r\nAPP_DEBUG=true<br />\r\nAPP_KEY=1SIkNkLLNKFhvVucOQNhb9uoXGFCYhYT<br />\r\nDB_CONNECTION=mysql<br />\r\nDB_HOST=localhost<br />\r\nDB_DATABASE=your_database_name<br />\r\nDB_USERNAME=your_database_username<br />\r\nDB_PASSWORD=your_database_password<br />\r\nDB_PORT=3306</blockquote>\r\n\r\n<h4>&nbsp;</h4>\r\n\r\n<h4><strong>Import the sql file in <code>/resources/db/mine_laracms.sql</code> into your database.</strong></h4>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1>Front-end side</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h4>I use <code>SCSS</code> and <code>gulp</code> to mix css/js, and <code>bower</code> to manage frontend packages.</h4>\r\n\r\n<h4>You need to install <code>nodejs</code>. Visit this link: <a href=\"https://nodejs.org/en/\">nodejs.org</a>, then do these steps:</h4>\r\n\r\n<blockquote>cd <strong>{path-to-your-local-project}</strong>\\public\\web_tools<br />\r\n#install <strong>gulp</strong><br />\r\nnpm install gulp -g<br />\r\n<br />\r\n#install <strong>npm packages</strong><br />\r\nnpm install<br />\r\n<br />\r\n#install <strong>bower</strong><br />\r\nnpm install bower -g<br />\r\n<br />\r\n#install <strong>bower packages</strong><br />\r\nbower install</blockquote>\r\n\r\n<h4>How to use <code>gulp</code>:</h4>\r\n\r\n<blockquote>#frontend side<br />\r\ncd <strong>{path-to-your-local-project}</strong>\\public\\web_tools<br />\r\n<br />\r\n#admin site<br />\r\ncd <strong>{path-to-your-local-project}</strong>\\public\\admin\\web_tools<br />\r\n<br />\r\ngulp build<br />\r\ngulp watch</blockquote>\r\n', '1', '', '', '0', '2016-04-18 13:48:36', '2016-04-19 20:30:54');
INSERT INTO post_contents VALUES ('211', '207', '1', 'Page model', 'page-model', '', '<p>The model files is located in&nbsp;<code>app/Models/Page.php</code>&nbsp;and <code>app/Models/PageContent.php</code>.&nbsp;</p>\r\n\r\n<p>One <code>page</code> have more <code>page_content</code> with a specific language&nbsp;(it&#39;s mean one page have more language).</p>\r\n\r\n<p>These are the methods of <code>page model</code>:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1>Get data</h1>\r\n\r\n<p><strong>Get with content:&nbsp;</strong>it&#39;s similar to method <strong>searchBy</strong>, but it&#39;s join the table <code>page_content</code> and <code>languages</code>.<br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p><strong>static function getWithContent($fields = [], $order = null, $multiple = false, $perPage = 0)</strong></p>\r\n</blockquote>\r\n\r\n<pre class=\"prettyprint\">\r\n$page = Models\\Page::getWithContent([\r\n    &#39;pages.id&#39; =&gt; [\r\n        &#39;compare&#39; =&gt; &#39;=&#39;,\r\n        &#39;value&#39; =&gt; &#39;foo&#39;\r\n    ],\r\n    &#39;page_contents.language_id&#39; =&gt; [\r\n        &#39;compare&#39; =&gt; &#39;=&#39;,\r\n        &#39;value&#39; =&gt; &#39;bar&#39;\r\n    ]\r\n]);</pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Get page by id: </strong>get page with content by <code>pages.id</code>.<br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>//$options[&#39;global_status&#39;]: status of page<br />\r\n//$options[&#39;status&#39;]: status of page_content<br />\r\n<strong>static function getPageById($id, $languageId, $options);</strong></p>\r\n</blockquote>\r\n\r\n<pre class=\"prettyprint\">\r\n$page = Page::getPageById(1, 59, [&#39;status&#39; =&gt; 1, &#39;global_status&#39; =&gt; 1]);</pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Get page by slug: </strong>get page with content by <code>page_contents.slug</code>.<br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>//$options[&#39;global_status&#39;]: status of page<br />\r\n//$options[&#39;status&#39;]: status of page_content<br />\r\n<strong>static function getPageById($slug, $languageId, $options);</strong></p>\r\n</blockquote>\r\n\r\n<pre class=\"prettyprint\">\r\n$page = Page::getPageBySlug(&#39;homepage&#39;, 59, [&#39;status&#39; =&gt; 1, &#39;global_status&#39; =&gt; 1]);</pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Get page content&nbsp;by page id: </strong>get page_content by <code>pages.id</code>.<br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p><strong>static function getPageContentByPageId</strong><strong>($id, $languageId);</strong></p>\r\n</blockquote>\r\n\r\n<pre class=\"prettyprint\">\r\n$pageContent = Page::getPageContentByPageId(1, 59);</pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1>Update data:</h1>\r\n\r\n<p><strong>Create page:&nbsp;</strong>create a new page.<br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>//@param&nbsp;$languageId: language_id for the page_content. (<strong>int</strong>)<br />\r\n//@param&nbsp;$data: some fields of editable fields of model. (<strong>array</strong>)<br />\r\n<strong>public&nbsp;function createPage($languageId, $data)</strong></p>\r\n</blockquote>\r\n\r\n<pre class=\"prettyprint\">\r\n$page = new Page();\r\n$data = [\r\n	&#39;title&#39; =&gt; &#39;foo&#39;,\r\n	&#39;slug&#39; =&gt; &#39;bar&#39;\r\n];\r\n$languageId = 59;\r\n$result = $page-&gt;createPage($languageId, $data);</pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Update page:&nbsp;</strong>update a page that <code>pages.id</code> equal to <strong>$id</strong>.<br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>//@param&nbsp;$id: id of page. (<strong>int</strong>)<br />\r\n//@param&nbsp;$data: some fields of editable fields of model. (<strong>array</strong>)<br />\r\n//@param&nbsp;$justUpdateSomeFields:&nbsp;if true, model just validate the fields in $data, if false, model will validate all fields of that model&nbsp;(<strong>bool</strong>)<br />\r\n<strong>public&nbsp;function updatePage($id, $data, $justUpdateSomeFields = false)</strong></p>\r\n</blockquote>\r\n\r\n<pre class=\"prettyprint\">\r\n$page = new Page();\r\n$data = [\r\n	&#39;title&#39; =&gt; &#39;foo&#39;,\r\n	&#39;slug&#39; =&gt; &#39;bar&#39;\r\n];\r\n$result = $page-&gt;updatePage(15, $data, true);</pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Update page content:&nbsp;</strong>update a <code>page_contents</code> that <code>page_contents.page_id</code> equal to <strong>$id</strong>.<br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>//@param&nbsp;$id: id of page. (<strong>int</strong>)<br />\r\n//@param&nbsp;$languageId: language_id. (<strong>int</strong>)<br />\r\n//@param&nbsp;$data: some fields of editable fields of model. (<strong>array</strong>)<br />\r\n<strong>public&nbsp;function updatePageContent($id, $languageId, $data)</strong></p>\r\n</blockquote>\r\n\r\n<pre class=\"prettyprint\">\r\n$page = new Page();\r\n$data = [\r\n	&#39;title&#39; =&gt; &#39;foo&#39;,\r\n	&#39;slug&#39; =&gt; &#39;bar&#39;\r\n];\r\n$languageId = 59;\r\n$result = $page-&gt;updatePageContent(15, $languageId, $data);</pre>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1>Delete page:</h1>\r\n\r\n<p><strong>Delete page: </strong>delete a page&nbsp;that <code>pages.id</code> equal to <strong>$id</strong>.<br />\r\n&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>//@param&nbsp;$id: id of page. (<strong>int</strong>)<br />\r\n<strong>public static function deletePage($id)</strong></p>\r\n</blockquote>\r\n\r\n<pre class=\"prettyprint\">\r\n$result = Page::deletePage(15);</pre>\r\n', '1', '', '', '0', '2016-04-23 00:52:29', '2016-04-24 15:58:26');
INSERT INTO post_contents VALUES ('212', '208', '1', 'Structure of application', 'structure-of-application', '', '<p>All the model files are located in&nbsp;<code>app/Models</code>.</p>\r\n\r\n<p>All the controller files are located in&nbsp;<code>app/Http/Controllers</code>.</p>\r\n\r\n<p>All the view files are located in&nbsp;<code>app/Views</code>.</p>\r\n\r\n<p>This application supports multilanguage.</p>\r\n\r\n<p>Example:<br />\r\n&nbsp;</p>\r\n\r\n<ul>\r\n	<li>There are many <code>page_content</code> of a <code>page</code>, a <code>page_content</code> has one <code>language</code>.</li>\r\n	<li>There are many <code>post_content</code> of a <code>post</code>, a <code>post_content</code> has one <code>language</code>. <code>Categories</code>, <code>products</code>, <code>product categories </code>are the same.</li>\r\n	<li>There are many <code>posts</code> of a <code>categories</code>. A <code>post</code> can be <strong>belongs to many</strong> <code>categories</code>. <code>Products</code> and <code>product categories</code> are the same.</li>\r\n</ul>\r\n', '1', '', '', '0', '2016-04-23 00:56:34', '2016-04-23 01:19:39');

-- ----------------------------
-- Table structure for `post_metas`
-- ----------------------------
DROP TABLE IF EXISTS `post_metas`;
CREATE TABLE `post_metas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int(11) DEFAULT NULL,
  `meta_key` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_value` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of post_metas
-- ----------------------------

-- ----------------------------
-- Table structure for `products`
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `global_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `order` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of products
-- ----------------------------

-- ----------------------------
-- Table structure for `product_categories`
-- ----------------------------
DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE `product_categories` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `global_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_template` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `order` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of product_categories
-- ----------------------------
INSERT INTO product_categories VALUES ('1', '0', 'Thời trang', 'Fashion', '1', '2', '0', '2016-01-28 14:09:50', '2016-04-18 11:03:14');

-- ----------------------------
-- Table structure for `product_categories_products`
-- ----------------------------
DROP TABLE IF EXISTS `product_categories_products`;
CREATE TABLE `product_categories_products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_categories_products
-- ----------------------------
INSERT INTO product_categories_products VALUES ('6', '2', '1');
INSERT INTO product_categories_products VALUES ('7', '3', '1');
INSERT INTO product_categories_products VALUES ('8', '4', '1');
INSERT INTO product_categories_products VALUES ('9', '5', '1');
INSERT INTO product_categories_products VALUES ('10', '6', '1');
INSERT INTO product_categories_products VALUES ('11', '7', '1');
INSERT INTO product_categories_products VALUES ('12', '8', '1');
INSERT INTO product_categories_products VALUES ('13', '9', '1');
INSERT INTO product_categories_products VALUES ('14', '10', '1');
INSERT INTO product_categories_products VALUES ('15', '11', '1');
INSERT INTO product_categories_products VALUES ('16', '12', '1');
INSERT INTO product_categories_products VALUES ('17', '13', '1');
INSERT INTO product_categories_products VALUES ('18', '14', '1');
INSERT INTO product_categories_products VALUES ('19', '15', '1');
INSERT INTO product_categories_products VALUES ('20', '16', '1');
INSERT INTO product_categories_products VALUES ('21', '17', '1');
INSERT INTO product_categories_products VALUES ('22', '18', '1');
INSERT INTO product_categories_products VALUES ('23', '19', '1');
INSERT INTO product_categories_products VALUES ('24', '20', '1');
INSERT INTO product_categories_products VALUES ('25', '21', '1');
INSERT INTO product_categories_products VALUES ('26', '22', '1');
INSERT INTO product_categories_products VALUES ('27', '23', '1');
INSERT INTO product_categories_products VALUES ('28', '24', '1');
INSERT INTO product_categories_products VALUES ('29', '25', '1');
INSERT INTO product_categories_products VALUES ('30', '26', '1');
INSERT INTO product_categories_products VALUES ('31', '27', '1');
INSERT INTO product_categories_products VALUES ('32', '28', '1');
INSERT INTO product_categories_products VALUES ('33', '29', '1');
INSERT INTO product_categories_products VALUES ('34', '30', '1');
INSERT INTO product_categories_products VALUES ('35', '31', '1');
INSERT INTO product_categories_products VALUES ('36', '32', '1');
INSERT INTO product_categories_products VALUES ('37', '33', '1');
INSERT INTO product_categories_products VALUES ('38', '34', '1');
INSERT INTO product_categories_products VALUES ('39', '35', '1');
INSERT INTO product_categories_products VALUES ('40', '36', '1');
INSERT INTO product_categories_products VALUES ('41', '37', '1');
INSERT INTO product_categories_products VALUES ('42', '38', '1');
INSERT INTO product_categories_products VALUES ('43', '39', '1');
INSERT INTO product_categories_products VALUES ('44', '40', '1');
INSERT INTO product_categories_products VALUES ('45', '41', '1');
INSERT INTO product_categories_products VALUES ('46', '42', '1');
INSERT INTO product_categories_products VALUES ('47', '43', '1');
INSERT INTO product_categories_products VALUES ('48', '44', '1');
INSERT INTO product_categories_products VALUES ('49', '45', '1');
INSERT INTO product_categories_products VALUES ('50', '46', '1');
INSERT INTO product_categories_products VALUES ('51', '47', '1');
INSERT INTO product_categories_products VALUES ('52', '48', '1');
INSERT INTO product_categories_products VALUES ('53', '49', '1');
INSERT INTO product_categories_products VALUES ('54', '50', '1');
INSERT INTO product_categories_products VALUES ('55', '51', '1');
INSERT INTO product_categories_products VALUES ('56', '52', '1');
INSERT INTO product_categories_products VALUES ('57', '53', '1');
INSERT INTO product_categories_products VALUES ('58', '54', '1');
INSERT INTO product_categories_products VALUES ('59', '55', '1');
INSERT INTO product_categories_products VALUES ('60', '56', '1');
INSERT INTO product_categories_products VALUES ('61', '57', '1');
INSERT INTO product_categories_products VALUES ('62', '58', '1');
INSERT INTO product_categories_products VALUES ('63', '59', '1');
INSERT INTO product_categories_products VALUES ('64', '60', '1');
INSERT INTO product_categories_products VALUES ('65', '61', '1');
INSERT INTO product_categories_products VALUES ('66', '62', '1');
INSERT INTO product_categories_products VALUES ('67', '63', '1');
INSERT INTO product_categories_products VALUES ('68', '64', '1');
INSERT INTO product_categories_products VALUES ('69', '65', '1');
INSERT INTO product_categories_products VALUES ('70', '66', '1');
INSERT INTO product_categories_products VALUES ('71', '67', '1');
INSERT INTO product_categories_products VALUES ('72', '68', '1');
INSERT INTO product_categories_products VALUES ('73', '69', '1');
INSERT INTO product_categories_products VALUES ('74', '70', '1');
INSERT INTO product_categories_products VALUES ('75', '71', '1');
INSERT INTO product_categories_products VALUES ('76', '72', '1');
INSERT INTO product_categories_products VALUES ('77', '73', '1');
INSERT INTO product_categories_products VALUES ('78', '74', '1');
INSERT INTO product_categories_products VALUES ('79', '75', '1');
INSERT INTO product_categories_products VALUES ('80', '76', '1');
INSERT INTO product_categories_products VALUES ('81', '77', '1');
INSERT INTO product_categories_products VALUES ('82', '78', '1');
INSERT INTO product_categories_products VALUES ('83', '79', '1');
INSERT INTO product_categories_products VALUES ('84', '80', '1');
INSERT INTO product_categories_products VALUES ('85', '81', '1');
INSERT INTO product_categories_products VALUES ('86', '82', '1');
INSERT INTO product_categories_products VALUES ('87', '83', '1');
INSERT INTO product_categories_products VALUES ('88', '84', '1');
INSERT INTO product_categories_products VALUES ('89', '85', '1');
INSERT INTO product_categories_products VALUES ('90', '86', '1');
INSERT INTO product_categories_products VALUES ('91', '87', '1');
INSERT INTO product_categories_products VALUES ('92', '88', '1');
INSERT INTO product_categories_products VALUES ('93', '89', '1');
INSERT INTO product_categories_products VALUES ('94', '90', '1');
INSERT INTO product_categories_products VALUES ('95', '91', '1');
INSERT INTO product_categories_products VALUES ('96', '92', '1');
INSERT INTO product_categories_products VALUES ('97', '93', '1');
INSERT INTO product_categories_products VALUES ('98', '94', '1');
INSERT INTO product_categories_products VALUES ('99', '95', '1');
INSERT INTO product_categories_products VALUES ('100', '96', '1');
INSERT INTO product_categories_products VALUES ('101', '97', '1');
INSERT INTO product_categories_products VALUES ('102', '98', '1');
INSERT INTO product_categories_products VALUES ('103', '99', '1');
INSERT INTO product_categories_products VALUES ('104', '100', '1');

-- ----------------------------
-- Table structure for `product_category_contents`
-- ----------------------------
DROP TABLE IF EXISTS `product_category_contents`;
CREATE TABLE `product_category_contents` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '59',
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '1',
  `thumbnail` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `tags` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_category_contents
-- ----------------------------
INSERT INTO product_category_contents VALUES ('8', '1', '59', 'Thời trang', 'thoi-trang', '', '', '1', '', '', '0', '2016-01-28 14:09:50', '2016-01-28 14:09:50');

-- ----------------------------
-- Table structure for `product_category_metas`
-- ----------------------------
DROP TABLE IF EXISTS `product_category_metas`;
CREATE TABLE `product_category_metas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int(11) DEFAULT NULL,
  `meta_key` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_value` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_category_metas
-- ----------------------------

-- ----------------------------
-- Table structure for `product_contents`
-- ----------------------------
DROP TABLE IF EXISTS `product_contents`;
CREATE TABLE `product_contents` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '59',
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `thumbnail` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `tags` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `price` double NOT NULL DEFAULT '0',
  `old_price` double NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_contents
-- ----------------------------

-- ----------------------------
-- Table structure for `product_metas`
-- ----------------------------
DROP TABLE IF EXISTS `product_metas`;
CREATE TABLE `product_metas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content_id` int(11) DEFAULT NULL,
  `meta_key` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_value` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of product_metas
-- ----------------------------

-- ----------------------------
-- Table structure for `settings`
-- ----------------------------
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `option_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `option_value` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of settings
-- ----------------------------
INSERT INTO settings VALUES ('1', 'email_receives_feedback', 'duyphan.developer@gmail.com', '2015-11-24 16:31:17', '2015-11-24 16:31:20');
INSERT INTO settings VALUES ('2', 'site_title', 'LaraWebEd', '2015-12-17 07:51:37', '2016-04-16 22:53:42');
INSERT INTO settings VALUES ('3', 'site_logo', '', '2015-12-17 07:51:52', '2016-01-21 06:06:24');
INSERT INTO settings VALUES ('4', 'site_keywords', 'Site vui, vui, haivl,Một người khỏe hai người vui', '2015-12-17 07:52:21', '2016-01-21 01:40:32');
INSERT INTO settings VALUES ('5', 'default_language', '1', '2015-12-17 07:53:12', '2016-04-16 00:59:54');
INSERT INTO settings VALUES ('6', 'google_analytics', '<script></script>', '2015-11-24 16:35:03', '2015-11-25 00:07:38');
INSERT INTO settings VALUES ('7', 'construction_mode', '0', '2015-11-24 16:36:20', '2016-01-26 10:04:50');
INSERT INTO settings VALUES ('8', 'site_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-01-21 01:40:32', '2016-01-21 01:52:35');
INSERT INTO settings VALUES ('9', 'default_homepage', '1', '2016-01-21 14:11:32', '2016-01-21 14:11:34');
INSERT INTO settings VALUES ('10', 'show_admin_bar', '1', '2016-01-26 10:00:54', '2016-01-26 10:05:42');
INSERT INTO settings VALUES ('11', 'google_captcha_site_key', '6Lfy4hYTAAAAABIGAFmHHScJ_lUZR7UuzD7MoXDO', '2016-01-30 22:21:48', '2016-01-30 22:21:48');
INSERT INTO settings VALUES ('12', 'google_captcha_secret_key', '6Lfy4hYTAAAAAGTRaZggVzW_PAyVxmGguw8uSWyH', '2016-01-30 22:21:48', '2016-01-30 22:21:48');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `last_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `sex` tinyint(1) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` datetime DEFAULT '0000-00-00 00:00:00',
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `phone_2` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `phone_3` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `register_key` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) NOT NULL,
  `login_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token_expired_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_login_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO users VALUES ('1', 'duy.phan2509@outlook.com', '$2y$10$OhUkdcdm5JlAnwr1s2VO/eAxpKiU66wLMVqsiQW9yesyheGs7/Fj6', 'Tedozi', 'Manson', '1', 'PHP developer, Frontend developer with 2 years experience.', '1993-02-25 00:00:00', null, '/uploads/chip-dep-xinh.jpg', '0984848519', '0915428202', '01993032562', '1', null, 'NMUhHbt9lhYdfTzxynISI8Jf9o7WN92364aB9jb3t5C8mnFxfbn2GxL1DQ3U', '749f258446f1d3bc08c9b669b3bb1a0f', '2015-12-22 01:33:21', '0000-00-00 00:00:00', '2014-10-14 00:10:13', '2016-01-24 16:22:26');
INSERT INTO users VALUES ('27', 'duyphan.developer@gmail.com', '$2y$10$DQPxPPlOraQzTKOBTbAmie/WhzaY6Xs2qp2aMoMvRVVq/1Z2aKbQW', 'Duy', 'Phan', '1', '', '2016-01-21 00:00:00', null, '/uploads/chipu.jpg', '0915428202', '', '', '1', null, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2016-01-24 16:33:47', '2016-01-24 16:41:46');
