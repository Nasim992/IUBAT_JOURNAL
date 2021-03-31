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
    <title>Journal Information</title>
    <!-- Css links -->
    <?php include 'link/csslinks.php'; ?>
    <!-- Css links -->
</head>
<body>
        <header class="sticky-top">
            <!-- Heading Sections starts  -->
            <?php include 'heading.php'?>
            <!-- Heading Sections ends  -->
        </header>
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
                    <div class="text-justify pb-4">
<!-- ------------------------------Journal Information -------------------------------------- -->
                        <h5 class="text-center">JOURNAL INFORMATION</h5>
                        <hr class="bg-secondary">
                        <p>International University of Business Agriculture and Technology (IUBAT University) is a
                            government approved non-proft independent institution and its fundamental objective is human
                            resource development through appropriate teaching, training and guidance as well as creation
                            of knowledge conducive to socio economic development of developing societies in general and
                            that of Bangladesh in particular. This objective is being attained through offering courses
                            and curricula relating to various aspects of knowledge as well as providing opportunities
                            for individuals to acquire skills and relevant experience in the chosen feld of
                            specialization, research, consultancy and training through specialized Centers.

                            IUBAT University is approved by the Government of Bangladesh as a degree granting
                            institution under the Non-Government University Act of 1992. IUBAT University curriculums
                            have been approved by the University Grants Commission (UGC) of Bangladesh and vetted by
                            cooperating universities abroad. The Bangladesh Public Service Commission accepts its
                            academic standards.

                            IUBAT University operates as an international institution having linkages with 74
                            universities and institutions located in industrially developed and developing countries.
                            The university is a member of Association of Commonwealth Universities, extending its
                            recognition to all 34 Commonwealth countries including those in SAARC region. IUBAT
                            University is also a member of a number of international scholarly bodies including
                            Association of SAARC Universities, Those linkages with universities and networks enables
                            IUBAT University to conduct international programs within the country and conduct programs
                            internationally.

                            IUBAT University has more than180 Faculties (Professor, Associate Professor, Assistant
                            Professor and Lecturer) in Different Disciplines/Programs. It has 80 offcers (Registrar,
                            Deputy Registrar, Assistant Registrar, Project Director, Deputy Director, Administrative
                            offcer, Accounts offcer etc.) and 20 Staffs who represent different Department. As mentioned
                            earlier, IUBAT University is organized into colleges, departments and centers for academic
                            as well as service activities. There are nine specialized centers which carry out applied
                            research, offer diplomas, certifcate courses and professional consultancy services to
                            clients as well as support to academic programs of IUBAT University colleges and
                            departments.</p>
                        </p>
                        <h6 class="text-info"><b>EDITOR'S NOTE </b></h6>
                        <p>The IUBAT Review is a multidisciplinary academic journal that the editors intend to publish
                            annually. The offce of the Journal is located at the International University of Business
                            Agriculture and Technology, the frst non-government university in Bangladesh. It was founded
                            in 1991 as a notfor-proft institution. The university’s mission is to develop human
                            resources through quality education.

                            IUBAT Review is peer-reviewed. The editors accept submissions from authors in Bangladesh and
                            elsewhere. The articles should generally analyze current issues relevant to management,
                            social sciences, engineering, agriculture, science and technology.

                            For submission guidelines, contact the editor at ijournal@iubat.edu.</p>                       
                    </div>
                <!-- ------------------------------Journal Information -------------------------------------- -->    
                </div>
            </div>
        </div>
        <!-- Footer section starts here  -->
        <?php include 'footer.php'?>
        <!-- Footer section ends here  -->
    <!-- Essential Js,jquery,section starts  -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/popper.min.js"></script>
    <!-- Essential Js,Jquery  section ends  -->
</body>
</html>