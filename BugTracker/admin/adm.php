<?php

    include("connection.php");
    include("check.php");

    $id = $_POST["id"];
    $name = $_POST["name"];

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
    <h1><class="hello">You sent me, <?php echo $id;?></h1>
    <h1><class="hello">You sent me, <?php echo $name;?></h1>



    <nav>
        <ul>
            <li><a href="/BugTracker/login/logout.php" style="font-size:18px">Logout?</a></li>
            <li><a href="/BugTracker/addBugReport/newbug.php">Submit New Bug Report</a></li>
        </ul>
    </nav>
</header>


<?php
        $sql = "UPDATE users SET admin='1' WHERE userID=$id";

        if (mysqli_query($db, $sql)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($db);
        }

?>



</body>
</html>