<body>
<div id="content">

<?php

include("/BugTracker/login/connection.php");
include("/BugTracker/login/check.php");


    $sql = "SELECT * FROM bugs WHERE bugID = ".$_GET["id"];
    $result=mysqli_query($db,$sql);

    $row = mysqli_fetch_assoc($result);
    $bugTitle = $row['title'];
    $bugID = $row['ID'];
    $bugDesc = $row['desc'];

    echo "<h2>".$bugTitle."<?h2>";
    echo "<p>".$bugDesc."</p>p>";

   // echo '<a href="bug.php?id="'.$bugID.'>'.$bugTitle.'</a></br>';
 ?>

</div>
</body>




