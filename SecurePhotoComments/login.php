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
            date_default_timezone_set('Europe/London');
            $total_failed_login = 3;
            $lockout_time = 5;
            $account_locked = false;

            // Check the database (Check user information)
            // Create a prepared statement //
            // The following code only executes if a correct user is entered

            $stmt = $db->stmt_init();
            if ($stmt->prepare("SELECT failed_login, last_login FROM users WHERE username =?")) {

                /* bind parameters for markers */
                $stmt->bind_param('s', $user);

                /* execute query */
                $stmt->execute();

                if ($stmt) {
                    print 'Success! we found a user!';
                } else {
                    print 'Error : (' . $db->errno . ') ' . $db->error;
                }




                /* bind variables to prepared statement */
                $stmt->bind_result($failed_login, $last_login);

                $stmt->store_result();
                if ($stmt->num_rows == 1) //check a user was found
                {

                    echo "<p>This should only print if you've entered a correct username</p>";
                    /* fetch values */
  //                               while ($stmt->fetch()) {
  //                                    printf("%s %s %s\n", $failed_login, $last_login, $try_login);
  //                                }

                    // Check if user has had max number of login attempts
/*                    echo"<p>failed logins:</p>";
                    var_dump($failed_login);
                    echo"<p>total_failed_login:</p>";
                    var_dump($total_failed_login);
                    echo"<p>last login:</p>";
                    var_dump($last_login);
*/
                    if ($failed_login >= $total_failed_login) {
                        // User is locked out

 /*                       echo"<p>failed logins:</p>";
                        var_dump($failed_login);
                        echo"<p>total_failed_login:</p>";
                        var_dump($total_failed_login);
                        echo"<p>last login:</p>";
                        var_dump($last_login);
*/
                        echo "<p>This should only print if failed logins >=3</p>";

                        $error = "This account has been locked due to too many incorrect logins.";

                        // Calculate when the user would be allowed to login again
                        $last_login = strtotime($last_login);
                        $try_login = strtotime($try_login);
                        // $timeout = ($last_login + $lockout_time);
                        $timeout = strtotime("+{$lockout_time} minutes", strtotime($try_login));
                        // $timeout = strtotime("{$last_login} +{$lockout_time} minutes");
                        $timenow = strtotime("now");
                        $unlock_time = ($timenow + $timeout);


                        echo "<p> This is the timenow: </p>" . date('D, d M Y H:i:s', $timenow);
                        echo "<p> This is the value of timenow: </p>" . $timenow;
                        echo "<p> This is the unlock time </p>" . date('D, d M Y H:i:s', $unlock_time);
                        echo "<p> this is the value of unlock_time: </p>" . $unlock_time;
                        echo "<p> timenow - unlock_time=" . ($timenow-$unlock_time);
                        echo "<p> Last attempted login (try_login): </p>" . date('D, d M Y H:i:s', $try_login);

                        echo "<p> Last successful login: </p>" . date('D, d M Y H:i:s', $last_login);




 //                          $last_login = new DateTime(date('h:i:s'));

 //                       echo $last_login->format('h:i:s');
                        //    $last_login->modify('+15 minutes');
                        //   echo $last_login->format('h:i:s');

                        //   echo "<p>timeout var dump: </p>";
                        //   var_dump($timeout);
                        //   echo "<p> 'Timeout' is: </p>".date('D, d M Y H:i:s', $timeout);
                        //   echo "<p>timenow var dump: </p>";
                        //   echo "<p> 'timenow' is: </p>".date('D, d M Y H:i:s', $timenow);
                        //   echo "<p>unlock_time var dump: </p>";
                        //   echo "Account will be available after: ".date('D, d M Y H:i:s', $unlock_time);

                        // Check to see if enough time has passed, $timenow is > $timeout so unlock account, else lock account and display feedback
                        if ( $unlock_time > $timenow) {
                            echo "<p> trying to unlock -> Is it unlocked?: </p>" . ($account_locked);
                            $account_locked = false;

                        } else {
                            $account_locked = true;
                            echo "<p> trying to lock -> Is it locked?: </p>" . ($account_locked);

                            echo "<p> Account will be available after: </p>" . date('D, d M Y H:i:s', $unlock_time);
                            echo "<p> Last successful login: </p>" . date('D, d M Y H:i:s', $last_login);

                            //   var_dump($account_locked);
                        }
                    }else {
                        echo "<p>wtf!</p>";

                        $error = "Incorrect username or password.";

                        echo "<pre><br />This part means you are a user who entered an incorrect password <em>{$failed_login}</em> but not more than max.</pre>";

                        //increase the failed_login count

                        $stmt = $db->stmt_init();
                        $stmt = $db->prepare('UPDATE users SET failed_login=failed_login+1 WHERE username=?');
                        $stmt->bind_param('s', $user);
                        $stmt->execute();

                        if ($stmt) {
                            print 'Success! failed_login increased by 1 due to incorrect user/password';
                        } else {
                            print 'Error : (' . $db->errno . ') ' . $db->error;
                        }
                    }
                } else {

                    $error = "Incorrect username or password. (both)";

                    /* close statement */
                    $stmt->close();
                }


                //  echo "<p>(This will be printed in any case) Number of login attempts: <em>{$failed_login}</em>.<br />Last login attempt was at: {$last_login}</em>.</p>";


                // Check the database (if username matches the password)

                $query = $db->stmt_init();
                $query = $db->prepare("SELECT username, password, last_login, failed_login FROM users where username=? AND password=?");
                $query->bind_param('ss', $user, $pass);
                $query->execute();


                if ($query) {
                    print 'Success! we found a user matching those details';
                } else {
                    print 'Error : (' . $db->errno . ') ' . $db->error;
                }

                echo "<p> Is account locked?: </p>" . ($account_locked);

                $query->bind_result($username, $password, $last_login, $failed_login);
                $query->store_result();
                if ($query->num_rows == 1) //check a user was found
                {

                    echo "<p>This should only print if you've entered a correct username AND password</p>";

                    if ($query->fetch()) // fetch contents of row
                    {
                        if ($account_locked == false) {

                            // Had the account been locked out since last login?
                            if ($failed_login >= $total_failed_login) {
                                echo '<script type="text/javascript">alert("hello!");</script>';
                                echo "<p><em>Warning</em>: Someone might of been brute forcing your account.</p>";
                                echo "<p>Number of login attempts: <em>{$failed_login}</em>.<br />Last login attempt was at: <em>${last_login}</em>.</p>";
                            }

                            // Reset bad login count
                            $query = $db->prepare('UPDATE users SET failed_login = 0 WHERE username=?');
                            $query->bind_param('s', $user);
                            $query->execute();

                            if ($query) {
                                print 'Success! Bad login reset';
                            } else {
                                print 'Login Reset Error : (' . $db->errno . ') ' . $db->error;
                            }

                            // Login successful
                            $_SESSION['username'] = $user; // Initializing Session
                            header("location: photos.php"); // Redirecting To Other Page


                        } else {
                            // Login failed due to account lock
                            sleep(rand(2, 4));

                            // Give the user some feedback

                            $error = "The account has been locked because of too many failed logins. Please try again later";

                            // Update bad login count

                            $failed_login = ($failed_login + 1); // increase the number of failed login variable
                            echo "<br>";
                            var_dump($failed_login);
                            $query = $db->prepare('UPDATE users SET failed_login = failed_login+1 WHERE username=?');
                            $query->bind_param('s', $user);
                            $query->execute();

                            if ($query) {
                                print 'Success! Failed_login increased by 1 (due to account lock)';
                            } else {
                                print 'Login Increase Error : (' . $db->errno . ') ' . $db->error;
                            }
                        }

                        // Set the last login time (only if the account is no longer locked)

                        if ($account_locked == false) {
                            $query = $db->prepare('UPDATE users SET last_login= now() WHERE username=?');
                            $query->bind_param('s', $user);
                            $query->execute();


                            if ($query) {
                                print 'Success! last_login time was reset ';
                            } else {
                                print 'Login_time was not set ;-( Error : (' . $db->errno . ') ' . $db->error;
                            }
                        } else echo "<p> This should print if the login details were correct but account is still locked</p>";
                    }

                    $query->close();

                }

                // $error = "Incorrect username or password.";

                $db->close();

            }

        }
    }
/*
		// Generate Anti-CSRF token
		//generateSessionToken();
	}
*/
?>
