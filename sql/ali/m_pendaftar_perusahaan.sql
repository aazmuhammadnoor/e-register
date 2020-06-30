/*
 Navicat Premium Data Transfer

 Source Server         : LOCALHOST
 Source Server Type    : MySQL
 Source Server Version : 50634
 Source Host           : localhost
 Source Database       : dpmptsp_update

 Target Server Type    : MySQL
 Target Server Version : 50634
 File Encoding         : utf-8

 Date: 08/20/2019 15:42:26 PM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `m_pendaftar_perusahaan`
-- ----------------------------
DROP TABLE IF EXISTS `m_pendaftar_perusahaan`;
CREATE TABLE `m_pendaftar_perusahaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pendaftar` int(11) DEFAULT NULL,
  `jenis_perusahaan` enum('PERORANGAN (PO)','FIRMA (FA)','KOPERASI (KOP)','COMMANDITAIRE VENNOOTSCHAP (CV)','PERSEORAN TERBATAS (PT)','PERUSAHAN ASING (PA)','PERUSAHAAN LAIN (PL)','YAYASAN (YA)') DEFAULT NULL,
  `status_jabatan` enum('PEMILIK','DIREKTUR','DIREKTUR UTAMA','PENANGGUNG JAWAB','KEPALA CABANG') DEFAULT NULL,
  `nama_perusahaan` varchar(255) DEFAULT NULL,
  `alamat_perusahaan` varchar(255) DEFAULT NULL,
  `tlp_perusahaan` decimal(14,0) DEFAULT NULL,
  `npwp_perusahaan` decimal(18,0) DEFAULT NULL,
  `nomor_akte_pendirian` varchar(50) DEFAULT NULL,
  `tanggal_akte_pendirian` date DEFAULT NULL,
  `nama_notaris_pendirian` varchar(60) DEFAULT NULL,
  `modal_dasar_pendirian` varchar(30) DEFAULT NULL,
  `modal_ditempatkan_pendirian` varchar(30) DEFAULT NULL,
  `kedudukan_perusahaan` varchar(100) DEFAULT NULL,
  `nomor_akte_perubahan` varchar(50) DEFAULT NULL,
  `tanggal_akte_perubahan` date DEFAULT NULL,
  `nama_notaris_perubahan` varchar(60) DEFAULT NULL,
  `modal_dasar_perubahan` varchar(30) DEFAULT NULL,
  `modal_ditempatkan_perubahan` varchar(30) DEFAULT NULL,
  `kegiatan_utama` enum('KESEHATAN','SOSIAL','PERDAGANGAN','RETAIL','JASA KONSTRUKSI','PENGADAAN BARANG JASA','WARALABA') DEFAULT NULL,
  `no_ahu` varchar(35) DEFAULT NULL,
  `direktur` varchar(255) DEFAULT NULL,
  `komisaris_utama` varchar(255) DEFAULT NULL,
  `komisaris` varchar(255) DEFAULT NULL,
  `saham_direktur` varchar(16) DEFAULT NULL,
  `saham_komisaris_utama` varchar(16) DEFAULT NULL,
  `saham_komisaris` varchar(16) DEFAULT NULL,
  `status_perusahaan` enum('PUSAT','CABANG','CABANG PEMBANTU','FRANCHISE') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id_pendaftar` (`id_pendaftar`) USING BTREE,
  CONSTRAINT `m_pendaftar_perusahaan_ibfk_1` FOREIGN KEY (`id_pendaftar`) REFERENCES `m_pendaftar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

SET FOREIGN_KEY_CHECKS = 1;
