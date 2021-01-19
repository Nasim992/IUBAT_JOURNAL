<?php
session_start();
error_reporting(0); 
include('link/config.php');

if(strlen($_SESSION['alogin'])=="")
    {    
    header("Location: login.php"); 
    } 
    else 
    {  
           $authoremail = $_SESSION["email"];
           //  New Paper count section starts here 

           $query = "SELECT COUNT(*) as total_rows FROM paper WHERE authoremail = '$authoremail'";
           $stmt = $dbh->prepare($query);
           
           // execute query
           $stmt->execute();
           
           // get total rows
           $row = $stmt->fetch(PDO::FETCH_ASSOC);
           $total_paper = $row['total_rows'];
   
   
        // New Paper count section ends here 

      //  Number of Editor  count section starts here 

       $query = "SELECT COUNT(*) as total_rows FROM author where primaryemail='$authoremail' and reviewerselection=1";
       $stmt = $dbh->prepare($query);
                               
        // execute query
        $stmt->execute();
                               
        // get total rows
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $reviewered = $row['total_rows'];
                       
                       
    // Number of Editor count section ends here 

          //  Number of Editor  count section starts here 

          $query = "SELECT COUNT(*) as total_rows FROM reviewertable where primaryemail='$authoremail' and feedback IS NOT NULL";
          $stmt = $dbh->prepare($query);
                                  
           // execute query
           $stmt->execute();
                                  
           // get total rows
           $row = $stmt->fetch(PDO::FETCH_ASSOC);
           $feedbackr = $row['total_rows'];
            

           $query = "SELECT COUNT(*) as total_rows FROM editortable where primaryemail='$authoremail' and feedback IS NOT NULL";
           $stmt = $dbh->prepare($query);
                                   
            // execute query
            $stmt->execute();
                                   
            // get total rows
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $feedbacke = $row['total_rows'];
             
                          
       // Number of Editor count section ends here 

          //  Number of Editor  count section starts here 

          $query = "SELECT COUNT(*) as total_rows FROM author where primaryemail='$authoremail' and editorselection=1";
          $stmt = $dbh->prepare($query);
                                  
           // execute query
           $stmt->execute();
                                  
           // get total rows
           $row = $stmt->fetch(PDO::FETCH_ASSOC);
           $editored = $row['total_rows'];
                          
                          
       // Number of Editor count section ends here 


          //  Number of Published paper  count section starts here 

                  $query = "SELECT COUNT(*) as total_rows FROM paper WHERE action = 1 and authoremail = '$authoremail'"; 
                  $stmt = $dbh->prepare($query);
                  
                  // execute query
                  $stmt->execute();
                  
                  // get total rows
                  $row = $stmt->fetch(PDO::FETCH_ASSOC);
                  $total_published = $row['total_rows'];
          
          
        // Number of Published paper  count section ends here 

        //  Number of Unublished paper  count section starts here 

                  $queryu = "SELECT COUNT(*) as total_rowsu FROM paper WHERE action = 0 and authoremail = '$authoremail'"; 
                  $stmtu = $dbh->prepare($queryu);
                  
                  // execute query
                  $stmtu->execute();
                  
                  // get total rows
                  $rowu = $stmtu->fetch(PDO::FETCH_ASSOC);
                  $total_unpublished = $rowu['total_rowsu'];
          
          
        // Number of Unublished paper  count section ends here 

              //  Number of Authors  count section starts here 

                 $query = "SELECT COUNT(*) as total_rows FROM author";
                 $stmt = $dbh->prepare($query);
                 
                 // execute query
                 $stmt->execute();
                 
                 // get total rows
                 $row = $stmt->fetch(PDO::FETCH_ASSOC);
                 $total_authors = $row['total_rows'];
         
         
              // Number of Authors count section ends here 

                      //  Number of Admins  count section starts here 

                      $query = "SELECT COUNT(*) as total_rows FROM admin";
                      $stmt = $dbh->prepare($query);
                       
                      // execute query
                      $stmt->execute();
                      
                      // get total rows
                      $row = $stmt->fetch(PDO::FETCH_ASSOC);
                      $total_admin = $row['total_rows'];
              
              
                 // Number of Admins count section ends here 


?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Dashboard</title>
    <link rel="shortcut icon" href="images/Iubat-logo.png" type="image/x-icon">
    <!-- <link rel="stylesheet" href="css/heading.css"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/admin-dashboard.css"> -->
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/fontawesome.v5.3.1.all.css">
    
 
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

<!-- Progress bar section starts here  -->
<div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
             <a href="author-paper-show">
             <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header"> 
                    <h4>Accepted</h4>
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
             <a href="author-paper-show">
             <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Reviewing</h4>
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

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
             <a href="author-paper-show">
             <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Rejected</h4>
                  </div>
                  <div class="card-body">
                    <?php
                    echo 0;
                    ?>
                  </div>
                </div>
              </div>
             </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
             <a href="author-paper-show">
             <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total</h4>
                  </div>
                  <div class="card-body">
                    <?php
                    echo $total_paper;
                    ?>
                  </div>
                </div>
              </div>
             </a>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Reviewer</h4>
                  </div>
                  <div class="">
                    <?php 
                    
                    if( $reviewered == 0) {
                     ?>
  <p style="font-size:16px;" class="text-danger"><i class="fas fa-times-circle"></i>  <?php  echo "Not Selected"; ?></p>
                     <?php
                    }
                    else {
                      ?>
  <p style="font-size:16px;" class="text-success"><i class="fas fa-check-circle"></i> <?php  echo "Selected"; ?></p>
                      <?php
                    }
                    
                    ?>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Editor</h4>
                  </div>
                  <div class="">
                  <?php 
                    
                    if( $editored  == 0) {
                     ?>
  <p style="font-size:16px;" class="text-danger"><i class="fas fa-times-circle"></i>  <?php  echo "Not Selected"; ?></p>
                     <?php
                    }
                    else {
                      ?>
  <p style="font-size:16px;" class="text-success"><i class="fas fa-check-circle"></i> <?php  echo "Selected"; ?></p>
                      <?php
                    }
                    
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-secondary">
                  <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Feedback</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $feedbackr+$feedbacke; ?>
                  </div>
                </div>
              </div>
            </div>
           
<!-- Progress bar section ends here  -->

</div>
</div>
<!-- Essential Js,jquery,section starts  -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script>
            // DataTables section starts here 
            $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
            });
            // Datables section ends here 

   function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
  document.getElementById("closesignof").style.display= "block";
  document.getElementById("closesign").style.display= "none";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.getElementById("closesign").style.display= "block";
  document.getElementById("closesignof").style.display= "none";
  
}
 
</script>
<!-- Essential Js,Jquery  section ends  -->    
</body>
</html> 

<?php 

}

    
?>