
-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `product_id` int(11) NOT NULL,
  `product_code` varchar(30) DEFAULT NULL,
  `product_name` varchar(150) DEFAULT NULL,
  `product_detail` varchar(150) DEFAULT NULL,
  `brand` varchar(150) DEFAULT NULL,
  `grade` varchar(100) DEFAULT NULL,
  `promotion_price` float DEFAULT NULL,
  `floor_price` float DEFAULT NULL,
  `max_discount_percent` float DEFAULT '40',
  `amount_in_stock` int(11) DEFAULT NULL,
  `product_unit` varchar(10) DEFAULT NULL,
  `pending_in` int(11) DEFAULT '0' COMMENT 'ค้างรับ',
  `pending_out` int(11) DEFAULT '0' COMMENT 'ค้างส่ง',
  `normal_price` float(18,4) DEFAULT '0.0000',
  `BARCODE` varchar(20) DEFAULT NULL,
  `item_code` varchar(20) DEFAULT NULL,
  `purchase_price` float DEFAULT '0',
  `purchase_ref` varchar(100) DEFAULT NULL COMMENT 'อ้างอิงการซื้อ',
  `ISBN` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT '0',
  `weight_in_lbs` float DEFAULT '0',
  `price_1` float DEFAULT '0',
  `price_10_99` float DEFAULT '0',
  `price_100` float DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
