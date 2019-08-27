-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2018 at 09:48 AM
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
-- Table structure for table `tb_quotation`
--

CREATE TABLE `tb_quotation` (
  `quotation_id` int(11) NOT NULL COMMENT 'id',
  `quotation_code` varchar(20) DEFAULT NULL COMMENT 'เลขที่ใบเสนอราคา',
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่เวลา',
  `customer_id` int(11) NOT NULL COMMENT 'รหัสลูกค้า',
  `debt_duration` int(11) NOT NULL COMMENT 'ระยะเวลาหนี้ (วัน)',
  `billing_duration` int(11) NOT NULL COMMENT 'กำหนดยื่นราคา (วัน)',
  `payment_condition` varchar(255) DEFAULT NULL COMMENT 'เงื่อนไขการชำระเงิน',
  `delivery_type_id` int(11) NOT NULL COMMENT 'ขนส่งโดย',
  `tax_type_id` int(11) NOT NULL COMMENT 'ชนิดภาษี',
  `delivery_time` int(11) NOT NULL COMMENT 'ระยะเวลาในกาส่งของ (วัน)',
  `department_id` int(11) DEFAULT NULL COMMENT 'รหัสแผนก',
  `sales_status_id` int(11) NOT NULL COMMENT 'สถานะ',
  `user_id` int(11) NOT NULL COMMENT 'รหัสพนักงานขาย',
  `zone_id` int(11) NOT NULL COMMENT 'เขตการขาย',
  `remark` varchar(255) DEFAULT NULL COMMENT 'หมายเหตุ',
  `vat_percent` float DEFAULT '7' COMMENT 'อัตราภาษี %'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_quotation`
--

INSERT INTO `tb_quotation` (`quotation_id`, `quotation_code`, `datetime`, `customer_id`, `debt_duration`, `billing_duration`, `payment_condition`, `delivery_type_id`, `tax_type_id`, `delivery_time`, `department_id`, `sales_status_id`, `user_id`, `zone_id`, `remark`, `vat_percent`) VALUES
(1, 'QT4801-00001', '2018-09-13 00:00:00', 4, 7, 15, '', 1, 2, 0, 0, 3, 4, 1, '', 0),
(2, 'QT4801-00002', '2018-09-13 00:00:00', 4, 7, 15, '', 1, 2, 0, 0, 3, 4, 1, '', 0),
(3, 'QT1810-00001', '2018-10-02 17:16:49', 4, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 1, NULL, 0),
(4, 'QT1810-00002', '2018-10-02 17:19:09', 4, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 1, NULL, 0),
(5, 'QT1810-00003', '2018-10-02 17:19:32', 4, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 1, NULL, 0),
(6, 'QT1810-00004', '2018-10-03 10:38:17', 4, 1, 1, '1', 1, 2, 1, NULL, 2, 4, 1, '1', 0),
(7, 'QT6110-00005', '2018-10-03 10:42:25', 4, 1, 1, '1', 1, 2, 1, NULL, 2, 4, 2, '1', 0),
(8, 'QT6110-00006', '2018-10-03 10:44:44', 4, 1, 1, '1', 1, 2, 1, NULL, 2, 4, 2, '1', 0),
(9, 'QT6110-00007', '2018-10-05 16:55:19', 5, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 2, '1', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_quotation`
--
ALTER TABLE `tb_quotation`
  ADD PRIMARY KEY (`quotation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_quotation`
--
ALTER TABLE `tb_quotation`
  MODIFY `quotation_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
