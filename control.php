
	<?php
	session_start();
	$_GET['objet'] = (isset($_GET['objet']))?$_GET['objet']:"home";
	$_GET['action'] = (isset($_GET['action']))?$_GET['action']:"loadhome";

	if(isset($_GET['objet']) && is_file("./Control/".$_GET['objet'].".php"))
		{
			require("./Control/".$_GET['objet'].".php");
	
			if(isset($_GET['action']) && function_exists($_GET['action']))
				{
					if ( isset($_GET['tpl']) && isset($_GET['title']) && isset($_GET['menu']) && isset($_GET['s1']) && isset($_GET['s2']) && isset($_GET['s3']) && isset($_GET['s4']) ) {
						$_GET['action']( $_GET['tpl'] , $_GET['title'], $_GET['menu'], $_GET['s1'], $_GET['s2'], $_GET['s3'], $_GET['s4'] );
					}
					else if ( isset($_GET['tpl'] ) ) {
						$_GET['action']( $_GET['tpl'] );
					}
					else {
						$_GET['action']();
					}
				}
			else
				{
					echo "Action invalide";
				}
		}
	?>