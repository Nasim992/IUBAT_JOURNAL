<?php 

$subject = "Paper Reviewed";

include 'url.php';  
 
$msg = "$paperid - this paper has been reviewed.
Please login to see the feedback of the reviewer -- $url/login";
    
$headers = "From: journal.iubat@gmail.com";
  
?>