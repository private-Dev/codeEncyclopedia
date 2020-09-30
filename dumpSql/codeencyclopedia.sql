-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 30 Septembre 2020 à 05:52
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
(1, 'LARAVEL SYNTAX', '2020-09-26 18:00:00', '2020-09-26 18:00:00', 1, 'nomenclature syntaxique pour le framework LARAVEL'),
(2, 'JAVASCRIPT', '2020-09-26 18:00:00', '2020-09-26 18:00:00', 2, ''),
(3, 'DOLIBARR', '2020-09-27 00:00:00', '2020-09-27 00:00:00', 3, ''),
(4, 'TERMINAL', '2020-09-27 00:00:00', '2020-09-27 00:00:00', 4, '');

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
(3, 2, 1, 1),
(4, 1, 1, 7),
(5, 3, 1, 3),
(6, 4, 1, 6);

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
(1, 'jean-pascal', 'boudet', 'j@j.com', '$2y$12$HCLoK1GK12AqTPD8hMMw6.dIoAFXPBClCf44UEgQEolJfkFVwaDxy', '8aafa6a5-4ed0-478a-8cb5-dbbfff691001', '2020-02-28', '2020-04-26', '2020-04-27 01:08:03');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `blocknote`
--
ALTER TABLE `blocknote`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT pour la table `theme_display_user`
--
ALTER TABLE `theme_display_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
