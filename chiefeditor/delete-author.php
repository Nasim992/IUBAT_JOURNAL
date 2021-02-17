<?php

include '../link/linklocal.php';

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
} 
 
$id=intval($_GET['id']);

// Select Email From the Author Table sections Starts Here 

$sql = "SELECT * FROM author WHERE  id= '$id' ";

$result = mysqli_query($link,$sql);

$file = mysqli_fetch_assoc($result);

$email = $file['email'];


// Select Email From the Author Table Sections ends Here 

// Select Paper Name Form the paper Table Section Starts Here 


// // Built-in PHP function to delete file
// unlink($_GET["name"]);
 
// // Redirecting back
// header("Location: " . $_SERVER["HTTP_REFERER"]);


$sql="DELETE FROM author WHERE id= '$id' ";

if(mysqli_query($link, $sql)){

    echo "Selected Authors were deleted successfully.";

    header("refresh:1;url=authors");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);

?>