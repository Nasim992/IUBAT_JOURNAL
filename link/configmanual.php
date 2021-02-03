<?php
include 'dbname.php';
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS,DB_NAME);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}

?>  