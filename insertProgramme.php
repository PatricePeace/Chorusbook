<?php

include("config.php");  // Configuration base de données
include("layout.php");  // Fichier de mise en page

// Afficher l'entete
entete("Vérification programme");

// Afficher le menu
menu("admin");

# Traitement spécifique de la page #

// Récupérer les valeurs saisies
$dateDeb = ($_POST["dateDeb"]);
$dateFin = ($_POST["dateFin"]);
$nomSaison = "Saison ".$dateDeb."-".$dateFin;
echo "Le nom de la saison est: ".$nomSaison."<br>";

// Traiter les erreurs de champs vides
$errChampVide = 'Vous devez impérativement remplir tous les champs.';

// Traiter les erreurs sur les dates
$errDate = 'Vérifier vos dates. Date';

// Test des dates passés en paramètre POST
if ($dateDeb > $dateFin)
{
    echo "L'erreur => ".$errDate;
}
// faire test date et appel fonct erreur. Passer en param a erre un message d'erreur

// Page de retour en cas d'erreur
$pagePrecedente = "index.php";



// Récupérer l'id du type d'événment saison
$idSaison = $db->getType('Saison');

$idEvtSaison = $db->insertSaison($idSaison['idtypeevt'],$nomSaison);

foreach ($_POST as $post => $val)
{

        if (preg_match("/^idOeuvre/", $post))
    {
        $idOeuvre = $val;
        $db->addOeuvreToEvenement($idOeuvre, $idEvtSaison);
    }

}


#erreur("Page en maintenance.", "index.php");
####################################

// Ecrire le contenu de la page
$contenu = "
Votre demande de création de programme a bien été prise en compte.
";

// Afficher le contenu de la page
page($contenu);

// Afficher le pied de page
pied();


?>
