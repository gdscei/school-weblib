<?php

	require_once("includes.php");
	
	$log = new Login();
	if($log->check()) header('Location: cpanel.php');
	
	if($_POST['req_inlog'])
	{
		
		$return = $log->login($_POST['u'],$_POST['w']);
		
		switch($return)
		{
			case 0:
				header('Location: index.php');
				break;
			case 1:
				header('Location: index.php');
				break;
			case 2:
				echo "Geen gebruikersnaam/wachtwoord ingevuld";
				break;
			case 3:
				echo "Verkeerd gebruikersnaam/wachtwoord";
				break;
			default:
				echo "Er is een fout opgetreden";
				break;
		}
	}
?>
<html>
<head>
</head>
<body>
<form action="login.php" method="post">
	<input type="text" name="u" /><br />
	<input type="password" name="w" /><br />
	<input type="submit" value="Inloggen" name="req_inlog" />
</form>
</body>
</html>