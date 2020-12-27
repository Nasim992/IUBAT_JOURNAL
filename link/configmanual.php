<?php

$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */ 
$dbname = "iubat"; /* Database name */

// $host = "sql103.epizy.com"; /* Host name */
// $user = "epiz_27210191"; /* User */
// $password = "d1cMVcXvOSxtu6q"; /* Password */
// $dbname = "epiz_27210191_iubat"; /* Database name */


$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}

?>  