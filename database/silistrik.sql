-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2024 at 02:29 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `silistrik`
--

-- --------------------------------------------------------

--
-- Table structure for table `agen`
--

CREATE TABLE `agen` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `jk` varchar(45) DEFAULT NULL,
  `telp` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agen`
--

INSERT INTO `agen` (`id`, `nama`, `jk`, `telp`, `username`, `password`) VALUES
(1, 'Agen PPOB', 'L', '0852746395', 'agen', '12345678');

-- --------------------------------------------------------

--
-- Stand-in structure for view `bbayar`
-- (See below for the actual view)
--
CREATE TABLE `bbayar` (
`kd_pelanggan` varchar(45)
,`no_meter` varchar(45)
,`nama` varchar(45)
,`alamat` text
,`kd_tarif` varchar(45)
,`tenggang_waktu` int(11)
,`kd_tagihan` varchar(45)
,`jumlah_meter` int(11)
,`total_tagihan` int(11)
,`bulan` varchar(45)
);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `kd_pelanggan` varchar(45) NOT NULL,
  `no_meter` varchar(45) DEFAULT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `alamat` text,
  `kd_tarif` varchar(45) NOT NULL,
  `tenggang_waktu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`kd_pelanggan`, `no_meter`, `nama`, `alamat`, `kd_tarif`, `tenggang_waktu`) VALUES
('PEL00001', '31012018145201', 'novan', 'Bogor', 'TAR00003', 19),
('PEL00002', '30012018145201', 'syubi', 'Bandung', 'TAR00003', 20);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pemasukan`
-- (See below for the actual view)
--
CREATE TABLE `pemasukan` (
`kd_tagihan` varchar(45)
,`kd_penggunaan` varchar(45)
,`kd_pelanggan` varchar(45)
,`bulan` varchar(45)
,`tahun` varchar(45)
,`jumlah_meter` int(11)
,`total_tagihan` int(11)
,`status` int(1)
,`nama` varchar(45)
);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `kd_bayar` varchar(45) NOT NULL,
  `kd_pelanggan` varchar(45) NOT NULL,
  `kd_penggunaan` varchar(45) NOT NULL,
  `tanggal` date NOT NULL,
  `bulan_bayar` varchar(45) NOT NULL,
  `biaya_admin` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `agen` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`kd_bayar`, `kd_pelanggan`, `kd_penggunaan`, `tanggal`, `bulan_bayar`, `biaya_admin`, `total`, `bayar`, `kembalian`, `agen`) VALUES
('BYR20180203024800', 'PEL00002', 'PGN00001', '2018-02-03', 'Feb', 5000, 151700, 152000, 300, 'Deka'),
('BYR20180204023214', 'PEL00010', 'PGN00010', '2018-02-04', 'Feb', 5000, 151700, 152000, 300, 'Shocky'),
('BYR20180204023312', 'PEL00010', 'PGN00025', '2018-02-04', 'Feb', 5000, 225050, 230000, 4950, 'Shocky'),
('BYR20180204024800', 'PEL00001', 'PGN00002', '2018-02-04', 'Feb', 5000, 151700, 152000, 300, 'Rudi'),
('BYR20180204024854', 'PEL00001', 'PGN00016', '2018-02-04', 'Feb', 5000, 151700, 152000, 300, 'Rudi'),
('BYR20180204025034', 'PEL00002', 'PGN00017', '2018-02-04', 'Feb', 5000, 159035, 160000, 965, 'Rudi'),
('BYR20180204025203', 'PEL00003', 'PGN00003', '2018-02-04', 'Feb', 5000, 34300, 40000, 5700, 'Rudi'),
('BYR20180204025441', 'PEL00003', 'PGN00018', '2018-02-04', 'Feb', 5000, 46020, 50000, 3980, 'Rudi'),
('BYR20180204025544', 'PEL00004', 'PGN00004', '2018-02-04', 'Feb', 5000, 25750, 30000, 4250, 'Rudi'),
('BYR20180204025731', 'PEL00004', 'PGN00019', '2018-02-04', 'Feb', 5000, 46500, 50000, 3500, 'Rudi'),
('BYR20180204030503', 'PEL00005', 'PGN00005', '2018-02-04', 'Feb', 5000, 78350, 80000, 1650, 'Rudi'),
('BYR20180204030913', 'PEL00005', 'PGN00020', '2018-02-04', 'Feb', 5000, 151700, 152000, 300, 'Rudi'),
('BYR20180204040301', 'PEL00022', 'PGN00026', '2018-02-04', 'Feb', 5000, 5586, 5586, 0, 'Bobby'),
('BYR20180204091308', 'PEL00007', 'PGN00007', '2018-02-04', 'Feb', 5000, 151700, 152000, 300, 'Rudi'),
('BYR20240715020427', 'PEL00001', 'PGN00027', '2024-07-15', 'Jul', 5000, 151700, 200000, 48300, 'Shocky'),
('BYR20240715024107', 'PEL00005', 'PGN00028', '2024-07-15', 'Jul', 5000, 4185950, 5000000, 814050, 'Shocky'),
('BYR20240715024731', 'PEL00002', 'PGN00029', '2024-07-15', 'Jul', 5000, 78350, 80000, 1650, 'Shocky'),
('BYR20240716071733', 'PEL00001', 'PGN00001', '2024-07-16', 'Jul', 5000, 445100, 800000, 354900, 'Agen PPOB');

-- --------------------------------------------------------

--
-- Table structure for table `penggunaan`
--

CREATE TABLE `penggunaan` (
  `kd_penggunaan` varchar(45) NOT NULL,
  `kd_pelanggan` varchar(45) NOT NULL,
  `bulan` varchar(45) NOT NULL,
  `tahun` varchar(45) NOT NULL,
  `meter_awal` int(11) NOT NULL,
  `meter_akhir` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penggunaan`
--

INSERT INTO `penggunaan` (`kd_penggunaan`, `kd_pelanggan`, `bulan`, `tahun`, `meter_awal`, `meter_akhir`, `status`) VALUES
('PGN00001', 'PEL00001', 'Jul', '2024', 0, 300, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `sbayar`
-- (See below for the actual view)
--
CREATE TABLE `sbayar` (
`kd_pelanggan` varchar(45)
,`no_meter` varchar(45)
,`nama` varchar(45)
,`alamat` text
,`kd_tarif` varchar(45)
,`tenggang_waktu` int(11)
,`kd_tagihan` varchar(45)
,`jumlah_meter` int(11)
,`total_tagihan` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `struk`
-- (See below for the actual view)
--
CREATE TABLE `struk` (
`kd_bayar` varchar(45)
,`kd_pelanggan` varchar(45)
,`kd_penggunaan` varchar(45)
,`tanggal` date
,`bulan_bayar` varchar(45)
,`biaya_admin` int(11)
,`total` int(11)
,`bayar` int(11)
,`kembalian` int(11)
,`agen` varchar(45)
,`nama` varchar(45)
,`no_meter` varchar(45)
,`kd_tarif` varchar(45)
,`daya` varchar(45)
,`tarif` int(11)
,`meter_awal` int(11)
,`meter_akhir` int(11)
,`total_tagihan` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `subayar`
-- (See below for the actual view)
--
CREATE TABLE `subayar` (
`kd_pelanggan` varchar(45)
,`no_meter` varchar(45)
,`nama` varchar(45)
,`alamat` text
,`kd_tarif` varchar(45)
,`tenggang_waktu` int(11)
,`kd_tagihan` varchar(45)
,`jumlah_meter` int(11)
,`total_tagihan` int(11)
,`bulan` varchar(45)
,`tahun` varchar(45)
);

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `kd_tagihan` varchar(45) NOT NULL,
  `kd_penggunaan` varchar(45) NOT NULL,
  `kd_pelanggan` varchar(45) NOT NULL,
  `bulan` varchar(45) NOT NULL,
  `tahun` varchar(45) NOT NULL,
  `jumlah_meter` int(11) NOT NULL,
  `total_tagihan` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`kd_tagihan`, `kd_penggunaan`, `kd_pelanggan`, `bulan`, `tahun`, `jumlah_meter`, `total_tagihan`, `status`) VALUES
('TGN16072024071618', 'PGN00001', 'PEL00001', 'Jul', '2024', 300, 440100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tarif`
--

CREATE TABLE `tarif` (
  `kd_tarif` varchar(45) NOT NULL,
  `daya` varchar(45) DEFAULT NULL,
  `tarif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tarif`
--

INSERT INTO `tarif` (`kd_tarif`, `daya`, `tarif`) VALUES
('TAR00001', '450', 415),
('TAR00002', '900', 586),
('TAR00003', '1300', 1467),
('TAR00004', '2200', 1467),
('TAR00005', '3500', 1467),
('TAR00006', '4400', 1467);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`) VALUES
(12, 'Administrator', 'admin', '12345678');

-- --------------------------------------------------------

--
-- Structure for view `bbayar`
--
DROP TABLE IF EXISTS `bbayar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bbayar`  AS  select `pelanggan`.`kd_pelanggan` AS `kd_pelanggan`,`pelanggan`.`no_meter` AS `no_meter`,`pelanggan`.`nama` AS `nama`,`pelanggan`.`alamat` AS `alamat`,`pelanggan`.`kd_tarif` AS `kd_tarif`,`pelanggan`.`tenggang_waktu` AS `tenggang_waktu`,`tagihan`.`kd_tagihan` AS `kd_tagihan`,`tagihan`.`jumlah_meter` AS `jumlah_meter`,`tagihan`.`total_tagihan` AS `total_tagihan`,`tagihan`.`bulan` AS `bulan` from (`pelanggan` join `tagihan` on((`tagihan`.`kd_pelanggan` = `pelanggan`.`kd_pelanggan`))) where (`tagihan`.`status` = 0) ;

-- --------------------------------------------------------

--
-- Structure for view `pemasukan`
--
DROP TABLE IF EXISTS `pemasukan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pemasukan`  AS  select `tagihan`.`kd_tagihan` AS `kd_tagihan`,`tagihan`.`kd_penggunaan` AS `kd_penggunaan`,`tagihan`.`kd_pelanggan` AS `kd_pelanggan`,`tagihan`.`bulan` AS `bulan`,`tagihan`.`tahun` AS `tahun`,`tagihan`.`jumlah_meter` AS `jumlah_meter`,`tagihan`.`total_tagihan` AS `total_tagihan`,`tagihan`.`status` AS `status`,`pelanggan`.`nama` AS `nama` from (`tagihan` join `pelanggan` on((`pelanggan`.`kd_pelanggan` = `tagihan`.`kd_pelanggan`))) where (`tagihan`.`status` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `sbayar`
--
DROP TABLE IF EXISTS `sbayar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sbayar`  AS  select `pelanggan`.`kd_pelanggan` AS `kd_pelanggan`,`pelanggan`.`no_meter` AS `no_meter`,`pelanggan`.`nama` AS `nama`,`pelanggan`.`alamat` AS `alamat`,`pelanggan`.`kd_tarif` AS `kd_tarif`,`pelanggan`.`tenggang_waktu` AS `tenggang_waktu`,`tagihan`.`kd_tagihan` AS `kd_tagihan`,`tagihan`.`jumlah_meter` AS `jumlah_meter`,`tagihan`.`total_tagihan` AS `total_tagihan` from (`pelanggan` join `tagihan` on((`tagihan`.`kd_pelanggan` = `pelanggan`.`kd_pelanggan`))) where (`tagihan`.`status` = 1) ;

-- --------------------------------------------------------

--
-- Structure for view `struk`
--
DROP TABLE IF EXISTS `struk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `struk`  AS  select `pembayaran`.`kd_bayar` AS `kd_bayar`,`pembayaran`.`kd_pelanggan` AS `kd_pelanggan`,`pembayaran`.`kd_penggunaan` AS `kd_penggunaan`,`pembayaran`.`tanggal` AS `tanggal`,`pembayaran`.`bulan_bayar` AS `bulan_bayar`,`pembayaran`.`biaya_admin` AS `biaya_admin`,`pembayaran`.`total` AS `total`,`pembayaran`.`bayar` AS `bayar`,`pembayaran`.`kembalian` AS `kembalian`,`pembayaran`.`agen` AS `agen`,`pelanggan`.`nama` AS `nama`,`pelanggan`.`no_meter` AS `no_meter`,`tarif`.`kd_tarif` AS `kd_tarif`,`tarif`.`daya` AS `daya`,`tarif`.`tarif` AS `tarif`,`penggunaan`.`meter_awal` AS `meter_awal`,`penggunaan`.`meter_akhir` AS `meter_akhir`,`tagihan`.`total_tagihan` AS `total_tagihan` from ((((`pembayaran` join `pelanggan` on((`pelanggan`.`kd_pelanggan` = `pembayaran`.`kd_pelanggan`))) join `tarif` on((`tarif`.`kd_tarif` = `pelanggan`.`kd_tarif`))) join `tagihan` on((`tagihan`.`kd_pelanggan` = `pembayaran`.`kd_pelanggan`))) join `penggunaan` on((`penggunaan`.`kd_pelanggan` = `pembayaran`.`kd_pelanggan`))) where ((`tagihan`.`status` = 1) and (`penggunaan`.`status` = 1)) ;

-- --------------------------------------------------------

--
-- Structure for view `subayar`
--
DROP TABLE IF EXISTS `subayar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `subayar`  AS  select `pelanggan`.`kd_pelanggan` AS `kd_pelanggan`,`pelanggan`.`no_meter` AS `no_meter`,`pelanggan`.`nama` AS `nama`,`pelanggan`.`alamat` AS `alamat`,`pelanggan`.`kd_tarif` AS `kd_tarif`,`pelanggan`.`tenggang_waktu` AS `tenggang_waktu`,`tagihan`.`kd_tagihan` AS `kd_tagihan`,`tagihan`.`jumlah_meter` AS `jumlah_meter`,`tagihan`.`total_tagihan` AS `total_tagihan`,`tagihan`.`bulan` AS `bulan`,`tagihan`.`tahun` AS `tahun` from (`pelanggan` join `tagihan` on((`tagihan`.`kd_pelanggan` = `pelanggan`.`kd_pelanggan`))) where (`tagihan`.`status` = 1) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agen`
--
ALTER TABLE `agen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`kd_pelanggan`),
  ADD KEY `fk_pelanggan_tarif1_idx` (`kd_tarif`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`kd_bayar`),
  ADD KEY `kd_tagihan` (`kd_penggunaan`);

--
-- Indexes for table `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD KEY `kd_penggunaan` (`kd_penggunaan`),
  ADD KEY `kd_pelanggan` (`kd_pelanggan`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`kd_tagihan`),
  ADD KEY `kd_penggunaan` (`kd_penggunaan`);

--
-- Indexes for table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`kd_tarif`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agen`
--
ALTER TABLE `agen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `fk_pelanggan_tarif1` FOREIGN KEY (`kd_tarif`) REFERENCES `tarif` (`kd_tarif`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`kd_penggunaan`) REFERENCES `penggunaan` (`kd_penggunaan`);

--
-- Constraints for table `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD CONSTRAINT `penggunaan_ibfk_1` FOREIGN KEY (`kd_pelanggan`) REFERENCES `pelanggan` (`kd_pelanggan`);

--
-- Constraints for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD CONSTRAINT `tagihan_ibfk_1` FOREIGN KEY (`kd_penggunaan`) REFERENCES `penggunaan` (`kd_penggunaan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
