<?php 

$subject = "RESET YOUR PASSWORD";

include 'url.php';

$msg = "Please Click the link below for resetting your password :
$url/resetpassword.php?email=$pemail&token=$validation_code_password";

// $msg = "Please Click the link below for resetting your password
// http://nasim992.epizy.com/resetpassword.php?email=$pemail";

$headers = "From: journal.iubat@gmail.com";

?>