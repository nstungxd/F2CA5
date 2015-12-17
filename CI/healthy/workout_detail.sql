-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Sam 22 Août 2015 à 20:46
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `admin_workmeout`
--

-- --------------------------------------------------------

--
-- Structure de la table `workout_detail`
--

CREATE TABLE IF NOT EXISTS `workout_detail` (
  `Seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `WorkoutSeq` int(11) DEFAULT NULL,
  `ExerciseSeq` int(11) DEFAULT NULL,
  `Input1` int(11) DEFAULT NULL,
  `Value1` varchar(255) DEFAULT NULL,
  `Input2` int(11) DEFAULT NULL,
  `Value2` varchar(255) DEFAULT NULL,
  `Input3` int(11) DEFAULT NULL,
  `Value3` varchar(255) DEFAULT NULL,
  `Position` int(11) DEFAULT NULL,
  PRIMARY KEY (`Seq`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `workout_detail`
--

