-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 13 fév. 2019 à 19:45
-- Version du serveur :  5.7.17
-- Version de PHP :  7.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `batimat`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8 NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `admingeneachat`
--

CREATE TABLE `admingeneachat` (
  `id` int(11) NOT NULL,
  `MatriculeAd` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admingeneachat`
--

INSERT INTO `admingeneachat` (`id`, `MatriculeAd`) VALUES
(2, 'adminGeneTest1');

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

CREATE TABLE `agent` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8 NOT NULL,
  `prenom` varchar(255) CHARACTER SET utf8 NOT NULL,
  `adresse` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `agent`
--

INSERT INTO `agent` (`id`, `login`, `mdp`, `nom`, `prenom`, `adresse`) VALUES
(1, 'loginAgentTest', 'mdpAgentTest', 'nomAgentTest', 'prenomAgentTest', 'AdresseAgentTest'),
(2, 'loginAdminTest', 'mdpAdminTest', 'nomAdminTest', 'prenomAdminTest', 'AdresseAdminTest'),
(3, 'agentAffAgence2', 'agentAffAgence2', 'agentAffAgence2', 'agentAffAgence2', 'agentAffAgence2'),
(4, 'testAdminGene', '$2y$12$eOxIJYOYdi25TEDP7iDytuf7sjI6frkEFFY9MUaWtSnYGRf6cNjcq', 'testNom', 'testPrenom', 'testAdresse');

-- --------------------------------------------------------

--
-- Structure de la table `agentaffagence`
--

CREATE TABLE `agentaffagence` (
  `id` int(11) NOT NULL,
  `MatriculeAg` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Agence` varchar(255) CHARACTER SET utf8 NOT NULL,
  `VilleAgence` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `agentaffagence`
--

INSERT INTO `agentaffagence` (`id`, `MatriculeAg`, `Agence`, `VilleAgence`) VALUES
(1, 'AgentAffAgenceTest1', 'Agence1', 'Ville1'),
(3, 'agentAffAgence2', 'agentAffAgence2', 'agentAffAgence2');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `Libelle` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `Libelle`) VALUES
(1, 'TestCategorie1');

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE `demande` (
  `NumCommande` int(11) NOT NULL,
  `DemandeEcrite` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Date` date NOT NULL,
  `Etat` tinyint(1) NOT NULL,
  `idMat` int(11) NOT NULL,
  `idAgentAff` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `detaildemande`
--

CREATE TABLE `detaildemande` (
  `Quantite` int(11) NOT NULL,
  `Note` float NOT NULL,
  `Commentaire` text CHARACTER SET utf8 NOT NULL,
  `idMat` int(11) NOT NULL,
  `numCommande` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL,
  `MatriculeF` varchar(255) CHARACTER SET utf8 NOT NULL,
  `RaisonSociale` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Adresse` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Ville` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Pays` varchar(255) CHARACTER SET utf8 NOT NULL,
  `NoteGlobale` varchar(255) CHARACTER SET utf8 NOT NULL,
  `RapportEcrit` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `MatriculeF`, `RaisonSociale`, `Adresse`, `Ville`, `Pays`, `NoteGlobale`, `RapportEcrit`) VALUES
(1, 'MatriculeF1', 'RaisonSociale1', 'Adresse1', 'Ville1', 'Pays1', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

CREATE TABLE `materiel` (
  `id` int(11) NOT NULL,
  `Libelle` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Description` text CHARACTER SET utf8 NOT NULL,
  `Stock` int(11) NOT NULL,
  `idCat` int(11) NOT NULL,
  `idF` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `materiel`
--

INSERT INTO `materiel` (`id`, `Libelle`, `Description`, `Stock`, `idCat`, `idF`) VALUES
(1, 'TestMateriel13', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam sit amet nisi velit. Vivamus consectetur metus odio, non sollicitudin orci sodales vitae. Fusce commodo pellentesque tortor, nec posuere nunc consectetur ut. Sed rutrum ex eget efficitur rutrum. Curabitur quis pellentesque erat. Maecenas lacinia nisi dui, in ornare lorem tristique non. Donec ac tincidunt nisi. Sed laoreet porta malesuada.', 2001, 1, 1),
(2, 'TestMateriel3', 'Testdescritpion', 110, 1, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `admingeneachat`
--
ALTER TABLE `admingeneachat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `agent`
--
ALTER TABLE `agent`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `agentaffagence`
--
ALTER TABLE `agentaffagence`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `demande`
--
ALTER TABLE `demande`
  ADD PRIMARY KEY (`NumCommande`),
  ADD KEY `idMat` (`idMat`),
  ADD KEY `idAgentAff` (`idAgentAff`);

--
-- Index pour la table `detaildemande`
--
ALTER TABLE `detaildemande`
  ADD PRIMARY KEY (`idMat`,`numCommande`),
  ADD KEY `numCommande` (`numCommande`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `materiel`
--
ALTER TABLE `materiel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idF` (`idF`),
  ADD KEY `materiel_ibfk_1` (`idCat`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `agent`
--
ALTER TABLE `agent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `demande`
--
ALTER TABLE `demande`
  MODIFY `NumCommande` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `materiel`
--
ALTER TABLE `materiel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `agentaffagence`
--
ALTER TABLE `agentaffagence`
  ADD CONSTRAINT `agentaffagence_ibfk_1` FOREIGN KEY (`id`) REFERENCES `agent` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
