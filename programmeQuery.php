<?php
include("config.php");

$saison = $_POST["saison"];
$styleForm = $_POST["style"];

$oeuvres = $db->getTitreOeuvreByStyle(3, $styleForm);

if ($styleForm == "all")
{
    $styles = $db->getStylesSaison($saison);
    $value = array(array());
    foreach($styles as $style)
    {
        foreach($oeuvres as $oeuvre)
        {
            $statut = $db->getStatusOeuvre($oeuvre['titre']);
            $oeuvreTab = array();
            $oeuvreTab['titre'] = $oeuvre['titre'];
            $oeuvreTab['style'] = $statut['idstatut'] - 1;
            $value[] = $oeuvreTab;
        }
    }

    if(!isset($_SESSION['login']))
    {
        $value[] = 'log';
    }
}
else
{
    $value = array();

    foreach($oeuvres as $oeuvre)
    {
        $statut = $db->getStatusOeuvre($oeuvre['titre']);
        $oeuvreTab = array();
        $oeuvreTab['titre'] = $oeuvre['titre'];
        $oeuvreTab['statut'] = $statut['idstatut'] - 1;
        $value[] = $oeuvreTab;
    }

    if(isset($_SESSION['login']))
    {
        $value[] = 'log';
    }
}


echo json_encode($value);

?>