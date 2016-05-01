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

    echo "desc as input = {$desc}";

    // Sanitise description
    $func_desc = xecho($_POST['desc']);

    $desc = stripslashes($desc);
//    $desc = mysqli_real_escape_string($db, $desc);

//    echo "desc after basic clean = {$desc}";

//    $desc = htmlspecialchars($desc, ENT_QUOTES);

//    echo "desc after html special = {$desc}";



    echo "desc after func clean = {$func_desc}";

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

    $stmt->store_result();

    if ($stmt->num_rows == 1) //check a user was found
    {

        if ($stmt->fetch()) {

            var_dump($desc);
            var_dump($id);
            var_dump($photoID);
            var_dump($name);

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
                printf("Prepared Statement Error: %s\n", $mysqli->error);

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

