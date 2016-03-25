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

    <nav>
        <ul>
            <li><a href="index.html">Home Page</a></li>
            <li><a href="login/index.php">Login</a></li>
            <li><a href="registration/register.php">Register</a></li>
        </ul>
    </nav>
</header>

<main>
    <h2>Welcome to my Bug Tracker!</h2>
    <p>This website is used to keep track of all of my bugs</p>


<div class="loginBox">
    <h3>Login Form</h3>
    <br><br>
    <form method="post" action="">
        <label>Username:</label><br>
        <input type="text" name="username" placeholder="username" /><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" placeholder="password" />  <br><br>
        <input type="submit" name="submit" value="Login" /> 
    </form>
    <div class="error"><?php echo $error;?></div>
</div>
</div>
</main>

<footer>
    <p>(c) 2016 1506100 Paul Mannion</p>
</footer>

</body>
</html>

