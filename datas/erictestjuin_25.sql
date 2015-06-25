-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 25 Juin 2015 à 15:19
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `erictestjuin`
--

-- --------------------------------------------------------

--
-- Structure de la table `droit`
--

CREATE TABLE IF NOT EXISTS `droit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lenom` varchar(45) DEFAULT NULL,
  `laperm` smallint(5) unsigned DEFAULT '2',
  PRIMARY KEY (`id`),
  UNIQUE KEY `lenom_UNIQUE` (`lenom`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `droit`
--

INSERT INTO `droit` (`id`, `lenom`, `laperm`) VALUES
(1, 'Administrateur', 0),
(2, 'Moderateur', 1),
(3, 'Utilisateur', 2);

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lenom` varchar(50) DEFAULT NULL,
  `lextension` char(3) DEFAULT NULL,
  `lepoids` int(10) unsigned DEFAULT NULL,
  `lalargeur` int(10) unsigned DEFAULT NULL,
  `lahauteur` int(10) unsigned DEFAULT NULL,
  `letitre` varchar(60) DEFAULT NULL,
  `ladesc` varchar(500) DEFAULT NULL,
  `affiche` smallint(5) unsigned DEFAULT '2',
  `utilisateur_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lenom_p_UNIQUE` (`lenom`),
  KEY `fk_photo_utilisateur1_idx` (`utilisateur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Contenu de la table `photo`
--

INSERT INTO `photo` (`id`, `lenom`, `lextension`, `lepoids`, `lalargeur`, `lahauteur`, `letitre`, `ladesc`, `affiche`, `utilisateur_id`) VALUES
(17, '20150625114440478nbpl8fblfrnalb59gjn2laekerqgoben7', 'jpg', 289152, 848, 565, 'La vision', 'Ma femme', 2, 4),
(19, '201506251333236bffchggdrgcoaoie9rk7q0f6e1q74fie9o2', 'jpg', 131731, 480, 640, 'Imanih', 'B&eacute;b&eacute; sourit cool.', 2, 3),
(20, '20150625133422h67rpile35n9a3n46noq4e2eh1anh37cjr6p', 'jpg', 117655, 600, 781, 'Bling', 'La barbe &agrave; Papa.', 2, 3),
(27, '20150625142435hlhdikrh4lb6bd5n7kf17d0005qadg4naa98', 'jpg', 86056, 500, 334, 'Bikini', 'Femme cool bikini', 2, 3),
(28, '201506251425091q7ep6c36f3e9d1184d6rqq3c3fc5da7n8oc', 'jpg', 105603, 500, 334, 'Bateau', 'Quai amsterdam', 2, 3),
(29, '20150625142540ddbff61f166o293b4q6b554rh60b357r89p0', 'jpg', 92124, 500, 333, 'Cat', 'Chatte bien repos&eacute;e', 2, 3),
(30, '20150625142611l4d7m5djhokmdo13brc99gpekh824qf3206e', 'jpg', 109760, 500, 328, 'Kids', 'Les enfants d&#039;abord', 2, 3),
(31, '20150625142644arralo2mm5gl5967iipq03prbdma097l247k', 'jpg', 122391, 500, 333, 'Fillette', 'Et puis un coq', 2, 3),
(32, '20150625142711jk4hkjf5hgf0i2f5b8c31i947id6el01iqe5', 'jpg', 67464, 500, 334, 'Ben', 'Un couch&eacute; de soleil', 2, 3),
(33, '20150625142748l022mlm667d9h8724ki7h58495ldldprc10j', 'jpg', 99563, 500, 246, 'Maison', 'Une maison en bois', 2, 3),
(34, '20150625142827ejo51ph563m2md9j624bdmg5kpm70ecl57fe', 'jpg', 68927, 500, 334, 'Table', 'Il bosse dur...', 2, 4),
(35, '20150625142858c11dbaoc9mr7jd528fc943o783cdl51mi98o', 'jpg', 92489, 333, 500, 'City', 'Shangai mon oeil...', 2, 4),
(36, '201506251429320qi28opnho1doh3nlff6cmrlqdnn1a5jo67q', 'jpg', 48544, 334, 500, 'Cat', 'Petit chat adorable', 2, 4),
(37, '20150625142958q6k9qndgflk5mijha2n2cg6k8c2cfc2nl4cd', 'jpg', 84040, 500, 500, 'Bureau', 'Elle bosse grave.', 2, 4),
(38, '20150625143029lfjcj2rab63kfqan88g4942od0n21amdk2eq', 'jpg', 93033, 500, 334, 'Voyage', 'Hola, elle veut partir', 2, 4),
(39, '20150625143144l0dfgnobji4b745e10qhodh20hhdh0felcq4', 'jpg', 123978, 333, 500, 'Ciel', 'Beaux paysage', 2, 5),
(40, '2015062514321236730pdmi090gf78bf9do026h0njr059kb1p', 'jpg', 114677, 500, 333, 'House', 'A l&#039;interieur', 2, 5),
(41, '201506251432430r9c70g36fcoglipr5e5qfc1e48bln73472o', 'jpg', 93427, 500, 369, 'Kids', 'Papa nage bien.', 2, 5),
(42, '20150625143334bdpncbi2a71dq4hgpj8d2q9bibnlqa1lrrr8', 'jpg', 67617, 500, 251, 'Allez', 'Coup de boule...', 2, 5),
(43, '201506251434255indah0hciq41b8k49fn37367f64j6q0km1m', 'jpg', 107657, 500, 334, 'Course', 'Un petit footing', 2, 5),
(44, '2015062514345208k3fkh4m9afd83fimgj8eoa2j6blkr9hpog', 'jpg', 42348, 500, 334, 'Chat', 'Chez la docteresse.', 2, 5),
(45, '20150625143526qen7dbbaikq36p6a5o8mp7o660eor5cjmf3r', 'jpg', 98802, 500, 333, 'Ciel', 'New-york ta m&egrave;re.', 2, 5),
(46, '201506251436063g069ib3j9pggorjqr98phaehoj1j4p53b8j', 'jpg', 25807, 334, 500, 'Loupe', 'Zoom &agrave; gogo', 2, 5),
(47, '20150625143637mc6gdqoanqbcpdiqq456m2begrgmnhdd6q42', 'jpg', 87081, 500, 317, 'Truck', 'Couleur arc-en-ciel', 2, 5);

-- --------------------------------------------------------

--
-- Structure de la table `photo_has_rubriques`
--

CREATE TABLE IF NOT EXISTS `photo_has_rubriques` (
  `photo_id` int(10) unsigned NOT NULL,
  `rubriques_id` int(10) unsigned NOT NULL,
  KEY `fk_photo_has_rubriques_rubriques1_idx` (`rubriques_id`),
  KEY `fk_photo_has_rubriques_photo1_idx` (`photo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `photo_has_rubriques`
--

INSERT INTO `photo_has_rubriques` (`photo_id`, `rubriques_id`) VALUES
(17, 9),
(19, 5),
(20, 4),
(27, 9),
(28, 8),
(29, 1),
(30, 4),
(31, 1),
(32, 5),
(33, 2),
(34, 7),
(35, 2),
(36, 1),
(37, 9),
(39, 3),
(40, 2),
(41, 3),
(42, 6),
(43, 6),
(44, 9),
(45, 2),
(46, 4),
(47, 8);

-- --------------------------------------------------------

--
-- Structure de la table `rubriques`
--

CREATE TABLE IF NOT EXISTS `rubriques` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lintitule` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `rubriques`
--

INSERT INTO `rubriques` (`id`, `lintitule`) VALUES
(1, 'Animaux'),
(2, 'Architectures'),
(3, 'Artistiques'),
(4, 'Personnes'),
(5, 'Paysages'),
(6, 'Sports'),
(7, 'Technologies'),
(8, 'Transports'),
(9, 'Divers');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lelogin` varchar(100) DEFAULT NULL,
  `lepass` varchar(45) DEFAULT NULL,
  `lemail` varchar(150) DEFAULT NULL,
  `lenom` varchar(80) DEFAULT NULL,
  `valide` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `droit_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lelogin_UNIQUE` (`lelogin`),
  KEY `fk_utilisateur_droit_idx` (`droit_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `lelogin`, `lepass`, `lemail`, `lenom`, `valide`, `droit_id`) VALUES
(3, 'Admin', 'admin', 'sallartistee@yahoo.fr', 'Super Admin', 1, 1),
(4, 'eric', 'salla', 'sallartiste@gmail.com', 'Eric Salla', 1, 2),
(5, 'util1', 'util1', 'utili@yahoo.nz', 'Utilisateur One', 1, 3),
(6, 'Util2', 'util2', 'utilisateur@wanadoo.uk', 'Utilisateur Two', 1, 3);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `fk_photo_utilisateur1` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateur` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `photo_has_rubriques`
--
ALTER TABLE `photo_has_rubriques`
  ADD CONSTRAINT `fk_photo_has_rubriques_photo1` FOREIGN KEY (`photo_id`) REFERENCES `photo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_photo_has_rubriques_rubriques1` FOREIGN KEY (`rubriques_id`) REFERENCES `rubriques` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `fk_utilisateur_droit` FOREIGN KEY (`droit_id`) REFERENCES `droit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
