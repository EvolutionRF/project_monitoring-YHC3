-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2022 at 03:19 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectmonitoring_yhc`
--

-- --------------------------------------------------------

--
-- Table structure for table `leader`
--

CREATE TABLE `leader` (
  `id_leader` int(11) NOT NULL,
  `nama_leader` varchar(2552) NOT NULL,
  `email_leader` varchar(255) NOT NULL,
  `foto_leader` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leader`
--

INSERT INTO `leader` (`id_leader`, `nama_leader`, `email_leader`, `foto_leader`) VALUES
(6, 'Indra Setiawan', 'indrasetiawan@gmail.com', '1658147375_6208eeb2fc80a7b6b9f6.jpg'),
(7, 'Ridha Fahmi J', 'ridhafahmij@gmail.com', '1658147393_dc4654634a1ef8e79cbb.jpg'),
(8, 'Alam Mahartaj', 'alam.mahartaj@gmail.com', '1658147430_238e3b1dadc9c3c78a14.jpg'),
(9, 'Yudha Fadilah', 'Yuda.fdh@gmail.com', '1658147451_805599270987345c6fa7.jpg'),
(10, 'Adit Firdaus', 'aditfirdaus@gmail.com', '1658147489_8f4bf87f58152d2a05fd.jpg'),
(11, 'Ervan Budiman', 'ervan.budiman@gmail.com', '1658147923_3cb596e4c8bd3e316eae.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id_project` int(11) NOT NULL,
  `nama_project` varchar(255) NOT NULL,
  `client_project` varchar(255) NOT NULL,
  `id_leader` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `progress` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id_project`, `nama_project`, `client_project`, `id_leader`, `start_date`, `end_date`, `progress`) VALUES
(5, 'Pembuatan SI Keuangan', 'Bakeuda Prov. Kalsel', 6, '2022-01-14', '2022-08-14', '30'),
(6, 'Learning Management System', 'Ruang Guru', 7, '2022-01-30', '2022-03-10', '50'),
(7, 'SI Pendataan Alat Daerah', 'Dispora Jawa Timur', 8, '2022-02-02', '2022-05-30', '75'),
(8, 'Employee Monitoring', 'PT. Bina Sarana Sukses', 9, '2021-09-02', '2022-01-15', '100'),
(9, 'Sistem Informasi Geografis', 'Disporabudpar Banjarbaru', 7, '2022-07-01', '2022-09-01', '15'),
(10, 'Pembuatan Website Persuratan', 'Kominfo Banjarmasin', 8, '2022-05-31', '2022-10-03', '50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leader`
--
ALTER TABLE `leader`
  ADD PRIMARY KEY (`id_leader`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id_project`),
  ADD KEY `id_leader` (`id_leader`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leader`
--
ALTER TABLE `leader`
  MODIFY `id_leader` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id_project` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`id_leader`) REFERENCES `leader` (`id_leader`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
