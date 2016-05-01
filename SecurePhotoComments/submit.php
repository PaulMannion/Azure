<?php
$msg = "";
if(isset($_POST["submit"])) {
    // Sanitise username input
    $user = $_POST['username'];
    $user = stripslashes($user);
    $user = mysqli_real_escape_string($db, $user);

    // Check & Sanitise email input
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    if ($email === false) {
        // Not a valid email address! Handle this invalid input here.
        echo "<script>alert('Not a valid email address, please try again');
        window.location.href='photos.php';
        </script>";
    }
    $email = stripslashes($email);
    $email = mysqli_real_escape_string($db, $email);


    // Sanitise password input
    $password = $_POST["password"];
    $pass = $_POST['password'];
    $pass = stripslashes($pass);
    $pass = mysqli_real_escape_string($db, $pass);


    //   $pass = md5($pass);

    echo "<p>Has username been cleaned? <em>{$user}</em></p>";
    echo "<p>Has email been cleaned? <em>{$email}</em></p>";
    echo "<p>Has password been cleaned? <em>{$pass}</em></p>";


    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT email FROM users WHERE email =?");

    /* bind parameters for markers */
    $stmt->bind_param('s', $email);

    /* execute query */
    $stmt->execute();

    if ($stmt) {
        print 'Success! The user query ran OK';
    } else {
        print 'Error : (' . $db->errno . ') ' . $db->error;
    }

    /* bind variables to prepared statement */
    $stmt->bind_result($email);

    $stmt->store_result();

    if ($stmt->num_rows == 1) //check a user was found
    {
        $msg = "Sorry...This email already exists...";
    } else {

        var_dump($user);
        var_dump($email);
        var_dump($pass);

        /* Create the prepared statement */
        if ($query = $db->prepare("INSERT INTO users (username, password, email) values (?, ?, ?)")) {

            /* Bind our params */
            $query->bind_param('sss', $user, $pass, $email);


            /* Execute the prepared Statement */
            $query->execute();

            echo "Inserted {$user},{$pass},{$email} into database\n";

            $msg = "Thank You! you are now registered. click <a href='index.php'>here</a> to login";

            /* Close the statement */
            $query->close();
        }
        else {
            /* Error */
            printf("Prepared Statement Error: %s\n", $mysqli->error);

        }


        /* close statement and connection */

        mysqli_stmt_close($stmt);


        /* close connection */
        mysqli_close($db);

    }
}

?>