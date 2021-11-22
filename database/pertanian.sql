-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2021 at 05:17 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pertanian`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_panen`
--

CREATE TABLE `tabel_panen` (
  `id` int(11) NOT NULL,
  `nama_tanaman` varchar(32) NOT NULL,
  `hasil_panen` int(11) NOT NULL,
  `lama_tanam` int(11) NOT NULL,
  `tanggal_panen` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabel_panen`
--

INSERT INTO `tabel_panen` (`id`, `nama_tanaman`, `hasil_panen`, `lama_tanam`, `tanggal_panen`) VALUES
(1459347719, 'Cabe Rawit', 112, 13, '2021-01-12'),
(1637554015, 'Jagung', 50, 8, '2021-11-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_panen`
--
ALTER TABLE `tabel_panen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_panen`
--
ALTER TABLE `tabel_panen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1637554016;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
