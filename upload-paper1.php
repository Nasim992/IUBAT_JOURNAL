<?php
session_start();
error_reporting(0);

include('link/config.php');

if(strlen($_SESSION['alogin'])=="")
    {    
    header("Location: login"); 
    }
    else
    { 
       $authoremail = $_SESSION["email"];

    

 
// Paper Uploaded Section Ends Here 

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Paper</title>
    <link rel="shortcut icon" href="images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/heading.css">
    <link rel="stylesheet" href="css/index.css">
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
<div id="mySidebar" class="sidebar mt-3">
  <?php 
  include 'author-sidebar.php';
  ?>
</div> 

<div id="main">  

<a href="#"><span class="openbtn"onclick="openNav()" id="closesign">☰</span></a>
<a href="javascript:void(0)" class="closebtn" id="closesignof" onclick="closeNav()">×</a>
<div class="container"> 

 <!-- input file section starts here  -->
   <form class="author-form" action="upload-paper.php"  method = "post">
   <h1 class="text-center" style="font-size:18px;"><b>UPLOAD PAPER</b></h1>
   <br>
<div class="input-group">
<label class="col-sm-2 col-form-label" for="formGroupExampleInput"><b>PaperTitle:</b></label>
<div class="col-sm-10">
<input type="text" class="form-control" id="formGroupExampleInput" name = "paper-title" placeholder="Write the title of the paper" required>
</div>
</div>
<br>
<div class="input-group">
<label class="col-sm-2 col-form-label" for="formGroupExampleInput"><b>CoAuthors:</b></label>
<div class="col-sm-10">
<input type="number" class="form-control" id="formGroupExampleInput" name = "co-authors-number" placeholder="Enter the number of Co-Authors" min=0 max=5 required>
</div>
</div>
<br>
 
<hr>
<div class="form-group">
<button class="btn btn-success  " name="submit-firsto" type="submit" >Next</button>
</div>

  <!-- Form Section Ends Here  -->
  </form>
 <!-- Input file section ends here  -->



</div> <!-- Container div -->
</div>

    <!-- Essential Js,jquery,section starts  -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
    <!-- Essential Js,Jquery  section ends  -->    
</body>
</html>

    <?php } ?>