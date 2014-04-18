<?php

include("config.php");
include("layout.php");

// Afficher l'entete
entete("Inscription");

// Afficher le menu
menu("inscription");

# Traitement spécifique de la page #

####################################

$contenu ="";

// Un utilisateur ne devrait pas se retrouver sur la page d'inscription
if(isset($_SESSION['login']))
{
	$msg = "Vous vous êtes perdu(e) ?";
	erreur($msg, "index.php");
}

else
{

// Ecrire le contenu de la page
	$contenu .= '
	<h2>Inscrivez-vous dès maintenant pour rejoindre la chorale d\'&Eacute;vry</h2>
	<div id="message"></div>
	<form action="verifInscription.php" method="post" id="signin">
	<input type="hidden" name="inscription" />
	<table id="inscription" >
		<tr>
			<td><input class="inpInscription" type="text" size="40" name="prenom" placeholder="Prénom" title="Prénom" onblur="check(this);" /></td>
			<td><input class="inpInscription" type="text" size="40" name="nom" placeholder="Nom" title="Nom" onblur="check(this);" /></td>
		</tr>
		<tr>
			<td colspan="2">
				<input class="inpInscription" type="text" size="83" name="login" placeholder="Votre adresse électronique" title="Votre adresse sera votre login" onblur="check(this);" />
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input class="inpInscription" type="password" size="83" name="pw" placeholder="Nouveau mot de passe" title="Saisir un mot de passe" onblur="check(this);" onkeyup="verifPW()" />
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input class="inpInscription" type="password" size="83" name="pwConfirm" placeholder="Confirmez votre mot de passe" title="Confirmer votre mot de passe" onkeyup="verifPW()" />
			</td>
		</tr>
		<tr>
			<td>
				<input class="inpInscription" type="text" size="40" name="ville" placeholder="Ville" title="Ville de résidence" onblur="check(this);" />
			</td>
			<td>
				<input class="inpInscription" type="text" size="40" name="tel" placeholder="Téléphone" title="Numéro de téléphone" onblur="check(this);" />
			</td>
		</tr>
		<tr>
			<td>
				<select name="voix" id="voix">
					<option value="">Choisissez votre voix...</option>';

					$result = $db->getVoix();

					foreach($result as $voix)
					{
						$contenu .= '<option value="'.$voix[0].'">'.ucwords($voix[1]).'</option>';
					}

				$contenu .= '
				</select>
			</td>
			<td>
				<select name="type" id="voix">
					<option value="">Choisissez votre type d\'inscription</option>';
					
					$result = $db->getTypeInscription();
					
					foreach($result as $type)
					{
						$contenu .= '<option value="'.$type[0].'">'.ucwords($type[1]).'</option>';
					}

				$contenu .= '
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="middle">
				<input class="inpInscription" type="button" value="Inscription" onclick="signin()" />
			</td>
		</tr>
	</table>
	</form>
';
}

page($contenu);


// Afficher le pied de page
pied();

?>
