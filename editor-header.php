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
            
            //  Number of paper  count section starts here 

                $query = "SELECT COUNT(*) as total_paper FROM paper where authoremail='$email'";
                $stmt = $dbh->prepare($query);
                             
                // execute query
                $stmt->execute();
                             
                // get total rows
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $total_paper = $row['total_paper'];
                                  
            // Number of paper  count section ends here  

                        // New Paper Assigned Section Starts Here 
                        $query = "SELECT COUNT(*) as total_rowsrev FROM editortable where primaryemail = '$authoremail'";
                        $stmt = $dbh->prepare($query);
                         
                        // execute query
                        $stmt->execute();
                        
                        // get total rows
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $total_revieweded = $row['total_rowsrev'];
                        
            
                        // New Paper Assigned Section Ends Here 

?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Header</title>
    <!-- <link rel="stylesheet" href="css/heading.css"> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/heading.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    
   <!-- <link rel="stylesheet" href="css/admin-dashboard.css"> -->

</head> 
<body> 

<nav class="navbar nav-class navbar-expand-lg navbar-light pb-2">
  <a class="navbar-brand" href="editor-dashboard.php"><img src="images/Iubat-logo.png">JOURNAL</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button> 
 
  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav ml-auto ul-nav">

   <ul>
   <li class="nav-item active" title="total paper">
    <a class="nav-link" href="#">Editored Paper</a>
    </li>
   </ul>

   <ul>
   <li class="nav-item active" title="total paper">
            <a class="nav-link" href="editor-paper">Assigned Paper</a>
        </li>
   </ul> 

        
<ul>
<li class="nav-item active" title="Messages">
<a class="nav-link" href="#"><i class="fas fa-envelope-square"></i>&nbsp<b><sup></b></a>

</ul> 

<ul>
<li class="nav-item active" title="New Paper">
<a class="nav-link" title="New paper assigned" href="editor-paper"><i class="fas fa-bell"></i>&nbsp<b><sup><?php echo $total_revieweded; ?></sup></b></a>
       
</ul>

<ul>

<?php  
include 'link/linklocal.php';

$authoremail = $_SESSION["email"];

$sql1 = "SELECT * FROM author WHERE  primaryemail= '$authoremail' ";

$result1 = mysqli_query($link,$sql1); 

$file1 = mysqli_fetch_assoc($result1);

$username = $file1['username'];

$title = $file1['title'];
$fname= $file1['firstname'];
$middlename= $file1['middlename'];
$lastname= $file1['lastname'];

$authorname = $title.' '.$fname.' '.$middlename.' ' .$lastname;

?>
<!-- Select user  name section ends here  -->


<li class="nav-item active" >
       <a class="nav-link " href="logout.php" onclick="return confirm('Are you sure you want Logging out the system?');" title = "Sign Out"> (<?php echo $username; ?>) <i class="fas fa-sign-out-alt"></i></a>
        </li>
</ul>

 

   
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