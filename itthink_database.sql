-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 25, 2024 at 03:29 PM
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
-- Database: `itthink_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_categorie` int NOT NULL,
  `nom_categorie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_categorie`, `nom_categorie`) VALUES
(48, 'cat1'),
(57, 'cat2');

-- --------------------------------------------------------

--
-- Table structure for table `freelances`
--

CREATE TABLE `freelances` (
  `id_utilisateur` int NOT NULL,
  `competences` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offres`
--

CREATE TABLE `offres` (
  `id_offre` int NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `delai` datetime NOT NULL,
  `id_utilisateur` int NOT NULL,
  `id_projet` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `offres`
--

INSERT INTO `offres` (`id_offre`, `montant`, `delai`, `id_utilisateur`, `id_projet`, `status`) VALUES
(9, '1000.00', '2024-12-26 02:50:00', 32, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `projets`
--

CREATE TABLE `projets` (
  `id_projet` int NOT NULL,
  `titre_projet` varchar(100) NOT NULL,
  `description` text,
  `id_categorie` int DEFAULT NULL,
  `id_sous_categorie` int DEFAULT NULL,
  `id_utilisateur` int DEFAULT NULL,
  `project_status` tinyint NOT NULL DEFAULT '1',
  `accepted_offre_id` int DEFAULT NULL
) ;

--
-- Dumping data for table `projets`
--

INSERT INTO `projets` (`id_projet`, `titre_projet`, `description`, `id_categorie`, `id_sous_categorie`, `id_utilisateur`, `project_status`, `accepted_offre_id`) VALUES
(5, 'project1', 'this is project 1 description', 48, 8, 31, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `sous_categories`
--

CREATE TABLE `sous_categories` (
  `id_sous_categorie` int NOT NULL,
  `nom_sous_categorie` varchar(100) NOT NULL,
  `id_categorie` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sous_categories`
--

INSERT INTO `sous_categories` (`id_sous_categorie`, `nom_sous_categorie`, `id_categorie`) VALUES
(8, 'sou cat1', 48),
(16, 'subcat1 cat2', 57);

-- --------------------------------------------------------

--
-- Table structure for table `temoignages`
--

CREATE TABLE `temoignages` (
  `id_temoignage` int NOT NULL,
  `commentaire` text NOT NULL,
  `id_utilisateur` int NOT NULL,
  `id_offre` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `temoignages`
--

INSERT INTO `temoignages` (`id_temoignage`, `commentaire`, `id_utilisateur`, `id_offre`) VALUES
(25, 'comment', 31, 9);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int NOT NULL,
  `nom_utilisateur` varchar(100) NOT NULL,
  `mot_de_passe` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` int DEFAULT NULL,
  `is_active` tinyint NOT NULL DEFAULT '1',
  `title` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom_utilisateur`, `mot_de_passe`, `email`, `role`, `is_active`, `title`) VALUES
(22, 'Admin', '$2y$10$LJjPWaxEea7Tl33.t2NsYOZY4CZ1qOUEHbmstzRJAqdMMfU3w47we', 'Admin@gmail.com', 1, 1, NULL),
(29, 'user2', '$2y$10$ytP17zlFQWZjjTdLOsui/eljz.JdtBEN1LwDattAvnVOiHkMOxp/e', 'user2@gmail.com', 3, 1, NULL),
(31, 'client1', '$2y$10$AHjdhcWR/eEDsICVIsyTtu0RAUi/D9d9PTNvqhYRLRuZINb4KMOFq', 'client1@gmail.com', 2, 1, NULL),
(32, 'freelancer1', '$2y$10$YqMpgzwaH73DNGoPo450VOHom.9FXFu6FE40kj5ocCniV1V5CHnYS', 'freelancer1@gmail.com', 3, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_categorie`),
  ADD UNIQUE KEY `nom_categorie` (`nom_categorie`);

--
-- Indexes for table `freelances`
--
ALTER TABLE `freelances`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- Indexes for table `offres`
--
ALTER TABLE `offres`
  ADD PRIMARY KEY (`id_offre`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_projet` (`id_projet`);

--
-- Indexes for table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`id_projet`),
  ADD KEY `id_categorie` (`id_categorie`),
  ADD KEY `id_sous_categorie` (`id_sous_categorie`),
  ADD KEY `projets_ibfk_1` (`id_utilisateur`),
  ADD KEY `fk_accepted_offre` (`accepted_offre_id`);

--
-- Indexes for table `sous_categories`
--
ALTER TABLE `sous_categories`
  ADD PRIMARY KEY (`id_sous_categorie`),
  ADD UNIQUE KEY `nom_sous_categorie_constraint` (`nom_sous_categorie`),
  ADD KEY `fk_id_categorie` (`id_categorie`);

--
-- Indexes for table `temoignages`
--
ALTER TABLE `temoignages`
  ADD PRIMARY KEY (`id_temoignage`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_offre` (`id_offre`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_categorie` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `offres`
--
ALTER TABLE `offres`
  MODIFY `id_offre` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `projets`
--
ALTER TABLE `projets`
  MODIFY `id_projet` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sous_categories`
--
ALTER TABLE `sous_categories`
  MODIFY `id_sous_categorie` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `temoignages`
--
ALTER TABLE `temoignages`
  MODIFY `id_temoignage` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `freelances`
--
ALTER TABLE `freelances`
  ADD CONSTRAINT `freelances_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`);

--
-- Constraints for table `offres`
--
ALTER TABLE `offres`
  ADD CONSTRAINT `offres_ibfk_2` FOREIGN KEY (`id_projet`) REFERENCES `projets` (`id_projet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projets`
--
ALTER TABLE `projets`
  ADD CONSTRAINT `fk_accepted_offre` FOREIGN KEY (`accepted_offre_id`) REFERENCES `offres` (`id_offre`) ON DELETE CASCADE,
  ADD CONSTRAINT `projets_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`),
  ADD CONSTRAINT `projets_ibfk_2` FOREIGN KEY (`id_sous_categorie`) REFERENCES `sous_categories` (`id_sous_categorie`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sous_categories`
--
ALTER TABLE `sous_categories`
  ADD CONSTRAINT `fk_id_categorie` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id_categorie`) ON DELETE CASCADE;

--
-- Constraints for table `temoignages`
--
ALTER TABLE `temoignages`
  ADD CONSTRAINT `temoignages_ibfk_2` FOREIGN KEY (`id_offre`) REFERENCES `offres` (`id_offre`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
