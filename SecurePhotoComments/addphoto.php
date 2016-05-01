<?php
session_start();
include("connection.php"); //Establishing connection with our database

$msg = ""; //Variable for storing our errors.
if(isset($_POST["submit"]))
{
    $title = $_POST["title"];
    $desc = $_POST["desc"];
    $url = "test";
    $name = $_SESSION["username"];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $uploadOk = 1;


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

  /*
                        //$timestamp = time();
                        //$target_file = $target_file.$timestamp;
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                            $id = $row['userID'];
                            $addsql = "INSERT INTO photos (title, description, postDate, url, userID) VALUES ('$title','$desc',now(),'$target_file','$id')";
                            $query = mysqli_query($db, $addsql) or die(mysqli_error($db));
                            if ($query) {
                                $msg = "Thank You! The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded. click <a href='photos.php'>here</a> to go back";
                            }

                        } else {
                            $msg = "Sorry, there was an error uploading your file.";
                        }
                        //echo $name." ".$email." ".$password;

*/
                        var_dump($title);
                        var_dump($desc);
                        $postDate = time();
                        $postDate = strtotime($postDate);
                        var_dump($postDate);
                        var_dump($url);
                        var_dump($id);

                        /* Create the prepared statement */
                        if ($query = $db->prepare("INSERT INTO photos (title, description, postDate = now(), url, userID) values (?, ?, ?, ?, ?)")) {

                            /* Bind our params */
                            $query->bind_param('sssi', $title, $desc, $url,$id);


                            /* Execute the prepared Statement */
                            $query->execute();

                            echo "Inserted {$title},{$desc},{$postDate},{$url},{$id} into database\n";

                            $msg = "Thank You! The Tile " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded. click <a href='photos.php'>here</a> to go back";

                            /* Close the statement */
                            $query->close();
                        }
                        else {
                            /* Error */
                            $msg = "Sorry, there was an error uploading your file.";

                        }

                        /* close statement and connection */

                        mysqli_stmt_close($stmt);


                        /* close connection */
                        mysqli_close($db);

                    }
                }
                else
                {
                    $msg = "You need to login first";
                }
}

?>