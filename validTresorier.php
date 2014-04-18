<?php

include("config.php");	// Configuration base de données
include("layout.php");	// Fichier de mise en page

// Afficher l'entete
entete("Validation des choristes");

// Afficher le menu
menu("admin");

# Traitement spécifique de la page #
if (!$_SESSION['tresorier'])
{
	erreur("Vous vous êtes perdu(e)","");
}

$contenu = "";

// Récupérer les choristes à valider
if (! $result = $db->getToValidTresorier())
{
	page("<p>Aucun utilisateur à valider</p>");
}
####################################
else
{
	$contenu .= '<table>';
	$contenu .= '<tr><th>Choriste</th><th>Accepter</th><th>Décliner</th></tr>';
	// Afficher les utilisateurs à valider
	foreach ($result as $user)
	{
		$contenu .= "<form action='valid.php' id='valid' method='post'>";
		$contenu .= '<tr><td>'.$user['nom'].' '.$user['prenom'].'</td>';
		$contenu .= '<td><input type="radio" value="1" name="validuser" onclick="validate(this)" /></td>';
		$contenu .= '<td><input type="radio" value="0" name="validuser" onclick="validate(this)" /></td>';
		$contenu .= '<input type="hidden" value="'.$user['login'].'" name="login" />';
		$contenu .= '<input type="hidden" value="tresorier" name="poste" id="poste" />';
		$contenu .= '</tr></form>';
	}
	$contenu .= '</table>';
	page($contenu);
}


// Afficher le pied de page
pied();

?>
