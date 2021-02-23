<?php 

$subject = "IUBAT Review Account Activation Link";

include 'url.php';

$msg = "Congratulations You have Created a Journal Account Successfully Now Click on the following link for activate your account.
$url/activate.php?email=$pemail&code=$validation_code";


$headers = "From: journal.iubat@gmail.com";
 

?>