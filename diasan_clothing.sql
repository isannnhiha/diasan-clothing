-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2026 at 06:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diasan_clothing`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `admin` varchar(100) DEFAULT NULL,
  `aktivitas` text DEFAULT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `admin`, `aktivitas`, `waktu`) VALUES
(1, 'admin', '🔑 Login ke sistem', '2026-07-12 09:37:30'),
(2, 'admin', '✏️ Mengedit pesanan milik aa', '2026-07-12 09:57:53'),
(3, 'admin', '🗑️ Menghapus pesanan milik apip p (Jaket Kulit)', '2026-07-12 09:59:29'),
(4, 'admin', '🚪 Logout dari sistem', '2026-07-12 10:03:18'),
(5, 'admin', '🔑 Login ke sistem', '2026-07-12 10:03:23'),
(6, 'admin', '🚪 Logout dari sistem', '2026-07-12 10:05:24'),
(7, 'admin', '🔑 Login ke sistem', '2026-07-12 10:05:30'),
(8, 'admin', '🚪 Logout dari sistem', '2026-07-12 10:15:22'),
(9, 'admin', '🚪 Logout dari sistem', '2026-07-12 10:23:07'),
(10, 'admin', '🚪 Logout dari sistem', '2026-07-12 10:33:39'),
(11, 'admin', '🚪 Logout dari sistem', '2026-07-12 13:08:10'),
(12, 'admin', '🚪 Logout dari sistem', '2026-07-12 13:11:19'),
(13, 'admin', '🚪 Logout dari sistem', '2026-07-12 13:13:30'),
(14, 'admin', '🚪 Logout dari sistem', '2026-07-12 13:20:31'),
(15, 'admin', '✏️ Mengedit pesanan milik dion', '2026-07-12 13:23:54'),
(16, 'admin', '🚪 Logout dari sistem', '2026-07-12 13:24:16'),
(17, 'admin', '✏️ Mengedit pesanan milik isan m', '2026-07-12 13:56:33'),
(18, 'admin', '🗑️ Menghapus pesanan milik aa (Kemeja Flanel)', '2026-07-12 13:56:43'),
(19, 'admin', '✏️ Mengedit pesanan milik dion', '2026-07-12 13:56:56'),
(20, 'admin', '✏️ Mengedit pesanan milik isan m', '2026-07-12 13:57:27'),
(21, 'admin', '🚪 Logout dari sistem', '2026-07-12 13:58:16'),
(22, 'admin', '✏️ Mengedit pesanan milik dion', '2026-07-12 15:56:01'),
(23, 'admin', '🗑️ Menghapus pesanan milik dion (Kaos Polos)', '2026-07-12 15:56:14'),
(24, 'admin', '🚪 Logout dari sistem', '2026-07-12 15:58:06');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `produk` varchar(50) DEFAULT NULL,
  `ukuran` varchar(10) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `nama`, `alamat`, `no_hp`, `produk`, `ukuran`, `jumlah`, `total_harga`) VALUES
(46, 'dion', 'genuk', '081234567', 'Kaos Polos', 'XL', 1, 85000),
(47, 'isan m', 'morowali', '0123456789', 'Kaos Polos', 'L', 5, 425000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
