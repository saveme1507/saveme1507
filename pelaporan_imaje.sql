-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Mar 2020 pada 21.07
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pelaporan_imaje`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_laporan_mesin`
--

CREATE TABLE `detail_laporan_mesin` (
  `dlm_id` varchar(11) NOT NULL,
  `dlm_id_mesin` int(11) NOT NULL,
  `dlm_vm` varchar(5) NOT NULL,
  `dlm_vj` varchar(5) NOT NULL,
  `dlm_press` varchar(5) NOT NULL,
  `dlm_visco` varchar(5) NOT NULL,
  `dlm_temp` varchar(5) NOT NULL,
  `dlm_ket` text NOT NULL,
  `dlm_id_pergantian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `header_laporan_mesin`
--

CREATE TABLE `header_laporan_mesin` (
  `hlm_id` varchar(11) NOT NULL,
  `hlm_tanggal` date NOT NULL,
  `hlm_pengerjaan` varchar(20) NOT NULL,
  `hlm_pelanggan` int(11) NOT NULL,
  `hlm_teknisi` int(11) NOT NULL,
  `hlm_ttd` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `histori_sparepart`
--

CREATE TABLE `histori_sparepart` (
  `hs_id` int(11) NOT NULL,
  `hs_tgl` date NOT NULL,
  `hs_pn` varchar(10) NOT NULL,
  `hs_nama` varchar(20) NOT NULL,
  `hs_gambar` text NOT NULL,
  `hs_ket` text NOT NULL,
  `hs_sn_mesin` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_kerusakan`
--

CREATE TABLE `laporan_kerusakan` (
  `lk_id` int(11) NOT NULL,
  `lk_tgl` date NOT NULL,
  `lk_pelapor` varchar(20) NOT NULL,
  `lk_ket` text NOT NULL,
  `lk_status` varchar(20) NOT NULL,
  `lk_update` date NOT NULL,
  `lk_id_hlm` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_file`
--

CREATE TABLE `master_file` (
  `mf_id` int(11) NOT NULL,
  `mf_flag` varchar(20) NOT NULL,
  `mf_nama` varchar(20) NOT NULL,
  `mf_path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_file`
--

INSERT INTO `master_file` (`mf_id`, `mf_flag`, `mf_nama`, `mf_path`) VALUES
(1, 'katalog_sp', '2200-Catalog.pdf', 'http://192.168.43.103/pelaporan_imaje/master_katalog_sparepart/'),
(2, 'katalog_sp', '9020_30-Catalog.pdf', 'http://192.168.43.103/pelaporan_imaje/master_katalog_sparepart/'),
(3, 'katalog_sp', '9040-Catalog.pdf', 'http://192.168.43.103/pelaporan_imaje/master_katalog_sparepart/'),
(4, 'katalog_sp', 'S8C2-Catalog.pdf', 'http://192.168.43.103/pelaporan_imaje/master_katalog_sparepart/'),
(5, 'katalog_sp', 'S8G2-Catalog.pdf', 'http://192.168.43.103/pelaporan_imaje/master_katalog_sparepart/');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_mesin`
--

CREATE TABLE `master_mesin` (
  `mm_id` int(11) NOT NULL,
  `mm_sn` varchar(15) DEFAULT NULL,
  `mm_tipe` varchar(20) NOT NULL,
  `mm_posisi` varchar(20) NOT NULL,
  `mm_last_pm` date NOT NULL,
  `mm_id_pt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_mesin`
--

INSERT INTO `master_mesin` (`mm_id`, `mm_sn`, `mm_tipe`, `mm_posisi`, `mm_last_pm`, `mm_id_pt`) VALUES
(3, 'FR 19191919', 's8c2', 'line 2', '2019-03-19', 1),
(4, 'FR 21092209', '9040', 'line 3', '2019-10-23', 1),
(5, 'FR 19191919', 's8c2', 'line 2', '2019-03-19', 1),
(6, 'FR 21092209', '9040', 'line 3', '2019-10-23', 1),
(7, 'FR 19191919', 's8c2', 'line 2', '2019-03-19', 2),
(8, 'FR 21092209', '9040', 'line 3', '2019-10-23', 2),
(9, 'FR 19191919', 's8c2', 'line 2', '2019-03-19', 2),
(10, 'FR 21092209', '9040', 'line 3', '2019-10-23', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_perusahaan`
--

CREATE TABLE `master_perusahaan` (
  `mp_id` int(11) NOT NULL,
  `mp_nama` varchar(50) NOT NULL,
  `mp_alamat` text NOT NULL,
  `mp_logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `master_perusahaan`
--

INSERT INTO `master_perusahaan` (`mp_id`, `mp_nama`, `mp_alamat`, `mp_logo`) VALUES
(1, 'PT. Pralon', 'xxx', ''),
(2, 'PT. Nestle', 'yyy', ''),
(3, 'PT. Printech', 'zzz', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_user`
--

CREATE TABLE `master_user` (
  `mu_id` int(11) NOT NULL,
  `mu_nama` varchar(20) NOT NULL,
  `mu_telp` int(15) NOT NULL,
  `mu_email` varchar(50) NOT NULL,
  `mu_pass` varchar(20) NOT NULL,
  `mu_flag` int(1) NOT NULL,
  `mu_logo` text NOT NULL,
  `mu_token` text NOT NULL,
  `mu_id_pt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_laporan_mesin`
--
ALTER TABLE `detail_laporan_mesin`
  ADD KEY `dlm_id` (`dlm_id`);

--
-- Indeks untuk tabel `header_laporan_mesin`
--
ALTER TABLE `header_laporan_mesin`
  ADD PRIMARY KEY (`hlm_id`);

--
-- Indeks untuk tabel `histori_sparepart`
--
ALTER TABLE `histori_sparepart`
  ADD PRIMARY KEY (`hs_id`);

--
-- Indeks untuk tabel `laporan_kerusakan`
--
ALTER TABLE `laporan_kerusakan`
  ADD PRIMARY KEY (`lk_id`);

--
-- Indeks untuk tabel `master_file`
--
ALTER TABLE `master_file`
  ADD PRIMARY KEY (`mf_id`);

--
-- Indeks untuk tabel `master_mesin`
--
ALTER TABLE `master_mesin`
  ADD PRIMARY KEY (`mm_id`),
  ADD KEY `mm_id_pt` (`mm_id_pt`);

--
-- Indeks untuk tabel `master_perusahaan`
--
ALTER TABLE `master_perusahaan`
  ADD PRIMARY KEY (`mp_id`);

--
-- Indeks untuk tabel `master_user`
--
ALTER TABLE `master_user`
  ADD PRIMARY KEY (`mu_id`),
  ADD KEY `mu_id_pt` (`mu_id_pt`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `master_file`
--
ALTER TABLE `master_file`
  MODIFY `mf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `master_mesin`
--
ALTER TABLE `master_mesin`
  MODIFY `mm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `master_perusahaan`
--
ALTER TABLE `master_perusahaan`
  MODIFY `mp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `master_user`
--
ALTER TABLE `master_user`
  MODIFY `mu_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_laporan_mesin`
--
ALTER TABLE `detail_laporan_mesin`
  ADD CONSTRAINT `detail_laporan_mesin_ibfk_1` FOREIGN KEY (`dlm_id`) REFERENCES `header_laporan_mesin` (`hlm_id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `master_mesin`
--
ALTER TABLE `master_mesin`
  ADD CONSTRAINT `master_mesin_ibfk_1` FOREIGN KEY (`mm_id_pt`) REFERENCES `master_perusahaan` (`mp_id`);

--
-- Ketidakleluasaan untuk tabel `master_user`
--
ALTER TABLE `master_user`
  ADD CONSTRAINT `master_user_ibfk_1` FOREIGN KEY (`mu_id_pt`) REFERENCES `master_perusahaan` (`mp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
