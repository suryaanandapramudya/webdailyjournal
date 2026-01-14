-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jan 14, 2026 at 03:46 AM
-- Server version: 10.4.34-MariaDB-1:10.4.34+maria~ubu2004
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdailyjournal`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `judul` text DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `judul`, `isi`, `gambar`, `tanggal`, `username`) VALUES
(1, 'Perpustakaan Kampus', 'This is a wider card with supporting text below as a natural lead-in to additional content.', 'keg1.jpg', '2025-12-19', 'admin'),
(2, 'Ruang Kelas', 'This card has supporting text below as a natural lead-in to additional content.', 'keg2.jpg', '2025-12-19', 'admin'),
(3, 'Kelompok Belajar', 'This is a wider card with supporting text below as a natural lead-in to additional content.', 'keg3.jpg', '2025-12-19', 'admin'),
(4, 'Auditorium', 'This is a wider card with supporting text below as a natural lead-in to additional content.', 'keg4.jpg', '2025-12-19', 'admin'),
(5, 'Taman', 'This card has supporting text below as a natural lead-in to additional content.', 'keg5.jpg', '2025-12-19', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `judul` text DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `judul`, `gambar`, `tanggal`, `username`) VALUES
(1, 'Galeri 1', 'gal1.jpg', '2025-12-19', 'admin'),
(2, 'Galeri 2', 'gal2.jpg', '2025-12-19', 'admin'),
(3, 'Galeri 3', 'gal4.jpg', '2025-12-19', 'admin'),
(4, 'Galeri 4', 'gal5.jpg', '2025-12-19', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `foto`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '20260114102615.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
