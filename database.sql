-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 12 août 2026 à 01:26
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `eclaireurs_solidaires`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `prenom`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Eclaireur', 'admin@eclaireurs-solidaires.fr', '$2y$10$e8R6.Qv63KkYwF3pvhI32eC5pQWp6n9c5JkUu1uG1eX.b/0O8iJ2K', '2026-08-11 13:07:35', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `city`
--

CREATE TABLE `city` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(100) NOT NULL,
  `code_postal` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `city`
--

INSERT INTO `city` (`id`, `nom`, `code_postal`) VALUES
(1, 'Grenoble', '38000'),
(2, 'Grenoble', '38100'),
(3, 'Échirolles', '38130');

-- --------------------------------------------------------

--
-- Structure de la table `demand_mission`
--

CREATE TABLE `demand_mission` (
  `id` int(10) UNSIGNED NOT NULL,
  `mission_id` int(10) UNSIGNED NOT NULL,
  `demandeur_id` int(10) UNSIGNED NOT NULL,
  `statut` enum('en_attente','acceptee','refusee','terminee') NOT NULL DEFAULT 'en_attente',
  `message` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `demand_mission`
--

INSERT INTO `demand_mission` (`id`, `mission_id`, `demandeur_id`, `statut`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'acceptee', 'Bonjour Marie, je suis disponible pour vous aider.', '2026-08-11 13:07:36', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `expediteur_id` int(10) UNSIGNED NOT NULL,
  `destinataire_id` int(10) UNSIGNED NOT NULL,
  `mission_id` int(10) UNSIGNED DEFAULT NULL,
  `contenu` text NOT NULL,
  `lu` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `missions`
--

CREATE TABLE `missions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `thematic_id` int(10) UNSIGNED NOT NULL,
  `city_id` int(10) UNSIGNED DEFAULT NULL,
  `titre` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `type` enum('offre','demande') NOT NULL DEFAULT 'offre',
  `statut` enum('active','en_cours','terminee','annulee') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `missions`
--

INSERT INTO `missions` (`id`, `user_id`, `thematic_id`, `city_id`, `titre`, `description`, `type`, `statut`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Besoin d\'aide pour mes courses', 'Recherche accompagnement pour courses hebdomadaires.', 'demande', 'active', '2026-08-11 13:07:36', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `thematics_missions`
--

CREATE TABLE `thematics_missions` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `icone` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `thematics_missions`
--

INSERT INTO `thematics_missions` (`id`, `nom`, `description`, `icone`) VALUES
(1, 'Aide aux courses', 'Accompagnement ou livraison de courses.', 'fa-shopping-cart'),
(2, 'Soutien scolaire', 'Aide aux devoirs et cours particuliers.', 'fa-graduation-cap');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `city_id` int(10) UNSIGNED DEFAULT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `city_id`, `nom`, `prenom`, `email`, `password`, `telephone`, `adresse`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dupont', 'Marie', 'marie.dupont@email.fr', '$2y$10$e8R6.Qv63KkYwF3pvhI32eC5pQWp6n9c5JkUu1uG1eX.b/0O8iJ2K', '0612345678', '12 Avenue Alsace-Lorraine', '2026-08-11 13:07:35', NULL),
(2, 1, 'Martin', 'Thomas', 'thomas.martin@email.fr', '$2y$10$e8R6.Qv63KkYwF3pvhI32eC5pQWp6n9c5JkUu1uG1eX.b/0O8iJ2K', '0698765432', '5 Rue Felix Poulat', '2026-08-11 13:07:35', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `demand_mission`
--
ALTER TABLE `demand_mission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_demand_missions_mission` (`mission_id`),
  ADD KEY `fk_demand_missions_user` (`demandeur_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_messages_expediteur` (`expediteur_id`),
  ADD KEY `fk_messages_destinataire` (`destinataire_id`),
  ADD KEY `fk_messages_mission` (`mission_id`);

--
-- Index pour la table `missions`
--
ALTER TABLE `missions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_missions_users` (`user_id`),
  ADD KEY `fk_missions_thematics` (`thematic_id`),
  ADD KEY `fk_missions_city` (`city_id`);

--
-- Index pour la table `thematics_missions`
--
ALTER TABLE `thematics_missions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom` (`nom`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_users_city` (`city_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `demand_mission`
--
ALTER TABLE `demand_mission`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `missions`
--
ALTER TABLE `missions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `thematics_missions`
--
ALTER TABLE `thematics_missions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `demand_mission`
--
ALTER TABLE `demand_mission`
  ADD CONSTRAINT `fk_demand_missions_mission` FOREIGN KEY (`mission_id`) REFERENCES `missions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_demand_missions_user` FOREIGN KEY (`demandeur_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_messages_destinataire` FOREIGN KEY (`destinataire_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_messages_expediteur` FOREIGN KEY (`expediteur_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_messages_mission` FOREIGN KEY (`mission_id`) REFERENCES `missions` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `missions`
--
ALTER TABLE `missions`
  ADD CONSTRAINT `fk_missions_city` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_missions_thematics` FOREIGN KEY (`thematic_id`) REFERENCES `thematics_missions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_missions_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_city` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
