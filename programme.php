<?php

include("config.php"); // Configuration base de donn��es
include("layout.php"); // Fichier de mise en page


// Afficher l'entete
entete("Programme");

// Afficher le menu
menu("programme");

# Traitement sp��cifique de la page #
####################################

$saisons = $db->getAllSaisons();

$contenu  = '<form name="programmeForm" id="programmeForm" action="#">';
$contenu .= '<div>';
$contenu .= '<p>Choisis une saison</p>';
$contenu .= '<select class="filtre" id="saison" name="saison">';

foreach($saisons as $saison)
{
    $contenu .= "<option value='{$saison['idevenement']}'>{$saison['nom']}</option>";
}
$contenu .= '</select>';
$contenu .= '</div>';

$styles = $db->getAllStyle();

$contenu .= '<div>';
$contenu .= '<p>Choisis un style</p>';
$contenu .= '<select class="filtre" id="style" name="style">';
$contenu .= '<option value="all">all</option>';
foreach($styles as $style)
{
    $contenu .= "<option value='{$style['idstyle']}'>{$style['intitule']}</option>";
}
$contenu .= '</select>';
$contenu .= '</div>';
$contenu .= '<input type="submit" value="voir oeuvre" />';
$contenu .= '</form>';

$contenu .= '<div id="programme">';
$contenu .= '</div>';

// Afficher le contenu de la page
page($contenu);

// Afficher le pied de page
pied();

?>