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
		<em></em><?php echo $login_rights;?>!</em>
		<li><a href="/BugTracker/admin/users.php">Admin Users</a></li>
		</ul>
	</nav>
</header>

<main>
	<h2>Welcome to my Bug Tracker!</h2>
	<p>Here is a list of all the bugs:</p>

	<?php
	$sql = "SELECT * FROM bugs";
	$result=mysqli_query($db,$sql);

	?>

	<table id="bugs">
		<tr>
			<th>Bug Title</th>
			<th>Bug Description</th>
			<th>Date Posted</th>
			<th>Date Fixed</th>
			<th>Fixed? (Y or N)</th>
			<th>Admin Approved?</th>
		</tr>
		<tr>

	<?php
			while($row = mysqli_fetch_assoc($result)) {
				$bugTitle = $row['title'];
				$bugDesc = $row['bugDesc'];
				$bugPost = $row['postDate'];
				$bugFix = $row['fixDate'];
				$bugFixed = $row['fixed'];
				$bugAuth = $row['isFixed'];

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
					if ($bugAuth == 1) {
						echo "<td>Approved</td>";
						} else {
						echo "<td></td>";
						}

				echo "</tr>\n";
			}

	?>
		</tr>

	</table>

	<?php

	if ($login_rights == 1) {

	echo "<p><h2>Administrate Users:</h2></p>";

	$sql = "SELECT * FROM users";
	$result = mysqli_query($db, $sql);

	?>

	<table id="bugs">
		<tr>
			<th>Username</th>
			<th>email address</th>
			<th>Phone</th>
			<th>Date Joined</th>
			<th>Authorised</th>
			<th>Administrator</th>
		</tr>
		<tr>

			<?php
			while ($row = mysqli_fetch_assoc($result)) {
				$userName = $row['username'];
				$userMail = $row['email'];
				$userPhone = $row['phone'];
				$userJoin = $row['joined'];
				$userAuth = $row['approved'];
				$userAdm = $row['admin'];

				echo "<td>$userName</td>";
				echo "<td>$userMail</td>";
				echo "<td>$userPhone</td>";
				echo "<td>$userJoin</td>";
				if ($userAuth == 1) {
					echo "<td>Authorised</td>";
				} else {
					echo "<td></td>";
				}
				if ($userAdm == 1) {
					echo "<td>Administrator</td>";
				} else {
					echo "<td></td>";
				}

				echo "</tr>\n";
			}

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