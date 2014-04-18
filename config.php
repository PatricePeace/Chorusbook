<?php
   /* Pour afficher les erreurs lors du dév */
   ini_set('display_errors', '1');
   error_reporting(E_ALL | E_STRICT);
   /* A retirer à la fin */

	include_once('db.php');
	$host = "localhost";
	$user = "postgres";
	$dbname = "chorusbook";
	$dbpassword = "casten";
	$db = new db($host, $user, $dbname, $dbpassword);
?>
