/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : perijinan_palembang

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 04/05/2019 01:50:09
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for t_tim_survey
-- ----------------------------
DROP TABLE IF EXISTS `t_tim_survey`;
CREATE TABLE `t_tim_survey`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_dinas` int(10) UNSIGNED NULL DEFAULT NULL,
  `users` int(10) UNSIGNED NULL DEFAULT NULL,
  `nip` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jabatan` enum('Koordinator','Anggota') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Anggota',
  `instansi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `created_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_tim_survey
-- ----------------------------
INSERT INTO `t_tim_survey` VALUES (2, 2, 36, '12424324', 'Koordinator', 'Univ Palembang', '2019-05-04 01:35:30', '2019-05-04 01:35:30');
INSERT INTO `t_tim_survey` VALUES (3, 2, 37, '123400000', 'Koordinator', 'AKBID Palembang', '2019-05-04 01:45:45', '2019-05-04 01:45:45');

SET FOREIGN_KEY_CHECKS = 1;
