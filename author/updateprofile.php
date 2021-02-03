<?php
session_start();
error_reporting(0); 
include('../link/config.php');

if(strlen($_SESSION['alogin'])=="") 
    {    
    header("Location:../login"); 
    } 
    else  
    {  
           $authoremail = $_SESSION["email"];

          //  Check that the author is logged in to the section or not starts here 

            $sql = "SELECT author.id,author.username,author.title,author.firstname,author.middlename,author.lastname,author.primaryemail,author.primaryemailcc,author.secondaryemail,author.secondaryemailcc,author.contact,author.address,author.password from author where primaryemail='$authoremail'"; 
            $query = $dbh->prepare($sql); 
            $query->execute(); 
            $resultsauthor=$query->fetchAll(PDO::FETCH_OBJ); 
            if($query->rowCount() > 0) 
            {
    
          // Check that the author is logged in to the section or not ends here 

        //   Update Author Profile Section starts here  

            if(isset($_POST['updateauthor']))
            { 
    
            $username=$_POST['userName'];
            $title=$_POST['title'];
            $firstname=$_POST['firstName'];
            $middlename=$_POST['middleName'];
            $lastname=$_POST['lastName'];
            $pemail=$_POST['pemail'];
            $pemailcc=$_POST['pemailcc'];
            $semail=$_POST['semail'];
            $semailcc=$_POST['semailcc'];
            $contact=$_POST['user-contact'];
            $address=$_POST['user-address']; 
    
         if ($pemail==$pemailAgain || $userpassword==$repeatPassword)
         {
        
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
                header("refresh:0;url=login.php");
            }
         }
         else {
            echo "<script>alert('Email or password doesn't matched with previous');</script>";
            header("refresh:0;url=login.php");
         }
    
            } 
    
        // Update Author Profile Section ends here 

?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widt
    h=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Update profile</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="../images/Iubat-logo.png" type="image/x-icon">
    <!-- <link rel="stylesheet" href="css/heading.css"> -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/admin-dashboard.css"> -->
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/fontawesome.v5.3.1.all.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/login.css">

    <style>
        form input {
            font-size:16px !important;
        }
    </style>
</head>
<body>

<!-- Author showing header sections starts  --> 
<div class="sticky-top header-floating ">
<?php
include 'author-header.php';
?> 
</div>
<!-- Author showing header sections ends   -->
<div id="mySidebar" class="sidebar ">
  <?php 
  include 'author-sidebar.php';
  ?>
</div> 

<div id="main">  
<!-- <a href="#"><span class="resbtn"onclick="openNav()" id="closesign">☰</span></a> -->
<a href="#"><span class="openbtn"onclick="openNav()" id="closesign">☰</span></a>
<a href="javascript:void(0)" class="closebtn" id="closesignof" onclick="closeNav()">×</a>
<div class="container"> 

<h6 >AUTHOR PROFILE</h6>
<hr class="bg-success">

<!-- Update Profile section starts here  -->
          <?php  foreach($resultsauthor as $result) {   ?>
             <form  class="form-signup marginbtm" method="post">
                <input style="font-size:11px;" type="text" id="txt_username" class="form-control" name = "userName" placeholder=" User Name" value="<?php echo htmlentities($result->username);?>" disabled>
                   <span><b id="uname_response"></b></span>

                <input style="font-size:11px;" type="text" id="user-name" class="form-control" name = "title" required="" placeholder="title" value="<?php echo htmlentities($result->title);?>">

                <div class="input-group">

                <input style="font-size:11px;" type="text" id="user-name" class="form-control col-sm-6" name = "firstName" placeholder="First Name" required="" value="<?php echo htmlentities($result->firstname);?>">

                <input style="font-size:11px;" type="text" id="user-name" class="form-control col-sm-6 ml-1" name = "middleName" placeholder="Middle Name(Optional)" value="<?php echo htmlentities($result->middlename);?>">

                <input style="font-size:11px;" type="text" id="user-name" class="form-control col-sm-6 ml-1" name = "lastName" placeholder="Last Name" required="" value="<?php echo htmlentities($result->lastname);?>">

                </div>

                <input style="font-size:11px;" type="email" id="pemail" class="form-control" onfocusout = "handlefocus()" name = "pemail" placeholder="Primary Email Address" required="" value="<?php echo htmlentities($result->primaryemail);?>">
                <span><b id="pemail-text"></b></span>

                <input style="font-size:11px;" type="email" id="user-name" class="form-control" name = "pemailcc" placeholder="Primary CC Email Address" required="" value="<?php echo htmlentities($result->primaryemailcc);?>">

                <input style="font-size:11px;" type="email" id="user-name" class="form-control" name = "semail" placeholder="Secondary Email Address" required="" value="<?php echo htmlentities($result->secondaryemail);?>">

                <input style="font-size:11px;" type="email" id="user-name" class="form-control" name = "semailcc" placeholder="Secondary CC Email Address" required="" value="<?php echo htmlentities($result->secondaryemailcc);?>">

        
                <input style="font-size:11px;" type="text" id="user-contact" name = "user-contact" class="form-control" placeholder="Contact Number" required value="<?php echo htmlentities($result->contact);?>">

                <input style="font-size:11px;" type="text" id="user-address" name = "user-address" class="form-control" placeholder="Address" required value="<?php echo htmlentities($result->address);?>">

                <button name="updateauthor" class="btn btn-sm btn-primary btn-block" type="submit"><i class="fas fa-user-plus"></i> UPDATE</button>
            </form>
            <?php  } ?>
<!-- Update profile section ends here  -->


</div>
</div>
<!-- Essential Js,jquery,section starts  -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-3.5.1.slim.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script>
            // DataTables section starts here 
            $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');
            });
            // Datables section ends here 

   function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
  document.getElementById("closesignof").style.display= "block";
  document.getElementById("closesign").style.display= "none";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.getElementById("closesign").style.display= "block";
  document.getElementById("closesignof").style.display= "none";
  
}
 
</script>
<!-- Essential Js,Jquery  section ends  -->    
</body>
</html> 

<?php 
            }
else {
  echo "<script>alert('You are not a Author.Try to log in as an Author');</script>";
  header("refresh:0;url=login.php");
}

}

    
?>