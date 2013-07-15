<?php
	if(isset($_POST['oldpw'], $_POST['newpw'], $_POST['newpw_confirm'])) 
	{
		require_once("includes.php");
	
		$pass_ex = '/ ^
			    (?=(?:.*?[A-Za-z]){6})  # minimum of 6 letters.
			    (?=(?:.*?[0-9]){2})     # minimum of 2 numbers.
			    [A-Za-z0-9#,.\-_]{8,}  # Match minimum of 8 characters.
			    $                       # Anchor to end of string.
			    /x';

		if($_POST['newpw_confirm'] != $_POST['newpw']) {
			$note = "<font color='red'>Confirm password is not the same as the other password.</font>";
		} else if($_POST['newpw'] == $_POST['oldpw']) {
			$note = "<font color='red'>Your new password cannot be the same as the old one.</font>";
		} else if(empty($_POST['newpw'])) {
			$note = "<font color='red'>New password cannot be empty!</font>";
		} else if(empty($_POST['oldpw'])) {
			$note = "<font color='red'>Old password cannot be empty!</font>";
		} else if (!preg_match($pass_ex, $_POST['newpw']) || !preg_match($pass_ex, $_POST['newpw_confirm'])) { // check if password contains 6 characters and 2 digits
			$error = 'Your password does not contain 6 letters and 2 digits!';
		} else {
			$acc = new Account();
			session_start();

			$res = $acc->chgPw($_SESSION['log-uid'], $_POST['oldpw'], $_POST['newpw']);
			$note = $res ? "<font color='green'>Password changed!</font>" : "<font color='red'>Your password could not be changed because the old password is incorrect!</font>";
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
			<p>You can change your password by filling out the fields below.</p>

			<?php 
				if(isset($note)) {
					echo  $note . "<br>";
				}
			?>
			<form action="account.php" method="post">
				Old password: <input type="password" name="oldpw" /><br>
				New password: <input type="password" name="newpw" /><br>
				New password (confirm): <input type="password" name="newpw_confirm" /><br>
				<input type="reset" value="Reset"/><input type="submit" value="Change password"/>
			</form>
		</div>
	</body>
</html>