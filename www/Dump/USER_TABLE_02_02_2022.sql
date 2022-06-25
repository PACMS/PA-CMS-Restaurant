-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql
-- Généré le : ven. 15 avr. 2022 à 10:17
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
-- Structure de la table `pacm_user`
--

CREATE TABLE `pacm_user` (
  `id` int(11) NOT NULL,
  `email` varchar(320) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(25) DEFAULT NULL,
  `lastname` text,
  `status` tinyint(4) DEFAULT '0',
  `role` varchar(8) NOT NULL DEFAULT 'user',
  `token` char(255) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pacm_user`
--
ALTER TABLE `pacm_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pacm_user`
--
ALTER TABLE `pacm_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Structure de la table `pacm_reservation`
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

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pacm_reservation`
--
ALTER TABLE `pacm_reservation`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pacm_reservation`
--
ALTER TABLE `pacm_reservation`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE `pacm_stock` (
  `id` int(11) NOT NULL,
  `restaurantId` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedAt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pacm_stock`
--
ALTER TABLE `pacm_stock`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pacm_stock`
--
ALTER TABLE `pacm_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE `pacm_restaurant` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `additional_address` varchar(100) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `zipcode` int(50) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NOT NULL,
  `phone` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pacm_restaurant`
--
ALTER TABLE `pacm_restaurant`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pacm_restaurant`
--
ALTER TABLE `pacm_restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE `pacm_food` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `nature` varchar(50) NOT NULL,
  `quantity` int(10) DEFAULT NULL,
  `stockId` int(10) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pacm_food`
--
ALTER TABLE `pacm_food`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pacm_food`
--
ALTER TABLE `pacm_food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;