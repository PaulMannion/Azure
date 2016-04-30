<?php
$msg = "";
if(isset($_POST["submit"]))
{
    // Sanitise username input
    $name = $_POST['username'];
    $name = stripslashes($name);
    $name = mysqli_real_escape_string($db, $name);

    // Sanitise email input
    $email = $_POST["email"];
    $email = stripslashes($email);
    $email = mysqli_real_escape_string($db, $email);

    // Sanitise password input
    $password = $_POST["password"];
    $pass = $_POST['password'];
    $pass = stripslashes($pass);
    $pass = mysqli_real_escape_string($db, $pass);


    //   $pass = md5($pass);

    echo "<p>Has username been cleaned? <em>{$user}</em></p>";
    echo "<p>Has email been cleaned? <em>{$email}</em></p>";
    echo "<p>Has password been cleaned? <em>{$pass}</em></p>";
    

    $sql="SELECT email FROM users WHERE email='$email'";
    $result=mysqli_query($db,$sql);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    if(mysqli_num_rows($result) == 1)
    {
        $msg = "Sorry...This email already exists...";
    }
    else
    {
        //echo $name." ".$email." ".$password;
        $query = mysqli_query($db, "INSERT INTO users (username, email, password) VALUES ('$name', '$email', '$password')")or die(mysqli_error($db));
        if($query)
        {
            $msg = "Thank You! you are now registered. click <a href='index.php'>here</a> to login";
        }

    }
}
?>