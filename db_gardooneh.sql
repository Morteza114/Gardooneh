-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2022 at 08:52 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gardooneh`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_javayez`
--

CREATE TABLE `tbl_javayez` (
  `id` tinyint(4) NOT NULL,
  `jayezeh` varchar(20) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_javayez`
--

INSERT INTO `tbl_javayez` (`id`, `jayezeh`) VALUES
(1, 'فلافل'),
(2, 'هات داگ پنیری'),
(3, 'نون پنیر لیقوان'),
(4, 'پاچین کبابی'),
(5, 'خوراک'),
(6, 'همبرگر');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_moshakhasat`
--

CREATE TABLE `tbl_moshakhasat` (
  `id` int(11) NOT NULL,
  `namVaFamil` varchar(40) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `shomareHamrah` char(11) CHARACTER SET utf8 COLLATE utf8_persian_ci NOT NULL,
  `darajeGardoone_ID` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_javayez`
--
ALTER TABLE `tbl_javayez`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_moshakhasat`
--
ALTER TABLE `tbl_moshakhasat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shomareHamrah` (`shomareHamrah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_moshakhasat`
--
ALTER TABLE `tbl_moshakhasat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
