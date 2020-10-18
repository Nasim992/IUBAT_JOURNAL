<?php
session_start();
error_reporting(0);
include('../link/config.php');

if(strlen($_SESSION['alogin'])=="")
    {    
    header("Location: login.php"); 
    }
    else
    { 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pannel</title>
    <!-- <link rel="stylesheet" href="../css/heading.css"> -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin-dashboard.css">
</head>
<body>
<div class="container">

<?php
include 'admin-header.php';
?>

<h1>Admin Pannel </h1>

</div>
<!-- Essential Js,jquery,section starts  -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-3.5.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
<!-- Essential Js,Jquery  section ends  -->    
</body>
</html>

    <?php } ?>