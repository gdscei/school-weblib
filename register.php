<?PHP
	//error_reporting(E_ALL);
	//ini_set("display_errors", 1);
	require_once("includes.php");

	$log = new Login();
	if($log->check()) header('Location: index.php');

	function validField($fieldName)
	{
		if(!isset($_POST[$fieldName]) || empty($_POST[$fieldName]))
			return false;

		return true;
	}

	$pass_ex = '/ ^
			    (?=(?:.*?[A-Za-z]){6})  # minimum of 6 letters.
			    (?=(?:.*?[0-9]){2})     # minimum of 2 numbers.
			    [A-Za-z0-9#,.\-_]{8,}  # Match minimum of 8 characters.
			    $                       # Anchor to end of string.
			    /x';

	if(isset($_POST['req_register'])) {
		// Check if fields are not empty and sent to the server
		if(!validField('pass')) {
			$error = 'The password field cannot be left blank!';
		} else if(!validField('realname')) {
			$error = 'The real name field cannot be left blank!';
		} else if(!validField('email')) {
			$error = 'The e-mail address field cannot be left blank!';
		} else if(!validField('address')) {
			$error = 'The address field cannot be left blank!';
		} else if(!validField('phonenumber')) {
			$error = 'The phone number field cannot be left blank!';
		}
		if(!isset($error)) { // error occurred?
			// Phone number checks
			if(!is_numeric($_POST['phonenumber'])) { // check if phone number only contains digits
				$error = 'Your phone number can only contain numeric characters!';
			} else if(strlen($_POST['phonenumber']) > 10) { // check if phone number has the correct size
				$error = 'Your phone number can only be 10 digits long!';
			}

			// Email checks
			else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$error = 'The email address you entered is not valid!';
			}

			// Password checks
			else if (!preg_match($pass_ex, $_POST['pass'])) { // check if password contains 6 characters and 2 digits
				$error = 'Your password does not contain 6 letters and 2 digits!';
			}

			// Add user
			if(!isset($error)) {
				$acc = new Account();

				if($acc->accountExists($_POST['user'])) {
					$error = 'Account already exists!';
				} else {
					$res = $acc->addAccount($_POST['user'], $_POST['pass'], $_POST['realname'], $_POST['email'], $_POST['address'], $_POST['phonenumber']);
					$error = $res ? 'Registration succesful!' : 'An error occurred while registering your account!';
				}
			}
		}
	}
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Weblibrary Kenia</title>
		<link rel="stylesheet" href="home.css" type="text/css">

		<script>
			function CheckFields()
			{
				var pass = document.getElementById('pass');
				var reg = /^(?=(?:.*?[A-Za-z]){6})(?=(?:.*?[0-9]){2})[A-Za-z0-9#,.\-_]{8,}$/;

				if(!pass.value.match(reg)) {
					alert('Pass does not meet the regex');
					return false;
				}
			}
		</script>
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
				$log->displayMenu();
			?>
		</div>

		<div id="content">
			<?PHP
				if(!empty($error)) {
					echo "<font color='red'>" . $error . "</font>";
				}
			?>
			<p>Please register by filling in your details below:</p>

			<form action="register.php" method="post" onsubmit="return CheckFields();">
			<table>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="user" required/></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" id="pass" name="pass" required/></td>
				</tr>
				<tr>
					<td>Real name:</td>
					<td><input type="text" name="realname" required/></td>
				</tr>
				<tr>
					<td>E-mail address:</td>
					<td><input type="email" name="email" required/></td>
				</tr>
				<tr>
					<td>Address:</td>
					<td><input type="text" name="address" required/></td>
				</tr>
				<tr>
					<td>Phone number:</td>
					<td><input type="text" name="phonenumber" maxlength="10" required/></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="reset" value="Reset" /> <input type="submit" value="Register" name="req_register"/></td>
				</tr>
			</table>
			</form>
		</div>
	</body>
</html>
