<?php
/**
 * Created by PhpStorm.
 * User: 1506100
 * Date: 02/03/2016
 * Time: 15:08
 */
define('DB_SERVER', 'eu-cdbr-azure-north-d.cloudapp.net');
define('DB_USERNAME', 'bab5a9f1a0500d');
define('DB_PASSWORD', '7233e6ee');
define('DB_DATABASE', 'pdm1506100');
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
?>
