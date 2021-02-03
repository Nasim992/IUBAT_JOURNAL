<?php
session_start();
error_reporting(0);
 
include('../link/config.php');
 

if(strlen($_SESSION['alogin'])=="")
    {    
    header("Location: ../adminlogin");  
    }
    else
    {  

    // Check that the admin is logged in or not section starts here 
     $adminemail = $_SESSION["email"];

     $sql = "SELECT admin.id,admin.username,admin.fullname,admin.password,admin.email,admin.contact from admin where email='$adminemail'"; 
     $query = $dbh->prepare($sql); 
     $query->execute(); 
     $results=$query->fetchAll(PDO::FETCH_OBJ); 
     $cnt=1;
     if($query->rowCount() > 0) 
     {
     
     // Check that the admin is logged in or not section ends here 



        $authoremail = $_SESSION["email"];

        if(isset($_POST['submit']))
        {
    $password=($_POST['password']);
    $newpassword=md5($_POST['newpassword']);

        $sql ="SELECT password FROM admin WHERE email=:authoremail and password=:password and password!=:newpassword";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':authoremail', $authoremail, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
    $query-> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
    
    if($query -> rowCount() > 0)
    {
    $con="update admin set password=:newpassword where email=:authoremail";
    $chngpwd1 = $dbh->prepare($con);
    $chngpwd1-> bindParam(':authoremail', $authoremail, PDO::PARAM_STR); 
    $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
    $chngpwd1->execute();

    echo "<script>alert('Password Changed Successfully');</script>";
    header("refresh:0;url=../adminlogin");
    }
    else {
        echo "<script>alert('You entered wrong password Or,Your Current password cannot be your new password');</script>";
        header("refresh:0;url=change-password-admin");
    }
    }    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="../images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/index.css">

    <title>Change password Admin</title>

    <style>
@media only screen and (max-width: 992px) {
  form {
    margin-left:0px !important;
    margin-right:0px !important; 
  }
}
form {

  padding:20px;
  margin-top:20px;
  margin-left:200px;
  margin-right:200px;
  border:2px solid #e3e3e3;
  font-size:14px;
  
}
</style>

</head>
<body>


<!-- Author showing header sections starts  --> 
<div class="sticky-top header-floating">
<?php
include 'admin-header.php';
?> 
</div> 
<!-- Author showing header sections ends   -->


<div id="mySidebar" class="sidebar mt-3">
  <?php
  include 'admin-sidebar.php';
  ?>

</div> 

<div id="main">  

<a href="#"><span class="openbtn"onclick="openNav()" id="closesign">☰</span></a>
<a href="javascript:void(0)" class="closebtn" id="closesignof" onclick="closeNav()">×</a>
<div class="container"> 

  <h6>CHANGE YOUR PASSWORD</h6>
  <hr class="bg-secondary" >

  <form  class="change-password-form" method="post">
         <div class="form-group has-success">
        <label for="success" class="control-label">Current Password</label>
        <div class="">
         <input type="password" name="password" class="form-control" required="required" id="success" placeholder="Enter Old Password">
                                                      
          </div>
           </div> 
           <div class="form-group has-success">
            <label for="success" class="control-label">New Password</label>
            <div class="">
            <input type="password" name="newpassword" required="required" class="form-control" id="success"placeholder="Enter New Password">
              </div>
               </div>
              <div class="form-group has-success">
            <label for="success" class="control-label">Confirm Password</label>
            <div class="">
             <input type="password" name="confirmpassword" class="form-control" required="required" id="success"placeholder="Enter New Password Again">
               </div>
                 </div>
                <div class="form-group has-success">


     
                <button type="submit" name="submit" class="btn btn-success btn-sm  " >Change password</button>
   
                                           
             </form>

<div class="mb-5"></div>
</div>
</div>

<!-- Essential Js,jquery,section starts  -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-3.5.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
<!-- Essential Js,Jquery  section ends  -->  
   
</body>
</html>

<?php     

}
else {
  echo "<script>alert('You are not an Admin.Try to log in as an Admin');</script>";
  header("refresh:0;url=../adminlogin");
}

}
    

?>