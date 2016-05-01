<?php
session_start();
include("connection.php"); //Establishing connection with our database

$msg = ""; //Variable for storing our errors.
if(isset($_POST["submit"]))
{
    //xss mitigation
    function xssafe($data,$encoding='UTF-8')
    {
        return htmlspecialchars($data,ENT_QUOTES | ENT_HTML401,$encoding);
    }
    function xecho($data)
    {
        echo xssafe($data);
    }

    // Sanitise description
    $desc = $_POST['desc'];
    $desc = xssafe($desc);
    
    // Sanitise photoID
    $photoID = $_POST["photoID"];
    $photoID = xssafe($photoID);

    $name = $_SESSION["username"];
    $postDate = time();
    


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

    $stmt->store_result();

    if ($stmt->num_rows == 1) //check a user was found
    {

        if ($stmt->fetch()) {

            /* Create the prepared statement */

            if ($query = $db->prepare("INSERT INTO comments (description, postDate, userID, photoID) values (?, now(), ?, ?)")) {

                /* Bind our params */
                $query->bind_param('sii', $desc, $id, $photoID);


                /* Execute the prepared Statement */
                if ($query->execute())

                echo "Inserted {$desc},{$id},{$photoID} into database\n";

                $msg = "Thank You! comment added. click <a href='photo.php?id=".$photoID."'>here</a> to go back";

                /* Close the statement */
                $query->close();
            } else {
                /* Error */
                printf("Prepared Statement Error: %s\n", $db->error);

            }

        }


    }

    else{
        $msg = "You need to login first";
        }

    /* close statement and connection */

    mysqli_stmt_close($stmt);


    /* close connection */
    mysqli_close($db);
}

?>

