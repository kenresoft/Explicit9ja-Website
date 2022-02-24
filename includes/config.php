<?php
// define('DB_SERVER','localhost');
// define('DB_USER','u875809167_explicit9ja');
// define('DB_PASS' ,'explicit9ja2019');
// define('DB_NAME','u875809167_explicit9ja_db');
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME','explicit9ja');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


require_once("./like/dbcontroller.php");
$db_handle = new DBController();
?>
