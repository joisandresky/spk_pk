/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 100110
Source Host           : localhost:3306
Source Database       : spk_pk

Target Server Type    : MYSQL
Target Server Version : 100110
File Encoding         : 65001

Date: 2017-09-16 22:54:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for data_fmea
-- ----------------------------
DROP TABLE IF EXISTS `data_fmea`;
CREATE TABLE `data_fmea` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_cacat` varchar(150) DEFAULT NULL,
  `penyebab` varchar(150) DEFAULT NULL,
  `severity` int(11) DEFAULT NULL,
  `occurrence` int(11) DEFAULT NULL,
  `detectabillity` int(11) DEFAULT NULL,
  `rpn` int(11) DEFAULT NULL,
  `tindakan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`no`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of data_fmea
-- ----------------------------
INSERT INTO `data_fmea` VALUES ('1', 'Kontaminasi partikel plastik atau partikel benda asing tidak menempel di botol (bisa lepas)', 'box tempat meletakan produk jadi kotor', '3', '4', '3', '36', 'Vacum Area Kerja, Bersihkan Conveyor. Tutup Pintu Mesin');

-- ----------------------------
-- Table structure for detail_produksi
-- ----------------------------
DROP TABLE IF EXISTS `detail_produksi`;
CREATE TABLE `detail_produksi` (
  `no_detail_produksi` int(11) NOT NULL AUTO_INCREMENT,
  `no_produksi` varchar(10) NOT NULL,
  `periode` varchar(1) NOT NULL,
  `sample` int(5) NOT NULL,
  `jumlah_defect` int(5) NOT NULL,
  `kode_ket_defect` varchar(10) NOT NULL,
  `action_inspector` varchar(25) NOT NULL,
  PRIMARY KEY (`no_detail_produksi`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of detail_produksi
-- ----------------------------
INSERT INTO `detail_produksi` VALUES ('1', 'PDS-001', '1', '8', '3', 'DF-101', 'OPV');
INSERT INTO `detail_produksi` VALUES ('2', 'PDS-001', '3', '8', '3', 'DF-103', 'OPV');
INSERT INTO `detail_produksi` VALUES ('3', 'PDS-001', '4', '8', '3', 'DF-104', 'OPV');
INSERT INTO `detail_produksi` VALUES ('4', 'PDS-001', '2', '8', '4', 'DF-102', 'OPV');
INSERT INTO `detail_produksi` VALUES ('9', 'PDS-002', '2', '8', '3', 'DF-302', 'OPV');
INSERT INTO `detail_produksi` VALUES ('10', 'PDS-002', '3', '8', '4', 'DF-303', 'OPV');
INSERT INTO `detail_produksi` VALUES ('11', 'PDS-002', '4', '8', '4', 'DF-304', 'OPV');
INSERT INTO `detail_produksi` VALUES ('12', 'PDS-002', '1', '8', '3', 'DF-301', 'OPV');
INSERT INTO `detail_produksi` VALUES ('17', 'PDS-004', '2', '6', '3', 'DF-P01', 'OPV');
INSERT INTO `detail_produksi` VALUES ('18', 'PDS-004', '1', '8', '3', 'DF-P01', 'OPV');
INSERT INTO `detail_produksi` VALUES ('19', 'PDS-004', '4', '8', '3', 'DF-P04', 'OPV');
INSERT INTO `detail_produksi` VALUES ('20', 'PDS-004', '3', '8', '4', 'DF-P03', 'OPV');
INSERT INTO `detail_produksi` VALUES ('21', 'PDS-003', '4', '8', '3', 'DFD-004', 'OPV');
INSERT INTO `detail_produksi` VALUES ('22', 'PDS-003', '2', '8', '3', 'DFD-002', 'OPV');
INSERT INTO `detail_produksi` VALUES ('23', 'PDS-003', '1', '8', '4', 'DFD-001', 'OPV');
INSERT INTO `detail_produksi` VALUES ('24', 'PDS-003', '3', '8', '3', 'DFD-003', 'OPV');
INSERT INTO `detail_produksi` VALUES ('25', 'PDS-005', '1', '8', '3', 'FD-001', 'OPV');
INSERT INTO `detail_produksi` VALUES ('26', 'PDS-005', '2', '8', '4', 'FD-002', 'OPV');
INSERT INTO `detail_produksi` VALUES ('27', 'PDS-005', '3', '8', '3', 'FD-003', 'OPV');
INSERT INTO `detail_produksi` VALUES ('28', 'PDS-005', '4', '8', '3', 'FD-004', 'OPV');

-- ----------------------------
-- Table structure for ket_defect_produksi
-- ----------------------------
DROP TABLE IF EXISTS `ket_defect_produksi`;
CREATE TABLE `ket_defect_produksi` (
  `kode_ket_defect` varchar(10) NOT NULL,
  `defect_pertama` varchar(2) DEFAULT NULL,
  `defect_kedua` varchar(2) DEFAULT NULL,
  `defect_ketiga` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`kode_ket_defect`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ket_defect_produksi
-- ----------------------------
INSERT INTO `ket_defect_produksi` VALUES ('DF-001', '10', '3', '6');
INSERT INTO `ket_defect_produksi` VALUES ('DF-002', '4', '7', '3');
INSERT INTO `ket_defect_produksi` VALUES ('DF-003', '3', '7', '2');
INSERT INTO `ket_defect_produksi` VALUES ('DF-004', '7', '3', '2');
INSERT INTO `ket_defect_produksi` VALUES ('DF-101', '5', '7', '10');
INSERT INTO `ket_defect_produksi` VALUES ('DF-102', '8', '2', '4');
INSERT INTO `ket_defect_produksi` VALUES ('DF-103', '5', '3', '8');
INSERT INTO `ket_defect_produksi` VALUES ('DF-104', '7', '3', '8');
INSERT INTO `ket_defect_produksi` VALUES ('DF-301', '2', '3', '8');
INSERT INTO `ket_defect_produksi` VALUES ('DF-302', '10', '6', '8');
INSERT INTO `ket_defect_produksi` VALUES ('DF-303', '3', '7', '1');
INSERT INTO `ket_defect_produksi` VALUES ('DF-304', '4', '6', '9');
INSERT INTO `ket_defect_produksi` VALUES ('DF-P01', '4', '5', '6');
INSERT INTO `ket_defect_produksi` VALUES ('DF-P03', '9', '5', '2');
INSERT INTO `ket_defect_produksi` VALUES ('DF-P04', '4', '6', '8');
INSERT INTO `ket_defect_produksi` VALUES ('DFD-001', '1', '5', '8');
INSERT INTO `ket_defect_produksi` VALUES ('DFD-002', '2', '8', '3');
INSERT INTO `ket_defect_produksi` VALUES ('DFD-003', '4', '6', '2');
INSERT INTO `ket_defect_produksi` VALUES ('DFD-004', '4', '3', '7');
INSERT INTO `ket_defect_produksi` VALUES ('FD-001', '10', '4', '7');
INSERT INTO `ket_defect_produksi` VALUES ('FD-002', '3', '6', '7');
INSERT INTO `ket_defect_produksi` VALUES ('FD-003', '3', '5', '7');
INSERT INTO `ket_defect_produksi` VALUES ('FD-004', '7', '4', '4');

-- ----------------------------
-- Table structure for master_cacat
-- ----------------------------
DROP TABLE IF EXISTS `master_cacat`;
CREATE TABLE `master_cacat` (
  `kode_defect` varchar(10) NOT NULL,
  `jenis_cacat` text NOT NULL,
  `penyebab_cacat` text NOT NULL,
  `tindakan` text NOT NULL,
  PRIMARY KEY (`kode_defect`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of master_cacat
-- ----------------------------
INSERT INTO `master_cacat` VALUES ('1', 'Kontaminasi partikel plastik atau partikel benda asing tidak menempel di botol (bisa lepas)', 'Penanganan kurang higenis, produk yang jatuh,  pintu mesin yang dibuka saat terjadinya proses pembautan produk,box tempat meletakan produk jadi kotor', 'Vacum Area Kerja, Bersihkan Conveyor. Tutup Pintu Mesin');
INSERT INTO `master_cacat` VALUES ('10', 'Keriput / melipat yang mengakibatkan pecah', 'Kestabilan Proses Dalam Mesin', 'Setting Temperatur. Cek Pemakaian Regrain dan Pemurni.');
INSERT INTO `master_cacat` VALUES ('2', 'Kontaminasi partikel plastik atau partikel benda asing menempel di dalam dinding botol (tidak bisa lepas)', 'Bahan Baku Yang Kotor, Runner Dalam Mesin Kotor', 'Maintenance Kebersihan Runner dan Mesin Giling');
INSERT INTO `master_cacat` VALUES ('3', 'Body Kotor Oli', 'Maintenance Mesin Yang Kurang Baik, Teknisi Setelah Mengecek Mesin Memegang Produk', 'Maintenance Mesin Yang Lebih Sering Jangka Waktunya');
INSERT INTO `master_cacat` VALUES ('4', 'Body kondensasi/ Bercak', 'Efek Kondisi Mold Yang Terlalu Dingin', 'Cek Temperatur Pada Mesin');
INSERT INTO `master_cacat` VALUES ('5', 'Botol nerawang (mata ikan) / Buble', 'Bahan Baku Yang Basah', 'Ganti Material');
INSERT INTO `master_cacat` VALUES ('6', 'Flashing pada neck atau botom', 'Operator Kurang Rapih Saat Finshing Produk', 'Pertajam Pisau');
INSERT INTO `master_cacat` VALUES ('7', 'Warna tidak standard', 'Karakteristik Dari Masterbatch Yang Tidak Sesuai, dan Komposisi Pencampuran Bahan Baku', 'Mixing Ulang, Cek Komposisi Masterbatch Dengan Bahan Baku.');
INSERT INTO `master_cacat` VALUES ('8', 'Body botol bolong', 'Material Luar Yang Menempel Pada Parison', 'Maintenance Kebersihan Mesin. Tutup Pintu Mesin Saat Proses Produksi Berlangsung');
INSERT INTO `master_cacat` VALUES ('9', 'Chocked neck', 'Proses Cutting Dalam Mesin Tidak Sempurna', 'Pertajam Cutting Parrison');

-- ----------------------------
-- Table structure for produk
-- ----------------------------
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk` (
  `kode_produk` varchar(10) NOT NULL,
  `nama_material` varchar(50) NOT NULL,
  `keterangan_produk` text NOT NULL,
  PRIMARY KEY (`kode_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of produk
-- ----------------------------
INSERT INTO `produk` VALUES ('PRD-0001', 'Zwt rb 100 ml', 'Material nya Zwt rb 100 ml');

-- ----------------------------
-- Table structure for produksi
-- ----------------------------
DROP TABLE IF EXISTS `produksi`;
CREATE TABLE `produksi` (
  `no_produksi` varchar(10) NOT NULL,
  `kode_produk` varchar(10) NOT NULL,
  `tanggal_produksi` date NOT NULL,
  PRIMARY KEY (`no_produksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of produksi
-- ----------------------------
INSERT INTO `produksi` VALUES ('PDS-001', 'PRD-0001', '2017-07-11');
INSERT INTO `produksi` VALUES ('PDS-002', 'PRD-0001', '2017-07-13');
INSERT INTO `produksi` VALUES ('PDS-003', 'PRD-0001', '2017-07-21');
INSERT INTO `produksi` VALUES ('PDS-004', 'PRD-0001', '2017-07-27');
INSERT INTO `produksi` VALUES ('PDS-005', 'PRD-0001', '2017-07-30');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(8) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', 'admin');

-- ----------------------------
-- Procedure structure for cekSample
-- ----------------------------
-- DROP PROCEDURE IF EXISTS `cekSample`;
-- DELIMITER ;;
-- CREATE DEFINER=`root`@`localhost` PROCEDURE `cekSample`()
-- BEGIN
--   declare str VARCHAR(255) default '';
--   DECLARE x INT DEFAULT 0;
--   SET x = 1;

--   WHILE x <= 5 DO
--     SET str = CONCAT(str,x,',');
--     SET x = x + 1;
--   END WHILE;

--   select str;
-- END
-- ;;
-- DELIMITER ;
