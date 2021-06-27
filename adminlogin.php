 <?php 
    session_start();
    error_reporting(0);    
    include('link/config.php'); 
    include('link/functionsql.php');
    include('link/loginfunction.php');
    include('link/count.php'); 
    include('functions.php');
    if(isset($_POST['admin-login']))  
    {
        admin_login(); // form loginfunction.php file 
    }
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
 </head>
 <body>
     <div style="font-size:14px; font-weight:bold;" class="container form-control-login">
         <div class="row pt-5">

             <div id="logreg-forms">
                 <form class="form-signin marginbtm" method="post">
                     <div class="logo-container">
                         <i style="font-size:35px;" class="fas fa-users logo"></i>
                     </div>
                     <h3 class="h3 mb-3 font-weight-normal" style="text-align: center;font-size:18px; padding:5px;"><b>
                             SIGN IN</b></h3>
                     <div class="social-login">
                     </div>
                     <input style="font-size:13px;" type="email" id="inputEmail" class="form-control" name="input-email"
                         placeholder="Email address" required="" autofocus="">

                     <input style="font-size:13px;" type="password" id="inputPassword"
                         pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                         title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"
                         name="input-password" class="form-control" placeholder="Password" required>

                     <button class="btn btn-info btn-sm btn-block" name="admin-login" type="submit"> Admin Login</button>
                     </form>
                     <div class="pb-5"></div>
             </div>
         </div> 
    </div>
     </div> 
 </body>
 </html>