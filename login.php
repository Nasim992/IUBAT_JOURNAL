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

// Login section 
    if(isset($_POST['author-login']))  
    {
        author_login();  // form loginfunction.php file
    }
    if(isset($_POST['reviewer-login']))  
    {
        reviewer_login(); // form loginfunction.php file

    }  
    if(isset($_POST['editor-login']))  
    {
        editor_login(); // form loginfunction.php file
    }
// Login section 

// Sign-up/Register 
    if(isset($_POST['sign-up']))
    { 
        sign_up(); // form loginfunction.php file
    } 
// Sign-up/Register

// Reset Password
    if(isset($_POST['rsubmit']))  
    {
        forgot_password(); // form loginfunction.php file
    }
// Reset Password 
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
                    <h4 class="text-center"><b>Instructions </b></h4>
                    <p><b>First-time users:</b><small> Please click on the word "Register" in the navigation bar at the
                            top of the page and enter the requested information. Upon successful registration, you will
                            be sent an e-mail with instructions to verify your registration. NOTE: If you received an
                            e-mail from us with an assigned user ID and password, DO NOT REGISTER AGAIN. Simply use that
                            information to login. Usernames and passwords may be changed after registration (see
                            instructions below).</small></p>
                    <p><b>Repeat Users:</b><small> Please click the "Login" button from the menu above and proceed as
                            appropriate.</small></p>
                    <p><b>Authors:</b><small> Please click the "Login" button from the menu above and login to the
                            system as "Author." You may then submit your manuscript and track its progress through the
                            system.</small></p>
                    <p><b>Reviewers:</b><small> Please click the "Login" button from the menu above and login to the
                            system as "Author." You may then view and/or download manuscripts assigned to you for review
                            or submit your comments to the editor and the authors.</small></p>
                    <p><b>To change your username and/or password:</b><small> Once you are registered, you may change
                            your contact information, password at any time. Simply log in to the system and click on
                            "Update Profile" on your pannel.</small></p>
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
                            <div class="d-flex justify-content-between">
                                <div>
                                    <button class="btn btn-info  ml-1" name="author-login" type="submit">Author</button>
                                </div>
                                <div>
                                    <button class="btn btn-info ml-1" name="reviewer-login" type="submit">Reviewer</button>
                                </div>
                                <div>
                                    <button class="btn btn-info ml-1" name="editor-login" type="submit">Editor</button>
                                </div>
                            </div>
                            <div class="login-details ">
                                <ul class="d-flex justify-content-center">
                                    <li id="btn-signup"><a href="#">Register Now</a></li>
                                    <li><a href="guideline">login Help </a></li>
                                </ul>
                            </div>
                            <a href="#" id="forgot_pswd">Forgot password?</a>
                            <hr>
                            <?php }else {
                                echo "<p class='alert alert-warning'>Logged out first then try to logged in again</p>";
                            } ?>
                        </form>
<!-- ------------------------------Log in form ------------------------------------------------------------ -->

<!-- ------------------------------Reset Password ------------------------------------------------------------ -->
                <form class="form-reset marginbtm" method="post">
                    <div class="logo-container">
                        <img src="images/forgotpass.png" alt="">
                    </div>
                    <input type="email" name="remail" id="resetEmail" class="form-control" placeholder="Write Your Primary Email Address" required="">
                    <button class="btn btn-info btn-block" type="submit" name="rsubmit">Reset Password</button>  <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> Back</a>
                </form>
<!-- ------------------------------Reset Password ------------------------------------------------------------ -->

<!-- ------------------------------Sign up/Registration ------------------------------------------------------------ -->
                        <form class="form-signup marginbtm" method="post">
                            <div class="logo-container">
                                <i style="font-size:35px;color:#17a2b8;" class="fas fa-user-plus logo"></i>
                            </div>
                            <h2 style="text-align:center;font-size:18px;padding:5px;"><b>REGISTRATION FORM</b></h2>
                            <input style="font-size:16px;" type="text" class="form-control" name="title"  placeholder="Title (Mr., Mrs., Dr., etc.)" required="" autofocus="">
                            <div class="input-group">
                            <input style="font-size:16px;" type="text" class="form-control col-sm-6"name="firstName" placeholder="First Name" required="" autofocus="">
                            <input style="font-size:16px;" type="text" class="form-control col-sm-6 ml-1"name="middleName" placeholder="Middle Name(Optional)" autofocus="">
                            <input style="font-size:16px;" type="text" class="form-control col-sm-6 ml-1"name="lastName" placeholder="Last Name" required="" autofocus="">
                            </div>
                            <input style="font-size:16px;" type="email" id="pemail" class="form-control"onfocusout="handlefocus()" name="pemail" placeholder="Primary Email Address" required="" autofocus="">
                            <span><b id="pemail-text"></b></span>
                            <input style="font-size:16px;" type="email" id="pemailAgain" class="form-control"name="pemailAgain" placeholder="Primary Email Address again" required="" autofocus="">
                            <span><b id="pemailAgain-response"></b></span>
                            <input style="font-size:16px;" type="email" class="form-control" name="semail"placeholder="Secondary Email Address" required="" autofocus="">
                            <input style="font-size:16px;" type="password" id="user-pass" onfocusout="handlepasschange()" name="user-password" class="form-control" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"   title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" required autofocus="">
                            <input style="font-size:16px;" type="password" id="user-repeatpass" name="repeat-password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control" placeholder="Repeat Password" required autofocus="">
                            <span><b id="user-reapeatpass-response"></b></span>
                            <input style="font-size:16px;" type="text" id="user-contact" name="user-contact" class="form-control" placeholder="Contact Number" required autofocus="">
                            <input style="font-size:16px;" type="text" id="user-address" name="user-address" class="form-control" placeholder="Address" required autofocus="">
                            <button name="sign-up" class="btn btn-info btn-block" type="submit"><i class="fas fa-user-plus"></i> REGISTER</button>
                            <br>
                            <hr>
                            <a href="#" id="cancel_signup"><i class="fas fa-angle-left"></i> Back</a>
                        </form>
<!-- ------------------------------Sign up/Registration ------------------------------------------------------------ -->
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
<!-- Check that the username is availavle on the database or not  -->
<script>
$(document).ready(function() {
    $("#txt_username").keyup(function() {
        var username = $(this).val().trim();
        if (username != '') {
            $.ajax({
                url: 'link/ajaxfile.php',
                type: 'post',
                data: {
                    username: username
                },
                success: function(response) {
                    $('#uname_response').html(response);
                }
            });
        } else {
            $("#uname_response").html("");
        }
    });
});

//  Email is exists or not checking email

$(document).ready(function() {
    $("#pemail").keyup(function() {
        var primaryemail = $(this).val().trim();
        if (primaryemail != '') {
            $.ajax({
                url: 'link/ajaxfile.php',
                type: 'post',
                data: {
                    primaryemail: primaryemail
                },
                success: function(response) {
                    $('#pemail-text').html(response);
                }
            });
        } else {
            $("#pemail-text").html("");
        }
    });
});
// Check that the email address is exists or not in the database secion ends here 

// Checking Previous Email is matched or not starts here
function handlefocus() {
    $(document).ready(function() {
        var pemail = document.getElementById('pemail').value;
        $("#pemailAgain").keyup(function() {
            var pemailAgain = $(this).val().trim();
            if (pemailAgain != '') {
                $.ajax({
                    url: 'link/ajaxfile.php',
                    type: 'post',
                    data: {
                        pemailAgain: pemailAgain,
                        pemail: pemail
                    },
                    success: function(response) {
                        $('#pemailAgain-response').html(response);
                    }
                });
            } else {
                $("#pemailAgain-response").html("");
            }
        });
    });
}
// Checking previous Email is matched or not ends here

// Checking that the reapeat pass is matched or not section starts here 
function handlepasschange() {
    $(document).ready(function() {
        var userpassword = document.getElementById('user-pass').value;
        console.log(userpassword);
        $("#user-repeatpass").keyup(function() {
            var userrepeatpass = $(this).val().trim();
            if (userrepeatpass != '') {
                $.ajax({
                    url: 'link/ajaxfile.php',
                    type: 'post',
                    data: {
                        userrepeatpass: userrepeatpass,
                        userpassword: userpassword
                    },
                    success: function(response) {
                        $('#user-reapeatpass-response').html(response);
                    }
                });
            } else {
                $("#user-reapeatpass-response").html("");
            }
        });
    });
}
// Checking that the repeat pass is matched or not section ends here  section is ends here 
</script>
<!-- Check that the username is availavle on the database or not  -->
</html>