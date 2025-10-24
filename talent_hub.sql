-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 24, 2025 at 04:43 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `talent_hub`
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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Anggota Intern', '2025-10-20 22:45:38', '2025-10-20 22:45:38'),
(2, 'Pemagang', '2025-10-20 22:45:38', '2025-10-20 23:43:13'),
(3, 'Alumni Virtual Classroom', '2025-10-20 22:45:38', '2025-10-20 22:45:38'),
(4, 'Mahasiswa Umum', '2025-10-20 23:22:07', '2025-10-20 23:22:07'),
(5, 'Alumni UNIKOM', '2025-10-22 08:17:16', '2025-10-22 08:17:16'),
(6, 'Kerja Praktek', '2025-10-24 08:42:02', '2025-10-24 08:42:02');

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

CREATE TABLE `certifications` (
  `id` bigint UNSIGNED NOT NULL,
  `profile_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issuing_organization` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issue_date` date NOT NULL,
  `credential_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certifications`
--

INSERT INTO `certifications` (`id`, `profile_id`, `title`, `issuing_organization`, `issue_date`, `credential_url`, `file_path`, `created_at`, `updated_at`) VALUES
(10, 2, 'Belajar Dasar AI', 'Dicoding', '2025-09-29', NULL, 'certifications/agyG8Xm4vxkE23OyjYX0Ia6uPtR3cwijIYC4KOW5.jpg', '2025-10-21 05:03:55', '2025-10-21 05:03:55'),
(11, 2, 'AI Engineer', 'Dicoding', '2025-09-29', NULL, 'certifications/HTxaBJ3kxOrmrEV21aiWBCNC57sZT6Pgs2MzrO2D.pdf', '2025-10-21 05:06:03', '2025-10-21 05:06:03'),
(14, 2, 'Software Engineer Junior', 'UNIKOM', '2025-10-21', NULL, 'certifications/NIuJxi2GBYG38eGnFf2jnQrugLibisKfCKTnWyZZ.pdf', '2025-10-21 06:43:07', '2025-10-21 06:43:07');

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE `educations` (
  `id` bigint UNSIGNED NOT NULL,
  `profile_id` bigint UNSIGNED NOT NULL,
  `institution_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `degree` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`id`, `profile_id`, `institution_name`, `degree`, `start_date`, `end_date`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, 'MAN 2 KOTA BANDUNG', 'IPA', '2019-08-22', '2022-08-22', NULL, '2025-10-14 02:01:21', '2025-10-14 02:01:21'),
(2, 2, 'UNIKOM', 'Sarjana Komputer', '2022-07-22', '2026-02-28', NULL, '2025-10-17 04:43:16', '2025-10-17 04:43:16');

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

CREATE TABLE `experiences` (
  `id` bigint UNSIGNED NOT NULL,
  `profile_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experiences`
--

INSERT INTO `experiences` (`id`, `profile_id`, `title`, `company_name`, `start_date`, `end_date`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, 'Fullstack Developer', 'Canvas Code', '2025-10-04', NULL, 'work as a fullstack developer', '2025-10-14 02:01:10', '2025-10-14 02:01:10');

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
(4, '2025_10_09_062133_create_profiles_table', 1),
(5, '2025_10_09_062134_create_portfolios_table', 1),
(6, '2025_10_09_135452_create_experiences_table', 1),
(7, '2025_10_09_135453_create_education_table', 1),
(8, '2025_10_14_082112_create_certifications_table', 1),
(9, '2025_10_14_095626_add_contact_links_to_profiles_table', 2),
(10, '2025_10_21_051405_create_categories_table', 3),
(11, '2025_10_21_054739_finalize_profiles_category_column', 4);

-- --------------------------------------------------------

--
-- Table structure for table `portfolios`
--

CREATE TABLE `portfolios` (
  `id` bigint UNSIGNED NOT NULL,
  `profile_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skills_used` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `portfolios`
--

INSERT INTO `portfolios` (`id`, `profile_id`, `title`, `description`, `project_url`, `image`, `skills_used`, `created_at`, `updated_at`) VALUES
(1, 2, 'calorie - tracker', 'Website ini adalah platform untuk membantu pengguna yang ingin meningkatkan massa otot dengan mengikuti program bulking dan diet yang sehat. Program ini mencakup informasi mengenai pola makan yang kaya kalori, latihan beban, dan tips lainnya untuk mendukung pertumbuhan otot yang efektif.', 'https://github.com/rzranz/calorie-tracker.git', NULL, 'Php, Javascript, HTML, CSS', '2025-10-14 01:56:33', '2025-10-14 01:56:33'),
(2, 2, 'manajemen-inventori-gudang', 'Sistem Manajemen Inventori Gudang menggunakan Laravel (backend) dan Vue 3 + Tailwind CSS (frontend).\r\nAplikasi ini membantu mengelola produk, stok, dan transaksi secara efisien.', 'https://github.com/rzranz/manajemen-inventori-gudang.git', NULL, 'Laravel, Tailwind, Vue', '2025-10-14 01:59:59', '2025-10-14 01:59:59'),
(3, 2, 'Kasir-Coffeshop', 'Proyek Kasir-Coffeeshop adalah aplikasi kasir untuk coffee shop yang menggunakan PHP dan MySQL untuk manajemen transaksi penjualan, login pengguna, dan pengelolaan data produk. Aplikasi ini memungkinkan petugas kasir untuk mencatat pesanan dan memperbarui status pesanan dengan mudah.', 'https://github.com/rzranz/Kasir-Coffeshop.git', NULL, 'PHP, HTML', '2025-10-14 02:22:30', '2025-10-14 02:22:30');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `headline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `github_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `portfolio_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `job_role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `profile_picture`, `headline`, `bio`, `phone`, `linkedin_url`, `github_url`, `portfolio_url`, `category_id`, `job_role`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2025-10-14 01:52:28', '2025-10-20 22:45:38'),
(2, 2, 'profile-pictures/DBNhgrXtADHneWBmCwpMZE4AUDTEWl7k6z2giTfF.jpg', 'Fullstack Developers', 'I am an undergraduate student majoring in Informatics Engineering at UNIKOM. I have a strong interest in learning frontend development, and I’m also currently pursuing backend development with the goal of becoming a full-stack developer. \r\n\r\nI’m excited to connect with professionals and peers in the industry, and I look forward to sharing insights and exploring opportunities together!', '082119302809', 'https://www.linkedin.com/in/randizakariaputra', 'https://github.com/rzranz', NULL, 1, NULL, '2025-10-14 01:53:42', '2025-10-21 04:56:06'),
(3, 3, 'profile-pictures/GzLrPfB7ZgSHoywNHHIB3OLZKBO24k66PZCJeu5z.jpg', NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2025-10-14 02:12:15', '2025-10-20 22:45:38'),
(6, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, '2025-10-17 04:11:34', '2025-10-20 22:45:38'),
(7, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, '2025-10-17 04:21:39', '2025-10-20 22:45:38'),
(8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2025-10-17 04:37:27', '2025-10-24 08:48:31'),
(9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2025-10-20 23:09:55', '2025-10-24 08:37:21'),
(10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2025-10-20 23:44:58', '2025-10-24 08:36:45'),
(11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2025-10-20 23:48:26', '2025-10-24 08:35:53'),
(12, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2025-10-20 23:50:10', '2025-10-24 08:35:06'),
(13, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2025-10-20 23:51:07', '2025-10-24 08:34:19'),
(14, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2025-10-24 08:33:42', '2025-10-24 08:33:42'),
(15, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, '2025-10-24 08:39:07', '2025-10-24 08:39:07'),
(16, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, '2025-10-24 08:42:47', '2025-10-24 08:42:47'),
(17, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, '2025-10-24 08:43:27', '2025-10-24 08:43:27'),
(18, 18, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, '2025-10-24 08:44:06', '2025-10-24 08:44:06'),
(19, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, '2025-10-24 08:44:50', '2025-10-24 08:44:50'),
(20, 20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, '2025-10-24 08:45:21', '2025-10-24 08:45:21'),
(21, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, '2025-10-24 08:46:14', '2025-10-24 08:46:14'),
(22, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, NULL, '2025-10-24 08:46:45', '2025-10-24 08:46:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('superadmin','anggota') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'anggota',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@gmail.com', NULL, '$2y$12$Eker7.SyxnI.GA78cto6Vu2T5CpppN/0ESD/KuDzM4vTzf8k.q9Ie', 'superadmin', NULL, '2025-10-14 01:50:48', '2025-10-14 01:50:48'),
(2, 'Randi Zakaria Putra', 'randi@gmail.com', NULL, '$2y$12$CdhD9MT3VJPV2qPHebamjO8K56cgbgjheDVpq/Y0R62FH8cvjEc7q', 'anggota', NULL, '2025-10-14 01:53:42', '2025-10-14 01:53:42'),
(3, 'Bilal Jamil Shafwan', 'bilal@gmail.com', NULL, '$2y$12$VA8saohfR2f1jIjHgyudCOHNez2DkyxC9jgI0Ka/ow.xqtEBMbZS2', 'anggota', NULL, '2025-10-14 02:12:15', '2025-10-14 02:12:15'),
(6, 'Zakaria putra', 'zakaria@gmail.com', NULL, '$2y$12$90Cw3wBb6amo5AhzTQx5hOaoGXOqJL/I8I.Jwf6bAkYhq4VMMVImW', 'anggota', NULL, '2025-10-17 04:11:34', '2025-10-17 04:22:17'),
(7, 'Vicky Firmansyah', 'viki123@gmail.com', NULL, '$2y$12$nRjRdz/i/htZE4ah/6r9xOvhI3Z9.x/9oAkaeV9NZRFzyWTht4R1q', 'anggota', NULL, '2025-10-17 04:21:39', '2025-10-17 04:21:39'),
(8, 'Kimberly', 'kimberly@yukmari.com', NULL, '$2y$12$18KWfISmrm0MFazCb2WWi.zOnH82pQIdU47pEnumYMiPm5sR68gvC', 'anggota', NULL, '2025-10-17 04:37:27', '2025-10-24 08:48:31'),
(9, 'Sisca Febrian Pratami', 'siska@yukmari.com', NULL, '$2y$12$rDZqV9h5o4AP0UMknYUoxOLfRobNkcKUx677dNpA2uNZm1NivCfWG', 'anggota', NULL, '2025-10-17 04:47:30', '2025-10-24 08:37:21'),
(10, 'Gabriel Iyas', 'gabriel@yukmari.com', NULL, '$2y$12$hue7Jz7TozqKmn1spgYrgeZDqFmrDG88x1g4LiuVnB4caFBYAScoa', 'anggota', NULL, '2025-10-20 23:44:58', '2025-10-24 08:36:45'),
(11, 'Dhafin Sulthon Aliansyah', 'dhafin@yukmari.com', NULL, '$2y$12$IIVQeMDdVnBCbQMsBBlHdO16ykWGRaDC87J4FFHczqroXCdR4Lzm.', 'anggota', NULL, '2025-10-20 23:48:26', '2025-10-24 08:35:53'),
(12, 'Mega Syarifa Musharofa', 'mega@yukmari.com', NULL, '$2y$12$sLcqddKXPKLd3osOTpgQeuCHczGME5uUpoG6pPEqJU/.f4FYjkl1K', 'anggota', NULL, '2025-10-20 23:50:10', '2025-10-24 08:35:06'),
(13, 'Raifal Bagus Afdiansyah', 'raifal@yukmari.com', NULL, '$2y$12$2j.VzlArhIcJdwmpWxfznuCsxXSaqkWDjWzuiX9dOxorNeFH/mVWG', 'anggota', NULL, '2025-10-20 23:51:07', '2025-10-24 08:34:19'),
(14, 'Ghina Mawarni Putri', 'ghina@yukmari.com', NULL, '$2y$12$74vHSo5DhUJWRtRfFUwwBOfIP1ZVP1fBoaWT9qeK837U.eJXFdZLO', 'anggota', NULL, '2025-10-24 08:33:42', '2025-10-24 08:33:42'),
(15, 'Raima Shaqinah Alamsyah', 'raima@gmail.com', NULL, '$2y$12$MkZCxVz2/Q4JAMkcHa126uMbV6ZVLrGPJD8xfSdCZwG3LGNgt0Snu', 'anggota', NULL, '2025-10-24 08:39:07', '2025-10-24 08:39:07'),
(16, 'Muhammad Alvian', 'alvian@yukmari.com', NULL, '$2y$12$SQTIW525k2Isc0lBgaHfIOr08GIO1N4CVgREXNiWJoYpnoEXzZdnK', 'anggota', NULL, '2025-10-24 08:42:47', '2025-10-24 08:42:47'),
(17, 'Fikri', 'fikri@yukmari.com', NULL, '$2y$12$po07C8j3M6qXiKQn1xLnUOl1BaZQJcwDZMeXEYcg.MUGOxCXKscmO', 'anggota', NULL, '2025-10-24 08:43:27', '2025-10-24 08:43:27'),
(18, 'Andriansyah', 'andriansyah@yukmari.com', NULL, '$2y$12$Yyk/K1/k0IP1gaVmEodjMejPHK79yBxMBzBdoAy7Y/GZYvmsuiU7y', 'anggota', NULL, '2025-10-24 08:44:06', '2025-10-24 08:44:06'),
(19, 'Irsyad Nur Hidayatulloh', 'irsyad@yukmari.com', NULL, '$2y$12$kQmVcdAyEk3ZAjOSMofp4eq.fJFBJqrOETavq700rEVqyIEpjxtHm', 'anggota', NULL, '2025-10-24 08:44:50', '2025-10-24 08:44:50'),
(20, 'Inayah Ayu Deswita', 'inayah@gmail.com', NULL, '$2y$12$YZOll/mWFbd3vdk5gzGiEOx2V2coAo0GZ54sIndmx5.5PVdioK15u', 'anggota', NULL, '2025-10-24 08:45:21', '2025-10-24 08:45:21'),
(21, 'Mochammad Khaerul Ilman', 'ilman@yukmari.com', NULL, '$2y$12$EhFLJE0jFtu3cZjeQ.I82uSm4lDwJByy6dXJZ1TA9FWsD1vUi9PzS', 'anggota', NULL, '2025-10-24 08:46:14', '2025-10-24 08:46:14'),
(22, 'Alvika Jienni', 'alvika@yukmari.com', NULL, '$2y$12$5hzAd4ml1jPwUqyy29NPluSkm5St3DQEvrsEk2UpBM7HMd22Tan8K', 'anggota', NULL, '2025-10-24 08:46:45', '2025-10-24 08:46:45');

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `certifications`
--
ALTER TABLE `certifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `certifications_profile_id_foreign` (`profile_id`);

--
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `educations_profile_id_foreign` (`profile_id`);

--
-- Indexes for table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `experiences_profile_id_foreign` (`profile_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `portfolios_profile_id_foreign` (`profile_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_foreign` (`user_id`),
  ADD KEY `profiles_category_id_foreign` (`category_id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `certifications`
--
ALTER TABLE `certifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certifications`
--
ALTER TABLE `certifications`
  ADD CONSTRAINT `certifications_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `educations`
--
ALTER TABLE `educations`
  ADD CONSTRAINT `educations_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `experiences`
--
ALTER TABLE `experiences`
  ADD CONSTRAINT `experiences_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `portfolios`
--
ALTER TABLE `portfolios`
  ADD CONSTRAINT `portfolios_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
