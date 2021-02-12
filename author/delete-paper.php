<?php

include '../link/linklocal.php';
 
if($link === false){ 
    die("ERROR: Could not connect. " . mysqli_connect_error());
} 

if(isset($_POST['deletepaper'])) { 
    $id=($_POST['paperiddelete']);
    $file1 = $_POST['filepathtitle'];
    $file2 = $_POST['filepathsecond']; 
    $file = $_POST['filepath'];
    $fileresubmit = $_POST['filepathresubmit'];

    unlink($file1);
    unlink($file2 );
    unlink($file);
    unlink($fileresubmit);
 
    header("Location: " . $_SERVER["HTTP_REFERER"]);

    $sql="DELETE FROM paper WHERE paperid='$id' ";

    if(mysqli_query($link, $sql)){
        echo "Selected paper were deleted successfully.";

        header("refresh:0;url=authorpaperstatus"); 
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        header("refresh:0;url=authorpaperstatus"); 
    }

}
// // Built-in PHP function to delete file
// unlink($_GET["name"]);
 
// // Redirecting back
// header("Location: " . $_SERVER["HTTP_REFERER"]);

// Close connection
mysqli_close($link);

?>