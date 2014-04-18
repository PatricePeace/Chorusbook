<?php

include("config.php");

$idSaison = $_POST['saison'];
$idStyle = $_POST['style'];

$stylesInfo = array();
$oeuvresInfo = array();

if(isset($_SESSION['login']))
{
    $stylesInfo['login'] = 1;
}

if($idStyle == 'all')
{
    $styles = $db->getStylesSaison($idSaison);

    foreach($styles as $style)
    {
        $oeuvres = $db->getTitreOeuvreByStyle($idSaison, $style['intitule']);
        foreach($oeuvres as $oeuvre)
        {
            $status = $db->getStatusOeuvre($oeuvre['titre']);
            $oeuvresInfo['titre'] = $oeuvre['titre'];
            $oeuvresInfo['statut'] = $status['idstatut'];
            $stylesInfo[$style['intitule']][] = $oeuvresInfo;
        }
    }
}
else
{
    $style = $db->getStyle($idStyle);
    $oeuvres = $db->getTitreOeuvreByStyle($idSaison, $style['intitule']);
    foreach($oeuvres as $oeuvre)
    {
        $status = $db->getStatusOeuvre($oeuvre['titre']);
        $oeuvresInfo['titre'] = $oeuvre['titre'];
        $oeuvresInfo['statut'] = $status['idstatut'];
        $stylesInfo[$style['intitule']][] = $oeuvresInfo;
    }
}

header('Content-Type: application/json');
echo json_encode($stylesInfo);

?>