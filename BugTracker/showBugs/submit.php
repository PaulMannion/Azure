<?php
	include("check.php");

$msg = "";
if(isset($_POST["submit"]))
{
    $desc = $_POST["commentDesc"];
    $bugID = $_POST["bugID"];

    $desc = mysqli_real_escape_string($db, $desc);
    $bugDesc = mysqli_real_escape_string($db, $bugDesc);
    
        $query = mysqli_query($db, "INSERT INTO comments (desc, postDate, userID, bugID) VALUES ('$desc', current_date(), '$login_userID', $bugID)")or die(mysqli_error($db));
       
        if($query)
        {
            $msg = "Thank You! Comment Submitted!";
        }


}
?>