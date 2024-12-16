#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

CREATE DATABASE IF NOT EXISTS cvven_db;

USE cvven_db;

#------------------------------------------------------------
# Table: clients
#------------------------------------------------------------

CREATE TABLE clients(
        id_client        Int  Auto_increment  NOT NULL ,
        nom_client       Varchar (150) NOT NULL ,
        prenom_client    Varchar (150) NOT NULL ,
        adresse_client   Varchar (150) NOT NULL ,
        password_client  Varchar (255) NOT NULL ,
        admin            Bool NOT NULL ,
        email_client     Varchar (150) NOT NULL ,
        telephone_client Varchar (10) NOT NULL 
	,CONSTRAINT clients_AK UNIQUE (email_client,telephone_client)
	,CONSTRAINT clients_PK PRIMARY KEY (id_client)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: reservation
#------------------------------------------------------------

CREATE TABLE reservation(
        id_reservation           Int  Auto_increment  NOT NULL ,
        date_debut_reservation   Date NOT NULL ,
        date_fin_reservation     Date NOT NULL ,
        type_pension_reservation Varchar (255) NOT NULL ,
        nb_personnes_reservation Int NOT NULL ,
        id_client                Int NOT NULL
	,CONSTRAINT reservation_PK PRIMARY KEY (id_reservation)

	,CONSTRAINT reservation_clients_FK FOREIGN KEY (id_client) REFERENCES clients(id_client)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: salle_reunion
#------------------------------------------------------------

CREATE TABLE salle_reunion(
        num_salle_reunion   Int NOT NULL ,
        type_salle_reunion  Varchar (150) NOT NULL ,
        description_reunion Varchar (255) NOT NULL ,
        tarif_reunion       Float NOT NULL ,
        id_reservation      Int
	,CONSTRAINT salle_reunion_PK PRIMARY KEY (num_salle_reunion)

	,CONSTRAINT salle_reunion_reservation_FK FOREIGN KEY (id_reservation) REFERENCES reservation(id_reservation)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: activités
#------------------------------------------------------------

CREATE TABLE activites(
        id_activite          Int  Auto_increment  NOT NULL ,
        nom_activite         Varchar (150) NOT NULL ,
        date_debut_activite  Datetime NOT NULL ,
        date_fin_activite    Datetime NOT NULL ,
        description_activite Varchar (255) NOT NULL ,
        tarif_activite       Float NOT NULL
	,CONSTRAINT activites_PK PRIMARY KEY (id_activite)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: hebergements
#------------------------------------------------------------

CREATE TABLE hebergements(
        numero_chambre          Int NOT NULL ,
        type_hebergement        Varchar (150) NOT NULL ,
        descritpion_hebergement Varchar (255) NOT NULL ,
        tarif_hebergement       Float NOT NULL ,
        option_menage           Bool DEFAULT false ,
        id_reservation          Int
	,CONSTRAINT hebergements_PK PRIMARY KEY (numero_chambre)

	,CONSTRAINT hebergements_reservation_FK FOREIGN KEY (id_reservation) REFERENCES reservation(id_reservation)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: transport
#------------------------------------------------------------

CREATE TABLE transport(
        id_transport    Int  Auto_increment  NOT NULL ,
        type_transport  Varchar (150) NOT NULL ,
        tarif_transport Float NOT NULL ,
        id_reservation  Int
	,CONSTRAINT transport_PK PRIMARY KEY (id_transport)

	,CONSTRAINT transport_reservation_FK FOREIGN KEY (id_reservation) REFERENCES reservation(id_reservation)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: participer
#------------------------------------------------------------

CREATE TABLE participer(
        id_reservation Int NOT NULL ,
        id_activite    Int NOT NULL
	,CONSTRAINT participer_PK PRIMARY KEY (id_reservation,id_activite)

	,CONSTRAINT participer_reservation_FK FOREIGN KEY (id_reservation) REFERENCES reservation(id_reservation)
	,CONSTRAINT participer_activites0_FK FOREIGN KEY (id_activite) REFERENCES activites(id_activite)
)ENGINE=InnoDB;

