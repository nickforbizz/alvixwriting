-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.37-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for chamaa
CREATE DATABASE IF NOT EXISTS `chamaa` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `chamaa`;

-- Dumping structure for table chamaa.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `admin_level` int(11) DEFAULT '0' COMMENT '0="normal member", 1="admin", 2="super admin"',
  `active` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_members_users` (`user_id`),
  CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table chamaa.admins: ~0 rows (approximately)
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`id`, `user_id`, `admin_level`, `active`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(2, 2, 0, 1, 1, '2019-03-30 14:03:12', '2019-03-30 14:03:12', '2019-03-30 14:03:12');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;

-- Dumping structure for table chamaa.chama
CREATE TABLE IF NOT EXISTS `chama` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT '0',
  `description` text,
  `mission` text,
  `vision` text,
  `goals` text,
  `active` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table chamaa.chama: ~0 rows (approximately)
/*!40000 ALTER TABLE `chama` DISABLE KEYS */;
INSERT INTO `chama` (`id`, `name`, `description`, `mission`, `vision`, `goals`, `active`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'default', 'the default chama group', NULL, NULL, NULL, 1, 1, '2019-03-27 21:55:24', '2019-03-27 21:55:24', '2019-03-27 21:55:26'),
	(2, 'wanadada', 'tunaweza sisi kama wamama', 'we are better than em nigros', 'kill all niggas', 'be richest', 0, 1, '2019-03-28 09:10:42', '2019-03-28 09:10:42', '2019-03-28 12:10:42');
/*!40000 ALTER TABLE `chama` ENABLE KEYS */;

-- Dumping structure for table chamaa.chama_acc
CREATE TABLE IF NOT EXISTS `chama_acc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chama_id` int(11) NOT NULL DEFAULT '0',
  `credit` int(11) DEFAULT '0',
  `debit` int(11) DEFAULT '0',
  `active` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_chama_acc_chama` (`chama_id`),
  CONSTRAINT `FK_chama_acc_chama` FOREIGN KEY (`chama_id`) REFERENCES `chama` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table chamaa.chama_acc: ~0 rows (approximately)
/*!40000 ALTER TABLE `chama_acc` DISABLE KEYS */;
/*!40000 ALTER TABLE `chama_acc` ENABLE KEYS */;

-- Dumping structure for table chamaa.chama_notifications
CREATE TABLE IF NOT EXISTS `chama_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) DEFAULT '0',
  `description` text,
  `active` int(11) DEFAULT '1',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_notifications_members` (`member_id`),
  CONSTRAINT `FK_notifications_members` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table chamaa.chama_notifications: ~2 rows (approximately)
/*!40000 ALTER TABLE `chama_notifications` DISABLE KEYS */;
INSERT INTO `chama_notifications` (`id`, `member_id`, `name`, `description`, `active`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 'the chama will start today', 'i want chama', 1, 1, '2019-03-30 11:46:55', '2019-03-30 08:46:55', '2019-03-30 11:46:55'),
	(2, 2, 'test Notification', 'Sample description', 1, 1, '2019-03-30 11:49:03', '2019-03-30 11:49:03', '2019-03-30 11:49:03');
/*!40000 ALTER TABLE `chama_notifications` ENABLE KEYS */;

-- Dumping structure for table chamaa.contribution
CREATE TABLE IF NOT EXISTS `contribution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT '0',
  `date_due` timestamp NULL DEFAULT NULL,
  `description` text,
  `active` int(11) DEFAULT '1',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_contributions_members` (`member_id`),
  KEY `FK_contributions_contribution_categories` (`category_id`),
  CONSTRAINT `FK_contributions_contribution_categories` FOREIGN KEY (`category_id`) REFERENCES `contribution_categories` (`id`),
  CONSTRAINT `FK_contributions_members` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table chamaa.contribution: ~9 rows (approximately)
/*!40000 ALTER TABLE `contribution` DISABLE KEYS */;
INSERT INTO `contribution` (`id`, `member_id`, `category_id`, `amount`, `date_due`, `description`, `active`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(2, 1, 1, 100, NULL, 'test', 1, 1, '2019-03-28 10:12:02', '2019-03-28 10:12:02', '2019-03-28 13:12:02'),
	(3, 1, 1, 300, NULL, 'test normal', 1, 1, '2019-03-28 10:20:14', '2019-03-28 10:20:14', '2019-03-28 13:20:14'),
	(4, 1, 1, 300, NULL, 'test normal', 1, 1, '2019-03-28 10:20:22', '2019-03-28 10:20:22', '2019-03-28 13:20:22'),
	(5, 1, 1, 300, NULL, 'testnormal', 1, 1, '2019-03-28 10:20:36', '2019-03-28 10:20:36', '2019-03-28 13:20:36'),
	(6, 1, 1, 3089, NULL, 'akiba yang', 1, 1, '2019-03-28 10:30:02', '2019-03-28 10:30:02', '2019-03-28 13:30:02'),
	(7, 2, 4, 400, '2019-04-30 07:38:58', 'descprition tests', 1, 1, '2019-03-30 07:38:58', '2019-03-30 07:38:58', '2019-03-30 10:38:58'),
	(8, 2, 2, 500, '2019-04-30 07:40:29', 'descprition tests for fuliza', 1, 1, '2019-03-30 07:40:29', '2019-03-30 07:40:29', '2019-03-30 10:40:29'),
	(9, 2, 2, 1000, '2019-04-30 07:47:26', 'misc tests', 1, 1, '2019-03-30 07:47:26', '2019-03-30 07:47:26', '2019-03-30 10:47:26'),
	(10, 2, 2, 2000, '2019-04-30 07:56:41', 'descprition savings tests', 1, 1, '2019-03-30 07:56:41', '2019-03-30 07:56:41', '2019-03-30 10:56:41');
/*!40000 ALTER TABLE `contribution` ENABLE KEYS */;

-- Dumping structure for table chamaa.contribution_categories
CREATE TABLE IF NOT EXISTS `contribution_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT '0',
  `description` text,
  `active` int(11) DEFAULT '1',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table chamaa.contribution_categories: ~5 rows (approximately)
/*!40000 ALTER TABLE `contribution_categories` DISABLE KEYS */;
INSERT INTO `contribution_categories` (`id`, `name`, `description`, `active`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'test1', 'descprition test', 0, 1, '2019-03-30 02:30:55', '2019-03-29 23:30:55', '2019-03-30 02:30:55'),
	(2, 'Nik is Boss', 'I said That Madam Gakii knows', 1, 1, '2019-03-30 03:05:04', '2019-03-30 00:05:04', '2019-03-30 03:05:04'),
	(4, 'test 3', 'descprition tests', 1, 1, '2019-03-30 00:03:11', '2019-03-30 00:03:11', '2019-03-30 03:03:11'),
	(5, 'test 3', 'descprition tests', 0, 1, '2019-03-30 03:05:16', '2019-03-30 00:05:16', '2019-03-30 03:05:16'),
	(6, 'test 4', 'descprition tests 1', 1, 1, '2019-03-30 00:04:28', '2019-03-30 00:04:28', '2019-03-30 03:04:28');
/*!40000 ALTER TABLE `contribution_categories` ENABLE KEYS */;

-- Dumping structure for table chamaa.guest_suggestions
CREATE TABLE IF NOT EXISTS `guest_suggestions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT '0',
  `email` varchar(100) DEFAULT '0',
  `subject` varchar(100) DEFAULT '0',
  `description` text,
  `active` int(11) DEFAULT '1',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table chamaa.guest_suggestions: ~0 rows (approximately)
/*!40000 ALTER TABLE `guest_suggestions` DISABLE KEYS */;
INSERT INTO `guest_suggestions` (`id`, `name`, `email`, `subject`, `description`, `active`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'jymo', 'jymo@kj.ds', 'fffffffsf', 'sdsfsafswvsefsdf', 1, 1, '2019-03-27 18:24:07', '2019-03-27 18:24:07', '2019-03-27 21:24:07');
/*!40000 ALTER TABLE `guest_suggestions` ENABLE KEYS */;

-- Dumping structure for table chamaa.loan_requested
CREATE TABLE IF NOT EXISTS `loan_requested` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL DEFAULT '0',
  `amount` int(11) DEFAULT NULL,
  `approve` int(11) DEFAULT '0',
  `active` int(11) DEFAULT '1',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_normal_contributions_contributions` (`member_id`),
  CONSTRAINT `loan_requested_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table chamaa.loan_requested: ~2 rows (approximately)
/*!40000 ALTER TABLE `loan_requested` DISABLE KEYS */;
INSERT INTO `loan_requested` (`id`, `member_id`, `amount`, `approve`, `active`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 300, 0, 1, 1, '2019-03-30 03:30:57', '2019-03-30 03:30:57', '2019-03-30 03:30:57');
/*!40000 ALTER TABLE `loan_requested` ENABLE KEYS */;

-- Dumping structure for table chamaa.loan_withdrawals
CREATE TABLE IF NOT EXISTS `loan_withdrawals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `withdrawal_id` int(11) NOT NULL DEFAULT '0',
  `date_due` timestamp NULL DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_normal_contributions_contributions` (`withdrawal_id`),
  CONSTRAINT `loan_withdrawals_ibfk_1` FOREIGN KEY (`withdrawal_id`) REFERENCES `withdrawals` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table chamaa.loan_withdrawals: ~2 rows (approximately)
/*!40000 ALTER TABLE `loan_withdrawals` DISABLE KEYS */;
INSERT INTO `loan_withdrawals` (`id`, `withdrawal_id`, `date_due`, `active`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 72, NULL, 1, 1, '2019-03-28 20:46:19', '2019-03-28 20:46:19', '2019-03-28 23:46:19'),
	(2, 75, NULL, 1, 1, '2019-03-28 20:48:37', '2019-03-28 20:48:37', '2019-03-28 23:48:37');
/*!40000 ALTER TABLE `loan_withdrawals` ENABLE KEYS */;

-- Dumping structure for table chamaa.members
CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `member_level` int(11) DEFAULT '0' COMMENT '0="normal member", 1="admin", 2="super admin"',
  `active` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_members_users` (`user_id`),
  CONSTRAINT `FK_members_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table chamaa.members: ~4 rows (approximately)
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` (`id`, `user_id`, `member_level`, `active`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 4, 0, 1, 1, '2019-03-29 22:54:51', '2019-03-29 19:54:51', '2019-03-29 22:54:51'),
	(2, 2, 0, 1, 1, '2019-03-30 07:50:20', '2019-03-30 07:50:21', '2019-03-30 07:50:22'),
	(3, 5, 0, 0, 1, '2019-03-30 15:06:55', '2019-03-30 15:06:55', '2019-03-30 15:06:55'),
	(4, 9, 0, 0, 1, '2019-03-30 15:06:53', '2019-03-30 15:06:53', '2019-03-30 15:06:53');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;

-- Dumping structure for table chamaa.member_acc
CREATE TABLE IF NOT EXISTS `member_acc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL DEFAULT '0',
  `credit` int(11) DEFAULT NULL,
  `debit` int(11) DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_normal_contributions_contributions` (`member_id`),
  CONSTRAINT `member_acc_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table chamaa.member_acc: ~0 rows (approximately)
/*!40000 ALTER TABLE `member_acc` DISABLE KEYS */;
INSERT INTO `member_acc` (`id`, `member_id`, `credit`, `debit`, `active`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 4, 1, 1, 1, '2019-03-28 23:52:24', '2019-03-28 23:52:24', '2019-03-28 23:52:24');
/*!40000 ALTER TABLE `member_acc` ENABLE KEYS */;

-- Dumping structure for table chamaa.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table chamaa.migrations: ~0 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table chamaa.miscalleneous_contributions
CREATE TABLE IF NOT EXISTS `miscalleneous_contributions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contribution_id` int(11) NOT NULL DEFAULT '0',
  `active` int(11) DEFAULT '1',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_normal_contributions_contributions` (`contribution_id`),
  CONSTRAINT `miscalleneous_contributions_ibfk_1` FOREIGN KEY (`contribution_id`) REFERENCES `contribution` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table chamaa.miscalleneous_contributions: ~1 rows (approximately)
/*!40000 ALTER TABLE `miscalleneous_contributions` DISABLE KEYS */;
INSERT INTO `miscalleneous_contributions` (`id`, `contribution_id`, `active`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(2, 2, 1, 1, '2019-03-28 10:12:02', '2019-03-28 10:12:02', '2019-03-28 13:12:02'),
	(3, 9, 1, 1, '2019-03-30 07:47:26', '2019-03-30 07:47:26', '2019-03-30 10:47:26');
/*!40000 ALTER TABLE `miscalleneous_contributions` ENABLE KEYS */;

-- Dumping structure for table chamaa.normal_contributions
CREATE TABLE IF NOT EXISTS `normal_contributions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contribution_id` int(11) NOT NULL DEFAULT '0',
  `active` int(11) DEFAULT '1',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_normal_contributions_contributions` (`contribution_id`),
  CONSTRAINT `FK_normal_contributions_contributions` FOREIGN KEY (`contribution_id`) REFERENCES `contribution` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table chamaa.normal_contributions: ~4 rows (approximately)
/*!40000 ALTER TABLE `normal_contributions` DISABLE KEYS */;
INSERT INTO `normal_contributions` (`id`, `contribution_id`, `active`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 3, 0, 1, '2019-03-30 11:54:06', '2019-03-30 08:54:06', '2019-03-30 11:54:06'),
	(2, 4, 0, 1, '2019-03-30 08:50:39', '2019-03-30 05:50:39', '2019-03-30 08:50:39'),
	(3, 5, 1, 1, '2019-03-30 08:49:06', '2019-03-30 08:49:06', '2019-03-30 08:49:06'),
	(4, 7, 1, 1, '2019-03-30 07:38:58', '2019-03-30 07:38:58', '2019-03-30 10:38:58'),
	(5, 8, 1, 1, '2019-03-30 07:40:29', '2019-03-30 07:40:29', '2019-03-30 10:40:29');
/*!40000 ALTER TABLE `normal_contributions` ENABLE KEYS */;

-- Dumping structure for table chamaa.payout_withdrawals
CREATE TABLE IF NOT EXISTS `payout_withdrawals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `withdrawal_id` int(11) NOT NULL DEFAULT '0',
  `active` int(11) DEFAULT '1',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_normal_contributions_contributions` (`withdrawal_id`),
  CONSTRAINT `payout_withdrawals_ibfk_1` FOREIGN KEY (`withdrawal_id`) REFERENCES `withdrawals` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table chamaa.payout_withdrawals: ~3 rows (approximately)
/*!40000 ALTER TABLE `payout_withdrawals` DISABLE KEYS */;
INSERT INTO `payout_withdrawals` (`id`, `withdrawal_id`, `active`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(3, 6, 1, 1, '2019-03-28 16:07:23', '2019-03-28 16:07:23', '2019-03-28 19:07:23'),
	(4, 7, 1, 1, '2019-03-28 16:09:06', '2019-03-28 16:09:06', '2019-03-28 19:09:06');
/*!40000 ALTER TABLE `payout_withdrawals` ENABLE KEYS */;

-- Dumping structure for table chamaa.penalties
CREATE TABLE IF NOT EXISTS `penalties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) DEFAULT NULL,
  `date_due` timestamp NULL DEFAULT NULL,
  `description` text,
  `active` int(11) DEFAULT '1',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_contributions_members` (`member_id`),
  KEY `FK_contributions_contribution_categories` (`category_id`),
  CONSTRAINT `penalties_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `penalty_categories` (`id`),
  CONSTRAINT `penalties_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table chamaa.penalties: ~8 rows (approximately)
/*!40000 ALTER TABLE `penalties` DISABLE KEYS */;
INSERT INTO `penalties` (`id`, `member_id`, `category_id`, `date_due`, `description`, `active`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 1, NULL, 'lateness', 1, 1, '2019-03-28 21:17:42', '2019-03-28 21:17:42', '2019-03-29 00:17:42'),
	(2, 2, 3, NULL, NULL, 1, 1, '2019-03-30 10:21:54', '2019-03-30 10:21:54', '2019-03-30 13:21:54'),
	(3, 1, 1, NULL, NULL, 1, 1, '2019-03-30 10:24:00', '2019-03-30 10:24:00', '2019-03-30 13:24:00'),
	(4, 1, 1, NULL, NULL, 1, 1, '2019-03-30 10:24:51', '2019-03-30 10:24:51', '2019-03-30 13:24:51'),
	(5, 1, 4, NULL, NULL, 1, 1, '2019-03-30 10:25:57', '2019-03-30 10:25:57', '2019-03-30 13:25:57'),
	(6, 1, 4, NULL, NULL, 1, 1, '2019-03-30 10:29:23', '2019-03-30 10:29:23', '2019-03-30 13:29:23'),
	(7, 1, 4, NULL, NULL, 1, 1, '2019-03-30 10:30:21', '2019-03-30 10:30:21', '2019-03-30 13:30:21'),
	(8, 1, 4, NULL, 'abrahcadabra', 1, 1, '2019-03-30 10:33:33', '2019-03-30 10:33:33', '2019-03-30 13:33:33'),
	(9, 1, 5, '2019-04-30 10:34:39', 'peeded', 1, 1, '2019-03-30 10:34:39', '2019-03-30 10:34:39', '2019-03-30 13:34:39');
/*!40000 ALTER TABLE `penalties` ENABLE KEYS */;

-- Dumping structure for table chamaa.penalty_categories
CREATE TABLE IF NOT EXISTS `penalty_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT '0',
  `description` text,
  `amount` int(11) DEFAULT '0',
  `active` int(11) DEFAULT '1',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table chamaa.penalty_categories: ~4 rows (approximately)
/*!40000 ALTER TABLE `penalty_categories` DISABLE KEYS */;
INSERT INTO `penalty_categories` (`id`, `name`, `description`, `amount`, `active`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'test penalty 1 edit', 'penalty test description s', 50, 1, 1, '2019-03-30 13:21:32', '2019-03-30 10:21:32', '2019-03-30 13:21:32'),
	(2, 'sdf', 'Its gaza da', 0, 1, 1, '2019-03-30 12:26:28', '2019-03-30 09:26:28', '2019-03-30 12:26:28'),
	(3, 'lateness', 'kdjfhkrugb;as', 0, 1, 1, '2019-03-30 04:26:03', '2019-03-30 04:26:03', '2019-03-30 07:26:03'),
	(4, 'truancy', 'abrahcadabra', 0, 1, 1, '2019-03-30 08:54:54', '2019-03-30 08:54:54', '2019-03-30 11:54:54'),
	(5, 'jay', 'peeded', 3000, 1, 1, '2019-03-30 10:15:17', '2019-03-30 10:15:17', '2019-03-30 13:15:17');
/*!40000 ALTER TABLE `penalty_categories` ENABLE KEYS */;

-- Dumping structure for table chamaa.savings_contributions
CREATE TABLE IF NOT EXISTS `savings_contributions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contribution_id` int(11) NOT NULL DEFAULT '0',
  `active` int(11) DEFAULT '1',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_normal_contributions_contributions` (`contribution_id`),
  CONSTRAINT `savings_contributions_ibfk_1` FOREIGN KEY (`contribution_id`) REFERENCES `contribution` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table chamaa.savings_contributions: ~0 rows (approximately)
/*!40000 ALTER TABLE `savings_contributions` DISABLE KEYS */;
INSERT INTO `savings_contributions` (`id`, `contribution_id`, `active`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 6, 1, 1, '2019-03-28 10:30:02', '2019-03-28 10:30:02', '2019-03-28 13:30:02'),
	(2, 10, 1, 1, '2019-03-30 07:56:41', '2019-03-30 07:56:41', '2019-03-30 10:56:41');
/*!40000 ALTER TABLE `savings_contributions` ENABLE KEYS */;

-- Dumping structure for table chamaa.suggestions
CREATE TABLE IF NOT EXISTS `suggestions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) DEFAULT '0',
  `description` text,
  `active` int(11) DEFAULT '1',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_suggestions_members` (`member_id`),
  CONSTRAINT `FK_suggestions_members` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table chamaa.suggestions: ~2 rows (approximately)
/*!40000 ALTER TABLE `suggestions` DISABLE KEYS */;
INSERT INTO `suggestions` (`id`, `member_id`, `name`, `description`, `active`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 1, 'the chama', 'i want chama', 1, 1, '2019-03-28 21:29:05', '2019-03-28 21:29:05', '2019-03-29 00:29:05'),
	(2, 2, 'test 1', 'Sample description', 1, 1, '2019-03-30 08:10:45', '2019-03-30 08:10:45', '2019-03-30 11:10:45'),
	(3, 2, 'lunch alllowances', 'uyafvbogvb;jvn;vuhdvn ;', 1, 1, '2019-03-30 08:57:22', '2019-03-30 08:57:22', '2019-03-30 11:57:22');
/*!40000 ALTER TABLE `suggestions` ENABLE KEYS */;

-- Dumping structure for table chamaa.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chama_id` int(11) NOT NULL DEFAULT '0',
  `national_id` int(11) DEFAULT NULL,
  `phone_number` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `gender` varchar(100) DEFAULT 'other',
  `password` text,
  `fname` varchar(100) DEFAULT NULL,
  `sname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `remember_token` text,
  `active` int(11) DEFAULT '1',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `national_id` (`national_id`),
  UNIQUE KEY `phone_number` (`phone_number`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  KEY `FK_users_chama` (`chama_id`),
  CONSTRAINT `FK_users_chama` FOREIGN KEY (`chama_id`) REFERENCES `chama` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table chamaa.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `chama_id`, `national_id`, `phone_number`, `email`, `username`, `gender`, `password`, `fname`, `sname`, `lname`, `remember_token`, `active`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(2, 1, 3456743, 3456778, 'john@yahoo.com', 'john', 'Female', '$2y$10$NS9Lx4fLblWi3ZrqiQaLj.bgl9LR1bTufCxxtG/Z4.F4ldOCZMtTi', 'john', 'nick', 'phod', '3IfWI0ZuOrzAg9q1xxKcGQJLLLOcOQIHesGr45q8PuGu7VCxkOS3tLpLAX5C', 1, 1, '2019-03-31 09:26:24', '2019-03-31 09:26:24', '2019-03-31 09:26:24'),
	(4, 1, 3434343, 123456789, 'kenedymunyui@gmail.com', 'allanoh', 'Male', '$2y$10$cHqI/SicIkfI0TSbBUIbD.Q8HqNHM54Om.0r0k94dANu0ms9tJuuG', 'Allan', 'Gaaki', 'Njeri ko', NULL, 1, 1, '2019-03-30 14:00:19', '2019-03-30 11:00:19', '2019-03-30 14:00:19'),
	(5, 2, 35457, 34578768, 'nicholaswaruingi@gmail.com', '@mombexent', 'Male', NULL, 'Nick', 'Mombex guru', 'Mombex', NULL, 1, 1, '2019-03-30 11:33:25', '2019-03-30 11:33:25', '2019-03-30 14:33:25'),
	(9, 2, 3457678, 3467, 'mombex@gmail.com', '@nikoo', 'Male', NULL, 'Nick', 'Mombex guru', 'Mombex', NULL, 1, 1, '2019-03-30 11:48:09', '2019-03-30 11:48:09', '2019-03-30 14:48:09');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table chamaa.withdrawals
CREATE TABLE IF NOT EXISTS `withdrawals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT '0',
  `description` text,
  `paid` int(11) DEFAULT '0',
  `active` int(11) DEFAULT '1',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_contributions_members` (`member_id`),
  KEY `FK_contributions_contribution_categories` (`category_id`),
  CONSTRAINT `withdrawals_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `withdraw_categories` (`id`),
  CONSTRAINT `withdrawals_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table chamaa.withdrawals: ~10 rows (approximately)
/*!40000 ALTER TABLE `withdrawals` DISABLE KEYS */;
INSERT INTO `withdrawals` (`id`, `member_id`, `category_id`, `amount`, `description`, `paid`, `active`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(6, 1, 1, 300, 'test  payouts', NULL, 1, 1, '2019-03-28 16:07:23', '2019-03-28 16:07:23', '2019-03-28 19:07:23'),
	(7, 1, 1, 300, 'test  payouts', NULL, 1, 1, '2019-03-28 16:09:06', '2019-03-28 16:09:06', '2019-03-28 19:09:06'),
	(72, 1, 1, 600, 'test  payouts', NULL, 1, 1, '2019-03-28 20:46:19', '2019-03-28 20:46:19', '2019-03-28 23:46:19'),
	(75, 2, 1, 1000, 'test  payouts', NULL, 1, 1, '2019-03-30 08:13:36', '2019-03-30 08:13:36', '2019-03-30 08:13:36'),
	(98, 1, NULL, 600, 'The User Has Been Paid His or Her Amount', 1, 1, 1, '2019-03-30 05:36:40', '2019-03-30 05:36:40', '2019-03-30 08:36:40'),
	(99, 1, NULL, 600, 'The User Has Been Paid His or Her Amount', 1, 1, 1, '2019-03-30 05:37:10', '2019-03-30 05:37:10', '2019-03-30 08:37:10'),
	(103, 1, NULL, 600, 'The User Has Been Paid His or Her Amount', 1, 1, 1, '2019-03-30 05:47:30', '2019-03-30 05:47:30', '2019-03-30 08:47:30'),
	(105, 1, NULL, 600, 'The User Has Been Paid His or Her Amount', 1, 1, 1, '2019-03-30 05:48:48', '2019-03-30 05:48:48', '2019-03-30 08:48:48'),
	(106, 1, 2, 600, 'The User Has Been Paid His or Her Amount', 1, 1, 1, '2019-03-30 05:50:39', '2019-03-30 05:50:39', '2019-03-30 08:50:39'),
	(107, 1, 1, 600, 'The User Has Been Paid His or Her Amount', 1, 1, 1, '2019-03-30 08:54:06', '2019-03-30 08:54:06', '2019-03-30 11:54:06');
/*!40000 ALTER TABLE `withdrawals` ENABLE KEYS */;

-- Dumping structure for table chamaa.withdraw_categories
CREATE TABLE IF NOT EXISTS `withdraw_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT '0',
  `description` text,
  `active` int(11) DEFAULT '1',
  `status` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table chamaa.withdraw_categories: ~7 rows (approximately)
/*!40000 ALTER TABLE `withdraw_categories` DISABLE KEYS */;
INSERT INTO `withdraw_categories` (`id`, `name`, `description`, `active`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'loans', 'descprition test 2', 1, 1, '2019-03-30 02:12:17', '2019-03-29 23:12:17', '2019-03-30 02:12:17'),
	(2, 'fgx', 'nick u\'ll awesome', 1, 1, '2019-03-30 02:16:18', '2019-03-29 23:16:18', '2019-03-30 02:16:18'),
	(3, 'sdf', 'dsf', 1, 1, '2019-03-29 20:51:44', '2019-03-29 20:51:44', '2019-03-29 23:51:44'),
	(4, 'sdfffg', 'dsf', 1, 1, '2019-03-29 20:53:25', '2019-03-29 20:53:25', '2019-03-29 23:53:25'),
	(5, 'Articles', 'fsdfsd grzg', 1, 1, '2019-03-29 20:54:09', '2019-03-29 20:54:09', '2019-03-29 23:54:09'),
	(6, 'Research paper', 'dsf dfdf', 1, 1, '2019-03-29 20:57:04', '2019-03-29 20:57:04', '2019-03-29 23:57:04'),
	(7, 'descprition test', 'loans', 1, 1, '2019-03-29 22:58:03', '2019-03-29 22:58:03', '2019-03-30 01:58:03'),
	(8, 'sdf', 'well iy', 1, 1, '2019-03-30 02:12:31', '2019-03-29 23:12:31', '2019-03-30 02:12:31');
/*!40000 ALTER TABLE `withdraw_categories` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
