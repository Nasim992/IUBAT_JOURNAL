<?php 

$subject = "IUBAT Review Account Activation";

include 'url.php';

$msg = "
<html>
<body>
  <h1><b>Congratulations !</b></h1>
  <p> You have Created a Account Successfully on IUBAT Review.Now Click on the following link for Verify your account.</p><br>

   <a style='text-decoration:none;
             font-size:18px; 
             color:white;
             background-color:#196fb8;
             padding:10px;
             border:none;
             border-radius:10px;
             font-weight:bold;
             'href='$url/activate.php?email=$pemail&code=$validation_code'>CLICK HERE TO VERIFY
   </a>
   <br>
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