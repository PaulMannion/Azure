<?php
    include("connection.php");
    include("check.php");
    include("submit.php");

    $id=$_GET['id'];
    $title=$_GET['title'];

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home</title>
    <!--	<link type="text/css" rel="stylesheet" href="assets/css/custom.css"/> -->
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

<header>
    <div align="center">
        <h1>My Bug Tracker Website</h1>
    </div>
    <h1 class="hello">Hello, <em><?php echo $login_user;?>!</em></h1>

    <div align="left">
        <form name="form" method="POST" action="logout.php">
            <input type="submit" value="Logout">
        </form>
    </div>

    </header>

    <?php

    $sql="SELECT c.postDate,c.comText, u.username FROM comments c JOIN users u ON c.userID=u.userID WHERE c.bugID=$id ORDER BY 'c.postDate' ASC ";

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
                $commentDesc = $row['comText'];

                
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
            <legend>Comment Submission Form</legend>
            <table width="400" border="0" cellpadding="10" cellspacing="10" align="center">
                <tr>
                    <td colspan="2" align="center" class="error"><?php echo $msg;?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold">
                        <div align="center"><label for="comments">Comment</label></div>
                    </td>
                    <td>
                        <textarea name="comText" rows="10" cols="60" required></textarea>
                        <input value="<?php echo $id;?>" type="hidden" name="bugID">
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
    <p align="center">(c) 2016 1506100 Paul Mannion</p>
</footer>

</body>
</html>



