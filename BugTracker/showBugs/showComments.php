<?php
    include("connection.php");
    include("check.php");
    include("submit.php");

    $id=$_GET['id'];
    $title=$_GET['title'];
    $userID=$login_user;
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
            <li><a href="/BugTracker/showBugs/showBugs.php" style="font-size:18px">Show Bug Report</a></li>
        </ul>
    </nav>
</header>

<main>
    <h2>Welcome to my Bug Tracker!</h2>
    <p>Here is a list of all the comments for the bug : <h2><?php echo $title;?>!</h2></p>



    <?php


    

    $sql="SELECT c.postDate,c.desc, u.username FROM comments c JOIN users u ON c.userID=u.userID WHERE c.bugID=$id ORDER BY 'c.postDate' ASC ";

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

                
                echo "<td>$commentDate</td>";
                echo "<td>$commentBy</td>";
                echo "<td>$commentDesc</td>";
                echo "</tr>\n";
            }

            ?>

        </tr>

    </table>


    <form method="post" action="">
        <fieldset>
            <legend>Registration Form</legend>
            <table width="400" border="0" cellpadding="10" cellspacing="10">
                <tr>
                    <td colspan="2" align="center" class="error"><?php echo $msg;?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold">
                        <div align="right"><label for="desc">Comment</label></div>
                    </td>
                    <td>
                        <input name="desc" type="text" class="input" size="25" required />
                        <input value="<?php echo $id;?>" type="hidden" name="bugID">
                        <input value="<?php echo $userID;?>" type="hidden" name="userID">
                    </td>
                </tr>
                <tr>
                    <td height="23"></td>
                    <td>
                        <div align="right">
                            <input type="submit" name="submit" value="Comment!" />
                        </div>
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>

</main>

<footer>
    <p>(c) 2016 1506100 Paul Mannion</p>
</footer>

</body>
</html>



