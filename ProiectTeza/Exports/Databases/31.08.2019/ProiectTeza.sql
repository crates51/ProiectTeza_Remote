-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 31 Aug 2019 la 18:31
-- Versiune server: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ProiectTeza`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `bookings`
--

CREATE TABLE `bookings` (
  `bookingId` int(10) UNSIGNED NOT NULL,
  `clientId` bigint(20) UNSIGNED DEFAULT NULL,
  `roomId` bigint(20) UNSIGNED DEFAULT NULL,
  `Status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Status Not inserted',
  `Adults` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Nr. Adults Not inserted',
  `Children` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Nr. Children Not inserted',
  `totalRooms` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Checkin` date NOT NULL,
  `Checkout` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `clients`
--

CREATE TABLE `clients` (
  `clientId` bigint(20) UNSIGNED NOT NULL,
  `First_Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'First Name Not inserted',
  `Last_Name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Last Name Not inserted',
  `Email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Email Not inserted',
  `Phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Phone Not inserted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `general_infos`
--

CREATE TABLE `general_infos` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalRooms` int(11) DEFAULT NULL,
  `totalFloors` int(11) DEFAULT NULL,
  `totalRoomsSet` tinyint(1) NOT NULL DEFAULT '0',
  `allRoomsPrepared` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Salvarea datelor din tabel `general_infos`
--

INSERT INTO `general_infos` (`id`, `name`, `totalRooms`, `totalFloors`, `totalRoomsSet`, `allRoomsPrepared`, `created_at`, `updated_at`) VALUES
(5, NULL, NULL, NULL, 0, 0, '2019-08-29 15:39:25', '2019-08-29 15:39:25'),
(6, 'Name Here', 23, NULL, 1, 0, '2019-08-29 15:50:45', '2019-08-29 15:50:45'),
(7, 'Name Here', 23, 1, 1, 1, '2019-08-30 01:43:17', '2019-08-30 01:43:17');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Salvarea datelor din tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_02_06_120945_create_bookings_table', 1),
(4, '2019_05_10_142512_create_clients_table', 1),
(5, '2019_05_10_142826_create_rooms_table', 1),
(6, '2019_05_12_132638_set_foreign_keys', 1),
(7, '2019_05_18_152501_create_general_infos_table', 1);

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `rooms`
--

CREATE TABLE `rooms` (
  `roomId` bigint(20) UNSIGNED NOT NULL,
  `floorId` bigint(20) UNSIGNED DEFAULT NULL,
  `nrOfBeds` int(11) DEFAULT NULL,
  `seaSight` tinyint(1) NOT NULL DEFAULT '0',
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `2019` longtext COLLATE utf8mb4_unicode_ci,
  `2020` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Salvarea datelor din tabel `rooms`
--

INSERT INTO `rooms` (`roomId`, `floorId`, `nrOfBeds`, `seaSight`, `available`, `2019`, `2020`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 1, NULL, NULL, '2019-08-30 01:43:16', '2019-08-30 01:43:16'),
(2, 1, 1, 0, 1, NULL, NULL, '2019-08-30 01:43:16', '2019-08-30 01:43:16'),
(3, 1, 1, 0, 1, NULL, NULL, '2019-08-30 01:43:16', '2019-08-30 01:43:16'),
(4, 1, 1, 0, 1, NULL, NULL, '2019-08-30 01:43:16', '2019-08-30 01:43:16'),
(5, 1, 1, 0, 1, NULL, NULL, '2019-08-30 01:43:16', '2019-08-30 01:43:16'),
(6, 1, 1, 0, 1, NULL, NULL, '2019-08-30 01:43:16', '2019-08-30 01:43:16'),
(7, 1, 1, 0, 1, NULL, NULL, '2019-08-30 01:43:16', '2019-08-30 01:43:16'),
(8, 1, 1, 0, 1, NULL, NULL, '2019-08-30 01:43:16', '2019-08-30 01:43:16'),
(9, 1, 1, 0, 1, NULL, NULL, '2019-08-30 01:43:16', '2019-08-30 01:43:16'),
(10, 1, 1, 0, 1, NULL, NULL, '2019-08-30 01:43:16', '2019-08-30 01:43:16'),
(11, 1, 1, 0, 1, NULL, NULL, '2019-08-30 01:43:16', '2019-08-30 01:43:16'),
(12, 1, 1, 0, 1, NULL, NULL, '2019-08-30 01:43:16', '2019-08-30 01:43:16'),
(13, 1, 1, 0, 1, NULL, NULL, '2019-08-30 01:43:16', '2019-08-30 01:43:16'),
(14, 1, 1, 0, 1, NULL, NULL, '2019-08-30 01:43:16', '2019-08-30 01:43:16'),
(15, 1, 1, 0, 1, NULL, NULL, '2019-08-30 01:43:16', '2019-08-30 01:43:16'),
(16, 1, 1, 0, 1, NULL, NULL, '2019-08-30 01:43:16', '2019-08-30 01:43:16'),
(17, 1, 1, 0, 1, NULL, NULL, '2019-08-30 01:43:16', '2019-08-30 01:43:16'),
(18, 1, 1, 0, 1, NULL, NULL, '2019-08-30 01:43:16', '2019-08-30 01:43:16'),
(19, 1, 1, 0, 1, NULL, NULL, '2019-08-30 01:43:16', '2019-08-30 01:43:16'),
(20, 1, 1, 0, 1, NULL, NULL, '2019-08-30 01:43:16', '2019-08-30 01:43:16'),
(21, 1, 1, 0, 1, NULL, NULL, '2019-08-30 01:43:16', '2019-08-30 01:43:16'),
(22, 1, 1, 0, 1, NULL, NULL, '2019-08-30 01:43:16', '2019-08-30 01:43:16'),
(23, 1, 1, 0, 1, NULL, NULL, '2019-08-30 01:43:16', '2019-08-30 01:43:16');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Salvarea datelor din tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'i.musteatavlad@gmail.com', NULL, '$2y$10$pq/he2MYxfy9sLWYU5Zr9.PTnF7.8G5MW6IIoE9yuhqmBXYAUEgsq', 'ZPRkBOrrtp8UIH3kb04kRMDypCKxNdTVYZ8zdNe3vYttPujg7OBGUwRP5h24', '2019-07-19 13:58:31', '2019-07-19 13:58:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`bookingId`),
  ADD KEY `bookings_clientid_foreign` (`clientId`),
  ADD KEY `bookings_roomid_foreign` (`roomId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`);

--
-- Indexes for table `general_infos`
--
ALTER TABLE `general_infos`
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
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`roomId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `bookingId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `general_infos`
--
ALTER TABLE `general_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `roomId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restrictii pentru tabele sterse
--

--
-- Restrictii pentru tabele `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_clientid_foreign` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`),
  ADD CONSTRAINT `bookings_roomid_foreign` FOREIGN KEY (`roomId`) REFERENCES `rooms` (`roomId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
