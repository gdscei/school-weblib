<?php

	require_once("includes.php");

	$log = new Login();
	$log->logout();
	
	header('Location: index.php');

?>