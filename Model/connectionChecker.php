<?php

	if (isset($_POST['login']) && isset($_POST['password']))
	{
		try
		{
				$hoteBD = 'mysql51-103.perso';
				$nomBD = 'thibautbvitrine';
				$userBD = 'thibautbvitrine';
				$passBD = 'edKQfY9X7tzy';

		        $db = new PDO('mysql:host='.$hoteBD.';dbname='.$nomBD, $userBD, $passBD);

		        unset($passBD);
		}
		catch(Exception $e)
		{
		        echo 'Erreur de connexion à la BDD : '.$e->getMessage().'<br />';
		        echo 'N° : '.$e->getCode();
		}
	
		$login = htmlspecialchars($_POST['login']);
		$pass = hash("SHA512", $_POST['password']);

		$query = $db->query("SELECT pass FROM hc_user WHERE login = " . $db->quote($login, PDO::PARAM_STR));
		$user = $query->fetch(PDO::FETCH_OBJ);

		if ($user->pass == $pass)
		{
			// connexion OK
			$_SESSION['login'] = $login;
		}
		else
		{
			// mot de passe erroné
			echo 'Mot de passe incorrect.<br />';
		}

		$query->closeCursor(); // fermeture des résultats

		//echo $_POST['login'] . ' / ' . $_POST['password'] . ' <br />';
	}

?>