<?php

//$_SESSION['login'] = "user";
session_start();

/*This webservice retrieves the list of all the drafts the user has done*/

// Gets the user's drafts directory
$tempDir = "../drafts/draft-" . $_SESSION['login'];

// Retrieves the list of draft files for the user
if ($handle = opendir($tempDir)) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            echo "<a href=\"javascript:void(0);\" onclick=\"retrieveDraft(this);\" >" . $entry . "</a>" . "<br/>";
        }
    }
    closedir($handle);
}
?>