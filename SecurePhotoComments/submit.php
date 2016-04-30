<?php
$msg = "";
if(isset($_POST["submit"])) {
    // Sanitise username input
    $user = $_POST['username'];
    $user = stripslashes($user);
    $user = mysqli_real_escape_string($db, $user);

    // Sanitise email input
    $email = $_POST["email"];
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
        //                        print 'Success! The user query ran OK';
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

        $query = $db->stmt_init();
        $query = mysqli_prepare($db, "INSERT INTO users VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($query, 'sss', $user, $email, $pass);

        /* execute prepared statement */
//        mysqli_stmt_execute($stmt);
        $query->execute();

        if ($query) {
            print 'Success! The user insert ran OK';
        } else {
            print 'Error : (' . $db->errno . ') ' . $db->error;
        }

        $msg = "Thank You! you are now registered. click <a href='index.php'>here</a> to login";

        /* close statement and connection */
        mysqli_stmt_close($stmt);
        mysqli_stmt_close($query);


        /* close connection */
        mysqli_close($db);

    }
}

?>