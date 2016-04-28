<?php
/*
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


			
			//Check username and password from database
			$sql="SELECT userID FROM users WHERE username='$username' and password='$password'";
			$result=mysqli_query($db,$sql);
			$row=mysqli_fetch_array($result,MYSQLI_ASSOC) ;
			
			//If username and password exist in our database then create a session.
			//Otherwise echo error.
			
			if(mysqli_num_rows($result) == 1)
			{
				$_SESSION['username'] = $username; // Initializing Session
				header("location: photos.php"); // Redirecting To Other Page
			}else
			{
				$error = "Incorrect username or password.";
			}

		}
	}
*/
?>


<?php
	//display error
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

	session_start();
	include("connection.php"); //Establishing connection with our database

	$error = ""; //Variable for storing our errors.


	if(isset($_POST["submit"])) {
        if (empty($_POST["username"]) || empty($_POST["password"])) {
            $error = "Both fields are required.";
        } else {
            // Check Anti-CSRF token
            //checkToken($_REQUEST['user_token'], $_SESSION['session_token'], 'index.php');

            // Sanitise username input
            $user = $_POST['username'];
            $user = stripslashes($user);
            $user = mysqli_real_escape_string($db, $user);

            echo "<p>Has username been cleaned? <em>{$user}</em></p>";

            // Sanitise password input
            $pass = $_POST['password'];
            $pass = stripslashes($pass);
            $pass = mysqli_real_escape_string($db, $pass);

            echo "<p>Has password been cleaned? <em>{$pass}</em></p>";

         //   $pass = md5($pass);

         //   echo "<p>Has password been hashed? <em>{$pass}</em></p>";

            // Default values
            $total_failed_login = 3;
            $lockout_time = 15;
            $account_locked = false;

            // Check the database (Check user information)
            // Create a prepared statement //
            // The following code only executes if a correct user is entered but wrong password

            $stmt = $db->stmt_init();
            if ($stmt->prepare("SELECT failed_login, last_login FROM users WHERE username =?")) {

                /* bind parameters for markers */
                $stmt->bind_param('s', $user);

                /* execute query */
                $stmt->execute();

                /* bind variables to prepared statement */
                $stmt->bind_result($failed_login, $last_login);

                /* fetch values */
                while ($stmt->fetch()) {
                    printf("%s %s\n", $failed_login, $last_login);
                }

                // Check if user has had max number of login attempts

                if ($failed_login >= $total_failed_login) {
                    // User is locked out
                    echo "<pre><br />This account has been locked due to too many incorrect logins.</pre>";

                    // Calculate when the user would be allowed to login again
                    $last_login = strtotime($last_login);
                    $timeout = strtotime("{$last_login} +{$lockout_time} minutes");
                    $timenow = strtotime("now");

                    var_dump($timeout);
                    var_dump($timenow);

                    // Check to see if enough time has passed, if it hasn't locked the account
                    if ($timenow > $timeout)
                        $account_locked = true;

                    echo "<p>(timeout={$timeout} timenow= {$timenow} This will only appear if user attempts is greater thane etc Number of login attempts: <em>{$failed_login}</em>.<br />Last login attempt was at: <em>${last_login}</em>.</p>";
                }

                echo "<pre><br />This part means you are a user who entered an incorrect password <em>{$failed_login}</em> but not more than max.</pre>";

                //increase the failed_login count

                $stmt = $db->stmt_init();
                $stmt = $db->prepare('UPDATE users SET failed_login=failed_login+1 WHERE username=?');
                $stmt->bind_param('s', $user);
                $stmt->execute();

                if($stmt){
                    print 'Success! failed_login increased by 1';
                }else{
                    print 'Error : ('. $db->errno .') '. $db->error;
                }

                /* close statement */
                $stmt->close();
            }


            echo "<p>(This will be printed in any case) Number of login attempts: <em>{$failed_login}</em>.<br />Last login attempt was at: <em>${last_login}</em>.</p>";

            /*
                        $data = $db->prepare('SELECT failed_login, last_login FROM users WHERE username = (:user) LIMIT 1;');
                        var_dump($data);
                        $data->bind_Param(':user', $user, PDO::PARAM_STR);  //PDO is a pain in the arse
                        $data->execute();
                        $row = $data->fetch();
                        echo "<p><em>Warning</em>: WE got as far fetching data.</p>";
                        // Check to see if the user has been locked out.
                        if (($data->rowCount() == 1) && ($row['failed_login'] >= $total_failed_login)) {   // no rowcount method in mysql - fix connection.php as per lecture slides creating stored proc
                            // User locked out.  Note, using this method would allow for user enumeration!
                            //echo "<pre><br />This account has been locked due to too many incorrect logins.</pre>";

                            // Calculate when the user would be allowed to login again
                            $last_login = $row['last_login'];
                            $last_login = strtotime($last_login);
                            $timeout = strtotime("{$last_login} +{$lockout_time} minutes");
                            $timenow = strtotime("now");

                            // Check to see if enough time has passed, if it hasn't locked the account
                            if ($timenow > $timeout)
                                $account_locked = true;
                        }
            */
            // Check the database (if username matches the password)

            $query = $db->stmt_init();
            $query = $db->prepare("SELECT username, password, last_login, failed_login FROM users where username=? AND password=?");
            $query->bind_param('ss', $user, $pass);
            $query->execute();
            $query->bind_result($username, $password, $last_login, $failed_login);
            $query->store_result();
            if ($query->num_rows == 1) //check a user was found
            {
                if ($query->fetch()) // fetch contents of row
                {
                    if ($account_locked == false) {
                        // Login successful
                        $_SESSION['username'] = $user; // Initializing Session
                        header("location: photos.php"); // Redirecting To Other Page

                        // Had the account been locked out since last login?
                        if ($failed_login >= $total_failed_login) {
                            echo "<p><em>Warning</em>: Someone might of been brute forcing your account.</p>";
                            echo "<p>Number of login attempts: <em>{$failed_login}</em>.<br />Last login attempt was at: <em>${last_login}</em>.</p>";
                        }

                        // Reset bad login count
                        $query = $db->prepare('UPDATE users SET failed_login = 0 WHERE username=?');
                        $query->bind_param('s', $user);
                        $query->execute();

                        if($query){
                            print 'Success! Bad login reset';
                        }else{
                            print 'Login Reset Error : ('. $db->errno .') '. $db->error;
                        }


                    } else {
                        // Login failed
                        sleep(rand(2, 4));

                        // Give the user some feedback

                        $error = "The account has been locked because of too many failed logins. Please try again in {$lockout_time} minutes";

                        // Update bad login count
                        var_dump($failed_login);
                        var_dump($user);
                        $failed_login=($failed_login + 1); // increase the number of failed login variable
                        var_dump($failed_login);
                        $query = $db->prepare('UPDATE users SET failed_login = failed_login+1 WHERE username=?');
                        $query->bind_param('s', $user);
                        $query->execute();

                        if($query){
                            print 'Success! Failed_login increased by 1 ';
                        }else{
                            print 'Login Increase Error : ('. $db->errno .') '. $db->error;
                        }
                    }

                    // Set the last login time

                    $query = $db->prepare('UPDATE users SET last_login= TIME() WHERE username=?');
                    $query->bind_param('s', $user);
                    $query->execute();


                    if($query){
                        print 'Success! last_login time was set ';
                    }else{
                        print 'Login_time was not set ;-( Error : ('. $db->errno .') '. $db->error;
                    }
                }

                $query->close();
            }

            $error = "Incorrect username or password.";
            
            $db->close();
            
            
            
            
            
        }

    }









/*			$data = $db->prepare('SELECT * FROM users WHERE user = (:user) AND password = (:password) LIMIT 1;');
			$data->bindParam(':user', $user, PDO::PARAM_STR);
			$data->bindParam(':password', $pass, PDO::PARAM_STR);
			$data->execute();
			$row = $data->fetch();

			// If its a valid login...
			if (($data->rowCount() == 1) && ($account_locked == false)) {
				// Get users details
				$avatar = $row['avatar'];
				$failed_login = $row['failed_login'];
				$last_login = $row['last_login'];

				// Login successful
				$_SESSION['username'] = $user; // Initializing Session
				header("location: photos.php"); // Redirecting To Other Page

				// Had the account been locked out since last login?
				if ($failed_login >= $total_failed_login) {
					echo "<p><em>Warning</em>: Someone might of been brute forcing your account.</p>";
					echo "<p>Number of login attempts: <em>{$failed_login}</em>.<br />Last login attempt was at: <em>${last_login}</em>.</p>";
				}

				// Reset bad login count
				$data = $db->prepare('UPDATE users SET failed_login = "0" WHERE user = (:user) LIMIT 1;');
				$data->bindParam(':user', $user, PDO::PARAM_STR);
				$data->execute();
			} else {
				// Login failed
				sleep(rand(2, 4));

				// Give the user some feedback
				$error = "<pre><br />Username and/or password incorrect.<br /><br/>Alternative, the account has been locked because of too many failed logins.<br />If this is the case, <em>please try again in {$lockout_time} minutes</em>.</pre>";

				// Update bad login count
				$data = $db->prepare('UPDATE users SET failed_login = (failed_login + 1) WHERE user = (:user) LIMIT 1;');
				$data->bindParam(':user', $user, PDO::PARAM_STR);
				$data->execute();
			}

			// Set the last login time
			$data = $db->prepare('UPDATE users SET last_login = now() WHERE user = (:user) LIMIT 1;');
			$data->bindParam(':user', $user, PDO::PARAM_STR);
			$data->execute();
		}

		// Generate Anti-CSRF token
		//generateSessionToken();
	}
*/
?>
