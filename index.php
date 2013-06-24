<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Weblibrary Kenia</title>
		<link rel="stylesheet" href="home.css" type="text/css">
	</head>

<<<<<<< HEAD
	<body>
		<header>
			<div id="logo">
				<img src='images/banner.jpg' alt='banner'/>
			</div>

			<div id="navbar">
				<a href="index.php" id="nav_button_active">Home</a>
				<a href="browse.php" class="nav_button_inactive">Browse</a>
			</div>
		</header>

		<!-- control panel on the left side -->
		<div id="usercp">
			<a href="index.php" class="usercp_button_inactive">Login</a>
			<a href="index.php" class="usercp_button_inactive">Register</a>
		</div>
=======
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
>>>>>>> fa5779a589a35360436c582035f4a87c47e12f8a
	</body>
</html>