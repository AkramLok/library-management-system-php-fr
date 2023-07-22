-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 19 mai 2023 à 11:29
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `biblio`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`) VALUES
(1, 'akram@gmail.com', '1234567'),
(3, 'ac@gmail.com', '1234567');

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

DROP TABLE IF EXISTS `emprunt`;
CREATE TABLE IF NOT EXISTS `emprunt` (
  `Emprunt_id` int NOT NULL AUTO_INCREMENT,
  `User_id` int NOT NULL,
  `Livre_id` int NOT NULL,
  `date_emprunt` datetime DEFAULT NULL,
  `date_retour` datetime DEFAULT NULL,
  PRIMARY KEY (`Emprunt_id`),
  KEY `User_id` (`User_id`),
  KEY `Livre_id` (`Livre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `emprunt`
--

INSERT INTO `emprunt` (`Emprunt_id`, `User_id`, `Livre_id`, `date_emprunt`, `date_retour`) VALUES
(2, 4, 1, '2023-05-14 00:11:58', '2023-05-19 15:59:00'),
(3, 4, 1, '2023-05-14 00:30:34', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `exemplaire`
--

DROP TABLE IF EXISTS `exemplaire`;
CREATE TABLE IF NOT EXISTS `exemplaire` (
  `Exemplaire_id` int NOT NULL AUTO_INCREMENT,
  `Livre_id` int NOT NULL,
  PRIMARY KEY (`Exemplaire_id`),
  KEY `Livre_idx` (`Livre_id`) INVISIBLE
) ENGINE=InnoDB AUTO_INCREMENT=238 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `exemplaire`
--

INSERT INTO `exemplaire` (`Exemplaire_id`, `Livre_id`) VALUES
(194, 5),
(195, 5),
(196, 5),
(197, 5),
(198, 5),
(199, 5),
(200, 5),
(201, 5),
(202, 5),
(203, 5),
(204, 5),
(205, 5),
(206, 5),
(207, 5),
(208, 5),
(214, 5),
(215, 5),
(216, 5),
(217, 5),
(218, 5),
(219, 5),
(220, 5),
(221, 5),
(222, 5),
(223, 5),
(224, 1),
(225, 1),
(226, 1),
(227, 1),
(228, 1),
(229, 1),
(230, 1),
(231, 1),
(232, 1),
(233, 1),
(234, 1),
(235, 1),
(236, 1),
(237, 1);

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `Livre_id` int NOT NULL AUTO_INCREMENT,
  `ISBN` varchar(255) NOT NULL,
  `titre_livre` varchar(70) DEFAULT NULL,
  `maison_edition` varchar(40) DEFAULT NULL,
  `Auteur` text,
  `Nb_des_pages` int DEFAULT NULL,
  `Nb_des_exemplaires` int DEFAULT NULL,
  PRIMARY KEY (`Livre_id`),
  UNIQUE KEY `ISBN` (`ISBN`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`Livre_id`, `ISBN`, `titre_livre`, `maison_edition`, `Auteur`, `Nb_des_pages`, `Nb_des_exemplaires`) VALUES
(1, '12451', 'jkj', 'bbv', 'df', 21, 15),
(2, '165', 'tyty', 'fh', 'ghj', 58, 0),
(5, '23', 'ty', 'fh', 'dg', 54, 0),
(8, '123', 'Analyse 1-Livre Future', 'Foena Edition', 'Omar John', 168, 0),
(9, '1234567891', 'azerty', 'fh', 'azertt', 42, 0),
(10, '1234567891234', 'ghh', 'fh', 'yt', 55, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `User_id` int NOT NULL AUTO_INCREMENT,
  `Nom` varchar(45) NOT NULL,
  `Prenom` varchar(45) NOT NULL,
  `Statut` varchar(45) DEFAULT NULL,
  `Adresse` text,
  `Email` varchar(255) DEFAULT NULL,
  `Nb_emprunt` int DEFAULT '0',
  PRIMARY KEY (`User_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`User_id`, `Nom`, `Prenom`, `Statut`, `Adresse`, `Email`, `Nb_emprunt`) VALUES
(4, 'ACHIBANE', 'Akram', 'Etudiant', 'Znagui Aourir Agadir', 'akram15191519@gmail.com', 2);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `Livre_id` FOREIGN KEY (`Livre_id`) REFERENCES `livre` (`Livre_id`),
  ADD CONSTRAINT `User_id` FOREIGN KEY (`User_id`) REFERENCES `users` (`User_id`);

--
-- Contraintes pour la table `exemplaire`
--
ALTER TABLE `exemplaire`
  ADD CONSTRAINT `Livre_idx` FOREIGN KEY (`Livre_id`) REFERENCES `livre` (`Livre_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
