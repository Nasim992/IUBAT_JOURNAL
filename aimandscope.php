<?php
session_start();
error_reporting(0);
include('link/config.php');
include("functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aim and scope</title>
    <!-- Css links -->
    <?php include 'link/csslinks.php'; ?>
    <!-- Css links -->
</head>

<body>
        <!-- Heading Sections starts  -->
        <header class="sticky-top">
            <?php include 'heading.php'; ?>
        </header>
        <!-- Heading Sections ends  -->
        <div style="font-size:17px;" class="container">
            <div class="row mt-3">
                <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                </div>
                <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
                    <div class="text-left pb-4">
                        <?php include "header.php"; ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Sidebar section starts here  -->
                <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
                    <?php include "sidelinks.php"; ?>
                </div>
                <!-- Sidebar Section ends here  -->
                <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
                    <section class="text-left pb-4">
                        <h5 class="text-center">AIM AND SCOPE</h5>
                        <hr class="bg-secondary">
                        <p style="font-size:17px;">It aims to address the most important issues in the aforementioned
                            fields. The journal can be
                            of great value to teachers, students, researchers, and experts dealing with these fields</p>
                        </p>
                    </section>
                </div>
            </div>
            <div class="pb-5"></div>
        </div>
        <!-- Footer section starts here  -->
        <?php include 'footer.php' ?>
        <!-- Footer section ends here  -->
    <!-- Essential Js,jquery,section starts  -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script>
    $(" .ul-nav li a").on("click", function() {
        $(this).addClass("active");
    });
    </script>
    <!-- Essential Js,Jquery  section ends  -->
</body>
</html>