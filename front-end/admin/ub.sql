-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2021 at 06:25 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olivia`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_penulis` bigint(20) UNSIGNED NOT NULL,
  `deskripsi` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lampiran` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_penulis` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `deskripsi`, `foto`, `keterangan`, `id_penulis`, `created_at`, `updated_at`) VALUES
(3, 'UB', '<p>wkwkwkkwkwkwkwkwkwkkwkwkwk</p>', 'assets/image/berita/1623086275_15022021SIANG.png', 'wkwk', 2, '2021-06-07 17:17:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `berkas`
--

CREATE TABLE `berkas` (
  `id` int(10) NOT NULL,
  `bukti` text NOT NULL,
  `proposal` text NOT NULL,
  `id_Pilihan` int(10) NOT NULL,
  `id_User` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `data_peserta`
--

CREATE TABLE `data_peserta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ktm` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_tim`
--

CREATE TABLE `data_tim` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_team` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim_ketua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ktm_ketua` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_dosen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nidn_dosen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institusi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pertanyaan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jawaban` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('publish','draft') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `pertanyaan`, `jawaban`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dimanakah Lokasi  Universitas Brawijaya', '<p>Jl. Veteran, Ketawanggede, Kec. Lowokwaru, Kota Malang, Jawa Timur 65145</p>', '', NULL, '2021-06-04 02:11:44'),
(2, 'Bagaimana Cara Membuat Akun', '<p>silahkan tema2 daftar menggunakan nim ,email dan password , jika sudah anda akan di alihkan ke halaman login</p>', '', NULL, '2021-06-04 02:11:04'),
(3, 'Berapakah Jumlah Fakultas yang terdapat di Universitas Brawijaya', '<p>Sekarang ini,&nbsp;<strong>jumlah fakultas</strong>&nbsp;dan program di&nbsp;<strong>UB</strong>&nbsp;sebanyak 17 (tujuh belas) yang terdiri dari 15&nbsp;<strong>fakultas</strong>, program pascasarjana, dan pendidikan vokasi.</p>', 'draft', '2021-06-04 02:12:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`id`, `nama`, `tahun`, `foto`, `created_at`, `updated_at`) VALUES
(9, 'M Farraseka F', '2021', '[\"PicsArt_05-17-01.42.20.jpg\"]', '2021-06-10 15:16:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `info_grafis`
--

CREATE TABLE `info_grafis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `info_grafis`
--

INSERT INTO `info_grafis` (`id`, `nama`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'iqbal', 'assets/image/info-grafis/1608617577_info5.png', '2020-12-21 23:12:57', NULL),
(2, 'iqbal', 'assets/image/info-grafis/1608617709_info5.png', '2020-12-21 23:15:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `info_struktur`
--

CREATE TABLE `info_struktur` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `info_struktur`
--

INSERT INTO `info_struktur` (`id`, `nama`, `jabatan`, `pt`, `gambar`, `created_at`, `updated_at`) VALUES
(5, 'M Farraseka Fadhil', 'Wakil Direktur', 'Universitas Brawijaya', 'assets/image/info-struktur/1623090042_PicsArt_05-17-01.42.20.jpg', '2021-06-07 18:20:42', NULL),
(8, 'Sofiq Kontol', 'Member', 'Universitas Brawijaya', 'assets/image/info-struktur/1623090067_bussiness-man.png', '2021-06-07 18:21:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lomba`
--

CREATE TABLE `lomba` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lomba` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `jadwal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lampiran` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(187, '2014_10_12_100000_create_password_resets_table', 1),
(188, '2019_08_19_000000_create_failed_jobs_table', 1),
(189, '2020_09_22_184349_create_role_table', 1),
(190, '2020_09_22_184458_create_users_table', 1),
(191, '2020_09_26_042822_create_berita_table', 1),
(192, '2020_09_26_044243_create_faq_table', 1),
(193, '2020_09_26_044751_create_other_question_table', 1),
(194, '2020_09_26_045010_create_galeri_table', 1),
(195, '2020_09_26_060936_create_lomba_table', 1),
(196, '2020_09_26_061357_create_artikel_table', 1),
(197, '2020_09_26_063423_create_data_peserta_table', 1),
(198, '2020_09_26_083614_create_data_ketua_table', 1),
(199, '2020_09_29_145907_create_pengumuman_table', 1),
(200, '2020_09_29_150550_create_sejarah_table', 1),
(201, '2020_09_29_150703_create_visimisi_table', 1),
(202, '2020_09_29_150848_create_struktur_organisasi_table', 1),
(203, '2020_09_29_150957_create_tugas_fungsi_table', 1),
(204, '2020_09_29_151102_create_foto_table', 1),
(205, '2020_09_29_151132_create_video_table', 1),
(206, '2020_09_29_151156_create_sosial_media_table', 1),
(207, '2020_09_29_151541_create_pertanyaan_user_table', 1),
(208, '2020_10_06_004928_create_info_struktur_table', 1),
(209, '2020_10_08_173850_create_slider_table', 1),
(210, '2020_10_08_174158_create_info_grafis_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `other_question`
--

CREATE TABLE `other_question` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_penanya` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pertanyaan` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `lampiran` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `deskripsi`, `lampiran`, `gambar`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 'ini pengumuman', '<p>inii pengumuman</p>', 'assets/file/pengumuman/1622739692_TIK4A_007_Muhammad Farraseka Fadhil- Progres (2).docx', 'assets/image/pengumuman/1622739692_logo-ub.jpg', 2, '2021-06-03 17:01:32', NULL),
(2, 'cok i', '<p>asui asui asui</p>', 'assets/file/pengumuman/1623086524_UAS_007_Muhammad Farraseka Fadhil_TIK4A.docx', 'assets/image/pengumuman/1623086524_0001 (1).jpg', 2, '2021-06-07 17:22:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan_user`
--

CREATE TABLE `pertanyaan_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pertanyaan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pertanyaan_user`
--

INSERT INTO `pertanyaan_user` (`id`, `nama`, `email`, `pertanyaan`, `status`, `created_at`, `updated_at`) VALUES
(1, 'asdsad', 'asdasd', 'sadasdsasdas', 0, '2021-05-20 05:17:36', NULL),
(2, 'farras', 'fadhilfarras008@gmail.com', 'asdasd', 0, '2021-05-20 05:17:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2020-12-21 19:47:43', '2020-12-21 19:47:43'),
(2, 'user', '2020-12-21 19:47:43', '2020-12-21 19:47:43');

-- --------------------------------------------------------

--
-- Table structure for table `sejarah`
--

CREATE TABLE `sejarah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sejarah`
--

INSERT INTO `sejarah` (`id`, `judul`, `deskripsi`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Sejarah Universitas Brawijaya', '<p>Universitas Brawijaya berkedudukan di Kota Malang, Jawa Timur, didirikan pada tanggal 5 Januari 1963 dengan Surat Keputusan Menteri Perguruan Tinggi dan Ilmu Pengetahuan (PTIP) Nomor 1 Tahun 1963, dan kemudian dikukuhkan dengan Keputusan Presiden Republik Indonesia Nomor 196 Tahun 1963 tertanggal 23 September 1963. Universitas ini semula berstatus swasta, dengan embrio sejak tahun 1957, yaitu berupa Fakultas Hukum dan Fakultas Ekonomi yang merupakan cabang Universitas Swasta Sawerigading, Makasar. Kedua fakultas itu perkembangannya nampak kurang menggembirakan, sehingga di kalangan mahasiswa timbul keresahan.Beberapa orang dan tokoh mahasiswa yang menyadari hal ini kemudian mengadakan pendekatan-pendekatan kepada para pemuka masyarakat. Akhirnya, pada suatu pertemuan yang mereka lakukan di Balai Kota Malang pada tanggal 10 Mei 1957, tercetus gagasan untuk mendirikan sebuah Universitas kotapraja&nbsp;<em>(Gemeentelijke Universiteit)</em>&nbsp;yang diharapkan lebih dapat menjamin masa depan para mahasiswa.</p>', 'aktif', '2021-06-07 19:03:35', '2021-06-08 17:54:39');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sosial_media`
--

CREATE TABLE `sosial_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `struktur_organisasi`
--

CREATE TABLE `struktur_organisasi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `struktur_organisasi`
--

INSERT INTO `struktur_organisasi` (`id`, `nama`, `deskripsi`, `gambar`, `created_at`, `updated_at`) VALUES
(20, 'ww', '<p>qweq</p>', 'assets/image/struktur/1623090438_download (2).jpg', '2021-06-07 18:27:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tugas_fungsi`
--

CREATE TABLE `tugas_fungsi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tugas_fungsi`
--

INSERT INTO `tugas_fungsi` (`id`, `nama`, `deskripsi`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Raih 53 Penghargaan, IPB Jadi Juara Umum Olimpiade Vokasi 2019', '<p>wkwkwkkwkw</p>', 'aktif', '2021-06-07 18:22:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_role` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `gambar`, `id_role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'farraseka', 'farras@gmail.com', NULL, 'farras008', NULL, 1, NULL, '2020-12-21 19:47:43', '2020-12-21 19:47:43'),
(2, 'M Farraseka Fadhil', 'admin@gmail.com', NULL, '$2y$10$k3OLy2OBIR5JK05vaqoZyex1l5PpvUlKgBeYCyntzMdEZinUvKQqm', 'assets/image/akun/1622744856_foto formal.png', 1, NULL, '2020-12-21 19:47:43', '2020-12-21 19:47:43'),
(3, 'admin', 'shofiqmughni26@gmail.com', NULL, '$2y$12$Ghl8UMGwIUZIQfWXWlwGZOyLvBvDPZ8fXtbX.lqR5CJOXkvsgR4Mi', NULL, 1, NULL, '2020-12-21 19:47:43', '2020-12-21 19:47:43');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `nama`, `video`, `created_at`, `updated_at`) VALUES
(1, 'Universitas Brawijaya', 'https://www.youtube.com/embed/UwK9OlhpMAY', '2021-06-03 19:06:56', '2021-06-03 19:08:12'),
(2, 'Fakultas Vokasi', 'https://www.youtube.com/embed/42jiBu5NjSA', '2021-06-03 19:09:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visimisi`
--

CREATE TABLE `visimisi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visi` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `misi` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('aktif','nonaktif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visimisi`
--

INSERT INTO `visimisi` (`id`, `judul`, `visi`, `misi`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Visi Misi Universitas Brawijaya', '<p>Menjadi lembaga pendidikan vokasi yang menitik beratkan kepada pengembangan potensi diri untuk meraih keahlian dan kompetensi serta menjadi insan cerdas, kreatif dan inovatif serta mampu memanfaatkan ipteks untuk bersaing di tingkat nasional maupun internasional.</p>', '<p>Menjadi lembaga pendidikan vokasi yang menitik beratkan kepada pengembangan potensi diri untuk meraih keahlian dan kompetensi serta menjadi insan cerdas, kreatif dan inovatif serta mampu memanfaatkan ipteks untuk bersaing di tingkat nasional maupun internasional.Menjadi lembaga pendidikan vokasi yang menitik beratkan kepada pengembangan potensi diri untuk meraih keahlian dan kompetensi serta menjadi insan cerdas, kreatif dan inovatif serta mampu memanfaatkan ipteks untuk bersaing di tingkat nasional maupun internasional.Menjadi lembaga pendidikan vokasi yang menitik beratkan kepada pengembangan potensi diri untuk meraih keahlian dan kompetensi serta menjadi insan cerdas, kreatif dan inovatif serta mampu memanfaatkan ipteks untuk bersaing di tingkat nasional maupun internasional.Menjadi lembaga pendidikan vokasi yang menitik beratkan kepada pengembangan potensi diri untuk meraih keahlian dan kompetensi serta menjadi insan cerdas, kreatif dan inovatif serta mampu memanfaatkan ipteks untuk bersaing di tingkat nasional maupun internasional.Menjadi lembaga pendidikan vokasi yang menitik beratkan kepada pengembangan potensi diri untuk meraih keahlian dan kompetensi serta menjadi insan cerdas, kreatif dan inovatif serta mampu memanfaatkan ipteks untuk bersaing di tingkat nasional maupun internasional.</p>', 'aktif', '2021-06-07 13:20:42', '2021-06-10 16:24:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `artikel_id_penulis_foreign` (`id_penulis`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `berita_id_penulis_foreign` (`id_penulis`);

--
-- Indexes for table `data_peserta`
--
ALTER TABLE `data_peserta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_tim`
--
ALTER TABLE `data_tim`
  ADD PRIMARY KEY (`id`),
  ADD KEY `data_tim_id_user_foreign` (`id_user`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info_grafis`
--
ALTER TABLE `info_grafis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `info_struktur`
--
ALTER TABLE `info_struktur`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lomba`
--
ALTER TABLE `lomba`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_question`
--
ALTER TABLE `other_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengumuman_id_user_foreign` (`id_user`);

--
-- Indexes for table `pertanyaan_user`
--
ALTER TABLE `pertanyaan_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sejarah`
--
ALTER TABLE `sejarah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sosial_media`
--
ALTER TABLE `sosial_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `struktur_organisasi`
--
ALTER TABLE `struktur_organisasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas_fungsi`
--
ALTER TABLE `tugas_fungsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_id_role_foreign` (`id_role`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visimisi`
--
ALTER TABLE `visimisi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_peserta`
--
ALTER TABLE `data_peserta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_tim`
--
ALTER TABLE `data_tim`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `info_grafis`
--
ALTER TABLE `info_grafis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `info_struktur`
--
ALTER TABLE `info_struktur`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `lomba`
--
ALTER TABLE `lomba`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `other_question`
--
ALTER TABLE `other_question`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pertanyaan_user`
--
ALTER TABLE `pertanyaan_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sejarah`
--
ALTER TABLE `sejarah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sosial_media`
--
ALTER TABLE `sosial_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `struktur_organisasi`
--
ALTER TABLE `struktur_organisasi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tugas_fungsi`
--
ALTER TABLE `tugas_fungsi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `visimisi`
--
ALTER TABLE `visimisi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `artikel_id_penulis_foreign` FOREIGN KEY (`id_penulis`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `berita`
--
ALTER TABLE `berita`
  ADD CONSTRAINT `berita_id_penulis_foreign` FOREIGN KEY (`id_penulis`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `data_tim`
--
ALTER TABLE `data_tim`
  ADD CONSTRAINT `data_tim_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `pengumuman_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
