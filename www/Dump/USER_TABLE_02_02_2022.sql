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

-- Structure de la table `pacm_restaurant`
--

CREATE TABLE `pacm_restaurant` (
                                   `id` int(11) NOT NULL,
                                   `name` varchar(50) NOT NULL,
                                   `address` varchar(50) NOT NULL,
                                   `additional_address` varchar(100) DEFAULT NULL,
                                   `city` varchar(50) NOT NULL,
                                   `zipcode` int(50) DEFAULT NULL,
                                   `user_id` varchar(50) DEFAULT NULL,
                                   `phone` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pacm_restaurant`
--

INSERT INTO `pacm_restaurant` (`id`, `name`, `address`, `additional_address`, `city`, `zipcode`, `user_id`, `phone`) VALUES
    (106, 'test', 'Teste', 'Teste', 'STESTES', 1, NULL, 10);

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
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

REATE TABLE `pacm_page` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_theme` int(11) DEFAULT NULL,
  `id_restaurant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pacm_page`
--
ALTER TABLE `pacm_page`
    ADD PRIMARY KEY (`id`),
  ADD KEY `rest` (`id_restaurant`),
  ADD KEY `theme` (`id_theme`);
--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pacm_page`
--
ALTER TABLE `pacm_page`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `pacm_page`
--
ALTER TABLE `pacm_page`
    ADD CONSTRAINT `rest` FOREIGN KEY (`id_restaurant`) REFERENCES `pacm_restaurant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `theme` FOREIGN KEY (`id_theme`) REFERENCES `pacm_theme` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

CREATE TABLE `pacm_content` (
                                `id` int(11) NOT NULL,
                                `id_page` int(11) NOT NULL,
                                `body` text NOT NULL,
                                `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pacm_content`
--
ALTER TABLE `pacm_content`
    ADD PRIMARY KEY (`id`),
  ADD KEY `page` (`id_page`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pacm_page_content`
--
ALTER TABLE `pacm_content`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `pacm_page_content`
--
ALTER TABLE `pacm_content`
    ADD CONSTRAINT `page` FOREIGN KEY (`id_page`) REFERENCES `pacm_page` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;



CREATE TABLE `pacm_reservation` (
    `id` int(11) NOT NULL,
    `name` varchar(50) NOT NULL,
    `date` date NOT NULL,
    `hour` time NOT NULL,
    `numTable` int(11) NOT NULL,
    `numPerson` int(11) NOT NULL,
    `phoneReserv` char(10) NOT NULL,
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    `id_restaurant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Déchargement des données de la table `pacm_reservation`
--


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
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
