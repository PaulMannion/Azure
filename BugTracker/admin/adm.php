<?php

    include("connection.php");
    include("check.php");

    $id = $_POST["id"];
    $name = $_POST["name"];


        $sql = "UPDATE users SET admin=1 WHERE userID=$id";

        if (mysqli_query($db, $sql)) {
            header("Location: /BugTracker/login/loggedin.php");
        } else {
            echo "Error updating record: " . mysqli_error($db);
        }

?>