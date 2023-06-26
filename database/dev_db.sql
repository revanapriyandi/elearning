-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 26 Jun 2023 pada 04.49
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pj_elearning`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `jawabans`
--

CREATE TABLE `jawabans` (
  `id` bigint UNSIGNED NOT NULL,
  `soal_id` bigint UNSIGNED NOT NULL,
  `pilihan` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text_jawaban` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_benar` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jawabans`
--

INSERT INTO `jawabans` (`id`, `soal_id`, `pilihan`, `text_jawaban`, `is_benar`, `created_at`, `updated_at`) VALUES
(1, 1, 'A', '<p>Sebuah alat komunikasi antara manusia</p>', 0, '2023-06-26 04:35:24', '2023-06-26 04:35:24'),
(2, 1, 'B', '<p>Sebuah sistem simbol dan aturan untuk mengungkapkan makna</p>', 0, '2023-06-26 04:35:24', '2023-06-26 04:42:18'),
(3, 1, 'C', '<p>Sebuah metode untuk mencetak teks dalam dokumen</p>', 0, '2023-06-26 04:35:24', '2023-06-26 04:42:18'),
(4, 1, 'D', '<p>Sebuah teknologi pemrosesan suara</p>', 1, '2023-06-26 04:35:24', '2023-06-26 04:42:18'),
(5, 1, 'E', '<p>Sebuah bentuk seni dalam menyusun kata-kata</p>\r\n<p>&nbsp;</p>', 0, '2023-06-26 04:35:24', '2023-06-26 04:35:24'),
(6, 2, 'A', '<p>Sebuah perangkat keras yang dapat bergerak secara otomatis</p>', 1, '2023-06-26 04:35:58', '2023-06-26 04:35:58'),
(7, 2, 'B', '<p>Sebuah algoritma untuk mengoptimalkan proses komputasi</p>', 0, '2023-06-26 04:35:58', '2023-06-26 04:35:58'),
(8, 2, 'C', '<p>Sebuah aplikasi perangkat lunak untuk mengelola data</p>', 0, '2023-06-26 04:35:58', '2023-06-26 04:35:58'),
(9, 2, 'D', '<p>Sebuah mesin abstrak yang dapat memproses urutan simbol</p>', 0, '2023-06-26 04:35:58', '2023-06-26 04:35:58'),
(10, 2, 'E', '<p>Sebuah model matematika untuk memprediksi peristiwa masa depan</p>', 0, '2023-06-26 04:35:58', '2023-06-26 04:35:58'),
(11, 3, 'A', '<p>Bahasa yang digunakan dalam situasi resmi seperti pidato politik</p>', 0, '2023-06-26 04:36:40', '2023-06-26 04:36:40'),
(12, 3, 'B', '<p>Bahasa yang digunakan dalam percakapan sehari-hari antar manusia</p>', 0, '2023-06-26 04:36:40', '2023-06-26 04:36:40'),
(13, 3, 'C', '<p>Bahasa yang digunakan dalam komunikasi interpersonal</p>', 0, '2023-06-26 04:36:40', '2023-06-26 04:36:40'),
(14, 3, 'D', '<p>Bahasa yang terdiri dari simbol-simbol yang ditentukan dengan jelas dan aturan sintaksis yang ketat</p>', 1, '2023-06-26 04:36:40', '2023-06-26 04:36:40'),
(15, 3, 'E', '<p>Bahasa yang hanya digunakan dalam lingkungan akademik</p>', 0, '2023-06-26 04:36:40', '2023-06-26 04:36:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban_siswas`
--

CREATE TABLE `jawaban_siswas` (
  `id` bigint UNSIGNED NOT NULL,
  `tugas_quiz_id` bigint UNSIGNED DEFAULT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `soal_id` bigint UNSIGNED DEFAULT NULL,
  `pilihan_jawaban` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jawaban_soal` text COLLATE utf8mb4_unicode_ci,
  `is_benar` tinyint(1) DEFAULT NULL,
  `is_terkoreksi` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jawaban_siswas`
--

INSERT INTO `jawaban_siswas` (`id`, `tugas_quiz_id`, `siswa_id`, `soal_id`, `pilihan_jawaban`, `jawaban_soal`, `is_benar`, `is_terkoreksi`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 1, 'D', NULL, 1, 1, '2023-06-26 04:44:02', '2023-06-26 04:44:02'),
(2, NULL, 1, 2, 'A', NULL, 1, 1, '2023-06-26 04:44:14', '2023-06-26 04:44:14'),
(3, NULL, 1, 3, 'D', NULL, 1, 1, '2023-06-26 04:44:17', '2023-06-26 04:44:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_kelas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kompetensi_keahlian` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `slug`, `kode_kelas`, `nama_kelas`, `kompetensi_keahlian`, `image`, `created_at`, `updated_at`) VALUES
(1, 'reguler', '61-RK', 'Reguler', 'Kelas Reguler', NULL, '2023-06-26 02:08:59', '2023-06-26 02:08:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_tugas_quiz`
--

CREATE TABLE `kelas_tugas_quiz` (
  `kelas_id` bigint UNSIGNED DEFAULT NULL,
  `tugas_quiz_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas_tugas_quiz`
--

INSERT INTO `kelas_tugas_quiz` (`kelas_id`, `tugas_quiz_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mata_pelajarans`
--

CREATE TABLE `mata_pelajarans` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_mapel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_mapel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mata_pelajarans`
--

INSERT INTO `mata_pelajarans` (`id`, `kode_mapel`, `nama_mapel`, `deskripsi`, `image`, `created_at`, `updated_at`) VALUES
(1, 'TBA-41-R', 'Teori Bahasa dan Otomata', 'TBO', NULL, '2023-06-26 02:03:20', '2023-06-26 02:03:20'),
(3, 'AOK', 'ARSITEKTUR DAN ORGANISASI KOMPUTER', NULL, NULL, '2023-06-17 04:18:42', '2023-06-17 04:18:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_06_16_030546_create_kelas_table', 1),
(7, '2023_06_16_030630_create_mata_pelajarans_table', 1),
(8, '2023_06_16_031137_create_pengajars_table', 1),
(9, '2023_06_16_031424_create_semesters_table', 1),
(10, '2023_06_16_031433_create_tahun_ajarans_table', 1),
(11, '2023_06_16_031446_create_siswas_table', 1),
(12, '2023_06_16_031758_create_presensis_table', 1),
(13, '2023_06_16_032124_create_ruang_diskusis_table', 1),
(14, '2023_06_16_032419_create_ruang_diskusi_comments_table', 1),
(15, '2023_06_16_032639_create_tugas_quizzes_table', 1),
(16, '2023_06_16_033315_create_soals_table', 1),
(17, '2023_06_16_033544_create_jawabans_table', 1),
(18, '2023_06_16_033849_create_jawaban_siswas_table', 1),
(19, '2023_06_18_231745_add-pengajars-table-tugas-quizzes', 1),
(20, '2023_06_18_234407_add_role_on_table_users', 1),
(21, '2023_06_19_013149_create_kelas_tugas_quiz_table', 1),
(22, '2023_06_21_005318_create_siswa_ujian_table', 1),
(23, '2023_06_23_214940_add_tugas_quiz_id_on_jawaban_siswa_table', 1),
(24, '2023_06_26_100605_add_status_to_presensis_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajars`
--

CREATE TABLE `pengajars` (
  `id` bigint UNSIGNED NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `mata_pelajaran_id` bigint UNSIGNED NOT NULL,
  `kelas_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengajars`
--

INSERT INTO `pengajars` (`id`, `nip`, `user_id`, `mata_pelajaran_id`, `kelas_id`, `created_at`, `updated_at`) VALUES
(1, '217771881', 2, 1, 1, '2023-06-26 02:09:26', '2023-06-26 02:09:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensis`
--

CREATE TABLE `presensis` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `status` enum('hadir','izin','sakit','alpa') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hadir',
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `presensis`
--

INSERT INTO `presensis` (`id`, `siswa_id`, `status`, `keterangan`, `latitude`, `longitude`, `location`, `created_at`, `updated_at`) VALUES
(1, 1, 'hadir', '-', '-6.2291968', '106.807296', NULL, '2023-06-26 02:50:22', '2023-06-26 02:50:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruang_diskusis`
--

CREATE TABLE `ruang_diskusis` (
  `id` bigint UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `mata_pelajaran_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ruang_diskusi_comments`
--

CREATE TABLE `ruang_diskusi_comments` (
  `id` bigint UNSIGNED NOT NULL,
  `ruang_diskusi_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `semesters`
--

CREATE TABLE `semesters` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `semesters`
--

INSERT INTO `semesters` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(2, 'Ganjil', 'ganjil', '2023-06-26 01:32:10', '2023-06-26 01:32:10'),
(3, 'Genap', 'genap', '2023-06-26 01:32:13', '2023-06-26 01:32:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswas`
--

CREATE TABLE `siswas` (
  `id` bigint UNSIGNED NOT NULL,
  `nis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kelas_id` bigint UNSIGNED NOT NULL,
  `tahun_ajaran_id` bigint UNSIGNED NOT NULL,
  `semester_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `siswas`
--

INSERT INTO `siswas` (`id`, `nis`, `user_id`, `kelas_id`, `tahun_ajaran_id`, `semester_id`, `created_at`, `updated_at`) VALUES
(1, '08211192', 4, 1, 2, 2, '2023-06-26 02:23:38', '2023-06-26 02:27:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa_ujian`
--

CREATE TABLE `siswa_ujian` (
  `id` bigint UNSIGNED NOT NULL,
  `siswa_id` bigint UNSIGNED NOT NULL,
  `tugas_quiz_id` bigint UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum' COMMENT 'dikerjakan, belum, selesai',
  `nilai` int DEFAULT NULL,
  `benar` int DEFAULT NULL,
  `salah` int DEFAULT NULL,
  `kosong` int DEFAULT NULL,
  `durasi` int DEFAULT NULL,
  `waktu_mulai` datetime DEFAULT NULL,
  `waktu_selesai` datetime DEFAULT NULL,
  `waktu_dikerjakan` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `siswa_ujian`
--

INSERT INTO `siswa_ujian` (`id`, `siswa_id`, `tugas_quiz_id`, `status`, `nilai`, `benar`, `salah`, `kosong`, `durasi`, `waktu_mulai`, `waktu_selesai`, `waktu_dikerjakan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'selesai', 100, 3, 0, NULL, 60, '2023-06-26 11:43:52', '2023-06-26 11:44:17', '2023-06-26 11:43:52', '2023-06-26 04:43:50', '2023-06-26 04:44:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `soals`
--

CREATE TABLE `soals` (
  `id` bigint UNSIGNED NOT NULL,
  `pertanyaan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tugas_quiz_id` bigint UNSIGNED NOT NULL,
  `jenis` enum('pilihan_ganda','benar_salah','isian') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `soals`
--

INSERT INTO `soals` (`id`, `pertanyaan`, `tugas_quiz_id`, `jenis`, `created_at`, `updated_at`) VALUES
(1, '<p>Apa yang dimaksud dengan bahasa dalam teori bahasa dan otomata?</p>', 1, 'pilihan_ganda', '2023-06-26 04:35:24', '2023-06-26 04:42:18'),
(2, '<p>Apa yang dimaksud dengan otomata dalam teori bahasa dan otomata? </p>', 1, 'pilihan_ganda', '2023-06-26 04:35:58', '2023-06-26 04:35:58'),
(3, '<p>Apa yang dimaksud dengan bahasa formal dalam teori bahasa dan otomata?</p>', 1, 'pilihan_ganda', '2023-06-26 04:36:40', '2023-06-26 04:36:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tahun_ajarans`
--

CREATE TABLE `tahun_ajarans` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tahun_ajarans`
--

INSERT INTO `tahun_ajarans` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, '2023/2024', '1', '2023-06-26 01:51:33', '2023-06-26 01:58:56'),
(2, '2022/2023', '0', '2023-06-26 01:58:44', '2023-06-26 01:58:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugas_quizzes`
--

CREATE TABLE `tugas_quizzes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` enum('tugas','quiz') COLLATE utf8mb4_unicode_ci NOT NULL,
  `mata_pelajaran_id` bigint UNSIGNED NOT NULL,
  `waktu_mulai` datetime NOT NULL,
  `waktu_berakhir` datetime NOT NULL,
  `is_aktif` tinyint(1) NOT NULL DEFAULT '1',
  `is_dikoreksi` tinyint(1) NOT NULL DEFAULT '0',
  `is_terbitkan_nilai` tinyint(1) NOT NULL DEFAULT '0',
  `is_poin` tinyint(1) NOT NULL DEFAULT '0',
  `is_acak_soal` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tugas_quizzes`
--

INSERT INTO `tugas_quizzes` (`id`, `user_id`, `slug`, `judul`, `deskripsi`, `jenis`, `mata_pelajaran_id`, `waktu_mulai`, `waktu_berakhir`, `is_aktif`, `is_dikoreksi`, `is_terbitkan_nilai`, `is_poin`, `is_acak_soal`, `created_at`, `updated_at`) VALUES
(1, 1, 'ujian-akhir', 'Ujian Akhir', '<p>Berikut ini adalah contoh soal ujian akhir teori bahasa dan otomata beserta pilihan jawaban (A, B, C, D, E) dan jawabannya:</p>\r\n<ol style=\"list-style-type: none;\">\r\n<li>&nbsp;</li>\r\n</ol>', 'quiz', 1, '2023-06-26 11:34:00', '2023-06-27 11:34:00', 1, 0, 1, 0, 0, '2023-06-26 04:34:27', '2023-06-26 04:34:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','pengajar','siswa') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'siswa',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `nama_lengkap`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `no_hp`, `alamat`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'Administrator', NULL, NULL, NULL, NULL, NULL, 'admin@E-LearningPlatform(PJ).com', '2023-06-26 01:08:30', '$2y$10$MUegnSmXvsGgOpqbnt4GWOLPUWAmEJypw7VjKLuI7D38zlgm1aXHe', 'admin', 'cbofIo6Ode', '2023-06-26 01:08:30', '2023-06-26 04:31:09', NULL),
(2, NULL, 'Pengajar', NULL, NULL, NULL, '082177722', 'Jakarta Timur', 'pengajar@gmail.com', NULL, '$2y$10$9bBeg4oqkylZ01nq1XBHtuffIEltsY/hWO.5QuvJ2vhJyaFTxAxmC', 'pengajar', NULL, '2023-06-26 02:09:26', '2023-06-26 02:09:26', NULL),
(4, 'siswa', 'Siswa', 'P', NULL, '2002-04-25', '08212222444', 'Jakarta', 'siswa@gmail.com', NULL, '$2y$10$cAt.hl2h.P2nQLI/zkgtFegOhjijkH67AhLo7D6DBS8q10bpGiRXO', 'siswa', NULL, '2023-06-26 02:23:38', '2023-06-26 04:33:03', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jawabans`
--
ALTER TABLE `jawabans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jawabans_soal_id_foreign` (`soal_id`);

--
-- Indeks untuk tabel `jawaban_siswas`
--
ALTER TABLE `jawaban_siswas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jawaban_siswas_siswa_id_foreign` (`siswa_id`),
  ADD KEY `jawaban_siswas_soal_id_foreign` (`soal_id`),
  ADD KEY `jawaban_siswas_tugas_quiz_id_foreign` (`tugas_quiz_id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kelas_slug_unique` (`slug`);

--
-- Indeks untuk tabel `kelas_tugas_quiz`
--
ALTER TABLE `kelas_tugas_quiz`
  ADD KEY `kelas_tugas_quiz_kelas_id_foreign` (`kelas_id`),
  ADD KEY `kelas_tugas_quiz_tugas_quiz_id_foreign` (`tugas_quiz_id`);

--
-- Indeks untuk tabel `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pengajars`
--
ALTER TABLE `pengajars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajars_user_id_foreign` (`user_id`),
  ADD KEY `pengajars_mata_pelajaran_id_foreign` (`mata_pelajaran_id`),
  ADD KEY `pengajars_kelas_id_foreign` (`kelas_id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `presensis`
--
ALTER TABLE `presensis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presensis_siswa_id_foreign` (`siswa_id`);

--
-- Indeks untuk tabel `ruang_diskusis`
--
ALTER TABLE `ruang_diskusis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ruang_diskusis_slug_unique` (`slug`),
  ADD KEY `ruang_diskusis_mata_pelajaran_id_foreign` (`mata_pelajaran_id`),
  ADD KEY `ruang_diskusis_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `ruang_diskusi_comments`
--
ALTER TABLE `ruang_diskusi_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ruang_diskusi_comments_ruang_diskusi_id_foreign` (`ruang_diskusi_id`),
  ADD KEY `ruang_diskusi_comments_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswas_nis_unique` (`nis`),
  ADD KEY `siswas_user_id_foreign` (`user_id`),
  ADD KEY `siswas_kelas_id_foreign` (`kelas_id`),
  ADD KEY `siswas_tahun_ajaran_id_foreign` (`tahun_ajaran_id`),
  ADD KEY `siswas_semester_id_foreign` (`semester_id`);

--
-- Indeks untuk tabel `siswa_ujian`
--
ALTER TABLE `siswa_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa_ujian_siswa_id_foreign` (`siswa_id`),
  ADD KEY `siswa_ujian_tugas_quiz_id_foreign` (`tugas_quiz_id`);

--
-- Indeks untuk tabel `soals`
--
ALTER TABLE `soals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `soals_tugas_quiz_id_foreign` (`tugas_quiz_id`);

--
-- Indeks untuk tabel `tahun_ajarans`
--
ALTER TABLE `tahun_ajarans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tugas_quizzes`
--
ALTER TABLE `tugas_quizzes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tugas_quizzes_slug_unique` (`slug`),
  ADD KEY `tugas_quizzes_mata_pelajaran_id_foreign` (`mata_pelajaran_id`),
  ADD KEY `tugas_quizzes_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jawabans`
--
ALTER TABLE `jawabans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `jawaban_siswas`
--
ALTER TABLE `jawaban_siswas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `mata_pelajarans`
--
ALTER TABLE `mata_pelajarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `pengajars`
--
ALTER TABLE `pengajars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `presensis`
--
ALTER TABLE `presensis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ruang_diskusis`
--
ALTER TABLE `ruang_diskusis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ruang_diskusi_comments`
--
ALTER TABLE `ruang_diskusi_comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `siswa_ujian`
--
ALTER TABLE `siswa_ujian`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `soals`
--
ALTER TABLE `soals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tahun_ajarans`
--
ALTER TABLE `tahun_ajarans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tugas_quizzes`
--
ALTER TABLE `tugas_quizzes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jawabans`
--
ALTER TABLE `jawabans`
  ADD CONSTRAINT `jawabans_soal_id_foreign` FOREIGN KEY (`soal_id`) REFERENCES `soals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jawaban_siswas`
--
ALTER TABLE `jawaban_siswas`
  ADD CONSTRAINT `jawaban_siswas_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_siswas_soal_id_foreign` FOREIGN KEY (`soal_id`) REFERENCES `soals` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jawaban_siswas_tugas_quiz_id_foreign` FOREIGN KEY (`tugas_quiz_id`) REFERENCES `tugas_quizzes` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kelas_tugas_quiz`
--
ALTER TABLE `kelas_tugas_quiz`
  ADD CONSTRAINT `kelas_tugas_quiz_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kelas_tugas_quiz_tugas_quiz_id_foreign` FOREIGN KEY (`tugas_quiz_id`) REFERENCES `tugas_quizzes` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengajars`
--
ALTER TABLE `pengajars`
  ADD CONSTRAINT `pengajars_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajars_mata_pelajaran_id_foreign` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajarans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajars_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `presensis`
--
ALTER TABLE `presensis`
  ADD CONSTRAINT `presensis_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ruang_diskusis`
--
ALTER TABLE `ruang_diskusis`
  ADD CONSTRAINT `ruang_diskusis_mata_pelajaran_id_foreign` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajarans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ruang_diskusis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `ruang_diskusi_comments`
--
ALTER TABLE `ruang_diskusi_comments`
  ADD CONSTRAINT `ruang_diskusi_comments_ruang_diskusi_id_foreign` FOREIGN KEY (`ruang_diskusi_id`) REFERENCES `ruang_diskusis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ruang_diskusi_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswas`
--
ALTER TABLE `siswas`
  ADD CONSTRAINT `siswas_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswas_semester_id_foreign` FOREIGN KEY (`semester_id`) REFERENCES `semesters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswas_tahun_ajaran_id_foreign` FOREIGN KEY (`tahun_ajaran_id`) REFERENCES `tahun_ajarans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswa_ujian`
--
ALTER TABLE `siswa_ujian`
  ADD CONSTRAINT `siswa_ujian_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `siswas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `siswa_ujian_tugas_quiz_id_foreign` FOREIGN KEY (`tugas_quiz_id`) REFERENCES `tugas_quizzes` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `soals`
--
ALTER TABLE `soals`
  ADD CONSTRAINT `soals_tugas_quiz_id_foreign` FOREIGN KEY (`tugas_quiz_id`) REFERENCES `tugas_quizzes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tugas_quizzes`
--
ALTER TABLE `tugas_quizzes`
  ADD CONSTRAINT `tugas_quizzes_mata_pelajaran_id_foreign` FOREIGN KEY (`mata_pelajaran_id`) REFERENCES `mata_pelajarans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tugas_quizzes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

DELIMITER $$
--
-- Event
--
CREATE DEFINER=`root`@`localhost` EVENT `check_absen_event` ON SCHEDULE EVERY 1 DAY STARTS '2023-06-26 20:14:57' ON COMPLETION PRESERVE ENABLE DO BEGIN
                IF HOUR(CURRENT_TIME()) = 10 THEN
                    INSERT INTO presensis (siswa_id, status, created_at)
                    SELECT id, "alpa", NOW()
                    FROM siswas
                    WHERE id NOT IN (
                        SELECT DISTINCT siswa_id
                        FROM presensis
                        WHERE DATE(created_at) = CURDATE()
                    );
                END IF;
            END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
