<?php

//$_SESSION['login'] = "user";
session_start();

/*This webservice uploads an image from the UI to a temp directory*/

// first checks if the temp directory for this current user already exists
$tempDir = "../temp/temp-" . $_SESSION['login'];
$imageLink = "./temp/temp-" . $_SESSION['login'];
if ( !file_exists ( $tempDir ) ) {
	mkdir($tempDir);
}

// upload the image in appropriate directory
// note that the request parameter name of image being uploaded is "imageName"
//move_uploaded_file($_FILES["imageName"]["tmp_name"], "newsImages/" . $_FILES["imageName"]["name"]);
if(isset($_FILES["imageName"]["type"])) {
	$validextensions = array("jpeg", "jpg", "png");
	$temporary = explode(".", $_FILES["imageName"]["name"]);
	$file_extension = end($temporary);
	if ((($_FILES["imageName"]["type"] == "image/png") || ($_FILES["imageName"]["type"] == "image/jpg") || ($_FILES["imageName"]["type"] == "image/jpeg")) && ($_FILES["imageName"]["size"] < 100000) && in_array($file_extension, $validextensions)) { //Approx. 100kb files can be uploaded.
		if ($_FILES["imageName"]["error"] > 0) {
			echo "Return Code: " . $_FILES["imageName"]["error"] . "<br/><br/>";
		}
		else {
			if (file_exists("../" . $_FILES["imageName"]["name"])) {
				echo $_FILES["imageName"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
			}
			else {
				$sourcePath = $_FILES["imageName"]['tmp_name']; // Storing source path of the file in a variable
				$targetPath = $tempDir . "/" . $_FILES["imageName"]['name']; // Target path where file is to be stored
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
			}
		}

		// return the complete path (absolute/relative) of uploaded image in response
		echo "<div id=\"image\">" . $imageLink . "/" . $_FILES["imageName"]["name"] . "</div>";
	}
}

?>