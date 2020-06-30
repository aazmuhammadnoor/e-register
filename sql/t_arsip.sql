/*
 Navicat Premium Data Transfer

 Source Server         : MYSQL-LOCAL
 Source Server Type    : MySQL
 Source Server Version : 100136
 Source Host           : 127.0.0.1:3306
 Source Schema         : palembang_izin

 Target Server Type    : MySQL
 Target Server Version : 100136
 File Encoding         : 65001

 Date: 15/06/2019 11:45:43
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for t_arsip
-- ----------------------------
DROP TABLE IF EXISTS `t_arsip`;
CREATE TABLE `t_arsip`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul_arsip` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nomor_rak` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal_arsip` date NULL DEFAULT NULL,
  `upload_scan` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_permohonan` int(10) UNSIGNED NULL DEFAULT NULL,
  `id_petugas` int(10) UNSIGNED NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_permohonan`(`id_permohonan`) USING BTREE,
  INDEX `id_petugas`(`id_petugas`) USING BTREE,
  CONSTRAINT `t_arsip_ibfk_1` FOREIGN KEY (`id_permohonan`) REFERENCES `permohonan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_arsip_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
