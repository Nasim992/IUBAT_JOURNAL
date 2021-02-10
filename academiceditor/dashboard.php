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
     // Check that the Associate Editor is logged in or not section starts here 

     $sql = "SELECT author.id,author.username,author.primaryemail,author.password,author.contact,author.academiceditor from author where primaryemail='$email' and academiceditor IS NOT NULL"; 
     $query = $dbh->prepare($sql); 
     $query->execute(); 
     $results=$query->fetchAll(PDO::FETCH_OBJ); 
     $cnt=1;
     if($query->rowCount() > 0) 
     {
 
// Check that the Associate Editor  is logged in or not section ends here 

      // Count
      include '../link/count.php';
      // Count

?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="../images/Iubat-logo.png" type="image/x-icon">
    <!-- <link rel="stylesheet" href="css/heading.css"> -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/admin-dashboard.css"> -->
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/fontawesome.v5.3.1.all.css"> 
    

</head>
<body>

<!-- Author showing header sections starts  --> 
<div class="sticky-top header-floating">
<?php
include 'header.php'; 
?>  
</div> 
<!-- Author showing header sections ends   -->

<div id="mySidebar" class="sidebar">
  <?php
  include 'sidebar.php';
  ?>

</div> 

<div id="main">  

<a href="#"><span class="openbtn"onclick="openNav()" id="closesign">☰</span></a>
<a href="javascript:void(0)" class="closebtn" id="closesignof" onclick="closeNav()">×</a>
<div class="container"> 

<!-- Progress bar section starts here  -->
<div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
             <a href="authors">
             <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Author</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $total_authors;  ?>
                  </div>
                </div>
              </div>
             </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <a href="editordetails">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4> Associate Editor</h4>
                  </div>
                  <div class="card-body">
                    <?php  echo $total_academiceditors; ?>
                  </div>
                </div>
              </div>
              </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <a href="editordetails">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Academic Editors</h4>
                  </div>
                  <div class="card-body">
                    <?php  echo $total_academiceditors; ?>
                  </div>
                </div>
              </div>
              </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
             <a href="reviewerdetails">
             <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Reviewer</h4>
                  </div>
                  <div class="card-body">
                    <?php  echo $total_reviewered; ?>
                  </div>
                </div>
              </div>
             </a>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="feedback">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Feedback</h4>
                  </div>
                  <div class="card-body">
                    <?php echo  $total_feedback; ?>
                  </div>
                </div>
              </div>
            </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
             <a href="publishedpaper">
             <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Published</h4>
                  </div>
                  <div class="card-body">
                    <?php
                    echo $total_published;
                    ?>
                  </div>
                </div>
              </div>
             </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="unpublishedpaper">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Unpublished</h4>
                  </div>
                  <div class="card-body">
                    <?php
                    echo $total_unpublished;
                    ?>
                  </div>
                </div>
              </div>
            </a>
            </div>

<!-- Progress bar section ends here  -->

</div> 
</div>
<!-- Essential Js,jquery,section starts  -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-3.5.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script> 
            // DataTables section starts here  
            $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
            });
            // Datables section ends here 
</script>
<!-- Essential Js,Jquery  section ends  -->    
</body>
</html>

<?php 

}
else {
  echo "<script>alert('You are not a academiceditor.Try to log in as an Author');</script>";
  header("refresh:0;url=../login");
}


}

    
?>