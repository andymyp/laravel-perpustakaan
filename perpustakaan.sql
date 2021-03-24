-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Mar 2021 pada 07.49
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--
CREATE DATABASE IF NOT EXISTS `perpustakaan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `perpustakaan`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `kode_anggota` varchar(6) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `kode_anggota`, `nama`, `jenis_kelamin`, `alamat`, `no_hp`) VALUES
(1, '749424', 'Sellanika Selviana', 'Perempuan', 'Jl. Muchran Ali', '08529745347'),
(3, '251649', 'Akhmad Rifaldy', 'Laki-laki', 'Jl. Muchran Ali No. 40 Sampit', '0857168152826');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `kode_buku` varchar(8) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `harga` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `id_kategori`, `kode_buku`, `judul`, `pengarang`, `penerbit`, `tahun`, `harga`, `jumlah`) VALUES
(4, 1, 'BK121962', 'Mengejar Mimpi', 'Andy', 'Media Kita', '2020', '50.000', 12),
(6, 2, 'BK131037', 'Berlindung di Balik Awan yang Gelap', 'Heru Pranata', 'Herita Media', '2015', '20.000', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail`
--

CREATE TABLE `detail` (
  `id_detail` int(11) NOT NULL,
  `kode_pinjam` varchar(8) NOT NULL,
  `kode_buku` varchar(8) NOT NULL,
  `status` enum('P','K','R','H') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail`
--

INSERT INTO `detail` (`id_detail`, `kode_pinjam`, `kode_buku`, `status`) VALUES
(41, 'PJ784887', 'BK121962', 'K'),
(42, 'PJ784887', 'BK131037', 'K'),
(43, 'PJ85995', 'BK131037', 'H');

-- --------------------------------------------------------

--
-- Struktur dari tabel `insiden`
--

CREATE TABLE `insiden` (
  `id_insiden` int(11) NOT NULL,
  `kode_pinjam` varchar(8) NOT NULL,
  `kode_anggota` varchar(6) NOT NULL,
  `tanggal` date NOT NULL,
  `ganti_rugi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `insiden`
--

INSERT INTO `insiden` (`id_insiden`, `kode_pinjam`, `kode_anggota`, `tanggal`, `ganti_rugi`) VALUES
(5, 'PJ85995', '251649', '2020-11-29', '20.000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Novel'),
(2, 'Cerpen');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` text NOT NULL,
  `status` enum('aktif','non-aktif') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama`, `alamat`, `no_hp`, `username`, `password`, `status`, `remember_token`) VALUES
(1, 'Anang Hermansyah', 'Jl. Muchran Ali No. 40 Sampit', '085753119368', 'pegawai1', '$2y$10$BbNrVeankNctWJct7stYb.st5lEZSCp940F3sQUijgUIJ8cXrzGcO', 'aktif', 'Hoxh3Ok0fEK7YwAqoZze5rJl6uvoiMv7VLJuAUGY7nOOAgi9WGfDftaEJwZQ'),
(3, 'Bambang Pamungkas', 'Jl Bersama', '08353352626', 'pegawai2', '$2y$10$BbNrVeankNctWJct7stYb.st5lEZSCp940F3sQUijgUIJ8cXrzGcO', 'non-aktif', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id_pengaturan` int(11) NOT NULL,
  `maks_pinjam` int(11) NOT NULL,
  `maks_lama` int(11) NOT NULL,
  `denda` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengaturan`
--

INSERT INTO `pengaturan` (`id_pengaturan`, `maks_pinjam`, `maks_lama`, `denda`) VALUES
(1, 3, 7, '1.000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjam`
--

CREATE TABLE `pinjam` (
  `id_pinjam` int(11) NOT NULL,
  `kode_pinjam` varchar(8) NOT NULL,
  `kode_anggota` varchar(6) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `harus_kembali` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `telat` varchar(20) DEFAULT NULL,
  `denda` varchar(20) DEFAULT NULL,
  `status` enum('P','K','I','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pinjam`
--

INSERT INTO `pinjam` (`id_pinjam`, `kode_pinjam`, `kode_anggota`, `tanggal_pinjam`, `harus_kembali`, `tanggal_kembali`, `telat`, `denda`, `status`) VALUES
(22, 'PJ784887', '749424', '2020-11-29', '2020-12-06', '2020-11-29', '0 Hari', '0', 'K'),
(23, 'PJ85995', '251649', '2020-11-29', '2020-12-06', NULL, NULL, NULL, 'I');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD KEY `kode_anggota` (`kode_anggota`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `kode_buku` (`kode_buku`);

--
-- Indeks untuk tabel `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `kode_pinjam` (`kode_pinjam`),
  ADD KEY `id_buku` (`kode_buku`);

--
-- Indeks untuk tabel `insiden`
--
ALTER TABLE `insiden`
  ADD PRIMARY KEY (`id_insiden`),
  ADD KEY `kode_pinjam` (`kode_pinjam`),
  ADD KEY `kode_anggota` (`kode_anggota`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id_pengaturan`);

--
-- Indeks untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`id_pinjam`) USING BTREE,
  ADD KEY `kode_pinjam` (`kode_pinjam`,`kode_anggota`),
  ADD KEY `kode_anggota` (`kode_anggota`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `detail`
--
ALTER TABLE `detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `insiden`
--
ALTER TABLE `insiden`
  MODIFY `id_insiden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id_pengaturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail`
--
ALTER TABLE `detail`
  ADD CONSTRAINT `detail_ibfk_1` FOREIGN KEY (`kode_pinjam`) REFERENCES `pinjam` (`kode_pinjam`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_ibfk_2` FOREIGN KEY (`kode_buku`) REFERENCES `buku` (`kode_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `insiden`
--
ALTER TABLE `insiden`
  ADD CONSTRAINT `insiden_ibfk_1` FOREIGN KEY (`kode_pinjam`) REFERENCES `pinjam` (`kode_pinjam`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `insiden_ibfk_2` FOREIGN KEY (`kode_anggota`) REFERENCES `anggota` (`kode_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  ADD CONSTRAINT `pinjam_ibfk_1` FOREIGN KEY (`kode_anggota`) REFERENCES `anggota` (`kode_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
