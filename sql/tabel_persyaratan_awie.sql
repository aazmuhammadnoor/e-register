/*
 Navicat Premium Data Transfer

 Source Server         : xampp-php-7.0.2
 Source Server Type    : MySQL
 Source Server Version : 100110
 Source Host           : localhost:3306
 Source Schema         : perizinan_palembang

 Target Server Type    : MySQL
 Target Server Version : 100110
 File Encoding         : 65001

 Date: 28/06/2019 10:59:34
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for persyaratan
-- ----------------------------
DROP TABLE IF EXISTS `persyaratan`;
CREATE TABLE `persyaratan`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` int(11) NULL DEFAULT 1,
  `aktif` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 232 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of persyaratan
-- ----------------------------
INSERT INTO `persyaratan` VALUES (1, 'Akte pendirian yayasan (jika berbentuk yayasan)', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (2, 'Alur proses pengolahan air minum', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (3, 'Bagan Alir Proses Kegiatan dan/ Usaha.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (4, 'Bagi pendirian atau bangunan yang berada ditanah rawa reklamasi dan/atau tanah rawa budidaya yang luasnya 1000m2 (seribu meter persegi) atau lebih melampirkan rekomendasi dari Dinas PU Bina Marga dan PSDA.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (5, 'Bahwa saya bersedia melakukan pengolahan limbah cair sesuai dengan ketentuan dan peraturan perundang-undangan yang berlaku dan apabila kami melanggar ketentuan tersebut, kami bersedia dituntut sesuai dengan hukum dan perundang-undangan yang berlaku.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (6, 'Bahwa saya bertanggung jawab akan tetap melakukan pemeliharaan terhadap peralatan ukur debit atau bangunan ukur air untuk kegiatan dan usaha', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (7, 'Bahwa saya bertanggung jawab untuk melaksanakan pembayaran ganti rugi atas pemulihan kualitas badan penerima air yang tercemar akibat pembuangan limbah cair dari kegiatan/usaha tersebut.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (8, 'Berijazah SLTA dengan pengalaman kerja minimal 10 (sepuluh) tahun pada aktifitas penambangan;Keterangan kesanggupan, daftar riwayat pekerjaan, photocopy KTP dan photocopy Ijazah yang telah dilegalisir.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (9, 'Bersedia melaksanakan keutamaan hygiene sanitasi produk yang dihasilkan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (10, 'Bersedia menerima petugas pemeriksa, pementau dan evaluasi dari pemerintah atau dari lembaga/ badan lain yang di perlukan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (11, 'Bersedia menjaga keamanan, ketertiban dan kebersihan lingkungan setempat.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (12, 'Bersedia untuk menggeser/membongkar/merubah bentuk reklame yang saya mohonkan tersebut diatas apabila sewaktu-waktu pihak pemerintah kota palembang dalam hal ini dinas tata kota palembang menghendaki hal tersebut dikarenakan sesuatu hal yang berkenaan dengan penataan/keindahan/ketertiban.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (13, 'Bertanggung jawab sepenuhnya dan mengganti segala kerugian yang ada apabila terjadi peristiwa kegagalan kontruksi/roboh/runtuh dari Penyelenggaraan Reklame yang saya mohonkan ini.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (14, 'Contoh label kemasan', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (15, 'Daftar identitas tenaga kerja (pramu pijat).', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (16, 'Daftar identitas Tenaga Kerja dan Pas photo ukuran 3x4 sebanyak 2 (dua) lembar.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (17, 'Daftar peralatan Apotik dan tenaga teknis kefarmasian', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (18, 'Daftar peralatan dan obat-obatan', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (19, 'Daftar Peralatan Obat-obatan', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (20, 'Daftar Peralatan Perusahaan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (21, 'Daftar peralatan, obat-obatan dan Denah Ruangan', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (22, 'Daftar rincian peralatan Optik', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (23, 'Daftar Riwayat Hidup Penanggungjawab Usaha.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (24, 'Daftar tenaga kesehatan dan struktur organisasi', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (25, 'Daftar tenaga kesehatan dan struktur organisasi pelayanan kesehatan', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (26, 'Denah Bangunan', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (27, 'Denah Ruangan', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (28, 'Denah Ruangan dan Struktur organisasi optikal', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (29, 'Dokumen kajian lingkungan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (30, 'foto kopi KTP yang masih berlaku 3 (tiga) lembar.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (31, 'Fotokopi  Surat Ijin Gangguan berdomisili di palembang.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (32, 'Fotokopi advice planning.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (33, 'Fotokopi akta pendirian BUJK dan Akte Perubahan, (apabila ada).', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (34, 'Fotokopi akta perubahan nama BUJK dan/atau.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (35, 'Fotokopi akta perubahan nama direksi/pengurus untuk perubahan data nama direksi/ pengurus.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (36, 'Fotokopi Akte Pendirian Perusahaan (Badan)', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (37, 'Fotokopi Akte Pendirian Perusahaan bagi pemohon berbentuk badan', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (38, 'Fotokopi Akte Pendirian Perusahaan bagi perusahaan berbentuk badan', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (39, 'Fotokopi BPKB (bila sudah ada).', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (40, 'Fotokopi bukti penguasaan tanah yang disahkan oleh pejabat berwenang.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (41, 'Fotokopi Buku Uji (bila sudah ada)', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (42, 'Fotokopi daftar peralatan apotik.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (43, 'Fotokopi ijazah', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (44, 'Fotokopi ijazah   Refraksionis Optisien (RO)', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (45, 'Fotokopi ijazah dan ijin kerja perawat atau perawat gigi dan tenaga paramedis lain (sesuai kebutuhan)', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (46, 'Fotokopi ijazah dan ijin kerja perawat serta tenaga paramedis lain (sesuai kebutuhan)', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (47, 'Fotokopi ijazah dan surat Ijin praktek tenaga teknis kefarmasian', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (48, 'Fotokopi Ijazah Dokter', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (49, 'Fotokopi Ijin Gangguan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (50, 'Fotokopi Kartu Penanggungjawab Teknik Badan Usaha (PJT-BU)', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (51, 'Fotokopi Kartu Pengawasan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (52, 'Fotokopi Kartu Tanda Penduduk (KTP) Pemohon.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (53, 'Fotokopi Kartu Tanda Penduduk (KTP) yang masih berlaku', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (54, 'Fotokopi kartuTanda Anggota (KTA) perusahaan bila BUJK yang bersangkutan tergabung dalam asosiasi.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (55, 'Fotokopi KTP 1 (satu) lembar  dan Pas foto 3x4cm 3 (tiga) lembar Pemohon', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (56, 'Fotokopi KTP 1 (satu) lembar dan Pas foto 3x4cm 2 (dua) lembar Pemohon', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (57, 'Fotokopi KTP Penanggungjawab Badan Usaha.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (58, 'Fotokopi KTP, NPWP, Ijazah Pendidikan Formal, SKA, SKT Tenaga ahli/ terampil BUJK.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (59, 'Fotokopi KTP, SKT Tenaga ahli/Terampil BUJK dalam hal terjadi pengantian pegawai.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (60, 'Fotokopi NPWP', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (61, 'Fotokopi NPWP Perusahaan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (62, 'Fotokopi pengesahan kehakiman perusahaan bagi BUJK yang berbentuk perseroan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (63, 'Fotokopi perjanjian kerjasama antara apoteker dan pemilik sarana apotik (akta notaris)', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (64, 'Fotokopi Sarana Pendaftaran Kapal.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (65, 'Fotokopi SBU yang masih berlaku dan telah diregistrasi lembaga.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (66, 'Fotokopi Sertifikat Badan Usaha (SBU) yang masih berlaku untuk perubahan Klasifikasi dan kualifikasi usaha.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (67, 'Fotokopi Sertifikat Keahlian (SKA) dan/atau sertifikat keterampilan (SKT) dari penanggungjawab Teknik Badan Usaha (PJT-BU) yang telah diregistrasi lembaga..', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (68, 'Fotokopi Sertifikat keahlian (SKA) dan/atau sertifikat keterampilan (SKT) dari Penanggungjawab Teknik Badan Usaha (PJT-BU) yang telah diregistrasi LPJK.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (69, 'Fotokopi Sertifikat Kesempurnaan Kapal', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (70, 'Fotokopi sertifikat/ keterangan pengalaman kerja sebagai pramu pijat. ', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (71, 'Fotokopi SIP Dokter, Surat Ijin Bidan (SIB) dan Surat Ijin Kerja Bidan(SIKB), Surat Ijin Perawat (SIP) dan Surat Ijin Kerja (SIK) yang berpraktik atau kerja pada rumah bersalin tersebut', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (72, 'Fotokopi SIUP berdomisili di kota palembang.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (73, 'Fotokopi STNK', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (74, 'Fotokopi STNK (bila belum ada harus dilampirkan photocopy faktur pembelian)', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (75, 'Fotokopi STRA dari Menteri Kesehatan yang dilegalisir', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (76, 'Fotokopi STRTTK dari Dinas Kesehatan Provinsi yang dilegalisir', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (77, 'Fotokopi Surat Ijin Gangguan', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (78, 'Fotokopi Surat Ijin Gangguan, Surat Ijin Usaha Perdagangan (SIUP) dan Tanda Daftar Perusahaan (TDP)', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (79, 'Fotokopi Surat Ijin Gangguan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (80, 'Fotokopi Surat Ijin Praktek Dokter Penanggung jawab', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (81, 'Fotokopi surat ijin praktek dokter Penanggung jawab  dan Fotokopi surat tanda registrasi (STR).', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (82, 'Fotokopi surat ijin praktek dokter penanggung jawab pada balai pengobatan tersebut (Surat keterangan dalam proses pengurusan) dan fotokopi Surat Tanda Registrasi (STR)', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (83, 'Fotokopi surat ijin praktek dokter penanggung jawab pada balai pengobatan tersebut (Surat keterangan dalam proses pengurusan) dan fotokopi Surat Tanda Registrasi (STR) dan Konsil Kedokteran Indonesia (KKI) yang masih berlaku', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (84, 'Fotokopi surat ijin praktik Apoteker (SIPA) dan ijin tenaga teknis kefarmasian minimal 2 (dua) orang', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (85, 'Fotokopi surat Ijin praktik tenaga teknis kefarmasian ', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (86, 'Fotokopi Surat Ijin Refraksionis Optisien (SIRO) dan Surat Ijin Kerja  Refraksionis Optisien (SIK RO)', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (87, 'Fotokopi Surat Tanda Registrasi Bidan (STRB) atau Surat Ijin Bidan (SIB) dari Dinas Kesehatan Provinsi yang dilegalisir', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (88, 'Fotokopi Surat Tanda Registrasi Perawat atau Surat Ijin Perawat yang dilegalisir', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (89, 'Fotokopi Surat Tanda Registrasi yang dilegalisir oleh KKI yang masih berlaku', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (90, 'Fotokopi Surat Tanda Registrasi/ SIPG dai Dinas Kesehatan Provinsi yang dilegalisir', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (91, 'Gambar konstruksi IPAL beserta saluran pembuangan limbah cair.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (92, 'Gambar rencana bangunan pagar bagian depan tidak boleh tertutup, harus transparan dilihat dari jalan (7 rangkap).', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (93, 'Identitas Pemrakarsa.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (94, 'Ijin atasan bagi Dokter penanggung jawab apabila sebagai PNS,TNI,POLRI dan pegawai pemerintah lainnya', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (95, 'Ijin atasan bagi penanggung jawab apabila sebagai PNS, TNI, POLRI  Dan pegawai pemerintah lainnya.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (96, 'Ijin Operasional Biro Jasa Reklame (IOBJR).', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (97, 'Kajian Analisa mengenai dampak lingkunagn (AMDAL);', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (98, 'Keterangan mempunyai tenaga ahli pertambangan dengan syarat pendidikan dan pengalaman kerja ', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (99, 'Keterangan sehat dari dokter yang memiliki surat Ijin  praktek', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (100, 'Melampirkan Akte Pendirian Bagi Yang Berbentuk Badan Dan Untuk Perorangan Melampirkan KTP.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (101, 'Melampirkan Data Personalia.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (102, 'Melampirkan design, bentuk (beserta keterangan ukuran secara lengkap) Simulator gambar, jenis, warna dan isi (meliputi jenis produk, tulisan dan gambar) secara jelas.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (103, 'Melampirkan Fotokopi akta pendirian perusahaan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (104, 'Melampirkan fotokopi bukti hak kepemilikan tanah.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (105, 'Melampirkan fotokopi bukti lunas Pajak Bumi dan Bangunan tahun terakhir.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (106, 'Melampirkan fotokopi IMB yang lama dan Apabila terjadi perubahan rencana kota dan/atau peruntukan maka harus mengajukan keterangan rencana kota yang baru (untuk permohonan IMB revisi).', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (107, 'Melampirkan fotokopi Kartu Tanda Penduduk pemohon.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (108, 'Melampirkan fotokopi keterangan rencana kota (3 rangkap)', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (109, 'Melampirkan fotokopi polis asuransi media reklame bagi yang memiliki resiko terhadap pihak lainnya. ', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (110, 'Melampirkan fotokopi sertifikat tanah, apabila tanda bukti penguasaan tanah belum berupa sertifikat maka pemohon wajib melampirkan surat pernyataan bahwa tanah tidak dalam sengketa yang didaftarkan pada Pejabat Pembuat Akta Tanah.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (111, 'Melampirkan gambar rancangan arsitektur bangunan (7 rangkap).', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (112, 'Melampirkan IUJK asli.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (113, 'Melampirkan Pernyataan Kesanggupan Membayar Retribusi Usaha Perikanan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (114, 'Melampirkan rekomendasi dari Ikatan Apoteker Indonesia (IAI) kota Palembang', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (115, 'Melampirkan rekomendasi dari organisasi profesi perawat (PPNI) Kota Palembang', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (116, 'Melampirkan rekomendasi dari Organisasi Profesi Perawat Gigi (PPGI) DPD Kota Palembang', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (117, 'Melampirkan rekomendasi dari RT, Lurah dan Camat setempat pada lokasi bangunan didirikan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (118, 'Melampirkan rekomendasi puskesmas', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (119, 'Melampirkan rencana dan perhitungan konstruksi beton bertulang/ baja beserta detail pembesian/rangka baja bagi bangunan bertingkat yang luasnya lebih 25 m2 (dua puluh lima meter persegi).', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (120, 'Melampirkan rencana tapak yang disahkan oleh oleh Dinas Tata Kota untuk luas lahan 5000 m2 (lima ribu meter persegi) keatas.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (121, 'Melampirkan Rencana Usaha.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (122, 'Melampirkan salinan IUP yang dilegalisir', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (123, 'Melampirkan salinan sertifikat kesempurnaan dan surat keterangan kecakapan (SKK).', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (124, 'Melampirkan salinan surat ukur  kapal diatas 7 Gros Ton (GT).', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (125, 'Melampirkan salinan tanda pendaftaran kapal (registrasi).', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (126, 'Melampirkan sertifikat IUJK Asli.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (127, 'Melampirkan skets lokasi letak rencana penyelenggaraan reklame beserta keterangan ukuran dan jarak secara detail dan jelas.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (128, 'Melampirkan Surat Ijin Asli', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (129, 'Melampirkan Surat ijin atasan (bagi pemohon PNS, anggota TNI, POLRI dan Pegawai Instasi Pemerintah Lainnya).', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (130, 'Melampirkan surat keterangan dari pimpinan sarana pelayanan kesehatan yang menyatakan tanggal mulai bekerja (Khusus yang bekerja pada sarana kesehatan)', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (131, 'Melampirkan Surat Keterangan/Sertifikat sebagai pekerja salon kecantikan (khusus salon kecantikan).', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (132, 'Melampirkan surat pernyataan bahwa tidak melakukan tindakan asusila, tidak menyediakan minuman keras dan obat-obatan terlarang.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (133, 'Melengkapi media reklame yang saya mohonkan tersebut di atas dengan lampu penerangan yang cukup terang sehingga dapat juga menerangi sekitar lokasi media reklame tersebut.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (134, 'Memagar persilnya dengan baik dan dikapur atau dicat dengan rapi.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (135, 'Memangkas pohon-pohon dan pagar-pagar hidup pada persilnya selambat-lambatnya 1 (satu)  minggu setelah menerima surat pemberitahuan dari Walikota.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (136, 'Memasangan/pembangunan  reklame yang saya mohonkan sesuai dengan ukuran, jumlah, kontruksi serta gambar permohonan reklame yang saya ajukan, yang merupakan lampiran persyaratan yang tidak terisahkan dengan surat permohonan reklame saya.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (137, 'Membersihkan, mengapur atau mengecat kembali pagar, dinding atau tembok bangunan pada bagian sebelah luar apabila telah Nampak kotor dan rapi', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (138, 'Membersihkan, mengapur atau mengecat kembali pagar, dinding atau tembok bangunan pada bagian sebelah luar apabila telah Nampak kotor dan rapi.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (139, 'Membuat bak penampung/pengolahan air limbah rumah tangga untuk air buanagan cuci pakaian, air mandi, air cuci piring, air cuci kendaraan dan sejenisnya.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (140, 'Membuat bak sampah bertutup dengan ukuran yang standar.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (141, 'Membuat lubang biopori dengan ukuran dan jarak yang standar.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (142, 'Membuat penutupan parit/got yang dilengkapi dengan mainhole agar dapat dibuka dan dibersihkan dengan ukuran dan jarak yang standar.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (143, 'Membuat Surat Pernyataan tidak masuk dalam daftar hitam yang ditandatanggani penanggungjawab utama badan usaha.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (144, 'Membuat tali air pada jembatan parit/got agar air buangan atau air hujan dari permukaan lahan tidak langsung jatuh ke jalan;', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (145, 'Memelihara dengan baik dan bersih persilnya dan segala sesuatu yang ada pada persil tersebut, termasuk tamannya, jalan masuk, pekarangan, pagar, batas pekarangan, jembatan dan saluran pembuangan atau riool yang ada di luar dan dalam persilnya.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (146, 'Memenuhi persyaratan baik administrasi maupun teknis yang di tetapkan pemerintah.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (147, 'Memiliki kantor dan workshop/ Studio yang memiliki IPB/SLF di kota palembang.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (148, 'Memperlakukan kesejahteraan hewan (keswaran) sebelum hewan dipotong.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (149, 'Menanam pohon penghijauan untuk satu petak toko – satu pohon dengan ketinggian paling rendah 2 (dua) sampai 3(tiga) meter.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (150, 'Menebang pohon-pohon yang ada pada persilnya yang dikhawatirkan akan tumbang dan mengganggu ketertiban.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (151, 'Menerima ketentuan pengalihan Ijin Penyelenggaraan Reklame Kepada pihak lain apabila terhitung 3 (tiga) bulan kalender sejak dari tanggal Surat Pernyataan ini saya belum menyelenggarakan / melaksanakan pendirian reklame saya ini di lapangan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (152, 'Menerima segala sanksi dalam bentuk apapun dari pihak Pemerintah Kota Palembang tanpa menuntut ganti rugi sesuai dengan ketentuan hukum yang berlaku melalui instansi pelaksana/teknis yang ditunjuk/ditugasi untuk melaksanakansanksi dimaksud apabila dikemudian hari ternyata pelaksanaan pemasangan/pembangunan reklame saya ini menyimpang atau tidak sesuai dengan ukuran, jumlah, kontruksi serta gambar permohonan reklame yang saya ajukan (penyimpangan pelaksanaan pembangunan tersebut baik sedikit ataupun banyak)', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (153, 'Mengajukan permohonan tertulis kepada walikota melalui Kepala KPPT.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (154, 'Mengajukan permohonan tertulis kepada walikota Palembang melalui Kepala KPPT.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (155, 'Mengajukan surat permohonan', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (156, 'Mengikutsertakan konsultan bidang kontruksi yang kompeten dan berwenang untuk melaksanakan perhitungan dan pertimbangan kontruksi apabila pemasangan/penyelenggaraan reklame saya yang mohonkan  tersebut memerlikan perhitungan dan pertimbangan kontruksi.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (157, 'Mengisi Formulir Permohonan', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (158, 'Mengisi formulir Surat Permohonan Ijin Penyelenggaraan Reklame (SPIPR)', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (159, 'Menjaga kebersihan dari  depan pintu sampai dengan pinggir jalan bagi pemilik atau penghuni rumah, toko, warung dan tempat usahanya.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (160, 'Menjaga kebersihan pada lingkungan masing-masing.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (161, 'Menyiapkan tempat sampah dalam kendaraan bagi pemilik kendaraan roda 4 (empat).', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (162, 'Nama Apotik harus sesuai dengan kaidah bahasa indonesia dan tidak boleh sama dengan nama Apotik yang telah ada dan masih berlaku', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (163, 'Nomor Pokok Wajib Pajak (NPWP)', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (164, 'NPWP BUJK', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (165, 'Pas foto 3x4 cm 2 (dua) lembar', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (166, 'Pas foto 3x4 cm 3 (tiga) lembar ', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (167, 'Pas foto 3x4 cm berwarna 2 (dua) lembar', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (168, 'Pas foto terbaru ukuran 3x4cm 3 (tiga) lembar.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (169, 'Pas foto Ukuran 3x4 cm 2 Lembar.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (170, 'Pas Photo ukuran 3x4cm sebanyak 2 (dua) lembar.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (171, 'Pedagang dan pengusaha diwajibkan membersihkan dan membuang sampah akibat dari pekerjaannya ke tempat sampah yang yang disediakan sebelum meninggalkan tempat usahanya.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (172, 'Perkerasan halaman depan dengan conblok agar berfungsi sebagai resapan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (173, 'Persetujuan Tetangga diketahui oleh RT setempat', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (174, 'Persetujuan tetangga untuk menimbun rawa yang diketahui oleh ketua RT setempat.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (175, 'Peta situasi wilayah pertambangan yang dimohon dengan skala antara 1:1.000 sampai dengan 1:10.000 yang diikat pada titik tetap dan dengan batas-batas koordinat yang jelas;', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (176, 'Peta wilayah 1:1.000 dengan batas-batas koordinat yang jelas dan diikat pada titik tetap (titik triangulasi);', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (177, 'Peta/ denah lokasi tempat usaha.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (178, 'Rekaman 3 (tiga) bulan terakhir hasil analisa kualitas limbah cair.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (179, 'Reklamasi rawa yang menimbulkan dampak negative penting dan negative tidak penting, perlu melaksanakan kajian lingkungan hidup (AMDAL/UKL-UPL) sesuai dengan peraturan perundang-undangan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (180, 'Rekomendasi dari Badan Pengurus cabang ikatan Apoteker Indonesia (IAI) Kota Palembang', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (181, 'Rekomendasi dari camat dan lurah, serta Instansi terkait lainnya apabila dianggap perlu.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (182, 'Rekomendasi dari camat dan lurah. ', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (183, 'Rekomendasi dari DP2K', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (184, 'Rekomendasi dari Organisasi Profesi Bidan (IBI) cabang kota Palembang', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (185, 'Rekomendasi dari Puskesmas setempat', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (186, 'Rekomendasi dari RT, Lurah dan Camat setempat pada lokasi bangunan pagar didirikan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (187, 'Rekomendasi gabungan pengusaha optikal (GAPOPIN) sumsel  dan  Ikatan  Refraksionis Optisien Indonesia (IROPIN) Kota Palembang ', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (188, 'Rekomendasi lurah dan camat setempat.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (189, 'Rekomendasi Puskesmas setempat (Untuk SIPB)', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (190, 'Rencana reklamasi rawa.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (191, 'Salinan akte pendirian perusahaan yang menyebutkan usahanya dibidang pertambangan dan telah didaftarkan di pengadilan negeri setempat.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (192, 'Sarjana jurusan lain yang mempunyai pengalaman kerja minimal 5 (lima) tahun pada aktifitas penambangan dengan dibuktikan keterangan dari perusahaan yang bersangkutan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (193, 'Sarjana Muda Teknik Pertambangan / Geologi.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (194, 'Sarjana Teknik Pertambangan / Geologi.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (195, 'Saya bersedia menerima sanksi yang ditempatkan oleh Pemerintah Kota Palembang/Instansi yang berwenang sesuai  dengan ketentuan / peraturan yang berlaku apabila pernyataan tidak benar', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (196, 'Selalu menjaga kerapian, kebersihan dan keindahan media reklame serta lokasi tempat penyelenggaraan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (197, 'Site Plan dan surat kepemilikan tanah.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (198, 'Sket atau denah bangunan dan lokasi', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (199, 'Sket Domisili Perusahaan', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (200, 'Status Bangunan/ bukti kepemilikan (sewa/ hak milik)', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (201, 'Struktur Organisasi dan daftar tenaga kesehatan di  rumah bersalin', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (202, 'Surat ijin Operasional PPUT/PPUM asli.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (203, 'Surat ijin Operasional Salon Kecantikan/Pemangkas Rambut Asli.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (204, 'Surat Kepemilikan Tanah (SKT);', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (205, 'Surat keterangan berbadan sehat asli atau legalisir dari dokter yang mempunyai SIP dengan mencantumkan nomor dan tahun SIPnya', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (206, 'Surat Keterangan Hilang dari Kepolisian', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (207, 'Surat keterangan kepemilikan hewan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (208, 'Surat keterangan kesehatan hewan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (209, 'Surat Kuasa dari penanggung jawab Badan Usaha bila Pengurusan Permohonan Ijin baru dikuasakan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (210, 'Surat kuasa dari penanggungjawab usaha bila pemohon ijin perpanjangan dikuasakan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (211, 'Surat Permohonan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (212, 'Surat pernyataan akan melakukan pengelolaan limbah cair sesuai dengan ketentuan yang berlaku.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (213, 'Surat pernyataan bermaterai kesediaan untuk menjadi penanggung jawab optikal dan tidak sebagai penanggung jawab optik lain', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (214, 'Surat pernyataan bersedia sebagai penanggung jawab toko obat dan tidak merangkap ditempat lain', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (215, 'Surat pernyataan bersedia sebagai penangung jawab Apotik dan tidak sebagai penanggung jawab sarana kesehatan lain', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (216, 'Surat pernyataan dari dokter penanggung jawab', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (217, 'Surat pernyataan kesanggupan untuk melakukan ganti rugi dan atau pemulihan kualitas sumber air yang tercemar akibat pembuangan limbah cair dari kegiatan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (218, 'Surat Pernyataan Kesanggupan untuk memiliki 5 (lima) kendaraan', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (219, 'Surat pernyataan kesediaan dokter sebagai penanggung jawab (materai 6000)', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (220, 'Surat Pernyataan menyediakan untuk  fasilitas pool kendaraan.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (221, 'Surat Pernyataan Penanggung Jawab Teknis', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (222, 'Surat pernyataan telah melakukan kegiatan konstruksi yang memuat nomor kontrak, jenis pekerjaan, lokasi, tahun terakhir.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (223, 'Surat pernyataan tidak melakukan tindakan asusila dan surat pernyataan tidak menyediakan minuman keras dan obat-obatan terlarang.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (224, 'Surat pernyataan tidak menjual obat daftar G, alat kesehatan dan tidak melayani resep dokter', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (225, 'Surat rekomendasi dan Organisasi profesi asli  atau legalisir dari IDI/PDGI', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (226, 'Surat Rekomendasi dari puskesmas setempat', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (227, 'Tidak menggunakan tempat usaha sebagai tempat perbuatan asusila, transaksi narkoba dan penjualan minuman keras serta perbuatan terlarang lainnya.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (228, 'Untuk bangunan publik atau pengunaanya yang berdampak terhadap keselamatan umum, lingkungan, lalu lintas dan sistem pemadam kebakaran, harus melampirkan rekomendasi mengenai kajian lingkungan, lalu lintas dan gambar pekerjaan mekanikal, elektrikal dan sistem pemadam kebakaran SKPD teknis terkait.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (229, 'Untuk bangunan rumah lebih dari 400 m2 (empat ratus meter persegi) dan bangunan non rumah tinggal lebih dari 300 m2 (tiga ratus meter persegi) harus dirancang oleh tenaga ahli ber-Surat ijin bekerja perencana di bidang arsitektur dan lebih tinggi dari 2 (dua) lantai melampirkan perhitungan struktur oleh tenaga ahli yang ber-surat ijin bekerja perencana di bidang konstruksi (3 rangkap).', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (230, 'Untuk Permohonan Surat Ijin Kerja Bidan (SIKB), melampirkan keterangan dari pimpinan sarana kesehatan tempat bekerja', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');
INSERT INTO `persyaratan` VALUES (231, 'Untuk tetap menyalakan lampu reklame tersebut setiap harinya dari pukul 18.00 WIB sampai dengan minimal pukul 24.00 WIB.', 1, 1, '2019-01-14 14:56:54', '2019-01-14 14:56:54');

SET FOREIGN_KEY_CHECKS = 1;
