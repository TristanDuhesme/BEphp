-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 23, 2018 at 06:34 PM
-- Server version: 10.1.26-MariaDB-0+deb9u1
-- PHP Version: 7.0.27-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdlibrairie`
--

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

CREATE TABLE `commandes` (
  `idcmd` int(11) NOT NULL,
  `idpersonne` int(11) NOT NULL,
  `date` date NOT NULL,
  `validee` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`idcmd`, `idpersonne`, `date`, `validee`) VALUES
(12, 2, '2010-02-08', 1),
(13, 2, '2010-02-08', 0),
(14, 9, '2018-01-23', 0),
(15, 9, '2018-01-23', 1),
(16, 15, '2012-02-06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lignescmd`
--

CREATE TABLE `lignescmd` (
  `idcmd` int(11) NOT NULL,
  `idouvrage` int(11) NOT NULL,
  `qte` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lignescmd`
--

INSERT INTO `lignescmd` (`idcmd`, `idouvrage`, `qte`) VALUES
(12, 1, 1),
(12, 3, 2),
(12, 5, 3),
(13, 1, 4),
(13, 2, 5),
(13, 3, 6),
(15, 4, 1),
(15, 4, 7),
(15, 5, 1),
(15, 7, 4),
(16, 4, 1),
(16, 6, 7);

-- --------------------------------------------------------

--
-- Table structure for table `ouvrages`
--

CREATE TABLE `ouvrages` (
  `idouvrage` int(11) NOT NULL,
  `titre` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `auteur` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `prix` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ouvrages`
--

INSERT INTO `ouvrages` (`idouvrage`, `titre`, `auteur`, `prix`) VALUES
(1, 'Begriffsschrift', 'Gottlob Frege', '9.00'),
(2, 'Logicomix', 'Apóstolos K. Doxiàdis & Christos Papadimitriou', '7.60'),
(3, 'Oncle Petros et la conjecture de Goldbach', 'Apóstolos K. Doxiàdis', '9.00'),
(4, 'Du spirituel dans l\'art, et dans la peinture en particulier', 'Wassily Kandinsky', '12.50'),
(5, 'Histoires vraies', 'Lucien de Samosate', '9.30'),
(6, '1984', 'George Orwell', '10.40'),
(7, 'La vie de Galilée', 'Berthold Brecht', '20.00'),
(8, 'Richard III', 'William Shakespeare', '23.00');

-- --------------------------------------------------------

--
-- Table structure for table `personnes`
--

CREATE TABLE `personnes` (
  `idpersonne` int(11) NOT NULL,
  `nom` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `libraire` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `personnes`
--

INSERT INTO `personnes` (`idpersonne`, `nom`, `prenom`, `adresse`, `password`, `libraire`) VALUES
(1, 'Turing', 'Alan Mathison', 'Bletchley Park, London', 'apple', 1),
(2, 'Dodgson', 'Charles Lutwige', 'Oxford', 'dodo', 0),
(9, 'Hilbert', 'David', 'Göttingen', 'Ignorabimus', 0),
(15, 'Leibniz', 'Gottfried Wilhelm', 'Hanovre', 'Calculemus', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`idcmd`),
  ADD KEY `idpersonne` (`idpersonne`);

--
-- Indexes for table `lignescmd`
--
ALTER TABLE `lignescmd`
  ADD PRIMARY KEY (`idcmd`,`idouvrage`,`qte`) USING BTREE,
  ADD KEY `idouvrage` (`idouvrage`);

--
-- Indexes for table `ouvrages`
--
ALTER TABLE `ouvrages`
  ADD PRIMARY KEY (`idouvrage`);

--
-- Indexes for table `personnes`
--
ALTER TABLE `personnes`
  ADD PRIMARY KEY (`idpersonne`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `idcmd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `ouvrages`
--
ALTER TABLE `ouvrages`
  MODIFY `idouvrage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `personnes`
--
ALTER TABLE `personnes`
  MODIFY `idpersonne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`idpersonne`) REFERENCES `personnes` (`idpersonne`);

--
-- Constraints for table `lignescmd`
--
ALTER TABLE `lignescmd`
  ADD CONSTRAINT `lignescmd_ibfk_1` FOREIGN KEY (`idcmd`) REFERENCES `commandes` (`idcmd`),
  ADD CONSTRAINT `lignescmd_ibfk_2` FOREIGN KEY (`idouvrage`) REFERENCES `ouvrages` (`idouvrage`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
