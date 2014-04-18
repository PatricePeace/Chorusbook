<?php

include("config.php");	// Configuration base de données
include("layout.php");	// Fichier de mise en page

// Afficher l'entete
entete("Créer un programme");

// Afficher le menu
menu("admin");

if(!$_SESSION['chef_de_choeur'])
{
    erreur("Vous vous êtes perdu(e)","");

}
# Traitement spécifique de la page #

####################################

$programme = $db->getAllOeuvreStyle();

if (isset($_SESSION['login']))
{
    $saison = "2014-2015";

    // Ecrire le contenu de la page
$contenu = '
<form action="insertProgramme.php" method="post">
    <label>Saison</label>

    <input type="text" name="dateDeb" size="12" maxlength="4" id="dateDeb" placeholder="Année début" <!--onblur="Print()-->;"/> -
    <input type="text" name="dateFin" size="10" maxlength="4" id="dateFin" placeholder="Année fin" <!--onblur="Print()-->;"/>

    <table id="tableau" border="1" cellpadding="2">
        <tr >
            <td nowrap="nowrap">Sélectionner</td>
            <td nowrap="nowrap">Titre</td>
            <td nowrap="nowrap">Auteur</td>
            <td nowrap="nowrap">Partition</td>
            <td nowrap="nowrap">Durée</td>
            <td nowrap="nowrap">Style Oueuvre</td>
            <td nowrap="nowrap">Type statut</td>
        </tr>';


        foreach ($programme as $prog)
        {
            $contenu .= '
            <tr>';
                $contenu .= '<td>';
                $contenu .= "<input type='checkbox' id='{$prog['idoeuvre']}' name='idOeuvre_{$prog['idoeuvre']}' id='{$prog['idoeuvre']}' value='{$prog['idoeuvre']}'";
                $contenu .= '>';
                $contenu .= '</td>';
               
                $contenu .= '<td>';
                $contenu .= "{$prog['titre']}";
                $contenu .='</td>';
                $contenu .= '<td>';
                $contenu .= "{$prog['auteur']}";
                $contenu .='</td>';
                $contenu .= '<td>';
                $contenu .= "{$prog['partition']}";
                $contenu .= '</td>';
                $contenu .= '<td>';
                $contenu .= "{$prog['duree']}";
                $contenu .= '</td>';
                
                $contenu .= '<td>';
                $contenu .= "{$prog['intitule']}";
                $contenu .= '</td>';
                
                $contenu .= '<td>';
                $contenu .= "{$prog['typestatut']}";
                $contenu .= '</td>';
                $contenu .= '</tr>';
	    }
$contenu .= '</table>';

$contenu .= '    <input type="submit" value="Valider la saison " />';

$contenu .= '</form>';

}

// Afficher le contenu de la page
page($contenu);

// Afficher le pied de page
pied();

?>

<script>

    function Print()
    {
        var dateDeb = document.getElementById("dateDeb").value;
        if (dateDeb == 2013)
        {
            alert(dateDeb);
        }

        var dateFin = document.getElementById("dateFin").value;
        
        alert(dateFin);
    }
    function VerifDate(date)
    {

        window.alert("La date de début ["+date+"] est valide");

    }


</script>
