<?php
//session_start();

include("config.php");	// Configuration base de données
include("layout.php");	// Fichier de mise en page
//include("entete.php");


// Afficher l'entete
entete("Concerts");

// Afficher le menu
menu("concert");

# Traitement spécifique de la page #
####################################
$contenu ='';
/*$contenu ='<div id="map-canvas" style="height: 100%;"></div>';*/
/* Test des variables de session liées au droit */
/*if (isset($_SESSION['choriste']) && $_SESSION['choriste'] == true)
$contenu .= '<strong> Bonjour je suis un choriste </strong>';

if (isset($_SESSION['chef_de_choeur']) && $_SESSION['chef_de_choeur'] == true)
$contenu .= '<strong> Bonjour je suis un Chef de Choeur </strong>';

if (isset($_SESSION['webmaster']) && $_SESSION['webmaster'] == true)
$contenu .= '<strong> Bonjour je suis un Webmaster </strong>';

if (isset($_SESSION['tresorier']) && $_SESSION['tresorier'] == true)
$contenu .= '<strong> Bonjour je suis un Trésorier </strong>';
*//* Fin des test */

$affiche_passe = false; // Marquer la limite entre concerts à venir et passés

$concerts = $db->getConcerts();
$contenu .= '<table id="tableau">';
$contenu .= '<th> Nom </th> <th> Date et Heure </th> <th> Lieu </th>';
$contenu .= '<tr><td colspan="3" class="sep_tableau"><strong> Concerts à venir </strong></td></tr>';
/*$contenu .= '<iframe
  width="450"
  height="250"
  frameborder="0" style="border:0"
  src="https://www.google.com/maps/embed/v1/search?key=AIzaSyAUGYoVcvJAYMFVve3hvDnyBn-Cvod-9dI&q=record+stores+in+Seattle">
</iframe>';*/
foreach($concerts as $concert)
{	
	if (date("Y-m-d H:i:s") > $concert['heuredate'] && $affiche_passe == false)
	{
		$contenu .= '<tr><td colspan="3" class="sep_tableau"><strong>Concerts passés</strong></td></tr>';
		$affiche_passe = true;
	}
		
		$nb_alto = $db->getNbVoixByConcert($concert['idevenement'], 'Alto');
		$nb_tenor = $db->getNbVoixByConcert($concert['idevenement'], 'Tenor');
		$nb_basse = $db->getNbVoixByConcert($concert['idevenement'], 'Basse');
		$nb_soprano = $db->getNbVoixByConcert($concert['idevenement'], 'Soprano');

		$contenu .= '<tr><td>';

		if(date("Y-m-d H:i:s") < $concert['heuredate'] && isset($_SESSION['login']))
		{
			if ($nb_alto[0] >= 2 && $nb_tenor[0] >= 2 && $nb_basse[0] >= 2 && $nb_soprano[0] >= 2)
				$contenu .= '<div id="voyant_vert"></div>';
			else $contenu .= '<div id="voyant_rouge"></div>';
		}
		$contenu .= $concert['nom'].'</td>';
		$contenu .= '<td>'.date("d/m/Y H:i",strtotime($concert['heuredate'])).'</td>';
		$contenu .= '<td>'.$concert['lieu'].'</td>';



		$contenu .= '</tr>';
	
}

$contenu .= '</table>';
// Afficher le contenu de la page
page($contenu);

// Afficher le pied de page
pied();

?>