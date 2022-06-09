-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for admin_smartvillage
DROP DATABASE IF EXISTS `admin_smartvillage`;
CREATE DATABASE IF NOT EXISTS `admin_smartvillage` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `admin_smartvillage`;

-- Dumping structure for table admin_smartvillage.admins
DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` varchar(50) COLLATE utf8_bin NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `nama` mediumtext COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table admin_smartvillage.admins: ~1 rows (approximately)
DELETE FROM `admins`;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`id`, `username`, `password`, `nama`) VALUES
	('1', 'admin', '$2a$12$PMNuf2cbjHMrrvo27U/rO.Bq75DF33X2ll6k2Pm4sxnRd6Eef7HJa', 'SmartVillage');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- Dumping structure for table admin_smartvillage.data_barang
DROP TABLE IF EXISTS `data_barang`;
CREATE TABLE IF NOT EXISTS `data_barang` (
  `kode_barang` char(5) COLLATE utf8_bin NOT NULL,
  `nama_barang` varchar(30) COLLATE utf8_bin NOT NULL,
  `harga_barang` int(11) NOT NULL,
  PRIMARY KEY (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table admin_smartvillage.data_barang: ~2 rows (approximately)
DELETE FROM `data_barang`;
/*!40000 ALTER TABLE `data_barang` DISABLE KEYS */;
INSERT INTO `data_barang` (`kode_barang`, `nama_barang`, `harga_barang`) VALUES
	('1', 'ASUS ROG', 30000000),
	('2', 'RTX 3000 Series', 5000000);
/*!40000 ALTER TABLE `data_barang` ENABLE KEYS */;

-- Dumping structure for table admin_smartvillage.data_layanan
DROP TABLE IF EXISTS `data_layanan`;
CREATE TABLE IF NOT EXISTS `data_layanan` (
  `kode_layanan` char(5) COLLATE utf8_bin NOT NULL,
  `nama_layanan` varchar(30) COLLATE utf8_bin NOT NULL,
  `harga_layanan` int(11) NOT NULL,
  PRIMARY KEY (`kode_layanan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table admin_smartvillage.data_layanan: ~2 rows (approximately)
DELETE FROM `data_layanan`;
/*!40000 ALTER TABLE `data_layanan` DISABLE KEYS */;
INSERT INTO `data_layanan` (`kode_layanan`, `nama_layanan`, `harga_layanan`) VALUES
	('L01', 'Web OpenSID', 10000000),
	('L02', 'Input Data', 3000000);
/*!40000 ALTER TABLE `data_layanan` ENABLE KEYS */;

-- Dumping structure for table admin_smartvillage.data_pelanggan
DROP TABLE IF EXISTS `data_pelanggan`;
CREATE TABLE IF NOT EXISTS `data_pelanggan` (
  `id_pelanggan` varchar(64) COLLATE utf8_bin NOT NULL,
  `nama_pelanggan` mediumtext COLLATE utf8_bin NOT NULL,
  `nama_desa` mediumtext COLLATE utf8_bin NOT NULL,
  `no_telp` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `alamat` mediumtext COLLATE utf8_bin NOT NULL,
  `total` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table admin_smartvillage.data_pelanggan: ~2 rows (approximately)
DELETE FROM `data_pelanggan`;
/*!40000 ALTER TABLE `data_pelanggan` DISABLE KEYS */;
INSERT INTO `data_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `nama_desa`, `no_telp`, `email`, `alamat`, `total`) VALUES
	('1', 'Ahmad Syafarudin', 'Pringsewu', '0895604395176', 'ahmad@gmail.com', 'Jl. Kesehatan Pringsewu Selatan', 80000000),
	('2', 'Khoirul Roziq', 'Sekampung', '0815131325255', 'khoirul@gmail.com', 'Jl. Tanjung Raya Sekampung, Lampung Timur', 10000000);
/*!40000 ALTER TABLE `data_pelanggan` ENABLE KEYS */;

-- Dumping structure for table admin_smartvillage.data_transaksi
DROP TABLE IF EXISTS `data_transaksi`;
CREATE TABLE IF NOT EXISTS `data_transaksi` (
  `id_transaksi` varchar(64) COLLATE utf8_bin NOT NULL,
  `id_pelanggan` char(64) COLLATE utf8_bin NOT NULL,
  `kode_barang` char(5) COLLATE utf8_bin DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `kode_layanan` char(5) COLLATE utf8_bin DEFAULT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `id_pelanggan` (`id_pelanggan`),
  KEY `FK_data_transaksi_data_barang` (`kode_barang`),
  KEY `FK_data_transaksi_data_layanan` (`kode_layanan`),
  CONSTRAINT `FK_data_transaksi_data_barang` FOREIGN KEY (`kode_barang`) REFERENCES `data_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_data_transaksi_data_layanan` FOREIGN KEY (`kode_layanan`) REFERENCES `data_layanan` (`kode_layanan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `data_transaksi_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `data_pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table admin_smartvillage.data_transaksi: ~3 rows (approximately)
DELETE FROM `data_transaksi`;
/*!40000 ALTER TABLE `data_transaksi` DISABLE KEYS */;
INSERT INTO `data_transaksi` (`id_transaksi`, `id_pelanggan`, `kode_barang`, `qty`, `kode_layanan`, `tanggal`) VALUES
	('1', '1', '1', 2, 'L01', '2022-06-08'),
	('2', '2', NULL, NULL, 'L01', '2022-06-08'),
	('3', '1', '1', 1, 'L01', '2022-06-08');
/*!40000 ALTER TABLE `data_transaksi` ENABLE KEYS */;

-- Dumping structure for table admin_smartvillage.perjanjian_kerjasama
DROP TABLE IF EXISTS `perjanjian_kerjasama`;
CREATE TABLE IF NOT EXISTS `perjanjian_kerjasama` (
  `id_pks` varchar(64) COLLATE utf8_bin NOT NULL,
  `nama_desa` varchar(30) COLLATE utf8_bin NOT NULL,
  `nama_kades` mediumtext COLLATE utf8_bin NOT NULL,
  `tgl` date NOT NULL,
  `id_transaksi` varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_pks`),
  KEY `id_transaksi` (`id_transaksi`),
  CONSTRAINT `perjanjian_kerjasama_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `data_transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table admin_smartvillage.perjanjian_kerjasama: ~0 rows (approximately)
DELETE FROM `perjanjian_kerjasama`;
/*!40000 ALTER TABLE `perjanjian_kerjasama` DISABLE KEYS */;
/*!40000 ALTER TABLE `perjanjian_kerjasama` ENABLE KEYS */;

-- Dumping structure for table admin_smartvillage.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` varchar(64) COLLATE utf8_bin NOT NULL,
  `username` varchar(30) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `nama_lengkap` mediumtext COLLATE utf8_bin NOT NULL,
  `jabatan` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `no_telp` varchar(20) COLLATE utf8_bin NOT NULL,
  `alamat` mediumtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table admin_smartvillage.users: ~1 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id_user`, `username`, `password`, `nama_lengkap`, `jabatan`, `role_id`, `email`, `no_telp`, `alamat`) VALUES
	('1', 'ahmadsyafar', '$2a$12$PMNuf2cbjHMrrvo27U/rO.Bq75DF33X2ll6k2Pm4sxnRd6Eef7HJa', 'Ahmad Syafarudin', 0, 0, 'ahmad@magang.com', '0895604395176', 'Pringsewu');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
