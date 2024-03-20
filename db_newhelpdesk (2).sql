-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 03:05 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_newhelpdesk`
--

-- --------------------------------------------------------

--
-- Table structure for table `log_activity`
--

CREATE TABLE `log_activity` (
  `id_log` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `cat_log` varchar(20) NOT NULL,
  `desk_log` text NOT NULL,
  `date_log` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_activity`
--

INSERT INTO `log_activity` (`id_log`, `id_user`, `cat_log`, `desk_log`, `date_log`) VALUES
(68, 1, 'tb_lokasi', 'Menambakan lokasi baru dengan nama HO - JAKARTA.', '2023-11-13 09:01:10'),
(69, 1, 'tb_lokasi', 'Menambakan lokasi baru dengan nama PLAN - PURWAKARTA.', '2023-11-13 09:01:18'),
(70, 1, 'tb_whatsapp', 'Memperbaharui konfigurasi whatsapp', '2023-11-13 09:13:57'),
(71, 1, 'tb_client', 'Menambakan client baru dengan nama Lizam Hermansyah.', '2023-11-15 09:13:22'),
(72, 1, 'tb_email', 'Memperbaharui konfigurasi email', '2023-11-15 14:31:56');

-- --------------------------------------------------------

--
-- Table structure for table `tb_akses`
--

CREATE TABLE `tb_akses` (
  `id_akses` int(11) NOT NULL,
  `nama_akses` varchar(100) NOT NULL,
  `ket_akses` text NOT NULL,
  `sts_akses` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_akses`
--

INSERT INTO `tb_akses` (`id_akses`, `nama_akses`, `ket_akses`, `sts_akses`) VALUES
(1, 'Administrator', 'Administrator adalah yang bisa mengakses semua menu.', 1),
(2, 'Koordinator', 'Koordinator adalah akses yang bisa melihat semua progress dan report sesuai divisi yang disettingnya.', 1),
(3, 'Troubleshooter', 'Troubleshooter memiliki akses untuk mengambil ticket sesuai divisi dan lokasi yang sudah disetting', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

CREATE TABLE `tb_category` (
  `id_cat` int(11) NOT NULL,
  `id_div` int(11) NOT NULL,
  `nama_cat` varchar(100) NOT NULL,
  `sts_cat` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_category`
--

INSERT INTO `tb_category` (`id_cat`, `id_div`, `nama_cat`, `sts_cat`) VALUES
(8, 5, 'Software', 1),
(9, 5, 'Hardware', 1),
(10, 6, 'Mesin', 1),
(11, 7, 'Elektrik', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_client`
--

CREATE TABLE `tb_client` (
  `id_client` int(11) NOT NULL,
  `id_loc` int(11) NOT NULL,
  `id_dept` int(11) NOT NULL,
  `nama_client` varchar(100) NOT NULL,
  `tlp_client` varchar(100) NOT NULL,
  `email_client` varchar(100) NOT NULL,
  `username_client` varchar(100) NOT NULL,
  `pass_client` varchar(100) NOT NULL,
  `sts_client` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_client`
--

INSERT INTO `tb_client` (`id_client`, `id_loc`, `id_dept`, `nama_client`, `tlp_client`, `email_client`, `username_client`, `pass_client`, `sts_client`) VALUES
(2, 10, 12, 'Lizam Hermansyah', '087879800730', 'lizam.hermansyah@gmail.com', 'ibamcandra', '25d55ad283aa400af464c76d713c07ad', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_department`
--

CREATE TABLE `tb_department` (
  `id_dept` int(11) NOT NULL,
  `nama_dept` varchar(100) NOT NULL,
  `sts_dept` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_department`
--

INSERT INTO `tb_department` (`id_dept`, `nama_dept`, `sts_dept`) VALUES
(10, 'HRD & GA', 1),
(11, 'WHS & LOG', 1),
(12, 'AKUNTING', 1),
(13, 'PRODUKSI', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_division`
--

CREATE TABLE `tb_division` (
  `id_div` int(11) NOT NULL,
  `nama_div` varchar(100) NOT NULL,
  `id_email` int(11) NOT NULL DEFAULT 1,
  `id_wa` int(11) NOT NULL DEFAULT 1,
  `sts_div` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_division`
--

INSERT INTO `tb_division` (`id_div`, `nama_div`, `id_email`, `id_wa`, `sts_div`) VALUES
(1, 'All Division', 1, 1, 1),
(5, 'IT Support', 1, 1, 1),
(6, 'Engineering', 1, 1, 1),
(7, 'Maintenance', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_email`
--

CREATE TABLE `tb_email` (
  `id_email` int(11) NOT NULL,
  `alamat_email` varchar(100) NOT NULL,
  `pass_email` varchar(100) NOT NULL,
  `smtphost_email` varchar(100) NOT NULL,
  `smtpport_email` varchar(100) NOT NULL,
  `sts_email` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_email`
--

INSERT INTO `tb_email` (`id_email`, `alamat_email`, `pass_email`, `smtphost_email`, `smtpport_email`, `sts_email`) VALUES
(1, 'cs@kantahkrs.id', 'kantahkrssukses2023', 'ssl://mail.kantahkrs.id', '465', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_location`
--

CREATE TABLE `tb_location` (
  `id_loc` int(11) NOT NULL,
  `nama_loc` varchar(100) NOT NULL,
  `sts_loc` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_location`
--

INSERT INTO `tb_location` (`id_loc`, `nama_loc`, `sts_loc`) VALUES
(1, 'All Location', 1),
(10, 'HO - JAKARTA', 1),
(11, 'PLAN - PURWAKARTA', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_notifemail_client`
--

CREATE TABLE `tb_notifemail_client` (
  `id_notifemail_client` int(11) NOT NULL,
  `no_ticket` varchar(100) NOT NULL,
  `ket_notif` varchar(10) NOT NULL DEFAULT 'open',
  `sts_notif` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_notifemail_client`
--

INSERT INTO `tb_notifemail_client` (`id_notifemail_client`, `no_ticket`, `ket_notif`, `sts_notif`) VALUES
(31, 'TICK111158001', 'open', 2),
(32, 'TICK111059002', 'open', 2),
(33, 'TICK111059002', 'proses', 2),
(34, 'TICK111158001', 'proses', 2),
(35, 'TICK111059003', 'open', 2),
(36, 'TICK111059002', 'finish', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_notifwa_client`
--

CREATE TABLE `tb_notifwa_client` (
  `id_notifwa_client` int(11) NOT NULL,
  `no_ticket` varchar(100) NOT NULL,
  `ket_notif` varchar(10) NOT NULL DEFAULT 'open',
  `sts_notif` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_notifwa_client`
--

INSERT INTO `tb_notifwa_client` (`id_notifwa_client`, `no_ticket`, `ket_notif`, `sts_notif`) VALUES
(31, 'TICK111158001', 'open', 2),
(32, 'TICK111059002', 'open', 2),
(33, 'TICK111059002', 'proses', 2),
(34, 'TICK111158001', 'proses', 2),
(35, 'TICK111059003', 'open', 2),
(36, 'TICK111059002', 'finish', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_notifwa_ts`
--

CREATE TABLE `tb_notifwa_ts` (
  `id_notifwa_ts` int(11) NOT NULL,
  `no_ticket` varchar(100) NOT NULL,
  `ket_notif` varchar(10) NOT NULL DEFAULT 'open',
  `sts_notif` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_notifwa_ts`
--

INSERT INTO `tb_notifwa_ts` (`id_notifwa_ts`, `no_ticket`, `ket_notif`, `sts_notif`) VALUES
(31, 'TICK111158001', 'open', 2),
(32, 'TICK111059002', 'open', 2),
(33, 'TICK111059002', 'proses', 2),
(34, 'TICK111158001', 'proses', 2),
(35, 'TICK111059003', 'open', 2),
(36, 'TICK111059002', 'finish', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_organisasi`
--

CREATE TABLE `tb_organisasi` (
  `id_org` int(11) NOT NULL,
  `nama_org` varchar(100) NOT NULL,
  `short_org` varchar(100) NOT NULL,
  `alamat_org` text NOT NULL,
  `tlp_org` varchar(20) NOT NULL,
  `email_org` varchar(20) NOT NULL,
  `favicon_org` varchar(100) NOT NULL,
  `logo_org` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_organisasi`
--

INSERT INTO `tb_organisasi` (`id_org`, `nama_org`, `short_org`, `alamat_org`, `tlp_org`, `email_org`, `favicon_org`, `logo_org`) VALUES
(1, 'PT Blucoppia Teknologi Indonesia', 'BLUCOPPIA', 'Jl. Raya Tanjung Garut RT/RW 06/02 Ds. Cijunti, Kec. Cijunti, Kab. Purwakarta', '087879800730', 'blucoppia@gmail.com', 'Buleleng_Compress_11.png', 'Buleleng_Compress_1.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_progress`
--

CREATE TABLE `tb_progress` (
  `id_progress` int(11) NOT NULL,
  `tgl_progress` date NOT NULL,
  `jam_progress` time NOT NULL,
  `no_ticket` varchar(255) NOT NULL,
  `ket_progress` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_progress`
--

INSERT INTO `tb_progress` (`id_progress`, `tgl_progress`, `jam_progress`, `no_ticket`, `ket_progress`) VALUES
(2, '2023-11-15', '09:12:04', 'TICK111158001', 'Ticket dibuat oleh Klien'),
(3, '2023-11-15', '09:17:58', 'TICK111059002', 'Ticket dibuat oleh Klien'),
(4, '2023-11-15', '09:57:23', 'TICK111059002', 'Ticket telah ditangani oleh teknisi'),
(5, '2023-11-15', '09:57:29', 'TICK111158001', 'Ticket telah ditangani oleh teknisi'),
(6, '2023-11-15', '10:41:33', 'TICK111059003', 'Ticket dibuat oleh Klien'),
(7, '2023-11-15', '13:58:23', 'TICK111059002', 'Perobaan mengganti RAM'),
(8, '2023-11-15', '13:58:47', 'TICK111158001', 'Sudah dilaporkan ke ISP terkait internet down'),
(9, '2023-11-15', '14:03:45', 'TICK111059002', 'Ticket telah diselesaikan. Catatan Teknisi:RAM diganti dengan yang baru');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ticket`
--

CREATE TABLE `tb_ticket` (
  `id_ticket` int(11) NOT NULL,
  `no_ticket` varchar(255) NOT NULL,
  `id_loc` int(11) NOT NULL,
  `id_client` int(11) NOT NULL DEFAULT 0,
  `nama_ticket` varchar(100) NOT NULL,
  `id_dept` int(11) NOT NULL,
  `email_ticket` varchar(100) NOT NULL,
  `tlp_ticket` varchar(20) NOT NULL,
  `id_div` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `desk_ticket` text NOT NULL,
  `lampiran_ticket` varchar(150) DEFAULT NULL,
  `create_ticket` date NOT NULL DEFAULT current_timestamp(),
  `start_time` time NOT NULL DEFAULT current_timestamp(),
  `finish_ticket` date DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `exe_time` datetime DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `remark_ticket` text DEFAULT NULL,
  `priority_ticket` varchar(10) DEFAULT '1',
  `sts_ticket` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_ticket`
--

INSERT INTO `tb_ticket` (`id_ticket`, `no_ticket`, `id_loc`, `id_client`, `nama_ticket`, `id_dept`, `email_ticket`, `tlp_ticket`, `id_div`, `id_cat`, `desk_ticket`, `lampiran_ticket`, `create_ticket`, `start_time`, `finish_ticket`, `end_time`, `exe_time`, `id_user`, `remark_ticket`, `priority_ticket`, `sts_ticket`) VALUES
(107, 'TICK111158001', 11, 0, 'Beiby Gloria', 12, 'lizam.hermansyah@gmail.com', '087879800730', 5, 8, 'HAHAHIHIHUHUHEHEHOHO', NULL, '2023-11-15', '09:12:04', NULL, NULL, '2023-11-15 09:57:29', 1, NULL, '1', 2),
(108, 'TICK111059002', 10, 2, 'Lizam Hermansyah', 12, 'lizam.hermansyah@gmail.com', '087879800730', 5, 9, 'Jajajajajejejejujujujojojo', NULL, '2023-11-15', '09:17:58', '2023-11-15', '14:03:45', '2023-11-15 09:57:23', 1, 'RAM diganti dengan yang baru', '1', 3),
(109, 'TICK111059003', 10, 2, 'Lizam Hermansyah', 12, 'lizam.hermansyah@gmail.com', '087879800730', 5, 9, 'KAKAKAKIKIKUKUKU', NULL, '2023-11-15', '10:41:33', NULL, NULL, NULL, NULL, NULL, '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `id_div` int(11) NOT NULL,
  `id_loc` int(11) NOT NULL,
  `id_akses` int(11) NOT NULL,
  `username_user` varchar(100) NOT NULL,
  `pass_user` varchar(100) NOT NULL,
  `tlp_user` varchar(100) NOT NULL,
  `sts_user` int(1) NOT NULL DEFAULT 1,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `id_div`, `id_loc`, `id_akses`, `username_user`, `pass_user`, `tlp_user`, `sts_user`, `last_login`) VALUES
(1, 'Lizam Hermansyah', 1, 1, 1, 'superadmin', '682cc7d993d4b56d7c8b728923b99062', '087879800730', 1, '2023-11-15 08:31:47'),
(7, 'Admin', 1, 1, 1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '087879800730', 1, '2023-10-09 11:49:52');

-- --------------------------------------------------------

--
-- Table structure for table `tb_waconfig`
--

CREATE TABLE `tb_waconfig` (
  `id_wa` int(11) NOT NULL,
  `no_wa` varchar(100) NOT NULL,
  `token_wa` varchar(255) NOT NULL,
  `sts_wa` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_waconfig`
--

INSERT INTO `tb_waconfig` (`id_wa`, `no_wa`, `token_wa`, `sts_wa`) VALUES
(1, '087879800730', 'kMfPN#+N1Peh9Zn5986#', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_wagroup`
--

CREATE TABLE `tb_wagroup` (
  `id_wagroup` int(11) NOT NULL,
  `id_loc` int(11) NOT NULL,
  `id_div` int(11) NOT NULL,
  `nama_wagroup` varchar(100) NOT NULL,
  `token_wagroup` varchar(100) NOT NULL,
  `sts_wagroup` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_wagroup`
--

INSERT INTO `tb_wagroup` (`id_wagroup`, `id_loc`, `id_div`, `nama_wagroup`, `token_wagroup`, `sts_wagroup`) VALUES
(4, 11, 5, 'Ticket PWK', '120363184790849706@g.us', 1),
(5, 10, 5, 'Percobaan', '120363049084695399@g.us', 1),
(6, 11, 6, 'Eng Test', '120363198427542562@g.us', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `tb_akses`
--
ALTER TABLE `tb_akses`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indexes for table `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indexes for table `tb_client`
--
ALTER TABLE `tb_client`
  ADD PRIMARY KEY (`id_client`),
  ADD UNIQUE KEY `username_client` (`username_client`);

--
-- Indexes for table `tb_department`
--
ALTER TABLE `tb_department`
  ADD PRIMARY KEY (`id_dept`);

--
-- Indexes for table `tb_division`
--
ALTER TABLE `tb_division`
  ADD PRIMARY KEY (`id_div`);

--
-- Indexes for table `tb_location`
--
ALTER TABLE `tb_location`
  ADD PRIMARY KEY (`id_loc`);

--
-- Indexes for table `tb_notifemail_client`
--
ALTER TABLE `tb_notifemail_client`
  ADD PRIMARY KEY (`id_notifemail_client`);

--
-- Indexes for table `tb_notifwa_client`
--
ALTER TABLE `tb_notifwa_client`
  ADD PRIMARY KEY (`id_notifwa_client`);

--
-- Indexes for table `tb_notifwa_ts`
--
ALTER TABLE `tb_notifwa_ts`
  ADD PRIMARY KEY (`id_notifwa_ts`);

--
-- Indexes for table `tb_organisasi`
--
ALTER TABLE `tb_organisasi`
  ADD PRIMARY KEY (`id_org`);

--
-- Indexes for table `tb_progress`
--
ALTER TABLE `tb_progress`
  ADD PRIMARY KEY (`id_progress`);

--
-- Indexes for table `tb_ticket`
--
ALTER TABLE `tb_ticket`
  ADD PRIMARY KEY (`id_ticket`),
  ADD UNIQUE KEY `no_ticket` (`no_ticket`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username_user` (`username_user`);

--
-- Indexes for table `tb_waconfig`
--
ALTER TABLE `tb_waconfig`
  ADD PRIMARY KEY (`id_wa`);

--
-- Indexes for table `tb_wagroup`
--
ALTER TABLE `tb_wagroup`
  ADD PRIMARY KEY (`id_wagroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `tb_akses`
--
ALTER TABLE `tb_akses`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_client`
--
ALTER TABLE `tb_client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_department`
--
ALTER TABLE `tb_department`
  MODIFY `id_dept` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_division`
--
ALTER TABLE `tb_division`
  MODIFY `id_div` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_location`
--
ALTER TABLE `tb_location`
  MODIFY `id_loc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_notifemail_client`
--
ALTER TABLE `tb_notifemail_client`
  MODIFY `id_notifemail_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tb_notifwa_client`
--
ALTER TABLE `tb_notifwa_client`
  MODIFY `id_notifwa_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tb_notifwa_ts`
--
ALTER TABLE `tb_notifwa_ts`
  MODIFY `id_notifwa_ts` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tb_organisasi`
--
ALTER TABLE `tb_organisasi`
  MODIFY `id_org` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_progress`
--
ALTER TABLE `tb_progress`
  MODIFY `id_progress` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_ticket`
--
ALTER TABLE `tb_ticket`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_waconfig`
--
ALTER TABLE `tb_waconfig`
  MODIFY `id_wa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_wagroup`
--
ALTER TABLE `tb_wagroup`
  MODIFY `id_wagroup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
