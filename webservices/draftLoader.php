<?php
session_start();
//$_SESSION['user'] = "user";

/*This webservice loads a draft for a template*/

// first retrieves the draft's path
$draft = "../drafts/draft-" . $_SESSION['login'] . "/" . $_POST['draftname'];

$draftcontent = file_get_contents($draft, 'r+');
echo $draftcontent ;	
?>