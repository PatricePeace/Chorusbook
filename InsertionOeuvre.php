<?php 


include("config.php");  // Configuration base de données
include("layout.php");  // Fichier de mise en page

###### Traitement de la page ######
$titre = $_POST['titre'] ;
$auteur = $_POST['auteur'] ;
$partition = $_POST['partition'] ;
$duree = $_POST['duree'] ;
$id_statut = $_POST['idstatut'] ;
$style_name = $_POST['style'] ;

$result = $db->InsertOeuvre($titre,$auteur,$partition,$duree,$id_statut,$style_name) ;
##################################

if($result!=null){
	 echo "<p>Votre oeuvre a bien ete ajoutee</p>" ;
}

else{
	echo "<p>Erreur parametre</p>" ;
}

	echo "<a href=./CreationOeuvre.php> Retour en arriere </href>" ;
?>
