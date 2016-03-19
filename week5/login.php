<?php
/**
 * Created by PhpStorm.
 * User: 1506100
 * Date: 02/03/2016
 * Time: 15:11
 */
include("connection.php"); //Establishing connection with our database

/**
 * We check if the username and password have values. Ie someone hasn’t just entered empty values.
 */

if(empty($_POST["username"]) || empty($_POST["password"]))
{
    echo "Both fields are required.";
}else
{
    /**Next we assign local variables to the parameters passed in via the POST
     */

    $username=$_POST['username'];
    $password=$_POST['password'];

    /**Now the important bit… we create an SQL statement ( a query)
     * that selects the uid of a user who has the username and password entered.
     * This statement searches through our database and
     * looks for a row where the username and password match an existing entry.
     */

$sql="SELECT uid FROM users WHERE username='$username' and password='$password'";

    /**
     * We now set up a variable, result, to hold the result of the query. These two lines run the query and return the result.
     */

    $result=mysqli_query($db,$sql);

/**
 * Finally we check how big the result is. If no rows are returned, this means a viable user has not been found. Likewise if two users are found there must be a problem!
 * Hence we check if the number of rows in the result is 1. If we do only have one result then rdirect to a new page using the header method, otherwise we set our error variable to a sensible message.
 */

if(mysqli_num_rows($result) == 1)
{
    header("location: loggedin.php?username=".$username); // Redirecting To another Page
}else
{
    echo "Incorrect username or password.";
        }
}

?>
