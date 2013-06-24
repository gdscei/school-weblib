<?php

	require_once("login_class.php");
	
	class Account
	{
		function __construct()
		{
			// ...
		}
		
		function chgPw($accid = "", $opw = "", $npw = "")
		{
			if(empty($opw) || empty($npw) || empty($accid)) return false;

			$log = new Login();

			$usr = $log->getUser($accid);

			if(!($log->verifyLogin($usr, $opw)))
			{
				return false;
			}

			$pwHashed = $log->makePassHash($npw);

			$db = new Database();

			$stmt = $db->prepare("UPDATE account SET wachtwoord = ? WHERE id = ?");
			$stmt->bind_param('si', $pwHashed, $accid);
			$changedPw = $stmt->execute();
			$stmt->close();

			$db->close();

			return $changedPw;
		}
	}

?>
