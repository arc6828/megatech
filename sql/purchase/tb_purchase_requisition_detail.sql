-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2018 at 06:16 AM
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
-- Table structure for table `tb_purchase_requisition_detail`
--

CREATE TABLE `tb_purchase_requisition_detail` (
  `purchase_requisition_detail_id` int(11) NOT NULL COMMENT '_id',
  `product_id` int(11) NOT NULL COMMENT 'รหัสสินค้า',
  `amount` int(11) NOT NULL DEFAULT '1' COMMENT 'จำนวน',
  `discount_price` float DEFAULT NULL COMMENT 'ราคาขาย (บาท)',
  `purchase_requisition_id` int(11) NOT NULL COMMENT 'เลขที่ใบเสนอราคา',
  `purchase_requisition_detail_remark` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_purchase_requisition_detail`
--

INSERT INTO `tb_purchase_requisition_detail` (`purchase_requisition_detail_id`, `product_id`, `amount`, `discount_price`, `purchase_requisition_id`, `purchase_requisition_detail_remark`) VALUES
(5, 1, 10, 60, 1, NULL),
(6, 1, 1, 100, 1, NULL),
(7, 1, 1, 100, 1, NULL),
(8, 1, 10, 90, 1, NULL),
(10, 1, 1, 80, 9, NULL),
(11, 3, 1, 100, 9, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_purchase_requisition_detail`
--
ALTER TABLE `tb_purchase_requisition_detail`
  ADD PRIMARY KEY (`purchase_requisition_detail_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_purchase_requisition_detail`
--
ALTER TABLE `tb_purchase_requisition_detail`
  MODIFY `purchase_requisition_detail_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '_id', AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
