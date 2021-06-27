<?php

include '../link/config.php';

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
} 

$id=intval($_GET['id']);

$sql="DELETE FROM admin WHERE id= '$id' ";

if(mysqli_query($link, $sql)){
    echo "Selected Admin  deleted successfully.";
    echo "<script type='text/javascript'> document.location = 'admin'; </script>";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
// Close connection
mysqli_close($link);
header("Location: " . $_SERVER["HTTP_REFERER"]);
exit;

?>