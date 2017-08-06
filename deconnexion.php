<?php
// déconnexion                                                                

session_start();

if (isset($_SESSION['login']))
{
	session_unset(); // on détruit les variables de session
	session_destroy(); // on détruit la session
	header("Location: index.php"); // on redirige vers la page d'accueil
}

?>