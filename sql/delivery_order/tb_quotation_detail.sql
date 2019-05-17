-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2019 at 08:35 AM
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
-- Table structure for table `tb_quotation_detail`
--

CREATE TABLE `tb_quotation_detail` (
  `quotation_detail_id` int(11) NOT NULL COMMENT '_id',
  `product_id` int(11) NOT NULL COMMENT 'รหัสสินค้า',
  `amount` int(11) NOT NULL DEFAULT '1' COMMENT 'จำนวน',
  `discount_price` float DEFAULT NULL COMMENT 'ราคาขาย (บาท)',
  `quotation_id` int(11) NOT NULL COMMENT 'เลขที่ใบเสนอราคา',
  `quotation_detail_remark` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_quotation_detail`
--

INSERT INTO `tb_quotation_detail` (`quotation_detail_id`, `product_id`, `amount`, `discount_price`, `quotation_id`, `quotation_detail_remark`) VALUES
(6, 1, 3, 100, 1, NULL),
(10, 1, 1, 80, 9, NULL),
(11, 3, 1, 100, 9, NULL),
(12, 1, 1, 100, 1, ''),
(15, 3, 1, 100, 1, ''),
(16, 2, 1, 100, 1, ''),
(17, 3, 1, 100, 1, ''),
(18, 3, 1, 100, 1, ''),
(19, 2, 1, 100, 6, ''),
(20, 2, 3, 100, 6, ''),
(29, 2, 1, 100, 18, ''),
(30, 1, 1, 200, 18, ''),
(73, 2, 1, 100, 5, ''),
(122, 3, 1, 855, 12, ''),
(123, 2, 1, 855, 12, ''),
(124, 2, 1, 577, 12, ''),
(125, 1, 1, 5675, 12, ''),
(206, 2, 12, 0, 3, ''),
(207, 1, 120, 70, 3, ''),
(208, 3, 20, 210, 3, ''),
(209, 1, 25, 70, 3, ''),
(210, 3, 25, 210, 3, ''),
(211, 2, 25, 180, 3, ''),
(212, 2, 1, 140, 3, ''),
(213, 1, 1, 90, 3, ''),
(215, 1, 1, 1, 1, '1'),
(230, 27414, 1, 0, 4, '1'),
(231, 27414, 1, 250, 20, ''),
(232, 27415, 1, 250, 20, ''),
(235, 2846, 1, 150, 19, ''),
(236, 2916, 1, 150, 19, ''),
(237, 2825, 1, 175, 19, ''),
(238, 2895, 1, 175, 19, ''),
(239, 2916, 1, 175, 21, ''),
(240, 2941, 1, 175, 21, ''),
(241, 2846, 1, 176.75, 22, ''),
(242, 2846, 1, 175, 23, ''),
(243, 2825, 1, 175, 23, ''),
(244, 2895, 1, 175, 23, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_quotation_detail`
--
ALTER TABLE `tb_quotation_detail`
  ADD PRIMARY KEY (`quotation_detail_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_quotation_detail`
--
ALTER TABLE `tb_quotation_detail`
  MODIFY `quotation_detail_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '_id', AUTO_INCREMENT=245;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
