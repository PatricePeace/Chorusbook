<?php

include("config.php");	// Configuration base de données
include("layout.php");	// Fichier de mise en page

// Afficher l'entete
entete("admin");

// Afficher le menu
menu("admin");

if(!$_SESSION['tresorier'] && !$_SESSION['webmaster'] && !$_SESSION['chef_de_choeur'])
{
	erreur("Vous vous êtes perdu(e)","");
}


$contenu = '';

$contenu .= '<div id="menu_admin">';

$contenu .=
'<table>
<tr><td><div class="tuile">
	<a href="CreationOeuvre.php">
			<div style="padding-top:10px;">
				<img src="img/oeuvre.png" width=50px />
				<p>Ajouter une oeuvre</p>
			</div>
	</a>
</div></td>
<td><div class="tuile">
	<a href="creationEvenement.php">
			<div style="padding-top:10px;">
				<img src="img/evenement.png" width=50px/>
				<p>Ajouter un évènement</p>
			</div>
	</a>
</div></td></tr>
<tr><td><div class="tuile">
	<a href="creatProgramme.php">
			<div style="padding-top:10px;">
				<img src="img/saison.png" width=50px/>
				<p>Ajouter une saison</p>
			</div>
	</a>
</div></td>
<td><div class="tuile">
	<a href="validTresorier.php">
			<div style="padding-top:10px;">
				<img src="img/tresorier.png" width=50px/>
				<p>Validation trésorier</p>
			</div>
	</a>
</div></td></tr>
<tr><td><div class="tuile">
	<a href="validWebmaster.php">
			<div style="padding-top:10px;">
				<img src="img/webmaster.png" width=50px/>
				<p>Validation webmaster</p>
			</div>
	</a>
</div></td></tr></table>';

page($contenu);


pied();
