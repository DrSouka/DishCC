-- --------------------------------------------------------
-- Host :                       127.0.0.1
-- Server Version:
-- Server OS:
-- HeidiSQL Version:
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Export database's structure for dishcc
CREATE DATABASE IF NOT EXISTS `dishcc`
/*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `dishcc`;
SET default_storage_engine=InnoDB;
ALTER DATABASE dishcc CHARACTER SET utf8 COLLATE utf8_unicode_ci;

-- Export table's structure of dishcc. category
CREATE TABLE IF NOT EXISTS `category` (
  `id` tinyint unsigned AUTO_INCREMENT NOT NULL,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
);

-- Export table's structure of dishcc. dish
CREATE TABLE IF NOT EXISTS `dish` (
  `id` int unsigned AUTO_INCREMENT NOT NULL,
  `name` varchar(256) NOT NULL,
  `nperson` tinyint unsigned NOT NULL,
  `tpreparation` time DEFAULT NULL,
  `tcooking` time DEFAULT NULL,
  `category` tinyint unsigned,
  `type` tinyint unsigned,
  `author` int unsigned,
  `difficulty` tinyint NOT NULL,
  `calories` float unsigned NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

-- Export table's structure of dishcc. dish_ingredient
CREATE TABLE IF NOT EXISTS `dish_ingredient` (
  `id` int unsigned AUTO_INCREMENT NOT NULL,
  `grams` float unsigned NOT NULL,
  `dish` int unsigned NOT NULL,
  `ingredient` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
);

-- Export table's structure of dishcc. ingredient
CREATE TABLE IF NOT EXISTS `ingredient` (
  `id` int unsigned AUTO_INCREMENT NOT NULL,
  `name` varchar(256) NOT NULL,
  `caloriesPer100g` float unsigned NOT NULL,
  PRIMARY KEY (`id`)
);

-- Export table's structure of dishcc. result
CREATE TABLE IF NOT EXISTS `result` (
  `id` int unsigned AUTO_INCREMENT NOT NULL,
  `calories` float unsigned NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
);

-- Export table's structure of dishcc. result_ingredient
CREATE TABLE IF NOT EXISTS `result_ingredient` (
  `id` int unsigned AUTO_INCREMENT NOT NULL,
  `result` int unsigned NOT NULL,
  `ingredient` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
);

-- Export table's structure of dishcc. type
CREATE TABLE IF NOT EXISTS `type` (
  `id` tinyint unsigned AUTO_INCREMENT NOT NULL,
  `name` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
);

-- Export table's structure of dishcc. user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int unsigned AUTO_INCREMENT NOT NULL,
  `pseudo` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(8000) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

ALTER TABLE `dish`
ADD FOREIGN KEY (`category`) REFERENCES `category`(`id`);
ALTER TABLE `dish`
ADD FOREIGN KEY (`type`) REFERENCES `type`(`id`);
ALTER TABLE `dish`
ADD FOREIGN KEY (`author`) REFERENCES `user`(`id`);

ALTER TABLE `dish_ingredient`
ADD FOREIGN KEY (`dish`) REFERENCES `dish`(`id`);
ALTER TABLE `dish_ingredient`
ADD FOREIGN KEY (`ingredient`) REFERENCES `ingredient`(`id`);

ALTER TABLE `result`
ADD FOREIGN KEY (`user`) REFERENCES `user`(`id`);

ALTER TABLE `result_ingredient`
ADD FOREIGN KEY (`result`) REFERENCES `result`(`id`);
ADD FOREIGN KEY (`ingredient`) REFERENCES `ingredient`(`id`);

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
