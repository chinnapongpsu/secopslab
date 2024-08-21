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


-- Dumping database structure for esport_system
CREATE DATABASE IF NOT EXISTS `esport_system` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `esport_system`;

-- Dumping structure for table esport_system.esportevent
CREATE TABLE IF NOT EXISTS `esportevent` (
  `EsportID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `EsportEventName` varchar(50) NOT NULL DEFAULT '',
  `EsportEventDate` datetime DEFAULT NULL,
  `Esportplace` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`EsportID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table esport_system.esportevent: ~5 rows (approximately)
/*!40000 ALTER TABLE `esportevent` DISABLE KEYS */;
REPLACE INTO `esportevent` (`EsportID`, `EsportEventName`, `EsportEventDate`, `Esportplace`) VALUES
	(1, 'PUBG_พ่อทุกสถาบัน', '2021-04-01 15:16:56', 'เมืองหอยใหญ่'),
	(2, 'FreeFire_เพื่อเด็กยากไร้', '2021-04-01 15:17:48', 'แอบเล่นหลังวัด'),
	(4, '1', '2021-04-01 15:16:00', 'บ้านเมียน้อย'),
	(5, 'เกมส์แข่งรถไถ', '2021-04-01 19:58:45', 'Big-O'),
	(6, 'เป่ากบ', '2021-04-01 19:59:36', 'โรงเรียนบ้านหนองใน');
/*!40000 ALTER TABLE `esportevent` ENABLE KEYS */;

-- Dumping structure for table esport_system.esportregistration
CREATE TABLE IF NOT EXISTS `esportregistration` (
  `GamerID` int(11) NOT NULL AUTO_INCREMENT,
  `EsportID` int(10) DEFAULT '0',
  `UserID` int(11) DEFAULT '0',
  `ConfirmRegister` varchar(50) DEFAULT 'n',
  PRIMARY KEY (`GamerID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table esport_system.esportregistration: ~5 rows (approximately)
/*!40000 ALTER TABLE `esportregistration` DISABLE KEYS */;
REPLACE INTO `esportregistration` (`GamerID`, `EsportID`, `UserID`, `ConfirmRegister`) VALUES
	(1, 1, 1, 'n'),
	(2, 2, 2, 'n'),
	(3, 3, 1, 'n'),
	(4, 2, 2, 'n'),
	(5, 1, 1, 'n');
/*!40000 ALTER TABLE `esportregistration` ENABLE KEYS */;

-- Dumping structure for table esport_system.userinformation
CREATE TABLE IF NOT EXISTS `userinformation` (
  `UserID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) DEFAULT '',
  `Password` varchar(200) DEFAULT '',
  `Email` varchar(50) DEFAULT '',
  `Name` varchar(50) DEFAULT '',
  `Surname` varchar(50) DEFAULT '',
  `Usefunctionadmin` varchar(50) DEFAULT 'n',
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table esport_system.userinformation: ~2 rows (approximately)
/*!40000 ALTER TABLE `userinformation` DISABLE KEYS */;
REPLACE INTO `userinformation` (`UserID`, `Username`, `Password`, `Email`, `Name`, `Surname`, `Usefunctionadmin`) VALUES
	(1, 'grid', '$10$Jz/scb2DWbU84ilBioPdmukj0kmnUjDoSC.syUyLHZUwY9BYXe5nm', '123@email.com', 'zip', 'Esc', 'n'),
	(2, 'Nut', '$2y$10$8gcDuQoDfGXdBpo2Ht3mLeQ60cxmBvAieXvK0oK03j1ev1W3xrKSG', 'ggeez@gmail.com', 'nutty', 'ggez', 'n'),
	(3, 'wave', '$10$Jz/scb2DWbU84ilBioPdmukj0kmnUjDoSC.syUyLHZUwY9BYXe5nm', 'inwza@hotmail.com', 'kondee', 'numberone', 'n');
/*!40000 ALTER TABLE `userinformation` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
