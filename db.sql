CREATE DATABASE `indosma` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `indosma`;

-- --------------------------------------------------------

--
-- Table structure for table `diskusi`
--

CREATE TABLE IF NOT EXISTS `diskusi` (
  `id_diskusi` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kelas` char(6) NOT NULL,
  `id_pengguna` int(35) NOT NULL,
  `isi_diskusi` text NOT NULL,
  `datecreated` datetime NOT NULL,
  PRIMARY KEY (`id_diskusi`),
  KEY `idx_kode_kelas` (`kode_kelas`),
  KEY `kode_kelas` (`kode_kelas`),
  KEY `id_pengguna` (`id_pengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `diskusi`
--


-- --------------------------------------------------------

--
-- Table structure for table `jawab_diskusi`
--

CREATE TABLE IF NOT EXISTS `jawab_diskusi` (
  `id_jawab_diskusi` int(11) NOT NULL AUTO_INCREMENT,
  `id_diskusi` int(11) DEFAULT NULL,
  `id_pengguna` int(35) DEFAULT NULL,
  `isi_jawab_diskusi` text,
  `datecreated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_jawab_diskusi`),
  KEY `idx_fk_id_diskusi` (`id_diskusi`),
  KEY `idx_fk_id_pengguna` (`id_pengguna`),
  KEY `id_diskusi` (`id_diskusi`),
  KEY `id_pengguna` (`id_pengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jawab_diskusi`
--


-- --------------------------------------------------------

--
-- Table structure for table `jawaban_pesan`
--

CREATE TABLE IF NOT EXISTS `jawaban_pesan` (
  `id_jawaban_pesan` int(11) NOT NULL AUTO_INCREMENT,
  `id_pesan` int(11) DEFAULT NULL,
  `id_pengirim` int(35) DEFAULT NULL,
  `id_tujuan` int(35) DEFAULT NULL,
  `isi_jawaban_pesan` text,
  `datecreated` datetime DEFAULT NULL,
  `status_dilihat` enum('1','0') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_jawaban_pesan`),
  KEY `idx_fk_id_pesan` (`id_pesan`),
  KEY `idx_fk_id_pengirim` (`id_pengirim`),
  KEY `idx_fk_id_tujuan` (`id_tujuan`),
  KEY `id_pengirim` (`id_pengirim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `jawaban_pesan`
--


-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `kode_kelas` char(6) NOT NULL,
  `nama_kelas` varchar(155) DEFAULT NULL,
  `id_pengguna` int(35) DEFAULT NULL,
  `kode_pt` char(5) DEFAULT NULL,
  `jurusan` varchar(155) DEFAULT NULL,
  `datecreated` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_kelas`),
  KEY `idx_fk_id_jurusan` (`jurusan`),
  KEY `kode_pt` (`kode_pt`),
  KEY `id_pengguna` (`id_pengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`kode_kelas`, `nama_kelas`, `id_pengguna`, `kode_pt`, `jurusan`, `datecreated`) VALUES
('ie', 'Jar. Syaraf Tiruan', 112288, '2', 'IF', '2014-10-01 01:34:18');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_pengguna`
--

CREATE TABLE IF NOT EXISTS `kelas_pengguna` (
  `id_kelas_pengguna` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kelas` char(6) NOT NULL,
  `id_pengguna` int(35) NOT NULL,
  `kode_pt` char(5) DEFAULT NULL,
  PRIMARY KEY (`id_kelas_pengguna`),
  KEY `kode_kelas` (`kode_kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `kelas_pengguna`
--

INSERT INTO `kelas_pengguna` (`id_kelas_pengguna`, `kode_kelas`, `id_pengguna`, `kode_pt`) VALUES
(2, 'ie', 112288, '2'),
(3, 'ie', 1142045, '2');

-- --------------------------------------------------------

--
-- Table structure for table `komentar_status`
--

CREATE TABLE IF NOT EXISTS `komentar_status` (
  `id_komentar_status` int(11) NOT NULL AUTO_INCREMENT,
  `id_status` int(11) DEFAULT NULL,
  `id_pengguna` int(35) DEFAULT NULL,
  `isi_komentar` text,
  `datecreated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_komentar_status`),
  KEY `idx_fk_id_pengguna` (`id_pengguna`),
  KEY `idx_fk_status` (`id_status`),
  KEY `id_status` (`id_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `komentar_status`
--


-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE IF NOT EXISTS `materi` (
  `id_materi` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kelas` char(6) DEFAULT NULL,
  `id_pengguna` int(35) DEFAULT NULL,
  `nama_materi` varchar(45) DEFAULT NULL,
  `isi_materi` text,
  `file_materi` varchar(200) DEFAULT NULL,
  `datecreated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_materi`),
  KEY `idx_fk_kode_kelas` (`kode_kelas`),
  KEY `idx_fk_id_pengguna` (`id_pengguna`),
  KEY `kode_kelas` (`kode_kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id_materi`, `kode_kelas`, `id_pengguna`, `nama_materi`, `isi_materi`, `file_materi`, `datecreated`) VALUES
(1, 'ie', 112288, 'Neural Network ', 'Research in the field of neural networks has been attracting increasing attention\r\nin recent years. Since 1943, when Warren McCulloch and Walter Pitts presented the first model of artificial neurons, new and more sophisticated proposals have been made from decade to decade. Mathematical analysis has solved some of the mysteries posed by the new models but has left many questions open for future investigations. Needless to say, the study of neurons, their interconnections, and their role as the brain’s elementary building blocks is one of the most dynamic and important research fields in modern biology. We can illustrate the relevance of this endeavor by pointing out that between 1901 and 1991 approximately ten percent of the Nobel Prizes for Physiology and Medicine were awarded to scientists who contributed to the understanding of the brain. It is not an exaggeration to say that we have learned more about the nervous system in the last fifty years than ever before.', '2007-19.pdf', '2014-10-01 01:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `memo`
--

CREATE TABLE IF NOT EXISTS `memo` (
  `id_memo` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengguna` int(35) DEFAULT NULL,
  `judul_memo` varchar(45) DEFAULT NULL,
  `isi_memo` text,
  `datecreated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_memo`),
  KEY `idx_fk_id_pengguna` (`id_pengguna`),
  KEY `id_pengguna` (`id_pengguna`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `memo`
--

INSERT INTO `memo` (`id_memo`, `id_pengguna`, `judul_memo`, `isi_memo`, `datecreated`) VALUES
(1, 112288, 'Catatan', 'ini isi catatan', '2014-10-01 01:43:08');

-- --------------------------------------------------------

--
-- Table structure for table `multileveldata`
--

CREATE TABLE IF NOT EXISTS `multileveldata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `induk` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `multileveldata`
--


-- --------------------------------------------------------

--
-- Table structure for table `nilai_tugas`
--

CREATE TABLE IF NOT EXISTS `nilai_tugas` (
  `id_nilai_tugas` int(11) NOT NULL AUTO_INCREMENT,
  `id_tugas` int(11) DEFAULT NULL,
  `id_pengguna` int(35) DEFAULT NULL,
  `nilai_tugas` char(5) DEFAULT NULL,
  `file_tugas` varchar(255) DEFAULT NULL,
  `datecreated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_nilai_tugas`),
  KEY `idx_fk_id_tugas` (`id_tugas`),
  KEY `idx_fk_id_pengguna` (`id_pengguna`),
  KEY `id_tugas` (`id_tugas`),
  KEY `id_pengguna` (`id_pengguna`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `nilai_tugas`
--

INSERT INTO `nilai_tugas` (`id_nilai_tugas`, `id_tugas`, `id_pengguna`, `nilai_tugas`, `file_tugas`, `datecreated`) VALUES
(1, 1, 1142045, NULL, 'ArtificialNeuralNetworks240506.pdf', '2014-10-01 01:42:07');

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE IF NOT EXISTS `notifikasi` (
  `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengguna` int(35) DEFAULT NULL,
  `tipe_notifikasi` varchar(45) DEFAULT NULL,
  `status_notifikasi` varchar(65) DEFAULT NULL,
  `deskripsi` varchar(115) DEFAULT NULL,
  `status_dilihat` enum('1','0') DEFAULT '0',
  `datecreated` datetime DEFAULT NULL,
  `link` varchar(145) DEFAULT NULL,
  `id_pemeberitahuan` varchar(45) DEFAULT NULL,
  `kode_mark` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_notifikasi`),
  KEY `idx_fk_id_pengguna` (`id_pengguna`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `id_pengguna`, `tipe_notifikasi`, `status_notifikasi`, `deskripsi`, `status_dilihat`, `datecreated`, `link`, `id_pemeberitahuan`, `kode_mark`) VALUES
(1, 1234567890, 'diskusi', 'Ada diskusi baru', 'Mendapat diskusi baru', '1', '2014-09-21 23:53:11', NULL, NULL, '7we5g'),
(2, 120191920, 'diskusi', 'Ada diskusi baru', 'Mendapat diskusi baru', '0', '2014-09-21 23:53:11', NULL, NULL, '7we5g'),
(3, 120001, 'diskusi', 'Ada diskusi baru', 'Mendapat diskusi baru', '0', '2014-09-21 23:53:11', NULL, NULL, '7we5g'),
(4, 1234510, 'diskusi', 'Ada diskusi baru', 'Mendapat diskusi baru', '0', '2014-09-21 23:53:11', NULL, NULL, '7we5g'),
(5, 120191920, 'komendiskusi', 'Ada komentar diskusi baru', 'Mendapat komentar diskusi baru', '1', '2014-09-21 23:56:04', NULL, NULL, '7we5g'),
(6, 1142045, 'komendiskusi', 'Ada komentar diskusi baru', 'Mendapat komentar diskusi baru', '1', '2014-09-21 23:56:04', NULL, NULL, '7we5g'),
(7, 120001, 'komendiskusi', 'Ada komentar diskusi baru', 'Mendapat komentar diskusi baru', '1', '2014-09-21 23:56:04', NULL, NULL, '7we5g'),
(8, 1234510, 'komendiskusi', 'Ada komentar diskusi baru', 'Mendapat komentar diskusi baru', '1', '2014-09-21 23:56:04', NULL, NULL, '7we5g'),
(9, 120191920, 'komendiskusi', 'Ada komentar diskusi baru', 'Mendapat komentar diskusi baru', '1', '2014-09-21 23:58:12', NULL, NULL, '7we5g'),
(10, 1142045, 'komendiskusi', 'Ada komentar diskusi baru', 'Mendapat komentar diskusi baru', '1', '2014-09-21 23:58:12', NULL, NULL, '7we5g'),
(11, 120001, 'komendiskusi', 'Ada komentar diskusi baru', 'Mendapat komentar diskusi baru', '1', '2014-09-21 23:58:12', NULL, NULL, '7we5g'),
(12, 1234510, 'komendiskusi', 'Ada komentar diskusi baru', 'Mendapat komentar diskusi baru', '1', '2014-09-21 23:58:12', NULL, NULL, '7we5g'),
(13, 120191920, 'diskusi', 'Ada diskusi baru', 'Mendapat diskusi baru', '0', '2014-09-21 23:58:23', NULL, NULL, '7we5g'),
(14, 1142045, 'diskusi', 'Ada diskusi baru', 'Mendapat diskusi baru', '1', '2014-09-21 23:58:23', NULL, NULL, '7we5g'),
(15, 120001, 'diskusi', 'Ada diskusi baru', 'Mendapat diskusi baru', '0', '2014-09-21 23:58:23', NULL, NULL, '7we5g'),
(16, 1234510, 'diskusi', 'Ada diskusi baru', 'Mendapat diskusi baru', '0', '2014-09-21 23:58:23', NULL, NULL, '7we5g'),
(17, 1142045, 'materi', 'Ada materi baru', 'Mendapat materi baru', '1', '2014-09-27 15:12:25', NULL, 'ini materi dua', 'x8k'),
(18, 1142045, 'tugas', 'Ada tugas baru', 'Mendapat tugas baru', '0', '2014-09-27 15:17:31', NULL, 'Ini tugas dua', 'x8k'),
(19, 1142101, 'pesan', 'Mendapat pesan baru', 'hai', '0', '2014-09-27 15:52:27', NULL, NULL, NULL),
(20, 1142045, 'jawaban', 'Mendapat jawaban pesan', 'hai juga', '0', '2014-09-27 15:52:44', NULL, NULL, NULL),
(21, 1142101, 'pesan', 'Mendapat pesan baru', 'asdsd', '0', '2014-09-27 16:01:36', NULL, NULL, NULL),
(22, 1142101, 'pesan', 'Mendapat pesan baru', 'sadsad', '0', '2014-09-27 16:09:02', NULL, NULL, NULL),
(23, 1142045, 'jawaban', 'Mendapat jawaban pesan', 'asd', '0', '2014-09-27 16:09:50', NULL, NULL, NULL),
(24, 1142101, 'status', 'Membuat status baru', 'cuy', '1', '2014-09-27 16:27:51', NULL, NULL, NULL),
(25, 1142045, 'komentar', 'Mengomentari status', 'asd', '1', '2014-09-27 16:27:57', NULL, '2', NULL),
(26, 1142045, 'status', 'Membuat status baru', 'sads', '1', '2014-09-27 16:30:21', NULL, NULL, NULL),
(27, 1142101, 'komentar', 'Mengomentari status', 'ddd', '1', '2014-09-27 16:30:26', NULL, '3', NULL),
(28, 1142045, 'status', 'Membuat status baru', 'asd', '1', '2014-09-27 16:31:29', NULL, NULL, NULL),
(29, 1142045, 'pesan', 'Mendapat pesan baru', 'Haloo ini isi pesan', '0', '2014-10-01 01:44:14', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE IF NOT EXISTS `pengguna` (
  `id_pengguna` int(35) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `nama_lengkap` varchar(155) NOT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text,
  `foto_profil` varchar(200) DEFAULT 'avatar.jpg',
  `hobi` varchar(155) DEFAULT NULL,
  `tentang_pribadi` text,
  `status_pernikahan` enum('jomblo','berpasangan') DEFAULT NULL,
  `jenis_kelamin` enum('l','p') DEFAULT NULL,
  `status_pengguna` enum('dosen','mahasiswa','admin') NOT NULL,
  `status_verifikasi` enum('1','0') NOT NULL DEFAULT '0',
  `datecreated` datetime NOT NULL,
  PRIMARY KEY (`id_pengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `password`, `email`, `nama_lengkap`, `no_telp`, `tgl_lahir`, `alamat`, `foto_profil`, `hobi`, `tentang_pribadi`, `status_pernikahan`, `jenis_kelamin`, `status_pengguna`, `status_verifikasi`, `datecreated`) VALUES
(9090, 'dosenaja', 'a4b0a3e80c501bd2d95d79694fe2f5a1', 'dosenaja@yahoo.com', 'dosenaja', NULL, NULL, NULL, 'avatar.jpg', NULL, NULL, NULL, NULL, 'dosen', '0', '2015-01-20 14:36:10'),
(101010, 'admin', 'f06a6b3dd6053b62beaa9d49668bae45', 'admin@live.com', 'Ricky Juniar Iskandar', '081394940849', '1980-10-24', 'Bandung', 'IMG-20130804-WA0004.jpg', NULL, 'simple, santai, kalem', 'jomblo', 'l', 'admin', '1', '2014-08-28 00:00:00'),
(112288, 'dosen', 'ce28eed1511f631af6b2a7bb0a85d636', 'tedjodarmanto@yahoo.com', 'Tedjo Darmanto', NULL, NULL, NULL, 'avatar.jpg', NULL, NULL, NULL, NULL, 'dosen', '0', '2014-09-30 12:36:34'),
(1142045, 'rikoy', 'f06a6b3dd6053b62beaa9d49668bae45', 'rikoy@live.com', 'Ricky Juniar Iskandar', NULL, NULL, NULL, 'avatar.jpg', NULL, NULL, NULL, NULL, 'mahasiswa', '0', '2014-09-30 12:46:59'),
(1242148, 'nanda', '859a37720c27b9f70e11b79bab9318fe', 'bangkit@gmail.com', 'Nanda Bangkit', NULL, NULL, NULL, 'avatar.jpg', NULL, NULL, NULL, NULL, 'mahasiswa', '0', '2014-09-30 15:42:03');

-- --------------------------------------------------------

--
-- Table structure for table `perguruan_tinggi`
--

CREATE TABLE IF NOT EXISTS `perguruan_tinggi` (
  `kode_pt` char(5) NOT NULL,
  `nama_pt` varchar(155) DEFAULT NULL,
  `alamat_pt` text,
  `kode_pos_pt` int(11) DEFAULT NULL,
  `id_pengguna` int(35) DEFAULT NULL,
  `datecreated` datetime DEFAULT NULL,
  `no_telp_pt` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`kode_pt`),
  KEY `id_id_pengguna` (`id_pengguna`),
  KEY `id_pengguna` (`id_pengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perguruan_tinggi`
--

INSERT INTO `perguruan_tinggi` (`kode_pt`, `nama_pt`, `alamat_pt`, `kode_pos_pt`, `id_pengguna`, `datecreated`, `no_telp_pt`) VALUES
('2', 'STMIK AMIK Bandung', 'Jalan Jakarta Bandung', 40123, 112288, '2014-10-01 01:33:47', '081231212');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE IF NOT EXISTS `pesan` (
  `id_pesan` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengirim` int(35) DEFAULT NULL,
  `id_tujuan` int(35) DEFAULT NULL,
  `judul_pesan` varchar(45) DEFAULT NULL,
  `isi_pesan` text,
  `datecreated` datetime DEFAULT NULL,
  `status_dilihat` enum('1','0') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pesan`),
  KEY `idx_fk_id_pengirim` (`id_pengirim`),
  KEY `idx_fk_id_tujuan` (`id_tujuan`),
  KEY `id_pengirim` (`id_pengirim`),
  KEY `id_tujuan` (`id_tujuan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesan`, `id_pengirim`, `id_tujuan`, `judul_pesan`, `isi_pesan`, `datecreated`, `status_dilihat`) VALUES
(1, 112288, 1142045, 'Haloo', 'Haloo ini isi pesan', '2014-10-01 01:44:14', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pt_pengguna`
--

CREATE TABLE IF NOT EXISTS `pt_pengguna` (
  `id_pt_dosen` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pt` char(5) DEFAULT NULL,
  `id_pengguna` int(35) DEFAULT NULL,
  PRIMARY KEY (`id_pt_dosen`),
  KEY `kode_pt` (`kode_pt`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pt_pengguna`
--

INSERT INTO `pt_pengguna` (`id_pt_dosen`, `kode_pt`, `id_pengguna`) VALUES
(2, '2', 112288),
(3, '2', 1142045);

-- --------------------------------------------------------

--
-- Table structure for table `session_login`
--

CREATE TABLE IF NOT EXISTS `session_login` (
  `id_session_login` int(11) NOT NULL AUTO_INCREMENT,
  `session_kode` varchar(255) DEFAULT NULL,
  `id_pengguna` int(35) DEFAULT NULL,
  `ip_login` varchar(45) DEFAULT NULL,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `user_agent` text,
  PRIMARY KEY (`id_session_login`),
  KEY `idx_fk_id_pengguna` (`id_pengguna`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `session_login`
--

INSERT INTO `session_login` (`id_session_login`, `session_kode`, `id_pengguna`, `ip_login`, `time`, `date`, `user_agent`) VALUES
(1, '', 112288, '::1', '12:36:54', '2014-09-30', NULL),
(2, '4dd955c6f9ef181b33f3192875f31393', 112288, '::1', '12:44:10', '2014-09-30', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36'),
(3, '720837bbdcb97cf255c0a65e36f567ef', 1142045, '::1', '12:46:59', '2014-09-30', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36'),
(4, 'f5850d95c9757449c3475759b266baaa', 1142045, '::1', '12:47:34', '2014-09-30', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36'),
(5, '9120f5ef9236fece1b63b3a971323ed9', 1242148, '::1', '15:42:03', '2014-09-30', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36'),
(6, '6391d4166a038629d53da8291522dec5', 112288, '::1', '16:27:59', '2014-09-30', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36'),
(7, 'e13e7525ccdbafc3561f06ed095698f8', 112288, '::1', '01:32:53', '2014-10-01', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36'),
(8, '36983c6035ba175560ecf24ef1a89d2a', 1142045, '::1', '01:40:59', '2014-10-01', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36'),
(9, '2c64ee977a4aba907f0e07a230aff89b', 112288, '::1', '01:41:15', '2014-10-01', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36'),
(10, '6adff51b21b9f1fa5c406acb06d74d99', 1142045, '::1', '01:41:29', '2014-10-01', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36'),
(11, 'bb6812544cfbd3db367530d17cb000f9', 112288, '::1', '01:42:19', '2014-10-01', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36'),
(12, 'd280f3428d64f209d4cecf1e9ce8a53b', 1142045, '::1', '01:44:30', '2014-10-01', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36'),
(13, '362f309a786237908c8e89d85429c799', 112288, '::1', '01:50:43', '2014-10-01', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36'),
(14, 'a77632010465c26b2cfd516b13aa16f9', 1142045, '::1', '01:53:35', '2014-10-01', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36'),
(15, '710847d8f04966c321b22a7ac8737791', 112288, '127.0.0.1', '12:37:13', '2015-01-18', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36'),
(16, '3629b412b16a59b9aa1a82866e09ea3c', 112288, '127.0.0.1', '14:35:13', '2015-01-20', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36'),
(17, '48f76527875aed4fa5b54aac839914d9', 9090, '127.0.0.1', '14:36:10', '2015-01-20', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36'),
(18, '5d58c493c4cc8ef7f623a9962e776cb5', 1142045, '127.0.0.1', '14:36:34', '2015-01-20', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36'),
(19, '9a7ffa5851f347a8617171d930decc1a', 112288, '127.0.0.1', '15:57:09', '2015-01-21', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengguna` int(35) DEFAULT NULL,
  `kode_pt` char(5) DEFAULT NULL,
  `isi_status` text,
  `datecreated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_status`),
  KEY `idx_fk_id_pengguna` (`id_pengguna`),
  KEY `idx_fk_kode_pt` (`kode_pt`),
  KEY `kode_pt` (`kode_pt`),
  KEY `id_pengguna` (`id_pengguna`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `status`
--


-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE IF NOT EXISTS `tugas` (
  `id_tugas` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kelas` char(6) DEFAULT NULL,
  `id_pengguna` int(35) DEFAULT NULL,
  `nama_tugas` varchar(45) DEFAULT NULL,
  `isi_tugas` text,
  `file_tugas` varchar(45) DEFAULT NULL,
  `batas_pengumpulan` date DEFAULT NULL,
  `datecreated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_tugas`),
  KEY `idx_fk_kode_kelas` (`kode_kelas`),
  KEY `idx_fk_id_pengguna` (`id_pengguna`),
  KEY `kode_kelas` (`kode_kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tugas`
--

INSERT INTO `tugas` (`id_tugas`, `kode_kelas`, `id_pengguna`, `nama_tugas`, `isi_tugas`, `file_tugas`, `batas_pengumpulan`, `datecreated`) VALUES
(1, 'ie', 112288, 'Cari e-book', 'Cari ebook bahasa inggris mengenai artificial neural network', NULL, '2014-10-04', '2014-10-01 01:40:36');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `diskusi`
--
ALTER TABLE `diskusi`
  ADD CONSTRAINT `diskusi_ibfk_1` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kode_kelas`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `diskusi_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `jawab_diskusi`
--
ALTER TABLE `jawab_diskusi`
  ADD CONSTRAINT `jawab_diskusi_ibfk_1` FOREIGN KEY (`id_diskusi`) REFERENCES `diskusi` (`id_diskusi`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `jawab_diskusi_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `jawaban_pesan`
--
ALTER TABLE `jawaban_pesan`
  ADD CONSTRAINT `jawaban_pesan_ibfk_1` FOREIGN KEY (`id_pengirim`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `jawaban_pesan_ibfk_2` FOREIGN KEY (`id_tujuan`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`kode_pt`) REFERENCES `perguruan_tinggi` (`kode_pt`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `kelas_pengguna`
--
ALTER TABLE `kelas_pengguna`
  ADD CONSTRAINT `kelas_pengguna_ibfk_2` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kode_kelas`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `komentar_status`
--
ALTER TABLE `komentar_status`
  ADD CONSTRAINT `komentar_status_ibfk_1` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kode_kelas`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `memo`
--
ALTER TABLE `memo`
  ADD CONSTRAINT `memo_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `nilai_tugas`
--
ALTER TABLE `nilai_tugas`
  ADD CONSTRAINT `nilai_tugas_ibfk_1` FOREIGN KEY (`id_tugas`) REFERENCES `tugas` (`id_tugas`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `nilai_tugas_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `perguruan_tinggi`
--
ALTER TABLE `perguruan_tinggi`
  ADD CONSTRAINT `perguruan_tinggi_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `pesan`
--
ALTER TABLE `pesan`
  ADD CONSTRAINT `pesan_ibfk_1` FOREIGN KEY (`id_pengirim`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `pesan_ibfk_2` FOREIGN KEY (`id_tujuan`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `pt_pengguna`
--
ALTER TABLE `pt_pengguna`
  ADD CONSTRAINT `pt_pengguna_ibfk_1` FOREIGN KEY (`kode_pt`) REFERENCES `perguruan_tinggi` (`kode_pt`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`kode_pt`) REFERENCES `perguruan_tinggi` (`kode_pt`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `status_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tugas`
--
ALTER TABLE `tugas`
  ADD CONSTRAINT `tugas_ibfk_1` FOREIGN KEY (`kode_kelas`) REFERENCES `kelas` (`kode_kelas`) ON DELETE CASCADE ON UPDATE NO ACTION;
--