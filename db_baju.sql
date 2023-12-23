-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2023 at 05:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_baju`
--
CREATE DATABASE IF NOT EXISTS `db_baju` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_baju`;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `fk_merek` int(11) NOT NULL,
  `fk_kategori` int(11) NOT NULL,
  `Nama` varchar(200) NOT NULL,
  `Harga` int(11) NOT NULL,
  `Deskripsi` varchar(200) NOT NULL,
  `Gambar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `fk_merek`, `fk_kategori`, `Nama`, `Harga`, `Deskripsi`, `Gambar`) VALUES
(1, 1, 1, 'Growth Blue T-Shirt - S', 150000, 'asdasdawe', 'b57f8cad-3ca6-4344-b7a2-bac6d0027232.jpg'),
(2, 1, 1, 'Growth Blue T-Shirt - S', 150000, 'asdasdawe', 'b57f8cad-3ca6-4344-b7a2-bac6d0027232.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `dtrans`
--

DROP TABLE IF EXISTS `dtrans`;
CREATE TABLE `dtrans` (
  `id` int(11) NOT NULL,
  `fk_htrans` varchar(200) NOT NULL,
  `fk_barang` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `Harga` int(11) NOT NULL,
  `Subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dtrans`
--

INSERT INTO `dtrans` (`id`, `fk_htrans`, `fk_barang`, `qty`, `Harga`, `Subtotal`) VALUES
(3, 'N161220231151001', '1', 2, 150000, 300000),
(4, 'N161220231153001', '1', 2, 150000, 300000);

-- --------------------------------------------------------

--
-- Table structure for table `htrans`
--

DROP TABLE IF EXISTS `htrans`;
CREATE TABLE `htrans` (
  `id_nota` varchar(200) NOT NULL,
  `fk_customer` int(11) NOT NULL,
  `Grandtotal` int(11) NOT NULL,
  `Tanggal` date NOT NULL,
  `snap_token` text DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `htrans`
--

INSERT INTO `htrans` (`id_nota`, `fk_customer`, `Grandtotal`, `Tanggal`, `snap_token`, `status`) VALUES
('N161220231151001', 1, 300000, '2023-12-16', '20630ad6-a638-49d8-acaf-027c914f3543', 1),
('N161220231153001', 1, 300000, '2023-12-16', '3a8b5778-c0b2-418b-95eb-4cd2584ef6ee', 2);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `Nama`) VALUES
(1, 'Baju'),
(2, 'Celana');

-- --------------------------------------------------------

--
-- Table structure for table `merek`
--

DROP TABLE IF EXISTS `merek`;
CREATE TABLE `merek` (
  `id` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `merek`
--

INSERT INTO `merek` (`id`, `Nama`) VALUES
(1, 'Cole'),
(2, 'Nevada');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `fk_barang` int(11) NOT NULL,
  `Ukuran` varchar(20) NOT NULL,
  `JumlahStock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `fk_barang`, `Ukuran`, `JumlahStock`) VALUES
(1, 1, 'XL', 50),
(2, 2, 'XL', 10),
(4, 2, 'L', 15);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Nama` varchar(255) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Username`, `Nama`, `Email`, `Password`) VALUES
(1, 'Budi', 'Budi', 'Budi@gmail.com', '$2a$12$igqzJ32OT.gJcgcNTU2qp.LZjXo8Y.xkybg459k8ySX2n5/2vbKrW'),
(2, 'Andi', 'andi', 'andi@gmail.com', '$2a$12$igqzJ32OT.gJcgcNTU2qp.LZjXo8Y.xkybg459k8ySX2n5/2vbKrW'),
(3, 'as', 'as', 'as@gmail.com', '$2y$12$TbSqAYK5TzhthTbkfMbVYuiv3WuNR3l5d1ZP8u3jggBf/Thpn6pKK');

-- --------------------------------------------------------

--
-- Table structure for table `withlist`
--

DROP TABLE IF EXISTS `withlist`;
CREATE TABLE `withlist` (
  `id` int(11) NOT NULL,
  `fk_users` int(11) NOT NULL,
  `fk_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `withlist`
--

INSERT INTO `withlist` (`id`, `fk_users`, `fk_barang`) VALUES
(1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dtrans`
--
ALTER TABLE `dtrans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `htrans`
--
ALTER TABLE `htrans`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merek`
--
ALTER TABLE `merek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withlist`
--
ALTER TABLE `withlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dtrans`
--
ALTER TABLE `dtrans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `merek`
--
ALTER TABLE `merek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `withlist`
--
ALTER TABLE `withlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
