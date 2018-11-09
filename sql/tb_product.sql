-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2018 at 06:54 AM
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
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `product_id` int(11) NOT NULL COMMENT 'id',
  `product_code` varchar(20) DEFAULT NULL COMMENT 'รหัสสินค้า',
  `product_name` varchar(100) NOT NULL COMMENT 'สินค้า',
  `product_detail` varchar(255) DEFAULT NULL COMMENT 'รายละเอียดสินค้า',
  `brand` varchar(100) DEFAULT NULL COMMENT 'ยี่ห้อ',
  `normal_price` float NOT NULL DEFAULT '0' COMMENT 'ราคาตั้ง',
  `promotion_price` float DEFAULT NULL COMMENT 'ราคาโปรโมชั่น',
  `floor_price` float DEFAULT '0' COMMENT 'ราคาต่ำสุด',
  `amount_in_stock` int(11) NOT NULL DEFAULT '0' COMMENT 'จำนวนในคลัง',
  `product_unit` varchar(10) NOT NULL DEFAULT 'ชิ้น' COMMENT 'หน่วย'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`product_id`, `product_code`, `product_name`, `product_detail`, `brand`, `normal_price`, `promotion_price`, `floor_price`, `amount_in_stock`, `product_unit`) VALUES
(1, 'FIN-01', 'สินค้าสำเร็จรูป', NULL, NULL, 100, 200, 0, 0, 'ชิ้น'),
(2, '01431-SAE', 'ชุดผ้าเบรค', NULL, NULL, 100, NULL, 0, 0, 'ชิ้น'),
(3, 'PRO-01', 'ลูกสูบ', NULL, NULL, 100, NULL, 0, 0, 'ชิ้น');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
