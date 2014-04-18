<?php

include("config.php");  // Configuration base de données
include("layout.php");  // Fichier de mise en page


# Traitement spécifique de la page #
if (!isset($_POST['inscription']))
{
	$msg = "Vous vous êtes perdu(e) ?";
	erreur($msg);
}

// Récupérer les valeurs saisies
if (isset($_POST['prenom']))
	$prenom = ucwords($_POST["prenom"]);
if (isset($_POST['nom']))
	$nom = mb_strtoupper($_POST["nom"]);
if (isset($_POST['login']))
	$login = $_POST["login"];
if (isset($_POST['pw']))
	$pw = $_POST["pw"];
if (isset($_POST['pwConfirm']))
	$pwConfirm = $_POST["pwConfirm"];
if (isset($_POST['ville']))
	$ville = mb_strtoupper($_POST["ville"]);
if (isset($_POST['tel']))
	$tel = $_POST["tel"];
if (isset($_POST['voix']))
	$voix = $_POST["voix"];
if (isset($_POST['type']))
	$type = $_POST["type"];

// Traiter les erreurs de champs vides
if (!isset($_POST["single"]))
{
	if ((!$prenom) | (!$nom) | (!$login) | (!$pw) | (!$pwConfirm) | (!$ville) | (!$tel) | (!$voix) | (!$type))
		$err = 'Vous devez impérativement remplir tous les champs.';
}

// Traiter les erreurs de champs incorrects
// Vérifier syntaxe prenom
if ( isset($prenom) && !preg_match('/^[A-Z é-]+$/i', $prenom) )
{
	$err = 'Certains champs saisis sont incorrects. Veuillez vérifier vos informations.';
}
// Vérifier syntaxe nom
else if ( isset($nom) && !preg_match('/^[A-Z é-]+$/i', $nom) )
{
	$err = 'Certains champs saisis sont incorrects. Veuillez vérifier vos informations.';
}
// Vérifier syntaxe login
else if ( isset($login) && !preg_match('/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}+$/', $login) )
{
	$err = 'Certains champs saisis sont incorrects. Veuillez vérifier vos informations.';
}
// Vérifier syntaxe ville
else if ( isset($ville) && !preg_match('/^[A-Z é-]+$/i', $ville) )
{
	$err = 'Certains champs saisis sont incorrects. Veuillez vérifier vos informations.';
}
// Vérifier numéro téléphone
else if ( isset($tel) && !preg_match('/^0[1-68]([-. ]?[0-9]{2}){4}$/', $tel) )
{
	$err = 'Certains champs saisis sont incorrects. Veuillez vérifier vos informations.';
}
// Vérifier longueur mot de passe
else if ( isset($pw) && (strlen($pw) < 6) )
{
	$err = 'Vous devez choisir un mot de passe de 6 caractères minimum.';
}
// Vérifier confirmation mdp
else if ( isset($pw) && isset($pwConfirm) )
{
	if($pw != $pwConfirm)
		$err = 'Vos mots de passe ne correspondent pas. Veuillez réessayer.';
}

// Vérifier que le login n'existe pas dans la BD
if(!isset($err) && isset($login) )
	$result = $db->getUtilisateur($login, '');


// Si l'utilisateur existe déjà afficher un message d'erreur
if( !isset($err) && isset($login) && $result['login'] == $login )
{
	$err = 'Le login saisi est déjà utilisé.';
}
else if(!isset($err) && !isset($_POST["single"]) )
{
	// Créer l'utilisateur
	$db->newUser($login, md5($pw));

	// Créer le choriste
	$db->newChoriste($nom, $prenom, $voix, $ville, $tel, $login, $type);
}
####################################


if(isset($err))
{
	if( isset($_POST["single"]))
		echo 0;
	else
		echo '<p class="erreur">'.$err.'</p>';
}
else
{
	if( isset($_POST["single"]))
		echo 1;
	else
		echo "<p>Votre demande d'inscription a bien été prise en compte et est en attente de validation.</p>";
}
?>
