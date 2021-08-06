-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Agu 2021 pada 16.10
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
-- Struktur dari tabel `pekerjaan`
--

CREATE TABLE `pekerjaan` (
  `id_pekerjaan` int(10) NOT NULL,
  `nama_pekerjaan` varchar(30) DEFAULT NULL,
  `id_user` int(20) NOT NULL,
  `tgl_awal` date NOT NULL,
  `meter` int(30) DEFAULT NULL,
  `tipe_kerja` varchar(20) NOT NULL,
  `harga` int(30) NOT NULL,
  `gambar` varchar(225) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pekerjaan`
--

INSERT INTO `pekerjaan` (`id_pekerjaan`, `nama_pekerjaan`, `id_user`, `tgl_awal`, `meter`, `tipe_kerja`, `harga`, `gambar`, `created_at`) VALUES
(14, 'Membajak Sawah', 43, '2021-08-05', 1750, 'harian', 140000, 'img_1628165632.jpg', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(10) NOT NULL,
  `id_users` int(10) NOT NULL,
  `user_get` int(10) NOT NULL,
  `id_pekerjaan` int(10) NOT NULL,
  `status_pembayaran` int(10) NOT NULL,
  `bukti_upload` varchar(30) NOT NULL,
  `tgl_upload` date NOT NULL,
  `akses` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjadwalan`
--

CREATE TABLE `penjadwalan` (
  `id` int(10) NOT NULL,
  `work_status` int(1) NOT NULL,
  `get_work` int(10) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `user_getid` int(22) NOT NULL,
  `bukti_upload` varchar(50) NOT NULL,
  `is_posted` int(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjadwalan`
--

INSERT INTO `penjadwalan` (`id`, `work_status`, `get_work`, `tgl_mulai`, `user_getid`, `bukti_upload`, `is_posted`, `created_at`) VALUES
(14, 0, 0, '2021-08-05', 0, '', 0, '2021-08-05 19:13:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_post`
--

CREATE TABLE `trans_post` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pekerjaan` int(11) NOT NULL,
  `totalAmount` int(10) NOT NULL,
  `img_bukti` varchar(225) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(43, 'zahra', 'profile-1628166273.jpg', 'Jl. Siliwangi Dusun Cipadung Desa. Karyamukti Kec. Panyingkiran Kab. Majalengka JABAR', 'zahranazizah28@gmail.com', '081586927961', '$2y$10$6vt9F.wQu0DDbmoIze.uCO691QmcoPqMTp3slCaOgBAERmTX13XFu', '2180393067', 1, 2),
(44, 'Maman', 'default.jpg', 'Jl. Masjid Dusun Cipadung Desa. Karyamukti Kec. Panyingkiran Kab. Majalengka', 'mamanfrediges07@gmail.com', '085222584089', '$2y$10$Ke9H6KIHJDasuiIkltt4yOTgv6uGrbBlm76AacWrFeKhGnClhR3qu', '', 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `penjadwalan`
--
ALTER TABLE `penjadwalan`
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
-- AUTO_INCREMENT untuk tabel `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id_pekerjaan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `penjadwalan`
--
ALTER TABLE `penjadwalan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `trans_post`
--
ALTER TABLE `trans_post`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
