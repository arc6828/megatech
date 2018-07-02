-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2018 at 08:07 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสพนักงาน', AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
