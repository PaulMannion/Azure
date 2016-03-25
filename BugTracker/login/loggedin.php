<?php
	include("check.php");
	include("connection.php");
	include("submit.php");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home</title>
	<!--	<link type="text/css" rel="stylesheet" href="assets/css/custom.css"/> -->
        <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

<header>
	<div align="center">
	<h1>My Bug Tracker Website</h1>
	</div>
	<h1 class="hello">Hello, <em><?php echo $login_user;?>!</em></h1>

<div align="left">
	<form name="form" method="POST" action="logout.php">
		<input type="submit" value="Logout">
	</form>
</div>

	<form method="post" action="/BugTracker/addBugReport/submit.php">
		<fieldset>
			<legend align="right">Submit A Bug Report</legend>
			<table width="400" border="0" cellpadding="10" cellspacing="10" align="center">
				<tr>
					<td colspan="2" align="center" class="error"><?php echo $msg;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold">
						<div align="center"><label for="bugTitle">Bug Title</label></div>
					</td>
					<td>
						<input name="bugTitle" type="text" class="input" size="25" required />
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold">
						<div align="center"><label for="bugDesc">Bug Description</label></div>
					</td>
					<td>
						<input name="bugDesc" type="text" class="input" size="50" required />
					</td>
				</tr>
				<tr>
					<td height="23"></td>
					<td>
						<div align="center">
							<input type="submit" name="submit" value="Submit New Bug!" />
						</div>
					</td>
				</tr>
			</table>
		</fieldset>
	</form>

</header>

<main>

	<h3>Too add a <b>comment</b> or <b>attachment</b> click on the link in the respective column.</h3>

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
			<th>Attachments</th>
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
				
				//display all the bugs

				echo "<TD>$bugTitle</TD>";
				echo "<td>$bugDesc</td>";
				echo "<td>$userName</td>";
				echo "<td>$bugPost</td>";
				if (empty($bugFix)) {
					echo "<td>Not Fixed</td>";
				} else {
					echo "<td>$bugFix</td>";
				}

				// if a bug is not fixed and the current user matches bug owner's username then offer to 'Flag as Fixed'

				if (($bugFixed == 0) and ($login_user == $userName)){
				//	echo "<td>Flag to fix</td>";

					?>
					
					<td><form name="form" method="POST" action="/BugTracker/showBugs/flagFixed.php">
							<input value="<?php echo $bugID;?>" type="hidden" name="id">
							<input value="<?php echo $bugTitle;?>" type="hidden" name="title">
							<input type="submit" value="Flag as Fixed">
						</form></td>
					
					<?php
				}
				else if ($bugFixed == 0) {  // This bug belongs to someone else and is not fixed so display "No"
					echo "<td>No</td>";
				}
				else
					{
					echo "<td>Yes</td>";  // The bug must be fixed so display "Yes"
					}

				// if user in table is an admin and bug is fixed but not approved, display 'Approve' button. Else display nothing
				
				if ($bugAuth == 1) {
						echo "<td>Approved</td>";
						} else {
							if ($login_rights == 1 and $bugFixed == 1) {            
								?>

								<td>
									<form name="form" method="POST" action="/BugTracker/admin/bugApproved.php">
										<input value="<?php echo $bugID; ?>" type="hidden" name="id">
										<input value="<?php echo $bugTitle; ?>" type="hidden" name="title">
										<input value="<?php echo $userName; ?>" type="hidden" name="name">
										<input type="submit" value="Approve Fix"style="background-color:#0066FF!important">
									</form>
								</td>

								<?php
								} else {
								echo "<td></td>";
							}
	//							echo "<td></td>";
						}

				
				// Display the number of comments against each bug as a link to showComments.php
				
				if ($results = mysqli_query($db, "SELECT commentID FROM comments WHERE bugID=$bugID")) {

					// determine number of rows result set //
					$row_cntC = mysqli_num_rows($results);

					echo "<td><a href='/BugTracker/showBugs/showComments.php?id=$bugID.&title=$bugTitle'>".$row_cntC."</a></TD>";

					// close result set //
					mysqli_free_result($results);
				}

				// Display the number of attachments against each bug as a link to showAttachments.php
				
				if ($results = mysqli_query($db, "SELECT attachmentID FROM attachments WHERE bugID=$bugID")) {

					// determine number of rows result set //
					$row_cntA = mysqli_num_rows($results);

					echo "<td><a href='/BugTracker/showBugs/showAttachments.php?id=$bugID.&title=$bugTitle'>".$row_cntA."</a></TD>";

					// close result set //
					mysqli_free_result($results);
				}

				echo "</tr>\n";
			}

	?>
		</tr>

	</table>
	
	
	<?php
	
	// Admin Users Section: Only Display if current user is flagged as an admin

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
				
				// Display all the users

				echo "<TD>$userName</TD>";
				echo "<td>$userMail</td>";
				echo "<td>$userPhone</td>";
				echo "<td>$userJoin</td>";
				
				//If user in the table is an admin, display 'Remove Admin' button else display 'Make Admin' button.
				 
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

				//If user in the table is authorised, display 'Approved' else display 'Approve' button.
				
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
	<p align="center">(c) 2016 1506100 Paul Mannion</p>
</footer>

</body>
</html>