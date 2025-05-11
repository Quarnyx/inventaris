/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : 127.0.0.1:3306
 Source Schema         : inventaris

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 12/05/2025 00:26:51
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for aset
-- ----------------------------
DROP TABLE IF EXISTS `aset`;
CREATE TABLE `aset`  (
  `id_aset` int NOT NULL AUTO_INCREMENT,
  `nama_aset` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tanggal_pembelian` date NULL DEFAULT NULL,
  `umur_ekonomis` int NULL DEFAULT NULL,
  `harga_pembelian` decimal(15, 2) NULL DEFAULT NULL,
  `nilai_residu` decimal(15, 2) NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_jenis` int NULL DEFAULT NULL,
  `id_kelompok` int NULL DEFAULT NULL,
  `deskripsi_aset` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `jumlah` int NULL DEFAULT NULL,
  `unit` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nilai_penyusutan` decimal(15, 2) NULL DEFAULT NULL,
  `letak_aset` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kode_aset` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `merek` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status_kondisi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sumber_dana` enum('APBN','APBD','Hibah','Lainnya') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `klasifikasi_pengadaan` enum('Hibah','Pembangunan Sendiri','Pembelian','Kontrak') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan_tolak` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_aset`) USING BTREE,
  INDEX `id_jenis`(`id_jenis` ASC) USING BTREE,
  INDEX `id_kelompok`(`id_kelompok` ASC) USING BTREE,
  CONSTRAINT `aset_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_aset` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `aset_ibfk_2` FOREIGN KEY (`id_kelompok`) REFERENCES `kelompok_aset` (`id_kelompok`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of aset
-- ----------------------------
INSERT INTO `aset` VALUES (7, 'Mobil Avanza', '2024-12-12', 8, 160000000.00, 50000000.00, 'Sudah Validasi Pemindahtanganan Aset', 4, 1, 'adasdasdsdasdsdada', 1, 'Unit', 1145833.00, 'Lapas', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `aset` VALUES (9, 'Mobil Hiace', '2024-10-01', 8, 90000000.00, 4000000.00, 'tidak aktif', 4, 1, 'kajsdkajsdkja', 1, 'Unit', 895833.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `aset` VALUES (12, 'adsadada', '2025-01-16', 8, 5000000.00, 1000000.00, 'Sudah Validasi Tambah Aset', 4, 1, 'adsdadadadada', 1, 'Unit', 41666.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `aset` VALUES (13, 'Laptop Asus', '2025-03-01', 4, 4000000.00, 100000.00, 'Sudah Validasi Tambah Aset', 4, 3, 'asdadasdasdsada', 1, 'Unit', 81250.00, 'Kantor', NULL, NULL, NULL, NULL, NULL, 'kurang B');
INSERT INTO `aset` VALUES (15, 'Mobil Avanza', '2025-05-09', 8, 16000000.00, 1000000.00, 'Ditolak', 1, 3, 'ffgfff', 5, 'Unit', 156250.00, NULL, 'AS-001', 'HOn', 'Baik', 'APBD', NULL, 'asdasdads');
INSERT INTO `aset` VALUES (16, 'Mobil Hiace AAAAA', '2025-05-23', 22, 232323232.00, 2999999.00, 'Sudah Validasi Tambah Aset', 4, 3, 'asdsadsadas', 22, '1', 868648.00, NULL, 'AS-002', 'hahdad', 'Baik A', 'APBD', 'Hibah', NULL);

-- ----------------------------
-- Table structure for jadwal_penyusutan
-- ----------------------------
DROP TABLE IF EXISTS `jadwal_penyusutan`;
CREATE TABLE `jadwal_penyusutan`  (
  `id_jadwal` int NOT NULL AUTO_INCREMENT,
  `id_aset` int NULL DEFAULT NULL,
  `tanggal_penyusutan` date NULL DEFAULT NULL,
  `nilai_jadwal_penyusutan` decimal(15, 2) NULL DEFAULT NULL,
  `validasi` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `sisa_umur` int NULL DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`) USING BTREE,
  INDEX `id_aset`(`id_aset` ASC) USING BTREE,
  CONSTRAINT `jadwal_penyusutan_ibfk_1` FOREIGN KEY (`id_aset`) REFERENCES `aset` (`id_aset`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jadwal_penyusutan
-- ----------------------------
INSERT INTO `jadwal_penyusutan` VALUES (7, 7, '2024-12-01', 1000000.00, 'Sudah Validasi', 79);
INSERT INTO `jadwal_penyusutan` VALUES (8, 7, '2025-01-31', 1000000.00, 'Sudah Validasi', 78);
INSERT INTO `jadwal_penyusutan` VALUES (10, 9, '2024-12-01', 895833.00, 'Sudah Validasi', 95);
INSERT INTO `jadwal_penyusutan` VALUES (11, 9, '2025-01-31', 895833.00, 'Sudah Validasi', 94);
INSERT INTO `jadwal_penyusutan` VALUES (13, 12, '2025-01-31', 41666.00, 'Sudah Validasi', 95);

-- ----------------------------
-- Table structure for jenis_aset
-- ----------------------------
DROP TABLE IF EXISTS `jenis_aset`;
CREATE TABLE `jenis_aset`  (
  `id_jenis` int NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deskripsi_jenis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_jenis`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jenis_aset
-- ----------------------------
INSERT INTO `jenis_aset` VALUES (1, 'Bangunan', 'Bangunan di Lapas Kendal');
INSERT INTO `jenis_aset` VALUES (4, 'Kendaraan', 'Kendaraan Dinas');

-- ----------------------------
-- Table structure for kelompok_aset
-- ----------------------------
DROP TABLE IF EXISTS `kelompok_aset`;
CREATE TABLE `kelompok_aset`  (
  `id_kelompok` int NOT NULL AUTO_INCREMENT,
  `nama_kelompok` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `deskripsi_kelompok` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_kelompok`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kelompok_aset
-- ----------------------------
INSERT INTO `kelompok_aset` VALUES (1, 'Gedung A', 'Gedung A');
INSERT INTO `kelompok_aset` VALUES (3, 'Gedung B', 'lorem ipsum');

-- ----------------------------
-- Table structure for letak_aset
-- ----------------------------
DROP TABLE IF EXISTS `letak_aset`;
CREATE TABLE `letak_aset`  (
  `id_letak` int NOT NULL AUTO_INCREMENT,
  `id_aset` int NOT NULL,
  `letak_aset` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_letak`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of letak_aset
-- ----------------------------
INSERT INTO `letak_aset` VALUES (4, 9, 'Kantor A', 'Pusat A');
INSERT INTO `letak_aset` VALUES (5, 15, 'Gedung C', 'asdsadsada');
INSERT INTO `letak_aset` VALUES (6, 16, 'AAAAAA', NULL);

-- ----------------------------
-- Table structure for mutasi_aset
-- ----------------------------
DROP TABLE IF EXISTS `mutasi_aset`;
CREATE TABLE `mutasi_aset`  (
  `id_mutasi` int NOT NULL AUTO_INCREMENT,
  `id_aset` int NULL DEFAULT NULL,
  `tanggal_mutasi` date NULL DEFAULT NULL,
  `dari_lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `ke_lokasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id_mutasi`) USING BTREE,
  INDEX `id_aset`(`id_aset` ASC) USING BTREE,
  CONSTRAINT `mutasi_aset_ibfk_1` FOREIGN KEY (`id_aset`) REFERENCES `aset` (`id_aset`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mutasi_aset
-- ----------------------------

-- ----------------------------
-- Table structure for pemeliharaan_aset
-- ----------------------------
DROP TABLE IF EXISTS `pemeliharaan_aset`;
CREATE TABLE `pemeliharaan_aset`  (
  `id_pemeliharaan` int NOT NULL AUTO_INCREMENT,
  `id_aset` int NULL DEFAULT NULL,
  `tanggal_pemeliharaan` date NULL DEFAULT NULL,
  `jenis_pemeliharaan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `biaya` decimal(15, 2) NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id_pemeliharaan`) USING BTREE,
  INDEX `id_aset`(`id_aset` ASC) USING BTREE,
  CONSTRAINT `pemeliharaan_aset_ibfk_1` FOREIGN KEY (`id_aset`) REFERENCES `aset` (`id_aset`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pemeliharaan_aset
-- ----------------------------
INSERT INTO `pemeliharaan_aset` VALUES (2, 7, '2025-05-11', 'Service', 20000000.00, 'asdsada');
INSERT INTO `pemeliharaan_aset` VALUES (3, 13, '2025-05-11', 'Service', 2222.00, 'sdasdasdasda');

-- ----------------------------
-- Table structure for pemindahtanganan_aset
-- ----------------------------
DROP TABLE IF EXISTS `pemindahtanganan_aset`;
CREATE TABLE `pemindahtanganan_aset`  (
  `id_pemindahtanganan` int NOT NULL AUTO_INCREMENT,
  `id_aset` int NOT NULL,
  `tanggal_pemindahtanganan` date NOT NULL,
  `metode` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `pihak_penerima` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dokumen_pendukung` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  PRIMARY KEY (`id_pemindahtanganan`) USING BTREE,
  INDEX `id_aset`(`id_aset` ASC) USING BTREE,
  CONSTRAINT `pemindahtanganan_aset_ibfk_1` FOREIGN KEY (`id_aset`) REFERENCES `aset` (`id_aset`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pemindahtanganan_aset
-- ----------------------------
INSERT INTO `pemindahtanganan_aset` VALUES (1, 9, '2025-05-11', 'Jual', 'sfsdfs', 'aafaf', 'afsasa');

-- ----------------------------
-- Table structure for pengguna
-- ----------------------------
DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna`  (
  `id_pengguna` int NOT NULL AUTO_INCREMENT,
  `nama_pengguna` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_pengguna`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengguna
-- ----------------------------
INSERT INTO `pengguna` VALUES (1, 'Admin', 'admin', 'admin', '0192023a7bbd73250516f069df18b500');
INSERT INTO `pengguna` VALUES (12, 'Jono', 'Kepala Lapas', 'jono', 'ef9322a1a342a36856e9e8929b19437a');
INSERT INTO `pengguna` VALUES (13, 'julia', 'Kasubag TU', 'julia', '04305e8ef1c15dbf249cc0c99ce86107');

-- ----------------------------
-- Table structure for penghapusan_aset
-- ----------------------------
DROP TABLE IF EXISTS `penghapusan_aset`;
CREATE TABLE `penghapusan_aset`  (
  `id_penghapusan` int NOT NULL AUTO_INCREMENT,
  `id_aset` int NULL DEFAULT NULL,
  `tanggal_penghapusan` date NULL DEFAULT NULL,
  `alasan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
  `metode_penghapusan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dokumen_pendukung` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_penghapusan`) USING BTREE,
  INDEX `id_aset`(`id_aset` ASC) USING BTREE,
  CONSTRAINT `penghapusan_aset_ibfk_1` FOREIGN KEY (`id_aset`) REFERENCES `aset` (`id_aset`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of penghapusan_aset
-- ----------------------------
INSERT INTO `penghapusan_aset` VALUES (1, 9, '2025-05-11', 'sadsadas', 'Jual', '1746947516_logo-sm.png');

-- ----------------------------
-- Table structure for validasi
-- ----------------------------
DROP TABLE IF EXISTS `validasi`;
CREATE TABLE `validasi`  (
  `id_validasi` int NOT NULL AUTO_INCREMENT,
  `keterangan_validasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_aset` int NOT NULL,
  `status_validasi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bukti_dokumen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_validasi`) USING BTREE,
  INDEX `id_aset`(`id_aset` ASC) USING BTREE,
  CONSTRAINT `validasi_ibfk_1` FOREIGN KEY (`id_aset`) REFERENCES `aset` (`id_aset`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of validasi
-- ----------------------------
INSERT INTO `validasi` VALUES (9, 'asdsadad', 7, 'Sudah Validasi Tambah Aset', 'BAB II.pdf');
INSERT INTO `validasi` VALUES (11, 'zczcaca', 9, 'Sudah Validasi Tambah Aset', '7094-25296-1-PB.pdf');
INSERT INTO `validasi` VALUES (14, 'adsadada', 12, 'Sudah Validasi Tambah Aset', 'Buku Panduan Akad Panggih Resepsi - TIARA & KUSUMA.docx.pdf');
INSERT INTO `validasi` VALUES (15, 'dfsfsfs', 16, 'Sudah Validasi Tambah Aset', '');
INSERT INTO `validasi` VALUES (16, 'sdasdadasda', 13, 'Sudah Validasi Tambah Aset', 'traditional-indian-header-footer-design_1106493-255760.jpg');

SET FOREIGN_KEY_CHECKS = 1;
