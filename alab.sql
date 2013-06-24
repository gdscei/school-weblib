-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.1.65-community - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2013-06-23 17:51:38
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping structure for table alab_bib.account
CREATE TABLE IF NOT EXISTS `account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gebruikersnaam` varchar(50) NOT NULL,
  `naam` varchar(100) NOT NULL,
  `wachtwoord` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table alab_bib.account: ~1 rows (approximately)
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` (`id`, `gebruikersnaam`, `naam`, `wachtwoord`, `email`, `type`) VALUES
	(1, 'testacc', 'Test Acc', 'bf4a3749fbeef13b51c086d4614e7c2eabd9f002', 'email', 0);
/*!40000 ALTER TABLE `account` ENABLE KEYS */;


-- Dumping structure for table alab_bib.item
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `naam` varchar(255) NOT NULL,
  `auteur` varchar(255) DEFAULT NULL,
  `isbn` bigint(20) unsigned DEFAULT NULL,
  `type` tinyint(1) NOT NULL,
  `actief` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table alab_bib.item: ~0 rows (approximately)
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
/*!40000 ALTER TABLE `item` ENABLE KEYS */;


-- Dumping structure for table alab_bib.uitgeleend
CREATE TABLE IF NOT EXISTS `uitgeleend` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `itemid` int(10) unsigned NOT NULL DEFAULT '0',
  `accountid` int(10) unsigned NOT NULL DEFAULT '0',
  `datum_geleend` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datum_terug` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ingeleverd` tinyint(1) NOT NULL DEFAULT '0',
  `datum_ingeleverd` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `itemid` (`itemid`),
  KEY `accountid` (`accountid`),
  CONSTRAINT `itemid` FOREIGN KEY (`itemid`) REFERENCES `item` (`id`),
  CONSTRAINT `accountid` FOREIGN KEY (`accountid`) REFERENCES `account` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table alab_bib.uitgeleend: ~0 rows (approximately)
/*!40000 ALTER TABLE `uitgeleend` DISABLE KEYS */;
/*!40000 ALTER TABLE `uitgeleend` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
