-- Table: utilisateur
INSERT INTO utilisateur (u_nom, u_prenom, u_adresse, u_mot_de_passe, u_admin, u_email, u_telephone, u_date_creation, u_verifie, u_date_naissance)
VALUES
('Dupont', 'Jean', '123 Rue de Paris', 'password123', TRUE, 'jean.dupont@example.com', NULL, '2024-01-01', TRUE, '1980-05-15'),
('Martin', 'Claire', '456 Avenue des Champs', 'secure456', FALSE, 'claire.martin@example.com', '0698765432', '2024-02-01', FALSE, '1992-11-30'),
('Durand', 'Paul', '789 Boulevard Haussmann', 'paul789', FALSE, 'paul.durand@example.com', NULL, '2024-03-01', TRUE, '1985-03-20');

-- Table: reservation
INSERT INTO reservation (r_date_debut, r_date_fin, r_type_pension, r_nb_personnes, r_date, r_statut, u_fk_id)
VALUES
('2024-12-10', '2024-12-15', 'Pension complète', 2, '2024-12-01', 'Confirmée', 1),
('2024-12-20', '2024-12-22', 'Demi-pension', 1, '2024-12-10', 'En attente', 2),
('2025-01-05', '2025-01-10', 'Pension complète', 4, '2024-12-20', 'Confirmée', 3);

-- Table: transport
INSERT INTO transport (t_type, t_tarif, r_fk_id)
VALUES
('Taxi', 50.0, 1),
('Navette', 30.0, 2),
('Bus', 100.0, 3);

-- Table: chambre
INSERT INTO chambre (ch_numero, ch_type, ch_description, ch_tarif, ch_option_menage, ch_disponible, r_fk_id)
VALUES
(101, 'Chambre simple', 'Chambre avec lit simple et salle de bain privée', 80.0, TRUE, TRUE, 1),
(102, 'Suite', 'Suite avec salon, chambre et vue sur mer', 200.0, TRUE, TRUE, 2),
(103, 'Chambre double', 'Chambre avec lit double et balcon', 120.0, FALSE, FALSE, 3);

-- Table: salle_reunion
INSERT INTO salle_reunion (sr_num, sr_type, sr_description, sr_tarif, sr_disponible, r_fk_id)
VALUES
(01, 'Salle conférence', 'Salle équipée pour conférence avec 50 places', 300.0, TRUE, 1),
(02, 'Salle workshop', 'Salle pour petits groupes avec équipements interactifs', 150.0, TRUE, 2),
(03, 'Salle événementielle', 'Salle pour événements avec espace buffet', 500.0, FALSE, 3);

-- Table: activite
INSERT INTO activite (a_nom, a_date_debut, a_date_fin, a_description, a_tarif)
VALUES
('Randonnée', '2024-12-11 09:00:00', '2024-12-11 12:00:00', 'Randonnée guidée en montagne', 25.0),
('Atelier cuisine', '2024-12-21 14:00:00', '2024-12-21 17:00:00', 'Atelier de cuisine locale', 50.0),
('Yoga', '2025-01-06 08:00:00', '2025-01-06 09:30:00', 'Séance de yoga matinale', 15.0);

-- Table: participer
INSERT INTO participer (r_fk_id, a_fk_id)
VALUES
(1, 1),
(2, 2),
(3, 3);