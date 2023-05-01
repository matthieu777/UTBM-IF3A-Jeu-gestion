-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 15 mars 2023 à 11:23
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_energie`
--

-- --------------------------------------------------------

--
-- Structure de la table `graphdemande`
--

CREATE TABLE `graphdemande` (
  `tour` int(11) NOT NULL,
  `valeur` int(11) NOT NULL,
  `partie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `graphdemande`
--
ALTER TABLE `graphdemande`
  ADD PRIMARY KEY (`partie`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `graphdemande`
--
ALTER TABLE `graphdemande`
  ADD CONSTRAINT `graphdemande_ibfk_1` FOREIGN KEY (`partie`) REFERENCES `map` (`idPartie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
