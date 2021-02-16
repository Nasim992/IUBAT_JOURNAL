<?php  
 
$sqlauthorernam = "SELECT * FROM author WHERE  primaryemail= '$authoremail' or username='$username' ";

$resultauthorernam = mysqli_query($link,$sqlauthorernam);  
 
$fileauthorername = mysqli_fetch_assoc($resultauthorernam);
 
$title = $fileauthorername['title'];
$fname= $fileauthorername['firstname'];
$middlename= $fileauthorername['middlename'];
$lastname= $fileauthorername['lastname'];

$authorname = $title.' '.$fname.' '.$middlename.' ' .$lastname;

?>