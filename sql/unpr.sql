-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2019 at 08:30 AM
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
-- Database: `data2017`
--

-- --------------------------------------------------------

--
-- Table structure for table `unpr`
--

CREATE TABLE `unpr` (
  `ID` varchar(30) NOT NULL DEFAULT '',
  `UNIT` varchar(10) DEFAULT NULL,
  `LINE` int(11) NOT NULL DEFAULT '0',
  `RATIO` decimal(18,4) DEFAULT '0.0000',
  `PRICE1` decimal(18,4) DEFAULT '0.0000',
  `PRICE2` decimal(18,4) DEFAULT '0.0000',
  `PRICE3` decimal(18,4) DEFAULT '0.0000',
  `PRICE4` decimal(18,4) DEFAULT '0.0000',
  `BARCODE` varchar(20) DEFAULT NULL,
  `XDESCB` varchar(100) DEFAULT NULL,
  `PRICE5` decimal(18,4) DEFAULT '0.0000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Indexes for dumped tables
--

--
-- Indexes for table `unpr`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
