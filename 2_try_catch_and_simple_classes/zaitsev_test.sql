CREATE DATABASE IF NOT EXISTS `zaitsev_test` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `zaitsev_test`;

CREATE TABLE IF NOT EXISTS `action_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `action_type` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'New, responsive actions', NULL, NULL),
	(2, 'Commitment or goals', NULL, NULL),
	(3, 'Ongoing actions', NULL, NULL),
	(4, 'Dialogue or additional info for consumers', NULL, NULL),
	(5, 'Dialogue or partnership with organization', NULL, NULL),
	(6, 'Past actions', NULL, NULL),
	(7, 'Internal or external standards', NULL, NULL);

