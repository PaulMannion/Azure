<?php
$msg = "";
if(isset($_POST["submit"]))
{
    $desc = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];
    

    $desc = mysqli_real_escape_string($db, $desc);


            $query = mysqli_query($db, "INSERT INTO comments (desc, postDate, userID, bugID) VALUES ('$desc', current_date(), 11, 11)") or die(mysqli_error($db));
            if ($query) {
                
                header("location: showComments.php"); // Redirecting To Awaiting Approval Page
            }
        }

        else
        {
            $msg = "Sorry...This user already exists...";
        }

?>