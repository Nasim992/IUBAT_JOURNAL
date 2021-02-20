<?php 
session_start();
error_reporting(0);
include('link/config.php'); 
include('link/functionsql.php');
include('functions.php');
 
if($_SESSION['alogin']!=''){
    $_SESSION['alogin']=''; 
    }
    //  Author log in section starts here
    if(isset($_POST['publisher-login']))  
    {
 
    $email = $_POST['input-email'];
    $password=md5($_POST["input-password"]); 
    $_SESSION["email"]=$_POST['input-email']; // push to the session

    $sql ="SELECT primaryemail,password,activation FROM author WHERE primaryemail=:email and password=:password and activation IS NOT NULL";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();  

    $results=$query->fetchAll(PDO::FETCH_OBJ);

    if($query->rowCount() > 0) 
    {
    $_SESSION['alogin']=$_POST['input-email'];
    echo "<script>alert('Logged in Success');</script>";
    echo "<script type='text/javascript'> document.location = 'author/dashboard'; </script>";
    } else{ 
        
        echo "<script>alert('Invalid Details.Enter Correct Information');</script>";
        header("refresh:0;url=login");
    
    }
    }
     
//  Reviewer sign in Option ends here

    //  Reviewer login in option starts here
    if(isset($_POST['reviewer-login']))  
    {

    $email = $_POST['input-email'];
    $password=md5($_POST["input-password"]); 
    $_SESSION["email"]=$_POST['input-email']; // push to the session

    // Author Checking that reviewer is selected or not section
    $sql ="SELECT primaryemail,password,reviewerselection FROM author WHERE primaryemail=:email and password=:password and reviewerselection=1";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();   
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    // Author Checking that reviewer is selected or not section

    if($query->rowCount() > 0)
    {
    $_SESSION['alogin']=$_POST['input-email'];
    echo "<script>alert('Logged in Success');</script>";
    echo "<script type='text/javascript'> document.location = 'reviewer/dashboard'; </script>";
    } else{ 
        
        echo "<script>alert('Invalid Details.Or,You are not selected as a Reviewer');</script>";
        header("refresh:0;url=login");
     
    }
    } 
     
//  Reviewer Log in Option ends here
 
    //  Editor login in option starts here
    if(isset($_POST['editor-login']))  
    {
    $email = $_POST['input-email'];
    $password=md5($_POST["input-password"]); 
    $_SESSION["email"]=$_POST['input-email']; // push to the session

    $sql ="SELECT author.id,author.primaryemail,author.password,author.associateeditor,author.academiceditor FROM author WHERE primaryemail=:email and password=:password";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR); 
    $query-> execute();  
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
        // Selecting Associate Editor and Academic Editor Section Starts Here 
        foreach($results as $result) {
            $associateeditor = htmlentities($result->associateeditor);
            $academiceditor = htmlentities($result->academiceditor);
            if($associateeditor==1) {
                $_SESSION['alogin']=$_POST['input-email'];
                echo "<script>alert('Logged in Success');</script>";
                echo "<script type='text/javascript'> document.location = 'associateeditor/dashboard'; </script>";
            }
            else if($academiceditor==1) {
                $_SESSION['alogin']=$_POST['input-email']; 
                echo "<script>alert('Logged in Success');</script>";
                echo "<script type='text/javascript'> document.location = 'academiceditor/dashboard'; </script>";
            }
            else {
                echo "<script>alert('You are not selected as an editor.');</script>";
                header("refresh:0;url=login");
            }
        }
     // Selecting Associate Editor and Academic Editor Section Starts here 
    } else{ 
        
        echo "<script>alert('Invalid Details.Or,You are not selected as a Editor');</script>";
        header("refresh:0;url=login");
    }
    }
     
//  Editor Log in Option ends here


    // Sign Up form section starts here 

        if(isset($_POST['sign-up']))
        { 

        $username=$_POST['userName'];
        $title=$_POST['title'];
        $firstname=$_POST['firstName'];
        $middlename=$_POST['middleName'];
        $lastname=$_POST['lastName'];
        $pemail=$_POST['pemail'];
        $pemailAgain=$_POST['pemailAgain'];
        $pemailcc=$_POST['pemailcc'];
        $semail=$_POST['semail'];
        $semailcc=$_POST['semailcc'];
        $userpassword=md5($_POST['user-password']);
        $repeatpassword=md5($_POST['repeat-password']);
        $contact=$_POST['user-contact'];
        $address=$_POST['user-address'];

        $validation_code = md5($username . microtime());  

        $sql="INSERT INTO  author(username,title,firstname,middlename,lastname,primaryemail,primaryemailcc,secondaryemail,secondaryemailcc,password,contact,address,validation_code) VALUES(:username,:title,:firstname,:middlename,:lastname,:pemail,:pemailcc,:semail,:semailcc,:userpassword,:contact,:address,:validation_code)";

        $query = $dbh->prepare($sql);

        $query->bindParam(':username',$username,PDO::PARAM_STR);
        $query->bindParam(':title',$title,PDO::PARAM_STR);
        $query->bindParam(':firstname',$firstname,PDO::PARAM_STR);
        $query->bindParam(':middlename',$middlename,PDO::PARAM_STR);
        $query->bindParam(':lastname',$lastname,PDO::PARAM_STR);
        $query->bindParam(':pemail',$pemail,PDO::PARAM_STR);
        $query->bindParam(':pemailcc',$pemailcc,PDO::PARAM_STR);
        $query->bindParam(':semail',$semail,PDO::PARAM_STR);
        $query->bindParam(':semailcc',$semailcc,PDO::PARAM_STR);

        $query->bindParam(':userpassword',$userpassword,PDO::PARAM_STR);
        $query->bindParam(':contact',$contact,PDO::PARAM_STR);
        $query->bindParam(':address',$address,PDO::PARAM_STR);
        $query->bindParam(':validation_code',$validation_code,PDO::PARAM_STR);
      
        $query->execute();

        $results=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0) 
        {
                    // Activation Link sending Messages starts here
                    include './mailmessage/accountactivation.php'; 
                    // Activation Link sending Messages section ends here
                    
                    send_email($pemail, $subject, $msg, $headers);
        echo "<script>alert('Activation Link is sent to this $pemail.Log in to your gmail Account and Activate your Account.');</script>";
        echo "<script type='text/javascript'> document.location = 'login'; </script>";
        } else{
            
            echo "<script>alert('Invalid Details !UserName or Email address already is in use');</script>";
            header("refresh:0;url=login");
        }
        } 

    // Sign Up form section ends here 

    // Reset-Password section starts here 
    
    if(isset($_POST['rsubmit']))  
    {

        $pemail = $_POST['remail'];

        // Reseting link sending mail section starts here.
        include './mailmessage/resetpasswordmessage.php';
        // Reseting link sending mail section ends here 

     //  Check that the email is available or not in the database

     $sql = "SELECT author.id,author.username,author.primaryemail,author.password,author.contact from author where primaryemail='$pemail'"; 
     $query = $dbh->prepare($sql); 
     $query->execute(); 
     $results=$query->fetchAll(PDO::FETCH_OBJ); 
     $cnt=1;
     if($query->rowCount() > 0) 
     {
   // Check that the email is available or not in the database

    if(send_email($pemail, $subject, $msg, $headers)) {
        echo "<script>alert('Reset password link is given to your gmail.');</script>";
    }
    else {
            echo "<script>alert('Something went wrong!');</script>";
        }
    }else
    {
        echo "<script>alert('Email is not available on the database!');</script>";
    }
    }
    // Reset-Password section ends here 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IUBAT JOURNAL</title>
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/login.js"></script>
    <link rel="shortcut icon" href="images/Iubat-logo.png" type="image/x-icon">
    <!-- Css links -->
    <?php include 'link/csslinks.php'; ?>
    <!-- Css links -->
</head>

<body>

    <div class="content">
        <div>
            <!-- Heading Sections starts  -->
            <?php 
    include 'heading.php';
    ?>
            <!-- Heading Sections ends  -->
        </div>

        <div style="font-size:14px; font-weight:bold;" class="container form-control-login">
            <div class="row pt-2">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 form-section-login">
                    <div id="logreg-forms">
                        <form class="form-signin marginbtm" method="post">
                            <div class="logo-container">
                                <i style="font-size:35px;" class="fas fa-users logo"></i>
                            </div>
                            <h3 class="h3 mb-3 font-weight-normal"
                                style="text-align: center;font-size:18px; padding:5px;"><b> SIGN IN</b></h3>
                            <div class="social-login">
        
                            </div>

                            <?php  
               
               display_message();

             ?>

                            <!-- Sign in Section starts Here -->

                            <input style="font-size:13px;" type="email" id="inputEmail" class="form-control"
                                name="input-email" placeholder="Email address" required="">

                            <input style="font-size:13px;" type="password" id="inputPassword"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"
                                name="input-password" class="form-control" placeholder="Password" required>

                            <!-- <button class="btn btn-success btn-sm" name = "admin-login" type="submit" > Admin Login</button> -->
                            <div class="d-flex justify-content-between">
                                <div>
                                    <button class="btn btn-success btn-sm ml-1" name="publisher-login" type="submit">
                                        Author</button>
                                </div>
                                <div>
                                    <button class="btn btn-success btn-sm ml-1" name="reviewer-login" type="submit">
                                        Reviewer</button>
                                </div>

                                <div>
                                    <button class="btn btn-success btn-sm ml-1" name="editor-login" type="submit">
                                        Editor</button>
                                </div>
                            </div>


                            <div class="login-details ">
                                <ul class="d-flex justify-content-center">
                                    <!-- <li><a href="#"> Send Login Details</a></li> -->
                                    <li id="btn-signup"><a href="#">Register Now</a></li>
                                    <li><a href="guideline">login Help </a></li>
                                </ul>

                            </div>

                            <a href="#" id="forgot_pswd">Forgot password?</a>
                            <hr>

                        </form>


                        <!-- Reset section starts here  -->

                        <form class="form-reset marginbtm" method="post">
                            <div class="logo-container">
                                <img src="images/forgotpass.png" alt="">
                            </div>


                            <input type="email" name="remail" id="resetEmail" class="form-control"
                                placeholder="Write Your Primary Email Address" required="">

                            <button class="btn btn-sm btn-info btn-block" type="submit" name="rsubmit">Reset
                                Password</button>
                            <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> Back</a>
                        </form>

                        <!-- Reset section ends here  -->




                        <!-- Sign up section starts here  -->

                        <form class="form-signup marginbtm" method="post">

                            <div class="logo-container">
                                <i style="font-size:35px;" class="fas fa-user-plus logo"></i>
                            </div>

                            <h2 style="text-align:center;font-size:18px;padding:5px;"><b>REGISTRATION FORM</b></h2>

                            <!-- New Registration Form section starts Here  -->
                            <input style="font-size:11px;" type="text" id="txt_username" class="form-control"
                                name="userName" placeholder="Enter Preferred User Name" required="" autofocus="">
                            <span><b id="uname_response"></b></span>


                            <input style="font-size:11px;" type="text" class="form-control" name="title"
                                placeholder="Title (Mr., Mrs., Dr., etc.)" required="" autofocus="">

                            <div class="input-group">

                                <input style="font-size:11px;" type="text" class="form-control col-sm-6"
                                    name="firstName" placeholder="First Name" required="" autofocus="">

                                <input style="font-size:11px;" type="text" class="form-control col-sm-6 ml-1"
                                    name="middleName" placeholder="Middle Name(Optional)" autofocus="">

                                <input style="font-size:11px;" type="text" class="form-control col-sm-6 ml-1"
                                    name="lastName" placeholder="Last Name" required="" autofocus="">

                            </div>

                            <input style="font-size:11px;" type="email" id="pemail" class="form-control"
                                onfocusout="handlefocus()" name="pemail" placeholder="Primary Email Address" required=""
                                autofocus="">
                            <span><b id="pemail-text"></b></span>

                            <input style="font-size:11px;" type="email" id="pemailAgain" class="form-control"
                                name="pemailAgain" placeholder="Primary Email Address again" required="" autofocus="">
                            <span><b id="pemailAgain-response"></b></span>

                            <input style="font-size:11px;" type="email" class="form-control" name="pemailcc"
                                placeholder="Primary CC Email Address" required="" autofocus="">

                            <input style="font-size:11px;" type="email" class="form-control" name="semail"
                                placeholder="Secondary Email Address" required="" autofocus="">

                            <input style="font-size:11px;" type="email" class="form-control" name="semailcc"
                                placeholder="Secondary CC Email Address" required="" autofocus="">


                            <!-- New Registration Form Section Ends Here  -->

                            <input style="font-size:11px;" type="password" id="user-pass"
                                onfocusout="handlepasschange()" name="user-password" class="form-control"
                                placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"
                                required autofocus="">

                            <input style="font-size:11px;" type="password" id="user-repeatpass" name="repeat-password"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"
                                class="form-control" placeholder="Repeat Password" required autofocus="">
                            <span><b id="user-reapeatpass-response"></b></span>

                            <input style="font-size:11px;" type="text" id="user-contact" name="user-contact"
                                class="form-control" placeholder="Contact Number" required autofocus="">

                            <input style="font-size:11px;" type="text" id="user-address" name="user-address"
                                class="form-control" placeholder="Address" required autofocus="">

                            <button name="sign-up" class="btn btn-primary btn-block" type="submit"><i
                                    class="fas fa-user-plus"></i> REGISTER</button>
                            <br>
                            <hr>
                            <a href="#" id="cancel_signup"><i class="fas fa-angle-left"></i> Back</a>
                        </form>

                        <!-- Sign up section ends here  -->

                        <br>

                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4 ml-6 description text-justify">
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
                            "Update Profile" in the navigation bar at the top of the page.</small></p>


                    <div class="mb-5"></div>
                </div>

            </div>
        </div>
        <div class="pb-5"></div>
        <div class="pb-5"></div>
        <div class="pb-5"></div>
        <!-- Footer section starts here  -->
        <?php include 'footer.php'; ?>
        <!-- Footer section ends here  -->
    </div>



</body>

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