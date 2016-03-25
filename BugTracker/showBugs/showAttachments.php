<?php
    include("connection.php");
    include("check.php");

    $id=$_GET['id'];            // Get the $bugID
    $title=$_GET['title'];      // Get the $bugtitle
    $userID=$login_userID;      // Get the logged in user's ID

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
            <form name="form" method="POST" action="/BugTracker/login/loggedin.php">
                <input type="submit" value="Back to Bugs"style="background-color:#0066FF!important">
            </form>
        </form>
        <br>
        <h3>Here is a list of all the attachments for bug: <em><?php echo $title;?></em></h3>
        <br>
    </div>
</header>
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

                
                echo "<td><a href='$attachUrl'target=\"_blank\">".$attachUrl."</a></td>";
                echo "<td>$attachBy</td>";
                echo "</tr>\n";
            }

            ?>

        </tr>

    </table>


    <form method="post" action="/BugTracker/showBugs/upload.php">
        <fieldset>
            <legend align="right">Attachment Submission Form</legend>
            <table width="400" border="0" cellpadding="10" cellspacing="10" align="center">
                <tr>
                    <td colspan="2" align="center" class="error"><?php echo $msg;?></td>
                </tr>
                <tr>
                    <td style="font-weight: bold">
                        <div align="right"><label for="url">Paste URL</label></div>
                    </td>
                    <td>
                        <input name="url" type="text" class="input" size="65" required />
                        <input value="<?php echo $id;?>" type="hidden" name="bugID">
                        <input value="<?php echo $userID;?>" type="hidden" name="userID">
                        <input value="<?php echo $title;?>" type="hidden" name="title">
                    </td>
                </tr>
                <tr>
                    <td height="23"></td>
                    <td>
                        <div align="right">
                            <input type="submit" name="upload" value="Upload!" />
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



