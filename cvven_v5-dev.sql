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
  `last_name` varchar(150) NOT NULL,
  `first_name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`, `first_name`, `last_name`) VALUES
(1, NULL, NULL, NULL, 1, '2024-12-31 10:29:50', '2024-12-29 12:25:56', '2024-12-29 12:25:57', NULL, 'John', 'Doe'),
(2, NULL, NULL, NULL, 1, '2024-12-31 14:45:19', '2024-12-31 14:41:18', '2024-12-31 14:41:59', NULL, 'Jane', 'Doe');

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
-- john doe, secret/mot de passe: Azerty1234
-- john doe, secret/mot de passe: Qwerty1234


-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `client_id` int(10) UNSIGNED NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(5) NOT NULL,
  `family_quotient` ENUM('less_800', '800-1200', '1200-1800', '1800-2500', 'more_2500') NOT NULL,
  `birth_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`client_id`, `phone`, `address`, `city`, `postal_code`, `family_quotient`, `birth_date`) VALUES
(1, NULL, '21 Jump Street', 'Melun', '77000', '800-1200', '2001-02-21'),
(2, NULL, '22 Jump Street', 'Melun', '77000', 'less_800', '1988-03-24');


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
  `id` INT(11) NOT NULL,
  `start_date` DATE NOT NULL,
  `end_date` DATE NOT NULL,
  `total_price` FLOAT NOT NULL CHECK (total_price > 0),
  `pension_type` ENUM('Pension Compléte', 'Demi-Pension', 'Sans Pension') NOT NULL,
  `number_people` INT(11) NOT NULL CHECK (number_people > 0),
  `cleaning_option` tinyint(1) DEFAULT 0,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` ENUM('En attente', 'Confirmée', 'Annulée') NOT NULL DEFAULT 'En attente',
  `client_id` INT(10) UNSIGNED NOT NULL,
  CHECK (end_date > start_date)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `id` INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `room_number` char(4) NOT NULL,
  `type` varchar(150) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` float NOT NULL CHECK (price > 0),
  `available` tinyint(1) NOT NULL,
  `capacity` int(11) NOT NULL CHECK (capacity > 0)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `rooms`
--

INSERT INTO `rooms` (`room_number`, `type`, `description`, `price`, `available`, `capacity`)
VALUES
-- 10 logements
("B101", 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120.00, 1, 4),
("B102", 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120.00, 1, 4),
("B103", 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120.00, 1, 4),
("B104", 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120.00, 1, 4),
("B105", 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120.00, 1, 4),
("B106", 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120.00, 1, 4),
("B107", 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120.00, 1, 4),
("B108", 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120.00, 1, 4),
("B109", 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120.00, 1, 4),
("B110", 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120.00, 1, 4),

-- 7 chambres doubles
("B201", 'Chambre Double', 'Entrée, douche et WC, 1 lit double', 100.00, 1, 2),
("B202", 'Chambre Double', 'Entrée, douche et WC, 1 lit double', 100.00, 1, 2),
("B203", 'Chambre Double', 'Entrée, douche et WC, 1 lit double', 100.00, 1, 2),
("B204", 'Chambre Double', 'Entrée, douche et WC, 1 lit double', 100.00, 1, 2),
("B205", 'Chambre Double', 'Entrée, douche et WC, 1 lit double', 100.00, 1, 2),
("B206", 'Chambre Double', 'Entrée, douche et WC, 1 lit double', 100.00, 1, 2),
("B207", 'Chambre Double', 'Entrée, douche et WC, 1 lit double', 100.00, 1, 2),

-- 4 chambres de 3 lits
("B301", 'Chambre Triple', 'Trois lits séparés par une cloison mobile avec coin toilette, WC, douche', 110.00, 1, 3),
("B302", 'Chambre Triple', 'Trois lits séparés par une cloison mobile avec coin toilette, WC, douche', 110.00, 1, 3),
("B303", 'Chambre Triple', 'Trois lits séparés par une cloison mobile avec coin toilette, WC, douche', 110.00, 1, 3),
("B304", 'Chambre Triple', 'Trois lits séparés par une cloison mobile avec coin toilette, WC, douche', 110.00, 1, 3),

-- 6 chambres de 4 lits
("B401", 'Chambre Quadruple', 'Quatre lits séparés par une cloison mobile avec douche, WC et balcon', 140.00, 1, 4),
("B402", 'Chambre Quadruple', 'Quatre lits séparés par une cloison mobile avec douche, WC et balcon', 140.00, 1, 4),
("B403", 'Chambre Quadruple', 'Quatre lits séparés par une cloison mobile avec douche, WC et balcon', 140.00, 1, 4),
("B404", 'Chambre Quadruple', 'Quatre lits séparés par une cloison mobile avec douche, WC et balcon', 140.00, 1, 4),
("B405", 'Chambre Quadruple', 'Quatre lits séparés par une cloison mobile avec douche, WC et balcon', 140.00, 1, 4),
("B406", 'Chambre Quadruple', 'Quatre lits séparés par une cloison mobile avec douche, WC et balcon', 140.00, 1, 4),

-- 1 logement adapté
("B001", 'Chambre Accessible', 'Adapté pour les personnes à mobilité réduite', 130.00, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `reservations_rooms`
--

CREATE TABLE IF NOT EXISTS `reservations_rooms` (
  `reservation_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Index pour les tables déchargées
--

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
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_reservations_user_date` (`client_id`,`start_date`,`end_date`);

--
-- Index pour la table `reservations_rooms`
--
ALTER TABLE `reservations_rooms`
  ADD PRIMARY KEY (`reservation_id`,`room_id`),
  ADD KEY `idx_reservations_rooms_reservation_id` (`reservation_id`),
  ADD KEY `idx_reservations_rooms_room_id` (`room_id`);

--
-- Index pour la table `rooms`
--
ALTER TABLE `rooms`
  ADD KEY `idx_rooms_available` (`available`),
  ADD KEY `idx_rooms_capacity` (`capacity`),
  ADD KEY `idx_rooms_type` (`type`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Index pour la table `users`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`),
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
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- Contraintes pour la table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_user_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`client_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reservations_rooms`
--
ALTER TABLE `reservations_rooms`
  ADD CONSTRAINT `reservations_rooms_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_rooms_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;