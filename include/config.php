<?PHP

	/*
		Deze configuratie stelt de database gegevens in als constante 
		variabelen die overal gebruikt kunnen worden.
	*/
	
	$db_user = "weblib"; // Database gebruikersnaam
	$db_pw = "kenialib"; // Database wachtwoord
	$db_host = "localhost"; // Database hostnaam
	$db_db = "kenialib"; // Database

	/*
		De volgende variabelen zijn voor de verschillende hash-functies. 
		Let op, als er al een hash wordt gebruikt in de database zullen deze daar ook moeten worden aangepast!
	*/
	
	$hash_salt1 = "JKOGg8Kg._"; 
	$hash_salt2 = "KOG9gg8+_";
	
	$token_salt1 = "AkdkoG95_";
	$token_salt2 = "qOAka08915.._";
	$token_salt3 = "kogakogJG_-0";
	$token_salt4 = "KKOGgao9_";
	$token_salt5 = "OKg,g.aj91_";
	
	// Dit gedeelte hoeft niet aangepast te worden
	if(!defined('DB_USERNAME'))	
		define('DB_USERNAME', $db_user);

	if(!defined('DB_PASSWORD'))
		define('DB_PASSWORD', $db_pw);

	if(!defined('DB_HOSTNAME'))	
		define('DB_HOSTNAME', $db_host);
		
	if(!defined('DB_DATABASE'))	
		define('DB_DATABASE', $db_db);
		
	if(!defined('HASH_SALT1'))
		define('HASH_SALT1', $hash_salt1);
		
	if(!defined('HASH_SALT2'))
		define('HASH_SALT2', $hash_salt2);
		
	if(!defined('TOKEN_SALT1'))
		define('TOKEN_SALT1', $token_salt1);
		
	if(!defined('TOKEN_SALT2'))
		define('TOKEN_SALT2', $token_salt2);
		
	if(!defined('TOKEN_SALT3'))
		define('TOKEN_SALT3', $token_salt3);
		
	if(!defined('TOKEN_SALT4'))
		define('TOKEN_SALT4', $token_salt4);
	
	if(!defined('TOKEN_SALT5'))
		define('TOKEN_SALT5', $token_salt5);
?>
