<?php
session_start();
error_reporting(0);
include('../link/config.php');

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
} 
 
$id=intval($_GET['id']); 

// Select Email From the Author Table sections Starts Here 

        $sql = "SELECT * FROM author WHERE  id= '$id' ";

        $result = mysqli_query($link,$sql);

        $file = mysqli_fetch_assoc($result);

        $email = $file['primaryemail']; 


    // Delete paper section 
    $paperid = array();
    $sqlacademiceditor = "SELECT paper.id,paper.paperid,paper.authoremail,paper.name,paper.name1,paper.name2,paper.resubmitpaper from paper Where authoremail='$email'";
    $queryacademiceditor = $dbh->prepare($sqlacademiceditor); 
    $queryacademiceditor ->execute(); 
    $resultacademiceditor=$queryacademiceditor ->fetchAll(PDO::FETCH_OBJ); 
    $cnt=1;

    if($queryacademiceditor->rowCount() > 0) 
    {
    foreach($resultacademiceditor as $result) 
    { 
    $usernameeditor = htmlentities($result->paperid);
    array_push($paperid,$usernameeditor);
    }}
    foreach($paperid as $pp) {
        $sqlpaperselect = "SELECT * FROM paper where paperid='$pp'";

        $resultpaper= mysqli_query($link,$sqlpaperselect);  
 
        $filepaper = mysqli_fetch_assoc($resultpaper);
        
        $file1 = $filepaper['name1']; 
        $file2 = $filepaper['name2'];
        $file = $filepaper['name'];
        $fileresubmit = $filepaper['resubmitpaper'];

        unlink('../documents/file1/'.$file1);
        unlink('../documents/file2/'.$file2);
        unlink('../documents/'.$file);
        unlink('../documents/resubmit/'.$fileresubmit);

        $sqlpapdelete="DELETE FROM paper WHERE paperid='$pp' ";
        mysqli_query($link, $sqlpapdelete);

        $sqlchieffeedback="DELETE FROM chieffeedback WHERE paperid= '$pp' ";
        mysqli_query($link, $sqlchieffeedback);
    }
    // Delete paper section 


    // Delete Reviewer  section 
    $revieweremail = array();
    $sqlreviewer = "SELECT reviewertable.id,reviewertable.paperid,reviewertable.primaryemail from reviewertable Where primaryemail='$email'";
    $queryreviewer = $dbh->prepare($sqlreviewer); 
    $queryreviewer ->execute(); 
    $resultreviewer=$queryreviewer ->fetchAll(PDO::FETCH_OBJ); 
    $cnt=1;

    if($queryreviewer->rowCount() > 0) 
    {
    foreach($resultreviewer as $result) 
    { 
    $usernameeditor = htmlentities($result->primaryemail);
    array_push($revieweremail,$usernameeditor);
    }}
    foreach($revieweremail as $pp) {

        $selectreviewer = "SELECT * FROM reviewertable where primaryemail='$pp'";
        $resultrevpaper= mysqli_query($link,$selectreviewer);  
        $filerevpaper = mysqli_fetch_assoc($resultrevpaper);
        $filefeedback = $filerevpaper['feedbackfile'];

        unlink('../documents/review/'.$filefeedback);
         
        $sqlreviewerdelete="DELETE FROM reviewertable WHERE primaryemail= '$pp' ";
        mysqli_query($link, $sqlreviewerdelete);
    }
    // Delete Reviewer section 


    // Delete Editor  section 
    $editoremail = array();
    $sqleditor = "SELECT editortable.id,editortable.paperid,editortable.primaryemail from editortable Where primaryemail='$email'";
    $queryeditor = $dbh->prepare($sqleditor); 
    $queryeditor ->execute(); 
    $resulteditor=$queryeditor->fetchAll(PDO::FETCH_OBJ); 
    $cnt=1;

    if($queryeditor->rowCount() > 0) 
    {
    foreach($resulteditor as $result) 
    { 
    $usernameeditor = htmlentities($result->primaryemail);
    array_push($editoremail,$usernameeditor);
    }}
    foreach($editoremail as $pp) {
        $selecteditor = "SELECT * FROM editortable where primaryemail='$pp'";
        $resulteditor= mysqli_query($link,$selecteditor);  
        $filerevpaper = mysqli_fetch_assoc($resulteditor);
        $filefeedback = $filerevpaper['feedbackfile'];

        unlink('../documents/review/'.$filefeedback);
        
        $sqlreditordelete="DELETE FROM editortable WHERE primaryemail= '$pp' ";
        mysqli_query($link, $sqlreditordelete);
    }
    // Delete Editor section 

 
$sql="DELETE FROM author WHERE id= '$id' ";

if(mysqli_query($link, $sql)){
    echo "<script>alert('Selected Authors were deleted successfully.')</script>";
    echo "<script type='text/javascript'> document.location = 'authors'; </script>";
    //header("refresh:0;url=authors"); 
} else{ 
    echo "<script>alert('Something went wrong')</script>";
    echo "<script type='text/javascript'> document.location = 'authors'; </script>";
    // header("refresh:0;url=authors");
    
}
 
// Close connection
header("Location: " . $_SERVER["HTTP_REFERER"]);
exit;
mysqli_close($link);

?>