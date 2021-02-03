<?php 
 include('link/config.php'); 
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aim and scope</title>
    <!-- Css links -->
    <?php include 'link/csslinks.php'; ?>
    <!-- Css links -->
    <!-- <script src="js/jquery-3.5.1.slim.min.js"></script> -->
</head> 
<body> 
<div class="content">
<div class="">
    <!-- Heading Sections starts  -->
    <?php 
    include 'heading.php';
    ?>
    <!-- Heading Sections ends  --> 
    </div>
 
    <div class="container">
    <div class="row mt-3">
    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">

    </div>
    <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
    <div class="text-left pb-4">
   <?php include "header.php"; ?>
    </div>
    </div> 
    </div>
 
    <div class="row">
    <!-- Sidebar section starts here  -->
    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
  
    <?php include "sidelinks.php"; ?>
    
    </div>
    <!-- Sidebar Section ends here  -->
    <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
    <div class="text-left pb-4">
        <h4 class="text-center">AIM AND SCOPE</h4>
        <hr class="bg-secondary">
        <p>Aim and Scope is not Available Now.</p>
    </p>
    </div>

    </div>
    </div>
</div>
    <!-- Footer section starts here  -->
    <?php
    include 'footer.php'
    ?>
    <!-- Footer section ends here  -->
</div>
    <!-- Loader image section starts here  -->
    <div class="loader-wrapper">
      <span class="loader"><img src="images/IUBAT-Logo-load.gif"></span></span>
    </div>
    <!-- Loader image section ends here  -->
<!-- Essential Js,jquery,section starts  -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<!-- Essential Js,Jquery  section ends  -->
</body>
</html>