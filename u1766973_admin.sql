-- phpMyAdmin SQL Dump
-- version 4.9.11
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 30, 2023 at 02:07 PM
-- Server version: 10.5.18-MariaDB-cll-lve
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u1766973_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `idcustomer` int(11) NOT NULL,
  `namacustomer` varchar(30) NOT NULL,
  `numbercustomer` varchar(15) DEFAULT NULL,
  `emailcustomer` varchar(30) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`idcustomer`, `namacustomer`, `numbercustomer`, `emailcustomer`, `order`, `qty`, `total`) VALUES
(1, 'custom1', '085727487544', '1@gmail.om', 0, 605, 6500000),
(2, 'custom2', '08998736754', '2@gmail.com', 0, 200, 2000000),
(14, 'customer ke 3', '08997743656', '3@gmail.com', 0, 500, 5000000);

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `qty` int(11) NOT NULL,
  `petugas` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `idbarang`, `tanggal`, `qty`, `petugas`) VALUES
(1, 7, '2023-01-18 05:12:32', 20, 'dede'),
(2, 7, '2023-01-18 05:13:06', 100, 'defef'),
(3, 8, '2023-01-18 05:41:01', 40, 'hdh'),
(4, 17, '2023-01-18 09:11:37', 1, 'admin'),
(14, 23, '2023-01-19 05:49:21', 1000, 'admin'),
(15, 23, '2023-01-19 06:15:50', 1000, 'admin'),
(16, 22, '2023-01-19 07:24:21', 1000, 'volvo'),
(17, 22, '2023-02-02 05:19:29', 100, 'volvo'),
(18, 24, '2023-02-02 05:20:08', 100, 'admin'),
(19, 22, '2023-02-03 06:38:50', 10, 'admin'),
(20, 22, '2023-02-15 05:41:59', 100, 'volvo'),
(21, 24, '2023-03-01 08:16:20', 100, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`iduser`, `email`, `password`, `role`) VALUES
(1, 'cek@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'admin'),
(6, 'gudang@gmail.com', '202cb962ac59075b964b07152d234b70', 'warehouse');

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `image` varchar(99) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `qty`, `total`, `image`, `tanggal`, `keterangan`) VALUES
(1, 23, 1000, 1000000, NULL, '2023-01-23 04:17:06', 'volvo'),
(2, 22, 100, 150000, NULL, '2023-02-02 05:19:03', 'admin'),
(3, 24, 100, 3000000, NULL, '2023-02-02 05:19:52', 'admin'),
(4, 22, 10, 1000000, NULL, '2023-02-03 06:38:30', 'admin'),
(5, 22, 100, 100000, NULL, '2023-02-13 08:30:32', 'admin'),
(12, 24, 100, 1000000, '8575d00b268e0c47d60bd8f6156d9ad2.jpg', '2023-03-01 08:16:06', 'admin'),
(13, 23, 10000, 100, 'fc163915c67b39d393e33f4cb2c260fb.png', '2023-05-24 04:42:10', 'admin cakep');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `idpesanan` int(11) NOT NULL,
  `idcustomer` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `pesanan` text NOT NULL,
  `jumlah` int(11) NOT NULL,
  `transaksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`idpesanan`, `idcustomer`, `tanggal`, `pesanan`, `jumlah`, `transaksi`) VALUES
(2, 1, '2023-02-16 04:05:29', 'snack', 100, 1000000),
(3, 2, '2023-02-16 05:27:49', 'snack', 200, 2000000),
(5, 4, '2023-02-26 08:17:47', 'wollroll', 200, 2000000),
(7, 1, '2023-02-26 09:00:15', 'snack', 100, 1000000),
(9, 4, '2023-02-27 02:03:58', 'cake ultah', 1, 1000000),
(10, 5, '2023-02-27 02:09:27', 'snack', 800, 8000000),
(11, 6, '2023-02-27 02:18:23', 'snackbox eko', 800, 8000000),
(12, 7, '2023-02-27 02:21:17', 'snack eko', 600, 6000000),
(13, 8, '2023-02-27 02:35:27', 'snack eko', 500, 5000000),
(14, 11, '2023-02-27 02:37:38', 'snack eko', 500, 5000000),
(15, 12, '2023-02-27 02:39:10', 'snack eko', 500, 5000000),
(16, 13, '2023-02-27 02:45:27', 'snack eko', 700, 7000000),
(18, 14, '2023-02-27 02:49:34', 'snack eko', 500, 5000000),
(19, 1, '2023-03-01 05:36:49', 'snack ultah', 400, 4000000),
(20, 1, '2023-03-01 07:23:16', 'snack eko', 5, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `idbarang` int(11) NOT NULL,
  `namabarang` varchar(30) NOT NULL,
  `deskripsi` varchar(30) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`idbarang`, `namabarang`, `deskripsi`, `stock`) VALUES
(22, 'Tepung Terigu', 'Tepung', 0),
(23, 'Tepung Cakra', 'Tepung', 20000),
(24, 'Gula Pasir', 'Gula', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`idcustomer`);

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`idpesanan`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idbarang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `idcustomer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `keluar`
--
ALTER TABLE `keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `idpesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
