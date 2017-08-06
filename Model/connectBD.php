<?php
function getBDD() {
	$bdd = new PDO('mysql:host=mysql51-103.perso;dbname=thibautbvitrine', 'thibautbvitrine', 'edKQfY9X7tzy',array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
	$bdd->exec('SET NAMES utf8');
	//$bdd = new PDO('mysql:host=127.0.0.1;dbname=handycom;charset=utf8', 'root', '');
	return $bdd ;
}
?>