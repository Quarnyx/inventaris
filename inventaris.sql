/*
 Navicat Premium Data Transfer

 Source Server         : localost
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : inventaris

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 21/12/2024 19:51:33
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
  PRIMARY KEY (`id_aset`) USING BTREE,
  INDEX `id_jenis`(`id_jenis` ASC) USING BTREE,
  INDEX `id_kelompok`(`id_kelompok` ASC) USING BTREE,
  CONSTRAINT `aset_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_aset` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `aset_ibfk_2` FOREIGN KEY (`id_kelompok`) REFERENCES `kelompok_aset` (`id_kelompok`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of aset
-- ----------------------------
INSERT INTO `aset` VALUES (7, 'Mobil Avanza', '2024-12-12', 8, 160000000.00, 50000000.00, 'Sudah Validasi Tambah Aset', 4, 1, 'adasdasdsdasdsdada', 1, 'Unit', 1145833.00);
INSERT INTO `aset` VALUES (9, 'Mobil Hiace', '2024-10-01', 8, 90000000.00, 4000000.00, 'Sudah Validasi Tambah Aset', 4, 1, 'kajsdkajsdkja', 1, 'Unit', 895833.00);

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
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jadwal_penyusutan
-- ----------------------------
INSERT INTO `jadwal_penyusutan` VALUES (7, 7, '2024-12-01', 1000000.00, 'Sudah Validasi', 79);
INSERT INTO `jadwal_penyusutan` VALUES (8, 7, '2025-01-31', 1000000.00, 'Sudah Validasi', 78);
INSERT INTO `jadwal_penyusutan` VALUES (10, 9, '2024-12-01', 895833.00, 'Sudah Validasi', 95);
INSERT INTO `jadwal_penyusutan` VALUES (11, 9, '2025-01-31', 895833.00, 'Sudah Validasi', 94);

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
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of pengguna
-- ----------------------------
INSERT INTO `pengguna` VALUES (1, 'Admin', 'admin', 'admin', '0192023a7bbd73250516f069df18b500');
INSERT INTO `pengguna` VALUES (12, 'Jono', 'Pengurus', 'jono', 'ef9322a1a342a36856e9e8929b19437a');

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
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of validasi
-- ----------------------------
INSERT INTO `validasi` VALUES (9, 'asdsadad', 7, 'Sudah Validasi Tambah Aset', 'BAB II.pdf');
INSERT INTO `validasi` VALUES (11, 'zczcaca', 9, 'Sudah Validasi Tambah Aset', '7094-25296-1-PB.pdf');

SET FOREIGN_KEY_CHECKS = 1;
