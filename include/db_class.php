<?php
require_once("config.php"); // database configuratie laden

class Database 
{
	var $db_connectie = ""; // nog geen connectie gemaakt
	
	function __construct() { // deze wordt aangreoepen als de class wordt aangemaakt
		
		// database connectie maken
		if(!($this->db_connectie = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE)))
		{
			echo "Er kon niet verbonden worden met de database";
		}
	}
	
	function checkdb() {
		return $this->db_connectie->ping();
	}
 
	function query($queryText) { // query uitvoeren waarvan meerdere resultaten zijn
		
		if(!($result = $this->db_connectie->query($queryText)))
		{
			echo "Er is een fout opgetreden tijdens het uitvoeren van een query!<br>Foutmelding: " . $this->db_connectie->error . "<br><br>"; // foutmelding
		}// query uitvoeren
		
		return $result; // resultaat terugsturen
	}
	
	function &queryresult($queryText) { // query uitvoeren waar maar één resultaat van is
	
		echo "Query req: " . $queryText . "<br>";
		$result = $this->db_connectie->query($queryText, MYSQLI_STORE_RESULT);
		
		
	
		return $result;
	}
	
	function close() { // class afsluiten (db verbinding verbreken)
		
		$this->db_connectie->close(); // db verbinding verbreken
	}
}
?>
