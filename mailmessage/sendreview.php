<?php 

$subject = "Paper Reviewed";

$msg = "
<html>
<body>
  <h1><b>PAPER ID : $paperid</b></h1>
  <p>Your paper has been reviewed .Please Log in to your account and Resubmit your paper if any
  correction needed</p><br>

   <br>
  <p>
   <i>
   <b>
   IUBAT Review<br>
   A Multidisciplinary Academic Journal<br>
   </b>
    <img height='100px' width='100px'src='https://iubat.edu/wp-content/uploads/2019/01/Iubat-logo-300x263.png'>
   </i>
  </p>
</body>
</html>

";
$headers = "From: journal.iubat@gmail.com\r\n";
$headers .= "Content-type: text/html\r\n";
?>