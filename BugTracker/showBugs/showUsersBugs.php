<?php

//include("connection.php");
//include("check.php");


$sql = "SELECT * FROM bugs";
$result=mysqli_query($db,$sql);

while($row = mysqli_fetch_assoc($result)){
    $bugTitle = $row['title'];
    $bugID = $row['ID'];

    echo '<a href="bug.php?id="'.$bugID.'>'.$bugTitle.'</a></br>';
    
}

?>



