-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2018 at 06:42 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_peserta`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_skema`
--

CREATE TABLE `t_skema` (
  `id_skema` int(11) NOT NULL,
  `nama_skema` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_skema`
--

INSERT INTO `t_skema` (`id_skema`, `nama_skema`) VALUES
(1, 'Programming'),
(2, 'Multimedia'),
(3, 'Jaringan');

-- --------------------------------------------------------

--
-- Table structure for table `t_tempat_uji`
--

CREATE TABLE `t_tempat_uji` (
  `id_tempat_uji` int(11) NOT NULL,
  `tempat_uji` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_tempat_uji`
--

INSERT INTO `t_tempat_uji` (`id_tempat_uji`, `tempat_uji`) VALUES
(1, 'Jambi'),
(2, 'Jakarta');

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `id` int(5) NOT NULL,
  `name` varchar(60) NOT NULL,
  `nik` bigint(16) NOT NULL,
  `email` varchar(60) NOT NULL,
  `id_skema` int(2) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tgl_sertifikat` date NOT NULL,
  `id_tempat_uji` int(11) NOT NULL,
  `organisasi` varchar(99) NOT NULL,
  `rekomendasi` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id`, `name`, `nik`, `email`, `id_skema`, `phone`, `tgl_lahir`, `tgl_sertifikat`, `id_tempat_uji`, `organisasi`, `rekomendasi`) VALUES
(31, 'Lamhot Simamora', 1503082812930002, 'lamhotsimamora36@gmail.com', 1, '082289953600', '1993-12-28', '2017-08-08', 1, 'PMI', 'Kompeten'),
(34, 'Tigor Parulian', 1503082812932006, 'tigor@yahoo.com', 2, '0822123912313', '1993-02-01', '2015-04-04', 1, 'Pemuda Pancasila', 'Kompeten');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_display_user`
-- (See below for the actual view)
--
CREATE TABLE `view_display_user` (
`id` int(5)
,`name` varchar(60)
,`nik` bigint(16)
,`email` varchar(60)
,`id_skema` int(2)
,`phone` varchar(13)
,`tgl_lahir` date
,`tgl_sertifikat` date
,`id_tempat_uji` int(11)
,`organisasi` varchar(99)
,`rekomendasi` varchar(99)
,`tempat_uji` varchar(99)
,`nama_skema` varchar(25)
);

-- --------------------------------------------------------

--
-- Structure for view `view_display_user`
--
DROP TABLE IF EXISTS `view_display_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_display_user`  AS  select `t_user`.`id` AS `id`,`t_user`.`name` AS `name`,`t_user`.`nik` AS `nik`,`t_user`.`email` AS `email`,`t_user`.`id_skema` AS `id_skema`,`t_user`.`phone` AS `phone`,`t_user`.`tgl_lahir` AS `tgl_lahir`,`t_user`.`tgl_sertifikat` AS `tgl_sertifikat`,`t_user`.`id_tempat_uji` AS `id_tempat_uji`,`t_user`.`organisasi` AS `organisasi`,`t_user`.`rekomendasi` AS `rekomendasi`,`t_tempat_uji`.`tempat_uji` AS `tempat_uji`,`t_skema`.`nama_skema` AS `nama_skema` from ((`t_user` join `t_tempat_uji`) join `t_skema`) where ((`t_user`.`id_skema` = `t_skema`.`id_skema`) and (`t_user`.`id_tempat_uji` = `t_tempat_uji`.`id_tempat_uji`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_skema`
--
ALTER TABLE `t_skema`
  ADD PRIMARY KEY (`id_skema`);

--
-- Indexes for table `t_tempat_uji`
--
ALTER TABLE `t_tempat_uji`
  ADD PRIMARY KEY (`id_tempat_uji`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `NIK` (`nik`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_skema`
--
ALTER TABLE `t_skema`
  MODIFY `id_skema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_tempat_uji`
--
ALTER TABLE `t_tempat_uji`
  MODIFY `id_tempat_uji` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
