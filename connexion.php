<?php
session_start();
include("config.php");	// Configuration base de données

// Récupérer les données saisies
if(isset($_POST['connexion']))
{
	if(isset($_POST['loginConnect']))	
		$login = $_POST['loginConnect'];
	if(isset($_POST['pwConnect']))	
		$pw = $_POST['pwConnect'];
	if(isset($_POST['page']))
		$page = $_POST['page'];
}

// Vérifier les informations de connexion dans la BD
if(! $result = $db->getUtilisateur($login, md5($pw)) )
{
	$erreur = 2;	// Compte innexistant
}
else if($result[2] == 't' && $result[3] == 't')
{
	$profil = $db->getProfil($login);
	$_SESSION['login'] = $login;
	$_SESSION['nom'] = $profil['nom'];
	$_SESSION['prenom'] = $profil['prenom'];
		/* Modif pour les droits  14/04/2014 */
	$_SESSION['tresorier'] = $db->getResponsabiliteByLogin($result[0],"Tresorier");
	$_SESSION['webmaster'] = $db->getResponsabiliteByLogin($result[0],"Webmaster");
	$_SESSION['chef_de_choeur'] = $db->getResponsabiliteByLogin($result[0],"Chef de coeur"); // A modifier en "Chef de choeur" lorsque la base aura été modifiée
	$_SESSION['choriste'] = $db->getResponsabiliteByLogin($result[0], "Choriste");
	/* Fin modif */
}	
else
	$erreur = 1;    // Attente validation

// Retourner sur la page logué ou avec erreur
if(isset($erreur))
	header('Location: '.$page.'?err='.$erreur);
else
	header('Location: '.$page);

?>
