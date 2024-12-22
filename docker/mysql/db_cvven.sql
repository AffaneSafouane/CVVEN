#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

CREATE DATABASE IF NOT EXISTS cvven;

USE cvven;

#------------------------------------------------------------
# Table: utilisateur
#------------------------------------------------------------

CREATE TABLE utilisateur(
        u_id        Int  Auto_increment  NOT NULL ,
        u_nom       Varchar (150) NOT NULL ,
        u_prenom    Varchar (150) NOT NULL ,
        u_adresse   Varchar (150) NOT NULL ,
        u_mot_de_passe  Varchar (255) NOT NULL ,
        u_admin     Boolean NOT NULL ,
        u_email     Varchar (150) NOT NULL ,
        u_telephone Varchar (10) NOT NULL,
        u_date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
        u_derniere_connexion DATETIME DEFAULT NULL 
	,CONSTRAINT utilisateur_AK UNIQUE (u_email, u_telephone)
	,CONSTRAINT utilisateur_PK PRIMARY KEY (u_id)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: reservation
#------------------------------------------------------------

CREATE TABLE reservation(
        r_id            Int  Auto_increment  NOT NULL ,
        r_date_debut    Date NOT NULL ,
        r_date_fin      Date NOT NULL ,
        r_type_pension  Varchar (255) NOT NULL ,
        r_nb_personnes  Int NOT NULL ,
        r_date          DATE DEFAULT (CURRENT_DATE),
        u_fk_id         Int NOT NULL
	,CONSTRAINT reservation_PK PRIMARY KEY (r_id)
	,CONSTRAINT client_reservation_FK FOREIGN KEY (u_fk_id) REFERENCES utilisateur(u_id)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: salle_reunion
#------------------------------------------------------------

CREATE TABLE salle_reunion(
        sr_num          Int NOT NULL ,
        sr_type         Varchar (150) NOT NULL ,
        sr_description  Varchar (255) NOT NULL ,
        sr_tarif        Float NOT NULL ,
        r_fk_id         Int
	,CONSTRAINT salle_reunion_PK PRIMARY KEY (sr_num)
	,CONSTRAINT salle_reunion_reservation_FK FOREIGN KEY (r_fk_id) REFERENCES reservation(r_id)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: activite
#------------------------------------------------------------

CREATE TABLE activite(
        a_id          Int  Auto_increment  NOT NULL ,
        a_nom         Varchar (150) NOT NULL ,
        a_date_debut  Datetime NOT NULL ,
        a_date_fin    Datetime NOT NULL ,
        a_description Varchar (255) NOT NULL ,
        a_tarif       Float NOT NULL
	,CONSTRAINT activite_PK PRIMARY KEY (a_id)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: chambre
#------------------------------------------------------------

CREATE TABLE chambre(
        ch_numero               Int NOT NULL ,
        ch_type                 Varchar (150) NOT NULL ,
        ch_descritption         Varchar (255) NOT NULL ,
        ch_tarif                Float NOT NULL ,
        ch_option_menage        Boolean DEFAULT false ,
        r_fk_id                 Int
	,CONSTRAINT chambre_PK PRIMARY KEY (ch_numero)
	,CONSTRAINT chambre_reservation_FK FOREIGN KEY (r_fk_id) REFERENCES reservation(r_id)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: transport
#------------------------------------------------------------

CREATE TABLE transport(
        t_id    Int  Auto_increment  NOT NULL ,
        t_type  Varchar (150) NOT NULL ,
        t_tarif Float NOT NULL ,
        r_fk_id Int
	,CONSTRAINT transport_PK PRIMARY KEY (t_id)
	,CONSTRAINT transport_reservation_FK FOREIGN KEY (r_fk_id) REFERENCES reservation(r_id)
)ENGINE=InnoDB;

#------------------------------------------------------------
# Table: participer
#------------------------------------------------------------

CREATE TABLE participer(
        r_fk_id    Int NOT NULL ,
        a_fk_id    Int NOT NULL
	,CONSTRAINT participer_PK PRIMARY KEY (r_fk_id ,a_fk_id)
	,CONSTRAINT participer_reservation_FK FOREIGN KEY (r_fk_id) REFERENCES reservation(r_id)
	,CONSTRAINT participer_activite_FK FOREIGN KEY (a_fk_id) REFERENCES activite(a_id)
)ENGINE=InnoDB;