-- Adminer 4.7.8 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `broadcasts`;
CREATE TABLE `broadcasts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiry_date` date NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isSent` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `broadcast_groups`;
CREATE TABLE `broadcast_groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `broadcast_groups` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1,	'new grp',	'2021-10-28 08:28:33',	'2021-10-28 08:28:33');

DROP TABLE IF EXISTS `broadcast_group_details`;
CREATE TABLE `broadcast_group_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `broadcast_group_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `broadcast_group_details_customer_id_foreign` (`customer_id`),
  KEY `broadcast_group_details_broadcast_group_id_foreign` (`broadcast_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `broadcast_histories`;
CREATE TABLE `broadcast_histories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sending_date` date NOT NULL,
  `sending_time` time NOT NULL,
  `broadcast_group_id` bigint(20) unsigned NOT NULL,
  `broadcast_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `broadcast_histories_broadcast_group_id_foreign` (`broadcast_group_id`),
  KEY `broadcast_histories_broadcast_id_foreign` (`broadcast_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) DEFAULT NULL,
  `supplier_id` bigint(20) DEFAULT NULL,
  `customer_id` bigint(23) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `qty` bigint(20) DEFAULT NULL,
  `min_qty` varchar(255) DEFAULT '0',
  `total` bigint(20) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isActive` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `name`, `image`, `isActive`, `created_at`, `updated_at`) VALUES
(5,	'Baking',	'16356123534778.jpg',	'1',	'2021-10-30 16:45:53',	'2021-10-30 16:49:33'),
(6,	'Ingrediants',	'16356124059679.jpg',	'1',	'2021-10-30 16:46:45',	'2021-10-30 16:49:36'),
(8,	'Flavours',	'16356125115881.jpg',	'1',	'2021-10-30 16:48:31',	'2021-10-30 16:49:39'),
(9,	'Spices',	'16356125574124.jpg',	'1',	'2021-10-30 16:49:17',	'2021-10-30 16:49:42');

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2016_06_01_000001_create_oauth_auth_codes_table',	1),
(4,	'2016_06_01_000002_create_oauth_access_tokens_table',	1),
(5,	'2016_06_01_000003_create_oauth_refresh_tokens_table',	1),
(6,	'2016_06_01_000004_create_oauth_clients_table',	1),
(7,	'2016_06_01_000005_create_oauth_personal_access_clients_table',	1),
(8,	'2019_08_19_000000_create_failed_jobs_table',	1),
(9,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(10,	'2021_10_03_120818_create_permission_tables',	1),
(11,	'2021_10_03_143257_create_categories_table',	1),
(12,	'2021_10_14_104654_create_units_table',	1),
(13,	'2021_10_20_073528_create_broadcasts_table',	1),
(14,	'2021_10_20_103220_create_broadcast_groups_table',	1),
(15,	'2021_10_21_044254_create_broadcast_histories_table',	1),
(16,	'2021_10_28_124431_create_products_table',	2),
(17,	'2021_10_28_132645_broadcast_group_details_table',	3);

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1,	'App\\Models\\User',	9),
(2,	'App\\Models\\User',	11),
(3,	'App\\Models\\User',	12),
(4,	'App\\Models\\User',	15),
(3,	'App\\Models\\User',	23),
(2,	'App\\Models\\User',	25),
(2,	'App\\Models\\User',	27),
(2,	'App\\Models\\User',	28),
(2,	'App\\Models\\User',	29),
(1,	'App\\Models\\User',	30),
(1,	'App\\Models\\User',	31),
(1,	'App\\Models\\User',	32),
(1,	'App\\Models\\User',	33),
(1,	'App\\Models\\User',	34),
(1,	'App\\Models\\User',	35),
(1,	'App\\Models\\User',	36),
(1,	'App\\Models\\User',	37),
(2,	'App\\Models\\User',	38),
(2,	'App\\Models\\User',	39),
(3,	'App\\Models\\User',	40),
(3,	'App\\Models\\User',	41),
(3,	'App\\Models\\User',	42);

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
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


DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_number` bigint(100) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `supplier_id` bigint(20) DEFAULT NULL,
  `customer_id` bigint(23) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `qty` bigint(20) DEFAULT NULL,
  `min_qty` varchar(255) DEFAULT '0',
  `total` bigint(20) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Confirmed',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `orders` (`id`, `order_number`, `product_id`, `supplier_id`, `customer_id`, `price`, `qty`, `min_qty`, `total`, `unit`, `status`, `created_at`, `updated_at`) VALUES
(10,	96150843,	'[12,13,14,14]',	30,	28,	NULL,	8,	'0',	6242,	NULL,	'Confirmed',	'2021-10-31 08:16:02',	'2021-10-31 08:16:02'),
(11,	13210700,	'[17,18]',	31,	28,	NULL,	7,	'0',	3678,	NULL,	'Confirmed',	'2021-10-31 08:16:33',	'2021-10-31 08:16:33'),
(12,	17656892,	'[21,23]',	36,	28,	NULL,	4,	'0',	750,	NULL,	'Confirmed',	'2021-10-31 08:30:30',	'2021-10-31 08:30:30'),
(13,	68671774,	'[20]',	33,	28,	NULL,	3,	'0',	3600,	NULL,	'Confirmed',	'2021-10-31 08:30:34',	'2021-10-31 08:30:34'),
(14,	64931333,	'[19]',	32,	28,	NULL,	4,	'0',	800,	NULL,	'Confirmed',	'2021-10-31 08:30:36',	'2021-10-31 08:30:36'),
(15,	28301800,	'[13,12]',	30,	28,	NULL,	8,	'0',	5600,	NULL,	'Confirmed',	'2021-10-31 08:34:48',	'2021-10-31 08:34:48');

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `isActive` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `min_req_qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `category_id` bigint(20) unsigned NOT NULL,
  `supplier_id` bigint(20) unsigned NOT NULL,
  `manufacturing_partner_id` bigint(20) unsigned NOT NULL,
  `unit_id` bigint(20) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `products` (`id`, `name`, `price`, `image`, `description`, `isActive`, `min_req_qty`, `category_id`, `supplier_id`, `manufacturing_partner_id`, `unit_id`, `quantity`, `created_at`, `updated_at`) VALUES
(12,	'Choclate',	200,	'16356682688039.jpg',	'<p>This is fabulous Product&nbsp;</p>',	'1',	'1',	6,	30,	23,	2,	50,	'2021-10-30 16:57:00',	'2021-10-31 08:17:48'),
(13,	'Butter',	1200,	'16356682959860.jpg',	'<p>Butter is yummy&nbsp;</p>',	'1',	'0',	8,	30,	23,	2,	50,	'2021-10-30 16:58:00',	'2021-10-31 08:18:15'),
(14,	'Salt',	807,	'1635668340568.jpg',	'<p>So yummy&nbsp;</p>',	'1',	'1',	9,	30,	23,	2,	10,	'2021-10-30 17:01:34',	'2021-10-31 08:19:00'),
(15,	'Black Peper',	500,	'16356684541513.jpg',	'<p>So yummy&nbsp;</p>',	'1',	'1',	5,	34,	23,	2,	944,	'2021-10-30 17:03:11',	'2021-10-31 08:20:54'),
(16,	'Vegetables',	1600,	'16356665413305.jpg',	'<p>Its So delecious</p>',	'1',	'0',	5,	30,	23,	2,	50,	'2021-10-30 17:04:49',	'2021-10-31 07:49:01'),
(17,	'Flour',	807,	'16356676122972.jpg',	'<p>Very high quality&nbsp;</p>',	'1',	'1',	5,	31,	40,	2,	788,	'2021-10-31 08:06:52',	'2021-10-31 08:12:57'),
(18,	'Cheese',	150,	'16356677887616.jpg',	'<p>Very high quality&nbsp;</p>',	'1',	'0',	6,	31,	40,	4,	50,	'2021-10-31 08:09:48',	'2021-10-31 08:13:03'),
(19,	'Baking Powder',	200,	'16356678848932.jpg',	'<p>Sjjkj</p>',	'1',	'0',	8,	32,	40,	5,	50,	'2021-10-31 08:11:24',	'2021-10-31 08:13:08'),
(20,	'Chicoo',	1200,	'16356679657392.png',	'<p>Very high quality&nbsp;Very high quality&nbsp;</p>',	'1',	'0',	9,	33,	42,	2,	805,	'2021-10-31 08:12:45',	'2021-10-31 08:13:20'),
(21,	'food color',	200,	'16356686186378.jpg',	'<p>aslam@gmail.comaslam@gmail.com</p>',	'1',	'1',	8,	36,	41,	6,	50,	'2021-10-31 08:23:38',	'2021-10-31 08:25:13'),
(22,	'EGGs',	300,	'1635668704594.jpg',	'<p>aslam@gmail.comaslam@gmail.com</p>',	'1',	'1',	6,	37,	41,	5,	788,	'2021-10-31 08:25:04',	'2021-10-31 08:25:20'),
(23,	'Milk',	150,	'16356688292921.jpg',	'<p>milkkk</p>',	'1',	'0',	9,	36,	42,	2,	805,	'2021-10-31 08:27:09',	'2021-10-31 08:28:38'),
(24,	'Suger',	1200,	'16356689028999.jpg',	'<p>aslam@gmail.comaslam@gmail.com</p>',	'1',	'1',	5,	35,	42,	6,	50,	'2021-10-31 08:28:22',	'2021-10-31 08:28:53');

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1,	'Supplier',	'web',	'2021-10-28 11:15:41',	'2021-10-28 11:15:41'),
(2,	'Customer',	'web',	'2021-10-28 11:22:50',	'2021-10-28 11:22:50'),
(3,	'Manufacturer',	'web',	'2021-10-28 11:32:00',	'2021-10-28 11:32:00'),
(4,	'Admin',	'web',	'2021-10-28 12:20:08',	'2021-10-28 12:20:08');

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `units`;
CREATE TABLE `units` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abbreviation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `units` (`id`, `name`, `symbol`, `abbreviation`, `isActive`, `created_at`, `updated_at`) VALUES
(2,	'kg',	'kg',	'kg',	1,	'2021-10-30 16:23:29',	'2021-10-30 16:28:43'),
(3,	'£',	'£',	'£',	1,	'2021-10-30 16:24:29',	'2021-10-30 16:29:11'),
(4,	'Packet',	'Packet',	'Packet',	1,	'2021-10-30 16:24:57',	'2021-10-30 16:28:58'),
(5,	'gram',	'gram',	'gram',	1,	'2021-10-30 16:26:54',	'2021-10-30 16:27:55'),
(6,	'Dozen',	'Dozen',	'Dozen',	1,	'2021-10-30 16:27:28',	'2021-10-30 16:27:50');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `franchise_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobilenumber` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isBlocked` tinyint(1) NOT NULL DEFAULT '0',
  `isBookmarked` tinyint(1) NOT NULL DEFAULT '0',
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `fax_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `first_name`, `last_name`, `image`, `email`, `email_verified_at`, `password`, `franchise_name`, `mobilenumber`, `address`, `isBlocked`, `isBookmarked`, `isActive`, `fax_number`, `created_at`, `updated_at`) VALUES
(15,	'Cplus',	'Soft',	NULL,	's.zargayouna@royal-donuts.com',	NULL,	'$2a$12$5trNVxX7l.CXq23RGB3Wn.kBAyGxTpaCGfN2zst8lsaTpF1wIeRCC',	NULL,	NULL,	NULL,	0,	0,	0,	NULL,	'2021-10-28 07:22:02',	'2021-10-28 07:22:02'),
(23,	'Coca',	'Cola',	NULL,	'coca@gmail.com',	NULL,	NULL,	NULL,	'+19653215994',	'House 626, Street 44,',	0,	0,	1,	NULL,	'2021-10-30 16:32:06',	'2021-10-30 16:32:16'),
(25,	'Hussam',	'Ali',	NULL,	'hussamali@gmail.com',	NULL,	'$2y$10$RxlheYZSmRsNdPKElnbvWeQiRZR5BHRJMT02pNBCf6pFKGL2QE2om',	'North West Donut',	'6345094054',	'97 White Oak Court',	0,	0,	1,	NULL,	'2021-10-30 16:36:04',	'2021-10-30 16:36:10'),
(27,	'Irfan',	'Elahi',	NULL,	'irfan@gmail.com',	NULL,	'$2y$10$n509TczTZ.vkXUIqr5QhiOMRUyKYYtYXRgD458exnmdA40J/j1AGi',	'East France Donut',	'6345094054',	'97 White Oak Court',	0,	0,	1,	NULL,	'2021-10-31 07:02:21',	'2021-10-31 07:03:07'),
(28,	'Aslam',	'Chaudhry',	NULL,	'aslam@gmail.com',	NULL,	'$2y$10$sAXVHxNrL1aDHrsqhYZFYujjm8Y6.tK.Q4c1wHqj4RwlUOIEA6o5m',	'Middle City Franchise',	'6345094054',	'97 White Oak Court',	0,	0,	1,	NULL,	'2021-10-31 07:03:55',	'2021-10-31 07:04:03'),
(29,	'Habib',	'Ullah',	NULL,	'habib@gmail.com',	NULL,	'$2y$10$Yg2bCuNatqZ3SlmOqJ9CfuPzt9RmnNFyiUHD/CPkbgiBCI5ojK/QS',	'New Franchise',	'+19653215994',	'House 626, Street 44,',	0,	0,	1,	NULL,	'2021-10-31 07:07:10',	'2021-10-31 07:07:16'),
(30,	'TCS',	'Services',	NULL,	'tcs@gmail.com',	NULL,	'$2y$10$Zeb9rEQHQj1LlSXhlKDTXuT1pbjEgYQzC5WRzCKtthKS/IwHNRIY6',	NULL,	'+9230804029705',	'Peter',	0,	0,	1,	'Nissim',	'2021-10-31 07:13:22',	'2021-10-31 07:24:15'),
(31,	'DHL',	'Services',	NULL,	'dhl@gmail.com',	NULL,	'$2y$10$klGaQC7V/NvSCwW7N3aj2.tiT0w3TGo81F4FsZlqOhIiFirEwq2DK',	NULL,	'13349824151',	'664 Second Lane',	0,	0,	1,	'06654654655',	'2021-10-31 07:14:16',	'2021-10-31 07:14:40'),
(32,	'Courier',	'Services',	NULL,	'courier@gmail.com',	NULL,	'$2y$10$.gvBzjwJNJafUtYUv6RKZeVpClUGT7i/.Dg8.0xHPc20xzWF5XXqe',	NULL,	'13349824151',	'664 Second Lane',	0,	0,	1,	'06654654655',	'2021-10-31 07:21:15',	'2021-10-31 07:21:21'),
(33,	'BlueEX',	'Services',	NULL,	'blue@gmail.com',	NULL,	'$2y$10$dn9G71qW1P1Y9Wh922M.5e/MGcqeX9fBO7D9MnzMXZggDLMrJUkhC',	NULL,	'+19653215994',	'House 626, Street 44,',	0,	0,	1,	'06654654655',	'2021-10-31 07:22:17',	'2021-10-31 07:22:24'),
(34,	'M&P Express',	'Logistics',	NULL,	'express@gmail.com',	NULL,	'$2y$10$2dmHc4vVKvacT1XM6VPsh.UUGSILKWvXRidCwP.WwlNL2T0P2JSni',	NULL,	'6345094054',	'97 White Oak Court',	0,	0,	1,	'06654654655',	'2021-10-31 07:25:53',	'2021-10-31 07:26:05'),
(35,	'Smart',	'Link',	NULL,	'smart@gmail.com',	NULL,	'$2y$10$fy1vNCu0g03Tm3QyfRvRMeI.RvNqGAtEipEetCIFSgyFxTRJCDDk2',	NULL,	'13349824151',	'664 Second Lane',	0,	0,	1,	'06654654655',	'2021-10-31 07:26:45',	'2021-10-31 07:26:50'),
(36,	'IDHS',	'COURIER',	NULL,	'idhs@gmail.com',	NULL,	'$2y$10$xgQYMkyfn35ND5BIoCFTuuFh4JTYgHD79R8Zmuz9JcT1/I98oia2i',	NULL,	'13349824151',	'664 Second Lane',	0,	0,	1,	'06654654655',	'2021-10-31 07:30:49',	'2021-10-31 07:30:55'),
(37,	'Hi Speed',	'Express',	NULL,	'hispeed@gmail.com',	NULL,	'$2y$10$N6C49tRYgq8ab1l82Y56EejKg6VS.JfNEXJe2Sfwj11beMHc8jsiS',	NULL,	'+19653215994',	'House 626, Street 44,',	0,	0,	1,	'06654654655',	'2021-10-31 07:31:36',	'2021-10-31 07:31:47'),
(38,	'Nasreen',	'Akhtar',	NULL,	'nasreen@gmail.com',	NULL,	'$2y$10$aaFB1nCLZ.TsFWKCy5zmx.xhahBjjUO8OMvk8Z9Lmkurc1Dqe4JUK',	'Civic Center',	'+19653215994',	'House 626, Street 44,',	0,	0,	1,	NULL,	'2021-10-31 07:34:00',	'2021-10-31 07:34:07'),
(39,	'Kamran',	'Ali',	NULL,	'kamran@gmail.com',	NULL,	'$2y$10$XnHXCa/mCXyTTwzfs9BCe.PPkw6nUj.OCBkBsODHzZAwcr.gAZNdu',	'Civic Center 2',	'13349824151',	'House 18-A, Awami Villas 5, Bahria Phase 8',	0,	0,	1,	NULL,	'2021-10-31 07:35:10',	'2021-10-31 07:35:18'),
(40,	'Peek',	'Freak',	NULL,	'peek@gmail.com',	NULL,	NULL,	NULL,	'+19653215994',	'House 626, Street 44,',	0,	0,	1,	NULL,	'2021-10-31 07:36:29',	'2021-10-31 07:39:29'),
(41,	'Lays',	'Cooperation',	NULL,	'lays@gmail.com',	NULL,	NULL,	NULL,	'6345094054',	'97 White Oak Court',	0,	0,	1,	NULL,	'2021-10-31 07:37:20',	'2021-10-31 07:39:27'),
(42,	'Ali',	'Manufacturer',	NULL,	'ali@gmail.com',	NULL,	NULL,	NULL,	'6345094054',	'97 White Oak Court',	0,	0,	1,	NULL,	'2021-10-31 07:39:20',	'2021-10-31 07:39:25');

-- 2021-11-01 08:10:53