-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 22 Iun 2019 la 11:45
-- Versiune server: 5.7.26-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.1

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

--
-- Salvarea datelor din tabel `bookings`
--

INSERT INTO `bookings` (`bookingId`, `clientId`, `roomId`, `Status`, `Adults`, `Children`, `totalRooms`, `Checkin`, `Checkout`, `created_at`, `updated_at`) VALUES
(1, 7, 2, 'Booked', '3', '1', NULL, '2019-07-06', '2019-08-03', '2019-06-22 03:00:19', '2019-06-22 03:00:19'),
(2, 8, 1, 'Booked', '3', '1', NULL, '2019-07-17', '2019-07-20', '2019-06-22 03:03:21', '2019-06-22 03:03:21');

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

--
-- Salvarea datelor din tabel `clients`
--

INSERT INTO `clients` (`clientId`, `First_Name`, `Last_Name`, `Email`, `Phone`, `created_at`, `updated_at`) VALUES
(1, 'Vladislav', 'Musteata', 'musteatavlad@yahoo.com', '0720103279', '2019-05-26 12:35:56', '2019-05-26 12:35:56'),
(2, 'Iulia', 'Popescu', 'popescuIulia@yahoo.com', '0720192131', '2019-05-26 12:45:31', '2019-05-26 12:45:31'),
(3, 'Constantin', 'Musteata', 'musteataconstantin@gmail.com', '0721901815', '2019-05-27 08:18:13', '2019-05-27 08:18:13'),
(4, 'William', 'Musteata', 'musteatawilliams@gmail.com', '0721312881', '2019-06-16 04:23:15', '2019-06-16 04:23:15'),
(5, 'Iulia', 'Popescu', 'popescuIulia@yahoo.com', '0721312881', '2019-06-16 04:39:56', '2019-06-16 04:39:56'),
(6, 'Vladislav', 'Musteata', 'musteataconstantin@gmail.com', '0720103279', '2019-06-16 04:43:45', '2019-06-16 04:43:45'),
(7, 'Vladislav', 'Musteata', 'musteatavlad93@gmail.com', '0720103279', '2019-06-22 02:54:19', '2019-06-22 02:54:19'),
(8, 'Iulia', 'Popescu', 'musteatavlad93@gmail.com', '0721312881', '2019-06-22 03:03:21', '2019-06-22 03:03:21');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `general_infos`
--

CREATE TABLE `general_infos` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalRooms` int(11) DEFAULT NULL,
  `totalRoomsSet` tinyint(1) NOT NULL DEFAULT '0',
  `allRoomsPrepared` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Salvarea datelor din tabel `general_infos`
--

INSERT INTO `general_infos` (`id`, `name`, `totalRooms`, `totalRoomsSet`, `allRoomsPrepared`, `created_at`, `updated_at`) VALUES
(5, NULL, NULL, 0, 0, '2019-05-26 12:32:07', '2019-05-26 12:32:07'),
(7, 'Casa Jasmine', 17, 1, 0, '2019-05-26 12:33:18', '2019-05-26 12:33:18'),
(8, 'Casa Jasmine', 17, 1, 1, '2019-05-26 12:34:47', '2019-05-26 12:34:47');

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
  `nrOfBeds` int(11) DEFAULT NULL,
  `seaSight` tinyint(1) NOT NULL DEFAULT '0',
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Salvarea datelor din tabel `rooms`
--

INSERT INTO `rooms` (`roomId`, `nrOfBeds`, `seaSight`, `available`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 0, '2019-05-26 12:34:47', '2019-06-22 03:03:21'),
(2, 1, 0, 0, '2019-05-26 12:34:47', '2019-06-22 03:00:19'),
(3, 2, 0, 1, '2019-05-26 12:34:47', '2019-05-27 12:41:15'),
(4, 2, 0, 1, '2019-05-26 12:34:47', '2019-06-16 05:26:16'),
(5, 2, 0, 1, '2019-05-26 12:34:47', '2019-05-27 13:22:52'),
(6, 2, 0, 1, '2019-05-26 12:34:47', '2019-06-16 05:26:23'),
(7, 2, 0, 1, '2019-05-26 12:34:47', '2019-05-27 12:46:17'),
(8, 2, 0, 1, '2019-05-26 12:34:47', '2019-05-26 12:34:47'),
(9, 2, 0, 1, '2019-05-26 12:34:47', '2019-05-26 12:34:47'),
(10, 2, 0, 1, '2019-05-26 12:34:47', '2019-05-27 12:41:11'),
(11, 2, 0, 1, '2019-05-26 12:34:47', '2019-05-26 12:34:47'),
(12, 2, 0, 1, '2019-05-26 12:34:47', '2019-05-27 12:39:09'),
(13, 2, 0, 1, '2019-05-26 12:34:47', '2019-05-26 12:34:47'),
(14, 1, 0, 1, '2019-05-26 12:34:47', '2019-05-27 12:41:07'),
(15, 1, 0, 1, '2019-05-26 12:34:47', '2019-05-26 12:34:47'),
(16, 1, 0, 1, '2019-05-26 12:34:47', '2019-05-26 12:34:47'),
(17, 1, 0, 0, '2019-05-26 12:34:47', '2019-06-22 02:54:19');

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
(2, 'admin', 'i.musteatavlad@gmail.com', NULL, '$2y$10$.KWFwctqwrSWo6T0INQ58O10UpkjzYL3VeHDYGFYJe2zfRSgf8zYy', 'EEM74wKWIe4QPYTHCFEaYFueKsS7aOxiUg7xBurKQF0yHTwR9uTwA70WQUu9', '2019-05-25 16:26:05', '2019-05-25 16:26:05');

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
  MODIFY `bookingId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `general_infos`
--
ALTER TABLE `general_infos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `roomId` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
