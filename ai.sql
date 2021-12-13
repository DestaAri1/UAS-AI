-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Des 2021 pada 11.07
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ai`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buat_akun`
--

CREATE TABLE `buat_akun` (
  `nama` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buat_akun`
--

INSERT INTO `buat_akun` (`nama`, `username`, `password`) VALUES
('apaan', 'wtfmenn', 'wtfmenn'),
('Bagoes', 'bagoes', 'bagoes'),
('Desta', 'desta', 'desta12'),
('Yuhas', 'ahhass', 'ahhass');

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan_saw`
--

CREATE TABLE `karyawan_saw` (
  `id_karyawan` int(11) NOT NULL,
  `nama_karyawan` varchar(20) NOT NULL,
  `alamat` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karyawan_saw`
--

INSERT INTO `karyawan_saw` (`id_karyawan`, `nama_karyawan`, `alamat`) VALUES
(1, 'Xiaomi Remi Note 10', 'Surabaya'),
(2, 'Asus Zenfone Max Pro', 'Surabaya'),
(3, 'Infinix Note 10 Pro', 'Surabaya'),
(4, 'Samsung Galaxy A22', 'Surabaya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria_saw`
--

CREATE TABLE `kriteria_saw` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(30) NOT NULL,
  `jenis` enum('cost','benefit') NOT NULL,
  `bobot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kriteria_saw`
--

INSERT INTO `kriteria_saw` (`id_kriteria`, `nama_kriteria`, `jenis`, `bobot`) VALUES
(1, 'Harga', 'cost', 0.2),
(2, 'Kualitas', 'benefit', 0.25),
(3, 'Fitur', 'benefit', 0.15),
(4, 'Penyimpanan', 'benefit', 0.125),
(5, 'RAM', 'benefit', 0.125),
(6, 'Processor', 'benefit', 0.15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_saw`
--

CREATE TABLE `nilai_saw` (
  `id_nilai` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `nilai` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nilai_saw`
--

INSERT INTO `nilai_saw` (`id_nilai`, `id_kriteria`, `id_karyawan`, `nilai`) VALUES
(1, 1, 1, 2500),
(2, 2, 1, 8),
(3, 3, 1, 8),
(4, 4, 1, 64),
(5, 5, 1, 4),
(6, 6, 1, 9),
(7, 1, 2, 2300),
(8, 2, 2, 7),
(9, 3, 2, 8),
(10, 4, 2, 64),
(11, 5, 2, 4),
(12, 6, 2, 8),
(13, 1, 3, 2450),
(14, 2, 3, 7),
(15, 3, 3, 8),
(16, 4, 3, 64),
(17, 5, 3, 6),
(18, 6, 3, 10),
(19, 1, 4, 2800),
(20, 2, 4, 9),
(21, 3, 4, 7),
(22, 4, 4, 128),
(23, 5, 4, 6),
(24, 6, 4, 7);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buat_akun`
--
ALTER TABLE `buat_akun`
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indeks untuk tabel `karyawan_saw`
--
ALTER TABLE `karyawan_saw`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indeks untuk tabel `kriteria_saw`
--
ALTER TABLE `kriteria_saw`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `nilai_saw`
--
ALTER TABLE `nilai_saw`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_karyawan` (`id_karyawan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `karyawan_saw`
--
ALTER TABLE `karyawan_saw`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kriteria_saw`
--
ALTER TABLE `kriteria_saw`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `nilai_saw`
--
ALTER TABLE `nilai_saw`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `nilai_saw`
--
ALTER TABLE `nilai_saw`
  ADD CONSTRAINT `nilai_saw_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria_saw` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_saw_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan_saw` (`id_karyawan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
