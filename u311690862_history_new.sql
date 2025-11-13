-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 19, 2025 at 03:39 PM
-- Server version: 10.11.10-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u311690862_history_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `apps`
--

CREATE TABLE `apps` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `apps`
--

INSERT INTO `apps` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Call History - Light', '2025-06-18 17:12:31', '2025-06-18 17:12:31');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `mobile` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country_code` varchar(2) NOT NULL DEFAULT '',
  `country_name` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_verifications`
--

CREATE TABLE `email_verifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) NOT NULL,
  `otp` varchar(191) NOT NULL,
  `created_at` bigint(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_verifications`
--

INSERT INTO `email_verifications` (`id`, `email`, `otp`, `created_at`) VALUES
(14, 'harnisha111gajera@gmail.com', '474424', 1692514698),
(15, 'patelswar859@gmail.com', '123456', 1750266733),
(16, 'admin@gmail.com', '123456', 1750346501);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_sessions`
--

CREATE TABLE `login_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `user_agent` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `last_activity` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_sessions`
--

INSERT INTO `login_sessions` (`id`, `user_id`, `session_id`, `email`, `is_verified`, `user_agent`, `ip_address`, `last_activity`, `created_at`, `updated_at`) VALUES
(10, 1, 'lOkQ2U7NM4uZPH6baX31zEqq7lsnKMdpXu6XTLEJ', 'admin@gmail.com', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '103.251.19.221', '2025-06-19 14:22:16', '2025-06-19 14:22:16', '2025-06-19 14:22:25'),
(6, 1, 'ac11ahwWbi71hPqnVCgalcLk1X8tnQAQHFIf4Q0D', 'admin@gmail.com', 1, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '2409:40c1:101c:b173:527:ef8f:d754:5d33', '2025-06-18 17:29:03', '2025-06-18 17:29:03', '2025-06-18 17:29:11'),
(5, 1, '7y9vpY1a03GsW0N5tZuW3SyoXEN79COzYkrowGEI', 'admin@gmail.com', 1, 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Mobile Safari/537.36', '163.53.179.5', '2025-06-18 17:19:13', '2025-06-18 17:19:13', '2025-06-18 17:19:20'),
(9, 1, 'NJsrnd3JskL6t4pRXXSk6uFmDC3pRWqA55AqI7zT', 'admin@gmail.com', 1, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '103.251.19.221', '2025-06-19 14:20:21', '2025-06-19 14:20:21', '2025-06-19 14:20:28'),
(11, 1, 'qWFh5yM9an3MkhI6ApGrcwz4P3Jx18FgxxWW9t2O', 'admin@gmail.com', 1, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', '45.120.121.67', '2025-06-19 15:21:41', '2025-06-19 15:21:41', '2025-06-19 15:21:48');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `app_id` int(11) NOT NULL,
  `query_id` bigint(20) UNSIGNED NOT NULL,
  `num` int(11) DEFAULT NULL,
  `message` text NOT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_11_154130_create_apps_table', 1),
(2, '2014_10_11_154132_create_plans_table', 1),
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(6, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(7, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(8, '2016_06_01_000004_create_oauth_clients_table', 1),
(9, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(10, '2019_08_19_000000_create_failed_jobs_table', 1),
(11, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(12, '2022_08_23_154025_create_minings_table', 1),
(13, '2022_09_10_232004_create_settings_table', 1),
(14, '2022_09_24_190014_create_payment_statuses_table', 1),
(15, '2022_09_24_192534_create_referrals_table', 1),
(16, '2022_09_28_050346_create_withdrawals_table', 1),
(17, '2023_01_30_071750_daily_mining_history', 1),
(18, '2023_01_30_083702_minings_details', 1),
(19, '2023_01_30_084511_subscription', 1),
(20, '2023_05_12_091923_add_new_columns_to_settings_table', 2),
(21, '2023_05_12_120625_add_new_columns_terms_and_condition_to_settings_table', 3),
(22, '2023_06_12_121245_create_api_logs_table', 4),
(23, '2021_09_28_150557_create_roles_table', 5),
(25, '2021_09_28_150603_create_permissions_table', 6),
(26, '2023_06_12_084534_create_api_logs_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
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
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
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
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'MiningApp Personal Access Client', 'ae7bfzzyEdnkSseuKe4AFd4g1osRCVT0ktwNjRFO', NULL, 'http://localhost', 1, 0, 0, '2023-02-04 04:52:24', '2023-02-04 04:52:24'),
(2, NULL, 'MiningApp Password Grant Client', 'GFO3yd7kDfpwScQqFQTrJO7g5Y1id3625IE00s0o', 'users', 'http://localhost', 0, 1, 0, '2023-02-04 04:52:24', '2023-02-04 04:52:24');

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

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-02-04 04:52:24', '2023-02-04 04:52:24');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `is_admin_added` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `is_admin_added`, `created_at`, `updated_at`) VALUES
(1, 'Plan Create', 'plan-create', NULL, NULL, NULL),
(2, 'Plan Edit', 'plan-edit', NULL, NULL, NULL),
(3, 'Plan Delete', 'plan-delete', NULL, NULL, NULL),
(9, 'App Edit', 'app-edit', NULL, NULL, NULL),
(7, 'App Create', 'add-create', NULL, NULL, NULL),
(39, 'Dashboard', 'dashboard', NULL, NULL, NULL),
(11, 'Role access', 'role-access', NULL, NULL, NULL),
(12, 'Role Edit', 'role-edit', NULL, NULL, NULL),
(13, 'Role create', 'role-create', NULL, NULL, NULL),
(14, 'Role delete', 'role-delete', NULL, NULL, NULL),
(15, 'Permission access', 'permission-access', NULL, NULL, NULL),
(16, 'Permission Edit', 'permission-edit', NULL, NULL, NULL),
(17, 'Permission create', 'permission-create', NULL, NULL, NULL),
(18, 'Permission delete', 'permission-delete', NULL, NULL, NULL),
(19, 'Call Universal', 'app-id-1', NULL, NULL, NULL),
(20, 'Call Blue White', 'app-id-2', NULL, NULL, NULL),
(21, 'Call OB', 'app-id-3', NULL, NULL, NULL),
(24, 'Call Green', 'app-id-4', NULL, NULL, NULL),
(25, 'User access', 'user-access', NULL, NULL, NULL),
(26, 'user Edit', 'user-edit', NULL, NULL, NULL),
(28, 'user delete', 'user-delete', NULL, NULL, NULL),
(27, 'User Multi-delete', 'user-multi-delete', NULL, NULL, NULL),
(5, 'Plan access', 'plan-access', NULL, NULL, NULL),
(34, 'Setting Edit', 'setting-edit', NULL, NULL, NULL),
(33, 'Setting access', 'setting-access', NULL, NULL, NULL),
(6, 'Plan Change-Status', 'plan-change-status', NULL, NULL, NULL),
(35, 'App Setting Access', 'app-setting-access', NULL, NULL, NULL),
(36, 'App Setting edit', 'app-setting-edit', NULL, NULL, NULL),
(37, 'Purchage Access', 'purchage-access', NULL, NULL, NULL),
(38, 'Withdrawal Access', 'withdrawal-access', NULL, NULL, NULL),
(40, 'Authentication Access', 'authentication', NULL, NULL, NULL),
(41, 'ETH Admin', 'app-id-5', NULL, NULL, NULL),
(42, 'user Support Access', 'user-support-access', NULL, NULL, NULL),
(43, 'User Support Chat', 'user-support-chat', NULL, NULL, NULL),
(44, 'User Support Delete', 'user-support-delete', NULL, NULL, NULL),
(45, 'Category Access', 'category-access', NULL, NULL, NULL),
(46, 'Category Add', 'category-add', NULL, NULL, NULL),
(47, 'Category Edit', 'category-edit', NULL, NULL, NULL),
(48, 'Category Delete', 'category-delete', NULL, NULL, NULL),
(49, 'Category Multi delete', 'category-multi-delete', NULL, NULL, NULL),
(75, 'test app', 'app-id-11', '1', '2023-08-20 01:30:57', '2023-08-20 01:30:57'),
(76, 'Call History - Light', 'app-id-1', '1', '2025-06-18 17:12:31', '2025-06-18 17:12:31');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `plan_name` varchar(191) NOT NULL,
  `price` varchar(191) NOT NULL,
  `app_name` varchar(191) DEFAULT NULL,
  `transaction_key` text DEFAULT NULL,
  `status` varchar(191) NOT NULL,
  `response` text NOT NULL,
  `payment_getway` varchar(191) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `query`
--

CREATE TABLE `query` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `app_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `query_responce`
--

CREATE TABLE `query_responce` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `query_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`role_id`, `permission_id`) VALUES
(1, 7),
(1, 9),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 24),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 40),
(1, 75),
(1, 76),
(2, 5),
(2, 19),
(2, 20),
(2, 21),
(2, 24),
(2, 25),
(2, 33),
(2, 34),
(10, 1),
(10, 2),
(10, 3),
(10, 5),
(10, 6),
(10, 7),
(10, 9),
(10, 19),
(10, 20),
(10, 21),
(10, 24),
(10, 25),
(10, 26),
(10, 27),
(10, 28),
(10, 33),
(10, 34),
(10, 37),
(10, 38),
(11, 5),
(11, 19),
(11, 20),
(11, 21),
(11, 24),
(11, 25),
(11, 33),
(11, 34),
(12, 5),
(12, 19),
(12, 20),
(12, 21),
(12, 24),
(12, 25),
(12, 33),
(12, 34),
(13, 5),
(13, 19),
(13, 20),
(13, 21),
(13, 24),
(13, 33),
(13, 34),
(15, 5),
(15, 11),
(15, 12),
(15, 13),
(15, 14),
(15, 33),
(16, 19),
(16, 25),
(17, 19),
(17, 25),
(19, 19),
(20, 19),
(20, 20),
(21, 19),
(21, 33),
(21, 35);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `json` text DEFAULT NULL,
  `isAppRemove` enum('0','1') NOT NULL DEFAULT '0',
  `isShowFailPurchase` enum('0','1') NOT NULL DEFAULT '0',
  `isShowPurchaseEntryInFirebase` enum('0','1') NOT NULL DEFAULT '0',
  `support_email` varchar(255) DEFAULT NULL,
  `privacy_policy` varchar(255) DEFAULT NULL,
  `isTestAd` enum('0','1') NOT NULL DEFAULT '0',
  `isAdmobAndFBMeditation` enum('0','1') NOT NULL DEFAULT '0',
  `facebook_ads` enum('0','1') NOT NULL DEFAULT '0',
  `fb_native_ad` varchar(255) DEFAULT NULL,
  `fb_native_banner_ad` varchar(255) DEFAULT NULL,
  `fb_banner_ad` varchar(255) DEFAULT NULL,
  `fb_medium_rectangle_250` varchar(255) DEFAULT NULL,
  `fb_interstitial_ad` varchar(255) DEFAULT NULL,
  `fb_rewarded_video_ad` varchar(255) DEFAULT NULL,
  `admob_ads_id` enum('0','1') NOT NULL DEFAULT '0',
  `admob_native_banner_ad` varchar(255) DEFAULT NULL,
  `admob_native_ad` varchar(255) DEFAULT NULL,
  `admob_banner_ad` varchar(255) DEFAULT NULL,
  `admob_interstitial_ad` varchar(255) DEFAULT NULL,
  `admob_rewarded_video_ad` varchar(255) DEFAULT NULL,
  `admob_app_open` varchar(255) DEFAULT NULL,
  `admob_ads` enum('0','1') NOT NULL DEFAULT '0',
  `payment_gateway` enum('0','1') NOT NULL DEFAULT '0',
  `razor_pay` enum('0','1') NOT NULL DEFAULT '0',
  `razor_merchant_key` varchar(255) DEFAULT NULL,
  `razor_solt_key` varchar(255) DEFAULT NULL,
  `payu_new` enum('0','1') NOT NULL DEFAULT '0',
  `payu_new_merchant_key` varchar(255) DEFAULT NULL,
  `payu_new_solt_key` varchar(255) DEFAULT NULL,
  `payu_old` enum('0','1') NOT NULL DEFAULT '0',
  `payu_old_merchant_key` varchar(255) DEFAULT NULL,
  `payu_old_solt_key` varchar(255) DEFAULT NULL,
  `cash_free` enum('0','1') NOT NULL DEFAULT '0',
  `cash_merchant_key` varchar(255) DEFAULT NULL,
  `cash_solt_key` varchar(255) DEFAULT NULL,
  `paytm` enum('0','1') NOT NULL DEFAULT '0',
  `paytm_merchant_key` varchar(255) DEFAULT NULL,
  `paytm_solt_key` varchar(255) DEFAULT NULL,
  `upi` enum('0','1') NOT NULL DEFAULT '0',
  `upi_merchant` varchar(255) DEFAULT NULL,
  `in_app_purchase` enum('0','1') NOT NULL DEFAULT '0',
  `show_all_world` enum('0','1') NOT NULL DEFAULT '0',
  `outside_india` enum('0','1') NOT NULL DEFAULT '0',
  `show_all_user` enum('0','1') NOT NULL DEFAULT '0',
  `app_update` int(11) DEFAULT 0,
  `show_user_count` int(11) DEFAULT NULL,
  `app_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `applovin_ads` enum('0','1') NOT NULL DEFAULT '0',
  `applovin_small_native_ad` varchar(255) DEFAULT NULL,
  `applovin_medium_banner_ad` varchar(255) DEFAULT NULL,
  `applovin_large_native_ad` varchar(255) DEFAULT NULL,
  `applovin_interstitial_ad` varchar(255) DEFAULT NULL,
  `applovin_rewarded_video_ad` varchar(255) DEFAULT NULL,
  `upi_api` enum('0','1') NOT NULL DEFAULT '0',
  `upi_api_merchant_key` varchar(255) DEFAULT NULL,
  `upi_api_token` varchar(255) DEFAULT NULL,
  `upi_api_call_back_url` varchar(255) DEFAULT NULL,
  `terms_and_condition` varchar(255) DEFAULT NULL,
  `mining_session_time` int(11) DEFAULT NULL,
  `app_update_type_immediate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `json`, `isAppRemove`, `isShowFailPurchase`, `isShowPurchaseEntryInFirebase`, `support_email`, `privacy_policy`, `isTestAd`, `isAdmobAndFBMeditation`, `facebook_ads`, `fb_native_ad`, `fb_native_banner_ad`, `fb_banner_ad`, `fb_medium_rectangle_250`, `fb_interstitial_ad`, `fb_rewarded_video_ad`, `admob_ads_id`, `admob_native_banner_ad`, `admob_native_ad`, `admob_banner_ad`, `admob_interstitial_ad`, `admob_rewarded_video_ad`, `admob_app_open`, `admob_ads`, `payment_gateway`, `razor_pay`, `razor_merchant_key`, `razor_solt_key`, `payu_new`, `payu_new_merchant_key`, `payu_new_solt_key`, `payu_old`, `payu_old_merchant_key`, `payu_old_solt_key`, `cash_free`, `cash_merchant_key`, `cash_solt_key`, `paytm`, `paytm_merchant_key`, `paytm_solt_key`, `upi`, `upi_merchant`, `in_app_purchase`, `show_all_world`, `outside_india`, `show_all_user`, `app_update`, `show_user_count`, `app_id`, `created_at`, `updated_at`, `applovin_ads`, `applovin_small_native_ad`, `applovin_medium_banner_ad`, `applovin_large_native_ad`, `applovin_interstitial_ad`, `applovin_rewarded_video_ad`, `upi_api`, `upi_api_merchant_key`, `upi_api_token`, `upi_api_call_back_url`, `terms_and_condition`, `mining_session_time`, `app_update_type_immediate`) VALUES
(1, NULL, '0', '0', '0', NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', NULL, NULL, '0', NULL, NULL, '0', NULL, NULL, '0', NULL, NULL, '0', NULL, NULL, '0', NULL, '0', '0', '0', '0', 0, NULL, 1, '2025-06-18 17:13:17', '2025-06-19 15:38:43', '0', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `app_id` int(10) UNSIGNED DEFAULT NULL,
  `role` enum('0','1') NOT NULL DEFAULT '0',
  `user_key` text DEFAULT NULL,
  `device_token` varchar(255) DEFAULT NULL,
  `device_type` varchar(255) DEFAULT NULL,
  `login_with` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_verification` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `email`, `email_verified_at`, `password`, `app_id`, `role`, `user_key`, `device_token`, `device_type`, `login_with`, `remember_token`, `created_at`, `updated_at`, `email_verification`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$VYh9gE2xAQZlkycJnB/GCesELQMJtV80bdggKDv9E3z8PpzumjuOW', NULL, '1', NULL, NULL, NULL, NULL, '5dDXDGRvoRMN0cjpKXojuxVWmFSh5HtixwpauLIyNBhcoAQOPRkNy7E8EBhT', '2023-08-01 16:20:12', '2023-08-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_permissions`
--

CREATE TABLE `users_permissions` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_permissions`
--

INSERT INTO `users_permissions` (`user_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 5),
(1, 6),
(1, 7),
(1, 9),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39);

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

CREATE TABLE `users_roles` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_roles`
--

INSERT INTO `users_roles` (`user_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_contacts`
--

CREATE TABLE `user_contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_id` int(11) NOT NULL,
  `email` varchar(191) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_verifications`
--
ALTER TABLE `email_verifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_verifications_email_index` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `login_sessions`
--
ALTER TABLE `login_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_sessions_user_id_foreign` (`user_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_user_id_foreign` (`user_id`),
  ADD KEY `message_query_id_foreign` (`query_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `query`
--
ALTER TABLE `query`
  ADD PRIMARY KEY (`id`),
  ADD KEY `query_user_id_foreign` (`user_id`),
  ADD KEY `query_app_id_foreign` (`app_id`);

--
-- Indexes for table `query_responce`
--
ALTER TABLE `query_responce`
  ADD PRIMARY KEY (`id`),
  ADD KEY `query_responce_query_id_foreign` (`query_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `roles_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_app_id_foreign` (`app_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_app_id_foreign` (`app_id`);

--
-- Indexes for table `users_permissions`
--
ALTER TABLE `users_permissions`
  ADD PRIMARY KEY (`user_id`,`permission_id`),
  ADD KEY `users_permissions_permission_id_foreign` (`permission_id`) USING BTREE;

--
-- Indexes for table `users_roles`
--
ALTER TABLE `users_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `users_roles_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_contacts`
--
ALTER TABLE `user_contacts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apps`
--
ALTER TABLE `apps`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_verifications`
--
ALTER TABLE `email_verifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_sessions`
--
ALTER TABLE `login_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `query`
--
ALTER TABLE `query`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `query_responce`
--
ALTER TABLE `query_responce`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_contacts`
--
ALTER TABLE `user_contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_app_id_foreign` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
