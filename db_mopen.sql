-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 10, 2025 at 03:41 AM
-- Server version: 8.0.43-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mopen`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('77de68daecd823babbb58edb1c8e14d7106e83bb', 'i:1;', 1757240863),
('77de68daecd823babbb58edb1c8e14d7106e83bb:timer', 'i:1757240863;', 1757240863),
('c1dfd96eea8cc2b62785275bca38ac261256e278', 'i:1;', 1757236183),
('c1dfd96eea8cc2b62785275bca38ac261256e278:timer', 'i:1757236183;', 1757236183),
('livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3', 'i:2;', 1757240746),
('livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1757240746;', 1757240746),
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:0:{}s:11:\"permissions\";a:0:{}s:5:\"roles\";a:0:{}}', 1757305963);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `educational_histories`
--

CREATE TABLE `educational_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `jenjang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_studi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institusi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_masuk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_lulus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ipk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dokumen_ijazah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lecturer_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `educational_histories`
--

INSERT INTO `educational_histories` (`id`, `jenjang`, `program_studi`, `institusi`, `tahun_masuk`, `tahun_lulus`, `ipk`, `dokumen_ijazah`, `created_at`, `updated_at`, `lecturer_id`) VALUES
(4, 'S1', 'Computer Science', 'Universitas Gadjah Mada', '2027', '2029', '4.00', 'documents/ijazah/01JYN5XZ0CK5540QEHJ3B4BY3R.pdf', '2025-06-26 02:54:01', '2025-06-26 02:54:01', 5),
(6, 'S2', 'Ilmu Fisika', 'Universitas Mulawarman', '2001', '2006', '3.96', 'documents/ijazah/01JYT1W53AK0NYWW8TJ74X8A4G.pdf', '2025-06-28 00:19:19', '2025-06-28 00:19:19', 5),
(7, 'S1', 'Ilmu Sains', 'Universitas Tadulako', '2015', '2019', '3.69', 'documents/ijazah/01K3FX04PFVFT4KYP1JQQD513F.pdf', '2025-08-25 05:00:12', '2025-08-25 05:00:12', 6),
(8, 'S3', 'Computer Science and Informatics', 'Massachusetts Institute of Technology (MIT)', '2021', '2025', '3.78', 'documents/ijazah/01K4HPYQK4PX3PYKTQZ3BTMRR2.pdf', '2025-09-07 09:08:45', '2025-09-07 09:08:45', 6),
(9, 'S2', 'Kajian Wilayah Eropa', 'Imperial College London', '2021', '2025', '4.00', 'documents/ijazah/01K4HVDHDKDBH7FW60XJTZW7D6.pdf', '2025-09-07 10:26:44', '2025-09-07 10:26:44', 3);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 'Apa itu SMART-P2M', '<p><strong>SMART-PPM</strong> adalah platform internal UINSI Samarinda yang digunakan untuk mendigitalisasi proses pengajuan, pemantauan, dan dokumentasi kegiatan penelitian serta pengabdian kepada masyarakat yang dilakukan oleh dosen dan peneliti.</p>', '2025-06-23 10:47:10', '2025-06-23 10:47:10'),
(2, 'Siapa saja yang dapat menggunakan SMART-PPM?', '<p>Platform ini diperuntukkan bagi: Dosen dan peneliti UINSI Samarinda</p><p><br></p>', '2025-06-23 10:47:58', '2025-06-23 10:47:58'),
(3, 'Apa saja fitur utama SMART-PPM?', '<ol><li>Pengajuan proposal penelitian dan pengabdian masyarakat</li><li>Pemantauan status persetujuan proposal</li><li>Input dan manajemen publikasi hasil penelitian</li><li>Pelaporan kegiatan pengabdian masyarakat</li><li>Manajemen profil dosen (data SINTA, pendidikan, dokumen, dll)</li><li>Panel admin untuk pengelolaan informasi dan validasi data</li></ol>', '2025-06-23 11:13:30', '2025-06-23 11:13:30'),
(4, 'Bagaimana cara mengajukan proposal penelitian?', '<p>Dosen atau peneliti dapat login ke sistem, kemudian memilih menu <strong>\"Ajukan Penelitian\"</strong> dan mengisi form lengkap beserta dokumen pendukung yang diperlukan.</p>', '2025-06-23 11:13:51', '2025-06-23 11:13:51'),
(5, 'Bagaimana saya tahu proposal saya disetujui atau ditolak?', '<p>Status proposal dapat dilihat langsung di dashboard pengguna, dan sistem juga akan mengirim notifikasi jika status berubah (misalnya: ditolak, revisi, disetujui).</p>', '2025-06-23 11:14:13', '2025-06-23 11:14:13'),
(6, 'Apakah saya bisa memperbarui data pribadi saya sendiri?', '<p>Ya. Setiap dosen/peneliti dapat mengakses menu <strong>\"Profil Saya\"</strong> untuk memperbarui data seperti ID SINTA, riwayat pendidikan, tempat lahir, dan mengunggah dokumen pendukung lainnya.</p>', '2025-06-23 11:14:31', '2025-06-23 11:14:31'),
(7, 'Apakah saya bisa mengunduh dokumen hasil penelitian dari sistem ini?', '<p>Ya. Setelah hasil publikasi diunggah, dosen maupun LP2M dapat mengakses dan mengunduh dokumen dari menu <strong>\"Publikasi Penelitian\"</strong>.</p>', '2025-06-23 11:14:52', '2025-06-23 11:14:52'),
(8, 'Siapa yang dapat saya hubungi jika mengalami kendala teknis?', '<p>Silakan hubungi tim pengelola LP2M atau staf IT UINSI Samarinda melalui menu <strong>\"Bantuan / Hubungi Admin\"</strong> di aplikasi.</p>', '2025-06-23 11:16:01', '2025-06-23 11:16:01');

-- --------------------------------------------------------

--
-- Table structure for table `guides`
--

CREATE TABLE `guides` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guides`
--

INSERT INTO `guides` (`id`, `title`, `file`, `created_at`, `updated_at`) VALUES
(1, 'Panduan Registrasi Member / Peneliti', 'documents/panduan/01K3J8VHY8JVYKEDGGNDMDTY0W.pdf', '2025-08-26 03:05:53', '2025-08-26 03:05:53'),
(2, 'Panduan Submit Proposal Tahun 2020', 'documents/panduan/01K3J9KNEJAQXBCK1E2VK2X3WP.pdf', '2025-08-26 03:19:03', '2025-08-26 03:19:03');

-- --------------------------------------------------------

--
-- Table structure for table `independent_activities`
--

CREATE TABLE `independent_activities` (
  `id` bigint UNSIGNED NOT NULL,
  `lecturer_id` bigint UNSIGNED DEFAULT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anggota` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `resume` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_pelaksanaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pelaksana_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mitra_kolaborasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sumber_dana` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `besaran_dana` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `independent_activities`
--

INSERT INTO `independent_activities` (`id`, `lecturer_id`, `jenis`, `judul`, `anggota`, `resume`, `tahun_pelaksanaan`, `pelaksana_kegiatan`, `mitra_kolaborasi`, `sumber_dana`, `besaran_dana`, `created_at`, `updated_at`) VALUES
(1, 5, 'Pengabdian', 'Pelatihan Pemanfaatan Pembelajaran Berbasis Web', 'Basrie, Sugiyono, Siti Qomariah, Nurul Huda', '<p>Kegiatan Pelatihan Pemanfaatan Pembelajaran Berbasis Web adalah bentuk pengabdian kepada masyarakat yang dilaksanakan oleh Dosen Program Studi Sistem Informasi, UINSI Samarinda</p>', '2023', 'Mandiri', 'Mandiri', 'Mandiri', 'Rp. 2.000.000', '2025-06-28 13:55:23', '2025-06-28 13:55:23'),
(2, 5, 'Penelitian', 'Pemanfaatan Kopi Untuk Kehidupan', 'Toni Adam, Mark Zurklow', '<p>Ketika dunia ini sedang tidak baik baik saja, maka kehancuran akan terjadi</p>', '2026', 'Mandiri', 'Kingkong Corps', 'Hibah (Non-BOPTN)', '$ 2000000000', '2025-06-29 03:11:11', '2025-06-29 03:11:11'),
(3, 6, 'Pengabdian', 'Pelatihan Pemanfaatan Berbasis Web', 'Basrie, Sugiyono, Siti Qomariah, Nurul Huda', '<p>Kegiatan Pelatihan/Pemanfaatan Pembelajaran Berbasis Web di Di UINSI Samarinda</p>', '2023', 'Mandiri', 'UINSI', 'Mandiri', '58500000', '2025-08-25 05:04:05', '2025-08-28 05:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_surat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`id`, `title`, `no_surat`, `document`, `created_at`, `updated_at`) VALUES
(2, 'Pengumuman Sosialisasi PUI-PT Tahun 2025', '0183/C3/DT.05.00/2025', 'documents/information/01JYD7ZBGE09NAME02K3CP2299.pdf', '2025-06-22 17:55:48', '2025-06-22 17:55:48'),
(3, 'Pengumuman Perpanjangan Penerimaan Proposal Program Kosabangsa Tahun Anggaran 2025', '0122/C3/AL.04/2025 ', 'documents/information/01JYD9X05N02ZXBV8JK6B05WH7.pdf', '2025-06-22 18:29:28', '2025-06-22 18:33:51'),
(4, 'Pengumuman Bimtek Perbaikan Proposal Penelitian untuk Pendanaan Penelitian Batch II Tahun Anggaran 2025', '0148/C3/DT.05.00/2025', 'documents/information/01JYD9XMHHA44KGJ5ZRPARDZNJ.pdf', '2025-06-22 18:29:49', '2025-06-22 18:29:49'),
(5, 'Undangan Bimbingan Teknis Penulisan Proposal Program Kosabangsa dan Mahasiswa Berdampak - Wilayah Surabaya', '0087/C3/AL.04/2025 ', 'documents/information/01JYDPZ26CFBE18KR4C30PXDPH.pdf', '2025-06-23 02:00:37', '2025-06-23 05:17:47'),
(6, 'SK Reposisi Tahun 2020', '0889 Tahun 2021', 'documents/information/01K3FW9QRVTHD5R1K3X57NJ3XM.pdf', '2025-08-25 04:47:58', '2025-08-25 04:47:58'),
(7, 'SK PENETEPAN PENELITI TAHUN ANGGARAN 2022', '125 Tahun 2022', 'documents/information/01K3FXDFSZ421MN3K7GCBG1THS.pdf', '2025-08-25 05:07:29', '2025-08-25 05:07:29');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"c07822d2-f54d-469e-9e8a-7aaf9af460f7\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:19:\\\"App\\\\Models\\\\Lecturer\\\";s:2:\\\"id\\\";a:1:{i:0;i:3;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:0:{}s:4:\\\"body\\\";s:35:\\\"Proposal anda tidak memenuhi syarat\\\";s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:19:\\\"heroicon-o-x-circle\\\";s:9:\\\"iconColor\\\";s:6:\\\"danger\\\";s:6:\\\"status\\\";s:6:\\\"danger\\\";s:5:\\\"title\\\";s:21:\\\"Proposal Anda Ditolak\\\";s:4:\\\"view\\\";s:36:\\\"filament-notifications::notification\\\";s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"a925c965-594b-46ce-95a7-879ce83f5696\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"}}', 0, NULL, 1756806036, 1756806036),
(2, 'default', '{\"uuid\":\"1cf0bae3-8b84-4d6d-a13f-2b1048bf54c0\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:5;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:0:{}s:4:\\\"body\\\";N;s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:23:\\\"heroicon-o-check-circle\\\";s:9:\\\"iconColor\\\";s:7:\\\"success\\\";s:6:\\\"status\\\";s:7:\\\"success\\\";s:5:\\\"title\\\";s:31:\\\"Selamat! Proposal Anda Diterima\\\";s:4:\\\"view\\\";s:36:\\\"filament-notifications::notification\\\";s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"ee3ba571-1d89-42ac-9199-20a26ecb46f9\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"}}', 0, NULL, 1757004393, 1757004393),
(3, 'default', '{\"uuid\":\"454fd554-f78d-40c3-9cf0-df85c4551dbc\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:5;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:0:{}s:4:\\\"body\\\";s:99:\\\"Proposal dengan judul \\\"Pendampingan Pengembangan Jurnal OJS Kampus XYA\\\" telah disetujui oleh Admin.\\\";s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:23:\\\"heroicon-o-check-circle\\\";s:9:\\\"iconColor\\\";s:7:\\\"success\\\";s:6:\\\"status\\\";s:7:\\\"success\\\";s:5:\\\"title\\\";s:31:\\\"Selamat! Proposal Anda Diterima\\\";s:4:\\\"view\\\";s:36:\\\"filament-notifications::notification\\\";s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"3132bd39-33ee-407c-9775-1ef1ae04a24d\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"}}', 0, NULL, 1757005228, 1757005228),
(4, 'default', '{\"uuid\":\"9e405410-e310-4de9-85ec-0e4e23debc51\",\"displayName\":\"Filament\\\\Notifications\\\\DatabaseNotification\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\",\"command\":\"O:48:\\\"Illuminate\\\\Notifications\\\\SendQueuedNotifications\\\":3:{s:11:\\\"notifiables\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:15:\\\"App\\\\Models\\\\User\\\";s:2:\\\"id\\\";a:1:{i:0;i:5;}s:9:\\\"relations\\\";a:0:{}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:12:\\\"notification\\\";O:43:\\\"Filament\\\\Notifications\\\\DatabaseNotification\\\":2:{s:4:\\\"data\\\";a:11:{s:7:\\\"actions\\\";a:0:{}s:4:\\\"body\\\";s:99:\\\"Proposal dengan judul \\\"Pendampingan Pengembangan Jurnal OJS Kampus XYA\\\" telah disetujui oleh Admin.\\\";s:5:\\\"color\\\";N;s:8:\\\"duration\\\";s:10:\\\"persistent\\\";s:4:\\\"icon\\\";s:23:\\\"heroicon-o-check-circle\\\";s:9:\\\"iconColor\\\";s:7:\\\"success\\\";s:6:\\\"status\\\";s:7:\\\"success\\\";s:5:\\\"title\\\";s:31:\\\"Selamat! Proposal Anda Diterima\\\";s:4:\\\"view\\\";s:36:\\\"filament-notifications::notification\\\";s:8:\\\"viewData\\\";a:0:{}s:6:\\\"format\\\";s:8:\\\"filament\\\";}s:2:\\\"id\\\";s:36:\\\"96d2a249-d48c-4942-ad5a-9b3d5d6716af\\\";}s:8:\\\"channels\\\";a:1:{i:0;s:8:\\\"database\\\";}}\"}}', 0, NULL, 1757005273, 1757005273);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_pengguna` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `study_program` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `sinta_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nidn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `functional_position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scientific_field` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sinta_score_all_years` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sinta_score_3_years` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sinta_affiliation_all_years` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sinta_profile_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sinta_affiliation_3_years` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `user_id`, `photo`, `status_pengguna`, `email`, `unit`, `study_program`, `nama`, `nik`, `jk`, `tempat_lahir`, `tanggal_lahir`, `hp`, `alamat`, `sinta_id`, `nip`, `nidn`, `employee_type`, `profession`, `functional_position`, `scientific_field`, `created_at`, `updated_at`, `sinta_score_all_years`, `sinta_score_3_years`, `sinta_affiliation_all_years`, `sinta_profile_link`, `sinta_affiliation_3_years`) VALUES
(3, 3, 'lecturer-photos/01JYV50ZCG9GRH907CDQF5CF55.png', 'Peneliti', 'hernansyah@gmail.com', 'FUAD', 'Sistem Informasi', 'Hernansyah, S.E.', '6472050802990003', 'Laki-laki', 'Kutai Lawas', '2022-10-04', '0895602695462', 'Jl. Perintis Gg. Campur Sari, No. 75', '258119', '123456', '1234567', 'PPPK', 'Pranata Keuangan', 'Peneliti', 'Studi Islam/Dirasat Islamiyah/Islamic Studies', '2025-06-25 00:03:00', '2025-09-07 10:25:44', '2.589', '1.121', '1.136', 'https://sinta.kemdiktisaintek.go.id/authors/profile/258119', '1.136'),
(5, 5, 'lecturer-photos/01JYRGEV2NZF2QG5ZQ248JF7PY.jpg', 'Dosen', 'rizqisap48@gmail.com', 'FTIK', 'Manajemen Pendidikan Islam', 'Rizqi Saputra S.Kom, M.Kom', '6472030607770006', 'Laki-laki', 'Samarinda', '1999-02-08', '0895602695462', 'Perum Pondok Karya Lestari Blok B, Rt. 13, No. 858, Kel. Sungai Kapih, Kec. Sambutan, Kota Samarinda', '235047', '197707062011011006', '2006077703', 'PNS', 'Dosen', 'Lektor Kepala', 'Sains dan Teknologi', '2025-06-25 04:38:34', '2025-09-07 05:34:35', '1.015', '388', '0', 'https://sinta.kemdiktisaintek.go.id/authors/profile/235047', '0'),
(6, 6, 'documents/lecturers/01K3F7AQ1JC5PSKEGPXY9RKMS1.jpg', 'Dosen', 'yayasclevara@gmail.com', 'FTIK', 'Tadris Biologi', 'Yasin Bonou, M.Ag', '6472030607770002', 'Laki-laki', 'Montreal, Canada', '1991-04-05', '0895602695461', 'Maroko', '42423', '197707062011011002', '2006077703', 'Kontrak', 'Dosen', 'Lektor', 'Tarbiyah dan Ilmu Pendidikan', '2025-06-29 05:54:30', '2025-09-07 09:47:45', '17.580', '2.318', '2.318', 'https://sinta.kemdiktisaintek.go.id/authors/profile/42423', '2.318');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_06_21_133001_create_news_table', 2),
(5, '2025_06_23_000059_create_information_table', 3),
(6, '2025_06_23_181347_create_faqs_table', 4),
(7, '2025_06_24_070501_create_contacts_table', 5),
(8, '2025_06_24_125106_create_lecturers_table', 5),
(9, '2025_06_24_125527_create_lecturers_table', 6),
(10, '2025_06_25_065300_add_user_id_to_lecturers_table', 7),
(11, '2025_06_25_092447_create_permission_tables', 8),
(12, '2025_06_25_183331_create_educational_histories_table', 9),
(13, '2025_06_26_102622_create_required_documents_table', 10),
(14, '2025_06_26_104202_add_lecturer_id_to_educational_histories_table', 11),
(15, '2025_06_27_143957_add_sinta_fields_to_lecturers_table', 12),
(16, '2025_06_27_181641_create_publications_table', 13),
(17, '2025_06_27_183443_add_lecturer_id_to_publications_table', 14),
(18, '2025_06_27_191917_add_jurnal_link_to_publications_table', 15),
(19, '2025_06_27_192247_add_jurnal_linkk_to_publications_table', 16),
(20, '2025_06_28_200019_create_independent_activities_table', 17),
(21, '2025_06_30_130725_create_proposals_table', 18),
(22, '2025_06_30_134021_create_proposal_lecturers_table', 18),
(23, '2025_06_30_134103_create_proposal_students_table', 18),
(24, '2025_06_30_134138_create_proposal_p_t_u_s_table', 18),
(25, '2025_06_30_134203_create_proposal_documents_table', 18),
(26, '2025_06_30_134239_create_proposal_supporting_files_table', 18),
(27, '2025_06_30_210933_add_research_schemes_to_proposals_table', 19),
(28, '2025_07_11_104615_add_timestamps_to_proposals_table', 20),
(29, '2025_08_13_124723_add_jabatan_to_proposal_lecturers_table', 21),
(30, '2025_08_13_125708_add_nidn_to_proposal_lecturers_table', 22),
(31, '2025_08_13_204125_create_proposal_logbooks_table', 23),
(32, '2025_08_14_080717_create_proposal_outcomes_table', 24),
(33, '2025_08_15_124545_create_proposal_outputs_table', 25),
(34, '2025_08_16_100740_create_proposal_reports_table', 26),
(35, '2025_08_17_191822_add_file_path_1_to_proposal_reports_table', 27),
(36, '2025_08_19_123916_create_reviewers_table', 27),
(37, '2025_08_26_084522_add_study_program_to_lecturers_table', 28),
(38, '2025_08_26_104956_create_guides_table', 29),
(39, '2025_08_26_131929_add_profile_fields_to_reviewers_table', 30),
(40, '2025_08_26_143933_add_study_program_to_reviewers_table', 31),
(41, '2025_08_27_074530_create_reviewer_educational_histories_table', 32),
(42, '2025_08_27_084056_create_reviewer_required_documents_table', 33),
(43, '2025_08_27_222617_add_detailed_substance_fields_to_proposals_table', 34),
(44, '2025_08_28_091251_add_status_to_proposals_table', 35),
(45, '2025_08_28_140403_create_proposal_reviewer_table', 36),
(46, '2025_08_28_204631_create_reviews_table', 37),
(47, '2025_08_29_174110_update_proposals_for_dynamic_substance', 38),
(48, '2025_08_29_233336_add_validator_note_to_reviews_table', 39),
(49, '2025_08_30_210416_add_workflow_columns_to_reviews_table', 40),
(50, '2025_08_30_220345_add_presentation_score_to_reviews_table', 41),
(51, '2025_08_31_181758_add_recommended_budget_to_reviews_table', 42),
(52, '2025_09_04_124121_add_photo_to_users_table', 43),
(53, '2025_09_04_232049_create_notifications_table', 44),
(54, '2025_09_07_131608_add_affiliation_score_to_lecturers_table', 45),
(55, '2025_09_07_174907_add_sinta_affiliation_to_reviewers_table', 46);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(4, 'App\\Models\\Reviewer', 1),
(1, 'App\\Models\\User', 1),
(4, 'App\\Models\\Reviewer', 2),
(4, 'App\\Models\\Reviewer', 3),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 8);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `category`, `author`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Kesalihan Ritual dan Kesalihan Sosial', '<p><strong>Ya Allah</strong>, anugerahkan kepada kami rasa takut kepada-Mu yang membatasi antara kami dengan perbuatan maksiat kepadamu, dan berikan ketaatan kepada-Mu yang mengantarkan kami ke surga-Mu. Anugerahkan pula keyakinan yang menyebabkan ringan bagi kami, atas segala musibah di dunia ini. Ya Allah, anugerahkan kepada kami kenikmatan melalui pendengaran, penglihatan dan kekuatan selama kami masih hidup dan jadikanlah ia warisan bagi kami. Dan jangan Engkau jadikan musibah atas kami dalam urusan agama kami dan janganlah Engkau jadikan dunia ini sebagai cita-cita terbesar dan puncak dari ilmu kami dan jangan jadikan berkuasa atas kami orang-orang yang tidak mengasihi kami.</p><p dir=\"rtl\">رَبَّنَا لَا تُؤَاخِذْنَآ اِنْ نَّسِيْنَآ اَوْ اَخْطَأْنَاۚ رَبَّنَا وَلَا تَحْمِلْ عَلَيْنَآ اِصْرًا كَمَا حَمَلْتَهٗ عَلَى الَّذِيْنَ مِنْ قَبْلِنَاۚ رَبَّنَا وَلَا تُحَمِّلْنَا مَا لَا طَاقَةَ لَنَا بِهٖۚ وَاعْفُ عَنَّاۗ وَاغْفِرْ لَنَاۗ وَارْحَمْنَاۗ اَنْتَ مَوْلٰىنَا فَانْصُرْنَا عَلَىالْقَوْمِ الْكٰفِرِيْنَ</p>', 'Suara Mimbar', 'Dr. H. Moh. Mahrus, S. Ag M. HI', '01JY9ENS0FKYDVXHHBBS1K3BDR.jpg', '2025-06-21 06:35:56', '2025-06-21 06:35:56'),
(2, 'Dr. H. Akhmad Haries, M.SI dari UINSI Samarinda Jadi Narasumber Talkshow dengan Tema “Perempuan Peduli Hak Waris”', '<p>Acara talkshow tersebut dipandu oleh moderator Dr. Hj. Wahdatun Nisa, M.A., yang juga merupakan Wakil Dekan Bidang Kemahasiswaan dan Kerjasama Fakultas Ekonomi Bisnis dan Islam UINSI Samarinda. Keduanya membahas secara komprehensif isu-isu seputar hak waris perempuan dalam perspektif hukum Islam dan implementasinya dalam masyarakat modern.</p><p>SAMARINDA, UINSI NEWS – Dosen Fakultas Syariah Universitas Islam Negeri Sultan Aji Muhammad Idris (UINSI) Samarinda, Dr. H. Akhmad Haries, M.S.I., tampil sebagai narasumber dalam kegiatan Talkshow “Perempuan Peduli Hak Waris” yang diselenggarakan oleh Komisi Perempuan, Remaja, dan Keluarga Majelis Ulama Indonesia (MUI) Provinsi Kalimantan Timur bekerja sama dengan PW. Muslimat NU Kaltim. Kegiatan ini berlangsung di Hotel Bumi Senyiur, Samarinda.(19/6)</p>', 'Umum', 'Novan Halim', '01JY9FB99PCY4DSGPXZC1F88D7.jpg', '2025-06-21 06:47:41', '2025-06-21 06:47:41'),
(3, 'Pengarahan Camaba Jalur SNBT 2025, Tekankan Kepatuhan Informasi dan Proses Pendataan UKT', '<p><strong>SAMARINDA, UINSI NEWS,</strong>- Universitas Islam Negeri Sultan Aji Muhammad Idris (UINSI) Samarinda menyambut calon mahasiswa baru yang lolos melalui jalur Seleksi Nasional Berbasis Tes (SNBT) Tahun 2025 dengan pengarahan penting terkait regulasi, registrasi, dan proses pendataan Uang Kuliah Tunggal (UKT) secara daring melalui Google Meet. Rabu (19/6).</p><p>Prof. Dr. M. Nasir, M.Ag., Wakil Rektor Bidang Akademik dan Pengembangan Kelembagaan (APK) dalam sambutannya menyampaikan beberapa poin penting, terutama mengenai gratispol (gratis biaya kuliah melalui bantuan pemerintah Provinsi Kalimantan Timur). Beliau menekankan pentingnya mahasiswa aktif membaca pengumuman dan informasi resmi dari kampus, khusus perihal Gratispol, agar mahasiswa dapat aktif mengakses informasi yang disediakan oleh Premprov Kalimantan Timur.</p>', 'Umum', 'Nisa Rahmawati', '01JY9FQNMZH98TJ733GMHJ0Z1E.jpg', '2025-06-21 06:54:27', '2025-06-21 06:54:27'),
(4, 'Dekan Fakultas Syariah UINSI Lolos Seleksi Asesor Nasional Kenaikan Jabatan Akademik Dosen Rumpun Ilmu Agama Kemenag RI', '<p><strong>SAMARINDA, UINSI NEWS,</strong>- Prof. Alfitri, M.Ag., LL.M., Ph.D., Dekan Fakultas Syariah (FASYA) UIN Sultan Aji Muhammad Idris (UINSI) Samarinda lolos seleksi dan resmi ditetapkan sebagai Asesor/Reviewer Nasional dalam Tim Penilai Kenaikan Jabatan Akademik Dosen (JAD) Rumpun Ilmu Agama di lingkungan Kementerian Agama Republik Indonesia.</p><p>Penetapan tersebut tertuang dalam Keputusan Direktur Jenderal Pendidikan Islam Kementerian Agama Republik Indonesia Nomor 4591 Tahun 2025 tentang Tim Asesor Kenaikan Jabatan Akademik Dosen Jenjang Lektor Kepala dan Profesor Rumpun Ilmu Agama.</p><p>Asesor/Reviewer Nasional dalam Tim Penilai Kenaikan Jabatan Akademik Dosen (JAD) Rumpun Ilmu Agama akan bertugas untuk menilai dan merekomendasikan pengusulan jabatan akademik dosen dalam bidang keilmuan agama Islam secara nasional.</p><p>Proses rekrutmen Tim Penilai JAD ini dimulai sejak 12 Februari hingga 11 Maret 2025, dengan 211 peserta dinyatakan layak mengikuti tahapan lanjutan setelah lolos seleksi administrasi. Tahapan berikutnya adalah ujian tertulis yang diselenggarakan secara daring dan serentak pada 29 April 2025, diikuti oleh peserta dari berbagai perguruan tinggi keagamaan Islam di seluruh Indonesia.</p><p>Prof. Alfitri sampaikan bahwa penetapan ini merupakan amanah yang tidak hanya menjadi pencapaian pribadi, tapi juga peluang strategis untuk mendorong percepatan kenaikan jabatan akademik dosen di UINSI Samarinda.</p><p>“Saya bersyukur atas amanah dan kepercayaan yang diberikan oleh Kementerian Agama melalui penetapan sebagai asesor nasional. Penugasan ini bukan hanya kehormatan pribadi, tetapi juga menjadi peluang strategis bagi UINSI Samarinda dalam mendorong percepatan kenaikan jabatan akademik dosen,” ucapnya.</p><p>“Saat ini, jumlah Lektor Kepala dan Guru Besar di lingkungan UINSI masih tergolong terbatas. Dengan hadirnya asesor internal, kita dapat lebih aktif dalam proses pendampingan, penilaian, dan percepatan pengusulan, sehingga target peningkatan kualitas akademik dapat lebih terukur dan terencana,” lanjutnya.</p><p>Prof. Alfitri juga sampaikan bahwa ketersediaan asesor dari dalam institusi tentu akan memberikan dampak positif dalam menciptakan ekosistem akademik yang progresif dan berdaya saing. Oleh karena itu, beliau berharap capaian ini bisa menjadi pemantik semangat bagi para dosen di UINSI Samarinda untuk terus berkarya, meneliti, dan mempublikasikan hasil pemikirannya agar dapat naik jenjang ke Lektor Kepala maupun Guru Besar.</p>', 'Humas', 'Nisa Rahmawati', '01JYC39X0NPXJM20XTC8CZDXV9.jpeg', '2025-06-22 07:14:56', '2025-06-22 07:14:56'),
(5, 'Upaya Wujudkan Laboratorium Sains yang Bermutu, UINSI Samarinda Terima Kunjungan PT. Visicom Citra Perkasa dan PHYWE Jerman', '<p><strong>SAMARINDA, UINSI NEWS,</strong>– Prof. Dr. H. M. Tahir, S.Ag., M.M., Wakil Rektor Bidang Kemahasiswaan, Alumni, dan Kerjasama (KAK) Universitas Islam Negeri Sultan Aji Muhammad Idris (UINSI) Samarinda menerima kunjungan dari PT. Visicom Citra Perkasa dan Principal Brand, yaitu PHYWE Jerman, di Ruang Rapat Rektor lantai 2 Gedung Rektorat Kampus 2 UINSI. Rabu (18/6/2025).</p><p>Pada kesempatan itu, hadir pula Dekan Fakultas Tarbiyah dan Ilmu Keguruan (FTIK), Prof. Dr. Muchammad Eka Mahmud, M.Ag., Kepala Program Studi Tadris Biologi Dr. Khusnul Khotimah, M.Si., serta para dosen Tadris&nbsp; Biologi dan juga Kepala Laboratorium FTIK, Muhammad Agil, S.Si., M.Sc.</p><p>PT. Visicom Citra Perkasa yang dihadiri langsung oleh Direkturnya, Ibu Sri Wahyuni dan pihak PHYWE Jerman diwakili oleh Mr. Can Acar selaku Manager untuk wilayah Asia Pasifik (APAC) menyampaikan audiensi tentang profil perusahaannya dan siap untuk menjalin kerja sama. PHYWE merupakan perusahaan asal Jerman yang telah dikenal secara global sebagai penyedia peralatan eksperimen dan laboratorium di bidang fisika, kimia, dan biologi untuk keperluan pendidikan dan penelitian.</p>', 'Kegiatan', 'Novan Halim dan Selvi Ramadhani Putri', '01JYC3C6J73FZT7C3P1SAGPEER.jpg', '2025-06-22 07:16:11', '2025-06-22 07:16:11'),
(6, 'Rektor UINSI Hadiri 16th CUPT-CRISU Conference di IKN Nusantara', '<p>SAMARINDA, UINSI NEWS – Rektor Universitas Islam Negeri Sultan Aji Muhammad Idris (UINSI) Samarinda, Prof. Dr. Zurqoni, M.Ag. menghadiri kegiatan 16th CUPT-CRISU Conference 2025 yang diselenggarakan oleh Majelis Rektor Perguruan Tinggi Negeri Indonesia (MRPTNI) bekerjasama dengan Council University President of Thailand (CUPT). Konferensi bergengsi ini berlangsung di IKN Nusantara, Kalimantan Timur, pada 25–26 Agustus 2025 dengan tuan rumah Institut Teknologi Kalimantan (ITK) dan Konsorsium Perguruan Tinggi Negeri se-Kalimantan.</p><p>Mengusung tema “<em>Collaborative Innovation for Impact: Strengthening Food Security and Industrial Downstreaming through Higher Education Partnerships</em>”, konferensi ini menjadi wadah penting bagi pimpinan perguruan tinggi Indonesia dan Thailand dalam memperkuat kerjasama akademik dan riset, khususnya dalam menjawab tantangan global yang semakin kompleks.</p><p>Konferensi dibagi menjadi tiga forum utama, yaitu:</p><ol><li>The President/Rector Forum dengan High Level Meeting,</li><li>The Dean Forum, dan</li><li>The Student Forum.</li></ol><p>Rektor UINSI, Prof. Dr. Zurqoni, M.Ag., menyampaikan bahwa partisipasi UINSI dalam forum internasional ini merupakan langkah strategis untuk memperluas jejaring kerjasama, terutama dalam bidang riset dan inovasi yang relevan dengan kebutuhan pembangunan nasional serta penguatan daya saing global.</p>', 'Kunjungan', 'Admin', 'documents/berita/01K3JE6RN2M4GE3VBB1WKAE76E.jpg', '2025-08-26 04:39:23', '2025-08-26 04:39:23'),
(7, ' Perluas Jejaring Nasional dan Internasional, Kapus Kerja Sama dan Layanan Luar Negeri Ikuti Promotional Webinar University of Dundee', '<p><strong>SAMARINDA, UINSI NEWS</strong>,- H. Muhammad Hasan, M.I.S., Ph.D., Kepala Pusat Kerja Sama dan Layanan Luar Negeri UIN Sultan Aji Muhammad Idris (UINSI) Samarinda menghadiri Promotional Webinar terkait program Master dan Doktor dari berbagai Schools yang ada di University of Dundee secara daring melalui zoom meeting. Senin (20/1).&nbsp; Kegiatan ini merupakan tindak lanjut atas arahan Sekretaris Jenderal Kementerian Agama pada bulan Agustus 2024 yang lalu ketika Delegasi University of Dundee melakukan courtesy visit dimana diminta agar University of Dundee menjalin Kerjasama dengan seluruh Perguruan Tinggi di Lingkungan Kementerian Agama, termasuk UINSI Samarinda.<figure data-trix-attachment=\"{&quot;contentType&quot;:&quot;image/png&quot;,&quot;filename&quot;:&quot;image.png&quot;,&quot;filesize&quot;:235920,&quot;height&quot;:418,&quot;href&quot;:&quot;http://localhost:8000/storage/x5LFzWIrBrodnh3g0CuUQkg2LnBZFlrV6yT5S4Vq.png&quot;,&quot;url&quot;:&quot;http://localhost:8000/storage/x5LFzWIrBrodnh3g0CuUQkg2LnBZFlrV6yT5S4Vq.png&quot;,&quot;width&quot;:768}\" data-trix-content-type=\"image/png\" data-trix-attributes=\"{&quot;caption&quot;:&quot;Pembicara University Of Dundeee&quot;,&quot;presentation&quot;:&quot;gallery&quot;}\" class=\"attachment attachment--preview attachment--png\"><a href=\"http://localhost:8000/storage/x5LFzWIrBrodnh3g0CuUQkg2LnBZFlrV6yT5S4Vq.png\"><img src=\"http://localhost:8000/storage/x5LFzWIrBrodnh3g0CuUQkg2LnBZFlrV6yT5S4Vq.png\" width=\"768\" height=\"418\"><figcaption class=\"attachment__caption attachment__caption--edited\">Pembicara University Of Dundeee</figcaption></a></figure>Kesempatan ini menjadi pengalaman yang baik bagi Muhammad Hasan untuk menambah referensinya dalam menyusun strategi untuk penguatan internasionalisasi UIN Sultan Aji Muhammad Idris Samarinda dengan memperluas jejaring di nasional dan internasional.</p>', 'Kegiatan LP2M', 'Admin', 'documents/berita/01K3JEEE4Z4G41FCKXHTBN5JYA.jpeg', '2025-08-26 04:43:35', '2025-08-26 04:43:35');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('252d6b73-4ee2-4245-bed2-1986e7272f5a', 'Filament\\Notifications\\DatabaseNotification', 'App\\Models\\User', 5, '{\"actions\":[],\"body\":\"Proposal dengan judul \\\"Pendampingan Pengembangan Jurnal OJS Kampus XYA\\\" telah disetujui oleh Admin.\",\"color\":null,\"duration\":\"persistent\",\"icon\":\"heroicon-o-check-circle\",\"iconColor\":\"success\",\"status\":\"success\",\"title\":\"Selamat! Proposal Anda Diterima\",\"view\":\"filament-notifications::notification\",\"viewData\":[],\"format\":\"filament\"}', NULL, '2025-09-04 16:10:35', '2025-09-04 16:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proposals`
--

CREATE TABLE `proposals` (
  `id` bigint UNSIGNED NOT NULL,
  `lecturer_id` bigint UNSIGNED NOT NULL,
  `judul_usulan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Diajukan',
  `kata_kunci` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengelola_bantuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `klaster_bantuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bidang_ilmu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tema` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_penelitian` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kontribusi_keilmuan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `research_schemes` json DEFAULT NULL,
  `issn_jurnal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rencana_kegiatan` text COLLATE utf8mb4_unicode_ci,
  `profil_jurnal` text COLLATE utf8mb4_unicode_ci,
  `url_website_jurnal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_scopus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_surat_rekomendasi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_pengajuan_dana` int DEFAULT NULL,
  `abstrak` text COLLATE utf8mb4_unicode_ci,
  `substansi` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proposals`
--

INSERT INTO `proposals` (`id`, `lecturer_id`, `judul_usulan`, `status`, `kata_kunci`, `pengelola_bantuan`, `klaster_bantuan`, `bidang_ilmu`, `tema`, `jenis_penelitian`, `kontribusi_keilmuan`, `research_schemes`, `issn_jurnal`, `rencana_kegiatan`, `profil_jurnal`, `url_website_jurnal`, `url_scopus`, `url_surat_rekomendasi`, `total_pengajuan_dana`, `abstrak`, `substansi`, `created_at`, `updated_at`) VALUES
(16, 5, 'Pendampingan Pengembangan Jurnal OJS Kampus XYA', 'diterima', 'OJS, pendampingan, jurnal', 'PTKIN', '25329 - Pengabdian kepada Masyarakat Kolaborasi Nasional Antar PT dan atau Kementerian/Lembaga (BOPTN)', 'Kedokteran dan Ilmu Kesehatan', 'Kemaritiman', 'Riset Dasar', 'Tidak Berkontribusi', '[\"proposal\", \"biaya\", \"bebas\", \"diktis\"]', '12345678', '<p>Jelaskan mengapa kegiatan ini penting. Soroti pentingnya publikasi ilmiah bagi akademisi, peneliti, dan mahasiswa. Sebutkan tantangan yang sering dihadapi, seperti kesulitan dalam penulisan, pemilihan jurnal yang tepat, dan proses <em>review</em>. Jelaskan bahwa kegiatan pendampingan ini hadir untuk mengatasi tantangan tersebut dan meningkatkan kualitas serta kuantitas publikasi ilmiah.</p>', '<p>Di era digitalisasi, Usaha Mikro, Kecil, dan Menengah (UMKM) menjadi tulang punggung perekonomian nasional. Namun, banyak UMKM di sekitar lingkungan pendidikan, khususnya yang bergerak di sektor produk halal, masih menghadapi tantangan dalam hal adopsi teknologi digital untuk pemasaran dan manajemen. Kurangnya literasi digital, keterbatasan akses ke platform e-commerce, dan manajemen keuangan yang masih konvensional menjadi penghambat utama pertumbuhan mereka. Kondisi ini ironis mengingat potensi pasar yang besar dari komunitas akademik yang sadar akan pentingnya produk halal dan teknologi. Oleh karena itu, diperlukan sebuah program pengabdian yang menjembatani kesenjangan ini.</p>', 'https://jurnal-abc.example.com', 'https://www.scimagojr.com/journalsearch.php?q=12345', 'https://drive.example.com/rekomendasi.pdf', 58500000, '<p>Di era digitalisasi, Usaha Mikro, Kecil, dan Menengah (UMKM) menjadi tulang punggung perekonomian nasional. Namun, banyak UMKM di sekitar lingkungan pendidikan, khususnya yang bergerak di sektor produk halal, masih menghadapi tantangan dalam hal adopsi teknologi digital untuk pemasaran dan manajemen. Kurangnya literasi digital, keterbatasan akses ke platform e-commerce, dan manajemen keuangan yang masih konvensional menjadi penghambat utama pertumbuhan mereka. Kondisi ini ironis mengingat potensi pasar yang besar dari komunitas akademik yang sadar akan pentingnya produk halal dan teknologi. Oleh karena itu, diperlukan sebuah program pengabdian yang menjembatani kesenjangan</p>', '[{\"isi_bagian\": \"<p><strong>Lembaga Amil Zakat</strong> (LAZ) memegang peranan krusial dalam pengelolaan dana sosial keagamaan Zakat, Infak, dan Sedekah (ZIS) di Indonesia. Potensi dana ZIS nasional yang mencapai ratusan triliun rupiah menjadi harapan besar untuk pengentasan kemiskinan. Namun, salah satu tantangan terbesar yang dihadapi LAZ hingga saat ini adalah isu transparansi dan akuntabilitas, yang secara langsung berdampak pada tingkat kepercayaan masyarakat <em>muzakki</em>. Di sisi lain, perkembangan teknologi informasi, khususnya teknologi <strong><em>blockchain</em></strong>, menawarkan solusi revolusioner untuk masalah kepercayaan melalui sifatnya yang terdesentralisasi, transparan, dan tidak dapat diubah <em>immutable</em>. Meskipun potensinya besar, adopsi teknologi ini di sektor filantropi Islam masih sangat terbatas karena kurangnya model implementasi yang praktis dan sesuai dengan konteks operasional LAZ di Indonesia.</p>\", \"judul_bagian\": \"Latar Belakang\"}, {\"isi_bagian\": \"<p>Berdasarkan latar belakang yang telah diuraikan, maka rumusan masalah dalam penelitian ini adalah sebagai berikut:</p><ol><li>Bagaimana merancang model sistem pengelolaan dana ZIS berbasis teknologi blockchain yang transparan dan akuntabel untuk Lembaga Amil Zakat?</li><li>Apa saja faktor-faktor kunci <em>critical success factors</em> dan tantangan dalam implementasi prototipe sistem tersebut di lingkungan LAZ?</li><li>Bagaimana dampak penggunaan <em>prototipe</em> sistem berbasis blockchain terhadap persepsi transparansi di kalangan donatur <em>muzakki</em>?</li></ol><p><br></p>\", \"judul_bagian\": \"Rumusan Masalah\"}, {\"isi_bagian\": \"<p>Adapun tujuan yang ingin dicapai melalui penelitian ini adalah:</p><ol><li>Menghasilkan sebuah rancangan model dan prototipe aplikasi pengelolaan dana ZIS berbasis teknologi blockchain yang dapat dilacak <em>traceable</em> dari donatur hingga penerima manfaat.</li><li>Mengidentifikasi tantangan teknis, operasional, dan regulasi yang dihadapi dalam penerapan teknologi blockchain di Lembaga Amil Zakat.</li><li>Menganalisis dan mengukur perubahan tingkat kepercayaan donatur setelah diperkenalkannya sistem pengelolaan ZIS yang transparan.</li></ol>\", \"judul_bagian\": \"Manfaat Penelitian\"}, {\"isi_bagian\": \"<p>Penelitian ini diharapkan dapat memberikan manfaat signifikan bagi beberapa pihak:</p><ol><li><strong>Bagi Lembaga Amil Zakat (LAZ):</strong> Menyediakan model operasional baru untuk meningkatkan akuntabilitas dan kepercayaan publik, yang berpotensi meningkatkan penghimpunan dana ZIS.</li><li><strong>Bagi Masyarakat (Muzakki):</strong> Memberikan kepastian dan kemampuan untuk melacak alur donasi mereka, sehingga meningkatkan ketenangan dan kepercayaan saat berdonasi.</li><li><strong>Bagi Akademisi dan Pemerintah:</strong> Menjadi referensi ilmiah dan studi kasus mengenai penerapan teknologi canggih dalam sektor filantropi Islam, serta memberikan masukan untuk perumusan kebijakan terkait.</li></ol>\", \"judul_bagian\": \"Tujuan Penelitian\"}]', '2025-08-27 15:02:56', '2025-09-04 16:10:34'),
(17, 3, 'Pengembangan Sistem Informasi Penelitian Berbasis Web di PTKIN', 'ditolak', 'penelitian, sistem informasi, web, PTKIN', 'PTKIN', '25410 - Bantuan Penghargaan Penulis Buku di Penerbit Internasional Bereputasi (BOPTN)', 'Adab dan Humaniora', 'Pangan-Pertanian', 'Riset Terapan', 'BerkontribuReportResi', '[\"proposal\", \"biaya\", \"bebas\", \"diktis\"]', '123456789', '<p><strong>Unit Kerja Terkait (Pihak Pengguna Layanan TIPD)</strong><br> Unit kerja lain di lingkungan UINSI Samarinda, seperti fakultas, biro, atau lembaga, adalah pihak yang menerima layanan dari TIPD. Keterlibatan mereka sangat penting sebagai sumber data kualitatif dan umpan balik langsung mengenai kinerja layanan yang disediakan oleh TIPD.</p><p><br></p>', '<p>Jurnal&nbsp; ini akan menjadi setiap pihak yang terlibat dalam proses evaluasi memiliki peran dan tanggung jawab spesifik yang harus dilaksanakan secara konsisten.</p>', 'https://jurnal-123.example.com', 'https://www.scimagojr.com/journalsearch.php?q=4567', 'https://drive.example.com/rekomendasi-rizqi.pdf', 78400000, '<p>Dalam dinamika organisasi modern, kinerja bukan hanya dipandang sebagai hasil akhir dari suatu aktivitas, tetapi juga sebagai proses yang harus dikelola dengan penuh tanggung jawab, transparan, serta dapat dipertanggungjawabkan. Evaluasi kinerja menjadi salah satu instrumen penting yang tidak dapat dipisahkan dari siklus manajemen kinerja. Melalui evaluasi kinerja, organisasi dapat menilai sejauh mana program, kegiatan, dan sumber daya manusia yang dimiliki mampu berkontribusi terhadap pencapaian visi, misi, dan tujuan strategis.</p>', '[{\"isi_bagian\": \"<p>Ruang lingkup evaluasi mencakup seluruh aspek operasional TIPD, termasuk tetapi tidak terbatas pada infrastruktur jaringan, keamanan siber, kinerja aplikasi dan sistem informasi, serta kualitas dukungan teknis (helpdesk). Pedoman ini menetapkan metodologi evaluasi yang sistematis, dimulai dari tahap persiapan, pengumpulan data, analisis, hingga pelaporan akhir. Pendekatan ini dirancang untuk menghasilkan temuan yang objektif, didukung oleh data yang valid dan dapat dipertanggungjawabkan.</p>\", \"judul_bagian\": \"Ikhtisar Eksekutif\"}, {\"isi_bagian\": \"<p>Dalam lanskap pendidikan tinggi modern, teknologi informasi bukan lagi sekadar alat pendukung, melainkan motor penggerak utama yang menentukan daya saing dan efektivitas institusi. Universitas Islam Negeri Sultan Aji Muhammad Idris (UINSI) Samarinda, dengan visi strategisnya untuk menjadi \\\"Perguruan Tinggi yang Unggul dalam Pengembangan Masyarakat,\\\" menyadari sepenuhnya bahwa pencapaian visi tersebut sangat bergantung pada infrastruktur teknologi informasi yang andal dan sistem informasi yang terintegrasi. Di sinilah peran krusial Tim Informasi dan Pangkalan Data (TIPD) menjadi sangat sentral.<br>TIPD adalah unit kunci yang bertanggung jawab penuh atas pengelolaan, pengembangan, dan pemeliharaan seluruh ekosistem digital universitas, mulai dari jaringan internet, server, aplikasi akademik, hingga keamanan data. Kinerja TIPD secara langsung mempengaruhi kelancaran proses belajar mengajar, administrasi, dan penelitian. Namun, seiring dengan kompleksitas dan laju perubahan teknologi yang cepat, tantangan dalam mengelola unit ini juga semakin meningkat. Tanpa sebuah mekanisme evaluasi yang terstruktur, sulit untuk mengukur efektivitas program kerja, mengidentifikasi akar masalah, dan merencanakan perbaikan secara proaktif.</p>\", \"judul_bagian\": \"Latar Belakang\"}, {\"isi_bagian\": \"<ol><li><strong>Undang-Undang Nomor 5 Tahun 2014 tentang Aparatur Sipil Negara (ASN)</strong><br> Dasar hukum ini menjadi landasan utama bagi penyelenggaraan manajemen ASN, termasuk di dalamnya sistem penilaian kinerja yang menjadi fokus pedoman ini.</li><li><strong>Peraturan Pemerintah Nomor 30 Tahun 2019 tentang Penilaian Kinerja Pegawai Negeri Sipil</strong><br> Peraturan ini memberikan kerangka kerja yang lebih detail mengenai mekanisme dan prinsip-prinsip penilaian kinerja PNS yang wajib diterapkan oleh setiap instansi pemerintah.</li><li><strong>Peraturan Menteri Pendayagunaan Aparatur Negara dan Reformasi Birokrasi Nomor 6 Tahun 2022 tentang Pengelolaan Kinerja Pegawai Aparatur Sipil Negara</strong><br> Regulasi ini memberikan panduan teknis yang lebih spesifik mengenai sistem pengelolaan kinerja ASN, mulai dari perencanaan, pelaksanaan, pemantauan, hingga penilaian kinerja.</li><li><strong>Peraturan Menteri Agama Republik Indonesia Nomor 18 Tahun 2021 tentang Statuta Universitas Islam Negeri Sultan Aji Muhammad Idris Samarinda</strong> <strong>Sebagai acuan internal</strong><br> Peraturan ini mengukuhkan legalitas dan mandat UINSI Samarinda sebagai perguruan tinggi negeri yang memiliki otonomi dalam mengelola tata kelola internalnya, termasuk urusan kepegawaian dan evaluasi kinerja.</li><li><strong>Keputusan Rektor Universitas Islam Negeri Sultan Aji Muhammad Idris Samarinda tentang Visi, Misi, Tujuan, dan Sasaran Strategis</strong><br> Keputusan ini menjadi acuan strategis yang memastikan bahwa setiap evaluasi kinerja, khususnya di lingkungan TIPD, selaras dan berkontribusi langsung pada pencapaian tujuan institusi secara menyeluruh.</li></ol>\", \"judul_bagian\": \"Dasar Hukum\"}, {\"isi_bagian\": \"<ol><li><strong>Memberikan Acuan Baku:</strong> Menyediakan pedoman yang terstandarisasi untuk pelaksanaan evaluasi kinerja internal TIPD, sehingga setiap proses dijalankan dengan konsistensi dan integritas.</li><li><strong>Menjamin Objektivitas dan Akuntabilitas:</strong> Memastikan bahwa setiap tahapan evaluasi kinerja dilakukan secara objektif, transparan, dan akuntabel, menjauhkan proses dari unsur subjektivitas.</li><li><strong>Meningkatkan Kualitas Manajemen Kinerja:</strong> Berkontribusi pada perbaikan sistem manajemen kinerja organisasi secara menyeluruh, dengan menyediakan data dan analisis yang valid.</li><li><strong>Mendukung Pengambilan Keputusan Strategis:</strong> Menjadi dasar bagi pimpinan dalam mengambil keputusan yang berkaitan dengan pengembangan sumber daya manusia (SDM), pemberian penghargaan, serta program pembinaan yang relevan.</li><li><strong>Meningkatkan Efisiensi dan Efektivitas Operasional:</strong> Mengidentifikasi area-area yang memerlukan perbaikan dalam proses kerja TIPD, sehingga sumber daya dapat dialokasikan secara lebih efisien dan layanan yang diberikan menjadi lebih efektif.</li></ol>\", \"judul_bagian\": \"Tujuan Penelitian\"}, {\"isi_bagian\": \"<p>Evaluasi kinerja adalah proses sistematis dan terstruktur untuk mengukur dan menilai efektivitas serta efisiensi pelaksanaan tugas dan fungsi suatu organisasi atau individu dalam periode waktu tertentu. Dalam konteks pedoman ini, evaluasi kinerja TIPD UIN Sultan Aji Muhammad Idris Samarinda merupakan sebuah proses terencana yang bertujuan untuk membandingkan capaian aktual dengan target dan standar yang telah ditetapkan sebelumnya.</p>\", \"judul_bagian\": \"Definisi Evaluasi Kinerja\"}, {\"isi_bagian\": \"<ol><li><strong>Objektivitas:</strong> Penilaian dilakukan berdasarkan data dan fakta yang valid, bukan berdasarkan asumsi atau bias pribadi. Setiap temuan harus didukung oleh bukti yang dapat diverifikasi.</li><li><strong>Transparansi:</strong> Seluruh tahapan proses evaluasi, mulai dari kriteria penilaian hingga hasil dan rekomendasinya, harus dapat diakses dan diketahui oleh pihak-pihak terkait.</li><li><strong>Akuntabilitas:</strong> Pihak-pihak yang terlibat dalam evaluasi memiliki tanggung jawab penuh atas pelaksanaan proses dan keabsahan hasil yang dilaporkan. Hasil evaluasi harus dapat dipertanggungjawabkan kepada seluruh pemangku kepentingan.</li><li><strong>Relevansi:</strong> Kriteria dan indikator yang digunakan dalam evaluasi harus relevan dengan tugas pokok dan fungsi TIPD serta berkontribusi pada pencapaian sasaran strategis universitas.</li><li><strong>Keterukuran:</strong> Kinerja yang dievaluasi harus dapat diukur, baik secara kuantitatif maupun kualitatif, menggunakan indikator yang jelas dan terdefinisi dengan baik.</li></ol>\", \"judul_bagian\": \"Prinsip Evaluasi Kinerja\"}]', '2025-09-02 05:35:30', '2025-09-02 08:40:36'),
(18, 6, 'Implementasi Algoritma Machine Learning untuk Prediksi Curah Hujan Berbasis Data Historis di Wilayah Pulau Jawa', 'dalam_penilaian', 'Machine Learning, prediksi curah hujan, data historis, random forest, support vector machine.', 'PTKIN', '25205 - Bantuan Pendampingan Kualitas Jurnal International  Bereputasi (BOPTN)', 'Kedokteran dan Ilmu Kesehatan', 'Kedokteran dan Kesehatan', 'Riset Dasar', 'BerkontribuReportResi', '[\"proposal\", \"biaya\", \"bebas\", \"diktis\"]', '12345670', '<p>Jelaskan mengapa kegiatan ini penting. Soroti pentingnya publikasi ilmiah bagi akademisi, peneliti, dan mahasiswa. Sebutkan tantangan yang sering dihadapi, seperti kesulitan dalam penulisan, pemilihan jurnal yang tepat, dan proses <em>review</em>. Jelaskan bahwa kegiatan pendampingan ini hadir untuk mengatasi tantangan tersebut dan meningkatkan kualitas serta kuantitas publikasi ilmiah.</p>', '<p><strong>Jurnal Sains dan Teknologi Canggih (JSTC) JSTC</strong> adalah jurnal <em>peer-review</em> yang berfokus pada publikasi hasil penelitian orisinal dan kajian literatur di bidang <strong>Sains dan Teknologi</strong>. Lingkup pembahasan mencakup, tetapi tidak terbatas pada:</p><ul><li>Kecerdasan Buatan dan <em>Machine Learning</em></li><li>Robotika dan Otomasi</li><li><em>Data Science</em> dan Analisis Big Data</li><li><em>Cybersecurity</em> dan Kriptografi</li><li>Inovasi Material dan Nanoteknologi</li><li>Rekayasa Perangkat Lunak</li></ul>', 'https://jurnal-456.example.com', 'https://www.scimagojr.com/journalsearch.php?q=12341', 'https://drive.example.com/rekomendasi-kampus.pdf', 45500000, '<p>Prediksi curah hujan memegang peranan krusial dalam berbagai sektor, seperti pertanian, manajemen sumber daya air, dan mitigasi bencana alam. Metode prediksi konvensional sering kali memiliki keterbatasan dalam akurasi dan kecepatan, terutama untuk area yang luas dan memiliki topografi kompleks seperti Pulau Jawa. Seiring dengan kemajuan teknologi, penggunaan <strong>algoritma </strong><strong><em>machine learning</em></strong> menawarkan potensi besar untuk meningkatkan akurasi prediksi. Model ini mampu mengidentifikasi pola rumit dalam set data historis yang besar, termasuk variabel-variabel meteorologis seperti suhu, kelembaban, dan tekanan udara. Oleh karena itu, penelitian ini akan mengimplementasikan beberapa algoritma <em>machine learning</em> untuk membangun model prediksi curah hujan yang lebih efektif dan akurat.</p>', '[{\"isi_bagian\": \"<p>Prediksi curah hujan memegang peranan krusial dalam berbagai sektor, seperti pertanian, manajemen sumber daya air, dan mitigasi bencana alam. Metode prediksi konvensional sering kali memiliki keterbatasan dalam akurasi dan kecepatan, terutama untuk area yang luas dan memiliki topografi kompleks seperti Pulau Jawa. Seiring dengan kemajuan teknologi, penggunaan <strong>algoritma </strong><strong><em>machine learning</em></strong> menawarkan potensi besar untuk meningkatkan akurasi prediksi. Model ini mampu mengidentifikasi pola rumit dalam set data historis yang besar, termasuk variabel-variabel meteorologis seperti suhu, kelembaban, dan tekanan udara. Oleh karena itu, penelitian ini akan mengimplementasikan beberapa algoritma <em>machine learning</em> untuk membangun model prediksi curah hujan yang lebih efektif dan akurat.</p>\", \"judul_bagian\": \"Latar Belakang\"}, {\"isi_bagian\": \"<ol><li>Bagaimana kinerja algoritma <strong>Random Forest</strong> dan <strong>Support Vector Machine (SVM)</strong> dalam memprediksi curah hujan di wilayah Pulau Jawa?</li><li>Variabel meteorologis apa saja yang paling dominan mempengaruhi akurasi prediksi curah hujan?</li><li>Bagaimana model yang dikembangkan dapat memberikan hasil prediksi yang lebih akurat dibandingkan metode konvensional?</li></ol>\", \"judul_bagian\": \"Rumusan Masalah\"}, {\"isi_bagian\": \"<ol><li><strong>Tujuan Utama:</strong> Mengembangkan dan mengevaluasi model prediksi curah hujan menggunakan algoritma <em>machine learning</em>.</li><li><strong>Tujuan Khusus:</strong></li></ol><ul><li><ul><li>Membandingkan akurasi prediksi antara model <strong>Random Forest</strong> dan <strong>SVM</strong>.</li><li>Mengidentifikasi faktor-faktor penting yang memengaruhi curah hujan melalui analisis data.</li><li>Menghasilkan <em>prototype</em> aplikasi yang dapat memvisualisasikan hasil prediksi.</li></ul></li></ul>\", \"judul_bagian\": \"Tujuan Penelitian\"}, {\"isi_bagian\": \"<ul><li><strong>Bagi Akademisi:</strong> Memberikan kontribusi pada pengembangan ilmu <strong>Geoinformatika</strong> dan <strong>Kecerdasan Buatan</strong>, serta menjadi referensi untuk penelitian selanjutnya.</li><li><strong>Bagi Masyarakat:</strong> Hasil prediksi dapat digunakan oleh petani untuk perencanaan tanam, pemerintah daerah untuk mitigasi banjir, dan masyarakat umum untuk aktivitas sehari-hari.</li><li><strong>Bagi Pemerintah:</strong> Model yang dihasilkan dapat menjadi alat bantu bagi instansi terkait (misalnya BMKG) dalam membuat keputusan yang lebih tepat.</li></ul>\", \"judul_bagian\": \"Manfaat Penelitian\"}, {\"isi_bagian\": \"<p><strong>Konsep Dasar Prediksi Curah Hujan:</strong> Menjelaskan pentingnya prediksi curah hujan dan metode-metode yang telah ada.</p><ul><li><strong>Algoritma </strong><strong><em>Machine Learning</em></strong>: Membahas secara mendalam mengenai cara kerja dan keunggulan algoritma <strong>Random Forest</strong> dan <strong>SVM</strong> dalam kasus prediksi waktu.</li><li><strong>Studi Terdahulu:</strong> Mereview penelitian-penelitian sebelumnya yang telah mengaplikasikan <em>machine learning</em> untuk masalah yang serupa, baik di Indonesia maupun di luar negeri, untuk mengidentifikasi celah penelitian yang ada.</li></ul>\", \"judul_bagian\": \"Tinjauan Pustaka\"}, {\"isi_bagian\": \"<ol><li><strong>Jenis Penelitian:</strong> Penelitian kuantitatif dengan pendekatan eksperimental.</li><li><strong>Data:</strong> Data historis curah hujan dan variabel meteorologis (suhu, kelembaban, kecepatan angin, tekanan udara) dari stasiun-stasiun BMKG di Pulau Jawa dalam periode 5 tahun terakhir.</li><li><strong>Tahapan Penelitian:</strong></li></ol><ul><li><strong>Pengumpulan dan Pra-pemrosesan Data:</strong> Mengumpulkan data dari sumber resmi, melakukan <em>data cleansing</em>, <em>feature selection</em>, dan normalisasi.</li><li><strong>Pemodelan:</strong> Melatih model <strong>Random Forest</strong> dan <strong>SVM</strong> dengan <em>training data</em> yang telah diproses.</li><li><strong>Evaluasi Model:</strong> Mengukur kinerja model menggunakan metrik seperti <em>Mean Absolute Error (MAE)</em> dan <em>Root Mean Square Error (RMSE)</em>.</li><li><strong>Implementasi:</strong> Membangun <em>prototype</em> aplikasi untuk visualisasi hasil prediksi.</li></ul>\", \"judul_bagian\": \"Metodologi Penelitian\"}]', '2025-09-03 04:56:49', '2025-09-03 06:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `proposal_documents`
--

CREATE TABLE `proposal_documents` (
  `id` bigint UNSIGNED NOT NULL,
  `proposal_id` bigint UNSIGNED NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proposal_documents`
--

INSERT INTO `proposal_documents` (`id`, `proposal_id`, `jenis`, `file_path`, `created_at`, `updated_at`) VALUES
(23, 16, 'proposal', '{\"1caea65d-9a47-4f4c-9cb3-187a7f19f60c\":\"documents\\/proposal\\/01K3P4972ZMPW1YH07B3WZ154M.pdf\"}', '2025-08-27 15:02:56', '2025-09-06 03:48:38'),
(24, 16, 'rab', '{\"4a122afb-bdf5-429f-b1f5-2e12719c9528\":\"documents\\/proposal\\/01K3P4973360EJ99702D5E74ES.pdf\"}', '2025-08-27 15:02:56', '2025-09-06 03:48:38'),
(25, 16, 'cek_similarity', '{\"ce4088b0-2dd4-4ab4-8510-1a1c72e24a0e\":\"documents\\/proposal\\/01K3Q3QYXG4G14QQ4VG7P49YH2.pdf\"}', '2025-08-28 00:12:45', '2025-09-06 03:48:38'),
(26, 17, 'proposal', 'documents/proposal/01K44J6HS1KGE6MEYYCNDP2WPE.pdf', '2025-09-02 05:35:31', '2025-09-02 05:35:31'),
(27, 17, 'rab', 'documents/proposal/01K44J6HS45C028ECBVHY45P53.pdf', '2025-09-02 05:35:31', '2025-09-02 05:35:31'),
(28, 17, 'cek_similarity', 'documents/proposal/01K44J6HS6BAMMEKS1YZS929MG.pdf', '2025-09-02 05:35:31', '2025-09-02 05:35:31'),
(29, 18, 'proposal', 'documents/proposal/01K472CDPXXAJ63CSXMYBT9200.pdf', '2025-09-03 04:56:49', '2025-09-03 04:56:49'),
(30, 18, 'rab', 'documents/proposal/01K472CDPZSM2JSTGZAA2SH2J4.pdf', '2025-09-03 04:56:49', '2025-09-03 04:56:49'),
(31, 18, 'cek_similarity', 'documents/proposal/01K472CDQ1VD632HEP51H5GE45.pdf', '2025-09-03 04:56:49', '2025-09-03 04:56:49'),
(32, 18, 'pendukung', 'documents/proposal/01K472CDQ2EBRAJ1XYZY4N8G9B.pdf', '2025-09-03 04:56:49', '2025-09-03 04:56:49');

-- --------------------------------------------------------

--
-- Table structure for table `proposal_lecturers`
--

CREATE TABLE `proposal_lecturers` (
  `id` bigint UNSIGNED NOT NULL,
  `proposal_id` bigint UNSIGNED NOT NULL,
  `nama_dosen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institusi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nidn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proposal_lecturers`
--

INSERT INTO `proposal_lecturers` (`id`, `proposal_id`, `nama_dosen`, `nip`, `institusi`, `created_at`, `updated_at`, `jabatan`, `nidn`) VALUES
(18, 16, 'Margono', '199902082025051005', 'UIN Sunan Kalijaga', '2025-08-27 15:02:56', '2025-09-06 03:48:38', 'Anggota', '1234567891'),
(19, 17, 'Sumargono, S.Kom', '197702082024', 'UINSI Samarinda', '2025-09-02 05:35:31', '2025-09-02 10:06:08', 'Anggota', '197702082021'),
(20, 17, 'Suketi, S.Pd.I', '197702082023', 'Universitas Mulawarman', '2025-09-02 05:35:31', '2025-09-02 05:35:31', 'Anggota', '1977020824'),
(21, 18, 'Ahmad Saufi, S.T., M.Eng.', '197805122005011002', 'Departemen Teknik Elektro dan Teknologi Informasi, Universitas Teknologi Maju', '2025-09-03 04:56:49', '2025-09-03 04:56:49', 'Anggota', '0012057801'),
(22, 18, 'Dr. Rina Agustina, M.Si.', '198207212009022001', 'Departemen Geofisika, Universitas Teknologi Maju', '2025-09-03 04:56:49', '2025-09-03 04:56:49', 'Anggota', '0021078202');

-- --------------------------------------------------------

--
-- Table structure for table `proposal_logbooks`
--

CREATE TABLE `proposal_logbooks` (
  `id` bigint UNSIGNED NOT NULL,
  `proposal_id` bigint UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `tempat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_kegiatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teknik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proposal_logbooks`
--

INSERT INTO `proposal_logbooks` (`id`, `proposal_id`, `tanggal`, `tempat`, `nama_kegiatan`, `teknik`, `deskripsi`, `file_path`, `created_at`, `updated_at`) VALUES
(6, 17, '2025-03-13', 'STAIN Balikpapan', 'Optimasi Metadata Kursi', 'FGD', 'Optimalisasi', 'documents/logbook/FORM SURAT PERNYATAAN KESANGGUPAN.pdf', '2025-09-02 06:54:52', '2025-09-02 06:54:52'),
(7, 17, '2025-09-02', 'STAIN Balikpapan', 'Pengiriman Surat Permohona Izin', 'Penyebaran Angket', 'Izin Penelitian', 'documents/logbook/FORM SURAT PERNYATAAN KESANGGUPAN.pdf', '2025-09-02 06:55:32', '2025-09-02 06:55:32');

-- --------------------------------------------------------

--
-- Table structure for table `proposal_outcomes`
--

CREATE TABLE `proposal_outcomes` (
  `id` bigint UNSIGNED NOT NULL,
  `proposal_id` bigint UNSIGNED NOT NULL,
  `jenis_outcomes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_outcomes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_jurnal_fix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `volume_jurnal_fix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_jurnal_fix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_isbn_fix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penerbit_buku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tahun_terbit_buku` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proposal_outcomes`
--

INSERT INTO `proposal_outcomes` (`id`, `proposal_id`, `jenis_outcomes`, `judul_outcomes`, `nama_jurnal_fix`, `volume_jurnal_fix`, `link_jurnal_fix`, `nomor_isbn_fix`, `penerbit_buku`, `tahun_terbit_buku`, `created_at`, `updated_at`) VALUES
(5, 17, 'Artikel Jurnal', 'MFQ: Network Bandwidth Utilization among Data Centers on Software Defi ned Network Using Multilevel-Feedback Queue', 'Abdinus Jurnal Pengabdian Nusantara', 'Volume 21 No. 7, 2025, 1576-1585', 'https://thescipub.com/abstract/jcssp.2025.1576.1585', NULL, NULL, NULL, '2025-09-02 08:19:39', '2025-09-02 08:19:39');

-- --------------------------------------------------------

--
-- Table structure for table `proposal_outputs`
--

CREATE TABLE `proposal_outputs` (
  `id` bigint UNSIGNED NOT NULL,
  `proposal_id` bigint UNSIGNED NOT NULL,
  `type_outputs` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `documents_outputs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proposal_outputs`
--

INSERT INTO `proposal_outputs` (`id`, `proposal_id`, `type_outputs`, `documents_outputs`, `created_at`, `updated_at`) VALUES
(5, 17, 'file_hki', 'documents/outputs/Pemanggilan LATSAR CPNS Gel. II.pdf', '2025-09-02 06:55:59', '2025-09-02 06:55:59'),
(6, 17, 'file_laporan_lengkap', 'documents/outputs/Pemanggilan LATSAR CPNS Gel. II.pdf', '2025-09-02 06:56:10', '2025-09-02 06:56:10'),
(7, 17, 'file_executive_summary', 'documents/outputs/Lamaran pekerjaan baru.pdf', '2025-09-02 06:56:34', '2025-09-02 06:56:34');

-- --------------------------------------------------------

--
-- Table structure for table `proposal_p_t_u_s`
--

CREATE TABLE `proposal_p_t_u_s` (
  `id` bigint UNSIGNED NOT NULL,
  `proposal_id` bigint UNSIGNED NOT NULL,
  `nama_peneliti` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nidn_nik` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institusi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proposal_p_t_u_s`
--

INSERT INTO `proposal_p_t_u_s` (`id`, `proposal_id`, `nama_peneliti`, `nidn_nik`, `institusi`, `created_at`, `updated_at`) VALUES
(16, 16, 'Rudi', '199902082025051005', 'BRIN', '2025-08-27 15:02:56', '2025-09-06 03:48:38'),
(18, 18, NULL, NULL, NULL, '2025-09-03 04:56:49', '2025-09-03 04:56:49');

-- --------------------------------------------------------

--
-- Table structure for table `proposal_reports`
--

CREATE TABLE `proposal_reports` (
  `id` bigint UNSIGNED NOT NULL,
  `proposal_id` bigint UNSIGNED NOT NULL,
  `report_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path_3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path_4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usulan_biaya` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proposal_reports`
--

INSERT INTO `proposal_reports` (`id`, `proposal_id`, `report_type`, `file_path`, `file_path_2`, `file_path_3`, `file_path_4`, `usulan_biaya`, `created_at`, `updated_at`) VALUES
(4, 17, 'laporan_keuangan_sementara', 'documents/laporan/progress/SK PTT Hernansyah.pdf', 'documents/laporan/keuangan/Pernyataan absensi Kosong.pdf', 'documents/laporan/final/Laporan Mesin Eror_Rizqi Saputra_2 Juli 2025.pdf', 'documents/laporan/final/RAB Absensi WA MAN 2 Samarinda.pdf', NULL, '2025-09-02 06:57:56', '2025-09-02 06:57:56');

-- --------------------------------------------------------

--
-- Table structure for table `proposal_reviewer`
--

CREATE TABLE `proposal_reviewer` (
  `proposal_id` bigint UNSIGNED NOT NULL,
  `reviewer_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proposal_reviewer`
--

INSERT INTO `proposal_reviewer` (`proposal_id`, `reviewer_id`, `created_at`, `updated_at`) VALUES
(16, 2, NULL, NULL),
(17, 1, NULL, NULL),
(17, 2, NULL, NULL),
(18, 1, NULL, NULL),
(18, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `proposal_students`
--

CREATE TABLE `proposal_students` (
  `id` bigint UNSIGNED NOT NULL,
  `proposal_id` bigint UNSIGNED NOT NULL,
  `nama_mahasiswa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_studi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proposal_students`
--

INSERT INTO `proposal_students` (`id`, `proposal_id`, `nama_mahasiswa`, `nim`, `program_studi`, `created_at`, `updated_at`) VALUES
(17, 16, 'Rizqi', '11111111111', 'Sistem Informasi', '2025-08-27 15:02:56', '2025-09-06 03:48:38'),
(19, 18, 'Kevin Wijaya', '2021081001', 'Teknik Kimia', '2025-09-03 04:56:49', '2025-09-03 04:56:49');

-- --------------------------------------------------------

--
-- Table structure for table `proposal_supporting_files`
--

CREATE TABLE `proposal_supporting_files` (
  `id` bigint UNSIGNED NOT NULL,
  `proposal_id` bigint UNSIGNED NOT NULL,
  `nama_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publications`
--

CREATE TABLE `publications` (
  `id` bigint UNSIGNED NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penulis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_jurnal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_ISBN` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `penerbit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `lecturer_id` bigint UNSIGNED DEFAULT NULL,
  `jurnal_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publications`
--

INSERT INTO `publications` (`id`, `jenis`, `judul`, `penulis`, `nama_jurnal`, `nomor_ISBN`, `penerbit`, `created_at`, `updated_at`, `lecturer_id`, `jurnal_link`) VALUES
(5, 'Buku', 'Pattern Recognition of Sarong Fabric Using Machine Learning Approach Based on Computer Vision for Cultural Preservation.', 'Masna Wati, Rizqi Saputra, Andi Tedjawati, Hamdani Hamdani', NULL, '123456', 'Dunia Ini', '2025-06-28 01:30:18', '2025-06-28 01:30:18', 3, NULL),
(6, 'Artikel', 'Pattern Recognition of Sarong Fabric Using Machine Learning Approach Based on Computer Vision for Cultural Preservation.', 'Masna Wati, Rizqi Saputra, Andi Tedjawati, Hamdani Hamdani', 'International Journal of Intelligent Engineering & Systems', NULL, NULL, '2025-06-28 01:32:21', '2025-06-28 01:32:21', 5, 'https://inass.org/wp-content/uploads/2022/04/2022103126-1.pdf'),
(7, 'Buku', 'Kenapa Kopi Bisa Mengubah Dunia', 'Rizqi Jon Ngerik', NULL, 'ISBN: 2000000', 'Penerbit Dunia Ini Indah', '2025-06-29 03:12:04', '2025-06-29 03:12:04', 5, NULL),
(8, 'Artikel', 'Kenapa dunia ini Kocak', 'Udin', 'Jurnal dunia', NULL, NULL, '2025-07-28 01:20:10', '2025-07-28 01:20:10', 5, 'https://www.elsevier.com/products/scopus'),
(9, 'Artikel', 'Kenapa Kucingku Lucu dan Comel', 'Marliana Mantap', 'Jurnal Kematian', NULL, NULL, '2025-08-25 05:01:19', '2025-08-25 05:01:19', 6, 'https://litapdimas.kemenag.go.id');

-- --------------------------------------------------------

--
-- Table structure for table `required_documents`
--

CREATE TABLE `required_documents` (
  `id` bigint UNSIGNED NOT NULL,
  `lecturer_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `documents` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `required_documents`
--

INSERT INTO `required_documents` (`id`, `lecturer_id`, `type`, `documents`, `created_at`, `updated_at`) VALUES
(2, 5, 'sertifikat_dosen', 'documents/berkas/Pengumuman Perpanjangan Penerimaan Proposal Program Kosabangsa Tahun Anggaran 2025.pdf', '2025-06-26 04:54:30', '2025-06-26 04:54:30'),
(3, 5, 'sk_jabatan_fungsional', 'documents/berkas/Pengumuman Perpanjangan Penerimaan Proposal Program Kosabangsa Tahun Anggaran 2025.pdf', '2025-06-26 04:57:05', '2025-06-26 04:57:05'),
(4, 5, 'kartu_nidn', 'documents/berkas/Pengumuman Perpanjangan Penerimaan Proposal Program Kosabangsa Tahun Anggaran 2025.pdf', '2025-06-27 04:57:11', '2025-06-27 04:57:11'),
(5, 3, 'sertifikat_dosen', 'documents/berkas/SK PTT Hernansyah.pdf', '2025-09-04 02:40:59', '2025-09-04 02:40:59');

-- --------------------------------------------------------

--
-- Table structure for table `reviewers`
--

CREATE TABLE `reviewers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_pengguna` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `study_program` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `sinta_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nidn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `functional_position` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scientific_field` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sinta_score_all_years` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sinta_score_3_years` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sinta_profile_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sinta_affiliation_all_years` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sinta_affiliation_3_years` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviewers`
--

INSERT INTO `reviewers` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `photo`, `status_pengguna`, `unit`, `study_program`, `nik`, `jk`, `tempat_lahir`, `tanggal_lahir`, `hp`, `alamat`, `sinta_id`, `nip`, `nidn`, `employee_type`, `profession`, `functional_position`, `scientific_field`, `sinta_score_all_years`, `sinta_score_3_years`, `sinta_profile_link`, `sinta_affiliation_all_years`, `sinta_affiliation_3_years`) VALUES
(1, 'Ousmane Dembélé', 'usman@gmail.com', NULL, '$2y$12$3kcBPTmnGa2afynQM62J2uyI3Y0xErC4OjpY2RlGu0yFIz6ZL9ggS', NULL, '2025-08-19 05:37:52', '2025-09-06 15:54:20', 'reviewer-photos/01K3JNA5K4FM5CSB1A1N5BXZHP.png', 'Reviewer', 'FEBI', 'Perbankan Syariah', '6472030607770002', 'Laki-laki', 'Vernon, France', '1997-05-15', '0895602695465', 'France', '235047', '197707062011011007', '2006077709', 'PPPK', 'Pengembang TP', 'Lektor Kepala', 'Ekonomi dan Bisnis Islam', '2.664', '11.694', 'https://sinta.kemdiktisaintek.go.id/authors/profile/235047', NULL, NULL),
(2, 'Daniel Baskara Putra', 'baskaraputra@yahoo.com', NULL, '$2y$12$QRf5Bs70mjGFnDlgyxyeJ.LmGpy6YafaLXpLrXNIP36.grwiMe7zG', NULL, '2025-08-26 13:56:42', '2025-09-07 09:58:15', 'reviewer-photos/01K3KE9S6XB1QXWM2AW55QZDS4.png', 'Dosen & Reviewer', 'FASYA', 'Hukum Ekonomi Syariah', '6472030607770006', 'Laki-laki', 'Jakarta', '1994-02-22', '0895602695468', 'Jagakarsa, Jakarta Selatan', '6021266', '197707062011011006', '2006077705', 'PNS', 'Pranata Komputer', 'Pranata Komputer', 'Sains dan Teknologi', '507', '393', 'https://sinta.kemdiktisaintek.go.id/authors/profile/6021266', NULL, NULL),
(3, 'Linus Benedict Torvalds', 'linustorvalds@linux.com', NULL, '$2y$12$vQjY1JR4SFVu5ftm4pVOzu.j5KUmXfr1x3Srz3v2hBk62bGQBG30q', NULL, '2025-08-28 04:45:44', '2025-08-28 04:45:44', 'documents/lecturers/01K3QKBTEPJ814213P4H70BQH7.png', 'Dosen & Reviewer', 'Unit Pelaksana Teknis', 'TIPD', '6472030607770013', 'Laki-laki', 'Helsinki, Finland', '1969-02-15', '0895602695471', 'Finland', '235049', '197707062011011005', '2006077705', 'PNS', 'Perancang UU', 'Lektor Kepala', 'Architecture', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviewer_educational_histories`
--

CREATE TABLE `reviewer_educational_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `reviewer_id` bigint UNSIGNED DEFAULT NULL,
  `jenjang` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_studi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `institusi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_masuk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_lulus` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ipk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dokumen_ijazah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviewer_educational_histories`
--

INSERT INTO `reviewer_educational_histories` (`id`, `reviewer_id`, `jenjang`, `program_studi`, `institusi`, `tahun_masuk`, `tahun_lulus`, `ipk`, `dokumen_ijazah`, `created_at`, `updated_at`) VALUES
(2, 2, 'S3', 'Computer Science and Informatics', 'Massachusetts Institute of Technology (MIT)', '2021', '2029', '3.78', 'documents/ijazah/01K3MJ4H9STYZ57F9S7YXMEVZG.pdf', '2025-08-27 00:26:34', '2025-08-27 00:26:34'),
(3, 1, 'S2', 'Computer Science', 'Imperial College London', '2021', '2024', '35.53', 'documents/ijazah/01K3MJS8MKYDWR8FABB8JYC4AS.pdf', '2025-08-27 00:37:53', '2025-08-27 00:37:53');

-- --------------------------------------------------------

--
-- Table structure for table `reviewer_required_documents`
--

CREATE TABLE `reviewer_required_documents` (
  `id` bigint UNSIGNED NOT NULL,
  `reviewer_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `documents` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviewer_required_documents`
--

INSERT INTO `reviewer_required_documents` (`id`, `reviewer_id`, `type`, `documents`, `created_at`, `updated_at`) VALUES
(1, 1, 'sertifikat_dosen', 'documents/berkas/Pengumuman Perpanjangan Penerimaan Proposal Program Kosabangsa Tahun Anggaran 2025.pdf', '2025-08-27 00:59:59', '2025-08-27 00:59:59'),
(2, 2, 'kartu_nidn', 'documents/berkas/Pengumuman Perpanjangan Penerimaan Proposal Program Kosabangsa Tahun Anggaran 2025.pdf', '2025-08-27 01:54:41', '2025-08-27 01:54:41');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `proposal_id` bigint UNSIGNED NOT NULL,
  `reviewer_id` bigint UNSIGNED NOT NULL,
  `komentar_substansi` json DEFAULT NULL,
  `skor_proposal` json DEFAULT NULL,
  `komentar_proposal` text COLLATE utf8mb4_unicode_ci,
  `skor_presentasi` json DEFAULT NULL,
  `komentar_presentasi` text COLLATE utf8mb4_unicode_ci,
  `rekomendasi_biaya` decimal(15,2) DEFAULT NULL,
  `komentar_luaran` text COLLATE utf8mb4_unicode_ci,
  `total_nilai_proposal` decimal(5,2) DEFAULT NULL,
  `total_nilai_presentasi` decimal(8,2) DEFAULT NULL,
  `catatan_validator` text COLLATE utf8mb4_unicode_ci,
  `status` enum('ditugaskan','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ditugaskan',
  `tahapan_review` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'proposal',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `proposal_id`, `reviewer_id`, `komentar_substansi`, `skor_proposal`, `komentar_proposal`, `skor_presentasi`, `komentar_presentasi`, `rekomendasi_biaya`, `komentar_luaran`, `total_nilai_proposal`, `total_nilai_presentasi`, `catatan_validator`, `status`, `tahapan_review`, `created_at`, `updated_at`) VALUES
(6, 16, 2, '{\"0\": {\"komentar\": \"<p>Mantap, Lanjutkan!!#$</p>\", \"judul_asli\": \"Latar Belakang\"}, \"1\": {\"komentar\": \"<p>Mantap, Lanjutkan!</p>\", \"judul_asli\": \"Rumusan Masalah\"}, \"2\": {\"komentar\": \"<p>Mantap, Lanjutkan!</p>\", \"judul_asli\": \"Manfaat Penelitian\"}, \"3\": {\"komentar\": \"<p>Mantap, Lanjutkan!</p>\", \"judul_asli\": \"Tujuan Penelitian\"}, \"abstrak\": \"<p>Mantap, Lanjutkan!</p>\"}', '{\"biaya_waktu\": \"4\", \"kajian_riset\": \"4\", \"originalitas\": \"4\", \"latar_belakang\": \"4\", \"rumusan_masalah\": \"4\", \"ketepatan_metode\": \"4\", \"keutuhan_gagasan\": \"4\", \"kontribusi_akademik\": \"4\", \"penggunaan_referensi\": \"4\"}', '<p>Mantap, Lanjutkan!</p>', '{\"keutuhan_gagasan\": \"1\", \"kelayakan_publikasi\": \"1\", \"kontribusi_akademik\": \"2\", \"rasionalisasi_anggaran\": \"2\"}', '<p>Mantap, Lanjutkan!</p>', 57000000.00, '<p>Mantap, Lanjutkan!</p>', 400.00, 140.00, 'Mantap, Lanjutkan!', 'selesai', 'selesai', '2025-09-01 12:32:18', '2025-09-01 15:25:25'),
(7, 17, 2, '{\"0\": {\"komentar\": \"<p>Isi sudah sesuai, namun perlu sedikit perubahan agar lebih baik dari segi penulisan</p>\", \"judul_asli\": \"Ikhtisar Eksekutif\"}, \"1\": {\"komentar\": \"<p>Isi sudah sesuai, namun perlu sedikit perubahan agar lebih baik dari segi penulisan</p>\", \"judul_asli\": \"Latar Belakang\"}, \"2\": {\"komentar\": \"<p>Isi sudah sesuai, namun perlu sedikit perubahan agar lebih baik dari segi penulisan</p>\", \"judul_asli\": \"Dasar Hukum\"}, \"3\": {\"komentar\": \"<p>Isi sudah sesuai, namun perlu sedikit perubahan agar lebih baik dari segi penulisan</p>\", \"judul_asli\": \"Tujuan Penelitian\"}, \"4\": {\"komentar\": \"<p>Isi sudah sesuai, namun perlu sedikit perubahan agar lebih baik dari segi penulisan</p>\", \"judul_asli\": \"Definisi Evaluasi Kinerja\"}, \"5\": {\"komentar\": \"<p>Isi sudah sesuai, namun perlu sedikit perubahan agar lebih baik dari segi penulisan</p>\", \"judul_asli\": \"Prinsip Evaluasi Kinerja\"}, \"abstrak\": \"<p>Isi sudah sesuai, namun perlu sedikit perubahan agar lebih baik dari segi penulisan</p>\"}', '{\"biaya_waktu\": \"1\", \"kajian_riset\": \"4\", \"originalitas\": \"3\", \"latar_belakang\": \"2\", \"rumusan_masalah\": \"1\", \"ketepatan_metode\": \"2\", \"keutuhan_gagasan\": \"3\", \"kontribusi_akademik\": \"1\", \"penggunaan_referensi\": \"4\"}', '<p>Isi sudah sesuai, namun perlu sedikit perubahan agar lebih baik dari segi penulisan</p>', '{\"keutuhan_gagasan\": \"1\", \"kelayakan_publikasi\": \"3\", \"kontribusi_akademik\": \"2\", \"rasionalisasi_anggaran\": \"2\"}', '<p>Isi sudah sesuai, namun perlu sedikit perubahan agar lebih baik dari segi penulisan</p>', 73210000.00, '<p>Luar biasa, cerdas</p>', 230.00, 180.00, 'Proposal sudah sesuai dengan klaster', 'selesai', 'selesai', '2025-09-02 06:46:30', '2025-09-02 08:34:58'),
(8, 17, 1, '{\"0\": {\"komentar\": \"<p>Isi sudah sesuai, namun perlu sedikit perubahan agar lebih baik dari segi penulisan</p>\", \"judul_asli\": \"Ikhtisar Eksekutif\"}, \"1\": {\"komentar\": \"<p>Isi sudah sesuai, namun perlu sedikit perubahan agar lebih baik dari segi penulisan</p>\", \"judul_asli\": \"Latar Belakang\"}, \"2\": {\"komentar\": \"<p>Isi sudah sesuai, namun perlu sedikit perubahan agar lebih baik dari segi penulisan</p>\", \"judul_asli\": \"Dasar Hukum\"}, \"3\": {\"komentar\": \"<p>Isi sudah sesuai, namun perlu sedikit perubahan agar lebih baik dari segi penulisan</p>\", \"judul_asli\": \"Tujuan Penelitian\"}, \"4\": {\"komentar\": \"<p>Isi sudah sesuai, namun perlu sedikit perubahan agar lebih baik dari segi penulisan</p>\", \"judul_asli\": \"Definisi Evaluasi Kinerja\"}, \"5\": {\"komentar\": \"<p>Isi sudah sesuai, namun perlu sedikit perubahan agar lebih baik dari segi penulisan</p>\", \"judul_asli\": \"Prinsip Evaluasi Kinerja\"}, \"abstrak\": \"<p>Isi sudah sesuai, namun perlu sedikit perubahan agar lebih baik dari segi penulisan</p>\"}', '{\"biaya_waktu\": \"1\", \"kajian_riset\": \"1\", \"originalitas\": \"2\", \"latar_belakang\": \"1\", \"rumusan_masalah\": \"2\", \"ketepatan_metode\": \"2\", \"keutuhan_gagasan\": \"2\", \"kontribusi_akademik\": \"2\", \"penggunaan_referensi\": \"3\"}', '<p>Isi sudah sesuai, namun perlu sedikit perubahan agar lebih baik dari segi penulisan</p>', '{\"keutuhan_gagasan\": \"1\", \"kelayakan_publikasi\": \"2\", \"kontribusi_akademik\": \"2\", \"rasionalisasi_anggaran\": \"2\"}', '<p>Sudah Aman</p>', 73210000.00, '<p>Luar Biasa, Mantap gan</p>', 180.00, 160.00, 'Isi sudah sesuai, namun perlu sedikit perubahan agar lebih baik dari segi penulisan', 'selesai', 'selesai', '2025-09-02 06:51:26', '2025-09-02 08:35:30'),
(9, 18, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ditugaskan', 'proposal', '2025-09-03 12:12:03', '2025-09-03 12:12:03'),
(10, 18, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ditugaskan', 'proposal', '2025-09-06 03:20:24', '2025-09-06 03:20:24');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-06-25 01:34:48', '2025-06-25 01:34:48'),
(2, 'dosen', 'web', '2025-06-25 01:36:22', '2025-06-25 01:36:22'),
(3, 'peneliti', 'web', '2025-06-25 01:37:43', '2025-06-25 01:37:43'),
(4, 'reviewer', 'reviewer', '2025-06-25 01:38:08', '2025-06-25 01:38:08');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('fe5UkdYtgwpHGmQysIvvVRNwJi4XvTD8MvLrtg6p', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRGJqejBjdTlldUlBNzg3U1dWVGJwR0tnYXJGazBGRG9FQk1Ga3pBOSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC91c2VyL2xvZ2luIjt9fQ==', 1757242795);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `photo`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'LP2M UINSI Samarinda', 'oplp2m@uinsi.ac.id', 'admin-photos/01K49M1W977B6JFJF86P1SQWBM.png', NULL, '$2y$12$NN7v7ui.dcxw0uaxXVYRo.Tj6d72LByMxmdn.XdMGK8nnTYakJQlC', NULL, '2025-06-21 05:11:50', '2025-09-04 05:47:12'),
(3, 'Hernansyah', 'hernansyah@gmail.com', NULL, NULL, '$2y$12$nBanGovn70Dx.TNTlFEI5OiARKpVCX2M2jNJCuL.cvfIvshhZlfEO', NULL, '2025-06-25 00:03:00', '2025-09-06 15:10:20'),
(5, 'Rizqi Saputra', 'rizqisap48@gmail.com', NULL, NULL, '$2y$12$BsrUCuRNVStFbM.z0Tp1muzUOLXjW1EFxufj3ekJXu4o1R4zKrY2m', NULL, '2025-06-25 04:38:34', '2025-08-27 01:35:54'),
(6, 'Yayas Clevara', 'yayasclevara@gmail.com', NULL, NULL, '$2y$12$4NJgd7n/Bz5H38eHyqnXQuNmJe79lS7Fx1byKCvg8Um73l/0xhrMi', NULL, '2025-06-29 05:54:30', '2025-06-29 05:54:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `educational_histories`
--
ALTER TABLE `educational_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `educational_histories_lecturer_id_foreign` (`lecturer_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guides`
--
ALTER TABLE `guides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `independent_activities`
--
ALTER TABLE `independent_activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `independent_activities_lecturer_id_foreign` (`lecturer_id`);

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lecturers_user_id_unique` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposals_lecturer_id_foreign` (`lecturer_id`);

--
-- Indexes for table `proposal_documents`
--
ALTER TABLE `proposal_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposal_documents_proposal_id_foreign` (`proposal_id`);

--
-- Indexes for table `proposal_lecturers`
--
ALTER TABLE `proposal_lecturers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposal_lecturers_proposal_id_foreign` (`proposal_id`);

--
-- Indexes for table `proposal_logbooks`
--
ALTER TABLE `proposal_logbooks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposal_logbooks_proposal_id_tanggal_index` (`proposal_id`,`tanggal`);

--
-- Indexes for table `proposal_outcomes`
--
ALTER TABLE `proposal_outcomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposal_outcomes_proposal_id_foreign` (`proposal_id`);

--
-- Indexes for table `proposal_outputs`
--
ALTER TABLE `proposal_outputs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposal_outputs_proposal_id_foreign` (`proposal_id`);

--
-- Indexes for table `proposal_p_t_u_s`
--
ALTER TABLE `proposal_p_t_u_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposal_p_t_u_s_proposal_id_foreign` (`proposal_id`);

--
-- Indexes for table `proposal_reports`
--
ALTER TABLE `proposal_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposal_reports_proposal_id_foreign` (`proposal_id`);

--
-- Indexes for table `proposal_reviewer`
--
ALTER TABLE `proposal_reviewer`
  ADD PRIMARY KEY (`proposal_id`,`reviewer_id`),
  ADD KEY `proposal_reviewer_reviewer_id_foreign` (`reviewer_id`);

--
-- Indexes for table `proposal_students`
--
ALTER TABLE `proposal_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposal_students_proposal_id_foreign` (`proposal_id`);

--
-- Indexes for table `proposal_supporting_files`
--
ALTER TABLE `proposal_supporting_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposal_supporting_files_proposal_id_foreign` (`proposal_id`);

--
-- Indexes for table `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publications_lecturer_id_foreign` (`lecturer_id`);

--
-- Indexes for table `required_documents`
--
ALTER TABLE `required_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `required_documents_lecturer_id_foreign` (`lecturer_id`);

--
-- Indexes for table `reviewers`
--
ALTER TABLE `reviewers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reviewers_email_unique` (`email`);

--
-- Indexes for table `reviewer_educational_histories`
--
ALTER TABLE `reviewer_educational_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviewer_educational_histories_reviewer_id_foreign` (`reviewer_id`);

--
-- Indexes for table `reviewer_required_documents`
--
ALTER TABLE `reviewer_required_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviewer_required_documents_reviewer_id_foreign` (`reviewer_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reviews_proposal_id_reviewer_id_unique` (`proposal_id`,`reviewer_id`),
  ADD KEY `reviews_reviewer_id_foreign` (`reviewer_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `educational_histories`
--
ALTER TABLE `educational_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `guides`
--
ALTER TABLE `guides`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `independent_activities`
--
ALTER TABLE `independent_activities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `proposal_documents`
--
ALTER TABLE `proposal_documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `proposal_lecturers`
--
ALTER TABLE `proposal_lecturers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `proposal_logbooks`
--
ALTER TABLE `proposal_logbooks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `proposal_outcomes`
--
ALTER TABLE `proposal_outcomes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `proposal_outputs`
--
ALTER TABLE `proposal_outputs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `proposal_p_t_u_s`
--
ALTER TABLE `proposal_p_t_u_s`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `proposal_reports`
--
ALTER TABLE `proposal_reports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `proposal_students`
--
ALTER TABLE `proposal_students`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `proposal_supporting_files`
--
ALTER TABLE `proposal_supporting_files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `publications`
--
ALTER TABLE `publications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `required_documents`
--
ALTER TABLE `required_documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reviewers`
--
ALTER TABLE `reviewers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviewer_educational_histories`
--
ALTER TABLE `reviewer_educational_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviewer_required_documents`
--
ALTER TABLE `reviewer_required_documents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `educational_histories`
--
ALTER TABLE `educational_histories`
  ADD CONSTRAINT `educational_histories_lecturer_id_foreign` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `independent_activities`
--
ALTER TABLE `independent_activities`
  ADD CONSTRAINT `independent_activities_lecturer_id_foreign` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD CONSTRAINT `lecturers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `proposals`
--
ALTER TABLE `proposals`
  ADD CONSTRAINT `proposals_lecturer_id_foreign` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `proposal_documents`
--
ALTER TABLE `proposal_documents`
  ADD CONSTRAINT `proposal_documents_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `proposals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `proposal_lecturers`
--
ALTER TABLE `proposal_lecturers`
  ADD CONSTRAINT `proposal_lecturers_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `proposals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `proposal_logbooks`
--
ALTER TABLE `proposal_logbooks`
  ADD CONSTRAINT `proposal_logbooks_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `proposals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `proposal_outcomes`
--
ALTER TABLE `proposal_outcomes`
  ADD CONSTRAINT `proposal_outcomes_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `proposals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `proposal_outputs`
--
ALTER TABLE `proposal_outputs`
  ADD CONSTRAINT `proposal_outputs_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `proposals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `proposal_p_t_u_s`
--
ALTER TABLE `proposal_p_t_u_s`
  ADD CONSTRAINT `proposal_p_t_u_s_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `proposals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `proposal_reports`
--
ALTER TABLE `proposal_reports`
  ADD CONSTRAINT `proposal_reports_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `proposals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `proposal_reviewer`
--
ALTER TABLE `proposal_reviewer`
  ADD CONSTRAINT `proposal_reviewer_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `proposals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `proposal_reviewer_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `reviewers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `proposal_students`
--
ALTER TABLE `proposal_students`
  ADD CONSTRAINT `proposal_students_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `proposals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `proposal_supporting_files`
--
ALTER TABLE `proposal_supporting_files`
  ADD CONSTRAINT `proposal_supporting_files_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `proposals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `publications`
--
ALTER TABLE `publications`
  ADD CONSTRAINT `publications_lecturer_id_foreign` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `required_documents`
--
ALTER TABLE `required_documents`
  ADD CONSTRAINT `required_documents_lecturer_id_foreign` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviewer_educational_histories`
--
ALTER TABLE `reviewer_educational_histories`
  ADD CONSTRAINT `reviewer_educational_histories_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `reviewers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviewer_required_documents`
--
ALTER TABLE `reviewer_required_documents`
  ADD CONSTRAINT `reviewer_required_documents_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `reviewers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_proposal_id_foreign` FOREIGN KEY (`proposal_id`) REFERENCES `proposals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_reviewer_id_foreign` FOREIGN KEY (`reviewer_id`) REFERENCES `reviewers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
