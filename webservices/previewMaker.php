<?php
//$_SESSION['login'] = "user";
session_start();
/*This webservice previews the website for the user by delivering him a protected code*/

	// First deletes the previous preview
	deleteDir( "../preview/preview-" . strtolower($_SESSION['login']) );

	//retieves the parameters
	$tpl = $_POST['tpl'];
	$title = $_POST['title'];
	
	$menu = json_decode(stripslashes($_POST['menu']));
	$sections = json_decode(stripslashes($_POST['sections']));
	
	//***step 1 - creates the request folder***

	$requestTime =  date('m/d/Y h:i:s a', time());
	$requestTime = str_replace('/', '_', $requestTime);
	$requestTime = str_replace(':', '_', $requestTime);
	$requestTime = str_replace(' ', '_', $requestTime);

	$requestParent = '../preview/preview-' . strtolower($_SESSION['login']);
	deleteDir($requestParent);
	mkdir($requestParent);

	$requestName = '../preview/preview-' . strtolower($_SESSION['login'] . "/" . $requestTime) ;
	deleteDir($requestName);
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
	$pathImages = "../temp/temp-" . strtolower($_SESSION['login']);
	if (file_exists( $pathImages )) {
		recurse_copy($pathImages, $requestName . "/images");
	}

	//***step 3 - adapts the source code to the request***
	fill_tpl($tpl, $requestName, $title, $menu, $sections );
		
	$requestName = substr($requestName,strrpos($requestName,'./') );
	//$requestName = './' . $requestName;
	
	echo $requestName . '/home.html';
	
	

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
	
	$str = obfuscator( $str );
	file_put_contents($requestName.'/home.html', $str);
	
}

/*Converts the html previewed by the user to a protected one line obfuscated code, by deleting the breaks*/
function obfuscator( $output ) {
	$output = str_replace(array("\r\n", "\r"), "\n", $output);
	$lines = explode("\n", $output);
	$new_lines = array();

	foreach ($lines as $i => $line) {
		if(!empty($line))
			$new_lines[] = trim($line);
	}
	return implode($new_lines);
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