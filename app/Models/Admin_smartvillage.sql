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

-- Dumping structure for table admin_smartvillage.barang_order
CREATE TABLE IF NOT EXISTS `barang_order` (
  `id_barang` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `kode_barang` char(11) COLLATE utf8_bin DEFAULT NULL,
  `nama_barang` mediumtext COLLATE utf8_bin,
  `harga_barang` int(10) unsigned DEFAULT '0',
  `qty` int(11) DEFAULT NULL,
  `id_transaksi` varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_barang`),
  KEY `FK__data_transaksi` (`id_transaksi`),
  CONSTRAINT `FK__data_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `data_transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table admin_smartvillage.barang_order: ~1 rows (approximately)
DELETE FROM `barang_order`;
/*!40000 ALTER TABLE `barang_order` DISABLE KEYS */;
INSERT INTO `barang_order` (`id_barang`, `kode_barang`, `nama_barang`, `harga_barang`, `qty`, `id_transaksi`) VALUES
	('62afed9b227d9', 'B001', 'Asus ROG ', 30000000, 1, '62afed9b1459a'),
	('62afeebf699a9', 'B002', 'Aqua', 2500, 2, '62afeebf68cfe');
/*!40000 ALTER TABLE `barang_order` ENABLE KEYS */;

-- Dumping structure for table admin_smartvillage.data_barang
CREATE TABLE IF NOT EXISTS `data_barang` (
  `kode_barang` char(10) COLLATE utf8_bin NOT NULL,
  `nama_barang` varchar(30) COLLATE utf8_bin NOT NULL,
  `harga_barang` int(11) unsigned NOT NULL,
  PRIMARY KEY (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table admin_smartvillage.data_barang: ~0 rows (approximately)
DELETE FROM `data_barang`;
/*!40000 ALTER TABLE `data_barang` DISABLE KEYS */;
INSERT INTO `data_barang` (`kode_barang`, `nama_barang`, `harga_barang`) VALUES
	('B001', 'Asus ROG ', 30000000),
	('B002', 'Aqua', 2500);
/*!40000 ALTER TABLE `data_barang` ENABLE KEYS */;

-- Dumping structure for table admin_smartvillage.data_layanan
CREATE TABLE IF NOT EXISTS `data_layanan` (
  `kode_layanan` char(10) COLLATE utf8_bin NOT NULL,
  `nama_layanan` varchar(30) COLLATE utf8_bin NOT NULL,
  `harga_layanan` int(11) unsigned NOT NULL,
  PRIMARY KEY (`kode_layanan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table admin_smartvillage.data_layanan: ~2 rows (approximately)
DELETE FROM `data_layanan`;
/*!40000 ALTER TABLE `data_layanan` DISABLE KEYS */;
INSERT INTO `data_layanan` (`kode_layanan`, `nama_layanan`, `harga_layanan`) VALUES
	('L001', 'Web OpenSID', 10000000),
	('L002', 'Input Data', 3000000);
/*!40000 ALTER TABLE `data_layanan` ENABLE KEYS */;

-- Dumping structure for table admin_smartvillage.data_pelanggan
CREATE TABLE IF NOT EXISTS `data_pelanggan` (
  `id_pelanggan` varchar(64) COLLATE utf8_bin NOT NULL,
  `nama_pelanggan` mediumtext COLLATE utf8_bin NOT NULL,
  `nama_desa` mediumtext COLLATE utf8_bin NOT NULL,
  `no_telp` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `alamat` mediumtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table admin_smartvillage.data_pelanggan: ~2 rows (approximately)
DELETE FROM `data_pelanggan`;
/*!40000 ALTER TABLE `data_pelanggan` DISABLE KEYS */;
INSERT INTO `data_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `nama_desa`, `no_telp`, `email`, `alamat`) VALUES
	('1', 'Ahmad Syafarudin', 'Pringsewu', '0895604395176', 'ahmad@gmail.com', 'Jl. Kesehatan Pringsewu Selatan'),
	('2', 'Khoirul Roziq', 'Sekampung', '0815131325255', 'khoirul@gmail.com', 'Jl. Tanjung Raya Sekampung, Lampung Timur');
/*!40000 ALTER TABLE `data_pelanggan` ENABLE KEYS */;

-- Dumping structure for table admin_smartvillage.data_transaksi
CREATE TABLE IF NOT EXISTS `data_transaksi` (
  `id_transaksi` varchar(64) COLLATE utf8_bin NOT NULL,
  `id_pelanggan` char(64) COLLATE utf8_bin NOT NULL,
  `total` bigint(20) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `id_pelanggan` (`id_pelanggan`),
  CONSTRAINT `data_transaksi_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `data_pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table admin_smartvillage.data_transaksi: ~1 rows (approximately)
DELETE FROM `data_transaksi`;
/*!40000 ALTER TABLE `data_transaksi` DISABLE KEYS */;
INSERT INTO `data_transaksi` (`id_transaksi`, `id_pelanggan`, `total`, `tanggal`, `status`) VALUES
	('62afed9b1459a', '1', 33000000, '2022-06-20', 1),
	('62afeebf68cfe', '2', 10005000, '2022-06-20', 1);
/*!40000 ALTER TABLE `data_transaksi` ENABLE KEYS */;

-- Dumping structure for table admin_smartvillage.layanan_order
CREATE TABLE IF NOT EXISTS `layanan_order` (
  `id_layanan` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `kode_layanan` char(11) COLLATE utf8_bin DEFAULT NULL,
  `nama_layanan` mediumtext COLLATE utf8_bin,
  `harga_layanan` int(10) unsigned DEFAULT '0',
  `id_transaksi` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_layanan`),
  KEY `FK__data_transaksi_layanan` (`id_transaksi`),
  CONSTRAINT `FK__data_transaksi_layanan` FOREIGN KEY (`id_transaksi`) REFERENCES `data_transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table admin_smartvillage.layanan_order: ~1 rows (approximately)
DELETE FROM `layanan_order`;
/*!40000 ALTER TABLE `layanan_order` DISABLE KEYS */;
INSERT INTO `layanan_order` (`id_layanan`, `kode_layanan`, `nama_layanan`, `harga_layanan`, `id_transaksi`) VALUES
	('62afed9b23437', 'L002', 'Input Data', 3000000, '62afed9b1459a'),
	('62afeebf6a378', 'L001', 'Web OpenSID', 10000000, '62afeebf68cfe');
/*!40000 ALTER TABLE `layanan_order` ENABLE KEYS */;

-- Dumping structure for table admin_smartvillage.perjanjian_kerjasama
CREATE TABLE IF NOT EXISTS `perjanjian_kerjasama` (
  `id_pks` varchar(64) COLLATE utf8_bin NOT NULL,
  `nama_desa` varchar(30) COLLATE utf8_bin NOT NULL,
  `nama_kades` mediumtext COLLATE utf8_bin NOT NULL,
  `tanggal` date NOT NULL,
  `id_transaksi` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id_pks`),
  KEY `id_transaksi` (`id_transaksi`),
  CONSTRAINT `perjanjian_kerjasama_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `data_transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dumping data for table admin_smartvillage.perjanjian_kerjasama: ~1 rows (approximately)
DELETE FROM `perjanjian_kerjasama`;
/*!40000 ALTER TABLE `perjanjian_kerjasama` DISABLE KEYS */;
INSERT INTO `perjanjian_kerjasama` (`id_pks`, `nama_desa`, `nama_kades`, `tanggal`, `id_transaksi`) VALUES
	('62afed9b23a7d', 'Pringsewu', '', '2022-06-20', '62afed9b1459a'),
	('62afeebfa82f4', 'Sekampung', '', '2022-06-20', '62afeebf68cfe');
/*!40000 ALTER TABLE `perjanjian_kerjasama` ENABLE KEYS */;

-- Dumping structure for table admin_smartvillage.users
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

-- Dumping data for table admin_smartvillage.users: ~2 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id_user`, `username`, `password`, `nama_lengkap`, `jabatan`, `role_id`, `email`, `no_telp`, `alamat`) VALUES
	('62a19deb7cc67', 'admin', '$2a$12$twOWVeXBj42RVi8SKZlIDuLlJqzhnjVI4A8Lhjj3.0Ih0ak6QWbaW', '', 0, 321, '', '', ''),
	('62ad51525f56b', 'ahmadsyafar', '$2y$10$Me37Xf9YSxVqcj5.6beqnOmL85.5F1aHh4LTGNagsQyAzBSgFe/gK', '', 0, 2, '', '', '');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
