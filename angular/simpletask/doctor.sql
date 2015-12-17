-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 21 Juillet 2015 à 08:34
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `doctor`
--

-- --------------------------------------------------------

--
-- Structure de la table `doctor`
--

CREATE TABLE IF NOT EXISTS `doctor` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_practice` int(11) DEFAULT NULL,
  `image_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `occupation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `doctor`
--

INSERT INTO `doctor` (`id`, `id_practice`, `image_logo`, `title`, `name`, `occupation`) VALUES
(1, 1, 'doc_profile1.png', 'titletúngns', 'doctor1', '123123'),
(2, 2, 'doc_profile2.png', 'Dr', 'James Lachlan', 'General Practioner'),
(3, 2, 'doc_profile3.png', '123123', 'tung1122', '123123'),
(6, 6, '6 retail trends that will change how we shop in 2015.jpg', 'Dr', 'John Dow', 'Physio');

-- --------------------------------------------------------

--
-- Structure de la table `roster`
--

CREATE TABLE IF NOT EXISTS `roster` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_doctor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_roster` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=51 ;

--
-- Contenu de la table `roster`
--

INSERT INTO `roster` (`id`, `id_doctor`, `dt_roster`) VALUES
(1, '1', '2015-07-19'),
(19, '1', '2015-07-16'),
(20, '1', '2015-07-24'),
(21, '1', '2015-07-22'),
(22, '1', '2015-07-23'),
(23, '1', '2015-08-18'),
(24, '1', '2016-01-27'),
(25, '1', '2015-07-17'),
(26, '1', '2015-07-25'),
(27, '1', '2015-06-23'),
(28, '1', '2015-06-24'),
(30, '2', '2015-07-22'),
(31, '2', '2015-07-20'),
(32, '3', '2015-07-15'),
(34, '3', '2015-07-16'),
(35, '3', '2015-07-20'),
(36, '3', '2015-07-21'),
(37, '3', '2015-07-24'),
(38, '3', '2015-07-25'),
(39, '3', '2015-07-22'),
(40, '3', '2015-07-23'),
(41, '6', '2015-07-15'),
(42, '6', '2015-07-16'),
(43, '6', '2015-07-17'),
(44, '6', '2015-07-24'),
(45, '6', '2015-07-23'),
(46, '6', '2015-07-30'),
(47, '6', '2015-07-22'),
(49, '2', '2015-07-23');

-- --------------------------------------------------------

--
-- Structure de la table `slide`
--

CREATE TABLE IF NOT EXISTS `slide` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_practice` int(11) DEFAULT NULL,
  `image_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=10 ;

--
-- Contenu de la table `slide`
--

INSERT INTO `slide` (`id`, `id_practice`, `image_logo`, `position`, `modified`) VALUES
(3, 2, 'img_sick.png', NULL, '2015-07-20 11:22:39'),
(6, 6, 'Dubai Digital Signage.jpg', NULL, '2015-07-21 12:19:29'),
(7, 6, 'HDMI Video Extenders CAT5E.jpg', NULL, '2015-07-21 12:19:39'),
(9, 2, '55adcc3597df3Penguins.jpg', NULL, '2015-07-21 02:36:05');

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_practice` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `status`
--

INSERT INTO `status` (`id`, `id_practice`, `modified`) VALUES
(3, 3, '2015-07-21 16:31:24');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acc_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `name`, `address`, `title`, `image_logo`, `acc_type`) VALUES
(1, 'admin@gmail.com', '123456', NULL, NULL, NULL, NULL, '1'),
(2, 'practice1@gmail.com', '123', 'City Medical', 'Sydney NSW Australia 2000', 'Welcome to City Medical Centre', 'img_logo copy.png', '2'),
(3, 'practice34@gmail.com', '0', 'practice3', 'title3', 'title45', '1480690_10201233156574563_191462113_n.jpg', '2'),
(6, 'mm@gmail.com', 'password', 'AM', '12 high st, Sydney', 'Welcome to AM Medical Centre', 'AM-mobi.png', '2');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
