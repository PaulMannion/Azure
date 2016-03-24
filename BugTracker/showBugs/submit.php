<?php
$msg = "";
if(isset($_POST["submit"]))
{
    $desc = $_POST["comment"];
    $bugID = $_POST["bugID"];


    echo "<p>The bugID is: $bugID</p>";
    echo "<p>The userID is: $login_userID</p>";
    echo "<p>The comment is: $desc</p>";

    $desc = mysqli_real_escape_string($db, $desc);

            $query = mysqli_query($db, "INSERT INTO users (username, email, password, joined, phone)VALUES ('$name', '$email', '$password', current_date(), '$phone')") or die(mysqli_error($db));
            $query = mysqli_query($db, "INSERT INTO comments (comment, postDate, userID, bugID) VALUES ('$desc', current_date(), $login_userID, $bugID)") or die(mysqli_error($db));
            if ($query) {
                
                header("location: /BugTracker/showBugs/showBugs.php"); // Redirecting To Awaiting Approval Page
            }
        }

        else
        {
            $msg = "Sorry...Something Terrible has Happened...";
        }

?>