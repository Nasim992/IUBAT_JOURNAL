 <?php
 
 ob_start();

session_start(); 

error_reporting(0); 
 
 include("link/linklocal.php"); 
 include('link/functionsql.php');
 include("functions.php");

 activate_user();