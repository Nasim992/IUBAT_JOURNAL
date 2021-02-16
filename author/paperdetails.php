<?php 
session_start();
error_reporting(0);
include '../link/config.php';
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
 
      // Paper description showing section starts here 

          //  Number of Feedback  count section starts here 

          $queryreviewerpermits = "SELECT COUNT(*) as total_rows FROM reviewertable where paperid='$id' and permits IS NOT NULL";
          $stmtpermits = $dbh->prepare($queryreviewerpermits);
                                  
           // execute query
           $stmtpermits->execute();
                                  
           // get total rows 
           $rowpermits = $stmtpermits->fetch(PDO::FETCH_ASSOC);
           $reviewed = $rowpermits['total_rows'];                         
                          
       // Number of Feedback count section ends here

    if (!empty($_GET['paperid'])) {
        $id=$_GET['paperid'];

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

    // Resubmit file path section
    $filepathresubmit ='../documents/resubmit/'.$file['resubmitpaper'];
    $filepathresubmitname = $file['resubmitpaper'];
    $fileresubmitdate = $file['resubmitdate'];
    // Resubmit file path section 

    $papername = $file['papername'];
    $authormail = $file['authoremail'];
    $abstract = $file['abstract'];
    $numberofcoauthor = $file['numberofcoauthor'];

    $uploaddate = $file['uploaddate'];

    $maindate = date("d-M-Y",strtotime($uploaddate));

    $cauname = unserialize($file['coauthorname']);

    $action = $file['action'];

    // Authorname selection starts here 
    $sql1 = "SELECT * FROM author WHERE  primaryemail= '$authormail' ";

    $result1 = mysqli_query($link,$sql1); 

    $file1 = mysqli_fetch_assoc($result1);

    $title = $file1['title'];
    $fname= $file1['firstname'];
    $middlename= $file1['middlename'];
    $lastname= $file1['lastname'];

    $authorname = $title.' '.$fname.' '.$middlename.' ' .$lastname;
    // Authorname selection section ends here 

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

    $arrayallusername = array();
    // Selecting All the username from the autor section starts here 
    $sqlreviewer = "SELECT username FROM author";
    $resultreviewer = mysqli_query($link,$sqlreviewer);
    $filereviewer = mysqli_fetch_assoc($resultreviewer);
        foreach($resultreviewer as $filerev) {
            array_push($arrayallusername,$filerev['username']);
      }
    // Selecting All the username from the author section ends here

// Resubmit paper section starts here 
  if(isset($_POST['resubmit']))
  { 
  $paperidresubmit = $_POST['resubmit-paperid'];
    // Full pdf if necessary info file section starts Here 
    $fileresubmit = $_FILES['fileresubmit'];
    $nameresubmit = $_FILES['fileresubmit']['name'];
    $filetmpresubmit = $_FILES['fileresubmit']['tmp_name']; 
    $typeresubmit = $_FILES['fileresubmit']['type'];
    $resubmitdate = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 0, date('Y')));

     // Full pdf if necessary info  File section ends here
 
     $sqlresubmit="update paper set resubmitpaper='$nameresubmit',resubmitdate='$resubmitdate' where paperid='$paperidresubmit'";
     
     if(mysqli_query($link, $sqlresubmit))
     {
        move_uploaded_file($filetmpresubmit,"../documents/resubmit/".$nameresubmit);
     echo "<script>alert('Paper Resubmitted Successfully.');</script>";
       header("refresh:0;url=paperstatus");
     }
     else {
         echo "<script>alert('Paper is already Resubmitted!');</script>";
         header("refresh:0;url=paperstatus");
 
     }   
}
// Resubmit paper section ends here

// Delete paper section starts here  
 
if(isset($_POST['deletepaper'])) { 
  $papid=($_POST['paperiddelete']);
  $file1 = $_POST['filepathtitle']; 
  $file2 = $_POST['filepathsecond']; 
  $file = $_POST['filepath'];
  $fileresubmit = $_POST['filepathresubmit'];

  $sqldelete="DELETE FROM paper WHERE paperid='$papid' ";
  $sqleditortable="DELETE FROM editortable WHERE paperid='$papid' ";
  $sqlreviewertable="DELETE FROM reviewertable WHERE paperid='$papid' ";
  if(mysqli_query($link, $sqldelete)){
    mysqli_query($link, $sqleditortable);
    mysqli_query($link, $sqlreviewertable);
    unlink($file1);
    unlink($file2 );
    unlink($file);
    unlink($fileresubmit);
    echo "<script>alert('Paper Deleted Successfully!');</script>";
      header("refresh:0;url=paperstatus"); 
  } else{
    echo "<script>alert('Could not be able to execute!');</script>";
      header("refresh:0;url=paperstatus"); 
  }

}
// Delete paper section ends here 


?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
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

<div id="mySidebar" class="sidebar">
  <?php
  include 'author-sidebar.php';
  ?>

</div> 

<div id="main">  

<a href="#"><span class="openbtn"onclick="openNav()" id="closesign">☰</span></a>
<a href="javascript:void(0)" class="closebtn" id="closesignof" onclick="closeNav()">×</a>
<div class="container"> 

  <h6>PAPER DETAILS</h6>
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
          if(!empty($cname)) {
            echo $cname.',';
          }
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
         <h6 style="font-size:15px;">Associate Editor:<span style='color:#122916;'> <small>
    <!-- Showing Selected editor Section Starts Here  -->
         <?php
             foreach( $associateeditorshowing  as $arrpap){
               $sqlnameeditorp = "SELECT title,firstname,middlename,lastname FROM author WHERE username='$arrpap'";
               $resultnameeditorp = mysqli_query($link,$sqlnameeditorp);
               $filenameeditorp = mysqli_fetch_assoc($resultnameeditorp);
               $fullname =  $filenameeditorp['title'].$filenameeditorp['firstname'].' '.$filenameeditorp['middlename'].' '.$filenameeditorp['lastname'];
               echo $fullname.' ';
             }
             echo "</small><h6 style='font-size:15px;'>Associate Editor:<span style='color:#122916;'> <small>";
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

     <p style="font-size:14px"><b>Abstract: </b><?php echo $abstract ?></p>
     <hr >

<div class="row">

<!-- <div class="col-sm-4 col-lg-3 col-md-3 col-xl-3">
<a style="font-size:13px;" title="Reviewer Feedback" class="">Reviewer Feedback:<?php echo $reviewed;?></a>
</div> -->
<!-- <div class="col-sm-4 col-lg-3 col-md-3 col-xl-3">
<a style="font-size:13px;" title="Reviewer Feedback" class="">Status:<span class="text-success">Satisfactory</span></a>
</div> -->


 
<div class="col-sm-4 col-lg-3 col-md-3 col-xl-3">

<form  method="post">
<input type="hidden" name="paperiddelete" value="<?php echo $id; ?>">
<input type="hidden" name="filepathtitle" value="<?php echo $filepathtitle; ?>">
<input type="hidden" name="filepathsecond" value="<?php echo $filepathsecond; ?>">
<input type="hidden" name="filepath" value="<?php echo $filepath; ?>">
<input type="hidden" name="filepathresubmit" value="<?php echo $filepathresubmit; ?>">


<button  type="submit" title="Delete"  class="bg-light" name="deletepaper" onclick="return confirm('Are you sure you want Delete this paper?');" style="border:none;color:red;margin-top:0px;"><i class="fas fa-trash-alt" title="Delete"></i></button>
</form>


</div> 
</div>


<!-- File Section starts here  -->
<hr>

<!-- Resubmit paper section starts here  -->
<?php if($action==1) { ?>
<form class="author-form"  method = "post" enctype = "multipart/form-data">
<div class="col-sm-12 col-lg-12 col-md-12">
<div class="input-group">
<label class="col-sm-6 col-form-label" for="formGroupExampleInput"><b>Resubmit paper :</b></label>
<div class="col-sm-6">
<input type="hidden" name="resubmit-paperid" value="<?php echo $id;?>">
<input type="file" class="form-control-file" name="fileresubmit"id="exampleFormControlFile1" accept = "application/pdf" required disabled>
</div>
</div>
<div class="row">
<div class="col-sm-6 col-lg-6 col-xl-6">
</div>
<?php if(empty($fileresubmitdate )) { ?>
<div class="col-sm-2 col-lg-2 col-xl-2">
<button class="btn btn-sm btn-info" name = "resubmit" type="submit" disabled>Submit</button>
</div>
<?php } else {?>
    <div class="col-sm-2 col-lg-2 col-xl-2">
<button class="btn btn-sm btn-info" name = "resubmit" type="submit" disabled>Submit</button>
</div>
<?php } ?>
</div>
</form>
<?php } else { ?>
  <form class="author-form"  method = "post" enctype = "multipart/form-data">
<div class="col-sm-12 col-lg-12 col-md-12">
<div class="input-group">
<label class="col-sm-6 col-form-label" for="formGroupExampleInput"><b>Resubmit paper :</b></label>
<div class="col-sm-6">
<input type="hidden" name="resubmit-paperid" value="<?php echo $id;?>">
<input type="file" class="form-control-file" name="fileresubmit"id="exampleFormControlFile1" accept = "application/pdf" required>
</div>
</div>
<div class="row">
<div class="col-sm-6 col-lg-6 col-xl-6">
</div>
<?php if(empty($fileresubmitdate )) { ?>
<div class="col-sm-2 col-lg-2 col-xl-2">
<button class="btn btn-sm btn-info" name = "resubmit" type="submit">Submit</button>
</div>
<?php } else {?>
    <div class="col-sm-2 col-lg-2 col-xl-2">
<button class="btn btn-sm btn-info" name = "resubmit" type="submit" disabled>Submit</button>
</div>
<?php } ?>
</div>
</form>
<?php  } ?>
<!-- Resubmit paper section ends here  -->

<hr class="bg-success">
<h6><small><b>Uploaded Files:</b></small></h6>
<div class="row">
<?php if(!empty($filename1)) { ?>
<div class="col-sm-4 col-lg-3 col-md-3 col-xl-3">
Full Manuscript as doc: <a style="font-size:13px;" title="Title and Abstract" class="" href="<?php echo $filepathtitle;?> "target ="_blank" role="button"><?php echo $filename1;  ?></a>
</div>
<?php } ?>

<?php if(!empty($filename2)) { ?>
<div class="col-sm-4 col-lg-3 col-md-3 col-xl-3">
Full Manuscript as pdf: <a style="font-size:13px;" title="Download this paper" class="" href="<?php echo $filepathsecond;?> "target ="_blank" role="button"><?php echo $filename2; ?></a>
</div>
<?php } ?>

<?php if(!empty($filename)) { ?>
<div class="col-sm-4 col-lg-3 col-md-3 col-xl-3">
Necessary Info: <a style="font-size:13px;" title="Download this paper" class="" href="<?php echo $filepath ?> "target ="_blank" role="button"><?php echo $filename;  ?></a>
</div>
<?php } ?>

<?php if(!empty($filepathresubmitname)) { ?>
<div class="col-sm-4 col-lg-3 col-md-3 col-xl-3">
Resubmitted paper: <a style="font-size:13px;" title="Download this paper" class="" href="<?php echo $filepathresubmit ?> "target ="_blank" role="button"><?php echo $filepathresubmitname;  ?></a>
</div>
<?php } ?>

</div> 
<!-- File Section Ends Here  -->
</div> 
<hr class="bg-success">

<!-- ------------------------------------------Feedback Timeline------------------------------------------------------------ -->
<p><b class="text-info">Feedback timeline:</b></p>
<?php 

// Select Reviewer Feedback section 
$sqlreviewerupdate = "SELECT * from reviewertable WHERE  paperid='$id' and permits=1";

$resultreviewerupdate = mysqli_query($link,$sqlreviewerupdate);

$filereviewerupdate = mysqli_fetch_assoc($resultreviewerupdate);

$feedbackfile = $filereviewerupdate['feedbackfile']; 

$feedbackfilepath = '../documents/review/'.$filereviewerupdate['feedbackfile'];

$feedback =  unserialize($filereviewerupdate['feedback']); 
$feedbackdate = unserialize($filereviewerupdate['feedbackdate']);
$authoremail = $filereviewerupdate['primaryemail']; 

  // Select Reviewer Feedback Section

  // Selet chiefeditor feedback 
  $sqlchief= "SELECT * from chieffeedback WHERE  paperid='$id'";

  $resultchief = mysqli_query($link,$sqlchief );

  $filechief = mysqli_fetch_assoc($resultchief);

  $feedbackchief = $filechief['feedback']; 
  $feedbackchieffile = $filechief['file']; 
  $feedbackchiefdatestring = $filechief['date']; 
  $feedbackchiefdate = date('d-M-Y',strtotime($feedbackchiefdatestring));

  $feedbackfilechiefpath = '../documents/review/'.$feedbackchieffile;
  // Select Chiefeditor feedback 

    // select Authorname
    include '../link/selectauthorname.php';
    // Select Authorname

    $revauthorname = $authorname;

  // Select editor feedback 

  $sqlreditorfeedback = "SELECT * from editortable WHERE  paperid='$id'";

  $resultreviewerupdate = mysqli_query($link, $sqlreditorfeedback);

  $fileeditorupdate = mysqli_fetch_assoc($resultreviewerupdate);

  $feedbackfileeditor = $fileeditorupdate['feedbackfile']; 

  $feedbackfilepatheditor = '../documents/review/'.$fileeditorupdate['feedbackfile'];

  $feedbackeditor =  unserialize($filereviewerupdate['feedback']); 
  $feedbackdateeditor = unserialize($filereviewerupdate['feedbackdate']);
  $authoremail = $filereviewerupdate['primaryemail']; 

  // Select Editor Feedback 

    // Select editor feedback 

    $sqlreditorfeedback = "SELECT * from editortable WHERE  paperid='$id'";

    $resultreviewerupdate = mysqli_query($link, $sqlreditorfeedback);
  
    $fileeditorupdate = mysqli_fetch_assoc($resultreviewerupdate);
  
    $feedbackfileeditor = $fileeditorupdate['feedbackfile']; 
  
    $feedbackfilepatheditor = '../documents/review/'.$fileeditorupdate['feedbackfile'];
  
    $feedbackeditor =  unserialize($fileeditorupdate['feedback']); 
    $feedbackdateeditor = unserialize($fileeditorupdate['feedbackdate']);
    $authoremail = $fileeditorupdate['primaryemail'];  
  
    // Select Editor Feedback 

     // select Authorname
     include '../link/selectauthorname.php';
     // Select Authorname
 

  // Reviewer Selection ends here 
  ?> 
  <!-- Review Showing Section starts here  -->

<?php if(!empty($feedbackchief)) {?>
<!-- ChiefEditor Feedback  -->
<div style="border:2px solid #e3e3e3;  padding:10px;margin-top:5px;border-radius:10px;">
  <p><?php echo $feedbackchief; ?></p>
  <div class="d-flex justify-content-between">
  <div>
  <p><b>Reviewed on: </b><small><?php echo $feedbackchiefdate; ?></small></p>
  </div>
  <div> 
  <p>- <small>Prof.Dr.Monjurul Islam</small></p>
  </div>
  </div>
  <?php if(!empty($feedbackchieffile)){?>
  <a style="font-size:14px;" class="btn btn-sm btn-info" href="<?php echo $feedbackfilechiefpath; ?> "target ="_blank" role="button">Feedback file</a>
  <?php  }  ?>
  </div>
<!-- Chief Editor Feedback -->
<?php  }  ?>
<?php 
  
  $maxnumber = max((count($feedback)),(count($feedbackeditor)));

  for ($x = $maxnumber-1; $x >=0 ; $x--) {
    $date = date('d-M-Y',strtotime($feedbackdate[$x]));
    $dateeditor = date('d-M-Y',strtotime($feedbackdateeditor[$x]));
    ?>
  <div style="border:2px solid #e3e3e3;  padding:10px;margin-top:5px;border-radius:10px;">
  <p><?php echo $feedback[$x]; ?></p>
  <div class="d-flex justify-content-between">
  <div>
  <p><b>Reviewed on: </b><small><?php echo $date; ?></small></p>
  </div>
  <div> 
  <p>- <small><?php echo $revauthorname; ?></small></p>
  </div>
  </div>

  <?php if(!empty($feedbackfile )){?>
  <a style="font-size:14px;" class="btn btn-sm btn-info" href="<?php echo $feedbackfilepath; ?> "target ="_blank" role="button">Feedback file</a>
  <?php  }  ?>
  </div>

  <div style="border:2px solid #e3e3e3;  padding:10px;margin-top:5px;border-radius:10px;">
  <p><?php echo $feedbackeditor[$x]; ?></p>
  <div class="d-flex justify-content-between">
  <div>
  <p><b>Reviewed on: </b><small><?php echo $dateeditor;?></small></p>
  </div>
  <div> 
  <p>- <small><?php echo $authorname; ?></small></p>
  </div>
  </div>
  
  <?php if(!empty($feedbackfileeditor )){?>
  <a style="font-size:14px;" class="btn btn-sm btn-info" href="<?php echo $feedbackfilepath; ?> "target ="_blank" role="button">Feedback file</a>
  <?php  }  ?>
  </div>



  <?php  } ?>

<!-- ------------------------------------------Feedback Timeline------------------------------------------------------------ -->
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
    header("refresh:0;url=paperstatus");
}
}
else {
    echo "<script>alert('You are not a Author.Try to log in as an Author');</script>";
    header("refresh:0;url=../login");
}
    }

    ?>