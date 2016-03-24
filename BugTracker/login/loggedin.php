<?php
	include("check.php");
	include("connection.php");
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
	<p>Here is a list of all the bugs:</p>

	<?php
	$sql = "SELECT b.*,u.username FROM bugs b, users u WHERE b.userID=u.userID";
	$result=mysqli_query($db,$sql);


	?>

	<table id="bugs">
		<tr>
			<th>Bug Title</th>
			<th>Bug Description</th>
			<th>Posted By</th>
			<th>Date Posted</th>
			<th>Date Fixed</th>
			<th>Fixed? (Y or N)</th>
			<th>Admin Approved?</th>
			<th>Comments</th>
		</tr>
		<tr>

	<?php
			while($row = mysqli_fetch_assoc($result)) {
				$bugTitle = $row['title'];
				$bugID = $row['bugID'];
				$bugDesc = $row['bugDesc'];
				$bugPost = $row['postDate'];
				$bugFix = $row['fixDate'];
				$bugFixed = $row['fixed'];
				$bugAuth = $row['isFixed'];
				$userName = $row['username'];


				echo "<TD><a href='/BugTracker/showBugs/showBugs.php?id=$bugID'>".$bugTitle."</a></TD>";
				echo "<td>$bugDesc</td>";
				echo "<td>$userName</td>";
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
							if ($login_rights == 1 and $bugFixed == 1) {            // if user is an admin and bug is fixed but not approved, display 'Approve' button. Else display nothing
								?>

								<td>
									<form name="form" method="POST" action="/BugTracker/admin/bugApproved.php">
										<input value="<?php echo $bugID; ?>" type="hidden" name="id">
										<input value="<?php echo $bugTitle; ?>" type="hidden" name="title">
										<input value="<?php echo $userName; ?>" type="hidden" name="name">
										<input type="submit" value="Approve Fix">
									</form>
								</td>

								<?php
								} else {
								echo "<td></td>";
							}
	//							echo "<td></td>";
						}

				if ($results = mysqli_query($db, "SELECT commentID FROM comments WHERE bugID=$bugID")) {

					// determine number of rows result set //
					$row_cnt = mysqli_num_rows($results);

					echo "<td><a href='/BugTracker/showBugs/showComments.php?id=$bugID'>".$row_cnt."</a></TD>";

					// close result set //
					mysqli_free_result($results);
				}


				echo "</tr>\n";
			}

	?>
		</tr>

	</table>

	<?php

	if ($login_rights == 1) {

	echo "<p><h2>Administer Users:</h2></p>";

	$sql = "SELECT * FROM users";
	$result = mysqli_query($db, $sql);

	?>

	<table id="bugs">
		<tr>
			<th>Username</th>
			<th>email address</th>
			<th>Phone</th>
			<th>Date Joined</th>
			<th>Administrator</th>
			<th>Authorised</th>

		</tr>
		<tr>

			<?php
			while ($row = mysqli_fetch_assoc($result)) {
				$userName = $row['username'];
				$userID = $row['userID'];
				$userMail = $row['email'];
				$userPhone = $row['phone'];
				$userJoin = $row['joined'];
				$userAdm = $row['admin'];
				$userAuth = $row['approved'];

				echo "<TD><a href='/BugTracker/admin/users.php?id=$userID'>".$userName."</a></TD>";
				echo "<td>$userMail</td>";
				echo "<td>$userPhone</td>";
				echo "<td>$userJoin</td>";
				if ($userAdm == 1) {
					?>

					<td><form name="form" method="POST" action="/BugTracker/admin/noadm.php">
							<input value="<?php echo $userID;?>" type="hidden" name="id">
							<input value="<?php echo $userName;?>" type="hidden" name="name">
							<input type="submit" value="Remove Admin">
						</form></td>

					<?php

				} else {
					?>

					<td><form name="form" method="POST" action="/BugTracker/admin/adm.php">
						<input value="<?php echo $userID;?>" type="hidden" name="id">
							<input value="<?php echo $userName;?>" type="hidden" name="name">
						<input type="submit" value="Make Admin" style="background-color:#4CAF50!important">
					</form></td>

					<?php
				}
				if ($userAuth == 1) {
					echo "<td>Approved</td>";
				} else {
					?>

					<td><form name="form" method="POST" action="/BugTracker/admin/approved.php">
							<input value="<?php echo $userID;?>" type="hidden" name="id">
							<input value="<?php echo $userName;?>" type="hidden" name="name">
							<input type="submit" value="Approve" style="background-color:#0066FF!important">
						</form></td>

					<?php
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