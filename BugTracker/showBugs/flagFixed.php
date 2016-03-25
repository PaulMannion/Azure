<?php

    include("connection.php");
    include("check.php");

    $id = $_POST["id"];
    $title = $_POST["title"];


        $sql = "UPDATE bugs SET fixDate = CURRENT_DATE(), fixed = 1 WHERE bugID=$id";

        if (mysqli_query($db, $sql)) {
            header("Location: /BugTracker/login/loggedin.php");
        } else {
            echo "Error updating record: " . mysqli_error($db);
        }

?>