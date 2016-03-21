<?php
	include("check.php");

$msg = "";
if(isset($_POST["submit"]))
{
    $bugTitle = $_POST["bugTitle"];
    $bugDesc = $_POST["bugDesc"];
    //$Comment = $_POST["Comment"];
    //$login_userID = 21;
    //$login_user=$row['userID'];

    $bugTitle = mysqli_real_escape_string($db, $bugTitle);
    $bugDesc = mysqli_real_escape_string($db, $bugDesc);
   // $bugComment = mysqli_real_escape_string($db, $bugComment);

    



        $query = mysqli_query($db, "INSERT INTO bugs (title, bugDesc, postDate, userID) VALUES ('$bugTitle', '$bugDesc', current_date(), '$login_userID')")or die(mysqli_error($db));
       // $query = mysqli_query($db, "INSERT INTO users (username, email, password)VALUES ('$name', '$email', '$password')")or die(mysqli_error($db));
        if($query)
        {
            $msg = "Thank You! Bug Submitted!";
        }


}
?>