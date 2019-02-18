-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2019 at 03:11 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gki_sarpras`
--

-- --------------------------------------------------------

--
-- Table structure for table `aset`
--

CREATE TABLE `aset` (
  `id_aset` int(11) NOT NULL,
  `nama_aset` varchar(30) NOT NULL,
  `nomor_aset` varchar(4) NOT NULL,
  `id_pengadaan` int(11) NOT NULL,
  `harga_aset` int(11) NOT NULL,
  `tanggal_pengadaan` date NOT NULL,
  `lokasi_aset` int(11) NOT NULL,
  `masa_manfaat` int(11) NOT NULL,
  `gambar` text,
  `tgl_added` date NOT NULL,
  `aset_pinjam` int(11) NOT NULL,
  `status_pinjam` int(11) NOT NULL,
  `status_aset` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aset`
--

INSERT INTO `aset` (`id_aset`, `nama_aset`, `nomor_aset`, `id_pengadaan`, `harga_aset`, `tanggal_pengadaan`, `lokasi_aset`, `masa_manfaat`, `gambar`, `tgl_added`, `aset_pinjam`, `status_pinjam`, `status_aset`) VALUES
(1, 'Keyboard Yamaha PSR-710', '', 0, 1, '0000-00-00', 0, 0, NULL, '2018-08-03', 0, 0, ''),
(2, 'Mixer Yamaha', '', 0, 1, '0000-00-00', 0, 0, NULL, '2018-08-04', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `merk` varchar(20) NOT NULL,
  `seri_model` varchar(20) NOT NULL,
  `status_barang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `id_kategori`, `nama_barang`, `merk`, `seri_model`, `status_barang`) VALUES
(1, 1, 'Gitar Elektrik', 'Yamaha', 'APX-300', 'Aktif'),
(2, 1, 'Keyboard Elektrik', 'Yamaha', 'PSR-700', 'Aktif'),
(3, 2, 'Avanza', 'Toyota', '1500cc', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `kode_kategori` varchar(50) NOT NULL,
  `status_kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `kode_kategori`, `status_kategori`) VALUES
(1, 'Alat Musik', 'AM', 'Aktif'),
(2, 'Transportasi', 'TR', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `komisi`
--

CREATE TABLE `komisi` (
  `id_komisi` int(11) NOT NULL,
  `nama_komisi` varchar(50) NOT NULL,
  `kode_komisi` varchar(10) NOT NULL,
  `status_komisi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komisi`
--

INSERT INTO `komisi` (`id_komisi`, `nama_komisi`, `kode_komisi`, `status_komisi`) VALUES
(1, 'Komisi Pemuda Remaja', 'KPR', 'Aktif'),
(2, 'Komisi Anak', 'KA', 'Aktif'),
(3, 'Komisi Senior', 'KS', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `pengadaan`
--

CREATE TABLE `pengadaan` (
  `id_pengadaan` int(11) NOT NULL,
  `barang_usulan` varchar(50) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `keterangan_usulan` varchar(200) NOT NULL,
  `tanggal_usulan` datetime NOT NULL,
  `tanggal_modifikasi` datetime NOT NULL,
  `tanggal_approve` datetime NOT NULL,
  `hasil_approval` varchar(10) NOT NULL,
  `status_usulan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengadaan`
--

INSERT INTO `pengadaan` (`id_pengadaan`, `barang_usulan`, `id_barang`, `jumlah`, `harga`, `keterangan_usulan`, `tanggal_usulan`, `tanggal_modifikasi`, `tanggal_approve`, `hasil_approval`, `status_usulan`) VALUES
(1, 'Yamaha APX-100', 1, 1, 2000000, 'Untuk keperluan KPR', '2019-02-17 00:36:41', '2019-02-17 00:36:41', '0000-00-00 00:00:00', 'Pending', 'Aktif'),
(2, 'Yamaha PSR-950', 2, 0, 9000000, 'Untuk keperluan ibadah', '2019-02-18 01:32:04', '2019-02-18 01:32:04', '0000-00-00 00:00:00', 'Pending', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` int(11) NOT NULL,
  `nama_ruangan` varchar(50) NOT NULL,
  `kode_ruangan` varchar(10) NOT NULL,
  `status_ruangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `nama_ruangan`, `kode_ruangan`, `status_ruangan`) VALUES
(1, 'Ruang Ibadah Utama', 'RU', 'Aktif'),
(2, 'Ruang Kantor', 'RK', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `sarpras`
--

CREATE TABLE `sarpras` (
  `id` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jenis` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tempat` varchar(20) NOT NULL,
  `gambar` text,
  `tgl_added` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sarpras`
--

INSERT INTO `sarpras` (`id`, `nama`, `jenis`, `jumlah`, `tempat`, `gambar`, `tgl_added`) VALUES
('SP-000001', 'Mixer Yamaha', 'Mixer', 1, 'Ruang Utama', NULL, '2018-08-04'),
('SP-000002', 'Keyboard Yamaha PSR-710', 'Keyboard', 1, 'Ruang Atas', NULL, '2018-08-03');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `nama_status` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `nama_status`, `status`) VALUES
(1, 'Aktif', 'Aktif'),
(2, 'Tidak Aktif', 'Aktif'),
(3, 'Rusak', 'Aktif'),
(4, 'Maintenance', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `role` varchar(20) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `status_user` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama`, `role`, `keterangan`, `status_user`) VALUES
(1, 'admin', 'admin', 'adminss', 'Administrator', 'Hak akses penuh', 'Aktif'),
(2, 'ketuamj', 'ketuamj', 'Ketua MJ', 'Ketua MJ', 'Untuk melihat laporan', 'Aktif'),
(3, 'mjbid4', 'mjbid4', 'Anggota MJ', 'Anggota MJ', 'Untuk transaksi aset', 'Aktif'),
(4, 'kpr', 'kpr', 'KPR', 'Komisi Jemaat', 'Untuk peminjaman (KPR)', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`id_aset`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `komisi`
--
ALTER TABLE `komisi`
  ADD PRIMARY KEY (`id_komisi`);

--
-- Indexes for table `pengadaan`
--
ALTER TABLE `pengadaan`
  ADD PRIMARY KEY (`id_pengadaan`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aset`
--
ALTER TABLE `aset`
  MODIFY `id_aset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `komisi`
--
ALTER TABLE `komisi`
  MODIFY `id_komisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengadaan`
--
ALTER TABLE `pengadaan`
  MODIFY `id_pengadaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id_ruangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
