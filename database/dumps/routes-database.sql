-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 19, 2021 at 11:30 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `routes-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `filling_stations`
--

CREATE TABLE `filling_stations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `road_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `filling_stations`
--

INSERT INTO `filling_stations` (`id`, `name`, `created_at`, `updated_at`, `road_id`) VALUES
(1, 'Shell', '2021-11-19 20:18:44', '2021-11-19 20:18:44', 1),
(2, 'Petrol', '2021-11-19 20:18:55', '2021-11-19 20:18:55', 5),
(3, 'Eco', '2021-11-19 20:19:11', '2021-11-19 20:19:11', 4),
(4, 'OMV', '2021-11-19 20:19:51', '2021-11-19 20:19:51', 2),
(5, 'BG OIL', '2021-11-19 20:20:28', '2021-11-19 20:20:28', 3),
(6, 'New', '2021-11-19 20:20:38', '2021-11-19 20:20:38', 2),
(7, 'Vratsa Oil', '2021-11-19 20:21:15', '2021-11-19 20:21:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fuels`
--

CREATE TABLE `fuels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fuels`
--

INSERT INTO `fuels` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'бензин', '2021-11-19 19:39:39', '2021-11-19 19:39:39'),
(2, 'дизел', '2021-11-19 19:39:39', '2021-11-19 19:39:39'),
(3, 'биодизел', '2021-11-19 19:39:39', '2021-11-19 19:39:39'),
(4, 'пропан', '2021-11-19 19:39:39', '2021-11-19 19:39:39'),
(5, 'електрически', '2021-11-19 19:39:39', '2021-11-19 19:39:39');

-- --------------------------------------------------------

--
-- Table structure for table `fuels_filling_stations`
--

CREATE TABLE `fuels_filling_stations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fuel_id` bigint(20) UNSIGNED NOT NULL,
  `filling_station_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fuels_filling_stations`
--

INSERT INTO `fuels_filling_stations` (`id`, `fuel_id`, `filling_station_id`) VALUES
(1, 3, 1),
(2, 4, 1),
(3, 2, 2),
(4, 3, 2),
(5, 3, 3),
(6, 5, 3),
(7, 1, 4),
(8, 3, 4),
(9, 1, 5),
(10, 2, 5),
(11, 5, 5),
(12, 4, 7),
(13, 5, 7);

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_10_26_233916_create_nodes_table', 1),
(6, '2021_10_26_234158_create_edges_table', 1),
(7, '2021_10_27_000527_create_types_table', 1),
(8, '2021_10_27_001129_add_type_to_edges_table', 1),
(9, '2021_11_03_122902_add_key_to_table_users', 1),
(10, '2021_11_06_154623_add_max_speed_to_edges_table', 1),
(11, '2021_11_06_155302_create_fuels_table', 1),
(12, '2021_11_06_155345_create_filling_stations_table', 1),
(13, '2021_11_06_160542_create_fuels_filling_stations_table', 1),
(14, '2021_11_06_171908_add_foreign_keys_to_filling_stations_table', 1),
(15, '2021_11_06_195326_add_distance_in_km_to_edges_table', 1),
(16, '2021_11_06_204652_add_unique_constraint_on_from_node_id_to_node_id_in_edges_table', 1),
(17, '2021_11_11_074851_add_ondelete_to_edges_table', 1),
(18, '2021_11_12_010822_remove_minutes_needed_from_edges_table', 1),
(19, '2021_11_19_183356_rename_nodes_table', 1),
(20, '2021_11_19_183642_rename_edges_table', 1),
(21, '2021_11_19_184344_rename_type_id_column_in_roads_table', 1),
(22, '2021_11_19_184443_rename_max_speed_column_in_roads_table', 1),
(23, '2021_11_19_184909_rename_edge_id_column_in_filling_stations', 1),
(24, '2021_11_19_191823_drop_indexes_and_foreign_keys_in_roads_table', 1),
(25, '2021_11_19_200931_add_road_type_id_foreign_key', 1),
(26, '2021_11_19_201357_add_foreign_keys_to_roads_table', 1),
(27, '2021_11_19_215028_rename_max_speed_column_in_roads_table_again', 2);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roads`
--

CREATE TABLE `roads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_town_id` bigint(20) UNSIGNED NOT NULL,
  `to_town_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `road_type_id` bigint(20) UNSIGNED NOT NULL,
  `max_speed_in_km_per_hour` bigint(20) NOT NULL,
  `distance_in_km` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roads`
--

INSERT INTO `roads` (`id`, `from_town_id`, `to_town_id`, `created_at`, `updated_at`, `road_type_id`, `max_speed_in_km_per_hour`, `distance_in_km`) VALUES
(1, 1, 2, '2021-11-18 18:43:58', '2021-11-18 18:43:58', 1, 90, 60),
(2, 2, 3, '2021-11-18 18:44:37', '2021-11-18 18:44:37', 1, 80, 30),
(3, 3, 5, '2021-11-18 18:44:55', '2021-11-18 18:47:11', 2, 120, 88),
(4, 4, 5, '2021-11-18 18:45:27', '2021-11-18 18:52:20', 2, 120, 80),
(5, 3, 4, '2021-11-18 18:45:58', '2021-11-19 20:28:09', 3, 120, 153);

-- --------------------------------------------------------

--
-- Table structure for table `road_types`
--

CREATE TABLE `road_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hardship_level` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `road_types`
--

INSERT INTO `road_types` (`id`, `name`, `hardship_level`, `created_at`, `updated_at`) VALUES
(1, 'магистрален', 20, '2021-11-19 19:39:39', '2021-11-19 19:39:39'),
(2, 'селски', 40, '2021-11-19 19:39:39', '2021-11-19 19:39:39'),
(3, 'планински', 60, '2021-11-19 19:39:39', '2021-11-19 19:39:39');

-- --------------------------------------------------------

--
-- Table structure for table `towns`
--

CREATE TABLE `towns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `towns`
--

INSERT INTO `towns` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Враца', '2021-11-19 19:39:39', '2021-11-19 19:39:39'),
(2, 'София', '2021-11-19 19:39:39', '2021-11-19 19:39:39'),
(3, 'Пекин', '2021-11-19 19:39:39', '2021-11-19 19:39:39'),
(4, 'Плевен', '2021-11-19 19:39:39', '2021-11-19 19:39:39'),
(5, 'Чирпан', '2021-11-19 19:39:39', '2021-11-19 19:39:39'),
(6, 'Пловдив', '2021-11-19 19:39:39', '2021-11-19 19:39:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `admin`) VALUES
(1, 'kris', 'admin@kristiyan.tech', NULL, '$2y$10$mQYdXq3wnWRS/S2znGcV0OjlIblLRwpvfVroPN7NAJ51vRAmo75zi', NULL, '2021-11-19 19:39:39', '2021-11-19 19:39:39', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `filling_stations`
--
ALTER TABLE `filling_stations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filling_stations_road_id_foreign` (`road_id`);

--
-- Indexes for table `fuels`
--
ALTER TABLE `fuels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fuels_filling_stations`
--
ALTER TABLE `fuels_filling_stations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fuels_filling_stations_fuel_id_foreign` (`fuel_id`),
  ADD KEY `fuels_filling_stations_filling_station_id_foreign` (`filling_station_id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roads`
--
ALTER TABLE `roads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roads_from_town_id_to_town_id_unique` (`from_town_id`,`to_town_id`),
  ADD KEY `roads_road_type_id_foreign` (`road_type_id`),
  ADD KEY `roads_to_town_id_foreign` (`to_town_id`);

--
-- Indexes for table `road_types`
--
ALTER TABLE `road_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `towns`
--
ALTER TABLE `towns`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `filling_stations`
--
ALTER TABLE `filling_stations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `fuels`
--
ALTER TABLE `fuels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fuels_filling_stations`
--
ALTER TABLE `fuels_filling_stations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roads`
--
ALTER TABLE `roads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `road_types`
--
ALTER TABLE `road_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `towns`
--
ALTER TABLE `towns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `filling_stations`
--
ALTER TABLE `filling_stations`
  ADD CONSTRAINT `filling_stations_road_id_foreign` FOREIGN KEY (`road_id`) REFERENCES `roads` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fuels_filling_stations`
--
ALTER TABLE `fuels_filling_stations`
  ADD CONSTRAINT `fuels_filling_stations_filling_station_id_foreign` FOREIGN KEY (`filling_station_id`) REFERENCES `filling_stations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fuels_filling_stations_fuel_id_foreign` FOREIGN KEY (`fuel_id`) REFERENCES `fuels` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `roads`
--
ALTER TABLE `roads`
  ADD CONSTRAINT `edges_from_node_id_foreign` FOREIGN KEY (`from_town_id`) REFERENCES `towns` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `edges_to_node_id_foreign` FOREIGN KEY (`to_town_id`) REFERENCES `towns` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `roads_from_town_id_foreign` FOREIGN KEY (`from_town_id`) REFERENCES `towns` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `roads_road_type_id_foreign` FOREIGN KEY (`road_type_id`) REFERENCES `road_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `roads_to_town_id_foreign` FOREIGN KEY (`to_town_id`) REFERENCES `towns` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
