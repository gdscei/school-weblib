<?PHP

	/*
		Deze configuratie stelt de database gegevens in als constante 
		variabelen die overal gebruikt kunnen worden.
	*/
	if(!defined('DB_USERNAME'))	
		define('DB_USERNAME', 'weblib');

	if(!defined('DB_PASSWORD'))
		define('DB_PASSWORD', 'kenialib');

	if(!defined('DB_HOSTNAME'))	
		define('DB_HOSTNAME', 'localhost');
		
	if(!defined('DB_DATABASE'))	
		define('DB_DATABASE', 'alab_bib');
?>