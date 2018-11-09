-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2018 at 05:37 PM
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
-- Table structure for table `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `supplier_id` int(11) NOT NULL COMMENT 'id',
  `supplier_type` varchar(100) NOT NULL COMMENT 'ประเภทลูกหนี้',
  `company_name` varchar(100) NOT NULL COMMENT 'ชื่อบริษัท',
  `account_id` int(11) DEFAULT NULL COMMENT 'รหัสผังบัญชี',
  `contact_name` varchar(100) NOT NULL COMMENT 'ชื่อผู้ติดต่อ',
  `address` varchar(100) NOT NULL COMMENT 'ที่อยู่',
  `sub_district` varchar(100) NOT NULL COMMENT 'ตำบล',
  `district` varchar(100) NOT NULL COMMENT 'อำเภอ',
  `province` varchar(100) NOT NULL COMMENT 'จังหวัด',
  `zipcode` varchar(10) NOT NULL COMMENT 'รหัสไปรษณีย์',
  `delivery_address` varchar(100) NOT NULL COMMENT 'ที่อยู่ส่งของ',
  `delivery_sub_district` varchar(100) NOT NULL COMMENT 'ตำบล (ส่งของ)',
  `delivery_district` varchar(100) NOT NULL COMMENT 'อำเภอ (ส่งของ)',
  `delivery_province` varchar(100) NOT NULL COMMENT 'จังหวัด (ส่งของ)',
  `delivery_zipcode` varchar(10) NOT NULL COMMENT 'รหัสไปรษณีย์ (ส่งของ)',
  `user_id` int(11) NOT NULL COMMENT 'รหัสพนักงานขาย',
  `telephone` varchar(100) NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `fax` varchar(100) DEFAULT NULL COMMENT 'เบอร์แฟ็กซ์',
  `email` varchar(100) DEFAULT NULL COMMENT 'อีเมล์',
  `zone_id` int(11) NOT NULL COMMENT 'เขตการขาย',
  `transpotation_id` int(11) NOT NULL COMMENT 'ขนส่งโดย',
  `remark` varchar(255) NOT NULL COMMENT 'หมายเหตุ',
  `max_credit` float NOT NULL COMMENT 'วงเงินเครดิต',
  `debt_duration` int(11) NOT NULL COMMENT 'ระยะเวลาหนี้ (วัน)',
  `degree_product` int(11) DEFAULT NULL COMMENT 'ระดับของราคาสินค้า',
  `loyalty_discount` float DEFAULT NULL COMMENT 'ส่วนลดประจำ',
  `tax_number` varchar(13) NOT NULL COMMENT 'เลขที่ภาษี',
  `billing_condition` varchar(255) DEFAULT NULL COMMENT 'เงื่อนไขวางบิล',
  `cheqe_condition` varchar(255) DEFAULT NULL COMMENT 'เงื่อนไขรับเช็ค',
  `location_type_id` int(11) DEFAULT '0' COMMENT 'ชนิดสถานประกอบการ',
  `branch_id` int(11) DEFAULT '0' COMMENT 'สำนักงาน/สาขา',
  `debt_balance` float DEFAULT '0' COMMENT 'ยอดหนี้ขณะนี้'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_supplier`
--

INSERT INTO `tb_supplier` (`supplier_id`, `supplier_type`, `company_name`, `account_id`, `contact_name`, `address`, `sub_district`, `district`, `province`, `zipcode`, `delivery_address`, `delivery_sub_district`, `delivery_district`, `delivery_province`, `delivery_zipcode`, `user_id`, `telephone`, `fax`, `email`, `zone_id`, `transpotation_id`, `remark`, `max_credit`, `debt_duration`, `degree_product`, `loyalty_discount`, `tax_number`, `billing_condition`, `cheqe_condition`, `location_type_id`, `branch_id`, `debt_balance`) VALUES
(4, '', 'Company A', 11011, 'Name A', 'xxxxx22222', '', '', '', '', 'asdcsae', '', '', '', '', 100, '099-199-4665', '02-9999-9', NULL, 0, 0, 'sadxzcwqesa', 1121, 120120, 12012012, 120120, '1201201', '', '', 0, 0, 1000),
(5, 'consumer', 'Company B', 1101, 'Name B', 'dsadsa', '', '', '', '', 'sadrsadr', '', '', '', '', 100, '099-199-4665', '02-9999-99999', NULL, 0, 0, 'sdarwerawe', 50, 50, 50, 50, '50', 'fist_mon', 'fist_mon', 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
