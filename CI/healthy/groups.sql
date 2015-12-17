-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 12 Août 2015 à 09:01
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `admin_workmeout`
--

-- --------------------------------------------------------

--
-- Structure de la table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `Seq` bigint(255) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) DEFAULT NULL,
  `TrainerSeq` int(11) DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `DateModified` datetime DEFAULT NULL,
  PRIMARY KEY (`Seq`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `groups`
--

INSERT INTO `groups` (`Seq`, `Name`, `TrainerSeq`, `CreateBy`, `DateModified`) VALUES
(1, 'group1', -1, -1, '2015-08-13 00:00:00'),
(2, 'group2', 2, 2, '2015-08-18 00:00:00'),
(4, 'group4', 2, -1, '2015-08-11 12:07:15');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
