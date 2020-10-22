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
    <title>Show Paper</title>
</head>
<body>
<div class="container">
<!-- Author showing header sections starts  -->

    <?php 
    include 'author-header.php';
    ?>

<!-- Author showing header sections ends   -->

    <h1>Paper Showing </h1>
    </div>
</body>
</html>

<?php } ?>