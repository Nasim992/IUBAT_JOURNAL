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
        $authoremail = $_SESSION["email"];

        if(isset($_POST['submit']))
        {
    $password=md5($_POST['password']);
    $newpassword=md5($_POST['newpassword']);

        $sql ="SELECT password FROM author WHERE email=:authoremail and password=:password and password!=:newpassword";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':authoremail', $authoremail, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
    $query-> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
    
    if($query -> rowCount() > 0)
    {
    $con="update author set password=:newpassword where email=:authoremail";
    $chngpwd1 = $dbh->prepare($con);
    $chngpwd1-> bindParam(':authoremail', $authoremail, PDO::PARAM_STR); 
    $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
    $chngpwd1->execute();

    echo "<script>alert('Password Changed Successfully');</script>";
    header("refresh:0;url=login.php");
    }
    else {
        echo "<script>alert('You entered wrong password Or,Your Current password cannot be your new password');</script>";
        header("refresh:0;url=change-password-author.php");
    }
    }    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <title>Change password Author</title>

<style>
.change-password-form {
    margin-left:100px;
    margin-right:100px;
    margin-top:50px;
}
</style>

</head>
<body>
    <div class="container">
<!-- Author showing header sections starts  -->

<?php 
    include 'author-header.php';
    ?>

<!-- Author showing header sections ends   -->

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

               <div class="d-flex justify-content-between mt-5">
               <div>
               <a href="author-paper-show.php" role="button"><i class="fa fa-backward" aria-hidden="true"></i>Go back</a>
               </div>
                <div >
                <button type="submit" name="submit" class="btn btn-success btn-block float-right" >Change password</button>
                </div>
                  
               </div>                                     
             </form>
    </div>

        <!-- Essential Js,jquery,section starts  -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/popper.min.js"></script>

        <!-- Essential Js,Jquery  section ends  -->   
</body>
</html>

<?php     }  ?>