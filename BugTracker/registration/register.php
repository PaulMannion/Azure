<?php

	include("connection.php");
	include("submit.php");

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registration Form</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<form method="post" action="">
		<fieldset>
		<legend>Registration Form</legend>
			<table width="100" border="0" cellpadding="10" cellspacing="10">
				<tr>
					<td colspan="2" align="center" class="error"><?php echo $msg;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold">
							<div align="right"><label for="name">Username</label></div>
					</td>
					<td>
							<input name="name" type="text" class="input" size="25" required />
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold">
							<div align="right">
									<label for="email">Email</label>
							</div>
					</td>
					<td>
							<input name="email" type="email" class="input" size="25" required />
					</td>
				</tr>
				<tr>
					<td height="23" style="font-weight: bold">
							<div align="right">
								<label for="password">Password</label>
							</div>
					</td>
					<td>
							<input name="password" type="password" class="input" size="25" required />
					</td>
				</tr>
				<tr>
					<td height="23" style="font-weight: bold">
						<div align="right">
							<label for="phone">Phone</label>
						</div>
					</td>
					<td>
						<input name="phone" type="tel" class="input" size="11" required />
					</td>
				</tr>
				<tr>
					<td height="23"></td>
					<td>
						<div align="right">
				  		<input type="submit" name="submit" value="Register!" />
						</form>
						<form name="form" method="POST" action="/BugTracker/login/index.php">
						<input type="submit" value="Cancel"style="background-color:#0066FF!important">
						</form>
						</div>
					</td>
				</tr>
			</table>
		</fieldset>
	</form>
</body>
</html>
