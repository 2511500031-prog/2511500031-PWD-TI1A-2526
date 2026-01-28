-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 28, 2026 at 04:34 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pwd2025`
--

-- --------------------------------------------------------

--
-- Table structure for table `biodata_dosen`
--

CREATE TABLE `biodata_dosen` (
  `id` int(11) NOT NULL,
  `bnama` varchar(100) DEFAULT NULL,
  `btempat_lahir` varchar(50) DEFAULT NULL,
  `btanggal_lahir` date DEFAULT NULL,
  `bhobi` varchar(100) DEFAULT NULL,
  `bpekerjaan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `biodata_dosen`
--

INSERT INTO `biodata_dosen` (`id`, `bnama`, `btempat_lahir`, `btanggal_lahir`, `bhobi`, `bpekerjaan`) VALUES
(1, 'Dr.ahmad fauzan,N.Kom', 'padang', '1985-03-12', 'membaca jurnal', 'dosen teknik informatika'),
(2, 'Dr.ahmad fauzan,N.Kom', 'padang', '1985-03-12', 'membaca jurnal', 'dosen teknik informatika');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biodata_dosen`
--
ALTER TABLE `biodata_dosen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biodata_dosen`
--
ALTER TABLE `biodata_dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
