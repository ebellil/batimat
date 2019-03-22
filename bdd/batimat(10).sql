-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 20 mars 2019 à 16:55
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
(4, 'testAdminGene', '$2y$12$eOxIJYOYdi25TEDP7iDytuf7sjI6frkEFFY9MUaWtSnYGRf6cNjcq', 'testNom', 'testPrenom', 'testAdresse'),
(6, 'testAgentAff', '$2y$12$jzOB.exCp6gX4aAU4ZPXkO5XJUOai17H62ckRfpX0km.Gix3d7taq', 'testNom', 'testPrenom', 'testAdresse');

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
(3, 'agentAffAgence2', 'agentAffAgence2', 'agentAffAgence2'),
(6, 'testAgentAff6', 'Agence6', 'VilleAgence6');

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
(1, 'TestCategorie1'),
(2, 'TestCatégorie2');

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
(1, 'MatriculeF1', 'RaisonSociale12', 'Adresse1', 'Ville1', 'Pays1', '5', 'gghghgh');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `materiel_id` int(11) DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `image`
--

INSERT INTO `image` (`id`, `materiel_id`, `image_name`, `updated_at`) VALUES
(1, NULL, '5c8f85e9ae14b593104146.jpg', '2019-03-18 12:50:01'),
(2, 8, '5c8f89bbbad3a473341165.JPG', '2019-03-18 13:06:21'),
(3, 8, '5c8f89bda3c83862231025.JPG', '2019-03-18 13:06:21'),
(4, 5, '5c8fb6075636a430450063.JPG', '2019-03-18 16:15:19'),
(5, 5, '5c8fb607aa3f3354873404.JPG', '2019-03-18 16:15:19'),
(6, 2, '5c90184a3eed6533192361.jpg', '2019-03-18 23:14:37'),
(7, 2, '5c925e68c5ffd970396065.jpg', '2019-03-20 16:38:18'),
(8, 2, '5c925e6ab0b6d499126257.jpg', '2019-03-20 16:38:18'),
(9, 2, '5c925e6abbfe6629615202.jpg', '2019-03-20 16:38:18');

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
(2, 'TestMateriel3', 'Testdescritpion', 110, 1, 1),
(3, 'Materiel5', 'Description materiel 5', 1000, 1, 1),
(4, 'Materiel6', 'rgrgrergergr', 4000, 2, 1),
(5, 'Materiel7', 'rgrgeergrgrggrregergrg', 800, 2, 1),
(6, 'Materiel7', 'uibubububuibibuibbnuibuibuib', 7000, 1, 1),
(8, 'MaterielImage2', 'jkbuibb', 700, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190314224030', '2019-03-14 22:45:23');

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
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C53D045F16880AAF` (`materiel_id`);

--
-- Index pour la table `materiel`
--
ALTER TABLE `materiel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idF` (`idF`),
  ADD KEY `materiel_ibfk_1` (`idCat`);

--
-- Index pour la table `migration_versions`
--
ALTER TABLE `migration_versions`
  ADD PRIMARY KEY (`version`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `materiel`
--
ALTER TABLE `materiel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `admingeneachat`
--
ALTER TABLE `admingeneachat`
  ADD CONSTRAINT `admingeneachat_ibfk_1` FOREIGN KEY (`id`) REFERENCES `agent` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `agentaffagence`
--
ALTER TABLE `agentaffagence`
  ADD CONSTRAINT `agentaffagence_ibfk_1` FOREIGN KEY (`id`) REFERENCES `agent` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `demande_ibfk_1` FOREIGN KEY (`idMat`) REFERENCES `materiel` (`id`),
  ADD CONSTRAINT `demande_ibfk_2` FOREIGN KEY (`idAgentAff`) REFERENCES `agentaffagence` (`id`);

--
-- Contraintes pour la table `detaildemande`
--
ALTER TABLE `detaildemande`
  ADD CONSTRAINT `detaildemande_ibfk_1` FOREIGN KEY (`idMat`) REFERENCES `materiel` (`id`),
  ADD CONSTRAINT `detaildemande_ibfk_2` FOREIGN KEY (`numCommande`) REFERENCES `demande` (`NumCommande`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `FK_C53D045F16880AAF` FOREIGN KEY (`materiel_id`) REFERENCES `materiel` (`id`);

--
-- Contraintes pour la table `materiel`
--
ALTER TABLE `materiel`
  ADD CONSTRAINT `materiel_ibfk_1` FOREIGN KEY (`idCat`) REFERENCES `categorie` (`id`),
  ADD CONSTRAINT `materiel_ibfk_2` FOREIGN KEY (`idF`) REFERENCES `fournisseur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
