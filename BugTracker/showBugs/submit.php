<?php
include("connection.php");
include("check.php");


$msg = "";
if(isset($_POST["submit"]))
{
    $comDesc = $_POST["comText"];
    $bugID = $_POST["bugID"];

    $comDesc = mysqli_real_escape_string($db, $comDesc);

  //  echo "<p>The bugID is: $bugID</p>";
  //  echo "<p>The userID is: $login_userID</p>";
  //  echo "<p>The comment is: $comDesc</p>";




            $query = mysqli_query($db, "INSERT INTO comments (comText, postDate, userID, bugID) VALUES ('$comDesc', current_date(), $login_userID, $bugID)") or die(mysqli_error($db));
            if ($query) {
                
                header("location: /BugTracker/login/loggedin.php"); // Redirecting To Awaiting Approval Page
            }
            else
            {
                $msg = "Sorry...Something Terrible has Happened...";
            }
        }


$msg = "";
if(isset($_POST["submit"]))
{
    $url = $_POST["url"];
    $bugID = $_POST["bugID"];

    $url = mysqli_real_escape_string($db, $url);

    echo "<p>The bugID is: $bugID</p>";
    echo "<p>The userID is: $login_userID</p>";
    echo "<p>The url is: $url</p>";




    $query = mysqli_query($db, "INSERT INTO attachments (URL, userID, bugID) VALUES ('$url', $login_userID, $bugID)") or die(mysqli_error($db));
    if ($query) {
        
        echo "<script type='text/javascript'>alert('Attachment Successfully Uploaded')</script>";
        header("location: /BugTracker/login/loggedin.php"); // Redirecting To Bug Display Page
    }
    else
    {
        $msg = "Sorry...Something Terrible has Happened...";
    }
}
        

?>