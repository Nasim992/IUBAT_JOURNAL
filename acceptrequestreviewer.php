<?php
 
 ob_start();

session_start();

error_reporting(0); 

 include("link/config.php");  
 include('link/functionsql.php');
 ?>

<?php include("functions.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accepted</title>
</head>

<body>

    <div class="jumbotron">
        <h1 class="text-center">Accept Request <?php accept_requestreviewer() ?> </h1>
    </div>

</body>

</html>