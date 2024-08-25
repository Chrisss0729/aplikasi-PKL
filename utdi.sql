-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 26, 2024 at 04:05 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `utdi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `kontak` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `username`, `password`, `nama`, `kontak`, `alamat`) VALUES
(0, 'admisi', 'c5ca56f5986311d30363182d8538ca16', 'admin', '', ''),
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'admin absen', 'admin@email.com', ''),
(2, 'oky', '123', 'OKYY', 'OKYY123@gmail.com', ''),
(7, 'amikom', 'a3e1100d6e60ffdac3c22044ae6518b7', 'AMIKOM ADMIN', 'amikom@gmail.com', ''),
(8, 'samsul', '202cb962ac59075b964b07152d234b70', 'samsul tzy', '0897', 'sident'),
(9, 'admisi', '202cb962ac59075b964b07152d234b70', 'admin', '088992842745', 'utdi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ijin`
--

CREATE TABLE `tb_ijin` (
  `id` int NOT NULL,
  `id_admin` int NOT NULL,
  `nis` int NOT NULL,
  `alasan` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_ijin`
--

INSERT INTO `tb_ijin` (`id`, `id_admin`, `nis`, `alasan`, `tanggal`) VALUES
(34, 0, 2112322, 'Sakit', '2023-03-06 07:00:00'),
(35, 0, 1123521, 'Batuk', '2023-03-06 07:00:00'),
(36, 0, 31130249, 'Mengikuti POPDA', '2023-03-07 07:00:00'),
(37, 0, 2123222, 'Sedang Tidak Enak Badan', '2023-03-09 07:00:00'),
(38, 0, 23, 'sakit', '2024-07-14 07:00:00'),
(39, 0, 2112322, 'Sakit', '2024-07-14 07:00:00'),
(40, 0, 213110007, 'sakit', '2024-07-21 00:00:00'),
(41, 0, 213110002, 'sakit', '2024-07-25 00:00:00'),
(42, 0, 213110001, 'pergi', '2024-07-24 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ip`
--

CREATE TABLE `tb_ip` (
  `id` int NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_ip`
--

INSERT INTO `tb_ip` (`id`, `ip`) VALUES
(1, '192.168.1.6');

-- --------------------------------------------------------

--
-- Table structure for table `tb_laporan`
--

CREATE TABLE `tb_laporan` (
  `id` bigint NOT NULL,
  `nis` bigint NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pengumpulan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_laporan`
--

INSERT INTO `tb_laporan` (`id`, `nis`, `file`, `pengumpulan`) VALUES
(1, 213110007, '213110007_cornelia anggry_laporan_240721043732.pdf', '2024-07-20 21:37:32'),
(2, 213110002, '213110002_BamAlfian_laporan_240721043803.pdf', '2024-07-20 21:38:03');

-- --------------------------------------------------------

--
-- Table structure for table `tb_presensi`
--

CREATE TABLE `tb_presensi` (
  `id_presensi` bigint NOT NULL,
  `nis` bigint NOT NULL,
  `masuk` datetime NOT NULL,
  `keluar` datetime DEFAULT NULL,
  `status` enum('hadir','telat') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_presensi`
--

INSERT INTO `tb_presensi` (`id_presensi`, `nis`, `masuk`, `keluar`, `status`) VALUES
(18, 213110007, '2024-07-21 22:00:21', '2024-07-21 22:00:28', 'telat'),
(19, 21311008, '2024-07-23 08:26:14', '0000-00-00 00:00:00', 'hadir'),
(20, 9765678, '2024-07-26 09:28:01', '2024-07-26 09:28:41', 'hadir');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sertifikat`
--

CREATE TABLE `tb_sertifikat` (
  `id` bigint NOT NULL,
  `id_admin` bigint NOT NULL,
  `id_pkl` bigint NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_sertifikat`
--

INSERT INTO `tb_sertifikat` (`id`, `id_admin`, `id_pkl`, `file`, `tanggal`) VALUES
(2, 9, 213110007, '213110007_sertifikat_20240721044928.png', '2024-07-20 21:49:28');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `NIS` int NOT NULL,
  `username` text COLLATE utf8mb4_general_ci NOT NULL,
  `password` text COLLATE utf8mb4_general_ci NOT NULL,
  `nama` text COLLATE utf8mb4_general_ci NOT NULL,
  `jurusan` text COLLATE utf8mb4_general_ci NOT NULL,
  `asal_sekolah` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`NIS`, `username`, `password`, `nama`, `jurusan`, `asal_sekolah`) VALUES
(1123521, 'anakpkl', '123', 'ANAK PKL', 'RPL', 'SMK N 1 WANAYASA'),
(2112322, 'zahra', '123', 'Mufidah Azzahra', 'RPL', 'SMK N 1 PEJAWARAN'),
(2123222, 'rahmat', '123', 'Rahmat', 'RPL', 'SMK N 1 PURWOKERTO'),
(3242145, 'Renny', '123', 'Reny Kartika Sari', 'RPL', 'SMK N 1 PEJAWARAN'),
(9765678, 'toro', '202cb962ac59075b964b07152d234b70', 'TORO', 'TKJ', 'SMK N 1 PURBALINGGA'),
(9890989, 'dirga', '123', 'Dirga Leksmana', 'TKJ', 'SMK N 1 WANAYASA'),
(21311008, 'cornelia08', '202cb962ac59075b964b07152d234b70', 'cornelia anggry', 'RPL', 'SMK N 3 Yk'),
(24145135, 'boo', '123', 'Boo', 'TKJ', 'SMK N 1 PURWOKERTO'),
(213110001, 'Amba01', '202cb962ac59075b964b07152d234b70', 'Ambalika', 'RPL', 'SMK N Taruna'),
(213110002, 'Bam12', '202cb962ac59075b964b07152d234b70', 'BamAlfian', 'RPL', 'SMK N Taruna'),
(213110006, 'Aisyah06', '202cb962ac59075b964b07152d234b70', 'Aisyah Fajri Syahnur', 'RPL', 'SMK N 1 YK'),
(213110007, 'cornelia07', '202cb962ac59075b964b07152d234b70', 'cornelia anggry', 'RPL', 'SMK N 5 YK');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tugas`
--

CREATE TABLE `tb_tugas` (
  `id_tugas` bigint NOT NULL,
  `nis` bigint NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengumpulan` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_tugas`
--

INSERT INTO `tb_tugas` (`id_tugas`, `nis`, `file`, `pengumpulan`) VALUES
(6, 213110007, '213110007_cornelia anggry_tugas_20240720034738.pdf', '2024-07-19 20:47:38'),
(7, 213110006, '213110006_Aisyah Fajri Syahnur_tugas_20240721025229.pdf', '2024-07-20 19:52:29'),
(8, 213110007, '213110007_cornelia anggry_tugas_20240721025256.pdf', '2024-07-20 19:52:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_ijin`
--
ALTER TABLE `tb_ijin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_ip`
--
ALTER TABLE `tb_ip`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_presensi`
--
ALTER TABLE `tb_presensi`
  ADD PRIMARY KEY (`id_presensi`);

--
-- Indexes for table `tb_sertifikat`
--
ALTER TABLE `tb_sertifikat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`NIS`);

--
-- Indexes for table `tb_tugas`
--
ALTER TABLE `tb_tugas`
  ADD PRIMARY KEY (`id_tugas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_ijin`
--
ALTER TABLE `tb_ijin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tb_ip`
--
ALTER TABLE `tb_ip`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_presensi`
--
ALTER TABLE `tb_presensi`
  MODIFY `id_presensi` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tb_sertifikat`
--
ALTER TABLE `tb_sertifikat`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_tugas`
--
ALTER TABLE `tb_tugas`
  MODIFY `id_tugas` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
