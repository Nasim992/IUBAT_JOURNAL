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
           $total_rows = $row['total_rows'];
   
   
        // New Paper count section ends here 

                  //  Number of Published paper  count section starts here 

                  $query = "SELECT COUNT(*) as total_rows FROM paper WHERE action = 1";
                  $stmt = $dbh->prepare($query);
                  
                  // execute query
                  $stmt->execute();
                  
                  // get total rows
                  $row = $stmt->fetch(PDO::FETCH_ASSOC);
                  $total_published = $row['total_rows'];
          
          
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
    
<style>
.sidebar {
  height: 100%;
  width: 250px;
  position: fixed;
  z-index: 1; 
  top: 0;
  left: 0;
  background-color: #f7f9f7;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.12), 0 2px 5px rgba(0,0,0,0.24);
     /* transition: all 0.3s cubic-bezier(.25,.8,.25,1); */
     border:2px solid rgba(212, 214, 212, 0.904);
}

.sidebar a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 16px;
  color: black;
  display: block;
  transition: 0.3s;
}

.sidebar a:hover {
  color: black;
}

.sidebar .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

.openbtn {
  font-size: 20px;
  cursor: pointer;
  background-color: white;
  color: green;
  padding: 10px 15px;
  border: none;
  display:none;
  overflow: hidden;
}

/* .openbtn:hover {
  background-color: #444;
} */

#main {
  transition: margin-left .5s;
  /* padding: 16px; */
  margin-left:250px;
}

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
}
/* Progress bar section starts here  */
.card.card-statistic-1, .card.card-statistic-2 {
    display: inline-block;
    width: 100%;
}
.card {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03);
    background-color: #fff;
    border-radius: 3px;
    border: none;
    position: relative;
    margin-top:10px;
    margin-bottom: 30px;
    cursor:pointer;
}
.card.card-statistic-1 .card-icon {
    line-height: 90px;
}
.card.card-statistic-1 .card-icon, .card.card-statistic-2 .card-icon {
    width: 80px;
    height: 80px;
    margin: 10px;
    border-radius: 3px;
    line-height: 94px;
    text-align: center;
    float: left;
    margin-right: 15px;
}
.card.card-statistic-1 .card-body {
    font-size: 20px;
}
.card.card-statistic-1 .card-body, .card.card-statistic-2 .card-body {
    font-size: 26px;
    font-weight: 700;
    color: #34395e;
    padding-bottom: 0;
}
.card.card-statistic-1 .card-body, .card.card-statistic-2 .card-body {
    padding-top: 0;
}
.card .card-body {
    padding-top: 20px;
    padding-bottom: 20px;
}
.card .card-header, .card .card-body, .card .card-footer {
    background-color: transparent;
    padding: 20px 25px;
}
.card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem;
}
.card.card-statistic-1 .card-header h4 {
    margin-bottom: 0;
}
.card.card-statistic-1 .card-header h4, .card.card-statistic-2 .card-header h4 {
    font-weight: 600;
    font-size: 13px;
    letter-spacing: .5px;
}
.card.card-statistic-1 .card-header h4, .card.card-statistic-2 .card-header h4 {
    line-height: 1.2;
    color: #98a6ad;
}
.card .card-header h4 {
    font-size: 16px;
    line-height: 28px;
    color: #6777ef;
    padding-right: 10px;
    margin-bottom: 0;
}
.card.card-statistic-1 .card-icon .ion, .card.card-statistic-1 .card-icon .fas, .card.card-statistic-1 .card-icon .far, .card.card-statistic-1 .card-icon .fab, .card.card-statistic-1 .card-icon .fal, .card.card-statistic-2 .card-icon .ion, .card.card-statistic-2 .card-icon .fas, .card.card-statistic-2 .card-icon .far, .card.card-statistic-2 .card-icon .fab, .card.card-statistic-2 .card-icon .fal {
    font-size: 22px;
    color: #fff;
}
.fas, .far, .fab, .fal {
    font-size: 13px;
}
/* Progress bar section ends here */
</style>

</head>
<body>

<!-- Author showing header sections starts  --> 
<div class="sticky-top">
<?php
include 'admin-header.php';
?> 
</div>
<!-- Author showing header sections ends   -->


<div id="mySidebar" class="sidebar mt-5">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <a href="#">About</a>
  <a href="#">Services</a>
  <a href="#">Clients</a>
  <a href="#">Add another admin</a>
  <a href="#">Change password</a>
  <a href="#">About</a>
  <a href="#">Journal</a>
  <a href="#">Author</a>
  <a href="#">Contact</a>
</div> 

<div id="main">  

<a href="#"><span class="openbtn"onclick="openNav()" id="closesign">☰</span></a>
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
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Editor</h4>
                  </div>
                  <div class="card-body">
                    10
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
                    <h4>Author</h4>
                  </div>
                  <div class="card-body">
                    <?php echo $total_authors;  ?>
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
                    <h4>Reviewer</h4>
                  </div>
                  <div class="card-body">
                    9
                  </div>
                </div>
              </div>
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
                    42
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Published Paper</h4>
                  </div>
                  <div class="card-body">
                    <?php
                    echo $total_published;
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Unpublished Paper</h4>
                  </div>
                  <div class="card-body">
                    <?php
                    echo $total_rows;
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
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
  document.getElementById("main").style.paddingTop = "10px";
  document.getElementById("closesign").style.display = "none";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.getElementById("closesign").style.display ="block" ;
}

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