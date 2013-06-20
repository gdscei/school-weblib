<?php

	require_once("login_class.php");
	
	function perscheck()
	{
		if(!$_SESSION['log-uid'] || empty($_SESSION['log-uid']))
		{
			return "Niet ingelogd";
		}
		
		$db = new Database();
		
		$stmt = $db->db_connectie->prepare("SELECT type FROM account WHERE id = ?");
		$stmt->bind_param('i', $_SESSION['log-uid']);
		$stmt->execute();
		$stmt->bind_result($res);
		$stmt->fetch();
		$stmt->close();
		
		$db->close();
		
		if($res == 1)
		{
			return "Personeel";
		}
		else
		{
			return "Klant";
		}
	}
?>