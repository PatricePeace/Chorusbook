<?php

include("config.php");

$idevenement = $_POST['idevenement'];
$idchoriste = $_POST['idchoriste'];
$status = $_POST['status'];

$insert = '';
if($status != 'reset')
	$insert = "INSERT INTO participe (choriste_idchoriste, evenement_idevenement,indecis) VALUES ('$idchoriste', '$idevenement', $status);";

$db->setParticipe($idchoriste,$idevenement,$insert);

echo 1;

?>
