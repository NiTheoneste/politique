-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2024 at 04:00 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `politiquedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `etat`
--

CREATE TABLE `etat` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `pid` varchar(50) DEFAULT NULL,
  `population` int(11) DEFAULT NULL CHECK (`population` >= 0),
  `superficie` decimal(10,2) DEFAULT NULL CHECK (`superficie` >= 0),
  `capitale` varchar(100) DEFAULT NULL,
  `flugs_id` int(11) DEFAULT NULL,
  `date_fondation` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `etat`
--

INSERT INTO `etat` (`id`, `nom`, `pid`, `population`, `superficie`, `capitale`, `flugs_id`, `date_fondation`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Burundi', '6541250', 2147483647, 99999999.99, '887745255322', 1, '2024-10-27', '2024-11-06 14:27:16', '2024-11-06 14:30:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `flugs`
--

CREATE TABLE `flugs` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `nom` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flugs`
--

INSERT INTO `flugs` (`id`, `image`, `nom`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Burundi', 'burundi.jpg', 'Le burundi est un pays de l\'Afrique de l\'EST', '2024-11-06 10:38:29', '2024-11-06 11:44:50', NULL),
(2, 'rwanda.png', 'Rwanda', 'Le Rwanda est un bon pays', '2024-11-06 10:50:14', '2024-11-06 10:50:14', NULL),
(5, 'g', 'fdf', 'gf', '2024-11-06 11:45:31', '2024-11-06 11:45:31', NULL),
(7, 'gffg', 'ffg', 'fdf', '2024-11-06 11:45:52', '2024-11-06 11:45:52', NULL),
(8, 'gfg', 'gfg', 'ffg', '2024-11-06 11:46:03', '2024-11-06 11:46:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gouverneurs`
--

CREATE TABLE `gouverneurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL CHECK (`age` >= 18),
  `telephone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gender` enum('Homme','Femme') DEFAULT NULL,
  `etat_id` int(11) DEFAULT NULL,
  `partis_id` int(11) DEFAULT NULL,
  `date_election` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grandselecteurs`
--

CREATE TABLE `grandselecteurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL CHECK (`age` >= 18),
  `telephone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gender` enum('Homme','Femme') DEFAULT NULL,
  `etat_id` int(11) DEFAULT NULL,
  `partis_id` int(11) DEFAULT NULL,
  `date_election` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `partis`
--

CREATE TABLE `partis` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `fondateur` varchar(100) DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `ideology` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `senateurs`
--

CREATE TABLE `senateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL CHECK (`age` >= 18),
  `telephone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gender` enum('Homme','Femme') DEFAULT NULL,
  `etat_id` int(11) DEFAULT NULL,
  `partis_id` int(11) DEFAULT NULL,
  `date_election` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`),
  ADD KEY `flugs_id` (`flugs_id`),
  ADD KEY `idx_nom_etat` (`nom`);

--
-- Indexes for table `flugs`
--
ALTER TABLE `flugs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Indexes for table `gouverneurs`
--
ALTER TABLE `gouverneurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nom` (`nom`,`prenom`,`etat_id`),
  ADD KEY `etat_id` (`etat_id`),
  ADD KEY `partis_id` (`partis_id`),
  ADD KEY `idx_nom_gouverneurs` (`nom`,`prenom`);

--
-- Indexes for table `grandselecteurs`
--
ALTER TABLE `grandselecteurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nom` (`nom`,`prenom`,`etat_id`),
  ADD KEY `etat_id` (`etat_id`),
  ADD KEY `partis_id` (`partis_id`),
  ADD KEY `idx_nom_grands_electeurs` (`nom`,`prenom`);

--
-- Indexes for table `partis`
--
ALTER TABLE `partis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`),
  ADD KEY `idx_nom_partis` (`nom`);

--
-- Indexes for table `senateurs`
--
ALTER TABLE `senateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nom` (`nom`,`prenom`,`etat_id`),
  ADD KEY `etat_id` (`etat_id`),
  ADD KEY `partis_id` (`partis_id`),
  ADD KEY `idx_nom_senateurs` (`nom`,`prenom`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `etat`
--
ALTER TABLE `etat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `flugs`
--
ALTER TABLE `flugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gouverneurs`
--
ALTER TABLE `gouverneurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grandselecteurs`
--
ALTER TABLE `grandselecteurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `partis`
--
ALTER TABLE `partis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `senateurs`
--
ALTER TABLE `senateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `etat`
--
ALTER TABLE `etat`
  ADD CONSTRAINT `etat_ibfk_1` FOREIGN KEY (`flugs_id`) REFERENCES `flugs` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `gouverneurs`
--
ALTER TABLE `gouverneurs`
  ADD CONSTRAINT `gouverneurs_ibfk_1` FOREIGN KEY (`etat_id`) REFERENCES `etat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gouverneurs_ibfk_2` FOREIGN KEY (`partis_id`) REFERENCES `partis` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `grandselecteurs`
--
ALTER TABLE `grandselecteurs`
  ADD CONSTRAINT `grandselecteurs_ibfk_1` FOREIGN KEY (`etat_id`) REFERENCES `etat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `grandselecteurs_ibfk_2` FOREIGN KEY (`partis_id`) REFERENCES `partis` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `senateurs`
--
ALTER TABLE `senateurs`
  ADD CONSTRAINT `senateurs_ibfk_1` FOREIGN KEY (`etat_id`) REFERENCES `etat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `senateurs_ibfk_2` FOREIGN KEY (`partis_id`) REFERENCES `partis` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
