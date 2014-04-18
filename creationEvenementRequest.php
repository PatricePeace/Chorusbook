<?php

include("config.php");

if (isset($_POST['nom'])) $nom = $_POST['nom'];
if (isset($_POST['date'])) $date = $_POST['date'];
if (isset($_POST['lieu'])) $lieu = $_POST['lieu'];
if (isset($_POST['evenement'])) $idtypeevt = $_POST['evenement'];
if (isset($_POST['oeuvres'])) $oeuvres = $_POST['oeuvres'];

if(isset($nom) && isset($idtypeevt) && isset($date) && isset($lieu))
{
    // Création événement
    $idevenement = $db->insertEvenement($idtypeevt, $nom, $date, $lieu);

    if ($idevenement != FALSE && isset($oeuvres))
    {
        if (count($oeuvres) > 0 && $nom != '' && $lieu != '')
        {
            // Associé l'événement aux oeuvres
            foreach($oeuvres as $oeuvre)
            {
                $db->addOeuvreToEvenement($oeuvre, $idevenement);
            }
            echo 'Evénement créé';
        }
        else
        {
            echo 'Création impossible';
        }
    }
    else
    {
        echo 'Création impossible';
    }
}
else
{
    echo 'Création impossible';
}

?>