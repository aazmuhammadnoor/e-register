/*
 Navicat Premium Data Transfer

 Source Server         : MYSQL-LOCAL
 Source Server Type    : MySQL
 Source Server Version : 100136
 Source Host           : 127.0.0.1:3306
 Source Schema         : dpmptsp_palembang

 Target Server Type    : MySQL
 Target Server Version : 100136
 File Encoding         : 65001

 Date: 16/06/2019 12:15:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent` int(11) NULL DEFAULT NULL,
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'icon fa fa-caret-right',
  `urutan` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 83 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (22, NULL, 'Referensi', '#', 'icon ti-panel', 2, '2017-10-25 17:11:46', '2017-11-02 05:27:47');
INSERT INTO `menu` VALUES (23, 22, 'Persyaratan Perizinan', 'referensi/persyaratan', 'icon ti-minus', 1, '2017-10-25 17:17:31', '2019-02-05 16:51:45');
INSERT INTO `menu` VALUES (24, 22, 'Daftar Perizinan', 'referensi/kategori-dinas', 'icon ti-angle-right', 2, '2017-10-25 17:18:19', '2019-02-05 16:51:14');
INSERT INTO `menu` VALUES (26, NULL, 'Beranda', 'home', 'icon ti-home', 1, '2017-10-26 02:13:13', '2017-10-26 02:13:13');
INSERT INTO `menu` VALUES (28, 22, 'Daerah Administrasi', 'referensi/provinsi', 'icon ti-angle-right', NULL, '2017-10-26 06:12:25', '2019-01-28 02:30:17');
INSERT INTO `menu` VALUES (29, 22, 'Fungsi Bangunan', 'referensi/fungsi-bangunan', 'icon ti-angle-right', NULL, '2017-10-26 06:13:01', '2017-10-26 06:23:26');
INSERT INTO `menu` VALUES (30, 22, 'Bahan Konstruksi', 'referensi/bahan-konstruksi', 'icon ti-angle-right', NULL, '2017-10-26 06:15:07', '2017-10-26 06:18:58');
INSERT INTO `menu` VALUES (31, 22, 'Jenis Reklame', 'referensi/jenis-reklame', 'icon ti-angle-right', NULL, '2017-10-26 06:16:16', '2017-10-26 06:18:50');
INSERT INTO `menu` VALUES (32, 22, 'Status Penggunaan', 'referensi/status-penggunaan', 'icon ti-angle-right', NULL, '2017-10-26 06:18:42', '2017-10-26 06:18:42');
INSERT INTO `menu` VALUES (33, 22, 'Kondisi Tanah', 'referensi/kondisi-tanah', 'icon ti-angle-right', NULL, '2017-10-26 06:20:01', '2017-10-26 06:20:01');
INSERT INTO `menu` VALUES (34, 22, 'Klasifikasi Usaha', 'referensi/klasifikasi-usaha', 'icon ti-angle-right', NULL, '2017-10-26 06:20:58', '2017-10-26 06:20:58');
INSERT INTO `menu` VALUES (35, NULL, 'Perizinan', '#', 'icon ti-server', 3, '2017-11-01 10:00:46', '2017-11-16 04:22:28');
INSERT INTO `menu` VALUES (36, 35, 'Pendaftaran Baru', 'perizinan/pendaftaran', 'icon ti-server', 1, '2017-11-01 10:01:07', '2017-11-01 10:01:07');
INSERT INTO `menu` VALUES (37, 35, 'List Pendaftaran', 'perizinan/pendaftaran/list', 'icon ti-server', NULL, '2017-11-02 03:49:44', '2017-11-02 03:49:44');
INSERT INTO `menu` VALUES (41, 35, 'Verifikasi Data Teknis', 'verifikasi/list', 'icon ti-server', NULL, '2017-11-07 17:00:59', '2017-11-16 04:19:26');
INSERT INTO `menu` VALUES (42, 35, 'Permohonan Proses Tinjau', 'perizinan/tinjau', 'icon ti-server', NULL, '2017-11-07 17:20:55', '2017-11-16 04:21:24');
INSERT INTO `menu` VALUES (43, 35, 'Permohonan Ditolak', 'perizinan/ditolak', 'icon ti-server', NULL, '2017-11-07 17:21:50', '2017-11-16 04:21:38');
INSERT INTO `menu` VALUES (44, 35, 'Pengetikan Draft Keputusan', 'perizinan/draft', 'icon ti-server', NULL, '2017-11-16 04:25:28', '2017-11-16 04:28:10');
INSERT INTO `menu` VALUES (49, 35, 'Semua Permohonan', 'perizinan/semua-permohonan', 'icon ti-server', NULL, '2017-11-16 14:25:51', '2017-11-16 14:25:51');
INSERT INTO `menu` VALUES (51, 22, 'Konfiguasi Retribusi', 'referensi/retribusi', 'icon ti-server', NULL, '2017-12-14 10:29:04', '2017-12-14 10:29:04');
INSERT INTO `menu` VALUES (52, 35, 'Permohonan Masuk', 'admin/proses/pendaftaran', 'icon ti-server', NULL, '2019-01-16 11:18:22', '2019-02-18 12:31:13');
INSERT INTO `menu` VALUES (53, 35, 'Persetujuan Berkas', 'admin/proses/kasi/approval-berkas', 'icon ti-server', NULL, '2019-01-16 22:34:44', '2019-02-18 12:39:17');
INSERT INTO `menu` VALUES (54, 35, 'Pembahasan Teknis', 'admin/proses/korlap', 'icon ti-server', NULL, '2019-01-16 23:45:17', '2019-02-18 12:40:43');
INSERT INTO `menu` VALUES (55, 35, 'Persetujuan Draft SK', 'admin/proses/kasi/draft', 'icon ti-server', NULL, '2019-01-17 00:05:50', '2019-02-18 12:41:50');
INSERT INTO `menu` VALUES (56, 35, 'Persetujuan Draft SK', 'admin/proses/kabid', 'icon ti-server', NULL, '2019-01-17 00:33:24', '2019-02-19 11:43:01');
INSERT INTO `menu` VALUES (57, 35, 'Tanda Tangan Draft SK', 'admin/proses/kadin', 'icon ti-server', NULL, '2019-01-17 00:34:20', '2019-02-19 11:43:28');
INSERT INTO `menu` VALUES (58, 22, 'Kategori Sarana Kesehatan', 'referensi/kategori-sarana-kesehatan', 'icon ti-angle-right', NULL, '2019-01-28 02:24:09', '2019-01-28 02:24:09');
INSERT INTO `menu` VALUES (59, 22, 'Type Sarana Kesehatan', 'referensi/type-sarana-kesehatan', 'icon ti-angle-right', NULL, '2019-01-28 02:24:45', '2019-01-28 02:24:45');
INSERT INTO `menu` VALUES (60, 22, 'Sarana Kesehatan', 'referensi/sarana-kesehatan', 'icon ti-angle-right', NULL, '2019-01-28 02:25:18', '2019-01-28 02:25:18');
INSERT INTO `menu` VALUES (61, 22, 'Agama', 'referensi/agama', 'icon ti-angle-right', NULL, '2019-01-28 02:25:49', '2019-01-28 02:25:49');
INSERT INTO `menu` VALUES (62, NULL, 'Laporan', '#', 'icon ti-files', 4, '2019-01-28 02:26:18', '2019-01-28 02:26:18');
INSERT INTO `menu` VALUES (63, 62, 'Rekapitulasi Data Member', 'laporan/rekapitulasi-member', 'icon ti-angle-right', NULL, '2019-01-28 02:26:48', '2019-01-28 02:26:48');
INSERT INTO `menu` VALUES (64, 62, 'Data Profil Member', 'laporan/profile-member', 'icon ti-angle-right', NULL, '2019-01-28 02:27:12', '2019-01-28 02:27:12');
INSERT INTO `menu` VALUES (65, 35, 'Cetak SK', 'admin/proses/cetak-sk', 'icon ti-server', NULL, '2019-02-18 12:49:00', '2019-02-18 12:49:00');
INSERT INTO `menu` VALUES (66, 35, 'Pengambilan SK', 'admin/proses/pengambilan', 'icon ti-server', NULL, '2019-02-19 11:45:25', '2019-02-19 11:45:25');
INSERT INTO `menu` VALUES (67, 35, 'Daftar Permohonan', 'admin/proses/permohonan', 'icon ti-server', NULL, '2019-02-19 11:51:20', '2019-02-19 11:51:20');
INSERT INTO `menu` VALUES (68, NULL, 'Pencabutan Izin', '#', 'icon ti-unlink', NULL, '2019-03-19 07:32:40', '2019-03-19 07:32:40');
INSERT INTO `menu` VALUES (69, 68, 'Pemeriksaan Berkas', 'admin/pencabutan/pendaftaran', 'icon ti-unlink', NULL, '2019-03-19 07:33:45', '2019-03-19 07:33:45');
INSERT INTO `menu` VALUES (70, 68, 'Penyusunan Draft', 'admin/pencabutan/kasi', 'icon ti-unlink', NULL, '2019-03-19 07:34:49', '2019-03-19 07:34:49');
INSERT INTO `menu` VALUES (71, 68, 'Persetujuan Draft SK', 'admin/pencabutan/kabid', 'icon ti-unlink', NULL, '2019-03-19 07:35:49', '2019-03-19 07:35:49');
INSERT INTO `menu` VALUES (72, 68, 'Persetujuan Draft SK', 'admin/pencabutan/kadin', 'icon ti-unlink', NULL, '2019-03-19 07:38:00', '2019-03-19 07:38:00');
INSERT INTO `menu` VALUES (73, 68, 'Pengambilan SK', 'admin/pencabutan/pengambilan', 'icon ti-unlink', NULL, '2019-03-19 07:38:44', '2019-03-19 07:38:44');
INSERT INTO `menu` VALUES (74, 68, 'Arsip', 'admin/pencabutan/arsip', 'icon ti-unlink', NULL, '2019-03-19 07:39:32', '2019-03-19 07:39:32');
INSERT INTO `menu` VALUES (75, 35, 'Survey', 'admin/proses/tim-teknis', 'icon ti-server', NULL, '2019-03-24 10:37:04', '2019-03-24 10:37:04');
INSERT INTO `menu` VALUES (76, 35, 'BAP Rekomendasi Teknis', 'admin/proses/korlap/bap', 'icon ti-server', NULL, '2019-03-24 10:38:24', '2019-03-24 10:38:24');
INSERT INTO `menu` VALUES (77, 35, 'Arsip', 'admin/proses/arsip', 'icon ti-server', NULL, '2019-03-25 14:57:21', '2019-03-25 14:57:21');
INSERT INTO `menu` VALUES (78, 35, 'Cetak SPM', 'admin/proses/cetak-spm', 'icon ti-server', NULL, '2019-04-02 15:34:20', '2019-04-02 15:34:20');
INSERT INTO `menu` VALUES (79, 35, 'Verifikasi Pembayaran', 'admin/proses/bendahara', 'icon ti-server', NULL, '2019-04-02 15:35:02', '2019-04-02 15:35:02');
INSERT INTO `menu` VALUES (80, 35, 'SKRD', 'admin/proses/skrd', 'icon ti-server', NULL, '2019-04-02 15:35:54', '2019-04-02 15:35:54');
INSERT INTO `menu` VALUES (81, 35, 'Pemeriksaan Berkas', 'admin/proses/pendaftaran', 'icon ti-server', NULL, '2019-04-25 16:13:20', '2019-04-25 16:13:20');
INSERT INTO `menu` VALUES (82, NULL, 'Arsip SK', 'admin/proses/arsip-sk', 'icon ti-receipt', NULL, '2019-06-15 09:24:15', '2019-06-16 12:09:18');

-- ----------------------------
-- Table structure for menu_role
-- ----------------------------
DROP TABLE IF EXISTS `menu_role`;
CREATE TABLE `menu_role`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NULL DEFAULT NULL,
  `menu_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 278 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of menu_role
-- ----------------------------
INSERT INTO `menu_role` VALUES (72, 1, 26);
INSERT INTO `menu_role` VALUES (73, 2, 26);
INSERT INTO `menu_role` VALUES (74, 3, 26);
INSERT INTO `menu_role` VALUES (75, 4, 26);
INSERT INTO `menu_role` VALUES (76, 5, 26);
INSERT INTO `menu_role` VALUES (79, 8, 26);
INSERT INTO `menu_role` VALUES (80, 8, 27);
INSERT INTO `menu_role` VALUES (89, 1, 35);
INSERT INTO `menu_role` VALUES (90, 8, 35);
INSERT INTO `menu_role` VALUES (97, 1, 38);
INSERT INTO `menu_role` VALUES (98, 8, 38);
INSERT INTO `menu_role` VALUES (114, 8, 45);
INSERT INTO `menu_role` VALUES (116, 8, 47);
INSERT INTO `menu_role` VALUES (120, 3, 35);
INSERT INTO `menu_role` VALUES (122, 3, 45);
INSERT INTO `menu_role` VALUES (123, 3, 46);
INSERT INTO `menu_role` VALUES (124, 1, 47);
INSERT INTO `menu_role` VALUES (125, 3, 47);
INSERT INTO `menu_role` VALUES (131, 8, 51);
INSERT INTO `menu_role` VALUES (138, 10, 35);
INSERT INTO `menu_role` VALUES (146, 11, 35);
INSERT INTO `menu_role` VALUES (147, 11, 46);
INSERT INTO `menu_role` VALUES (158, 8, 46);
INSERT INTO `menu_role` VALUES (161, 1, 52);
INSERT INTO `menu_role` VALUES (178, 8, 62);
INSERT INTO `menu_role` VALUES (184, 4, 35);
INSERT INTO `menu_role` VALUES (185, 5, 35);
INSERT INTO `menu_role` VALUES (188, 1, 67);
INSERT INTO `menu_role` VALUES (189, 2, 67);
INSERT INTO `menu_role` VALUES (190, 3, 67);
INSERT INTO `menu_role` VALUES (191, 4, 67);
INSERT INTO `menu_role` VALUES (192, 5, 67);
INSERT INTO `menu_role` VALUES (193, 8, 67);
INSERT INTO `menu_role` VALUES (194, 11, 67);
INSERT INTO `menu_role` VALUES (201, 2, 35);
INSERT INTO `menu_role` VALUES (204, 11, 26);
INSERT INTO `menu_role` VALUES (208, 1, 68);
INSERT INTO `menu_role` VALUES (209, 11, 68);
INSERT INTO `menu_role` VALUES (210, 16, 68);
INSERT INTO `menu_role` VALUES (211, 17, 68);
INSERT INTO `menu_role` VALUES (212, 27, 68);
INSERT INTO `menu_role` VALUES (213, 28, 68);
INSERT INTO `menu_role` VALUES (216, 16, 71);
INSERT INTO `menu_role` VALUES (217, 17, 72);
INSERT INTO `menu_role` VALUES (218, 27, 73);
INSERT INTO `menu_role` VALUES (219, 28, 74);
INSERT INTO `menu_role` VALUES (226, 1, 22);
INSERT INTO `menu_role` VALUES (227, 1, 23);
INSERT INTO `menu_role` VALUES (228, 1, 24);
INSERT INTO `menu_role` VALUES (229, 6, 26);
INSERT INTO `menu_role` VALUES (230, 7, 26);
INSERT INTO `menu_role` VALUES (231, 9, 26);
INSERT INTO `menu_role` VALUES (232, 10, 26);
INSERT INTO `menu_role` VALUES (233, 12, 26);
INSERT INTO `menu_role` VALUES (234, 13, 26);
INSERT INTO `menu_role` VALUES (235, 1, 28);
INSERT INTO `menu_role` VALUES (236, 1, 29);
INSERT INTO `menu_role` VALUES (237, 1, 30);
INSERT INTO `menu_role` VALUES (238, 1, 32);
INSERT INTO `menu_role` VALUES (239, 1, 33);
INSERT INTO `menu_role` VALUES (240, 1, 34);
INSERT INTO `menu_role` VALUES (241, 6, 35);
INSERT INTO `menu_role` VALUES (242, 7, 35);
INSERT INTO `menu_role` VALUES (243, 9, 35);
INSERT INTO `menu_role` VALUES (244, 12, 35);
INSERT INTO `menu_role` VALUES (245, 13, 35);
INSERT INTO `menu_role` VALUES (246, 2, 69);
INSERT INTO `menu_role` VALUES (247, 8, 79);
INSERT INTO `menu_role` VALUES (248, 9, 80);
INSERT INTO `menu_role` VALUES (249, 7, 78);
INSERT INTO `menu_role` VALUES (250, 13, 77);
INSERT INTO `menu_role` VALUES (251, 4, 76);
INSERT INTO `menu_role` VALUES (252, 5, 75);
INSERT INTO `menu_role` VALUES (253, 6, 67);
INSERT INTO `menu_role` VALUES (254, 7, 67);
INSERT INTO `menu_role` VALUES (255, 9, 67);
INSERT INTO `menu_role` VALUES (256, 10, 67);
INSERT INTO `menu_role` VALUES (257, 12, 67);
INSERT INTO `menu_role` VALUES (258, 13, 67);
INSERT INTO `menu_role` VALUES (259, 12, 66);
INSERT INTO `menu_role` VALUES (260, 6, 65);
INSERT INTO `menu_role` VALUES (261, 11, 57);
INSERT INTO `menu_role` VALUES (262, 10, 56);
INSERT INTO `menu_role` VALUES (263, 3, 70);
INSERT INTO `menu_role` VALUES (264, 4, 54);
INSERT INTO `menu_role` VALUES (266, 2, 81);
INSERT INTO `menu_role` VALUES (267, 1, 60);
INSERT INTO `menu_role` VALUES (268, 1, 59);
INSERT INTO `menu_role` VALUES (269, 1, 58);
INSERT INTO `menu_role` VALUES (270, 1, 61);
INSERT INTO `menu_role` VALUES (271, 1, 31);
INSERT INTO `menu_role` VALUES (272, 3, 53);
INSERT INTO `menu_role` VALUES (273, 3, 55);
INSERT INTO `menu_role` VALUES (274, 1, 64);
INSERT INTO `menu_role` VALUES (275, 1, 63);
INSERT INTO `menu_role` VALUES (276, 1, 82);
INSERT INTO `menu_role` VALUES (277, 11, 82);

SET FOREIGN_KEY_CHECKS = 1;
