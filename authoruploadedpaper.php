<?php 
session_start();
error_reporting(0);
include('link/config.php');

if(strlen($_SESSION['alogin'])=="")
    {    
    header("Location: login.php");  
    } else {

        $authoremail = $_SESSION["email"];

     //  Check that the author is logged in to the section or not starts here 


     $sql = "SELECT author.id,author.username,author.primaryemail,author.password,author.contact from author where primaryemail='$authoremail'"; 
     $query = $dbh->prepare($sql); 
     $query->execute(); 
     $results=$query->fetchAll(PDO::FETCH_OBJ); 
     $cnt=1;
     if($query->rowCount() > 0) 
     {

   // Check that the author is logged in to the section or not ends here 


?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Paper</title>
    <link rel="shortcut icon" href="images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/index.css"> 
    <!-- <script src="js/jquery-3.5.1.slim.min.js"></script> -->
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

  <h5>UNDER REVIEW</h5>
  <hr class="bg-secondary" >
    <table id="heading-table">
    <tbody>
    <?php $sql = "SELECT paper.id,paper.authoremail,paper.papername,paper.abstract,paper.name,paper.type,paper.action from paper WHERE action=0 and authoremail='$authoremail'";
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
include 'link/linklocal.php';

$authoremail = htmlentities($result->authoremail);

$sql1 = "SELECT * FROM author WHERE  primaryemail= '$authoremail' ";

$result1 = mysqli_query($link,$sql1); 

$file1 = mysqli_fetch_assoc($result1);

$title = $file1['title'];
$fname= $file1['firstname'];
$middlename= $file1['middlename'];
$lastname= $file1['lastname'];

$authorname = $title.' '.$fname.' '.$middlename.' ' .$lastname;
 
?>
<!-- Select user  name section ends here  -->

          <!-- Dashboard section starts  -->
      
            <tr>
            <td>
            <div class="jumbotron  mb-0" >
            <a href="paper-download.php?id=<?php echo htmlentities($result->id);?>"><h5 style="font-size:16px;"><?php echo htmlentities($result->papername);?></h5></a>
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
<div class="mb-5"></div>
</div>
</div>
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

<?php      }
else {
  echo "<script>alert('You are not a Author.Try to log in as an Author');</script>";
  header("refresh:0;url=login.php");
}


   }?>