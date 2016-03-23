<?php
include("check.php");
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="/BugTracker/login/style.css" type="text/css" />
</head>
<body>

<header>
    <h1>My Bug Tracker Website</h1>
    <h1 class="hello">Hello, <em><?php echo $login_user;?>!</em></h1>
    <nav>
        <ul>
            <li><a href="/BugTracker/login/logout.php" style="font-size:18px">Logout?</a></li>
            <li><a href="/BugTracker/login/loggedin.php">List of Bugs</a></li>
        </ul>
    </nav>
</header>

<main>
    <h2>Welcome to my Bug Tracker User Admin Page</h2>
    <p>Here is a list of all the users:</p>

    <?php
    $sql = "SELECT * FROM users";
    $result=mysqli_query($db,$sql);
    //echo "<script type='text/javascript'>alert('before php!')</script>";
    ?>

    <table id="bugs">
        <tr>
            <th>Username</th>
            <th>email address</th>
            <th>Phone</th>
            <th>Date Joined</th>
            <th>Authorised</th>
            <th>Administrator</th>
        </tr>
        <tr>

            <?php
            echo "<script type='text/javascript'>alert('$result')</script>";
            while($row = mysqli_fetch_assoc($result)) {
                $userName = $row['username'];
                $userMail = $row['email'];
                $userPhone = $row['phone'];
                $userJoin = $row['joined'];
                $userAuth = $row['approved'];
                $userAdm = $row['admin'];

                echo "<script type='text/javascript'>alert('middle!')</script>";
                echo "<td>$userName</td>";
                echo "<td>$userMail</td>";
                echo "<td>$userPhone</td>";
                echo "<td>$userJoin</td>";
                if ($userAuth == 1) {
                    echo "<td>Authorised</td>";
                } else {
                    echo "<td></td>";
                }
                if ($userAdm == 1) {
                    echo "<td>Administrator</td>";
                } else {
                    echo "<td></td>";
                }

                echo "</tr>\n";
            }
            echo "<script type='text/javascript'>alert('wtf!')</script>";
            ?>
        </tr>

    </table>

</main>

<footer>
    <p>(c) 2016 1506100 Paul Mannion</p>
</footer>

</body>
</html>