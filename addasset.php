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
			<p>You can add an asset to the library by filling out the form below.</p>

			<form action="addasset.php" method="post">
				<table>
					<tr>
						<td>Asset name:</td>
						<td><input type="text" name="assetname" required/></td>
					</tr>
					<tr>
						<td>ISBN (optional):</td>
						<td><input type="text" name="asset"/></td>
					</tr>
					<tr>
						<td>Author (optional):</td>
						<td><input type="text" name="author"/></td>
					</tr>
					<tr>
						<td></td>
						<td><a href="index.php"><input type="button" value="Cancel" /></a><input type="submit" value="Add asset" name="addasset"/></td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>