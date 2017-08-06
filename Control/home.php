<?php
require "Model/home.php" ;

function loadhome( $idtpl ){
	require("./View/home/home.tpl");
}

function previewTpl( $idtpl ) {
	$reponse = previewTplBD( $idtpl );
	$donnees = $reponse->fetch();
	
	echo "<img src='images/preview/" . $donnees['preview'] . "' />";
}

function templateName( $idtpl ) {
	$reponse = previewTplBD( $idtpl );
	$donnees = $reponse->fetch();
	
	if ( $donnees['name'] == "Classique" ) {
		echo "<script type='text/javascript' >selectTemplate('tpl1'); </script>";
	}
	else if ( $donnees['name'] == "In New York, concrete jungle where dreams are made of, there's nothing you can't do..." ) {
		echo "<script type='text/javascript' >selectTemplate('startbootstrap-grayscale-1.0.3'); </script>";
	}
	

}