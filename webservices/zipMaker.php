<?php

//$_SESSION['login'] = "user";
session_start();

/*This webservice makes the zip file and let the user download it*/

//MAIN Function - Where the webservice begins
//Downloads the user's request

	//retieves the parameters
	$tpl = $_POST['tpl'];
	$title = $_POST['title'];
	
	$menu = json_decode(stripslashes($_POST['menu']));
	$sections = json_decode(stripslashes($_POST['sections']));

	//gets the timer when the user requests a download
	$requestTime =  date('m/d/Y h:i:s a', time());
	$requestTime = str_replace('/', '_', $requestTime);
	$requestTime = str_replace(':', '_', $requestTime);
	$requestTime = str_replace(' ', '_', $requestTime);
	
	//***step 1 - creates the request folder***
	$requestName = '../request-' . $requestTime;
	mkdir($requestName);
	
	//***step 2 - fills the request folders***
	$path='../templates/' . $tpl;
	$rootPath = realpath($path);
	
	// Create recursive directory iterator
	$filesToCopy = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator($rootPath),
		RecursiveIteratorIterator::LEAVES_ONLY
	);
	recurse_copy($path, $requestName);
	
	// Adds the images
	$pathImages = "../temp/temp-" . $_SESSION['login'];
	if (file_exists( $pathImages )) {
		recurse_copy($pathImages, $requestName . "/images");
	}

	//***step 3 - adapts the source code to the request***
	fill_tpl($tpl, $requestName, $title, $menu, $sections );
	
	//***step 4 - zips the request folder and sends it to the user***
    $zip = new ZipArchive($path); 
      if($zip->open($requestName . '/template.zip', ZipArchive::CREATE) === true)
      {    
			// Create recursive directory iterator
			$files = new RecursiveIteratorIterator(
				new RecursiveDirectoryIterator($requestName),
				RecursiveIteratorIterator::LEAVES_ONLY
			);
			foreach ($files as  $file) {
				// Get real path for current file
				$filePath = $file->getPathname();
				$nom = $file->getBasename ();
				if ( $nom != '.' && $nom != '..' ) {
					$new_filename = substr($filePath,strrpos($filePath,'request') );
					// Add current file to archive
					$zip->addFile($filePath, $new_filename);
				}
			}
			
		// Closes the archive
		$zip->close();
		
		$requestName = substr($requestName,strrpos($requestName,'request') );
		/*header("Content-type: application/zip");
		header("Content-Disposition: attachment; filename=template.zip");
		header("Pragma: no-cache");
		header("Expires: 0");
		readfile($requestName . '/template.zip');*/
		
		// Deletes the temp directory for the user
		deleteDir( "../temp/temp-" . $_SESSION['login'] );
		
		echo $requestName . '/template.zip';
      }

//Fills the template for the user
function fill_tpl($tpl, $requestName, $title, $menu, $sections ) {
	//p1 - writes the doctype + includes + begining of document + title part 1
	$p1 = file_get_contents('../pageFiller/' . $tpl . '/1.part', 'r+');
	file_put_contents ($requestName.'/home.html' , $p1 . $title );
	
	//p2 - title part 2 + menu part 1
	$p2 = file_get_contents('../pageFiller/' . $tpl . '/2.part', 'r+');
	$categs = "";
	$cptCateg = 1;
	foreach( $menu as $m ) {
		$categs = $categs . "<li><a href=\"" . "#" . $cptCateg . "\">" . $m . "</a></li> " ;
		$cptCateg ++;
	}
	file_put_contents ($requestName.'/home.html' , $p2 . "					" . $categs . "\n", FILE_APPEND );	
	
	//p3 - menu part 2 + header part 1
	$p3 = file_get_contents('../pageFiller/' . $tpl . '/3.part', 'r+');
	$cleantext = str_replace("&quot;", "\"", $sections[0]);
	$p3 = str_replace("IDTOREPLACE", "1", $p3);
	$content = "	<p class=\"large\">" . $cleantext . "</p>";
	file_put_contents ($requestName.'/home.html' , $p3 . $content, FILE_APPEND );	
	
	//p4 - header part 2
	$p4 = file_get_contents('../pageFiller/' . $tpl . '/4.part', 'r+');
	file_put_contents ($requestName.'/home.html' , $p4, FILE_APPEND );
	
	//builds the sections
	$cptSec = 1;	//to check if we are odd or even
	$cptTitre = 0;
	foreach( $sections as $s ) {
		//$cleantext = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($s)); 
		//$cleantext = html_entity_decode($cleantext,null,'UTF-8');
		$cleantext = str_replace("&quot;", "\"", $s);
		if ( $cptSec > 1 ) {
			if ( $cptSec % 2 == 0 ) {
				$p5 = file_get_contents('../pageFiller/' . $tpl . '/5.part', 'r+');
				$p5 = str_replace("IDTOREPLACE", $cptSec, $p5);
				$content = "	<p class=\"large\">" . $cleantext . "</p>";		
				//replaces the title
				$p5 = str_replace("<h2>currentTitle-toBeReplaced</h2>","<h2>" . $menu[$cptTitre] . "</h2>",$p5 );
				file_put_contents ($requestName.'/home.html' , $p5 . $content, FILE_APPEND );		

				//p6 - section oddPart part 2
				$p6 = file_get_contents('../pageFiller/' . $tpl . '/6.part', 'r+');
				file_put_contents ($requestName.'/home.html' , $p6, FILE_APPEND );	
			}
			else {
				//p7 - section evenPart part 1
				$p7 = file_get_contents('../pageFiller/' . $tpl . '/7.part', 'r+');
				$p7 = str_replace("IDTOREPLACE", $cptSec, $p7);
				$content = "	<p class=\"large\">" . $cleantext . "</p>";
				//replaces the title
				$p7 = str_replace("<h2>currentTitle-toBeReplaced</h2>","<h2>" . $menu[$cptTitre] . "</h2>",$p7);
				file_put_contents ($requestName.'/home.html' , $p7 . $content, FILE_APPEND );	
				
				//p8 - section evenPart part 2
				$p8 = file_get_contents('../pageFiller/' . $tpl . '/8.part', 'r+');
				file_put_contents ($requestName.'/home.html' , $p8, FILE_APPEND );
			}
		}
		$cptSec ++;
		$cptTitre ++;
	}

	//p9 - writes the bottom
	$p9 = file_get_contents('../pageFiller/' . $tpl . '/9.part', 'r+');
	file_put_contents ($requestName.'/home.html' , $p9 , FILE_APPEND );	

	//integrates the images
	$str=file_get_contents($requestName.'/home.html');
	$str=str_replace("./temp/temp-user", "./images",$str);
	file_put_contents($requestName.'/home.html', $str);
	
}

//***UTIL***
//copies a directory to another
function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
}

// deletes a directory, empty or not
function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        //throw new InvalidArgumentException("$dirPath must be a directory");
    }
    else {
		if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
			$dirPath .= '/';
		}
		$files = glob($dirPath . '*', GLOB_MARK);
		foreach ($files as $file) {
			if (is_dir($file)) {
				deleteDir($file);
			} else {
				unlink($file);
			}
		}
		rmdir($dirPath);
	}
}

?>