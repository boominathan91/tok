-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.25-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for tok_box
CREATE DATABASE IF NOT EXISTS `tok_box` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `tok_box`;

-- Dumping structure for table tok_box.chat_group_details
CREATE TABLE IF NOT EXISTS `chat_group_details` (
  `chat_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('1-1','1-m') NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`chat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table tok_box.chat_group_details: ~0 rows (approximately)
/*!40000 ALTER TABLE `chat_group_details` DISABLE KEYS */;
INSERT IGNORE INTO `chat_group_details` (`chat_id`, `type`, `session_id`, `status`, `created_at`, `last_updated`) VALUES
	(1, '1-1', '1_MX40NjE0NTM1Mn4xMi4zNC41Ni43OH4xNTMwNzk2MTQ4MTY4fnZiZkhKWXlER003VVF0ck9rNkx2NzcwMX5Qfg', 1, '2018-07-05 18:39:08', '2018-07-05 18:39:08');
/*!40000 ALTER TABLE `chat_group_details` ENABLE KEYS */;

-- Dumping structure for table tok_box.chat_members
CREATE TABLE IF NOT EXISTS `chat_members` (
  `chat_member_id` int(11) NOT NULL AUTO_INCREMENT,
  `chat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`chat_member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table tok_box.chat_members: ~0 rows (approximately)
/*!40000 ALTER TABLE `chat_members` DISABLE KEYS */;
INSERT IGNORE INTO `chat_members` (`chat_member_id`, `chat_id`, `user_id`, `status`, `created_at`, `last_updated`) VALUES
	(1, 1, 2, 1, '2018-07-05 18:39:08', '2018-07-05 18:39:08'),
	(2, 1, 1, 2, '2018-07-05 18:39:08', '2018-07-05 18:39:08');
/*!40000 ALTER TABLE `chat_members` ENABLE KEYS */;

-- Dumping structure for table tok_box.user_details
CREATE TABLE IF NOT EXISTS `user_details` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table tok_box.user_details: ~4 rows (approximately)
/*!40000 ALTER TABLE `user_details` DISABLE KEYS */;
INSERT IGNORE INTO `user_details` (`user_id`, `session_id`, `created_at`, `last_updated`) VALUES
	(1, '1_MX40NjE0NTM1Mn4xMi4zNC41Ni43OH4xNTMwNzcyMjY5MzE0', '2018-07-05 12:01:09', '2018-07-05 12:01:09'),
	(2, '1_MX40NjE0NTM1Mn4xMi4zNC41Ni43OH4xNTMwNzcyMjg4NTIx', '2018-07-05 12:01:28', '2018-07-05 12:01:28'),
	(3, '2_MX40NjE0NTM1Mn4xMi4zNC41Ni43OH4xNTMwNzcyMjk1OTk2', '2018-07-05 12:01:36', '2018-07-05 12:01:36'),
	(4, '2_MX40NjE0NTM1Mn4xMi4zNC41Ni43OH4xNTMwNzcyMzM2Njg2', '2018-07-05 12:02:16', '2018-07-05 12:02:16');
/*!40000 ALTER TABLE `user_details` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
