<?php
	include("check.php");	
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home</title>
<link rel="stylesheet" href="style.css" type="text/css" />
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
	//$fields_num = mysqli_num_fields($result);

	echo "<h1>Table: Bugs</h1>";
	echo "<table border='1'><tr>";
	// printing table headers
	/*for($i=0; $i<$fields_num; $i++)
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
*/
	?>


	<table id="bugs">
		<tr>
			<th>Bug Title</th>
			<th>Bug Description</th>
			<th>Date Posted</th>
			<th>Date Fixed</th>
			<th>Fixed (Y or N)</th>
		</tr>
		<tr>

	<?php
			while($row = mysqli_fetch_assoc($result))
			{
				$bugTitle = $row['title'];
				$bugDesc = $row['bugDesc'];
				$bugPost = $row['postDate'];
				$bugFix = $row['fixDate'];
				$bugFixed = $row['fixed'];

				echo "<td>$bugTitle</td>";
				echo "<td>$bugDesc</td>";
				echo "<td>$bugPost</td>";
					if (empty($bugFix)) {
						echo "<td>Not Fixed</td>";
					} else {
				echo "<td>$bugFix</td>";
				}
					if ($bugFixed == 0) {
				echo "<td>No</td>";
				} else {
						echo "<td>Yes</td>";
					}
			echo "</tr>\n";
		}

	?>
		</tr>

	</table>

</main>

<footer>
	<p>(c) 2016 1506100 Paul Mannion</p>
</footer>

</body>
</html>