-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 05 mai 2019 à 02:49
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
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `admingeneachat`
--

CREATE TABLE `admingeneachat` (
  `id` int(11) NOT NULL,
  `MatriculeAd` varchar(255) CHARACTER SET utf8 NOT NULL,
  `agent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admingeneachat`
--

INSERT INTO `admingeneachat` (`id`, `MatriculeAd`, `agent_id`) VALUES
(3, 'MatriculeAdminGene', NULL),
(41, 'testAdminGene1', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `agent`
--

CREATE TABLE `agent` (
  `id` int(11) NOT NULL,
  `adresse` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `agent`
--

INSERT INTO `agent` (`id`, `adresse`) VALUES
(3, 'AdresseAdminGene'),
(4, 'AdresseAgentAff'),
(29, 'testAgentAff1'),
(30, 'testAgentAff1'),
(31, 'testAgentAff1'),
(32, 'testAgentAff1'),
(33, 'testAgentAff1'),
(34, 'testAgentAff1'),
(35, 'testAgentAff1'),
(36, 'testAgentAff1'),
(39, 'testAgentAff2'),
(40, 'testAgentAff3'),
(41, 'testAdminGene1'),
(42, 'testAgentAff1');

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
(4, 'MatriculeAgentAff', 'Agence1', 'VilleAgence'),
(39, 'testAgentAff2', 'testAgentAff2', 'testAgentAff2'),
(40, 'testAgentAff3', 'testAgentAff3', 'testAgentAff3'),
(42, 'testAgentAff1', 'testAgentAff1', 'testAgentAff1');

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
  `Etat` tinyint(1) DEFAULT '0',
  `idMat` int(11) NOT NULL,
  `idAgentAff` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `demande`
--

INSERT INTO `demande` (`NumCommande`, `DemandeEcrite`, `Date`, `Etat`, `idMat`, `idAgentAff`) VALUES
(1, '', '2019-05-02', 1, 3, 4),
(2, '', '2019-05-02', 0, 4, 4),
(3, '', '2019-05-02', 0, 5, 39);

-- --------------------------------------------------------

--
-- Structure de la table `detaildemande`
--

CREATE TABLE `detaildemande` (
  `Quantite` int(11) NOT NULL,
  `Note` float DEFAULT NULL,
  `Commentaire` text CHARACTER SET utf8 NOT NULL,
  `idMat` int(11) NOT NULL,
  `numCommande` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `detaildemande`
--

INSERT INTO `detaildemande` (`Quantite`, `Note`, `Commentaire`, `idMat`, `numCommande`) VALUES
(50, NULL, '', 3, 1),
(100, NULL, '', 4, 2),
(50, NULL, '', 5, 3);

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
  `note` int(11) DEFAULT NULL,
  `rapport` int(11) DEFAULT NULL,
  `noteglobale` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `MatriculeF`, `RaisonSociale`, `Adresse`, `Ville`, `Pays`, `note`, `rapport`, `noteglobale`) VALUES
(1, 'MatriculeF1', 'RaisonSociale12', 'Adresse1', 'Ville1', 'Pays1', NULL, NULL, 2),
(2, 'MatriculeF2', 'test', 'test', 'test', 'test', NULL, NULL, 2.5),
(3, 'MatriculeF3', 'test', 'test', 'test', 'est', NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur_rapport`
--

CREATE TABLE `fournisseur_rapport` (
  `id` int(11) NOT NULL,
  `fournisseur_id` int(11) DEFAULT NULL,
  `rapport` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admingeneral_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `fournisseur_rapport`
--

INSERT INTO `fournisseur_rapport` (`id`, `fournisseur_id`, `rapport`, `admingeneral_id`) VALUES
(1, NULL, 'test', NULL),
(2, NULL, 'test', NULL),
(3, 1, 'test3', 3),
(4, 2, 'test4', 3),
(5, 2, 'testAdminGene1', 41),
(6, 1, 'testièièèi-', 41);

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
(10, 9, '5cbf8c5992de0977328817.jpg', '2019-04-24 00:06:17'),
(11, 9, '5cbf8c59b73f1679333979.jpg', '2019-04-24 00:06:17');

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
(3, 'Materiel', 'Description materiel 5', 900, 1, 1),
(4, 'Materiel6', 'rgrgrergergr', 50, 2, 1),
(5, 'Materiel7', 'rgrgeergrgrggrregergrg', 800, 2, 1),
(6, 'Materiel7', 'uibubububuibibuibbnuibuibuib', 7000, 1, 1),
(8, 'MaterielImage2', 'jkbuibb', 700, 1, 1),
(9, 'Matériel 1', 'Description Matériel 1', 40, 1, 1);

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
('20190427210703', '2019-04-27 21:08:02');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `fournisseur_id` int(11) NOT NULL,
  `admingeneral_id` int(11) NOT NULL,
  `note` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`id`, `fournisseur_id`, `admingeneral_id`, `note`) VALUES
(19, 2, 41, 2),
(17, 3, 3, 4),
(16, 2, 3, 1),
(15, 1, 3, 3),
(21, 1, 41, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nom`, `prenom`, `roles`) VALUES
(3, 'testAdminGene', '$2y$12$5UxIKrRidMZTjL/K96TvzuWtxJU0bTeRc77bT2sjSpC6hMJDm3kKa', 'nomAdminGene', 'prenomAdminGene', 'ROLE_ADMINGENE'),
(4, 'testAgentAff', '$2y$12$b5mxapi6FlTkOIMTvHxcEe9Wn3EnPPkJXSGhv3dPKcALL1aS9ATN2', 'nomAgentAff', 'prenomAgentAff', 'ROLE_AGENTAFF'),
(5, 'admin', '$2y$12$9v/4ebNsK9sAeKYvBHO4nub74inT1JQUcHGXGSRf426QdKmoSpC1.', 'nomAdmin', 'prenomAdmin', 'ROLE_ADMIN'),
(41, 'testAdminGene1', '$2y$12$mCHaYhtRLkokEexB4ZfyIOxcOocWf3mXXrKLVoR9Q/HyXfM8w8kMi', 'testAdminGene1', 'testAdminGene1', 'ROLE_ADMINGENE'),
(42, 'testAgentAff1', '$2y$12$zEwyJEYnY3WG7peLy1eLqe96kx6RwbmLQVWtKtezEubNTruHCewIa', 'testAgentAff1', 'testAgentAff1', 'ROLE_AGENTAFF');

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_9F5BCE603414710B` (`agent_id`);

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
  ADD KEY `numCommande` (`numCommande`),
  ADD KEY `idMat` (`idMat`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_NOTE` (`note`),
  ADD KEY `IDX_RAPPORT` (`rapport`);

--
-- Index pour la table `fournisseur_rapport`
--
ALTER TABLE `fournisseur_rapport`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6CF4EF31670C757F` (`fournisseur_id`),
  ADD KEY `IDX_6CF4EF31748960DE` (`admingeneral_id`);

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
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CFBDFA14670C757F` (`fournisseur_id`),
  ADD KEY `FK_CFBDFA14748960DE` (`admingeneral_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `demande`
--
ALTER TABLE `demande`
  MODIFY `NumCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `fournisseur_rapport`
--
ALTER TABLE `fournisseur_rapport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `materiel`
--
ALTER TABLE `materiel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `admingeneachat`
--
ALTER TABLE `admingeneachat`
  ADD CONSTRAINT `FK_9F5BCE603414710B` FOREIGN KEY (`agent_id`) REFERENCES `agent` (`id`),
  ADD CONSTRAINT `FK_9F5BCE60BF396750` FOREIGN KEY (`id`) REFERENCES `agent` (`id`);

--
-- Contraintes pour la table `agentaffagence`
--
ALTER TABLE `agentaffagence`
  ADD CONSTRAINT `agentaffagence_ibfk_1` FOREIGN KEY (`id`) REFERENCES `agent` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `FK_13AGENTAFF` FOREIGN KEY (`idAgentAff`) REFERENCES `agentaffagence` (`id`),
  ADD CONSTRAINT `FK_13IDMAT` FOREIGN KEY (`idMat`) REFERENCES `materiel` (`id`);

--
-- Contraintes pour la table `detaildemande`
--
ALTER TABLE `detaildemande`
  ADD CONSTRAINT `FK_12IDMAT` FOREIGN KEY (`idMat`) REFERENCES `materiel` (`id`),
  ADD CONSTRAINT `FK_12NUMCOMMANDE` FOREIGN KEY (`numCommande`) REFERENCES `demande` (`numCommande`);

--
-- Contraintes pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD CONSTRAINT `fournisseur_ibfk_1` FOREIGN KEY (`note`) REFERENCES `note` (`id`),
  ADD CONSTRAINT `fournisseur_ibfk_2` FOREIGN KEY (`rapport`) REFERENCES `rapport` (`id`);

--
-- Contraintes pour la table `fournisseur_rapport`
--
ALTER TABLE `fournisseur_rapport`
  ADD CONSTRAINT `FK_6CF4EF31670C757F` FOREIGN KEY (`fournisseur_id`) REFERENCES `fournisseur` (`id`),
  ADD CONSTRAINT `FK_6CF4EF31748960DE` FOREIGN KEY (`admingeneral_id`) REFERENCES `admingeneachat` (`id`);

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
