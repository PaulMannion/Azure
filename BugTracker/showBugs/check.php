<?php
include('connection.php');
session_start();
$user_check=$_SESSION['username'];

$ses_sql = mysqli_query($db,"SELECT username, admin FROM users WHERE username='$user_check' ");

$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

$login_user=$row['username'];
$login_rights=$row['admin'];

if(!isset($user_check))
{
header("Location: newbug.php");
}
?>