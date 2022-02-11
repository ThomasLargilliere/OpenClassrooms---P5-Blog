-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 11 fév. 2022 à 17:23
-- Version du serveur :  10.4.18-MariaDB
-- Version de PHP : 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `chapo` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date DEFAULT NULL,
  `id_user` int(5) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `chapo`, `content`, `created_at`, `updated_at`, `id_user`, `image`) VALUES
(9, 'Mon premier article avec une image 2', '                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi scelerisque felis vitae mauris venenatis, vitae malesuada tortor bibendum. Nullam enim nulla, ultricies a tincidunt nec, bibendu', '                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi scelerisque felis vitae mauris venenatis, vitae malesuada tortor bibendum. Nullam enim nulla, ultricies a tincidunt nec, bibendum eu velit. Cras orci felis, porttitor vitae quam non, tristique placerat orci. Proin hendrerit a dui ut sodales. Morbi tincidunt consequat finibus. Mauris fermentum turpis vel enim dignissim aliquam. Donec non dui tempor, lacinia sem sed, pellentesque lacus. Aliquam erat volutpat. Phasellus volutpat sodales purus dignissim accumsan.\r\n\r\nAenean at dapibus augue. Proin ac dignissim dui. Cras tristique ultrices metus, vel sollicitudin ligula accumsan nec. Praesent a ultricies risus. Praesent in congue nisi, vel imperdiet lorem. Pellentesque tempus felis et ligula ornare, nec congue tellus viverra. Curabitur porta lacinia ex non euismod. Morbi eget eros in mi ultrices viverra. Aliquam porta lorem a urna vehicula, sit amet scelerisque lectus scelerisque.\r\n\r\nUt dapibus laoreet nibh, nec maximus nunc semper sit amet. Duis finibus erat ipsum. Integer nulla nulla, luctus id euismod id, hendrerit sit amet lacus. Quisque tempus ornare justo, sit amet efficitur massa blandit id. Duis eget tempus risus. Quisque odio turpis, ultrices vitae ante ac, blandit porttitor tortor. Donec condimentum suscipit bibendum.\r\n\r\nMauris ultricies a elit at consequat. Phasellus commodo quis diam eu maximus. Cras venenatis dolor risus, sed interdum orci euismod sit amet. Sed sit amet arcu finibus, tempus velit ut, tincidunt est. Suspendisse at tristique quam. Praesent sit amet laoreet felis, sit amet dictum mauris. Fusce sollicitudin diam quis est sollicitudin finibus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus at urna elit. Nunc egestas dapibus diam vel accumsan.\r\n\r\nCras non pulvinar nunc, sed volutpat ante. Curabitur massa enim, facilisis eu euismod ac, sagittis nec quam. Ut dignissim velit sed sem tempus malesuada. In metus neque, dictum tincidunt ullamcorper sit amet, cursus at est. Nulla nec suscipit nibh. Nullam vel augue consequat, condimentum magna in, varius mauris. Duis ut varius lacus. Pellentesque metus ipsum, suscipit ut nunc nec, congue consectetur erat. Pellentesque et dolor ac dui feugiat volutpat ut at risus. Nunc tincidunt quam sit amet nulla rhoncus, at tincidunt neque mattis. Morbi id turpis posuere, molestie diam et, eleifend ante.                                                ', '2022-02-09', '2022-02-09', 3, 'public/images/articles/a2dd9f0390e5e53ea2ea4eb3884801bf70f2100820210912_211404.jpg'),
(10, 'test article 2', 'petit article', 'voici un plus petit article (pour les tests)', '2022-02-09', NULL, 3, 'public/images/articles/3f3d71a781c4c4852dda944402e1590c8a123926dofus-2021-03-08_19-29-54-Spyooz.png');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(5) NOT NULL,
  `content` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 0,
  `id_user` int(5) NOT NULL,
  `id_article` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `content`, `created_at`, `state`, `id_user`, `id_article`) VALUES
(49, 'Test commentaire', '2022-02-10', 1, 3, 10);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(5) NOT NULL,
  `label` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `label`, `is_admin`) VALUES
(1, 'Utilisateur', 0),
(2, 'Administrateur', 1);

-- --------------------------------------------------------

--
-- Structure de la table `token_password`
--

CREATE TABLE `token_password` (
  `id_user` int(5) NOT NULL,
  `token` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `id_role` int(5) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `pseudo`, `password`, `first_name`, `name`, `image`, `id_role`) VALUES
(3, 'thomas.largilliere2012@gmail.com', 'Spyoo', '$2y$10$fRDt3gIEuu4GVtYaxebGuOva7.X5wLArTnYxzlshTW92OE3NRQVG.', 'Thomas', 'Largilliere', 'public/images/profils/3aaf36bd63c504de1b66b33e62dfa39eb4cb486aSpyoo.png', 2),
(6, 'thomas.largilliere93140@gmail.com', 'Thomas', '$2y$10$f5N5hEVeDnUK/4V/cTV9o.wYtwPt8K4GkHEMdOr2c7eE3xfgIx8du', 'Thomas', 'Largilliere', NULL, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_article` (`id_article`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `token_password`
--
ALTER TABLE `token_password`
  ADD PRIMARY KEY (`id_user`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`);

--
-- Contraintes pour la table `token_password`
--
ALTER TABLE `token_password`
  ADD CONSTRAINT `token_password_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
