<?php

include '../link/linklocal.php';

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
} 

$id=intval($_GET['id']);


// // Built-in PHP function to delete file
// unlink($_GET["name"]);
 
// // Redirecting back
// header("Location: " . $_SERVER["HTTP_REFERER"]);


$sql="DELETE FROM admin WHERE id= '$id' ";

if(mysqli_query($link, $sql)){
    echo "<script>alert('Selected Admin  deleted successfully')</script>";
    echo "<script type='text/javascript'> document.location = 'admin'; </script>";
} else{
    echo "<script>alert('Something went wrong')</script>";
    echo "<script type='text/javascript'> document.location = 'admin'; </script>";
}
 
// Close connection
mysqli_close($link);
header("Location: " . $_SERVER["HTTP_REFERER"]);

?>