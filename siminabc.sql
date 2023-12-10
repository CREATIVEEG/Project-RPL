-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Des 2023 pada 17.15
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siminabc`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_gudang`
--

CREATE TABLE `admin_gudang` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin_gudang`
--

INSERT INTO `admin_gudang` (`id_admin`, `nama`, `username`, `password`) VALUES
(1, 'Dyren Ikid', 'admin01', 'admingudang01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barangkeluar` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `tanggalkeluar` datetime NOT NULL,
  `jumlahkeluar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barangkeluar`, `nama_barang`, `tanggalkeluar`, `jumlahkeluar`) VALUES
(1, 'Processor Samsung Galaxy Z Flip 5', '2023-12-07 09:57:00', 500),
(2, 'Layar Xiaomi 13T', '2023-12-09 19:49:00', 160),
(3, 'Type C port Itel S23+', '2023-12-09 10:51:00', 150);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barangmasuk` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `tanggalmasuk` datetime NOT NULL,
  `jumlahmasuk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barangmasuk`, `nama_barang`, `tanggalmasuk`, `jumlahmasuk`) VALUES
(1, 'Processor Samsung Galaxy Z Flip 5', '2023-12-07 09:56:00', 1500),
(2, 'Layar Xiaomi 13T', '2023-12-09 19:08:00', 560),
(3, 'Layar Xiaomi 13T', '2023-12-08 22:12:00', 900),
(4, 'ROM VIVO V29e', '2023-12-09 15:09:00', 850),
(5, 'Camera Realme 11Pro', '2023-12-09 16:09:00', 150),
(6, 'RAM Infinix Zero 30', '2023-12-09 15:06:00', 670),
(7, 'Fingerprint Sensor OPPO F11', '2023-12-09 19:48:00', 450),
(8, 'Front Camera Redmi 13C', '2023-12-09 13:49:00', 550),
(9, 'Backdoor Realme 11 Pro', '2023-12-07 20:50:00', 700),
(10, 'Type C port Itel S23+', '2023-12-09 07:50:00', 990),
(11, 'Frame Asus Max Pro M2', '2023-12-09 09:51:00', 560),
(12, 'Baterai Samsung S23 Ultra', '2023-12-09 22:42:00', 500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stockbarang`
--

CREATE TABLE `stockbarang` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggalupdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stockbarang`
--

INSERT INTO `stockbarang` (`id`, `nama_barang`, `jumlah`, `tanggalupdate`) VALUES
(1, 'Processor Samsung Galaxy Z Flip 5', 1000, '2023-12-07 09:57:00'),
(2, 'ROM VIVO V29e', 850, '2023-12-09 15:09:00'),
(3, 'RAM Infinix Zero 30', 670, '2023-12-09 15:06:00'),
(4, 'Layar Xiaomi 13T', 1300, '2023-12-09 19:49:00'),
(5, 'Camera Realme 11Pro', 150, '2023-12-09 16:09:00'),
(6, 'Fingerprint Sensor OPPO F11', 450, '2023-12-09 19:48:00'),
(7, 'Front Camera Redmi 13C', 550, '2023-12-09 13:49:00'),
(8, 'Backdoor Realme 11 Pro', 700, '2023-12-07 20:50:00'),
(9, 'Type C port Itel S23+', 840, '2023-12-09 10:51:00'),
(10, 'Frame Asus Max Pro M2', 560, '2023-12-09 09:51:00'),
(11, 'Baterai Samsung S23 Ultra', 500, '2023-12-09 22:42:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin_gudang`
--
ALTER TABLE `admin_gudang`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barangkeluar`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barangmasuk`);

--
-- Indeks untuk tabel `stockbarang`
--
ALTER TABLE `stockbarang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin_gudang`
--
ALTER TABLE `admin_gudang`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_barangkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id_barangmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `stockbarang`
--
ALTER TABLE `stockbarang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
