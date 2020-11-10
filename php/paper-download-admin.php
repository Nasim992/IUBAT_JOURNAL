<?php 
session_start();
error_reporting(0);

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
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$idstr=strval($_GET['id']);

$unpublished = $idstr[-1];


if (!empty($_GET['id'])) {
$id=intval($_GET['id']);

$sql = "SELECT * FROM paper WHERE id = '$id' ";

$result = mysqli_query($link,$sql);

$file = mysqli_fetch_assoc($result);

$filename = $file['name'];

$title = $file['papername'];
$abstract = $file['abstract'];
$authorname = $file['authoremail'];
$filepath = '../documents/'.$file['name'];


$sql = "SELECT * FROM author WHERE  email= '$authorname' ";

$result1 = mysqli_query($link,$sql);

$file1 = mysqli_fetch_assoc($result1);

$name = $file1['name'];

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
    <title>Document</title>
</head> 
<body>
<div class="container">
   <!-- Dashboard section starts  -->
       <div class="jumbotron">
     
        <h5 class="display-4">Name : <?php echo $title ?></h5>
        <h6 class="display-5">Author:<span style='color:goldenrod;'> <?php echo $name ?></span></h6>
        
        <h6 class="display-5">Email:<span style='color:green;'> <?php echo $authorname ?></span></h6>
        <p class="lead"><?php echo $abstract ?></p>
        <hr class="my-4">

    <?php if($unpublished == 'u') {
     ?>
     <a href="unpublished-paper.php" role="button"><i class="fa fa-backward" aria-hidden="true"></i>Go back</a>

     <?php  
    }
    else {
     ?>
     <a href="admin-dashboard.php" role="button"><i class="fa fa-backward" aria-hidden="true"></i>Go back</a>

    <?php } ?>

     <a class="btn btn-success btn-sm float-right" href="<?php echo $filepath ?> "target ="_blank" role="button">Download as PDF</a>
        </div>

    <!-- DashBoard Section ends  -->

    </div>

<!-- Essential Js,jquery,section starts  -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-3.5.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
<!-- Essential Js,Jquery  section ends  -->
</body>
</html>



<?php } else  {

    echo " Id is empty";
    } ?>