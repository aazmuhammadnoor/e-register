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

 Date: 14/06/2019 00:56:11
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for t_permohonan_perusahaan
-- ----------------------------
DROP TABLE IF EXISTS `t_permohonan_perusahaan`;
CREATE TABLE `t_permohonan_perusahaan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_permohonan` int(11) NULL DEFAULT NULL,
  `jenis_perusahaan` enum('PERORANGAN (PO)','FIRMA (FA)','KOPERASI (KOP)','COMMANDITAIRE VENNOOTSCHAP (CV)','PERSEORAN TERBATAS (PT)','PERUSAHAN ASING (PA)','PERUSAHAAN LAIN (PL)','YAYASAN (YA)') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status_jabatan` enum('PEMILIK','DIREKTUR','DIREKTUR UTAMA','PENANGGUNG JAWAB','KEPALA CABANG') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_perusahaan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat_perusahaan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nomor_akte_pendirian` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal_akte_pendirian` date NULL DEFAULT NULL,
  `nama_notaris_pendirian` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `modal_dasar_pendirian` decimal(30, 0) NULL DEFAULT NULL,
  `modal_ditempatkan_pendirian` decimal(30, 0) NULL DEFAULT NULL,
  `nomor_akte_perubahan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal_akte_perubahan` date NULL DEFAULT NULL,
  `nama_notaris_perubahan` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `modal_dasar_perubahan` decimal(30, 0) NULL DEFAULT NULL,
  `modal_ditempatkan_perubahan` decimal(30, 0) NULL DEFAULT NULL,
  `kegiatan_utama` enum('KESEHATAN','SOSIAL','PERDAGANGAN','RETAIL','JASA KONSTRUKSI','PENGADAAN BARANG JASA','WARALABA') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_pendaftar`(`id_permohonan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_permohonan_perusahaan
-- ----------------------------
INSERT INTO `t_permohonan_perusahaan` VALUES (1, 50, 'COMMANDITAIRE VENNOOTSCHAP (CV)', 'PEMILIK', NULL, NULL, 'akta 0123', '2017-03-01', 'Fulan', 0, 0, NULL, NULL, NULL, NULL, NULL, 'KESEHATAN', '2019-06-12 16:19:53', '2019-06-12 16:19:53');
INSERT INTO `t_permohonan_perusahaan` VALUES (2, 50, 'COMMANDITAIRE VENNOOTSCHAP (CV)', 'PEMILIK', NULL, NULL, 'akta 0123', '2017-03-01', 'Fulan', 0, 0, NULL, NULL, NULL, NULL, NULL, 'KESEHATAN', '2019-06-12 16:36:07', '2019-06-12 16:36:07');

SET FOREIGN_KEY_CHECKS = 1;
