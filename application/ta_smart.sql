-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Nov 2018 pada 16.24
-- Versi server: 10.1.33-MariaDB
-- Versi PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta_smart`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `username` varchar(100) NOT NULL,
  `nama` text NOT NULL,
  `jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_berkas`
--

CREATE TABLE `data_berkas` (
  `id` int(11) NOT NULL,
  `id_pegawai` varchar(100) NOT NULL,
  `nama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama`) VALUES
(2, 'Manusia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `bobot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id`, `nama`, `bobot`) VALUES
(7, 'Pengalaman Kerja', 95),
(10, 'Pengalaman Kerja ( Masa Kerja )', 95),
(11, 'bahasa yang dikuasai', 90),
(13, 'genre musik', 70),
(14, 'nilai test', 65),
(15, 'domisili', 60);

-- --------------------------------------------------------

--
-- Struktur dari tabel `manager`
--

CREATE TABLE `manager` (
  `username` varchar(100) NOT NULL,
  `nama` text NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `id_jabatan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_kriteria`
--

CREATE TABLE `nilai_kriteria` (
  `id` int(11) NOT NULL,
  `kriteria` int(11) NOT NULL,
  `parameter` text NOT NULL,
  `bobot` int(11) NOT NULL,
  `nilai_awal` int(11) NOT NULL,
  `nilai_akhir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai_kriteria`
--

INSERT INTO `nilai_kriteria` (`id`, `kriteria`, `parameter`, `bobot`, `nilai_awal`, `nilai_akhir`) VALUES
(4, 7, 'intertaiment (penyiar radio)', 100, 0, 0),
(5, 7, 'intertaiment (penyiar TV)', 80, 0, 0),
(6, 7, 'intertaiment (MC)', 60, 0, 0),
(7, 7, 'umum', 40, 0, 0),
(8, 7, 'tidak memiliki pengalaman kerja', 20, 0, 0),
(9, 10, '4 tahun', 100, 0, 0),
(10, 10, '3 tahun', 80, 0, 0),
(11, 10, '2 tahun', 60, 0, 0),
(12, 10, '1 tahun', 40, 0, 0),
(13, 10, 'tidak memiliki pengalam kerja', 20, 0, 0),
(14, 11, 'bahasa daerah, bahasa indonesia, bahasa asing', 100, 0, 0),
(15, 11, 'bahasa daerah, bahasa indonesia', 80, 0, 0),
(16, 11, 'bahasa indonesia, bahasa asing', 60, 0, 0),
(17, 11, 'bahasa indonesia', 40, 0, 0),
(18, 11, 'bahasa daerah', 20, 0, 0),
(19, 13, '5 genre musik', 100, 0, 0),
(20, 13, '4 genre musik', 80, 0, 0),
(21, 13, '3 genre musik', 60, 0, 0),
(22, 13, '2 genre musik', 40, 0, 0),
(23, 13, '1 genre musik', 20, 0, 0),
(24, 14, 'skor 90- skor 100', 100, 90, 100),
(25, 14, 'skor 80- skor 85', 80, 80, 85),
(26, 14, 'skor 70 - skor 75', 60, 70, 75),
(27, 14, 'skor 60 - skor 65', 40, 60, 65),
(28, 14, 'skor 0 - 55', 20, 0, 55),
(29, 15, '15 km - 10 km', 100, 15, 10),
(30, 15, '25 km - 20 km', 80, 25, 20),
(31, 15, '35 km - 30 km', 60, 35, 30),
(32, 15, '45 km - 40 km', 40, 45, 40),
(33, 15, '> 50', 20, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_utiliti`
--

CREATE TABLE `nilai_utiliti` (
  `id` int(11) NOT NULL,
  `nilai_kriteria` int(11) NOT NULL,
  `nilai_utiliti` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `username` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `pendidikan` varchar(100) NOT NULL,
  `berkas` int(11) NOT NULL DEFAULT '0',
  `tes` int(11) NOT NULL DEFAULT '0',
  `wawancara` int(11) NOT NULL DEFAULT '0',
  `telepon` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`username`, `nama`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `pendidikan`, `berkas`, `tes`, `wawancara`, `telepon`) VALUES
('apranta', 'Rezi Apriliansyah', 'pbm', '2018-03-15', 'asasasa', 'SMA', 1, 1, 1, '08981073502'),
('kiki', 're', 'Prabumulih', '1999-04-16', 'agsajfsasghhahgfasaoyfouaf;ashfja', 'SMA', 0, 0, 9, '08981073502'),
('dian', 'dian', 'oajs', '1900-12-05', 'ajska', 'SMA', 0, 0, 1, '0001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penilaian`
--

CREATE TABLE `penilaian` (
  `id` int(11) NOT NULL,
  `id_pegawai` varchar(100) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penilaian`
--

INSERT INTO `penilaian` (`id`, `id_pegawai`, `id_kriteria`, `nilai`) VALUES
(1, 'apranta', 7, 4),
(2, 'apranta', 10, 10),
(3, 'apranta', 11, 14),
(4, 'apranta', 13, 19),
(5, 'apranta', 14, 24),
(6, 'apranta', 15, 29),
(7, 'kiki', 7, 7),
(8, 'kiki', 10, 10),
(9, 'kiki', 11, 15),
(10, 'kiki', 13, 21),
(11, 'kiki', 14, 26),
(12, 'kiki', 15, 29),
(13, 'dian', 7, 6),
(14, 'dian', 10, 0),
(15, 'dian', 11, 16),
(16, 'dian', 13, 21),
(17, 'dian', 14, 27),
(18, 'dian', 15, 30),
(19, 'dian', 7, 6),
(20, 'dian', 10, 10),
(21, 'dian', 11, 15),
(22, 'dian', 13, 20),
(23, 'dian', 14, 25),
(24, 'dian', 15, 29);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `nama`) VALUES
(1, 'Admin'),
(2, 'Manager'),
(3, 'Pegawai'),
(4, 'Penilai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tes_tertulis`
--

CREATE TABLE `tes_tertulis` (
  `id` int(11) NOT NULL,
  `id_pendaftar` varchar(100) NOT NULL,
  `tiu` int(11) NOT NULL,
  `tkd` int(11) NOT NULL,
  `twk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`, `role`) VALUES
('admin', '202cb962ac59075b964b07152d234b70', 1),
('apranta', '202cb962ac59075b964b07152d234b70', 3),
('dian', '202cb962ac59075b964b07152d234b70', 3),
('kaka', '202cb962ac59075b964b07152d234b70', 2),
('kiki', '202cb962ac59075b964b07152d234b70', 3),
('nilai', '202cb962ac59075b964b07152d234b70', 4);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD KEY `username` (`username`);

--
-- Indeks untuk tabel `data_berkas`
--
ALTER TABLE `data_berkas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`username`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indeks untuk tabel `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kriteria` (`kriteria`);

--
-- Indeks untuk tabel `nilai_utiliti`
--
ALTER TABLE `nilai_utiliti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_kriteria` (`nilai_kriteria`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD KEY `username` (`username`);

--
-- Indeks untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_nilai` (`nilai`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tes_tertulis`
--
ALTER TABLE `tes_tertulis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pendaftar` (`id_pendaftar`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_berkas`
--
ALTER TABLE `data_berkas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `nilai_utiliti`
--
ALTER TABLE `nilai_utiliti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tes_tertulis`
--
ALTER TABLE `tes_tertulis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_berkas`
--
ALTER TABLE `data_berkas`
  ADD CONSTRAINT `data_berkas_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manager_ibfk_2` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai_kriteria`
--
ALTER TABLE `nilai_kriteria`
  ADD CONSTRAINT `nilai_kriteria_ibfk_1` FOREIGN KEY (`kriteria`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
