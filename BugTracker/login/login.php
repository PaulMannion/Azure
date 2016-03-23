<?php
	session_start();
	include("connection.php"); //Establishing connection with our database
	
	$error = ""; //Variable for storing our errors.
	if(isset($_POST["submit"]))
	{
		if(empty($_POST["username"]) || empty($_POST["password"]))
			{
			$error = "Both fields are required.";
			}
		else
		{
			// Define $username and $password
			$username=$_POST['username'];
			$password=$_POST['password'];

			// To protect from MySQL injection
			$username = stripslashes($username);
			$password = stripslashes($password);
			$username = mysqli_real_escape_string($db, $username);
			$password = mysqli_real_escape_string($db, $password);
			$password = md5($password);
			$userApproved = 5;


			//Check username, password and is approved from database

			$sql="SELECT userID FROM users WHERE username='$username' and password='$password' and approved='1' limit 1";
			$result=mysqli_query($db,$sql);
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

			//If username and password  and approval exist in database then create a session.
			////Otherwise check for username/password error.

			if(mysqli_num_rows($result) == 1)
					{
					$_SESSION['username'] = $username; // Initializing Session
					header("location: loggedin.php"); // Redirecting To Other Page
					}
			else
					{

				//Check username and password from database
				$sql = "SELECT userID FROM users WHERE username='$username' and password='$password'";
				$result = mysqli_query($db, $sql);
				$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

				//If username and password exist in our database then must be awaiting approval --> redirect to "Awaiting Approval" page.
				//Otherwise echo incorrect password/username error.

					if (mysqli_num_rows($result) == 1)
						{
						header("location: /BugTracker/registration/nonapproved.html"); // Redirecting To Awaiting Approval Page
						}
					else
						{
						$error = "Incorrect username or password.";
						}
					}
		}
	}
?>