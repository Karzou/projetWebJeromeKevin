-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 02 juin 2021 à 12:47
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetwebjeromekevin`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse_entreprise`
--

DROP TABLE IF EXISTS `adresse_entreprise`;
CREATE TABLE IF NOT EXISTS `adresse_entreprise` (
  `id_entreprise` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom_entreprise` varchar(50) NOT NULL,
  `ville_entreprise` varchar(50) NOT NULL,
  PRIMARY KEY (`id_entreprise`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etudiants`
--

DROP TABLE IF EXISTS `etudiants`;
CREATE TABLE IF NOT EXISTS `etudiants` (
  `id_etudiant` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `mdp2` varchar(50) NOT NULL,
  `nom_etudiant` varchar(50) NOT NULL,
  `prenom_etudiant` varchar(50) NOT NULL,
  `stage_ok` int(11) DEFAULT NULL CHECK (`stage_ok` in (1,0)),
  PRIMARY KEY (`id_etudiant`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sujet_stage`
--

DROP TABLE IF EXISTS `sujet_stage`;
CREATE TABLE IF NOT EXISTS `sujet_stage` (
  `id_sujet` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `descriptif` varchar(255) DEFAULT NULL,
  `nom_superviseur` varchar(50) DEFAULT NULL,
  `num_stagiaire` int(10) UNSIGNED NOT NULL,
  `num_entreprise` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id_sujet`),
  KEY `fk_num_stagiaire` (`num_stagiaire`),
  KEY `fk_num_entreprise` (`num_entreprise`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Déclencheurs `sujet_stage`
--
DROP TRIGGER IF EXISTS `update_etudiant_after`;
DELIMITER $$
CREATE TRIGGER `update_etudiant_after` AFTER INSERT ON `sujet_stage` FOR EACH ROW BEGIN
	UPDATE etudiants
    SET stage_ok = 1
   	WHERE id_etudiant = NEW.num_stagiaire;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update_etudiant_after_delete`;
DELIMITER $$
CREATE TRIGGER `update_etudiant_after_delete` AFTER DELETE ON `sujet_stage` FOR EACH ROW BEGIN
IF NOT EXISTS(SELECT * FROM sujet_stage where num_stagiaire = OLD.num_stagiaire)
    
	THEN
	UPDATE etudiants
    SET stage_ok = 0
   	WHERE id_etudiant = OLD.num_stagiaire;
END IF;
END
$$
DELIMITER ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `sujet_stage`
--
ALTER TABLE `sujet_stage`
  ADD CONSTRAINT `fk_num_entreprise` FOREIGN KEY (`num_entreprise`) REFERENCES `adresse_entreprise` (`id_entreprise`),
  ADD CONSTRAINT `fk_num_stagiaire` FOREIGN KEY (`num_stagiaire`) REFERENCES `etudiants` (`id_etudiant`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
