<?php 
session_start();
error_reporting(0);
include('link/config.php'); 
include('link/functionsql.php'); 
include('link/loginfunction.php');
include('link/count.php');
include('functions.php');
// Check Already logged in or not 
if (isset($_SESSION['alogin'])){
    $email = $_SESSION["email"];
} 
// Checked Already Logged in or not

    if(isset($_POST['admin-login']))  
    {
        admin_login(); // form loginfunction.php file
    }
// Login section 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IUBAT Review</title>
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/login.js"></script>
    <link rel="shortcut icon" href="images/Iubat-logo.png" type="image/x-icon">
    <?php include 'link/csslinks.php'; ?>
    <style>
    .instruction__fontsize  small{
        font-size:16px !important;
    }
    </style>
</head>
<body>
        <header class="sticky-top">
            <!-- Heading Sections starts  --> 
            <?php  include 'heading.php';?>
            <!-- Heading Sections ends  -->
        </header>
        <div style="font-size:17px; font-weight:bold;" class="container form-control-login">
            <div class="row pt-2">
<!-- --------------------------------Instructions for authors ----------------------------------------------------   -->
            <div  class="col-sm-12 col-md-12 col-lg-6 col-xl-6 instruction__fontsize text-justify">
                    <h4 class="text-center"><b>Instructions for Admin </b></h4>
                    <p style="font-size:20px;color:red;"><b>Important Note:</b>Don't Forget your password.No System Available for resetting password for admin</p>
           
                </div>
<!-- --------------------------------Instructions for authors ----------------------------------------------------   -->

<!-- ------------------------------Log in form/Sign in form ------------------------------------------------------------ -->
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 pt-4 ">
                    <div id="logreg-forms">
                        <form class="form-signin marginbtm" method="post"> 
                            <div class="logo-container">
                                <i style="font-size:35px;color:#17a2b8;" class="fas fa-users logo"></i>
                            </div>
                            <h3 class="h3 mb-3 font-weight-normal"
                                style="text-align: center;font-size:18px; padding:5px;"><b> SIGN IN</b></h3>
                            <div class="social-login">     
                            </div>
                            <?php  display_message(); ?>
                            <input style="font-size:16px;" type="email" id="inputEmail" class="form-control" name="input-email" placeholder="Email address" required="">
                            <input style="font-size:16px;" type="password" id="inputPassword"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" name="input-password" class="form-control" placeholder="Password" required>
                          <?php if(empty($email)) {  ?>
                                <div>
                                    <button class="btn btn-info btn-block" name="admin-login" type="submit">Admin</button>
                                </div>
                            <?php }else {
                                echo "<p class='alert alert-warning'>Logged out first then try to logged in again</p>";
                            } ?>
                        </form>
<!-- ------------------------------Log in form ------------------------------------------------------------ -->
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-5"></div>
        <div class="pb-5"></div>
        <div class="pb-5"></div>
        <!-- Footer section starts here  -->
        <?php include 'footer.php'; ?>
        <!-- Footer section ends here  -->
</body>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
</html>