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

 Date: 14/06/2019 00:57:30
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for t_permohonan_reklame
-- ----------------------------
DROP TABLE IF EXISTS `t_permohonan_reklame`;
CREATE TABLE `t_permohonan_reklame`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_permohonan` int(11) NULL DEFAULT NULL,
  `jenis_advertising` enum('PERORANGAN (PO)','FIRMA (FA)','KOPERASI (KOP)','Commanditaire Vennootschap (CV)','PERSEORAN TERBATAS (PT)') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_perusahaan` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `provinsi` int(5) NULL DEFAULT NULL,
  `kabupaten` int(5) NULL DEFAULT NULL,
  `kecamatan` int(5) NULL DEFAULT NULL,
  `kelurahan` int(5) NULL DEFAULT NULL,
  `rw` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `rt` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kode_pos` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_pendaftar`(`id_permohonan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
