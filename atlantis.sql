-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2020 at 05:06 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atlantis`
--

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_11_27_201014_create_settings_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('adam@mail.com', '$2y$10$S7qEH97fh8l59Mvg98fhSOLMH9tt3TymAeH6B2RyD0ijOu0HbdFmi', '2020-11-24 11:07:38');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `perusahaan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `icon`, `logo`, `perusahaan`, `tagline`, `created_at`, `updated_at`) VALUES
(1, '1606486475_icon.ico', '1606489273_Webp.net-resizeimage (1).png', 'PT.Atlantis', 'We do it', NULL, '2020-11-28 07:39:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `profile`, `email`, `username`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin sekali', '1606404692_profile2.jpg', 'admin@mail.com', 'admin', NULL, '$2y$10$r9a0qkt.QCYkD3jKrJcopuO/74LSoH.OHMiCsi.ceVaLmIu0xQU0S', '5dImy5o77eKMDycCLGVYrYFJMl3wFFsacpUXkUeN0TJUsjyaeyVCVDTMXCb7', '2020-11-22 17:00:00', '2020-11-28 13:56:02'),
(29, 'Mr. Mallory Renner', '3366bf3eb6477d6beeb12bbc80d1bb3b.jpg', 'whalvorson@example.org', '', '2020-11-23 05:41:24', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'l13kbu2TOd', '2020-11-23 05:41:41', '2020-11-23 05:41:41'),
(33, 'Ms. Destiny Armstrong', 'd30c2fbe38db17e065e744154716bb14.jpg', 'zella50@example.org', '', '2020-11-23 05:41:30', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'MS9a72vURK', '2020-11-23 05:41:41', '2020-11-23 05:41:41'),
(38, 'Ms. Brielle Marquardt', 'd15041c2267a5a20c7100b989911420b.jpg', 'weissnat.maegan@example.net', '', '2020-11-23 05:41:38', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'gFF8ZdC5P2', '2020-11-23 05:41:41', '2020-11-23 05:41:41'),
(40, 'Weldon Cruickshank', '0', 'wsporer@example.org', '', '2020-11-23 06:24:37', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'IT86RkHqK0', '2020-11-23 06:35:50', '2020-11-23 06:35:50'),
(42, 'Roosevelt Shields', 'f99f3fe12e1d28d999b0400aa6d5d557.jpg', 'wnikolaus@example.net', '', '2020-11-23 06:25:41', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'M0fMqQWeAT', '2020-11-23 06:35:50', '2020-11-23 06:35:50'),
(46, 'Tyra Doyle', 'ac822a07fa2aa14823663f69865aead7.jpg', 'antonio15@example.com', '', '2020-11-23 06:27:30', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'L7jTwchjnT', '2020-11-23 06:35:50', '2020-11-23 06:35:50'),
(53, 'Frieda Anderson', '1606565968_client-1.png', 'aa85@example.com', 'asdas', '2020-11-23 06:31:15', '$2y$10$UtgrOIyedmK0fATm3RRJUuqqWSp5Z8l.yE9ta0w7J7AAQwu2YdfGm', '8B4MW1FKdA', '2020-11-23 06:35:50', '2020-11-28 12:19:28'),
(55, 'Seth Considine', '8d6827422dfe0406ecafd8cf906560b7.jpg', 'foconnell@example.org', '', '2020-11-23 06:32:39', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'P8FFV0euAq', '2020-11-23 06:35:50', '2020-11-23 06:35:50'),
(56, 'Dawson Dickinson', '1606558600_client-1.png', 'ghj@mail.com', 'aswwaa', '2020-11-23 06:34:13', '$2y$10$ctWq46kT9NuI6CzlLMAeeuWX0pVV3kQEa8BwgiR8gfSr2ReZ65sfC', 'WnruXrasOB', '2020-11-23 06:35:50', '2020-11-28 12:21:41'),
(58, 'Mr. Rick Dietrich DDS', '0', 'svonrueden@example.com', '', '2020-11-23 06:35:02', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'XX2efvsQuC', '2020-11-23 06:35:51', '2020-11-23 06:35:51'),
(59, 'Leilani Boehm IV', '7ed2495197515c973a5333282402d887.jpg', 'braden.senger@example.net', '', '2020-11-23 06:35:23', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2xjbmiteV8', '2020-11-23 06:35:51', '2020-11-23 06:35:51'),
(60, 'adam', '1606405874_talha.jpg', 'adam@mail.com', 'adam_levine', NULL, '$2y$10$MS2NXyHMzZj7J.Ka7vxtwentClY8Gt6rg.LPGsivdbPwmmQ9yqo9m', NULL, '2020-11-24 10:49:15', '2020-11-28 13:44:02'),
(61, 'tiara kusuma', '1606551705_Another Danger - Font Cover 1.png', 'tiara@mail.com', 'tiara', NULL, '$2y$10$WWxmaFdeKyhoOkswsQVZmOcEKcxEH7i2drI8UN/Pvu0wYzTmAFBRa', NULL, '2020-11-28 08:20:41', '2020-11-28 08:40:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`,`username`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
