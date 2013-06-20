<?php

	require_once("include/functions.php");

	$log = new Login();
	$log->logout();
	
	header('Location: index.php');

?>