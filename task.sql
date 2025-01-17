-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for t1
CREATE DATABASE IF NOT EXISTS `t1` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `t1`;

-- Dumping structure for table t1.addresses
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `city_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  CONSTRAINT `city_id` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table t1.addresses: ~5 rows (approximately)
INSERT INTO `addresses` (`id`, `city_id`, `name`, `first_name`, `email`, `street`, `zip`, `created_at`, `updated_at`) VALUES
	(36, 24, 'James K. Naron', 'James', 'JamesKNaron@armyspy.com', '3552 Matthews Street', '61032', '2025-01-17 06:27:30', '2025-01-17 00:57:30'),
	(37, 31, 'Dwayne J. Waters', 'Dwayne', 'DwayneJWaters@rhyta.com', '4201 Clay Road', '80014', '2025-01-17 06:28:06', '2025-01-17 00:58:06'),
	(38, 37, 'Teri P. Mosley', 'Teri', 'TeriPMosley@rhyta.com', '1463 Still Pastures Drive', '29841', '2025-01-17 06:28:30', '2025-01-17 00:58:30'),
	(39, 21, 'Benjamin A. Lillibridge', 'Benjamin', 'BenjaminALillibridge@teleworm.us', '2327 Coulter Lane', '23219', '2025-01-17 06:28:55', '2025-01-17 00:58:55'),
	(40, 18, 'Daniel P. Ragsdale', 'Daniel', 'DanielPRagsdale@dayrep.com', '1730 Heather Sees Way', '74360', '2025-01-17 06:29:24', '2025-01-17 00:59:24');

-- Dumping structure for table t1.cities
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int NOT NULL AUTO_INCREMENT,
  `city_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table t1.cities: ~50 rows (approximately)
INSERT INTO `cities` (`id`, `city_name`, `created_at`, `updated_at`) VALUES
	(1, 'Yuping', '2024-08-15 23:59:13', '2024-03-13 11:10:26'),
	(2, 'Balzar', '2024-11-30 09:00:40', '2024-03-29 15:53:16'),
	(3, 'Oganlima', '2024-06-07 19:35:48', '2024-11-30 23:47:32'),
	(4, 'Buenavista', '2024-10-14 10:21:21', '2024-03-20 05:33:27'),
	(5, 'Oyama', '2024-05-15 17:43:24', '2024-11-22 04:52:57'),
	(6, 'Cojutepeque', '2024-03-23 04:55:48', '2024-11-04 10:21:43'),
	(7, 'Zhentian', '2024-03-20 02:04:36', '2024-12-25 13:30:34'),
	(8, 'Prvost', '2024-05-15 20:54:10', '2024-08-07 02:50:35'),
	(9, 'Ciputat', '2024-02-05 08:12:05', '2025-01-03 17:41:42'),
	(10, 'Fukuma', '2024-07-23 21:21:03', '2024-08-17 11:47:21'),
	(11, 'Menghe', '2024-05-10 18:40:47', '2024-10-12 09:54:23'),
	(12, 'Sekampung', '2024-04-01 23:23:38', '2024-03-05 01:31:47'),
	(13, 'Klippan', '2024-10-05 14:13:55', '2024-03-17 06:40:22'),
	(14, 'Taganrog', '2024-11-25 21:49:52', '2024-02-17 07:37:43'),
	(15, 'Candijay', '2024-12-07 01:30:23', '2024-08-12 09:04:46'),
	(16, 'Palmares', '2024-02-05 00:08:47', '2024-06-07 12:09:03'),
	(17, 'Hola Prystan', '2024-03-23 01:39:35', '2024-10-18 10:09:13'),
	(18, 'Tullinge', '2024-10-04 23:53:37', '2024-07-04 15:30:01'),
	(19, 'Ucimw Stary', '2024-04-23 19:05:09', '2024-01-29 16:01:34'),
	(20, 'Zaliznychne', '2024-03-11 14:33:41', '2024-09-29 20:30:55'),
	(21, 'Malec', '2025-01-03 18:50:11', '2024-08-28 14:52:31'),
	(22, 'Luoao', '2024-06-01 21:20:26', '2024-03-05 16:27:04'),
	(23, 'San Andrs Xecul', '2024-07-03 21:23:33', '2024-02-03 06:26:32'),
	(24, 'Butere', '2024-11-19 14:16:45', '2024-09-30 01:02:31'),
	(25, 'Lydenburg', '2024-01-26 18:33:14', '2024-08-02 17:58:42'),
	(26, 'Churovichi', '2024-06-04 18:40:03', '2024-03-23 11:10:21'),
	(27, 'Duas Igrejas', '2024-10-23 19:52:41', '2025-01-10 21:29:58'),
	(28, 'Alibago', '2025-01-12 05:12:30', '2024-10-16 11:10:43'),
	(29, 'Minyue', '2024-12-17 15:33:45', '2024-04-24 20:23:52'),
	(30, 'Jiesheng', '2024-12-19 03:03:08', '2024-03-31 17:24:43'),
	(31, 'Novi Kneevac', '2024-02-14 03:04:22', '2024-11-01 05:27:48'),
	(32, 'Vinkkil', '2024-12-31 23:16:57', '2024-05-30 22:03:26'),
	(33, 'San Jernimo', '2024-10-18 02:48:48', '2025-01-06 19:13:33'),
	(34, 'Atalaia', '2024-04-28 22:00:29', '2024-05-02 11:09:53'),
	(35, 'Noebesa', '2024-11-16 05:29:15', '2024-06-23 16:24:59'),
	(36, 'Qingyang', '2025-01-11 05:40:26', '2024-11-04 11:16:56'),
	(37, 'Kristinestad', '2024-05-03 10:19:29', '2024-05-30 23:36:04'),
	(38, 'El Potrero', '2024-06-23 15:56:17', '2024-05-27 06:44:30'),
	(39, 'Tiyingtali Kelod', '2024-09-14 14:00:57', '2024-04-27 16:15:53'),
	(40, 'Lukou', '2024-08-18 10:00:21', '2024-04-20 18:10:58'),
	(41, 'Muonio', '2024-09-21 11:05:44', '2024-03-05 06:40:22'),
	(42, 'Lisakovsk', '2024-03-06 22:16:31', '2024-03-06 23:07:54'),
	(43, 'Aioi', '2024-09-13 05:19:54', '2024-04-17 14:33:18'),
	(44, 'Makoua', '2024-11-17 01:03:12', '2024-12-23 05:14:54'),
	(45, 'Kekeri', '2024-12-24 21:04:59', '2024-07-03 20:10:40'),
	(46, 'Richmond', '2025-01-06 02:49:55', '2024-11-17 11:38:26'),
	(47, 'FleurylesAubrais', '2025-01-02 12:17:05', '2024-12-20 10:46:13'),
	(48, 'Raszowa', '2024-03-12 18:26:25', '2024-11-08 07:13:40'),
	(49, 'Astorga', '2024-02-20 01:30:47', '2024-09-09 21:27:25'),
	(50, 'Sanxiang', '2024-02-01 01:02:48', '2024-06-04 13:32:58');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
