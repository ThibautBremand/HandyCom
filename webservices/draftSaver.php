<?php

//$_SESSION['login'] = "user";
session_start();

/*This webservice saves a draft for a template*/

// first checks if the draft directory for this current user already exists
$tempDir = "../drafts/draft-" . $_SESSION['login'];
if ( !file_exists ( $tempDir ) ) {
	mkdir($tempDir);
}

//gets the timer when the user requests a download
$requestTime =  date('m/d/Y h:i:s a', time());
$requestTime = str_replace('/', '_', $requestTime);
$requestTime = str_replace(':', '_', $requestTime);
$requestTime = str_replace(' ', '_', $requestTime);

//***step 1 - creates the draft file***
$requestName = '../drafts/draft-' . $_SESSION['login'] . '/draft-' . $requestTime;
$draft = fopen( $requestName , "w") ;

//***step 2 - gets the text from the sections
	//retrieves the parameters
	$tpl = $_POST['tpl'];
	$title = $_POST['title'];
	
	$menu = json_decode(stripslashes($_POST['menu']));
	$sections = json_decode(stripslashes($_POST['sections']));
	
//***step 3 - fills the draw file for the user
	$content = "";
	$cptTitre = 1;
	
	$content = $content . "TEMPLATE-HANDYCOMTAGSEPARATOR-" . $tpl . "\n" ;
	$content = $content . "TITLE-HANDYCOMTAGSEPARATOR-" . $title . "\n" ;
	
	foreach( $menu as $m ) {
		$cleantext = str_replace("&quot;", "\"", $m);
		$content = $content . "TITLENUMBER-HANDYCOMTAGSEPARATOR-" ;
		$content = $content . $cleantext . "\n" ;
		
		$cptTitre++;
	}
	
	$cptTitre = 1;
	foreach( $sections as $s ) {
		$cleantext = str_replace("&quot;", "\"", $s);
			
		$content = $content . "SECTIONNUMBER-HANDYCOMTAGSEPARATOR-" ;
		$content = $content . $cleantext . "\n" ;
		
		$cptTitre ++;
	}

	file_put_contents ($requestName , $content );
	
?>