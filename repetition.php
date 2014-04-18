<?php
//session_start();

include("config.php");	// Configuration base de données
include("layout.php");	// Fichier de mise en page
//include("entete.php");


// Afficher l'entete
entete("Répétitions");

// Afficher le menu
menu("repetition");

# Traitement spécifique de la page #
####################################



$repetitions = $db->getRepetitions($_SESSION['login']);
$contenu = '<table id="tableau" class="radio">';
//$contenu .= '<tr><td colspan="3" class="sep_tableau"><strong> Répétitions </strong></td>';

if($_SESSION['choriste'] == true)
{
//	$contenu .= '<td colspan="3" class="sep_concert"><strong> Ma présence </strong></td>';
	$idChoriste = $db->getChoristeId($_SESSION['login']);
}
$contenu .= '</tr>';
$contenu .= '<th class="sep_tableau"> Nom </th> <th class="sep_tableau"> Date et Heure </th> <th class="sep_tableau"> Lieu </th>';

if($_SESSION['choriste'] == true)
	$contenu .= '<th class="sep_tableau"> Participe </th> <th class="sep_tableau"> Peut-être </th class="sep_tableau"> <th class="sep_tableau"> Absent </th>';

foreach($repetitions as $repetition)
{	
	$contenu .= '<tr><td>';
	$contenu .= $repetition['nom'].'</td>';
	$contenu .= '<td>'.date("d/m/Y H:i",strtotime($repetition['heuredate'])).'</td>';
	$contenu .= '<td>'.$repetition['lieu'].'</td>';

if($_SESSION['choriste'] == true)
{
	$checked_participe = '';
	$checked_peutetre = '';
	$checked_absent = 'checked';

	if($repetition['idchoriste'] > 0)
	{
		$checked_absent = '';
		if($repetition['indecis'] == 't' )
		     $checked_peutetre = 'checked';
		else
	             $checked_participe = 'checked';
	}

	$contenu .= '<td><input type="radio" id="y-'.$repetition['idevenement'].'" name="'.$repetition['idevenement'].'" '.$checked_participe.' value="y" onclick="modifier_participation('.$repetition['idevenement'].','.$idChoriste[0].', \'false\');"><label for="y-'.$repetition['idevenement'].'"></label></td>';
	$contenu .= '<td><input type="radio" id="m-'.$repetition['idevenement'].'" name="'.$repetition['idevenement'].'" '.$checked_peutetre.' value="m" onclick="modifier_participation('.$repetition['idevenement'].','.$idChoriste[0].', \'true\');"><label for="m-'.$repetition['idevenement'].'"></label></td>';
	$contenu .= '<td><input type="radio" id="n-'.$repetition['idevenement'].'" name="'.$repetition['idevenement'].'" '.$checked_absent.' value="n" onclick="modifier_participation('.$repetition['idevenement'].','.$idChoriste[0].',\'reset\');"><label for="n-'.$repetition['idevenement'].'"></label></td>';
}
	$contenu .= '</tr>';

}

$contenu .= '</table>';
// Afficher le contenu de la page
page($contenu);

// Afficher le pied de page
pied();

?>
