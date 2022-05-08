-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 21 avr. 2022 à 14:54
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `auto_enchere`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

DROP TABLE IF EXISTS `annonce`;
CREATE TABLE IF NOT EXISTS `annonce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_vendeur` int(11) DEFAULT NULL,
  `prix_depart` float NOT NULL,
  `marque` varchar(255) NOT NULL,
  `modele` varchar(255) NOT NULL,
  `annee` text NOT NULL,
  `kilometre` int(11) NOT NULL,
  `energie` varchar(255) NOT NULL,
  `puissance` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_fin_annonce` date NOT NULL,
  `user_prenom` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `annonce_ibfk_2` (`user_prenom`),
  KEY `annonce_ibfk_1` (`id_user_vendeur`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`id`, `id_user_vendeur`, `prix_depart`, `marque`, `modele`, `annee`, `kilometre`, `energie`, `puissance`, `description`, `date_fin_annonce`, `user_prenom`) VALUES
(8, NULL, 20000, 'MERCEDES', 'CLIO', '2000', 3, 'ESSENCE', 28, 'TOP', '2022-04-21', NULL),
(9, 10, 20000, 'MERCEDES', 'CLIO', '2000', 3, 'ESSENCE', 28, 'TOP', '2022-04-21', NULL),
(10, 10, 23000, 'RENAULT', 'CLIO', '2020', 2, 'ESSENCE', 28, 'Sauvegarde Aruba', '2022-04-28', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

DROP TABLE IF EXISTS `enchere`;
CREATE TABLE IF NOT EXISTS `enchere` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_annonce` int(11) NOT NULL,
  `id_user_acheteur` int(11) NOT NULL,
  `prix_propose` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `enchere_ibfk_2` (`id_user_acheteur`),
  KEY `enchere_ibfk_1` (`id_annonce`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `enchere`
--

INSERT INTO `enchere` (`id`, `id_annonce`, `id_user_acheteur`, `prix_propose`) VALUES
(18, 10, 10, 24000),
(21, 8, 11, 21000);

-- --------------------------------------------------------

--
-- Structure de la table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_acheteur` int(11) NOT NULL,
  `id_user_vendeur` int(11) NOT NULL,
  `id_annonce` int(11) NOT NULL,
  `date_vente` datetime DEFAULT CURRENT_TIMESTAMP,
  `prix_vente` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user_acheteur` (`id_user_acheteur`),
  KEY `id_user_vendeur` (`id_user_vendeur`),
  KEY `id_annonce` (`id_annonce`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `prenom` (`prenom`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `email`, `password`) VALUES
(4, 'LASTICOT', 'JOJO', 'JOJO@LASTICOT.FR', '$2y$10$LbS3mtKiNydGGKUIdFSqyOELruWIFcl0PvgBlHzTkavLOFslSeiRi'),
(6, 'LASTICOT', 'Jojo', 'jojo@live.fr', '$2y$10$1BtVBqHH4OMzlm/gKv5RX.TejxdzcU5kBpDUfOkb.Py1jSHsUHwfe'),
(7, 'edouard', 'maindargent', 'doudou@live.fr', '$2y$10$Eu4pk5yibaQMMxfGXrG6JenNfKe5oE1JbQ.JVOFcPMsRVuDJ/honm'),
(9, 'eliot', 'belzunces', 'eliot@live.com', '$2y$10$ItLB0aEs5pzmF2JbWTHVN.eeFeDDH29o.rH16gI5e96.i5H/FOhI2'),
(10, 'belzunces', 'eliot', 'nws@live.fr', '$2y$10$jEM0x18HMwiT8ytYQBBIYuuZ9giPeYRxf0ZnkWWH.zWr3Yex2djbe'),
(11, 'Dumas-Miton', 'StÃ©phane', 'courtelem@gmail.com', '$2y$10$gOEhZhgBRTqjKygyDCahXuyRXpaom9HXexYRTEygbAWYbNjPlUJny');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD CONSTRAINT `annonce_ibfk_1` FOREIGN KEY (`id_user_vendeur`) REFERENCES `user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `annonce_ibfk_2` FOREIGN KEY (`user_prenom`) REFERENCES `user` (`prenom`);

--
-- Contraintes pour la table `enchere`
--
ALTER TABLE `enchere`
  ADD CONSTRAINT `enchere_ibfk_1` FOREIGN KEY (`id_annonce`) REFERENCES `annonce` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`id_user_acheteur`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`id_user_vendeur`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`id_annonce`) REFERENCES `annonce` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
