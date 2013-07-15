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
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque dignissim eros turpis, quis fringilla dolor euismod cursus. Vestibulum aliquam massa tortor, a aliquam neque venenatis id. Mauris dignissim accumsan dui, in fringilla metus sodales eu. Nullam purus risus, iaculis vel condimentum laoreet, congue id arcu. Sed sed volutpat nunc. Nunc feugiat vestibulum ipsum. Donec vestibulum mi dolor, quis malesuada diam accumsan non.
Suspendisse hendrerit massa ac mauris sollicitudin, id ultricies nisl mattis. Duis sed vulputate eros, nec imperdiet urna. Nam in rhoncus mi. Vivamus luctus mi vitae nulla scelerisque, vitae adipiscing libero molestie. Aliquam erat volutpat. Fusce vestibulum lectus magna, in gravida ligula tristique non. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur mollis diam vitae augue fringilla dapibus. Donec tincidunt, purus vel consequat ullamcorper, ante nibh sollicitudin odio, id rhoncus ligula quam sit amet erat. Mauris ut fringilla neque. Vestibulum arcu libero, iaculis quis adipiscing vel, lobortis a libero. Donec accumsan eget justo vel molestie. Suspendisse scelerisque velit felis, quis fermentum dolor pretium sed.
		</div>
	</body>
</html>