 
<?php 
session_start();
error_reporting(0);
include('link/config.php');
if($_SESSION['alogin']!=''){
    $_SESSION['alogin']=''; 
    }
    if(isset($_POST['login']))  
    {
    $select = $_POST['select'];

    if ($select == "Admin") {

    // Admin Login Section starts 

    $email = $_POST['input-email'];
    $password = md5($_POST['input-password']);

    $_SESSION["email"]=$_POST['input-email']; // push to the session

    // echo $email;
    // echo $select;
    // echo $password;
    // $password=md5($_POST['pass']);
    $sql ="SELECT email,password FROM admin WHERE email=:email and password=:password";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute(); 

    $results=$query->fetchAll(PDO::FETCH_OBJ);

    if($query->rowCount() > 0)
    {
    $_SESSION['alogin']=$_POST['input-email'];
    echo "<script>alert('Logged in Success');</script>";
    echo "<script type='text/javascript'> document.location = 'admin-dashboard.php'; </script>";
    } else{
        
        echo "<script>alert('Invalid Details.Enter Correct Information');</script>";
        header("refresh:0;url=login.php");
    
    }

    // Admin Login Section ends 
    
    }
    else{

    // Authors sign in option starts here

    $email = $_POST['input-email'];
    $password=md5($_POST["input-password"]); 
    $_SESSION["email"]=$_POST['input-email']; // push to the session

    // echo $email;
    // echo $select;
    // echo $password;
    // $password=md5($_POST['pass']);
    $sql ="SELECT email,password FROM author WHERE email=:email and password=:password";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute(); 

    $results=$query->fetchAll(PDO::FETCH_OBJ);

    if($query->rowCount() > 0)
    {
    $_SESSION['alogin']=$_POST['input-email'];
    echo "<script>alert('Logged in Success');</script>";
    echo "<script type='text/javascript'> document.location = 'all-paper-author.php'; </script>";
    } else{ 
        
        echo "<script>alert('Invalid Details.Enter Correct Information');</script>";
        header("refresh:0;url=login.php");
    
    }

     // Authors sign in Option ends here
    }
    }

    // Sign Up form section starts here 

        if(isset($_POST['sign-up']))
        { 
        $username=$_POST['user-name'];
        $email=$_POST['user-email'];
        $password=md5($_POST["user-password"]); 
        $repeatPassword=md5($_POST["repeat-password"]);
        $contact=$_POST['user-contact'];
        $address=$_POST['user-address'];

        // echo $username;
        // echo $email;
        // echo $password;
        // echo $repeatPassword;
        // echo $contact;
        // echo $address;

        $sql="INSERT INTO  author(name,email,password,contact,address) VALUES(:username,:email,:password,:contact,:address)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':username',$username,PDO::PARAM_STR);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        $query->bindParam(':password',$password,PDO::PARAM_STR);
        $query->bindParam(':contact',$contact,PDO::PARAM_STR);
        $query->bindParam(':address',$address,PDO::PARAM_STR);
      
        $query->execute();

        $results=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0)
        {

        echo "<script>alert('Signed Up Success');</script>";
        echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
        } else{
            
            echo "<script>alert('Invalid Details !Something went wrong.Email address already is in use');</script>";
            header("refresh:0;url=login.php");

        }
        

        }

    // Sign Up form section ends here 

          $name = $_POST['rname'];
        $email = $_POST['remail'];
        $password = md5($_POST['rpassword']);
        $contact = $_POST['rconatct'];



    // Reset-Password section starts here 
    
    if(isset($_POST['rsubmit']))  
    {
        $name = $_POST['rname'];
        $email = $_POST['remail'];
        $password = md5($_POST['rpassword']);
        $contact = $_POST['rconatct'];


        $sql="update author set password=:password  where email=:email and contact=:contact ";

        $query = $dbh->prepare($sql);
        // $query->bindParam(':name',$name,PDO::PARAM_STR);
        $query->bindParam(':email',$email,PDO::PARAM_STR);
        $query->bindParam(':password',$password,PDO::PARAM_STR); 
        $query->bindParam(':contact',$contact,PDO::PARAM_STR); 
  
        $query->execute();
  
        $results=$query->fetchAll(PDO::FETCH_OBJ);
  
        if($query->rowCount() > 0)
        {
  
            echo "<script>alert('Password Changed Successfully');</script>";
        }
        else {
            echo "<script>alert('Contact Information is wrong');</script>";
        }

 

    }



    // Reset-Password section ends here 


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IUBAT</title>
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/login.js"></script>
    <link rel="shortcut icon" href="images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/brands.css">
    <link rel="stylesheet" href="css/brands.min.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <link rel="stylesheet" href="css/regular.css">
    <link rel="stylesheet" href="css/regular.min.css">
    <link rel="stylesheet" href="css/solid.css">
    <link rel="stylesheet" href="css/solid.min.css">
    <link rel="stylesheet" href="css/svg-with-js.css">
    <link rel="stylesheet" href="css/svg-with-js.min.css">
    <link rel="stylesheet" href="css/v4-shims.css">
    <link rel="stylesheet" href="css/v4-shims.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- Jquery section starts  -->
<script>

$(document).ready(function(){
    $("#Admin-id").click(function(){
      $("#btn-signup").hide(1000);
      $("#forgot_pswd").hide(1000);
    });
    $("#Author-id").click(function(){
      $("#btn-signup").show(1000);
      $("#forgot_pswd").show(1000);
    });
  });



</script>

<!-- Jquery Section ends  -->
</head>
<body style="font-size:13px;">

<div class="sticky-top mr-2 ml-2 pb-3">
    <!-- Heading Sections starts  -->
    <?php 
    include 'heading.php';
    ?>
    <!-- Heading Sections ends  --> 
    </div>

    <div class="container">
       <div class="row">
           <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6">
           <div id="logreg-forms">
        <form class="form-signin" method="post">
       <div class="logo-container">
                <i class="fas fa-users logo"></i>
            </div>
            <h3 class="h3 mb-3 font-weight-normal" style="text-align: center"> Sign in</h3>
            <div class="social-login">
                <!-- <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Sign in with Facebook</span> </button>
                <button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Sign in with Google+</span> </button> -->

               
                <!-- <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Sign in with Facebook</span> </button>
                <button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Sign in with Google+</span> </button> -->

                <div class="Admin_Author d-flex">

                <div class="Admins" id = "Admin-id">
                <label for="Admin" class="admin-author">Admin</label>
                <input type="radio" id = "Admin" name="select" value="Admin"  required>
                </div>

                <div class="Authors" id = "Author-id">
                <label for="Author" class="admin-author">Author</label>
                <input type="radio" id = "Author" name="select" checked="checked" value="Author">
                </div>

                </div> 
            </div>


        <!-- Sign in Section starts  -->

            <input style="font-size:13px;" type="email" id="inputEmail" class="form-control"name = "input-email" placeholder="Email address" required="" autofocus="">

            <input style="font-size:13px;" type="password" id="inputPassword" name = "input-password" class="form-control" placeholder="Password" required>
            
            <button class="btn btn-success btn-sm" name = "login" type="submit" > Admin Login</button>
            <button class="btn btn-success btn-sm " name = "login" type="submit" > Reviewer Login</button>
            <button class="btn btn-success btn-sm" name = "login" type="submit" > Editor Login</button>
            <button class="btn btn-success btn-sm" name = "login" type="submit" > Publisher Login</button>

            <div class="login-details ">
           <ul class="d-flex justify-content-center">
            <li><a href="#"> Send Login Details</a></li>
            <li id="btn-signup"><a href="#">Register Now</a></li>
            <li><a href="#">login Help </a></li>
            </ul>

            </div>

            <a href="#" id="forgot_pswd">Forgot password?</a>
            <hr>

      


        <!-- Sign in section ends  -->


            <!-- <p>Don't have an account!</p>  -->
            <!-- <button class="btn btn-primary btn-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> Sign up New Account</button> -->
            </form>


           <!-- Reset section starts here  -->

            <form  class="form-reset" method="post">
            <div class="logo-container">
                    <img src="images/forgotpass.png" alt="">
            </div>

                <input type="text" name="rname" id="resetEmail" class="form-control" placeholder="Enter your Name" required="" autofocus="">

                <input type="email" name="remail" id="resetEmail" class="form-control" placeholder="Email address" required="" >

                <input type="text" name="rcontact" id="resetEmail" class="form-control" placeholder="Enter your contact" required="">

                <input type="password" name="rpassword" id="resetEmail" class="form-control" placeholder="Enter New Password" required="">

                <button class="btn btn-primary btn-block" type="submit" name="rsubmit">Reset Password</button>
                <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> Back</a>
            </form>

          <!-- Reset section ends here  -->


            
            
            <!-- Sign up section starts here  -->

            <form  class="form-signup" method="post">
                <!-- <div class="social-login">
                    <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Sign up with Facebook</span> </button>
                </div> -->
                <!-- <div class="social-login">
                    <button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Sign up with Google+</span> </button>
                </div> -->

                <div class="logo-container">
                    <i class="fas fa-user-plus logo"></i>
                </div>
                
                <p style="text-align:center">Sign UP</p>

                <input type="text" id="user-name" class="form-control" name = "user-name" placeholder="Full name" required="" autofocus="">

                <input type="email" id="user-email" class="form-control"name = "user-email" placeholder="Email address" required autofocus="">

                <input type="password" id="user-pass" name = "user-password" class="form-control" placeholder="Password" required autofocus="">

                <input type="password" id="user-repeatpass" name = "repeat-password" class="form-control" placeholder="Repeat Password" required autofocus="">

                <input type="text" id="user-contact" name = "user-contact" class="form-control" placeholder="Contact Number" required autofocus="">

                <input type="text" id="user-address" name = "user-address" class="form-control" placeholder="Address" required autofocus="">

                <button name="sign-up" class="btn btn-primary btn-block" type="submit"><i class="fas fa-user-plus"></i> Sign Up</button>
                <a href="#" id="cancel_signup"><i class="fas fa-angle-left"></i> Back</a>
            </form>

            <!-- Sign up section ends here  -->

            <br>
            
    </div>
           </div>
           <div class="col-sm-12 col-md-12 col-lg-6 col-xl-4 ml-6 description">
               <h4 class="text-center"><b>Instructions </b></h4>
            <p><b>First-time users:</b><small> Please click on the word "Register" in the navigation bar at the top of the page and enter the requested information. Upon successful registration, you will be sent an e-mail with instructions to verify your registration. NOTE: If you received an e-mail from us with an assigned user ID and password, DO NOT REGISTER AGAIN. Simply use that information to login. Usernames and passwords may be changed after registration (see instructions below).</small></p>
            <p><b>Repeat Users:</b><small>  Please click the "Login" button from the menu above and proceed as appropriate.</small></p>
            <p><b>Authors:</b><small>Please click the "Login" button from the menu above and login to the system as "Author." You may then submit your manuscript and track its progress through the system.</small></p>
            <p><b>Reviewers:</b><small>Please click the "Login" button from the menu above and login to the system as "Reviewer." You may then view and/or download manuscripts assigned to you for review or submit your comments to the editor and the authors.</small></p>
            <p><b>To change your username and/or password:</b><small> Once you are registered, you may change your contact information, username and/or password at any time. Simply log in to the system and click on "Update My Information" in the navigation bar at the top of the page.</small></p>



           </div>

       </div>
    </div>


 
    <p style="text-align:center">
        <a href="http://bit.ly/2RjWFMfunction toggleResetPswd(e){
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle() // display:block or none
    $('#logreg-forms .form-reset').toggle() // display:block or none
}

function toggleSignUp(e){
    e.preventDefault();
    $('#logreg-forms .form-signin').toggle(); // display:block or none
    $('#logreg-forms .form-signup').toggle(); // display:block or none
}

$(()=>{
    // Login Register Form
    $('#logreg-forms #forgot_pswd').click(toggleResetPswd);
    $('#logreg-forms #cancel_reset').click(toggleResetPswd);
    $('#logreg-forms #btn-signup').click(toggleSignUp);
    $('#logreg-forms #cancel_signup').click(toggleSignUp);
})g" target="_blank" style="color:black"> <a href="index.php" id="cancel_signup"><i class="fas fa-angle-left"></i> Back to the main page</a></a>
    </p>


<!-- Essential Js,jquery,section starts  -->

<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-3.5.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>

<!-- <script src="js/login.js"></script>  -->

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/login.js"></script> -->
<!-- Essential Js,Jquery  section ends  -->
</body>
</html>