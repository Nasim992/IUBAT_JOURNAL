<?php 

$subject = "New paper uploaded on IUBAT Review";

include 'url.php'; 
 
$msg = "paper name  - $papername.
     Here, is the abstract of this paper
      $abstract 
      Please Log in to your account to visit the paper - $url/login";
    
$headers = "From: journal.iubat@gmail.com";
 
?>