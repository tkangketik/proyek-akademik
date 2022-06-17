-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 17, 2022 at 04:50 PM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyek_akademik`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail`
--

CREATE TABLE `detail` (
  `id_det` int(11) NOT NULL,
  `NomorResep` int(11) NOT NULL,
  `KodeObat` int(11) NOT NULL,
  `Jumlah` int(11) NOT NULL,
  `Dosis` text NOT NULL,
  `SubTotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail`
--

INSERT INTO `detail` (`id_det`, `NomorResep`, `KodeObat`, `Jumlah`, `Dosis`, `SubTotal`) VALUES
(2, 1, 1, 4, '1x3', 30000),
(3, 1, 2, 6, '3x1', 30000),
(4, 1, 3, 4, '2x1', 48000),
(5, 2, 1, 1, '3', 7500);

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `KodeDkt` int(11) NOT NULL,
  `NamaDkt` varchar(25) NOT NULL,
  `Spesialis` varchar(35) NOT NULL,
  `AlamatDkt` text NOT NULL,
  `TeleponDkt` int(13) NOT NULL,
  `KodePlk` int(11) NOT NULL,
  `Tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`KodeDkt`, `NamaDkt`, `Spesialis`, `AlamatDkt`, `TeleponDkt`, `KodePlk`, `Tarif`) VALUES
(2, 'Yuliana', 'umum', 'trini', 2147483647, 1, 100000);

-- --------------------------------------------------------

--
-- Table structure for table `enkripsi`
--

CREATE TABLE `enkripsi` (
  `id` int(11) NOT NULL,
  `KodePsn` int(11) NOT NULL,
  `hasil` text NOT NULL,
  `kunci` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `req` varchar(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enkripsi`
--

INSERT INTO `enkripsi` (`id`, `KodePsn`, `hasil`, `kunci`, `status`, `req`) VALUES
(5, 3, 'SDUDFHWDPRO', '11111', 1, '1'),
(7, 2, 'RLMLE', '12345', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `online` enum('true','false') NOT NULL DEFAULT 'false',
  `status` enum('active','non active') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `username`, `password`, `online`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'true', 'active'),
(2, 'lili', '827ccb0eea8a706c4c34a16891f84e7b', 'false', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `KodeObat` int(11) NOT NULL,
  `NamaObat` varchar(25) NOT NULL,
  `JenisObat` varchar(25) NOT NULL,
  `Kategori` text NOT NULL,
  `HargaObat` int(11) NOT NULL,
  `JumlahObat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`KodeObat`, `NamaObat`, `JenisObat`, `Kategori`, `HargaObat`, `JumlahObat`) VALUES
(1, 'Paracetamol', 'Tablet', 'Obat Bebas', 7500, 94),
(2, 'Amoxicillin', 'Pil', 'Obat Bebas Terbatas', 5000, 193),
(3, 'Antibiotik', 'Pil', 'Obat Bebas Terbatas', 12000, 146),
(4, 'Antijamur', 'Salep', 'Obat Bebas', 17000, 100);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `KodePsn` int(11) NOT NULL,
  `NamaPsn` varchar(50) NOT NULL,
  `AlamatPsn` text NOT NULL,
  `GenderPsn` enum('Laki-Laki','Perempuan') NOT NULL,
  `TanggalLahir` date NOT NULL,
  `TeleponPsn` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`KodePsn`, `NamaPsn`, `AlamatPsn`, `GenderPsn`, `TanggalLahir`, `TeleponPsn`) VALUES
(2, 'heri', 'trini', 'Laki-Laki', '1977-07-03', 2147483647),
(3, 'anggi', 'trini ', 'Perempuan', '2000-08-22', 2147483647),
(4, 'umar', 'haisdha', 'Laki-Laki', '1999-07-31', 12313);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `NomorByr` int(11) NOT NULL,
  `NomorPendf` int(11) NOT NULL,
  `TanggalByr` date NOT NULL,
  `JumlahByr` int(11) NOT NULL,
  `bayar` text NOT NULL,
  `kembali` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`NomorByr`, `NomorPendf`, `TanggalByr`, `JumlahByr`, `bayar`, `kembali`) VALUES
(1, 2, '2022-04-07', 150000, '200000', '50000');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `NomorPendf` int(11) NOT NULL,
  `TanggalPendf` date NOT NULL,
  `KodeDkt` int(11) NOT NULL,
  `KodePsn` int(11) NOT NULL,
  `KodePlk` int(11) NOT NULL,
  `Biaya` int(11) NOT NULL DEFAULT '50000',
  `Ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendaftaran`
--

INSERT INTO `pendaftaran` (`NomorPendf`, `TanggalPendf`, `KodeDkt`, `KodePsn`, `KodePlk`, `Biaya`, `Ket`) VALUES
(2, '2022-04-07', 2, 2, 1, 50000, 'Rawat Jalan'),
(3, '2022-04-08', 2, 3, 1, 50000, 'Rawat Jalan');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `Uid` int(11) NOT NULL,
  `id_login` int(11) NOT NULL,
  `NamaUser` varchar(25) NOT NULL,
  `AlamatUser` text NOT NULL,
  `GenderUser` enum('Laki-Laki','Perempuan') NOT NULL,
  `TelpUser` varchar(15) NOT NULL,
  `Level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Login Table';

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`Uid`, `id_login`, `NamaUser`, `AlamatUser`, `GenderUser`, `TelpUser`, `Level`) VALUES
(1, 1, 'Admin', '-', 'Laki-Laki', '911', 0),
(2, 2, 'lili', 'trini', 'Perempuan', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `poliklinik`
--

CREATE TABLE `poliklinik` (
  `KodePlk` int(11) NOT NULL,
  `NamaPlk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poliklinik`
--

INSERT INTO `poliklinik` (`KodePlk`, `NamaPlk`) VALUES
(1, 'umum');

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE `resep` (
  `NomorResep` int(11) NOT NULL,
  `TanggalResep` date NOT NULL,
  `KodeDkt` int(11) NOT NULL,
  `KodePsn` int(11) NOT NULL,
  `KodePlk` int(11) NOT NULL,
  `TotalHarga` int(11) NOT NULL,
  `Bayar` int(11) NOT NULL,
  `Kembali` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resep`
--

INSERT INTO `resep` (`NomorResep`, `TanggalResep`, `KodeDkt`, `KodePsn`, `KodePlk`, `TotalHarga`, `Bayar`, `Kembali`) VALUES
(1, '2022-04-07', 2, 2, 1, 108000, 150000, 42000),
(2, '2022-05-26', 2, 3, 1, 7500, 8000, 500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id_det`),
  ADD KEY `KodeObat` (`KodeObat`),
  ADD KEY `NomorResep` (`NomorResep`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`KodeDkt`),
  ADD KEY `KodePlk` (`KodePlk`);

--
-- Indexes for table `enkripsi`
--
ALTER TABLE `enkripsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `KodePsn` (`KodePsn`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`KodeObat`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`KodePsn`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`NomorByr`),
  ADD KEY `NomorPendf` (`NomorPendf`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`NomorPendf`),
  ADD KEY `KodeDkt` (`KodeDkt`,`KodePsn`,`KodePlk`),
  ADD KEY `KodePsn` (`KodePsn`),
  ADD KEY `KodePlk` (`KodePlk`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`Uid`),
  ADD KEY `id_login` (`id_login`);

--
-- Indexes for table `poliklinik`
--
ALTER TABLE `poliklinik`
  ADD PRIMARY KEY (`KodePlk`);

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`NomorResep`),
  ADD KEY `KodeDkt` (`KodeDkt`,`KodePsn`,`KodePlk`),
  ADD KEY `KodePlk` (`KodePlk`),
  ADD KEY `KodePsn` (`KodePsn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail`
--
ALTER TABLE `detail`
  MODIFY `id_det` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `KodeDkt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enkripsi`
--
ALTER TABLE `enkripsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `KodeObat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `KodePsn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `NomorByr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `NomorPendf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `Uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `poliklinik`
--
ALTER TABLE `poliklinik`
  MODIFY `KodePlk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail`
--
ALTER TABLE `detail`
  ADD CONSTRAINT `detail_ibfk_1` FOREIGN KEY (`NomorResep`) REFERENCES `resep` (`NomorResep`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_ibfk_2` FOREIGN KEY (`KodeObat`) REFERENCES `obat` (`KodeObat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `dokter_ibfk_1` FOREIGN KEY (`KodePlk`) REFERENCES `poliklinik` (`KodePlk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enkripsi`
--
ALTER TABLE `enkripsi`
  ADD CONSTRAINT `enkripsi_ibfk_1` FOREIGN KEY (`KodePsn`) REFERENCES `pasien` (`KodePsn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`NomorPendf`) REFERENCES `pendaftaran` (`NomorPendf`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_ibfk_2` FOREIGN KEY (`KodeDkt`) REFERENCES `dokter` (`KodeDkt`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pendaftaran_ibfk_3` FOREIGN KEY (`KodePlk`) REFERENCES `poliklinik` (`KodePlk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pendaftaran_ibfk_4` FOREIGN KEY (`KodePsn`) REFERENCES `pasien` (`KodePsn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_ibfk_1` FOREIGN KEY (`id_login`) REFERENCES `login` (`id_login`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resep`
--
ALTER TABLE `resep`
  ADD CONSTRAINT `resep_ibfk_2` FOREIGN KEY (`KodePlk`) REFERENCES `poliklinik` (`KodePlk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resep_ibfk_4` FOREIGN KEY (`KodeDkt`) REFERENCES `dokter` (`KodeDkt`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resep_ibfk_5` FOREIGN KEY (`KodePsn`) REFERENCES `pasien` (`KodePsn`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
