-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2026 at 11:24 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `nama_produk` varchar(150) NOT NULL,
  `nama_pegawai` varchar(100) NOT NULL,
  `jumlah_beli` int(11) NOT NULL DEFAULT 1,
  `tanggal_transaksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `nama_mahasiswa`, `nama_produk`, `nama_pegawai`, `jumlah_beli`, `tanggal_transaksi`) VALUES
(1, 'Octavian Sinar Ramadhan', 'Tipe-X', 'Rudi Hartono', 5, '2026-04-25'),
(2, 'Dewi Lestari', 'Pulpen', 'Ahmad Fauzi', 5, '2026-04-02'),
(3, 'Eko Prasetyo', 'Penghapus Papan Tulis', 'Siti Rahma', 2, '2026-04-03'),
(4, 'Fitri Handayani', 'Stabilo Warna', 'Rudi Hartono', 4, '2026-04-04'),
(5, 'Galih Wicaksono', 'Map Plastik', 'Ahmad Fauzi', 10, '2026-04-05'),
(6, 'Hana Permata', 'Buku Tulis A4', 'Rudi Hartono', 2, '2026-04-07'),
(7, 'Irfan Maulana', 'Kertas HVS A4', 'Siti Rahma', 1, '2026-04-08'),
(8, 'Julia Rahayu', 'Pensil Warna', 'Ahmad Fauzi', 3, '2026-04-09'),
(9, 'Kevin Ardiansyah', 'Tipe-X', 'Rudi Hartono', 2, '2026-04-10'),
(10, 'Laila Nurul', 'Penggaris 30cm', 'Siti Rahma', 1, '2026-04-11'),
(11, 'Miko Saputra', 'Pulpen', 'Ahmad Fauzi', 6, '2026-04-12'),
(12, 'Nina Kartika', 'Buku Tulis A4', 'Rudi Hartono', 4, '2026-04-14'),
(14, 'Daffa Nurfadhilah', 'Gunting', 'Ahmad Fauzi', 1, '2026-04-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
