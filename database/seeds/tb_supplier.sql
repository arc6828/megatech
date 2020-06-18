-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 18, 2020 at 02:54 PM
-- Server version: 5.7.30-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.6

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
  `supplier_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ประเภทเจ้าหนี้',
  `company_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ชื่อบริษัท',
  `account_id` int(11) DEFAULT NULL COMMENT 'รหัสผังบัญชี',
  `contact_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ชื่อผู้ติดต่อ',
  `supplier_name` int(11) DEFAULT '555',
  `address` text COLLATE utf8mb4_unicode_ci COMMENT 'ที่อยู่',
  `address2` text COLLATE utf8mb4_unicode_ci,
  `sub_district` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ตำบล',
  `district` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'อำเภอ',
  `province` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'จังหวัด',
  `zipcode` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'รหัสไปรษณีย์',
  `delivery_address` text COLLATE utf8mb4_unicode_ci COMMENT 'ที่อยู่ส่งของ',
  `delivery_address2` text COLLATE utf8mb4_unicode_ci,
  `delivery_sub_district` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ตำบล (ส่งของ)',
  `delivery_district` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'อำเภอ (ส่งของ)',
  `delivery_province` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'จังหวัด (ส่งของ)',
  `delivery_zipcode` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'รหัสไปรษณีย์ (ส่งของ)',
  `user_id` int(11) DEFAULT '1' COMMENT 'รหัสพนักงานขาย',
  `telephone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'เบอร์โทรศัพท์',
  `fax` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'เบอร์แฟ็กซ์',
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'อีเมล์',
  `zone_id` int(11) DEFAULT NULL COMMENT 'เขตการขาย',
  `delivery_type_id` int(11) DEFAULT NULL COMMENT 'ขนส่งโดย',
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'หมายเหตุ',
  `max_credit` double DEFAULT NULL COMMENT 'วงเงินเครดิต',
  `debt_duration` int(11) DEFAULT NULL COMMENT 'ระยะเวลาหนี้ (วัน)',
  `degree_product` int(11) DEFAULT NULL COMMENT 'ระดับของราคาสินค้า',
  `loyalty_discount` double DEFAULT NULL COMMENT 'ส่วนลดประจำ',
  `tax_number` varchar(13) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'เลขที่ภาษี',
  `billing_duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'เงื่อนไขวางบิล',
  `cheqe_condition` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_time` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_condition` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'เงื่อนไขรับเช็ค',
  `tax_type_id` int(11) DEFAULT '2',
  `location_type_id` int(11) DEFAULT '0' COMMENT 'ชนิดสถานประกอบการ',
  `branch_id` int(11) DEFAULT '0' COMMENT 'สำนักงาน/สาขา',
  `debt_balance` double DEFAULT '0' COMMENT 'ยอดหนี้ขณะนี้',
  `upload` text COLLATE utf8mb4_unicode_ci,
  `contact` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_map` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_cc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_cv_20` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_cheque` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_supplier`
--

INSERT INTO `tb_supplier` (`supplier_id`, `supplier_code`, `supplier_type`, `company_name`, `account_id`, `contact_name`, `supplier_name`, `address`, `address2`, `sub_district`, `district`, `province`, `zipcode`, `delivery_address`, `delivery_address2`, `delivery_sub_district`, `delivery_district`, `delivery_province`, `delivery_zipcode`, `user_id`, `telephone`, `fax`, `email`, `zone_id`, `delivery_type_id`, `remark`, `max_credit`, `debt_duration`, `degree_product`, `loyalty_discount`, `tax_number`, `billing_duration`, `cheqe_condition`, `delivery_time`, `payment_condition`, `tax_type_id`, `location_type_id`, `branch_id`, `debt_balance`, `upload`, `contact`, `created_at`, `updated_at`, `payment_method`, `file_map`, `file_cc`, `file_cv_20`, `file_cheque`) VALUES
(1, 'DA0001', NULL, 'บริษัท เอพิร็อค (ประเทศไทย) จำกัด', NULL, NULL, 555, '125 ม.9 นิคมอุตสาหกรรมเวลโกรว์ ถ.บางนา-ตราด กม.36', 'ต.บางวัว อ.บางปะกง จ.ฉะเชิงเทรา 24130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '038-562930', '038-562904', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '0245560001641', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'DC0001', NULL, 'บริษัท ซีเค ทูลส์ จำกัด', NULL, NULL, 555, '99/8 ซ.แจ้งวัฒนะ 1 แขวง ตลาดบางเขน', 'เขต หลักสี่   กทม  10210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-973-2773', '02-973-2772', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'DF0001', NULL, 'บริษัท ฟูจิทูลลิ่ง จำกัด', NULL, NULL, 555, '19/315 ม.2 ซ.วิถาวดี 60 ถ.วิภาวดีรังสิต', 'เเขวงบางเขน  เขตหลักสี่   กทม 10210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-579-4433', '02-579-8409', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'DF0002', NULL, 'บริษัท เอฟ ดี เอ็ม เทคโนโลยี จำกัด', NULL, NULL, 555, '888/3 ถนนศรีนครินทร์ แขวงพัฒนาการ', 'เขตสวนหลวง  กรุงเทพมหานคร 10250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-347-6255', '02-3476256', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '010554511522', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'DF0003', NULL, 'บริษัท ฟอซ ลิ้งค์ จำกัด', NULL, NULL, 555, '99/53 ม.5 ถ.สุขาภิบาล2 แขวงดอกไม้', 'เขตประเวศ กรุงเทพฯ 10250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-750-0005', '02-750-2704', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'DG0001', NULL, 'บริษัท โกรว์ ไวด์ เทคโนโลยี จำกัด', NULL, NULL, 555, '10/19  ถ.ราเมศวร  ต.ประตูชัย', 'อ.พระนครศรีอยุธยา จ.พระนครศรีอยุธยา 13000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '035-324-046', '035-245-790', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '0145549000619', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'DG0002', NULL, 'บริษัท ไกรนด์เทค จำกัด', NULL, NULL, 555, '99/37 หมู่ 6 ต.ศาลายา', 'อ.พุทธมณฑล  จ.นครปฐม  73170', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-441-5481', '02-441-5482', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '0105546004109', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'DG0003', NULL, 'บริษัท จี.พี.คอมพิวเตอร์ จำกัด', NULL, NULL, 555, '78/228  หมู่ 6 ต.บึงคำพร้อย', 'อ.ลำลูกกา จ.ปทุมธานี  12150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-152-1323', '02-153-1323', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '0135550000635', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'DG0004', NULL, 'ห้างหุ้นส่วนจำกัด จีเอ็ม ลาเบล แอนด์ บาร์โคด ซิสเต็ม', NULL, NULL, 555, '1/49 ซ.พระยาสุเรนทร์ 39', 'แขวงสามวาจะวันตก เขตคลองสามวา กทม. 10510', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '081-205-4317', '-', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'DI0001', NULL, 'บริษัท ไอเดีย เทรด แอนด์ ซัพพอร์ท จำกัด', NULL, NULL, 555, '228/1  ถ.สันติเกษม ต.แสนสุข', 'อ.เมืองชลบุรี จ.ชลบุรี 20130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '038-391-680', '038-391-680', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'DI0002', NULL, 'บริษัท อีสคาร์(ไทยแลนด์) จำกัด', NULL, NULL, 555, '\"57', '59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '61', '63 ซ.สมานฉันท์-บาโบส ถ.สุขุมวิท\"', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, 'พระโขนง  คลอง', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'DI0003', NULL, 'บริษัท อินเตอร์ทูลไทย จำกัด', NULL, NULL, 555, '907 ม.15 ต.บางเสาธง', 'อ.บางเสาธง จ.สมุทรปราการ 10540', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-706-0899', '02-313-1114', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '0115554011640', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'DI0004', NULL, 'บริษัท อินดัสทรีเมท จำกัด', NULL, NULL, 555, '19/6 ซ.พระราม2 ซ.28 แยก 12', 'แขวงบางมด เขตจอมทอง กทม 10150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-877-0055', '02-8770099', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'DJ0001', NULL, 'บริษัท จัวเยียะ (ไทยแลนด์) จำกัด', NULL, NULL, 555, '1588/1 บ้านกลางกรุง ถ.บางนา-ตราด', 'บางนา กรุงเทพฯ 10260', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-1820581-6', '02-1820587', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'DJ0002', NULL, 'บริษัท จ.ศรีรุ่งเรืองอิมเป็กซ์ จำกัด', NULL, NULL, 555, '850/1 ซ.ลาดกระบัง 30/5 ถ.ลาดกระบัง', 'เขตลาดกระบัง กทม. 10520', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-327-0351-5', '02-327-0356-7', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'DJ0003', NULL, 'ห้างหุ้นส่วนจำกัด จินดาทรัพย์กลการ', NULL, NULL, 555, '226/71 ม.6 ถ.ประชาสโมสร ต.ในเมือง', 'อ.เมืองขอนแก่น จ.ขอนแก่น 40000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '081-570-4579', '043-245727', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'DK0001', NULL, 'บริษัท คราเด็กซ์ จำกัด', NULL, NULL, 555, '59/203  หมู่ 16 ต.บางแก้ว', 'อ.บางพลี  จ.สมุทรปราการ  10540', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-349-4081', '02-383-4732', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '0115547006725', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'DK0002', NULL, 'บริษัท เกียงไทยวัฒนา อินเตอร์เทรด จำกัด', NULL, NULL, 555, '634  ถ.พระราม 2 แขวงบางมด', 'เขตจอมทอง กรุงเทพ 10150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-811-7499', '02-811-7475', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '0105551103799', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'DK0003', NULL, 'บริษัท เคียวเซกิ ทูลส์ จำกัด', NULL, NULL, 555, '23 ม4 นิคมอุตสาหกรรมลาดกระบัง ซ.ฉลองกรุง31', 'แขวงลำปลาทิว เขตลาดกระบัง กรุงเทพมหานคร 10520', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-739-6491-4', '02-7396495', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '0105557039863', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'DK0004', NULL, 'บริษัท กรุงเทพหินเจียร จำกัด', NULL, NULL, 555, '59/6 ม.4 ต.บางแก้ว อ.บางพลี', 'จ.สมุทรปราการ 10540', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-753-5357', '02-703-0300', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'DK0005', NULL, 'บริษัท เกรียงกมล 2009 จำกัด', NULL, NULL, 555, '44 ถ.เยาวราช แขวงจักรวรรดิ', 'เขตสัมพันธวงศ์ กรุงเทพฯ 10100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-811-7499', '02-811-7475-5', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'DK0006', NULL, 'ห้างหุ้นส่วนจำกัด เค. เอส. เวลธี่ อินเตอร์ เทรด', NULL, NULL, 555, '60 ซ.รังสิต-ปทุมธานี14 ซ.5 ถ.รังสิต-ปทุมธานี', 'ต.ประชาธิปัตย์ อ.ธัญบุรี จ.ปทุมธานี 12130', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '090-6646494', '02-9583818', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '0133549000854', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'DM0001', NULL, 'บริษัท มิซูยา (ประเทศไทย) จำกัด', NULL, NULL, 555, '8/5 ม.9 ต.บางบ่อ อ.บางบ่อ', 'จ.สมุทรปราการ 10560', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-9809423', '02-9809423', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '0115556021227', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'DM0002', NULL, 'บริษัท มิล มาสเตอร์ จำกัด', NULL, NULL, 555, '77/63 ถ.สามวา แขวงบางชัน', 'เขตคลองสามวา กทม 10510', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-9063883', '02-9060884', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'DN0001', NULL, 'บริษัท เอ็น. บี. ที. ซัพพลาย จำกัด', NULL, NULL, 555, '120/8 ม.3 ต.บ่อวิน', 'อ.ศรีราชา จ.ชลบุรี 20230', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '038-337-085-6', '038-337-087', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'DN0002', NULL, 'บริษัท เอ็นที.พาร์ท จำกัด', NULL, NULL, 555, '26/176 ซ.ประเสริฐมนูกิจ 39 แขวงนวลจันทร์', 'เขตบึงกุ่ม กรุงเทพฯ 10230', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-946-6394', '02-519-3247', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'DO0001', NULL, 'บริษัท โอนิอินเตอร์เทรด จำกัด', NULL, NULL, 555, '18/34 ม.7 ถ.บางนา-ตราด กม.17.5', 'ต.บางโฉลง อ.บางพลี จ.สมุทรปราการ 10540', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-750-8525', '02-750-8526', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'DP0001', NULL, 'บริษัท แปซิฟิค ทูลส์ จำกัด', NULL, NULL, 555, '299/8  หมู่ 9 ถ.เทพารักษ์ ต.บางปลา', 'อ.บางพลี จ.สมุทรปราการ 10540', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-706-3393', '02-315-4363', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '0115531001605', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'DP0002', NULL, 'บริษัท พีทีพี คอร์ปอเรชั่น จำกัด', NULL, NULL, 555, '89/391 หมู่6 ตำบลบ่อวิน อำเภอศรีราชา', 'จังหวัดชลบุรี  20230', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '038-346019', '038-346019', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '0205553014903', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'DP0003', NULL, 'บริษัท แปซิฟิก เมอร์คิวรี่ จำกัด', NULL, NULL, 555, '32 ซ.ลาดพร้าววังหิน67 ถ.ลาดพร้าววังหิน แขวงลาดพร้าว', 'เขตลาดพร้าว กรุงเทพมหานคร 10230', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '025397989', '025383945', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'DP0004', NULL, 'บริษัท พลัสแม็กซ์ ออโตเมชั่น จำกัด', NULL, NULL, 555, '289 ซ.จรัญสนิทวงศ์ 44 ถ.จรัญสนิทวงศ์', 'แขวงบางยี่ขัน เขตบางพลัด กรุงเทพมหานคร 10700', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-235-3295-8', '02-235-3299', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'DP0005', NULL, 'ห้างหุ้นส่วนจำกัด พีเค ไม้ฟิตติ้ง', NULL, NULL, 555, '147 ถ.ราชมรรคา ต.สนามจันทร์', 'อ.เมือง จ.นครปฐม 73000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '096-5945539', '034-275228', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'DP0006', NULL, 'ร้านเป็นเอก', NULL, NULL, 555, 'ตลาดธนบุรี สนามหลวง2 ถ.เลียบคลองทวีวัฒนา', 'แขวงทวีวัฒนา เขตทวีวัฒนา กรุงเทพมหานคร 10170', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '087-067-1949', '-', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'DP0007', NULL, 'บริษัท พาร์ท แฟคตอรี่ โทเทิ้ล กรุ๊ป จำกัด', NULL, NULL, 555, '406/28 ถ.สามัคคี ต.ท่าทราย', 'อ.เมืองนนทบุรี จ.นนทบุรี 11000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '-', '-', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'DP0008', NULL, 'บริษัท เพรสซิชั่น ทูลลิ่ง เซอร์วิส จำกัด', NULL, NULL, 555, '88 อาคารนิมิตกุล ชั้น3 ซ.พระรามเก้า57/1', 'สวนหลวง กทม 10250', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-370-4900', '02-3704920', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'DQ0001', NULL, 'ห้างหุ้นส่วนจำกัด ควอลิเทค อิควิปเม้นท์', NULL, NULL, 555, '70/175 ม.5 ถ.ลำลูกกา ต.บึงคำพร้อย', 'อ.ลำลูกกา จ.ปทุมธานี 12150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-532-7363', '02-532-6526', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'DS0001', NULL, 'บริษัท สมาร์ท  ทูลส์  จำกัด', NULL, NULL, 555, '3/63  ซ.พุทธบูชา 36 แยก 1', 'แขวงบางมด  เขตทุ่งครุ  กรุงเทพ  10140', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-464-8152-3', '02-464-8154', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '0105546042515', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'DS0002', NULL, 'ห้างหุ้นส่วนจำกัด ศิลป์ไฟฟ้าไทยอุตสาหกรรม', NULL, NULL, 555, '97/3  ซ.นาคสุวรรณ  ถ.นนทรี', 'แขวงช่องนนทรี เขตทยานนาวา   กรุงเทพ 10120', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, ' 02-284-1597', '02-681-689', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'DS0003', NULL, 'บริษัท เอสอี เพอร์เฟค วัน จำกัด', NULL, NULL, 555, '118/17  ม.1 ต.ลำไทร', 'อ.วังน้อย จ.พระนครศรีอยุธยา  13170', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '035-740-833', '035-740-834', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'DS0004', NULL, 'บริษัท สยาม แมคคาทรอนิค จำกัด', NULL, NULL, 555, '644 ซ.ลาซาล แขวงบางนา', 'เขตบางนา กรุงเทพมหานคร 10260', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-3985537', '02-3993786', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'DS0005', NULL, 'บริษัท ซุปเปอร์คิท แอนด์ มาร์เก็ตติ้ง จำกัด', NULL, NULL, 555, '9/173 ซ.ลาดปลาเค้า78 แขวงอนุสาวรีย์', 'เขตบางเขน กทม. 10220', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-552-6235', '02-551-0716', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '0105558006781', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 'DS0006', NULL, 'บริษัท เอสเอสเอ เจเนอรัล ทูลส์ จำกัด', NULL, NULL, 555, '5 ซ.เพชรเกษม 55/2 ถ.เพชรเกษม', 'แขวงบางแค เขตบางแค กรุงเทพมหานคร 10160', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-413-5731', '02-454-3957', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '0105558000405', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 'DS0007', NULL, 'คุณสะอาด ไปล่โสภน', NULL, NULL, 555, '60/128 ม.3 ต.คลองสวนพลู อ.พระนครศรีอยุธยา', 'จ.พระนครศรีอยุธยา 13000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '083-7145173', '-', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 'DS0008', NULL, 'บริษัท สยามมิตโต โปรดักส์ พาร์ท จำกัด', NULL, NULL, 555, '75/31 ม.1 ต.หนองซ้ำซาก อ.บ้านบึง จ.ชลบุรี 20170', '-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '-', '-', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'DS0009', NULL, 'ส.ศิริออโต้', NULL, NULL, 555, '201/960 ม.1 ซ.เอ็มไทย2 ถ.เทพารักษ์', 'ต.บางเสาธง อ.บาเสาธง จ.สมุทรปราการ 10540', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '089-982-6192', '-', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 'DS0010', NULL, 'ห้างหุ้นส่วนจำกัด สยามไดน่าซัพพลาย', NULL, NULL, 555, '295/14 ซ.กิ่งเพชร ถ.เพชรบุรีตัดใหม่', 'แขวงถนนเพชรบุรี เขตราชเทวี กทม 10400', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-933-3430', '02-933-3440', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '0103533021024', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 'DS0011', NULL, 'S.A.U. S.p.A.', NULL, NULL, 555, '\"Via Dei Raseni', '6/B\"', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '\"41040 Polinago', ' Modena', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, ' Italy\"', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 'DT0001', NULL, 'บริษัท ทูลลิ่ง เซอร์วิส เซ็นเตอร์ จำกัด', NULL, NULL, 555, '202/655-565 ซ.สุภาพงษ์2 แขวงหัวหมาก', 'เขตบางกะปิ กรุงเทพมหานคร 10240', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-370-4929-35', '02-376-2527', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 'DT0002', NULL, 'บริษัท ทรูเทค แมชชินเนอรี่ จำกัด', NULL, NULL, 555, '\"2', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '4/1 ซอยเอกชัย 76 ถ.เอกชัย\"', 'แขวงบางบอน เขตบางบอน กรุงเทพมหานคร 10150', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '02-4171225-30', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 'DT0003', NULL, 'บริษัท ทูล ลิงค์ จำกัด', NULL, NULL, 555, '88 อาคารเอ.พี.นครินทร์ ชั้น14 ซ.ลาซาล58', 'ถ.ศรีนครินทร์ บางนา กทม 10260', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-748-7070-1', '02-748-7072', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 'DT0004', NULL, 'Tool-Flo Manufacturing Inc.', NULL, NULL, 555, '14745 Kirby DR', '\"Houston', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, ' TX 77047\"', '+1 713 941 1080', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '+1 800 342 09', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 'DT0005', NULL, 'บริษัท ต้าเหรียญ อินดัสทรีส์ จำกัด', NULL, NULL, 555, '29/11 ม.7 แขวงศาลาธรรฒสพน์', 'เขตทวีวัฒนา กทม. 10170', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-889-7338', '02-889-6823', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(53, 'DT0006', NULL, 'ห้างหุ้นส่วนจำกัด ที.ดี.อีควิปเม้นท์ (1997)', NULL, NULL, 555, '136/17 ซ.แม้นศรี 1 ถ.บำรุงเมือง แขวงคลองมหานาค', 'เขตป้อมปราบศัตรูพ่าย กรุงเทพมหานคร 10100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-225-7343', '02-2257343', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(54, 'DT0007', NULL, 'ไทยอควาเรี่ยมเซ็นเตอร์', NULL, NULL, 555, 'ตลาดปลาสวยงาม JJ MALL ห้อง B01', 'กทม 10150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '086-700-4515', '-', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 'DT0008', NULL, 'บริษัท ทองพูน เอ็นจิเนียริ่ง จำกัด', NULL, NULL, 555, '34 ซ.สุขสวัสดิ์13 แยก12', 'แขวงบางปะกอก เขตราษฎร์บูรณะ กทม. 10140', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '084-6652496', '-', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 'DT0009', NULL, 'บริษัท ไทยพัฒนสิน (จิ้นเส็ง) จำกัด', NULL, NULL, 555, '13 ถ.ราชพฤกษ์ ตลิ่งชัน', 'กรุงเทพฯ 10170', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-408-8710', '02-408-8719-20', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 'DT0010', NULL, 'บริษัท ทูลเน็ท (ไทยแลนด์) จำกัด', NULL, NULL, 555, '52/171 ซ.กรุงเทพกรีฑา แขวงสะพานสูง', 'เขตสะพานสูง กทม. 10240', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-736-2381-4', '02-7362385', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 'DT0011', NULL, 'บริษัท ทูลลิ่ง เอ็กแซ็กท์ จำกัด', NULL, NULL, 555, '261/15 ม.2 ต.บางเพรียง อ.บางบ่อ จ.สมุทรปราการ 10560', '-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-7085721-3', '02-7085724', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 'DT0012', NULL, 'บริษัท เทียนสุภา อินเตอร์เทรด จำกัด', NULL, NULL, 555, '1938 ถ.ข้าวหลาม แขวงตลาดน้อย', 'เขตสัมพันธวงศ์ กรุงเทพฯ 10100', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-236-4765', '02-639-4238', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 'DT0013', NULL, 'ห้างหุ้นส่วนจำกัด ที. เอ็ม. ทูลลิ่ง', NULL, NULL, 555, '28 ซ.ลาซาล 65 ถ.สุขุมวิท 105 แขวงบางนา', 'เขตบางนา กรุงเทพมหานคร 10540', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-7525214-5', '02-7525216', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 'DU0001', NULL, 'บริษัท ยูไนเต็ดทังสเตน จำกัด', NULL, NULL, 555, '15/5 หมู่ที่ 1 ตำบลคลองอุดมชลจร', 'อำเภอเมือง จังหวัดฉะเชิงเทรา 24000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '038-090-650', '038-090-659', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 'DW0001', NULL, 'บริษัท ดับบลิว.เค มัลติทูลส์ จำกัด', NULL, NULL, 555, '100/7  หมู่ 8 ต.บางเมือง', 'อ.เมืองสมุทรปราการ จ.สมุทรปราการ 10270', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-383-5804', '02-383-5799', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '3032270595', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 'DW0002', NULL, 'บริษัท วราคณะ จำกัด', NULL, NULL, 555, '20 ม.1 ถ.สุขุมวิท ต.เมืองใหม่', 'อ.เมืองสมุทรปราการ จ.สมุทรปราการ 10270', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-757-8537-8', '027578539', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 'DW0003', NULL, 'บริษัท วุฒิ ฮาร์ดแวร์ จำกัด', NULL, NULL, 555, '70 ซ.บรมราชชนนี 64 ถ.บรมราชชนนี', 'แขวงศาลาธรรมสพน์ เขตทวีวัฒนา กทม 10170', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-8884205', '02-8883427', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 'DX0001', NULL, 'ห้างหุ้นส่วนจำกัด เอ๊กซ์วีเอ็น พรีซิชั่น พาร์ท', NULL, NULL, 555, '1/45 ม.1 ต.หนองรี อ.เมืองชลบุรี จ.ชลบุรี 20000', '-', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '-', '-', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 'DY0001', NULL, '\"YAMAZEN (THAILAND) CO.', NULL, NULL, 555, ' LTD\"', '\"1230 and 1230/1 Rama 9 Road', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, ' Kwang Suanluang\"', '\"Khet Suanluang', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, ' Bangkok 1025', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 'DY0002', NULL, 'บริษัท ยี้ซิง แมชชีนเนอรี่ จำกัด', NULL, NULL, 555, '17 ถ.พระราม2 แขวงท่าข้าม', 'เขตบางขุนเทียน กรุงเทพมหานคร 10150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '02-4158964-5', '02-4165464', NULL, NULL, 1, NULL, NULL, 30, NULL, NULL, '-', '30', NULL, '30', '30', 2, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=68;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
