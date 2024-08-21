-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for jokeboard_system
CREATE DATABASE IF NOT EXISTS `jokeboard_system` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `jokeboard_system`;

-- Dumping structure for table jokeboard_system.informationjoke
CREATE TABLE IF NOT EXISTS `informationjoke` (
  `JokeID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `JokeName` varchar(50) NOT NULL DEFAULT '',
  `JokeDate` datetime DEFAULT NULL,
  `Joketype` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`JokeID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table jokeboard_system.informationjoke: ~3 rows (approximately)
/*!40000 ALTER TABLE `informationjoke` DISABLE KEYS */;
REPLACE INTO `informationjoke` (`JokeID`, `JokeName`, `JokeDate`, `Joketype`) VALUES
	(1, 'ไก่กับควาย', '2021-03-31 02:46:35', 'สัตว์เลี้ยง'),
	(2, 'ไก่กับงู', '2021-03-31 02:47:00', 'สัตว์'),
	(4, 'จังหวัด1', '2021-03-31 02:46:37', 'ชื่อเฉพาะ');
/*!40000 ALTER TABLE `informationjoke` ENABLE KEYS */;

-- Dumping structure for table jokeboard_system.jokerregistration
CREATE TABLE IF NOT EXISTS `jokerregistration` (
  `JokeID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL DEFAULT '',
  `Surname` varchar(50) NOT NULL DEFAULT '',
  `JokeRank` char(50) NOT NULL DEFAULT 'normal',
  PRIMARY KEY (`JokeID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table jokeboard_system.jokerregistration: ~4 rows (approximately)
/*!40000 ALTER TABLE `jokerregistration` DISABLE KEYS */;
REPLACE INTO `jokerregistration` (`JokeID`, `Name`, `Surname`, `JokeRank`) VALUES
	(1, 'grid', 'ggez', 'normal'),
	(2, 'wave', 'ggez', 'normal'),
	(3, 'nutty', 'ggez', 'normal'),
	(4, 'tangmo', 'ggez', 'normal');
/*!40000 ALTER TABLE `jokerregistration` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
