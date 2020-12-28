-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2020 at 11:30 AM
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
-- Database: `hms`
--

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
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(3, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(4, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(5, '2016_06_01_000004_create_oauth_clients_table', 1),
(6, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(7, '2020_03_31_000001_create_permissions_table', 1),
(8, '2020_03_31_000002_create_roles_table', 1),
(9, '2020_03_31_000003_create_users_table', 1),
(10, '2020_03_31_000008_create_permission_role_pivot_table', 1),
(11, '2020_03_31_000009_create_role_user_pivot_table', 1),
(12, '2020_10_15_061748_create_m_rights_table', 1),
(13, '2020_10_15_081859_create_m_orginfo_table', 1),
(14, '2020_10_16_054800_create_m_lookupfixed_table', 1),
(15, '2020_10_16_054829_create_m_lookup_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_lookup`
--

CREATE TABLE `m_lookup` (
  `lookupid` bigint(20) UNSIGNED NOT NULL,
  `keyname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keyvalue` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stats_flag` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_lookupfixed`
--

CREATE TABLE `m_lookupfixed` (
  `lookupfixid` bigint(20) UNSIGNED NOT NULL,
  `keyname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keyvalue` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_orginfo`
--

CREATE TABLE `m_orginfo` (
  `hospid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospcode` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospaddr1` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospaddr2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hospaddr3` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hospzip` bigint(20) DEFAULT NULL,
  `hospcity` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospstate` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospcontry` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospphone` bigint(20) NOT NULL,
  `hospmobile1` bigint(20) NOT NULL,
  `hospmobile2` bigint(20) DEFAULT NULL,
  `hospemail` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hospweb` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hosplogo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_orginfo`
--

INSERT INTO `m_orginfo` (`hospid`, `hospcode`, `hospname`, `hospaddr1`, `hospaddr2`, `hospaddr3`, `hospzip`, `hospcity`, `hospstate`, `hospcontry`, `hospphone`, `hospmobile1`, `hospmobile2`, `hospemail`, `hospweb`, `hosplogo`, `created_at`, `updated_at`, `deleted_at`, `updated_by`) VALUES
('217cafb4-6f00-42f2-b850-ae1fd1f4f4a6', '1', 'Appolo', 'Ambavadi', NULL, NULL, NULL, 'Ahmedabad', 'Gujarat', 'INDIA', 7878978, 4655456, NULL, 'appolo@gmail.com', 'http://appolo.com', NULL, '2020-10-19 03:44:40', '2020-10-19 03:44:40', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_rights`
--

CREATE TABLE `m_rights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint(20) NOT NULL DEFAULT 0,
  `status` bigint(20) NOT NULL DEFAULT 1 COMMENT '1=Active, 0=Inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_rights`
--

INSERT INTO `m_rights` (`id`, `title`, `link`, `parent_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Master', NULL, 0, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(2, 'Provider Master', 'admin/providers', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(3, 'Reference Master', 'admin/references', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(4, 'Dosage Master', 'admin/dosages', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(5, 'Charge Group Master', 'admin/charge_groups', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(6, 'Charge Master', 'admin/charges', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(7, 'Charge Price List', 'admin/charge_prices', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(8, 'Vaccine Group Master', 'admin/vaccine_groups', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(9, 'Vaccine Master', 'admin/vaccines', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(10, 'Holiday Master', 'admin/holidays', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(11, 'Consent Master', 'admin/consents', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(12, 'Tieup Master', 'admin/tieups', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(13, 'ICD Diagnosis Master', 'admin/icd_diagnosis', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(14, 'Diangosis Medicine Link', 'admin/diangosis_medicines', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(15, 'Vital Master', 'admin/vitals', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(16, 'Unit Master', 'admin/units', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(17, 'Drug Master', 'admin/drugs', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(18, 'Medicine Master', 'admin/medicine', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(19, 'Dosage Remarks Master', 'admin/dosage_remarks', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(20, 'Specimen Master', 'admin/specimens', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(21, 'Lab Test Master', 'admin/lab_tests', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(22, 'Invetory Item Category', 'admin/invetory_item_categorories', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(23, 'Inventory Item Master', 'admin/invetory_items', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(24, 'Lookup Master', 'admin/lookups', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(25, 'Tieup Master', 'admin/tieups', 1, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(26, 'Administrator', NULL, 0, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(27, 'Hospital Master', 'admin/hospitals', 26, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(28, 'User Management', NULL, 26, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(29, 'User Group', 'admin/roles', 28, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40'),
(30, 'User Master', 'admin/users', 28, 1, '2020-10-19 03:44:40', '2020-10-19 03:44:40');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
('06e4204e-545a-4686-95f6-8dc48abf0200', 'profile_password_edit', '2020-10-19 09:14:39', NULL, NULL),
('070f9c99-8e5b-4241-8076-8e8076b71103', 'user_management_access', '2020-10-19 09:14:39', NULL, NULL),
('19346782-c7a1-4998-84b8-a52aa954c777', 'role_access', '2020-10-19 09:14:39', NULL, NULL),
('3035ee96-64c6-4084-9d61-5875186f11bc', 'role_delete', '2020-10-19 09:14:39', NULL, NULL),
('35e103d8-203e-4c0a-b250-516bc60bf8cb', 'permission_edit', '2020-10-19 09:14:39', NULL, NULL),
('41d261e7-004b-402e-bab9-274c748c4a37', 'user_show', '2020-10-19 09:14:39', NULL, NULL),
('5c86c0e2-59e9-40a5-83cd-20dc6fdecbf9', 'user_delete', '2020-10-19 09:14:39', NULL, NULL),
('5e05a352-1fde-488d-b939-1613084a2c54', 'user_create', '2020-10-19 09:14:39', NULL, NULL),
('6942a990-801d-4f12-a09d-58033c913826', 'role_show', '2020-10-19 09:14:39', NULL, NULL),
('6e2d77e4-36d6-4d7a-9bbc-3d773e04b5dc', 'role_edit', '2020-10-19 09:14:39', NULL, NULL),
('816a2c51-fd59-4ea9-b373-60e2d41adb5f', 'permission_create', '2020-10-19 09:14:39', NULL, NULL),
('84f917f3-30d3-4179-bd8d-3360699c126f', 'role_create', '2020-10-19 09:14:39', NULL, NULL),
('9f219d93-5aff-4cf2-9956-cbb3672af50f', 'user_edit', '2020-10-19 09:14:39', NULL, NULL),
('bd614a20-490a-45ae-8a67-4fe83693c4c2', 'permission_access', '2020-10-19 09:14:39', NULL, NULL),
('bf6fe3bf-a329-48d6-a20b-7bb6800a348a', 'permission_show', '2020-10-19 09:14:39', NULL, NULL),
('c23b75bf-3e9c-4d41-9993-f53443b76e1b', 'permission_delete', '2020-10-19 09:14:39', NULL, NULL),
('dc408776-7820-43cc-93ab-89a5640a939c', 'user_access', '2020-10-19 09:14:39', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `role_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
('0512082e-24bc-4846-9bef-c9337c476fa7', '06e4204e-545a-4686-95f6-8dc48abf0200'),
('0512082e-24bc-4846-9bef-c9337c476fa7', '070f9c99-8e5b-4241-8076-8e8076b71103'),
('0512082e-24bc-4846-9bef-c9337c476fa7', '19346782-c7a1-4998-84b8-a52aa954c777'),
('0512082e-24bc-4846-9bef-c9337c476fa7', '3035ee96-64c6-4084-9d61-5875186f11bc'),
('0512082e-24bc-4846-9bef-c9337c476fa7', '35e103d8-203e-4c0a-b250-516bc60bf8cb'),
('0512082e-24bc-4846-9bef-c9337c476fa7', '41d261e7-004b-402e-bab9-274c748c4a37'),
('0512082e-24bc-4846-9bef-c9337c476fa7', '5c86c0e2-59e9-40a5-83cd-20dc6fdecbf9'),
('0512082e-24bc-4846-9bef-c9337c476fa7', '5e05a352-1fde-488d-b939-1613084a2c54'),
('0512082e-24bc-4846-9bef-c9337c476fa7', '6942a990-801d-4f12-a09d-58033c913826'),
('0512082e-24bc-4846-9bef-c9337c476fa7', '6e2d77e4-36d6-4d7a-9bbc-3d773e04b5dc'),
('0512082e-24bc-4846-9bef-c9337c476fa7', '816a2c51-fd59-4ea9-b373-60e2d41adb5f'),
('0512082e-24bc-4846-9bef-c9337c476fa7', '84f917f3-30d3-4179-bd8d-3360699c126f'),
('0512082e-24bc-4846-9bef-c9337c476fa7', '9f219d93-5aff-4cf2-9956-cbb3672af50f'),
('0512082e-24bc-4846-9bef-c9337c476fa7', 'bd614a20-490a-45ae-8a67-4fe83693c4c2'),
('0512082e-24bc-4846-9bef-c9337c476fa7', 'bf6fe3bf-a329-48d6-a20b-7bb6800a348a'),
('0512082e-24bc-4846-9bef-c9337c476fa7', 'c23b75bf-3e9c-4d41-9993-f53443b76e1b'),
('0512082e-24bc-4846-9bef-c9337c476fa7', 'dc408776-7820-43cc-93ab-89a5640a939c'),
('37f90ec4-03b1-4b45-a87b-af47e3f88a36', '06e4204e-545a-4686-95f6-8dc48abf0200');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
('0512082e-24bc-4846-9bef-c9337c476fa7', 'Admin', '2020-10-19 09:14:39', NULL, NULL),
('37f90ec4-03b1-4b45-a87b-af47e3f88a36', 'User', '2020-10-19 09:14:39', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
('ac08792b-2f54-46eb-8125-bc082a97eb21', '0512082e-24bc-4846-9bef-c9337c476fa7');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `mobile_no`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
('ac08792b-2f54-46eb-8125-bc082a97eb21', 'Admin', 'admin@admin.com', NULL, '$2y$10$KjopsXqbCq1NrrGYJe7rr./68LzZSGCas5XxBHHbG.9AF4mc3GPR.', NULL, '', 1, '2020-10-19 09:14:40', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_lookup`
--
ALTER TABLE `m_lookup`
  ADD PRIMARY KEY (`lookupid`),
  ADD KEY `m_lookup_created_by_fk` (`created_by`),
  ADD KEY `m_lookup_updated_by_fk` (`updated_by`);

--
-- Indexes for table `m_lookupfixed`
--
ALTER TABLE `m_lookupfixed`
  ADD PRIMARY KEY (`lookupfixid`);

--
-- Indexes for table `m_orginfo`
--
ALTER TABLE `m_orginfo`
  ADD PRIMARY KEY (`hospid`),
  ADD KEY `m_orginfo_updated_by_fk` (`updated_by`);

--
-- Indexes for table `m_rights`
--
ALTER TABLE `m_rights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD KEY `permission_role_role_id_fk` (`role_id`),
  ADD KEY `permission_role_permission_id_fk` (`permission_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD KEY `role_user_user_id_fk` (`user_id`),
  ADD KEY `role_user_role_id_fk` (`role_id`);

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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `m_lookup`
--
ALTER TABLE `m_lookup`
  MODIFY `lookupid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_lookupfixed`
--
ALTER TABLE `m_lookupfixed`
  MODIFY `lookupfixid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_rights`
--
ALTER TABLE `m_rights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_lookup`
--
ALTER TABLE `m_lookup`
  ADD CONSTRAINT `m_lookup_created_by_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `m_lookup_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `m_orginfo`
--
ALTER TABLE `m_orginfo`
  ADD CONSTRAINT `m_orginfo_updated_by_fk` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_fk` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_fk` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_fk` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
