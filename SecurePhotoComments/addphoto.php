<?php
session_start();
include("connection.php"); //Establishing connection with our database

$msg = ""; //Variable for storing our errors.
if(isset($_POST["submit"]))
{
    echo "title as input = {$title}";

    //xss mitigation
    function xssafe($title,$encoding='UTF-8')
    {
        return htmlspecialchars($title,ENT_QUOTES | ENT_HTML401,$encoding);
    }
    function xecho($title)
    {
        echo xssafe($title);
    }

    //sanitise title
    $title = $_POST["title"];
    $title = xssafe($title);
    var_dump($title);

    // sanitise desc
    $desc = $_POST["desc"];
    $desc = xssafe($desc);
    var_dump($desc);

    $url = "test";
    $name = $_SESSION["username"];

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $uploadOk = 1;

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
    // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
    // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }


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
 //                       $postDate = time();
 //                       $postDate = strtotime($postDate);
                        var_dump($postDate);
                        var_dump($target_file);
                        var_dump($id);

                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                            echo "Sorry, your file was not uploaded.";
                            // if everything is ok, try to upload file
                        }else{
                            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

                                /* Create the prepared statement */
                                if ($query = $db->prepare("INSERT INTO photos (title, description, postDate, url, userID) values (?, ?, now(), ?, ?)")) {

                                    /* Bind our params */
                                    $query->bind_param('sssi', $title, $desc, $target_file, $id);


                                    /* Execute the prepared Statement */
                                    $query->execute();

                                    echo "Inserted {$title},{$desc},{$postDate},{$target_file},{$id} into database\n";

                                    $msg = "Thank You! The pile " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded. click <a href='photos.php'>here</a> to go back";

                                    /* Close the statement */
                                    $query->close();
                                }
                            }
                            else {
                                /* Error */
                                $msg = "Sorry, there was an error uploading your file.";

                            }
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