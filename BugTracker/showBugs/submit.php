<?php
$msg = "";
if(isset($_POST["submit"]))
{
    $comText = $_POST["comText"];
    $bugID = $_POST["bugID"];


    echo "<p>The bugID is: $bugID</p>";
    echo "<p>The userID is: $login_userID</p>";
    echo "<p>The comment is: $comText</p>";

   // $comText = mysqli_real_escape_string($db, $comText);


            $query = mysqli_query($db, "INSERT INTO comments (comText, postDate, userID, bugID) VALUES ('$comText', current_date(), $login_userID, $bugID)") or die(mysqli_error($db));
            if ($query) {
                
                header("location: /BugTracker/showBugs/showBugs.php"); // Redirecting To Awaiting Approval Page
            }
        }

        else
        {
            $msg = "Sorry...Something Terrible has Happened...";
        }

?>