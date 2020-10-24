<?php

$link = mysqli_connect("localhost", "root", "", "iubat");

 
 
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$id=intval($_GET['id']);
$name = $_GET['name'];

// Built-in PHP function to delete file
unlink($_GET["name"]);
 
// Redirecting back
header("Location: " . $_SERVER["HTTP_REFERER"]);


$sql="DELETE FROM paper WHERE id=$id ";

if(mysqli_query($link, $sql)){
    echo "Selected disease were deleted successfully.";

    header("refresh:1;url=show_disease.php");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);

?>