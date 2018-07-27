-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2018 at 10:42 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `testfrontend`
--

-- --------------------------------------------------------

--
-- Table structure for table `dt_siswa`
--

CREATE TABLE IF NOT EXISTS `dt_siswa` (
`id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `ulangtahun` date NOT NULL,
  `email` varchar(30) NOT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `tgl_insert` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `dt_siswa`
--

INSERT INTO `dt_siswa` (`id`, `nama`, `ulangtahun`, `email`, `alamat`, `is_active`, `tgl_insert`, `tgl_last_update`) VALUES
(1, 'siswa1', '2018-07-07', 'siswa1@gmail.com', 'Almt A', 1, '2018-01-15 13:43:36', '2018-07-27 07:52:41'),
(2, 'siswa2', '2018-07-27', 'siswa2@gmail.com', 'Almt B', 1, '2018-01-15 13:46:12', '2018-07-27 06:31:52'),
(3, 'siswa3', '2018-07-27', 'siswa3@gmail.com', 'Almt C', 1, '2018-01-15 13:46:16', '2018-07-27 06:31:52'),
(4, 'siswa4', '2018-07-27', 'siswa4@gmail.com', 'Almt D', 1, '2018-01-15 13:46:20', '2018-07-27 06:31:52'),
(5, 'siswa5', '2018-07-27', 'siswa5@gmail.com', 'Almt E', 1, '2018-01-15 13:46:25', '2018-07-27 06:31:52'),
(6, 'siswa6', '2018-07-27', 'siswa6@gmail.com', 'Almt F', 1, '2018-01-20 07:48:50', '2018-07-27 06:31:52'),
(7, 'siswa7', '2018-07-27', 'siswa7@gmail.com', 'Almt G', 1, '2018-01-22 03:56:23', '2018-07-27 06:31:52'),
(8, 'siswa8', '2018-07-27', 'siswa8@gmail.com', 'Malang', 1, '2018-04-08 07:07:01', '2018-07-27 06:47:02'),
(9, 'siswa9', '2018-07-27', 'siswa9@gmail.com', 'Jalan Aceh Barat no.47 RT.01 RW.22 Tajurhalang', 1, '2018-04-09 08:54:25', '2018-07-27 06:31:52'),
(10, 'siswa10', '2018-07-27', 'siswa10@gmail.com', 'Bogor', 1, '2018-05-09 13:51:03', '2018-07-27 06:31:52'),
(11, 'siswa11', '2018-07-27', 'siswa11@gmail.com', 'Alamat X', 1, '2018-05-25 03:25:42', '2018-07-27 06:31:52'),
(12, 'siswa12', '2018-07-27', 'siswa12@gmail.com', 'Bogor', 1, '2018-06-27 13:33:56', '2018-07-27 06:31:52'),
(13, 'siswa13', '2018-07-27', 'siswa13@gmail.com', 'Alamat Jihan', 1, '2018-06-28 01:07:12', '2018-07-27 06:31:52'),
(14, 'siswa14', '2018-07-27', 'siswa14@gmail.com', 'siswa14', 1, '2018-07-27 07:20:25', '2018-07-27 07:20:25');

-- --------------------------------------------------------

--
-- Table structure for table `sys_keys`
--

CREATE TABLE IF NOT EXISTS `sys_keys` (
`id` int(11) NOT NULL,
  `kunci` varchar(20) NOT NULL,
  `level` int(2) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `tgl_insert` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `sys_keys`
--

INSERT INTO `sys_keys` (`id`, `kunci`, `level`, `is_active`, `tgl_insert`, `tgl_last_update`) VALUES
(1, 'zsDKLYYdwFObexSSo8xA', 1, 1, '2018-01-15 13:39:54', '2018-01-15 13:41:19'),
(2, 'xWOS69X4f5cNpCJblcp4', 1, 1, '2018-01-15 13:39:54', '2018-01-15 13:41:41');

-- --------------------------------------------------------

--
-- Table structure for table `sys_users`
--

CREATE TABLE IF NOT EXISTS `sys_users` (
`id` int(11) NOT NULL,
  `nama` varchar(80) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(72) NOT NULL,
  `email` varchar(30) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `user_key` varchar(20) DEFAULT NULL COMMENT 'akses key untuk login',
  `level` int(1) NOT NULL DEFAULT '2',
  `is_active` int(1) NOT NULL DEFAULT '1',
  `tgl_insert` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `sys_users`
--

INSERT INTO `sys_users` (`id`, `nama`, `username`, `password`, `email`, `foto`, `user_key`, `level`, `is_active`, `tgl_insert`, `tgl_last_update`) VALUES
(1, 'Admin', 'admin1', '$2y$04$ZXp5c2Nob29sLSQyeSQxM.dVK46JRa4alvcfOarVLa.F593ohJOL.', 'admin1@gmail.com', '1|//image-pengguna/20180727/original/b53b3fab-68b4-e8dc-a897-8ac555f5f659.jpg', 'B3gFlJ2WcUumskLdQOEj', 1, 1, '2018-01-15 13:37:39', '2018-07-27 08:40:37'),
(2, 'Admin B', 'admin2', '$2y$04$ZXp5c2Nob29sLSQyeSQxM.IKm.5nG/R0HZSNh55xlalRph7HbEF9.', 'admin2@gmail.com', 'default.png', 'CAvqcL8NU0QJ1RlTDgVn', 1, 1, '2018-01-15 13:37:39', '2018-04-24 06:10:22'),
(3, 'Admin C', 'admin3', '$2y$04$ZXp5c2Nob29sLSQyeSQxM.IKm.5nG/R0HZSNh55xlalRph7HbEF9.', 'admin3@gmail.com', 'default.png', 'M6L8Zs9VKakhd3JYQfoe', 1, 1, '2018-01-15 13:37:39', '2018-04-24 06:10:22'),
(4, 'Admin D', 'admin4', '$2y$04$ZXp5c2Nob29sLSQyeSQxM.IKm.5nG/R0HZSNh55xlalRph7HbEF9.', 'admin4@gmail.com', 'default.png', 'M0JuxLdoBIyYkgeH7SN8', 1, 1, '2018-01-15 13:37:39', '2018-04-24 06:10:22'),
(5, 'Admin E', 'admin5', '$2y$04$ZXp5c2Nob29sLSQyeSQxM.IKm.5nG/R0HZSNh55xlalRph7HbEF9.', 'admin5@gmail.com', 'default.png', 'YGK1jkPNof3shaqn2Ig5', 1, 1, '2018-01-15 13:37:39', '2018-04-24 06:10:22'),
(10, 'Siswa', 'siswa', '$2y$04$ZXp5c2Nob29sLSQyeSQxM.dVK46JRa4alvcfOarVLa.F593ohJOL.', 'siswa@gmail.com', '1|//image-pengguna/20180131/original/4993a376-59ee-22ff-eb74-0ef7310cb288.jpg', 'nh0ajqglfwMZc3S5QIVC', 2, 1, '2018-01-15 13:37:39', '2018-04-25 04:55:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dt_siswa`
--
ALTER TABLE `dt_siswa`
 ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sys_keys`
--
ALTER TABLE `sys_keys`
 ADD PRIMARY KEY (`id`) USING BTREE, ADD KEY `id` (`id`) USING BTREE, ADD KEY `key` (`kunci`) USING BTREE, ADD KEY `level` (`level`) USING BTREE, ADD FULLTEXT KEY `Fulltext` (`kunci`);

--
-- Indexes for table `sys_users`
--
ALTER TABLE `sys_users`
 ADD PRIMARY KEY (`id`) USING BTREE, ADD UNIQUE KEY `username` (`username`) USING BTREE, ADD KEY `id` (`id`) USING BTREE, ADD KEY `user_key` (`user_key`) USING BTREE, ADD KEY `is_active` (`is_active`) USING BTREE, ADD FULLTEXT KEY `Fulltext` (`nama`,`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dt_siswa`
--
ALTER TABLE `dt_siswa`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `sys_keys`
--
ALTER TABLE `sys_keys`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sys_users`
--
ALTER TABLE `sys_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
