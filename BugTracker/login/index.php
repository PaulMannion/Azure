<?php
	include('login.php'); // Include Login Script

	if ((isset($_SESSION['username']) != '')) 
	{
		header('Location: loggedin.php');
	}	
?>

<html lang="en">
<head>
    <link href="http://fonts.googleapis.com/css?family=Corben:bold" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Nobile" rel="stylesheet" type="text/css">

    <link type="text/css" rel="stylesheet" href="style.css"/>

    <meta charset="UTF-8">
    <title>Login</title>


</head>
<body>
<div align="center">
<header>
    <h1>A Bug Tracker Website</h1>

</header>

<main>

<div class="loginBox">
    <h3>Login</h3>
    <br><br>
    <form method="post" action="">
        <label>Username:</label><br>
        <input type="text" name="username" placeholder="username" /><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" placeholder="password" />  <br><br>
        <input type="submit" name="submit" value="Login" />
        <br><label><a href="registration/register.php">Register</a></label><br>
    </form>
    <div class="error"><?php echo $error;?></div>
</div>
</div>
</main>

<footer>
    <p align="center">(c) 2016 Paul Mannion 1506100</p>
</footer>

</body>
</html>

