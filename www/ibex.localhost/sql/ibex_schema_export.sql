-- --------------------------------------------------------
-- Host:                         ibex.localhost
-- Server version:               10.3.11-MariaDB - MariaDB Server
-- Server OS:                    Linux
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for ibex
CREATE DATABASE IF NOT EXISTS `ibex` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ibex`;

-- Dumping structure for table ibex.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dealer_id` varchar(50) NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dealer_id_customer_id_unique` (`dealer_id`,`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8189 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table ibex.customer_sale
CREATE TABLE IF NOT EXISTS `customer_sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dealer_id` varchar(50) NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `total_sales` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dealer_id_customer_id_unique` (`dealer_id`,`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2048 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table ibex.dealer
CREATE TABLE IF NOT EXISTS `dealer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dealer_id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` char(2) NOT NULL,
  `zip` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dealer_id_unique` (`dealer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
