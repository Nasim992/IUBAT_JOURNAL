<?php 
session_start();
error_reporting(0);
include '../link/config.php';
include '../functions.php';
if(strlen($_SESSION['alogin'])=="")
    {    
    header("Location:../login"); 
    } 
    else
    {  
      $email =  $_SESSION['alogin'];
     // Check that the Associate Editor is logged in or not section starts here 

     $sql = "SELECT author.id,author.username,author.primaryemail,author.password,author.contact,author.associateeditor from author where primaryemail='$email' and associateeditor IS NOT NULL"; 
     $query = $dbh->prepare($sql); 
     $query->execute(); 
     $results=$query->fetchAll(PDO::FETCH_OBJ); 
     $cnt=1;
     if($query->rowCount() > 0) 
     {
     // Check that the Associate Editor  is logged in or not section ends here 

if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Paper description showing section starts here 

$idstr=strval($_GET['id']);
 
$unpublished = $idstr[-1];

$id=rtrim($_GET['id'],"u");

if (!empty($_GET['id'])) {
$id=rtrim($_GET['id'],"u");

$sql = "SELECT * FROM paper WHERE paperid = '$id' and action=0";
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


// Resubmit paper Section starts here 
$filepathresubmit = '../documents/resubmit/'.$file['resubmitpaper'];
$filepathmessageresubmit = 'documents/resubmit/'.$file['resubmitpaper'];
$filenameresubmit = $file['resubmitpaper'];
// Resubmit paper Section Ends Here 


$papername = $file['papername'];
$authormail = $file['authoremail'];
$abstract = $file['abstract'];
$numberofcoauthor = $file['numberofcoauthor'];

$uploaddatestring = $file['uploaddate'];

$maindate = date("d-M-Y",strtotime($uploaddatestring ));;

$cauname = unserialize($file['coauthorname']);


// Select Author Name Section starts here 
$sql1 = "SELECT * FROM author WHERE  primaryemail= '$authormail' ";

$result1 = mysqli_query($link,$sql1); 

$file1 = mysqli_fetch_assoc($result1);

$title = $file1['title'];
$fname= $file1['firstname'];
$middlename= $file1['middlename'];
$lastname= $file1['lastname'];

$authorname = $title.' '.$fname.' '.$middlename.' ' .$lastname;
// Select Author Name Section Ends Here 

// Paper description showing section ends here 

// Accept Paper section starts Here
 
if(isset($_POST['accept-paper']))
{
    $id = $_POST['acceptid']; 
    $action = 1;

    $pdate = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 0, date('Y')));

    $sql="update paper set action=$action,pdate='$pdate',reject=NULL,rejectdate=NULL where paperid='$id' ";

    if(mysqli_query($link, $sql))
    {
    //Accepted paper  Starts Here 
    include '../mailmessage/acceptpaper.php';
    // Accepted paper Section Ends Here 
      send_email($authormail, $subject, $msg, $headers);
    echo "<script>alert('Paper accepted...');</script>";
      header("refresh:0;url=unpublishedpaper");
    }
    else {
        echo "<script>alert('Paper is already Accepted!');</script>";
        header("refresh:0;url=unpublishedpaper");

    }
}
// Accept Paper section ends here
// Reject paper section starts here 

if(isset($_POST['reject-paper']))
{ 
    $id = $_POST['rejectid'];
    $action = 1;

    $rejectdate = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 0, date('Y')));


    $sql="update paper set action=0,pdate=NULL,reject=$action,rejectdate='$rejectdate' where paperid='$id' ";

    if(mysqli_query($link, $sql))
    {
    //Accepted paper  Starts Here 
    include '../mailmessage/rejectpaper.php';
    // Accepted paper Section Ends Here 
      send_email($authormail, $subject, $msg, $headers);
    echo "<script>alert('Paper Rejected');</script>";
      header("refresh:0;url=unpublishedpaper");
    }
    else {
        echo "<script>alert('Something went wrong');</script>";
        header("refresh:0;url=unpublishedpaper");

    }
} 

// Reject paper section ends here 

// Sending Review to the author section starts here 
if(isset($_POST['send-review']))
{
    $id = $_POST['paperidrev'];
    $primaryemail = $_POST['primaryemailrev'];
    $authornamsender = $_POST['authorenamsender'];
    $authoremailsender = $_POST['authoremailrev'];
    $action = 1;

    // Send Review Message Section Starts Here 
    include '../mailmessage/sendreview.php';
    // Send Review Message Section Ends Here 
    $sql="update reviewertable set permits=$action where paperid='$id' and primaryemail='$primaryemail' ";
    if(mysqli_query($link, $sql))
    {
    send_email($authoremailsender, $subject, $msg, $headers);
    echo "<script>alert('Send this Review to the author Successfully.');</script>";
      // header("refresh:0;url=unpublished-paper");
    }
    else {
        echo "<script>alert('Already sent!');</script>";
        // header("refresh:0;url=unpublished-paper");

    }
}
// Sending Review to the author section ends here 



// Reviewer Selection Section starts here 
if(isset($_POST['select-reviewer']))
{
    $usernameauthor = $_POST['authornameselect']; 
    $pemail = $_POST['primaryemail'];
    // echo $usernameauthor;
    $sqlauthorselect = "SELECT primaryemail FROM author WHERE username = '$usernameauthor'";
    $resultauthorselect = mysqli_query($link,$sqlauthorselect);
    $fileauthorselect = mysqli_fetch_assoc($resultauthorselect);
    $primaryemail = $fileauthorselect['primaryemail'];

    $assigndate = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 0, date('Y')));
    $endingdate = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 7, date('Y')));

    $sqlinsert="INSERT INTO reviewertable (paperid,username,primaryemail,assigndate,endingdate) VALUES('$id','$usernameauthor','$primaryemail','$assigndate','$endingdate')";

    $reviewerselection =1;
    $sqlupdatereviewer = "update author set reviewerselection=$reviewerselection where username = '$usernameauthor' ";
     
    if(mysqli_query($link, $sqlinsert) and (mysqli_query($link, $sqlupdatereviewer)))
    {
 
      // Sending Messages that selected as a reviewer section starts here.
      include '../mailmessage/reviewerselected.php';
      // Sending Messages that selected as a reviewer section ends 
      send_email($pemail, $subject, $msg, $headers);
     echo "<script>alert('Review Requested sent Successfully for this paper');</script>";
    //   header("refresh:0;url=unpublished-paper.php");
    }
    else {
        echo "<script>alert('Something Went Wrong');</script>";
        // header("refresh:0;url=unpublished-paper.php");


    }
}
// Reviewer Selection Section Ends Here 

// Associate Editor Selection section starts here 
// if(isset($_POST['select-associate-editor']))
// {
//     $usernameauthor = $_POST['authornameselect']; 
//     // echo $usernameauthor;
//     $sqlauthorselect = "SELECT primaryemail FROM author WHERE username = '$usernameauthor'";
//     $resultauthorselect = mysqli_query($link,$sqlauthorselect);
//     $fileauthorselect = mysqli_fetch_assoc($resultauthorselect);
//     $pemail = $fileauthorselect['primaryemail']; 
//     $associateeditor = 1;
//     $assigndate = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 0, date('Y')));

//     $endingdate = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 7, date('Y')));

//       $sqlinsert="INSERT INTO editortable(paperid,username,primaryemail,assigndate,endingdate,associateeditor) VALUES('$id','$usernameauthor','$pemail','$assigndate','$endingdate','$associateeditor')";
//       if(mysqli_query($link, $sqlinsert))
//       {
//               // Sending Messages that selected as a Editor section starts here.
//               include '../mailmessage/editorselected.php';
//               // Sending Messages that selected as a Editor section ends 
//               send_email($pemail, $subject, $msg, $headers);
//       echo "<script>alert('Editor Selected Successfully for this paper');</script>";
//       //   header("refresh:0;url=unpublished-paper.php");
//       }
//       else {
//           echo "<script>alert('Something Went Wrong');</script>";
//           // header("refresh:0;url=unpublished-paper.php");
//       }
// }
// Associate Editor selection section ends here 


// Academic  Editor Selection section starts here 

if(isset($_POST['select-academic-editor']))
{
    $usernameauthor = $_POST['authornameselect']; 
    // echo $usernameauthor;
    $sqlauthorselect = "SELECT primaryemail FROM author WHERE username = '$usernameauthor'";
    $resultauthorselect = mysqli_query($link,$sqlauthorselect);
    $fileauthorselect = mysqli_fetch_assoc($resultauthorselect);
    $pemail = $fileauthorselect['primaryemail']; 
    $academiceditor =1;
    $assigndate = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 0, date('Y')));

    $endingdate = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 7, date('Y')));

    $sqlinsert1="INSERT INTO editortable(paperid,username,primaryemail,assigndate,endingdate,academiceditor) VALUES('$id','$usernameauthor','$pemail','$assigndate','$endingdate','$academiceditor')";
      if(mysqli_query($link, $sqlinsert1))
      {
              // Sending Messages that selected as a Editor section starts here.
              include '../mailmessage/editorselected.php';
              // Sending Messages that selected as a Editor section ends 
              send_email($pemail, $subject, $msg, $headers);
      echo "<script>alert('Editor Selected Successfully for this paper');</script>";
      //   header("refresh:0;url=unpublished-paper.php");
      }
      else {
          echo "<script>alert('Something Went Wrong');</script>";
          // header("refresh:0;url=unpublished-paper.php");
      }
      
}

// Academic Editor Selection Ends Here 

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


$associateeditorshowing = array();
// Associate Editor showing section starts here
$sqlassociateeditor = "SELECT editortable.id,editortable.paperid,editortable.username,editortable.action,editortable.accepted,editortable.associateeditor from editortable Where paperid='$id' and action IS NULL and associateeditor IS NOT NULL";
$queryassociateeditor = $dbh->prepare($sqlassociateeditor); 
$queryassociateeditor ->execute(); 
$resultassociateeditor=$queryassociateeditor ->fetchAll(PDO::FETCH_OBJ); 
$cnt=1;

if($queryassociateeditor->rowCount() > 0) 
{
foreach($resultassociateeditor as $result) 
{ 
$usernameeditor = htmlentities($result->username);
array_push($associateeditorshowing,$usernameeditor);
}}
// Associate  Editor showing section ends here



$academiceditorshowing = array();
// Academic Editor showing section starts here
$sqlacademiceditor = "SELECT editortable.id,editortable.paperid,editortable.username,editortable.action,editortable.accepted,editortable.academiceditor from editortable Where paperid='$id' and action IS NULL  and academiceditor IS NOT NULL";
$queryacademiceditor = $dbh->prepare($sqlacademiceditor); 
$queryacademiceditor ->execute(); 
$resultacademiceditor=$queryacademiceditor ->fetchAll(PDO::FETCH_OBJ); 
$cnt=1;

if($queryacademiceditor->rowCount() > 0) 
{
foreach($resultacademiceditor as $result) 
{ 
$usernameeditor = htmlentities($result->username);
array_push($academiceditorshowing,$usernameeditor);
}}
// Academic Editor section ends here 


$arrayallusernameassociateeditor = array();
// Select All username of Associate Editor section
$sqlassociateeditor100 = "SELECT username FROM author where associateeditor IS NOT NULL";
$resultassociateeditor100 = mysqli_query($link,$sqlassociateeditor100);
$fileassociateeditor= mysqli_fetch_assoc($resultassociateeditor100);
    foreach($resultassociateeditor100 as $filerev) {
        array_push($arrayallusernameassociateeditor,$filerev['username']);
   }
// Select All Username of Associate Editor Section 

$arrayallusernameacademiceditor = array();
// Select All username of Academic Editor section starts here 
$sqlacademiceditor100 = "SELECT username FROM author where academiceditor IS NOT NULL";
$resultacademiceditor100 = mysqli_query($link,$sqlacademiceditor100);
$fileacademiceditor100 = mysqli_fetch_assoc($resultacademiceditor100);
    foreach($resultacademiceditor100 as $filerev) {
        array_push($arrayallusernameacademiceditor,$filerev['username']);
   }
// Select All Username of Academic Editor Section ends here 


$arrayallusername = array();
// Selecting All the username from the autor section starts here 
$sqlreviewer = "SELECT username FROM author where associateeditor IS  NULL and academiceditor IS  NULL";
$resultreviewer = mysqli_query($link,$sqlreviewer);
$filereviewer = mysqli_fetch_assoc($resultreviewer);
    foreach($resultreviewer as $filerev) {
        array_push($arrayallusername,$filerev['username']);
   }
// Selecting All the username from the author section ends here


// Selecting Remaining Reviewer and Editor of the section starts here 
$emptyarray = array();
$resultreviewershown=array_diff($arrayallusername,$arrayusernamereviewershowing,$emptyarray);

$resultassociateeditorshown=array_diff($arrayallusernameassociateeditor,$associateeditorshowing,$emptyarray);

$resultacademiceditorshown=array_diff($arrayallusernameacademiceditor,$academiceditorshowing,$emptyarray);

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
    <title>Select Reviewer and Author</title>
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
include 'header.php';
?> 
</div> 
<!-- Author showing header sections ends-->

<div id="mySidebar" class="sidebar">
  <?php
  include 'sidebar.php';
  ?>

</div> 

<div id="main">  

<a href="#"><span class="openbtn"onclick="openNav()" id="closesign">☰</span></a>
<a href="javascript:void(0)" class="closebtn" id="closesignof" onclick="closeNav()">×</a>
<div class="container"> 

  <h5>UNPUBLISHED PAPER</h5>
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
           foreach( $arrayusernamereviewershowing as $arrpap){
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
         <h6 style="font-size:15px;" class="display-5"> Associate Editor:<span style='color:#122916;'> <small>
    <!-- Showing Selected editor Section Starts Here  -->
         <?php
             foreach( $associateeditorshowing  as $arrpap){
               $sqlnameeditorp = "SELECT title,firstname,middlename,lastname FROM author WHERE username='$arrpap'";
               $resultnameeditorp = mysqli_query($link,$sqlnameeditorp);
               $filenameeditorp = mysqli_fetch_assoc($resultnameeditorp);
               $fullname =  $filenameeditorp['title'].$filenameeditorp['firstname'].' '.$filenameeditorp['middlename'].' '.$filenameeditorp['lastname'];
               echo $fullname.' ';
             }
     ?>
    <!-- Showing Selected editor section ends here -->
         </small></span></h6>
         <h6 style="font-size:15px;" class="display-5"> Academic Editor:<span style='color:#122916;'> <small>
    <!-- Showing Selected editor Section Starts Here  -->
         <?php
             foreach( $academiceditorshowing  as $arrpap){
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

     <p style="font-size:14px"><b>Abstract:&nbsp</b><?php echo $abstract ?></p>
     <hr >

<div class="row">

<!-- <div class="col-sm-4 col-lg-3 col-md-3 col-xl-3">
<a href="reviewerdetails"  style="font-size:13px;" title="Reviewer Feedback" class="">Reviewer Feedback:0</a>
</div> -->
<!-- <div class="col-sm-4 col-lg-3 col-md-3 col-xl-3">
<a style="font-size:13px;" title="Reviewer Feedback" class="">Editor Feedback:0</a>
</div> -->
<!-- <div class="col-sm-4 col-lg-3 col-md-3 col-xl-3">
<a style="font-size:13px;" title="Reviewer Feedback" class="">Status:<span class="text-success">Satisfactory</span></a>
</div> -->

<div class="col-sm-4 col-lg-3 col-md-3 col-xl-3">
</div> 
</div>
<!-- File Section starts here  -->
<hr class="bg-success">
<h6><small><b>Uploaded Files:</b></small></h6>
<div class="row">
 
<?php  if(!empty($filename1)) {  ?>
<div class="col-sm-4 col-lg-4 col-md-3 col-xl-4">
Title and Abstract: <a style="font-size:13px;" title="Title and Abstract" class="" href="<?php echo $filepathtitle;?> "target ="_blank" role="button"><?php echo $filename1;  ?></a>
</div>
<?php } ?>
<?php  if(!empty($filename2)) {  ?>
<div class="col-sm-4 col-lg-4 col-md-3 col-xl-4">
Full Manuscript: <a style="font-size:13px;" title="Download this paper" class="" href="<?php echo $filepathsecond;?> "target ="_blank" role="button"><?php echo $filename2; ?></a>
</div>
<?php } ?>
<?php  if(!empty($filename)) {  ?>
<div class="col-sm-4 col-lg-4 col-md-3 col-xl-4">
Necessary Info: <a style="font-size:13px;" title="Download this paper" class="" href="<?php echo $filepath; ?> "target ="_blank" role="button"><?php echo $filename;  ?></a>
</div>
<?php } ?> 

<?php  if(!empty($filenameresubmit)) {  ?>
<div class="col-sm-4 col-lg-4 col-md-3 col-xl-4">
Resubmitted paper: <a style="font-size:13px;" title="Download this paper" class="" href="<?php echo $filepathresubmit; ?> "target ="_blank" role="button"><?php echo $filenameresubmit;  ?></a>
</div>
<?php } ?>

</div>
<!-- File Section Ends Here  -->

</div>
<hr class="bg-success">
 <!-- DashBoard Section ends  -->
 <div class="row">

<!-- Academic Editor Section starts here  -->
<div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
 <h3 style="font-size:17px" class="text-dark "><b class="text-info"><i>Select Academic Editor of this paper</i></b></h3>
  <hr class="bg-success">

  <?php
  $sel1 = 0;
  foreach($resultacademiceditorshown as $arrname){
    $sqlnamenibo = "SELECT title,firstname,middlename,lastname,primaryemail,academiceditor FROM author WHERE username='$arrname'";
    $resultnamenibo = mysqli_query($link,$sqlnamenibo);
    $filenamenibo = mysqli_fetch_assoc($resultnamenibo);
    $fullname =  $filenamenibo['title'].$filenamenibo['firstname'].' '.$filenamenibo['middlename'].' '.$filenamenibo['lastname'];
    $primaryemail = $filenamenibo['primaryemail'];
    ?>
   <form  method="post">
   <div class="row">
   <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
   <label  for="formGroupExampleInput"><b style="font-size:14px;"><?php echo $sel1+1 ?>.<span><?php echo $fullname ?></b></span></label>
     <input type="hidden" id="custId" name="authornameselect" value="<?php echo $arrname ?>">
     <input type="hidden" name="primaryemail" value="<?php echo $primaryemail; ?>">
   </div>
   <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
    <button style="font-size:10px;" onclick="return confirm('Send Review Request to this author?');" class="btn btn-sm btn-secondary form-control mt-0" type="submit" name="select-academic-editor"><b>Select</b></button>
     </div>
   </div>
    </form>
     <?php 
    $sel1 = $sel1 +1;   
    }
    ?>
  </div>
<!-- Academic Editor Section ends here -->


  <!-- Reviewer Selection starts Here  -->
  <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">

  <h3 style="font-size:17px" class="text-info "><b><i>Select Reviewer of this paper</i></b></h3>
  <hr class="bg-success">

  <?php
  $selection = 0;
  foreach($resultreviewershown as $arrname){
    $sqlnamenibo = "SELECT title,firstname,middlename,lastname,primaryemail FROM author WHERE username='$arrname'";
    $resultnamenibo = mysqli_query($link,$sqlnamenibo);
    $filenamenibo = mysqli_fetch_assoc($resultnamenibo);
    $fullname =  $filenamenibo['title'].$filenamenibo['firstname'].' '.$filenamenibo['middlename'].' '.$filenamenibo['lastname'];
    $primaryemail = $filenamenibo['primaryemail'];

    ?>
   <form  method="post">
   <div class="row">
   <div class="col-sm-12 col-md-6 col-lg-8 col-xl-8">
   <label  for="formGroupExampleInput"><b style="font-size:14px;"><?php echo $selection+1 ?>.<span><?php echo $fullname ?></b></span></label>
     <input type="hidden" id="custId" name="authornameselect" value="<?php echo $arrname ?>">
     <input type="hidden" name="primaryemail" value="<?php echo $primaryemail; ?>">
   </div>
   <div class="col-sm-12 col-md-6 col-lg-4 col-xl-4">
    <button style="font-size:10px;" onclick="return confirm('Send Review Request to this author?');" class="btn btn-sm btn-secondary form-control mt-0" type="submit" name="select-reviewer"><b>Select</b></button>
     </div>
   </div>
    </form>
     <?php 
    $selection = $selection +1;   
    }
           ?>
  </div>
  <!-- Reviewer Selection section ends here -->

  </div>


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


<?php } else  {

echo "<script>alert('You are trying with wrong direction');</script>";
header("refresh:0;url=unpublished-paper");
    } 
  }
  else {
    echo "<script>alert('You are not a AssociateEditor.Try to log in as an Author');</script>";
    header("refresh:0;url=../login");
  }
  
  
  }
  
    ?>