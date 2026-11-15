-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 14, 2026 at 05:30 PM
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
-- Database: `sistem_absensi_karyawan`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int NOT NULL,
  `id_karyawan` int NOT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `status_masuk` enum('tepat_waktu','terlambat') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_keluar` enum('normal','pulang_cepat') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat_masuk` decimal(10,7) DEFAULT NULL,
  `long_masuk` decimal(10,7) DEFAULT NULL,
  `lat_keluar` decimal(10,7) DEFAULT NULL,
  `long_keluar` decimal(10,7) DEFAULT NULL,
  `lokasi_masuk` enum('dalam_area','luar_area') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lokasi_keluar` enum('dalam_area','luar_area') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `catatan_koreksi` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `izin`
--

CREATE TABLE `izin` (
  `id_izin` int NOT NULL,
  `id_karyawan` int NOT NULL,
  `id_admin` int DEFAULT NULL,
  `id_kategori` int DEFAULT NULL,
  `jenis_izin` enum('sakit','lainnya') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pengajuan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `alasan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('menunggu','disetujui','ditolak','dibatalkan') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `tanggal_diproses` datetime DEFAULT NULL,
  `catatan_admin` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kalender_libur`
--

CREATE TABLE `kalender_libur` (
  `id_libur` int NOT NULL,
  `id_admin` int NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kalender_libur`
--

INSERT INTO `kalender_libur` (`id_libur`, `id_admin`, `tanggal`, `keterangan`) VALUES
(1, 1, '2026-12-25', 'Hari Raya Natal'),
(2, 1, '2027-01-01', 'Tahun Baru Masehi');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `peran` enum('karyawan','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'karyawan',
  `tanggal_masuk` date NOT NULL,
  `saldo_cuti` int NOT NULL DEFAULT '0',
  `wajib_ganti_password` tinyint(1) NOT NULL DEFAULT '1',
  `aktif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `username`, `password`, `peran`, `tanggal_masuk`, `saldo_cuti`, `wajib_ganti_password`, `aktif`) VALUES
(1, 'Admin', 'admin', '$2y$10$px3MyPuMFZwaeyd9mYNDW./o/JFgq7jKoYIsNWNzyC4hNlyCwiyfi', 'admin', '2026-01-02', 0, 0, 1),
(2, 'Raditya izzan', 'budi', '$2y$10$.1YwF6eMPDUqKM0I2LAWZ.cp1ss/cYYyugi6Ib7OTfWp5OaEUoPi6', 'karyawan', '2026-03-04', 12, 1, 1),
(3, 'Riski darmawn', 'Riski', '$2y$10$.1YwF6eMPDUqKM0I2LAWZ.cp1ss/cYYyugi6Ib7OTfWp5OaEUoPi6', 'karyawan', '2026-02-10', 12, 1, 1),
(4, 'Fajar Sampurna', 'Fajar', '$2y$10$.1YwF6eMPDUqKM0I2LAWZ.cp1ss/cYYyugi6Ib7OTfWp5OaEUoPi6', 'karyawan', '2026-08-03', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_izin`
--

CREATE TABLE `kategori_izin` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pola_pengajuan` enum('urgensi','jauh_hari') COLLATE utf8mb4_unicode_ci NOT NULL,
  `memotong_saldo` tinyint(1) NOT NULL DEFAULT '0',
  `bukti_wajib` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_izin`
--

INSERT INTO `kategori_izin` (`id_kategori`, `nama_kategori`, `pola_pengajuan`, `memotong_saldo`, `bukti_wajib`) VALUES
(1, 'Cuti tahunan', 'jauh_hari', 1, 0),
(2, 'Keperluan keluarga', 'jauh_hari', 0, 0),
(3, 'Musibah / kedukaan', 'urgensi', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kode_qr`
--

CREATE TABLE `kode_qr` (
  `id_qr` int NOT NULL,
  `id_admin` int NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` enum('masuk','keluar') COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id_pengaturan` int NOT NULL,
  `id_admin` int NOT NULL,
  `lat_kantor` decimal(10,7) NOT NULL,
  `long_kantor` decimal(10,7) NOT NULL,
  `radius_meter` int NOT NULL DEFAULT '100',
  `jam_masuk` time NOT NULL DEFAULT '07:00:00',
  `jam_pulang` time NOT NULL DEFAULT '16:00:00',
  `toleransi_menit` int NOT NULL DEFAULT '15',
  `jatah_cuti_tahunan` int NOT NULL DEFAULT '12'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id_pengaturan`, `id_admin`, `lat_kantor`, `long_kantor`, `radius_meter`, `jam_masuk`, `jam_pulang`, `toleransi_menit`, `jatah_cuti_tahunan`) VALUES
(1, 1, '-6.3015000', '107.3020000', 100, '07:00:00', '16:00:00', 15, 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD UNIQUE KEY `uq_absen_harian` (`id_karyawan`,`tanggal`);

--
-- Indexes for table `izin`
--
ALTER TABLE `izin`
  ADD PRIMARY KEY (`id_izin`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kalender_libur`
--
ALTER TABLE `kalender_libur`
  ADD PRIMARY KEY (`id_libur`),
  ADD UNIQUE KEY `tanggal` (`tanggal`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `kategori_izin`
--
ALTER TABLE `kategori_izin`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kode_qr`
--
ALTER TABLE `kode_qr`
  ADD PRIMARY KEY (`id_qr`),
  ADD UNIQUE KEY `uq_qr_harian` (`tanggal`,`jenis`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`),
  ADD KEY `id_admin` (`id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `izin`
--
ALTER TABLE `izin`
  MODIFY `id_izin` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kalender_libur`
--
ALTER TABLE `kalender_libur`
  MODIFY `id_libur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori_izin`
--
ALTER TABLE `kategori_izin`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kode_qr`
--
ALTER TABLE `kode_qr`
  MODIFY `id_qr` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id_pengaturan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`);

--
-- Constraints for table `izin`
--
ALTER TABLE `izin`
  ADD CONSTRAINT `izin_ibfk_1` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`),
  ADD CONSTRAINT `izin_ibfk_2` FOREIGN KEY (`id_admin`) REFERENCES `karyawan` (`id_karyawan`),
  ADD CONSTRAINT `izin_ibfk_3` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_izin` (`id_kategori`);

--
-- Constraints for table `kalender_libur`
--
ALTER TABLE `kalender_libur`
  ADD CONSTRAINT `kalender_libur_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `karyawan` (`id_karyawan`);

--
-- Constraints for table `kode_qr`
--
ALTER TABLE `kode_qr`
  ADD CONSTRAINT `kode_qr_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `karyawan` (`id_karyawan`);

--
-- Constraints for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD CONSTRAINT `pengaturan_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `karyawan` (`id_karyawan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
