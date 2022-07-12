-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le : sam. 09 juil. 2022 à 17:13
-- Version du serveur : 5.7.35
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
-- Structure de la table `pacm_carte`
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
-- Structure de la table `pacm_categorie`
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
-- Structure de la table `pacm_comments`
--

CREATE TABLE `pacm_comments` (
  `id` bigint(20) NOT NULL,
  `content` varchar(400) NOT NULL,
  `status` tinyint(1)  NULL DEFAULT '0',
  `id_parent` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `id_restaurant` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pacm_content`
--

CREATE TABLE `pacm_content` (
  `id` int(11) NOT NULL,
  `id_page` int(11) NOT NULL,
  `body` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pacm_content`
--



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
-- Structure de la table `pacm_meal`
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
-- Structure de la table `pacm_mealsFoods`
--

CREATE TABLE `pacm_mealsFoods` (
  `id` int(11) NOT NULL,
  `meal_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pacm_mealsFoods`
--



-- --------------------------------------------------------

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

-- --------------------------------------------------------

--
-- Structure de la table `pacm_page`
--

CREATE TABLE `pacm_page` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `display_menu` tinyint(1) NOT NULL DEFAULT '0',
  `display_comments` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_theme` int(11) DEFAULT NULL,
  `id_restaurant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pacm_page`
--



-- --------------------------------------------------------

--
-- Structure de la table `pacm_reservation`
--

CREATE TABLE `pacm_reservation` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(320) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `hour` time NOT NULL,
  `numTable` int(11) NOT NULL,
  `numPerson` int(11) NOT NULL,
  `phoneReserv` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `id_restaurant` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `pacm_restaurant`
--

CREATE TABLE `pacm_restaurant` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `additional_address` varchar(100) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `zipcode` int(50) DEFAULT NULL,
  `user_id` varchar(50) NOT NULL,
  `phone` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pacm_restaurant`
--


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

--
-- Déchargement des données de la table `pacm_stock`
--



-- --------------------------------------------------------

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

-- --------------------------------------------------------

--
-- Structure de la table `pacm_user`
--

CREATE TABLE `pacm_user` (
  `id` int(11) NOT NULL,
  `email` varchar(320) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL ,
  `firstname` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) DEFAULT '0',
  `role` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `token` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pacm_user`
--


--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pacm_carte`
--
ALTER TABLE `pacm_carte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurantDeleteCards` (`id_restaurant`);

--
-- Index pour la table `pacm_categorie`
--
ALTER TABLE `pacm_categorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carteDeleteCategorie` (`id_carte`);

--
-- Index pour la table `pacm_comments`
--
ALTER TABLE `pacm_comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pacm_content`
--
ALTER TABLE `pacm_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page` (`id_page`);

--
-- Index pour la table `pacm_food`
--
ALTER TABLE `pacm_food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stockDeleteFood` (`stockId`);

--
-- Index pour la table `pacm_meal`
--
ALTER TABLE `pacm_meal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carteDeleteMeal` (`id_carte`),
  ADD KEY `categorieDeleteMeal` (`id_categories`);

--
-- Index pour la table `pacm_mealsFoods`
--
ALTER TABLE `pacm_mealsFoods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mealDeleteFoods` (`meal_id`),
  ADD KEY `foodDeleteFood` (`food_id`);

--
-- Index pour la table `pacm_option`
--
ALTER TABLE `pacm_option`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pacm_page`
--
ALTER TABLE `pacm_page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rest` (`id_restaurant`),
  ADD KEY `theme` (`id_theme`);

--
-- Index pour la table `pacm_reservation`
--
ALTER TABLE `pacm_reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_restaurant` (`id_restaurant`);

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
-- Index pour la table `pacm_theme`
--
ALTER TABLE `pacm_theme`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pacm_user`
--
ALTER TABLE `pacm_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pacm_carte`
--
ALTER TABLE `pacm_carte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pacm_categorie`
--
ALTER TABLE `pacm_categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pacm_comments`
--
ALTER TABLE `pacm_comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pacm_content`
--
ALTER TABLE `pacm_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `pacm_food`
--
ALTER TABLE `pacm_food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pacm_meal`
--
ALTER TABLE `pacm_meal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pacm_mealsFoods`
--
ALTER TABLE `pacm_mealsFoods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `pacm_option`
--
ALTER TABLE `pacm_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `pacm_page`
--
ALTER TABLE `pacm_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `pacm_reservation`
--
ALTER TABLE `pacm_reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `pacm_restaurant`
--
ALTER TABLE `pacm_restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT pour la table `pacm_stock`
--
ALTER TABLE `pacm_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT pour la table `pacm_theme`
--
ALTER TABLE `pacm_theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `pacm_user`
--
ALTER TABLE `pacm_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

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
