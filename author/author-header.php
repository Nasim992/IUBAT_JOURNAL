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

               // Check that the admin is logged in or not section starts here 

               $sql = "SELECT author.id,author.username,author.primaryemail,author.password,author.contact from author where primaryemail='$authoremail'"; 
               $query = $dbh->prepare($sql); 
               $query->execute(); 
               $results=$query->fetchAll(PDO::FETCH_OBJ); 
               $cnt=1;
               if($query->rowCount() > 0) 
               {
        
        // Check that the admin is logged in or not section ends here 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Header</title>
    <link rel="stylesheet" href="../css/heading.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/heading.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    
   <!-- <link rel="stylesheet" href="css/admin-dashboard.css"> -->
 
   <style>
     @media screen and (max-width: 992px) { 
      .hidden{
       display: block !important;
     }
      }
     .hidden{
       display: none;
     }
   </style>

</head> 
<body> 

<!-- Select User Name tile section starts Here  -->
<?php  
include '../link/linklocal.php';

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
<!-- Select User Name title section ends here -->

<nav class="navbar nav-class navbar-expand-lg navbar-light">
  <a class="navbar-brand" href="author-dashboard"><img src="../images/Iubat-logo.png">JOURNAL</a>
  <h6 style="font-size:12px;">Welcome Back,<?php  echo $authorname; ?></h6>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>  
 
  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav ml-auto ul-nav">
 

   <li class="nav-item hidden active" title="Dashboard">
   <a href="author-dashboard" class="sidebars nav-link"><i class="fas fa-tachometer-alt"></i>&nbsp Dashboard</a>
   </li>

   <li class="nav-item hidden active" title="Upload paper">
   <a href="upload-paper1" class="sidebars nav-link"><i class="fas fa-upload"></i>&nbsp Upload Paper</a>
  </li>
    <li class="nav-item hidden active" title="Published paper">
    <a href="all-paper-author" class="sidebars nav-link"><i class="far fa-newspaper" class="sidebars"></i>&nbsp Published Paper</a>
    </li>
    <!-- <li class="nav-item hidden active" title="Paper Status">
    <a href="authorpaperstatus" class="sidebars nav-link"><i class="fas fa-exclamation-circle"></i>&nbsp Paper Status</a>
    </li>
    <li class="nav-item hidden active" title="Under Review">
    <a href="authoruploadedpaper" class="sidebars nav-link"><i class="fas fa-exclamation-circle"></i>&nbsp Under Review</a>
    </li> -->
    <li class="nav-item hidden active" title="Under Review">
    <a href="reviewerstatus" class="sidebars nav-link"><i class="far fa-newspaper"></i>&nbsp Reviewed paper</a>
    </li>
    <li class="nav-item hidden active" title="Under Review">
    <a href="editorstatus" class="sidebars nav-link"><i class="far fa-newspaper"></i>&nbsp Editor Status</a>
    </li>
    
<li class="nav-item active" >
       <a class="nav-link " href="../logout" onclick="return confirm('Are you sure you want Logging out the system?');" title = "Sign Out"><small>(Sign Out)</small> <i class="fas fa-sign-out-alt"></i></a>
  </li>
        </ul>
  
  </div>
</nav>


<!-- Essential Js,jquery,section starts  -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-3.5.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
<!-- Essential Js,Jquery  section ends  -->
</body>
</html>

    <?php
                }
                else {
                  echo "<script>alert('You are not a Author.Try to log in as an Author');</script>";
                  header("refresh:0;url=../login");
                }
  
  
  }
    
    
    ?>