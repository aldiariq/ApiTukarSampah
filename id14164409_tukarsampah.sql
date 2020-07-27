-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 27, 2020 at 04:46 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id14164409_tukarsampah`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `username_admin` varchar(200) NOT NULL,
  `nohp_admin` varchar(200) NOT NULL,
  `password_admin` varchar(200) NOT NULL,
  `tipe_akun` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username_admin`, `nohp_admin`, `password_admin`, `tipe_akun`) VALUES
(1, 'admin', '082289242539', '21232f297a57a5a743894a0e4a801fc3', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kurir`
--

CREATE TABLE `tb_kurir` (
  `id_kurir` int(11) NOT NULL,
  `username_kurir` varchar(200) NOT NULL,
  `password_kurir` varchar(200) NOT NULL,
  `nohp_kurir` varchar(200) NOT NULL,
  `alamat_kurir` varchar(200) NOT NULL,
  `tipe_akun` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kurir`
--

INSERT INTO `tb_kurir` (`id_kurir`, `username_kurir`, `password_kurir`, `nohp_kurir`, `alamat_kurir`, `tipe_akun`) VALUES
(21, 'kurir', 'bb31e9f1f03ad601eb8fb53e4f663039', '0821', 'jl bedil', 'KURIR');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username_pengguna` varchar(200) NOT NULL,
  `password_pengguna` varchar(200) NOT NULL,
  `nohp_pengguna` varchar(200) NOT NULL,
  `alamat_pengguna` varchar(200) NOT NULL,
  `tipe_akun` varchar(200) NOT NULL,
  `status_langganan` enum('YA','TIDAK') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `username_pengguna`, `password_pengguna`, `nohp_pengguna`, `alamat_pengguna`, `tipe_akun`, `status_langganan`) VALUES
(28, 'abbi', 'd2bdbdc8c8d538746ab50adc311e1faf', '081367565460', 'Jl bukit baru , Komp griya bukit permai no.4', 'PENGGUNA', 'YA'),
(29, 'baru', '5ef035d11d74713fcb36f2df26aa7c3d', '08281381', 'Alamat', 'PENGGUNA', 'YA'),
(31, 'pengguna', '8b097b8a86f9d6a991357d40d3d58634', '0878', 'jl bosku', 'PENGGUNA', 'YA'),
(32, 'Farah Salsabila', '891688e1dbdb827de281d1ee7c6b87bf', '081219782301', 'Jl. Bukit baru , komp Griya bukit permai no.19', 'PENGGUNA', 'YA');

-- --------------------------------------------------------

--
-- Table structure for table `tb_point`
--

CREATE TABLE `tb_point` (
  `id_point` int(11) NOT NULL,
  `jumlah_point` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_point`
--

INSERT INTO `tb_point` (`id_point`, `jumlah_point`, `id_pengguna`) VALUES
(27, 110, 28),
(28, 20, 29);

-- --------------------------------------------------------

--
-- Table structure for table `tb_reward`
--

CREATE TABLE `tb_reward` (
  `id_reward` int(11) NOT NULL,
  `hadiah_reward` varchar(200) NOT NULL,
  `point_reward` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_reward`
--

INSERT INTO `tb_reward` (`id_reward`, `hadiah_reward`, `point_reward`) VALUES
(57, 'PULSA 10RB', '250');

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `id_kurir` int(11) NOT NULL,
  `tipe_sampah` varchar(200) NOT NULL,
  `jumlah_transaksi` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `status_transaksi` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transaksi`, `id_pengguna`, `id_kurir`, `tipe_sampah`, `jumlah_transaksi`, `tgl_transaksi`, `status_transaksi`) VALUES
(65, 28, 21, 'ORGANIK', 2, '2020-07-20', 'SELESAI'),
(66, 28, 21, 'ORGANIK', 2, '2020-07-20', 'SELESAI'),
(67, 29, 21, 'ORGANIK', 2, '2020-07-20', 'BATAL'),
(68, 29, 21, 'ORGANIK', 3, '2020-07-20', 'BATAL'),
(69, 29, 21, 'ORGANIK', 2, '2020-07-20', 'BATAL'),
(70, 29, 21, 'ORGANIK', 1, '2020-07-20', 'BATAL'),
(71, 29, 21, 'ORGANIK', 2, '2020-07-20', 'SELESAI'),
(72, 29, 21, 'ORGANIK', 2, '2020-07-23', 'BATAL'),
(73, 31, 21, 'Organik', 10, '2020-07-24', 'BATAL'),
(74, 31, 21, 'ORGANIKANORGANIK', 10, '2020-07-24', 'BATAL'),
(75, 31, 21, 'ORGANIKANORGANIKORGANIK & ANORGANIK', 10, '2020-07-24', 'BATAL'),
(76, 31, 21, 'ORGANIK & ANORGANIK', 10, '2020-07-24', 'BATAL'),
(77, 31, 21, 'ORGANIK', 10, '2020-07-24', 'BATAL'),
(78, 31, 21, 'ANORGANIK', 10, '2020-07-24', 'BATAL'),
(79, 31, 21, 'ORGANIK & ANORGANIK', 10, '2020-07-24', 'BATAL'),
(80, 31, 21, 'ORGANIK', 10, '2020-07-24', 'BATAL'),
(81, 31, 21, 'ANORGANIK', 20, '2020-07-24', 'BATAL'),
(82, 31, 21, 'ANORGANIK', 8, '2020-07-24', 'BATAL'),
(83, 28, 21, 'ORGANIK & ANORGANIK', 2, '2020-07-25', 'SELESAI'),
(84, 28, 21, 'ORGANIK & ANORGANIK', 2, '2020-07-26', 'BATAL'),
(85, 28, 21, 'ORGANIK & ANORGANIK', 2, '2020-07-26', 'SELESAI');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tukarpoint`
--

CREATE TABLE `tb_tukarpoint` (
  `id_tukarpoint` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `jumlah_point` int(11) NOT NULL,
  `perlu_point` int(11) NOT NULL,
  `id_reward` int(11) NOT NULL,
  `tgl_tukarpoint` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tb_kurir`
--
ALTER TABLE `tb_kurir`
  ADD PRIMARY KEY (`id_kurir`);

--
-- Indexes for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `tb_point`
--
ALTER TABLE `tb_point`
  ADD PRIMARY KEY (`id_point`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `tb_reward`
--
ALTER TABLE `tb_reward`
  ADD PRIMARY KEY (`id_reward`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_kurir` (`id_kurir`);

--
-- Indexes for table `tb_tukarpoint`
--
ALTER TABLE `tb_tukarpoint`
  ADD PRIMARY KEY (`id_tukarpoint`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_reward` (`id_reward`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_kurir`
--
ALTER TABLE `tb_kurir`
  MODIFY `id_kurir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tb_point`
--
ALTER TABLE `tb_point`
  MODIFY `id_point` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tb_reward`
--
ALTER TABLE `tb_reward`
  MODIFY `id_reward` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `tb_tukarpoint`
--
ALTER TABLE `tb_tukarpoint`
  MODIFY `id_tukarpoint` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_point`
--
ALTER TABLE `tb_point`
  ADD CONSTRAINT `tb_point_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `tb_pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `tb_pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_transaksi_ibfk_2` FOREIGN KEY (`id_kurir`) REFERENCES `tb_kurir` (`id_kurir`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_tukarpoint`
--
ALTER TABLE `tb_tukarpoint`
  ADD CONSTRAINT `tb_tukarpoint_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `tb_pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_tukarpoint_ibfk_2` FOREIGN KEY (`id_reward`) REFERENCES `tb_reward` (`id_reward`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
