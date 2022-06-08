-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 08, 2022 at 02:28 PM
-- Server version: 8.0.29-0ubuntu0.22.04.1
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_smartvillage`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_barang`
--

CREATE TABLE `data_barang` (
  `kode_barang` char(5) CHARACTER SET utf8mb3 COLLATE utf8_bin NOT NULL,
  `nama_barang` varchar(30) COLLATE utf8_bin NOT NULL,
  `harga_barang` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `data_layanan`
--

CREATE TABLE `data_layanan` (
  `kode_layanan` char(5) COLLATE utf8_bin NOT NULL,
  `nama_layanan` varchar(30) COLLATE utf8_bin NOT NULL,
  `harga_layanan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `data_pelanggan`
--

CREATE TABLE `data_pelanggan` (
  `id_pelanggan` varchar(64) COLLATE utf8_bin NOT NULL,
  `nama_pelanggan` mediumtext COLLATE utf8_bin NOT NULL,
  `no_telp` varchar(20) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `alamat` mediumtext COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `data_pesanan`
--

CREATE TABLE `data_pesanan` (
  `id_pesanan` varchar(64) COLLATE utf8_bin NOT NULL,
  `id_transaksi` varchar(64) COLLATE utf8_bin NOT NULL,
  `kode_barang` char(5) CHARACTER SET utf8mb3 COLLATE utf8_bin NOT NULL,
  `kode_layanan` char(5) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `data_traksaksi`
--

CREATE TABLE `data_traksaksi` (
  `id_transaksi` varchar(64) COLLATE utf8_bin NOT NULL,
  `nama_desa` varchar(30) COLLATE utf8_bin NOT NULL,
  `qty` int NOT NULL,
  `total` int NOT NULL,
  `id_pelanggan` char(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `perjanjian_kerjasama`
--

CREATE TABLE `perjanjian_kerjasama` (
  `id_perjanjian_kerjasama` varchar(64) COLLATE utf8_bin NOT NULL,
  `nama_desa` varchar(30) COLLATE utf8_bin NOT NULL,
  `nama_kades` mediumtext COLLATE utf8_bin NOT NULL,
  `tgl` date NOT NULL,
  `id_transaksi` varchar(64) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8_bin NOT NULL,
  `nama_lengkap` mediumtext CHARACTER SET utf8mb3 COLLATE utf8_bin,
  `role_id` int DEFAULT NULL,
  `jabatan` int DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8_bin DEFAULT NULL,
  `no_telp` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8_bin DEFAULT NULL,
  `alamat` mediumtext CHARACTER SET utf8mb3 COLLATE utf8_bin
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama_lengkap`, `role_id`, `jabatan`, `email`, `no_telp`, `alamat`) VALUES
(14, 'asfsf', '$2y$10$CH8buDRZrGb97Z9iVISI2OviV7i6NDp3OgJBvewWLQEeC9AyeYQDC', NULL, 2, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_barang`
--
ALTER TABLE `data_barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `data_layanan`
--
ALTER TABLE `data_layanan`
  ADD PRIMARY KEY (`kode_layanan`);

--
-- Indexes for table `data_pelanggan`
--
ALTER TABLE `data_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `data_pesanan`
--
ALTER TABLE `data_pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_transaksi_idx` (`id_transaksi`),
  ADD KEY `kode_barang_idx` (`kode_layanan`),
  ADD KEY `fk_data_pesanan_data_barang1_idx` (`kode_barang`);

--
-- Indexes for table `data_traksaksi`
--
ALTER TABLE `data_traksaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pelanggan` (`id_pelanggan`);

--
-- Indexes for table `perjanjian_kerjasama`
--
ALTER TABLE `perjanjian_kerjasama`
  ADD PRIMARY KEY (`id_perjanjian_kerjasama`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_pesanan`
--
ALTER TABLE `data_pesanan`
  ADD CONSTRAINT `fk_data_pesanan_data_barang1` FOREIGN KEY (`kode_barang`) REFERENCES `data_barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `data_traksaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kode_layanan` FOREIGN KEY (`kode_layanan`) REFERENCES `data_layanan` (`kode_layanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_traksaksi`
--
ALTER TABLE `data_traksaksi`
  ADD CONSTRAINT `data_traksaksi_ibfk_2` FOREIGN KEY (`id_pelanggan`) REFERENCES `data_pelanggan` (`id_pelanggan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `perjanjian_kerjasama`
--
ALTER TABLE `perjanjian_kerjasama`
  ADD CONSTRAINT `perjanjian_kerjasama_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `data_traksaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
