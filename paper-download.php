<?php  
session_start();
error_reporting(0);

// $link = mysqli_connect("sql103.epizy.com", "epiz_27210191", "d1cMVcXvOSxtu6q", "epiz_27210191_iubat");

$link = mysqli_connect("localhost", "root", "", "iubat");
   

if(strlen($_SESSION['alogin'])=="")
    {    
        $authoremail = "";
    }
    else
    {  
      $authoremail = $_SESSION["email"];
    }

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
$filepath = 'documents/'.$file['name'];


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
    <link rel="shortcut icon" href="images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet" href="css/index.css">
    <title>Document</title>
</head> 
<body>

<div class="sticky-top pb-3">
    <!-- Heading Sections starts  -->
    <?php 
    include 'heading.php'
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
    <div class="text-left">

    </div>

<hr class="bg-secondary" >
   <!-- Dashboard section starts  -->
   <div class="jumbotron "> 
     
     <h5 class="display-4">Name : <?php echo $papername ?></h5>
     <?php 
     if ($authoremail == "") {
         ?>
      
       <?php 
     }
     else {
     ?>
    <h6 class="display-5">Author:<span style='color:goldenrod;'> <?php echo $name; ?></span></h6>
     <?php 
     }  
     ?>
     
     <h6 class="display-5">Email:<span style='color:green;'> <?php echo $authorname ?></span></h6>
     <p style="font-size:14px;"><?php echo $abstract ?></p>
     <hr class="my-4">
   
     <?php 
     if ($authoremail == "") {
         ?>
       <a href="index.php" role="button"><i class="fa fa-backward" aria-hidden="true"></i>Go back</a>
      
       <?php 
     }
     else {
     ?>
    <a href="author-paper-show.php" role="button"><i class="fa fa-backward" aria-hidden="true"></i>Go back</a>
     <?php 
     }  
     ?>
     <a style="font-size:14px;" class="btn btn-success btn-sm float-right" href="<?php echo $filepath ?> "target ="_blank" role="button">Download as PDF</a>
     </div>

 <!-- DashBoard Section ends  -->

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



<?php } else  {

    echo " Id is empty";
    } ?>