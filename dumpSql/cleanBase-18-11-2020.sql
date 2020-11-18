-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 18 Novembre 2020 à 06:20
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `codeencyclopedia`
--

-- --------------------------------------------------------

--
-- Structure de la table `blocknote`
--

CREATE TABLE `blocknote` (
  `id` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `fk_theme` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `toolTipMsg` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `blocknote`
--

INSERT INTO `blocknote` (`id`, `label`, `date_created`, `date_update`, `fk_theme`, `rank`, `toolTipMsg`) VALUES
(25, 'Version process', '2020-11-16 08:51:23', '2020-11-16 08:51:23', 12, 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `blocknote_display_user`
--

CREATE TABLE `blocknote_display_user` (
  `id` int(11) NOT NULL,
  `fk_blocknote` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `rank_display` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `blocknote_display_user`
--

INSERT INTO `blocknote_display_user` (`id`, `fk_blocknote`, `fk_user`, `rank_display`) VALUES
(43, 25, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `fk_blocknote` int(11) NOT NULL,
  `label` text COLLATE utf8_unicode_ci,
  `rank` int(11) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `toolTipMsg` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `note`
--

INSERT INTO `note` (`id`, `fk_blocknote`, `label`, `rank`, `date_created`, `date_update`, `toolTipMsg`) VALUES
(35, 25, 'RemontÃ©e de version', 1, '2020-11-16 08:52:03', '2020-11-16 08:52:03', '');

-- --------------------------------------------------------

--
-- Structure de la table `note_display_user`
--

CREATE TABLE `note_display_user` (
  `id` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `fk_note` int(11) NOT NULL,
  `rank_display` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paragraph`
--

CREATE TABLE `paragraph` (
  `id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `date_created` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `fk_note` int(11) NOT NULL,
  `rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `paragraph`
--

INSERT INTO `paragraph` (`id`, `content`, `date_created`, `date_update`, `fk_note`, `rank`) VALUES
(28, '# title', '2020-11-16 08:52:03', '2020-11-16 08:52:03', 35, 1);

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

CREATE TABLE `theme` (
  `id` int(11) NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `rank` int(11) NOT NULL,
  `toolTipMsg` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `theme`
--

INSERT INTO `theme` (`id`, `label`, `date_created`, `date_update`, `rank`, `toolTipMsg`) VALUES
(12, 'Atm Process', '2020-11-16 08:51:02', '2020-11-16 08:51:02', 1, '');

-- --------------------------------------------------------

--
-- Structure de la table `theme_display_user`
--

CREATE TABLE `theme_display_user` (
  `id` int(11) NOT NULL,
  `fk_theme` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL,
  `rank_display` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `theme_display_user`
--

INSERT INTO `theme_display_user` (`id`, `fk_theme`, `fk_user`, `rank_display`) VALUES
(21, 12, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  `token_expire` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `password`, `token`, `created_at`, `updated_at`, `token_expire`) VALUES
(1, 'jean-pascal', 'boudet', 'j@j.com', '$2y$10$3gnQ/4XMOMLu/hwkasTWleuaZ0718G1RkA11.caTBJOoYT1hKZ0d2', '', '2020-02-28', '2020-04-26', NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `blocknote`
--
ALTER TABLE `blocknote`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `blocknote_display_user`
--
ALTER TABLE `blocknote_display_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `note_display_user`
--
ALTER TABLE `note_display_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paragraph`
--
ALTER TABLE `paragraph`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `theme_display_user`
--
ALTER TABLE `theme_display_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `blocknote`
--
ALTER TABLE `blocknote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `blocknote_display_user`
--
ALTER TABLE `blocknote_display_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT pour la table `note_display_user`
--
ALTER TABLE `note_display_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `paragraph`
--
ALTER TABLE `paragraph`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT pour la table `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `theme_display_user`
--
ALTER TABLE `theme_display_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
