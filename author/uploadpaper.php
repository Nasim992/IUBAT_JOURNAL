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
       $authoremail = $_SESSION["email"];

          //  Check that the author is logged in to the section or not starts here 


          $sql = "SELECT author.id,author.username,author.primaryemail,author.password,author.contact from author where primaryemail='$authoremail'"; 
          $query = $dbh->prepare($sql); 
          $query->execute(); 
          $results=$query->fetchAll(PDO::FETCH_OBJ); 
          $cnt=1;
          if($query->rowCount() > 0) 
            {
         
        // Check that the author is logged in to the section or not ends here 
    

 
// Paper Uploaded Section Ends Here 

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Paper</title>
    <link rel="shortcut icon" href="../images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/heading.css">
    <link rel="stylesheet" href="../css/index.css">
    <!-- <link rel="stylesheet" href="css/admin-dashboard.css"> -->
<style>
@media only screen and (max-width: 992px) { 
  form {
    margin-left:0px !important;
    margin-right:0px !important; 
  }
} 
form {

  padding:20px;
  margin-left:150px;
  margin-right:150px;
  border:2px solid #e3e3e3;
  font-size:14px;
  
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

 <!-- input file section starts here  -->
   <form class="author-form" action="upload-paper"  method = "post">
   <h1 class="text-center" style="font-size:18px;"><b>UPLOAD PAPER</b></h1>
   <br>
<div class="input-group">
<label class="col-sm-2 col-form-label" for="formGroupExampleInput"><b>Paper Title:</b></label>
<div class="col-sm-10">
<input type="text" class="form-control" id="formGroupExampleInput" name = "paper-title" placeholder="Write the title of the paper" required>
</div>
</div>
<br>
<div class="input-group">
<label class="col-sm-2 col-form-label" for="formGroupExampleInput"><b>Co-Authors:</b></label>
<div class="col-sm-10">
<input type="number" class="form-control" id="formGroupExampleInput" name = "co-authors-number" placeholder="Enter the number of Co-Authors" min=0 max=30 required>
</div>
</div>
<br>
<div class="input-group">
<label class="col-sm-2 col-form-label" for="formGroupExampleInput"><b>Abstract:</b></label>
<div class="col-sm-10">
<textarea class="form-control" id="exampleFormControlTextarea1" name= "summary" rows="5" placeholder ="Write the short summary about the paper" required></textarea>
</div>
</div>
<br>
<div class="row">
<div class="col-sm-12 col-lg-12 col-md-12">
<div class="input-group">
<label class="col-sm-8 col-form-label" for="formGroupExampleInput"><b>1.Upload Title and Abstract as Pdf Format:</b></label>
<div class="col-sm-4">
<input type="file" class="form-control-file" name="file1"id="exampleFormControlFile1" accept = "application/pdf"  required>
</div>
</div>
</div>
<div class="col-sm-12 col-lg-12 col-md-12">
<div class="input-group">
<label class="col-sm-8 col-form-label" for="formGroupExampleInput"><b>2.Upload full manuscript as Pdf format:</b></label>
<div class="col-sm-4">
<input type="file" class="form-control-file" name="file2"id="exampleFormControlFile1" accept = "application/pdf"  required>
</div>
</div>
</div>
<div class="col-sm-12 col-lg-12 col-md-12">
<div class="input-group">
<label class="col-sm-8 col-form-label" for="formGroupExampleInput"><b>3.Upload Necessary information as Pdf format:(If required)</b></label>
<div class="col-sm-4">
<input type="file" class="form-control-file" name="file"id="exampleFormControlFile1" accept = "application/pdf">
</div>
</div>
</div>
</div>
<br>
<hr class="bg-success">

<div class="row co-author-form">
   <?php
   for ( $x=0;$x<$numberOfCoAuthor;$x++)
   {
       ?>

<div class="col-sm-12 col-md-6 col-lg-4">
<h6 style="font-size:14px;"><b>Co-Author:<?php echo $x+1;?></b></h6>
<div class="input-group">
<label class="col-sm-3 col-form-label" for="formGroupExampleInput">Name:</label>
<div class="col-sm-9">
<input type="text" class="form-control" id="formGroupExampleInput" name = "caufullname<?php echo $x+1;?>" placeholder="FullName " required>
</div>
</div>
<br>
<div class="input-group">
<label class="col-sm-3 col-form-label" for="formGroupExampleInput">Email:</label>
<div class="col-sm-9">
<input type="email" class="form-control" id="formGroupExampleInput" name = "cauemail<?php echo $x+1;?>" placeholder="email " required>
</div>
</div>
<br>
<div class="input-group">
<label class="col-sm-3 col-form-label" for="formGroupExampleInput">Dept.:</label>
<div class="col-sm-9">
<input type="text" class="form-control" id="formGroupExampleInput" name = "caudept<?php echo $x+1;?>" placeholder="Department " required>
</div>
</div>
<br>
<div class="input-group">
<label class="col-sm-3 col-form-label" for="formGroupExampleInput">Institute:</label>
<div class="col-sm-9">
<input type="text" class="form-control" id="formGroupExampleInput" name = "cauinstitute<?php echo $x+1;?>" placeholder="Institute" required>
</div>
</div>
<br>
<div class="input-group">
<label class="col-sm-3 col-form-label" for="formGroupExampleInput">Address:</label>
<div class="col-sm-9">
<input type="text" class="form-control" id="formGroupExampleInput" name = "cauaddress<?php echo $x+1;?>" placeholder="address" required>
</div>
</div>

       <?php 
   }
   
   ?>
<br>

   </div>
<hr>
<div class="form-group">
<div class="d-flex justify-content-between">
<div>
<!-- <a href="upload-paper1.php" role="button"><i class="fa fa-backward" aria-hidden="true"></i>Go back</a> -->
</div>
<div>
<button class="btn btn-sm btn-success " name = "submit" type="submit" >Submit</button>
</div>

  </form>
 <!-- Input file section ends here  -->



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
       echo "<script>alert('You are not a Author.Try to log in as an Author');</script>";
       header("refresh:0;url=../login");
     }
  

  } ?>