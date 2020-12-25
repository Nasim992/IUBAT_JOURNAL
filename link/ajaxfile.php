<?php
include "configmanual.php";
 
// Check the username is available or not section starts here 
if(isset($_POST['username'])){
   $username = $_POST['username'];

   $query = "select count(*) as cntUser from author where username='".$username."'";

   $result = mysqli_query($con,$query);
   $response = "<span style='color: green;'>User name is Available.</span>";
   if(mysqli_num_rows($result)){
      $row = mysqli_fetch_array($result);

      $count = $row['cntUser'];
    
      if($count > 0){
          $response = "<span style='color: red;'> User Name is Not Available.</span>";
      }
   
   }

   echo $response;
   die;
}
// Chekc the username is available or not section ends here 

// Check that the email is available or not starts here 

if(isset($_POST['primaryemail'])){
   $primaryemail = $_POST['primaryemail'];

   $query = "select count(*) as cntUser from author where primaryemail='".$primaryemail."'";

   $result = mysqli_query($con,$query);
   $response = "<span style='color: green;'>Email is Available.</span>";
   if(mysqli_num_rows($result)){
      $row = mysqli_fetch_array($result);

      $count = $row['cntUser'];
    
      if($count > 0){
          $response = "<span style='color: red;'>Email is Already Exists.Try another one</span>";
      }
   
   }

   echo $response;
   die;
}

// Check that the email is available or not ends here 

// Check that the email is matched or not starts here 

if(isset($_POST['pemailAgain'])){
   $pemailAgain = $_POST['pemailAgain'];
   $pemail = $_POST['pemail'];

   // $query = "select count(*) as cntUser from author where primaryemail='".$primaryemail."'";

   // $result = mysqli_query($con,$query);
   if($pemailAgain == $pemail){
      $response = "<span style='color: green;'>Email is Matched.</span>";
      }
      else  {

         $response = "<span style='color: red;'>Email is Not  Matched with the previous.</span>";
      }

   echo $response;
   die;
}

// Check that the email is matched or not ends here 

// Check that the pass is matched or not section starts here 
// Check that the email is matched or not starts here 

if(isset($_POST['userrepeatpass'])){
   $userrepeatpass = $_POST['userrepeatpass'];
   $userpassword= $_POST['userpassword'];

   // $query = "select count(*) as cntUser from author where primaryemail='".$primaryemail."'";

   // $result = mysqli_query($con,$query);
   if($userrepeatpass == $userpassword){
      $response = "<span style='color: green;'>Password is Matched.</span>";
      }
      else  {

         $response = "<span style='color: red;'>Password is Not  Matched with the previous.</span>";
      }

   echo $response;
   die;
}

// Check that the email is matched or not ends here 
// Check that the pass is matched or not section ends here 



?>