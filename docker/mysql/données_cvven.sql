-- Table: clients
INSERT INTO clients (nom_client, prenom_client, adresse_client, password_client, admin, email_client, telephone_client)
VALUES
('Dupont', 'Jean', '123 Rue de Paris', 'password123', TRUE, 'jean.dupont@example.com', '0612345678'),
('Martin', 'Claire', '456 Avenue des Champs', 'secure456', FALSE, 'claire.martin@example.com', '0698765432'),
('Durand', 'Paul', '789 Boulevard Haussmann', 'paul789', FALSE, 'paul.durand@example.com', '0678945612');

-- Table: reservation
INSERT INTO reservation (date_debut_reservation, date_fin_reservation, type_pension_reservation, nb_personnes_reservation, id_client)
VALUES
('2024-12-10', '2024-12-15', 'Pension complète', 2, 1),
('2024-12-20', '2024-12-22', 'Demi-pension', 1, 2),
('2025-01-05', '2025-01-10', 'Pension complète', 4, 3);

-- Table: transport
INSERT INTO transport (type_transport, tarif_transport, id_reservation)
VALUES
('Taxi', 50.0, 1),
('Navette', 30.0, 2),
('Bus', 100.0, 3);

-- Table: hebergements
INSERT INTO hebergements (numero_chambre, type_hebergement, descritpion_hebergement, tarif_hebergement, option_menage, id_reservation)
VALUES
(101, 'Chambre simple', 'Chambre avec lit simple et salle de bain privée', 80.0, TRUE, 1),
(102, 'Suite', 'Suite avec salon, chambre et vue sur mer', 200.0, TRUE, 2),
(103, 'Chambre double', 'Chambre avec lit double et balcon', 120.0, FALSE, 3);

-- Table: salle_reunion
INSERT INTO salle_reunion (num_salle_reunion, type_salle_reunion, description_reunion, tarif_reunion, id_reservation)
VALUES
(01, 'Salle conférence', 'Salle équipée pour conférence avec 50 places', 300.0, 1),
(02, 'Salle workshop', 'Salle pour petits groupes avec équipements interactifs', 150.0, 2),
(03, 'Salle événementielle', 'Salle pour événements avec espace buffet', 500.0, 3);

-- Table: activités
INSERT INTO activites (nom_activite, date_debut_activite, date_fin_activite, description_activite, tarif_activite)
VALUES
('Randonnée', '2024-12-11 09:00:00', '2024-12-11 12:00:00', 'Randonnée guidée en montagne', 25.0),
('Atelier cuisine', '2024-12-21 14:00:00', '2024-12-21 17:00:00', 'Atelier de cuisine locale', 50.0),
('Yoga', '2025-01-06 08:00:00', '2025-01-06 09:30:00', 'Séance de yoga matinale', 15.0);

-- Table: participer
INSERT INTO participer (id_reservation, id_activite)
VALUES
(1, 1),
(2, 2),
(3, 3);