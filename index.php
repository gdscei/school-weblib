<?php

	require_once("includes.php");

	$log = new Login();
	if(!$log->check()) header('Location: login.php');
	
	echo "U bent ingelogd!";

?>