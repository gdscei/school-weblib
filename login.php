<?PHP
	//error_reporting(E_ALL);
	//ini_set("display_errors", 1);
	require_once("includes.php");
	
	$log = new Login();
	if($log->check()) header('Location: index.php');
	
	if(isset($_POST['req_inlog']))
	{	
		$return = $log->login($_POST['u'],$_POST['w']);
		
		switch($return)
		{
			case 0:
			case 1:
				header('Location: index.php');
				break;
			case 2:
				$error = "No username / password was entered.";
				break;
			case 3:
				$error = "Wrong username / password.";
				break;
			default:
				$error = "An unknown error has occurred.";
				break;
		}
	}
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Weblibrary Kenia</title>
		<link rel="stylesheet" href="home.css" type="text/css">
	</head>

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
			<?PHP
				require_once("includes.php");
				$log = new Login();
				$log->displayMenu();
			?>
		</div>

		<div id="content">
			<?php
				if(!empty($error))
				{
					echo "<font color='red'>".$error."</font>";
				}
			?>
			<p>Please login by filling in your details below:</p>

			<form action="login.php" method="post">
				Username: <input type="text" name="u" /><br />
				Password: <input type="password" name="w" /><br />

				<div id="login_buttons">
					<input type="submit" value="Login" name="req_inlog" required/>
					<input type="reset" value="Reset" required/>
				</div>
			</form>
		</div>
	</body>
</html>
