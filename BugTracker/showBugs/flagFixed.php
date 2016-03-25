<?php

    include("connection.php");
    include("check.php");

    $id = $_POST["id"];
    $title = $_POST["title"];

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

<header>
    <h1>My Bug Tracker Website</h1>
    <h1><class="hello">Hello, <em><?php echo $login_user;?>!</em></h1>
    <nav>
        <ul>
            <li><a href="/BugTracker/login/logout.php" style="font-size:18px">Logout?</a></li>
            <li><a href="/BugTracker/addBugReport/newbug.php">Submit New Bug Report</a></li>
        </ul>
    </nav>
</header>


<?php
        $sql = "UPDATE bugs SET fixDate = CURRENT_DATE(), fixed = 1 WHERE bugID=$id";

        if (mysqli_query($db, $sql)) {
            echo "<h2>Bug: <b>$title</b> has been flagged as fixed. It needs to be approved by an administrator.</h2>";
        } else {
            echo "Error updating record: " . mysqli_error($db);
        }

?>

        <h2><a href="/BugTracker/login/loggedin.php" style="font-size:18px">Return to Bug Page</a></li></h2>

</body>
</html>