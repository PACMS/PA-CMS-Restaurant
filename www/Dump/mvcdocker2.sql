-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le : mer. 13 juil. 2022 à 15:39
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mvcdocker2`
--

-- --------------------------------------------------------

--
-- Structure de la table `pacm_activitylog`
--

CREATE TABLE IF NOT EXISTS `pacm_activitylog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pacm_carte`
--

CREATE TABLE IF NOT EXISTS `pacm_carte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_restaurant` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `restaurantDeleteCards` (`id_restaurant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pacm_categorie`
--

CREATE TABLE IF NOT EXISTS `pacm_categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_carte` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `carteDeleteCategorie` (`id_carte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pacm_comments`
--

CREATE TABLE IF NOT EXISTS `pacm_comments` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `content` varchar(400) NOT NULL,
  `id_parent` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) DEFAULT '0',
  `id_user` int(11) NOT NULL,
  `id_restaurant` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `restaurantDeleteComment` (`id_restaurant`),
  KEY `userDeleteComment` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pacm_content`
--

CREATE TABLE IF NOT EXISTS `pacm_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_page` int(11) NOT NULL,
  `body` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `page` (`id_page`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pacm_food`
--

CREATE TABLE IF NOT EXISTS `pacm_food` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `nature` varchar(50) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `stockId` int(10) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stockDeleteFood` (`stockId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pacm_meal`
--

CREATE TABLE IF NOT EXISTS `pacm_meal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `price` float NOT NULL,
  `description` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_carte` int(11) NOT NULL,
  `id_categories` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `carteDeleteMeal` (`id_carte`),
  KEY `categorieDeleteMeal` (`id_categories`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pacm_mealsFoods`
--

CREATE TABLE IF NOT EXISTS `pacm_mealsFoods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `meal_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mealDeleteFoods` (`meal_id`),
  KEY `foodDeleteFood` (`food_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pacm_option`
--

CREATE TABLE IF NOT EXISTS `pacm_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pacm_option`
--

INSERT INTO `pacm_option` (`id`, `name`, `value`) VALUES
(1, 'Theme', '2');

-- --------------------------------------------------------

--
-- Structure de la table `pacm_page`
--

CREATE TABLE IF NOT EXISTS `pacm_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `display_menu` tinyint(1) NOT NULL DEFAULT '0',
  `display_comments` tinyint(1) NOT NULL DEFAULT '0',
  `display_reservations` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_theme` int(11) DEFAULT NULL,
  `id_restaurant` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rest` (`id_restaurant`),
  KEY `theme` (`id_theme`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pacm_reservation`
--

CREATE TABLE IF NOT EXISTS `pacm_reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(320) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `hour` time NOT NULL,
  `numTable` int(11) DEFAULT NULL,
  `numPerson` int(11) NOT NULL,
  `phoneReserv` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `confirmation` tinyint(1) DEFAULT null,
  `id_restaurant` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_restaurant` (`id_restaurant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pacm_restaurant`
--

CREATE TABLE IF NOT EXISTS `pacm_restaurant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `additional_address` varchar(100) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `zipcode` int(50) DEFAULT NULL,
  `user_id` varchar(50) NOT NULL,
  `phone` int(50) DEFAULT NULL,
  `favorite` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pacm_stock`
--

CREATE TABLE IF NOT EXISTS `pacm_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `restaurantId` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedAt` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `restaurantId` (`restaurantId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pacm_theme`
--

CREATE TABLE IF NOT EXISTS `pacm_theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `font` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `h1` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `h2` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `h3` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `p` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pacm_theme`
--

INSERT INTO `pacm_theme` (`id`, `name`, `slug`, `path`, `font`, `h1`, `h2`, `h3`, `p`) VALUES
(1, 'Thème 1', 'theme1', '/public/src/themes/theme1/', 'Poppins', '#aa7da9', '#ffc524', '#5ef7ed', '#e24040'),
(2, 'Thème 2', 'theme2', '/public/src/themes/theme2/', 'Nunito', '#6f7c90', '#8171fe', '#cc1919', '#000000');

-- --------------------------------------------------------

--
-- Structure de la table `pacm_user`
--

CREATE TABLE IF NOT EXISTS `pacm_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(320) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) DEFAULT '0',
  `role` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `token` text COLLATE utf8mb4_unicode_ci,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `pacm_activitylog`
--
ALTER TABLE `pacm_activitylog`
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `pacm_user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pacm_carte`
--
ALTER TABLE `pacm_carte`
  ADD CONSTRAINT `restaurantDeleteCards` FOREIGN KEY (`id_restaurant`) REFERENCES `pacm_restaurant` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pacm_categorie`
--
ALTER TABLE `pacm_categorie`
  ADD CONSTRAINT `carteDeleteCategorie` FOREIGN KEY (`id_carte`) REFERENCES `pacm_carte` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pacm_comments`
--
ALTER TABLE `pacm_comments`
  ADD CONSTRAINT `restaurantDeleteComment` FOREIGN KEY (`id_restaurant`) REFERENCES `pacm_restaurant` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `userDeleteComment` FOREIGN KEY (`id_user`) REFERENCES `pacm_user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pacm_content`
--
ALTER TABLE `pacm_content`
  ADD CONSTRAINT `pageDeleteContent` FOREIGN KEY (`id_page`) REFERENCES `pacm_page` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pacm_food`
--
ALTER TABLE `pacm_food`
  ADD CONSTRAINT `stockDeleteFood` FOREIGN KEY (`stockId`) REFERENCES `pacm_stock` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pacm_meal`
--
ALTER TABLE `pacm_meal`
  ADD CONSTRAINT `carteDeleteMeal` FOREIGN KEY (`id_carte`) REFERENCES `pacm_carte` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `categorieDeleteMeal` FOREIGN KEY (`id_categories`) REFERENCES `pacm_categorie` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pacm_page`
--
ALTER TABLE `pacm_page`
  ADD CONSTRAINT `restaurantDeletePages` FOREIGN KEY (`id_restaurant`) REFERENCES `pacm_restaurant` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pacm_reservation`
--
ALTER TABLE `pacm_reservation`
  ADD CONSTRAINT `restaurantDeleteReservations` FOREIGN KEY (`id_restaurant`) REFERENCES `pacm_restaurant` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pacm_stock`
--
ALTER TABLE `pacm_stock`
  ADD CONSTRAINT `restauDeleteStock` FOREIGN KEY (`restaurantId`) REFERENCES `pacm_restaurant` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
