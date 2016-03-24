<?php

    include("connection.php");
    include("check.php");

    $id=$_GET['id'];

   // $sql="SELECT * FROM bugs WHERE bugID='$id'";
    //$result=mysqli_query($db,$sql);


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
    <h1><class="hello">You sent me, <em><?php echo "<h1> Hello ".$_POST["id"]."</h1>";?>!</em></h1>

    <nav>
        <ul>
            <li><a href="/BugTracker/login/logout.php" style="font-size:18px">Logout?</a></li>
            <li><a href="/BugTracker/addBugReport/newbug.php">Submit New Bug Report</a></li>
        </ul>
    </nav>
</header>
</body>
</html>