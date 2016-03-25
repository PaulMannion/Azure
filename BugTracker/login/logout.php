<?php
session_start();
if(session_destroy())
{
header("Location: /BugTracker/login/index.php");
}

?>