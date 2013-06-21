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
			
			$this->makeSession(($this->makePassToken($this->makePassHash($w))), ($this->getUID($u)));
			
			return 1;
		}
		
		function verifyLogin($u, $ww)
		{
			$wwdb = $this->getPw($u);
			
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
		
		function verifyPersonnel()
		{
			if($this->getType($_SESSION['log-uid']) == 1)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		
		function makeSession($wwtoken, $uid)
		{
			$_SESSION['log-wwtoken'] = $wwtoken;
			$_SESSION['log-token'] = $this->makeToken($uid, $wwtoken);
			$_SESSION['log-uid'] = $uid;
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
			$gebr = getUser($uid);
		
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
		
		function getUser($uid)
		{
			$db = new Database();

			$stmt = $db->db_connectie->prepare("SELECT gebruikersnaam FROM account WHERE id = ?");
			$stmt->bind_param('i', $uid);
			$stmt->execute();
			$stmt->bind_result($gebr);
			$stmt->fetch();
		
			$stmt->close();
			$db->close();
			
			return $gebr;
		}
		
		function getPw($gebr)
		{
			$db = new Database();
			
			$stmt = $db->db_connectie->prepare("SELECT wachtwoord FROM account WHERE gebruikersnaam = ?");
			$stmt->bind_param('s', $gebr);
			$stmt->execute();
			$stmt->bind_result($wwdb);
			$stmt->fetch();
			
			$stmt->close();
			$db->close();
			
			return $wwdb;
		}
		
		function getType($uid)
		{
			$db = new Database();
		
			$stmt = $db->db_connectie->prepare("SELECT type FROM account WHERE id = ?");
			$stmt->bind_param('i', $uid);
			$stmt->execute();
			$stmt->bind_result($type);
			$stmt->fetch();
			
			$stmt->close();
			$db->close();
			
			return $type;
		}
		
		function check()
		{
			if(!$_SESSION['log-uid'] || empty($_SESSION['log-uid']))
			{
				return false;
			}
		
			$gebr = $this->getUser($_SESSION['log-uid']);
		
			if($gebr && !empty($gebr))
			{
				return true;
			}
			else
			{
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