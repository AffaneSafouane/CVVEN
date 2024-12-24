-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db:3306
-- Généré le : mar. 24 déc. 2024 à 21:56
-- Version du serveur : 8.0.40
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
-- Structure de la table `activite`
--

CREATE TABLE `activite` (
  `a_id` int NOT NULL,
  `a_nom` varchar(150) NOT NULL,
  `a_date_debut` datetime NOT NULL,
  `a_date_fin` datetime NOT NULL,
  `a_description` varchar(255) NOT NULL,
  `a_tarif` float NOT NULL
) ENGINE=InnoDB;

--
-- Déchargement des données de la table `activite`
--

INSERT INTO `activite` (`a_id`, `a_nom`, `a_date_debut`, `a_date_fin`, `a_description`, `a_tarif`) VALUES
(1, 'Randonnée', '2024-12-11 09:00:00', '2024-12-11 12:00:00', 'Randonnée guidée en montagne', 25),
(2, 'Atelier cuisine', '2024-12-21 14:00:00', '2024-12-21 17:00:00', 'Atelier de cuisine locale', 50),
(3, 'Yoga', '2025-01-06 08:00:00', '2025-01-06 09:30:00', 'Séance de yoga matinale', 15);

-- --------------------------------------------------------

--
-- Structure de la table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB;

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
) ENGINE=InnoDB;

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
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Structure de la table `auth_permissions_users`
--

CREATE TABLE `auth_permissions_users` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `permission` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB;

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
) ENGINE=InnoDB;

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
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

CREATE TABLE `chambre` (
  `ch_numero` int NOT NULL,
  `ch_type` varchar(150) NOT NULL,
  `ch_description` varchar(255) NOT NULL,
  `ch_tarif` float NOT NULL,
  `ch_option_menage` tinyint(1) DEFAULT '0',
  `ch_disponible` tinyint(1) NOT NULL,
  `r_fk_id` int DEFAULT NULL
) ENGINE=InnoDB;

--
-- Déchargement des données de la table `chambre`
--

INSERT INTO `chambre` (`ch_numero`, `ch_type`, `ch_description`, `ch_tarif`, `ch_option_menage`, `ch_disponible`, `r_fk_id`) VALUES
(101, 'Chambre simple', 'Chambre avec lit simple et salle de bain privée', 80, 1, 1, 1),
(102, 'Suite', 'Suite avec salon, chambre et vue sur mer', 200, 1, 1, 2),
(103, 'Chambre double', 'Chambre avec lit double et balcon', 120, 0, 0, 3);

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
) ENGINE=InnoDB;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2020-12-28-223112', 'CodeIgniter\\Shield\\Database\\Migrations\\CreateAuthTables', 'default', 'CodeIgniter\\Shield', 1735077233, 1),
(2, '2021-07-04-041948', 'CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable', 'default', 'CodeIgniter\\Settings', 1735077233, 1),
(3, '2021-11-14-143905', 'CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn', 'default', 'CodeIgniter\\Settings', 1735077233, 1);

-- --------------------------------------------------------

--
-- Structure de la table `participer`
--

CREATE TABLE `participer` (
  `r_fk_id` int NOT NULL,
  `a_fk_id` int NOT NULL
) ENGINE=InnoDB;

--
-- Déchargement des données de la table `participer`
--

INSERT INTO `participer` (`r_fk_id`, `a_fk_id`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `r_id` int NOT NULL,
  `r_date_debut` date NOT NULL,
  `r_date_fin` date NOT NULL,
  `r_type_pension` varchar(50) NOT NULL,
  `r_nb_personnes` int NOT NULL,
  `r_date` date DEFAULT (curdate()),
  `r_statut` varchar(50) DEFAULT 'En attente',
  `u_fk_id` int NOT NULL
) ENGINE=InnoDB;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`r_id`, `r_date_debut`, `r_date_fin`, `r_type_pension`, `r_nb_personnes`, `r_date`, `r_statut`, `u_fk_id`) VALUES
(1, '2024-12-10', '2024-12-15', 'Pension complète', 2, '2024-12-01', 'Confirmée', 1),
(2, '2024-12-20', '2024-12-22', 'Demi-pension', 1, '2024-12-10', 'En attente', 2),
(3, '2025-01-05', '2025-01-10', 'Pension complète', 4, '2024-12-20', 'Confirmée', 3);

-- --------------------------------------------------------

--
-- Structure de la table `salle_reunion`
--

CREATE TABLE `salle_reunion` (
  `sr_num` int NOT NULL,
  `sr_type` varchar(50) NOT NULL,
  `sr_description` varchar(255) NOT NULL,
  `sr_tarif` float NOT NULL,
  `sr_disponible` tinyint(1) NOT NULL,
  `r_fk_id` int DEFAULT NULL
) ENGINE=InnoDB;

--
-- Déchargement des données de la table `salle_reunion`
--

INSERT INTO `salle_reunion` (`sr_num`, `sr_type`, `sr_description`, `sr_tarif`, `sr_disponible`, `r_fk_id`) VALUES
(1, 'Salle conférence', 'Salle équipée pour conférence avec 50 places', 300, 1, 1),
(2, 'Salle workshop', 'Salle pour petits groupes avec équipements interactifs', 150, 1, 2),
(3, 'Salle événementielle', 'Salle pour événements avec espace buffet', 500, 0, 3);

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
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Structure de la table `transport`
--

CREATE TABLE `transport` (
  `t_id` int NOT NULL,
  `t_type` varchar(150) NOT NULL,
  `t_tarif` float NOT NULL,
  `r_fk_id` int DEFAULT NULL
) ENGINE=InnoDB;

--
-- Déchargement des données de la table `transport`
--

INSERT INTO `transport` (`t_id`, `t_type`, `t_tarif`, `r_fk_id`) VALUES
(1, 'Taxi', 50, 1),
(2, 'Navette', 30, 2),
(3, 'Bus', 100, 3);

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
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `u_id` int NOT NULL,
  `u_nom` varchar(150) NOT NULL,
  `u_prenom` varchar(150) NOT NULL,
  `u_adresse` varchar(150) NOT NULL,
  `u_mot_de_passe` varchar(255) NOT NULL,
  `u_admin` tinyint(1) DEFAULT '0',
  `u_email` varchar(150) NOT NULL,
  `u_telephone` varchar(10) DEFAULT NULL,
  `u_date_creation` date DEFAULT (curdate()),
  `u_verifie` tinyint(1) DEFAULT '0',
  `u_derniere_connexion` datetime DEFAULT NULL,
  `u_date_naissance` date NOT NULL
) ENGINE=InnoDB;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`u_id`, `u_nom`, `u_prenom`, `u_adresse`, `u_mot_de_passe`, `u_admin`, `u_email`, `u_telephone`, `u_date_creation`, `u_verifie`, `u_derniere_connexion`, `u_date_naissance`) VALUES
(1, 'Dupont', 'Jean', '123 Rue de Paris', 'password123', 1, 'jean.dupont@example.com', NULL, '2024-01-01', 1, NULL, '1980-05-15'),
(2, 'Martin', 'Claire', '456 Avenue des Champs', 'secure456', 0, 'claire.martin@example.com', '0698765432', '2024-02-01', 0, NULL, '1992-11-30'),
(3, 'Durand', 'Paul', '789 Boulevard Haussmann', 'paul789', 0, 'paul.durand@example.com', NULL, '2024-03-01', 1, NULL, '1985-03-20');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activite`
--
ALTER TABLE `activite`
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
-- Index pour la table `chambre`
--
ALTER TABLE `chambre`
  ADD PRIMARY KEY (`ch_numero`),
  ADD KEY `chambre_reservation_FK` (`r_fk_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `participer`
--
ALTER TABLE `participer`
  ADD PRIMARY KEY (`r_fk_id`,`a_fk_id`),
  ADD KEY `participer_activite_FK` (`a_fk_id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `client_reservation_FK` (`u_fk_id`);

--
-- Index pour la table `salle_reunion`
--
ALTER TABLE `salle_reunion`
  ADD PRIMARY KEY (`sr_num`),
  ADD KEY `salle_reunion_reservation_FK` (`r_fk_id`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `transport_reservation_FK` (`r_fk_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `utilisateur_AK` (`u_email`,`u_telephone`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activite`
--
ALTER TABLE `activite`
  MODIFY `a_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `auth_identities`
--
ALTER TABLE `auth_identities`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `r_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `transport`
--
ALTER TABLE `transport`
  MODIFY `t_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `u_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Contraintes pour la table `chambre`
--
ALTER TABLE `chambre`
  ADD CONSTRAINT `chambre_reservation_FK` FOREIGN KEY (`r_fk_id`) REFERENCES `reservation` (`r_id`);

--
-- Contraintes pour la table `participer`
--
ALTER TABLE `participer`
  ADD CONSTRAINT `participer_activite_FK` FOREIGN KEY (`a_fk_id`) REFERENCES `activite` (`a_id`),
  ADD CONSTRAINT `participer_reservation_FK` FOREIGN KEY (`r_fk_id`) REFERENCES `reservation` (`r_id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `client_reservation_FK` FOREIGN KEY (`u_fk_id`) REFERENCES `utilisateur` (`u_id`);

--
-- Contraintes pour la table `salle_reunion`
--
ALTER TABLE `salle_reunion`
  ADD CONSTRAINT `salle_reunion_reservation_FK` FOREIGN KEY (`r_fk_id`) REFERENCES `reservation` (`r_id`);

--
-- Contraintes pour la table `transport`
--
ALTER TABLE `transport`
  ADD CONSTRAINT `transport_reservation_FK` FOREIGN KEY (`r_fk_id`) REFERENCES `reservation` (`r_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
