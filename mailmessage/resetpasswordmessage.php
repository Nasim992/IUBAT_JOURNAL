<?php 

$subject = "RESET YOUR PASSWORD";

include 'url.php';

$msg = "Please Click the link below for resetting your password :
$url/resetpassword.php?email=$pemail&token=$validation_code_password";

$msg = "
<html>
<body>
  <p> Please Click on the link below and give your new password for resetting your password.</p><br>
   <a style='text-decoration:none;
             font-size:18px; 
             color:white;
             background-color:#c30000;
             padding:10px;
             border:none;
             border-radius:10px;
             font-weight:bold;
             'href='$url/resetpassword.php?email=$pemail&token=$validation_code_password'>CLICK HERE TO RESET YOUR PASSWORD
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