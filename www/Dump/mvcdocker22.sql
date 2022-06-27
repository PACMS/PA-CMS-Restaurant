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


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvcdocker2`
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

--
-- Dumping data for table `pacm_carte`
--

INSERT INTO `pacm_carte` (`id`, `name`, `status`, `create_at`, `updated_at`, `id_restaurant`) VALUES
(1, 'Le Mezzo Yes', 1, '2022-05-06 18:28:36', '2022-05-20 09:11:43', 1),
(2, 'Test', 0, '2022-05-19 12:08:55', '2022-05-20 18:12:35', 1),
(3, 'Sunshine', 0, '2022-05-20 18:18:17', '2022-05-20 18:18:17', 1),
(4, 'Romain', 0, '2022-05-24 10:59:20', '2022-05-24 10:59:20', 1);

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

--
-- Dumping data for table `pacm_categorie`
--

INSERT INTO `pacm_categorie` (`id`, `name`, `id_carte`, `created_at`, `updated_at`) VALUES
(10, 'Entrées', 2, '2022-05-20 13:48:37', '2022-05-20 16:58:20'),
(11, 'Entrées', 1, '2022-05-20 16:36:49', '2022-05-20 16:36:49'),
(13, 'Desserts', 2, '2022-05-20 16:58:37', '2022-05-20 16:58:37'),
(14, 'Entrées', 3, '2022-05-20 18:18:35', '2022-05-20 18:18:35'),
(15, 'Plats', 3, '2022-05-20 18:19:39', '2022-05-20 18:19:39'),
(16, 'Desserts', 3, '2022-05-20 18:19:44', '2022-05-20 18:19:44'),
(17, 'Pizzas', 4, '2022-05-24 10:59:35', '2022-05-24 10:59:39');

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

--
-- Dumping data for table `pacm_meal`
--

INSERT INTO `pacm_meal` (`id`, `name`, `price`, `description`, `created_at`, `update_at`, `id_carte`, `id_categories`) VALUES
(18, 'Avocat', 4, 'test', '2022-05-20 13:48:47', '2022-05-20 16:58:28', 2, 10),
(19, 'Nom Du Menu', 18, 'lorem ipsum description, salades, tomates, oignons', '2022-05-20 16:37:03', '2022-05-20 16:37:03', 1, 11),
(20, 'Nom Du Chef', 18, 'lorem ipsum description, salades, tomates, oignons', '2022-05-20 16:37:25', '2022-05-24 20:24:55', 1, 11),
(21, 'Nom Du Menu', 18, 'lorem ipsum description, salades, tomates, oignons', '2022-05-20 16:37:38', '2022-05-20 16:37:38', 1, 11),
(24, 'Dessert', 78, 'oui\r\n', '2022-05-20 16:59:06', '2022-05-20 16:59:06', 2, 13),
(25, 'Ta Darrone La Tchoin', 1, '1€ symbolique tu connais', '2022-05-20 18:19:02', '2022-05-20 18:19:17', 3, 14),
(27, 'Ta Darrone La Tchoin', 1, '1€ symbolique tu connais', '2022-05-20 18:20:19', '2022-05-20 18:20:19', 3, 15),
(28, 'Ta Darrone La Tchoin', 1, '1€ symbolique tu connais', '2022-05-20 18:20:32', '2022-05-20 18:20:32', 3, 16),
(29, '67 Fromages', 4, 'pas mal', '2022-05-24 10:59:54', '2022-05-24 10:59:54', 4, 17);

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

--
-- Dumping data for table `pacm_reservation`
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
(49, 'Tomates', 'LÃ©gumes', 123, 41, '2022-06-26 23:14:44', NULL),
(51, 'Tomates', 'LÃ©gumes', 123456, 41, '2022-06-26 23:15:46', NULL),
(56, 'test', 'test2', 222, 40, '2022-06-26 23:01:15', NULL);

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

--
-- Déchargement des données de la table `pacm_restaurant`
--

INSERT INTO `pacm_restaurant` (`id`, `name`, `address`, `additional_address`, `city`, `zipcode`, `user_id`, `phone`) VALUES
(56, 'test33', 'Test2', 'Tt', 'PARISSSS', 111111, '13', 1111111),
(57, 'test', 'Test', 'Test', 'TEST', 1234, '13', 1234123);

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
(40, 56, '2022-06-24 19:52:59', NULL),
(41, 57, '2022-06-25 09:48:35', NULL);

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
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pacm_food`
--
ALTER TABLE `pacm_food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pour la table `pacm_restaurant`
--
ALTER TABLE `pacm_restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT pour la table `pacm_stock`
--
ALTER TABLE `pacm_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
-- Indexes for table `pacm_reservation`
--
ALTER TABLE `pacm_reservation`
  ADD PRIMARY KEY (`id`);




--
-- AUTO_INCREMENT for dumped tables
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
--
-- AUTO_INCREMENT for table `pacm_carte`
--
ALTER TABLE `pacm_carte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pacm_categorie`
--
ALTER TABLE `pacm_categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pacm_meal`
--
ALTER TABLE `pacm_meal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;



--
-- AUTO_INCREMENT for table `pacm_restaurant`
--
ALTER TABLE `pacm_restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pacm_user`
--
ALTER TABLE `pacm_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
