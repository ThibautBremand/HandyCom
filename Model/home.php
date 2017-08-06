<?php
require_once('connectBD.php') ;
function previewTplBD( $idtpl ) {
	try	{
		$bdd = getBDD();
	}
	catch(Exception $e)	{
		die('Erreur : '.$e->getMessage());
	}

	$reponse = $bdd->query('SELECT * FROM hc_templates where id = ' . $idtpl);

	return $reponse ;
}
?>