-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2018 at 11:08 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ci_tutorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `prov`
--

CREATE TABLE IF NOT EXISTS `prov` (
`id_prov` int(2) NOT NULL,
  `nama_prov` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prov`
--

INSERT INTO `prov` (`id_prov`, `nama_prov`) VALUES
(1, 'sulawesi selatan'),
(2, 'sulawesi tenggara'),
(3, 'sulawesi tengah'),
(4, 'sulawesi barat'),
(5, 'sulawesi utara'),
(6, 'gorontalo'),
(7, 'jawa tengah'),
(8, 'jawa timur'),
(9, 'jawa barat'),
(10, 'dki jakarta'),
(11, 'kalimanta timur'),
(12, 'kalimantar barat'),
(13, 'kalimantan tengah'),
(14, 'sumatera selatan'),
(15, 'sumatera barat'),
(16, 'sumatera utara');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prov`
--
ALTER TABLE `prov`
 ADD PRIMARY KEY (`id_prov`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `prov`
--
ALTER TABLE `prov`
MODIFY `id_prov` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
