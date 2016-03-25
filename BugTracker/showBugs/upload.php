<?php

	include("connection.php");
	include("check.php");

$msg = "";
if(isset($_POST["upload"])) {
       $url = $_POST["url"];
       $bugID = $_POST["bugID"];
       $userID = $_POST["userID"];

    //$url = "blah";
    //$bugID = 41;
    //$userID = 21;

    //$url = mysqli_real_escape_string($db, $url);

    echo "<p>The bugID is: $bugID</p>";
    echo "<p>The userID is: $userID</p>";
    echo "<p>The url is: $url</p>";


    $query = mysqli_query($db, "INSERT INTO attachments (URL, userID, bugID) VALUES ('$url', '$userID', '$bugID')") or die(mysqli_error($db));


    if ($query) {

        echo "<script type='text/javascript'>alert('Attachment Successfully Uploaded')</script>";
        header("location: /BugTracker/login/loggedin.php"); // Redirecting To Bug Display Page
    } else {

        echo "<script type='text/javascript'>alert('We ended up here :-(')</script>";
        $msg = "Sorry...Something Terrible has Happened...";
    }
}
        

?>