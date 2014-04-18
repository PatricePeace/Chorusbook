<?php

include("concert.php")

/*
include("config.php");
include("layout.php");

// Afficher l'entete
entete("Inscription");

// Afficher le menu
menu();

# Traitement spécifique de la page #

####################################

// Ecrire le contenu de la page
$contenu = '
	<h2>Inscrivez-vous dès maintenant pour rejoindre la chorale d\'&Eacute;vry</h2>
	<form action="verifInscription.php" method="post">
	<table id="inscription">
		<tr>
			<td><input type="text" size="40" name="prenom" placeholder="Prénom" title="Prénom" /></td>
			<td><input type="text" size="40" name="nom" placeholder="Nom" title="Nom" /></td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="text" size="83" name="login" placeholder="Votre adresse électronique" title="Votre adresse sera votre login" />
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="password" size="83" name="pw" placeholder="Nouveau mot de passe" title="Saisir un mot de passe" />
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="password" size="83" name="pwConfirm" placeholder="Confirmez votre mot de passe" title="Confirmer votre mot de passe" />
			</td>
		</tr>
		<tr>
			<td>
				<input type="text" size="40" name="ville" placeholder="Ville" title="Ville de résidence" />
			</td>
			<td>
				<input type="text" size="40" name="tel" placeholder="Téléphone" title="Numéro de téléphone" />
			</td>
		</tr>
		<tr>
			<td>
				<select name="voix">
					<option value="">Voix</option>';

					$result = pg_query($db, "SELECT * FROM voix;");
					while ($row = pg_fetch_row($result))
					{
						$contenu .= '<option value="'.$row[0].'">'.$row[1].'</option>';
					}

				$contenu .= '
				</select>
			</td>
			<td>
				<select name="type">
					<option value="">Type d\'inscription</option>';
					
					$result = pg_query($db, "SELECT idinscription, type_inscr FROM inscription;");
                                        while ($row = pg_fetch_row($result))
                                        {
                                                $contenu .= '<option value="'.$row[0].'">'.$row[1].'</option>';
                                        }

				$contenu .= '
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="middle">
				<input type="submit" value="Inscription"/>
			</td>
		</tr>
	</table>
	</form>
';
page($contenu);


// Afficher le pied de page
pied();
*/
?>
