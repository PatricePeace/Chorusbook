<?php

include("config.php");	// Configuration base de données

function entete($titre)
{
	session_start();
	$page=$_SERVER['PHP_SELF'];

	print "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";
	print "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
	print "<head>\n";
	print "<meta http-equiv=\"Content-Type\" content=\"text/html;charset=utf-8\" />\n";
	print "<title>$titre</title>\n";
	print "<link rel=\"stylesheet\" href=\"css/style.css\"/>\n";
	print "<link rel=\"stylesheet\" href=\"css/programme.css\"/>\n";
	print "<link rel=\"stylesheet\" href=\"css/creation_evenement.css\"/>\n";
	print "<link rel=\"stylesheet\" href=\"css/jquery/ui-lightness/jquery-ui-1.10.2.custom.css\"/>\n";
	print "<link rel=\"stylesheet\" href=\"css/jquery/jquery.datetimepicker.css\"/>\n";
    print "<script type=\"text/javascript\" src=\"js/jquery-1.9.1.min.js\"></script>";
    print "<script type=\"text/javascript\" src=\"js/jquery-ui-1.10.1.min.js\"></script>";
    print "<script type=\"text/javascript\" src=\"js/programme.js\"></script>";
    print "<script type=\"text/javascript\" src=\"js/creation_evenement.js\"></script>";
    print "<script type=\"text/javascript\" src=\"js/jquery.datetimepicker.js\"></script>";
    print "<script src='js/profil.js'></script>";


	print "</head>\n";

	print "<body>\n";
	print '<div id="bandeau">';
	print "<h1> Chorusbook </h1>\n";
	
	// Personnaliser affichage erreur connexion
	$class = '';
	if(isset($_GET['err']) && $_GET['err'] > 1)
		$class = 'class="input_erreur"';

	// Afficher formulaire de connexion
	if (! isset($_SESSION['login']))
	{
		print '<div class="connexion">';
		print '<form action="connexion.php" method="post">';
		print '<input type="text" name="loginConnect" placeholder="Login" '.$class.' title="Adresse électronique" />';
		print '<input type="password" name="pwConnect" placeholder="Mot de passe" '.$class.' />';
		print '<input type="hidden" id="page" name="page" value="'.$page.'" />';
		print '<input type="submit" name="connexion" value="Connexion" />';
		print '</form>';

		// Afficher erreur de connexion
		if(isset($_GET['err']))
		{
			print "<span id='erreur_login'>";
			if($_GET['err']==1)
				print "Compte en attente de validation.";
			else if($_GET['err']==2)
				print "Login et/ou mot de passe incorrects.";
			print "</span>";
		}

		print '</div>';
	}
	// Afficher personne connectée
		else
	{
		print '<div class="deconnexion">';

		if((isset($_SESSION['chef_de_choeur']) && $_SESSION['chef_de_choeur'] == true) ||
		(isset($_SESSION['webmaster']) && $_SESSION['webmaster'] == true) ||
		(isset($_SESSION['tresorier']) && $_SESSION['tresorier'] == true))
		{
		print '<a href="admin.php"><img src="img/admin.png" width=25 title="Administration" /></a>&nbsp;&nbsp;';
		}
		print $_SESSION['prenom']. ' ' .$_SESSION['nom']. ' &nbsp;';
		print '<a href="editProfil.php"><img src="img/edit_user.png" width="25" title="Modifier mon profil" /></a>&nbsp;&nbsp;';
		print '<form action="deconnexion.php" method="post">';
		print '<input type="submit" id="logout" name="deconnexion" title="Me déconnecter" value="" />';
		print '</form>';
		print '</div>';
	}
	

	print "</div>";
}

function menu($page)
{
	print '<div id="menu">';
	
	if($page == "concert")
		print '<div class="tuileON">';
	else
		print '<div class="tuile">';
	
	print '<a href="concert.php">
			<div style="padding-top:10px;">
				<img src="img/concerts.png" />
				<p>Concerts</p>
			</div>
		</a>
		</div>';

	if($page == "choriste")
		print '<div class="tuileON">';
	else
		print '<div class="tuile">';
	print	'<a href="choriste.php">
			<div style="padding-top:10px;">
				<img src="img/choristes.png" />
				<p>Choristes</p>
			</div>
		</a>
		</div>';
	
	if($page == "programme")
		print '<div class="tuileON">';
	else
		print '<div class="tuile">';
	print	'<a href="programme.php">
			<div>
				<img src="img/prog.png" />
				<p>Programme de l\'année</p>
			</div>
		</a>
		</div>';
	// Afficher tuile inscription si non logué
	if(!isset($_SESSION['login']))
	{
		if($page == "inscription")
			print '<div class="tuileON">';
		else
			print '<div class="tuile">';
		print '<a href="inscription.php">
				<div style="padding-top:25px;">
					<img src="img/signin.png" width="32" />
					<p>S\'inscrire</p>
				</div>
			</a>
		</div>';
	}
	else
	{
		if($page == "repetition")
			print '<div class="tuileON">';
		else
			print '<div class="tuile">';
		print '<a href="repetition.php">
				<div style="padding-top:25px;">
					<img src="img/repetitions.png" width="32" />
					<p>Répétitions</p>
				</div>
			</a>
		</div>';
	}

/*	if((isset($_SESSION['chef_de_choeur']) && $_SESSION['chef_de_choeur'] == true) ||
		(isset($_SESSION['webmaster']) && $_SESSION['webmaster'] == true) ||
		(isset($_SESSION['tresorier']) && $_SESSION['tresorier'] == true))
	{
		if ($page == "admin")
			print '<div class="tuileON">';
		else
			print '<div class="tuile">';
		print '<a href="admin.php">
				<div style="padding-top:25px;">
					<img src="img/admin.png" width="32" />
					<p>Administration</p>
				</div>
			</a>
		</div>';

		
	}
*/

	print '</div>';
}
function page($contenu)
{
	print '<div id="contenu">';
	print $contenu;
	print '</div>';
}

function erreur($msgErreur, $pagePrecedente)
{
	print '<div id="contenu">';
	print "<p class=\"erreur\">$msgErreur</p>";
	#print "<p><a href=\"$pagePrecedente\">Revenir à la page précédente</a></p>";
	print "<p><a href=\"javascript:history.go(-1);\">Revenir à la page précédente</a></p>";
	print '</div>';
	pied();
	exit(1);
}

function pied()
{
	print "</body>
	</html>";
}

?>
