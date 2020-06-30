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

 Date: 01/07/2019 11:20:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tutorial
-- ----------------------------
DROP TABLE IF EXISTS `tutorial`;
CREATE TABLE `tutorial`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul_tutorial` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `deskripsi_tutorial` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `tipe_tutorial` enum('gambar','video','youtube','pdf') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `file` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `tampilkan` enum('publik','admin') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime(0) NULL DEFAULT NULL,
  `updated_at` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
