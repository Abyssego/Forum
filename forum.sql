-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 28, 2024 at 02:04 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `idArt` int NOT NULL,
  `titreArt` varchar(60) DEFAULT NULL,
  `dateArt` datetime DEFAULT CURRENT_TIMESTAMP,
  `contenuArt` varchar(1024) DEFAULT NULL,
  `idMemb` varchar(50) DEFAULT NULL,
  `idRub` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`idArt`, `titreArt`, `dateArt`, `contenuArt`, `idMemb`, `idRub`) VALUES
(1, 'Problème adressage IP', '2023-01-13 10:18:37', 'Je n\'ai pas compris comment cela marche, help me.', 'abyssego4@gmail.com', 2),
(2, 'Pourquoi utiliser les classes ?', '2023-01-13 11:42:07', 'Est-ce que quelqu\'un sait spécifiquement à quoi sert de créé des classes et ses avantages ??', 'abyssego4@gmail.com', 6),
(3, 'Recherche stage', '2023-01-13 11:43:36', 'Est-ce que les secondes années pourrait donnée l\'endroit où ils ont fait leurs stages ??', 'abyssego4@gmail.com', 3),
(4, 'Comment monter une machine virtuel ?', '2023-01-20 09:45:13', 'J\'ai essayé de monté une machine Debian pour m\'en servir comme serveur, mais elle ne marche pas, quelqu\'un aurait-il des conseil ou tuto pour aider ?', 'abyssego4@gmail.com', 1),
(5, 'Aide prononciation', '2023-01-20 09:46:37', 'Nous devons faire un oral en anglais, mais je ne suis pas très bon avec la prononciation des mots, quelqu\'un aurait-il des conseils ?', 'abyssego4@gmail.com', 5),
(6, 'Requête SQL', '2023-01-20 09:48:55', 'Je code une requête SQl pour placer dans mon code php, mais je n\'arrive pas à ma connecter à ma BDD, et quand j\'exécute une requête dans phpMyAdmin directement, il me retourne des valeurs NULL.', 'abyssego4@gmail.com', 6),
(7, 'Fête', '2023-01-20 09:50:49', 'Message pour dire à tous les élèves de seconde année qu\'une fête est prévu pour ceux qui ont eu leurs BTS, mais ceux qui ne l\'ont pas feront le ménage.', 'abyssego4@gmail.com', 4),
(8, 'Verbe irrégulier ', '2023-02-03 20:22:52', 'Est-ce que quelqu\'un connaitrait un site qui contient tous les verbes irrégulier qu\'il y aura à l\'évaluation ?', 'abyssego4@gmail.com', 5),
(9, 'Digital Fishing', '2023-02-03 20:22:52', 'Comme j\'ai un niveau en programmation et un égo supérieur, voici les solutions les nuls :)', 'abyssego4@gmail.com', 3),
(10, 'Projet', '2023-02-03 20:26:52', 'Bonjour, les SIO 2, juste pour savoir si vous pouvez dire quelles projets vous avez fait en fonction de vos spécialités, merci.', 'abyssego4@gmail.com', 4),
(11, 'Mise en place serveur', '2023-02-03 20:26:52', 'Bonjour, j\'ai essayé de mettre en place un serveur mais mon pc à pris feu, est-ce que quelqu\'un à un extincteur ?', 'abyssego4@gmail.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `idCat` int NOT NULL,
  `nomCat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`idCat`, `nomCat`) VALUES
(1, 'Matières technologiques'),
(2, 'Matières générales'),
(3, 'Les niveaux');

-- --------------------------------------------------------

--
-- Table structure for table `membre`
--

CREATE TABLE `membre` (
  `idMemb` varchar(50) NOT NULL,
  `nomMemb` varchar(50) DEFAULT NULL,
  `prenomMemb` varchar(50) DEFAULT NULL,
  `dateIns` datetime DEFAULT CURRENT_TIMESTAMP,
  `mdpMemb` varchar(20) DEFAULT NULL,
  `typeMemb` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membre`
--

INSERT INTO `membre` (`idMemb`, `nomMemb`, `prenomMemb`, `dateIns`, `mdpMemb`, `typeMemb`) VALUES
('abyssego4@gmail.com', 'Massie', 'Loan', '2023-01-06 16:05:55', 'griotte', 3);

-- --------------------------------------------------------

--
-- Table structure for table `reponse`
--

CREATE TABLE `reponse` (
  `idRep` int NOT NULL,
  `idMemb` varchar(50) DEFAULT NULL,
  `idArt` int DEFAULT NULL,
  `dateRep` datetime DEFAULT CURRENT_TIMESTAMP,
  `contenuRep` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reponse`
--

INSERT INTO `reponse` (`idRep`, `idMemb`, `idArt`, `dateRep`, `contenuRep`) VALUES
(1, 'abyssego4@gmail.com', 1, '2023-01-13 10:19:49', 'Pourquoi personne ne me répond ?? Peut être car c\'est un teste.'),
(2, 'abyssego4@gmail.com', 2, '2023-01-13 11:45:35', 'Les classes servent à avoir un code plus propre et par conséquence pouvoir le maintenir facilement.'),
(3, 'abyssego4@gmail.com', 3, '2023-01-13 11:46:42', 'Tu peux aller sur ECLAT pour avoir la liste des entreprises où les élèves sont allez ces dernières années.'),
(4, 'abyssego4@gmail.com', 4, '2023-01-20 10:10:33', 'Il faut aller sur le disque D, et utiliser VMware.'),
(5, 'abyssego4@gmail.com', 5, '2023-01-20 10:11:53', 'S\'entrainer en allant sur discord, et aller dans un channel avec des anglais et parler avec eux. '),
(6, 'abyssego4@gmail.com', 6, '2023-01-20 10:13:10', 'Vérifie su les identifiant du login et mot de passe sont les bons, et insère des données dans les colonnes des tables qui renvoie NULL.'),
(7, 'abyssego4@gmail.com', 8, '2023-02-03 21:08:16', 'J\'ai pas compris'),
(8, 'abyssego4@gmail.com', 7, '2023-01-20 10:14:12', 'Je ramène Vodka.'),
(9, 'abyssego4@gmail.com', 9, '2023-02-03 21:08:16', 'Prend pas la grosse tête, non plus'),
(10, 'abyssego4@gmail.com', 10, '2023-02-03 21:09:41', 'Tkt, on te dit pas c\'est la surprise ! :)'),
(11, 'abyssego4@gmail.com', 11, '2023-02-03 21:09:41', 'Heuuuu, pas sur mais je pense que le jeté par la fenêtre aurait été un bon choix');

-- --------------------------------------------------------

--
-- Table structure for table `rubrique`
--

CREATE TABLE `rubrique` (
  `idRub` int NOT NULL,
  `nomRub` varchar(100) DEFAULT NULL,
  `descRub` varchar(300) DEFAULT NULL,
  `idCat` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rubrique`
--

INSERT INTO `rubrique` (`idRub`, `nomRub`, `descRub`, `idCat`) VALUES
(1, 'B1 - Support et mise à disposition de services informatiques', 'Ce module permet de construire les savoirs et savoir-faire liés au support et au maintien en condition opérationnelle de solution techniques.', 1),
(2, 'B2 SISR - Administration des systèmes et des réseaux', 'Ce module permet de construire les savoirs et savoir-faire liés au support et au maintien en condition opérationnelle de solutions techniques d\'accès \"réseau\"', 1),
(3, 'SIO 1', 'Ce module est destinée aux élèves de Première année.', 3),
(4, 'SIO 2', 'Ce module est destinée aux élèves de Seconde année.', 3),
(5, 'Anglais', 'La maîtrise de la langue vivante anglaise constitue une compétence fondamentale pour l\'exercice du futur métier dans le secteur informatique.', 2),
(6, 'Slam', 'Option du BTS SIO, pour apprendre le code dans le but de devenir développeur.', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`idArt`),
  ADD KEY `idRub` (`idRub`),
  ADD KEY `idMemb` (`idMemb`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCat`);

--
-- Indexes for table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`idMemb`);

--
-- Indexes for table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`idRep`),
  ADD KEY `idMemb` (`idMemb`),
  ADD KEY `idArt` (`idArt`);

--
-- Indexes for table `rubrique`
--
ALTER TABLE `rubrique`
  ADD PRIMARY KEY (`idRub`),
  ADD KEY `idCat` (`idCat`),
  ADD KEY `idCat_2` (`idCat`),
  ADD KEY `idCat_3` (`idCat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `idArt` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `idRep` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rubrique`
--
ALTER TABLE `rubrique`
  MODIFY `idRub` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_ARTICLE_MEMBRE` FOREIGN KEY (`idMemb`) REFERENCES `membre` (`idMemb`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ARTICLE_RUBRIQUE` FOREIGN KEY (`idRub`) REFERENCES `rubrique` (`idRub`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `FK_REPONSE_ARTICLE` FOREIGN KEY (`idArt`) REFERENCES `article` (`idArt`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_REPONSE_MEMBRE` FOREIGN KEY (`idMemb`) REFERENCES `membre` (`idMemb`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rubrique`
--
ALTER TABLE `rubrique`
  ADD CONSTRAINT `FK_RUBRIQUE_CATEGORIE` FOREIGN KEY (`idCat`) REFERENCES `categorie` (`idCat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
