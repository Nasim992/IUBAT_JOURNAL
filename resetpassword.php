<?php 
session_start();
error_reporting(0);
include('link/config.php');

    $email = $_GET['email'];
    // Reset-Password section starts here 
    
    if(isset($_POST['change-submit']))  
    {
        $pemail = $_POST['remail'];
        $password = md5($_POST['rpassword']);
        $passwordconf = md5($_POST['rpasswordconf']);

        if($password !== $passwordconf) {
            echo "<script>alert('Password does not match properly.);</script>";
        }
        else {

    // Change Password Section Starts Here 
    $sql="update author set password='$password' where primaryemail='$pemail'";

    if(query($sql)) {
    
        echo "<script>alert('Password Changed Successfully');</script>";
        header("refresh:0;url=login");

    }else
    {
        echo "<script>alert('Something went wrong!');</script>";
    }
        }
    }

    
    // Reset-Password section ends here 


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RESET PASSWORD</title>
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/login.js"></script>
    <link rel="shortcut icon" href="images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/heading.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>

<div style="font-size:14px; font-weight:bold;" class="container form-control-login">
       <div class="row pt-5">

           <div id="logreg-forms">
        <form class="form-signin marginbtm" method="post">
        <div class="logo-container">
                    <img src="images/forgotpass.png" alt="">
            </div>



            <input style="font-size:13px;" type="hidden" id="inputEmail" class="form-control"name = "remail" placeholder=""value="<?php echo $email;  ?>">

            <input style="font-size:13px;" type="password" id="inputPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name = "rpassword" class="form-control" placeholder="Enter New password" required>

            <input style="font-size:13px;" type="password" id="inputPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name = "rpasswordconf" class="form-control" placeholder="Enter New password again" required>
            
            <button class="btn btn-success btn-sm btn-block" name = "change-submit" type="submit" > Change password</button>

            <div class="pb-5"></div>
            
           </div>
            
    </div>
  

       </div>
    </div>

</body>

</html>