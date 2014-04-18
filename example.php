<?php

include("config.php");	// Configuration base de données
include("layout.php");	// Fichier de mise en page

// Afficher l'entete
entete("TITRE DE LA PAGE");

// Afficher le menu
menu();

# Traitement spécifique de la page #

####################################

// Ecrire le contenu de la page
$contenu = '

';
// Afficher le contenu de la page
page($contenu);

// Afficher le pied de page
pied();

?>
