<?php

$link = mysqli_connect("localhost", "root", "", "iubat");

//  $link = mysqli_connect("sql103.epizy.com", "epiz_27210191", "d1cMVcXvOSxtu6q", "epiz_27210191_iubat");

 
if($link === false){ 
    die("ERROR: Could not connect. " . mysqli_connect_error());
} 

$id=intval($_GET['id']);
$name = $_GET['name'];

// echo $id;
// echo $name;

// Built-in PHP function to delete file
unlink($_GET["name"]);
 
// Redirecting back
header("Location: " . $_SERVER["HTTP_REFERER"]);


$sql="DELETE FROM paper WHERE id=$id ";

if(mysqli_query($link, $sql)){
    echo "Selected paper were deleted successfully.";

    header("refresh:0;url=unpublished-paper"); 
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);

?>