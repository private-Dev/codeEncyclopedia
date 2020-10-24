-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 24 Octobre 2020 à 10:09
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
(9, 'menu', '2020-10-19 17:54:53', '2020-10-19 17:54:53', 3, 1, '');

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
(11, 9, 1, 1),
(12, 9, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `fk_blocknote` int(11) NOT NULL,
  `beware` text COLLATE utf8_unicode_ci,
  `big_title` text COLLATE utf8_unicode_ci,
  `title` text COLLATE utf8_unicode_ci,
  `important_comment` text COLLATE utf8_unicode_ci,
  `comment` text COLLATE utf8_unicode_ci,
  `comment_bar` text COLLATE utf8_unicode_ci,
  `code_block` text COLLATE utf8_unicode_ci,
  `block_img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hash_title` text COLLATE utf8_unicode_ci,
  `rank` int(11) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `note`
--

INSERT INTO `note` (`id`, `fk_blocknote`, `beware`, `big_title`, `title`, `important_comment`, `comment`, `comment_bar`, `code_block`, `block_img`, `hash_title`, `rank`, `date_created`, `date_update`) VALUES
(9, 9, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.', 'Lorem ipsum dolor sit', 'Lorem ipsum dolor sit', 'Lorem ipsum dolor sit', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque delectus repellat dolorem ipsum temporibus molestias dolor incidunt dolore quidem porro. At sunt placeat deleniti laudantium eius, dignissimos repudiandae temporibus minus.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque delectus repellat dolorem ipsum temporibus molestias dolor incidunt dolore quidem porro. At sunt placeat deleniti laudantium eius, dignissimos repudiandae temporibus minus.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque delectus repellat dolorem ipsum temporibus molestias dolor incidunt dolore quidem porro. At sunt placeat deleniti laudantium eius, dignissimos repudiandae temporibus minus.', NULL, 'Arbitrary Route Properties replaced', 1, NULL, NULL);

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
  `fk_blocknote` int(11) NOT NULL,
  `rank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `paragraph`
--

INSERT INTO `paragraph` (`id`, `content`, `date_created`, `date_update`, `fk_blocknote`, `rank`) VALUES
(1, '# test  h1\r\n<br><br>\r\n\r\n## test h2\r\n\r\n### test h3\r\n\r\n#### test h4\r\n\r\n##### test h5\r\n\r\n###### test h6\r\n\r\n\r\n> A brief summary of time quote\r\n\r\n---\r\n$lines = explode("\\n", $text);\r\n\r\n---\r\n\r\n: imp 1 {{tip imp}}\r\n\r\n:: imp 2 \r\n\r\n& warning 2 {{tip warning}}\r\n\r\n&& warning 3 \r\n\r\n: text lambda that lorem ipsum itself\r\n: text lambda that lorem ipsum itself\r\n: text lambda that lorem ipsum itself\r\n\r\n\r\ntext lambda that lorem ipsum itself\r\ntext lambda that lorem ipsum itself\r\ntext lambda that lorem ipsum itself\r\n\r\n', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 1),
(3, ': imp 1 {{tip imp}}\r\n\r\n:: imp 2 \r\n\r\n& warning 2 {{tip warning}}\r\n\r\n&& warning 3 ', '2020-10-24 00:00:00', '2020-10-24 00:00:00', 1, 2);

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
(3, 2, 1, 6),
(4, 1, 1, 1),
(5, 3, 1, 7),
(6, 4, 1, 3);

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
(1, 'jean-pascal', 'boudet', 'j@j.com', '$2y$12$HCLoK1GK12AqTPD8hMMw6.dIoAFXPBClCf44UEgQEolJfkFVwaDxy', '8aafa6a5-4ed0-478a-8cb5-dbbfff691001', '2020-02-28', '2020-04-26', NULL),
(2, 'kevin', 'giuga', 'k@g.com', '$2y$12$HCLoK1GK12AqTPD8hMMw6.dIoAFXPBClCf44UEgQEolJfkFVwaDxy', '$2y$12$HCLoK1GK12AqTPD8hMMw6.dIoAFXPBClCf44UEgQEolJfkFVwaDxy', '2020-10-01', '2020-10-01', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `blocknote_display_user`
--
ALTER TABLE `blocknote_display_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `note_display_user`
--
ALTER TABLE `note_display_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `paragraph`
--
ALTER TABLE `paragraph`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `theme_display_user`
--
ALTER TABLE `theme_display_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
