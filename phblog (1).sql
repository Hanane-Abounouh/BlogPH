-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 17 mai 2024 à 17:09
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `phblog`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id_article` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `sous_titre` varchar(100) DEFAULT NULL,
  `image_article` varchar(250) NOT NULL,
  `contenu` text NOT NULL,
  `date_publication` date DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_categorie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id_article`, `titre`, `sous_titre`, `image_article`, `contenu`, `date_publication`, `id_utilisateur`, `id_categorie`) VALUES
(6, 'titre1', 'sous_titre1', './image/6644883dd84f4.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .', '2024-05-14', 2, 1),
(7, 'titr2', 'sous_titre2', './image/6644883dd84f4.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .', '2024-05-13', 1, 1),
(8, 'titre3', 'sous_titre3', './image/6644883dd84f4.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .', '2024-05-08', 1, 1),
(9, 'titre4', 'sous_titre5', '../image/664755d05651f.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .', '2024-05-17', 1, 1),
(10, 'titre5', 'sous_titre6', '../image/6647560be4130.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .', '2024-05-17', 1, 1),
(12, 'titre7', 'sous_titre8', '../image/664756436d997.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar elementum, viverra.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar nisl ipsum morbi diam scelerisque pulvinar .', '2024-05-17', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_categorie` int(11) NOT NULL,
  `nom_categorie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `nom_categorie`) VALUES
(1, 'Nom_categorie_1'),
(2, 'Nom_categorie_2'),
(3, 'Nom_categorie_1'),
(4, 'Nom_categorie_2');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id_commentaire` int(11) NOT NULL,
  `contenu` varchar(500) NOT NULL,
  `date_commentaire` date DEFAULT NULL,
  `id_article` int(11) DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id_commentaire`, `contenu`, `date_commentaire`, `id_article`, `id_utilisateur`) VALUES
(1, 'fgybuhjnk', '2024-05-17', NULL, NULL),
(2, 'fgybuhjnk', '2024-05-17', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `id_like` int(11) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_article` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id_permission` int(11) NOT NULL,
  `nom_permission` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `rolepermitions`
--

CREATE TABLE `rolepermitions` (
  `id_rolePermition` int(11) NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `nom_Role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id_role`, `nom_Role`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL,
  `nom_utilisateur` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `mobil` varchar(20) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom_utilisateur`, `email`, `mot_de_passe`, `id_role`, `mobil`, `lastname`) VALUES
(1, 'hanane', 'hanane@gmail.com', '123456', 1, NULL, NULL),
(2, 'ferdaous', 'ferdaous@gmail.com', '123456', 1, NULL, NULL),
(3, 'marwa', 'marwa@gmail.com', '123456', 2, NULL, NULL),
(4, 'fghjn', 'hanane@email.com', '1234', 2, '986489', 'ghjn'),
(7, 'gvb', 'hanane33@email.com', '123', 2, '64686', 'djksgjlsdngv'),
(8, 'cflkjcf', 'salmaganani@gmail.com', '123', 2, '765783', 'sfnklqsf');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id_article`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `id_article` (`id_article`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id_like`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_article` (`id_article`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id_permission`);

--
-- Index pour la table `rolepermitions`
--
ALTER TABLE `rolepermitions`
  ADD PRIMARY KEY (`id_rolePermition`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_role` (`id_role`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id_commentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `likes`
--
ALTER TABLE `likes`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id_permission` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `rolepermitions`
--
ALTER TABLE `rolepermitions`
  MODIFY `id_rolePermition` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`),
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id_categorie`);

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id_article`),
  ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`);

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id_article`);

--
-- Contraintes pour la table `rolepermitions`
--
ALTER TABLE `rolepermitions`
  ADD CONSTRAINT `rolepermitions_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`),
  ADD CONSTRAINT `rolepermitions_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`);

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
