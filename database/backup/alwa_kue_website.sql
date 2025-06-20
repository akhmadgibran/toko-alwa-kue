/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`),
  KEY `carts_product_id_foreign` (`product_id`),
  CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `job_batches`;
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
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `custom_order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` double NOT NULL,
  `quantity` int NOT NULL,
  `subtotal` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_details_custom_order_id_foreign` (`custom_order_id`),
  CONSTRAINT `order_details_custom_order_id_foreign` FOREIGN KEY (`custom_order_id`) REFERENCES `orders` (`custom_order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `order_statuses`;
CREATE TABLE `order_statuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `custom_order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Menunggu Pembayaran',
  `buyer_note` longtext COLLATE utf8mb4_unicode_ci,
  `seller_note` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `snap_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_custom_order_id_unique` (`custom_order_id`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE `product_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `product_promotions`;
CREATE TABLE `product_promotions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_promotions_product_id_foreign` (`product_id`),
  CONSTRAINT `product_promotions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int NOT NULL,
  `price` int NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `shop_statuses`;
CREATE TABLE `shop_statuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE `site_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `shop_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Shop Name',
  `logo_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_background_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_banner_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'shop@gmail.com',
  `slogan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Shop Slogan',
  `about_us` longtext COLLATE utf8mb4_unicode_ci,
  `promotion_paragraph` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0123456789',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Shop Address',
  `facebook_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Facebook Name',
  `facebook_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'https://www.facebook.com',
  `twitter_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Twitter Name',
  `twitter_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'https://www.twitter.com',
  `instagram_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Instagram Name',
  `instagram_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'https://www.instagram.com',
  `copyright_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usertype` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'costumer',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_0ade7c2cf97f75d009975f4d720d1fa6c19f4897', 'i:4;', 1749483637);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_0ade7c2cf97f75d009975f4d720d1fa6c19f4897:timer', 'i:1749483637;', 1749483637);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_15a55fc384cfa1521755a19f123fd1f1', 'i:2;', 1750407951);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_15a55fc384cfa1521755a19f123fd1f1:timer', 'i:1750407951;', 1750407951);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_17ba0791499db908433b80f37c5fbc89b870084b', 'i:1;', 1749610555);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_17ba0791499db908433b80f37c5fbc89b870084b:timer', 'i:1749610555;', 1749610555);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_1b6453892473a467d07372d45eb05abc2031647a', 'i:1;', 1749359339);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_1b6453892473a467d07372d45eb05abc2031647a:timer', 'i:1749359339;', 1749359339);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_2be533ed9aa593e47bc6901490e205ce', 'i:1;', 1750382490);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_2be533ed9aa593e47bc6901490e205ce:timer', 'i:1750382490;', 1750382490);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_2fdb6b2b4b2521c36eee6e276c2deb16', 'i:1;', 1750298670);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_2fdb6b2b4b2521c36eee6e276c2deb16:timer', 'i:1750298670;', 1750298670);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_30fb836cd4716f95e097d3f772b85be7', 'i:1;', 1749786440);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_30fb836cd4716f95e097d3f772b85be7:timer', 'i:1749786440;', 1749786440);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_3405492861571044d94e77ad442ec54a', 'i:1;', 1749427592);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_3405492861571044d94e77ad442ec54a:timer', 'i:1749427592;', 1749427592);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_34663035315e3081c295ff18a722012c', 'i:1;', 1749427415);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_34663035315e3081c295ff18a722012c:timer', 'i:1749427415;', 1749427415);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_366eb030ddb68a76b585b290294d1f55', 'i:1;', 1750209773);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_366eb030ddb68a76b585b290294d1f55:timer', 'i:1750209773;', 1750209773);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_3b047662de4ce792952cafd3998c4195', 'i:1;', 1750379357);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_3b047662de4ce792952cafd3998c4195:timer', 'i:1750379357;', 1750379357);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_3bee2178bd38be1f7fca569bd9690bc6', 'i:1;', 1750384184);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_3bee2178bd38be1f7fca569bd9690bc6:timer', 'i:1750384184;', 1750384184);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_46cad3c94ce025035d40771cc5baa1ef', 'i:1;', 1750384549);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_46cad3c94ce025035d40771cc5baa1ef:timer', 'i:1750384549;', 1750384549);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_474868e2cf2dca95bf4653f025c5c9e0', 'i:1;', 1750379424);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_474868e2cf2dca95bf4653f025c5c9e0:timer', 'i:1750379424;', 1750379424);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_4b1598ed2d913ce2d9252ca0922cae52', 'i:1;', 1749819303);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_4b1598ed2d913ce2d9252ca0922cae52:timer', 'i:1749819303;', 1749819303);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_4d8e7c025355ffa93d4fb12d527dadb9', 'i:1;', 1749466216);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_4d8e7c025355ffa93d4fb12d527dadb9:timer', 'i:1749466216;', 1749466216);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_505ee814f64dc45d3456db7464e47401', 'i:1;', 1749466309);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_505ee814f64dc45d3456db7464e47401:timer', 'i:1749466309;', 1749466309);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_60a48808b72459a1e70a5064b16cbaf8', 'i:1;', 1749553390);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_60a48808b72459a1e70a5064b16cbaf8:timer', 'i:1749553390;', 1749553390);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_612e2e51e227f6f8674cd8197c176eb0', 'i:1;', 1750382222);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_612e2e51e227f6f8674cd8197c176eb0:timer', 'i:1750382222;', 1750382222);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_6dc39bd47a585d21ac07c7c8615ea4ad', 'i:1;', 1749466147);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_6dc39bd47a585d21ac07c7c8615ea4ad:timer', 'i:1749466147;', 1749466147);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_70976f728cc2b34dfd6bf887cdf09d0d', 'i:1;', 1750408483);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_70976f728cc2b34dfd6bf887cdf09d0d:timer', 'i:1750408483;', 1750408483);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_71e3bf8915e5e4d91a81d0435b4f496a', 'i:1;', 1750410276);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_71e3bf8915e5e4d91a81d0435b4f496a:timer', 'i:1750410276;', 1750410276);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_729bc9c1cbeb47b3df2918a47ff4a81f', 'i:1;', 1749553431);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_729bc9c1cbeb47b3df2918a47ff4a81f:timer', 'i:1749553431;', 1749553431);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_7b52009b64fd0a2a49e6d8a939753077792b0554', 'i:2;', 1749781585);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_7b52009b64fd0a2a49e6d8a939753077792b0554:timer', 'i:1749781585;', 1749781585);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_7d50ab91eefdedd4f91a3574e7cd3b42', 'i:1;', 1749781580);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_7d50ab91eefdedd4f91a3574e7cd3b42:timer', 'i:1749781580;', 1749781580);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_7dc4fd8d09d68798078c0072c78b0719', 'i:1;', 1750066826);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_7dc4fd8d09d68798078c0072c78b0719:timer', 'i:1750066826;', 1750066826);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_7df73639caf71a543c494f9cd5b8a495', 'i:1;', 1750404306);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_7df73639caf71a543c494f9cd5b8a495:timer', 'i:1750404306;', 1750404306);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_7e7ce351d80b06fb948941ce979842e9', 'i:1;', 1749469102);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_7e7ce351d80b06fb948941ce979842e9:timer', 'i:1749469102;', 1749469102);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_7f0e55f1a76794d390dbdd764d55f065', 'i:1;', 1750298895);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_7f0e55f1a76794d390dbdd764d55f065:timer', 'i:1750298895;', 1750298895);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_858d7c89abb9745c3f274888a6aac0eb', 'i:4;', 1750346613);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_858d7c89abb9745c3f274888a6aac0eb:timer', 'i:1750346613;', 1750346613);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_8d3a54f9e9ec4883f56fb5f9bc635858', 'i:1;', 1750321267);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_8d3a54f9e9ec4883f56fb5f9bc635858:timer', 'i:1750321267;', 1750321267);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_902ba3cda1883801594b6e1b452790cc53948fda', 'i:1;', 1749466606);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_902ba3cda1883801594b6e1b452790cc53948fda:timer', 'i:1749466606;', 1749466606);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_91032ad7bbcb6cf72875e8e8207dcfba80173f7c', 'i:1;', 1750408397);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_91032ad7bbcb6cf72875e8e8207dcfba80173f7c:timer', 'i:1750408397;', 1750408397);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_915e0382e6db9f7d6737fbdb57e10ebb', 'i:1;', 1750066809);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_915e0382e6db9f7d6737fbdb57e10ebb:timer', 'i:1750066809;', 1750066809);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_925dadab1350daa231ad5e0b32c13a53', 'i:1;', 1750346957);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_925dadab1350daa231ad5e0b32c13a53:timer', 'i:1750346957;', 1750346957);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_940f79904a3b8306e0c9e12ee2e07267', 'i:1;', 1749903135);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_940f79904a3b8306e0c9e12ee2e07267:timer', 'i:1749903135;', 1749903135);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_9e6a55b6b4563e652a23be9d623ca5055c356940', 'i:1;', 1750407629);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_9e6a55b6b4563e652a23be9d623ca5055c356940:timer', 'i:1750407629;', 1750407629);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_a51f2207942f7c66470326f9142ea80a', 'i:1;', 1750209760);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_a51f2207942f7c66470326f9142ea80a:timer', 'i:1750209760;', 1750209760);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_a7edadf5dbb55cc25237ca4d352961e6', 'i:1;', 1749448136);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_a7edadf5dbb55cc25237ca4d352961e6:timer', 'i:1749448136;', 1749448136);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4', 'i:6;', 1749437871);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_ac3478d69a3c81fa62e60f5c3696165a4e5e6ac4:timer', 'i:1749437871;', 1749437871);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_arshellachelsea11@gmail.com|110.138.99.103', 'i:4;', 1750346613);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_arshellachelsea11@gmail.com|110.138.99.103:timer', 'i:1750346613;', 1750346613);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_b1d5781111d84f7b3fe45a0852e59758cd7a87e5', 'i:1;', 1749483742);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_b1d5781111d84f7b3fe45a0852e59758cd7a87e5:timer', 'i:1749483742;', 1749483742);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_b3f0c7f6bb763af1be91d9e74eabfeb199dc1f1f', 'i:1;', 1750407924);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_b3f0c7f6bb763af1be91d9e74eabfeb199dc1f1f:timer', 'i:1750407924;', 1750407924);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_c1dfd96eea8cc2b62785275bca38ac261256e278', 'i:2;', 1749462602);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_c1dfd96eea8cc2b62785275bca38ac261256e278:timer', 'i:1749462602;', 1749462602);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_c29f73bbaa85b6fd6e8c8b99acfd01e3', 'i:2;', 1750321931);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_c29f73bbaa85b6fd6e8c8b99acfd01e3:timer', 'i:1750321931;', 1750321931);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_c422ce5b7b9a1221be821ea45d5684d8', 'i:1;', 1750404687);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_c422ce5b7b9a1221be821ea45d5684d8:timer', 'i:1750404687;', 1750404687);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_c50e7dbc53398136738dfd69b7119498', 'i:1;', 1750407600);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_c50e7dbc53398136738dfd69b7119498:timer', 'i:1750407600;', 1750407600);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_chelsea@gmail.com|110.138.99.103', 'i:1;', 1750346957);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_chelsea@gmail.com|110.138.99.103:timer', 'i:1750346957;', 1750346957);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_d885ea107d92af64c0b822b98b479c47', 'i:1;', 1749786154);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_d885ea107d92af64c0b822b98b479c47:timer', 'i:1749786154;', 1749786154);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:1;', 1749437958);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1749437958;', 1749437958);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_ed83ab7cfb8f214749666d1fa5c254c9', 'i:1;', 1750410370);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_ed83ab7cfb8f214749666d1fa5c254c9:timer', 'i:1750410370;', 1750410370);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_f3687070fb5bebd2d1ef2d1f15e9b5eb', 'i:1;', 1750409131);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_f3687070fb5bebd2d1ef2d1f15e9b5eb:timer', 'i:1750409131;', 1750409131);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_nadintazahira@gmail.com|202.58.72.214', 'i:1;', 1749466310);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_nadintazahira@gmail.com|202.58.72.214:timer', 'i:1749466310;', 1749466310);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_zahwa.fatima05@gmail.com|110.138.97.213', 'i:1;', 1749903135);
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('toko_alwa_kue_cache_zahwa.fatima05@gmail.com|110.138.97.213:timer', 'i:1749903135;', 1749903135);





INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2025_03_11_231202_add_two_factor_columns_to_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2025_03_17_010533_create_product_categories_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(6, '2025_03_17_010605_create_products_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2025_03_22_013801_create_shop_statuses_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '2025_03_28_040736_create_orders_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(9, '2025_03_28_040758_create_order_details_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '2025_03_28_040821_create_order_statuses_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(11, '2025_03_28_040913_create_carts_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(12, '2025_05_06_232204_add_snap_token_to_orders_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(13, '2025_05_13_223653_create_site_settings_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(14, '2025_06_01_235707_create_product_promotions_table', 1);

INSERT INTO `order_statuses` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Menunggu Pembayaran', NULL, NULL);
INSERT INTO `order_statuses` (`id`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Menunggu Verifikasi', NULL, NULL);
INSERT INTO `order_statuses` (`id`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Dalam Proses', NULL, NULL);
INSERT INTO `order_statuses` (`id`, `status`, `created_at`, `updated_at`) VALUES
(4, 'Delivery', NULL, NULL);
INSERT INTO `order_statuses` (`id`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Selesai', NULL, NULL);
INSERT INTO `order_statuses` (`id`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Ditolak', NULL, NULL);
INSERT INTO `order_statuses` (`id`, `status`, `created_at`, `updated_at`) VALUES
(7, 'Dibatalkan', NULL, NULL);


INSERT INTO `product_categories` (`id`, `name`, `description`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'Kue Kering', 'Aneka kue renyah seperti nastar dan kastengel, cocok untuk camilan dan sajian saat hari besar.', 'product_categories/JUK3YbU7ifL5z4Cjl13JAy2UTSfysDYivZVHsiRI.jpg', '2025-06-08 05:09:52', '2025-06-13 04:29:27');
INSERT INTO `product_categories` (`id`, `name`, `description`, `image_path`, `created_at`, `updated_at`) VALUES
(2, 'Kue Basah', 'Kue tradisional lembut dan lezat disajikan segar setiap hari.', 'product_categories/Jfjum1AQxkk9FNSAnXzqwljbXAS8PUKH8ckVczYc.jpg', '2025-06-09 02:11:19', '2025-06-20 00:58:18');
INSERT INTO `product_categories` (`id`, `name`, `description`, `image_path`, `created_at`, `updated_at`) VALUES
(4, 'Kue Tart', 'Kue tart adalah kue berlapis yang dihias dengan krim, fondant, atau buah, biasanya disajikan untuk perayaan seperti ulang tahun atau pernikahan.', 'product_categories/8GLDwu90ieEv8AbqyoSsv86RSBNnHUbfF74P6ksx.jpg', '2025-06-20 01:01:24', '2025-06-20 01:01:24');
INSERT INTO `product_promotions` (`id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 4, NULL, '2025-06-20 09:10:35');
INSERT INTO `product_promotions` (`id`, `product_id`, `created_at`, `updated_at`) VALUES
(2, 4, NULL, '2025-06-20 07:16:40');
INSERT INTO `product_promotions` (`id`, `product_id`, `created_at`, `updated_at`) VALUES
(3, 3, NULL, '2025-06-20 01:25:16');
INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `image_path`, `created_at`, `updated_at`) VALUES
(1, 'Kue Nastar 500g', 'Kue Nastar', 1, 50000, 'products/t9GM7MWSoEiH0tunnxSEhoMEt5qMLqslRAaKKqPb.jpg', '2025-06-08 05:11:23', '2025-06-20 01:10:50');
INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `image_path`, `created_at`, `updated_at`) VALUES
(2, 'Kue Muffin', 'mantul harga/pcs', 2, 3000, 'products/XxVsHUtgX5hLUMuIXGwTOfsXFBGfhsj8m5q2uXi2.jpg', '2025-06-13 04:34:39', '2025-06-20 05:43:20');
INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `image_path`, `created_at`, `updated_at`) VALUES
(3, 'Fruit Pie', 'Pie dengan toping buah yang segar harga/pcs', 2, 3500, 'products/FLOhX8E1qG3ZabZGHayFhFcnStcjBXtKjn2fuXg2.jpg', '2025-06-20 00:43:41', '2025-06-20 05:43:38');
INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `image_path`, `created_at`, `updated_at`) VALUES
(4, 'Putri Salju 500g', 'Kue kering yang lembut dengan toping gula halus, harga/pcs', 1, 45000, 'products/UwSRfU6DHCgMFvJ4vM6ZTIniCoZPl8IRyQsWqAlp.jpg', '2025-06-20 00:48:51', '2025-06-20 05:52:42');
INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `image_path`, `created_at`, `updated_at`) VALUES
(5, 'Kastengel 500g', 'Menggunakan Keju pilihan', 1, 50000, 'products/clL1oAWWv3QtCJYEmkrT4Y9j80Jw42oVBL8S7mDO.jpg', '2025-06-20 00:50:58', '2025-06-20 05:52:58');
INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `image_path`, `created_at`, `updated_at`) VALUES
(6, 'Brownis Lumer', 'kue cokelat lembut dengan bagian tengah yang meleleh saat dipotong, manis dan nikmat disantap hangat. harga/pcs', 2, 2000, 'products/9i1kzZXD3GhXX6QtZxC2zlkmLCmLvvImYl1Tv0v7.jpg', '2025-06-20 00:56:11', '2025-06-20 05:44:13');
INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `image_path`, `created_at`, `updated_at`) VALUES
(7, 'Brownies Lapis', 'kue cokelat bertekstur lembut yang disusun dalam beberapa lapisan, sering dikombinasikan dengan keju atau varian rasa lainnya. harga/pcs', 2, 2000, 'products/sJaUsnHdkGTuramIpg6DPt8IIoxNpoCe9S1Y7qlh.jpg', '2025-06-20 00:58:00', '2025-06-20 05:44:34');
INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `image_path`, `created_at`, `updated_at`) VALUES
(8, 'Lemper Ayam', 'camilan tradisional dari ketan yang diisi suwiran ayam berbumbu, dibungkus daun pisang dan dikukus.\r\nharga/pcs', 2, 2000, 'products/J5IwZ8QcZBZ9wZN2jvdclpb9gkySfR6wpOzJmOV5.jpg', '2025-06-20 01:13:55', '2025-06-20 05:45:01');
INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `image_path`, `created_at`, `updated_at`) VALUES
(11, 'Kue Tart karakter (Batman)', 'Kue tart karakter (Batman) adalah kue tart yang dihias dengan tema Batman, menggunakan krim, fondant, atau cetakan karakter untuk tampilan menarik, cocok untuk pesta anak-anak.', 4, 250000, 'products/SbWwZ3ek9CtEZyo8GM8lVRe68MAUI12fk8orfZkZ.jpg', '2025-06-20 01:31:29', '2025-06-20 01:31:29');
INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `image_path`, `created_at`, `updated_at`) VALUES
(12, 'Pinkky cake', 'Kue tart pinky cake adalah kue tart berwarna dominan pink, biasanya dihias dengan tema feminin seperti bunga, pita, atau karakter lucu, cocok untuk ulang tahun atau acara spesial.', 4, 150000, 'products/GcObdrwRskZLUUrMle3AHedmcaeqrVs7uPTASQ8U.jpg', '2025-06-20 01:36:48', '2025-06-20 01:36:48');
INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `image_path`, `created_at`, `updated_at`) VALUES
(13, 'Kue Tart (Teachers Day)', 'Kue tart Teachers Day adalah kue spesial yang dibuat untuk merayakan Hari Guru, biasanya dihias dengan tema pendidikan seperti papan tulis, buku, atau ucapan terima kasih.', 4, 150000, 'products/KgPKJtJHD8MX7rqHFZ5szllFewfDexTHYZZs0GHY.jpg', '2025-06-20 01:40:15', '2025-06-20 01:40:15');
INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `image_path`, `created_at`, `updated_at`) VALUES
(14, 'Bolen Pisang', 'Bolen pisang adalah kue pastry berlapis yang berisi pisang, sering dipadukan dengan cokelat atau keju, dan dipanggang hingga renyah di luar dan lembut di dalam.\r\nharga/pcs', 2, 3000, 'products/VJmtUFp2prjjcGDr64PstiMK3xUZixAx1tUfNBZY.jpg', '2025-06-20 01:47:00', '2025-06-20 05:45:26');
INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `image_path`, `created_at`, `updated_at`) VALUES
(16, 'Kue Tart Karakter (Frozen)', 'Kue tart karakter (Frozen) adalah kue tart yang dihias dengan tema film Frozen, menampilkan tokoh seperti Elsa dan Anna, dengan dominasi warna biru dan putih, cocok untuk pesta anak-anak.', 4, 200000, 'products/0ItauQIreVQFuzlK0guEp0l5kWlh6zEf2rkVEmcG.jpg', '2025-06-20 05:37:36', '2025-06-20 05:37:36');
INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `image_path`, `created_at`, `updated_at`) VALUES
(17, 'Kue Tart Custom', 'kue yang dibuat sesuai permintaan, baik dari segi desain, rasa, ukuran, maupun tema, sehingga bisa disesuaikan dengan momen atau keinginan pelanggan.', 4, 100000, 'products/JsvGIPRAEGN3VUyEh3r2wj4Wk7Ed5VXEfrJQpSZt.jpg', '2025-06-20 05:39:41', '2025-06-20 05:39:41');
INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `image_path`, `created_at`, `updated_at`) VALUES
(18, 'Kue Tart karakter (Hello Kity)', 'kue yang dihias dengan tema Hello Kitty, biasanya berwarna pink dan putih, dengan dekorasi lucu yang cocok untuk pesta anak-anak.', 4, 125000, 'products/vPBosaaTZgX0tHdJH7sDinoonCkrzzeE0BnCfiV9.jpg', '2025-06-20 05:48:02', '2025-06-20 05:48:02');
INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `image_path`, `created_at`, `updated_at`) VALUES
(19, 'Kacang Wijen 500g', 'camilan manis berbentuk bulat kecil, terbuat dari adonan tepung dan kacang, dilapisi biji wijen, lalu digoreng hingga renyah dan gurih.', 1, 45000, 'products/XRQ33b29o7xacGdmTCMTw10a6PycbeQSppHF3kbB.jpg', '2025-06-20 05:49:30', '2025-06-20 05:49:30');
INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `image_path`, `created_at`, `updated_at`) VALUES
(20, 'Semprit Susu 500g', 'camilan manis berbentuk bulat kecil, terbuat dari adonan tepung dan kacang, dilapisi biji wijen, lalu digoreng hingga renyah dan gurih.', 1, 45000, 'products/M2qH7uGivjX5xJAbXBhIQ0hegbdHZ9ryZoFVN2pz.jpg', '2025-06-20 05:50:36', '2025-06-20 05:59:36');
INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `image_path`, `created_at`, `updated_at`) VALUES
(21, 'Semprit Garut 500g', 'kue kering tradisional yang terbuat dari tepung garut, berbentuk bunga dengan tekstur renyah dan rasa manis lembut.', 1, 45000, 'products/dFE7VFtAz2i8eCVOQNUpRirgxf55JhDboGk5sES6.jpg', '2025-06-20 05:51:29', '2025-06-20 05:59:55');
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('16ZIjvX9hQJzO1gn4QicMNbI3n3Hu23IkKyV950J', NULL, '170.106.140.151', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUjRxVjFGUFdTZVpBZHZiR050TlROUTZFY3FsSTRhRkRZY0gySnRFbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750443698);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2UjlGozNiqlbEvkPCPy3mydZNdDyUU0Wq5sSSY2e', NULL, '43.134.163.26', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidFc4dmdyaHpvTEJLenFoa09ZblM2OXM1QmU1MXF4T3F6R0UzUFkydCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750455554);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3YvMxDyT0UPzBfjxkPcQ5QRjc17jlwEH1Xfc5PqG', NULL, '176.53.220.22', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/94.0.4606.61 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibG5TcW9mNldvSWJsTmNKcHdHWkZzUVJBMlRSZ1RqUGl0RnpIZ2NoVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750405865);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5FyAsdwt2oLedLydfLtvFz2z0CE9aewwti6siEbB', 2, '120.188.84.223', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWHkwc1cyQXNOaGdLa0tkSzlxVkNLSllNNTRiNE9QaFpaaWs0QVBWWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9zdXBlcmFkbWluL3Nob3BzdGF0dXMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1750410680);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5g5ueAHBxo6m955z7DdZPFejwdecnhsSJw2Pglxb', 4, '114.125.111.3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYUdGWkJZc3dMN2RtS1dCMlM4T1V3U3JXV0ZtNnBWNlB6R3kyVk10RCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9ob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1750408951);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6bKEKXWvcyvjrobBKlTi0EjhC2cwydUy3I6H7pIn', 2, '182.4.133.52', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOW80cDQ1Zkc4bGg1MGxIUml4cXlPTUUyTWhGWVZSTGtNSGNFNnBQTCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9zdXBlcmFkbWluL3Byb2R1Y3Q/cGFnZT0yIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1750410186);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6PZU4h7r6XwatuIHB17IWw1g1tK9fZv8djJpVPR7', 20, '120.188.84.223', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicmNreHlwb2ZkV3V5QjdKcjVacXVTVnNEbmJNNXI2elpIVDFMZlVhayI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9wcm9kdWN0LzQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyMDt9', 1750410698);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6r74iPzV6HNKPGTzr1vrOlHyh3ab6q4tL3YCi579', NULL, '175.45.186.197', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZGRNSEhRR3dCMnVqM1ZiQWxHZXVUNEJZbDNhcjdXQlU5UnZ4bnNvMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750404393);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6UsbhhDQjrqYWtioQCDAKNoJCwpyz6QaZZzAXuRH', NULL, '103.116.13.228', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQW84am1aTkVBd0hvMHUybHJuR2g4bFlIQ0hsZEVCM0ZuMTMwdlBabyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoxNzI6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9lbWFpbC92ZXJpZnkvMTgvZWViOTNhN2YyODNiYzIxNTYzODBjNDc3YzU3MDg0YjkyMmQ2Yzg5Nz9leHBpcmVzPTE3NTA0MTA3OTMmc2lnbmF0dXJlPThiNmUxNmY3NmIxMWZmN2Y5NGIxMmE0NGNmNzZiMTY5NmE5MWQwNDljYWJhNjllZDU0ZjVkNTJlZWIwMDMxMDgiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cHM6Ly9hbHdha3VlLnN0b3JlL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750408306);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8HJpwcMyH0YX1l4tzoaKw2wtJ7k1ojzny1dKFfes', NULL, '43.156.32.91', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibjVKZjU3cEhsQTA3bzdFcGtJbFhTekZBTzk0OHZ5U2U1SVJ3cVZnOSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750448439);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('9T3b3pQMcFwjngYvhj1kPp2JNmd15QTPAEvfksfe', NULL, '2600:1f18:fde:726e:8c3:62c3:26f8:af00', 'Iframely/1.3.1 (+https://iframely.com/docs/about) Canva', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTEVGVkMwb2V3OEF1NWZTSFZaMnZjSlhsaW1VdE4wZFV3M1Y3OUxQTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750405399);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('aHOO1p1K78R2lXo3GnyZz6QIyBeexWVFZI67Obou', NULL, '49.51.205.73', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieGRQM2ZqTnJ3THZTSWpLc3FJMjRCTDhwNXFLQm9oeVdLb1hXUXVRUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750426918);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('AyraqhopTjERlUgxpHwRcxpi2P1LIQLfpizYjcAR', NULL, '103.189.123.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicnpuY0F3b3ZEOHRRMXhZUGN0aVdEUDFUUUhMckViWENPUEF0ZXNYaiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoxNzI6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9lbWFpbC92ZXJpZnkvMTkvZTEyYWM2YWRhYzRmNTZjNGMxMzkzNDY4MGZhZjliNjY0N2U0ODFiNj9leHBpcmVzPTE3NTA0MTEwODgmc2lnbmF0dXJlPThmZmVlNjEwNDM5MjhiMTBlMmVhNWY1MjU3YzM0MzExODQxM2IxZmZiZGM2MTFlOWQ0ZGJiOGUyYTcyYjdmYjciO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cHM6Ly9hbHdha3VlLnN0b3JlL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750409373);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('b3NpETl9BzeiIhdG4NkKOE7kRH0YK5Jv7h5O6CMt', NULL, '43.156.32.91', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaVgyRFBxaExkaUdJd01KM2M4VXlycHhocGdMZ3B2RzI2N1RVMlVMeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750407974);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('BKSJZEky9XGrErj1yDF2BtnqpTDU6ksCulYWyADj', NULL, '36.92.231.70', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaWtVWkM2T1lrNjNTRHBaaURwMkZEYWNIdUVTdnNxSlQ4UmlVOWFtViI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoxNzI6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9lbWFpbC92ZXJpZnkvMTgvZWViOTNhN2YyODNiYzIxNTYzODBjNDc3YzU3MDg0YjkyMmQ2Yzg5Nz9leHBpcmVzPTE3NTA0MTA3OTMmc2lnbmF0dXJlPThiNmUxNmY3NmIxMWZmN2Y5NGIxMmE0NGNmNzZiMTY5NmE5MWQwNDljYWJhNjllZDU0ZjVkNTJlZWIwMDMxMDgiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cHM6Ly9hbHdha3VlLnN0b3JlL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750408303);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('brGOS0zwAyxNNa6jrRwUfAN86XoWLrKydeMUyYwS', NULL, '117.103.171.6', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTXJEZzk0T3l6OHhjMWhxdjRrNURUZkhxY0FCaVhkUFhuTjdQQmdXWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9wcm9kdWN0L2NhdGVnb3J5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750407517);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('BTml48qfKVPG91VQfKkgef5YKSl9NtjyUb66Zxrd', NULL, '36.92.231.72', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMHBXYUZDa1ZqMU9hZ2FSRWlTMVhLUkgxcjNnbURicDVBcWVHM082VyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoxNzI6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9lbWFpbC92ZXJpZnkvMTgvZWViOTNhN2YyODNiYzIxNTYzODBjNDc3YzU3MDg0YjkyMmQ2Yzg5Nz9leHBpcmVzPTE3NTA0MTA3OTMmc2lnbmF0dXJlPThiNmUxNmY3NmIxMWZmN2Y5NGIxMmE0NGNmNzZiMTY5NmE5MWQwNDljYWJhNjllZDU0ZjVkNTJlZWIwMDMxMDgiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cHM6Ly9hbHdha3VlLnN0b3JlL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750408595);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('cbYclGoV681cZvgubhPcVPIsBBm2MFFE9QGYGhUg', 2, '114.5.108.19', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUzNFQXlnUVo1azJzQ3MwbUk0TmlzVHB4SkFQVGhlSUpMUnpyRE1BSyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9zdXBlcmFkbWluL29yZGVyIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1750409380);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Cd626xaHXmu074JwFhI2sZPGlk1OdWdVDaKATrqd', NULL, '43.156.126.238', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN3lhV0o2N0pyclU3MUNxZndyRTJLdm5PSHlvR2FlU1EzV0VBazZEdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750417389);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('CkOX2Adr1dpWxt7mm604VA4dgnFXlhsRAAaQcxLU', NULL, '66.249.71.135', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.7151.103 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieEx0bkxQUWRuQ0pBNHNVMU5kR3RIM2RMdkJUdlg5RFRaeTRMeElUZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750444309);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('d72D0oiUP1x5qt6XRbymQPbflVgvKXqS10uDRrkY', NULL, '175.45.186.197', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYTF6ZFpqZm5mVW5oeTZ4YVdBR2RjeVphbWJpM1c1NHBoVGt3OEE5OSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9wcm9kdWN0L2NhdGVnb3J5Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750407500);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('DU2cYFifeOHPSgy60GlA4nHejPVa8EjPAqHl3iXp', NULL, '117.103.171.8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN2Z1endYd1ZldEtiejc4RVExRng4RmQ0VWUwWVJ3TUtpV3ZLUXB3VCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoxNzI6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9lbWFpbC92ZXJpZnkvMjAvZTM3MWUxYmJhMzMxZDFmYzQ0NTU1NjgwYWNhZGFiYzNhN2I1OWY5Nj9leHBpcmVzPTE3NTA0MTE2MzMmc2lnbmF0dXJlPTE3MDA1NGQ3MzMwODZlZGY3YzU5ZmJjOWY4NGMxMzM3YTk0ODZhN2NlYWJiZDEyZWQ1OGEwMjExNjU4ZGE5OWEiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cHM6Ly9hbHdha3VlLnN0b3JlL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750408368);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('DvAHoX410CdLaju32tJkXMP2b9bqKpRMZCuNgqb1', NULL, '2001:4ba0:cafe:b2c::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36 Edg/91.0.864.54', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVFBZakFiTHJnWDVYcEk4WEtzME5rREptTGdhT2lWdDBYeUlZOFd5VSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750405756);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('eZ6c3Y7Y0rKUreJNo4aaGtDxFPitNOkAIINCbtlT', NULL, '43.156.126.238', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidHZPV2pXeXJ3N1N2ZVZONkVoc0Q2bG5BbGJkSVJseXJzbXpDUjJiYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750405620);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('FKIXJpZ3sknoZxkAEavBpIO0BDghSFXpUVOWY3Rz', NULL, '114.5.99.222', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZXlFbjJDN0ltOUhFelhZWEIxREdvMzVJVG1GMEt5RVhrcTc1c2tPdCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9ob21lIjt9fQ==', 1750404843);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('FNJ0kkd719sJmZmsmAub8AnAEAZ6n2rhbQnVUzgR', NULL, '43.163.6.141', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTzh0blRiQThBZXA1Z2Vvcm5YQU1NSHBjMHBHTlhVMkdPRE1uU004ZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750422159);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('g2QWWHg2L0FyEXsbMFOBQlw49QZKTSfttAjerWE6', NULL, '114.5.99.222', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ1hrdWZ6d3Z3WFlvN1BwNHg3Z2JCc0tNa3U2VlRYQ0hqVVJDbkFNTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750407468);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('gdQkzGZ6pVcQZJ35MZf8LEoRrELwYhxm9EBNY0pO', NULL, '170.106.140.151', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZ3pFTFQ0VFlsNUJ0d2c2aXdWdmF3Y29Zdllja2Myd1MyWkREWlM2diI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750446066);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('gPX9UENB3uuvsDwTert6Y63GznA5Do8Zk4ZJqs00', NULL, '66.249.68.66', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR0FhRFNkZjRjRG1mZURubWdaMGthSXlldU5MQlRZYmhNcEthWll2RiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750412295);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('gWXNx08z2D2kQKoehbaqDpdIDjqup5nURa3doIoG', NULL, '36.92.231.68', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibUtKNW1wZlpDMU5KTEhKWVFYcnhzTFc4YmRKN2s3NzJuVFViVEVQaCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoxNzI6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9lbWFpbC92ZXJpZnkvMTkvZTEyYWM2YWRhYzRmNTZjNGMxMzkzNDY4MGZhZjliNjY0N2U0ODFiNj9leHBpcmVzPTE3NTA0MTEwODgmc2lnbmF0dXJlPThmZmVlNjEwNDM5MjhiMTBlMmVhNWY1MjU3YzM0MzExODQxM2IxZmZiZGM2MTFlOWQ0ZGJiOGUyYTcyYjdmYjciO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cHM6Ly9hbHdha3VlLnN0b3JlL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750407920);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('GYB1SX05ARSutyWs4jdopujOmb68alhfKbPlHEsP', NULL, '138.246.253.7', 'quic-go-HTTP/3', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoicGNscUxrMUlnckRNN2M1NFNJb1NmTzVSQWJ2Q3g0U1FUYWdhR3ZJTSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750408716);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('GYrwFRO2fmqisP3pPqVqUcunyjUjrsbth2mqey4z', NULL, '150.129.59.5', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSktvU3RaU0d6ZDRSa292NXl1b3RVRHBHdkg0UjlSTXJ4c2hEeG5TQSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoxNzI6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9lbWFpbC92ZXJpZnkvMTkvZTEyYWM2YWRhYzRmNTZjNGMxMzkzNDY4MGZhZjliNjY0N2U0ODFiNj9leHBpcmVzPTE3NTA0MTEwODgmc2lnbmF0dXJlPThmZmVlNjEwNDM5MjhiMTBlMmVhNWY1MjU3YzM0MzExODQxM2IxZmZiZGM2MTFlOWQ0ZGJiOGUyYTcyYjdmYjciO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cHM6Ly9hbHdha3VlLnN0b3JlL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750408012);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Hy2W2q3ll9Rjr9zUqHNzaRi9dVJCKsR3nKcpL4mZ', NULL, '43.134.163.26', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOVNXc3JHOWkyZ09jU3Q2NTlxUm9RMFJJZVh1SlRsT0VrTzNOU2R4VCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750419809);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('if8JbjUexCn57G1U5YTFofYR4oinEa2Hm2VU9mF7', NULL, '114.5.99.222', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieHp3b3VkQnE5Yjk2aG1KMkltQWprTmxRdEFwVXNQb0VRajFjNHc3VyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0MDoiaHR0cHM6Ly9hbHdha3VlLnN0b3JlL3N1cGVyYWRtaW4vcHJvZHVjdCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI2OiJodHRwczovL2Fsd2FrdWUuc3RvcmUvaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750403805);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('IpmEIDMbVdOL1oLCTPxfRzZya4q549Zfc8brlfRG', NULL, '66.249.70.167', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia0JRNlhLU2Z3bWhJaThneUVsNUYzblRHRlhFRnhjUk1Rb2ZuNzNudSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750445277);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('jCP7oaFYVPJ0dUG9ZBXE1yx1HX2NOwNghLDGmX26', NULL, '43.156.126.238', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM1VYUG8zMjR1Z3dXTVpzdkhvbDAzWmYyaHFHQ2lDSEFMTms1THhEYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750415038);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Ji7jkCpAh6gKtx1PACFxQWMAZXIo3tsF7a2bueOx', NULL, '43.163.92.29', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoic2NHa1N0YjlRbFFhYzNhbG1VMjd3cXpSUWZZQTZvaGJWOTd3SXZjZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750431798);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Kgz3FFQZ5hw46M62MWXqlIDBZMT3wcwwKME76dEw', NULL, '36.92.231.70', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicHl4eWVscEF2WmY0YTc5dUxZR1Y3V09NMkRubW9xTmkxSnpBMGFXSyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoxNzI6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9lbWFpbC92ZXJpZnkvMTgvZWViOTNhN2YyODNiYzIxNTYzODBjNDc3YzU3MDg0YjkyMmQ2Yzg5Nz9leHBpcmVzPTE3NTA0MTA3OTMmc2lnbmF0dXJlPThiNmUxNmY3NmIxMWZmN2Y5NGIxMmE0NGNmNzZiMTY5NmE5MWQwNDljYWJhNjllZDU0ZjVkNTJlZWIwMDMxMDgiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cHM6Ly9hbHdha3VlLnN0b3JlL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750407707);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('kl60EIw1NnoOHNg2mRJ9Gaa3rYEwJh8Ya7MGQDam', NULL, '103.116.13.229', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieldQaDZCOEo5NWhiTzYxR0M0eTVUWDJrRWRLa2V3TDFIVFBvRktHMCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoxNzI6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9lbWFpbC92ZXJpZnkvMjAvZTM3MWUxYmJhMzMxZDFmYzQ0NTU1NjgwYWNhZGFiYzNhN2I1OWY5Nj9leHBpcmVzPTE3NTA0MTE2MzMmc2lnbmF0dXJlPTE3MDA1NGQ3MzMwODZlZGY3YzU5ZmJjOWY4NGMxMzM3YTk0ODZhN2NlYWJiZDEyZWQ1OGEwMjExNjU4ZGE5OWEiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cHM6Ly9hbHdha3VlLnN0b3JlL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750408377);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('lTJ2AHLqTs1Iw9LIRG7HuKHTF6fMvbIZzxjnlGDE', NULL, '66.249.71.135', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVDVmbXMzSk81VlAyN0VuN09hcXRYVlZLVlNINFBqS1k5UVBjRU9uSSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750412292);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Lwy7m2nA7rGLViXmaJgZ3CLD0AyBLZKez0Exg6K8', NULL, '66.249.71.134', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.7151.103 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTDBqTTRQZTBoWmkxQVl6SHE3WDBkdUZTdDlvZEZ6NFlXN0prZkoxaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750443133);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('mhD3yCNov5XDoCl4oBhTbJOoYqxIDKBppgTN1W0l', NULL, '170.106.140.151', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTWJzZ3QxckJSclNDR1NjSzlXc3RsT0JmNnZUVks1THY0Ylc3U0d3MyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750436575);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('NazrIXRia8TYruH1HKfljLWqpjrK9PyB76tHijbM', NULL, '43.159.135.119', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieG5FNG85Qmw2TEpMNzlUQmN0U2FxWDF2c2hZRWZST0N1dDJYcXVzUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750453186);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('NycC66xWBjDIrKByMOYYgG9qzfFwMc5YnaFTnHRv', NULL, '109.248.49.176', 'Python/3.11 aiohttp/3.11.11', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTHhBaVZsVU40SmZDQnJtYVphcjh5YWZEcUs2UEtrVXJleFBNaUk5ZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750405423);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('nYFv14DS7qddKO66lQUNXknuYcwvD8GBqcdvfIhJ', NULL, '43.159.135.119', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQUZzTWgySU5GYWV6UVBsemxOWmEyVW1wTG1QeXM1aHZOc09BUU1ESyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750434184);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('OumdTkY6ugfnZG4IuLTP9hG3Mp22E8kOefjH23iS', NULL, '66.249.79.169', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.7151.103 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTENyWThUVVZLNHB5UkhwREd5YW8xM2I3ZVdWbkVndUVVS2RhNVpGdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vd3d3LmFsd2FrdWUuc3RvcmUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1750409504);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('pCpOZUnlddVdKVoQJOkpxTsTHCsSwPpRv2AgdJb3', NULL, '43.156.126.238', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaFNiOHNiTE92RWZsWWNQWktnUTBQWkZsQzByWEtNWDVpc0o4cmtHciI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750410335);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('pgsJCqySpbdOUwKhMpPwgNVI7mwV0pmjyfRx0uYt', NULL, '170.106.140.151', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYWxleW1vanQwc0ZBU3NRejdRVVVNU0lodE5PZnRWcUhaMUdhT1M1NyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750457927);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('pQ2knp8JDrJ0NZPxEYAbjYq6faTQDpKtIK50Isk5', 19, '114.125.111.3', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoienlsSkxDa2ZWSE9MclNScjZIU1VhRWVsU2FEMERsV0RFZEVjRWV6QyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTk7czozOiJ1cmwiO2E6MDp7fX0=', 1750407865);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('pUGjYGAVvB4AwMPFxxJBwrP1KAYZbZZtWhZiTYNj', 18, '120.188.85.12', 'Mozilla/5.0 (Linux; Android 13; V2109) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/87.0.4280.141 Mobile Safari/537.36 VivoBrowser/13.3.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOGhKZURjbW1NOVd4VzlKMjlUZW5rWUZlMkNEQldPbG9kdG9IUUlnNiI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI5OiJodHRwczovL2Fsd2FrdWUuc3RvcmUvd2VsY29tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE4O30=', 1750407569);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('pYY4MVLBctgxRc6KD1UgkrlONy72VxOnNOMceR50', NULL, '38.43.64.36', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNHhzRm5WU0hUZTNrMEhFM1hYeTdYOGpXZWpzWmRBRU5kckNVREdOeSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoxNzI6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9lbWFpbC92ZXJpZnkvMTkvZTEyYWM2YWRhYzRmNTZjNGMxMzkzNDY4MGZhZjliNjY0N2U0ODFiNj9leHBpcmVzPTE3NTA0MTEwODgmc2lnbmF0dXJlPThmZmVlNjEwNDM5MjhiMTBlMmVhNWY1MjU3YzM0MzExODQxM2IxZmZiZGM2MTFlOWQ0ZGJiOGUyYTcyYjdmYjciO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czoyNzoiaHR0cHM6Ly9hbHdha3VlLnN0b3JlL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750409390);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('qcrOwlOHpoj0kYYTO8GkYv40OexJjx0JxmVMTeoN', NULL, '43.134.163.26', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicTF1ajZYS1JqMVhoajNwUXNkMEpKb0FTQVZTSFFlV1IwUklBbDY5WSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750438961);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('qtwWTgXwzOh9uM0QPVaQaRTypFSqAXnGFOHHdVmu', NULL, '43.134.163.26', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQVRYYmo5Wm5jT2N1RHVLVk9vU2pSZER2U2tzNm5uVEgyRW0xSkpKdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750424521);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('RFghbqBcUxG24JS4Z23PZonoCJJOw1KXCJe95ErN', NULL, '43.163.92.29', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRmxVR2hQc1VzT3lkR3kxWDBzMHlsWHlBeGlObEVKVlFYbXpmNnlsdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750441323);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('RkEXEWxDPVUvV471lwqyjozI8KHPmuj1gDyTSHxe', NULL, '120.188.86.80', 'Mozilla/5.0 (iPhone; CPU iPhone OS 15_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/15.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY0FUN2Vxbld5SXVJQkpXY1c4MnRiVWpUTkliM0JiYnlYeG1MMnN4SyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9wcm9kdWN0LzQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1750426389);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('SMDg795A7c3Ly5Rnk8DUDs14xJ6Op80hasPDPRbb', NULL, '148.113.202.94', 'Mozilla/5.0 (Debian; Linux x86_64; rv:121.0) Gecko/20100101 Firefox/121.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVFJKckhNNE9wMmllVE5GSGJGa1VOZjdnVFF3Y3JqYVZvVjlTTlRLTyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750459142);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('T97ZvheDbLPDgrN3qhE5hLYLcubJeG0Ju3Ld42ux', NULL, '2a03:2880:f802:b::', 'meta-externalagent/1.1 (+https://developers.facebook.com/docs/sharing/webmasters/crawler)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMGlmNlNvNzdZOUZwRVBIVFhPd1VCdGNUNWQ3bDd4c2dRajZFS21HbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750438097);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('TJe90ZuP7rJGIosyV0sXosHqOLsBIZ1jGhG9j1p3', NULL, '43.134.163.26', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSHVUNFA2QkpMYU9XRmlkR0tZRlVsOHM5ZU1HbkhjdGp5TW4zdE1zdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750450815);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('tjEbOrawp925AZ2eUltvjbIDIIfRLpEbCtF4fj03', NULL, '210.64.24.100', 'Python/3.13 aiohttp/3.12.13', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQlJRUXk2aVdTcTc5T1o4Zzc0TFFuMEczMGk1OElmSmNUajhrcVozVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750450042);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('UIWxlHeB6RM56avbiB6GaGQOY5Msy0MbFfgqfmri', NULL, '66.249.68.65', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.7151.103 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibGlNRmZUZllranZCMFJiR1VVVkNUamhQbk80NE9CUjU0OW5xOHk3RiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750412201);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('uJSDLjruTEpcGeOiMHtYRo6EAPIqLMD1Z9YbbDb5', NULL, '66.249.64.231', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.7151.103 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSzRVREREWExaQUdMckFaMDdiSnV5bWlQWWNPRUl3U3cwdjhteTJWRSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHBzOi8vd3d3LmFsd2FrdWUuc3RvcmUvcHJvZHVjdC8zIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1750448401);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('USdMHZ5BzWqoS1jo2VS0FsnRAT7zKv4V2rVxa0HA', NULL, '159.203.187.130', 'Mozilla/5.0 (X11; Linux x86_64; rv:137.0) Gecko/20100101 Firefox/137.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoienpmVFl2YWh6OUlPTDRZVFYydmc1WmhLVDZLYzFQME53a1UwVzJ1SiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750444960);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('V7g5FOmXgQtAMwQJI7yrRUeNnrgsZigGMsp7O9xO', NULL, '43.156.126.238', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSVRYZU9OY2lMaGloY2hrVHhzZlZpRU11UjBnMGMxTGtpNExCWklacyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750412688);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('VsgxHI2w2zbo0RyLKH3wFQGkDf4caJTuly5AhTOi', NULL, '43.153.87.54', 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibUNYTGttdnBrTml1Y3A0Z0VOUVFycXdTWGxRRGNyZ0hRRk9xT3ZabyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjU6Imh0dHBzOi8vd3d3LmFsd2FrdWUuc3RvcmUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1750452010);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('XfneGbMKCqG5lcOCN938RKMhLfzh6hZONSrMbph9', NULL, '66.249.70.166', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWVd3VGw1bGFwek9NemRFNFQxOVdvM3YwZTNocUVQbG9qclJCSzRGRyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750445276);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('xKVcvo79G6vqFzKnLG7rwR9iFywSKYk853To9z9a', NULL, '66.249.71.133', 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWHlkSEFtRVkycjJlYXdYTW11TEY3NFZzUW80dUNscExkV2J5akM3MSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750410315);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Y0C450EbBrPxqqgO8gumDid016AJEU06iAtkC6mS', NULL, '43.156.126.238', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOXZVY0ZkQzJEWFoxU1RwWlY2MGRheHdkRkpVY2xZd2ZmalA2SW1MZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750429442);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('yyK362x1uy36gcEqZpN2InqjiTFflB6IZTaKeHI9', NULL, '2a03:2880:f800:17::', 'meta-externalagent/1.1 (+https://developers.facebook.com/docs/sharing/webmasters/crawler)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMEw4UmlIS1pQbWJTbGtnajY2bW42SjhTS2k2bXFka3N4QnhyMXFmTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750406157);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ZSfOHGp0BqsExxjYnm6556CKRNBWnsSX1wNSGsdZ', NULL, '66.249.68.66', 'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 5X Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/99.0.4844.84 Mobile Safari/537.36 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaGxCWW1IWUREb2VwODJiOHVMckl6cjVrUVFaNjBXUmR4M05XT0x4cCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHBzOi8vYWx3YWt1ZS5zdG9yZS9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1750410316);
INSERT INTO `shop_statuses` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'closed', 'Toko sedang tutup, anda tida bisa melakukan pemesanan!', NULL, '2025-06-20 09:11:19');
INSERT INTO `site_settings` (`id`, `shop_name`, `logo_path`, `home_background_path`, `about_banner_path`, `shop_email`, `slogan`, `about_us`, `promotion_paragraph`, `phone`, `address`, `facebook_name`, `facebook_link`, `twitter_name`, `twitter_link`, `instagram_name`, `instagram_link`, `copyright_text`, `created_at`, `updated_at`) VALUES
(1, 'Toko Alwa Kue', 'site-logos/sbZSkTAxCLwlOUmO1pDuch0SmxndYaXh0k9CfWp7.png', NULL, 'about-banners/d67R0RAHfpaeodnZsMRdf3DYB47WWtTLnnLriZYa.jpg', 'tokoaalwa@gmail.com', 'Apapun acaranya, Alwa Kue Solusinya', 'ALWA KUE merupakan toko kue di Tulungagung yang menyediakan berbagai macam aneka Snack, Cookies, Tart, Kue Tradisional, Paket Snack, dan masih banyak lagi produk yang kami tawarkan. Kini, ALWA KUE hadir di Sebalor, Kec. Bandung, Kabupaten Tulungagung, Jawa Timur 66274. Kami juga melayani pemesanan secara online melalui WhatsApp dan Instagram. Dengan tema “APAPUN ACARANYA, ALWA KUE SOLUSINYA”, kami siap melayani segala kebutuhan Sahabat ALWA.', 'Discover our new premium Specialty Product. The perfect fusion of innovative design and timeless flavors. Enjoy intricate layers, delicate textures, and balanced flavours in every bite', '085875206802', 'Sirah Kandang, Jl. Sebalor, Kec. Bandung, Kabupaten Tulungagung, Jawa Timur 66274.', 'Alwa kue', 'https://www.facebook.com/alwa.kue', 'MyAwesomeShopTW', 'https://twitter.com/MyAwesomeShopTW', 'alwa_kue', 'https://www.instagram.com/alwa_kue/', '2025 Alwa Kue', '2025-06-08 03:42:46', '2025-06-20 08:43:59');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `phone`, `usertype`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '2025-06-08 03:42:45', '$2y$12$hZstqe4mL8xwy3kESzG.CuW3ZA050G69zGwiMnGQrAKHp0Sbi8b9K', NULL, NULL, NULL, '', 'admin', NULL, NULL, NULL, NULL);
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `phone`, `usertype`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'superadmin', 'superadmin@gmail.com', '2025-06-08 03:42:45', '$2y$12$Dnls/UwTqkLLoo7MUcYC9.U7tvTO6fDU5jOeNUWYou4ywt8Dj0NkK', NULL, NULL, NULL, '', 'superadmin', NULL, 'bHU1tH8uqiJ7wvW2h5fwcd5pJ0IRJkpnwMSsuLxQ4Avo19DKMATFe7Cijps0', NULL, NULL);
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `phone`, `usertype`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'costumer', 'costumer@gmail.com', '2025-06-08 03:42:46', '$2y$12$E6HBYxS1LtedtjinWYzF3uvSTU5dI9RnOGhWzirM5pPzH7MjV3aXm', NULL, NULL, NULL, '088811112222', 'costumer', NULL, NULL, NULL, NULL);


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;