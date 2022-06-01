-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le : mer. 01 juin 2022 à 18:01
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
-- Structure de la table `pacm_option`
--

CREATE TABLE IF NOT EXISTS `pacm_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pacm_option`
--

INSERT INTO `pacm_option` (`id`, `name`, `value`) VALUES
(1, 'Theme', '1');

-- --------------------------------------------------------

--
-- Structure de la table `pacm_reservation`
--

CREATE TABLE IF NOT EXISTS `pacm_reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `hour` time NOT NULL,
  `numTable` int(11) NOT NULL,
  `numPerson` int(11) NOT NULL,
  `phoneReserv` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pacm_reservation`
--

INSERT INTO `pacm_reservation` (`id`, `name`, `date`, `hour`, `numTable`, `numPerson`, `phoneReserv`, `created_at`, `updated_at`) VALUES
(1, 'test', '1999-02-10', '10:10:00', 45, 5, '0780808080', '2022-04-18 18:06:11', '2022-04-18 18:06:11'),
(2, 'test2', '2022-01-10', '10:10:00', 100, 2, '0780808080', '2022-04-18 21:50:06', '2022-04-18 21:50:06'),
(6, 'testlength', '2022-04-20', '10:45:00', 10, 10, '0780808080', '2022-04-21 20:35:20', '2022-04-21 20:35:20'),
(7, 'testlength', '2022-04-20', '10:45:00', 10, 10, '0780808080', '2022-04-21 20:35:25', '2022-04-21 20:35:25'),
(8, 'testlength', '2022-04-20', '10:45:00', 10, 10, '0780808080', '2022-04-21 20:35:26', '2022-04-21 20:35:26'),
(9, 'testlength', '2022-04-20', '10:45:00', 10, 10, '0780808080', '2022-04-21 20:35:28', '2022-04-21 20:35:28'),
(10, 'testlength', '2022-04-20', '10:45:00', 10, 10, '0780808080', '2022-04-21 20:35:29', '2022-04-21 20:35:29'),
(11, 'testlength', '2022-04-20', '10:45:00', 10, 10, '0780808080', '2022-04-21 20:35:31', '2022-04-21 20:35:31'),
(12, 'testlength', '2022-04-20', '10:45:00', 10, 10, '0780808080', '2022-04-21 20:35:32', '2022-04-21 20:35:32'),
(13, 'testlength', '2022-04-20', '10:45:00', 10, 10, '0780808080', '2022-04-21 20:35:35', '2022-04-21 20:35:35'),
(14, 'testlength', '2022-04-20', '10:45:00', 10, 10, '0780808080', '2022-04-21 20:35:37', '2022-04-21 20:35:37'),
(15, 'testlength', '2022-04-20', '10:45:00', 10, 10, '0780808080', '2022-04-21 20:35:38', '2022-04-21 20:35:38'),
(16, 'testlength', '2022-04-20', '10:45:00', 10, 10, '0780808080', '2022-04-21 20:35:39', '2022-04-21 20:35:39'),
(17, 'testlength', '2022-04-20', '10:45:00', 10, 10, '0780808080', '2022-04-21 20:35:40', '2022-04-21 20:35:40'),
(18, 'testlength', '2022-04-20', '10:45:00', 10, 10, '0780808080', '2022-04-21 20:35:41', '2022-04-21 20:35:41'),
(19, 'testlength', '2022-04-20', '10:45:00', 10, 10, '0780808080', '2022-04-21 20:35:42', '2022-04-21 20:35:42'),
(20, 'testlength', '2022-04-20', '10:45:00', 10, 10, '0780808080', '2022-04-21 20:35:43', '2022-04-21 20:35:43'),
(21, 'testlength', '2022-04-20', '10:45:00', 10, 10, '0780808080', '2022-04-21 20:35:48', '2022-04-21 20:35:48');

-- --------------------------------------------------------

--
-- Structure de la table `pacm_theme`
--

CREATE TABLE IF NOT EXISTS `pacm_theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pacm_theme`
--

INSERT INTO `pacm_theme` (`id`, `name`, `slug`, `path`) VALUES
(1, 'Theme 1', 'theme1', '/public/src/themes/theme1/'),
(2, 'Theme 2', 'theme2', '/public/src/themes/theme2/');

-- --------------------------------------------------------

--
-- Structure de la table `pacm_user`
--

CREATE TABLE IF NOT EXISTS `pacm_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(320) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) DEFAULT '0',
  `role` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `token` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pacm_user`
--

INSERT INTO `pacm_user` (`id`, `email`, `password`, `firstname`, `lastname`, `status`, `role`, `token`, `createdAt`, `updatedAt`) VALUES
(1, 'admin@admin.fr', '$2y$10$RmqsCm15R7YCsxFcTFlixONe0a3r1MPWwX3CmsvhtXKvd4LWA7KgK', 'Admin', 'ADMIN', 1, 'admin', NULL, '2022-05-06 13:48:09', '2022-05-06 13:48:09'),
(4, 'vivian.fr@free.fr', '$2y$10$p9IyP1AUR0P.hZSdE8gOluiSNOoliqxysUwR6DDeg7uPPXCCLYYDK', 'Vivian', 'RUHLMANN', 1, 'admin', NULL, '2022-05-06 23:38:29', '2022-05-09 20:45:15');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
