-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2018 at 08:16 AM
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
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id_account` int(11) NOT NULL,
  `note_account` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id_account`, `note_account`) VALUES
(1101, 'เงินสด'),
(11011, 'เงินสดย่อย');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id_bank` int(11) NOT NULL,
  `name_bank` text NOT NULL,
  `total` int(11) NOT NULL,
  `branch` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `id_customer` text NOT NULL,
  `type_customer` varchar(100) NOT NULL,
  `name_company` varchar(100) NOT NULL,
  `id_account` int(11) NOT NULL,
  `name_customer` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `place_delivery` varchar(100) NOT NULL,
  `id_user` text NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `sales_area` varchar(100) NOT NULL,
  `transpot` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL,
  `credit` int(11) NOT NULL,
  `debt_period` int(11) NOT NULL,
  `degree_product` int(11) NOT NULL,
  `deposit_discount` int(11) NOT NULL,
  `tax_number` int(11) NOT NULL,
  `bill_condition` varchar(100) NOT NULL,
  `check_condition` varchar(100) NOT NULL,
  `location` text NOT NULL,
  `branch` varchar(100) NOT NULL,
  `fax_number` varchar(100) NOT NULL,
  `debt_balance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `id_customer`, `type_customer`, `name_company`, `id_account`, `name_customer`, `address`, `place_delivery`, `id_user`, `telephone`, `sales_area`, `transpot`, `note`, `credit`, `debt_period`, `degree_product`, `deposit_discount`, `tax_number`, `bill_condition`, `check_condition`, `location`, `branch`, `fax_number`, `debt_balance`) VALUES
(4, '100-SW', '', '110111254645', 11011, 'xxxxx', 'xxxxx22222', 'asdcsae', '100', '099-199-4665', '', '', 'sadxzcwqesa', 1121, 120120, 12012012, 120120, 1201201, '', '', '', 'สำนักงานใหญ่', '02-9999-9', 1000),
(5, 'sad-1231', 'consumer', '110111254645', 1101, 'asdas', 'dsadsa', 'sadrsadr', '100', '099-199-4665', 'bankok', 'postoffice', 'sdarwerawe', 50, 50, 50, 50, 50, 'fist_mon', 'fist_mon', 'headquarters', 'สำนักงานใหญ่', '02-9999-99999', 0);

-- --------------------------------------------------------

--
-- Table structure for table `debtout`
--

CREATE TABLE `debtout` (
  `id` int(11) NOT NULL,
  `id_dept` varchar(100) NOT NULL,
  `id_customer` varchar(100) NOT NULL,
  `type_tax` varchar(100) NOT NULL,
  `tax_liability` varchar(100) NOT NULL,
  `date_dept` date NOT NULL,
  `deadline` date NOT NULL,
  `tax_filing` varchar(100) NOT NULL,
  `total_dept` float NOT NULL,
  `tax_value` float NOT NULL,
  `tax` float NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `debtout`
--

INSERT INTO `debtout` (`id`, `id_dept`, `id_customer`, `type_tax`, `tax_liability`, `date_dept`, `deadline`, `tax_filing`, `total_dept`, `tax_value`, `tax`, `total`) VALUES
(4, 'XR123', '100-SW', '', '', '2018-06-12', '2018-07-01', '6/2018', 1000, 80, 8, 1080);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `id_department` varchar(100) NOT NULL,
  `name_department` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `id_department`, `name_department`) VALUES
(1, 'ACC-01', 'แผนกบัญชี');

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `id` int(11) NOT NULL,
  `id_deposit` varchar(100) NOT NULL,
  `total_deposit` float NOT NULL,
  `date_deposit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id_document` int(11) NOT NULL,
  `no_document` text,
  `id_department` int(11) NOT NULL,
  `tax_liability` text,
  `type_text` text,
  `id_customer` text NOT NULL,
  `id_account` int(11) NOT NULL,
  `balance` int(20) NOT NULL,
  `id_job` int(11) NOT NULL,
  `id_deposit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `id` int(11) NOT NULL,
  `id_job` varchar(100) NOT NULL,
  `note_job` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `id_job`, `note_job`) VALUES
(1, 'AA-01', 'โครงการยอดนิยม');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movement`
--

CREATE TABLE `movement` (
  `id_move` int(10) NOT NULL COMMENT 'รหัส',
  `id_product` int(10) NOT NULL COMMENT 'รหัสสินค้า',
  `date` datetime NOT NULL COMMENT 'วันที่',
  `inproduct` varchar(10) NOT NULL COMMENT 'สินค้าเข้า',
  `outproduct` varchar(10) NOT NULL COMMENT 'สินค้าออก',
  `receive` varchar(10) NOT NULL COMMENT 'สินค้าค้างรับ',
  `send` varchar(10) NOT NULL COMMENT 'สินค้าค้างส่ง',
  `balance` varchar(10) NOT NULL COMMENT 'ยอดคงเหลือสินค้า'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_product` int(10) NOT NULL COMMENT 'รหัสสินค้า',
  `product` varchar(20) NOT NULL COMMENT 'สินค้า'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id_order` int(10) NOT NULL COMMENT 'รหัสซื้อสินค้า',
  `date` datetime NOT NULL COMMENT 'วันที่',
  `price` varchar(20) NOT NULL COMMENT 'ราคา',
  `id_supplier` int(10) NOT NULL COMMENT 'รหัสผู้จัดจำหน่าย',
  `id_user` int(10) NOT NULL COMMENT 'รหัสพนักงาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_detail`
--

CREATE TABLE `purchase_order_detail` (
  `id_orderdetail` int(10) NOT NULL COMMENT 'รหัสรายละอียดซื้อสินค้า',
  `detail` varchar(50) NOT NULL COMMENT 'รายละเอียด',
  `quantity` varchar(10) NOT NULL COMMENT 'จำนวน',
  `price` varchar(10) NOT NULL COMMENT 'ราคา',
  `amount` varchar(10) NOT NULL COMMENT 'จำนวนเงิน',
  `id_product` int(10) NOT NULL COMMENT 'รหัสสินค้า',
  `id_order` int(10) NOT NULL COMMENT 'รหัสซื้อสินค้า'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sell_order`
--

CREATE TABLE `sell_order` (
  `id_sell` int(10) NOT NULL COMMENT 'รหัส',
  `date` datetime NOT NULL COMMENT 'วันที่ขาย',
  `price` varchar(20) NOT NULL COMMENT 'ราคา',
  `date_sent` datetime NOT NULL COMMENT 'วันที่รับสินค้าคืน',
  `date_quatation` datetime NOT NULL COMMENT 'วันที่เสนอราคา',
  `id_customer` int(10) NOT NULL COMMENT 'รหัสลูกค้า',
  `id_user` int(10) NOT NULL COMMENT 'รหัสพนักงาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sell_order_detail`
--

CREATE TABLE `sell_order_detail` (
  `id_selldetail` int(10) NOT NULL COMMENT 'รหัส',
  `id_product` int(10) NOT NULL COMMENT 'รหัสสินค้า',
  `quantity` varchar(20) NOT NULL COMMENT 'จำนวน',
  `price` varchar(20) NOT NULL COMMENT 'ราคา',
  `amount` varchar(20) NOT NULL COMMENT 'จำนวนเงิน',
  `id_sell` int(10) NOT NULL COMMENT 'รหัสขายสินค้า'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settle`
--

CREATE TABLE `settle` (
  `id` int(11) NOT NULL,
  `id_settle` varchar(100) NOT NULL,
  `id_customer` varchar(100) NOT NULL,
  `type_tax` varchar(100) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `id_department` varchar(100) NOT NULL,
  `sale_area` varchar(100) NOT NULL,
  `tax_liability` varchar(100) NOT NULL,
  `date_settle` date NOT NULL,
  `debt_period` int(11) NOT NULL,
  `deadline_settle` date NOT NULL,
  `id_job` int(11) NOT NULL,
  `ref_number` varchar(100) NOT NULL,
  `tax_filing` varchar(100) NOT NULL,
  `id_account` int(11) NOT NULL,
  `total_settle` float NOT NULL,
  `id_deposit` varchar(100) DEFAULT NULL,
  `discount` text,
  `total_deposit` float DEFAULT NULL,
  `tax` float NOT NULL,
  `tax_value` float NOT NULL,
  `cash_receipt` float DEFAULT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(10) NOT NULL COMMENT 'รหัสผู้จัดจำหน่าย ',
  `name_supplier` varchar(20) NOT NULL COMMENT 'ชื่อ',
  `address` varchar(30) NOT NULL COMMENT 'ที่อยู่',
  `email` varchar(20) NOT NULL COMMENT 'อีเมล',
  `telephone` varchar(10) NOT NULL COMMENT 'เบอร์โทร'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_quotation`
--

CREATE TABLE `tb_quotation` (
  `quotation_id` varchar(20) NOT NULL COMMENT 'เลขที่ใบเสนอราคา',
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่เวลา',
  `customer_id` varchar(20) NOT NULL COMMENT 'รหัสลูกค้า',
  `debt_duration` int(11) NOT NULL COMMENT 'ระยะเวลาหนี้ (วัน)',
  `billing_duration` int(11) NOT NULL COMMENT 'กำหนดยื่นราคา (วัน)',
  `payment_condition` varchar(255) NOT NULL COMMENT 'เงื่อนไขการชำระเงิน',
  `transportation` varchar(255) NOT NULL COMMENT 'ขนส่งโดย',
  `tax_type` varchar(255) NOT NULL COMMENT 'ชนิดภาษี',
  `delivery_time` int(11) NOT NULL COMMENT 'ระยะเวลาในกาส่งของ (วัน)',
  `department_id` varchar(20) DEFAULT NULL COMMENT 'รหัสแผนก',
  `status` varchar(255) NOT NULL COMMENT 'สถานะ',
  `user_id` varchar(20) NOT NULL COMMENT 'รหัสพนักงานขาย',
  `zone` varchar(100) NOT NULL COMMENT 'เขตการขาย',
  `remark` varchar(255) NOT NULL COMMENT 'หมายเหตุ',
  `total` float NOT NULL COMMENT 'ยอดรวม',
  `tax_rate` float NOT NULL COMMENT 'อัตราภาษี %',
  `tax` float NOT NULL COMMENT 'มูลค่าภาษี (บาท)',
  `total_tax` float NOT NULL COMMENT 'ยอดสุทธิ (บาท)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_quotation`
--

INSERT INTO `tb_quotation` (`quotation_id`, `datetime`, `customer_id`, `debt_duration`, `billing_duration`, `payment_condition`, `transportation`, `tax_type`, `delivery_time`, `department_id`, `status`, `user_id`, `zone`, `remark`, `total`, `tax_rate`, `tax`, `total_tax`) VALUES
('QT4801-00001', '2018-09-13 00:00:00', 'CUS-01', 7, 15, '', 'รถบริษัท', 'ราคาสินค้าแยกภาษี', 0, 'DPT-01', 'นัดวันส่งสินค้า', '4', 'เขตกรุงเทพฯ', '', 0, 0, 0, 0),
('QT4801-00002', '2018-09-13 00:00:00', 'CUS-01', 7, 15, '', 'รถบริษัท', 'ราคาสินค้าแยกภาษี', 0, 'DPT-01', 'นัดวันส่งสินค้า', '4', 'เขตกรุงเทพฯ', '', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_quotation_detail`
--

CREATE TABLE `tb_quotation_detail` (
  `_id` int(11) NOT NULL COMMENT '_id',
  `product_id` varchar(20) NOT NULL COMMENT 'รหัสสินค้า',
  `product_detail` varchar(255) NOT NULL COMMENT 'รายละเอียดสินค้า',
  `amount` int(11) NOT NULL COMMENT 'จำนวน',
  `unit` varchar(20) NOT NULL COMMENT 'หน่วย',
  `normal_price` float NOT NULL COMMENT 'ราคาตั้ง (บาท)',
  `discount_percent` float NOT NULL COMMENT 'ส่วนลด %',
  `discount_price` float NOT NULL COMMENT 'ราคาขาย (บาท)',
  `value` float NOT NULL COMMENT 'มูลค่า (บาท)',
  `quotation_id` int(11) NOT NULL COMMENT 'เลขที่ใบเสนอราคา'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_tax_type`
--

CREATE TABLE `tb_tax_type` (
  `tax_type_id` int(11) NOT NULL,
  `tax_type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_tax_type`
--

INSERT INTO `tb_tax_type` (`tax_type_id`, `tax_type_name`) VALUES
(1, 'ราคาสินค้ารวมภาษี'),
(2, 'ราคาสินค้าแยกภาษี'),
(3, 'อัตราภาษี 0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL COMMENT 'รหัสพนักงาน',
  `name` varchar(20) NOT NULL COMMENT 'ชื่อ',
  `telephone` varchar(10) NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `email` varchar(20) NOT NULL COMMENT 'อีเมล',
  `user` varchar(20) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `password` varchar(20) NOT NULL COMMENT 'รหัสผ่าน',
  `id_department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `name`, `telephone`, `email`, `user`, `password`, `id_department`) VALUES
(100, 'somchai', '099-999-99', 'Email@email.com', 'somchai', '123456789', 1002);

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
(3, 'Finance A', 'finance@gmail.com', '$2y$10$S1KPrKKxibtqE6ZckghdDeSz10yjeBXCyvOANc0meZa/Z67F3GKLu', 'K0SPXlqn9pvoY4UNQlKPMJGIrlp1r66YZXU3TnkUmGRuNQQd4k9rC1G1Uhgd', '2018-07-04 08:44:44', '2018-07-04 08:44:44', 'finance'),
(4, 'Sales A', 'sales@gmail.com', '$2y$10$WyMRYhZF/yZBhhTNmg5GV.YsJ0XiVxh5spZm1UbeUOkhOWAj4Fpi2', 'JPyKSYdGGsA1gp8gaG569i7W9n65oWx10QER5NDUtc1YiaFkQYC37Zxkg1zf', '2018-07-04 08:45:16', '2018-07-04 08:45:16', 'sales');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id_account`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debtout`
--
ALTER TABLE `debtout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id_document`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movement`
--
ALTER TABLE `movement`
  ADD PRIMARY KEY (`id_move`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `purchase_order_detail`
--
ALTER TABLE `purchase_order_detail`
  ADD PRIMARY KEY (`id_orderdetail`);

--
-- Indexes for table `sell_order`
--
ALTER TABLE `sell_order`
  ADD PRIMARY KEY (`id_sell`);

--
-- Indexes for table `sell_order_detail`
--
ALTER TABLE `sell_order_detail`
  ADD PRIMARY KEY (`id_selldetail`);

--
-- Indexes for table `settle`
--
ALTER TABLE `settle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `tb_quotation`
--
ALTER TABLE `tb_quotation`
  ADD PRIMARY KEY (`quotation_id`);

--
-- Indexes for table `tb_quotation_detail`
--
ALTER TABLE `tb_quotation_detail`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `tb_tax_type`
--
ALTER TABLE `tb_tax_type`
  ADD PRIMARY KEY (`tax_type_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `debtout`
--
ALTER TABLE `debtout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movement`
--
ALTER TABLE `movement`
  MODIFY `id_move` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัส';

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสสินค้า';

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id_order` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสซื้อสินค้า';

--
-- AUTO_INCREMENT for table `purchase_order_detail`
--
ALTER TABLE `purchase_order_detail`
  MODIFY `id_orderdetail` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสรายละอียดซื้อสินค้า';

--
-- AUTO_INCREMENT for table `sell_order`
--
ALTER TABLE `sell_order`
  MODIFY `id_sell` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัส';

--
-- AUTO_INCREMENT for table `sell_order_detail`
--
ALTER TABLE `sell_order_detail`
  MODIFY `id_selldetail` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัส';

--
-- AUTO_INCREMENT for table `settle`
--
ALTER TABLE `settle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_quotation_detail`
--
ALTER TABLE `tb_quotation_detail`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '_id';

--
-- AUTO_INCREMENT for table `tb_tax_type`
--
ALTER TABLE `tb_tax_type`
  MODIFY `tax_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสพนักงาน', AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
