<?php
$msg = "";
if(isset($_POST["submit"]))
{
    $desc = $_POST["desc"];
    $bugID = $_POST["bugID"];


    echo "<p>The bugID is: <?php echo '$bugID';?></p>";
    echo "<p>The userID is: <?php echo '$login_userID';?></p>";
    echo "<p>The comment is: <?php echo '$desc';?></p>";

    $desc = mysqli_real_escape_string($db, $desc);


            $query = mysqli_query($db, "INSERT INTO comments (desc, postDate, userID, bugID) VALUES ('$desc', current_date(), '$login_userID','$bugID')") or die(mysqli_error($db));
            if ($query) {
                
                header("location: /BugTracker/showBugs/showBugs.php"); // Redirecting To Awaiting Approval Page
            }
        }

        else
        {
            $msg = "Sorry...Something Terrible has Happened...";
        }

?>