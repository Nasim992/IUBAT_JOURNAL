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


?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IUBAT</title>
    <link rel="shortcut icon" href="images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css"> 
    <!-- <script src="js/jquery-3.5.1.slim.min.js"></script> -->
</head> 
<body> 
<div class="sticky-top pb-3">
    <!-- Heading Sections starts  -->
    <?php 
    include 'admin-header.php'
    ?>
    <!-- Heading Sections ends  --> 
    </div>
 
    <div class="container">
    <div class="row">
    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">

    </div>
    <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
    <div class="text-left pb-4">
        <?php 
         include 'header.php';
        ?>
    </div>
    </div> 
    </div>
 
    <div class="row">
    <!-- Sidebar section starts here  -->
    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
     <?php
     include 'sidelinks.php';
     ?> 
    </div>
    
    <!-- Sidebar Section ends here  -->
    <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
    <div class="text-left pb-4">
    
    </div>

<hr class="bg-secondary" >
    <table id="heading-table">
    <tbody>
    <?php $sql = "SELECT paper.id,paper.authoremail,paper.papername,paper.abstract,paper.name,paper.type,paper.action,paper.numberofcoauthor,paper.pdate,paper.pmonth,paper.pyear,paper.cauname1,paper.cauname2,paper.cauname3,paper.cauname4,paper.cauname5,paper.uploaddate from paper WHERE action=0 ORDER BY uploaddate DESC"; 
      $query = $dbh->prepare($sql); 
      $query->execute(); 
      $results=$query->fetchAll(PDO::FETCH_OBJ); 
      $cnt=1; 
 
      if($query->rowCount() > 0) 
      {
      foreach($results as $result) 

{   ?>

<!-- Select User name section starts here  -->
<?php  

$link = mysqli_connect("localhost", "root", "", "iubat");

// $link = mysqli_connect("sql103.epizy.com", "epiz_27210191", "d1cMVcXvOSxtu6q", "epiz_27210191_iubat");
  

$authoremail = htmlentities($result->authoremail);

$sql1 = "SELECT * FROM author WHERE  primaryemail= '$authoremail' ";

$result1 = mysqli_query($link,$sql1); 

$file1 = mysqli_fetch_assoc($result1);

$title = $file1['title'];
$fname= $file1['firstname'];
$middlename= $file1['middlename'];
$lastname= $file1['lastname'];
$uploaddate= $file1['uploaddate'];

$authorname = $title.' '.$fname.' '.$middlename.' ' .$lastname;

?>
<!-- Select user  name section ends here  -->

          <!-- Dashboard section starts  -->
      
            <tr>
            <td>
            <div class="jumbotron  mb-0" >
            <a href="selection-admin.php?id=<?php echo htmlentities($result->id);?>u"><h5 style="font-size:16px;"><?php echo htmlentities($result->papername);?> <i class="text-dark">uploaded on :<?php echo htmlentities($result->uploaddate);?></i></h5></a>
            <h5 class="text-secondary" style="font-size:15px;"><?php echo $authorname;?></h5>
            <p id="paper-abstract<?php echo htmlentities($result->id);?>" style="font-size:14px;height: 6.0em;overflow: hidden;width:auto;"><span style="font-weight:bold">Abstract:</span> <?php echo htmlentities($result->abstract);?></p>
            <a style="cursor:pointer;" class="text-secondary float-right"><span id="read-more-abstract<?php echo htmlentities($result->id);?>">Read more...</span></a>
      <!--Individual Read More section starts here   -->
        <script>
        document.querySelector('#read-more-abstract<?php echo htmlentities($result->id);?>').addEventListener('click', function() {
        document.querySelector('#paper-abstract<?php echo htmlentities($result->id);?>').style.height= 'auto';
        this.style.display= 'none';
        });
            </script>
      <!-- Individual Read More section ends here  -->
      <hr>
            </td>
           </div>
           </tr>
          
      

       <!-- DashBoard Section ends  -->

    <?php }} ?>
    </tbody>
    </table>
    </div>
    </div>
    </div>

    <!-- Footer section starts here  -->
    <?php
    include 'footer.php'
    ?>
    <!-- Footer section ends here  -->
<!-- Essential Js,jquery,section starts  -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<!-- Essential Js,Jquery  section ends  -->
   <script> 
        $(document).ready(function(){
        $("#heading-input").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#heading-table tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            }); 
        });
        });
// Aim and scope readmore section starts here 
        document.querySelector('#read-more').addEventListener('click', function() {
        document.querySelector('#content').style.height= 'auto';
       this.style.display= 'none';
        });
//   Aim and scope read more section ends here 
  </script>
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