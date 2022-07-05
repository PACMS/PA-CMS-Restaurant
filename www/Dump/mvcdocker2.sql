-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le : mar. 28 juin 2022 à 00:12
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

--
-- Déchargement des données de la table `pacm_carte`
--

INSERT INTO `pacm_carte` (`id`, `name`, `status`, `create_at`, `updated_at`, `id_restaurant`) VALUES
(23, 'Test', 0, '2022-06-27 22:19:57', '2022-06-27 22:19:57', 73);

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

--
-- Déchargement des données de la table `pacm_categorie`
--

INSERT INTO `pacm_categorie` (`id`, `name`, `id_carte`, `created_at`, `updated_at`) VALUES
(30, 'THIBAUT', 23, '2022-06-27 22:37:43', '2022-06-27 22:37:43');

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

--
-- Déchargement des données de la table `pacm_food`
--

INSERT INTO `pacm_food` (`id`, `name`, `nature`, `quantity`, `stockId`, `createdAt`, `updatedAt`) VALUES
(4, 'Tomates', 'legume', 10, 50, '2022-06-27 22:21:43', NULL),
(5, 'Pates', 'pates', 20, 50, '2022-06-27 22:21:51', NULL);

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

--
-- Déchargement des données de la table `pacm_meal`
--

INSERT INTO `pacm_meal` (`id`, `name`, `price`, `description`, `created_at`, `update_at`, `id_carte`, `id_categories`) VALUES
(42, 'Test', 12, '', '2022-06-27 22:37:47', '2022-06-27 22:37:47', 23, 30),
(75, 'Crepes', 12, '', '2022-06-27 23:54:10', '2022-06-27 23:54:10', 23, 30),
(113, 'ITS MORBIN TIME', 12, '', '2022-06-28 00:05:59', '2022-06-28 00:05:59', 23, 30),
(114, 'TEST', 12, '', '2022-06-28 00:06:22', '2022-06-28 00:06:22', 23, 30);

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

INSERT INTO `pacm_mealsFoods` (`id`, `meal_id`, `food_id`) VALUES
(5, 75, 4),
(6, 75, 5),
(13, 113, 4),
(14, 113, 5),
(15, 114, 5);

-- --------------------------------------------------------

--
-- Structure de la table `pacm_reservation`
--

CREATE TABLE `pacm_reservation` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(320) NOT NULL,
  `date` date NOT NULL,
  `hour` time NOT NULL,
  `numTable` int(11) NOT NULL,
  `numPerson` int(11) NOT NULL,
  `phoneReserv` char(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Structure de la table `pacm_restaurant`
--

CREATE TABLE `pacm_restaurant` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `additional_address` varchar(100) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `zipcode` int(50) DEFAULT NULL,
  `user_id` int(50) NOT NULL,
  `phone` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pacm_restaurant`
--

INSERT INTO `pacm_restaurant` (`id`, `name`, `address`, `additional_address`, `city`, `zipcode`, `user_id`, `phone`) VALUES
(73, 'Barrière', '12 Rue Berthier', '12 Rue Berthier', 'YERRES', 91330, 3, 651588687);

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

INSERT INTO `pacm_stock` (`id`, `restaurantId`, `createdAt`, `updatedAt`) VALUES
(50, 73, '2022-06-27 22:10:13', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `pacm_user`
--

CREATE TABLE `pacm_user` (
  `id` int(11) NOT NULL,
  `email` varchar(320) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `pacm_user` (`id`, `email`, `password`, `firstname`, `lastname`, `status`, `role`, `token`, `createdAt`, `updatedAt`) VALUES
(3, 'jeremie@test.com', '$2y$10$Fs75b8.PP89m6tsLdyq/A.GRWnz70/fZhxKqiQZYQM0G0kfZkhF4q', 'jere', 'barr', 1, 'admin', NULL, '2022-06-27 10:15:04', '2022-06-27 10:15:04');

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
-- Index pour la table `pacm_food`
--
ALTER TABLE `pacm_food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stockId` (`stockId`);

--
-- Index pour la table `pacm_meal`
--
ALTER TABLE `pacm_meal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorieDeleteMeal` (`id_categories`),
  ADD KEY `carteDeleteMeal` (`id_carte`);

--
-- Index pour la table `pacm_mealsFoods`
--
ALTER TABLE `pacm_mealsFoods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mealDeleteFoods` (`meal_id`),
  ADD KEY `foodDeleteFood` (`food_id`);

--
-- Index pour la table `pacm_reservation`
--
ALTER TABLE `pacm_reservation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pacm_restaurant`
--
ALTER TABLE `pacm_restaurant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userDeleteRestaurants` (`user_id`);

--
-- Index pour la table `pacm_stock`
--
ALTER TABLE `pacm_stock`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `restaurantId` (`restaurantId`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `pacm_categorie`
--
ALTER TABLE `pacm_categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `pacm_food`
--
ALTER TABLE `pacm_food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `pacm_meal`
--
ALTER TABLE `pacm_meal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT pour la table `pacm_mealsFoods`
--
ALTER TABLE `pacm_mealsFoods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `pacm_restaurant`
--
ALTER TABLE `pacm_restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT pour la table `pacm_stock`
--
ALTER TABLE `pacm_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT pour la table `pacm_user`
--
ALTER TABLE `pacm_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `pacm_reservation`
--
ALTER TABLE `pacm_reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

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
-- Contraintes pour la table `pacm_mealsFoods`
--
ALTER TABLE `pacm_mealsFoods`
  ADD CONSTRAINT `foodDeleteFood` FOREIGN KEY (`food_id`) REFERENCES `pacm_food` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mealDeleteFoods` FOREIGN KEY (`meal_id`) REFERENCES `pacm_meal` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pacm_restaurant`
--
ALTER TABLE `pacm_restaurant`
  ADD CONSTRAINT `userDeleteRestaurants` FOREIGN KEY (`user_id`) REFERENCES `pacm_user` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pacm_stock`
--
ALTER TABLE `pacm_stock`
  ADD CONSTRAINT `restauDeleteStock` FOREIGN KEY (`restaurantId`) REFERENCES `pacm_restaurant` (`id`) ON DELETE CASCADE;
COMMIT;

--
-- Table structure for table `pacm_comments`
--

CREATE TABLE `pacm_comments` (
  `id` bigint(20) NOT NULL,
  `content` varchar(400) NOT NULL,
  `id_parent` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `id_restaurant` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pacm_comments`
--
ALTER TABLE `pacm_comments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pacm_comments`
--
ALTER TABLE `pacm_comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
