<?php
$msg = "";
if(isset($_POST["submit"]))
{
    $desc = $_POST["desc"];
    $userID = $_POST["userID"];
    $bugID = $_POST["bugID"];


    

    $desc = mysqli_real_escape_string($db, $desc);


            $query = mysqli_query($db, "INSERT INTO comments (desc, postDate, userID, bugID) VALUES ('$desc', current_date(), '$userID','$bugID')") or die(mysqli_error($db));
            if ($query) {
                
                header("location: /BugTracker/showBugs/showBugs.php"); // Redirecting To Awaiting Approval Page
            }
        }

        else
        {
            $msg = "Sorry...Something Terrible has Happened...";
        }

?>