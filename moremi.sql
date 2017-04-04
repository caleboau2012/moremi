/*
Navicat MySQL Data Transfer

Source Server         : LocalDatabase
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : moremi

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2016-10-14 17:26:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('2016_06_06_164126_create_profile_table', '1');
INSERT INTO `migrations` VALUES ('2016_06_06_165008_create_photos_table', '1');
INSERT INTO `migrations` VALUES ('2016_06_06_165655_create_voters_table', '1');
INSERT INTO `migrations` VALUES ('2016_06_24_235716_create_social_accounts_table', '1');

-- ----------------------------
-- Table structure for old_cheeks
-- ----------------------------
DROP TABLE IF EXISTS `old_cheeks`;
CREATE TABLE `old_cheeks` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) DEFAULT NULL,
  `won_date` date DEFAULT NULL,
  `won_photo` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of old_cheeks
-- ----------------------------
INSERT INTO `old_cheeks` VALUES ('1', '192', '2016-08-25', 'uploads\\96858b3abc9db738d9df78fb8c32b7ca.jpg', '2016-08-25 16:39:18', '2016-08-25 16:39:18', null);
INSERT INTO `old_cheeks` VALUES ('2', '192', '2016-08-25', 'uploads\\96858b3abc9db738d9df78fb8c32b7ca.jpg', '2016-08-25 16:40:57', '2016-08-25 16:40:57', null);
INSERT INTO `old_cheeks` VALUES ('3', '192', '2016-08-25', 'uploads\\96858b3abc9db738d9df78fb8c32b7ca.jpg', '2016-08-25 16:41:42', '2016-08-25 16:41:42', null);
INSERT INTO `old_cheeks` VALUES ('4', '192', '2016-08-25', 'uploads\\96858b3abc9db738d9df78fb8c32b7ca.jpg', '2016-08-25 16:41:43', '2016-08-25 16:41:43', null);
INSERT INTO `old_cheeks` VALUES ('5', '192', '2016-08-25', 'uploads\\96858b3abc9db738d9df78fb8c32b7ca.jpg', '2016-08-25 16:41:44', '2016-08-25 16:41:44', null);
INSERT INTO `old_cheeks` VALUES ('6', '192', '2016-08-25', 'uploads\\96858b3abc9db738d9df78fb8c32b7ca.jpg', '2016-08-25 16:46:38', '2016-08-25 16:46:38', null);

-- ----------------------------
-- Table structure for photos
-- ----------------------------
DROP TABLE IF EXISTS `photos`;
CREATE TABLE `photos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `full_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumb_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=411 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of photos
-- ----------------------------
INSERT INTO `photos` VALUES ('351', 'uploads\\cde6a19004da0b3f8bf3d98fd4f11a44.jpg', 'uploads\\thumbs\\c0d6eceeda8af8bfbe0c38416fe0dac8.jpg', '185', '2016-08-20 00:29:41', '2016-08-20 00:29:41');
INSERT INTO `photos` VALUES ('352', 'uploads\\4498c63ab4065778184357cf2e84a77d.jpg', 'uploads\\thumbs\\497dcd3ca0c125ad4e2267cae8ae9ff4.jpg', '185', '2016-08-20 00:29:42', '2016-08-20 00:29:42');
INSERT INTO `photos` VALUES ('353', 'uploads\\120544972f99f2b71e156c3588317eb0.jpg', 'uploads\\thumbs\\c74ae40b08be6567c1968aeb187282ca.jpg', '185', '2016-08-20 00:29:43', '2016-08-20 00:29:43');
INSERT INTO `photos` VALUES ('354', 'uploads\\b70be50e5d37b1ec878cbe4fa8c089ba.jpg', 'uploads\\thumbs\\b89f92e4644994969d8c15c6c2366e3f.jpg', '185', '2016-08-20 00:29:44', '2016-08-20 00:29:44');
INSERT INTO `photos` VALUES ('355', 'uploads\\9376e48e8bd2e5022b6014375d0d087f.jpg', 'uploads\\thumbs\\b2f9d14deac7c266e4aedbd6bc52f691.jpg', '185', '2016-08-20 00:29:45', '2016-08-20 00:29:45');
INSERT INTO `photos` VALUES ('356', 'uploads\\aecf2133123e9c44bc5e7ee2e9432985.jpg', 'uploads\\thumbs\\b576c8523e5b2f5082c5053b4b4de668.jpg', '185', '2016-08-20 00:29:46', '2016-08-20 00:29:46');
INSERT INTO `photos` VALUES ('357', 'uploads\\12ac2626fe2b5e23d54469078d93963d.jpg', 'uploads\\thumbs\\516b21b3bde10391db7ba28c23c81d06.jpg', '186', '2016-08-20 00:29:47', '2016-08-20 00:29:47');
INSERT INTO `photos` VALUES ('358', 'uploads\\97134940f20bf44e4a062a1d60306ac7.jpg', 'uploads\\thumbs\\2b4f26b566c40fde245a179b40e5e30a.jpg', '186', '2016-08-20 00:29:48', '2016-08-20 00:29:48');
INSERT INTO `photos` VALUES ('359', 'uploads\\4243b742ed9f053a7fa6a80ce5d73d58.jpg', 'uploads\\thumbs\\fc7a812f414a5ea1bad6ef67c6a37f39.jpg', '186', '2016-08-20 00:29:49', '2016-08-20 00:29:49');
INSERT INTO `photos` VALUES ('360', 'uploads\\e6ea6e9dd801057cc022b3ad8ac6867a.jpg', 'uploads\\thumbs\\63c9e9e8327427bb6446bd1b935f9eb5.jpg', '186', '2016-08-20 00:29:50', '2016-08-20 00:29:50');
INSERT INTO `photos` VALUES ('361', 'uploads\\cbd3566d034219fa520666f9b77799ca.jpg', 'uploads\\thumbs\\459681f37a07164bf0562b3683e2d8d5.jpg', '186', '2016-08-20 00:29:51', '2016-08-20 00:29:51');
INSERT INTO `photos` VALUES ('362', 'uploads\\80cea6f878902c85a346075f64015831.jpg', 'uploads\\thumbs\\4b38e6ecd9009fe5725523b36c90be31.jpg', '186', '2016-08-20 00:29:52', '2016-08-20 00:29:52');
INSERT INTO `photos` VALUES ('363', 'uploads\\ab348d1efb47e80ee5bd25ebb28f36a9.jpg', 'uploads\\thumbs\\08a0497e7c98f5e055138fdada005383.jpg', '187', '2016-08-20 00:29:53', '2016-08-20 00:29:53');
INSERT INTO `photos` VALUES ('364', 'uploads\\657661ae6db5c2653ea10881c7fff9e5.jpg', 'uploads\\thumbs\\80406a769cbcbb22d1e06e5d98225975.jpg', '187', '2016-08-20 00:29:54', '2016-08-20 00:29:54');
INSERT INTO `photos` VALUES ('365', 'uploads\\e16dcee8cffc1a9b040e18add844ece7.jpg', 'uploads\\thumbs\\120fd6586256d899256c6de81a6a8613.jpg', '187', '2016-08-20 00:29:55', '2016-08-20 00:29:55');
INSERT INTO `photos` VALUES ('366', 'uploads\\a60bc5c3b0044203465c94ab6af79a69.jpg', 'uploads\\thumbs\\f89bc9576ad04c04828e10ee17acd957.jpg', '187', '2016-08-20 00:29:56', '2016-08-20 00:29:56');
INSERT INTO `photos` VALUES ('367', 'uploads\\ef232b7e644e0334c0bd9d52e5ead884.jpg', 'uploads\\thumbs\\1db53e396bc44e70e38d2fe82330246a.jpg', '187', '2016-08-20 00:29:57', '2016-08-20 00:29:57');
INSERT INTO `photos` VALUES ('368', 'uploads\\a4f4600e3c59d2d8ad77d0fc87e6428f.jpg', 'uploads\\thumbs\\ca9983db90a00d37ecb6176892a672c3.jpg', '187', '2016-08-20 00:29:58', '2016-08-20 00:29:58');
INSERT INTO `photos` VALUES ('369', 'uploads\\c4c6aaf927dff397109f0d00e7db6e90.jpg', 'uploads\\thumbs\\fa36dd0fbd503afe403cd69d812d9f23.jpg', '188', '2016-08-20 00:29:59', '2016-08-20 00:29:59');
INSERT INTO `photos` VALUES ('370', 'uploads\\42a00abd23fa4696906e983d9e5d8f28.jpg', 'uploads\\thumbs\\8c17eb966892a82696ccf1e99c1cc7c5.jpg', '188', '2016-08-20 00:30:00', '2016-08-20 00:30:00');
INSERT INTO `photos` VALUES ('371', 'uploads\\3d9d7ee612903ada23c2ee499c8f4586.jpg', 'uploads\\thumbs\\540334a3e462dd2d7b06de2e3c275fbf.jpg', '188', '2016-08-20 00:30:01', '2016-08-20 00:30:01');
INSERT INTO `photos` VALUES ('372', 'uploads\\2ff8ab896a114d9078e98bf3d314e692.jpg', 'uploads\\thumbs\\e7c23d081939f644d6dd4b9ffe141bc4.jpg', '188', '2016-08-20 00:30:02', '2016-08-20 00:30:02');
INSERT INTO `photos` VALUES ('373', 'uploads\\bc850df0934250b6477721d3f3cb43e0.jpg', 'uploads\\thumbs\\112f61dd4b9f2cb6d63accbe3c4c0ebd.jpg', '188', '2016-08-20 00:30:03', '2016-08-20 00:30:03');
INSERT INTO `photos` VALUES ('374', 'uploads\\57c101a67ebbcce29e0b059b6fb0b758.jpg', 'uploads\\thumbs\\d117f8a55c1bfa1baa2dfa6c5f68071c.jpg', '188', '2016-08-20 00:30:03', '2016-08-20 00:30:03');
INSERT INTO `photos` VALUES ('375', 'uploads\\3f92e291962835384f107d1d3cbda9f5.jpg', 'uploads\\thumbs\\cbf24d325b588884f075eb7a19137571.jpg', '189', '2016-08-20 00:30:05', '2016-08-20 00:30:05');
INSERT INTO `photos` VALUES ('376', 'uploads\\ebe555be712db1b919e629edc6e796e8.jpg', 'uploads\\thumbs\\0c9339e09e30455497790906abe6570a.jpg', '189', '2016-08-20 00:30:06', '2016-08-20 00:30:06');
INSERT INTO `photos` VALUES ('377', 'uploads\\e98f773266303da5b911880b16deb7d6.jpg', 'uploads\\thumbs\\ee0c5c8860f65b77d5b91dc3704cf3c3.jpg', '189', '2016-08-20 00:30:07', '2016-08-20 00:30:07');
INSERT INTO `photos` VALUES ('378', 'uploads\\9a9df3302ce181b362848f2ab05f6b2d.jpg', 'uploads\\thumbs\\fb0449555cdf8621661a6e38842cf9e1.jpg', '189', '2016-08-20 00:30:08', '2016-08-20 00:30:08');
INSERT INTO `photos` VALUES ('379', 'uploads\\4225a84126ed44d239f58fbb65c55329.jpg', 'uploads\\thumbs\\3fbf62a2f668c6ae33f79847e891018c.jpg', '189', '2016-08-20 00:30:09', '2016-08-20 00:30:09');
INSERT INTO `photos` VALUES ('380', 'uploads\\c6dde2fee4e4b75151e0cf8db025a84c.jpg', 'uploads\\thumbs\\28ff377d345923666331fb3ffb5e8c11.jpg', '189', '2016-08-20 00:30:09', '2016-08-20 00:30:09');
INSERT INTO `photos` VALUES ('381', 'uploads\\852acdc76044751f3abe8b28e043075d.jpg', 'uploads\\thumbs\\d059b40e77ffa0a2d64da131d577c852.jpg', '190', '2016-08-20 00:30:10', '2016-08-20 00:30:10');
INSERT INTO `photos` VALUES ('382', 'uploads\\6be284423db4c3931a4fe4bc4209c904.jpg', 'uploads\\thumbs\\ec5b33c005b7c27d511ade91a7e31ceb.jpg', '190', '2016-08-20 00:30:11', '2016-08-20 00:30:11');
INSERT INTO `photos` VALUES ('383', 'uploads\\27d01067841d8e5352c8156aeedb773d.jpg', 'uploads\\thumbs\\93958d53c5fd86ed289859a3e959cf85.jpg', '190', '2016-08-20 00:30:12', '2016-08-20 00:30:12');
INSERT INTO `photos` VALUES ('384', 'uploads\\62024aa2dc4ae35e6570a7a4e0ed0d6e.jpg', 'uploads\\thumbs\\4a22e9a2ff774ef9c1e2cf6ddbc01901.jpg', '190', '2016-08-20 00:30:13', '2016-08-20 00:30:13');
INSERT INTO `photos` VALUES ('385', 'uploads\\adf89c3391fc3982d9a41c9b40e1b6da.jpg', 'uploads\\thumbs\\82f7af7e454456e222ed59b2e063b5c7.jpg', '190', '2016-08-20 00:30:14', '2016-08-20 00:30:14');
INSERT INTO `photos` VALUES ('386', 'uploads\\9f5ffd2fab9d993104913c19e7f8c86f.jpg', 'uploads\\thumbs\\07e17b3a688aca958ff54f3db34373cc.jpg', '190', '2016-08-20 00:30:15', '2016-08-20 00:30:15');
INSERT INTO `photos` VALUES ('387', 'uploads\\df74d3526ada2cb38a69942acab9c45f.jpg', 'uploads\\thumbs\\fbe8a53228494c2266d980ac0f88d4cc.jpg', '191', '2016-08-20 00:30:16', '2016-08-20 00:30:16');
INSERT INTO `photos` VALUES ('388', 'uploads\\c9b0aa6698ce24d9a597eac34544f759.jpg', 'uploads\\thumbs\\bc7ceddc2769589d4bd26b0eefda6a1f.jpg', '191', '2016-08-20 00:30:17', '2016-08-20 00:30:17');
INSERT INTO `photos` VALUES ('389', 'uploads\\f88fa70edca824a54dbbb688ca731d4a.jpg', 'uploads\\thumbs\\0465411eb41e92083888d5a18e09b8c8.jpg', '191', '2016-08-20 00:30:18', '2016-08-20 00:30:18');
INSERT INTO `photos` VALUES ('390', 'uploads\\ecd0166c554bedbd0fbf759276ea4243.jpg', 'uploads\\thumbs\\c6f3813b5df119f72a723b2b4f833048.jpg', '191', '2016-08-20 00:30:19', '2016-08-20 00:30:19');
INSERT INTO `photos` VALUES ('391', 'uploads\\6b00a6121960ba006b3b8b1fe3882992.jpg', 'uploads\\thumbs\\889bfc2836bda683a1a8b830e8b636f5.jpg', '191', '2016-08-20 00:30:20', '2016-08-20 00:30:20');
INSERT INTO `photos` VALUES ('392', 'uploads\\1acd4d287c92e363104f1032921929d7.jpg', 'uploads\\thumbs\\bc62fdca893da855a2e0e4eb76579155.jpg', '191', '2016-08-20 00:30:20', '2016-08-20 00:30:20');
INSERT INTO `photos` VALUES ('393', 'uploads\\def57db4198467ce61af4a0861ac5d00.jpg', 'uploads\\thumbs\\a526d862724e8a08e92c4056caa8b4f5.jpg', '192', '2016-08-20 00:30:22', '2016-08-20 00:30:22');
INSERT INTO `photos` VALUES ('394', 'uploads\\ce40c07f76393a15c3920d121a6ce327.jpg', 'uploads\\thumbs\\76cb8f132cb5db3132cfed816e16a4ae.jpg', '192', '2016-08-20 00:30:23', '2016-08-20 00:30:23');
INSERT INTO `photos` VALUES ('395', 'uploads\\7a2848a726c6e1190d402834823469e3.jpg', 'uploads\\thumbs\\35dee01259ab578f9ab8031bf5e5ef85.jpg', '192', '2016-08-20 00:30:23', '2016-08-20 00:30:23');
INSERT INTO `photos` VALUES ('396', 'uploads\\d9ab245982f28efccd489f4d54064d01.jpg', 'uploads\\thumbs\\9ba14996bdf66b79b5e5c6a7c798a839.jpg', '192', '2016-08-20 00:30:24', '2016-08-20 00:30:24');
INSERT INTO `photos` VALUES ('397', 'uploads\\9addf49dbdb97dd514b189a154d3faff.jpg', 'uploads\\thumbs\\6c2e3a5a047785bdea0b89c9f9033647.jpg', '192', '2016-08-20 00:30:25', '2016-08-20 00:30:25');
INSERT INTO `photos` VALUES ('398', 'uploads\\96858b3abc9db738d9df78fb8c32b7ca.jpg', 'uploads\\thumbs\\cd647297ff4e8217ee5aee74b274edd5.jpg', '192', '2016-08-20 00:30:26', '2016-08-20 00:30:26');
INSERT INTO `photos` VALUES ('399', 'uploads\\55cbf045c2e3e5077b4ea9211e869754.jpg', 'uploads\\thumbs\\82b54fd4331ad8b606edfe5bde8b602d.jpg', '193', '2016-08-20 00:30:27', '2016-08-20 00:30:27');
INSERT INTO `photos` VALUES ('400', 'uploads\\8ce9ccd2897baea1e2cc69c4c4bbb15f.jpg', 'uploads\\thumbs\\6e76aaa108d4e30b53168f93cc739877.jpg', '193', '2016-08-20 00:30:28', '2016-08-20 00:30:28');
INSERT INTO `photos` VALUES ('401', 'uploads\\f207558b90c850edf9db8ceee318e5f2.jpg', 'uploads\\thumbs\\d37fa8308da5285aecacbd94c9b6ed7c.jpg', '193', '2016-08-20 00:30:29', '2016-08-20 00:30:29');
INSERT INTO `photos` VALUES ('402', 'uploads\\62fa95a5dc72b0b35c134182493dd47a.jpg', 'uploads\\thumbs\\2aa97140ca7322c7838598dfe336b5ea.jpg', '193', '2016-08-20 00:30:30', '2016-08-20 00:30:30');
INSERT INTO `photos` VALUES ('403', 'uploads\\dfa4ffa514d7c0d1b1abf51b5e3737de.jpg', 'uploads\\thumbs\\44ae2793534862ac3aeceb50c07ae49e.jpg', '193', '2016-08-20 00:30:31', '2016-08-20 00:30:31');
INSERT INTO `photos` VALUES ('404', 'uploads\\e368da415a9102274088ed0797bcd398.jpg', 'uploads\\thumbs\\cf328046953f5733e7e1da46dacefb9a.jpg', '193', '2016-08-20 00:30:32', '2016-08-20 00:30:32');
INSERT INTO `photos` VALUES ('405', 'uploads\\72fdfa28e8398a1217676d622dcf178a.jpg', 'uploads\\thumbs\\5e0ab3f91a70163aaf47707f99795033.jpg', '194', '2016-08-20 00:30:33', '2016-08-20 00:30:33');
INSERT INTO `photos` VALUES ('406', 'uploads\\92565280686a099bdff1e23bd29e5827.jpg', 'uploads\\thumbs\\52d64e729f230ecccea4c275de24728c.jpg', '194', '2016-08-20 00:30:33', '2016-08-20 00:30:33');
INSERT INTO `photos` VALUES ('407', 'uploads\\48d2b29a50d987525186cba5216833f6.jpg', 'uploads\\thumbs\\6f0a01b12e4dbc77b0dd0f5c9f70df26.jpg', '194', '2016-08-20 00:30:34', '2016-08-20 00:30:34');
INSERT INTO `photos` VALUES ('408', 'uploads\\5c7aa113da3cc9855a18b1944cc4f06f.jpg', 'uploads\\thumbs\\d04f1e31844fa6de762c97fd7170c975.jpg', '194', '2016-08-20 00:30:35', '2016-08-20 00:30:35');
INSERT INTO `photos` VALUES ('409', 'uploads\\13fdac4b2c03648630f3d6371bc7f714.jpg', 'uploads\\thumbs\\3b43d7daafd9fd84c33a3802dc5fb15f.jpg', '194', '2016-08-20 00:30:36', '2016-08-20 00:30:36');
INSERT INTO `photos` VALUES ('410', 'uploads\\f568e3697123693f21c0e19dbeddec87.jpg', 'uploads\\thumbs\\6eb307a4442211ed824b39a417567bea.jpg', '194', '2016-08-20 00:30:37', '2016-08-20 00:30:37');

-- ----------------------------
-- Table structure for profiles
-- ----------------------------
DROP TABLE IF EXISTS `profiles`;
CREATE TABLE `profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `show_private_info` tinyint(1) NOT NULL,
  `vote` int(11) NOT NULL,
  `photo_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `about` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `profiles_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of profiles
-- ----------------------------
INSERT INTO `profiles` VALUES ('185', 'Lorna', 'Stroman', 'keven.lang@yahoo.com', '203.841.8246', '25406113', '0', '4', '356', '2016-08-20 00:29:40', '2016-08-29 21:47:33', null);
INSERT INTO `profiles` VALUES ('186', 'Jaqueline', 'Kshlerin', 'rrogahn@veum.com', '+1-364-381-3061', '28767864', '0', '2', '362', '2016-08-20 00:29:46', '2016-08-29 21:51:18', null);
INSERT INTO `profiles` VALUES ('187', 'Quinten', 'Schneider', 'theresa.abernathy@hotmail.com', '607.578.1023 x06205', '9650656', '0', '3', '368', '2016-08-20 00:29:52', '2016-10-06 15:39:25', null);
INSERT INTO `profiles` VALUES ('188', 'Anne', 'Rippin', 'genesis98@hotmail.com', '(290) 729-7141 x05089', '20168254', '0', '0', '374', '2016-08-20 00:29:58', '2016-08-25 16:46:38', null);
INSERT INTO `profiles` VALUES ('189', 'Everett', 'Ernser', 'amy74@gmail.com', '+1 (957) 561-3878', '97789312', '0', '0', '380', '2016-08-20 00:30:04', '2016-08-20 00:30:09', null);
INSERT INTO `profiles` VALUES ('190', 'Mireya', 'Barrows', 'okutch@lockman.com', '626.360.2402', '55547236', '0', '0', '386', '2016-08-20 00:30:09', '2016-08-20 00:30:15', null);
INSERT INTO `profiles` VALUES ('191', 'Devyn', 'Reynolds', 'tjohns@schuppe.biz', '(732) 578-0674', '8280878', '0', '0', '392', '2016-08-20 00:30:15', '2016-08-20 00:30:21', null);
INSERT INTO `profiles` VALUES ('192', 'Monserrat', 'Weber', 'jolie31@gerlach.biz', '219.904.3891', '28146046', '0', '0', '398', '2016-08-20 00:30:21', '2016-08-25 16:46:38', null);
INSERT INTO `profiles` VALUES ('193', 'Jimmy', 'Pagac', 'hauck.alexa@hotmail.com', '1-696-859-7319', '49358439', '0', '0', '404', '2016-08-20 00:30:26', '2016-08-20 00:30:32', null);
INSERT INTO `profiles` VALUES ('194', 'Cayla', 'Schroeder', 'godfrey.simonis@hotmail.com', '(482) 284-5175', '4985', '0', '1', '410', '2016-08-20 00:30:32', '2016-08-29 15:55:04', null);

-- ----------------------------
-- Table structure for voters
-- ----------------------------
DROP TABLE IF EXISTS `voters`;
CREATE TABLE `voters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cookie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of voters
-- ----------------------------
INSERT INTO `voters` VALUES ('39', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '', '', '6xg65RwlinvjgTkcVpELZdk3d4FH9F1o5YIVsQOu3OTTnnn2', '192', '2016-08-20 00:37:55', '2016-08-20 00:37:55');
INSERT INTO `voters` VALUES ('40', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '', '', 'MSfwuGOjiKyUXsHyIvpGhaIAziCVM3fXKQ7ikWcZG6xsSRuW', '187', '2016-08-20 00:41:04', '2016-08-20 00:41:04');
INSERT INTO `voters` VALUES ('41', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '', '', '71mEiYFRJSnKjEAhbze5t1q65Tac3EPRPOlAUmcVxSoc5ByL', '192', '2016-08-20 00:48:25', '2016-08-20 00:48:25');
INSERT INTO `voters` VALUES ('42', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '', '', '8am8YFTGeChjmIEq3d6cO2yogh8wii7Ot3Q2VJPumkOBu4vx', '188', '2016-08-20 00:51:50', '2016-08-20 00:51:50');
INSERT INTO `voters` VALUES ('43', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '', '', 'ktk9iro25ARKsHP54VVcm8V2SZgtlGQ8k1Gs2KcUMqOMcrR0', '186', '2016-08-20 00:51:53', '2016-08-20 00:51:53');
INSERT INTO `voters` VALUES ('44', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '', '', 'FcxUa9ICeO5S9lVWTcHDxVtG9364xwURWJ6IlK6kSEhFeLKl', '188', '2016-08-20 00:51:58', '2016-08-20 00:51:58');
INSERT INTO `voters` VALUES ('45', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '', '', 'tQaA9ZAMGkLBENNqcrMHB6kUKPDFUXr89mL4W15WaCGOB1Hg', '192', '2016-08-20 00:52:05', '2016-08-20 00:52:05');
INSERT INTO `voters` VALUES ('46', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '', '', '35psGGah7rm2BrEqrfjJACoCaQSt3vQzlhFbyILjcwjsX1tH', '188', '2016-08-20 00:52:08', '2016-08-20 00:52:08');
INSERT INTO `voters` VALUES ('47', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '', '', '35psGGah7rm2BrEqrfjJACoCaQSt3vQzlhFbyILjcwjsX1tH', '192', '2016-08-20 01:01:45', '2016-08-20 01:01:45');
INSERT INTO `voters` VALUES ('48', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '', '', '35psGGah7rm2BrEqrfjJACoCaQSt3vQzlhFbyILjcwjsX1tH', '186', '2016-08-20 01:01:53', '2016-08-20 01:01:53');
INSERT INTO `voters` VALUES ('49', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '', '', '35psGGah7rm2BrEqrfjJACoCaQSt3vQzlhFbyILjcwjsX1tH', '187', '2016-08-20 01:02:04', '2016-08-20 01:02:04');
INSERT INTO `voters` VALUES ('50', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '', '', 'XgnXsklif9cYTgzMOi5PaQxWqFxYquoPH3Iuh6jQmYL14fspXO', '192', '2016-08-24 15:42:44', '2016-08-24 15:42:44');
INSERT INTO `voters` VALUES ('51', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '', '', 'ZpbDykLLVezZNhhwekCG04oThb3exAQV4gqbNlSZVUEbB2Y7IU', '192', '2016-08-24 15:42:44', '2016-08-24 15:42:44');
INSERT INTO `voters` VALUES ('52', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '', '', 'ZpbDykLLVezZNhhwekCG04oThb3exAQV4gqbNlSZVUEbB2Y7IU', '187', '2016-08-25 16:11:41', '2016-08-25 16:11:41');
INSERT INTO `voters` VALUES ('53', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '', '', 'ZpbDykLLVezZNhhwekCG04oThb3exAQV4gqbNlSZVUEbB2Y7IU', '185', '2016-08-25 16:48:05', '2016-08-25 16:48:05');
INSERT INTO `voters` VALUES ('54', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '', '', 'ZpbDykLLVezZNhhwekCG04oThb3exAQV4gqbNlSZVUEbB2Y7IU', '186', '2016-08-25 16:48:40', '2016-08-25 16:48:40');
INSERT INTO `voters` VALUES ('60', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '', '', 'tLrabKku81aQf8igGfAj6YfkGGzO2PxREfShK5QTfSrtmumrpG', '187', '2016-08-29 21:52:54', '2016-08-29 21:52:54');
INSERT INTO `voters` VALUES ('61', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0', '', '', 'CadHXocLorPOeTuAeybQ2WEbu0xzW8ARzW1xuz7w0eM3rjGubp', '187', '2016-09-12 20:17:32', '2016-09-12 20:17:32');
INSERT INTO `voters` VALUES ('62', '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:49.0) Gecko/20100101 Firefox/49.0', '', '', '1h5J4uuW6BFX0PjBfhBO6PPXBXm1UlDNSPxCS9OpalKswS3tQr', '187', '2016-10-06 15:39:25', '2016-10-06 15:39:25');
