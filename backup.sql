-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql-eclaireurs-solidaires.alwaysdata.net
-- Generation Time: Oct 15, 2026 at 07:28 AM
-- Server version: 11.4.13-MariaDB
-- PHP Version: 8.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eclaireurs-solidaires_eclaireurs_solidaires`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(30) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `admin_password` varchar(250) NOT NULL,
  `admin_date_creation` datetime NOT NULL,
  `id_roles` int(11) DEFAULT NULL,
  `id_auth` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `admin_date_creation`, `id_roles`, `id_auth`) VALUES
(6, 'El Hadji Cata Ndiaye', 'paomar8@gmail.com', '$2y$10$nUjFaRcUtSyRa4kw1BQ9KezxJYuzRA1Bm6j6gamSvzQqXB0iKSLDu', '2026-09-16 00:00:00', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `auth_id` int(11) NOT NULL,
  `auth_email` varchar(30) NOT NULL,
  `auth_pswrd` varchar(250) NOT NULL,
  `auth_date` datetime NOT NULL,
  `id_roles` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`auth_id`, `auth_email`, `auth_pswrd`, `auth_date`, `id_roles`) VALUES
(3, 'paomar8@gmail.com', '$2y$10$nUjFaRcUtSyRa4kw1BQ9KezxJYuzRA1Bm6j6gamSvzQqXB0iKSLDu', '2026-09-25 11:50:12', 1),
(4, 'omardiop@gmail.com', '$2y$10$EIi3VcS1TJhrKXadOzsAZ.NzROaEdZNesS3au77jNl5hpEtkHGvHi', '2026-09-25 11:50:45', 2),
(5, 'emmapernet@gmail.com', '$2y$10$dce19Jq7JBSK2NOMi5qnxubRiXRhzCTwdpaAZT.tF/220vxwhy/MK', '2026-09-25 11:50:45', 2);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(30) NOT NULL,
  `city_zipcode` char(5) NOT NULL,
  `id_country` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`, `city_zipcode`, `id_country`) VALUES
(1, 'Paris', '95000', 1),
(2, 'LYON', '69000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`) VALUES
(1, 'FRANCE'),
(2, 'ESPAGNE');

-- --------------------------------------------------------

--
-- Table structure for table `demand_mission`
--

CREATE TABLE `demand_mission` (
  `demand_mission_id` int(11) NOT NULL,
  `demand_mission_date` datetime NOT NULL,
  `demand_mission_validation` tinyint(1) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_missions` int(11) NOT NULL,
  `demand_mission_avis` text DEFAULT NULL,
  `demand_mission_note` char(15) DEFAULT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `demand_mission`
--

INSERT INTO `demand_mission` (`demand_mission_id`, `demand_mission_date`, `demand_mission_validation`, `id_users`, `id_missions`, `demand_mission_avis`, `demand_mission_note`, `id_status`) VALUES
(10, '2026-09-17 16:24:41', 1, 3, 6, '', '', 1),
(11, '2026-09-17 16:25:17', 1, 3, 2, '', '', 1),
(12, '2026-09-18 18:26:47', 1, 3, 7, '', '', 1),
(13, '2026-09-18 21:55:06', 1, 3, 3, 'Un atelier super bien organisé et dans une ambiance très conviviale. On apprend plein de choses sur la revalorisation des déchets tout en se rendant utile. Une belle action concrète pour l&#039;environnement !', '3', 1),
(14, '2026-09-21 19:51:07', 1, 3, 4, '', '', 1),
(15, '2026-09-23 15:04:14', 1, 3, 5, '', '', 1),
(17, '2026-09-23 15:55:46', 1, 4, 4, 'Super expérience, équipe très accueillante !', '5', 1),
(18, '2026-09-23 16:21:25', 1, 4, 2, '', '', 1),
(19, '2026-09-23 22:41:24', 1, 4, 3, 'Très bonne mission ! L&#039;organisation était fluide et l&#039;équipe au top. Une excellente façon de s&#039;engager bénévolement pour une cause écologique', '4', 1),
(20, '2026-09-24 09:59:27', 1, 4, 6, '', '', 1),
(21, '2026-09-24 10:01:06', 1, 4, 7, '', '', 1),
(22, '2026-09-24 10:08:33', 1, 4, 5, '', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `message_date` datetime NOT NULL,
  `message_admin` tinyint(1) NOT NULL,
  `message_content` text NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `message_date`, `message_admin`, `message_content`, `id_users`, `id_admin`, `is_read`) VALUES
(2, '2026-09-25 09:16:53', 0, 'Coucou', 4, 6, 1),
(3, '2026-09-25 09:26:04', 1, 'Salut', 4, 6, 1),
(4, '2026-09-25 09:26:08', 1, 'Comment tu vas?', 4, 6, 1),
(5, '2026-09-25 09:26:48', 0, 'Oui ca va super :)', 4, 6, 1),
(6, '2026-09-25 09:27:30', 0, 'Hello', 3, 6, 1),
(7, '2026-09-25 09:27:58', 1, 'Hello :)', 3, 6, 1),
(8, '2026-09-25 09:59:39', 1, 'quoi de neuf?', 3, 6, 1),
(9, '2026-09-25 09:59:50', 1, 'Cool :)', 4, 6, 1),
(10, '2026-09-25 10:00:23', 0, 'Rien de special', 3, 6, 1),
(11, '2026-09-25 10:00:34', 0, 'et toi?', 3, 6, 1),
(12, '2026-09-25 10:01:01', 0, 'Yes', 4, 6, 1),
(13, '2026-09-25 10:21:17', 1, 'Idem', 3, 6, 1),
(14, '2026-09-25 10:21:25', 1, 'ok', 4, 6, 1),
(15, '2026-09-25 10:21:59', 0, 'good', 4, 6, 1),
(16, '2026-09-25 10:22:30', 0, 'd\'accord :)', 3, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `missions`
--

CREATE TABLE `missions` (
  `missions_id` int(11) NOT NULL,
  `missions_name` varchar(30) NOT NULL,
  `missions_description` text NOT NULL,
  `missions_date_start` date NOT NULL,
  `missions_date_stop` date NOT NULL,
  `missions_nbre_volontaries` smallint(6) NOT NULL,
  `missions_address` varchar(50) NOT NULL,
  `missions_duration_hour` time NOT NULL,
  `missions_publication_date` datetime NOT NULL,
  `id_thematics_missions` int(11) NOT NULL,
  `id_city` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `missions`
--

INSERT INTO `missions` (`missions_id`, `missions_name`, `missions_description`, `missions_date_start`, `missions_date_stop`, `missions_nbre_volontaries`, `missions_address`, `missions_duration_hour`, `missions_publication_date`, `id_thematics_missions`, `id_city`) VALUES
(2, 'Maraude nocturne et distributi', 'Inscription pour la tournée du week-end auprès des personnes sans-abri. Distribution de repas chauds, couvertures et kits d\'hygiène. Prévoir des vêtements chauds et de bonnes chaussures.', '2026-09-17', '2026-09-17', 8, '12 Place de la République', '03:30:00', '2026-09-16 00:00:00', 2, 1),
(3, 'Atelier de tri et recyclage', 'Animation d\'un stand d\'information pour expliquer les consignes de tri sélectif aux habitants du quartier', '2026-09-19', '2026-09-19', 3, '4 Rue de la Claire', '03:00:00', '2026-09-17 00:00:00', 3, 2),
(4, 'Distribution de repas chauds', 'Préparation et service de repas du soir pour les personnes en situation de précarité.', '2026-09-19', '2026-09-19', 6, '56 Avenue washington', '04:00:00', '2026-09-17 00:00:00', 2, 1),
(5, 'Aide aux devoirs - Niveau Prim', 'Accompagnement d\'enfants du CP au CM2 pour la lecture et les exercices après l\'école.', '2026-09-20', '2026-09-20', 3, '6 TER Rue du DRAC', '02:00:00', '2026-09-17 00:00:00', 4, 2),
(6, 'Visite de convivialité en EHPA', ' Organisation de jeux de société et moments d\'échange avec les résidents pour rompre l\'isolement.', '2026-09-19', '2026-09-19', 5, '68 Boulevard de FRANCE', '02:00:00', '2026-09-17 00:00:00', 5, 1),
(7, 'Promenade des chiens du refuge', 'Sortie et sociabilisation des chiens en attente d\'adoption le week-end.', '2026-09-24', '2026-09-24', 2, '5 Rue Jacqueline Prevost', '03:00:00', '2026-09-17 00:00:00', 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roles_id` int(11) NOT NULL,
  `roles_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roles_id`, `roles_name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(1, 'En Attente'),
(2, 'Validée'),
(3, 'Rejetée');

-- --------------------------------------------------------

--
-- Table structure for table `thematics_missions`
--

CREATE TABLE `thematics_missions` (
  `thematics_missions_id` int(11) NOT NULL,
  `thematics_missions_name` varchar(30) NOT NULL,
  `thematics_missions_is_activated` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thematics_missions`
--

INSERT INTO `thematics_missions` (`thematics_missions_id`, `thematics_missions_name`, `thematics_missions_is_activated`) VALUES
(1, 'Aide ménagère', 1),
(2, 'Aide alimentaire et sociale', 1),
(3, 'Sensibilisation à l\'environnem', 1),
(4, 'Soutien scolaire & Éducation', 1),
(5, 'Accompagnement des aînés', 1),
(6, 'Protection animale', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_id` int(11) NOT NULL,
  `users_firstname` varchar(30) NOT NULL,
  `users_lastname` varchar(30) NOT NULL,
  `users_email` varchar(30) NOT NULL,
  `users_password` varchar(250) NOT NULL,
  `users_address` varchar(30) NOT NULL,
  `users_gender` tinyint(1) NOT NULL,
  `users_birthday` date NOT NULL,
  `users_date_creation` datetime NOT NULL,
  `users_img` varchar(50) DEFAULT NULL,
  `users_city` varchar(30) NOT NULL,
  `users_country` varchar(30) NOT NULL,
  `id_auth` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `users_firstname`, `users_lastname`, `users_email`, `users_password`, `users_address`, `users_gender`, `users_birthday`, `users_date_creation`, `users_img`, `users_city`, `users_country`, `id_auth`) VALUES
(3, 'omar', 'Diop', 'omardiop@gmail.com', '$2y$10$EIi3VcS1TJhrKXadOzsAZ.NzROaEdZNesS3au77jNl5hpEtkHGvHi', '6 Rue Capitaine Belmont', 1, '2014-06-12', '2026-09-16 00:00:00', 'omar-16-09-2026_23-44-13.jpg', 'Grenoble', 'France', 4),
(4, 'Emma', 'Pernet', 'emmapernet@gmail.com', '$2y$10$dce19Jq7JBSK2NOMi5qnxubRiXRhzCTwdpaAZT.tF/220vxwhy/MK', ' 8 Rue de la Claire', 2, '1992-12-31', '2026-09-23 00:00:00', 'Emma-23-09-2026_15-54-40.jpg', 'Lyon', 'France', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `fk_admin_roles` (`id_roles`),
  ADD KEY `fk_admin_auth` (`id_auth`);

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`auth_id`),
  ADD KEY `fk_auth_roles` (`id_roles`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `fk_city_country` (`id_country`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `demand_mission`
--
ALTER TABLE `demand_mission`
  ADD PRIMARY KEY (`demand_mission_id`),
  ADD KEY `fk_demand_users` (`id_users`),
  ADD KEY `fk_demand_missions` (`id_missions`),
  ADD KEY `fk_demand_status` (`id_status`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `fk_message_users` (`id_users`),
  ADD KEY `fk_message_admin` (`id_admin`);

--
-- Indexes for table `missions`
--
ALTER TABLE `missions`
  ADD PRIMARY KEY (`missions_id`),
  ADD KEY `fk_missions_thematics` (`id_thematics_missions`),
  ADD KEY `fk_missions_city` (`id_city`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roles_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `thematics_missions`
--
ALTER TABLE `thematics_missions`
  ADD PRIMARY KEY (`thematics_missions_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD KEY `fk_users_auth` (`id_auth`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `auth_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `demand_mission`
--
ALTER TABLE `demand_mission`
  MODIFY `demand_mission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `missions`
--
ALTER TABLE `missions`
  MODIFY `missions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `thematics_missions`
--
ALTER TABLE `thematics_missions`
  MODIFY `thematics_missions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_admin_auth` FOREIGN KEY (`id_auth`) REFERENCES `auth` (`auth_id`),
  ADD CONSTRAINT `fk_admin_roles` FOREIGN KEY (`id_roles`) REFERENCES `roles` (`roles_id`);

--
-- Constraints for table `auth`
--
ALTER TABLE `auth`
  ADD CONSTRAINT `fk_auth_roles` FOREIGN KEY (`id_roles`) REFERENCES `roles` (`roles_id`);

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `fk_city_country` FOREIGN KEY (`id_country`) REFERENCES `country` (`country_id`);

--
-- Constraints for table `demand_mission`
--
ALTER TABLE `demand_mission`
  ADD CONSTRAINT `fk_demand_missions` FOREIGN KEY (`id_missions`) REFERENCES `missions` (`missions_id`),
  ADD CONSTRAINT `fk_demand_status` FOREIGN KEY (`id_status`) REFERENCES `status` (`status_id`),
  ADD CONSTRAINT `fk_demand_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`users_id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_message_admin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`admin_id`),
  ADD CONSTRAINT `fk_message_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`users_id`);

--
-- Constraints for table `missions`
--
ALTER TABLE `missions`
  ADD CONSTRAINT `fk_missions_city` FOREIGN KEY (`id_city`) REFERENCES `city` (`city_id`),
  ADD CONSTRAINT `fk_missions_thematics` FOREIGN KEY (`id_thematics_missions`) REFERENCES `thematics_missions` (`thematics_missions_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_auth` FOREIGN KEY (`id_auth`) REFERENCES `auth` (`auth_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
