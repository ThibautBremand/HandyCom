<?php
require "../Model/homepage.php" ;
session_start();

if ( $_POST['query'] == 'retrieveTplCategs' ) {
	retrieveTplCategs() ;
}
else if ( $_POST['query'] == 'retrieveTplForCateg' ) {
	retrieveTplForCateg( $_POST['categ'] ) ;
}

else if ( $_POST['query'] == 'retrieveTpl' ) {
	retrieveTpl( $_POST['tpl'] );
}

else if ( $_POST['query'] == 'registerPerson' ) {
	registerPerson( $_POST['login'], $_POST['password'], $_POST['mail'] );
}

function retrieveTplCategs () {
	$reponse = retrieveTplCategsBD();
	echo '<li class=""><a class="linkTpl" href="javascript:void(0);" onclick="retrieveTplCategs(\'all\', this)" >All</a></li>' ;
	while ($donnees = $reponse->fetch()) {
		echo '<li><a class="linkTpl" href="javascript:void(0);" onclick="retrieveTplCategs(\'' .  $donnees['name'] . '\', this)" >' . $donnees['name'] . '</a></li>' ;
	}
	$reponse->closeCursor();
}

function retrieveTplForCateg ( $categ ) {
	$reponse = retrieveTplForCategBD ( $categ );

	while ($donnees = $reponse->fetch()) {
		//$donnees['name']
		$cpt = 1;
		$cptTempo = 0;
		if ( $cpt % 3  == 0 ) {
			echo '<div class="isotope-container row grid-space-20">' ;
			$cptTempo = 0;
		}
		$name = $donnees['name'];
		if ( strlen($name ) > 20 ) {
			$name = substr($name,0,20) . '...' ;
		}
		echo				'<div class="col-sm-6 col-md-3 isotope-item web-design">
								<div class="image-box" onclick=\'previewTplFancybox("' . str_replace("'","&#39;",$donnees['name']) . '");\'>
									<div class="overlay-container">
										<img src="images/preview/' . $donnees['preview'] . '" alt="">
										<a class="overlay" data-toggle="modal" data-target="#project-1">
											<i class="fa fa-search-plus"></i>
											<span>' . $donnees['name'] . '</span>
										</a>
									</div>
									<a class="btn btn-default btn-block" data-toggle="modal" data-target="#project-1">' . $name . '</a>
								</div>
							</div> ' ;
		if ( $cptTempo  == 3 ) {
			echo '</div>' ;
		}
		$cpt ++ ;
		$cptTempo ++ ;
	}
	$reponse->closeCursor();
}

function retrieveTpl( $tpl ) {
	$reponse = retrieveTplBD( $tpl );
	$donnees = $reponse->fetch();

	if ( isset ( $_SESSION['login']) ) {
		$linkEdit = "<a href='control.php?objet=home&action=loadhome&tpl=" .  $donnees['id'] . "'>Edit ! </a>" ;
	}
	else {
		$linkEdit = "<a href='index.php'>Please login before. </a>" ;
	}

	$txt = "<p class='titreTplColorbox'>" . $donnees['name'] . "</p> </br> <p class='descriptionTplColorbox'>"  . str_replace("''","&#39;",$donnees['description']) . "</p></br> <img class='logoTplColorbox' src=\"images/preview/" . $donnees['preview'] . "\"/><p class='linkTplColorbox'>" . $linkEdit . "</p>" ;
	echo $txt;
}

function registerPerson( $login, $password, $mail ) {
	$reponse = registerPersonBD( $login, $password, $mail );
	$txt = $reponse;
	echo $txt;
}
?>