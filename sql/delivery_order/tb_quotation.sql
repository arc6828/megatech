-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2019 at 08:34 AM
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
  `quotation_code` varchar(20) DEFAULT NULL COMMENT 'เลขที่เอกสาร',
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่เวลา',
  `customer_id` int(11) NOT NULL COMMENT 'รหัสลูกค้า',
  `debt_duration` int(11) NOT NULL COMMENT 'ระยะเวลาหนี้ (วัน)',
  `billing_duration` int(11) NOT NULL COMMENT 'กำหนดยื่นราคา (วัน)',
  `payment_condition` varchar(255) DEFAULT NULL COMMENT 'เงื่อนไขการชำระเงิน',
  `delivery_type_id` int(11) NOT NULL COMMENT 'ขนส่งโดย',
  `tax_type_id` int(11) NOT NULL COMMENT 'ชนิดภาษี',
  `delivery_time` int(11) NOT NULL COMMENT 'ระยะเวลาในกาส่งของ (วัน)',
  `department_id` varchar(11) DEFAULT NULL COMMENT 'รหัสแผนก',
  `sales_status_id` int(11) NOT NULL COMMENT 'สถานะ',
  `user_id` int(11) NOT NULL COMMENT 'รหัสพนักงานขาย',
  `zone_id` int(11) NOT NULL COMMENT 'เขตการขาย',
  `remark` varchar(255) DEFAULT NULL COMMENT 'หมายเหตุ',
  `vat_percent` float DEFAULT '7' COMMENT 'อัตราภาษี %',
  `internal_reference_doc` varchar(100) DEFAULT NULL,
  `external_reference_doc` varchar(100) DEFAULT NULL,
  `total` float DEFAULT '0' COMMENT 'ราคารวม'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_quotation`
--

INSERT INTO `tb_quotation` (`quotation_id`, `quotation_code`, `datetime`, `customer_id`, `debt_duration`, `billing_duration`, `payment_condition`, `delivery_type_id`, `tax_type_id`, `delivery_time`, `department_id`, `sales_status_id`, `user_id`, `zone_id`, `remark`, `vat_percent`, `internal_reference_doc`, `external_reference_doc`, `total`) VALUES
(3, 'QT1810-00001', '2018-10-02 17:16:49', 4, 120, 5, 'ภายใน 30 วัน', 1, 2, 1, 'admin', 1, 1, 1, 'sadxzcwqesa', 7, NULL, NULL, 24330),
(4, 'QT1810-00002', '2018-10-02 17:19:09', 4, 1, 1, '1', 1, 2, 1, 'admin', 1, 1, 1, NULL, 7, NULL, NULL, 0),
(5, 'QT1810-00003', '2018-10-02 17:19:32', 4, 1, 1, '1', 1, 2, 1, 'admin', 1, 1, 1, NULL, 0, NULL, NULL, 100),
(6, 'QT1810-00004', '2018-10-03 10:38:17', 4, 1, 1, '1', 1, 2, 1, 'admin', 2, 1, 1, '1', 0, NULL, NULL, 0),
(7, 'QT1812-00001', '2018-12-24 14:09:15', 5, 1, 1, '1', 2, 2, 1, 'admin', 4, 1, 1, NULL, NULL, NULL, NULL, 0),
(8, 'QT1812-00002', '2018-12-24 14:19:25', 4, 60, 30, 'ภายใน 30 วัน', 2, 2, 7, 'admin', 2, 1, 1, NULL, NULL, NULL, NULL, 0),
(9, 'QT1812-00003', '2018-12-24 14:23:53', 4, 60, 30, 'ภายใน 30 วัน', 2, 2, 7, 'admin', 2, 1, 1, NULL, NULL, NULL, NULL, 0),
(10, 'QT1812-00004', '2018-12-24 14:34:23', 4, 60, 30, 'ภายใน 30 วัน', 2, 2, 7, 'admin', 2, 1, 1, NULL, 7, NULL, NULL, 0),
(11, 'QT1812-00005', '2018-12-24 14:35:40', 4, 60, 30, 'ภายใน 30 วัน', 2, 2, 7, 'admin', 2, 1, 1, NULL, 1, NULL, NULL, 0),
(12, 'QT1901-00001', '2019-01-07 17:20:45', 4, 0, 30, 'ภายใน 30 วัน', 2, 2, 30, 'admin', 1, 1, 0, NULL, 7, NULL, NULL, 8519.34),
(13, 'QT1901-00002', '2019-01-07 17:25:42', 4, 60, 30, 'ภายใน 30 วัน', 2, 2, 30, 'admin', 1, 1, 1, NULL, 7, NULL, NULL, 0),
(14, 'QT1901-00003', '2019-01-07 17:39:24', 4, 60, 30, 'ภายใน 30 วัน', 2, 2, 30, 'admin', 1, 1, 1, NULL, 7, NULL, NULL, 0),
(15, 'QT1901-00004', '2019-01-07 17:43:01', 4, 60, 30, 'ภายใน 30 วัน', 2, 2, 30, 'admin', 1, 1, 1, NULL, 7, NULL, NULL, 0),
(16, 'QT1901-00005', '2019-01-07 17:49:55', 4, 60, 30, 'ภายใน 30 วัน', 2, 2, 30, 'admin', 1, 1, 1, NULL, 7, NULL, NULL, 0),
(17, 'QT1901-00006', '2019-01-07 17:50:35', 4, 60, 30, 'ภายใน 30 วัน', 2, 2, 30, 'admin', 1, 1, 1, NULL, 7, NULL, NULL, 0),
(18, 'QT1901-00007', '2019-01-07 17:52:55', 4, 60, 30, 'ภายใน 30 วัน', 2, 2, 30, 'admin', 1, 1, 1, NULL, 7, NULL, NULL, 0),
(19, 'QT1901-00008', '2019-01-08 16:37:24', 114, 0, 2, '3', 1, 2, 3, 'admin', 1, 1, 0, NULL, 7, NULL, NULL, 695.5),
(20, 'QT1901-00009', '2019-01-24 17:46:30', 4, 0, 30, 'ภายใน 30 วัน', 2, 2, 30, 'admin', 1, 1, 0, NULL, 7, NULL, NULL, 535),
(21, 'QT1905-00001', '2019-05-14 16:00:02', 5, 60, 30, 'ภายใน 30 วัน', 2, 2, 30, 'sales', 1, 4, 1, NULL, 7, NULL, NULL, 374.5),
(22, 'QT1905-00002', '2019-05-14 16:15:48', 395, 60, 30, 'ภายใน 30 วัน', 2, 2, 30, 'admin', 1, 1, 1, NULL, 7, NULL, NULL, 189.12),
(23, 'QT1905-00003', '2019-05-16 16:16:22', 395, 60, 30, 'ภายใน 30 วัน', 2, 2, 30, 'admin', 1, 1, 1, NULL, 7, NULL, NULL, 561.75);

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
  MODIFY `quotation_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
