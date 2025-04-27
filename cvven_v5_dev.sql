-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db:3306
-- Généré le : lun. 17 mars 2025 à 16:08
-- Version du serveur : 8.0.41
-- Version de PHP : 8.2.27

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

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_message` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `last_name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `status`, `status_message`, `active`, `last_active`, `created_at`, `updated_at`, `deleted_at`, `last_name`, `first_name`) VALUES
(1, NULL, NULL, NULL, 1, '2025-03-17 17:04:48', '2024-12-29 12:25:56', '2024-12-29 12:25:57', NULL, 'Doe', 'John'),
(2, NULL, NULL, NULL, 1, '2024-12-31 14:45:19', '2024-12-31 14:41:18', '2024-12-31 14:41:59', NULL, 'Doe', 'Jane'),
(3, NULL, NULL, NULL, 1, NULL, '2025-03-17 17:04:49', '2025-03-17 17:04:49', NULL, 'Istrateur', 'Admin');

-- --------------------------------------------------------

--
-- Structure de la table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`id`, `user_id`, `group`, `created_at`) VALUES
(1, 1, 'user', '2024-12-29 12:25:57'),
(2, 2, 'user', '2024-12-31 14:41:19'),
(3, 3, 'admin', '2025-03-17 17:04:50');

-- --------------------------------------------------------

--
-- Structure de la table `auth_identities`
--

CREATE TABLE `auth_identities` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `secret` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `secret2` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `extra` text COLLATE utf8mb4_general_ci,
  `force_reset` tinyint(1) NOT NULL DEFAULT '0',
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `auth_identities`
--

INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'email_password', NULL, 'john.doe@exemple.com', '$2y$12$zg043K4aEZtqK1ZJD9BCQOjVsf0PYnLcpqvgl5b5rOv/ZSOdFbUG.', NULL, NULL, 0, '2025-03-17 16:53:53', '2024-12-29 12:25:57', '2025-03-17 16:53:53'),
(2, 2, 'email_password', NULL, 'jane.doe@exemple.com', '$2y$12$UvF4Y53VITg1pngkgaWpVu/lOy7vi74e3XfK7tohBdkcqRd7K1H4C', NULL, NULL, 0, NULL, '2024-12-31 14:41:19', '2024-12-31 14:41:19'),
(3, 3, 'email_password', NULL, 'admin@exemple.com', '$2y$12$Emr.SqYbGZSUynf34o.GAuEmATTvN.vvoijH2wp0nwoSRgC7yJSZO', NULL, NULL, 0, NULL, '2025-03-17 17:04:50', '2025-03-17 17:04:50');
-- john doe, secret/mot de passe: Azerty1234
-- john doe, secret/mot de passe: Qwerty1234
-- admin, secret/mot de passe: adminCVVEN

-- --------------------------------------------------------

--
-- Structure de la table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `identifier` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `user_agent`, `id_type`, `identifier`, `user_id`, `date`, `success`) VALUES
(1, '172.18.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'john.doe@exemple.com', 1, '2024-12-29 13:39:39', 1),
(2, '172.18.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'john.doe@exemple.com', 1, '2024-12-30 12:42:12', 1),
(3, '172.18.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'email_password', 'john.doe@exemple.com', 1, '2024-12-31 10:26:54', 1),
(4, '172.18.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'email_password', 'john.doe@exemple.com', 1, '2025-03-17 16:53:53', 1);

-- --------------------------------------------------------

--
-- Structure de la table `auth_permissions_users`
--

CREATE TABLE `auth_permissions_users` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `permission` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `auth_remember_tokens`
--

CREATE TABLE `auth_remember_tokens` (
  `id` int UNSIGNED NOT NULL,
  `selector` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `hashedValidator` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `auth_token_logins`
--

CREATE TABLE `auth_token_logins` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `identifier` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `client_id` int UNSIGNED NOT NULL,
  `phone` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `postal_code` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  `family_quotient` enum('less_800','800-1200','1200-1800','1800-2500','more_2500') COLLATE utf8mb4_general_ci NOT NULL,
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
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
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

CREATE TABLE `reservations` (
  `id` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `total_price` float NOT NULL,
  `pension_type` enum('Pension-Compléte','Demi-Pension','Sans-Pension') COLLATE utf8mb4_general_ci NOT NULL,
  `number_people` int NOT NULL,
  `cleaning_option` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('En attente','Confirmée','Annulée') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'En attente',
  `client_id` int UNSIGNED NOT NULL
) ;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `start_date`, `end_date`, `total_price`, `pension_type`, `number_people`, `cleaning_option`, `created_at`, `updated_at`, `status`, `client_id`) VALUES
(1, '2025-07-01', '2025-07-07', 1200.50, 'Pension-Compléte', 2, 1, '2025-06-15 10:23:45', '2025-06-15 10:23:45', 'Confirmée', 1),
(2, '2025-08-10', '2025-08-15', 850.00, 'Demi-Pension', 1, 0, '2025-07-01 09:12:30', '2025-07-01 09:12:30', 'En attente', 2),
(3, '2025-09-05', '2025-09-12', 1500.75, 'Sans-Pension', 4, 1, '2025-08-01 14:45:00', '2025-08-01 14:45:00', 'Confirmée', 2),
(4, '2025-10-01', '2025-10-05', 600.00, 'Demi-Pension', 2, NULL, '2025-09-15 11:00:00', '2025-09-15 11:00:00', 'Annulée', 2),
(5, '2025-12-20', '2025-12-27', 2100.00, 'Pension-Compléte', 5, 1, '2025-11-10 16:30:00', '2025-11-10 16:30:00', 'Confirmée', 1);

-- --------------------------------------------------------

--
-- Structure de la table `reservations_rooms`
--

CREATE TABLE `reservations_rooms` (
  `reservation_id` int NOT NULL,
  `room_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


--
-- Déchargement des données de la table `reservations_rooms`
--

INSERT INTO `reservations_rooms` (`reservation_id`, `room_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 4),
(3, 5),
(4, 6),
(5, 7),
(5, 8),
(5, 9);

-- --------------------------------------------------------

--
-- Structure de la table `rooms`
--

CREATE TABLE `rooms` (
  `id` int NOT NULL,
  `room_number` char(4) COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` float NOT NULL,
  `available` tinyint(1) NOT NULL,
  `capacity` int NOT NULL,
  `img_url` VARCHAR(255)
);

--
-- Déchargement des données de la table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `type`, `description`, `price`, `available`, `capacity`, `img_url`) VALUES
(1, 'B101', 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120, 1, 4, 'images/logement.png'),
(2, 'B102', 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120, 1, 4, 'images/logement.png'),
(3, 'B103', 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120, 1, 4, 'images/logement.png'),
(4, 'B104', 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120, 1, 4, 'images/logement.png'),
(5, 'B105', 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120, 1, 4, 'images/logement.png'),
(6, 'B106', 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120, 1, 4, 'images/logement.png'),
(7, 'B107', 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120, 1, 4, 'images/logement.png'),
(8, 'B108', 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120, 1, 4, 'images/logement.png'),
(9, 'B109', 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120, 1, 4, 'images/logement.png'),
(10, 'B110', 'Logement', 'Entrée, douche et WC, 2 chambres à 2 lits avec coin toilette et balcon', 120, 1, 4, 'images/logement.png'),
(11, 'B201', 'Chambre Double', 'Entrée, douche et WC, 1 lit double', 100, 1, 2, 'images/chambre_double.jpg'),
(12, 'B202', 'Chambre Double', 'Entrée, douche et WC, 1 lit double', 100, 1, 2, 'images/chambre_double.jpg'),
(13, 'B203', 'Chambre Double', 'Entrée, douche et WC, 1 lit double', 100, 1, 2, 'images/chambre_double.jpg'),
(14, 'B204', 'Chambre Double', 'Entrée, douche et WC, 1 lit double', 100, 1, 2, 'images/chambre_double.jpg'),
(15, 'B205', 'Chambre Double', 'Entrée, douche et WC, 1 lit double', 100, 1, 2, 'images/chambre_double.jpg'),
(16, 'B206', 'Chambre Double', 'Entrée, douche et WC, 1 lit double', 100, 1, 2, 'images/chambre_double.jpg'),
(17, 'B207', 'Chambre Double', 'Entrée, douche et WC, 1 lit double', 100, 1, 2, 'images/chambre_double.jpg'),
(18, 'B301', 'Chambre Triple', 'Trois lits séparés par une cloison mobile avec coin toilette, WC, douche', 110, 1, 3, 'images/chambre_triple.jpg'),
(19, 'B302', 'Chambre Triple', 'Trois lits séparés par une cloison mobile avec coin toilette, WC, douche', 110, 1, 3, 'images/chambre_triple.jpg'),
(20, 'B303', 'Chambre Triple', 'Trois lits séparés par une cloison mobile avec coin toilette, WC, douche', 110, 1, 3, 'images/chambre_triple.jpg'),
(21, 'B304', 'Chambre Triple', 'Trois lits séparés par une cloison mobile avec coin toilette, WC, douche', 110, 1, 3, 'images/chambre_triple.jpg'),
(22, 'B401', 'Chambre Quadruple', 'Quatre lits séparés par une cloison mobile avec douche, WC et balcon', 140, 1, 4, 'images/chambre_quadruple.jpg'),
(23, 'B402', 'Chambre Quadruple', 'Quatre lits séparés par une cloison mobile avec douche, WC et balcon', 140, 1, 4, 'images/chambre_quadruple.jpg'),
(24, 'B403', 'Chambre Quadruple', 'Quatre lits séparés par une cloison mobile avec douche, WC et balcon', 140, 1, 4, 'images/chambre_quadruple.jpg'),
(25, 'B404', 'Chambre Quadruple', 'Quatre lits séparés par une cloison mobile avec douche, WC et balcon', 140, 1, 4, 'images/chambre_quadruple.jpg'),
(26, 'B405', 'Chambre Quadruple', 'Quatre lits séparés par une cloison mobile avec douche, WC et balcon', 140, 1, 4, 'images/chambre_quadruple.jpg'),
(27, 'B406', 'Chambre Quadruple', 'Quatre lits séparés par une cloison mobile avec douche, WC et balcon', 140, 1, 4, 'images/chambre_quadruple.jpg'),
(28, 'B001', 'Chambre Accessible', 'Adapté pour les personnes à mobilité réduite', 130, 1, 2, 'images/chambre_accessible.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `id` int NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `value` text COLLATE utf8mb4_general_ci,
  `type` varchar(31) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'string',
  `context` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



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
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `phone` (`phone`);

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
  ADD PRIMARY KEY (`id`),
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
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `auth_identities`
--
ALTER TABLE `auth_identities`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `auth_permissions_users`
--
ALTER TABLE `auth_permissions_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `auth_remember_tokens`
--
ALTER TABLE `auth_remember_tokens`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `auth_token_logins`
--
ALTER TABLE `auth_token_logins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `reservations_rooms_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_rooms_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
