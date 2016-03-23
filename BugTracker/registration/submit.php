<?php
$msg = "";
if(isset($_POST["submit"]))
{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];
    

    $name = mysqli_real_escape_string($db, $name);
    $email = mysqli_real_escape_string($db, $email);
    $password = mysqli_real_escape_string($db, $password);
    $password = md5($password);
    $phone = mysqli_real_escape_string($db, $phone);

    // Check to see if username already exists

    $sql="SELECT username FROM users WHERE username='$name'";
    $result=mysqli_query($db,$sql);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

    if(mysqli_num_rows($result) == 0) {

        //no duplicate user so now check duplicate email address

        $sql = "SELECT email FROM users WHERE email='$email'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if (mysqli_num_rows($result) == 1) {
            $msg = "Sorry...This email already exists...";
        } else {
            // no duplicate user or email so register

            $query = mysqli_query($db, "INSERT INTO users (username, email, password, joined)VALUES ('$name', '$email', '$password', current_date())") or die(mysqli_error($db));
            if ($query) {
                
                header("location: nonapproved.html"); // Redirecting To Awaiting Approval Page
            }
        }
    }
        else
        {
            $msg = "Sorry...This user already exists...";
        }
}
?>