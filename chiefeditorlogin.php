 <?php 
session_start();
error_reporting(0);
include('link/config.php');
if($_SESSION['alogin']!=''){
    $_SESSION['alogin']=''; 
    }

   //  Chief editor section starts here 

    if(isset($_POST['chief-editor-login']))  
    {
        $email = $_POST['input-email'];
        $password=md5($_POST["input-password"]); 
        $_SESSION["email"]=$_POST['input-email']; // push to the session
    
        $sql ="SELECT chiefeditor.id,chiefeditor.fullname,chiefeditor.password,chiefeditor.contact FROM chiefeditor WHERE email=:email and password=:password";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':email', $email, PDO::PARAM_STR);
        $query-> bindParam(':password', $password, PDO::PARAM_STR); 
        $query-> execute();  
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0)
        {
     
            $_SESSION['alogin']=$_POST['input-email'];
            echo "<script>alert('Logged in Success');</script>";
            echo "<script type='text/javascript'> document.location = 'chiefeditor/dashboard'; </script>";
       }
       else {
        echo "<script>alert('Invalid Details.');</script>";
        header("refresh:0;url=chiefeditorlogin");
       }
    }
    
    
    // Chief editor section ends here 


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Pannel</title>
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/login.js"></script>
    <link rel="shortcut icon" href="images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/index.css">  -->
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
                <i style="font-size:35px;" class="fas fa-users logo"></i>
            </div>
            <h3 class="h3 mb-3 font-weight-normal" style="text-align: center;font-size:18px; padding:5px;"><b> SIGN IN</b></h3>
            <div class="social-login">

            </div>

            <input style="font-size:13px;" type="email" id="inputEmail" class="form-control"name = "input-email" placeholder="Email address" required="" autofocus="">

            <input style="font-size:13px;" type="password" id="inputPassword" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
  title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" name = "input-password" class="form-control" placeholder="Password" required>
            
            <button class="btn btn-info btn-sm btn-block" name = "chief-editor-login" type="submit" >Chief Editor</button>

            <div class="pb-5"></div>
            
           </div>
            
    </div>
  

       </div>
    </div>


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