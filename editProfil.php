<?php

include("config.php");	// Configuration base de données
include("layout.php");	// Fichier de mise en page

// Afficher l'entete
entete("Modification profil");

// Afficher le menu
menu("");

// Un visiteur ne devrait pas se retrouver sur la page d'inscription
if( ! isset($_SESSION['login']))
{
	$msg = "Vous vous êtes perdu(e) ?";
	erreur($msg, "index.php");
}

# Traitement spécifique de la page #

// Récupérer le profil du choriste connecté
$profil = $db->getProfil($_SESSION['login']);

// Récupérer voix
$voix = $db->getVoix();

// Récupérer type inscription
$type = $db->getTypeInscription();
####################################

// Ecrire le contenu de la page
$contenu = '
	<div id="message"></div>
	<table class="profil">
	<tr><td><h3>Mes coordonnées</h3></td>
	<form action="setProfil.php" method="post" id="setProfil">
		<input type="hidden" name="profilEdit" />
		<td><input type="button" class="submit" value="Modifier" style="width:175px" onclick="setProfil()" /></td></tr>
		<tr><td><label for="nom">Nom</label></td>
		<td><input type="text" id="nom" name="nom" value="'.$profil["nom"].'" /><br/></td></tr>
		<tr><td><label for="prenom">Prénom</label></td>
		<td><input type="text" id="prenom" name="prenom" value="'.$profil["prenom"].'" /><br/></td></tr>
		<tr><td><label for="tel">Téléphone</label></td>
		<td><input type="text" id="tel" name="tel" value="'.$profil["telephone"].'" /><br/></td></tr>
		<tr><td><label for="ville">Ville</label></td>
		<td><input type="text" id="ville" name="ville" value="'.$profil["ville"].'" /><br/></td></tr>
	</form></table>
	<table class="profil">
	<tr><td><h3>Mon mot de passe</h3></td>
	<form action="setProfil.php" method="post" id="setPw">
		<td><input type="button" class="submit" value="Modifier" style="width:175px" onclick="setPw()" /></td></tr>
		<input type="hidden" name="pwEdit" />
		<tr><td><label for="oldPw">Mot de passe actuel</label></td>
		<td><input type="password" id="oldPw" name="oldPw" /><br/></td></tr>
		<tr><td><label for="pw">Nouveau mot de passe</label></td>
		<td><input type="password" id="pw" name="pw" /><br/></td></tr>
		<tr><td><label for="pwConfirm">Confirmation nouveau mot de passe</label></td>
		<td><input type="password" id="pwConfirm" name="pwConfirm" /><br/></td></tr>
	</form></table>
';
// Afficher le contenu de la page
page($contenu);

// Afficher le pied de page
pied();

?>
