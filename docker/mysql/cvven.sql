-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db:3306
-- Généré le : dim. 29 déc. 2024 à 12:35
-- Version du serveur : 8.4.3
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
-- Structure de la table `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `a_id` int NOT NULL,
  `a_name` varchar(150) NOT NULL,
  `a_starting_date` datetime NOT NULL,
  `a_ending_date` datetime NOT NULL,
  `a_description` varchar(255) NOT NULL,
  `a_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `activities`
--

INSERT INTO `activities` (`a_id`, `a_name`, `a_starting_date`, `a_ending_date`, `a_description`, `a_price`) VALUES
(1, 'Randonnée', '2024-12-11 09:00:00', '2024-12-11 12:00:00', 'Randonnée guidée en montagne', 25),
(2, 'Atelier cuisine', '2024-12-21 14:00:00', '2024-12-21 17:00:00', 'Atelier de cuisine locale', 50),
(3, 'Yoga', '2025-01-06 08:00:00', '2025-01-06 09:30:00', 'Séance de yoga matinale', 15);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `last_active` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `phone` varchar(10) CHARACTER SET utf8mb4 DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `postal_code` varchar(5) NOT NULL,
  `birth_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `secret` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `secret2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expires` datetime DEFAULT NULL,
  `extra` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `force_reset` tinyint(1) NOT NULL DEFAULT '0',
  `last_used_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `auth_identities`
--

INSERT INTO `auth_identities` (`id`, `user_id`, `type`, `name`, `secret`, `secret2`, `expires`, `extra`, `force_reset`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'email_password', NULL, 'john.doe@exemple.com', '$2y$12$zg043K4aEZtqK1ZJD9BCQOjVsf0PYnLcpqvgl5b5rOv/ZSOdFbUG.', NULL, NULL, 0, '2024-12-31 10:26:54', '2024-12-29 12:25:57', '2024-12-31 10:26:54'), -- secret 2/mot de passe : Azerty1234
(2, 2, 'email_password', NULL, 'jane.doe@exemple.com', '$2y$12$UvF4Y53VITg1pngkgaWpVu/lOy7vi74e3XfK7tohBdkcqRd7K1H4C', NULL, NULL, 0, NULL, '2024-12-31 14:41:19', '2024-12-31 14:41:19'); -- secret 2/mot de passe : Qwerty1234

-- --------------------------------------------------------

--
-- Structure de la table `auth_logins`
--

CREATE TABLE IF NOT EXISTS `auth_logins` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `identifier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `permission` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `auth_remember_tokens`
--

CREATE TABLE IF NOT EXISTS `auth_remember_tokens` (
  `id` int UNSIGNED NOT NULL,
  `selector` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hashedValidator` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `expires` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `auth_token_logins`
--

CREATE TABLE IF NOT EXISTS `auth_token_logins` (
  `id` int UNSIGNED NOT NULL,
  `ip_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_agent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `identifier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

CREATE TABLE IF NOT EXISTS `reservations` (
  `r_id` int NOT NULL,
  `r_starting_date` date NOT NULL,
  `r_ending_date` date NOT NULL,
  `r_pension_type` varchar(50) NOT NULL,
  `r_nb_people` int NOT NULL,
  `r_date` date DEFAULT (curdate()),
  `r_status` varchar(50) DEFAULT 'En attente',
  `u_fk_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`r_id`, `r_starting_date`, `r_ending_date`, `r_pension_type`, `r_nb_people`, `r_date`, `r_status`, `u_fk_id`) VALUES
(1, '2024-12-10', '2024-12-15', 'Pension complète', 2, '2024-12-01', 'Confirmée', 1),
(2, '2024-12-20', '2024-12-22', 'Demi-pension', 1, '2024-12-10', 'En attente', 2);

-- --------------------------------------------------------

--
-- Structure de la table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `ro_num` int NOT NULL,
  `ro_type` varchar(150) NOT NULL,
  `ro_description` varchar(255) NOT NULL,
  `ro_price` float NOT NULL,
  `ro_cleaning_option` tinyint(1) DEFAULT '0',
  `ro_available` tinyint(1) NOT NULL,
  `r_fk_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `rooms`
--

INSERT INTO `rooms` (`ro_num`, `ro_type`, `ro_description`, `ro_price`, `ro_cleaning_option`, `ro_available`, `r_fk_id`) VALUES
(101, 'rooms simple', 'rooms avec lit simple et salle de bain privée', 80, 1, 1, 1),
(102, 'Suite', 'Suite avec salon, rooms et vue sur mer', 200, 1, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Structure de la table `participate`
--

CREATE TABLE IF NOT EXISTS `participate` (
  `r_fk_id` int NOT NULL,
  `a_fk_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `participate`
--

INSERT INTO `participate` (`r_fk_id`, `a_fk_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `meeting_rooms`
--

CREATE TABLE IF NOT EXISTS `meeting_rooms` (
  `mr_num` int NOT NULL,
  `mr_type` varchar(50) NOT NULL,
  `mr_description` varchar(255) NOT NULL,
  `mr_price` float NOT NULL,
  `mr_available` tinyint(1) NOT NULL,
  `r_fk_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `meeting_rooms`
--

INSERT INTO `meeting_rooms` (`mr_num`, `mr_type`, `mr_description`, `mr_price`, `mr_available`, `r_fk_id`) VALUES
(1, 'Salle conférence', 'Salle équipée pour conférence avec 50 places', 300, 1, 1),
(2, 'Salle workshop', 'Salle pour petits groupes avec équipements interactifs', 150, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int NOT NULL,
  `class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `type` varchar(31) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'string',
  `context` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `transports`
--

CREATE TABLE IF NOT EXISTS `transports` (
  `t_id` int NOT NULL,
  `t_type` varchar(150) NOT NULL,
  `t_price` float NOT NULL,
  `r_fk_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `transports`
--

INSERT INTO `transports` (`t_id`, `t_type`, `t_price`, `r_fk_id`) VALUES
(1, 'Taxi', 50, 1),
(2, 'Navette', 30, 2);

-- --------------------------------------------------------

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`a_id`);

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
-- Index pour la table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`ro_num`),
  ADD KEY `rooms_reservations_FK` (`r_fk_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `participate`
--
ALTER TABLE `participate`
  ADD PRIMARY KEY (`r_fk_id`,`a_fk_id`),
  ADD KEY `participate_activities_FK` (`a_fk_id`);

--
-- Index pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `users_reservations_FK` (`u_fk_id`);

--
-- Index pour la table `meeting_rooms`
--
ALTER TABLE `meeting_rooms`
  ADD PRIMARY KEY (`mr_num`),
  ADD KEY `meeting_rooms_reservations_FK` (`r_fk_id`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transports`
--
ALTER TABLE `transports`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `transports_reservations_FK` (`r_fk_id`);

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
-- AUTO_INCREMENT pour la table `activities`
--
ALTER TABLE `activities`
  MODIFY `a_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `auth_identities`
--
ALTER TABLE `auth_identities`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `r_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `transports`
--
ALTER TABLE `transports`
  MODIFY `t_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Contraintes pour la table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_reservations_FK` FOREIGN KEY (`r_fk_id`) REFERENCES `reservations` (`r_id`);

--
-- Contraintes pour la table `participate`
--
ALTER TABLE `participate`
  ADD CONSTRAINT `participate_activities_FK` FOREIGN KEY (`a_fk_id`) REFERENCES `activities` (`a_id`),
  ADD CONSTRAINT `participate_reservations_FK` FOREIGN KEY (`r_fk_id`) REFERENCES `reservations` (`r_id`);

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `client_reservations_FK` FOREIGN KEY (`u_fk_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `meeting_rooms`
--
ALTER TABLE `meeting_rooms`
  ADD CONSTRAINT `meeting_rooms_reservations_FK` FOREIGN KEY (`r_fk_id`) REFERENCES `reservations` (`r_id`);

--
-- Contraintes pour la table `transports`
--
ALTER TABLE `transports`
  ADD CONSTRAINT `transports_reservations_FK` FOREIGN KEY (`r_fk_id`) REFERENCES `reservations` (`r_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
