<?php
 
 ob_start();

session_start();
 
 include("link/linklocal.php");   
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
        <h1 class="text-center">Accept Request <?php reject_requesteditor() ?> </h1>
    </div>

</body>

</html>