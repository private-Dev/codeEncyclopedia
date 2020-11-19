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
-- Déchargement des données de la table `blocknote`
--

INSERT INTO `blocknote` (`id`, `label`, `date_created`, `date_update`, `fk_theme`, `rank`, `toolTipMsg`) VALUES
(25, 'Conf Et Setup', '2020-11-16 14:22:27', '2020-11-16 14:22:27', 12, 1, ''),
(26, 'ExtraFields', '2020-11-16 15:55:20', '2020-11-16 15:55:20', 12, 2, ''),
(27, 'Trigger', '2020-11-16 21:55:37', '2020-11-16 21:55:37', 12, 3, ''),
(28, 'Gestion des droits', '2020-11-17 08:06:28', '2020-11-17 08:06:28', 13, 4, ''),
(29, 'CONSTANTES', '2020-11-17 09:36:34', '2020-11-17 09:36:34', 12, 5, ''),
(30, 'install Open Vpn', '2020-11-17 12:26:10', '2020-11-17 12:26:10', 20, 6, ''),
(31, 'CMD de base', '2020-11-17 15:05:29', '2020-11-17 15:05:29', 13, 7, ''),
(32, 'Cron', '2020-11-18 07:34:50', '2020-11-18 07:34:50', 12, 8, 'usage des TÃ¢ches planifiÃ©es dans l\'environement Dolibarr'),
(33, 'Email', '2020-11-18 08:15:26', '2020-11-18 08:15:26', 12, 9, 'Gestion envoie email'),
(34, 'Menu', '2020-11-18 08:48:05', '2020-11-18 08:48:05', 12, 10, ''),
(35, 'Onglet', '2020-11-18 08:48:41', '2020-11-18 08:48:41', 12, 11, 'gestion des Onglets dans dolibarr'),
(36, 'Hook', '2020-11-18 08:49:51', '2020-11-18 08:49:51', 12, 12, 'Gestion des Hooks dans dolibarr'),
(37, 'Includes', '2020-11-18 16:43:27', '2020-11-18 16:43:27', 12, 13, '');

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
-- Déchargement des données de la table `blocknote_display_user`
--

INSERT INTO `blocknote_display_user` (`id`, `fk_blocknote`, `fk_user`, `rank_display`) VALUES
(43, 25, 1, 1),
(44, 26, 1, 2),
(45, 27, 1, 3),
(46, 28, 1, 4),
(47, 29, 1, 5),
(48, 30, 1, 6),
(49, 31, 1, 7),
(50, 32, 1, 8),
(51, 33, 1, 9),
(52, 34, 1, 10),
(53, 35, 1, 11),
(54, 36, 1, 12),
(55, 37, 1, 13),
(56, 37, 3, 13);

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `fk_blocknote` int(11) NOT NULL,
  `label` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rank` int(11) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL,
  `toolTipMsg` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`id`, `fk_blocknote`, `label`, `rank`, `date_created`, `date_update`, `toolTipMsg`) VALUES
(35, 25, 'crÃ©ation de conf', 1, '2020-11-16 14:35:19', '2020-11-16 14:35:19', ''),
(36, 27, 'Description GÃ©nÃ©rale', 2, '2020-11-16 22:04:01', '2020-11-16 22:04:01', ''),
(37, 28, 'Chmod & Chown', 3, '2020-11-17 08:20:43', '2020-11-17 08:20:43', ''),
(38, 29, 'dolibarr constantes', 4, '2020-11-17 09:39:31', '2020-11-17 09:39:31', ''),
(39, 26, 'crÃ©ation d\'une table extrafields liÃ©e Ã  un object', 5, '2020-11-17 11:52:32', '2020-11-17 11:52:32', ''),
(40, 30, 'intall process', 6, '2020-11-17 12:30:23', '2020-11-17 12:30:23', ''),
(41, 31, 'copie de fichier ', 7, '2020-11-17 15:11:45', '2020-11-17 15:11:45', ''),
(42, 32, 'dÃ©claration ', 8, '2020-11-18 07:45:28', '2020-11-18 07:45:28', ''),
(43, 33, 'dÃ©claration Email', 9, '2020-11-18 08:16:02', '2020-11-18 08:16:02', ''),
(44, 37, 'rÃ¨gles includes fichiers/modules', 10, '2020-11-18 16:45:16', '2020-11-18 16:45:16', '');

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
  `content` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  `fk_note` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  FULLTEXT KEY (`content`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `paragraph`
--

INSERT INTO `paragraph` (`id`, `content`, `date_created`, `date_update`, `fk_note`, `rank`) VALUES
(28, '# Ajout de configuration \n\n!! \nLes confs sont Ã  placer dans le dossier admin du client.\nnom du fichier est du type <strong>cli_setup.php</strong>\nle module doit Ãªtre dÃ©sactivÃ©/activÃ©   aprÃ¨s modification pour prise en compte \n\n!!/\n\n\n<hr>\n\n! include Obligatoire  {{hash}}\n!/\n\n\n\n\n&& \n Libraries\n\nrequire_once DOL_DOCUMENT_ROOT . \"<strong>/core/lib/admin.lib.php</strong>\";\nrequire_once \'<strong>../lib/clialphadiab.lib.php</strong>\'; // rempacer par le cli de travail \ndol_include_once(\'<strong>abricot/includes/lib/admin.lib.php</strong>\');\n&&/\n\n! Object abricot  {{hash}}\n!/\n\n### Ajout d\'un titre de section \n\n: {{code-s}}\nsetup_print_title($langs->trans(\"Parameters\"));\n:/\n\n### Ajout d\'un switch On/off \n\n: {{code-s}}\nsetup_print_on_off(\'ALPHADIAB_STATE_PRODUCTION\');\n:/\n\n### Ajout d\'un input  avec btn modifier\n\n: {{code-s}}\n$params = array();\nif(empty($conf->global->ALPHADIAB_USER_FTP)){\n    dolibarr_set_const($db, \'ALPHADIAB_USER_FTP\', 80);\n}\nsetup_print_input_form_part(\'ALPHADIAB_USER_FTP\', $langs->trans(\'ALPHADIAB_USER_FTP\'), \'\', $params, \'input\');\n:/\n\n<hr>\n\n\n\n! Retour Action {{hash}}\n!/\n\n<hr>\n\n: {{code-s}}\n\n/*\n * Actions\n */\nif (preg_match(\'/set_(.*)/\', $action, $reg))\n{\n    $code=$reg[1];\n    if (dolibarr_set_const($db, $code, GETPOST($code), \'chaine\', 0, \'\', $conf->entity) > 0)\n    {\n        header(\"Location: \".$_SERVER[\"PHP_SELF\"]);\n        exit;\n    }\n    else\n    {\n        dol_print_error($db);\n    }\n}\n/* this preg_match  for switch html selector  */\nif (preg_match(\'/del_(.*)/\', $action, $reg))\n{\n    var_dump(\'del requested\');\n    $code=$reg[1];\n    if (dolibarr_del_const($db, $code, 0) > 0)\n    {\n        Header(\"Location: \".$_SERVER[\"PHP_SELF\"]);\n        exit;\n    }\n    else\n    {\n        dol_print_error($db);\n    }\n}\n:/\n\n\n! Sortie UI {{hash}}\n!/\n<hr>\n@[ ../assets/upload/7ee72fb5-7150-4c83-a4de-d964031fef8e.png\n\n', '2020-11-16 14:35:19', '2020-11-16 14:42:06', 35, 1),
(29, '# Le TRIGGER \n!!  est liÃ© au changement dâ€™Ã©tat de la table sur laquelle lâ€™objet est associÃ© (processus CRUD)  !!/\n\n! Le contexte dâ€™un TRIGGER est sa propre classe. \nChaque TRIGGER appartient Ã  UN OBJET. Un TRIGGER ne devrait pas se retrouver Ã  plusieurs endroits.\n(Exemple : commande_update DIFFÃ‰RENT DE client_update).\nPour les bonnes pratiques, toutes les actions liÃ©es au CRUD doivent Ãªtre traitÃ©es dans les TRIGGERS et pas dans les HOOKS.\n\nDans le ModuleBuilder, on peut gÃ©nÃ©rer directement son Trigger :\nCela crÃ©e un dossier /Triggers dans le dossier /core de notre module et crÃ©Ã© un fichier gÃ©nÃ©rique : interface_99_modMyModule_MyModuleTriggers.class.php\nâ†’ https://wiki.dolibarr.org/index.php/Syst%C3%A8me_de_Triggers (DOC)\n\n!/\n\n! USER CASES  {{hash}}\n!/\n\n! Lâ€™utilisateur veut supprimer un produit qui est liÃ© Ã  N sessions dans la BDD\n\nCes deux entitÃ©s sont liÃ©es par une contrainte dâ€™intÃ©gritÃ© (fk_product sur la table du module â€œsportâ€ ou â€œmusiqueâ€ par ex).\n\nLâ€™existant est le suivant : Quand on veut supprimer un produit, on a un message dâ€™erreur indiquant lâ€™impossibilitÃ© de supprimer dÃ»e Ã  la prÃ©sence de la foreign key (contrainte).\n\n!/\n\n\n! Pour palier Ã  cela, on va mettre en place le systÃ¨me de <strong>HOOK </strong>et <strong>TRIGGERS</strong>  :  !/\n\n! Quand on clique sur le bouton SUPPRIMER, $action = â€˜deleteâ€™... Une fonction formconfirm (de lâ€™objet â€œformâ€) fait afficher une fenÃªtre/popup de confirmation de suppression\nDans cette Pop-up, on a une possibilitÃ© â€œouiâ€ ou â€œnonâ€\nEn cliquant sur â€œouiâ€, $action devient â€˜confirm_deleteâ€™\nNotre fichier de HOOK intercepte cette action confirm_delete dans le HOOK â€œdoActions( )â€\nIl envoie un setEventMessage indiquant le nombre de sessions liÃ©es au produit\nPuis  IMPORTANT, ici, il y a un â€œheader-locationâ€ qui reload la page que lâ€™on souhaite, suivi dâ€™un exit; Dans ce header-location, on passe en paramÃ¨tre GET une action personnalisÃ©e (ici â€˜&action=ask_delete_modsportchildâ€™)\n!/\n\n@[ ../assets/upload/e57a1185-807b-4fee-8acf-1d7d5854e97d.png\n\nCette action est â€œappelÃ©eâ€ Ã  prÃ©sent dans le HOOK <strong>addMoreActionsButtons</strong> dans le but de crÃ©er une deuxiÃ¨me Pop-up de â€œdouble confirmation de suppressionâ€\nCâ€™est le seul HOOK disponible (câ€™est-Ã -dire dÃ©jÃ  dÃ©clarÃ© dans le htdocs/core) oÃ¹ il soit possible dâ€™injecter ce type de codeâ€¦\nCâ€™est donc ici quâ€™on print un autre formconfirm en changeant les paramÃ¨tres de la fonction : On peut y passer une clÃ© qui sera reprise dans le fichier de trad du module (pour remplir notre Pop-Up avec du texte personnalisÃ©) et on peut surtout changer lâ€™action !\nOn modifie donc lâ€™action Ã  <strong>confirm_delete_childs</strong> ou <strong>confirm_delete_double</strong>, peu importe. \nCe sera cette action <strong>confirm_delete_double</strong> qui sera finalement rappelÃ©e dans le HOOK <strong>doActions</strong> avec un <strong>if ($action == \'confirm_delete_double\') {...</strong>\nqui renvoie vers lâ€™action <strong>confirm_delete</strong> â†’prise en charge par le fichier product/card.php qui lance la procÃ©dure de suppression sur lâ€™objet Product.\n<strong>Cette fonction va appeler LE TRIGGER PRODUC_DELETE </strong>\n\n@[ ../assets/upload/44d62e11-f343-40c4-9767-cd4a64e00757.png\n\n<hr>\n\n! SchÃ©ma Process {{hash center}}\n!/\n\n<hr>\n\n@[ ../assets/upload/6dbdd91f-da7f-4027-8802-f38b45f5704a.png\n\n<hr>\n\n\n', '2020-11-16 22:04:01', '2020-11-17 08:03:37', 36, 2),
(30, '## Chmod & Chown\n\n<hr>\n\n###  La gestion des droits sous GNU Linux   {{hash}}\n\n\n!! Un systÃ¨me d\'exploitation GNU/Linux a trois types d\'utilisateurs et trois type de droits distincts.\nCette page explique et prÃ©sente les options les plus souvent utilisÃ©es pour des scripts et plus prÃ©cisÃ©ment la gestion de dossiers et fichiers de sites web sur un serveur Apache sous Linux.\n\nPour un complÃ©ment d\'information vous pouvez consulter les documentations d\'ubuntu.fr.org :\n- les permissions\n- Les rÃ©pertoires de travail d\'un serveur lamp\n\n!!/\n<br>\n\n## I - La commande CHmod\n\n<br>\n\n### Les types d\'utilisateurs\n\n<br>\n\nLe propriÃ©taire du fichier (user)\nLe groupe du propriÃ©taire du fichier (group)\nLes autres utilisateurs, ou encore le reste du monde (others)\n\n<br>\n\n#### Les types de droits\n\n<br>\n\nr : droit de lecture (read)\nw : droit d\'Ã©criture (write)\nx : droit d\'exÃ©cution (eXecute)\n\n\n@[ ../assets/upload/4d87db26-669d-4c6e-9fbd-8558da5c8ea8.png\n\n\n!! \nAinsi pour modifier les droits de faÃ§on octale, la meilleure faÃ§on pour Ãªtre certain du rÃ©sultat, est d\'additionner ceux-ci.\n\nPar exemple : changer les droits du fichier \"monscript\" pour que je sois (moi le propriÃ©taire) le seul Ã  pouvoir le modifier, que les personnes de mon groupe puissent le lire comme l\'exÃ©cuter et que le reste du monde puisse uniquement l\'exÃ©cuter :\n!!/\n\n@[ ../assets/upload/0dc13a03-e471-40b7-aaeb-83356bee5d3a.png\n\n<br>\n<br>\n\n@[ ../assets/upload/57df6b1a-403c-4c74-8d1c-eed702732b43.png\n\n', '2020-11-17 08:20:43', '2020-11-17 08:20:43', 37, 3),
(31, '! DOL_DATA_ROOT {{hash bluetext}}\nchemin vers le dossier documents\n!/\n\n: {{code-s}}\n// cli et folder sont Ã  crÃ©er  en fonction des besoins\n$dir = DOL_DATA_ROOT . \"/cli/folder\"\n:/\n\n<hr>\n\n! DOL_DOCUMENT_ROOT  {{hash bluetext}}\nchemin vers le dossier htdocs\n!/\n\n include_once  DOL_DOCUMENT_ROOT .\"/custom/isiworkconnector/\n: {{code-s}}\ninclude_once  DOL_DOCUMENT_ROOT .\"/custom/climodule/...\n:/', '2020-11-17 09:39:31', '2020-11-18 08:55:09', 38, 4),
(32, '!  ajout de la table via sql  {{hash}}\n!/\n\n\n: {{code-s}}\nCREATE TABLE if not exists llx_fin_conformite_extrafields\n(\n  rowid   integer NOT NULL AUTO_INCREMENT PRIMARY KEY,\n  tms                       timestamp,\n  fk_object                 integer NOT NULL,\n  import_key                varchar(14)\n)ENGINE=innodb;\n:/\n\n!  ajout de l\'extrafield dans le module core du module  {{hash}}\n!/\n', '2020-11-17 11:52:32', '2020-11-17 11:52:32', 39, 5),
(33, '### download openvpn \n\n! <a href=\"https://openvpn.net/community-downloads/\">https://openvpn.net/community-downloads/</a> {{hash}}\n!/\n\n@[ ../assets/upload/22f797bf-8c57-4101-8668-4d9ed6e6386c.png\n\n!!  si la librairie lz4 manquante  \n!!/\n\n: {{code-s}}\nsudo snap install lz4\n:/', '2020-11-17 12:30:24', '2020-11-17 12:30:24', 40, 6),
(34, '### 1 - SCP\n\n! Copy single file from local to remote using scp. !/  {{bluetext}}\n\n: {{code-s}}\n $ scp myfile.txt remoteuser@remoteserver:/remote/folder/\n:/\n\n! Copy single file from remote to local using scp. !/  {{bluetext}}\n\n: {{code-s}}\n $ scp remoteuser@remoteserver:/remote/folder/remotefile.txt  localfile.txt\n:/\n\n### 2 - CP\n\ncp (copy files) est une commande beaucoup utilisÃ©e car cette derniÃ¨re permet de procÃ©der Ã  des copies de fichiers ou rÃ©pertoires.\n\nBien que ce tutoriel soit fait pour les dÃ©butants, il est Ã©galement utile Ã  tous ceux qui souhaitent revoir rapidement des exemples pratiques dâ€™utilisation des diverses options de la commande cp.\n\nMÃªme si vous utilisez la commande cp tous le temps, probablement quâ€™un ou plusieurs exemples ci-dessous pourront Ãªtre nouveau pour vous.\n\nLa syntaxe gÃ©nÃ©rale de commande cp est :\n\n: {{code-s}}\ncp [option] source destination\n:/\n\n#### Copier un fichier\n\nIl arrive trÃ¨s souvent de vouloir copier un fichier. Voici un exemple, de la commande cp dans lequel nous copions un fichier nommÃ© Â« photo.jpg Â» dans le rÃ©pertoire Â« /home/jean/Bureau Â».\n\n: {{code-s}}\n$ cp photo.jpg /home/jean/Bureau\n:/\n\nCopier un fichier en lui donnant un nom diffÃ©rent\nSi lâ€™on souhaite donner un nom diffÃ©rent au fichier qui sera copiÃ© il suffit de le prÃ©ciser dans le deuxiÃ¨me argument de la commande. Dans lâ€™exemple ci-dessous nous copions le fichier photo.jpg vers le rÃ©pertoire Â« /home/jean/Bureau Â» et lui donnons le nom Â« image.jpg Â».\n\n: {{code-s}}\n$ cp /home/jean/photo.jpg /home/jean/Bureau/image.jpg\n:/\n\nIl est possible de faire la mÃªme chose au sein du rÃ©pertoire courant dans lequel nous nous trouvons :\n\n: {{code-s}}\n$ cp photo.jpg image.jpg\n:/\n\nLe fichier photo.jpg sera alors recherchÃ© au sein du rÃ©pertoire courant et sera copiÃ© en tant quâ€™image.jpg.\n\n\n\n\n\n### 3  - FIND\n\nLister les fichiers dont le nom est Â« toto Â» Ã  partir du rÃ©pertoire courant :\n\n: {{code-s}}\nfind . -name \"toto\" -exec ls -lh \"{}\" \\;\n:/\n\nLister les fichiers dont lâ€™extension est Â« .log Â» Ã  partir du rÃ©pertoire courant :\n\n: {{code-s}}\nfind . -name \"*.log\" -exec ls -lh \"{}\" \\;\n:/\n\nLister les rÃ©pertoires dont le nom est Â« toto Â» Ã  partir du rÃ©pertoire courant :\n\n: {{code-s}}\nfind . -name \"toto\" -type d -exec ls -d \"{}\" \\;\n:/\n\nLister les rÃ©pertoires dont le chemin contient Â« /local/bin Â» Ã  partir du rÃ©pertoire courant :\n\n: {{code-s}}\nfind . -wholename \"*/local/bin*\" -type d -exec ls -d \"{}\" \\;\n:/\n\n\n\n', '2020-11-17 15:11:45', '2020-11-17 15:43:26', 41, 7),
(35, '### 1 - Core Module \n\nDans le core module on place aprÃ©s  <strong>$this->module_parts = []</strong>\n\n: {{code-s}}\n\n$this->cronjobs = array(\n			0 => array(\'label\' => \'ZeenDoc\',\n					   \'jobtype\' => \'method\',\n					   \'class\' => \'financement/cron/zeendoc_cron.php\',\n					   \'objectname\' => \'CronZeenDoc\',\n					   \'method\' => \'run\',\n					   \'parameters\' => \'\',\n					   \'comment\' => \'check and send eligible invoices\',\n					   \'frequency\' => 1,\n					   \'unitfrequency\' => 3600 * 24 ,\n					   \'status\' => Cronjob::STATUS_ENABLED,\n					   \'test\' => true),\n);\n:/\n\n&& \n<strong> \'class\' => \'financement/cron/zeendoc_cron.php\' </strong> chemin de la class Ã  utilisÃ©e\n<strong>  \'objectname\' => \'CronZeenDoc\' </strong> pour la class cron utilisÃ©e\n<strong>  \'method\' => \'run\' </strong>la methode Ã  lancer\n&&/\n\n\n### 2 - crÃ©ation class cron \n\n- crÃ©ation d\'un Dossier cron Ã  la racine du module \n\n\n\n\n: {{code-s}}\n\ndefine(\'INC_FROM_DOLIBARR\',1);\nrequire_once (__DIR__ . \'/../config.php\');\n\n\n/**\n* Class CronZeenDoc\n*/\nclass CronZeenDoc {\n\n    /**\n     * Cron Main function\n     *\n     */\n    function run(){}\n\n}\n:/\n\n### 3 - paramÃªtres d\'entrÃ©e\n\n### 4 - retour cron \n\n', '2020-11-18 07:45:28', '2020-11-18 11:02:33', 42, 8),
(36, '# Avant-Propos\n\n\n\n! ajout d\'un accÃ¨s app  {{hash}}\n!/\n\n@[ ../assets/upload/b4862c12-f957-4093-bde0-50394cda5252.gif\n\n! Configuration mail dans le module de travail {{hash}}\n!/\n\n@[ ../assets/upload/1afddbec-babc-4e2d-8a8c-eab1c0ca924f.gif\n\n\n! Configuration intranet  {{hash}}\n!/\n\n@[ ../assets/upload/2d668335-32fc-439a-b296-ff3a166a039b.png\n\n<br>\n\nle mot de passe doit Ãªtre celui de l\'app (google ) crÃ©Ã© plus tÃ´t.\n\n<br>\n\n<hr>\n### 1 -  Class import\n<hr>\n\n: {{code-s}}\ndol_include_once(\'/core/class/CMailFile.class.php\');\n:/\n\n### 2 - process\n\n: {{code-s}}\n$CMail = new CMailFile(\n                        \'Fichier ORD non envoyÃ©\' // title\n                        ,$conf->global->ALPHADIAB_DELIVERY_MAIL  //to\n                        ,  $conf->email_from  //from\n                        , \' Message \'\n                        , $filename_list, $mimetype_list, $mimefilename_list, \'\' //,$addr_cc=\"\"\n                        , \'\' //,$addr_bcc=\"\"\n                        , \'\' //,$deliveryreceipt=0\n                        , \'\' //,$msgishtml=0*/\n                        , \'\'//,$css=\'\'\n                    );\n\n                    // Send mail\n                    if($CMail->sendfile()){\n                        $this->output .= $langs->trans(\'MailSended\').\"<b r/>\";\n                        dol_syslog(\"message\",LOG_ALERT);\n                        setEventMessage($langs->trans(\'MailSended\',\"warnings\"));\n                    }else{\n                        $this->output .= $langs->trans(\'ErrorMailSended\') .\"<b r/>\";\n                        dol_syslog(\"error mail \", LOG_ALERT);\n                        setEventMessage($langs->trans(\'ErrorMailSended\', \"warnings\"));\n                    }\n\n:/\n\n\n\n', '2020-11-18 08:16:02', '2020-11-18 12:00:04', 43, 9),
(37, '\n\n&&  \n// appel Core Dolibarr\n<strong>require_once DOL_DOCUMENT_ROOT .\'/core/modules/DolibarrModules.class.php\';</strong>\n<strong>require_once DOL_DOCUMENT_ROOT .\'/cron/class/cronjob.class.php\';</strong>\n// appel dans le module de travail\n<strong>require_once (__DIR__ . \'/class/conformite.class.php\');</strong>\n// module mais pas celui de travail\n<strong>dol_include_once(\'/dispatch/class/dispatchdetail.class.php\');</strong>\n&&/', '2020-11-18 16:45:16', '2020-11-18 16:45:16', 44, 10);

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
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`id`, `label`, `date_created`, `date_update`, `rank`, `toolTipMsg`) VALUES
(12, 'Dolibarr', '2020-11-16 09:11:10', '2020-11-16 09:11:10', 1, 'https://www.dolibarr.org/?lang=fr&l=fr'),
(13, 'Shell Scripting', '2020-11-16 09:16:00', '2020-11-16 09:16:00', 2, ''),
(14, 'Jquery', '2020-11-16 09:16:24', '2020-11-16 09:16:24', 3, ''),
(15, 'javascript Vanilla', '2020-11-16 09:16:35', '2020-11-16 09:16:35', 4, ''),
(16, 'Atm Process', '2020-11-16 09:23:15', '2020-11-16 09:23:15', 5, ''),
(17, 'GIT', '2020-11-16 09:42:50', '2020-11-16 09:42:50', 6, ''),
(18, 'CLIENT HELPER', '2020-11-16 12:25:18', '2020-11-16 12:25:18', 7, ''),
(19, 'SQL', '2020-11-16 21:50:05', '2020-11-16 21:50:05', 8, ''),
(20, 'Linux', '2020-11-17 12:25:53', '2020-11-17 12:25:53', 9, '');

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
-- Déchargement des données de la table `theme_display_user`
--

INSERT INTO `theme_display_user` (`id`, `fk_theme`, `fk_user`, `rank_display`) VALUES
(21, 12, 1, 1),
(22, 13, 1, 2),
(23, 14, 1, 3),
(24, 15, 1, 4),
(25, 16, 1, 5),
(26, 17, 1, 6),
(27, 18, 1, 7),
(28, 19, 1, 8),
(29, 20, 1, 9);

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
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `email`, `password`, `token`, `created_at`, `updated_at`, `token_expire`) VALUES
(1, 'jean-pascal', 'boudet', 'j@j.com', '$2y$10$3gnQ/4XMOMLu/hwkasTWleuaZ0718G1RkA11.caTBJOoYT1hKZ0d2', '', '2020-02-28', '2020-04-26', NULL),
(3, 'kevin', 'giula', 'kevin.giuga@protonmail.com', '$2y$10$yjmDpQEQXdEQ1udUU9gXb.5N7fDQPg0WYLynL3jytODJLA39CkefO', '$2y$10$yjmDpQEQXdEQ1udUU9gXb.5N7fDQPg0WYLynL3jytODJLA39CkefO', '2020-11-18', '2020-11-18', '2022-03-09 10:44:59');

--
-- Index pour les tables déchargées
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
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `blocknote`
--
ALTER TABLE `blocknote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `blocknote_display_user`
--
ALTER TABLE `blocknote_display_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `note_display_user`
--
ALTER TABLE `note_display_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paragraph`
--
ALTER TABLE `paragraph`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `theme`
--
ALTER TABLE `theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `theme_display_user`
--
ALTER TABLE `theme_display_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;