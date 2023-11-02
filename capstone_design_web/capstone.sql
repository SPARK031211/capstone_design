-- --------------------------------------------------------
-- 호스트:                          127.0.0.1
-- 서버 버전:                        10.4.28-MariaDB - mariadb.org binary distribution
-- 서버 OS:                        Win64
-- HeidiSQL 버전:                  12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- capstone 데이터베이스 구조 내보내기
CREATE DATABASE IF NOT EXISTS `capstone` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `capstone`;

-- 테이블 capstone.capstone_py 구조 내보내기
CREATE TABLE IF NOT EXISTS `capstone_py` (
  `people_count` int(11) unsigned NOT NULL DEFAULT 0,
  `area_size` float unsigned NOT NULL DEFAULT 0,
  `status` text NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`datetime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 테이블 데이터 capstone.capstone_py:~9 rows (대략적) 내보내기
REPLACE INTO `capstone_py` (`people_count`, `area_size`, `status`, `datetime`) VALUES
	(36, 167.344, 'Safety', '2023-10-15 06:09:00'),
	(35, 167.344, 'Safety', '2023-10-15 06:10:00'),
	(41, 167.344, 'Safety', '2023-10-15 06:11:00'),
	(36, 167.344, 'Safety', '2023-10-15 06:12:00'),
	(30, 167.344, 'Safety', '2023-10-15 06:13:00'),
	(38, 167.344, 'Warning', '2023-10-15 06:14:00'),
	(12, 167.344, 'Warning', '2023-10-15 06:15:00'),
	(24, 167.344, 'Safety', '2023-10-15 06:16:00'),
	(1, 167.344, 'Warning', '2023-10-16 01:09:16'),
	(14, 167.344, 'Warning', '2023-10-16 01:10:19');

-- 테이블 capstone.users 구조 내보내기
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'User',
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 테이블 데이터 capstone.users:~2 rows (대략적) 내보내기
REPLACE INTO `users` (`id`, `username`, `password`, `ipaddress`, `role`, `created_at`) VALUES
	(1, 'admin', '$2y$10$mrozHDf405HFAukpoXOWf.vt0G95egkrhLNoa/jxnITRjr7mTv4Bi', '127.0.0.1', 'Admin', '2023-10-30 02:08:24'),
	(2, 'user', '$2y$10$0/U1kY4TptsgIqjC88aWaeEd4DiQob0zxm.cDwPgYgMAtj/IMTZzi', '127.0.0.1', 'User', '2023-10-30 02:09:33');

-- 테이블 capstone.user_signin_log 구조 내보내기
CREATE TABLE IF NOT EXISTS `user_signin_log` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `connected_id` int(11) NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 테이블 데이터 capstone.user_signin_log:~76 rows (대략적) 내보내기
REPLACE INTO `user_signin_log` (`idx`, `connected_id`, `ipaddress`, `datetime`) VALUES
	(1, 1, '127.0.0.1', '2023-10-30 00:07:39'),
	(2, 1, '127.0.0.1', '2023-10-30 00:08:03'),
	(3, 2, '127.0.0.1', '2023-10-30 00:08:23'),
	(4, 1, '127.0.0.1', '2023-10-30 00:40:19'),
	(5, 1, '127.0.0.1', '2023-10-30 00:40:32'),
	(6, 1, '127.0.0.1', '2023-10-30 00:40:38'),
	(7, 1, '127.0.0.1', '2023-10-30 00:40:48'),
	(8, 1, '127.0.0.1', '2023-10-30 01:51:07'),
	(9, 1, '127.0.0.1', '2023-10-30 01:51:45'),
	(10, 1, '127.0.0.1', '2023-10-30 01:52:32'),
	(11, 1, '127.0.0.1', '2023-10-30 01:52:42'),
	(12, 1, '127.0.0.1', '2023-10-30 01:52:43'),
	(13, 1, '127.0.0.1', '2023-10-30 01:52:58'),
	(14, 1, '127.0.0.1', '2023-10-30 01:53:28'),
	(15, 1, '127.0.0.1', '2023-10-30 01:53:39'),
	(16, 1, '127.0.0.1', '2023-10-30 01:54:32'),
	(17, 1, '127.0.0.1', '2023-10-30 01:54:52'),
	(18, 1, '127.0.0.1', '2023-10-30 01:55:40'),
	(19, 1, '127.0.0.1', '2023-10-30 01:55:45'),
	(20, 1, '127.0.0.1', '2023-10-30 01:55:50'),
	(21, 1, '127.0.0.1', '2023-10-30 01:55:51'),
	(22, 1, '127.0.0.1', '2023-10-30 01:56:36'),
	(23, 1, '127.0.0.1', '2023-10-30 01:56:39'),
	(24, 1, '127.0.0.1', '2023-10-30 01:56:40'),
	(25, 1, '127.0.0.1', '2023-10-30 01:56:40'),
	(26, 1, '127.0.0.1', '2023-10-30 01:56:40'),
	(27, 1, '127.0.0.1', '2023-10-30 01:56:43'),
	(28, 1, '127.0.0.1', '2023-10-30 01:56:44'),
	(29, 1, '127.0.0.1', '2023-10-30 01:56:45'),
	(30, 1, '127.0.0.1', '2023-10-30 01:56:46'),
	(31, 1, '127.0.0.1', '2023-10-30 01:56:58'),
	(32, 1, '127.0.0.1', '2023-10-30 01:56:58'),
	(33, 1, '127.0.0.1', '2023-10-30 01:56:59'),
	(34, 1, '127.0.0.1', '2023-10-30 01:56:59'),
	(35, 1, '127.0.0.1', '2023-10-30 01:56:59'),
	(36, 1, '127.0.0.1', '2023-10-30 01:57:13'),
	(37, 1, '127.0.0.1', '2023-10-30 01:57:13'),
	(38, 1, '127.0.0.1', '2023-10-30 01:57:18'),
	(39, 1, '127.0.0.1', '2023-10-30 01:57:32'),
	(40, 1, '127.0.0.1', '2023-10-30 01:58:28'),
	(41, 1, '127.0.0.1', '2023-10-30 01:59:23'),
	(42, 1, '127.0.0.1', '2023-10-30 01:59:39'),
	(43, 1, '127.0.0.1', '2023-10-30 01:59:46'),
	(44, 1, '127.0.0.1', '2023-10-30 02:00:47'),
	(45, 1, '127.0.0.1', '2023-10-30 02:02:38'),
	(46, 1, '127.0.0.1', '2023-10-30 02:02:42'),
	(47, 1, '127.0.0.1', '2023-10-30 02:02:43'),
	(48, 1, '127.0.0.1', '2023-10-30 02:02:44'),
	(49, 1, '127.0.0.1', '2023-10-30 02:03:53'),
	(50, 1, '127.0.0.1', '2023-10-30 02:08:30'),
	(51, 2, '127.0.0.1', '2023-10-30 02:09:37'),
	(52, 2, '127.0.0.1', '2023-10-30 02:19:13'),
	(53, 2, '127.0.0.1', '2023-10-30 02:21:10'),
	(54, 2, '127.0.0.1', '2023-10-30 02:24:17'),
	(55, 2, '127.0.0.1', '2023-10-30 02:28:01'),
	(56, 1, '127.0.0.1', '2023-10-30 02:37:03'),
	(57, 1, '127.0.0.1', '2023-10-30 02:37:34'),
	(58, 1, '127.0.0.1', '2023-10-30 02:38:18'),
	(59, 1, '127.0.0.1', '2023-10-31 01:13:53'),
	(60, 3, '127.0.0.1', '2023-10-31 01:33:24'),
	(61, 1, '127.0.0.1', '2023-10-31 22:44:48'),
	(62, 2, '127.0.0.1', '2023-10-31 23:46:31'),
	(63, 1, '127.0.0.1', '2023-11-01 00:11:36'),
	(64, 2, '127.0.0.1', '2023-11-01 00:17:14'),
	(65, 1, '127.0.0.1', '2023-11-01 00:21:15'),
	(66, 2, '127.0.0.1', '2023-11-01 00:21:55'),
	(67, 2, '127.0.0.1', '2023-11-01 01:50:09'),
	(68, 1, '127.0.0.1', '2023-11-01 01:50:57'),
	(69, 5, '127.0.0.1', '2023-11-01 01:59:58'),
	(70, 4, '127.0.0.1', '2023-11-01 02:00:26'),
	(71, 7, '127.0.0.1', '2023-11-01 02:02:32'),
	(72, 1, '127.0.0.1', '2023-11-01 02:04:55'),
	(73, 1, '127.0.0.1', '2023-11-01 02:10:24'),
	(74, 4, '127.0.0.1', '2023-11-01 02:16:03'),
	(75, 4, '127.0.0.1', '2023-11-01 02:16:37'),
	(76, 1, '127.0.0.1', '2023-11-01 02:16:45'),
	(77, 1, '127.0.0.1', '2023-11-01 02:19:49');

-- 테이블 capstone.user_admin_log 구조 내보내기
CREATE TABLE IF NOT EXISTS `user_admin_log` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `connected_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 테이블 데이터 capstone.user_admin_log:~5 rows (대략적) 내보내기
REPLACE INTO `user_admin_log` (`idx`, `connected_id`, `category`, `ipaddress`, `datetime`) VALUES
	(1, 1, 'User 데이터 삭제', '127.0.0.1', '2023-11-01 01:58:21'),
	(2, 1, 'User 데이터 삭제', '127.0.0.1', '2023-11-01 01:58:48'),
	(3, 1, 'User 데이터 삭제', '127.0.0.1', '2023-11-01 01:58:57'),
	(4, 1, 'User 데이터 삭제', '127.0.0.1', '2023-11-01 01:59:20'),
	(5, 1, 'User 데이터 삭제', '127.0.0.1', '2023-11-01 02:05:04');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
