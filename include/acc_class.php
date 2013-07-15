<?php

	require_once("login_class.php");
	
	class Account
	{
		function __construct()
		{
			// ...
		}

		function addAccount($username, $pass, $name, $email, $address, $tel)
		{
			$log = new Login();
			$passHashed = $log->makePassHash($pass);

			$db = new Database();

			$stmt = $db->db_connectie->prepare("INSERT INTO account (gebruikersnaam, wachtwoord, naam, email, adres, telefoon) values (?, ?, ?, ?, ?, ?)");
			$stmt->bind_param('ssssss', $username, $passHashed, $name, $email, $address, $tel);
			$result = $stmt->execute();

			$stmt->close();
			$db->close();

			return $result;
		}

		function accountExists($username) {
			$db = new Database();

			if($stmt = $db->db_connectie->prepare("SELECT COUNT(*) FROM account WHERE gebruikersnaam = ?")) {
				$stmt->bind_param('s', $username);
				$stmt->execute();
				$stmt->bind_result($result);
				$stmt->fetch();
				$stmt->close();

				$db->close();
			}
			return $result;
		}

		function chgPw($accid = "", $opw = "", $npw = "")
		{
			if(empty($opw) || empty($npw) || empty($accid)) return false;

			$log = new Login();

			$usr = $log->getUser($accid);

			if(!($log->verifyLogin($usr,$opw))) {
				return false;
			}

			$pwHashed = $log->makePassHash($npw);

			$db = new Database();

			$stmt = $db->db_connectie->prepare("UPDATE account SET wachtwoord = ? WHERE id = ?");
			$stmt->bind_param('si', $pwHashed, $accid);
			$changedPw = $stmt->execute();
			$stmt->close();

			$db->close();

			return $changedPw;
		}
	}
?>
