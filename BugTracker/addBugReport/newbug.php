<?php

	include("connection.php");
	include("submit.php");
	include("check.php");

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Log a new bug </title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<form method="post" action="">
		<fieldset>
		<legend>New Bug Form</legend>
			<table width="400" border="0" cellpadding="10" cellspacing="10">
				<tr>
					<td colspan="2" align="center" class="error"><?php echo $msg;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold">
							<div align="right"><label for="name">Bug Title</label></div>
					</td>
					<td>
							<input name="title" type="text" class="input" size="25" required />
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold">
						<div align="right"><label for="name">Bug Description</label></div>
					</td>
					<td style="font-weight: bold">
						<textarea name="comment" rows="5" cols="40" required ></textarea>
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold">

					</td>
				</tr>
				<tr>
					<td height="23"></td>
					<td>
						<div align="right">
				  		<input type="submit" name="submit" value="Register!" />
						</div>
					</td>
				</tr>
			</table>
		</fieldset>
	</form>
</body>
</html>
