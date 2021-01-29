<?php  
session_start();
error_reporting(0);

include '../link/linklocal.php';
   

      // Check that the admin is logged in or not section starts here 
      include '../link/config.php';
      $adminemail = $_SESSION["email"];
      $sql = "SELECT admin.id,admin.username,admin.fullname,admin.password,admin.email,admin.contact from admin where email='$adminemail'"; 
      $query = $dbh->prepare($sql); 
      $query->execute(); 
      $results=$query->fetchAll(PDO::FETCH_OBJ); 
      $cnt=1;
      if($query->rowCount() > 0) 
      {
      
      // Check that the admin is logged in or not section ends here 





if(strlen($_SESSION['alogin'])=="")
    {     
        header("Location:../adminlogin");  
    }
    else
    {  


if($link === false){
    die("ERROR: Could not connect. " .mysqli_connect_error());
}

// $id=intval($_GET['id']);

if (!empty($_GET['id'])) {
$id=intval($_GET['id']);

$sql = "SELECT * FROM paper WHERE id = '$id' ";

$result = mysqli_query($link,$sql);

$file = mysqli_fetch_assoc($result);

$filename = $file['name'];

$papername = $file['papername'];
$abstract = $file['abstract'];
$authorname = $file['authoremail'];
$filepath = '../documents/'.$file['name'];


$sql = "SELECT * FROM author WHERE  primaryemail= '$authorname' ";

$result1 = mysqli_query($link,$sql); 

$file1 = mysqli_fetch_assoc($result1);

$title = $file1['title'];
$fname= $file1['firstname'];
$middlename= $file1['middlename'];
$lastname= $file1['lastname'];

$name = $title.' '.$fname.' '.$middlename.' ' .$lastname;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/index.css">
    <title>Download paper</title>
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

  <h4>DOWNLOAD THIS PAPER</h4>
<hr class="bg-secondary" >
   <!-- Dashboard section starts  -->
   <div class="jumbotron "> 
     
     <h5 class="display-4">Name : <?php echo $papername ?></h5>
     <?php 
     if ($authoremail == "") {
         ?>
          <h6 class="display-5">Author:<span style='color:goldenrod;'> <?php echo $name; ?></span></h6>
       <?php 
     }
     else {
     ?>
    <h6 class="display-5">Author:<span style='color:goldenrod;'> <?php echo $name; ?></span></h6>
     <?php 
     }  
     ?>
     
     <p style="font-size:14px;"><b>Abstract:</b><?php echo $abstract ?></p>
     <hr class="my-4">
   

     <a style="font-size:14px;" class="btn btn-success btn-sm float-right" href="<?php echo $filepath ?> "target ="_blank" role="button">Download</a>
     </div>

 <!-- DashBoard Section ends  -->

    </div>
    </div>
</div>
<!-- Essential Js,jquery,section starts  -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-3.5.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
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



<?php } else  {

    echo " Id is empty";
    } 
}
}
else {
    echo "<script>alert('You are not an Admin.Try to log in as an Admin');</script>";
    header("refresh:0;url=login.php");
  }
    

    
    ?>