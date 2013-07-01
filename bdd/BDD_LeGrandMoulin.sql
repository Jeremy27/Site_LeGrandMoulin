#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


CREATE TABLE menuSite(
        idOnglet   int (11) Auto_increment  NOT NULL ,
        nomOnglet  Varchar (15) NOT NULL ,
        LienOnglet Varchar (255) NOT NULL ,
        PRIMARY KEY (idOnglet )
)ENGINE=InnoDB;


CREATE TABLE reservation(
        idReservation     int (11) Auto_increment  NOT NULL ,
        civilite          Varchar (3) NOT NULL ,
        nom               Varchar (30) NOT NULL ,
        prenom            Varchar (30) NOT NULL ,
        telephone         Varchar (10) NOT NULL ,
        email             Varchar (50) NOT NULL ,
        codePostal        Varchar (5) NOT NULL ,
        ville             Varchar (30) NOT NULL ,
        adresse           Varchar (255) NOT NULL ,
        dateDebut         Date NOT NULL ,
        nbNuit            Int NOT NULL ,
        idChambre_chambre Int ,
        idType_typeSejour Int ,
        PRIMARY KEY (idReservation )
)ENGINE=InnoDB;


CREATE TABLE chambre(
        idChambre           int (11) Auto_increment  NOT NULL ,
        nomChambre          Varchar (25) ,
        informationsChambre Varchar (255) ,
        capaciteChambre     Int ,
        wc                  Varchar (50) NOT NULL ,
        sdb                 Varchar (25) ,
        PRIMARY KEY (idChambre )
)ENGINE=InnoDB;


CREATE TABLE optionHotel(
        idOption      int (11) Auto_increment  NOT NULL ,
        libelleOption Varchar (25) ,
        prixOption    Int ,
        PRIMARY KEY (idOption )
)ENGINE=InnoDB;


CREATE TABLE typeSejour(
        idType      int (11) Auto_increment  NOT NULL ,
        libelleType Varchar (255) ,
        PRIMARY KEY (idType )
)ENGINE=InnoDB;


CREATE TABLE utilisateur(
        idUtilisateur              int (11) Auto_increment  NOT NULL ,
        loginUtilisateur           Varchar (30) NOT NULL ,
        mdpUtilisateur             Varchar (40) NOT NULL ,
        idGroupe_groupeUtilisateur Int ,
        PRIMARY KEY (idUtilisateur )
)ENGINE=InnoDB;


CREATE TABLE groupeUtilisateur(
        idGroupe      int (11) Auto_increment  NOT NULL ,
        libelleGroupe Varchar (25) NOT NULL ,
        PRIMARY KEY (idGroupe )
)ENGINE=InnoDB;


CREATE TABLE formuleRestaurant(
        idFormule      int (11) Auto_increment  NOT NULL ,
        libelleFormule Varchar (50) NOT NULL ,
        prixFormule    Double NOT NULL ,
        PRIMARY KEY (idFormule )
)ENGINE=InnoDB;


CREATE TABLE platRestaurant(
        idPlat              int (11) Auto_increment  NOT NULL ,
        libellePlat         Varchar (255) NOT NULL ,
        prixPlat            Double NOT NULL ,
        idTypePlat_typePlat Int NOT NULL ,
        PRIMARY KEY (idPlat )
)ENGINE=InnoDB;


CREATE TABLE typePlat(
        idTypePlat      int (11) Auto_increment  NOT NULL ,
        libelleTypePlat Varchar (255) ,
        PRIMARY KEY (idTypePlat )
)ENGINE=InnoDB;


CREATE TABLE chambreOption(
        idOption_optionHotel Int NOT NULL ,
        idChambre_chambre    Int NOT NULL ,
        PRIMARY KEY (idOption_optionHotel ,idChambre_chambre )
)ENGINE=InnoDB;


CREATE TABLE prixChambre(
        prix              Double ,
        idChambre_chambre Int NOT NULL ,
        idType_typeSejour Int NOT NULL ,
        PRIMARY KEY (idChambre_chambre ,idType_typeSejour )
)ENGINE=InnoDB;


CREATE TABLE platFormuleRestaurant(
        idPlat_platRestaurant       Int NOT NULL ,
        idFormule_formuleRestaurant Int NOT NULL ,
        PRIMARY KEY (idPlat_platRestaurant ,idFormule_formuleRestaurant )
)ENGINE=InnoDB;


CREATE TABLE reservationOptionHotel(
        idReservation_reservation Int NOT NULL ,
        idOption_optionHotel      Int NOT NULL ,
        PRIMARY KEY (idReservation_reservation ,idOption_optionHotel )
)ENGINE=InnoDB;

ALTER TABLE reservation ADD CONSTRAINT FK_reservation_idChambre_chambre FOREIGN KEY (idChambre_chambre) REFERENCES chambre(idChambre);
ALTER TABLE reservation ADD CONSTRAINT FK_reservation_idType_typeSejour FOREIGN KEY (idType_typeSejour) REFERENCES typeSejour(idType);
ALTER TABLE utilisateur ADD CONSTRAINT FK_utilisateur_idGroupe_groupeUtilisateur FOREIGN KEY (idGroupe_groupeUtilisateur) REFERENCES groupeUtilisateur(idGroupe);
ALTER TABLE platRestaurant ADD CONSTRAINT FK_platRestaurant_idTypePlat_typePlat FOREIGN KEY (idTypePlat_typePlat) REFERENCES typePlat(idTypePlat);
ALTER TABLE chambreOption ADD CONSTRAINT FK_chambreOption_idOption_optionHotel FOREIGN KEY (idOption_optionHotel) REFERENCES optionHotel(idOption);
ALTER TABLE chambreOption ADD CONSTRAINT FK_chambreOption_idChambre_chambre FOREIGN KEY (idChambre_chambre) REFERENCES chambre(idChambre);
ALTER TABLE prixChambre ADD CONSTRAINT FK_prixChambre_idChambre_chambre FOREIGN KEY (idChambre_chambre) REFERENCES chambre(idChambre);
ALTER TABLE prixChambre ADD CONSTRAINT FK_prixChambre_idType_typeSejour FOREIGN KEY (idType_typeSejour) REFERENCES typeSejour(idType);
ALTER TABLE platFormuleRestaurant ADD CONSTRAINT FK_platFormuleRestaurant_idPlat_platRestaurant FOREIGN KEY (idPlat_platRestaurant) REFERENCES platRestaurant(idPlat);
ALTER TABLE platFormuleRestaurant ADD CONSTRAINT FK_platFormuleRestaurant_idFormule_formuleRestaurant FOREIGN KEY (idFormule_formuleRestaurant) REFERENCES formuleRestaurant(idFormule);
ALTER TABLE reservationOptionHotel ADD CONSTRAINT FK_reservationOptionHotel_idReservation_reservation FOREIGN KEY (idReservation_reservation) REFERENCES reservation(idReservation);
ALTER TABLE reservationOptionHotel ADD CONSTRAINT FK_reservationOptionHotel_idOption_optionHotel FOREIGN KEY (idOption_optionHotel) REFERENCES optionHotel(idOption);
