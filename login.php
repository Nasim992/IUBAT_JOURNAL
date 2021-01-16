 
<?php 
session_start();
error_reporting(0);
include('link/config.php');
if($_SESSION['alogin']!=''){
    $_SESSION['alogin']=''; 
    }


    if(isset($_POST['admin-login']))  
    {
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
    echo "<script type='text/javascript'> document.location = 'admin-dashboard'; </script>";
    } else{
        
        echo "<script>alert('Invalid Details.Enter Correct Information');</script>";
        header("refresh:0;url=login");
    
    }
}

    // Admin Login Section ends 
    
    //  publisher log in option starts here

    if(isset($_POST['publisher-login']))  
    {

    $email = $_POST['input-email'];
    $password=md5($_POST["input-password"]); 
    $_SESSION["email"]=$_POST['input-email']; // push to the session

    // echo $email;
    // echo $select;
    // echo $password;
    // $password=md5($_POST['pass']);
    $sql ="SELECT primaryemail,password FROM author WHERE primaryemail=:email and password=:password";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();  

    $results=$query->fetchAll(PDO::FETCH_OBJ);

    if($query->rowCount() > 0) 
    {
    $_SESSION['alogin']=$_POST['input-email'];
    echo "<script>alert('Logged in Success');</script>";
    echo "<script type='text/javascript'> document.location = 'author-dashboard'; </script>";
    } else{ 
        
        echo "<script>alert('Invalid Details.Enter Correct Information');</script>";
        header("refresh:0;url=login");
    
    }
    }
     
//  Publisher sign in Option ends here

    //  Reviewer login in option starts here
    if(isset($_POST['reviewer-login']))  
    {

    $email = $_POST['input-email'];
    $password=md5($_POST["input-password"]); 
    $_SESSION["email"]=$_POST['input-email']; // push to the session
    // echo $email;
    // echo $select;
    // echo $password;
    // $password=md5($_POST['pass']);
    $sql ="SELECT primaryemail,password,reviewerselection FROM author WHERE primaryemail=:email and password=:password and reviewerselection=1";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();  

    $results=$query->fetchAll(PDO::FETCH_OBJ);
 
    if($query->rowCount() > 0)
    {
    $_SESSION['alogin']=$_POST['input-email'];
    echo "<script>alert('Logged in Success');</script>";
    echo "<script type='text/javascript'> document.location = 'reviewer-dashboard'; </script>";
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

    // echo $email;
    // echo $select;
    // echo $password;
    // $password=md5($_POST['pass']);
    $sql ="SELECT primaryemail,password FROM author WHERE primaryemail=:email and password=:password and editorselection=1";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();  

    $results=$query->fetchAll(PDO::FETCH_OBJ);

    if($query->rowCount() > 0)
    {
    $_SESSION['alogin']=$_POST['input-email'];
    echo "<script>alert('Logged in Success');</script>";
    echo "<script type='text/javascript'> document.location = 'editor-dashboard'; </script>";
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

        // echo $username;
        // echo $title;
        // echo $firstname;
        // echo $middlename;
        // echo $lastname;
        // echo $pemail;
        // echo $pemailAgain;
        // echo $pemailcc;
        // echo $semail;
        // echo  $secmailcc;
        // echo $userpassword;
        // echo $repeatPassword;
        // echo $contact;
        // echo $address;

        // echo $username;
        // echo $email;
        // echo $password;
        // echo $repeatPassword;
        // echo $contact;
        // echo $address;
     if ($pemail==$pemailAgain || $userpassword==$repeatPassword)
     {
    
        $sql="INSERT INTO  author(username,title,firstname,middlename,lastname,primaryemail,primaryemailcc,secondaryemail,secondaryemailcc,password,contact,address) VALUES(:username,:title,:firstname,:middlename,:lastname,:pemail,:pemailcc,:semail,:semailcc,:userpassword,:contact,:address)";

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
      
        $query->execute();

        $results=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0)
        {

        echo "<script>alert('Signed Up Success');</script>";
        echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
        } else{
            
            echo "<script>alert('Invalid Details !UserName or Email address already is in use');</script>";
            header("refresh:0;url=login.php");

        }
     }
     else {
        echo "<script>alert('Email or password doesen't matched with previous');</script>";
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
    <!-- <link rel="stylesheet" href="css/index.css">  -->
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/heading.css">
    <!-- <link rel="stylesheet" href="css/brands.css">
    <link rel="stylesheet" href="css/brands.min.css"> -->
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <!-- <link rel="stylesheet" href="css/regular.css">
    <link rel="stylesheet" href="css/regular.min.css">
    <link rel="stylesheet" href="css/solid.css">
    <link rel="stylesheet" href="css/solid.min.css">
    <link rel="stylesheet" href="css/svg-with-js.css">
    <link rel="stylesheet" href="css/svg-with-js.min.css">
    <link rel="stylesheet" href="css/v4-shims.css">
    <link rel="stylesheet" href="css/v4-shims.min.css"> -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>

<div class="sticky-top  header-floating">
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
            <h3 class="h3 mb-3 font-weight-normal" style="text-align: center;font-size:18px; padding:5px;"><b> SIGN IN</b></h3>
            <div class="social-login">
                <!-- <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Sign in with Facebook</span> </button>
                <button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Sign in with Google+</span> </button> -->

               
                <!-- <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Sign in with Facebook</span> </button>
                <button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Sign in with Google+</span> </button> -->

            </div>


        <!-- Sign in Section starts Here -->

            <input style="font-size:13px;" type="email" id="inputEmail" class="form-control"name = "input-email" placeholder="Email address" required="" autofocus="">

            <input style="font-size:13px;" type="password" id="inputPassword" name = "input-password" class="form-control" placeholder="Password" required>
            
            <button class="btn btn-success btn-sm" name = "admin-login" type="submit" > Admin Login</button>
            <button class="btn btn-success btn-sm " name = "reviewer-login" type="submit" > Reviewer Login</button>
            <button class="btn btn-success btn-sm" name = "editor-login" type="submit" > Editor Login</button>
            <button class="btn btn-success btn-sm" name = "publisher-login" type="submit" > Publisher Login</button>

            <div class="login-details ">
           <ul class="d-flex justify-content-center">
            <li><a href="#"> Send Login Details</a></li>
            <li id="btn-signup"><a href="#">Register Now</a></li>
            <li><a href="#">login Help </a></li>
            </ul>

            </div>

            <a href="#" id="forgot_pswd">Forgot password?</a>
            <hr>

      


        <!-- Sign in section ends Here -->


            <!-- <p>Don't have an account!</p>  -->
            <!-- <button class="btn btn-primary btn-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> Sign up New Account</button> -->
            </form>


           <!-- Reset section starts here  -->

            <form  class="form-reset marginbtm" method="post">
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

            <form  class="form-signup marginbtm" method="post">
                <!-- <div class="social-login">
                    <button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> Sign up with Facebook</span> </button>
                </div> -->
                <!-- <div class="social-login">
                    <button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> Sign up with Google+</span> </button>
                </div> -->

                <div class="logo-container">
                    <i style="font-size:35px;" class="fas fa-user-plus logo"></i>
                </div>
                 
                <h2 style="text-align:center;font-size:18px;padding:5px;"><b>REGISTRATION FORM</b></h2>

                <!-- New Registration Form section starts Here  -->
                <input style="font-size:11px;" type="text" id="txt_username" class="form-control" name = "userName" placeholder="Enter Preferred User Name" required="" autofocus="">
                   <span><b id="uname_response"></b></span>


                <input style="font-size:11px;" type="text" id="user-name" class="form-control" name = "title" placeholder="Title (Mr., Mrs., Dr., etc.)" required="" autofocus="">

                <div class="input-group">

                <input style="font-size:11px;" type="text" id="user-name" class="form-control col-sm-6" name = "firstName" placeholder="First Name" required="" autofocus="">

                <input style="font-size:11px;" type="text" id="user-name" class="form-control col-sm-6 ml-1" name = "middleName" placeholder="Middle Name(Optional)"  autofocus="">

                <input style="font-size:11px;" type="text" id="user-name" class="form-control col-sm-6 ml-1" name = "lastName" placeholder="Last Name" required="" autofocus="">

                </div>

                <input style="font-size:11px;" type="email" id="pemail" class="form-control" onfocusout = "handlefocus()" name = "pemail" placeholder="Primary Email Address" required="" autofocus="">
                <span><b id="pemail-text"></b></span>

                <input style="font-size:11px;" type="email" id="pemailAgain" class="form-control" name = "pemailAgain" placeholder="Primary Email Address again" required="" autofocus="">
                <span><b id="pemailAgain-response"></b></span>

                <input style="font-size:11px;" type="email" id="user-name" class="form-control" name = "pemailcc" placeholder="Primary CC Email Address" required="" autofocus="">

                <input style="font-size:11px;" type="email" id="user-name" class="form-control" name = "semail" placeholder="Secondary Email Address" required="" autofocus="">

                <input style="font-size:11px;" type="email" id="user-name" class="form-control" name = "semailcc" placeholder="Secondary CC Email Address" required="" autofocus="">

                
                <!-- New Registration Form Section Ends Here  -->

                <input style="font-size:11px;" type="password" id="user-pass" onfocusout="handlepasschange()" name = "user-password" class="form-control" placeholder="Password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
  title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" required autofocus="">

                <input style="font-size:11px;" type="password" id="user-repeatpass" name = "repeat-password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
  title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" class="form-control" placeholder="Repeat Password" required autofocus="">
                    <span><b id="user-reapeatpass-response"></b></span>

                <input style="font-size:11px;" type="text" id="user-contact" name = "user-contact" class="form-control" placeholder="Contact Number" required autofocus="">

                <input style="font-size:11px;" type="text" id="user-address" name = "user-address" class="form-control" placeholder="Address" required autofocus="">

                <button name="sign-up" class="btn btn-primary btn-block" type="submit"><i class="fas fa-user-plus"></i> REGISTER</button>
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

</body>

<!-- Check that the username is availavle on the database or not  -->
<script>
$(document).ready(function(){

   $("#txt_username").keyup(function(){

      var username = $(this).val().trim();

      if(username != ''){

         $.ajax({
            url: 'link/ajaxfile.php',
            type: 'post',
            data: {username: username},
            success: function(response){

                $('#uname_response').html(response);

             }
         });
      }else{
         $("#uname_response").html("");
      }

    });

 });


//  Email is exists or not checking email

$(document).ready(function(){

$("#pemail").keyup(function(){

   var primaryemail = $(this).val().trim();

   if(primaryemail != ''){

      $.ajax({
         url: 'link/ajaxfile.php',
         type: 'post',
         data: {primaryemail: primaryemail},
         success: function(response){

             $('#pemail-text').html(response);

          }
      });
   }else{
      $("#pemail-text").html("");
   }

 });

});
// Check that the email address is exists or not in the database secion ends here 


// Checking Previous Email is matched or not starts here

function handlefocus() {

    $(document).ready(function(){

        var pemail = document.getElementById('pemail').value;
     $("#pemailAgain").keyup(function(){

   var pemailAgain = $(this).val().trim();

      if(pemailAgain != ''){

      $.ajax({
         url: 'link/ajaxfile.php',
         type: 'post',
         data: {pemailAgain: pemailAgain,pemail:pemail},
         success: function(response){

             $('#pemailAgain-response').html(response);

          }
      });
   }else{
      $("#pemailAgain-response").html("");
   }

 });

});
}
// Checking previous Email is matched or not ends here

// Checking that the reapeat pass is matched or not section starts here 

function handlepasschange() {

$(document).ready(function(){

    var userpassword = document.getElementById('user-pass').value;
    console.log(userpassword);
 $("#user-repeatpass").keyup(function(){

var userrepeatpass = $(this).val().trim();

  if(userrepeatpass != ''){

  $.ajax({
     url: 'link/ajaxfile.php',
     type: 'post',
     data: {userrepeatpass: userrepeatpass,userpassword:userpassword},
     success: function(response){

         $('#user-reapeatpass-response').html(response);

      }
  });
}else{
  $("#user-reapeatpass-response").html("");
}

});

});
}

// Checking that the repeat pass is matched or not section ends here  section is ends here 


</script>

<!-- Check that the username is availavle on the database or not  -->

</html>