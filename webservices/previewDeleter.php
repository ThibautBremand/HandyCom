<?php
//$_SESSION['login'] = "user";
session_start();

/*This webservice deletes the preview so the user won't steal the obfuscated code*/

	// Deletes the files that can be stolen
	//if ( file_exists ( "../preview/preview-" . $_SESSION['login'] . "/home.html" ) ) unlink( "../preview/preview-" . $_SESSION['login'] . "/home.html" );
	//if ( file_exists ( "../preview/preview-" . $_SESSION['login'] . "/index.html" ) ) unlink( "../preview/preview-" . $_SESSION['login'] . "/index.html" );
	//if ( file_exists ( "../preview/preview-" . $_SESSION['login'] . "/css" ) ) deleteDir( "../preview/preview-" . $_SESSION['login'] . "/css" );
	
/***UTIL***/
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