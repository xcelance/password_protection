-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 18, 2019 at 06:31 PM
-- Server version: 5.5.49
-- PHP Version: 7.1.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `instantPassPdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `market_urls`
--

CREATE TABLE `market_urls` (
  `id` int(11) NOT NULL,
  `url` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `market_urls`
--

INSERT INTO `market_urls` (`id`, `url`, `created_at`, `updated_at`) VALUES
(1, 'https://www.facebook.com/', '2019-01-17 07:39:08', '2019-01-17 07:39:08'),
(5, 'https://www.google.com/', '2019-01-18 01:13:36', '2019-01-18 01:13:36'),
(6, 'www.sharethisride.com/testurl', '2019-01-18 03:58:37', '2019-01-18 03:58:37'),
(7, 'https://www.google.com/maps', '2019-01-18 04:14:23', '2019-01-18 04:14:23'),
(9, 'www.sharethisride.com/testurl2', '2019-01-18 06:43:50', '2019-01-18 06:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
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

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('vipul.bhatia@xcelance.com', '$2y$10$s5gUyaYv8xH/bJQj7GrttOefjtaaNHLR2ANoiU5trBX0LcGGv.WOK', '2019-01-18 06:45:22'),
('mlc@sharethisride.com', '$2y$10$H4a/rSFiMpF7/PoIi0KLueE4uMdDwpvJvE41jPLQY8u9xdFwmtVnW', '2019-01-18 06:55:52');

-- --------------------------------------------------------

--
-- Table structure for table `reset_notifications`
--

CREATE TABLE `reset_notifications` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reset_notifications`
--

INSERT INTO `reset_notifications` (`id`, `email`, `status`, `created_at`, `updated_at`) VALUES
(2, 'suneel.kumar@xcelance.com', '1', '2019-01-18 12:05:37', '2019-01-18 12:58:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_show` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `url` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `password_show`, `role`, `active`, `url`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$VlxZDXE7r43bwAPuRxAHje6BvREWbgmxDyJr/Y6zGuY1nyzpl4O8W', '', '0', '0', '', 'qxduIylwVdvjt7QqsanJLDSM6dbvhJHGt1Prsj4qc4Nk97bwYhLZ2mRpNnK4', '2019-01-16 05:36:35', '2019-01-18 00:39:07'),
(4, 'suneel kumar kumar', 'suneel.kumar@xcelance.com', '$2y$10$5d1t3PxpdsX7eVUstzRvJuZM0tJTutcLcuNDqOfg29habCzGq9Mvi', 'V2VsY29tZUAxMjM=', '1', '0', 'https://www.facebook.com/', '4yFSzCLwxdZZHYTm6GLkzn7DbIXJ1MGscOHXzL8Os401J5L1ohtsHJ6ZqyoA', '2019-01-17 05:47:40', '2019-01-18 11:41:09'),
(15, 'muninder', 'muninderbhatia49@gmail.com', '$2y$10$adpgsUc4hF/.Lu1xA3W3S.XegtUnqDG.UpZgbikXAS5SM3XdP2K2i', 'V2VsY29tZUAxMjM=', '1', '1', 'https://www.facebook.com/', NULL, '2019-01-18 06:32:58', '2019-01-18 09:07:38'),
(17, 'CHETAN bhatia', 'chetan123@gmail.com', '$2y$10$JkIQIaa6rW607l44hPbghOuwgN/LBO877WPwdJ0RVpJPGB1TRRYPC', 'V2VsY29tZUAxMjM=', '1', '0', 'https://www.google.com/', 'JxTXlFe6xb1rG34BkH0ab5y9KWLWDQmwHqseLGMwsvinu3w9OUsqUXNAwVxw', '2019-01-18 06:41:16', '2019-01-18 09:07:54'),
(18, 'Mark Colclough', 'mlc@sharethisride.com', '$2y$10$UDhwVSqvZeslFZ..VVqljOVB4bwO0O94XcEGO0HZ5Di3D1R2wEJFO', 'V2VsY29tZUAxMjM=', '1', '0', 'www.sharethisride.com/testurl', NULL, '2019-01-18 06:42:47', '2019-01-18 09:08:09'),
(19, 'vipul', 'vipul.bhatia@xcelance.com', '$2y$10$ALgUeUxD8rAQB0NClqR2n.vOw8TP15Wt0HyetXBk3tCQlS5LDSoZ2', 'V2VsY29tZUAxMjM=', '1', '0', 'https://www.google.com/', NULL, '2019-01-18 06:45:12', '2019-01-18 09:08:19'),
(20, 'test', 'test@gmail.com', '$2y$10$AOyrOsTqMjPZMkqSNMl9pOsUE2Dg8xfCvUFgecIbf8QmAvoT5Au3.', 'V2VsY29tZUAxMjM=', '1', '0', 'https://www.facebook.com/', NULL, '2019-01-18 09:18:53', '2019-01-18 09:18:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `market_urls`
--
ALTER TABLE `market_urls`
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
  ADD KEY `password_resets_email_index` (`email`(191)),
  ADD KEY `password_resets_token_index` (`token`(191));

--
-- Indexes for table `reset_notifications`
--
ALTER TABLE `reset_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `market_urls`
--
ALTER TABLE `market_urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reset_notifications`
--
ALTER TABLE `reset_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
