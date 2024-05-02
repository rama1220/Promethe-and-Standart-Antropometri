-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2023 at 04:02 AM
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
-- Database: `spk_prometheci`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nidn` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `prodi` enum('SI','TI') NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nidn`, `nama`, `prodi`, `jenis_kelamin`) VALUES
('554545', 'ghghgh', 'TI', 'Laki - Laki'),
('67676', 'ghghgh', 'TI', 'Laki - Laki'),
('6767676', 'ghghgh', 'TI', 'Laki - Laki'),
('67676767', 'hgjhjhj', 'SI', 'Laki - Laki');

-- --------------------------------------------------------

--
-- Table structure for table `dosen_subkriteria`
--

CREATE TABLE `dosen_subkriteria` (
  `id` int(11) NOT NULL,
  `nidn` varchar(20) NOT NULL,
  `id_subkriteria` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen_subkriteria`
--

INSERT INTO `dosen_subkriteria` (`id`, `nidn`, `id_subkriteria`, `value`, `periode`) VALUES
(464, '67676767', 15, 0, 1),
(465, '67676767', 16, 0, 1),
(466, '67676767', 27, 0, 1),
(467, '67676767', 31, 0, 1),
(468, '67676767', 40, 0, 1),
(469, '67676767', 20, 2, 1),
(470, '67676767', 21, 0, 1),
(471, '67676767', 22, 2, 1),
(472, '67676767', 44, 0, 1),
(473, '67676767', 38, 0, 1),
(484, '6767676', 37, 0, 1),
(485, '6767676', 33, 0, 1),
(486, '6767676', 30, 0, 1),
(487, '6767676', 32, 0, 1),
(488, '6767676', 41, 0, 1),
(489, '6767676', 20, 1, 1),
(490, '6767676', 42, 0, 1),
(491, '6767676', 22, 1, 1),
(492, '6767676', 45, 0, 1),
(493, '6767676', 39, 0, 1),
(494, '67676', 35, 0, 0),
(495, '67676', 16, 0, 0),
(496, '67676', 28, 0, 0),
(497, '67676', 31, 0, 0),
(498, '67676', 40, 0, 0),
(499, '67676', 20, 1, 0),
(500, '67676', 42, 0, 0),
(501, '67676', 22, 1, 0),
(502, '67676', 44, 0, 0),
(503, '67676', 38, 0, 0),
(504, '554545', 35, 0, 1),
(505, '554545', 16, 0, 1),
(506, '554545', 29, 0, 1),
(507, '554545', 31, 0, 1),
(508, '554545', 40, 0, 1),
(509, '554545', 20, 1, 1),
(510, '554545', 42, 0, 1),
(511, '554545', 22, 1, 1),
(512, '554545', 44, 0, 1),
(513, '554545', 38, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_seleksi`
--

CREATE TABLE `hasil_seleksi` (
  `id` int(11) NOT NULL,
  `nilai` float NOT NULL,
  `nidn` varchar(20) NOT NULL,
  `periode` int(11) NOT NULL,
  `prodi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil_seleksi`
--

INSERT INTO `hasil_seleksi` (`id`, `nilai`, `nidn`, `periode`, `prodi`) VALUES
(92, 0.075, '061234515', 2, 'TI'),
(93, -0.05, '06123457', 2, 'TI'),
(97, 0.1, '06123456', 1, 'TI'),
(98, -0.15, '06123457', 1, 'TI'),
(99, -0.15, '06123458', 1, 'TI'),
(100, -0.025, '06123459', 1, 'TI'),
(101, 0.225, '061234510', 1, 'TI'),
(103, -0.05, '06123458', 2, 'TI'),
(104, 0.025, '06123459', 2, 'TI'),
(105, 0.0583333, '06123456', 0, 'TI'),
(106, -0.191667, '06123457', 0, 'TI'),
(107, -0.175, '06123458', 0, 'TI'),
(108, -0.05, '06123459', 0, 'TI'),
(109, 0.175, '061234510', 0, 'TI'),
(110, 0.175, '061234516', 0, 'TI'),
(111, 0.00833333, '061234513', 0, 'TI'),
(112, -0.1, '06123458', 0, 'TI'),
(113, 0.1, '06123459', 0, 'TI'),
(114, -0.15, '06123458', 0, 'TI'),
(115, 0, '06123459', 0, 'TI'),
(116, 0.15, '34343', 0, 'TI'),
(117, -0.15, '06123458', 0, 'TI'),
(118, 0, '06123459', 0, 'TI'),
(119, 0.15, '34343', 0, 'TI'),
(120, -0.15, '06123458', 0, 'TI'),
(121, 0, '06123459', 0, 'TI'),
(122, 0.15, '34343', 0, 'TI'),
(123, -0.1, '06123458', 0, 'TI'),
(124, 0.1, '06123459', 0, 'TI'),
(125, -0.1, '06123458', 0, 'TI'),
(126, 0, '06123459', 0, 'TI'),
(127, 0.1, '232323', 0, 'TI'),
(128, -0.15, '06123458', 0, 'TI'),
(129, 0, '06123459', 0, 'TI'),
(130, 0.15, '34343', 0, 'TI'),
(131, 0, '4565465656', 0, 'TI'),
(132, 0, '67676767', 0, 'TI'),
(133, 0.125, '4565465656', 0, 'TI'),
(134, -0.275, '6767676', 0, 'TI'),
(135, 0.15, '67676767', 0, 'TI'),
(136, 0.125, '4565465656', 0, 'TI'),
(137, -0.275, '6767676', 0, 'TI'),
(138, 0.15, '67676767', 0, 'TI'),
(139, 0.15, '554545', 0, 'TI'),
(140, -0.3, '6767676', 0, 'TI'),
(141, 0.15, '67676767', 0, 'TI');

-- --------------------------------------------------------

--
-- Table structure for table `input_parameter`
--

CREATE TABLE `input_parameter` (
  `id` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `tipe` int(11) NOT NULL,
  `q` float NOT NULL,
  `p` float NOT NULL,
  `periode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `input_parameter`
--

INSERT INTO `input_parameter` (`id`, `id_kriteria`, `tipe`, `q`, `p`, `periode`) VALUES
(181, 21, 1, 0, 0, 2),
(182, 22, 1, 0, 0, 2),
(183, 23, 1, 0, 0, 2),
(184, 24, 0, 1, 0.5, 2),
(185, 25, 2, 0, 1, 2),
(186, 26, 1, 0, 0, 2),
(187, 27, 1, 0, 0, 2),
(188, 28, 1, 0, 0, 2),
(189, 29, 0, 3, 1, 2),
(190, 30, 1, 0, 0, 2),
(201, 21, 1, 0, 0, 1),
(202, 22, 1, 0, 0, 1),
(203, 23, 1, 0, 0, 1),
(204, 24, 2, 1, 0, 1),
(205, 25, 2, 1, 0, 1),
(206, 26, 4, 0.5, 1, 1),
(207, 27, 1, 0, 0, 1),
(208, 28, 1, 0, 0, 1),
(209, 29, 2, 1, 0, 1),
(210, 30, 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `bobot` float NOT NULL,
  `jenis` varchar(10) NOT NULL,
  `simbol` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `nama`, `bobot`, `jenis`, `simbol`) VALUES
(21, 'Nilai Rata-Rata Kuesioner mahasiswa', 0.05, 'MAX', 'X1'),
(22, 'Kesesuaian RPP', 0, 'MAX', 'X2'),
(23, 'Kedisiplinan jumlah kehadiran', 0.1, 'MAX', 'X3'),
(24, 'Kedisiplinan pengumpulan berkas soal dan nilai', 0.125, 'MAX', 'X4'),
(25, 'Penelitian', 0.1, 'MAX', 'X5'),
(26, 'Pengabdian', 0.125, 'MAX', 'X6'),
(27, 'Penulisan artikel ilmiah', 0.1, 'MAX', 'X7'),
(28, 'Penyusunan modul', 0.125, 'MAX', 'X8'),
(29, 'Penyusunan buku', 0.1, 'MAX', 'X9'),
(30, 'Pembicara seminar', 0.125, 'MAX', 'X10');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(15) NOT NULL,
  `prodi` enum('SI','TI') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `email`, `username`, `password`, `level`, `prodi`) VALUES
(1, 'Kasep_Code', 'zaenur.rochman98@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'superadmin', 'TI'),
(4, 'Zaenur Rochman', 'zaenur.rochman98@gmail.com', 'admin TI', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'TI'),
(5, 'Zaenur Rochman', 'zaenur.rochman98@gmail.com', 'admin SI', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'SI');

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id`, `nama`, `keterangan`) VALUES
(1, '2021/2022', 'Ganjil'),
(2, '2022/2023', 'Genap');

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

CREATE TABLE `subkriteria` (
  `id` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`id`, `id_kriteria`, `nama`, `bobot`) VALUES
(15, 21, 'Rata-rata 80-100', 4),
(16, 22, 'Sesuai', 4),
(19, 25, 'Penelitian Internasional', 4),
(20, 26, 'input', 0),
(21, 27, 'Jurnal Internasional', 4),
(22, 28, 'input', 0),
(23, 29, 'Buku Penerbit Internasional', 4),
(24, 30, 'Pembicara Seminar Internasional', 4),
(26, 23, 'Rata-rata 80-100', 4),
(27, 23, 'Rata-rata 70-79', 3),
(28, 23, 'Rata-rata 60-69', 2),
(29, 23, 'Rata-rata 50-59', 1),
(30, 23, 'Rata-rata < 50', 0),
(31, 24, 'Disiplin', 4),
(32, 24, 'Tidak Disiplin', 1),
(33, 22, 'Tidak Sesuai', 1),
(34, 21, 'Rata-rata 70-79', 3),
(35, 21, 'Rata-rata 60-69', 2),
(36, 21, 'Rata-rata 50-59', 1),
(37, 21, 'Rata-rata < 50', 0),
(38, 30, 'Pembicara Seminar Nasional', 3),
(39, 30, 'Tidak Ada', 1),
(40, 25, 'Penelitian Nasional', 3),
(41, 25, 'Tidak ada penelitian', 1),
(42, 27, 'Jurnal Nasional', 3),
(43, 27, 'Tidak ada karya ilmiah', 1),
(44, 29, 'Buku Penerbit Nasional', 3),
(45, 29, 'Tidak ada penyusunan', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nidn`);

--
-- Indexes for table `dosen_subkriteria`
--
ALTER TABLE `dosen_subkriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_calon_subkriteria` (`nidn`),
  ADD KEY `fk_subkriteria_calon` (`id_subkriteria`);

--
-- Indexes for table `hasil_seleksi`
--
ALTER TABLE `hasil_seleksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `input_parameter`
--
ALTER TABLE `input_parameter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_subkriteria` (`id_kriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen_subkriteria`
--
ALTER TABLE `dosen_subkriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=514;

--
-- AUTO_INCREMENT for table `hasil_seleksi`
--
ALTER TABLE `hasil_seleksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `input_parameter`
--
ALTER TABLE `input_parameter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen_subkriteria`
--
ALTER TABLE `dosen_subkriteria`
  ADD CONSTRAINT `fk_calon_subkriteria` FOREIGN KEY (`nidn`) REFERENCES `dosen` (`nidn`),
  ADD CONSTRAINT `fk_subkriteria_calon` FOREIGN KEY (`id_subkriteria`) REFERENCES `subkriteria` (`id`);

--
-- Constraints for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD CONSTRAINT `fk_subkriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
