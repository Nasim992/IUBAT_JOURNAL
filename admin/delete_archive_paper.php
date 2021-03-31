<?php
session_start();
error_reporting(0);
include('../link/config.php');

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
} 
 
$id=$_GET['id']; 

// Select Email From the Archive Table sections Starts Here 

        $sql = "SELECT * FROM archive WHERE paperid= '$id' ";
        $result = mysqli_query($link,$sql);
        $file = mysqli_fetch_assoc($result);
        $filename=$file['filename'];

$sql="DELETE FROM archive WHERE paperid= '$id' ";

if(mysqli_query($link, $sql)){
    unlink("../documents/archivefile/".$filename);
    echo "<script>alert('Selected Authors were deleted successfully.')</script>";
    echo "<script type='text/javascript'> document.location = 'authors'; </script>";
} else{ 
    echo "<script>alert('Something went wrong')</script>";
    echo "<script type='text/javascript'> document.location = 'authors'; </script>";
}
 
// Close connection
header("Location: " . $_SERVER["HTTP_REFERER"]);
mysqli_close($link);

?>