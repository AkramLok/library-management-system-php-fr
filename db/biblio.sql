-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 19 mai 2023 à 11:55
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=318 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `exemplaire`
--

INSERT INTO `exemplaire` (`Exemplaire_id`, `Livre_id`) VALUES
(258, 12),
(259, 12),
(260, 12),
(261, 12),
(262, 12),
(263, 12),
(264, 12),
(265, 12),
(266, 12),
(267, 12),
(268, 12),
(269, 12),
(270, 12),
(271, 12),
(272, 12),
(273, 12),
(274, 12),
(275, 12),
(276, 12),
(277, 12),
(278, 12),
(279, 12),
(280, 12),
(281, 12),
(282, 12),
(283, 12),
(284, 12),
(285, 12),
(286, 12),
(287, 12),
(288, 13),
(289, 13),
(290, 13),
(291, 13),
(292, 13),
(293, 13),
(294, 13),
(295, 13),
(296, 13),
(297, 13),
(298, 13),
(299, 13),
(300, 13),
(301, 13),
(302, 13),
(303, 13),
(304, 13),
(305, 13),
(306, 13),
(307, 13),
(308, 14),
(309, 14),
(310, 14),
(311, 14),
(312, 14),
(313, 14),
(314, 14),
(315, 14),
(316, 14),
(317, 14);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`Livre_id`, `ISBN`, `titre_livre`, `maison_edition`, `Auteur`, `Nb_des_pages`, `Nb_des_exemplaires`) VALUES
(12, '1111111111', 'Analyse 1', 'A1', 'Anas', 167, 30),
(13, '2222222222', 'Algèbre', 'A2', 'Omar', 235, 20),
(14, '3333333333', 'Electronique', 'B1', 'Oussama', 133, 10);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`User_id`, `Nom`, `Prenom`, `Statut`, `Adresse`, `Email`, `Nb_emprunt`) VALUES
(7, 'ACHIBANE', 'Akram', 'Etudiant', 'Hay Mohammedi Agadir', 'akram@gmail.com', 0),
(8, 'TARBI', 'Achraf', 'Etudiant', 'Tilila Agadir', 'achraf12@gmail.com', 0),
(9, 'BONO', 'Yassine', 'Enseignant', 'Sevilla Spain', 'bono3456@gmail.com', 0);

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
