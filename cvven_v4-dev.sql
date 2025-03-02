-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 16 fév. 2025 à 14:55
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
-- Base de données : `cvven`
--

CREATE DATABASE IF NOT EXISTS cvven;

USE cvven;

-- --------------------------------------------------------

--
-- Structure de la table `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `a_id` int(11) NOT NULL,
  `a_type` varchar(150) NOT NULL,
  `a_starting_date` datetime NOT NULL,
  `a_ending_date` datetime NOT NULL,
  `a_description` varchar(255) NOT NULL,
  `a_price` float NOT NULL CHECK (a_price > 0),
  `a_limit` int(11) NOT NULL CHECK (a_limit > 0),
  CHECK (a_ending_date >= a_starting_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `activities`
--

INSERT INTO `activities` (`a_id`, `a_type`, `a_starting_date`, `a_ending_date`, `a_description`, `a_price`, `a_limit`) VALUES
(1, 'Soirée dansante', '2025-02-14 20:00:00', '2025-02-14 23:00:00', 'Soirée dansante animée par des intervenants extérieurs', 20, 100),
(2, 'Spectacle de théâtre', '2025-04-20 19:30:00', '2025-04-20 22:00:00', 'Spectacle de théâtre avec magie et cirque', 25, 150),
(3, 'Atelier arts plastiques', '2025-04-15 14:00:00', '2025-04-15 16:00:00', 'Activité manuelle pour les vacances scolaires', 15, 20),
(4, 'Randonnée encadrée', '2025-07-10 09:00:00', '2025-07-10 12:00:00', 'Randonnée guidée pour participants aux colloques', 30, 30),
(5, 'Activité sportive estivale', '2025-07-20 10:00:00', '2025-07-20 13:00:00', 'Accès au terrain de sport et parc VTT', 40, 50),
(6, 'Location matériel hiver', '2025-12-22 08:00:00', '2025-12-22 17:00:00', 'Location de ski, raquettes et chaussures de randonnée', 50, 200);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `postal_code` varchar(5) NOT NULL,
  `birth_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`, `phone`, `last_name`, `name`, `address`, `city`, `postal_code`, `birth_date`) VALUES
(1, NULL, NULL, NULL, 1, '2024-12-31 10:29:50', '2024-12-29 12:25:56', '2024-12-29 12:25:57', NULL, NULL, 'Doe', 'John', '21 Jump Street', 'Melun', '77000', '2001-02-21'),
(2, NULL, NULL, NULL, 1, '2024-12-31 14:45:19', '2024-12-31 14:41:18', '2024-12-31 14:41:59', NULL, NULL, 'Doe', 'Jane', '22 Jump Street', 'Melun', '77000', '1988-03-24');

-- --------------------------------------------------------

--
-- Structure de la table `auth_groups_users`
--

CREATE TABLE IF NOT EXISTS `auth_groups_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `group` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`id`, `user_id`, `group`, `created_at`) VALUES
(1, 1, 'user', '2024-12-29 12:25:57'),
(2, 2, 'user', '2024-12-31 14:41:19');

-- --------------------------------------------------------

--
-- Structure de la table `auth_identities`
--

CREATE TABLE IF NOT EXISTS `auth_identities` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `secret` varchar(255) NOT NULL,
  `secret2` varchar(255) DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `extra` text DEFAULT NULL,
  `force_reset` tinyint(1) NOT NULL DEFAULT 0,
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `auth_identities`
--

INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'email_password', NULL, 'john.doe@exemple.com', '$2y$12$zg043K4aEZtqK1ZJD9BCQOjVsf0PYnLcpqvgl5b5rOv/ZSOdFbUG.', NULL, NULL, 0, '2024-12-31 10:26:54', '2024-12-29 12:25:57', '2024-12-31 10:26:54'),
(2, 2, 'email_password', NULL, 'jane.doe@exemple.com', '$2y$12$UvF4Y53VITg1pngkgaWpVu/lOy7vi74e3XfK7tohBdkcqRd7K1H4C', NULL, NULL, 0, NULL, '2024-12-31 14:41:19', '2024-12-31 14:41:19');

-- --------------------------------------------------------

--
-- Structure de la table `auth_logins`
--

CREATE TABLE IF NOT EXISTS `auth_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(1, '172.18.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'john.doe@exemple.com', 1, '2024-12-29 13:39:39', 1),
(2, '172.18.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'john.doe@exemple.com', 1, '2024-12-30 12:42:12', 1),
(3, '172.18.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'john.doe@exemple.com', 1, '2024-12-31 10:26:54', 1);

-- --------------------------------------------------------

--
-- Structure de la table `auth_permissions_users`
--

CREATE TABLE IF NOT EXISTS `auth_permissions_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `permission` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `auth_remember_tokens`
--

CREATE TABLE IF NOT EXISTS `auth_remember_tokens` (
  `id` int(10) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `auth_token_logins`
--

CREATE TABLE IF NOT EXISTS `auth_token_logins` (
  `id` int(10) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `id_type` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `meeting_rooms`
--

CREATE TABLE IF NOT EXISTS `meeting_rooms` (
  `mr_number` char(3) NOT NULL,
  `mr_type` varchar(50) NOT NULL,
  `mr_description` varchar(255) NOT NULL,
  `mr_price` float NOT NULL CHECK (mr_price > 0),
  `mr_capacity` int(11) NOT NULL CHECK (mr_capacity > 0),
  `mr_available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `meeting_rooms`
--

INSERT INTO `meeting_rooms` (`mr_number`, `mr_type`, `mr_description`, `mr_price`, `mr_capacity`, `mr_available`) VALUES
("002", 'Salle conférence', 'Salle de conférence avec 196 places, tablettes écritoires, sonorisation, vidéoprojecteur pour grand écran', 300, 196, 1),
("003", 'Salle commission', 'Salle de commission avec 45 à 50 places, tablettes écritoires et tableau blanc', 150, 50, 1),
("004", 'Salle commission', 'Salle de commission avec 25 places, tables, chaises et tableau blanc', 120, 25, 1),
("005", 'Salle commission', 'Salle de commission avec 10 places, tables, chaises et tableau blanc', 100, 10, 1);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2020-12-28-223112', 'CodeIgniter\\Shield\\Database\\Migrations\\CreateAuthTables', 'default', 'CodeIgniter\\Shield', 1735077233, 1),
(2, '2021-07-04-041948', 'CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable', 'default', 'CodeIgniter\\Settings', 1735077233, 1),
(3, '2021-11-14-143905', 'CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn', 'default', 'CodeIgniter\\Settings', 1735077233, 1),
(4, '2024-12-27-122107', 'App\\Database\\Migrations\\AddAttributesToUsers', 'default', 'App', 1735308684, 2);

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE IF NOT EXISTS `reservations` (
  `r_id` int(11) NOT NULL,
  `r_starting_date` DATETIME NOT NULL,
  `r_ending_date` DATETIME NOT NULL,
  `r_type` ENUM('Chambre', 'Activité', 'Salle de réunion', 'Transport') NOT NULL,
  `r_total_price` FLOAT NOT NULL CHECK (r_total_price > 0),
  `r_meal_option` ENUM('Pension-Compléte', 'Demi-Pension', 'Sans-Pension') NOT NULL,
  `r_number_people` INT(11) NOT NULL CHECK (r_number_people > 0),
  `r_created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `r_updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `r_deleted_at` DATETIME NULL,
  `r_status` ENUM('En attente', 'Confirmée', 'Annulée') NOT NULL DEFAULT 'En attente',
  `u_fk_id` INT(10) UNSIGNED NOT NULL,
  CHECK (r_ending_date >= r_starting_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Structure de la table `reservations_activities`
--

CREATE TABLE IF NOT EXISTS `reservations_activities` (
  `r_fk_id` int(11) NOT NULL,
  `a_fk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservations_meeting_rooms`
--

CREATE TABLE IF NOT EXISTS `reservations_meeting_rooms` (
  `r_fk_id` int(11) NOT NULL,
  `mr_fk_number` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservations_rooms`
--

CREATE TABLE IF NOT EXISTS `reservations_rooms` (
  `r_fk_id` int(11) NOT NULL,
  `ro_fk_number` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `reservations_transports`
--

CREATE TABLE IF NOT EXISTS `reservations_transports` (
  `r_fk_id` int(11) NOT NULL,
  `t_fk_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `ro_number` char(3) NOT NULL,
  `ro_type` varchar(150) NOT NULL,
  `ro_description` varchar(255) NOT NULL,
  `ro_price` float NOT NULL CHECK (ro_price > 0),
  `ro_cleaning_option` tinyint(1) DEFAULT NULL,
  `ro_available` tinyint(1) NOT NULL,
  `ro_capacity` int(11) NOT NULL CHECK (ro_capacity > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `rooms`
--

INSERT INTO `rooms` (`ro_number`, `ro_type`, `ro_description`, `ro_price`, `ro_cleaning_option`, `ro_available`, `ro_capacity`)
VALUES
-- 10 logements
("101", 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120.00, NULL, 1, 4),
("102", 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120.00, NULL, 1, 4),
("103", 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120.00, NULL, 1, 4),
("104", 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120.00, NULL, 1, 4),
("105", 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120.00, NULL, 1, 4),
("106", 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120.00, NULL, 1, 4),
("107", 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120.00, NULL, 1, 4),
("108", 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120.00, NULL, 1, 4),
("109", 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120.00, NULL, 1, 4),
("110", 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120.00, NULL, 1, 4),

-- 7 chambres doubles
("201", 'Chambre Double', 'Entrée, douche et WC, 1 lit double', 100.00, NULL, 1, 2),
("202", 'Chambre Double', 'Entrée, douche et WC, 1 lit double', 100.00, NULL, 1, 2),
("203", 'Chambre Double', 'Entrée, douche et WC, 1 lit double', 100.00, NULL, 1, 2),
("204", 'Chambre Double', 'Entrée, douche et WC, 1 lit double', 100.00, NULL, 1, 2),
("205", 'Chambre Double', 'Entrée, douche et WC, 1 lit double', 100.00, NULL, 1, 2),
("206", 'Chambre Double', 'Entrée, douche et WC, 1 lit double', 100.00, NULL, 1, 2),
("207", 'Chambre Double', 'Entrée, douche et WC, 1 lit double', 100.00, NULL, 1, 2),

-- 4 chambres de 3 lits
("301", 'Chambre Triple', 'Trois lits séparés par une cloison mobile avec coin toilette, WC, douche', 110.00, NULL, 1, 3),
("302", 'Chambre Triple', 'Trois lits séparés par une cloison mobile avec coin toilette, WC, douche', 110.00, NULL, 1, 3),
("303", 'Chambre Triple', 'Trois lits séparés par une cloison mobile avec coin toilette, WC, douche', 110.00, NULL, 1, 3),
("304", 'Chambre Triple', 'Trois lits séparés par une cloison mobile avec coin toilette, WC, douche', 110.00, NULL, 1, 3),

-- 6 chambres de 4 lits
("401", 'Chambre Quadruple', 'Quatre lits séparés par une cloison mobile avec douche, WC et balcon', 140.00, NULL, 1, 4),
("402", 'Chambre Quadruple', 'Quatre lits séparés par une cloison mobile avec douche, WC et balcon', 140.00, NULL, 1, 4),
("403", 'Chambre Quadruple', 'Quatre lits séparés par une cloison mobile avec douche, WC et balcon', 140.00, NULL, 1, 4),
("404", 'Chambre Quadruple', 'Quatre lits séparés par une cloison mobile avec douche, WC et balcon', 140.00, NULL, 1, 4),
("405", 'Chambre Quadruple', 'Quatre lits séparés par une cloison mobile avec douche, WC et balcon', 140.00, NULL, 1, 4),
("406", 'Chambre Quadruple', 'Quatre lits séparés par une cloison mobile avec douche, WC et balcon', 140.00, NULL, 1, 4),

-- 1 logement adapté
("001", 'Chambre Accessible', 'Adapté pour les personnes à mobilité réduite', 130.00, NULL, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL,
  `class` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(31) NOT NULL DEFAULT 'string',
  `context` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `transports`
--

CREATE TABLE IF NOT EXISTS `transports` (
  `t_id` int(11) NOT NULL,
  `t_type` varchar(150) NOT NULL,
  `t_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `transports`
--

INSERT INTO `transports` (`t_id`, `t_type`, `t_price`) VALUES
(1, 'Taxi', 50),
(2, 'Remontée mécanique', 30),
(3, 'Taxi', 50),
(4, 'Remontée mécanique', 30);

-- --------------------------------------------------------

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`a_id`),
  ADD KEY `idx_activities_start_date` (`a_starting_date`),
  ADD KEY `idx_activities_end_date` (`a_ending_date`);

--
-- Index pour la table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`);

--
-- Index pour la table `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type_secret` (`type`,`secret`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_permissions_users_user_id_foreign` (`user_id`);

--
-- Index pour la table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `auth_remember_tokens_user_id_foreign` (`user_id`);

--
-- Index pour la table `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_identifier` (`id_type`,`identifier`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `meeting_rooms`
--
ALTER TABLE `meeting_rooms`
  ADD PRIMARY KEY (`mr_number`),
  ADD KEY `idx_meeting_rooms_available` (`mr_available`),
  ADD KEY `idx_meeting_rooms_capacity` (`mr_capacity`),
  ADD KEY `idx_meeting_rooms_type` (`mr_type`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `idx_reservations_user_date` (`u_fk_id`,`r_starting_date`,`r_ending_date`),
  ADD KEY `idx_reservations_type` (`r_type`);

--
-- Index pour la table `reservations_activities`
--
ALTER TABLE `reservations_activities`
  ADD PRIMARY KEY (`r_fk_id`,`a_fk_id`),
  ADD KEY `idx_reservations_activities_rid` (`r_fk_id`),
  ADD KEY `idx_reservations_activities_aid` (`a_fk_id`);

--
-- Index pour la table `reservations_meeting_rooms`
--
ALTER TABLE `reservations_meeting_rooms`
  ADD PRIMARY KEY (`r_fk_id`,`mr_fk_number`),
  ADD KEY `idx_reservations_meeting_rooms_rid` (`r_fk_id`),
  ADD KEY `idx_reservations_meeting_rooms_mrnumber` (`mr_fk_number`);

--
-- Index pour la table `reservations_rooms`
--
ALTER TABLE `reservations_rooms`
  ADD PRIMARY KEY (`r_fk_id`,`ro_fk_number`),
  ADD KEY `idx_reservations_rooms_rid` (`r_fk_id`),
  ADD KEY `idx_reservations_rooms_ronumber` (`ro_fk_number`);

--
-- Index pour la table `reservations_transports`
--
ALTER TABLE `reservations_transports`
  ADD PRIMARY KEY (`r_fk_id`,`t_fk_id`),
  ADD KEY `idx_reservations_transports_rid` (`r_fk_id`),
  ADD KEY `idx_reservations_transports_tid` (`t_fk_id`);

--
-- Index pour la table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`ro_number`),
  ADD KEY `idx_rooms_available` (`ro_available`),
  ADD KEY `idx_rooms_capacity` (`ro_capacity`),
  ADD KEY `idx_rooms_type` (`ro_type`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transports`
--
ALTER TABLE `transports`
  ADD PRIMARY KEY (`t_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `auth_identities`
--
ALTER TABLE `auth_identities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `transports`
--
ALTER TABLE `transports`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `activities`
--
ALTER TABLE `activities`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `auth_identities`
--
ALTER TABLE `auth_identities`
  ADD CONSTRAINT `auth_identities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  ADD CONSTRAINT `auth_permissions_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  ADD CONSTRAINT `auth_remember_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`u_fk_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reservations_activities`
--
ALTER TABLE `reservations_activities`
  ADD CONSTRAINT `reservations_activities_ibfk_1` FOREIGN KEY (`r_fk_id`) REFERENCES `reservations` (`r_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_activities_ibfk_2` FOREIGN KEY (`a_fk_id`) REFERENCES `activities` (`a_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reservations_meeting_rooms`
--
ALTER TABLE `reservations_meeting_rooms`
  ADD CONSTRAINT `reservations_meeting_rooms_ibfk_1` FOREIGN KEY (`r_fk_id`) REFERENCES `reservations` (`r_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_meeting_rooms_ibfk_2` FOREIGN KEY (`mr_fk_number`) REFERENCES `meeting_rooms` (`mr_number`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

--
-- Contraintes pour la table `reservations_rooms`
--
ALTER TABLE `reservations_rooms`
  ADD CONSTRAINT `reservations_rooms_ibfk_1` FOREIGN KEY (`r_fk_id`) REFERENCES `reservations` (`r_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_rooms_ibfk_2` FOREIGN KEY (`ro_fk_number`) REFERENCES `rooms` (`ro_number`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

--
-- Contraintes pour la table `reservations_transports`
--
ALTER TABLE `reservations_transports`
  ADD CONSTRAINT `reservations_transports_ibfk_1` FOREIGN KEY (`r_fk_id`) REFERENCES `reservations` (`r_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_transports_ibfk_2` FOREIGN KEY (`t_fk_id`) REFERENCES `transports` (`t_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
