<?php
session_start();
error_reporting(0);  
include('../link/config.php');  
include('../link/count.php');
include('../functions.php');
checkLoggedInOrNot();  
$authoremail = $_SESSION["email"];
IsAuthorLoggedIn($authoremail);
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="widt
    h=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Author Dashboard</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="../images/Iubat-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../css/fontawesome.v5.3.1.all.css">
</head>

<body>
    <!-- Author showing header sections starts  -->
    <div class="sticky-top header-floating ">
        <?php include 'author-header.php'; ?>
    </div>
    <!-- Author showing header sections ends   -->
    <div id="mySidebar" class="sidebar ">
        <?php  include 'author-sidebar.php'; ?>
    </div>

    <div id="main">
        <!-- <a href="#"><span class="resbtn"onclick="openNav()" id="closesign">☰</span></a> -->
        <a href="#"><span class="openbtn" onclick="openNav()" id="closesign">☰</span></a>
        <a href="javascript:void(0)" class="closebtn" id="closesignof" onclick="closeNav()">×</a>
        <div class="container">

            <!-- Progress bar section starts here  -->
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="paperstatus">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-success">
                                <i class="far fa-file"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Accepted</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo total_published_author($authoremail); ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="paperstatus">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="far fa-file"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Under Review</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo total_unpublished_author($authoremail); ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="paperstatus">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-danger">
                                <i class="far fa-file"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Rejected</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo total_reject($authoremail) ;?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="paperstatus">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-warning">
                                <i class="far fa-file"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Total</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo total_paper($authoremail); ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="reviewerstatus">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-primary">
                                <i class="far fa-user"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Reviewer</h4>
                                </div>
                                <div class="">
                                    <?php 
                                     if( reviewed($authoremail) == 0) {?> 
                                    <p style="font-size:16px;" class="text-danger"><i class="fas fa-times-circle"></i>
                                        <?php  echo "Not Selected"; ?></p>
                                    <?php } else { ?>
                                    <p style="font-size:16px;" class="text-success"><i class="fas fa-check-circle"></i>
                                        <?php  echo "Selected"; ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <a href="reviewerstatus">
                        <div class="card card-statistic-1">
                            <div class="card-icon bg-secondary">
                                <i class="far fa-newspaper"></i>
                            </div>
                            <div class="card-wrap">
                                <div class="card-header">
                                    <h4>Reviewed paper</h4>
                                </div>
                                <div class="card-body">
                                    <?php echo feedbackr($authoremail); ?>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Progress bar section ends here  -->
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