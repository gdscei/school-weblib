<?php

	require_once("db_class.php");
	
	class Login
	{
		function __construct()
		{
			session_start();
		}
		
		function login($u, $w)
		{
			/* Return codes:
				0 = Al ingelogd
				1 = Ingelogd
				2 = Geen gebruikersnaam/ww ingevuld
				3 = Verkeerd gebruikersnaam/ww
			*/
			if($_SESSION['log-token']) return 0;
			
			if(!$u || empty($u) || !$w || empty($w)) return 2;
			
			if(!$this->verifyLogin($u, $w)) return 3;
			
			$uid = $this->getUID($u);
			
			$wwtoken = $this->makePassToken($this->makePassHash($w));
			$_SESSION['log-wwtoken'] = $wwtoken;
			$_SESSION['log-token'] = $this->makeToken($uid, $wwtoken);
			$_SESSION['log-uid'] = $uid;
			
			return 1;
		}
		
		function verifyLogin($u, $ww)
		{
			$db = new Database();
			
			$stmt = $db->db_connectie->prepare("SELECT wachtwoord FROM account WHERE gebruikersnaam = ?");
			$stmt->bind_param('s', $u);
			$stmt->execute();
			$stmt->bind_result($wwdb);
			$stmt->fetch();
			
			$stmt->close();
			$db->close();
			
			if($this->makePassHash($ww) == $wwdb)
			{
				return true;
			}
			else
			{
				return false;
			}
			
			return true;
		}
		
		function makePassToken($ww)
		{
			$tokww = md5("JKOGg8Kg._".sha1("KOG9gg8+_".$ww));
			return $tokww;
		}
		
		function makePassHash($ww)
		{
			$hash = sha1(md5("KKOGgao9_".$ww)."OKg,g.aj91_");
			return $hash;
		}
		
		function makeToken($uid, $wwtoken)
		{
			$db = new Database();

			$stmt = $db->db_connectie->prepare("SELECT gebruikersnaam FROM account WHERE id = ?");
			$stmt->bind_param('i', $uid);
			$stmt->execute();
			$stmt->bind_result($gebr);
			$stmt->fetch();
		
			$stmt->close();
			$db->close();
		
			if(!$gebr || empty($gebr)) return false;
			
			$token = md5(sha1($gebr."AkdkoG95_".$wwtoken."qOAka08915.._")."kogakogJG_-0");
			return $token;
		}
	
		function verifyToken($token, $uid)
		{
			if(!($mkTokenParam = $this->makeToken($uid))) return false;
			if($mkTokenParam == $token)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		function getUID($u)
		{
			$db = new Database();
			
			$stmt = $db->db_connectie->prepare("SELECT id FROM account WHERE gebruikersnaam = ?");
			$stmt->bind_param('s', $u);
			$stmt->execute();
			$stmt->bind_result($uid);
			$stmt->fetch();
			
			$stmt->close();
			$db->close();
			
			return $uid;
		}
		
		function check()
		{
			if(!$_SESSION['log-uid'] || empty($_SESSION['log-uid']))
			{
				return false;
			}
		
			$db = new Database();
		
			$stmt = $db->db_connectie->prepare("SELECT gebruikersnaam FROM account WHERE id = ?");
			$stmt->bind_param('i', $_SESSION['log-uid']);
			$stmt->execute();
			$stmt->bind_result($gebr);
			$stmt->fetch();
		
			if($gebr && !empty($gebr))
			{
				$stmt->close();
				$db->close();
			
				return true;
			}
			else
			{
				$stmt->close();
				$db->close();
			
				session_destroy();
				$_SESSION = array();
		
				return false;
			}
		}
		
		function logout()
		{
			session_destroy();
			$_SESSION = Array();
		}
	}
?>