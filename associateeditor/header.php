<?php
session_start();
error_reporting(0);
include('../link/config.php');

if(strlen($_SESSION['alogin'])=="") 
    {    
    header("Location:../login");  
    } else {

      $email =  $_SESSION['alogin'];
     // Check that the Associate Editor  is logged in or not section starts here 

     $sql = "SELECT author.id,author.username,author.title,author.firstname,author.middlename,author.lastname,author.primaryemail,author.password,author.contact,author.associateeditor from author where primaryemail='$email' and associateeditor IS NOT NULL"; 
     $query = $dbh->prepare($sql); 
     $query->execute(); 
     $results=$query->fetchAll(PDO::FETCH_OBJ); 
     $cnt=1;
     if($query->rowCount() > 0) 
     {
      foreach($results as $result) {
        $title = htmlentities($result->title);
        $firstname = htmlentities($result->firstname);
        $middlename = htmlentities($result->middlename);
        $lastname  = htmlentities($result->lastname);

        $fullname = $title.' '.$firstname.' '.$middlename.' '.$lastname; 
    // Check that the Associate Editor is logged in or not section ends here 

?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/heading.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- <script src="../js/jquery-3.5.1.slim.min.js"></script> -->
   <!-- <link rel="stylesheet" href="../css/admin-dashboard.css"> -->
   <!-- <link rel="stylesheet" href="../css/index.css">  -->
   <style>
     @media screen and (max-width: 990px) { 
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

<nav class="navbar nav-class navbar-expand-lg navbar-light">
  <a class="navbar-brand" href="dashboard"><img src="../images/Iubat-logo.png">JOURNAL</a>
  <h6 style="font-size:12px;">Welcome Back,<?php  echo  $fullname ;  } ?></h6>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav ml-auto ul-nav">

 
    <li class="nav-item hidden active" title="Dashboard">
    <a href="admin-dashboard" class="sidebars nav-link"><i class="fas fa-tachometer-alt"></i>&nbsp Dashboard</a>
    </li> 

    <li class="nav-item hidden active" title="Published paper">
    <a href="publishedpaper" class="sidebars nav-link"><i class="far fa-newspaper"></i>&nbsp Published Paper</a>
    </li>
    <li class="nav-item hidden active" title="Unpublished paper">
    <a href="unpublishedpaper" class="sidebars nav-link"><i class="far fa-newspaper"></i>&nbsp Unpublished Paper</a>
    </li>
    <li class="nav-item hidden active" title="Changed password">
    <a href="updateprofile" class="sidebars nav-link"><i class="fas fa-unlock-alt"></i>&nbsp Update Profile</a>
    </li>
    <li class="nav-item hidden active" title="Changed password">
    <a href="changepassword" class="sidebars nav-link"><i class="fas fa-unlock-alt"></i>&nbsp Change password</a>
    </li>

    <li class="nav-item hidden active" title="Author states">
    <a href="authors" class="sidebars nav-link"><i class="fas fa-users-cog"></i>&nbsp Author States</a>
    </li>
    <li class="nav-item hidden active" title="reviewer">
    <a href="reviewerdetails" class="sidebars nav-link"><i class="fas fa-users-cog"></i>&nbsp Reviewer</a>
    </li> 
    <li class="nav-item hidden active" title="Feedback">
    <a href="feedback" class="sidebars nav-link"><i class="fas fa-comments"></i>&nbsp Feedback</a>
    </li>

        <li class="nav-item active" >
       <a class="nav-link" href="../logout" onclick="return confirm('Are you sure you want Logging out the system?');" title = "Sign Out"><small>(Sign Out)</small><i class="fas fa-sign-out-alt"></i></a>
        </li>



  
        </ul>
  
  </div>
</nav>


<!-- Essential Js,jquery,section starts  -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-3.5.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
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
  echo "<script>alert('You are not a AssociateEditor.Try to log in as an Author');</script>";
  header("refresh:0;url=../login");
}


}
?>