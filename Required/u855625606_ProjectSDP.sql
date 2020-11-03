-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2020 at 11:29 AM
-- Server version: 10.4.15-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u855625606_ProjectSDP`
--

-- --------------------------------------------------------

--
-- Table structure for table `Absen`
--

CREATE TABLE `Absen` (
  `Absen_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Mahasiswa_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Kelas_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Tanggal` date NOT NULL,
  `Hadir` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Administrator`
--

CREATE TABLE `Administrator` (
  `Admin_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Admin_Nama` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Admin_Pass` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `Administrator`
--

INSERT INTO `Administrator` (`Admin_ID`, `Admin_Nama`, `Admin_Pass`) VALUES
('ADM1', 'Admin', 'Admin'),
('ADM2', 'David', 'David24'),
('ADM3', 'Andy', 'Andy'),
('ADM4', 'Marco', 'Marco'),
('ADM5', 'Andyco', 'Andyco');

-- --------------------------------------------------------

--
-- Table structure for table `Ambil`
--

CREATE TABLE `Ambil` (
  `Ambil_ID` int(11) NOT NULL,
  `Mahasiswa_ID` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Matkul_Kurikulum_ID` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Ambil_Status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Ambil`
--

INSERT INTO `Ambil` (`Ambil_ID`, `Mahasiswa_ID`, `Matkul_Kurikulum_ID`, `Ambil_Status`) VALUES
(1, '2205010031', 'MLK0004', 'Diterima'),
(2, '2205010032', 'MLK0004', 'Diterima'),
(3, '2205040006', 'MLK0003', 'Diterima'),
(4, '2205010033', 'MLK0004', 'Diterima'),
(5, '2205010031', 'MLK0002', 'Diterima'),
(6, '2205010032', 'MLK0002', 'Diterima'),
(7, '2195010028', 'MLK0001', 'Diterima'),
(8, '2195010028', 'MLK0004', 'Diterima'),
(27, '2195010028', 'MLK0004', 'Ditolak'),
(28, '2195010028', 'MLK0005', 'Ditolak'),
(29, '2195010028', 'MLK0006', 'Ditolak'),
(30, '2195010028', 'MLK0007', 'Ditolak'),
(31, '2195010028', 'MLK0008', 'Diterima'),
(32, '2195010028', 'MLK0016', 'Diterima'),
(37, '2205010100', 'MLK0004', ''),
(38, '2205010100', 'MLK0005', ''),
(39, '2205010100', 'MLK0006', ''),
(40, '2205010100', 'MLK0007', ''),
(41, '2205010100', 'MLK0009', ''),
(48, '2205010100', 'MLK0005', ''),
(49, '2205010100', 'MLK0006', ''),
(50, '2205010100', 'MLK0007', ''),
(51, '2205010100', 'MLK0009', '');

-- --------------------------------------------------------

--
-- Table structure for table `Chat`
--

CREATE TABLE `Chat` (
  `Chat_ID` int(11) NOT NULL,
  `Admin_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Mahasiswa_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Chat_Text` text COLLATE utf8_unicode_ci NOT NULL,
  `Chat_Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Chat_Status` varchar(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Dosen`
--

CREATE TABLE `Dosen` (
  `Dosen_ID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Dosen_Nama` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Dosen_User` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Dosen_Pass` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Dosen_Jabatan` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Dosen_Photo` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Dosen`
--

INSERT INTO `Dosen` (`Dosen_ID`, `Dosen_Nama`, `Dosen_User`, `Dosen_Pass`, `Dosen_Jabatan`, `Dosen_Photo`) VALUES
('198020051002', 'Devon Harijadi', 'devonharijadi1', 'Devonhar1982', 'Dosen Wali', ''),
('198120031001', 'Rio Skuravijh', 'rios1', 'skuy123', 'Dosen', ''),
('198120032001', 'Kelly Winata', 'kelly1', 'winata2', 'Dosen Wali', ''),
('198220071001', 'Dennis Dacosta', 'dennisdacosta1', 'D4c0sta', 'Dosen Wali', ''),
('198220072001', 'Jeannice Velae', 'jeannicevelae1', 'Catbury11', 'Dosen Wali', ''),
('198320062001', 'Vina Erland', 'vina123', 'aniv123', 'Dosen', ''),
('199005011013', 'Panca Eka', 'panca5eka1', 'EkaPanca15', 'Dosen Wali', ''),
('202010011013', 'Kenny Wijaya', 'dosen12', '123', 'Wakil Rektor', ''),
('202010071017', 'Marco Holiwono', 'loket1', '123', 'Dosen Wali', ''),
('202010151007', 'Benny Sudjipto', 'benny1', 'benny123', 'Rektor', ''),
('202011061010', 'David Brave', 'davidbrave244', 'a', 'Dosen', '');

-- --------------------------------------------------------

--
-- Table structure for table `Jabatan`
--

CREATE TABLE `Jabatan` (
  `Jabatan_ID` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Jabatan_Nama` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Jabatan`
--

INSERT INTO `Jabatan` (`Jabatan_ID`, `Jabatan_Nama`) VALUES
('JBT0001', 'Rektor'),
('JBT0002', 'Wakil Rektor'),
('JBT0003', 'Dekan'),
('JBT0004', 'Wakil Dekan'),
('JBT0005', 'Dosen Wali'),
('JBT0006', 'Dosen Pengajar');

-- --------------------------------------------------------

--
-- Table structure for table `Jabatan_Dosen`
--

CREATE TABLE `Jabatan_Dosen` (
  `Dosen_ID` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Jabatan_ID` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Jabatan_Dosen`
--

INSERT INTO `Jabatan_Dosen` (`Dosen_ID`, `Jabatan_ID`, `nomor`) VALUES
('202010071017', 'JBT0005', 15),
('202010031018', 'JBT0001', 16),
('198020051002', 'JBT0005', 19),
('198120031001', 'JBT0006', 20),
('198120032001', 'JBT0005', 21),
('198220071001', 'JBT0005', 22),
('198220072001', 'JBT0006', 23),
('198320062001', 'JBT0006', 24),
('199005011013', 'JBT0005', 25),
('202010011013', 'JBT0001', 26),
('202011061010', 'JBT0001', 27),
('198020051002', 'JBT0001', 28),
('202010151007', 'JBT0001', 29),
('198220072001', 'JBT0005', 30);

-- --------------------------------------------------------

--
-- Table structure for table `Jadwal_Kuliah`
--

CREATE TABLE `Jadwal_Kuliah` (
  `Jadwal_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Kelas_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Jadwal_Hari` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Jadwal_Mulai` time NOT NULL,
  `Jadwal_Selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Jadwal_Kuliah`
--

INSERT INTO `Jadwal_Kuliah` (`Jadwal_ID`, `Kelas_ID`, `Jadwal_Hari`, `Jadwal_Mulai`, `Jadwal_Selesai`) VALUES
('JDL0002', 'KLS0002', 'tuesday', '13:00:00', '15:30:00'),
('JDL0003', 'KLS0003', 'tuesday', '13:00:00', '15:30:00'),
('JDL0004', 'KLS0009', 'monday', '08:00:00', '10:30:00'),
('JDL0005', 'KLS0004', 'monday', '08:00:00', '10:30:00'),
('JDL0006', 'KLS0005', 'monday', '13:00:00', '15:30:00'),
('JDL0007', 'KLS0007', 'wednesday', '10:30:00', '13:00:00'),
('JDL0008', 'KLS0008', 'wednesday', '10:30:00', '13:00:00'),
('JDL0009', 'KLS0006', 'thursday', '10:30:00', '13:00:00'),
('JDL0010', 'KLS0011', 'thursday', '10:30:00', '13:00:00'),
('JDL0011', 'KLS0010', 'friday', '08:00:00', '10:30:00'),
('JDL0012', 'KLS0012', 'friday', '10:30:00', '13:00:00'),
('JDL0013', 'KLS0013', 'monday', '10:30:00', '01:00:00'),
('JDL0014', 'KLS0014', 'monday', '10:30:00', '13:00:00'),
('JDL0015', 'KLS0015', 'tuesday', '08:00:00', '10:30:00'),
('JDL0016', 'KLS0016', 'thursday', '10:30:00', '13:00:00'),
('JDL0017', 'KLS0017', 'friday', '13:00:00', '15:30:00'),
('JDL0018', 'KLS0018', 'monday', '13:00:00', '15:30:00'),
('JDL0019', 'KLS0019', 'tuesday', '08:00:00', '10:30:00'),
('JDL0020', 'KLS0020', 'wednesday', '10:30:00', '13:00:00'),
('JDL0021', 'KLS0021', 'wednesday', '10:30:00', '13:00:00'),
('JDL0022', 'KLS0022', 'thursday', '13:00:00', '15:30:00'),
('JDL0023', 'KLS0023', 'friday', '08:00:00', '10:30:00'),
('JDL0024', 'KLS0024', 'monday', '10:30:00', '13:00:00'),
('JDL0025', 'KLS0025', 'tuesday', '08:00:00', '10:30:00'),
('JDL0026', 'KLS0026', 'wednesday', '13:00:00', '15:30:00'),
('JDL0027', 'KLS0027', 'thursday', '08:00:00', '10:30:00'),
('JDL0028', 'KLS0028', 'thursday', '08:00:00', '10:30:00'),
('JDL0029', 'KLS0029', 'monday', '13:00:00', '15:30:00'),
('JDL0030', 'KLS0030', 'tuesday', '08:00:00', '10:30:00'),
('JDL0031', 'KLS0031', 'tuesday', '13:00:00', '15:30:00'),
('JDL0032', 'KLS0032', 'wednesday', '08:00:00', '10:30:00'),
('JDL0033', 'KLS0033', 'thursday', '13:00:00', '15:30:00'),
('JDL0034', 'KLS0034', 'friday', '08:00:00', '10:30:00'),
('JDL0035', 'KLS0035', 'monday', '10:30:00', '13:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Jadwal_Penting`
--

CREATE TABLE `Jadwal_Penting` (
  `Penting_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Jadwal_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Penting_Date` date NOT NULL,
  `Keterangan` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Jurusan`
--

CREATE TABLE `Jurusan` (
  `Jurusan_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Jurusan_Nama` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Jurusan`
--

INSERT INTO `Jurusan` (`Jurusan_ID`, `Jurusan_Nama`) VALUES
('J301', 'Sistem Informasi'),
('J501', 'Teknik Informatika'),
('J503', 'Teknik Elektro'),
('J504', 'Sistem Informasi Bisnis'),
('J601', 'Program Magister Sistem Informasi');

-- --------------------------------------------------------

--
-- Table structure for table `Kelas`
--

CREATE TABLE `Kelas` (
  `Kelas_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Matkulkurikulum_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `DosenPengajar_ID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Kelas_Nama` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Kelas_Ruangan` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Kelas_Kapasitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Kelas`
--

INSERT INTO `Kelas` (`Kelas_ID`, `Matkulkurikulum_ID`, `DosenPengajar_ID`, `Kelas_Nama`, `Kelas_Ruangan`, `Kelas_Kapasitas`) VALUES
('KLS0002', 'MLK0001', '198020051002', 'B', 'U-302', 0),
('KLS0003', 'MLK0001', '198120031001', 'A', 'L-201', 13),
('KLS0004', 'MLK0006', '202010151007', 'B', 'U-301', 15),
('KLS0005', 'MLK0004', '198220072001', 'A', 'L-201', 9),
('KLS0006', 'MLK0003', '198020051002', 'A', 'N-302', 20),
('KLS0007', 'MLK0005', '199005011013', 'A', 'N-301', 10),
('KLS0008', 'MLK0005', '198120032001', 'B', 'N-303', 10),
('KLS0009', 'MLK0006', '198020051002', 'A', 'U-401', 25),
('KLS0010', 'MLK0007', '198220071001', 'A', 'N-303', 20),
('KLS0011', 'MLK0008', '198220072001', 'B', 'N-401', 20),
('KLS0012', 'MLK0009', '198320062001', 'A', 'U-403', 20),
('KLS0013', 'MLK0010', '198020051002', 'A', 'N-101', 10),
('KLS0014', 'MLK0010', '198120032001', 'B', 'N-303', 10),
('KLS0015', 'MLK0011', '198120031001', 'A', 'N-302', 20),
('KLS0016', 'MLK0012', '198220072001', 'A', 'N-401', 20),
('KLS0017', 'MLK0013', '198120031001', 'A', 'U-401', 20),
('KLS0018', 'MLK0014', '198020051002', 'A', 'N-302', 15),
('KLS0019', 'MLK0015', '198120032001', 'A', 'N-301', 20),
('KLS0020', 'MLK0016', '198320062001', 'A', 'L-201', 15),
('KLS0021', 'MLK0016', '198120031001', 'B', 'L-401', 15),
('KLS0022', 'MLK0017', '202010151007', 'A', 'U-401', 30),
('KLS0023', 'MLK0018', '202010071017', 'A', 'N-301', 30),
('KLS0024', 'MLK0019', '202010011013', 'A', 'N-303', 20),
('KLS0025', 'MLK0020', '199005011013', 'A', 'N-401', 20),
('KLS0026', 'MLK0021', '198220071001', 'A', 'N-201', 30),
('KLS0027', 'MLK0022', '198020051002', 'A', 'L-201', 15),
('KLS0028', 'MLK0022', '198220072001', 'B', 'L-301', 15),
('KLS0029', 'MLK0023', '198220071001', 'A', 'L-401', 30),
('KLS0030', 'MLK0024', '198120032001', 'A', 'N-101', 25),
('KLS0031', 'MLK0025', '198320062001', 'A', 'U-401', 35),
('KLS0032', 'MLK0026', '202010151007', 'A', 'L-201', 35),
('KLS0033', 'MLK0027', '202011061010', 'A', 'N-302', 20),
('KLS0034', 'MLK0028', '198320062001', 'A', 'L-401', 15),
('KLS0035', 'MLK0001', '198120031001', 'A', 'R-301', 20);

-- --------------------------------------------------------

--
-- Table structure for table `Kelas_Praktikum`
--

CREATE TABLE `Kelas_Praktikum` (
  `Kelas_Praktikum_ID` int(11) NOT NULL,
  `Praktikum_ID` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Kelas_Praktikum_Ruangan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Kelas_Praktikum_Kapasitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Kelas_Praktikum`
--

INSERT INTO `Kelas_Praktikum` (`Kelas_Praktikum_ID`, `Praktikum_ID`, `Kelas_Praktikum_Ruangan`, `Kelas_Praktikum_Kapasitas`) VALUES
(1, 'P0001', 'L-401', 30),
(2, 'P0002', 'L-201', 15),
(3, 'P0002', 'L-301', 15),
(4, 'P0003', 'L-401', 10),
(5, 'P0003', 'L-301', 10),
(7, 'P0004', 'L-201', 15);

-- --------------------------------------------------------

--
-- Table structure for table `Kurikulum`
--

CREATE TABLE `Kurikulum` (
  `Kurikulum_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Kurikulum_Nama` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Kurikulum`
--

INSERT INTO `Kurikulum` (`Kurikulum_ID`, `Kurikulum_Nama`) VALUES
('K20041', 'Kurikulum Berbasis Kompetensi Tes'),
('K20061', 'Kurikulum Tingkat Satuan Pendidikan'),
('K20131', 'Kurikulum 2013'),
('K20132', 'Kurikulum 2013 Revisi'),
('K20201', 'Kurikulum 2020');

-- --------------------------------------------------------

--
-- Table structure for table `Log`
--

CREATE TABLE `Log` (
  `Log_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Admin_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Log_Deskripsi` text COLLATE utf8_unicode_ci NOT NULL,
  `Log_Date` date NOT NULL,
  `Log_Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Mahasiswa`
--

CREATE TABLE `Mahasiswa` (
  `Mahasiswa_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Dosen_Wali_ID` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Dosen_Pembimbing_ID` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Mahasiswa_Nama` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Mahasiswa_JK` char(1) COLLATE utf8_unicode_ci NOT NULL,
  `Mahasiswa_Alamat` text COLLATE utf8_unicode_ci NOT NULL,
  `Mahasiswa_Tgl` date NOT NULL,
  `Mahasiswa_Agama` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Mahasiswa_Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Mahasiswa_NoTelp` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Mahasiswa_Pass` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Mahasiswa_Jurusan` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Mahasiswa_Photo` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `Mahasiswa_Semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Mahasiswa`
--

INSERT INTO `Mahasiswa` (`Mahasiswa_ID`, `Dosen_Wali_ID`, `Dosen_Pembimbing_ID`, `Mahasiswa_Nama`, `Mahasiswa_JK`, `Mahasiswa_Alamat`, `Mahasiswa_Tgl`, `Mahasiswa_Agama`, `Mahasiswa_Email`, `Mahasiswa_NoTelp`, `Mahasiswa_Pass`, `Mahasiswa_Jurusan`, `Mahasiswa_Photo`, `Mahasiswa_Semester`) VALUES
('2145010001', '198220071001', '', 'Subaru Erina', 'F', 'Jl Tebet Dlm VI 40, Dki Jakarta', '1998-01-17', 'Kong Hu Cu', 'gogogo@gmail.com', '082340102003', 'gohan', '', '', 13),
('2153010003', '198220071001', '', 'Maeno Ema', 'F', 'Jl Kapuas 1, Dki Jakarta', '1997-12-06', 'Hindu', 'ema@gmail.com', '082340012001', 'ema222', '', '111193.jpg', 11),
('2155010004', '198220071001', '198120031001', 'Nagasawa Marina', 'F', 'Jl Tebet Dlm II 40, Dki Jakarta', '1997-11-13', 'Kong Hu Cu', 'marinanagasawa@gmail.com', '082340012003', 'belzebub', '', '', 11),
('2155010005', '198220071001', '198120031001', 'Lisa', 'M', 'Jl Setiabudi Simpang Psr 13 10 A, Sumatera Utara', '1997-01-02', 'Kristen', 'lisalisa@gmail.com', '082340012004', 'genuine123', '', '', 11),
('2155010006', '198220071001', '198120032001', 'Yamazaki Kento', 'F', 'Jl Adinegoro 2, Sumatera Utara', '1997-12-03', 'Katolik', 'kento@gmail.com', '082340012005', 'caramel11', '', '', 11),
('2155010007', '198120032001', '198120032001', 'Takahashi Rie', 'M', 'Jl Jateul Gg Tegalega 32 A/20 C, Jawa Barat', '1997-12-21', 'Buddha', 'explosion@gmail.com', '082340012006', 'yoakenoinu', '', '', 11),
('2155010008', '198120032001', '198120032001', 'Matsuoka Yoshitsugu', 'F', 'Jl Kb Kawung 44 B, Jawa Barat', '1997-07-13', 'Hindu', 'kirito@gmail.com', '082340012007', 'boris111', '', '', 11),
('2155010009', '198120032001', '198220072001', 'Kousaka Kirino', 'M', 'Kompl Griyo Kebraon Utama Fl DF 7, Jawa Timur', '1997-12-12', 'Katolik', 'tsuntsun@gmail.com', '082340012008', 'stagiare23', '', '', 11),
('2155020001', '198120032001', '198220072001', 'Orihime Hime', 'M', 'Kompl Tmn Permata Indah II Cl N/37, Dki Jakarta', '1997-12-25', 'Kong Hu Cu', 'himehime@gmail.com', '082340012009', 'latom', '', '', 11),
('2155020002', '198120032001', '198220072001', 'Akasaka Yoru', 'M', 'Jl Cipete Raya 16 B4 A/18, Dki Jakarta', '1997-01-21', 'Kristen', 'bangohan@gmail.com', '087890012001', 'honooo', '', '', 11),
('2163010005', '198120032001', '', 'Shirasaki Ayase', 'F', 'Jl Dorang 1, Jawa Timur', '1998-04-26', 'Katolik', 'shirasaki@gmail.com', '082340003001', 'shiro123', '', '', 9),
('2163010006', '198120032001', '', 'Yamato Kudo', 'F', 'Jl Dorang 2, Jawa Timur', '1998-10-28', 'Islam', 'kudo1@gmail.com', '082340003002', 'yama123', '', '', 9),
('2165010010', '198120032001', '', 'Tanaka Keiko', 'F', 'Jl Dorang 3, Jawa Timur', '1998-11-27', 'Kong Hu Cu', 'keiko23@gmail.com', '082340003003', 'tana123', '', '', 9),
('2165010011', '198120032001', '', 'Eru Eru', 'M', 'Jl Mujaer 1, Jawa Timur', '1998-02-22', 'Kristen', 'eru01@gmail.com', '082340003004', 'eru123', '', '', 9),
('2165010012', '198120032001', '', 'Sudou Ikagawa', 'F', 'Jl Mujaer 2, Jawa Timur', '1998-07-23', 'Katolik', 'ikagawa2@gmail.com', '082340003005', 'sudou123', '', '', 9),
('2165010013', '198020051002', '', 'Kuro Neko', 'M', 'Jl Mujaer 3, Jawa Timur', '1998-04-21', 'Buddha', 'kuro@gmail.com', '082340003006', 'kuro123', '', '', 9),
('2165010014', '198020051002', '', 'Yamada Kotarou', 'F', 'Jl Mujaer 4, Jawa Timur', '1998-07-28', 'Hindu', 'yamada22@gmail.com', '082340003007', 'yamada123', '', '', 9),
('2165010015', '198020051002', '', 'Yamada Eriri', 'M', 'Jl Mujaer 5, Jawa Timur', '1998-12-27', 'Islam', 'eririri@gmail.com', '082340003008', 'eriri123', '', '', 9),
('2165020003', '198020051002', '', 'Takeguchi Rina', 'M', 'Kompl Tmn Permata Indah II Bl N/38, Dki Jakarta', '1998-02-09', 'Kong Hu Cu', 'guchichan@gmail.com', '082340003009', 'take123', '', '', 9),
('2165020004', '198020051002', '', 'Watanabe Ken', 'M', 'Jl Cipete Raya 16 Bl B/18, Dki Jakarta', '1998-11-11', 'Kristen', 'ken2@gmail.com', '087890003001', 'watanabe123', '', '', 9),
('2165030001', '198020051002', '', 'Kanata Aria', 'F', 'Jl Jend Gatot Subroto 527, Jawa Barat', '1998-03-26', 'Katolik', 'ariaria@gmail.com', '087890003002', 'kanata123', '', '', 9),
('2165030002', '198020051002', '', 'Sorachi Hideaki', 'F', 'Jl Tujuh Belas Agustus II/29, Jawa Barat', '1998-06-29', 'Buddha', 'gintama@gmail.com', '087890003003', 'sorachi123', '', '', 9),
('2165050001', '198020051002', '198020051002', 'Matsumoto Kurazawa', 'F', 'Jl Utan Kayu Raya 80 A, Jakarta', '1998-08-09', 'Hindu', 'sawasawa@gmail.com', '087890003004', 'matsumoto123', '', '', 9),
('2165050003', '198020051002', '198020051002', 'Stella Rium', 'F', 'Jl Sultan Agung 9, Jawa Tengah', '1998-04-02', 'Kong Hu Cu', 'kano@gmail.com', '087890003006', 'stella123', '', '', 9),
('2173010007', '', '', 'Noah Jung', 'F', 'Jl H Domang 31, Dki Jakarta', '1997-09-06', 'Hindu', 'noahjung@gmail.com', '082340002001', 'tes', '', '', 7),
('2173010008', '', '', 'Jesse Pandebayang', 'F', 'Psr Tanah Abang Bl C/I 30 Lt 1, Dki Jakarta', '1999-10-18', 'Islam', 'jessepandebayang@gmail.com', '082340002002', '221116776', '', '', 7),
('2175010016', '', '', 'David Sinuraya', 'F', 'Jl Tebet Dlm III 40, Dki Jakarta', '1999-11-17', 'Kong Hu Cu', 'davidsinuraya@gmail.com', '082340002003', '221116777', '', '', 7),
('2175010018', '', '', 'Sriwidadi', 'F', 'Jl Adinegoro 1, Sumatera Utara', '1999-07-03', 'Katolik', 'sriwidadi@gmail.com', '082340002005', '221116779', '', '', 7),
('2175010019', '198020051002', '', 'Citra Inge Sugiarto', 'M', 'Jl Jateul Gg Tegalega 52 A/20 C, Jawa Barat', '1999-02-21', 'Buddha', 'citraingesugiarto@gmail.com', '082340002006', '221116780', '', '', 7),
('2175010020', '198020051002', '', 'Cahaya Widya Rachman', 'F', 'Jl Kb Kawung 74 B, Jawa Barat', '1999-07-18', 'Hindu', 'cahayawidyarachman@gmail.com', '082340002007', '221116781', '', '', 7),
('2175010021', '198020051002', '', 'Onggo Yanyu', 'M', 'Kompl Griyo Kebraon Utama Bl DF 7, Jawa Timur', '1999-12-07', 'Islam', 'onggoyanyu@gmail.com', '082340002008', '221116782', '', '', 7),
('2175020005', '198020051002', '', 'Wongsojoyo Ushi', 'M', 'Kompl Tmn Permata Indah II Bl N/37, Dki Jakarta', '1999-12-09', 'Kong Hu Cu', 'wongsojoyoushi@gmail.com', '082340002009', '221116783', '', '', 7),
('2175020006', '198020051002', '', 'Babette Silooy', 'M', 'Jl Cipete Raya 16 Bl A/18, Dki Jakarta', '1999-01-11', 'Kristen', 'babettesilooy@gmail.com', '087890002001', '221116784', '', '', 7),
('2175030003', '198020051002', '', 'Drusilla Malau', 'F', 'Jl Jend Gatot Subroto 517, Jawa Barat', '1999-03-21', 'Katolik', 'drusillamalau@gmail.com', '087890002002', '221116785', '', '', 7),
('2175030004', '198020051002', '', 'Elisha Hutabangun', 'F', 'Jl Tujuh Belas Agustus II/19, Jawa Barat', '1999-06-13', 'Buddha', 'elishahutabangun@gmail.com', '087890002003', '221116786', '', '', 7),
('2175050004', '198020051002', '198020051002', 'Terah Sinupayung', 'F', 'Jl Utan Kayu Raya 70 A, Jakarta', '1999-08-17', 'Hindu', 'terahsinupayung@gmail.com', '087890002004', '221116787', '', '', 7),
('2175050005', '198020051002', '198020051002', 'Ratu', 'F', 'Jl Metro Pd Indah Pondok Indah Mall, Dki Jakarta', '1999-12-13', 'Islam', 'ratu@gmail.com', '087890002005', '221116788', '', '', 7),
('2175050006', '198020051002', '198020051002', 'Utari', 'F', 'Jl Sultan Agung 3, Jawa Tengah', '1999-11-01', 'Kong Hu Cu', 'utari@gmail.com', '087890002006', '221116789', '', '', 7),
('2183010009', '198020051002', '', 'Djaja Raja Kusnadi', 'F', 'Jl Pacar 15 A, Jawa Barat', '2000-08-09', 'Kristen', 'djajarajakusnadi@gmail.com', '081230001001', '218116730', '', '', 5),
('2183010010', '198020051002', '', 'Hadi Slamet Susanto', 'F', 'Jl Legian Kuta, Bali', '2000-07-12', 'Katolik', 'hadislametsusanto@gmail.com', '081230001002', '218116731', '', '', 5),
('2185010022', '198020051002', '', 'Limijanto Yi', 'M', 'Jl Mangga 19, Dki Jakarta', '2000-09-29', 'Buddha', 'limijanto2i@gmail.com', '2025550101', '081230001003', '', '', 5),
('2185010023', '198020051002', '198020051002', 'Tejarukmana Shi', 'F', 'Jl Hayam Wuruk 1 R/V, Dki Jakarta', '2000-12-09', 'Hindu', 'tejarukmanashi@gmail.com', '081230001004', '218116733', '', '', 5),
('2185010024', '198020051002', '198020051002', 'Lard Pattinasarani', 'F', 'Jl Raden Saleh 51 Pav, Dki Jakarta', '2000-01-11', 'Islam', 'lardpattinasarani@gmail.com', '081230001005', '218116734', '', '', 5),
('2185010025', '198020051002', '198020051002', 'Abihu Ritonga', 'F', 'Jl Letjen South Parman Kav 21, Dki Jakarta', '2000-03-21', 'Kong Hu Cu', 'abihuritonga@gmail.com', '081230001006', '218116735', '', '', 5),
('2185020007', '198020051002', '198120031001', 'Timothy Sabab', 'M', 'Jl Darmo Permai Timur Vi/ 2, Propinsi Jawa Timur', '2000-06-21', 'Kristen', 'timothysabab@gmail.com', '081230001007', '218116736', '', '', 5),
('2185020008', '198020051002', '198120031001', 'Uzziah Batubara', 'F', 'Jl Dr Sutomo 29 BC, Sumatera Utara', '2000-08-16', 'Katolik', 'uzziahbatubara@gmail.com', '081230001008', '218116737', '', '', 5),
('2185030005', '198020051002', '198120031001', 'Kuwat', 'M', 'Jl Pejaten Brt II 7 Psr Minggu Pejaten Barat Jakarta Slt, Jakarta', '2000-11-11', 'Buddha', 'kuwat@gmail.com', '081230001009', '218116738', '', '', 5),
('2185030006', '198020051002', '198120032001', 'Suharto', 'F', 'Jl Mangga Besar V 277 B, Dki Jakarta', '2000-11-02', 'Hindu', 'Suharto@gmail.com', '082340001001', '218116739', '', '', 5),
('2185030007', '198120032001', '198120032001', 'Yanti Liana Hermawan', 'M', 'Jl Bahtera Bl Z-1/18 Kapuk Muara, Dki Jakarta', '2000-07-19', 'Islam', 'yantilianahermawan@gmail.com', '082340001002', '218116740', '', '', 5),
('2185040001', '198120032001', '198120032001', 'Eka Siska Sudjarwadi', 'F', 'Jl Raya Boulevard Tmr Raya Bl A/1, Dki Jakarta', '2000-08-15', 'Kong Hu Cu', 'ekasiskasudjarwadi@gmail.com', '082340001003', '218116741', '', '', 5),
('2185040002', '198120032001', '198220072001', 'Fandi Changying', 'M', 'Jl Kom L Yos Sudarso Kav 89, Dki Jakarta', '2000-11-05', 'Kristen', 'fandichangying@gmail.com', '082340001004', '218116742', '', '', 5),
('2185050007', '198120032001', '198220072001', 'Setiawan Yuèhai', 'F', 'Jl Asia Afrika - Pintu IX STC Senayan, Dki Jakarta', '2000-12-09', 'Katolik', 'setiawanyuehai@gmail.com', '082340001005', '218116743', '', '', 5),
('2185050008', '198120032001', '198220072001', 'Aicha Angwarmasse', 'F', 'Jl Mampang Prapatan 15 RT 14/04, Dki Jakarta', '2000-06-19', 'Buddha', 'aichaangwarmasse@gmail.com', '082340001006', '218116744', '', '', 5),
('2193010011', '198120032001', '198220071001', 'Chloe Meha', 'F', 'Jl Gedongan Palem Wulung 23, Jawa Tengah', '2001-06-28', 'Hindu', 'chlomeha@gmail.com', '082340001007', 'tes', '', '', 3),
('2193010012', '198120032001', '198220071001', 'Phoebe Gersang', 'M', 'Jl Cipagalo 214, Jawa Barat', '2001-11-15', 'Islam', 'phoebegersang@gmail.com', '082340001008', '219116746', '', '', 3),
('2193010013', '198120032001', '198220071001', 'Tamar Sidebang', 'F', 'Kompl Kopo Mas Regency Bl 18 C, Jawa Barat', '2001-12-29', 'Kong Hu Cu', 'tamarsidebang@gmail.com', '082340001009', '219116747', '', '', 3),
('2195010026', '198120032001', '198320062001', 'Eko', 'M', 'Jl KH Zainul Arifin Kompl Ketapang Indah Bl B-1/6, Dki Jakarta', '2001-06-12', 'Kristen', 'eko@gmail.com', '087890001001', '219116748', '', '', 3),
('2195010027', '198120032001', '198320062001', 'Surtinem', 'M', 'Jl Kramat Sawah Baru E-328, Dki Jakarta', '2001-08-18', 'Katolik', 'surtinem@gmail.com', '087890001002', '219116749', '', '', 3),
('2195010028', '198220072001', '198320062001', 'Surya Setiawan', 'M', 'Jl Kedung Cowek 120, Jawa Timur', '2001-09-06', 'Buddha', 'suryasetiawansetiabudi@gmail.com', '087890001003', 'tes', '', '', 3),
('2195010029', '198220072001', '', 'Harta Sugiarto Yuwono', 'M', 'Jl Majapahit 63, Jawa Tengah', '2001-10-18', 'Hindu', 'hartasugiartoyuwono@gmail.com', '087890001004', '219116751', '', '', 3),
('2195010030', '198220072001', '', 'Solikin Jian', 'M', 'Jl Balongpanggang 3 62283', '2001-11-17', 'Islam', 'solikinjian@gmail.com', '087890001005', '219116752', '', '', 3),
('2195020009', '198220072001', '', 'Tantama Shàoqiáng', 'F', 'Jl Kutisari Slt 105, Jawa Timur', '2001-09-01', 'Kong Hu Cu', 'tantamashaoqiang@gmail.com', '087890001006', '219116753', '', '', 3),
('2195020010', '198220072001', '', 'Ilan Tahapary', 'M', 'Jl Karang Anyar 55 Bl B/17 Karang Anyar, Dki Jakarta', '2001-07-03', 'Kristen', 'ilantahapary@gmail.com', '087890001007', '219116754', '', '', 3),
('2195030008', '198220072001', '', 'Silas Mano', 'M', 'Jl Toko Tiga 24, Dki Jakarta', '2001-02-21', 'Katolik', 'silasmano@gmail.com', '087890001008', '219116755', '', '', 3),
('2195040003', '198220072001', '', 'Zebedee Solin', 'F', 'Kompl Cemara Boulevard Bl A-1/30, Sumatera Utara', '2001-07-18', 'Buddha', 'zebedeesolin@gmail.com', '087890001009', '219116756', '', '', 3),
('2195040004', '198220072001', '', 'Phineas Limbong', 'M', 'Jl Tmn Ade Irma Suryani 3 A, Jawa Tengah', '2001-12-07', 'Hindu', 'phineaslimbong@gmail.com', '085670001001', '219116757', '', '', 3),
('2195040005', '198220072001', '', 'Raharjo', 'M', 'Psr Tanah Abang Bl A Los PKS/5 Lt 1, Dki Jakarta', '2001-12-09', 'Islam', 'raharjo@gmail.com', '085670001002', '219116758', '', '', 3),
('2195050009', '198220072001', '', 'Purwodarminto', 'F', 'Jl Puri Kencana Bl M-8/1 H Perk Puri Niaga III, Dki', '2001-02-05', 'Kong Hu Cu', 'purwodarminto@gmail.com', '085670001003', '219116759', '', '', 3),
('2203010014', '198220072001', '', 'Tri Batari Tedjo', 'M', 'l Puncak Permai Utr 47, Jawa Timur', '2002-03-21', 'Kristen', 'tribataritedjo@gmail.com', '085670001004', 'tes', '', '', 1),
('2205010031', '198220072001', '', 'Sari Batari Tedja', 'M', 'Jl Kaliwaru I 27 G, Jawa Timur', '2002-06-21', 'Katolik', 'saribataritedja@gmail.com', '085670001005', '220116761', '', '', 1),
('2205010032', '198220072001', '', 'Soeganda Meiying', 'F', 'Jl SH Wardoyo 15 RT 21, Sumatera Selatan', '2002-08-16', 'Buddha', 'soegandameiying@gmail.com', '085670001006', '220116762', '', '', 1),
('2205010033', '198220072001', '', 'Lukas Nuo', 'M', 'Jl P Jayakarta 115 Bl C 4, Dki Jakarta', '2002-10-10', 'Hindu', 'lukasnuo@gmail.com', '085670001007', '220116763', '', '', 1),
('2205010034', '198220072001', '', 'Gaelle Hehanusa', 'M', 'Jl Jend Basuki Rachmad 16-18, Jawa Timur', '2002-11-02', 'Islam', 'gaellehehanusa@gmail.com', '085670001008', '220116764', '', '', 1),
('2205010035', '198220072001', '', 'Grace Simargolang', 'M', 'Jl Penjernihan I 12 RT 006/06, Dki Jakarta', '2002-07-19', 'Kong Hu Cu', 'gracesimargolang@gmail.com', '085670001009', 'tes', '', '', 1),
('2205010036', '198020051002', '', 'David', 'M', 'klampis, Surabaya, null', '1999-02-02', '', 'davidbrave244@gmail.com', '098254430344', '2205010036098254430344', '', '', 1),
('2205010100', '198220072001', '', 'Cokro Yingjie', 'F', 'Jl Kereta Api Gg Pertama 61, Sumatera Utara', '2002-12-29', 'Kristen', 'cokroyingjie@gmail.com', '081230002007', '220116772', '', '', 1),
('2205020011', '', '', 'Neriah Rumahorbo', 'F', 'JL By Pass Prof Dr IB Mantra 98, Kesiman Kertalangu', '2002-08-15', 'Kristen', 'neriahrumahorbo@gmail.com', '081230002001', '220116766', '', '', 1),
('2205020012', '', '', 'Esther Sidari', 'M', 'Jl Pintu Besar Slt 34, Dki Jakarta', '2002-11-04', 'Katolik', 'esthersidari@gmail.com', '081230002002', '220116767', '', '', 1),
('2205020013', '', '', 'Wangi', 'F', 'Jl Rorotan 9/7, Dki Jakarta', '2002-12-03', 'Buddha', 'wangi@gmail.com', '081230002003', '220116768', '', '', 1),
('2205030009', '', '', 'Surtinem', 'F', 'Jl Darmo Indah Tmr Bl K/17, Jawa Timur', '2002-06-12', 'Hindu', 'surtinem@gmail.com', '081230002004', '220116769', '', '', 1),
('2205030010', '', '', 'Suparman Buana Halim', 'F', 'Jl Biru Laut X 21, Dki Jakarta', '2002-10-05', 'Islam', 'suparmanbuanahalim@gmail.com', '081230002005', '220116770', '', '', 1),
('2205030011', '198220072001', '198220072001', 'Doddy Raja Kusumo', 'F', 'Jl Banjardowo RT 003/II, Jawa Tengah', '2002-11-16', 'Kong Hu Cu', 'doddyrajakusumo@gmail.com', '081230002006', '220116771', '', '', 1),
('2205030013', '198220072001', '', 'Wuisan Changpu', 'F', 'Jl Arteri Mangga Dua Raya Mal Mangga Dua Bl B/89, Dki Jakarta', '2002-06-24', 'Katolik', 'wuisanchangpu@gmail.com', '081230002008', '220116773', '', '', 1),
('2205040006', '198220072001', '', 'Yorit Pooroe', 'F', 'Jl Jatiwaringin Raya 9, Dki Jakarta', '2002-08-23', 'Buddha', 'yoritpooroe@gmail.com', '081230002009', 'tes', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Major`
--

CREATE TABLE `Major` (
  `Major_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Jurusan_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Major_Nama` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `Major`
--

INSERT INTO `Major` (`Major_ID`, `Jurusan_ID`, `Major_Nama`) VALUES
('M50101', 'J501', 'Internet Technology'),
('M50102', 'J501', 'Computational Intelligence'),
('M50103', 'J501', 'Software Technology');

-- --------------------------------------------------------

--
-- Table structure for table `Matkul`
--

CREATE TABLE `Matkul` (
  `Matkul_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Matkul_Nama` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Matkul_Standar` decimal(3,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Matkul`
--

INSERT INTO `Matkul` (`Matkul_ID`, `Matkul_Nama`, `Matkul_Standar`) VALUES
('MK0001', 'Matematika 1', '50.0'),
('MK0002', 'Matematika 2', '50.0'),
('MK0003', 'Algoritma dan Pemrograman 1', '55.0'),
('MK0004', 'Algoritma dan Pemrograman 2', '55.0'),
('MK0005', 'Intro To Programming', '55.0'),
('MK0006', 'Struktur Data', '55.0'),
('MK0007', 'Struktur Data Lanjut', '55.0'),
('MK0008', 'Program Komputer Aplikasi', '60.0'),
('MK0009', 'Internet dan World Wide Web', '55.0'),
('MK0010', 'Pengantar Teknologi Informasi', '55.0'),
('MK0012', 'Jaringan Komputer', '50.0'),
('MK0013', 'Pemrograman Berorientasi Objek', '50.0'),
('MK0014', 'Analisa dan Desai Sistem', '55.0'),
('MK0015', 'Pemrograman Visual', '60.0'),
('MK0016', 'Sistem Digital', '50.0'),
('MK0017', 'Statistika Terapan', '50.0'),
('MK0018', 'Teori Graf', '55.0'),
('MK0019', 'Analisa Desain Berorientasi Objek', '55.0'),
('MK0020', 'Grafika Komputer', '55.0'),
('MK0021', 'Interaksi Manusia dan Komputer', '55.0'),
('MK0022', 'Pemrograman Client Server', '60.0'),
('MK0023', 'Pemrograman Web', '55.0'),
('MK0024', 'Framework Pemrograman Web', '55.0'),
('MK0025', 'Kecerdasan Buatan', '50.0'),
('MK0026', 'Mobile Device Programming', '60.0'),
('MK0027', 'Organisasi Komputer', '55.0'),
('MK0028', 'Rekayasa Perangkat Lunak', '50.0'),
('MK0029', 'Software Develpoment Project', '55.0'),
('MK0030', 'Embedded Systems', '55.0'),
('MK0031', 'Kapita Selekta', '50.0'),
('MK0032', 'Service Oriented Architecture', '50.0'),
('MK0033', 'Soft Computing', '50.0'),
('MK0034', 'Kerja Praktek', '60.0'),
('MK0035', 'Data Mining', '55.0'),
('MK0036', 'Artificial Intelligence for Games', '55.0'),
('MK0037', 'Big Data Processing', '60.0'),
('MK0038', 'Biomedical Informatics', '60.0'),
('MK0039', 'Computer Vision', '55.0'),
('MK0040', 'Evolutionary Programming', '60.0'),
('MK0041', 'Deep Learning & Advanced Machine Learning', '50.0'),
('MK0042', 'Natural Language Understanding', '50.0'),
('MK0043', 'Natural User Interface', '55.0'),
('MK0044', 'Sistem Operasi', '60.0'),
('MK0045', 'Teknik Kompilasi', '50.0'),
('MK0046', 'Web Mining', '55.0'),
('MK0047', 'Cloud Computing', '60.0'),
('MK0048', 'Distributed Database', '60.0'),
('MK0049', 'Internet Server Administration', '50.0'),
('MK0050', 'Internetworking', '55.0'),
('MK0051', 'Ios Mobile Programming', '50.0'),
('MK0052', 'Multimedia', '60.0'),
('MK0053', 'Network Programming', '55.0'),
('MK0054', 'Network Security', '55.0'),
('MK0055', 'Accounting Information System', '60.0'),
('MK0056', 'Design Patterns', '55.0'),
('MK0057', 'E-comm Application', '60.0'),
('MK0058', 'Enterprise Java', '50.0'),
('MK0059', 'Software Project Management', '60.0'),
('MK0060', 'Desain Kemasan', '55.0'),
('MK0061', 'abc', '50.0');

-- --------------------------------------------------------

--
-- Table structure for table `Matkul_Kurikulum`
--

CREATE TABLE `Matkul_Kurikulum` (
  `Matkul_Kurikulum_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Matkul_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Major_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Jurusan_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Kurikulum_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Periode_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Praktikum_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Semester` int(11) NOT NULL,
  `SKS` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Matkul_Kurikulum`
--

INSERT INTO `Matkul_Kurikulum` (`Matkul_Kurikulum_ID`, `Matkul_ID`, `Major_ID`, `Jurusan_ID`, `Kurikulum_ID`, `Periode_ID`, `Praktikum_ID`, `Semester`, `SKS`) VALUES
('MLK0001', 'MK0002', '', 'J501', 'K20041', '2018201921', '', 2, 3),
('MLK0004', 'MK0008', '', 'J501', 'K20201', '2020202111', 'P0004', 1, 3),
('MLK0005', 'MK0001', '', 'J501', 'K20132', '2019202011', '', 1, 3),
('MLK0006', 'MK0003', '', 'J501', 'K20041', '2018201921', '', 1, 3),
('MLK0007', 'MK0005', '', 'J501', 'K20201', '2018201911', 'P0002', 1, 3),
('MLK0008', 'MK0009', '', 'J501', 'K20132', '2019202021', 'P0001', 1, 2),
('MLK0009', 'MK0010', '', 'J501', 'K20061', '2019202021', '', 1, 3),
('MLK0010', 'MK0006', '', 'J501', 'K20201', '2018201911', '', 2, 3),
('MLK0011', 'MK0012', '', 'J501', 'K20041', '2018201911', '', 2, 2),
('MLK0012', 'MK0013', '', 'J501', 'K20201', '2018201911', '', 2, 3),
('MLK0013', 'MK0004', '', 'J501', 'K20132', '2018201911', '', 2, 3),
('MLK0014', 'MK0007', '', 'J501', 'K20061', '2018201921', '', 3, 3),
('MLK0015', 'MK0014', '', 'J501', 'K20061', '2018201921', '', 3, 2),
('MLK0016', 'MK0015', '', 'J501', 'K20201', '2017201821', 'P0003', 3, 3),
('MLK0017', 'MK0018', '', 'J501', 'K20132', '2016201721', '', 3, 2),
('MLK0018', 'MK0017', '', 'J501', 'K20131', '2017201821', '', 3, 3),
('MLK0019', 'MK0016', '', 'J501', 'K20132', '2018201911', '', 4, 3),
('MLK0020', 'MK0020', '', 'J501', 'K20061', '2017201821', '', 4, 3),
('MLK0021', 'MK0021', '', 'J501', 'K20061', '2017201821', '', 4, 2),
('MLK0022', 'MK0022', '', 'J501', 'K20201', '2017201821', '', 4, 3),
('MLK0023', 'MK0024', '', 'J501', 'K20132', '2019202021', '', 5, 3),
('MLK0024', 'MK0025', '', 'J501', 'K20201', '2019202021', '', 5, 2),
('MLK0025', 'MK0028', '', 'J501', 'K20132', '2019202011', '', 5, 3),
('MLK0026', 'MK0026', '', 'J501', 'K20132', '2017201811', '', 5, 3),
('MLK0027', 'MK0027', '', 'J501', 'K20201', '2018201921', '', 5, 2),
('MLK0028', 'MK0029', '', 'J501', 'K20132', '2019202021', '', 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `Pengambilan`
--

CREATE TABLE `Pengambilan` (
  `Pengambilan_ID` int(11) NOT NULL,
  `Mahasiswa_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Kelas_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `UTS` int(11) NOT NULL,
  `UAS` int(11) NOT NULL,
  `Quiz` int(11) NOT NULL,
  `Nilai_Akhir` int(11) NOT NULL,
  `Pengambilan_Grade` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `Pengambilan_Drop` int(1) NOT NULL,
  `Pengambilan_Batal` int(11) NOT NULL,
  `Jumlah_Ambil` int(11) NOT NULL,
  `Semester_Pengambilan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Pengambilan`
--

INSERT INTO `Pengambilan` (`Pengambilan_ID`, `Mahasiswa_ID`, `Kelas_ID`, `UTS`, `UAS`, `Quiz`, `Nilai_Akhir`, `Pengambilan_Grade`, `Pengambilan_Drop`, `Pengambilan_Batal`, `Jumlah_Ambil`, `Semester_Pengambilan`) VALUES
(1, '2205010031', 'KLS0003', 0, 0, 0, 0, '', 0, 0, 1, 1),
(2, '2205010032', '', 0, 0, 0, 0, '', 0, 0, 1, 1),
(3, '2205010033', 'KLS0005', 0, 0, 0, 0, '', 0, 0, 1, 1),
(5, '2205010032', '', 0, 0, 0, 0, '', 0, 0, 1, 1),
(6, '2195010028', 'KLS0011', 70, 80, 60, 74, 'B', 0, 0, 1, 2),
(7, '2195010028', 'KLS0021', 90, 50, 85, 70, 'B', 0, 0, 1, 2),
(8, '2195010028', 'KLS0002', 0, 0, 0, 0, '', 0, 0, 1, 3),
(9, '2195010028', 'KLS0005', 0, 0, 0, 0, '', 0, 0, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `Pengambilan_Praktikum`
--

CREATE TABLE `Pengambilan_Praktikum` (
  `Pengambilan_Praktikum_ID` int(11) NOT NULL,
  `Mahasiswa_ID` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Kelas_Praktikum_ID` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nilai_Praktikum` decimal(3,1) NOT NULL,
  `Jumlah_Ambil_Praktikum` int(11) NOT NULL,
  `Semester_Pengambilan_Praktikum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Pengambilan_Praktikum`
--

INSERT INTO `Pengambilan_Praktikum` (`Pengambilan_Praktikum_ID`, `Mahasiswa_ID`, `Kelas_Praktikum_ID`, `Nilai_Praktikum`, `Jumlah_Ambil_Praktikum`, `Semester_Pengambilan_Praktikum`) VALUES
(3, '2195010028', '7', '0.0', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `Periode`
--

CREATE TABLE `Periode` (
  `Periode_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Periode_Nama` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Periode`
--

INSERT INTO `Periode` (`Periode_ID`, `Periode_Nama`) VALUES
('2015201611', 'Tahun Ajaran 2015/2016 Semester Gasal'),
('2015201621', 'Tahun Ajaran 2015/2016 Semester Genap'),
('2016201711', 'Tahun Ajaran 2016/2017 Semester Gasal'),
('2016201721', 'Tahun Ajaran 2016/2017 Semester Genap'),
('2017201811', 'Tahun Ajaran 2017/2018 Semester Gasal'),
('2017201821', 'Tahun Ajaran 2017/2018 Semester Genap'),
('2018201911', 'Tahun Ajaran 2018/2019 Semester Gasal'),
('2018201921', 'Tahun Ajaran 2018/2019 Semester Genap'),
('2019202011', 'Tahun Ajaran 2019/2020 Semester Gasal'),
('2019202021', 'Tahun Ajaran 2019/2020 Semester Genap'),
('2020202111', 'Tahun Ajaran 2020/2021 Semester Gasal'),
('2020202121', 'Tahun Ajaran 2020/2021 Semester Genap'),
('2021202211', 'Tahun Ajaran 2021/2022 Semester Gasal'),
('2021202221', 'Tahun Ajaran 2021/2022 Semester Genap'),
('2022202311', 'Tahun Ajaran 2022/2023 Semester Gasal'),
('2022202321', 'Tahun Ajaran 2022/2023 Semester Genap');

-- --------------------------------------------------------

--
-- Table structure for table `Praktikum`
--

CREATE TABLE `Praktikum` (
  `Praktikum_ID` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Matkulkurikulum_ID` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Praktikum_Nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Praktikum_Hari` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Praktikum_Jam_Mulai` time NOT NULL,
  `Praktikum_Jam_Selesai` time NOT NULL,
  `Praktikum_Standar` decimal(3,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Praktikum`
--

INSERT INTO `Praktikum` (`Praktikum_ID`, `Matkulkurikulum_ID`, `Praktikum_Nama`, `Praktikum_Hari`, `Praktikum_Jam_Mulai`, `Praktikum_Jam_Selesai`, `Praktikum_Standar`) VALUES
('P0001', 'MLK0008', 'IWWW', 'Selasa', '12:00:00', '14:30:00', '50.5'),
('P0002', 'MLK0007', 'ITP', 'Rabu', '13:00:00', '14:30:00', '55.0'),
('P0003', 'MLK0016', 'PV', 'Jumat', '10:00:00', '12:00:00', '55.5'),
('P0004', 'MLK0004', 'PKA', 'Senin', '15:00:00', '16:30:00', '50.0');

-- --------------------------------------------------------

--
-- Table structure for table `Sidang_Skripsi`
--

CREATE TABLE `Sidang_Skripsi` (
  `Sidang_Skripsi_ID` int(11) NOT NULL,
  `Dosen_Pengamat_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Mahasiswa_ID` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Judul_Tesis` text COLLATE utf8_unicode_ci NOT NULL,
  `Sidang_Date` date NOT NULL,
  `Sidang_Mulai` time NOT NULL,
  `Sidang_Selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Absen`
--
ALTER TABLE `Absen`
  ADD PRIMARY KEY (`Absen_ID`);

--
-- Indexes for table `Administrator`
--
ALTER TABLE `Administrator`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `Ambil`
--
ALTER TABLE `Ambil`
  ADD PRIMARY KEY (`Ambil_ID`);

--
-- Indexes for table `Chat`
--
ALTER TABLE `Chat`
  ADD PRIMARY KEY (`Chat_ID`);

--
-- Indexes for table `Dosen`
--
ALTER TABLE `Dosen`
  ADD PRIMARY KEY (`Dosen_ID`);

--
-- Indexes for table `Jabatan_Dosen`
--
ALTER TABLE `Jabatan_Dosen`
  ADD PRIMARY KEY (`nomor`);

--
-- Indexes for table `Jadwal_Kuliah`
--
ALTER TABLE `Jadwal_Kuliah`
  ADD PRIMARY KEY (`Jadwal_ID`);

--
-- Indexes for table `Jadwal_Penting`
--
ALTER TABLE `Jadwal_Penting`
  ADD PRIMARY KEY (`Penting_ID`);

--
-- Indexes for table `Jurusan`
--
ALTER TABLE `Jurusan`
  ADD PRIMARY KEY (`Jurusan_ID`);

--
-- Indexes for table `Kelas`
--
ALTER TABLE `Kelas`
  ADD PRIMARY KEY (`Kelas_ID`);

--
-- Indexes for table `Kelas_Praktikum`
--
ALTER TABLE `Kelas_Praktikum`
  ADD PRIMARY KEY (`Kelas_Praktikum_ID`);

--
-- Indexes for table `Kurikulum`
--
ALTER TABLE `Kurikulum`
  ADD PRIMARY KEY (`Kurikulum_ID`);

--
-- Indexes for table `Log`
--
ALTER TABLE `Log`
  ADD PRIMARY KEY (`Log_ID`);

--
-- Indexes for table `Mahasiswa`
--
ALTER TABLE `Mahasiswa`
  ADD PRIMARY KEY (`Mahasiswa_ID`);

--
-- Indexes for table `Major`
--
ALTER TABLE `Major`
  ADD PRIMARY KEY (`Major_ID`);

--
-- Indexes for table `Matkul`
--
ALTER TABLE `Matkul`
  ADD PRIMARY KEY (`Matkul_ID`);

--
-- Indexes for table `Matkul_Kurikulum`
--
ALTER TABLE `Matkul_Kurikulum`
  ADD PRIMARY KEY (`Matkul_Kurikulum_ID`);

--
-- Indexes for table `Pengambilan`
--
ALTER TABLE `Pengambilan`
  ADD PRIMARY KEY (`Pengambilan_ID`);

--
-- Indexes for table `Pengambilan_Praktikum`
--
ALTER TABLE `Pengambilan_Praktikum`
  ADD PRIMARY KEY (`Pengambilan_Praktikum_ID`);

--
-- Indexes for table `Periode`
--
ALTER TABLE `Periode`
  ADD PRIMARY KEY (`Periode_ID`);

--
-- Indexes for table `Praktikum`
--
ALTER TABLE `Praktikum`
  ADD PRIMARY KEY (`Praktikum_ID`);

--
-- Indexes for table `Sidang_Skripsi`
--
ALTER TABLE `Sidang_Skripsi`
  ADD PRIMARY KEY (`Sidang_Skripsi_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Ambil`
--
ALTER TABLE `Ambil`
  MODIFY `Ambil_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `Chat`
--
ALTER TABLE `Chat`
  MODIFY `Chat_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Jabatan_Dosen`
--
ALTER TABLE `Jabatan_Dosen`
  MODIFY `nomor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `Kelas_Praktikum`
--
ALTER TABLE `Kelas_Praktikum`
  MODIFY `Kelas_Praktikum_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Pengambilan`
--
ALTER TABLE `Pengambilan`
  MODIFY `Pengambilan_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `Pengambilan_Praktikum`
--
ALTER TABLE `Pengambilan_Praktikum`
  MODIFY `Pengambilan_Praktikum_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Sidang_Skripsi`
--
ALTER TABLE `Sidang_Skripsi`
  MODIFY `Sidang_Skripsi_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
