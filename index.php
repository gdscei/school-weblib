<?php

	require_once("includes.php");

	$log = new Login();
	if(!$log->check()) header('Location: login.php');

?>
<html>
	<head>
	<title>Ingelogd</title>
	</head>
	<body>
		<a href="logout.php">Logout</a>
	</body>
</html>