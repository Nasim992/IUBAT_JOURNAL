<?php
$subject = "Paper Rejected";

$msg = "
<html>
<body>
  <h1><b>SORRY!</b></h1>
  <p>Your paper <b>$paperid</b> named <b>$papername</b> has been Rejected by IUBAT Review.
    Good Work ! Please keep with IUBAT Review.
  </p><br>

  <hr>
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