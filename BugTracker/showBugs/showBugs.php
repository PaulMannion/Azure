<body>
<div id="content">

<?php

include("connection.php");
include("check.php");


    $sql = "SELECT * FROM bugs WHERE bugID = ".$_GET["id"];
    $result=mysqli_query($db,$sql);

    $row = mysqli_fetch_assoc($result);
    $bugTitle = $row['title'];
    $bugID = $row['ID'];
    $bugDesc = $row['desc'];

    echo "<h2>".$bugTitle."<h2>";
    echo "<p>".$bugDesc."</p>";

   // echo '<a href="bug.php?id="'.$bugID.'>'.$bugTitle.'</a></br>';
 ?>

</div>
</body>




