<?php

	include("connection.php");
	include("check.php");

$msg = "";
if(isset($_POST["upload"])) {
       $url = $_POST["url"];
       $bugID = $_POST["bugID"];
       $userID = $_POST["userID"];


    //$url = mysqli_real_escape_string($db, $url);

    echo "<p>The bugID is: $bugID</p>";
    echo "<p>The userID is: $userID</p>";
    echo "<p>The url is: $url</p>";


    $query = mysqli_query($db, "INSERT INTO attachments (URL, userID, bugID) VALUES ('$url', '$userID', '$bugID')") or die(mysqli_error($db));


    if ($query) {


        header("location: BugTracker/showBugs/showAttachments.php"); // Redirecting To Bug Display Page
    } else {

        echo "<script type='text/javascript'>alert('Something went wrong :-(')</script>";
        $msg = "Sorry...Something Terrible has Happened...";
    }
}
        

?>