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
		<legend>New Bug Submission</legend>
			<table width="400" border="0" cellpadding="10" cellspacing="10" align="center">
				<tr>
					<td colspan="2" align="center" class="error"><?php echo $msg;?></td>
				</tr>
				<tr>
					<td style="font-weight: bold">
							<div align="right"><label for="bugTitle">Bug Title</label></div>
					</td>
					<td>
							<input name="bugTitle" type="text" class="input" size="25" required />
					</td>
				</tr>
				<tr>
					<td style="font-weight: bold">
						<div align="right"><label for="bugDesc">Bug Description</label></div>
					</td>
					<td>
						<input name="bugDesc" type="text" class="input" size="25" required />
					</td>
				</tr>
				<tr>
					<td height="23"></td>
					<td>
						<div align="right">
				  		<input type="submit" name="submit" value="Submit New Bug!" />
						</div>
					</td>
				</tr>
				<tr>
					<td height="23"></td>
					<td>
						<div align="left">
							<<a href='/BugTracker/index.html'>"Go Home"</a>>
						</div>
					</td>
				</tr>
			</table>
		</fieldset>
	</form>
</body>
</html>
