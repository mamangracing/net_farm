-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Jun 2021 pada 19.03
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `netfarm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(10) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `image` varchar(30) DEFAULT NULL,
  `alamat` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `nohp` int(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `rekening` int(30) DEFAULT NULL,
  `is_active` int(5) DEFAULT NULL,
  `role_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `buruh`
--

CREATE TABLE `buruh` (
  `id_buruh` int(30) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `image` varchar(30) DEFAULT NULL,
  `alamat` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `nohp` int(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `rekening` int(30) DEFAULT NULL,
  `is_active` int(5) DEFAULT NULL,
  `role_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `id_pekerjaan` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `batas_waktu` date NOT NULL,
  `uang_makan` double NOT NULL,
  `lokasi` text NOT NULL,
  `tipe_kerja` varchar(20) NOT NULL,
  `upah` double NOT NULL,
  `gambar` varchar(225) NOT NULL,
  `is_posted` int(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pekerjaan`
--

INSERT INTO `pekerjaan` (`id_pekerjaan`, `nama`, `batas_waktu`, `uang_makan`, `lokasi`, `tipe_kerja`, `upah`, `gambar`, `is_posted`, `created_at`) VALUES
(30, 'testestestes', '2021-06-20', 10000, 'jalan Anyar', 'harian', 1000, 'img_1624203190.jpg', 0, '2021-06-20 10:33:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petani`
--

CREATE TABLE `petani` (
  `id_petani` int(30) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `image` varchar(30) DEFAULT NULL,
  `alamat` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `nohp` int(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `rekening` int(30) DEFAULT NULL,
  `is_active` int(5) DEFAULT NULL,
  `role_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `petani`
--

INSERT INTO `petani` (`id_petani`, `nama`, `image`, `alamat`, `email`, `nohp`, `password`, `rekening`, `is_active`, `role_id`) VALUES
(2, 'agung', 'default.jpg', NULL, 'putra@gmail.com', 2147483647, '$2y$10$T0LSBPgV0nsiPwGTRX.9fuB', NULL, 1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_getwork`
--

CREATE TABLE `trans_getwork` (
  `id` int(11) NOT NULL,
  `work_status` int(1) NOT NULL,
  `get_status` int(1) NOT NULL,
  `id_pekerjaan` int(22) NOT NULL,
  `user_getid` int(22) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_post`
--

CREATE TABLE `trans_post` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pekerjaan` int(11) NOT NULL,
  `img_bukti` varchar(225) NOT NULL,
  `totalAmount` double NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `trans_post`
--

INSERT INTO `trans_post` (`id_transaksi`, `id_user`, `id_pekerjaan`, `img_bukti`, `totalAmount`, `created_at`) VALUES
(14, 29, 30, 'img_1624203229.jpg', 21100, '2021-06-20 10:33:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `image` varchar(225) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `nohp` varchar(13) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rekening` varchar(30) NOT NULL,
  `is_active` int(1) NOT NULL,
  `role_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama`, `image`, `alamat`, `email`, `nohp`, `password`, `rekening`, `is_active`, `role_id`) VALUES
(2, 'admin', 'default.jpg', 'Jln. Jend. Sudirman No. 255, Tangerang Selatan 18663, NTB', 'admin@netfarm.co.id', '8745845', '$2y$12$f4JGHA9CDzkLqtsOya6bO.MvWF4C/WTgXauRrSgKlECuLB783chaW', '4485436952991075', 1, 1),
(29, 'sukirman', 'default.jpg', 'cipadung', 'sukirman@gmail.com', '085222584089', '$2y$10$sdlbGPSKbesOhDVKZGvMF.TIzdoAzM6t/I7k2lEf/rH1C6WGAWcXy', '12335658899000', 1, 2),
(30, 'maman', 'default.jpg', '', 'mamanfrediges07@gmail.com', '085222584089', '$2y$10$OyaqdJo4hj15KJcK2otfKum0WukCF7b37e5U42OTi1ZHp8UQg5Ot6', '', 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `buruh`
--
ALTER TABLE `buruh`
  ADD PRIMARY KEY (`id_buruh`);

--
-- Indeks untuk tabel `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`);

--
-- Indeks untuk tabel `petani`
--
ALTER TABLE `petani`
  ADD PRIMARY KEY (`id_petani`);

--
-- Indeks untuk tabel `trans_getwork`
--
ALTER TABLE `trans_getwork`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `trans_post`
--
ALTER TABLE `trans_post`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `buruh`
--
ALTER TABLE `buruh`
  MODIFY `id_buruh` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `petani`
--
ALTER TABLE `petani`
  MODIFY `id_petani` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `trans_getwork`
--
ALTER TABLE `trans_getwork`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `trans_post`
--
ALTER TABLE `trans_post`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
