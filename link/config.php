<?php 
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','root'); 
define('DB_PASS','');
define('DB_NAME','iubat');
// Establish database connection.

// DB credentials.
// define('DB_HOST','sql103.epizy.com');
// define('DB_USER','epiz_27210191'); 
// define('DB_PASS','d1cMVcXvOSxtu6q');
// define('DB_NAME','epiz_27210191_iubat');
// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}

$link = mysqli_connect("localhost", "root", "", "iubat");

// $link = mysqli_connect("sql103.epizy.com", "epiz_27210191", "d1cMVcXvOSxtu6q", "epiz_27210191_iubat");
  
?>