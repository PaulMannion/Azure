<?php
    include("connection.php");
    include("check.php");
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
            <li><a href="logout.php" style="font-size:18px">Logout?</a></li>
            <li><a href="/BugTracker/addBugReport/newbug.php">Submit New Bug Report</a></li>
        </ul>
    </nav>
</header>

<main>
    <h2>Welcome to my Bug Tracker!</h2>
    <p>Here is a list of all the bugs:</p>



    <?php

    $id="11";

    $sql="SELECT * FROM bugs WHERE bugID='$id'";
    $result=mysqli_query($db,$sql);

    ?>

    <table id="bugs">
        <tr>
            <th>Bug Title</th>
            <th>Bug Description</th>
            <th>Date Posted</th>
            <th>Date Fixed</th>
            <th>Fixed? (Y or N)</th>
            <th>Admin Approved?</th>
        </tr>
        <tr>

            <?php
            while($row = mysqli_fetch_assoc($result)) {
                $bugTitle = $row['title'];
                $bugID = $row['bugID'];
                $bugDesc = $row['bugDesc'];
                $bugPost = $row['postDate'];
                $bugFix = $row['fixDate'];
                $bugFixed = $row['fixed'];
                $bugAuth = $row['isFixed'];

                //			echo "<td><a href="/BugTracker/showBugs/showBugs.php?id="'.$bugID.'>'.$bugTitle.'</a></td>";
                echo '<td><a href="/BugTracker/showBugs/showBugs.php?id="'.$bugID.'>'.$bugTitle.'</a></td>';
                echo "<td>$bugDesc</td>";
                echo "<td>$bugPost</td>";
                if (empty($bugFix)) {
                    echo "<td>Not Fixed</td>";
                } else {
                    echo "<td>$bugFix</td>";
                }
                if ($bugFixed == 0) {
                    echo "<td>No</td>";
                } else {
                    echo "<td>Yes</td>";
                }
                if ($bugAuth == 1) {
                    echo "<td>Approved</td>";
                } else {
                    echo "<td></td>";
                }

                echo "</tr>\n";
            }

            ?>

        </tr>

    </table>
</main>

<footer>
    <p>(c) 2016 1506100 Paul Mannion</p>
</footer>

</body>
</html>


