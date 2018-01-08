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

-- Dumping structure for table db_risikohipertensi.tb_data_training
DROP TABLE IF EXISTS `tb_data_training`;
CREATE TABLE IF NOT EXISTS `tb_data_training` (
  `id` int(100) NOT NULL,
  `umur` int(100) NOT NULL,
  `sex` varchar(2) NOT NULL,
  `td_sistol` int(255) NOT NULL,
  `td_diastol` int(255) NOT NULL,
  `sum_td` int(255) DEFAULT NULL,
  `lingkar_perut` int(200) NOT NULL,
  `tinggi_badan` double NOT NULL,
  `berat_badan` double NOT NULL,
  `bmi` double NOT NULL,
  `merokok` varchar(3) NOT NULL,
  `makanan_berlemak` varchar(10) NOT NULL,
  `k_gula` varchar(10) NOT NULL,
  `k_garam` varchar(10) NOT NULL,
  `olahraga` varchar(3) NOT NULL,
  `k_kafein` varchar(10) NOT NULL,
  `risiko_hipertensi` int(10) NOT NULL,
  `is_deleted` varchar(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_risikohipertensi.tb_data_training: ~75 rows (approximately)
DELETE FROM `tb_data_training`;
/*!40000 ALTER TABLE `tb_data_training` DISABLE KEYS */;
INSERT INTO `tb_data_training` (`id`, `umur`, `sex`, `td_sistol`, `td_diastol`, `sum_td`, `lingkar_perut`, `tinggi_badan`, `berat_badan`, `bmi`, `merokok`, `makanan_berlemak`, `k_gula`, `k_garam`, `olahraga`, `k_kafein`, `risiko_hipertensi`, `is_deleted`) VALUES
	(1, 52, '1', 125, 90, 215, 78, 1.63, 62.7, 23.598931085099178, '1', '0', '0', '0', '1', '2', 2, '0'),
	(2, 66, '1', 194, 114, 308, 98, 1.63, 72.2, 27.174526704053598, '0', '0', '1', '1', '1', '1', 3, '0'),
	(3, 56, '1', 129, 80, 209, 98, 1.51, 61.2, 26.840928029472394, '1', '0', '0', '0', '1', '1', 1, '0'),
	(4, 51, '1', 148, 97, 245, 98, 1.65, 77.2, 28.356290174471997, '1', '0', '0', '1', '0', '1', 2, '0'),
	(5, 71, '0', 148, 88, 236, 88, 1.43, 56.3, 27.531908650789774, '0', '0', '1', '1', '1', '3', 2, '0'),
	(6, 51, '1', 115, 83, 198, 70, 1.57, 62.5, 25.355998214937724, '0', '0', '0', '0', '1', '2', 1, '0'),
	(7, 55, '1', 170, 96, 266, 97, 1.56, 67.4, 27.695595003287313, '0', '0', '0', '0', '1', '2', 3, '0'),
	(8, 58, '0', 168, 104, 272, 90, 1.46, 51.2, 24.019515856633518, '0', '0', '0', '1', '1', '2', 3, '0'),
	(9, 55, '1', 127, 85, 212, 72, 1.53, 45.7, 19.522405912255973, '0', '0', '0', '1', '1', '1', 1, '0'),
	(10, 57, '0', 140, 99, 239, 105, 1.55, 64.4, 26.8054110301769, '0', '0', '0', '1', '0', '1', 2, '0'),
	(11, 64, '1', 178, 98, 276, 101, 1.57, 77.8, 31.563146577954477, '0', '0', '0', '0', '1', '1', 3, '0'),
	(12, 58, '0', 117, 78, 195, 91, 1.54, 54.2, 22.85376960701636, '1', '0', '0', '0', '1', '1', 1, '0'),
	(13, 52, '1', 138, 93, 231, 85, 1.54, 64.1, 27.028166638556247, '1', '0', '1', '1', '1', '2', 2, '0'),
	(14, 49, '0', 113, 78, 191, 75, 1.46, 45.9, 21.53312066053669, '0', '0', '0', '0', '1', '2', 1, '0'),
	(15, 51, '1', 139, 85, 224, 84, 1.62, 61.2, 23.3196159122085, '1', '0', '0', '0', '1', '3', 2, '0'),
	(16, 66, '0', 187, 108, 295, 88, 1.47, 43.6, 20.17677819427091, '0', '0', '0', '0', '1', '3', 3, '0'),
	(17, 69, '1', 139, 78, 217, 81, 1.59, 49.1, 19.421700090977414, '0', '1', '1', '0', '0', '2', 2, '0'),
	(18, 52, '0', 119, 72, 191, 83, 1.47, 41.2, 19.066129853301867, '0', '0', '0', '0', '1', '1', 1, '0'),
	(19, 67, '1', 124, 74, 198, 79, 1.62, 52.1, 19.8521566834324, '0', '0', '1', '1', '1', '3', 2, '0'),
	(20, 62, '0', 156, 91, 247, 108, 1.57, 66.7, 27.059921294981542, '0', '1', '1', '0', '0', '1', 3, '0'),
	(21, 52, '0', 145, 92, 237, 93, 1.45, 69.9, 33.2461355529132, '0', '0', '1', '0', '0', '1', 2, '0'),
	(22, 54, '1', 105, 67, 172, 79, 1.58, 58.6, 23.473802275276395, '0', '0', '0', '0', '1', '2', 1, '0'),
	(23, 57, '1', 170, 91, 261, 88, 1.6, 62.9, 24.570312499999996, '0', '1', '0', '1', '1', '3', 3, '0'),
	(24, 50, '1', 126, 73, 199, 82, 1.47, 53, 24.526817529732984, '1', '0', '0', '1', '1', '2', 2, '0'),
	(25, 50, '1', 151, 99, 250, 84, 1.58, 54.1, 21.671206537413873, '1', '0', '0', '1', '1', '3', 3, '0'),
	(26, 52, '1', 115, 69, 184, 99, 1.6, 71.2, 27.812499999999996, '0', '0', '0', '0', '1', '2', 1, '0'),
	(27, 50, '0', 156, 88, 244, 97, 1.5, 63, 28, '0', '0', '1', '1', '0', '2', 3, '0'),
	(28, 69, '0', 120, 63, 183, 72, 1.55, 44.2, 18.397502601456814, '0', '1', '1', '0', '0', '2', 2, '0'),
	(29, 51, '0', 100, 75, 175, 71, 1.52, 52, 22.506925207756233, '0', '0', '0', '0', '1', '3', 1, '0'),
	(30, 56, '1', 195, 105, 300, 85, 1.55, 60.6, 25.223725286160246, '0', '1', '0', '0', '1', '2', 3, '0'),
	(31, 85, '1', 175, 91, 266, 68, 1.54, 58.3, 24.58256029684601, '0', '1', '0', '0', '1', '2', 3, '0'),
	(32, 38, '0', 116, 87, 203, 99, 1.512, 74.2, 32.45639819713894, '0', '1', '1', '1', '1', '1', 1, '0'),
	(33, 62, '0', 123, 78, 201, 98, 1.515, 63.4, 27.622564236621685, '0', '0', '1', '0', '1', '1', 1, '0'),
	(34, 36, '0', 115, 83, 198, 88, 1.46, 50.3, 23.59729780446613, '0', '1', '0', '0', '1', '1', 1, '0'),
	(35, 70, '0', 159, 83, 242, 78, 1.42, 41.8, 20.7300138861337, '0', '0', '0', '1', '1', '2', 2, '0'),
	(36, 32, '1', 133, 76, 209, 88, 1.68, 74.4, 26.36054421768708, '1', '0', '0', '0', '1', '2', 1, '0'),
	(37, 43, '1', 149, 102, 251, 128, 1.69, 115.3, 40.36973495325795, '1', '1', '1', '1', '0', '3', 3, '0'),
	(38, 31, '0', 122, 83, 205, 89, 1.475, 68.1, 31.301350186727948, '0', '1', '1', '0', '0', '2', 2, '0'),
	(39, 40, '0', 173, 103, 276, 95, 1.54, 68.9, 29.05211671445438, '0', '1', '0', '1', '1', '2', 3, '0'),
	(40, 41, '0', 132, 101, 233, 97, 1.5, 60.5, 26.88888888888889, '0', '0', '1', '0', '0', '2', 2, '0'),
	(41, 35, '1', 123, 86, 209, 71, 1.615, 50.7, 19.438507030643446, '1', '1', '0', '0', '1', '1', 2, '0'),
	(42, 36, '0', 127, 98, 225, 101, 1.6, 75.4, 29.453124999999996, '0', '1', '0', '0', '0', '1', 2, '0'),
	(43, 55, '0', 161, 100, 261, 98, 1.42, 58.6, 29.061694108311844, '0', '0', '1', '1', '0', '3', 3, '0'),
	(44, 37, '0', 165, 90, 255, 85, 1.445, 53.3, 25.526514289819325, '0', '0', '0', '1', '1', '3', 3, '0'),
	(45, 70, '0', 166, 87, 253, 85, 1.405, 38.9, 19.705930775952684, '0', '1', '0', '1', '1', '3', 3, '0'),
	(46, 32, '0', 113, 80, 193, 82, 1.48, 43.7, 19.950693937180425, '0', '0', '0', '0', '1', '2', 1, '0'),
	(47, 61, '1', 167, 103, 270, 81, 1.52, 44, 19.04432132963989, '1', '0', '0', '1', '0', '2', 3, '0'),
	(48, 32, '0', 160, 118, 278, 98, 1.505, 64.3, 28.388207635677315, '0', '0', '0', '1', '0', '3', 3, '0'),
	(49, 39, '0', 167, 111, 278, 93, 1.49, 46.7, 21.0350885095266, '0', '1', '0', '1', '1', '3', 3, '0'),
	(50, 27, '0', 148, 123, 271, 106, 1.45, 78.8, 37.47919143876337, '0', '1', '1', '0', '0', '3', 3, '0'),
	(51, 27, '0', 127, 100, 227, 83, 1.475, 51.7, 23.763286411950588, '1', '0', '0', '1', '1', '1', 1, '0'),
	(52, 80, '0', 156, 79, 235, 87, 1.42, 40.4, 20.035707200952192, '0', '1', '0', '1', '0', '1', 3, '0'),
	(53, 39, '0', 166, 110, 276, 94, 1.58, 68.1, 27.279282166319494, '0', '1', '0', '1', '0', '1', 3, '0'),
	(54, 80, '1', 167, 89, 256, 78, 1.55, 50.2, 20.894901144640997, '0', '0', '0', '0', '0', '2', 2, '0'),
	(55, 24, '0', 109, 78, 187, 68, 1.515, 40.4, 17.601760176017603, '0', '0', '0', '0', '1', '3', 1, '0'),
	(56, 51, '0', 161, 98, 259, 85, 1.42, 46, 22.81293394167824, '0', '1', '0', '1', '0', '2', 3, '0'),
	(57, 22, '0', 133, 89, 222, 70, 1.49, 41.6, 18.737894689428405, '0', '0', '0', '0', '1', '1', 1, '0'),
	(58, 65, '1', 138, 81, 219, 91, 1.63, 65.8, 24.765704392336936, '1', '0', '0', '1', '1', '2', 2, '0'),
	(59, 23, '0', 141, 96, 237, 85, 1.5, 51.7, 22.977777777777778, '0', '0', '0', '0', '1', '2', 1, '0'),
	(60, 64, '0', 179, 113, 292, 91, 1.46, 59.6, 27.960217676862456, '0', '1', '0', '1', '0', '2', 3, '0'),
	(61, 30, '0', 113, 79, 192, 94, 1.54, 65.1, 27.449822904368357, '0', '1', '0', '1', '0', '1', 2, '1'),
	(62, 27, '0', 143, 107, 250, 106, 1.44, 76.5, 36.892361111111114, '1', '0', '1', '1', '0', '1', 3, '1'),
	(63, 53, '0', 208, 113, 321, 92, 1.45, 45, 21.40309155766944, '0', '1', '0', '1', '0', '1', 3, '1'),
	(64, 34, '0', 126, 86, 212, 108, 1.45, 62.1, 29.53626634958383, '0', '1', '0', '1', '1', '1', 2, '1'),
	(65, 43, '0', 130, 82, 212, 80, 1.44, 43.9, 21.17091049382716, '0', '0', '0', '1', '1', '1', 1, '1'),
	(66, 41, '0', 198, 122, 320, 77, 1.43, 43.8, 21.419140300259183, '0', '1', '0', '0', '0', '3', 3, '1'),
	(67, 53, '0', 181, 115, 296, 87, 1.425, 45.2, 22.259156663588797, '0', '1', '0', '0', '0', '3', 3, '1'),
	(68, 20, '0', 127, 86, 213, 81, 1.5, 43.7, 19.422222222222224, '0', '0', '0', '0', '1', '1', 1, '1'),
	(69, 49, '1', 129, 85, 214, 87, 1.505, 52.6, 23.222701736183932, '1', '0', '0', '1', '1', '1', 1, '1'),
	(70, 53, '0', 208, 113, 321, 92, 1.45, 45, 21.40309155766944, '0', '1', '0', '1', '0', '2', 3, '1'),
	(71, 43, '1', 130, 77, 207, 89, 1.56, 63.6, 26.13412228796844, '0', '1', '0', '1', '0', '3', 3, '1'),
	(72, 70, '1', 194, 121, 315, 89, 1.64, 64.4, 23.944080904223682, '0', '0', '0', '1', '0', '3', 3, '1'),
	(73, 33, '0', 104, 86, 190, 98, 1.46, 66.9, 31.384875211109033, '0', '1', '1', '0', '0', '2', 2, '1'),
	(74, 49, '1', 176, 114, 290, 91, 1.536, 62.3, 26.40618218315972, '1', '1', '0', '1', '1', '3', 3, '1'),
	(75, 65, '1', 141, 92, 233, 75, 1.4, 44.3, 22.602040816326532, '0', '0', '0', '1', '0', '3', 2, '1');
/*!40000 ALTER TABLE `tb_data_training` ENABLE KEYS */;

-- Dumping structure for table db_risikohipertensi.tb_initialthreshold
DROP TABLE IF EXISTS `tb_initialthreshold`;
CREATE TABLE IF NOT EXISTS `tb_initialthreshold` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(20) DEFAULT NULL,
  `categoryorder` int(11) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `descriptionorder` int(11) DEFAULT NULL,
  `minimumvalue` double DEFAULT NULL,
  `maximumvalue` double DEFAULT NULL,
  `index` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table db_risikohipertensi.tb_initialthreshold: ~17 rows (approximately)
DELETE FROM `tb_initialthreshold`;
/*!40000 ALTER TABLE `tb_initialthreshold` DISABLE KEYS */;
INSERT INTO `tb_initialthreshold` (`id`, `category`, `categoryorder`, `description`, `descriptionorder`, `minimumvalue`, `maximumvalue`, `index`) VALUES
	(1, 'umur', 0, 'muda', 0, NULL, 26, 0),
	(2, 'umur', 0, 'tua', 1, NULL, 46, 1),
	(3, 'tekanan_darah', 1, 'normal', 0, NULL, 200, 2),
	(4, 'tekanan_darah', 1, 'pra hipertensi', 1, NULL, 230, 3),
	(5, 'tekanan_darah', 1, 'hipertensi', 2, NULL, 270, 4),
	(6, 'berat_badan', 2, 'normal', 0, NULL, 90, 5),
	(7, 'berat_badan', 2, 'obesitas', 1, NULL, 100, 6),
	(8, 'bmi', 3, 'normal', 0, NULL, 18, 7),
	(9, 'bmi', 3, 'overweight', 1, NULL, 27, 8),
	(10, 'merokok', 4, 'ya/tidak', 0, 0, 1, 9),
	(11, 'konsumsi_lemak', 5, 'jarang/sering', 0, 0, 1, 10),
	(12, 'konsumsi_gula', 6, '>4sdm/<=4sdm', 0, 0, 1, 11),
	(13, 'konsumsi_garam', 7, '>1sdt/<=1sdt', 0, 0, 1, 12),
	(14, 'olahraga', 8, 'ya/tidak', 0, 0, 1, 13),
	(15, 'konsumsi_kafein', 9, 'tidak', 0, NULL, 0, 14),
	(16, 'konsumsi_kafein', 9, '<=3 gelas', 1, NULL, 0.5, 15),
	(17, 'konsumsi_kafein', 9, '> 3 gelas', 2, NULL, 1, 16);
/*!40000 ALTER TABLE `tb_initialthreshold` ENABLE KEYS */;

-- Dumping structure for table db_risikohipertensi.tb_rule
DROP TABLE IF EXISTS `tb_rule`;
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

-- Dumping data for table db_risikohipertensi.tb_rule: ~8 rows (approximately)
DELETE FROM `tb_rule`;
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
