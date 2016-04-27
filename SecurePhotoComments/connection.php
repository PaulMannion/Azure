<?php
define('DB_SERVER', 'eu-cdbr-azure-north-e.cloudapp.net');
define('DB_USERNAME', 'b03c736b29bc97');
define('DB_PASSWORD', '3885262f');
define('DB_DATABASE', 'vulnerable_1506100');
$db = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
if ($db->connect_errno){
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ")" . $db->connect_error;
}
?>
