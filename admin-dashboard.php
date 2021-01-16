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

     // Check that the admin is logged in or not section starts here 
     $adminemail = $_SESSION["email"];

     $sql = "SELECT admin.id,admin.username,admin.fullname,admin.password,admin.email,admin.contact from admin where email='$adminemail'"; 
     $query = $dbh->prepare($sql); 
     $query->execute(); 
     $results=$query->fetchAll(PDO::FETCH_OBJ); 
     $cnt=1;
     if($query->rowCount() > 0) 
     {
     
     // Check that the admin is logged in or not section ends here 

           //  New Paper count section starts here 

           $query = "SELECT COUNT(*) as total_rows FROM paper WHERE action = 0";
           $stmt = $dbh->prepare($query);
           
           // execute query
           $stmt->execute();
           
           // get total rows
           $row = $stmt->fetch(PDO::FETCH_ASSOC);
           $total_published = $row['total_rows'];
   
   
        // New Paper count section ends here 

          //  Number of Published paper  count section starts here 

                  $query = "SELECT COUNT(*) as total_rows FROM paper WHERE action = 1";
                  $stmt = $dbh->prepare($query);
                  
                  // execute query
                  $stmt->execute();
                  
                  // get total rows
                  $row = $stmt->fetch(PDO::FETCH_ASSOC);
                  $total_unpublished = $row['total_rows'];
          
          
        // Number of Published paper  count section ends here 
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

        //  Number of Editor  count section starts here 

        $query = "SELECT COUNT(*) as total_rows FROM author where editorselection=1";
       $stmt = $dbh->prepare($query);
                               
        // execute query
        $stmt->execute();
                               
        // get total rows
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_editors = $row['total_rows'];
                       
                       
    // Number of Editor count section ends here 

    //  Number of Editor  count section starts here 

       $query = "SELECT COUNT(*) as total_rows FROM author where reviewerselection=1";
       $stmt = $dbh->prepare($query);
                               
        // execute query
        $stmt->execute();
                               
        // get total rows
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_reviewered = $row['total_rows'];
                       
                       
    // Number of Editor count section ends here 

        //  Number of Reviewer Feedback  count section starts here 

        $query = "SELECT COUNT(*) as total_rows FROM reviewertable where feedback IS NOT NULL";
        $stmt = $dbh->prepare($query);
                                
         // execute query
         $stmt->execute();
                                
         // get total rows
         $row = $stmt->fetch(PDO::FETCH_ASSOC);
         $total_feedback = $row['total_rows'];
                        
                        
     // Number of Reviewer Feedback count section ends here 



?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
include 'admin-header.php';
?> 
</div> 
<!-- Author showing header sections ends   -->

<div id="mySidebar" class="sidebar mt-3">
  <?php
  include 'admin-sidebar.php';
  ?>

</div> 

<div id="main">  

<a href="#"><span class="openbtn"onclick="openNav()" id="closesign">☰</span></a>
<a href="javascript:void(0)" class="closebtn" id="closesignof" onclick="closeNav()">×</a>
<div class="container"> 

<!-- Progress bar section starts here  -->
<div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <a href="admin-number.php"><div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Admin</h4>
                  </div> 
                  <div class="card-body">
                    <?php echo $total_admin ?>
                  </div>
                </div>
              </div></a>
            </div>
   
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
             <a href="admin-show-authors">
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
                    <h4>Editor</h4>
                  </div>
                  <div class="card-body">
                    <?php  echo $total_editors; ?>
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
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
             <a href="published-paper-admin">
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
            <a href="unpublished-paper">
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

            <!-- <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Online Users</h4>
                  </div>
                  <div class="card-body">
                    47
                  </div>
                </div>
              </div>
            </div>
          </div> -->
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
</script>
<!-- Essential Js,Jquery  section ends  -->    
</body>
</html>

<?php 

}
else {
  echo "<script>alert('You are not an Admin.Try to log in as an Admin');</script>";
  header("refresh:0;url=login.php");
}

}
    
?>