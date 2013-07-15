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
			<p>On this page you can lend an asset to a patron.</p>

			<form action="lendasset.php" method="post">
				<table>
					<tr>
						<td>Patron:</td>
						<td><input type="text" name="patron" required/></td>
					</tr>
					<tr>
						<td>Asset:</td>
						<td><input type="text" name="asset" required/></td>
					</tr>
					<tr>
						<td>Date to return:</td>
						<td><input type="date" name="datereturn" value="<?PHP echo date("Y-m-d"); ?>" min="<?PHP echo date("Y-m-d"); ?>" required/></td>
					</tr>
					<tr>
						<td></td>
						<td><a href="index.php"><input type="button" value="Cancel" /></a><input type="submit" value="Lend" name="lendasset"/></td>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>