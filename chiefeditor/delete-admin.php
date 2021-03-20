<?php

include '../link/config.php';

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
} 

$id=intval($_GET['id']);

$sql="DELETE FROM admin WHERE id= '$id' ";

if(mysqli_query($link, $sql)){
    echo "Selected Admin  deleted successfully.";
    header("refresh:0;url=admin");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
// Close connection
mysqli_close($link);

?>