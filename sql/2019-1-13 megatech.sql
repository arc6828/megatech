-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2019 at 06:44 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.1.22

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

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_code` varchar(100) NOT NULL,
  `department_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_code`, `department_name`) VALUES
(1, 'ACC-01', 'แผนกบัญชี'),
(2, 'DPT-01', 'แผนกขายในกรุงเทพ'),
(3, 'PUR-01', 'แผนกจัดซื้อ'),
(4, 'STC-01', 'แผนกสต๊อก');

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
-- Table structure for table `tb_account`
--

CREATE TABLE `tb_account` (
  `account_id` int(11) NOT NULL COMMENT 'id',
  `account_note` varchar(100) NOT NULL COMMENT 'ผังบัญชี'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_account`
--

INSERT INTO `tb_account` (`account_id`, `account_note`) VALUES
(1101, 'เงินสด'),
(11011, 'เงินสดย่อย');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bank`
--

CREATE TABLE `tb_bank` (
  `bank_id` int(11) NOT NULL COMMENT 'id',
  `bank_code` varchar(10) NOT NULL COMMENT 'รหัสธนาคาร',
  `bank_name` varchar(100) NOT NULL COMMENT 'รายละเอียด',
  `bank_branch` varchar(100) NOT NULL COMMENT 'สาขา',
  `account_id` int(11) DEFAULT NULL COMMENT 'รหัสผังบัญชี',
  `book_bank_serial` varchar(100) DEFAULT NULL COMMENT 'เลขที่บัญชีธนาคาร',
  `bring_forward` int(11) DEFAULT '0' COMMENT 'ยอดยกมา'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_bank_detail`
--

CREATE TABLE `tb_bank_detail` (
  `bank_detail_id` int(11) NOT NULL COMMENT 'id',
  `bank_id` int(11) NOT NULL COMMENT 'bank_id',
  `m_date` date NOT NULL COMMENT 'เดือนที่',
  `bring_forword` float NOT NULL COMMENT 'ยอดยกมา',
  `income` float NOT NULL DEFAULT '0' COMMENT 'ยอดเงินรับ',
  `outcome` float NOT NULL DEFAULT '0' COMMENT 'ยอดเงินจ่าย',
  `balance` float NOT NULL DEFAULT '0' COMMENT 'ยอดปลายงวด'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_billing_note`
--

CREATE TABLE `tb_billing_note` (
  `billing_note_id` int(11) NOT NULL,
  `billing_note_code` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `billing_condition` text NOT NULL,
  `payment_condition` text CHARACTER SET utf16 NOT NULL,
  `billing_date` date NOT NULL,
  `cheque_date` date NOT NULL,
  `remark` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_billing_receipt`
--

CREATE TABLE `tb_billing_receipt` (
  `billing_receipt_id` int(11) NOT NULL COMMENT 'id',
  `billing_receipt_code` varchar(20) NOT NULL COMMENT 'เลขที่รับชำระหนี้',
  `date` date NOT NULL COMMENT 'วันที่รับชำระหนี้',
  `department_id` int(11) NOT NULL COMMENT 'รหัสแผนก',
  `remark` varchar(255) NOT NULL COMMENT 'หมายเหตุ',
  `tax_period` varchar(20) NOT NULL COMMENT 'ยื่นภาษีในงวด',
  `billing_note_id` int(11) NOT NULL COMMENT 'Id ใบวางบิล',
  `customer_id` int(11) NOT NULL COMMENT 'รหัสลูกค้า',
  `cash_amount` float NOT NULL COMMENT 'ยอดรับเงินสด',
  `cheque_amount` float NOT NULL COMMENT 'ยอดรับเช็ค',
  `tax` float NOT NULL COMMENT 'ภาษี ณ ที่จ่าย'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cheque`
--

CREATE TABLE `tb_cheque` (
  `cheque_id` int(11) NOT NULL COMMENT 'id',
  `cheque_code` varchar(20) NOT NULL COMMENT 'เลขที่เช็ค',
  `cheque_date` date NOT NULL COMMENT 'วันที่เช็ค',
  `bank_id` int(11) NOT NULL COMMENT 'รายละเอียดสาขาธนาคาร',
  `amount` float NOT NULL COMMENT 'ยอดเช็ครับ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_contact`
--

CREATE TABLE `tb_contact` (
  `contact_id` int(11) NOT NULL,
  `contact_name` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `customer_id` int(11) NOT NULL COMMENT 'id',
  `customer_code` varchar(100) NOT NULL,
  `customer_type` varchar(100) NOT NULL COMMENT 'ประเภทลูกหนี้',
  `company_name` varchar(100) NOT NULL COMMENT 'ชื่อบริษัท',
  `account_id` int(11) DEFAULT NULL COMMENT 'รหัสผังบัญชี',
  `contact_name` varchar(100) NOT NULL COMMENT 'ชื่อผู้ติดต่อ',
  `customer_name` int(11) DEFAULT '555',
  `address` varchar(100) DEFAULT NULL COMMENT 'ที่อยู่',
  `sub_district` varchar(100) DEFAULT NULL COMMENT 'ตำบล',
  `district` varchar(100) DEFAULT NULL COMMENT 'อำเภอ',
  `province` varchar(100) DEFAULT NULL COMMENT 'จังหวัด',
  `zipcode` varchar(100) DEFAULT NULL COMMENT 'รหัสไปรษณีย์',
  `delivery_address` varchar(100) DEFAULT NULL COMMENT 'ที่อยู่ส่งของ',
  `delivery_sub_district` varchar(100) DEFAULT NULL COMMENT 'ตำบล (ส่งของ)',
  `delivery_district` varchar(100) DEFAULT NULL COMMENT 'อำเภอ (ส่งของ)',
  `delivery_province` varchar(100) NOT NULL COMMENT 'จังหวัด (ส่งของ)',
  `delivery_zipcode` varchar(100) NOT NULL COMMENT 'รหัสไปรษณีย์ (ส่งของ)',
  `user_id` int(11) NOT NULL COMMENT 'รหัสพนักงานขาย',
  `telephone` varchar(100) NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `fax` varchar(100) DEFAULT NULL COMMENT 'เบอร์แฟ็กซ์',
  `email` varchar(100) DEFAULT NULL COMMENT 'อีเมล์',
  `zone_id` int(11) NOT NULL COMMENT 'เขตการขาย',
  `transpotation_id` int(11) NOT NULL COMMENT 'ขนส่งโดย',
  `remark` varchar(255) DEFAULT NULL COMMENT 'หมายเหตุ',
  `max_credit` float DEFAULT NULL COMMENT 'วงเงินเครดิต',
  `debt_duration` int(11) DEFAULT NULL COMMENT 'ระยะเวลาหนี้ (วัน)',
  `degree_product` int(11) DEFAULT NULL COMMENT 'ระดับของราคาสินค้า',
  `loyalty_discount` float DEFAULT NULL COMMENT 'ส่วนลดประจำ',
  `tax_number` varchar(13) DEFAULT NULL COMMENT 'เลขที่ภาษี',
  `billing_condition` varchar(255) DEFAULT NULL COMMENT 'เงื่อนไขวางบิล',
  `cheqe_condition` varchar(255) DEFAULT NULL COMMENT 'เงื่อนไขรับเช็ค',
  `location_type_id` int(11) DEFAULT '0' COMMENT 'ชนิดสถานประกอบการ',
  `branch_id` int(11) DEFAULT '0' COMMENT 'สำนักงาน/สาขา',
  `debt_balance` float DEFAULT '0' COMMENT 'ยอดหนี้ขณะนี้'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`customer_id`, `customer_code`, `customer_type`, `company_name`, `account_id`, `contact_name`, `customer_name`, `address`, `sub_district`, `district`, `province`, `zipcode`, `delivery_address`, `delivery_sub_district`, `delivery_district`, `delivery_province`, `delivery_zipcode`, `user_id`, `telephone`, `fax`, `email`, `zone_id`, `transpotation_id`, `remark`, `max_credit`, `debt_duration`, `degree_product`, `loyalty_discount`, `tax_number`, `billing_condition`, `cheqe_condition`, `location_type_id`, `branch_id`, `debt_balance`) VALUES
(4, 'sadsaeqwe', '', 'Company A', 11011, 'Name A', 555, 'xxxxx22222', '', '', '', '', 'asdcsae', '', '', '', '', 100, '099-199-4665', '02-9999-9', NULL, 0, 0, 'sadxzcwqesa', 1121, 120120, 12012012, 120120, '1201201', '', '', 0, 0, 1000),
(5, 'axx', 'consumer', 'Company B', 1101, 'Name B', 555, 'dsadsa', '', '', '', '', 'sadrsadr', '', '', '', '', 100, '099-199-4665', '02-9999-99999', NULL, 0, 0, 'sdarwerawe', 50, 50, 50, 50, '50', 'fist_mon', 'fist_mon', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer_type`
--

CREATE TABLE `tb_customer_type` (
  `customer_type_id` int(11) NOT NULL,
  `customer_type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_customer_type`
--

INSERT INTO `tb_customer_type` (`customer_type_id`, `customer_type_name`) VALUES
(1, 'Consumer'),
(2, 'Industries'),
(3, 'ภาคเหนือ'),
(4, 'ตะวันออกเฉียงเหนือ'),
(5, 'ภาคใต้');

-- --------------------------------------------------------

--
-- Table structure for table `tb_debtout`
--

CREATE TABLE `tb_debtout` (
  `debt_id` int(11) NOT NULL,
  `debt_code` text NOT NULL,
  `customer_id` int(11) NOT NULL,
  `tax_type_id` int(11) NOT NULL,
  `tax_liability` varchar(100) NOT NULL,
  `date_debt` date NOT NULL,
  `deadline` date NOT NULL,
  `tax_filing` varchar(100) NOT NULL,
  `tax` float NOT NULL,
  `net_amount` int(11) NOT NULL,
  `total_debt` float NOT NULL,
  `tax_value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_debtout`
--

INSERT INTO `tb_debtout` (`debt_id`, `debt_code`, `customer_id`, `tax_type_id`, `tax_liability`, `date_debt`, `deadline`, `tax_filing`, `tax`, `net_amount`, `total_debt`, `tax_value`) VALUES
(1, 'XR5080', 4, 1, 'right', '2019-01-12', '2019-01-24', '1/2562', 7, 535, 500, 35);

-- --------------------------------------------------------

--
-- Table structure for table `tb_delivery_type`
--

CREATE TABLE `tb_delivery_type` (
  `delivery_type_id` int(11) NOT NULL,
  `delivery_type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_delivery_type`
--

INSERT INTO `tb_delivery_type` (`delivery_type_id`, `delivery_type_name`) VALUES
(1, 'ไปรษณีย์'),
(2, 'รถบริษัท');

-- --------------------------------------------------------

--
-- Table structure for table `tb_department`
--

CREATE TABLE `tb_department` (
  `department_id` int(11) NOT NULL,
  `department_code` varchar(10) NOT NULL,
  `department_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_department`
--

INSERT INTO `tb_department` (`department_id`, `department_code`, `department_name`) VALUES
(1, 'ACC-01', 'แผนก A'),
(2, 'ACC-02', 'แผนก B'),
(1, 'ACC-01', 'แผนก A'),
(2, 'ACC-02', 'แผนก B');

-- --------------------------------------------------------

--
-- Table structure for table `tb_inventory`
--

CREATE TABLE `tb_inventory` (
  `inventory_id` int(11) NOT NULL,
  `inventory_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_invoice`
--

CREATE TABLE `tb_invoice` (
  `invoice_id` int(11) NOT NULL COMMENT 'id',
  `invoice_code` varchar(20) DEFAULT NULL COMMENT 'เลขที่ใบเสนอราคา',
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
-- Dumping data for table `tb_invoice`
--

INSERT INTO `tb_invoice` (`invoice_id`, `invoice_code`, `datetime`, `customer_id`, `debt_duration`, `billing_duration`, `payment_condition`, `delivery_type_id`, `tax_type_id`, `delivery_time`, `department_id`, `sales_status_id`, `user_id`, `zone_id`, `remark`, `vat_percent`) VALUES
(1, 'IV4801-00001', '2018-09-13 00:00:00', 4, 7, 15, '', 1, 2, 0, 0, 3, 4, 1, '', 0),
(2, 'IV4801-00002', '2018-09-13 00:00:00', 4, 7, 15, '', 1, 2, 0, 0, 3, 4, 1, '', 0),
(3, 'IV1810-00001', '2018-10-02 17:16:49', 4, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 1, NULL, 0),
(4, 'IV1810-00002', '2018-10-02 17:19:09', 4, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 1, NULL, 0),
(5, 'IV1810-00003', '2018-10-02 17:19:32', 4, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 1, NULL, 0),
(6, 'IV1810-00004', '2018-10-03 10:38:17', 4, 1, 1, '1', 1, 2, 1, NULL, 2, 4, 1, '1', 0),
(7, 'IV6110-00005', '2018-10-03 10:42:25', 4, 1, 1, '1', 1, 2, 1, NULL, 2, 4, 2, '1', 0),
(8, 'IV6110-00006', '2018-10-03 10:44:44', 4, 1, 1, '1', 1, 2, 1, NULL, 2, 4, 2, '1', 0),
(9, 'IV6110-00007', '2018-10-05 16:55:19', 5, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 2, '1', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tb_invoice_detail`
--

CREATE TABLE `tb_invoice_detail` (
  `invoice_detail_id` int(11) NOT NULL COMMENT '_id',
  `product_id` int(11) NOT NULL COMMENT 'รหัสสินค้า',
  `amount` int(11) NOT NULL DEFAULT '1' COMMENT 'จำนวน',
  `discount_price` float DEFAULT NULL COMMENT 'ราคาขาย (บาท)',
  `invoice_id` int(11) NOT NULL COMMENT 'เลขที่ใบเสนอราคา'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_invoice_detail`
--

INSERT INTO `tb_invoice_detail` (`invoice_detail_id`, `product_id`, `amount`, `discount_price`, `invoice_id`) VALUES
(5, 1, 1, 0, 1),
(6, 1, 1, 100, 1),
(7, 1, 1, 100, 1),
(8, 1, 10, 90, 1),
(9, 1, 1, 100, 1),
(10, 1, 1, 80, 9),
(11, 3, 1, 100, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tb_location_type`
--

CREATE TABLE `tb_location_type` (
  `location_type_id` int(11) NOT NULL,
  `location_type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_location_type`
--

INSERT INTO `tb_location_type` (`location_type_id`, `location_type_name`) VALUES
(1, '01-สำนักงานใหญ่'),
(2, '02-สาขา');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `order_id` int(11) NOT NULL COMMENT 'id',
  `order_code` varchar(20) DEFAULT NULL COMMENT 'เลขที่ใบเสนอราคา',
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
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`order_id`, `order_code`, `datetime`, `customer_id`, `debt_duration`, `billing_duration`, `payment_condition`, `delivery_type_id`, `tax_type_id`, `delivery_time`, `department_id`, `sales_status_id`, `user_id`, `zone_id`, `remark`, `vat_percent`) VALUES
(1, 'OE4801-00001', '2018-09-13 00:00:00', 4, 7, 15, '', 1, 2, 0, 0, 3, 4, 1, '', 0),
(2, 'OE4801-00002', '2018-09-13 00:00:00', 4, 7, 15, '', 1, 2, 0, 0, 3, 4, 1, '', 0),
(3, 'OE1810-00001', '2018-10-02 17:16:49', 4, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 1, NULL, 0),
(4, 'OE1810-00002', '2018-10-02 17:19:09', 4, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 1, NULL, 0),
(5, 'OE1810-00003', '2018-10-02 17:19:32', 4, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 1, NULL, 0),
(6, 'OE1810-00004', '2018-10-03 10:38:17', 4, 1, 1, '1', 1, 2, 1, NULL, 2, 4, 1, '1', 0),
(7, 'OE6110-00005', '2018-10-03 10:42:25', 4, 1, 1, '1', 1, 2, 1, NULL, 2, 4, 2, '1', 0),
(8, 'OE6110-00006', '2018-10-03 10:44:44', 4, 1, 1, '1', 1, 2, 1, NULL, 2, 4, 2, '1', 0),
(9, 'OE6110-00007', '2018-10-05 16:55:19', 5, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 2, '1', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order_detail`
--

CREATE TABLE `tb_order_detail` (
  `order_detail_id` int(11) NOT NULL COMMENT '_id',
  `product_id` int(11) NOT NULL COMMENT 'รหัสสินค้า',
  `amount` int(11) NOT NULL DEFAULT '1' COMMENT 'จำนวน',
  `discount_price` float DEFAULT NULL COMMENT 'ราคาขาย (บาท)',
  `order_id` int(11) NOT NULL COMMENT 'เลขที่ใบเสนอราคา'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_order_detail`
--

INSERT INTO `tb_order_detail` (`order_detail_id`, `product_id`, `amount`, `discount_price`, `order_id`) VALUES
(5, 1, 1, 0, 1),
(6, 1, 1, 100, 1),
(7, 1, 1, 100, 1),
(8, 1, 10, 90, 1),
(9, 1, 1, 100, 1),
(10, 1, 1, 80, 9),
(11, 3, 1, 100, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order_detail_status`
--

CREATE TABLE `tb_order_detail_status` (
  `order_detail_status_id` int(11) NOT NULL,
  `order_detail_status_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_order_detail_status`
--

INSERT INTO `tb_order_detail_status` (`order_detail_status_id`, `order_detail_status_name`) VALUES
(1, 'อนุมัติ'),
(2, 'ไม่อนุมัติ'),
(3, 'รออนุมัติ'),
(4, 'ออก IV แล้ว'),
(5, '...'),
(1, 'อนุมัติ'),
(2, 'ไม่อนุมัติ'),
(3, 'รออนุมัติ'),
(4, 'ออก IV แล้ว'),
(5, '...');

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

-- --------------------------------------------------------

--
-- Table structure for table `tb_purchase_order`
--

CREATE TABLE `tb_purchase_order` (
  `purchase_order_id` int(11) NOT NULL COMMENT 'id',
  `purchase_order_code` varchar(20) DEFAULT NULL COMMENT 'เลขที่เอกสาร',
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่เวลา',
  `customer_id` int(11) NOT NULL COMMENT 'รหัสลูกค้า',
  `debt_duration` int(11) NOT NULL COMMENT 'ระยะเวลาหนี้ (วัน)',
  `billing_duration` int(11) NOT NULL COMMENT 'กำหนดยื่นราคา (วัน)',
  `payment_condition` varchar(255) DEFAULT NULL COMMENT 'เงื่อนไขการชำระเงิน',
  `delivery_type_id` int(11) NOT NULL COMMENT 'ขนส่งโดย',
  `tax_type_id` int(11) NOT NULL COMMENT 'ชนิดภาษี',
  `delivery_time` int(11) NOT NULL COMMENT 'ระยะเวลาในกาส่งของ (วัน)',
  `department_id` int(11) DEFAULT NULL COMMENT 'รหัสแผนก',
  `purchase_status_id` int(11) NOT NULL COMMENT 'สถานะ',
  `user_id` int(11) NOT NULL COMMENT 'รหัสพนักงานขาย',
  `zone_id` int(11) NOT NULL COMMENT 'เขตการขาย',
  `remark` varchar(255) DEFAULT NULL COMMENT 'หมายเหตุ',
  `vat_percent` float DEFAULT '7' COMMENT 'อัตราภาษี %',
  `internal_reference_doc` varchar(100) DEFAULT NULL,
  `external_reference_doc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_purchase_order`
--

INSERT INTO `tb_purchase_order` (`purchase_order_id`, `purchase_order_code`, `datetime`, `customer_id`, `debt_duration`, `billing_duration`, `payment_condition`, `delivery_type_id`, `tax_type_id`, `delivery_time`, `department_id`, `purchase_status_id`, `user_id`, `zone_id`, `remark`, `vat_percent`, `internal_reference_doc`, `external_reference_doc`) VALUES
(1, 'PO4801-00001', '2018-09-13 00:00:00', 4, 7, 15, NULL, 1, 2, 60, 0, 3, 4, 1, NULL, 7, NULL, NULL),
(2, 'PO4801-00002', '2018-09-13 00:00:00', 4, 7, 15, '', 1, 2, 0, 0, 3, 4, 1, '', 0, NULL, NULL),
(3, 'PO1810-00001', '2018-10-02 17:16:49', 4, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 1, NULL, 0, NULL, NULL),
(4, 'PO1810-00002', '2018-10-02 17:19:09', 4, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 1, NULL, 0, NULL, NULL),
(5, 'PO1810-00003', '2018-10-02 17:19:32', 4, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 1, NULL, 0, NULL, NULL),
(6, 'PO1810-00004', '2018-10-03 10:38:17', 4, 1, 1, '1', 1, 2, 1, NULL, 2, 4, 1, '1', 0, NULL, NULL),
(7, 'PO6110-00005', '2018-10-03 10:42:25', 4, 1, 1, '1', 1, 2, 1, NULL, 2, 4, 2, '1', 0, NULL, NULL),
(8, 'PO6110-00006', '2018-10-03 10:44:44', 4, 1, 1, '1', 1, 2, 1, NULL, 2, 4, 2, '1', 0, NULL, NULL),
(9, 'PO6110-00007', '2018-10-05 16:55:19', 5, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 2, '1', 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_purchase_order_detail`
--

CREATE TABLE `tb_purchase_order_detail` (
  `purchase_order_detail_id` int(11) NOT NULL COMMENT '_id',
  `product_id` int(11) NOT NULL COMMENT 'รหัสสินค้า',
  `amount` int(11) NOT NULL DEFAULT '1' COMMENT 'จำนวน',
  `discount_price` float DEFAULT NULL COMMENT 'ราคาขาย (บาท)',
  `purchase_order_id` int(11) NOT NULL COMMENT 'เลขที่ใบเสนอราคา',
  `purchase_order_detail_remark` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_purchase_order_detail`
--

INSERT INTO `tb_purchase_order_detail` (`purchase_order_detail_id`, `product_id`, `amount`, `discount_price`, `purchase_order_id`, `purchase_order_detail_remark`) VALUES
(5, 1, 10, 60, 1, NULL),
(6, 1, 1, 100, 1, NULL),
(7, 1, 1, 100, 1, NULL),
(8, 1, 10, 90, 1, NULL),
(10, 1, 1, 80, 9, NULL),
(11, 3, 1, 100, 9, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_purchase_receive`
--

CREATE TABLE `tb_purchase_receive` (
  `purchase_receive_id` int(11) NOT NULL COMMENT 'id',
  `purchase_receive_code` varchar(20) DEFAULT NULL COMMENT 'เลขที่เอกสาร',
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่เวลา',
  `customer_id` int(11) NOT NULL COMMENT 'รหัสลูกค้า',
  `debt_duration` int(11) NOT NULL COMMENT 'ระยะเวลาหนี้ (วัน)',
  `billing_duration` int(11) NOT NULL COMMENT 'กำหนดยื่นราคา (วัน)',
  `payment_condition` varchar(255) DEFAULT NULL COMMENT 'เงื่อนไขการชำระเงิน',
  `delivery_type_id` int(11) NOT NULL COMMENT 'ขนส่งโดย',
  `tax_type_id` int(11) NOT NULL COMMENT 'ชนิดภาษี',
  `delivery_time` int(11) NOT NULL COMMENT 'ระยะเวลาในกาส่งของ (วัน)',
  `department_id` int(11) DEFAULT NULL COMMENT 'รหัสแผนก',
  `purchase_status_id` int(11) NOT NULL COMMENT 'สถานะ',
  `user_id` int(11) NOT NULL COMMENT 'รหัสพนักงานขาย',
  `zone_id` int(11) NOT NULL COMMENT 'เขตการขาย',
  `remark` varchar(255) DEFAULT NULL COMMENT 'หมายเหตุ',
  `vat_percent` float DEFAULT '7' COMMENT 'อัตราภาษี %',
  `internal_reference_doc` varchar(100) DEFAULT NULL,
  `external_reference_doc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_purchase_receive`
--

INSERT INTO `tb_purchase_receive` (`purchase_receive_id`, `purchase_receive_code`, `datetime`, `customer_id`, `debt_duration`, `billing_duration`, `payment_condition`, `delivery_type_id`, `tax_type_id`, `delivery_time`, `department_id`, `purchase_status_id`, `user_id`, `zone_id`, `remark`, `vat_percent`, `internal_reference_doc`, `external_reference_doc`) VALUES
(1, 'RC4801-00001', '2018-09-13 00:00:00', 4, 7, 15, NULL, 1, 2, 60, 0, 3, 4, 1, NULL, 7, NULL, NULL),
(2, 'RC4801-00002', '2018-09-13 00:00:00', 4, 7, 15, '', 1, 2, 0, 0, 3, 4, 1, '', 0, NULL, NULL),
(3, 'RC1810-00001', '2018-10-02 17:16:49', 4, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 1, NULL, 0, NULL, NULL),
(4, 'RC1810-00002', '2018-10-02 17:19:09', 4, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 1, NULL, 0, NULL, NULL),
(5, 'RC1810-00003', '2018-10-02 17:19:32', 4, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 1, NULL, 0, NULL, NULL),
(6, 'RC1810-00004', '2018-10-03 10:38:17', 4, 1, 1, '1', 1, 2, 1, NULL, 2, 4, 1, '1', 0, NULL, NULL),
(7, 'RC6110-00005', '2018-10-03 10:42:25', 4, 1, 1, '1', 1, 2, 1, NULL, 2, 4, 2, '1', 0, NULL, NULL),
(8, 'RC6110-00006', '2018-10-03 10:44:44', 4, 1, 1, '1', 1, 2, 1, NULL, 2, 4, 2, '1', 0, NULL, NULL),
(9, 'RC6110-00007', '2018-10-05 16:55:19', 5, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 2, '1', 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_purchase_receive_detail`
--

CREATE TABLE `tb_purchase_receive_detail` (
  `purchase_receive_detail_id` int(11) NOT NULL COMMENT '_id',
  `product_id` int(11) NOT NULL COMMENT 'รหัสสินค้า',
  `amount` int(11) NOT NULL DEFAULT '1' COMMENT 'จำนวน',
  `discount_price` float DEFAULT NULL COMMENT 'ราคาขาย (บาท)',
  `purchase_receive_id` int(11) NOT NULL COMMENT 'เลขที่ใบเสนอราคา',
  `purchase_receive_detail_remark` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_purchase_receive_detail`
--

INSERT INTO `tb_purchase_receive_detail` (`purchase_receive_detail_id`, `product_id`, `amount`, `discount_price`, `purchase_receive_id`, `purchase_receive_detail_remark`) VALUES
(5, 1, 10, 60, 1, NULL),
(6, 1, 1, 100, 1, NULL),
(7, 1, 1, 100, 1, NULL),
(8, 1, 10, 90, 1, NULL),
(10, 1, 1, 80, 9, NULL),
(11, 3, 1, 100, 9, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_purchase_requisition`
--

CREATE TABLE `tb_purchase_requisition` (
  `purchase_requisition_id` int(11) NOT NULL COMMENT 'id',
  `purchase_requisition_code` varchar(20) DEFAULT NULL COMMENT 'เลขที่เอกสาร',
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่เวลา',
  `customer_id` int(11) NOT NULL COMMENT 'รหัสลูกค้า',
  `debt_duration` int(11) NOT NULL COMMENT 'ระยะเวลาหนี้ (วัน)',
  `billing_duration` int(11) NOT NULL COMMENT 'กำหนดยื่นราคา (วัน)',
  `payment_condition` varchar(255) DEFAULT NULL COMMENT 'เงื่อนไขการชำระเงิน',
  `delivery_type_id` int(11) NOT NULL COMMENT 'ขนส่งโดย',
  `tax_type_id` int(11) NOT NULL COMMENT 'ชนิดภาษี',
  `delivery_time` int(11) NOT NULL COMMENT 'ระยะเวลาในกาส่งของ (วัน)',
  `department_id` int(11) DEFAULT NULL COMMENT 'รหัสแผนก',
  `purchase_status_id` int(11) NOT NULL COMMENT 'สถานะ',
  `user_id` int(11) NOT NULL COMMENT 'รหัสพนักงานขาย',
  `zone_id` int(11) NOT NULL COMMENT 'เขตการขาย',
  `remark` varchar(255) DEFAULT NULL COMMENT 'หมายเหตุ',
  `vat_percent` float DEFAULT '7' COMMENT 'อัตราภาษี %',
  `internal_reference_doc` varchar(100) DEFAULT NULL,
  `external_reference_doc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_purchase_requisition`
--

INSERT INTO `tb_purchase_requisition` (`purchase_requisition_id`, `purchase_requisition_code`, `datetime`, `customer_id`, `debt_duration`, `billing_duration`, `payment_condition`, `delivery_type_id`, `tax_type_id`, `delivery_time`, `department_id`, `purchase_status_id`, `user_id`, `zone_id`, `remark`, `vat_percent`, `internal_reference_doc`, `external_reference_doc`) VALUES
(1, 'PR4801-00001', '2018-09-13 00:00:00', 4, 7, 15, NULL, 1, 2, 60, 0, 3, 4, 1, NULL, 7, NULL, NULL),
(2, 'PR4801-00002', '2018-09-13 00:00:00', 4, 7, 15, '', 1, 2, 0, 0, 3, 4, 1, '', 0, NULL, NULL),
(3, 'PR1810-00001', '2018-10-02 17:16:49', 4, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 1, NULL, 0, NULL, NULL),
(4, 'PR1810-00002', '2018-10-02 17:19:09', 4, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 1, NULL, 0, NULL, NULL),
(5, 'PR1810-00003', '2018-10-02 17:19:32', 4, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 1, NULL, 0, NULL, NULL),
(6, 'PR1810-00004', '2018-10-03 10:38:17', 4, 1, 1, '1', 1, 2, 1, NULL, 2, 4, 1, '1', 0, NULL, NULL),
(7, 'PR6110-00005', '2018-10-03 10:42:25', 4, 1, 1, '1', 1, 2, 1, NULL, 2, 4, 2, '1', 0, NULL, NULL),
(8, 'PR6110-00006', '2018-10-03 10:44:44', 4, 1, 1, '1', 1, 2, 1, NULL, 2, 4, 2, '1', 0, NULL, NULL),
(9, 'PR6110-00007', '2018-10-05 16:55:19', 5, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 2, '1', 8, NULL, NULL);

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
  `department_id` int(11) DEFAULT NULL COMMENT 'รหัสแผนก',
  `sales_status_id` int(11) NOT NULL COMMENT 'สถานะ',
  `user_id` int(11) NOT NULL COMMENT 'รหัสพนักงานขาย',
  `zone_id` int(11) NOT NULL COMMENT 'เขตการขาย',
  `remark` varchar(255) DEFAULT NULL COMMENT 'หมายเหตุ',
  `vat_percent` float DEFAULT '7' COMMENT 'อัตราภาษี %',
  `internal_reference_doc` varchar(100) DEFAULT NULL,
  `external_reference_doc` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_quotation`
--

INSERT INTO `tb_quotation` (`quotation_id`, `quotation_code`, `datetime`, `customer_id`, `debt_duration`, `billing_duration`, `payment_condition`, `delivery_type_id`, `tax_type_id`, `delivery_time`, `department_id`, `sales_status_id`, `user_id`, `zone_id`, `remark`, `vat_percent`, `internal_reference_doc`, `external_reference_doc`) VALUES
(1, 'QT4801-00001', '2018-09-13 00:00:00', 4, 7, 15, NULL, 1, 2, 60, 0, 3, 4, 1, NULL, 7, NULL, NULL),
(2, 'QT4801-00002', '2018-09-13 00:00:00', 4, 7, 15, '', 1, 2, 0, 0, 3, 4, 1, '', 0, NULL, NULL),
(3, 'QT1810-00001', '2018-10-02 17:16:49', 4, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 1, NULL, 0, NULL, NULL),
(4, 'QT1810-00002', '2018-10-02 17:19:09', 4, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 1, NULL, 0, NULL, NULL),
(5, 'QT1810-00003', '2018-10-02 17:19:32', 4, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 1, NULL, 0, NULL, NULL),
(6, 'QT1810-00004', '2018-10-03 10:38:17', 4, 1, 1, '1', 1, 2, 1, NULL, 2, 4, 1, '1', 0, NULL, NULL),
(7, 'QT6110-00005', '2018-10-03 10:42:25', 4, 1, 1, '1', 1, 2, 1, NULL, 2, 4, 2, '1', 0, NULL, NULL),
(8, 'QT6110-00006', '2018-10-03 10:44:44', 4, 1, 1, '1', 1, 2, 1, NULL, 2, 4, 2, '1', 0, NULL, NULL),
(9, 'QT6110-00007', '2018-10-05 16:55:19', 5, 1, 1, '1', 1, 2, 1, NULL, 1, 4, 2, '1', 8, NULL, NULL);

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
(18, 3, 1, 100, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sales_status`
--

CREATE TABLE `tb_sales_status` (
  `sales_status_id` int(11) NOT NULL,
  `sales_status_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_sales_status`
--

INSERT INTO `tb_sales_status` (`sales_status_id`, `sales_status_name`) VALUES
(1, 'รอการตัดสินใจ'),
(2, 'รอเสนอผู้ใหญ่'),
(3, 'นัดวันส่งสินค้า'),
(4, 'ปิดการขายเรียบร้อย'),
(5, 'รอเสนอผู้ใหญ่'),
(6, 'ไม่สามารถปิดการขาย');

-- --------------------------------------------------------

--
-- Table structure for table `tb_settle`
--

CREATE TABLE `tb_settle` (
  `settle_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `settle_code` text NOT NULL,
  `customer_id` int(11) NOT NULL,
  `tax_type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deadline` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `zone_id` int(11) NOT NULL,
  `ref_number` int(11) NOT NULL,
  `taxation` text NOT NULL,
  `tax_filing` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `supplier_id` int(11) NOT NULL COMMENT 'id',
  `supplier_code` varchar(100) NOT NULL,
  `supplier_type` varchar(100) NOT NULL COMMENT 'ประเภทเจ้าหนี้',
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
  `telephone` varchar(100) NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `fax` varchar(100) DEFAULT NULL COMMENT 'เบอร์แฟ็กซ์',
  `email` varchar(100) DEFAULT NULL COMMENT 'อีเมล์',
  `transpotation_id` int(11) NOT NULL COMMENT 'ขนส่งโดย',
  `tax_number` varchar(13) DEFAULT NULL COMMENT 'เลขที่ภาษี',
  `remark` varchar(255) DEFAULT NULL COMMENT 'หมายเหตุ',
  `max_credit` float DEFAULT NULL COMMENT 'วงเงินเครดิต',
  `debt_duration` int(11) DEFAULT NULL COMMENT 'ระยะเวลาหนี้ (วัน)',
  `loyalty_discount` float DEFAULT NULL COMMENT 'ส่วนลดประจำ',
  `location_type_id` int(11) DEFAULT '0' COMMENT 'ชนิดสถานประกอบการ',
  `branch_id` int(11) DEFAULT '0' COMMENT 'สำนักงาน/สาขา',
  `debt_balance` float DEFAULT '0' COMMENT 'ยอดหนี้ขณะนี้'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_supplier`
--

INSERT INTO `tb_supplier` (`supplier_id`, `supplier_code`, `supplier_type`, `company_name`, `account_id`, `contact_name`, `address`, `sub_district`, `district`, `province`, `zipcode`, `delivery_address`, `delivery_sub_district`, `delivery_district`, `delivery_province`, `delivery_zipcode`, `telephone`, `fax`, `email`, `transpotation_id`, `tax_number`, `remark`, `max_credit`, `debt_duration`, `loyalty_discount`, `location_type_id`, `branch_id`, `debt_balance`) VALUES
(4, 'x1', '', 'Company A', 11011, 'Name A', 'xxxxx22222', '', '', '', '', 'asdcsae', '', '', '', '', '099-199-4665', '02-9999-9', NULL, 0, '1201201', 'sadxzcwqesa', 1121, 120120, 120120, 0, 0, 1000),
(5, 'x2', 'consumer', 'Company B', 1101, 'Name B', 'dsadsa', '', '', '', '', 'sadrsadr', '', '', '', '', '099-199-4665', '02-9999-99999', NULL, 0, '50', 'sdarwerawe', 50, 50, 50, 0, 0, 0);

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
-- Table structure for table `tb_zone`
--

CREATE TABLE `tb_zone` (
  `zone_id` int(11) NOT NULL,
  `zone_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_zone`
--

INSERT INTO `tb_zone` (`zone_id`, `zone_name`) VALUES
(1, 'เขตกรุงเทพฯ'),
(2, 'ภาคเหนือ'),
(3, 'ภาคใต้'),
(4, 'ภาคกลาง'),
(5, 'ภาคตะวันออกเฉียงเหนือ');

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
-- Indexes for table `debtout`
--
ALTER TABLE `debtout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

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
-- Indexes for table `settle`
--
ALTER TABLE `settle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_account`
--
ALTER TABLE `tb_account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `tb_bank`
--
ALTER TABLE `tb_bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `tb_bank_detail`
--
ALTER TABLE `tb_bank_detail`
  ADD PRIMARY KEY (`bank_detail_id`);

--
-- Indexes for table `tb_billing_note`
--
ALTER TABLE `tb_billing_note`
  ADD PRIMARY KEY (`billing_note_id`);

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `tb_customer_type`
--
ALTER TABLE `tb_customer_type`
  ADD PRIMARY KEY (`customer_type_id`);

--
-- Indexes for table `tb_debtout`
--
ALTER TABLE `tb_debtout`
  ADD PRIMARY KEY (`debt_id`);

--
-- Indexes for table `tb_delivery_type`
--
ALTER TABLE `tb_delivery_type`
  ADD PRIMARY KEY (`delivery_type_id`);

--
-- Indexes for table `tb_inventory`
--
ALTER TABLE `tb_inventory`
  ADD PRIMARY KEY (`inventory_id`);

--
-- Indexes for table `tb_invoice`
--
ALTER TABLE `tb_invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `tb_invoice_detail`
--
ALTER TABLE `tb_invoice_detail`
  ADD PRIMARY KEY (`invoice_detail_id`);

--
-- Indexes for table `tb_location_type`
--
ALTER TABLE `tb_location_type`
  ADD PRIMARY KEY (`location_type_id`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tb_purchase_order`
--
ALTER TABLE `tb_purchase_order`
  ADD PRIMARY KEY (`purchase_order_id`);

--
-- Indexes for table `tb_purchase_order_detail`
--
ALTER TABLE `tb_purchase_order_detail`
  ADD PRIMARY KEY (`purchase_order_detail_id`);

--
-- Indexes for table `tb_purchase_receive`
--
ALTER TABLE `tb_purchase_receive`
  ADD PRIMARY KEY (`purchase_receive_id`);

--
-- Indexes for table `tb_purchase_receive_detail`
--
ALTER TABLE `tb_purchase_receive_detail`
  ADD PRIMARY KEY (`purchase_receive_detail_id`);

--
-- Indexes for table `tb_purchase_requisition`
--
ALTER TABLE `tb_purchase_requisition`
  ADD PRIMARY KEY (`purchase_requisition_id`);

--
-- Indexes for table `tb_purchase_requisition_detail`
--
ALTER TABLE `tb_purchase_requisition_detail`
  ADD PRIMARY KEY (`purchase_requisition_detail_id`);

--
-- Indexes for table `tb_purchase_status`
--
ALTER TABLE `tb_purchase_status`
  ADD PRIMARY KEY (`purchase_status_id`);

--
-- Indexes for table `tb_quotation`
--
ALTER TABLE `tb_quotation`
  ADD PRIMARY KEY (`quotation_id`);

--
-- Indexes for table `tb_quotation_detail`
--
ALTER TABLE `tb_quotation_detail`
  ADD PRIMARY KEY (`quotation_detail_id`);

--
-- Indexes for table `tb_sales_status`
--
ALTER TABLE `tb_sales_status`
  ADD PRIMARY KEY (`sales_status_id`);

--
-- Indexes for table `tb_settle`
--
ALTER TABLE `tb_settle`
  ADD PRIMARY KEY (`settle_id`);

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `tb_tax_type`
--
ALTER TABLE `tb_tax_type`
  ADD PRIMARY KEY (`tax_type_id`);

--
-- Indexes for table `tb_zone`
--
ALTER TABLE `tb_zone`
  ADD PRIMARY KEY (`zone_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `debtout`
--
ALTER TABLE `debtout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- AUTO_INCREMENT for table `settle`
--
ALTER TABLE `settle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_bank`
--
ALTER TABLE `tb_bank`
  MODIFY `bank_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT for table `tb_bank_detail`
--
ALTER TABLE `tb_bank_detail`
  MODIFY `bank_detail_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT for table `tb_billing_note`
--
ALTER TABLE `tb_billing_note`
  MODIFY `billing_note_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_customer`
--
ALTER TABLE `tb_customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_customer_type`
--
ALTER TABLE `tb_customer_type`
  MODIFY `customer_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_debtout`
--
ALTER TABLE `tb_debtout`
  MODIFY `debt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_delivery_type`
--
ALTER TABLE `tb_delivery_type`
  MODIFY `delivery_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_inventory`
--
ALTER TABLE `tb_inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_invoice`
--
ALTER TABLE `tb_invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_invoice_detail`
--
ALTER TABLE `tb_invoice_detail`
  MODIFY `invoice_detail_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '_id', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_location_type`
--
ALTER TABLE `tb_location_type`
  MODIFY `location_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '_id', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_purchase_order`
--
ALTER TABLE `tb_purchase_order`
  MODIFY `purchase_order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_purchase_order_detail`
--
ALTER TABLE `tb_purchase_order_detail`
  MODIFY `purchase_order_detail_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '_id', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_purchase_receive`
--
ALTER TABLE `tb_purchase_receive`
  MODIFY `purchase_receive_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_purchase_receive_detail`
--
ALTER TABLE `tb_purchase_receive_detail`
  MODIFY `purchase_receive_detail_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '_id', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_purchase_requisition`
--
ALTER TABLE `tb_purchase_requisition`
  MODIFY `purchase_requisition_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_purchase_requisition_detail`
--
ALTER TABLE `tb_purchase_requisition_detail`
  MODIFY `purchase_requisition_detail_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '_id', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_purchase_status`
--
ALTER TABLE `tb_purchase_status`
  MODIFY `purchase_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_quotation`
--
ALTER TABLE `tb_quotation`
  MODIFY `quotation_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_quotation_detail`
--
ALTER TABLE `tb_quotation_detail`
  MODIFY `quotation_detail_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '_id', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_sales_status`
--
ALTER TABLE `tb_sales_status`
  MODIFY `sales_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_settle`
--
ALTER TABLE `tb_settle`
  MODIFY `settle_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_tax_type`
--
ALTER TABLE `tb_tax_type`
  MODIFY `tax_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_zone`
--
ALTER TABLE `tb_zone`
  MODIFY `zone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
