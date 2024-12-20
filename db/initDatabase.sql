-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               11.5.2-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for looper
CREATE DATABASE IF NOT EXISTS `looper` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `looper`;

-- Dumping structure for table looper.answers
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contents` text NOT NULL,
  `field_id` int(11) NOT NULL,
  `fulfillment_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `field_id` (`field_id`),
  KEY `fulfillment_id` (`fulfillment_id`),
  CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`field_id`) REFERENCES `fields` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`fulfillment_id`) REFERENCES `fulfillments` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table looper.answers: ~10 rows (approximately)
INSERT INTO `answers` (`id`, `contents`, `field_id`, `fulfillment_id`) VALUES
	(7, '', 4, 3),
	(8, 'answer the field', 5, 4),
	(9, 'fsgrdth', 11, 6),
	(10, 'dfghjk', 12, 6),
	(12, 'WHAT', 20, 8);

-- Dumping structure for table looper.exercises
CREATE TABLE IF NOT EXISTS `exercises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `exercise_status` enum('building','answering','closed') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table looper.exercises: ~8 rows (approximately)
INSERT INTO `exercises` (`id`, `title`, `exercise_status`) VALUES
	(2, 'closed2', 'closed'),
	(3, 'answering', 'closed'),
	(5, 'Test IceScrum', 'answering'),
	(7, '', 'answering'),
	(8, '2', 'answering'),
	(9, 'sgfdhfjgk', 'answering'),
	(10, 'dfsghfn', 'building'),
	(11, 'asdfgh', 'building'),
	(12, '', 'building'),
	(14, 'ABABABAB', 'closed'),
	(15, 'rdxtyjrtydfjtyr', 'building');

-- Dumping structure for table looper.fields
CREATE TABLE IF NOT EXISTS `fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(20) NOT NULL DEFAULT '0',
  `type` varchar(50) NOT NULL DEFAULT '',
  `exercises_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fields_ibfk_2` (`exercises_id`),
  CONSTRAINT `fields_ibfk_2` FOREIGN KEY (`exercises_id`) REFERENCES `exercises` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table looper.fields: ~11 rows (approximately)
INSERT INTO `fields` (`id`, `label`, `type`, `exercises_id`) VALUES
	(4, '', 'single_line', 2),
	(5, '', 'single_line', 3),
	(10, '', 'single_line', 7),
	(11, 'sZCA', 'single_line', 8),
	(12, 'hjfg', 'single_line', 8),
	(13, 'dfhjgkhshgdfjkh', 'multi_line', 9),
	(14, 'cds', 'single_line', 10),
	(15, 'htheh', 'single_line', 10),
	(16, 'jkh', 'single_line', 11),
	(17, 'djdkggdkghkhjl', 'multi_line', 11),
	(20, 'RHEA', 'single_line', 14),
	(21, 'w4treyu', 'single_line', 15);

-- Dumping structure for table looper.fulfillments
CREATE TABLE IF NOT EXISTS `fulfillments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fulfillment` datetime NOT NULL,
  `exercise_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fulfillments_ibfk_1` (`exercise_id`),
  CONSTRAINT `fulfillments_ibfk_1` FOREIGN KEY (`exercise_id`) REFERENCES `exercises` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table looper.fulfillments: ~6 rows (approximately)
INSERT INTO `fulfillments` (`id`, `fulfillment`, `exercise_id`) VALUES
	(3, '2024-11-04 04:19:28', 2),
	(4, '2024-11-05 04:59:49', 3),
	(5, '2024-12-19 20:00:35', 5),
	(6, '2024-12-19 20:00:58', 8),
	(8, '2024-12-19 21:57:33', 14);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
