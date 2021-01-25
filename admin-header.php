<?php
session_start();
error_reporting(0);
include('link/config.php');

if(strlen($_SESSION['alogin'])=="")
    {    
    header("Location: adminlogin");  
    } else {



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
    <title>Document</title>
    <!-- <link rel="stylesheet" href="css/heading.css"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- <script src="js/jquery-3.5.1.slim.min.js"></script> -->
   <link rel="stylesheet" href="css/admin-dashboard.css">
   <!-- <link rel="stylesheet" href="css/index.css">  -->
  

</head> 
<body>  



<nav class="navbar nav-class navbar-expand-lg navbar-light text-white pb-2">
  <a class="navbar-brand" href="admin-dashboard"><img src="images/Iubat-logo.png">JOURNAL</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav ml-auto ul-nav">

    <!-- <li class="nav-item dropdown" title="Operation">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-cog" ></i> 
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="change-password-admin">Change password</a>
          <a class="dropdown-item" href="add-admin">Add Another Admin</a>
    </li>


        <li class="nav-item" title="total paper">
            <a class="nav-link" href="published-paper-admin">Published Paper &nbsp<b><sup><?php echo $total_published; ?></sup></b></a>
        </li>

        <li class="nav-item" title="total paper">
            <a class="nav-link" href="admin-number">Admin &nbsp<b><sup><?php echo $total_admin; ?></sup></b></a>
        </li>


        <li class="nav-item" title="total paper">
            <a class="nav-link" href="admin-show-authors">Author &nbsp<b><sup><?php echo $total_authors; ?></sup></b></a>
        </li> -->

        <!-- <li class="nav-item" title="New Paper">

        <?php   


        ?> 

            <a class="nav-link" href="unpublished-paper"><i class="fas fa-bell"></i>&nbsp<b><sup><?php echo $total_rows; ?></sup></b></a>
       </li> -->
        <li class="nav-item active" >
       <a class="nav-link" href="adminlogout" onclick="return confirm('Are you sure you want Logging out the system?');" title = "Sign Out"> (<?php echo $_SESSION["email"] ?>) <i class="fas fa-sign-out-alt"></i></a>
        </li>



  
        </ul>
  
  </div>
</nav>


<!-- Essential Js,jquery,section starts  -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<!-- Essential Js,Jquery  section ends  -->
<script> 
        $(document).ready(function(){
        $("#myInput-admin").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable-admin tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        });
    </script>
</body>
</html>

    <?php }
    else {
      echo "<script>alert('You are not an Admin.Try to log in as an Admin');</script>";
      header("refresh:0;url=login.php");
    }

   }?>