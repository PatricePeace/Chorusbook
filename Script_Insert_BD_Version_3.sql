DELETE FROM est_au_programme;
DELETE FROM participe;
DELETE FROM responsabilite;
DELETE FROM utilisateur;
DELETE FROM choriste;
DELETE FROM inscription;
DELETE FROM Voix;
DELETE FROM StatutOeuvre;
DELETE FROM TypeEvt;
DELETE FROM evenement;
DELETE FROM style;
DELETE FROM oeuvre;




INSERT INTO Voix(typeVoix)
VALUES ('Alto');
INSERT INTO Voix(typeVoix)
VALUES ('Tenor');
INSERT INTO Voix(typeVoix)
VALUES ('Basse');
INSERT INTO Voix(typeVoix)
VALUES ('Soprano');

INSERT INTO TypeEvt(typeEvt)
VALUES ('Concert');
INSERT INTO TypeEvt(typeEvt)
VALUES ('Répétition');
INSERT INTO TypeEvt( typeEvt)
VALUES ('Saison');


INSERT INTO StatutOeuvre(typeStatut)
VALUES ('Non étudié');
INSERT INTO StatutOeuvre(typeStatut)
VALUES ('En cours apprentissage');
INSERT INTO StatutOeuvre(typeStatut)
VALUES ('Etudié');


INSERT INTO utilisateur(login, motdepasse, ValiWebmaster, ValiTresorier)
VALUES ('bressan.bastien@gmail.com', md5('bbressan'),true, true);
INSERT INTO utilisateur(login, motdepasse, ValiWebmaster, ValiTresorier)
VALUES ('patrice.melt@gmail.com', md5('pmelt'),true, true);
INSERT INTO utilisateur(login, motdepasse, ValiWebmaster, ValiTresorier)
VALUES ('c.defaud@gmail.com', md5('cdefaud'),true, true);
INSERT INTO utilisateur(login, motdepasse, ValiWebmaster, ValiTresorier)
VALUES ('davidgr95@yahoo.fr', md5('dgoncalves'),true, true);
INSERT INTO utilisateur(login, motdepasse, ValiWebmaster, ValiTresorier)
VALUES ('rodrigues.thomas@gmail.com', md5('trodrigues'),true, true);
INSERT INTO utilisateur(login, motdepasse, ValiWebmaster, ValiTresorier)
VALUES ('pierrick.kerirzin@hotmail.fr', md5('pkerizin'),true, true);
INSERT INTO utilisateur(login, motdepasse, ValiWebmaster, ValiTresorier)
VALUES ('test1.test@hotmail.fr', md5('ttest'),true, true);
INSERT INTO utilisateur(login, motdepasse, ValiWebmaster, ValiTresorier)
VALUES ('test2.test@hotmail.fr', md5('ttest'),true, true);
INSERT INTO utilisateur(login, motdepasse, ValiWebmaster, ValiTresorier)
VALUES ('test3.test@hotmail.fr', md5('ttest'),true, true);
INSERT INTO utilisateur(login, motdepasse, ValiWebmaster, ValiTresorier)
VALUES ('test4.test@hotmail.fr', md5('ttest'),true, true);
INSERT INTO utilisateur(login, motdepasse, ValiWebmaster, ValiTresorier)
VALUES ('test5.test@hotmail.fr', md5('ttest'),true, true);

INSERT INTO responsabilite(titre, login)
VALUES ('Chef de coeur', 'bressan.bastien@gmail.com');
INSERT INTO responsabilite(titre, login)
VALUES ('Tresorier', 'c.defaud@gmail.com');
INSERT INTO responsabilite(titre, login)
VALUES ('Webmaster', 'rodrigues.thomas@gmail.com');
INSERT INTO responsabilite(titre, login)
VALUES ('Menage', 'rodrigues.thomas@gmail.com');

INSERT INTO inscription(type_inscr, montant, annee)
VALUES ('etudiant', '200', '2014');


INSERT INTO choriste(nom ,prenom ,idVoix ,ville ,telephone ,login ,idinscription)
VALUES ('melt', 'patrice', '1', 'angers', '0601020304', 'patrice.melt@gmail.com', 1);
INSERT INTO choriste(nom ,prenom ,idVoix ,ville ,telephone ,login ,idinscription)
VALUES ('defaud', 'christophe', '3', 'bordeaux', '0602030405', 'c.defaud@gmail.com', 1);
INSERT INTO choriste(nom ,prenom ,idVoix ,ville ,telephone ,login ,idinscription)
VALUES ('goncalves', 'david', '4', 'sarcelles', '0603040506', 'davidgr95@yahoo.fr', 1);
INSERT INTO choriste(nom ,prenom ,idVoix ,ville ,telephone ,login ,idinscription)
VALUES ('rodrigues', 'thomas', '2', 'taverny', '0604050607', 'rodrigues.thomas@gmail.com', 1);
INSERT INTO choriste(nom ,prenom ,idVoix ,ville ,telephone ,login ,idinscription)
VALUES ('kerizin', 'pierrick', '1', 'amiens', '0605060708', 'pierrick.kerirzin@hotmail.fr', 1);
INSERT INTO choriste(nom ,prenom ,idVoix ,ville ,telephone ,login ,idInscription)
VALUES ('test1', 'test', '2', 'amiens', '0605060708', 'test1.test@hotmail.fr', 1);
INSERT INTO choriste(nom ,prenom ,idVoix ,ville ,telephone ,login ,idInscription)
VALUES ('test2', 'test', '3', 'amiens', '0605060708', 'test2.test@hotmail.fr', 1);
INSERT INTO choriste(nom ,prenom ,idVoix ,ville ,telephone ,login ,idInscription)
VALUES ('test3', 'test', '4', 'amiens', '0605060708', 'test3.test@hotmail.fr', 1);
INSERT INTO choriste(nom ,prenom ,idVoix ,ville ,telephone ,login ,idInscription)
VALUES ('test4', 'test', '1', 'amiens', '0605060708', 'test4.test@hotmail.fr', 1);
INSERT INTO choriste(nom ,prenom ,idVoix ,ville ,telephone ,login ,idInscription)
VALUES ('test5', 'test', '2', 'amiens', '0605060708', 'test5.test@hotmail.fr', 1);


INSERT INTO evenement(idTypeEvt, heuredate, lieu, nom)
VALUES (2, '2014-01-06 19:00:00', 'Evry - Au temple rue Chauchat', 'Préparation concert 1 de 19h à 21h30');
INSERT INTO evenement(idTypeEvt, heuredate, lieu, nom)
VALUES (2, '2014-01-13 10:30:00', 'Evry - Au temple rue Chauchat', 'Racccord instruments (Cuivres, orgue, percu)');
INSERT INTO evenement(idTypeEvt, heuredate, lieu, nom)
VALUES ( 2, '2014-01-20 18:00:00', 'Evry - Au temple vestier salle 45', 'Raccord choeur');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 2, '2014-05-24 10:00:00', 'Evry - Au temple rue Chauchat', 'Répétition générale concert 1 de 19h à 21h30');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 1, '2014-01-25 11:00:00', 'Eglise de Creteil', 'Messe de requiem');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 2, '2014-05-02 19:00:00', 'Evry - Au temple rue Chauchat', 'Préparation concert 2 de 19h à 21h30');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 2, '2014-05-16 10:30:00', 'Evry - Au temple rue Chauchat', 'Racccord instruments (Cuivres, orgue, percu)');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 2, '2014-05-23 18:00:00', 'Evry - Au temple vestier salle 45', 'Raccord choeur');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 2, '2014-05-26 18:00:00', 'Evry - Au temple vestier salle 45', 'Répétition générale concert 2 de 19h à 21h30');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 1, '2014-05-27 20:00:00', 'Paris - Au Palais des Congrès', 'Concert 2 Requiem allemand');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 1, '2014-01-28 20:30:00', 'Paris 12ème aux "Voix sur berges"', 'Concert 3 a capella');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 1, '2014-01-29 20:00:00', 'Paris 10ème Eglise St Vincent de Paul"', 'Concert 4 Requiem Mozart');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 2, '2014-08-29 19:00:00', 'Evry - Au conservatoire, 2 rue Bullet', 'Répétition générale');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 2, '2014-08-30 19:30:00', 'Evry - Au conservatoire, 2 rue Bullet', 'Répétition générale');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 2, '2014-08-31 18:00:00', 'Evry - Au conservatoire, 2 rue Bullet', 'Travail des partitions');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 2, '2014-09-01 19:00:00', 'Evry - Au conservatoire, 2 rue Bullet', 'Répétition générale');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 2, '2014-09-08 19:30:00', 'Evry - Au conservatoire, 2 rue Bullet', 'Répétition générale');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 2, '2014-09-15 18:00:00', 'Evry - Au conservatoire, 2 rue Bullet', 'Travail des partitions');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES (2, '2014-09-22 19:00:00', 'Evry - Au conservatoire, 2 rue Bullet', 'Travail des partitions');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 1, '2014-10-03 20:00:00', 'Paris 10ème Eglise St Vincent de Paul', 'Messe solennelle');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 1, '2014-10-04 20:30:00', 'Paris 12ème Eglise La trinité"', 'Concert 4');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 1, '2014-10-05 20:00:00', 'Paris 4ème Eglise St Louis"', 'Concert 5 profit assos ELA');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 2, '2014-10-13 18:00:00', 'Evry - Au conservatoire, 2 rue Bullet', 'Répétition générale');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 2, '2014-10-20 18:30:00', 'Evry - Au conservatoire, 2 rue Bullet', 'Répétition générale');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 2, '2014-10-27 18:00:00', 'Evry - Au conservatoire, 2 rue Bullet', 'Perfectionnement Tenors et Basses');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 2, '2014-11-03 18:00:00', 'Evry - Au conservatoire, 2 rue Bullet', 'Répétition générale');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 2, '2014-11-04 18:30:00', 'Evry - Au conservatoire, 2 rue Bullet', 'Répétition générale');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 2, '2014-11-10 18:00:00', 'Evry - Au conservatoire, 2 rue Bullet', 'Perfectionnement Tenors et Basses');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 2, '2014-11-17 18:30:00', 'Evry - Au conservatoire, 2 rue Bullet', 'Répétition générale');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 2, '2014-11-27 18:00:00', 'Evry - Au conservatoire, 2 rue Bullet', 'Répétition générale');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 1, '2014-11-28 20:00:00', 'Paris 19ème Le Zénith', 'Bach La passion selon St Jean');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 1, '2014-11-29 20:30:00', 'Evry - Au conservatoire, 2 rue Bullet', 'Requiem de Mozart');
INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 1, '2014-11-30 20:00:00', 'Evry - Salle Croix blanche', 'Concert anniversaire');

INSERT INTO evenement( idTypeEvt, heuredate, lieu, nom)
VALUES ( 3, NULL, '', 'Saison 2013-2014');

INSERT INTO style(intitule)
VALUES ('Religieux');
INSERT INTO style(intitule)
VALUES ('Renaissance');
INSERT INTO style(intitule)
VALUES ('Chanson à boire');

INSERT INTO oeuvre( titre, auteur, partition, duree, idStyle, idStatut)
VALUES ( 'Passion selon Saint Jean', 'BACH Johann Sebastian', 'BWV 245', '60', 1,3);
INSERT INTO oeuvre( titre, auteur, partition, duree, idStyle, idStatut)
VALUES ( 'Passion selon Saint Matthieu', 'BACH Johann Sebastian', 'BWV 244', '60', 1,3);
INSERT INTO oeuvre( titre, auteur, partition, duree, idStyle, idStatut)
VALUES ( 'Cantate', 'BACH Johann Sebastian', 'BWV 150', '60', 1,3);
INSERT INTO oeuvre( titre, auteur, partition, duree, idStyle, idStatut)
VALUES ( 'Requiem allemand', 'BRAHMS Johannes', '', '75', 1,3);
INSERT INTO oeuvre( titre, auteur, partition, duree, idStyle, idStatut)
VALUES ( 'Requiem', 'Mozart', '', '60', 1,3);
INSERT INTO oeuvre( titre, auteur, partition, duree, idStyle, idStatut)
VALUES ( 'Messe solenelle', 'Rossini', '', '60', 1,3);
INSERT INTO oeuvre( titre, auteur, partition, duree, idStyle, idStatut)
VALUES ( 'O magnum mysterium', 'Fabrice Gregorutti', '', '50', 1,2);
INSERT INTO oeuvre( titre, auteur, partition, duree, idStyle, idStatut)
VALUES ( 'Stabat Mater', 'Dvorak', '', '90', 2,2);
INSERT INTO oeuvre( titre, auteur, partition, duree, idStyle, idStatut)
VALUES ( 'Le roi David', 'Honegger', '', '90', 2,1);
INSERT INTO oeuvre( titre, auteur, partition, duree, idStyle, idStatut)
VALUES ( 'Chansson à boire', 'Poulenc', '', '45', 3,1);



INSERT INTO participe(Choriste_idChoriste, Evenement_IdEvenement, Indecis)
VALUES (1, 1, false);
INSERT INTO participe(Choriste_idChoriste, Evenement_IdEvenement, Indecis)
VALUES (2, 1, false);
INSERT INTO participe(Choriste_idChoriste, Evenement_IdEvenement, Indecis)
VALUES (3, 2, false);
INSERT INTO participe(Choriste_idChoriste, Evenement_IdEvenement, Indecis)
VALUES (4, 2, true);


INSERT INTO est_au_programme(oeuvre_idOeuvre, Evenement_IdEvenement)
VALUES (1, 1);
INSERT INTO est_au_programme(oeuvre_idOeuvre, Evenement_IdEvenement)
VALUES (1, 2);
INSERT INTO est_au_programme(oeuvre_idOeuvre, Evenement_IdEvenement)
VALUES (2, 1);
INSERT INTO est_au_programme(oeuvre_idOeuvre, Evenement_IdEvenement)
VALUES (2, 3);
INSERT INTO est_au_programme(oeuvre_idOeuvre, Evenement_IdEvenement)
VALUES (1, 4);
INSERT INTO est_au_programme(oeuvre_idOeuvre, Evenement_IdEvenement)
VALUES (1, 34);
INSERT INTO est_au_programme(oeuvre_idOeuvre, Evenement_IdEvenement)
VALUES (2, 34);
INSERT INTO est_au_programme(oeuvre_idOeuvre, Evenement_IdEvenement)
VALUES (3, 34);
INSERT INTO est_au_programme(oeuvre_idOeuvre, Evenement_IdEvenement)
VALUES (4, 34);
INSERT INTO est_au_programme(oeuvre_idOeuvre, Evenement_IdEvenement)
VALUES (5, 34);
INSERT INTO est_au_programme(oeuvre_idOeuvre, Evenement_IdEvenement)
VALUES (6, 34);
INSERT INTO est_au_programme(oeuvre_idOeuvre, Evenement_IdEvenement)
VALUES (7, 34);
INSERT INTO est_au_programme(oeuvre_idOeuvre, Evenement_IdEvenement)
VALUES (8, 34);
INSERT INTO est_au_programme(oeuvre_idOeuvre, Evenement_IdEvenement)
VALUES (9, 34);
INSERT INTO est_au_programme(oeuvre_idOeuvre, Evenement_IdEvenement)
VALUES (10, 34);
