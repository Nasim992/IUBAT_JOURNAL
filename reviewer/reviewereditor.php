<?php
session_start();
error_reporting(0);
include('../link/config.php');
if(strlen($_SESSION['alogin'])=="")
    {     
    header("Location: ../login");  
    }
    else
    {  
      $email =  $_SESSION['alogin'];

              // Check that the Author is logged in or not section starts here 

              $sql = "SELECT author.id,author.username,author.primaryemail,author.password,author.contact from author where primaryemail='$email' and reviewerselection IS NOT NULL"; 
              $query = $dbh->prepare($sql); 
              $query->execute(); 
              $results=$query->fetchAll(PDO::FETCH_OBJ); 
              $cnt=1;
              if($query->rowCount() > 0) 
              {
            // Check that the Author is logged in or not section ends here 


      // Reviewer Paper Section Starts Here
      if(isset($_POST['reviewer-feedbacks'])) {
        $paperid = $_POST['paperid'];
      }
 
      if(isset($_POST['reviewer-update'])) {
        $paperid = $_POST['paperid'];
        $email = $_POST['authoremail']; 
        $feedbackinput = $_POST['reviewer-review'];
        $feedbackdateinput = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 0, date('Y')));

               // Full pdf if necessary info file section starts Here 
               $filereviewer = $_FILES['reviewerfile'];
               $namereviewer = $_FILES['reviewerfile']['name']; 
               $filetmpreviewer = $_FILES['reviewerfile']['tmp_name'];
               $typereviewer = $_FILES['reviewerfile']['type'];
               // Full pdf if necessary info  File section ends here

        // Select Previous review of this paper 
        $sqlselectpfeedback = "SELECT * FROM reviewertable WHERE  paperid= '$paperid' and primaryemail='$email'";
        $resultpfeedback = mysqli_query($link,$sqlselectpfeedback); 
        $filepfeedback = mysqli_fetch_assoc($resultpfeedback);
         $pfeedback = unserialize($filepfeedback['feedback']);
         $pfeedbackfname = $filepfeedback['feedbackfile'];
         $pfeedbackdate = unserialize($filepfeedback['feedbackdate']);
        // Select Previous review of this paper  
          if(empty($namereviewer )) {
            $pfeedbackfname = $filepfeedback['feedbackfile'];
          }
          else  {
            $pfeedbackfname = $namereviewer;
            $filefpath = '../documents/review/'.$pfeedbackfname;
            unlink( $filefpath);
          }
         array_push($pfeedback,$feedbackinput);
         array_push($pfeedbackdate,$feedbackdateinput);
        $feedback = serialize($pfeedback);
        $feedbackdate = serialize($pfeedbackdate);

        $sqlreviewer="update reviewertable set feedback='$feedback',feedbackdate='$feedbackdate',feedbackfile='$pfeedbackfname' where paperid='$paperid' and primaryemail='$email'"; 

        if(mysqli_query($link, $sqlreviewer))
        {
          move_uploaded_file($filetmpreviewer,"../documents/review/".$namereviewer);
          echo "<script>alert('Feedback Sent Successfully');</script>"; 
          // header("refresh:0;url=reviewed-paper");
        }
        else {
          echo "<script>alert('Something went wrong');</script>";
          // header("refresh:0;url=reviewed-paper");
        }

      }
      // Reviewer Paper Section Ends Here 

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviewer Feedback</title>
    <link rel="shortcut icon" href="../images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/heading.css">
    <link rel="stylesheet" href="../css/index.css">
    <!-- <link rel="stylesheet" href="css/admin-dashboard.css"> -->
</head> 
<body>
<!-- Author showing header sections starts  --> 
<div class="sticky-top header-floating">
<?php
include 'reviewer-header.php';
?> 
</div>
<!-- Author showing header sections ends   -->
<div id="mySidebar" class="sidebar">
  <?php 
  include 'reviewer-sidebar.php';
  ?>
</div> 

<div id="main">  

<a href="#"><span class="openbtn"onclick="openNav()" id="closesign">☰</span></a>
<a href="javascript:void(0)" class="closebtn" id="closesignof" onclick="closeNav()">×</a>
<div class="container"> 
<!-- ------------------------------ Edit feedback section --------------------------------------- -->

<h6>REVIEWED PAPER</h6>
<hr>

<!-- Paper SHowing Section Starts Here  -->

<?php
 
// Selecting Paper section starts Here
$sqlreviewerselection = "SELECT paper.id,paper.paperid,paper.authoremail,paper.papername,paper.abstract,paper.name,paper.type,paper.action,paper.numberofcoauthor,paper.pdate,paper.uploaddate,paper.coauthorname,paper.name1,paper.name2 from paper WHERE  paperid='$paperid'";

$resultreviewerselection = mysqli_query($link,$sqlreviewerselection);

$filereviewerselection = mysqli_fetch_assoc($resultreviewerselection);

$id =  $filereviewerselection['paperid']; 
$papername = $filereviewerselection['papername'];
$numberofcoauthor = $filereviewerselection['numberofcoauthor'];
$abstract = $filereviewerselection['abstract'];
$authoremailpaper = $filereviewerselection['authoremail'];
$name = $filereviewerselection['name'];
$filepath1 = '../documents/file1/'.$filereviewerselection['name1']; 
$filepath2 = '../documents/file2/'.$filereviewerselection['name2']; 
$type = $filereviewerselection['type'];
$action = $filereviewerselection['action'];

$uploaddatestring = $filereviewerselection['uploaddate'];
$uploaddate = date("d-M-Y",strtotime($uploaddatestring));

$type = $filereviewerselection['type'];
$pdatestring = $filereviewerselection['pdate'];
$pdate = date("d-M-Y",strtotime($pdatestring));

$cauname = $filereviewerselection['coauthorname'];;
        
?>

<div class="jumbotron mt-0" > 

<div class="d-flex justify-content-between">
<div>
<p class="fontSize14px">Paper ID : <?php echo $id;?></p>
</div>
<div>
<p class="fontSize14px"><b> Status: <?php

if ($action!=1) {
    ?>
    <span style="color:goldenrod;">
   <?php  echo "Pending";
}
else {
    ?>
    </span>
    <span style="color:green;">
    <?php
    echo "Published on ".$pdate;
}

?>
</span></b></p>
</div>
</div>

<h5 class="display-4 fontSize16px"><?php echo $papername;?></h5>
<p style="font-size:12px"><b>Uploaded On : </b><?php echo $uploaddate;?></p>

<p class="fontSize14px"><span style="font-weight:bold">Abstract:</span> <?php echo $abstract;?></p>

<div class=" d-flex justify-content-between col-sm-12">
<div >
<a style="font-size:14px;" class="" href="<?php echo $filepath1 ?> "target ="_blank" role="button">Download as doc</a>
</div>
<div >
<a style="font-size:14px;" class="" href="<?php echo $filepath2 ?> "target ="_blank" role="button">Download as pdf </a>
</div>
<div >
<p><?php echo $type;?></p>
</div>

</div>
</div>
<!-- Paper Showing Section Ends Here  -->

<hr class="bg-success">
<?php  

  // Reviewer Selection section starts here 
  $sqlreviewerupdate = "SELECT * from reviewertable WHERE  paperid='$id' and primaryemail='$email'";

  $resultreviewerupdate = mysqli_query($link,$sqlreviewerupdate);

  $filereviewerupdate = mysqli_fetch_assoc($resultreviewerupdate);

  $feedbackfile = $filereviewerupdate['feedbackfile']; 

  $feedbackfilepath = '../documents/review/'.$filereviewerupdate['feedbackfile'];

  $feedback =  unserialize($filereviewerupdate['feedback']);
  $feedbackdate = unserialize($filereviewerupdate['feedbackdate']);
 

  // Reviewer Selection ends here 
?> 

<div class="row"> 
<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" >
 
<!-- Review Showing Section starts here  -->
<?php for ($x =count($feedback)-1; $x >=0 ; $x--) {
  $date = date('d-M-Y',strtotime($feedbackdate[$x]));
  ?>
<div style="border:2px solid #e3e3e3;  padding:10px;margin-top:5px;border-radius:10px;">
<b class="text-white bg-success btn-sm"><i>Your Review:</i></b>
<hr> 
<p><?php echo $feedback[$x]; ?></p>
<p><b>Reviewed on: </b><small><?php echo $date; ?></small></p>
<?php if(!empty($feedbackfile )){?>
<a style="font-size:14px;" class="btn btn-sm btn-info" href="<?php echo $feedbackfilepath; ?> "target ="_blank" role="button">Your Reviewed file</a>
<?php  } else {
  echo "Not Reviewed yet!";
} ?>
</div>
<?php  } ?>
<!-- Review Showing Section Ends Here  -->
 </div>

  <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
     <!-- input file section starts here  --> 
   <form method = "post" enctype = "multipart/form-data">
   <div class="">
   <h1 class="text-center" style="font-size:18px;"><b>Sent Review Again</b></h1> 
   <br>

<input type="hidden" id="custId" name="authoremail" value="<?php echo $email ?>"> 
<input type="hidden" id="custId" name="paperid" value="<?php echo  $paperid ?>">
 
<div class="input-group">
<label class="col-sm-2 col-form-label" for="formGroupExampleInput"><b>Review:</b></label>
<div class="col-sm-10">
<textarea class="form-control" id="exampleFormControlTextarea1" name= "reviewer-review" rows="5"  required><?php echo  $feedback[count( $feedback)-1]; ?></textarea>
</div>
</div> 
<br>
<div class="input-group">
<label class="col-sm-12 col-form-label" for="formGroupExampleInput"><b>Attach Review(If Required):</b></label><br>
<div class="col-sm-12">
<input type="file" class="form-control-file" name="reviewerfile"id="exampleFormControlFile1" accept = ".doc, .docx, .pdf" >
</div>
<br>
<br>
   </div>

<div class="form-group">
<div class="d-flex justify-content-between">
<div>

</div>
<div>
<?php  if($action==1)  {?> 
<button class="btn btn-sm btn-info btn-block" name = "reviewer-update" type="submit" disabled>Sent Review</button>
<?php  } else {?>
  <button class="btn btn-sm btn-info btn-block" name = "reviewer-update" type="submit">Sent Review</button>
<?php  } ?>
</div>
</div>

</div>
  <!-- Form Section Ends Here  -->
  </form>
 <!-- Input file section ends here  -->
  </div>
</div>
<!-- ------------------------------ Edit feedback Section ---------------------------------------  -->

</div> <!-- Container div -->
</div>
    <!-- Essential Js,jquery,section starts  -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
    <!-- Essential Js,Jquery  section ends  -->    
</body>
</html>
  <?php    
  }
  else {
    echo "<script>alert('You are not selected as a Reviewer.');</script>";
    header("refresh:0;url=../login");
  }
 }
    ?>