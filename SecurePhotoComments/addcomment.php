<?php
session_start();
include("connection.php"); //Establishing connection with our database

$msg = ""; //Variable for storing our errors.
if(isset($_POST["submit"]))
{

    // Sanitise description
    $desc = $_POST['desc'];
    $desc = stripslashes($desc);
    $desc = mysqli_real_escape_string($db, $desc);

    // Sanitise photoID
    $photoID = $_POST["photoID"];
    $photoID = stripslashes($photoID);
    $photoID = mysqli_real_escape_string($db, $photoID);

    $name = $_SESSION["username"];
    $postDate = now();

    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT userID FROM users WHERE username =?");

    /* bind parameters for markers */
    $stmt->bind_param('s', $name);

    /* execute query */
    $stmt->execute();

    if ($stmt) {
        //                        print 'Success! The user query ran OK';
    } else {
        print 'Error : (' . $db->errno . ') ' . $db->error;
    }

    /* bind variables to prepared statement */
    $stmt->bind_result($id);

    $stmt->store_result();

    if ($stmt->num_rows == 1) //check a user was found
    {
        $stmt = mysqli_prepare($db, "INSERT INTO comments VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, 'ssii', $desc, $postDate, $photoID, $id);

        /* execute prepared statement */
        mysqli_stmt_execute($stmt);

        $msg = "Thank You! comment added. click <a href='photo.php?id=\".$photoID.\"'>here</a> to go back";

        /* close statement and connection */
        mysqli_stmt_close($stmt);


        /* close connection */
        mysqli_close($link);

    }

    else{
        $msg = "You need to login first";
        }

}

?>

