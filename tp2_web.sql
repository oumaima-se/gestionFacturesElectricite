-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 30, 2021 at 11:15 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tp2_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent`
--

DROP TABLE IF EXISTS `agent`;
CREATE TABLE IF NOT EXISTS `agent` (
  `ID_agent` int(11) NOT NULL,
  `Nom` varchar(35) NOT NULL,
  `Prenom` varchar(35) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL,
  PRIMARY KEY (`ID_agent`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agent`
--

INSERT INTO `agent` (`ID_agent`, `Nom`, `Prenom`, `username`, `password`) VALUES
(1, 'Salmi', 'Taha', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `ID_client` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(35) NOT NULL,
  `Prenom` varchar(35) NOT NULL,
  `Adresse` varchar(200) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL,
  PRIMARY KEY (`ID_client`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`ID_client`, `Nom`, `Prenom`, `Adresse`, `username`, `password`) VALUES
(1, 'Zitouni', 'Ahmed', '4 rue la belle vie Casablanca', 'ahmed', 'ahmed'),
(2, 'Sarghini', 'Salwa', 'av 9 avril Tetouan', 'salwa', 'motdepasse'),
(3, 'Bahri', 'Deyae', 'HAY Moulay Abdellah rue 270 numero 80 Casablanca', 'deyae', 'deyae');

-- --------------------------------------------------------

--
-- Table structure for table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `ID_facture` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `ID_client` int(11) NOT NULL,
  `consommation_cumule` float NOT NULL,
  `Consommation_mensuelle` float NOT NULL,
  `prix_ht` float NOT NULL,
  `Prix_total` float NOT NULL,
  `statut` int(1) NOT NULL,
  PRIMARY KEY (`ID_facture`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facture`
--

INSERT INTO `facture` (`ID_facture`, `Date`, `ID_client`, `consommation_cumule`, `Consommation_mensuelle`, `prix_ht`, `Prix_total`, `statut`) VALUES
(23, '2021-01-13', 2, 13, 13, 11.83, 13.4862, 0),
(24, '2021-02-17', 2, 26, 13, 11.83, 13.4862, 0),
(25, '2021-03-04', 2, 66, 40, 36.4, 41.496, 0),
(26, '2021-04-05', 2, 83, 17, 15.47, 17.6358, 0),
(27, '2021-05-19', 2, 100, 17, 15.47, 17.6358, 0),
(28, '2021-09-22', 2, 500, 400, 448, 510.72, 0),
(29, '2021-12-14', 2, 650, 150, 151.5, 172.71, 0),
(30, '2021-02-02', 1, 13, 13, 11.83, 13.4862, 0),
(31, '2021-03-24', 1, 31, 18, 16.38, 18.6732, 0),
(32, '2021-06-08', 1, 41, 10, 9.1, 10.374, 0),
(33, '2021-08-17', 1, 78, 37, 33.67, 38.3838, 0),
(34, '2021-11-17', 1, 88, 10, 9.1, 10.374, 0),
(36, '2021-12-03', 1, 109, 21, 19.11, 21.7854, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fichier_consommation`
--

DROP TABLE IF EXISTS `fichier_consommation`;
CREATE TABLE IF NOT EXISTS `fichier_consommation` (
  `ID_fichier` int(11) NOT NULL AUTO_INCREMENT,
  `ID_client` int(11) NOT NULL,
  `Consommation_annuelle` float NOT NULL,
  `Annee` year(4) NOT NULL,
  PRIMARY KEY (`ID_fichier`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fichier_consommation`
--

INSERT INTO `fichier_consommation` (`ID_fichier`, `ID_client`, `Consommation_annuelle`, `Annee`) VALUES
(19, 2, 654, 2021),
(18, 2, 63, 2020),
(20, 1, 200, 2021);

-- --------------------------------------------------------

--
-- Table structure for table `reponses`
--

DROP TABLE IF EXISTS `reponses`;
CREATE TABLE IF NOT EXISTS `reponses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ticket` int(11) NOT NULL,
  `quand` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text NOT NULL,
  `poste_par` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reponses`
--

INSERT INTO `reponses` (`id`, `id_ticket`, `quand`, `message`, `poste_par`) VALUES
(4, 5, '2021-04-28 01:26:18', 'resolu !', 'Support'),
(5, 6, '2021-04-28 01:32:25', 'sdsfdfd', 'Membre'),
(6, 6, '2021-04-28 02:22:40', 'pardon', 'Support');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL,
  `mail_du_membre` varchar(50) NOT NULL,
  `sujet` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `priorite` tinyint(1) NOT NULL DEFAULT '0',
  `etat` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `id_membre`, `mail_du_membre`, `sujet`, `message`, `priorite`, `etat`) VALUES
(5, 1, 'ayoubyam@gmail.com', 'reclamation n1', 'je veux reclamer un petit soucis', 3, 0),
(6, 2, 'aelyamani330@gmail.com', 'test1', 'ssssss', 1, 0),
(7, 2, 'aelyamani330@gmail.com', 'rec 3', 'saluut voice ma recla', 3, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
