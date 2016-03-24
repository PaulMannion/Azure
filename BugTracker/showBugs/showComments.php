<?php
    include("connection.php");
    include("check.php");

    $id=$_GET['id'];
    $title=$_GET['title'];
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
    <p>Here is a list of all the comments for the bug : <h2><?php echo $title;?>!</h2></p>



    <?php


    
    //"SELECT b.*,u.username FROM bugs b, users u WHERE b.userID=u.userID";
   // $sql="SELECT * FROM comments WHERE bugID=$id order by 'postDate'";
   // $sql = "SELECT b.*,u.username FROM bugs b, users u WHERE b.userID=u.userID";
    $sql="SELECT c.postDate,c.desc,u.username FROM comments c, users u WHERE c.userID=u.userID order by 'c.postDate'";
    $sql="SELECT c.postDate,c.desc,u.username FROM comments c, users u WHERE comments c.userID=u.userID order by 'c.postDate'";

    $result=mysqli_query($db,$sql);

    ?>

    <table id="bugs">
        <tr>
            <th>Date Posted</th>
            <th>Posted By</th>
            <th>Comments</th>
        </tr>
        <tr>

            <?php
            while($row = mysqli_fetch_assoc($result)) {

                $commentDate = $row['postDate'];
                $commentBy = $row['username'];
                $commentDesc = $row['desc'];
               // $bugFix = $row['fixDate'];
               // $bugFixed = $row['fixed'];
               // $bugAuth = $row['isFixed'];

                
                echo "<td>$commentDate</td>";
                echo "<td>$commentBy</td>";
                echo "<td>$commentDesc</td>";
         /*       if (empty($bugFix)) {
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
            */
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



