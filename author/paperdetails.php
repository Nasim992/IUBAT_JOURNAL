<?php 
session_start();
error_reporting(0);
include '../link/config.php';
include '../link/linklocal.php';
include('../functions.php');
if(strlen($_SESSION['alogin'])=="") 
    {    
    header("Location: ../login"); 
    }
    else
    {  
        $authoremail = $_SESSION["email"];

    // Check that the Author is logged in or not section starts here 

        $sql = "SELECT author.id,author.username,author.primaryemail,author.password,author.contact from author where primaryemail='$authoremail'"; 
        $query = $dbh->prepare($sql); 
        $query->execute(); 
        $results=$query->fetchAll(PDO::FETCH_OBJ); 
        $cnt=1;
        if($query->rowCount() > 0) 
        { 
    // Check that the Author is logged in or not section ends here 

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Paper description showing section starts here 

$id=strval($_GET['paperid']);

if (!empty($_GET['paperid'])) {
    $id=strval($_GET['paperid']);

$sql = "SELECT * FROM paper WHERE paperid = '$id'";
$result = mysqli_query($link,$sql);
$file = mysqli_fetch_assoc($result);

// Title File and Abstract Section Starts Here
$filepathtitle = '../documents/file1/'.$file['name1'];
$filepathmessagetitle = 'documents/file1/'.$file['name1'];
$filename1 = $file['name1'];
$type1 = $file['type1']; 
// Title File and Abstract Section Ends Here 

// Title second Section Starts Here
$filepathsecond = '../documents/file2/'.$file['name2'];
$filepathmessageseconod = 'documents/file2/'.$file['name2'];
$filename2 = $file['name2'];
$type2 = $file['type2']; 
// Title Second Section Ends Here 

// Main File Uploaded Section starts here 
$filepath = '../documents/'.$file['name'];
$filepathmessage = 'documents/'.$file['name'];
$filename = $file['name'];
$type = $file['type']; 
// Main File Uploaded Section Ends Here 


$papername = $file['papername'];
$authormail = $file['authoremail'];
$abstract = $file['abstract'];
$numberofcoauthor = $file['numberofcoauthor'];
$uploaddate = $file['uploaddate'];
$uploadmonth = $file['uploadmonth'];
$uploadyear = $file['uploadyear'];

$maindate = $uploaddate.' '.month($uploadmonth).' '.$uploadyear;

$cauname = unserialize($file['coauthorname']);

$sql1 = "SELECT * FROM author WHERE  primaryemail= '$authormail' ";

$result1 = mysqli_query($link,$sql1); 

$file1 = mysqli_fetch_assoc($result1);

$title = $file1['title'];
$fname= $file1['firstname'];
$middlename= $file1['middlename'];
$lastname= $file1['lastname'];

$authorname = $title.' '.$fname.' '.$middlename.' ' .$lastname;

// Paper description showing section ends here 

$arrayusernamereviewershowing = array();
// Show Reviewer Selection section starts Here
$sqlrshowing = "SELECT reviewertable.id,reviewertable.paperid,reviewertable.username,reviewertable.action from reviewertable Where paperid='$id' and action IS NULL";
$queryrshowing = $dbh->prepare($sqlrshowing); 
$queryrshowing->execute(); 
$resultrshowing=$queryrshowing->fetchAll(PDO::FETCH_OBJ); 
$cnt=1;
if($queryrshowing->rowCount() > 0) 
{

foreach($resultrshowing as $resultr) 
{ 

$usernamereviewer = htmlentities($resultr->username);
array_push($arrayusernamereviewershowing,$usernamereviewer);
}}
// Show Reviewer Selection Section ends here 

$arrayusernameeditorshowing = array();
// Editor showing section starts here here
$sqleshowing = "SELECT editortable.id,editortable.paperid,editortable.username,editortable.action from editortable Where paperid='$id' and action IS NULL";
$queryeshowing = $dbh->prepare($sqleshowing); 
$queryeshowing ->execute(); 
$resulteshowing=$queryeshowing ->fetchAll(PDO::FETCH_OBJ); 
$cnt=1;

if($queryeshowing->rowCount() > 0) 
{
foreach($resulteshowing as $result) 
{ 
$usernameeditor = htmlentities($result->username);
array_push($arrayusernameeditorshowing,$usernameeditor);
}}
// Editor showing section ends here

$arrayallusername = array();
// Selecting All the username from the autor section starts here 
$sqlreviewer = "SELECT username FROM author";
$resultreviewer = mysqli_query($link,$sqlreviewer);
$filereviewer = mysqli_fetch_assoc($resultreviewer);
    foreach($resultreviewer as $filerev) {
        array_push($arrayallusername,$filerev['username']);
   }
// Selecting All the username from the author section ends here

// Selecting Remaining Reviewer and Editor of the section starts here 
$emptyarray = array();
$resultreviewershown=array_diff($arrayallusername,$arrayusernamereviewershowing,$emptyarray);

$resulteditorshown=array_diff($arrayallusername,$arrayusernameeditorshowing,$emptyarray);

// Selecting Remaining Reviewer and Editor of the section ends here

?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/index.css">
    <title>Paper Details</title>
    <style>
        button[type="submit"]:hover {
         background-color:none !important;
     }
    </style>
</head> 
<body>
<!-- Author showing header sections starts  --> 
<div class="sticky-top header-floating">
<?php
include 'author-header.php';
?> 
</div> 
<!-- Author showing header sections ends   -->

<div id="mySidebar" class="sidebar mt-3">
  <?php
  include 'author-sidebar.php';
  ?>

</div> 

<div id="main">  

<a href="#"><span class="openbtn"onclick="openNav()" id="closesign">☰</span></a>
<a href="javascript:void(0)" class="closebtn" id="closesignof" onclick="closeNav()">×</a>
<div class="container"> 

  <h5>PAPER DETAILS</h5>
  <hr class="bg-secondary" >

  <div class="jumbotron">
     
     <h5 style="font-size:18px" class="display-4">Name : <?php echo $papername ?></h5>
     <h6 style="font-size:15px;" class="display-5">Paper ID:<span style='color:#122916;'> <?php echo $id; ?></span></h6>
     <h6 style="font-size:15px;" class="display-5">Uploaded on:<span style='color:#122916;'> <small><?php echo $maindate; ?></small></span></h6>

   <div class="d-flex justify-content-between">
         <p class="fontSize14px"><b>Author:</b> <?php echo $authorname ?></p>
      <a href="#"><p class="fontSize14px">Number of Co-Author:0<?php echo $numberofcoauthor;?></p></a>
         </div>
     
         <div class="d-flex justify-content-between">
         <p class="fontSize14px"><b>Email:</b> <?php echo $authormail;?></p>
         <p class="fontSize14px"><b>Co-Authors:</b>[<?php 
        //  Showing Co Author Name section starts here 
        foreach($cauname as $cname) {
          echo $cname.' ';
        }
        // Showing Co-Author Name Section ends here 
         ?>]</p>
         </div>
         <div class="d-flex justify-content-between">

         <div>
         <h6 style="font-size:15px;" class="display-5">Reviewer:<span style='color:#122916;'> <small>

         <!-- Show Reviewer Selection section starts Here  -->
         <?php
           foreach( $arrayusernamereviewershowing  as $arrpap){
            $sqlnameeditorr = "SELECT title,firstname,middlename,lastname FROM author WHERE username='$arrpap'";
            $resultnameeditorr = mysqli_query($link,$sqlnameeditorr);
            $filenameeditorr = mysqli_fetch_assoc($resultnameeditorr);
            $fullname =  $filenameeditorr['title'].$filenameeditorr['firstname'].' '.$filenameeditorr['middlename'].' '.$filenameeditorr['lastname'];
            echo $fullname.' ';
          }
     ?>
     <!-- Show Reviewer Selection Section ends here -->

         
         </small></span></h6>
         </div>
         <div>
         <h6 style="font-size:15px;" class="display-5">Editor:<span style='color:#122916;'> <small>
    <!-- Showing Selected editor Section Starts Here  -->
         <?php
             foreach( $arrayusernameeditorshowing  as $arrpap){
               $sqlnameeditorp = "SELECT title,firstname,middlename,lastname FROM author WHERE username='$arrpap'";
               $resultnameeditorp = mysqli_query($link,$sqlnameeditorp);
               $filenameeditorp = mysqli_fetch_assoc($resultnameeditorp);
               $fullname =  $filenameeditorp['title'].$filenameeditorp['firstname'].' '.$filenameeditorp['middlename'].' '.$filenameeditorp['lastname'];
               echo $fullname.' ';
             }
     ?>
    <!-- Showing Selected editor section ends here -->
         </small></span></h6>
         </div>

         </div>

     <p style="font-size:14px"><b>Abstract: </b><?php echo $abstract ?></p>
     <hr >

<div class="row">

<div class="col-sm-4 col-lg-3 col-md-3 col-xl-3">
<a style="font-size:13px;" title="Reviewer Feedback" class="">Reviewer Feedback:0</a>
</div>
<div class="col-sm-4 col-lg-3 col-md-3 col-xl-3">
<a style="font-size:13px;" title="Reviewer Feedback" class="">Status:<span class="text-success">Satisfactory</span></a>
</div>

<div class="col-sm-4 col-lg-3 col-md-3 col-xl-3">
<a href="delete-paper.php?id=<?php echo $id; ?>&name=<?php echo $filepath; ?>"onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash-alt" title="Delete"></i></a>
</div> 
</div>
<!-- File Section starts here  -->
<hr class="bg-success">
<h6><small><b>Uploaded Files:</b></small></h6>
<div class="row">

<div class="col-sm-4 col-lg-4 col-md-3 col-xl-4">
1.Title and Abstract: <a style="font-size:13px;" title="Title and Abstract" class="" href="<?php echo $filepathtitle;?> "target ="_blank" role="button"><?php echo $filename1;  ?></a>
</div>
<div class="col-sm-4 col-lg-4 col-md-3 col-xl-4">
2.Full Manuscript: <a style="font-size:13px;" title="Download this paper" class="" href="<?php echo $filepathsecond;?> "target ="_blank" role="button"><?php echo $filename2; ?></a>
</div>
<div class="col-sm-4 col-lg-4 col-md-3 col-xl-4">
3.Necessary Info: <a style="font-size:13px;" title="Download this paper" class="" href="<?php echo $filepath ?> "target ="_blank" role="button"><?php echo $filename;  ?></a>
</div>
</div>
<!-- File Section Ends Here  -->
</div> 
<hr class="bg-success">

<p><b class="text-info">Feedback timeline:</b></p>
<!-- Feedback Section Starts Here  -->
<?php
     $sqlreviewertable = "SELECT reviewertable.id,reviewertable.paperid,reviewertable.username,reviewertable.feedback,reviewertable.action,reviewertable.permits from reviewertable Where paperid='$id' and feedback IS NOT NULL and permits=1";
     $querytable = $dbh->prepare($sqlreviewertable); 
     $querytable->execute(); 
     $resultreviewertable=$querytable->fetchAll(PDO::FETCH_OBJ); 
     $cnt=1;
     if( $querytable->rowCount() > 0) 
     {
     foreach($resultreviewertable as $result) 
     { 

        $feedback =   htmlentities($result->feedback);
        $feedbackauthor =   htmlentities($result->username);

      $authoremail = htmlentities($result->authoremail);
      $sql1 = "SELECT * FROM author WHERE  username= '$feedbackauthor' ";

      $result1 = mysqli_query($link,$sql1); 

      $file1 = mysqli_fetch_assoc($result1);
      
      $title = $file1['title']; 
      $fname= $file1['firstname'];
      $middlename= $file1['middlename'];
      $lastname= $file1['lastname'];

      $authorname = $title.' '.$fname.' '.$middlename.' ' .$lastname;

  ?>
  <div style="border:2px solid #e3e3e3;  padding:10px;margin-top:5px;border-radius:10px;">
  <p><?php echo $feedback ?></p>
  <div class="d-flex justify-content-between">
<div>

        </div>
        <div>
        <p><small><b> - &nbsp<?php echo $authorname; ?></b></small></p>
        </div>
          </div>
       
          </div>

<?php   }}  ?>
<!-- Feedback Section Ends Here  -->






    <div class="pb-5"></div>

    </div>
    </div>

<!-- Essential Js,jquery,section starts  -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-3.5.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
<!-- Essential Js,Jquery  section ends  -->
</body>
</html>


<?php 
}
else {
    echo "<script>alert('You are not selecting Anything');</script>";
    header("refresh:0;url=authorpaperstatus");
}
}
else {
    echo "<script>alert('You are not a Author.Try to log in as an Author');</script>";
    header("refresh:0;url=../login");
}
    }

    ?>