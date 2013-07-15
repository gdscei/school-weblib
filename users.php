<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Weblibrary Kenia</title>
		<link rel="stylesheet" href="home.css" type="text/css">

		<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

	  <script>
	  $(function() {
	  	<?PHP
	  		require_once("include/db_class.php");

			$db = new Database();

			// prepare statement
			$stmt = $db->db_connectie->prepare("SELECT naam FROM account");
			$stmt->execute();
			$stmt->bind_result($name);

			// create auto-complete array
		 	$string = 'var availableTags = [';

			while($stmt->fetch()) {
				$string .= "'$name'" . ',';
			}

			// close connection and statement
			$stmt->close();
			$db->close();

			// output the array
			$string = substr_replace($string ,"",-1); // remove last ',' from string
			echo $string . '];';
	    ?>

	    $( "#tags" ).autocomplete({
	      source: availableTags
	    });
	  });
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
				require_once("includes.php");
				$log = new Login();
				$log->displayMenu();
			?>
		</div>

		<div id="content">
			<p>You can view a user by entering (a part of) his real name below.</p>

			<form action="users.php" method="post">
				<label for="tags">Real name: </label>
				<input id="tags" name="realname"/>
				<input type="submit" name="getdetails" value="View details"/>
			</form>

			<?PHP
				if(isset($_POST['getdetails'])) {
					echo 'Showing details for user ' . $_POST['realname'];
				}
			?>
		</div>
	</body>
</html>