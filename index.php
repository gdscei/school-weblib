<?php

	require_once("include/functions.php");

	$log = new Login();
	if(!$log->check()) header('Location: login.php');
	
	echo "U bent ingelogd!";

?>