-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2026 at 04:09 PM
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
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `katasandi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `katasandi`) VALUES
(1, 'octavian123', 'octavian123');

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
(1, 'Octavian Sinar Ramadhan', 'busur derajat', 'Rudi Hartono', 7, '2026-05-01'),
(2, 'Dewi Lestari', 'Pulpen', 'Ahmad Fauzi', 5, '2026-04-02'),
(3, 'Eko Prasetyo', 'Penghapus Papan Tulis', 'Siti Rahma', 2, '2026-04-03'),
(4, 'Fitri Handayani', 'Stabilo Warna', 'Rudi Hartono', 4, '2026-04-04'),
(5, 'Galih Wicaksono', 'Map Plastik', 'Ahmad Fauzi', 10, '2026-04-05'),
(7, 'Irfan Maulana', 'Kertas HVS A4', 'Siti Rahma', 1, '2026-04-08'),
(9, 'Kevin Ardiansyah', 'Tipe-X', 'Rudi Hartono', 2, '2026-04-10'),
(10, 'Laila Nurul', 'Penggaris 30cm', 'Siti Rahma', 1, '2026-04-11'),
(14, 'Daffa Nurfadhilah', 'Gunting', 'Ahmad Fauzi', 1, '2026-04-25'),
(15, 'Tatavian', 'kertas polio', 'Ahmad Fauzi', 10, '2026-04-28'),
(16, 'Ramadhan', 'Papan Ujian', 'Siti Rahma', 1, '0000-00-00'),
(17, 'Farid MU', 'Isi pulpen', 'Siti Rahma', 12, '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
