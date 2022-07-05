-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le : ven. 06 mai 2022 à 13:45
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `pacms_restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `pacm_carte`
--

CREATE TABLE `pacm_carte` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_restaurant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pacm_categorie`
--

CREATE TABLE `pacm_categorie` (
  `id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_carte` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pacm_meal`
--

CREATE TABLE `pacm_meal` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `price` float NOT NULL,
  `description` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_carte` int(11) NOT NULL,
  `id_categories` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pacm_reservation`
--

CREATE TABLE `pacm_reservation` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `hour` time NOT NULL,
  `numTable` int(11) NOT NULL,
  `numPerson` int(11) NOT NULL,
  `phoneReserv` char(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pacm_food`
--

CREATE TABLE `pacm_food` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `nature` varchar(50) DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `stockId` int(10) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pacm_restaurant`
--

CREATE TABLE `pacm_restaurant` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `additional_address` varchar(100) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `zipcode` int(50) DEFAULT NULL,
  `user_id` varchar(50) NOT NULL,
  `phone` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pacm_stock`
--

CREATE TABLE `pacm_stock` (
  `id` int(11) NOT NULL,
  `restaurantId` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedAt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------



--
-- Index pour la table `pacm_food`
--
ALTER TABLE `pacm_food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stockId` (`stockId`);

--
-- Index pour la table `pacm_restaurant`
--
ALTER TABLE `pacm_restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pacm_stock`
--
ALTER TABLE `pacm_stock`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `restaurantId` (`restaurantId`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `pacm_food`
--
ALTER TABLE `pacm_food`
  ADD CONSTRAINT `stockDeleteFood` FOREIGN KEY (`stockId`) REFERENCES `pacm_stock` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pacm_stock`
--
ALTER TABLE `pacm_stock`
  ADD CONSTRAINT `restauDeleteStock` FOREIGN KEY (`restaurantId`) REFERENCES `pacm_restaurant` (`id`) ON DELETE CASCADE;
COMMIT;


-- --------------------------------------------------------

--
-- Table structure for table `pacm_user`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pacm_user`
--
ALTER TABLE `pacm_categorie`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `pacm_carte`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `pacm_meal`
  ADD PRIMARY KEY (`id`);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;


--
-- Structure de la table `pacm_option`
--

CREATE TABLE `pacm_option` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pacm_option`
--

INSERT INTO `pacm_option` (`id`, `name`, `value`) VALUES
(1, 'Theme', '2');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pacm_option`
--
ALTER TABLE `pacm_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pacm_reservation`
--
ALTER TABLE `pacm_reservation`
  ADD PRIMARY KEY (`id`);

--
-- Structure de la table `pacm_theme`
--

CREATE TABLE `pacm_theme` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pacm_theme`
--

INSERT INTO `pacm_theme` (`id`, `name`, `slug`, `path`) VALUES
(1, 'Theme 1', 'theme1', '/public/src/themes/theme1/'),
(2, 'Theme 2', 'theme2', '/public/src/themes/theme2/');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pacm_theme`
--
ALTER TABLE `pacm_theme`
  ADD PRIMARY KEY (`id`);