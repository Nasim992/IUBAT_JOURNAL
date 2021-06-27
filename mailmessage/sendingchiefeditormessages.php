<?php
$subject = "New paper uploaded on IUBAT Review";

include 'url.php'; 
 
$msg = "
<html>
<body>
  <h1><b>New Paper Uploaded named <i>$papername</i></b></h1>
  <p>Here, is the abstract of this paper:</p> <br>
  <p style='border:1px solid #093c472e; padding:10px;font-size:14px;border-radius:5px;'><i>
     $abstract 
  </i></p>
<br>
<p>If you want to accept this Request as a Editor for this paper please click the  acceptation link:</p>
   <a style='text-decoration:none;
             font-size:18px; 
             color:white;
             background-color:#196fb8;
             padding:10px;
             border:none;
             border-radius:10px;
             font-weight:bold;
             'href='$url/login'>CLICK HERE TO LOG IN TO THE SYSTEM
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