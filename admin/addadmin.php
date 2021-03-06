<?php
session_start();
error_reporting(0);
include('../link/config.php');
include('../functions.php');
checkLoggedInOrNot();
$adminemail = $_SESSION["email"];
IsAdminLoggedIn($adminemail);


            if(isset($_POST['submit'])) 
            {
            $username=$_POST['uname'];
            $password=md5($_POST['password']);
            $newpassword=md5($_POST['newpassword']);
            $fullname=$_POST['fname'];
            $email=$_POST['email'];
            $contact=$_POST['contact'];
            // $username=$_SESSION["username"];
            if($password==$newpassword) 
            {
            $sql="INSERT INTO  admin(username,fullname,password,email,contact) VALUES(:username,:fullname,:password,:email,:contact)";
            $query= $dbh -> prepare($sql);
            $query-> bindParam(':username', $username, PDO::PARAM_STR);
            $query-> bindParam(':fullname', $fullname, PDO::PARAM_STR);
            $query-> bindParam(':password', $password, PDO::PARAM_STR);
            $query-> bindParam(':email', $email, PDO::PARAM_STR);
            $query-> bindParam(':contact', $contact, PDO::PARAM_STR); 
            $query->execute();
            if( $query->rowCount() > 0) 
            {
            echo "<script>alert('Admin Added Succssfully');</script>";
            }

            else {
                echo "<script>alert('Email Already Available');</script>";
            }

            } 
            else
            {
            echo "<script>alert('Password Doesn't Match.');</script>";
            }

            }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
    <link rel="shortcut icon" href="../images/Iubat-logo.png" type="image/x-icon">
    <!-- <link rel="stylesheet" href="css/heading.css"> -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin-dashboard.css">
    <link rel="stylesheet" href="../css/index.css">
    <style>
    .chngpass {
        margin: 1px 233px;
    }
    </style>
</head>

<body>


    <!-- Author showing header sections starts  -->
    <div class="sticky-top header-floating">
        <?php include 'header.php'; ?>
    </div>
    <!-- Author showing header sections ends   -->


    <div id="mySidebar" class="sidebar">
        <?php include 'sidebar.php'; ?>

    </div>

    <div id="main">

        <a href="#"><span class="openbtn" onclick="openNav()" id="closesign">☰</span></a>
        <a href="javascript:void(0)" class="closebtn" id="closesignof" onclick="closeNav()">×</a>
        <div class="container">

            <!-- Admin Addition Section Starts here  -->

            <form name="chngpwd" class="chngpass form-admin" method="post">
                <div class="logo-container">
                    <img src="../images/admin.png" alt="">
                </div>

                <div class="form-group has-success">
                    <label for="success" class="control-label">User Name</label>
                    <div class="">
                        <input type="text" name="uname" class="form-control" id="inputEmail3" placeholder="UserName"
                            required>

                    </div>
                </div>
                <div class="form-group has-success">
                    <label for="success" class="control-label">Full Name</label>
                    <div class="">
                        <input type="text" name="fname" class="form-control" id="inputEmail3"
                            placeholder="Enter Full Name" required>

                    </div>
                </div>
                <div class="form-group has-success">
                    <label for="success" class="control-label">User Email</label>
                    <div class="">
                        <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Enter Email"
                            required>

                    </div>
                </div>
                <div class="form-group has-success">
                    <label for="success" class="control-label">Password</label>
                    <div class="">
                        <input type="password" name="password" required="required" class="form-control" id="success"
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                            title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"
                            placeholder="Password">
                    </div>
                </div>
                <div class="form-group has-success">
                    <label for="success" class="control-label">Confirm Password</label>
                    <div class="">
                        <input type="password" name="newpassword" required="required" class="form-control" id="success"
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                            title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"
                            placeholder="Confirm Password">
                    </div>
                </div>
                <div class="form-group has-success">
                    <label for="success" class="control-label">Contact</label>
                    <div class="">
                        <input type="text" name="contact" class="form-control" id="inputEmail3"
                            placeholder="Contact Number" required>
                    </div>
                </div>

                <div class="form-group  text-center">

                    <div class="">
                        <button type="submit" name="submit" class="bg-info text-white col-lg-6 p-2">Submit</button>
                    </div>
            </form>
            <!-- Admin Addition Section ends Here  -->
            <div class="mb-5"></div>
        </div>
    </div>


    <!-- Essential Js,jquery,section starts  -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery-3.5.1.slim.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <!-- Essential Js,Jquery  section ends  -->
</body>
</html>