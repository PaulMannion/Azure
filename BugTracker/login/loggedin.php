<?php
	include("check.php");	
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home</title>
<link rel="stylesheet" href="/BugTracker/assets/css/style.css" type="text/css" />
</head>
<body>

<header>
	<h1>My Bug Tracker Website</h1>
	<h1 class="hello">Hello, <em><?php echo $login_user;?>!</em></h1>
	<nav>
		<ul>
			<li><a href="logout.php" style="font-size:18px">Logout?</a></li>
			<li><a href="/BugTracker/addBugReport/newbug.php">Submit New Bug Report</a></li>
		</ul>
	</nav>
</header>

<main>
	<h2>Welcome to my Bug Tracker!</h2>
	<p>This website is used to keep track of all of my bugs</p>

	<?php
	$sql = "SELECT title, bugDesc, postDate, fixDate, fixed FROM bugs";
	$result=mysqli_query($db,$sql);
	$fields_num = mysqli_num_fields($result);

	echo "<h1>Table: Bugs</h1>";
	echo "<table border='1'><tr>";
	// printing table headers
	for($i=0; $i<$fields_num; $i++)
	{
		$field = mysqli_fetch_field($result);
		echo "<td>{$field->name}</td>";
	}
	echo "</tr>\n";
	// printing table rows
	while($row = mysqli_fetch_row($result))
	{
		echo "<tr>";

		// $row is array... foreach( .. ) puts every element
		// of $row to $cell variable
		foreach($row as $cell)
			echo "<td>$cell</td>";

		echo "</tr>\n";
	}
	mysqli_free_result($result);
	?>


	<div id="bugContainer">
		<h3>Bug Name 1</h3>
		<img class="TextWrap" src="/BugTracker/assets/images/mug1.png" alt="bug">
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	</div>

	<div id="bugContainer">
		<h3>Bug Name</h3>
		<img src="/BugTracker/assets/images/mug2.png" alt="bug">
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	</div>

	<div id="bugContainer">
		<h3>Bug Name</h3>
		<img src="/BugTracker/assets/images/mug3.png" alt="bug">
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	</div>
</main>

<footer>
	<p>(c) 2016 1506100 Paul Mannion</p>
</footer>

</body>
</html>