-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for db_risikohipertensi
CREATE DATABASE IF NOT EXISTS `db_risikohipertensi` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_risikohipertensi`;

-- Dumping structure for table db_risikohipertensi.tb_data_training
CREATE TABLE IF NOT EXISTS `tb_data_training` (
  `id` int(100) NOT NULL,
  `umur` int(100) NOT NULL,
  `sex` varchar(2) NOT NULL,
  `td_sistol` int(255) NOT NULL,
  `td_diastol` int(255) NOT NULL,
  `lingkar_perut` int(200) NOT NULL,
  `tinggi_badan` int(3) NOT NULL,
  `berat_badan` int(150) NOT NULL,
  `bmi` int(50) NOT NULL,
  `merokok` varchar(3) NOT NULL,
  `makanan_berlemak` varchar(10) NOT NULL,
  `k_gula` varchar(10) NOT NULL,
  `k_garam` varchar(10) NOT NULL,
  `olahraga` varchar(3) NOT NULL,
  `k_kafein` varchar(10) NOT NULL,
  `risiko_hipertensi` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_risikohipertensi.tb_data_training: ~75 rows (approximately)
/*!40000 ALTER TABLE `tb_data_training` DISABLE KEYS */;
INSERT INTO `tb_data_training` (`id`, `umur`, `sex`, `td_sistol`, `td_diastol`, `lingkar_perut`, `tinggi_badan`, `berat_badan`, `bmi`, `merokok`, `makanan_berlemak`, `k_gula`, `k_garam`, `olahraga`, `k_kafein`, `risiko_hipertensi`) VALUES
	(1, 52, '1', 125, 90, 78, 1, 62, 23, '1', '0', '0', '0', '1', '2', 2),
	(2, 66, '1', 194, 114, 98, 1, 72, 27, '0', '0', '1', '1', '1', '1', 3),
	(3, 56, '1', 129, 80, 98, 1, 61, 26, '1', '0', '0', '0', '1', '1', 1),
	(4, 51, '1', 148, 97, 98, 1, 77, 28, '1', '0', '0', '1', '0', '1', 2),
	(5, 71, '0', 148, 88, 88, 1, 56, 27, '0', '0', '1', '1', '1', '3', 2),
	(6, 51, '1', 115, 83, 70, 1, 62, 25, '0', '0', '0', '0', '1', '2', 1),
	(7, 55, '1', 170, 96, 97, 1, 67, 27, '0', '0', '0', '0', '1', '2', 3),
	(8, 58, '0', 168, 104, 90, 1, 51, 24, '0', '0', '0', '1', '1', '2', 3),
	(9, 55, '1', 127, 85, 72, 1, 45, 19, '0', '0', '0', '1', '1', '1', 1),
	(10, 57, '0', 140, 99, 105, 1, 64, 26, '0', '0', '0', '1', '0', '1', 2),
	(11, 64, '1', 178, 98, 101, 1, 77, 31, '0', '0', '0', '0', '1', '1', 3),
	(12, 58, '0', 117, 78, 91, 1, 54, 22, '1', '0', '0', '0', '1', '1', 1),
	(13, 52, '1', 138, 93, 85, 1, 64, 27, '1', '0', '1', '1', '1', '2', 2),
	(14, 49, '0', 113, 78, 75, 1, 45, 21, '0', '0', '0', '0', '1', '2', 1),
	(15, 51, '1', 139, 85, 84, 1, 61, 23, '1', '0', '0', '0', '1', '3', 2),
	(16, 66, '0', 187, 108, 88, 1, 43, 20, '0', '0', '0', '0', '1', '3', 3),
	(17, 69, '1', 139, 78, 81, 1, 49, 19, '0', '1', '1', '0', '0', '2', 2),
	(18, 52, '0', 119, 72, 83, 1, 41, 19, '0', '0', '0', '0', '1', '1', 1),
	(19, 67, '1', 124, 74, 79, 1, 52, 19, '0', '0', '1', '1', '1', '3', 2),
	(20, 62, '0', 156, 91, 108, 1, 66, 27, '0', '1', '1', '0', '0', '1', 3),
	(21, 52, '0', 145, 92, 93, 1, 69, 33, '0', '0', '1', '0', '0', '1', 2),
	(22, 54, '1', 105, 67, 79, 1, 58, 23, '0', '0', '0', '0', '1', '2', 1),
	(23, 57, '1', 170, 91, 88, 1, 62, 24, '0', '1', '0', '1', '1', '3', 3),
	(24, 50, '1', 126, 73, 82, 1, 53, 24, '1', '0', '0', '1', '1', '2', 2),
	(25, 50, '1', 151, 99, 84, 1, 54, 21, '1', '0', '0', '1', '1', '3', 3),
	(26, 52, '1', 115, 69, 99, 1, 71, 27, '0', '0', '0', '0', '1', '2', 1),
	(27, 50, '0', 156, 88, 97, 1, 63, 28, '0', '0', '1', '1', '0', '2', 3),
	(28, 69, '0', 120, 63, 72, 1, 44, 18, '0', '1', '1', '0', '0', '2', 2),
	(29, 51, '0', 100, 75, 71, 1, 52, 22, '0', '0', '0', '0', '1', '3', 1),
	(30, 56, '1', 195, 105, 85, 1, 60, 25, '0', '1', '0', '0', '1', '2', 3),
	(31, 85, '1', 175, 91, 68, 1, 58, 24, '0', '1', '0', '0', '1', '2', 3),
	(32, 38, '0', 116, 87, 99, 1, 74, 32, '0', '1', '1', '1', '1', '1', 1),
	(33, 62, '0', 123, 78, 98, 1, 63, 27, '0', '0', '1', '0', '1', '1', 1),
	(34, 36, '0', 115, 83, 88, 1, 50, 23, '0', '1', '0', '0', '1', '1', 1),
	(35, 70, '0', 159, 83, 78, 1, 41, 20, '0', '0', '0', '1', '1', '2', 2),
	(36, 32, '1', 133, 76, 88, 1, 74, 26, '1', '0', '0', '0', '1', '2', 1),
	(37, 43, '1', 149, 102, 128, 1, 115, 40, '1', '1', '1', '1', '0', '3', 3),
	(38, 31, '0', 122, 83, 89, 1, 68, 31, '0', '1', '1', '0', '0', '2', 2),
	(39, 40, '0', 173, 103, 95, 1, 68, 29, '0', '1', '0', '1', '1', '2', 3),
	(40, 41, '0', 132, 101, 97, 1, 60, 26, '0', '0', '1', '0', '0', '2', 2),
	(41, 35, '1', 123, 86, 71, 1, 50, 19, '1', '1', '0', '0', '1', '1', 2),
	(42, 36, '0', 127, 98, 101, 1, 75, 29, '0', '1', '0', '0', '0', '1', 2),
	(43, 55, '0', 161, 100, 98, 1, 58, 29, '0', '0', '1', '1', '0', '3', 3),
	(44, 37, '0', 165, 90, 85, 1, 53, 25, '0', '0', '0', '1', '1', '3', 3),
	(45, 70, '0', 166, 87, 85, 1, 38, 19, '0', '1', '0', '1', '1', '3', 3),
	(46, 32, '0', 113, 80, 82, 1, 43, 19, '0', '0', '0', '0', '1', '2', 1),
	(47, 61, '1', 167, 103, 81, 1, 44, 19, '1', '0', '0', '1', '0', '2', 3),
	(48, 32, '0', 160, 118, 98, 1, 64, 28, '0', '0', '0', '1', '0', '3', 3),
	(49, 39, '0', 167, 111, 93, 1, 46, 21, '0', '1', '0', '1', '1', '3', 3),
	(50, 27, '0', 148, 123, 106, 1, 78, 37, '0', '1', '1', '0', '0', '3', 3),
	(51, 27, '0', 127, 100, 83, 1, 51, 23, '1', '0', '0', '1', '1', '1', 1),
	(52, 80, '0', 156, 79, 87, 1, 40, 20, '0', '1', '0', '1', '0', '1', 3),
	(53, 39, '0', 166, 110, 94, 1, 68, 27, '0', '1', '0', '1', '0', '1', 3),
	(54, 80, '1', 167, 89, 78, 1, 50, 20, '0', '0', '0', '0', '0', '2', 2),
	(55, 24, '0', 109, 78, 68, 1, 40, 17, '0', '0', '0', '0', '1', '3', 1),
	(56, 51, '0', 161, 98, 85, 1, 46, 22, '0', '1', '0', '1', '0', '2', 3),
	(57, 22, '0', 133, 89, 70, 1, 41, 18, '0', '0', '0', '0', '1', '1', 1),
	(58, 65, '1', 138, 81, 91, 1, 65, 24, '1', '0', '0', '1', '1', '2', 2),
	(59, 23, '0', 141, 96, 85, 1, 51, 22, '0', '0', '0', '0', '1', '2', 1),
	(60, 64, '0', 179, 113, 91, 1, 59, 27, '0', '1', '0', '1', '0', '2', 3),
	(61, 30, '0', 113, 79, 94, 1, 65, 27, '0', '1', '0', '1', '0', '1', 2),
	(62, 27, '0', 143, 107, 106, 1, 76, 36, '1', '0', '1', '1', '0', '1', 3),
	(63, 53, '0', 208, 113, 92, 1, 45, 21, '0', '1', '0', '1', '0', '1', 3),
	(64, 34, '0', 126, 86, 108, 1, 62, 29, '0', '1', '0', '1', '1', '1', 2),
	(65, 43, '0', 130, 82, 80, 1, 43, 21, '0', '0', '0', '1', '1', '1', 1),
	(66, 41, '0', 198, 122, 77, 1, 43, 21, '0', '1', '0', '0', '0', '3', 3),
	(67, 53, '0', 181, 115, 87, 1, 45, 22, '0', '1', '0', '0', '0', '3', 3),
	(68, 20, '0', 127, 86, 81, 1, 43, 19, '0', '0', '0', '0', '1', '1', 1),
	(69, 49, '1', 129, 85, 87, 1, 52, 23, '1', '0', '0', '1', '1', '1', 1),
	(70, 53, '0', 208, 113, 92, 1, 45, 21, '0', '1', '0', '1', '0', '2', 3),
	(71, 43, '1', 130, 77, 89, 1, 63, 26, '0', '1', '0', '1', '0', '3', 3),
	(72, 70, '1', 194, 121, 89, 1, 64, 23, '0', '0', '0', '1', '0', '3', 3),
	(73, 33, '0', 104, 86, 98, 1, 66, 31, '0', '1', '1', '0', '0', '2', 2),
	(74, 49, '1', 176, 114, 91, 1, 62, 26, '1', '1', '0', '1', '1', '3', 3),
	(75, 65, '1', 141, 92, 75, 1, 44, 22, '0', '0', '0', '1', '0', '3', 2);
/*!40000 ALTER TABLE `tb_data_training` ENABLE KEYS */;

-- Dumping structure for table db_risikohipertensi.tb_rule
CREATE TABLE IF NOT EXISTS `tb_rule` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `umur` varchar(20) DEFAULT NULL,
  `sex` varchar(20) DEFAULT NULL,
  `tekanan_darah` varchar(20) DEFAULT NULL,
  `lingkar_perut` varchar(20) DEFAULT NULL,
  `tinggi_badan` varchar(20) DEFAULT NULL,
  `berat_badan` varchar(20) DEFAULT NULL,
  `bmi` varchar(20) DEFAULT NULL,
  `merokok` varchar(20) DEFAULT NULL,
  `makanan_berlemak` varchar(20) DEFAULT NULL,
  `k_gula` varchar(20) DEFAULT NULL,
  `k_garam` varchar(20) DEFAULT NULL,
  `olahraga` varchar(20) DEFAULT NULL,
  `k_kafein` varchar(20) DEFAULT NULL,
  `risiko_hipertensi` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table db_risikohipertensi.tb_rule: ~7 rows (approximately)
/*!40000 ALTER TABLE `tb_rule` DISABLE KEYS */;
INSERT INTO `tb_rule` (`id`, `umur`, `sex`, `tekanan_darah`, `lingkar_perut`, `tinggi_badan`, `berat_badan`, `bmi`, `merokok`, `makanan_berlemak`, `k_gula`, `k_garam`, `olahraga`, `k_kafein`, `risiko_hipertensi`) VALUES
	(1, NULL, NULL, 'normal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rendah'),
	(2, 'muda', NULL, 'pra', 'kecil', NULL, NULL, 'normal', NULL, NULL, NULL, NULL, NULL, NULL, 'rendah'),
	(3, 'muda', NULL, 'pra', 'kecil', NULL, NULL, 'ow', NULL, NULL, NULL, NULL, NULL, NULL, 'sedang'),
	(5, 'tua', NULL, 'pra', 'kecil', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'sedang'),
	(6, NULL, NULL, 'pra', NULL, NULL, NULL, 'normal', NULL, NULL, NULL, NULL, NULL, NULL, 'rendah'),
	(7, 'muda', NULL, 'pra', 'besar', NULL, NULL, 'ow', NULL, NULL, NULL, NULL, NULL, NULL, 'sedang'),
	(8, 'tua', NULL, 'pra', 'besar', NULL, NULL, 'ow', NULL, NULL, NULL, NULL, NULL, NULL, 'sedang'),
	(9, NULL, NULL, 'hipertensi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'tinggi');
/*!40000 ALTER TABLE `tb_rule` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
