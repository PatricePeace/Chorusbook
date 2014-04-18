<?php

include("config.php");	// Configuration base de données
include("layout.php");	// Fichier de mise en page

// Afficher l'entete
entete("Modification profil");


# Traitement spécifique de la page #

if ( ( !isset($_POST['profilEdit'])) && ( !isset($_POST['pwEdit'])) )
{
	$msg = "Vous vous êtes perdu(e) ?";
	erreur($msg);
}

$login = $_SESSION['login'];

if (isset($_POST['profilEdit']))
{
	$prenom = ucwords($_POST["prenom"]);
	$nom = mb_strtoupper($_POST["nom"]);
	$ville = mb_strtoupper($_POST["ville"]);
	$tel = $_POST["tel"];

	// Traiter les erreurs de champs vides
	if ((!$prenom) | (!$nom) | (!$ville) | (!$tel))
	{
		$err = 'Vous devez impérativement remplir tous les champs.';
	}
	// Vérifier syntaxe prenom
	else if (!preg_match('/^[A-Z é-]+$/i', $prenom))
	{
		$err = 'Certains champs saisis sont incorrects. Veuillez vérifier vos informations.';
	}
	// Vérifier syntaxe nom
	else if (!preg_match('/^[A-Z é-]+$/i', $nom))
	{
		$err = 'Certains champs saisis sont incorrects. Veuillez vérifier vos informations.';
	}
	// Vérifier syntaxe ville
	else if (!preg_match('/^[A-Z é-]+$/i', $ville))
	{
		$err = 'Certains champs saisis sont incorrects. Veuillez vérifier vos informations.';
	}
	// Vérifier numéro téléphone
	else if (!preg_match('/^0[1-68]([-. ]?[0-9]{2}){4}$/', $tel))
	{
		$err = 'Certains champs saisis sont incorrects. Veuillez vérifier vos informations.';
	}

	else if(!isset($err))
	{
		$db->setProfil($login, $nom, $prenom, $ville, $tel);
		$_SESSION['nom'] = $nom;
		$_SESSION['prenom'] = $prenom;
	}
}
else
{
	$oldpw = $_POST['oldPw'];
	$newpw = $_POST['pw'];
	$confirm = $_POST['pwConfirm'];
	
	// Traiter les erreurs de champs vides
	if ((!$oldpw) | (!$newpw) | (!$confirm))
	{
		$err = 'Vous devez impérativement remplir tous les champs.';
	}
	// Vérifier longueur nouveau mot de passe
	else if (strlen($newpw) < 6)
	{
		$err = 'Vous devez choisir un mot de passe de 6 caractères minimum.';
	}
	// Vérifier confirmation mdp
	else if ($newpw != $confirm)
	{
		$err = 'Les nouveaux mots de passe ne correspondent pas. Veuillez réessayer.';
	}
	// Vérifier le mot de passe actuel
	if (!isset($err))
	{
		$result = $db->getUtilisateur($login, md5($oldpw));
		if( isset($result) && ($result['login'] != $login) )
			$err = 'Votre mot de passe actuel est incorrect.';
	}
	
	// Modifier le mot de passe si authentification OK
	if ( !isset($err) )
	{
		$db->setPassword($login, $newpw);
	}	
}
####################################

if(isset($err))
{
	echo '<p class="erreur">'.$err.'</p>';
}
else
{
	echo "<p>Votre demande a bien été effectuée.</p>";
}


?>
