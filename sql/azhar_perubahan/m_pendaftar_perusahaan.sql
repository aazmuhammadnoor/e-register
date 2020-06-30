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

 Date: 14/06/2019 00:56:30
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for m_pendaftar_perusahaan
-- ----------------------------
DROP TABLE IF EXISTS `m_pendaftar_perusahaan`;
CREATE TABLE `m_pendaftar_perusahaan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pendaftar` int(11) NULL DEFAULT NULL,
  `jenis_perusahaan` enum('PERORANGAN (PO)','FIRMA (FA)','KOPERASI (KOP)','COMMANDITAIRE VENNOOTSCHAP (CV)','PERSEORAN TERBATAS (PT)','PERUSAHAN ASING (PA)','PERUSAHAAN LAIN (PL)','YAYASAN (YA)') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `status_jabatan` enum('PEMILIK','DIREKTUR','DIREKTUR UTAMA','PENANGGUNG JAWAB','KEPALA CABANG') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama_perusahaan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat_perusahaan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nomor_akte_pendirian` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal_akte_pendirian` date NULL DEFAULT NULL,
  `nama_notaris_pendirian` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `modal_dasar_pendirian` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `modal_ditempatkan_pendirian` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kedudukan_perusahaan` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nomor_akte_perubahan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tanggal_akte_perubahan` date NULL DEFAULT NULL,
  `nama_notaris_perubahan` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `modal_dasar_perubahan` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `modal_ditempatkan_perubahan` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kegiatan_utama` enum('KESEHATAN','SOSIAL','PERDAGANGAN','RETAIL','JASA KONSTRUKSI','PENGADAAN BARANG JASA','WARALABA') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT CURRENT_TIMESTAMP(0) ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_pendaftar`(`id_pendaftar`) USING BTREE,
  CONSTRAINT `m_pendaftar_perusahaan_ibfk_1` FOREIGN KEY (`id_pendaftar`) REFERENCES `m_pendaftar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
