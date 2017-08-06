<?php
require_once('connectBD.php') ;
function retrieveTplCategsBD() {
	try	{
		$bdd = getBDD();
	}
	catch(Exception $e)	{
		die('Erreur : '.$e->getMessage());
	}

	$reponse = $bdd->query('SELECT name FROM hc_tpltypes');

	return $reponse ;
}

function retrieveNoCategFromCateg( $categ, $bdd ) {
	$reponse = $bdd->query('SELECT * FROM hc_tpltypes where name = "' . $categ . '"' );
	$donnees = $reponse->fetch();
	return $donnees['id'] ;
	//$reponse->closeCursor();
}

function retrieveTplForCategBD ( $categ ) {
	try	{
		$bdd = getBDD();
	}
	catch(Exception $e)	{
		die('Erreur : '.$e->getMessage());
	}
	if ( $categ != "all" ) {
		$nocateg = retrieveNoCategFromCateg( $categ, $bdd ) ;
		$reponse = $bdd->query('SELECT * FROM hc_templates where id IN ( SELECT idtemplate from hc_typeappartient WHERE idtype  = ' . $nocateg . ')');
	}
	else {
		$reponse = $bdd->query('SELECT * FROM hc_templates');
	}

	return $reponse ;
}

function retrieveTplBD( $tpl ) {
	try	{
		$bdd = getBDD();
	}
	catch(Exception $e)	{
		die('Erreur : '.$e->getMessage());
	}
	$reponse = $bdd->query('SELECT * FROM hc_templates where name = "' . $tpl . '"' );
	return $reponse;
}

function checkIfLoginExists( $login ) {
	try	{
		$bdd = getBDD();
	}
	catch(Exception $e)	{
		die('Erreur : '.$e->getMessage());
	}	
	$reponse = $bdd->query('SELECT * FROM hc_user where login = "' . $login . '"' );
	if ( $reponse->rowCount() > 0 ) {
		return true;
	}
	return false;
}

function registerPersonBD( $login, $password, $mail ) {
	if ( !checkIfLoginExists( $login ) ) {
	try	{
		$bdd = getBDD();
	}
		catch(Exception $e)	{
			die('Erreur : '.$e->getMessage());
		}	
		$password = hash("SHA512", $password);
		$reponse = $bdd->query('INSERT INTO hc_user(login, pass, mail) VALUES ("' . $login . '","' . $password . '","' . $mail . '")' );
		return "ok";
	}
	return 'ko';
}
?>