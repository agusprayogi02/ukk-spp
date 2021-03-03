-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 03, 2021 at 03:01 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spp`
--

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `kopetensi_keahlian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `kopetensi_keahlian`) VALUES
(6, '12', 'RPL 2'),
(7, '11', 'RPL 2'),
(8, '10', 'RPL 2'),
(9, '10', 'TKJ 1'),
(10, '10', 'TKR 1'),
(11, '12', 'TKJ 1'),
(12, '12', 'TEI 1');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `nisn` char(10) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `bulan_dibayar` varchar(8) NOT NULL,
  `tahun_dibayar` varchar(4) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_petugas`, `nisn`, `tgl_bayar`, `bulan_dibayar`, `tahun_dibayar`, `id_spp`, `jumlah_bayar`) VALUES
(3, 1, '0026511951', '2021-03-02', '03', '2018', 1, 240000),
(4, 1, '0026511951', '2021-03-02', '04', '2018', 1, 240000),
(5, 1, '0026511951', '2021-03-02', '01', '2019', 2, 250000),
(6, 1, '0026511951', '2021-03-02', '04', '2019', 2, 250000),
(7, 5, '0026511949', '2021-03-02', '03', '2019', 2, 250000),
(8, 5, '0026511949', '2021-03-02', '03', '2018', 1, 240000),
(10, 1, '0026511951', '2021-03-02', '02', '2019', 2, 250000),
(11, 1, '0026511951', '2021-03-02', '03', '2019', 2, 250000),
(12, 1, '0026511951', '2021-03-02', '02', '2019', 2, 250000),
(13, 1, '0026511951', '2021-03-02', '03', '2019', 2, 250000),
(14, 1, '0026511951', '2021-03-02', '02', '2019', 2, 250000),
(15, 1, '0026511951', '2021-03-02', '03', '2019', 2, 250000),
(16, 1, '0026511951', '2021-03-02', '02', '2019', 2, 250000),
(17, 1, '0026511951', '2021-03-02', '03', '2019', 2, 250000),
(18, 1, '0026511949', '2021-03-02', '02', '2018', 1, 240000),
(19, 1, '0026511949', '2021-03-02', '04', '2018', 1, 240000),
(20, 5, '0026511949', '2021-03-02', '11', '2018', 1, 240000),
(21, 5, '0026511949', '2021-03-02', '12', '2018', 1, 240000),
(22, 5, '0026511949', '2021-03-02', '11', '2019', 2, 250000),
(23, 5, '0026511949', '2021-03-02', '12', '2019', 2, 250000);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `level` enum('admin','petugas','siswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `username`, `password`, `nama_petugas`, `level`) VALUES
(1, 'agus', '21232f297a57a5a743894a0e4a801fc3', 'Agus Prayogi', 'admin'),
(2, '0026511951', '195df8cac7cea2376a0ec6ca6212ecd7', 'Agus Prayogi', 'siswa'),
(3, '0026511949', 'ab01c977c622379d7f7b8d990a6a49ef', 'Adi Saputra', 'siswa'),
(5, 'petugas', 'afb91ef692fd08c445e8cb1bab2ccf9c', 'aku', 'petugas'),
(6, '0026511954', 'ab01c977c622379d7f7b8d990a6a49ef', 'Alfani Rahma', 'siswa'),
(7, '0026511956', 'b440e511b3bccdf30b5f76e4c89917de', 'Adinda Winson Susanti', 'siswa'),
(8, 'hari', 'a9bcf1e4d7b95a22e2975c812d938889', 'Harianto', 'petugas'),
(9, '0026511940', 'ab01c977c622379d7f7b8d990a6a49ef', 'Anisa', 'siswa'),
(10, '0026511930', 'e410326449d21b1c12460c67d088e883', 'Agung', 'siswa'),
(11, '0026511871', '6aff21120ad9f1df5d16579216c89146', 'Helna Kurniawati', 'siswa'),
(12, '00265117881', '8c38c473cb6bcfaa7ab143d629cec981', 'Uul Citra sari', 'siswa'),
(13, '002651120', '04e98ac942395fbdcf26b94ade30e6be', 'Hendrik', 'siswa'),
(14, '0026511098', 'cd4220f40a56682eeb3a7a800cc097f5', 'Aldi', 'siswa'),
(15, '003651108824', '9cc224fe943044fc587f11d14a872dbc', 'Irvan', 'siswa'),
(16, '0026592342', '4daa0f105eefcd6199bad658179a9bfe', 'Saidi Al-autad', 'siswa'),
(17, '0026511952', '2271d42598bea6a17b56869be8785ea1', 'Fikri', 'siswa'),
(18, 'herman', 'a1a6907c989946085b0e35493786fce3', 'herman As', 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nisn` char(10) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `id_spp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nisn`, `nama`, `id_kelas`, `alamat`, `no_telp`, `id_spp`) VALUES
('0026511098', 'Aldi', 6, 'kepanjen', '08173224214', 1),
('002651120', 'Hendrik', 12, 'Ngelewong', '08773424229', 2),
('0026511871', 'Helna Kurniawati', 6, 'Jenggolo', '087734242143', 1),
('0026511930', 'Agung', 9, 'Kebon Agung', '08723624101', 3),
('0026511940', 'Anisa', 8, 'Kebon Agung', '08723624141', 2),
('0026511949', 'Adi Saputra', 6, 'Cempokomulyo', '08723624141', 1),
('0026511951', 'Agus Prayogi', 6, 'Kebobang', '087734243221', 1),
('0026511952', 'Fikri', 6, 'Cempokomulyo', '0812345678', 1),
('0026511954', 'Alfani Rahma', 6, 'Kromengan', '08723624141', 2),
('0026511956', 'Adinda Winson Susanti', 6, 'Kromengan', '08773424', 1),
('0026592342', 'Saidi Al-autad', 6, 'Kedung Pedaringan', '087239424202', 2);

-- --------------------------------------------------------

--
-- Table structure for table `spp`
--

CREATE TABLE `spp` (
  `id_spp` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spp`
--

INSERT INTO `spp` (`id_spp`, `tahun`, `nominal`) VALUES
(1, 2018, 240000),
(2, 2019, 250000),
(3, 2020, 150000),
(6, 2021, 110000),
(7, 2017, 230000),
(8, 2016, 220000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_spp` (`id_spp`),
  ADD KEY `nisn` (`nisn`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `id_pembayaran` (`id_pembayaran`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD UNIQUE KEY `nisn_2` (`nisn`),
  ADD KEY `id_spp` (`id_spp`),
  ADD KEY `nisn` (`nisn`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`id_spp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `spp`
--
ALTER TABLE `spp`
  MODIFY `id_spp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`nisn`) REFERENCES `siswa` (`nisn`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pembayaran_ibfk_3` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`id_petugas`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pembayaran_ibfk_4` FOREIGN KEY (`id_spp`) REFERENCES `spp` (`id_spp`) ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_ibfk_3` FOREIGN KEY (`id_spp`) REFERENCES `spp` (`id_spp`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
