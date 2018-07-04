-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 04, 2018 at 09:03 AM
-- Server version: 10.2.12-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id5594390_arctech`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT 'norole'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Chavalit Koweerawong', 'chavalit.kow@gmail.com', '$2y$10$Z16Qz0VDUfSWGzAUmsnru.16e3zs4lHnqIo0WctddiZU35Qy9jd7u', 'GWPNAVLYa1ESBQnxhYcV0gFQZymu9xpZaok4jegphNavPEVJ9oRDyO5vPh3B', '2018-06-28 10:54:25', '2018-06-28 10:54:25', 'admin'),
(2, 'Kantachai', 'manager@gmail.com', '$2y$10$l6PQJHga5Cw6RVTu.mBRJ.SOIHShK0v.e/dj.kA84G0T6wnZW9pVG', 'sOcovFLCqiLxvzW9Wv5s0MY2MOu2GxSpoz1hhYeYbur1yHYjFZxwJ5NpqdVp', '2018-07-04 08:44:01', '2018-07-04 08:44:01', 'manager'),
(3, 'Finance', 'finance@gmail.com', '$2y$10$S1KPrKKxibtqE6ZckghdDeSz10yjeBXCyvOANc0meZa/Z67F3GKLu', 'K0SPXlqn9pvoY4UNQlKPMJGIrlp1r66YZXU3TnkUmGRuNQQd4k9rC1G1Uhgd', '2018-07-04 08:44:44', '2018-07-04 08:44:44', 'finance'),
(4, 'Sales', 'sales@gmail.com', '$2y$10$WyMRYhZF/yZBhhTNmg5GV.YsJ0XiVxh5spZm1UbeUOkhOWAj4Fpi2', 'JPyKSYdGGsA1gp8gaG569i7W9n65oWx10QER5NDUtc1YiaFkQYC37Zxkg1zf', '2018-07-04 08:45:16', '2018-07-04 08:45:16', 'sales');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
