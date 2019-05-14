-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Lun 13 Mai 2019 à 16:29
-- Version du serveur :  5.7.26-0ubuntu0.18.04.1
-- Version de PHP :  7.2.17-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Contenu de la table `admingeneachat`
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
-- Contenu de la table `agent`
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
-- Contenu de la table `agentaffagence`
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
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `Libelle`) VALUES
(1, 'TestCategorie1'),
(2, 'TestCatégorie2'),
(3, 'chaussures'),
(4, 'combinaisons'),
(5, 'quincaillerie'),
(6, 'petit matériel');

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE `demande` (
  `NumCommande` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Etat` tinyint(1) DEFAULT '0',
  `idMat` int(11) DEFAULT NULL,
  `idagentaff` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `rapport` text,
  `note` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `demande`
--

INSERT INTO `demande` (`NumCommande`, `Date`, `Etat`, `idMat`, `idagentaff`, `quantite`, `rapport`, `note`) VALUES
(49, '2019-05-13', 0, 8, 4, 4, NULL, 0.3);

-- --------------------------------------------------------

--
-- Structure de la table `demandematerielrapport`
--

CREATE TABLE `demandematerielrapport` (
  `id` int(11) NOT NULL,
  `fournisseur_id` int(11) DEFAULT NULL,
  `admingeneral_id` int(11) DEFAULT NULL,
  `rapport` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `detaildemande`
--

CREATE TABLE `detaildemande` (
  `Quantite` int(11) NOT NULL,
  `Note` float DEFAULT NULL,
  `Commentaire` text CHARACTER SET utf8,
  `idMat` int(11) NOT NULL,
  `numcommande` int(11) DEFAULT NULL
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
  `noteglobale` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `MatriculeF`, `RaisonSociale`, `Adresse`, `Ville`, `Pays`, `noteglobale`) VALUES
(1, 'Leclerc', 'E-leclerc', '5 rue general leclerc', 'Evry', 'France', 2),
(2, 'Bricorama', 'brico', '5 rue du tamaris', 'Quincy sous Sénart', 'France', 2.5),
(3, 'Point-P', 'E-batiment', '89 avenue de paris', 'Villeneuve Saint Georges', 'France', 4);

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
-- Contenu de la table `fournisseur_rapport`
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
-- Contenu de la table `image`
--

INSERT INTO `image` (`id`, `materiel_id`, `image_name`, `updated_at`) VALUES
(2, 8, '5c8f89bbbad3a473341165.JPG', '2019-03-18 13:06:21');
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
-- Contenu de la table `materiel`
--

INSERT INTO `materiel` (`id`, `Libelle`, `Description`, `Stock`, `idCat`, `idF`) VALUES
(3, 'Brouette', 'brouette couleur orange', 900, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190427210703', '2019-04-27 21:08:02');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `fournisseur_id` int(11) DEFAULT NULL,
  `admingeneral_id` int(11) DEFAULT NULL,
  `note` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `note`
--

INSERT INTO `note` (`id`, `fournisseur_id`, `admingeneral_id`, `note`) VALUES
(19, 2, 41, 2),
(17, 3, 3, 5),
(16, 2, 3, 3),
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
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nom`, `prenom`, `roles`) VALUES
(3, 'testAdminGene', '$2y$12$5UxIKrRidMZTjL/K96TvzuWtxJU0bTeRc77bT2sjSpC6hMJDm3kKa', 'nomAdminGene', 'prenomAdminGene', 'ROLE_ADMINGENE'),
(4, 'testAgentAff', '$2y$12$b5mxapi6FlTkOIMTvHxcEe9Wn3EnPPkJXSGhv3dPKcALL1aS9ATN2', 'nomAgentAff', 'prenomAgentAff', 'ROLE_AGENTAFF'),
(5, 'admin', '$2y$12$9v/4ebNsK9sAeKYvBHO4nub74inT1JQUcHGXGSRf426QdKmoSpC1.', 'nomAdmin', 'prenomAdmin', 'ROLE_ADMIN'),
(41, 'testAdminGene1', '$2y$12$mCHaYhtRLkokEexB4ZfyIOxcOocWf3mXXrKLVoR9Q/HyXfM8w8kMi', 'testAdminGene1', 'testAdminGene1', 'ROLE_ADMINGENE'),
(42, 'testAgentAff1', '$2y$12$zEwyJEYnY3WG7peLy1eLqe96kx6RwbmLQVWtKtezEubNTruHCewIa', 'testAgentAff1', 'testAgentAff1', 'ROLE_AGENTAFF');

--
-- Index pour les tables exportées
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
  ADD KEY `idAgentAff` (`idagentaff`);

--
-- Index pour la table `demandematerielrapport`
--
ALTER TABLE `demandematerielrapport`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9C71F47A670C757F` (`fournisseur_id`),
  ADD KEY `IDX_9C71F47A748960DE` (`admingeneral_id`);

--
-- Index pour la table `detaildemande`
--
ALTER TABLE `detaildemande`
  ADD PRIMARY KEY (`idMat`),
  ADD KEY `numCommande` (`numcommande`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `IDX_CFBDFA14670C757F` (`fournisseur_id`),
  ADD KEY `IDX_CFBDFA14748960DE` (`admingeneral_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `demande`
--
ALTER TABLE `demande`
  MODIFY `NumCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT pour la table `demandematerielrapport`
--
ALTER TABLE `demandematerielrapport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pour la table `materiel`
--
ALTER TABLE `materiel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
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
-- Contraintes pour les tables exportées
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
  ADD CONSTRAINT `FK_13AGENTAFF` FOREIGN KEY (`idagentaff`) REFERENCES `agentaffagence` (`id`),
  ADD CONSTRAINT `FK_13IDMAT` FOREIGN KEY (`idMat`) REFERENCES `materiel` (`id`);

--
-- Contraintes pour la table `demandematerielrapport`
--
ALTER TABLE `demandematerielrapport`
  ADD CONSTRAINT `FK_9C71F47A670C757F` FOREIGN KEY (`fournisseur_id`) REFERENCES `fournisseur` (`id`),
  ADD CONSTRAINT `FK_9C71F47A748960DE` FOREIGN KEY (`admingeneral_id`) REFERENCES `admingeneachat` (`id`);

--
-- Contraintes pour la table `detaildemande`
--
ALTER TABLE `detaildemande`
  ADD CONSTRAINT `FK_12NUMCOMMANDE` FOREIGN KEY (`numcommande`) REFERENCES `demande` (`NumCommande`);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
