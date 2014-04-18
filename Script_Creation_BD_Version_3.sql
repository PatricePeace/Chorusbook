/*
BressanBastien
MeltPatrice
DefaudChristophe
RodriguesThomas
KerirzinPierrick
ConcalvesDavid
*/

DROP TABLE IF EXISTS responsabilite CASCADE;
DROP TABLE IF EXISTS Voix CASCADE;
DROP TABLE IF EXISTS Choriste CASCADE;
DROP TABLE IF EXISTS Inscription CASCADE;
DROP TABLE IF EXISTS utilisateur CASCADE;
DROP TABLE IF EXISTS TypeEvt CASCADE;
DROP TABLE IF EXISTS evenement CASCADE;
DROP TABLE IF EXISTS participe CASCADE;
DROP TABLE IF EXISTS StatutOeuvre CASCADE;
DROP TABLE IF EXISTS style CASCADE;
DROP TABLE IF EXISTS oeuvre CASCADE;
DROP TABLE IF EXISTS est_au_programme CASCADE;

create table utilisateur (
login varchar(45),
motdepasse varchar(45),
ValiWebmaster boolean,
ValiTresorier boolean,
constraint pk_utilisateur PRIMARY KEY(login))
;

create table responsabilite (
titre varchar(30),
login varchar(45),
constraint pk_titre PRIMARY KEY(titre),
constraint fk_responsabilite_user foreign key (login) references Utilisateur (login) ON DELETE SET NULL ON UPDATE CASCADE )
;

create table inscription (
idInscription serial,
type_inscr varchar(10) NOT NULL,
montant varchar(45) NOT NULL,
annee varchar(10) NOT NULL,
constraint pk_idInscription PRIMARY KEY(idInscription))
;

create table Voix (
idVoix serial,
typeVoix varchar(45),
constraint pk_idVoix PRIMARY KEY(idVoix)
);

create table Choriste (
idChoriste serial,
nom varchar(45),
prenom varchar(45),
idVoix int,
ville varchar(45),
telephone varchar(30),
login varchar(45) NOT NULL,
idInscription int,
constraint pk_idChoriste PRIMARY KEY(idChoriste),
constraint fk_idVoix foreign key (login) references Utilisateur (login) ON DELETE CASCADE ON UPDATE CASCADE,
constraint fk_utilisateur foreign key (login) references Utilisateur (login) ON DELETE CASCADE ON UPDATE CASCADE,
constraint fk_inscription foreign key (idInscription) references Inscription (idInscription) ON DELETE SET NULL);




create table TypeEvt (
idTypeEvt serial,
typeEvt varchar(45),
constraint pk_idTypeEvt PRIMARY KEY(idTypeEvt)
);

create table evenement (
idEvenement serial,
idTypeEvt int,
heureDate timestamp,
lieu varchar(45),
nom varchar(45),
constraint fk_idTypeEvt FOREIGN KEY(idTypeEvt) references TypeEvt (idTypeEvt) ON DELETE SET NULL,
constraint pk_idEvenement PRIMARY KEY(idEvenement)
);



create table participe (
Choriste_idChoriste int,
Evenement_IdEvenement int,
Indecis boolean, 
constraint pk_participe PRIMARY KEY (Choriste_idChoriste, Evenement_IdEvenement),
constraint fk_participe_choriste foreign key (Choriste_idChoriste) references Choriste (idChoriste) ON DELETE CASCADE,
constraint fk_participe_evenement foreign key (Evenement_IdEvenement) references evenement (idEvenement) ON DELETE CASCADE
);



create table StatutOeuvre (
idStatut serial,
typeStatut varchar(45),
constraint pk_idStatut PRIMARY KEY(idStatut)
);

create table style (
idStyle serial,
intitule varchar(45),
constraint pk_idStyle PRIMARY KEY(idStyle)
);

create table oeuvre (
idOeuvre serial,
titre varchar(45),
auteur varchar(45),
partition varchar(45),
duree int,
idStyle int,
idStatut INT,
constraint fk_idStyle foreign key (idStyle) references style (idStyle) ON DELETE SET NULL,
constraint fk_idStatut foreign key (idStatut) references StatutOeuvre (idStatut) ON DELETE SET NULL,
constraint pk_oeuvre PRIMARY KEY (idOeuvre)
);



create table est_au_programme (
oeuvre_idOeuvre int,
Evenement_IdEvenement int,
constraint pk_est_au_programme PRIMARY KEY (oeuvre_idOeuvre, Evenement_IdEvenement),
constraint fk_programme_oeuvre foreign key (oeuvre_idOeuvre) references Oeuvre (idOeuvre) ON DELETE CASCADE,
constraint fk_programme_evenement foreign key (Evenement_IdEvenement) references Evenement (idEvenement) ON DELETE CASCADE
);
