<?php
$resultText = "";
if(isset($_POST["submit"]))
{
    // sanitise username
    $user = $_POST['username'];
    $user = stripslashes($user);
    $user = mysqli_real_escape_string($db, $user);


    // check username with prepared statement
    $stmt = $db->stmt_init();
    $stmt->prepare("SELECT userID FROM users WHERE username =?");

    /* bind parameters for markers */
    $stmt->bind_param('s', $user);

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

                        // Create a prepared statement //
                        // Get the photos for the entered user

                        $query = $db->stmt_init();
                        $query->prepare("SELECT title, photoID FROM photos WHERE userID =?");

                        /* bind parameters for markers */
                        $query->bind_param('i', $id);

                        /* execute query */
                        $query->execute();

                        if ($query) {
                            print 'Success! The username query ran OK';
                        } else {
                            print 'Error : (' . $db->errno . ') ' . $db->error;
                        }

                        /* bind variables to prepared statement */
                        $query->bind_result($title, $photoID);

                        $query->store_result();

                        if ($query->num_rows == 1) //check a photo was found
                        {
                            /* fetch values */

                            while ($query->fetch()) { // fetch contents of row

                                $line = "<p><a href='photo.php?id=" .
                                    $photoID . "'>" . $title . "</a></p>";
                                $resultText = $resultText . $line;
                            }
                        } else {
                            $resultText = "no photos by user";
                        }

                    }
                }
                else
                {
                    $resultText = "no user with that username";
            
                }
}
?>