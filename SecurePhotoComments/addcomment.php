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
    $postDate = time();

    echo "<p>Description: <em>{$desc}</em></p>";
    echo "<p>photoID: <em>{$photoID}</em></p>";
    echo "<p>What is postdate? <em>{$postDate}</em></p>";


    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT userID FROM users WHERE username =?");

    /* bind parameters for markers */
    $stmt->bind_param('s', $name);

    /* execute query */
    $stmt->execute();

    if ($stmt) {
                               print 'Success! The user query ran OK';
    } else {
        print 'Error : (' . $db->errno . ') ' . $db->error;
    }

    /* bind variables to prepared statement */
    $stmt->bind_result($id);
    echo "<p>The user id is  <em>{$id}</em></p>";
    $stmt->store_result();

    echo "<p>The user id is  <em>{$id}</em></p>";

    if ($stmt->num_rows == 1) //check a user was found
    {

        if ($stmt->fetch()) {

            var_dump($desc);
            var_dump($postDate);
            var_dump($id);
            var_dump($photoID);
            var_dump($name);

            /* Create the prepared statement */
            if ($query = $mysqli->prepare("INSERT INTO comments (description, postDate, userID, photoID) values (?, ?, ?, ?)")) {

                /* Bind our params */
                $query->bind_param('siii', $desc, $postDate, $id, $photoID);


                /* Execute the prepared Statement */
                $query->execute();

                echo "Inserted {$desc},{$postDate},{$id},{$photoID} into database\n";

                $msg = "Thank You! you are now registered. click <a href='index.php'>here</a> to login";

                /* Close the statement */
                $query->close();
            } else {
                /* Error */
                printf("Prepared Statement Error: %s\n", $mysqli->error);

            }

        }
        /* close statement and connection */

        mysqli_stmt_close($stmt);


        /* close connection */
        mysqli_close($db);


    }

    else{
        $msg = "You need to login first";
        }

}

?>

