/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100137
 Source Host           : localhost:3306
 Source Schema         : palembang_fix

 Target Server Type    : MySQL
 Target Server Version : 100137
 File Encoding         : 65001

 Date: 14/06/2019 00:57:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for m_pendaftar_transportasi
-- ----------------------------
DROP TABLE IF EXISTS `m_pendaftar_transportasi`;
CREATE TABLE `m_pendaftar_transportasi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pendaftar` int(11) NULL DEFAULT NULL,
  `nomor_kendaraan` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nomor_rangka` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nomor_mesin` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tahun_pembuatan` char(4) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_pada_stnk` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_pendaftar`(`id_pendaftar`) USING BTREE,
  CONSTRAINT `m_pendaftar_transportasi_ibfk_1` FOREIGN KEY (`id_pendaftar`) REFERENCES `m_pendaftar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
