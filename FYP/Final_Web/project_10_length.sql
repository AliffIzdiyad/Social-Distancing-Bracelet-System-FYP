-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2022 at 08:07 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_10_length`
--

-- --------------------------------------------------------

--
-- Table structure for table `signal_length`
--

CREATE TABLE `signal_length` (
  `signal_id` int(11) NOT NULL,
  `signal_status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `starting_range` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ending_range` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `signal_length`
--

INSERT INTO `signal_length` (`signal_id`, `signal_status`, `starting_range`, `ending_range`) VALUES
(1, 'Far', '-85', '-61'),
(2, 'Near', '-60', '-46'),
(3, 'Too Near', '-45', '0');

-- --------------------------------------------------------

--
-- Table structure for table `signal_value`
--

CREATE TABLE `signal_value` (
  `id` int(11) NOT NULL,
  `signal_val` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `signal_value`
--

INSERT INTO `signal_value` (`id`, `signal_val`, `status`, `time_updated`) VALUES
(1, '-70', 'Far', '2022-01-30 04:52:01'),
(2, '-70', 'Far', '2022-01-30 04:52:11'),
(8, '-60', 'Near', '2022-01-30 15:19:33'),
(4, '-60', 'Near', '2022-01-30 13:23:02'),
(5, '-40', 'Too Near', '2022-01-30 13:23:19'),
(6, '-20', 'Too Near', '2022-01-30 13:23:44'),
(7, '-60', 'Near', '2022-01-30 13:28:05'),
(9, '-60', 'Near', '2022-01-30 15:19:39'),
(10, '-60', 'Near', '2022-01-30 15:20:03'),
(35, '-60', 'Near', '2022-01-30 20:08:49'),
(12, '-60', 'Near', '2022-01-30 15:20:04'),
(13, '-60', 'Near', '2022-01-30 15:20:04'),
(14, '-60', 'Near', '2022-01-30 15:20:05'),
(15, '-60', 'Near', '2022-01-30 15:23:01'),
(19, '-60', 'Near', '2022-01-30 15:23:02'),
(24, '-60', 'Near', '2022-01-30 15:23:02'),
(26, '-60', 'Near', '2022-01-30 15:23:03'),
(37, '-66', 'Far', '2022-01-30 20:10:58'),
(36, '-60', 'Near', '2022-01-30 20:09:32'),
(34, '-60', 'Near', '2022-01-30 15:23:52'),
(38, '-59', 'Near', '2022-01-30 20:32:14'),
(39, '-60', 'Near', '2022-01-30 20:32:24'),
(40, '-70', 'Far', '2022-01-30 20:32:35'),
(41, '-60', 'Near', '2022-01-30 20:32:45'),
(42, '-69', 'Far', '2022-01-30 20:32:55'),
(43, '-60', 'Near', '2022-01-30 20:33:05'),
(44, '-61', 'Far', '2022-01-30 20:33:15'),
(45, '-61', 'Far', '2022-01-30 20:33:25'),
(46, '-72', 'Far', '2022-01-30 20:33:35'),
(47, '-61', 'Far', '2022-01-30 20:33:45'),
(48, '-71', 'Far', '2022-01-30 20:33:56');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `level`) VALUES
(1, 'admin', 'QjRsT2NVWG8xWFV5ZnQvaTN5Nk9QUT09', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `signal_length`
--
ALTER TABLE `signal_length`
  ADD PRIMARY KEY (`signal_id`);

--
-- Indexes for table `signal_value`
--
ALTER TABLE `signal_value`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `signal_length`
--
ALTER TABLE `signal_length`
  MODIFY `signal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `signal_value`
--
ALTER TABLE `signal_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
