<?php
session_start();
error_reporting(0);
include('link/config.php');

if(strlen($_SESSION['alogin'])=="")
    {    
    header("Location: login.php"); 
    } 
    else
    {  

     // Check that the admin is logged in or not section starts here 
     $adminemail = $_SESSION["email"];

     $sql = "SELECT admin.id,admin.user_name,admin.full_name,admin.password,admin.email,admin.contact from admin where email='$adminemail'"; 
     $query = $dbh->prepare($sql); 
     $query->execute(); 
     $results=$query->fetchAll(PDO::FETCH_OBJ); 
     $cnt=1;
     if($query->rowCount() > 0) 
     {
     
     // Check that the admin is logged in or not section ends here 


?>  

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pannel</title>
    <!-- <link rel="stylesheet" href="css/heading.css"> --> 
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin-dashboard.css">
    <link rel="stylesheet" href="css/index.css">
    <style>
    .chngpass {
    margin-left:100px;
    margin-right:100px;
    margin-top:50px;
    }
    </style>
</head>
<body>
<div class="container ">

<div class="sticky-top">
<!-- Author showing header sections starts  -->

<?php
include 'admin-header.php';
?>

<!-- Author showing header sections ends   -->
</div>





<!-- Admin Addition Section Starts here  -->

<form  name="chngpwd" class="chngpass" method="post" \ onSubmit="return valid();">
                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">User Email</label>
                                                		<div class="">
                                                    <input type="text" name="uname" class="form-control" id="inputEmail3" placeholder="UserName" required>
                   
                                                		</div>
                                                	</div>
                                                  <div class="form-group has-success">
                                                        <label for="success" class="control-label">Password</label>
                                                        <div class="">
                                                            <input type="password" name="password" required="required" class="form-control" id="success"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"   title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Password">
                                                        </div>
                                                    </div>
                                                       <div class="form-group has-success">
                                                        <label for="success" class="control-label">Confirm Password</label>
                                                        <div class="">
                                                            <input type="password" name="newpassword" required="required" class="form-control" id="success"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"   title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Confirm Password">
                                                        </div>
                                                    </div>
                                                    
  <div class="form-group has-success">

                                                        <div class="">
                                                           <button type="submit" name="submit" class="result-color1">Submit</button>
                                                    </div>


                                                    
                                                </form>
<!-- Admin Addition Section ends Here  -->
</div>









<!-- Essential Js,jquery,section starts  -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<!-- Essential Js,Jquery  section ends  -->  
</body>
</html>

<?php 

}
else {
  echo "<script>alert('You are not an Admin.Try to log in as an Admin');</script>";
  header("refresh:0;url=login.php");
}

}
    
    
    
    ?>