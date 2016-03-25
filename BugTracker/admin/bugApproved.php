<?php

    include("connection.php");
    include("check.php");

    $id = $_POST["id"];
    $title = $_POST["title"];
    $name = $_POST["name"];


  $sql = "UPDATE bugs SET isFixed='1' WHERE bugID=$id";

        if (mysqli_query($db, $sql)) {
            header("Location: /BugTracker/login/loggedin.php");
        } else {
            echo "Error updating record: " . mysqli_error($db);
        }

?>
