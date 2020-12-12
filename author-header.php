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

        $email =  $_SESSION['alogin'];
        
                 //  Number of Reviews   count section starts here 

                 $query = "SELECT COUNT(*) as total_rowsrev FROM reviews";
                 $stmt = $dbh->prepare($query);
                  
                 // execute query
                 $stmt->execute();
                 
                 // get total rows
                 $row = $stmt->fetch(PDO::FETCH_ASSOC);
                 $total_reviews = $row['total_rowsrev'];
         
         
            // Number of Reviews  count section ends here 

                 //  Number of comments   count section starts here 

                 $query = "SELECT COUNT(*) as total_rowscom FROM comments";
                 $stmt = $dbh->prepare($query);
                 
                 // execute query
                 $stmt->execute();
                 
                 // get total rows
                 $row = $stmt->fetch(PDO::FETCH_ASSOC);
                 $total_comments = $row['total_rowscom'];
         
         
            // Number of comments  count section ends here            

            

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
    
   <link rel="stylesheet" href="css/admin-dashboard.css">

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><img src="images/Iubat-logo.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav ml-auto">

    <li class="nav-item" title="total paper">
            <a class="nav-link" href="author-dashboard.php">Upload paper</a>
    </li>

        <li class="nav-item" title="total paper">
            <a class="nav-link" href="all-paper-author.php">All Paper</a>
        </li>

        <li class="nav-item" title="total paper">
            <a class="nav-link" href="change-password-author.php">Change Password</a>
        </li>

        <li class="nav-item" title="total paper">
            <a class="nav-link" href="author-paper-show.php">Your Paper</a>
        </li>
        

        <li class="nav-item" title="Messages">
            <a class="nav-link" href="#"><i class="fas fa-envelope-square"></i>&nbsp<b><sup><?php echo $total_reviews; ?></sup></b></a>

        <li class="nav-item" title="New Paper">
            <a class="nav-link" href="#"><i class="fas fa-bell"></i>&nbsp<b><sup><?php echo $total_comments; ?></sup></b></a>
       
        <li class="nav-item active" >
       <a class="nav-link" href="admin-logout.php" onclick="return confirm('Are you sure you want Logging out the system?');" title = "Sign Out"> (<?php echo $_SESSION["email"] ?>) <i class="fas fa-sign-out-alt"></i></a>
        </li>

 

   
        </ul>
  
  </div>
</nav>


<!-- Essential Js,jquery,section starts  -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<!-- Essential Js,Jquery  section ends  -->
</body>
</html>

    <?php } ?>