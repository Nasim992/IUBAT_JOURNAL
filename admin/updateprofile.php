<?php
session_start();
error_reporting(0); 
include('../link/config.php');
include('../functions.php');
checkLoggedInOrNot();

     // Check that the Editor is logged in or not section starts here  
     $editoremail = $_SESSION["email"];
     $editoremail1 = $_SESSION["email"];
     $sql = "SELECT admin.id,admin.fullname,admin.password,admin.contact,admin.email FROM admin WHERE email='$editoremail'"; 
     $query = $dbh->prepare($sql); 
     $query->execute(); 
     $results=$query->fetchAll(PDO::FETCH_OBJ); 
     $cnt=1;
     if($query->rowCount() > 0) 
     {
     
     // Check that the Editor is logged in or not section ends here 

        //   Update Author Profile Section starts here  

            if(isset($_POST['updataadmin']))
            { 
    
            $editoremails=$_POST['editoremails'];
            $fullname=$_POST['fullname'];
            $email=$_POST['email'];
            $contact=$_POST['contact'];


            $sqlauthorupdate = "update admin set fullname='$fullname',email='$email',contact='$contact' where email='$editoremails'";

            if(mysqli_query($link,$sqlauthorupdate)) {

              echo "<script>alert('Profile Updated Successfully');</script>";
              header("refresh:0;url=updateprofile");
          } 
          else {
            echo "<script>alert('Something went Wrong !');</script>";
            header("refresh:0;url=updateprofile");
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
    <title>Editor profile</title>
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
        font-size: 16px !important;
    }
    </style>
</head>

<body>

    <!-- Author showing header sections starts  -->
    <div class="sticky-top header-floating ">
        <?php include 'header.php'; ?>
    </div>
    <!-- Author showing header sections ends   -->
    <div id="mySidebar" class="sidebar ">
        <?php  include 'sidebar.php'; ?>
    </div>
    <div id="main">
        <!-- <a href="#"><span class="resbtn"onclick="openNav()" id="closesign">☰</span></a> -->
        <a href="#"><span class="openbtn" onclick="openNav()" id="closesign">☰</span></a>
        <a href="javascript:void(0)" class="closebtn" id="closesignof" onclick="closeNav()">×</a>
        <div class="container">

            <h6>AUTHOR PROFILE</h6>
            <hr class="bg-success">

            <!-- Update Profile section starts here  -->
            <?php  foreach($results as $result) { 
            ?>
            <form class="form-signup marginbtm" method="post">

                <input style="font-size:11px;" type="hidden" id="editoremails" class="form-control" name="editoremails"
                    placeholder="Email" value="<?php echo  $editoremail1 ;?>">

                <input style="font-size:11px;" type="text" id="pemail" class="form-control" name="fullname"
                    placeholder="Fullname" required="" value="<?php echo htmlentities($result->fullname);?>">

                <input style="font-size:11px;" type="email" id="user-name" class="form-control" name="email"
                    placeholder="Email" required="" value="<?php echo   $editoremail ;?>">

                <input style="font-size:11px;" type="text" id="user-name" class="form-control" name="contact"
                    placeholder="Secondary Email Address" required=""
                    value="<?php echo htmlentities($result->contact);?>">


                <button name="updataadmin" class="btn btn-sm btn-primary btn-block" type="submit"><i
                        class="fas fa-user-plus"></i> UPDATE</button>
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
    $(document).ready(function() {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
    // Datables section ends here 

    function openNav() {
        document.getElementById("mySidebar").style.width = "250px";
        document.getElementById("main").style.marginLeft = "250px";
        document.getElementById("closesignof").style.display = "block";
        document.getElementById("closesign").style.display = "none";
    }

    function closeNav() {
        document.getElementById("mySidebar").style.width = "0";
        document.getElementById("main").style.marginLeft = "0";
        document.getElementById("closesign").style.display = "block";
        document.getElementById("closesignof").style.display = "none";

    }
    </script>
    <!-- Essential Js,Jquery  section ends  -->
</body>

</html>

<?php 
         }
         else {
           echo "<script>alert('You are not a admin.Try to log in as a admin');</script>";
           echo "<script type='text/javascript'> document.location = '../login'; </script>";
         }