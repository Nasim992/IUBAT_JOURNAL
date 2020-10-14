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
</head>
<body>

<h1>Admin Pannel </h1>
    
</body>
</html>

    <?php } ?>