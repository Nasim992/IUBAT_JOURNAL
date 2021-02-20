<?php

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
    $paper = array();
    $sqlacademiceditor = "SELECT paper.id,paper.paperid,paper.authoremail from paper Where authoremail='$email'";
    $queryacademiceditor = $dbh->prepare($sqlacademiceditor); 
    $queryacademiceditor ->execute(); 
    $resultacademiceditor=$queryacademiceditor ->fetchAll(PDO::FETCH_OBJ); 
    $cnt=1;

    if($queryacademiceditor->rowCount() > 0) 
    {
    foreach($resultacademiceditor as $result) 
    { 
    $usernameeditor = htmlentities($result->paperid);
    array_push($paper,$usernameeditor);
    }}
    foreach($paper as $pp) {
        $sqlpapdelete="DELETE FROM paper WHERE authoremail= '$pp' ";
        (mysqli_query($link, $sqlpapdelete));
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
        $sqlreviewerdelete="DELETE FROM reviewertable WHERE primaryemail= '$pp' ";
        (mysqli_query($link, $sqlreviewerdelete));
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
        $sqlreditordelete="DELETE FROM editortable WHERE primaryemail= '$pp' ";
        (mysqli_query($link, $sqlreditordelete));
    }
    // Delete Editor section 




// Select Email From the Author Table Sections ends Here 

// Select Paper Name Form the paper Table Section Starts Here 


// // Built-in PHP function to delete file
// unlink($_GET["name"]);
 
// // Redirecting back
// header("Location: " . $_SERVER["HTTP_REFERER"]);


$sql="DELETE FROM author WHERE id= '$id' ";

if(mysqli_query($link, $sql)){
    echo "Selected Authors were deleted successfully.";
    header("refresh:0;url=authors");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    header("refresh:0;url=authors");
}
 
// Close connection
mysqli_close($link);

?>