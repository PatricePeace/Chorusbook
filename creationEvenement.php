<?php

include("config.php"); // Configuration base de donn��es
include("layout.php"); // Fichier de mise en page


// Afficher l'entete
entete("Création événement");

// Afficher le menu
menu("admin");

if(!$_SESSION['chef_de_choeur'])
{
	erreur("Vous vous êtes perdu(e)","");

}
# Traitement sp��cifique de la page #
####################################

$contenu = '<form id="creerEvenement" action="#">
                <p>nom : <input type="text" name="nom" id="nomEvt"/></p>
                <p>lieu : <input type="text" name="lieu" id="lieuEvt"/></p>
                <p>type :
                <select name="evenement" id="evenement">';

// récuperer les types d'evenement
$evenements = $db->getAllTypeevt();
foreach($evenements as $evenement)
{
    $contenu .= '<option value="'.$evenement['idtypeevt'].'">'.$evenement['typeevt'].'</option>';
}

$contenu .= '</select></p>';

$contenu .= '<p>date: <input name="date" type="text" id="datepicker"></p>';

$contenu .= '<div>';
$contenu .= '<div>';
$contenu .= '<span style="margin-left: 60px;">Toutes les oeuvres</span><span style="margin-left: 280px;">Les oeuvres de l\'événement</span>';
$contenu .= '</div>';
$contenu .= '<div style="height: 250px;">';
$contenu .= '<ul class="list_oeuvre" id="all_oeuvres">';

// récuperer toutes les oeuvres de la base
$oeuvres = $db->getAllOeuvre();
foreach($oeuvres as $oeuvre)
{
    $contenu .= '<li value="'.$oeuvre['idoeuvre'].'" class="oeuvre">'.$oeuvre['titre'].'</li>';
}


$contenu .= '</ul>';

$contenu .= '<input id="add_oeuvre" type="button" value=">" />';
$contenu .= '<input id="back_oeuvre" type="button" value="<" />';

$contenu .= '<ul class="list_oeuvre" id="evt_oeuvres">';
$contenu .= '<ul>';
$contenu .= '</div>';
$contenu .= '</div>';

$contenu .= '<span style="margin-left: 670px"><input value="Créer" type="submit"/></span>';

$contenu .= '</form>';

// Afficher le contenu de la page
page($contenu);

// Afficher le pied de page
pied();

?>