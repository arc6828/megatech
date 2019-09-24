-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 24, 2019 at 07:33 AM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.2

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
-- Table structure for table `debtout_kak`
--

CREATE TABLE `debtout_kak` (
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
-- Dumping data for table `debtout_kak`
--

INSERT INTO `debtout_kak` (`id`, `id_dept`, `id_customer`, `type_tax`, `tax_liability`, `date_dept`, `deadline`, `tax_filing`, `total_dept`, `tax_value`, `tax`, `total`) VALUES
(4, 'XR123', '100-SW', '', '', '2018-06-12', '2018-07-01', '6/2018', 1000, 80, 8, 1080);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `debtout_kak`
--
ALTER TABLE `debtout_kak`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `debtout_kak`
--
ALTER TABLE `debtout_kak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
