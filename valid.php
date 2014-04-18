<?php

include_once('config.php');

if(isset($_POST['validuser']))
{
	$poste = $_POST["poste"];
        $valid = $_POST['validuser'];
        $login = $_POST['login'];
}

if ( $poste == "tresorier" )
{
	if($valid)
	        $db->setValidTresorier($login);
}
if ( $poste == "webmaster" )
{
	if($valid)
	        $db->setValidWebmaster($login);
	else
        	$db->deleteChoriste($login);
}


?>
