-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2018 at 10:00 AM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `megatech`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_purchase_status`
--

CREATE TABLE `tb_purchase_status` (
  `purchase_status_id` int(11) NOT NULL,
  `purchase_status_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_purchase_status`
--

INSERT INTO `tb_purchase_status` (`purchase_status_id`, `purchase_status_name`) VALUES
(1, 'รอการตัดสินใจ'),
(2, 'รอเสนอผู้ใหญ่'),
(3, 'นัดวันส่งสินค้า'),
(4, 'ปิดการขายเรียบร้อย'),
(5, 'รอเสนอผู้ใหญ่'),
(6, 'ไม่สามารถปิดการขาย');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_purchase_status`
--
ALTER TABLE `tb_purchase_status`
  ADD PRIMARY KEY (`purchase_status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_purchase_status`
--
ALTER TABLE `tb_purchase_status`
  MODIFY `purchase_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
