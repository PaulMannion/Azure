<?php
	session_start();
	include("connection.php"); //Establishing connection with our database
	
	$error = ""; //Variable for storing our errors.
	if(isset($_POST["submit"]))
	{
		if(empty($_POST["username"]) || empty($_POST["password"]))
		{
			$error = "Both fields are required.";
		}else
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


			//Check username and password from database
			$sql="SELECT approved FROM users WHERE username='$username' and password='$password' limit 1";
			$userApproved=mysqli_query($sql);
			//$userApproved=mysqli_fetch_object($result);

			echo "<script type='text/javascript'>alert('$userApproved')</script>";
			//Check user has been approved before allowing entry

	/*		if ($userApproved == 1)
			{
				echo "$userApproved";
				$_SESSION['username'] = $username; // Initializing Session
				header("location: loggedin.php"); // Redirecting To Other Page
			}else
			{
				echo "$userApproved";
				//header("location: /BugTracker/registration/nonapproved.html"); // Redirecting To Awaiting Approval Page
			}

			//Check username and password from database
			$sql="SELECT userID FROM users WHERE username='$username' and password='$password'";
			$result=mysqli_query($db,$sql);
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC) ;
			
			//If username and password exist in our database then create a session.
			//Otherwise echo error.

			if(mysqli_num_rows($result) == 1)
			{
				$_SESSION['username'] = $username; // Initializing Session
				header("location: loggedin.php"); // Redirecting To Other Page
			}else
			{
				$error = "Incorrect username or password.";
			}
	*/
		}
	}

?>