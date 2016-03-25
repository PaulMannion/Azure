<?php
	include("check.php");
    include("connection.php");

$msg = "";
if(isset($_POST["submit"]))
{
    $bugTitle = $_POST["bugTitle"];
    $bugDesc = $_POST["bugDesc"];

    $bugTitle = mysqli_real_escape_string($db, $bugTitle);
    $bugDesc = mysqli_real_escape_string($db, $bugDesc);
    
        $query = mysqli_query($db, "INSERT INTO bugs (title, bugDesc, postDate, userID) VALUES ('$bugTitle', '$bugDesc', current_date(), '$login_userID')")or die(mysqli_error($db));
       
        if($query)
        {
            header("Location: /BugTracker/login/loggedin.php");
        }


}
?>