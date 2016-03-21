<?php
$msg = "";
if(isset($_POST["submit"]))
{
    $bugTitle = $_POST["bugTitle"];
    $bugDesc = $_POST["bugDesc"];
    //$postDate = $_
    //$Comment = $_POST["Comment"];

    $bugTitle = mysqli_real_escape_string($db, $bugTitle);
    $bugDesc = mysqli_real_escape_string($db, $bugDesc);
   // $bugComment = mysqli_real_escape_string($db, $bugComment);

    



        $query = mysqli_query($db, "INSERT INTO bugs (title, desc)VALUES ('$bugTitle', '$bugDesc')")or die(mysqli_error($db));
       // $query = mysqli_query($db, "INSERT INTO users (username, email, password)VALUES ('$name', '$email', '$password')")or die(mysqli_error($db));
        if($query)
        {
            $msg = "Thank You! Bug Submitted!";
        }


}
?>