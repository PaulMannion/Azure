<?php
    include("connection.php");
    include("check.php");
    include("submit.php");

    $id=$_GET['id'];            // Get the $bugID
    $title=$_GET['title'];      // Get the $bugtitle

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
    <h1 class="hello">Hello, <em><?php echo $login_user;?>!</em></h1>
    <nav>
        <ul>
            <li><a href="/BugTracker/login/logout.php" style="font-size:18px">Logout?</a></li>
            <li><a href="/BugTracker/addBugReport/newbug.php">Submit New Bug Report</a></li>
            <li><a href="/BugTracker/login/loggedin.php" style="font-size:18px">Show Bug Report</a></li>
        </ul>
    </nav>
</header>

<main>
    <h2>Welcome to my Bug Tracker!</h2>
    <p>Here is a list of all the attachments for the bug : <?php echo $title;?>!</p>

    <?php

    $sql="SELECT a.url, u.username FROM attachments a JOIN users u ON a.userID=u.userID WHERE a.bugID=$id";

    $result=mysqli_query($db,$sql);

    ?>

    <table id="bugs">
        <tr>
            <th>URL</th>
            <th>Uploaded By</th>
        </tr>
        <tr>

            <?php
            while($row = mysqli_fetch_assoc($result)) {

                $attachUrl = $row['url'];
                $attachBy = $row['username'];

                
                echo "<td>$attachUrl</td>";
                echo "<td>$attachBy</td>";
                echo "</tr>\n";
            }

            ?>

        </tr>

    </table>


    <form method="post" enctype="multipart/form-data">
        <table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
            <tr>
                <td width="246">
                    <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                    <input name="userfile" type="file" id="userfile">
                </td>
                <td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
            </tr>
        </table>
    </form>

</main>

<footer>
    <p>(c) 2016 1506100 Paul Mannion</p>
</footer>

</body>
</html>



