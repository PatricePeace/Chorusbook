<?php

include("config.php");	// Configuration base de données
include("layout.php");	// Fichier de mise en page



// Afficher l'entete
entete("Oeuvre");

// Afficher le menu
menu("admin");

if(!$_SESSION['chef_de_choeur'])
{
    erreur("Vous vous êtes perdu(e)","");

}
# Traitement spécifique de la page #

####################################

// Ecrire le contenu de la page

$contenu = '<p align=center> <strong> CREATION OEUVRE </strong></p><br/><br/>

<form id="target" method="post" action="InsertionOeuvre.php">
<p> Titre : <input type="text" name="titre"/> <br/> 
    Auteur : <input type="text" name="auteur"/> <br/> 
    Partition : <input type="text" name="partition"/> <br/>
    Duree : <input type="text" name="duree"/> <br/>
    Style : <input type="text" name="style"/> <br/>
</p>
    
    <p> Statut oeuvre : </p>
    <select name="idstatut" form="target">
        <option value="1"> Non étudié </option>
        <option value="2"> En cours d\'apprentissage </option>
        <option value="3"> Etudié </option>
    </select> <br/><br/>

<input type="submit" value="Créer l\'oeuvre"/> <br/>';
    

// Afficher le contenu de la page
page($contenu);

// Afficher le pied de page
pied();
?>
